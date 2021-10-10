<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Admin\HandleRefundRequest;



class OrdersController extends AdminController
{
    protected $title = ' 需求单';

    protected function grid()
    {
        $grid = new Grid(new Order);

        // 只展示已确认的需求单，并且默认按确认时间倒序排序
        $grid->model()->whereNotNull('confirmed_at')->orderBy('confirmed_at', 'desc');

        $grid->no('需求单流水号');
        // 展示关联关系的字段时，使用 column 方法
        $grid->column('user.name', '领用家');
        // $grid->total_amount('总金额')->sortable();
        $grid->confirmed_at('确认时间')->sortable();
        $grid->ship_status('物流')->display(function($value) {
            return Order::$shipStatusMap[$value];
        });
        $grid->refund_status('退货状态')->display(function($value) {
            return Order::$refundStatusMap[$value];
        });
        // 禁用创建按钮，后台不需要创建需求单
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {
            // 禁用删除和编辑按钮
            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    public function show($id, Content $content)
    {
        return $content
            ->header('查看需求单')
            // body 方法可以接受 Laravel 的视图作为参数
            ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }

        public function ship(Order $order, Request $request)
    {
        // 判断当前需求单是否已支付
        if (!$order->confirmed_at) {
            throw new InvalidRequestException('该需求单未确认');
        }
        // 判断当前需求单发放状态是否为未发放
        if ($order->ship_status !== Order::SHIP_STATUS_PENDING) {
            throw new InvalidRequestException('该需求单已发放');
        }
        // Laravel 5.5 之后 validate 方法可以返回校验过的值
        // $data = $this->validate($request, [
        //     'express_company' => ['required'],
        //     'express_no'      => ['required'],
        // ], [], [
        //     'express_company' => '物流公司',
        //     'express_no'      => '物流单号',
        // ]);
        // 将需求单发放状态改为已发放，并存入物流信息
        $order->update([
            'ship_status' => Order::SHIP_STATUS_DELIVERED,
            // 我们在 Order 模型的 $casts 属性里指明了 ship_data 是一个数组
            // 因此这里可以直接把数组传过去
            // 'ship_data'   => $data,
        ]);

        // 返回上一页
        return redirect()->back();
    }

    public function handleRefund(Order $order, HandleRefundRequest $request)
    {
        // 判断需求单状态是否正确
        if ($order->refund_status !== Order::REFUND_STATUS_APPLIED) {
            throw new InvalidRequestException('需求单状态不正确');
        }
        // 是否同意退货
        if ($request->input('agree')) {
            // 同意退货的逻辑这里先留空
            // todo
        } else {
            // 将拒绝退货理由放到需求单的 extra 字段中
            $extra = $order->extra ?: [];
            $extra['refund_disagree_reason'] = $request->input('reason');
            // 将需求单的退货状态改为未退货
            $order->update([
                'refund_status' => Order::REFUND_STATUS_PENDING,
                'extra'         => $extra,
            ]);
        }

        return $order;
    }
}

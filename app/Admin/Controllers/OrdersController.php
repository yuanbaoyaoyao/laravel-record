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


        $grid->model()->whereNotNull('confirmed_at')->orderBy('confirmed_at', 'desc');

        $grid->no('需求单流水号');

        $grid->column('user.name', '领用人');
        $grid->confirmed_at('确认时间')->sortable();
        $grid->ship_status('发放状态')->display(function($value) {
            return Order::$shipStatusMap[$value];
        });
        $grid->refund_status('退货状态')->display(function($value) {
            return Order::$refundStatusMap[$value];
        });

        $grid->disableCreateButton();
        $grid->actions(function ($actions) {

            $actions->disableDelete();
            $actions->disableEdit();
        });
        $grid->tools(function ($tools) {

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

            ->body(view('admin.orders.show', ['order' => Order::find($id)]));
    }

        public function ship(Order $order, Request $request)
    {

        if (!$order->confirmed_at) {
            throw new InvalidRequestException('该需求单未确认');
        }

        if ($order->ship_status !== Order::SHIP_STATUS_PENDING) {
            throw new InvalidRequestException('该需求单已发放');
        }

        $order->update([
            'ship_status' => Order::SHIP_STATUS_DELIVERED,
        ]);

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
            $extra = $order->extra ?: [];
            unset($extra['refund_disagree_reason']);
            $order->update([
                'extra' => $extra,
            ]);
            // 调用退货逻辑
            $this->_refundOrder($order);
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

    protected function _refundOrder(Order $order)
    {
        $order->update([
            'refund_status' => Order::REFUND_STATUS_SUCCESS,
        ]);
    }
}

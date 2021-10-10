<?php

namespace App\Admin\Controllers;

use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OrdersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());

        $grid->model()->whereNotNull('confirmed_at')->orderBy('confirmed_at', 'desc');

        $grid->no('需求单流水号');
        $grid->column('user.name', '领用人');
        // $grid->total_amount('总金额')->sortable();
        $grid->confirmed_at('确认时间')->sortable();
        $grid->ship_status('物流')->display(function($value) {
            return Order::$shipStatusMap[$value];
        });
        // $grid->refund_status('退款状态')->display(function($value) {
        //     return Order::$refundStatusMap[$value];
        // });
        // 禁用创建按钮，后台不需要创建订单
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

    // /**
    //  * Make a show builder.
    //  *
    //  * @param mixed $id
    //  * @return Show
    //  */
    // protected function detail($id)
    // {
    //     $show = new Show(Order::findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('no', __('No'));
    //     $show->field('user_id', __('User id'));
    //     $show->field('address', __('Address'));
    //     $show->field('remark', __('Remark'));
    //     $show->field('confirmed_at', __('Confirmed at'));
    //     $show->field('closed', __('Closed'));
    //     $show->field('ship_status', __('Ship status'));
    //     $show->field('ship_data', __('Ship data'));
    //     $show->field('extra', __('Extra'));
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));

    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Order());

    //     $form->text('no', __('No'));
    //     $form->number('user_id', __('User id'));
    //     $form->textarea('address', __('Address'));
    //     $form->textarea('remark', __('Remark'));
    //     $form->datetime('confirmed_at', __('Confirmed at'))->default(date('Y-m-d H:i:s'));
    //     $form->switch('closed', __('Closed'));
    //     $form->text('ship_status', __('Ship status'))->default('pending');
    //     $form->textarea('ship_data', __('Ship data'));
    //     $form->textarea('extra', __('Extra'));

    //     return $form;
    // }
}

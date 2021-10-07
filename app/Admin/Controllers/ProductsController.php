<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProductsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '耗材';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->id('ID')->sortable();
        $grid->title('耗材名称');
        $grid->in_warehouse('在库')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->sold_count('销量');

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });
        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    // protected function detail($id)
    // {
    //     $show = new Show(Product::findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('title', __('Title'));
    //     $show->field('description', __('Description'));
    //     $show->field('image', __('Image'));
    //     $show->field('in_warehouse', __('In warehouse'));
    //     $show->field('sold_count', __('Sold count'));
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));

    //     return $show;
    // }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('title', '耗材名称')->rules('required');

        $form->image('image', '封面图片')->rules('required|image');

        $form->quill('description', '耗材描述')->rules('required');

        $form->radio('in_warehouse', '在库')->options(['1' => '是', '0'=> '否'])->default('0');

        $form->hasMany('skus', 'SKU 列表', function (Form\NestedForm $form) {
            $form->text('title', 'SKU 名称')->rules('required');
            $form->text('description', 'SKU 描述')->rules('required');
            $form->text('stock', '剩余库存')->rules('required|integer|min:0');
        });

        // $form->saving(function (Form $form) {
        //     $form->model()->stock = collect($form->input('skus'))->where(Form::REMOVE_FLAG_NAME, 0)->min('stock') ?: 0;
        // });

        return $form;
    }
}

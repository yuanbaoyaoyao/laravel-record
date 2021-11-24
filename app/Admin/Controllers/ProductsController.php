<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    use HasResourceActions;

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
    public function index(Content $content)
    {
        return $content
//            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }

    protected function grid()
    {
        $grid = new Grid(new Product());


        $grid->id('ID')->sortable();
        $grid->title('耗材名称');
        $grid->in_warehouse('在库')->display(function ($value) {
            return $value ? '是' : '否';
        });
        $grid->sold_count('发放量');

        $grid->actions(function ($actions) {
            // $actions->disableView();
//            $actions->disableDelete();
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

        $form->radio('in_warehouse', '在库')->options(['1' => '是', '0' => '否'])->default('0');

        $form->hasMany('skus', '型号 列表', function (Form\NestedForm $form) {
            $form->text('title', '型号 名称')->rules('required');
            $form->text('description', '型号 描述')->rules('required');
            $form->text('stock', '剩余库存')->rules('required|integer|min:0');
        });

        return $form;
    }

    public function create(Content $content)
    {
        return $content
            ->body($this->form());
    }

    public function edit($id, Content $content)
    {
        return $content
            ->body($this->form()->edit($id));
    }


    //显示耗材领用详情
    public function show($id, Content $content, Request $request)
    {
        $data = DB::table('order_items',)
            ->join('product_skus', 'product_skus.id', '=', 'order_items.product_sku_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('product_skus.title', 'users.name', 'order_items.amount', 'orders.delivered_at')
            ->where('order_items.product_id', '=', $id)
            ->WhereNotNull('orders.delivered_at')
            ->orderBy('orders.delivered_at', 'desc');
        $builder = $data;
        if ($search = $request->input('search', '')) {
            $like = '%' . $search . '%';
            // 模糊搜索SKU 标题、领用人
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('name', 'like', $like);
            });
        }

        $data = $builder->paginate(20);

        return $content->title('详情')
            ->description('简介')
            ->body(view('admin.products.show',
                ['product' => Product::find($id),
                    'data' => $data,
                    'filters' => [
                        'search' => $search,
                    ],]));

    }
}

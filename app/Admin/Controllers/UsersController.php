<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    use HasResourceActions;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->id('ID');

        $grid->name('用户名');

        $grid->email('邮箱');

        $grid->email_verified_at('已验证邮箱')->display(function ($value) {
            return $value ? '是' : '否';
        });

        $grid->created_at('注册时间');

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            // $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }

    public function index(Content $content)
    {
        return $content
            ->body($this->grid());
    }

    //显示用户领用详情
    public function show($id, Content $content, Request $request)
    {
        $data = DB::table('order_items',)
            ->join('product_skus', 'product_skus.id', '=', 'order_items.product_sku_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->select('product_skus.title', 'users.name', 'order_items.amount', 'orders.delivered_at')
            ->where('users.id', '=', $id)
            ->WhereNotNull('orders.delivered_at')
            ->orderBy('orders.delivered_at', 'desc');
        $builder = $data;
        if ($search = $request->input('search', '')) {
            $like = '%' . $search . '%';
            // 模糊搜索SKU 标题
            $builder->where(function ($query) use ($like) {
                $query->where('title', 'like', $like);
            });
        }

        $data = $builder->paginate(20);

        return $content->title('详情')
            ->description('简介')
            ->body(view('admin.users.show',
                ['user' => User::find($id),
                    'data' => $data,
                    'filters' => [
                        'search' => $search,
                    ],]));

    }

}

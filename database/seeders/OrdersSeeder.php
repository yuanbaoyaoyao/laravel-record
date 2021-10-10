<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);
        // 创建 100 笔订单
        $orders = factory(Order::class, 100)->create();
        // 被购买的商品，用于后面更新商品销量和评分
        $products = collect([]);
        foreach ($orders as $order) {
            // 每笔订单随机 1 - 3 个商品
            $items = factory(OrderItem::class, random_int(1, 3))->create([
                'order_id'    => $order->id,
            ]);

            // 将这笔订单的商品合并到商品集合中
            $products = $products->merge($items->pluck('product'));
        }

        // 根据商品 ID 过滤掉重复的商品
        $products->unique('id')->each(function (Product $product) {
            // 查出该商品的销量、评分、评价数
            $result = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('confirmed_at');
                })
                ->first([
                    \DB::raw('sum(amount) as sold_count'),
                ]);

            $product->update([
                'sold_count'   => $result->sold_count,
            ]);
        });
    }
}

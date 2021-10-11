<?php

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    public function run()
    {
        $faker = app(Faker\Generator::class);
        $orders = Order::factory()->count(100)->create();
        $products = collect([]);
        foreach ($orders as $order) {
            $items = OrderItem::factory()->count(random_int(1, 3))->create([
                'order_id'    => $order->id,
            ]);

            $products = $products->merge($items->pluck('product'));
        }

        // 根据商品 ID 过滤掉重复的商品
        $products->unique('id')->each(function (Product $product) {
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

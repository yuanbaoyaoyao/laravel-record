<?php

namespace Database\Factories;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        $product = Product::query()->where('in_warehouse', true)->inRandomOrder()->first();
        $sku = $product->skus()->inRandomOrder()->first();

        return [
            'amount'         => random_int(1, 5), // 购买数量随机 1 - 5 份
            'product_id'     => $product->id,
            'product_sku_id' => $sku->id,
        ];
    }
}
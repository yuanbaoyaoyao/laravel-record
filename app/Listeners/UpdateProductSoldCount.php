<?php

namespace App\Listeners;

use App\Events\OrderConfirmed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\OrderItem;
//  implements ShouldQueue 代表此监听器是异步执行的
class UpdateProductSoldCount implements ShouldQueue
{
    // Laravel 会默认执行监听器的 handle 方法，触发的事件会作为 handle 方法的参数
    public function handle(OrderConfirmed $event)
    {
        $order = $event->getOrder();
        $order->load('items.product');
        foreach ($order->items as $item) {
            $product   = $item->product;
            $soldCount = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('confirmed_at');
                })->sum('amount');
            $product->update([
                'sold_count' => $soldCount,
            ]);
        }
    }
}

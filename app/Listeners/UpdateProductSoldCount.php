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
        // 从事件对象中取出对应的订单
        $order = $event->getOrder();
        // 预加载耗材数据
        $order->load('items.product');
        // 循环遍历订单的耗材
        foreach ($order->items as $item) {
            $product   = $item->product;
            // 计算对应耗材的发放量
            $soldCount = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('confirmed_at');  // 关联的订单状态是已支付
                })->sum('amount');
            // 更新耗材发放量
            $product->update([
                'sold_count' => $soldCount,
            ]);
        }
    }
}

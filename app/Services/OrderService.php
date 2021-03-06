<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Order;
use App\Models\ProductSku;
use App\Exceptions\InvalidRequestException;
use App\Jobs\CloseOrder;
use Carbon\Carbon;

class OrderService
{
    public function store(User $user, UserAddress $address, $remark, $items)
    {
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $address, $remark, $items) {
            $address->update(['last_used_at' => Carbon::now()]);
            $order   = new Order([
                'address'      => [ // 将领用信息信息放入订单中
                    'address'       => $address->full_address,
                    'user'          => $address->user,
                    'contact_phone' => $address->contact_phone,
                ],
                'remark'       => $remark,
            ]);
            $order->user()->associate($user);
            $order->save();
            //直接确认订单
            $order->update(['confirmed_at' => Carbon::now()]);
            $order->save();

            foreach ($items as $data) {
                $sku  = ProductSku::find($data['sku_id']);
                // 创建一个 OrderItem 并直接与当前订单关联
                $item = $order->items()->make([
                    'amount' => $data['amount'],
                ]);
                $item->product()->associate($sku->product_id);
                $item->productSku()->associate($sku);
                $item->save();
                if ($sku->decreaseStock($data['amount']) <= 0) {
                    throw new InvalidRequestException('该耗材库存不足');
                }
            }

            // 将下单的耗材从需求单中移除
            $skuIds = collect($items)->pluck('sku_id')->all();
            app(CartService::class)->remove($skuIds);

            return $order;
        });

        dispatch(new CloseOrder($order, config('app.order_ttl')));

        return $order;
    }
}

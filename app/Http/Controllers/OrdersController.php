<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\ProductSku;
use App\Models\Userinfo;
use App\Models\Order;
use Carbon\Carbon;
use App\Exceptions\InvalidRequestException;


class OrdersController extends Controller
{
    public function store(OrderRequest $request)
    {
        $user  = $request->user();
        // 开启一个数据库事务
        $order = \DB::transaction(function () use ($user, $request) {
            $info = UserInfo::find($request->input('info_id'));
            // 更新此地址的最后使用时间
            $info->update(['last_used_at' => Carbon::now()]);
            // 创建一个订单
            $order = new Order([
                'info' => [ // 将地址信息放入订单中
                                    'info' => $info->department,
                                    'user' => $info->user,
                                    'contact_phone' => $info->contact_phone,
                ],
                'remark' => $request->input('remark'),
            ]);
            // 订单关联到当前用户
            $order->user()->associate($user);
            // 写入数据库
            $order->save();

            $items = $request->input('items');
            // 遍历用户提交的 SKU
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
                    throw new InvalidRequestException('该商品库存不足');
                }
            }

            // 将下单的商品从购物车中移除
            $skuIds = collect($items)->pluck('sku_id');
            $user->cartItems()->whereIn('product_sku_id', $skuIds)->delete();

            return $order;
        });

        return $order;
    }
}

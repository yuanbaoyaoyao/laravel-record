<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Order;
use App\Services\OrderService;
use Carbon\Carbon;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\ApplyRefundRequest;




class OrdersController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::query()
            // 使用 with 方法预加载，避免N + 1问题
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order, Request $request)
    {
        $this->authorize('own', $order);
        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    // public function update(Order $order, Request $request)
    // {
    //     $this->authorize('own', $order);
    //     $order->update(['confirmed_at' => Carbon::now()]);
    //     dd($order);
    //     return redirect()->route('orders.show');
    // }

    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user    = $request->user();
        $address = UserAddress::find($request->input('address_id'));

        return $orderService->store($user, $address, $request->input('remark'), $request->input('items'));
    }

    public function received(Order $order, Request $request)
    {
        // 校验权限
        $this->authorize('own', $order);

        // 判断需求单的发放状态是否为已发放
        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new InvalidRequestException('发放状态不正确');
        }

        // 更新发放状态为已收到
        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        // 返回原页面
        return $order;
    }

    public function applyRefund(Order $order, ApplyRefundRequest $request)
    {
        // 校验需求单是否属于当前用户
        $this->authorize('own', $order);
        // 判断需求单是否已付款
        if (!$order->confirmed_at) {
            throw new InvalidRequestException('该需求单未确认，不可退货');
        }
        // 判断需求单退货状态是否正确
        if ($order->refund_status !== Order::REFUND_STATUS_PENDING) {
            throw new InvalidRequestException('该需求单已经申请过退货，请勿重复申请');
        }
        // 将用户输入的退货理由放到需求单的 extra 字段中
        $extra                  = $order->extra ?: [];
        $extra['refund_reason'] = $request->input('reason');
        // 将需求单退货状态改为已申请退货
        $order->update([
            'refund_status' => Order::REFUND_STATUS_APPLIED,
            'extra'         => $extra,
        ]);

        return $order;
    }
}

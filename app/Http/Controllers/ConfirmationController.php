<?php

namespace App\Http\Controllers;

use App\Events\OrderConfirmed;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\Request;
use App\Models\Order;
use Carbon\Carbon;

class ConfirmationController extends Controller
{
    //
    public function store(Order $order,Request $request)
    {
        $this->authorize('own',$order);

        if ($order->confirmed_at || $order->closed) {
            throw new InvalidRequestException('订单状态不正确');
        }

        $order->update(['confirmed_at' => Carbon::now()]);
        $this->afterConfirmed($order);

        return redirect()->route('orders.index');
    }

    protected function afterConfirmed(Order $order)
    {
        event(new OrderConfirmed($order));
    }
}

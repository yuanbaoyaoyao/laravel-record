<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CouponCode;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        $user = User::query()->inRandomOrder()->first();
        $address = $user->addresses()->inRandomOrder()->first();
        $refund = random_int(0, 10) < 1;
        $ship = $this->faker->randomElement(array_keys(Order::$shipStatusMap));
        return [
            'address'        => [
                'address'       => $address->full_address,
                'user'  => $address->user,
                'contact_phone' => $address->contact_phone,
            ],
            'remark'         => $this->faker->sentence,
            'confirmed_at'        => $this->faker->dateTimeBetween('-30 days'), // 30天前到现在任意时间点

            'refund_status'  => $refund ? Order::REFUND_STATUS_SUCCESS : Order::REFUND_STATUS_PENDING,
            'closed'         => false,
            'ship_status'    => $ship,
            'extra'          => $refund ? ['refund_reason' => $this->faker->sentence] : [],
            'user_id'        => $user->id,
        ];
    }
}
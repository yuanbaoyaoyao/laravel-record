<?php

use App\Models\CouponCode;
use App\Models\Order;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $user = User::query()->inRandomOrder()->first();
    $address = $user->addresses()->inRandomOrder()->first();
    // 10% 的概率把订单标记为退款
    $refund = random_int(0, 10) < 1;
    $ship = $faker->randomElement(array_keys(Order::$shipStatusMap));

    return [
        'address'        => [
            'address'       => $address->full_address,
            'zip'           => $address->zip,
            'user'  => $address->user,
            'contact_phone' => $address->contact_phone,
        ],
        'remark'         => $faker->sentence,
        'confirmed_at'        => $faker->dateTimeBetween('-30 days'), // 30天前到现在任意时间点
        'refund_status'  => $refund ? Order::REFUND_STATUS_SUCCESS : Order::REFUND_STATUS_PENDING,
        'closed'         => false,
        'ship_status'    => $ship,
        'extra'          => $refund ? ['refund_reason' => $faker->sentence] : [],
        'user_id'        => $user->id,
    ];
});

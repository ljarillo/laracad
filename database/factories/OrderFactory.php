<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(\App\Models\Tenant::class),
        'identify' => uniqid() . Str::random(10),
        'total' => 80.3,
        'status' => 'open',
    ];
});

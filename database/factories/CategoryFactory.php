<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'tenant_id' => factory(\App\Models\Tenant::class),
        'name' => $faker->unique()->name,
        'description' => $faker->sentence,
    ];
});

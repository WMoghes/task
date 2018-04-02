<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->name,
        'email' => $faker->safeEmail,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'permission_id' => 2,
        'status' => array_rand(getArrayOfClientStatus()),
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'product_name' => 'pro_' . $faker->company,
        'product_price' => $faker->numberBetween(150, 30000),
        'product_description' => $faker->sentence(),
        'product_details' => $faker->text,
        'product_quantity' => $faker->numberBetween(5,55),
        'product_admin_verify' => $faker->numberBetween(0, 1),
        'category_id' => $faker->numberBetween(1, 10)
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'order_user_id' => $faker->numberBetween(10, 30),
        'order_total_amount' => $faker->numberBetween(550, 66000),
        'order_status' => array_rand(getArrayOFOrderStatus()),
        'order_address' => $faker->address
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'category_name' => $faker->company
    ];
});

$factory->define(App\OrderDetail::class, function (Faker\Generator $faker) {
    return [
        'order_id' => $faker->numberBetween(1, 110),
        'product_id' => $faker->numberBetween(1, 110),
        'product_quantity' => $faker->numberBetween(2, 15)
    ];
});

$factory->define(App\Permission::class, function (Faker\Generator $faker) {
    return [
        'permission_name' => $faker->numberBetween(1, 100),
    ];
});
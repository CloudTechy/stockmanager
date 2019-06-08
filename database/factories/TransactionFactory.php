<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {

    $user = User::inRandomOrder()->get()->first()->id;

    return [

        'due_date' => $faker->dateTime($max = 'now', $timezone = null),
        'status' => $faker->randomElement($array = array('paid', 'pending', 'not-paid')),
        'user_id' => $user,
    ];
});

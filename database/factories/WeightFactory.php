<?php

use Faker\Generator as Faker;

$factory->define(App\Weight::class, function (Faker $faker) {

    return [
        'weight' => $faker->numberBetween(80, 120),
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
    ];
});

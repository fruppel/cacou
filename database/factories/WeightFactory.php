<?php

use Faker\Generator as Faker;

$factory->define(App\Weight::class, function (Faker $faker) {
    return [
        'weight' => $faker->numberBetween(90, 110),
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        "formation_id" => $faker->numberBetween(1,5),
        "user_id" => $faker->numberBetween(1,5),
    ];
});

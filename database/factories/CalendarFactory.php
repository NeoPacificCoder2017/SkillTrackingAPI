<?php

use Faker\Generator as Faker;

$factory->define(App\Calendar::class, function (Faker $faker) {
    return [
    "file_name" => $faker->name(),
    "formation_id" => $faker->numberBetween(1,5)
    ];
});

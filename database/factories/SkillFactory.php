<?php

use Faker\Generator as Faker;

$factory->define(App\Skill::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "is_mandatory" => $faker->numberBetween(0,1),
        "module_id" => $faker->numberBetween(1,5)
    ];
});

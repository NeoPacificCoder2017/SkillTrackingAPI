<?php

use Faker\Generator as Faker;

$factory->define(App\FormationDetail::class, function (Faker $faker) {
    $datePerso = [
        '2018-06-18',
        '2018-06-20',
        '2018-06-22',
        '2018-06-24',
        '2018-06-26',
        '2018-06-28',
        '2018-06-30',
        '2018-07-10',
        '2018-07-18',
        '2018-07-20',
        '2018-07-19'
    ];
    return [
        "teacher_id" => $faker->numberBetween(1,5),
        "module_id" => $faker->numberBetween(1,5),
        "formation_id" => $faker->numberBetween(1,5),
    ];
});

<?php

use Faker\Generator as Faker;

$factory->define(App\Report::class, function (Faker $faker) {
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
        "text" => $faker->text(25),
        "student_id" => $faker->numberBetween(1,5),
        "is_daily" => $faker->numberBetween(0,1),
        "rate" => $faker->numberBetween(15,20),
        "date" => $datePerso[$faker->numberBetween(0,8)],
        "text" => $faker->text(25),
    ];
});

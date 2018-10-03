<?php

use Faker\Generator as Faker;

$factory->define(App\ReportComment::class, function (Faker $faker) {
    return [
        "text" => $faker->text(25),
        "user_id" => $faker->numberBetween(1,5),
        "report_id" => $faker->numberBetween(1,5)
    ];
});

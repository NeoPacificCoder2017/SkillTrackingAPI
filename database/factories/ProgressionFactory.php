<?php

use Faker\Generator as Faker;

$factory->define(App\Progression::class, function (Faker $faker) {
    return [
        "student_id" => $faker->numberBetween(1,5),
        "student_validation" => $faker->numberBetween(1,5),
        "teacher_validation" => $faker->numberBetween(1,5),
        "skill_id" => $faker->numberBetween(1,5)
    ];
});

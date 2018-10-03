<?php

use Faker\Generator as Faker;

$factory->define(App\Parameter::class, function (Faker $faker) {
    return [
        "request_doc_id" => $faker->numberBetween(1,50),
        "name" => $faker->name(10),
        "type" => $faker->word,
        "position" => $faker->word,
        "required" => $faker->numberBetween(0,1),
        "description" => $faker->text(100),
    ];
});

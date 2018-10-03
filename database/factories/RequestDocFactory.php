<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\RequestDoc::class, function (Faker $faker) {
    $requestColor = [
        'success',
        'primary',
        'warning',
        'danger',
    ];

    $requestMethod = [
        'get',
        'put',
        'post',
        'delete',
    ];

    return [
        "title" => $faker->text(8),
        "url" => $faker->url,
        "method" => $requestMethod[$faker->numberBetween(0,3)],
        "response" => $faker->text(80),
        "description" => $faker->text(150),
        "color" => $requestColor[$faker->numberBetween(0,3)],
        "user_type_id" => $faker->numberBetween(1,3),
    ];
});

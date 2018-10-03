<?php

use Faker\Generator as Faker;

$factory->define(App\Module::class, function (Faker $faker) {
    $moduleName = [
        "HTML",
        "JAVA",
        "JAVASCRIPT",
        "WEB MOBILE",
        "BASE DE DONEES",
        "WEB APPLICATION",
        "PHP",
        "C++",
        "C#"
    ];
    
    return [
        "name" => $moduleName[$faker->numberBetween(0,7)],
    ];
});

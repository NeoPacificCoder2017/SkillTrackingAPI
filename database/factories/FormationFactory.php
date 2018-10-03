<?php

use Faker\Generator as Faker;

$factory->define(App\Formation::class, function (Faker $faker) {
    $formationName = [
        "Npc - Neo Pacific Coder",
        "Tcc - Tahiti Code Camp"
    ];
    
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
        'name'=>$formationName[$faker->numberBetween(0,1)],
        'logo'=>$faker->url(),
        'start_at'=>$datePerso[$faker->numberBetween(0,7)],
        'end_at'=>$datePerso[$faker->numberBetween(0,7)],
    ];
});

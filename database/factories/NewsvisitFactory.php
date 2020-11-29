<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NewsVisit;
use Faker\Generator as Faker;

$factory->define(NewsVisit::class, function (Faker $faker) {
    return [
        'news_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11']),
        'visit_id' => $faker->unique()->numberBetween($min=1, $max=700) 
    ];
});

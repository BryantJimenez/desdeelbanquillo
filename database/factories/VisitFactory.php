<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    return [
    	'visitor' => $faker->ipv4,
    	'device' =>  $faker->randomElement(['Escritorio', 'Teléfono', 'Tablet']),
    	'created_at' => Carbon\Carbon::create(2020, $faker->month, $faker->dayOfMonth)
    ];
});

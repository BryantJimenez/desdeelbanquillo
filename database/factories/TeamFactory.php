<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Team::class, function (Faker $faker) {
	$name=$faker->unique()->sentence(1);
    return [
    	'name' => $name,
    	'slug' => Str::slug($name, '-'),
    	'shield' => 'imagen.jpg',
        'tournament_id' => $faker->randomElement(['1'])
    ];
});

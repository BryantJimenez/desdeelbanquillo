<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    $name=$faker->unique()->firstNameMale." ".$faker->lastName;
    return [
    	'name' => $name,
    	'slug' => Str::slug($name, '-'),
    	'photo' => 'usuario.png',
    	'number' => $faker->unique()->numberBetween($min=1, $max=99),
    	'position_id' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']),
        'team_id' => $faker->randomElement(['1', '2', '3', '4'])
    ];
});

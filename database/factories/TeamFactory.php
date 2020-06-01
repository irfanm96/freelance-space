<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'leader_id' => $faker->randomElement([1,2]),
        'owner_id' => $faker->randomElement([1]),
    ];
});

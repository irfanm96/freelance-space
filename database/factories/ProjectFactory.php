<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->sentence(),
        'type' => ['web','mobile'],
        'rate' => $faker->randomDigit(3),
        'team_id' => $faker->randomElement([1,2,3])
    ];
});

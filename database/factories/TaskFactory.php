<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'type' => $faker->randomElement(['sprint_backlog', 'in_progress', 'in_staging', 'in_production']),
        'hours' => $faker->randomDigit,
        'project_id' => 1
    ];
});

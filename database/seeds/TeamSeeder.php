<?php

use App\Project;
use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Team::class, 10)->create()->each(function ($q) {
            $q->users()->attach(User::inRandomOrder()->limit(3)->get());
            $q->projects()->saveMany(factory(Project::class, 1)->make());
        });
    }
}

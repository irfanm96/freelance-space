<?php

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
        factory(Team::class,10)->create()->each(function ($q){
            $q->users()->saveMany(factory(User::class, 3)->make());
        });
    }
}

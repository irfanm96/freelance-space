<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mohamed Irfan',
            'email' => 'irfanmm96@gmail.com',
            'password' => bcrypt('secret')
        ])->assignRole('super-admin');

        User::create([
            'name' => 'Mohamed Fawzan',
            'email' => 'fawzanm@gmail.com',
            'password' => bcrypt('secret')
        ])->assignRole('super-admin');
        $roles = ['team-lead', 'project-owner', 'user'];
        factory(User::class, 50)->create()->each(function ($user) use ($roles) {
            $role = $roles[array_rand($roles)];
            $user->assignRole($role);
        });
    }
}

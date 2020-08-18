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
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('super-admin');

        User::create([
            'name' => 'Mohamed Fawzan',
            'email' => 'fawzanm@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->assignRole('super-admin');
        $roles = ['team-lead', 'project-owner', 'user'];
        factory(User::class, 50)->create()->each(function ($user) use ($roles) {
            $role = $roles[array_rand($roles)];
            $user->assignRole($role);
        });
    }
}

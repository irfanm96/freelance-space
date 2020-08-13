<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function testSeeLoginPage()
    {
        $this->get('/admin/login')
            ->assertSee('Login')
            ->assertSee('Email Address')
            ->assertSee('Password');
    }

    /**
    * @test
    */
    public function userShouldGetRedirectedToAdminLogin()
    {
        $this->get('/login')
             ->assertRedirect('/admin/login')
             ->assertStatus(302);
    }

    /**
    * @test
    */
    public function loginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('MyPass')
        ]);
        $this->call('POST', '/login', [
            'email' => $user->email,
            'password' => 'MyPass',
            '_token' => csrf_token()
        ])->assertRedirect('/home')
        ->assertSessionHasNoErrors();
    }

    /**
        * @test
        */
    public function loginWithWrongEmail()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('MyPass')
        ]);
        $this->call('POST', '/login', [
            'email' => 'irfan@abc.com',
            'password' => 'MyPass',
            '_token' => csrf_token()
        ])->assertSessionHasErrors(['email'])
        ->assertRedirect();
    }

    /**
          * @test
          */
    public function loginWithWrongPassword()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('MyPass')
        ]);
        $this->call('POST', '/login', [
            'email' => $user->email,
            'password' => 'wrong pass',
            '_token' => csrf_token()
        ])->assertSessionHasErrors(['email'])
        ->assertRedirect();
    }
}

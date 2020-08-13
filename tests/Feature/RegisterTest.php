<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function testSeeRegisterPage()
    {
        $this->get('/register')
            ->assertSee('Register')
            ->assertSee('Name')
            ->assertSee('E-Mail Address')
            ->assertSee('Password')
            ->assertSee('Confirm Password');
    }

    /**
    * @test
    */
    public function registerWithCorrectCredentials()
    {
        $user = factory(User::class)->make([
            'password' => Hash::make('MyPass123')
        ]);
        $this->call('POST', '/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'MyPass123',
            'password_confirmation' => 'MyPass123',
            '_token' => csrf_token()
        ])
        ->assertSessionHasNoErrors();

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    /**
      * @test
      */
    public function cannotRegisterWithExitingEmail()
    {
        $user = factory(User::class)->create([
            'password' => Hash::make('MyPass123')
        ]);
        $this->call('POST', '/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'MyPass123',
            'password_confirmation' => 'MyPass123',
            '_token' => csrf_token()
        ])
        ->assertSessionHasErrors(['email']);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    /**
       * @test
       */
    public function cannotRegisterWithAnEmptyName()
    {
        $user = factory(User::class)->make([
            'password' => Hash::make('MyPass123')
        ]);
        $this->call('POST', '/register', [
            'name' => '',
            '_token' => csrf_token()
        ])
        ->assertSessionHasErrors(['name']);

        $this->assertDatabaseMissing('users', [
            'name' => $user->name,
        ]);
    }

    /**
         * @test
         */
    public function cannotRegisterWithWeekPassword()
    {
        $user = factory(User::class)->make([
            'password' => Hash::make('MyPass123')
        ]);
        $this->call('POST', '/register', [
            'name' => $user->name,
            'password' => '12121',
            '_token' => csrf_token()
        ])
        ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }

    /**
           * @test
           */
    public function cannotRegisterWithWrongPasswordConfirmation()
    {
        $user = factory(User::class)->make([
            'password' => Hash::make('MyPass123')
        ]);
        $this->call('POST', '/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'MyPass123',
            'password_confirmation' => 'MyPass12312',
            '_token' => csrf_token()
        ])
        ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'email' => $user->email,
        ]);
    }
}

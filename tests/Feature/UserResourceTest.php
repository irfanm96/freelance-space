<?php

namespace Tests\Feature;

use App\User;
use Tests\NovaTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserResourceTest extends NovaTestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        $this->user->assignRole('super-admin');
    }

    /** @test **/
    public function user_can_be_retrieved_with_correct_resource_elements()
    {
        $response = $this->get('/nova-api/users/1');

        $response->assertJson([
            'resource' => [
                'id' => [
                    'value' => $this->user->id,
                ]
            ],
        ]);
    }

    /** @test **/
    public function users_can_be_retrieved_with_latest_first()
    {
        $user2 = factory(User::class)->create();

        $response = $this->get('/nova-api/users');

        $response->assertJson([
            'label' => 'Users',
            'resources' => [
                [
                    'id' => [
                        'value' => $user2->id,
                    ],
                ],
                [
                    'id' => [
                        'value' => $this->user->id,
                    ],
                ],
            ],
        ]);
    }

    /** @test **/
    public function user_has_correct_validation_on_create()
    {
        $user = factory(User::class)->make();

        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertCreated();
    }

    /** @test **/
    public function name_is_required_on_create()
    {
        $this->post('/nova-api/users/', ['name' => null])
              ->assertRedirect()
             ->assertSessionHasErrors([
                 'name' => 'The name field is required.',
             ]);
    }

    /** @test **/
    public function name_must_be_under_255_chars_on_create()
    {
        $user = factory(User::class)->make([
            'name' => str_repeat('J', 256),
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'name' => 'The name may not be greater than 255 characters.',
        ]);
    }

    /** @test **/
    public function email_is_required_on_create()
    {
        $user = factory(User::class)->make([
            'email' => null,
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'email' => 'The email field is required.',
        ]);
    }

    /** @test **/
    public function email_must_be_under_254_chars_on_create()
    {
        $user = factory(User::class)->make([
            'email' => str_repeat('J', 255),
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'email' => 'The email may not be greater than 254 characters.',
        ]);
    }

    /** @test **/
    public function email_must_be_valid_on_create()
    {
        $user = factory(User::class)->make([
            'email' => 'johndoe',
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.',
        ]);
    }

    /** @test **/
    public function email_must_be_unique_on_create()
    {
        $user = factory(User::class)->create();
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'email' => 'The email has already been taken.',
        ]);
    }

    /** @test **/
    public function password_is_required_on_create()
    {
        $user = factory(User::class)->make([
            'password' => null,
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'password' => 'The password field is required.',
        ]);
    }

    /** @test **/
    public function password_must_be_string_on_create()
    {
        $user = factory(User::class)->make([
            'password' => 123,
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'password' => 'The password must be a string.',
        ]);
    }

    /** @test **/
    public function password_must_be_8_chars_on_create()
    {
        $user = factory(User::class)->make([
            'password' => 12345,
        ]);
        $this->post('/nova-api/users/', $user->getAttributes())
        ->assertRedirect()
        ->assertSessionHasErrors([
            'password' => 'The password must be at least 8 characters.',
        ]);
    }

    /** @test **/
    public function email_must_be_unique_except_for_self_on_update()
    {
        $this->user->assignRole('super-admin');

        $user = factory(User::class)->make([
            'email' => $this->user->email,
        ]);
        $response = $this->put(
            '/nova-api/users/' . $this->user->id,
            $user->toArray()
        );
        $response->assertStatus(200);
    }

    /** @test **/
    public function email_must_be_unique_on_update()
    {
        $user2 = factory(User::class)->create();
        $user = factory(User::class)->make([
            'email' => $user2->email,
        ]);
        $this->put(
            '/nova-api/users/' . $this->user->id,
            $user->toArray()
        )->assertRedirect()->assertSessionHasErrors([
            'email' => 'The email has already been taken.',
        ]);
    }

    /** @test **/
    public function password_can_be_nullable_on_update()
    {
        $user = factory(User::class)->make([
            'password' => null,
        ]);
        $response = $this->put(
            '/nova-api/users/' . $this->user->id,
            $user->getAttributes()
        );
        $response->assertStatus(200);
    }

    /** @test **/
    public function password_must_be_string_on_update()
    {
        $user = factory(User::class)->make([
            'password' => 123,
        ]);
        $this->put(
            '/nova-api/users/' . $this->user->id,
            $user->getAttributes()
        )->assertRedirect()
        ->assertSessionHasErrors([
            'password' => 'The password must be a string.',
        ]);
    }

    /** @test **/
    public function password_must_be_8_chars_on_update()
    {
        $user = factory(User::class)->make([
            'password' => 12345,
        ]);
        $this->put(
            '/nova-api/users/' . $this->user->id,
            $user->getAttributes()
        )->assertRedirect()
        ->assertSessionHasErrors([
            'password' => 'The password must be at least 8 characters.',
        ]);
    }
}

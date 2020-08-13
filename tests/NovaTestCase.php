<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class NovaTestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $user;

    public function setUp() :void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        app()['cache']->forget('spatie.permission.cache');

        // create roles and assign existing permissions
        $this->seed('RoleSeeder');

        $this->user = factory(\App\User::class)->create();
        $this->actingAs($this->user);
    }
}

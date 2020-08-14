<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use RefreshDatabase;

    /**
    * @test
    */
    public function testSeeLoginPage()
    {
        $this->browse(function ($browser) {
            $browser->visit('/admin/login')
                    ->assertSee('Login')
                    ->assertSee('Email')
                    ->assertSee('Password');
        });
    }
}

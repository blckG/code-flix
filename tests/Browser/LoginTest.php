<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        //LoginPage Failed
        $this->browse(function (Browser $browser) {
            $browser->visit('admin/login')
            ->type('email', 'admin1@user.com')
            ->type('password', '123456789')
            ->press('LoginPage')
            ->assertSee('LoginPage');
        });

        //LoginPage Success
        $this->browse(function (Browser $browser) {
            $browser->visit('admin/login')
            ->type('email', 'admin@user.com')
            ->type('password', '123456')
            ->press('LoginPage')
            ->assertPathIs('/admin/dashboard');
        });
    }
}

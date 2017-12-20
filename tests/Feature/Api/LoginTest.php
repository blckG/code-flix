<?php

namespace Tests\Feature\Api;

use Dingo\Api\Routing\UrlGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessToken()
    {
        $urlGenerator = app(UrlGenerator::class)->version('v1');

        $this->post($urlGenerator->route('api.access_token'), [
            'email' => 'admin@user.com',
            'password' => '123456'
        ])
        ->assertStatus(200)
        ->assertJsonStructure(['token']);
    }
}

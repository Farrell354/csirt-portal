<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('auth|127.0.0.1');
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $unique = strtolower(Str::random(8));
        $response = $this->post('/register', [
            'name'                  => 'New Hunter',
            'username'              => 'hunter_' . $unique,
            'email'                 => 'hunter_' . $unique . '@example.com',
            'password'              => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }
}

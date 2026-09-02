<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('auth|127.0.0.1');
    }

    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::forceCreate([
            'name'           => 'Auth Test User',
            'username'       => 'auth_user_' . Str::random(6),
            'email'          => 'auth_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->post('/login', [
            'username' => $user->username,
            'password' => 'StrongPass123!',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('dashboard', absolute: false));
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::forceCreate([
            'name'           => 'Auth Test User',
            'username'       => 'auth_fail_' . Str::random(6),
            'email'          => 'fail_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $this->post('/login', [
            'username' => $user->username,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }

    public function test_users_can_logout(): void
    {
        $user = User::forceCreate([
            'name'           => 'Auth Test User',
            'username'       => 'logout_' . Str::random(6),
            'email'          => 'logout_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}

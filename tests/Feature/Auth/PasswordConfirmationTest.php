<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::forceCreate([
            'name'           => 'Confirm User',
            'username'       => 'confirm_' . Str::random(6),
            'email'          => 'confirm_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $user = User::forceCreate([
            'name'           => 'Confirm User',
            'username'       => 'confirm2_' . Str::random(6),
            'email'          => 'confirm2_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'StrongPass123!',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::forceCreate([
            'name'           => 'Confirm User',
            'username'       => 'confirm3_' . Str::random(6),
            'email'          => 'confirm3_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}

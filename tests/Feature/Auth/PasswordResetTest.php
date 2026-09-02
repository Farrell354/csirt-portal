<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
    use DatabaseTransactions;

    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $user = User::forceCreate([
            'name'     => 'Reset Test User',
            'username' => 'reset_usr_' . Str::random(6),
            'email'    => 'reset_' . Str::random(6) . '@example.com',
            'password' => bcrypt('StrongPass123!'),
            'role'     => 'hunter',
        ]);

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $user = User::forceCreate([
            'name'     => 'Reset Test User',
            'username' => 'reset_scr_' . Str::random(6),
            'email'    => 'screen_' . Str::random(6) . '@example.com',
            'password' => bcrypt('StrongPass123!'),
            'role'     => 'hunter',
        ]);

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/'.$notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $user = User::forceCreate([
            'name'     => 'Reset Test User',
            'username' => 'reset_tok_' . Str::random(6),
            'email'    => 'token_' . Str::random(6) . '@example.com',
            'password' => bcrypt('OldPass123!'),
            'role'     => 'hunter',
        ]);

        $this->post('/forgot-password', ['email' => $user->email]);

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $response = $this->post('/reset-password', [
                'token'                 => $notification->token,
                'email'                 => $user->email,
                'password'              => 'NewStrongPass123!',
                'password_confirmation' => 'NewStrongPass123!',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('login'));

            return true;
        });
    }
}

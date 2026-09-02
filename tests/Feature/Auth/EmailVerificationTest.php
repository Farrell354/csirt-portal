<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_email_verification_screen_can_be_rendered(): void
    {
        $user = User::forceCreate([
            'name'              => 'Unverified User',
            'username'          => 'unver_' . Str::random(6),
            'email'             => 'unver_' . strtolower(Str::random(6)) . '@example.com',
            'password'          => bcrypt('StrongPass123!'),
            'role'              => 'hunter',
            'email_verified_at' => null,
            'remember_token'    => Str::random(10),
        ]);

        $response = $this->actingAs($user)->get('/verify-email');

        $response->assertStatus(200);
    }

    public function test_email_can_be_verified(): void
    {
        $user = User::forceCreate([
            'name'              => 'Unverified User',
            'username'          => 'verify_' . Str::random(6),
            'email'             => 'verify_' . strtolower(Str::random(6)) . '@example.com',
            'password'          => bcrypt('StrongPass123!'),
            'role'              => 'hunter',
            'email_verified_at' => null,
            'remember_token'    => Str::random(10),
        ]);

        Event::fake();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1((string) $user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        Event::assertDispatched(Verified::class);
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
        $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $user = User::forceCreate([
            'name'              => 'Unverified User',
            'username'          => 'inval_' . Str::random(6),
            'email'             => 'inval_' . strtolower(Str::random(6)) . '@example.com',
            'password'          => bcrypt('StrongPass123!'),
            'role'              => 'hunter',
            'email_verified_at' => null,
            'remember_token'    => Str::random(10),
        ]);

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1('wrong-email')]
        );

        $this->actingAs($user)->get($verificationUrl);

        $this->assertFalse($user->fresh()->hasVerifiedEmail());
    }
}

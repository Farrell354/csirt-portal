<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_profile_page_is_displayed(): void
    {
        $user = User::forceCreate([
            'name'           => 'Profile User',
            'username'       => 'prof_' . Str::random(6),
            'email'          => 'prof_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated(): void
    {
        $user = User::forceCreate([
            'name'           => 'Profile User',
            'username'       => 'prof2_' . Str::random(6),
            'email'          => 'prof2_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $unique = strtolower(Str::random(6));
        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name'  => 'Test User Updated',
                'email' => 'updated_' . $unique . '@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Test User Updated', $user->name);
        $this->assertSame('updated_' . $unique . '@example.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    public function test_email_verification_status_is_unchanged_when_the_email_address_is_unchanged(): void
    {
        $user = User::forceCreate([
            'name'              => 'Profile User',
            'username'          => 'prof3_' . Str::random(6),
            'email'             => 'prof3_' . strtolower(Str::random(6)) . '@example.com',
            'password'          => bcrypt('StrongPass123!'),
            'role'              => 'hunter',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
        ]);

        $response = $this
            ->actingAs($user)
            ->patch('/profile', [
                'name'  => 'Test User Updated',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    public function test_user_can_delete_their_account(): void
    {
        $user = User::forceCreate([
            'name'           => 'Delete User',
            'username'       => 'del_' . Str::random(6),
            'email'          => 'del_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'StrongPass123!',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_correct_password_must_be_provided_to_delete_account(): void
    {
        $user = User::forceCreate([
            'name'           => 'Delete User',
            'username'       => 'del2_' . Str::random(6),
            'email'          => 'del2_' . strtolower(Str::random(6)) . '@example.com',
            'password'       => bcrypt('StrongPass123!'),
            'role'           => 'hunter',
            'remember_token' => Str::random(10),
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('userDeletion', 'password')
            ->assertRedirect('/profile');

        $this->assertNotNull($user->fresh());
    }
}

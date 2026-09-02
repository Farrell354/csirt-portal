<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use DatabaseTransactions;

    public function test_password_can_be_updated(): void
    {
        $user = User::forceCreate([
            'name'     => 'Update Pass User',
            'username' => 'pass_upd_' . Str::random(6),
            'email'    => 'upd_' . Str::random(6) . '@example.com',
            'password' => bcrypt('CurrentPass123!'),
            'role'     => 'hunter',
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'CurrentPass123!',
                'password'              => 'NewStrongPass123!',
                'password_confirmation' => 'NewStrongPass123!',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertTrue(Hash::check('NewStrongPass123!', $user->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::forceCreate([
            'name'     => 'Update Pass User',
            'username' => 'pass_err_' . Str::random(6),
            'email'    => 'err_' . Str::random(6) . '@example.com',
            'password' => bcrypt('CurrentPass123!'),
            'role'     => 'hunter',
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->put('/password', [
                'current_password'      => 'wrong-password',
                'password'              => 'NewStrongPass123!',
                'password_confirmation' => 'NewStrongPass123!',
            ]);

        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/profile');
    }
}

<?php

namespace App\Http\Controllers;

use App\Rules\UniqueEncryptedEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            // Email terenkripsi: cek unik via blind index, abaikan user sendiri
            'email' => ['required', 'string', 'email', 'max:255', new UniqueEncryptedEmail($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];

        // Ganti password selalu wajib verifikasi sandi lama
        if ($request->filled('password')) {
            $rules['current_password'] = ['required', 'current_password'];
        }

        $validated = $request->validate($rules);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('sukses', 'Profil berhasil diperbarui!');
    }
}

<?php

namespace App\Auth;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;

class EncryptedEmailUserProvider extends EloquentUserProvider
{
    /**
     * Terjemahkan lookup "email" menjadi lookup "email_hash"
     * agar password reset & auth berbasis email tetap bekerja
     * meskipun email disimpan terenkripsi.
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (array_key_exists('email', $credentials)) {
            if ($credentials['email'] === null || $credentials['email'] === '') {
                return;
            }

            $credentials['email_hash'] = User::hashEmail($credentials['email']);
            unset($credentials['email']);
        }

        return parent::retrieveByCredentials($credentials);
    }
}

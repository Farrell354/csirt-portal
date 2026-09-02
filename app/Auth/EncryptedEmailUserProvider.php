<?php

namespace App\Auth;

use App\Models\User;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class EncryptedEmailUserProvider extends EloquentUserProvider
{
    /**
     * Terjemahkan lookup "email" menjadi lookup "email_hash"
     * agar password reset & auth berbasis email tetap bekerja
     * meskipun email disimpan terenkripsi.
     *
     * @param  array<string, mixed>  $credentials
     */
    public function retrieveByCredentials(array $credentials): (Authenticatable&\Illuminate\Database\Eloquent\Model)|null
    {
        if (array_key_exists('email', $credentials)) {
            if ($credentials['email'] === null || $credentials['email'] === '') {
                return null;
            }

            $credentials['email_hash'] = User::hashEmail($credentials['email']);
            unset($credentials['email']);
        }

        /** @var (Authenticatable&\Illuminate\Database\Eloquent\Model)|null */
        return parent::retrieveByCredentials($credentials);
    }
}

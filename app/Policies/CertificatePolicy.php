<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\User;

/**
 * CertificatePolicy — Defense in Depth: Authorization Layer
 *
 * Controls access to Certificate of Appreciation entities.
 * Enforces strict ownership checks to prevent IDOR vulnerabilities.
 */
class CertificatePolicy
{
    /**
     * Pre-check: Admins have full privileges across all certificates.
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view the certificate.
     */
    public function view(User $user, Certificate $certificate): bool
    {
        return $user->id === $certificate->user_id;
    }

    /**
     * Determine whether the user can download the certificate PDF.
     */
    public function download(User $user, Certificate $certificate): bool
    {
        return $user->id === $certificate->user_id;
    }

    /**
     * Determine whether the user can issue/create certificates.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }
}

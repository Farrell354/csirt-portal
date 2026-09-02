<?php

namespace App\Policies;

use App\Models\Laporan;
use App\Models\User;

/**
 * LaporanPolicy — Defense in Depth: Authorization Layer
 *
 * Enforces strict, model-level access control on every Laporan action.
 * This is the single authoritative source of truth for "who can do what"
 * on a Laporan — no inline role checks are permitted elsewhere.
 *
 * Role matrix:
 * ┌──────────────────┬───────┬─────────────┐
 * │ Ability          │ Admin │ Hunter      │
 * ├──────────────────┼───────┼─────────────┤
 * │ viewAny          │  ✅   │ ❌          │
 * │ view             │  ✅   │ own only ✅  │
 * │ create           │  ❌   │ ✅          │
 * │ update (validasi)│  ✅   │ ❌          │
 * │ delete           │  ✅   │ ❌          │
 * │ downloadPoc      │  ✅   │ own only ✅  │
 * └──────────────────┴───────┴─────────────┘
 *
 * The `before()` hook grants admins blanket access so individual methods
 * only need to encode hunter-specific rules — removing repetition and
 * preventing accidental admin lockout if a new policy method is added.
 */
class LaporanPolicy
{
    /**
     * Pre-check: admin bypasses all individual policy checks.
     * Returning null defers to the specific policy method for non-admins.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->role === 'admin') {
            return true;
        }

        return null; // Defer to specific method
    }

    /**
     * Allow listing all laporans. Admin-only (handled by before()).
     * Hunters must never see another hunter's reports in a list.
     */
    public function viewAny(User $user): bool
    {
        return false; // Non-admins: always deny (before() handles admin)
    }

    /**
     * Allow viewing a single laporan.
     * Hunter may only view their own report.
     */
    public function view(User $user, Laporan $laporan): bool
    {
        return $user->id === $laporan->user_id;
    }

    /**
     * Allow creating a new laporan.
     * Only hunters submit vulnerability reports.
     */
    public function create(User $user): bool
    {
        return $user->role === 'hunter';
    }

    /**
     * Allow updating (validating/scoring) a laporan.
     * Admin-only — handled exclusively by before().
     */
    public function update(User $user, Laporan $laporan): bool
    {
        return false;
    }

    /**
     * Allow deleting a laporan.
     * Admin-only — handled exclusively by before().
     */
    public function delete(User $user, Laporan $laporan): bool
    {
        return false;
    }

    /**
     * Allow downloading the PoC file attached to a laporan.
     *
     * This is a custom policy ability (not a standard CRUD verb).
     * Hunter may only download PoC they uploaded themselves.
     *
     * Security note: even if a hunter guesses the UUID from another
     * hunter's report, this gate will reject the request before
     * FileUploadService::download() is called.
     */
    public function downloadPoc(User $user, Laporan $laporan): bool
    {
        return $user->id === $laporan->user_id;
    }
}

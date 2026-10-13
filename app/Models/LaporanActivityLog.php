<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

/**
 * LaporanActivityLog — NIST SP 800-61 Compliant Audit Trail
 *
 * Immutable append-only record of every security-relevant event on a Laporan.
 * Never update or delete rows from this table programmatically.
 *
 * Action vocabulary (controlled, never arbitrary strings):
 *   REPORT_SUBMITTED    — hunter submitted a new vulnerability report
 *   STATUS_UPDATED      — admin changed report status (Menunggu/Valid/Ditolak)
 *   CVSS_ASSIGNED       — admin computed and saved a CVSS v3.1 score
 *   POC_DOWNLOADED      — authorised party streamed the PoC file
 *   POC_SCANNED         — PocScannerService ran heuristic check on the file
 *   QUARANTINE_OVERRIDDEN — admin overrode quarantine decision to clean
 *   DISPOSITION_SENT    — admin forwarded the report to an OPD with embargo date
 *   CERTIFICATE_ISSUED  — admin issued a Certificate of Appreciation for validated report
 *
 * @property string       $id
 * @property string       $laporan_id
 * @property int|null     $causer_id
 * @property string       $action
 * @property array<string, mixed>|null  $details
 * @property string|null  $ip_address
 * @property string|null  $user_agent
 * @property \Carbon\Carbon $created_at
 */
class LaporanActivityLog extends Model
{
    use HasUuids;

    public $incrementing  = false;
    protected $keyType    = 'string';

    // Immutable — no updated_at column
    public $timestamps    = false;

    protected $fillable = [
        'laporan_id',
        'causer_id',
        'action',
        'details',
        'ip_address',
        'user_agent',
    ];

    /**
     * External-facing actions safe for the reporting hunter to see.
     */
    public const EXTERNAL_ACTIONS = [
        'REPORT_SUBMITTED',
        'STATUS_UPDATED',
        'CVSS_ASSIGNED',
        'CERTIFICATE_ISSUED',
    ];

    /**
     * Internal actions restricted strictly to CSIRT analysts.
     * Must never be exposed to hunters.
     */
    public const INTERNAL_ACTIONS = [
        'POC_SCANNED',
        'QUARANTINE_OVERRIDDEN',
        'DISPOSITION_SENT',
    ];

    /**
     * Scope a query to only include external-facing logs visible to the hunter.
     * Excludes sensitive internal CSIRT operations (e.g. DISPOSITION_SENT, OPD routing, internal notes).
     *
     * @param  Builder<static>  $query
     * @return Builder<static>
     */
    public function scopeForHunter(Builder $query): Builder
    {
        return $query->whereIn('action', self::EXTERNAL_ACTIONS);
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'         => 'string',
            'details'    => 'array',
            'created_at' => 'datetime',
        ];
    }

    // ── Relationships ─────────────────────────────────────────────────────────

    /**
     * @return BelongsTo<Laporan, $this>
     */
    public function laporan(): BelongsTo
    {
        return $this->belongsTo(Laporan::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function causer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'causer_id');
    }

    // ── Static factory helper ─────────────────────────────────────────────────

    /**
     * Record an immutable audit log entry.
     *
     * Centralising log creation here ensures all callers use the same
     * schema and makes it easy to add async queue dispatch in the future.
     *
     * @param  Laporan        $laporan
     * @param  User|null      $causer   The authenticated user, or null for system events
     * @param  string         $action   One of the controlled vocabulary constants above
     * @param  array<string, mixed>  $details  Before/after state, metadata, filenames
     * @param  Request|null   $request  HTTP request context for IP/UA forensics
     */
    public static function record(
        Laporan $laporan,
        ?User $causer,
        string $action,
        array $details = [],
        ?Request $request = null,
    ): self {
        return self::create([
            'laporan_id' => $laporan->id,
            'causer_id'  => $causer?->id,
            'action'     => $action,
            'details'    => $details,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);
    }
}

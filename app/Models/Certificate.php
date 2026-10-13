<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Certificate — Certificate of Appreciation for Verified Vulnerability Reports
 *
 * Primary key is UUID v4 to prevent enumeration and provide a secure public verification identifier.
 *
 * @property string $id
 * @property string $report_id
 * @property int $user_id
 * @property string $certificate_number
 * @property \Carbon\Carbon $issued_at
 * @property float|null $cvss_score
 * @property string $severity
 * @property string|null $pdf_path
 * @property string $verification_hash
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Laporan $report
 * @property-read \App\Models\Laporan $laporan
 */
class Certificate extends Model
{
    /** @use HasFactory<\Illuminate\Database\Eloquent\Factories\Factory<static>> */
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'report_id',
        'user_id',
        'certificate_number',
        'issued_at',
        'cvss_score',
        'severity',
        'pdf_path',
        'verification_hash',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'                => 'string',
            'user_id'           => 'integer',
            'issued_at'         => 'datetime',
            'cvss_score'        => 'float',
            'verification_hash' => 'string',
        ];
    }

    /**
     * Relasi ke Hunter penerima sertifikat.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Laporan / Tiket yang divalidasi.
     *
     * @return BelongsTo<Laporan, $this>
     */
    public function report(): BelongsTo
    {
        return $this->belongsTo(Laporan::class, 'report_id');
    }

    /**
     * Alias relasi laporan untuk kompatibilitas nama lokal.
     *
     * @return BelongsTo<Laporan, $this>
     */
    public function laporan(): BelongsTo
    {
        return $this->report();
    }
}

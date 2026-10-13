<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Laporan — Vulnerability Report Model
 *
 * Defense in Depth — Authorization Layer:
 *   HasUuids: primary key is UUID v4, not a sequential integer.
 *   This removes the enumerable ID surface that enables IDOR attacks.
 *
 * @property string $id
 * @property int $user_id
 * @property string $target_url
 * @property string $jenis_kerentanan
 * @property string|null $severity
 * @property float|null $cvss_score
 * @property string|null $cvss_vector
 * @property string $deskripsi
 * @property string $bukti_poc
 * @property string|null $poc_hash
 * @property bool $is_exif_stripped
 * @property string $scan_status
 * @property string $status
 * @property int $poin_diberikan
 * @property bool $is_anonymous
 * @property string|null $pseudonym
 * @property-read \App\Models\Certificate|null $certificate
 */
class Laporan extends Model
{
    /** @use HasFactory<\Illuminate\Database\Eloquent\Factories\Factory<static>> */
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'target_url',
        'jenis_kerentanan',
        'severity',
        'cvss_score',
        'cvss_vector',
        'deskripsi',
        'bukti_poc',
        'poc_hash',
        'is_exif_stripped',
        'scan_status',
        'status',
        'poin_diberikan',
        'is_anonymous',
        'pseudonym',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'              => 'string',
            'poin_diberikan'  => 'integer',
            'cvss_score'      => 'float',
            'is_anonymous'    => 'boolean',
            'is_exif_stripped'=> 'boolean',
            'poc_hash'        => 'string',
        ];
    }

    /**
     * Defensive Accessor for poc_hash to guard against MissingAttributeException
     * if older records or unmigrated databases are accessed.
     */
    public function getPocHashAttribute(): ?string
    {
        return isset($this->attributes['poc_hash']) ? (string) $this->attributes['poc_hash'] : null;
    }

    /**
     * Defensive Accessor for is_exif_stripped to guard against MissingAttributeException.
     */
    public function getIsExifStrippedAttribute(): bool
    {
        return (bool) ($this->attributes['is_exif_stripped'] ?? false);
    }

    /**
     * Defensive Accessor for scan_status to guard against MissingAttributeException.
     */
    public function getScanStatusAttribute(): string
    {
        return (string) ($this->attributes['scan_status'] ?? 'clean');
    }

    /**
     * Defensive Accessor for is_anonymous to guard against MissingAttributeException.
     */
    public function getIsAnonymousAttribute(): bool
    {
        return (bool) ($this->attributes['is_anonymous'] ?? false);
    }

    /**
     * Defensive Accessor for pseudonym to guard against MissingAttributeException.
     */
    public function getPseudonymAttribute(): ?string
    {
        return isset($this->attributes['pseudonym']) ? (string) $this->attributes['pseudonym'] : null;
    }

    /**
     * Defensive Accessor for cvss_score to guard against MissingAttributeException.
     */
    public function getCvssScoreAttribute(): ?float
    {
        return isset($this->attributes['cvss_score'])
            ? (float) $this->attributes['cvss_score']
            : null;
    }

    /**
     * Defensive Accessor for cvss_vector to guard against MissingAttributeException.
     */
    public function getCvssVectorAttribute(): ?string
    {
        return isset($this->attributes['cvss_vector']) ? (string) $this->attributes['cvss_vector'] : null;
    }

    /**
     * Defensive Accessor for severity to guard against MissingAttributeException.
     */
    public function getSeverityAttribute(): string
    {
        return (string) ($this->attributes['severity'] ?? 'Medium');
    }

    /**
     * Relasi: Laporan ini milik satu User (Hunter).
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Laporan ini memiliki satu Sertifikat Penghargaan (jika telah divalidasi dan diterbitkan).
     *
     * @return HasOne<Certificate, $this>
     */
    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class, 'report_id');
    }

    /**
     * Defensive Accessor for certificate relationship.
     * Prevents fatal QueryException if certificates table has not yet been migrated.
     */
    public function getCertificateAttribute(): ?Certificate
    {
        try {
            /** @var Certificate|null */
            return $this->getRelationValue('certificate');
        } catch (\Throwable) {
            return null;
        }
    }

    /**
     * Relasi: Laporan ini memiliki banyak log aktivitas (audit trail).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<LaporanActivityLog, $this>
     */
    public function activityLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LaporanActivityLog::class);
    }

    /**
     * Relasi: log aktivitas eksternal yang aman dilihat oleh pelapor (hunter).
     * Mengecualikan tindakan internal CSIRT seperti DISPOSITION_SENT dan detail sensitif.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<LaporanActivityLog, $this>
     */
    public function externalActivityLogs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->activityLogs()->whereIn('action', LaporanActivityLog::EXTERNAL_ACTIONS);
    }

    /**
     * Dapatkan detail analisis forensik PoC untuk dashboard admin.
     *
     * @return array<string, mixed>
     */
    public function getForensics(): array
    {
        return app(\App\Services\PocScannerService::class)->getForensics($this);
    }
}

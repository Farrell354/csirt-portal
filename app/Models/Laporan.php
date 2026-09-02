<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
 * @property string $deskripsi
 * @property string $bukti_poc
 * @property string $status
 * @property int $poin_diberikan
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
        'deskripsi',
        'bukti_poc',
        'status',
        'poin_diberikan',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id'             => 'string',
            'poin_diberikan' => 'integer',
        ];
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
}

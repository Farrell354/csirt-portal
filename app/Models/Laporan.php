<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi mass-assignment.
     * 'user_id' sengaja dikecualikan — kepemilikan laporan
     * hanya boleh diset lewat relasi $user->laporans()->create().
     */
    protected $fillable = [
        'target_url',
        'jenis_kerentanan',
        'severity',
        'deskripsi',
        'bukti_poc',
        'status',
        'poin_diberikan',
    ];

    // Relasi: Laporan ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

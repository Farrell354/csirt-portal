<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Membuka semua gembok kolom agar bisa diisi
    protected $guarded = [];

    // Relasi: Laporan ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

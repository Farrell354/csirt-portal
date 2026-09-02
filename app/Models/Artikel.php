<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    /** @use HasFactory<\Illuminate\Database\Eloquent\Factories\Factory<static>> */
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori',
        'gambar',
        'penulis',
        'konten',
        'tanggal_publikasi',
    ];
}

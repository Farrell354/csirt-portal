<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori'); // Misalnya: Peringatan Keamanan, Berita Siber
            $table->string('penulis')->default('Tim JatimProv-CSIRT');
            $table->string('gambar'); // Untuk menyimpan nama file atau URL gambar
            $table->text('konten'); // Isi lengkap artikel
            $table->date('tanggal_publikasi');
            $table->timestamps(); // Otomatis mencatat waktu dibuat (created_at) dan diubah (updated_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};

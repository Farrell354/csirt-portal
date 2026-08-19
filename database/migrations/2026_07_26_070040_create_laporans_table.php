<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users (Siapa hunter yang melapor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Detail Laporan
            $table->string('target_url');
            $table->string('jenis_kerentanan'); // Contoh: SQLi, XSS, dll
            $table->text('deskripsi');
            $table->string('bukti_poc'); // Link gambar atau dokumen

            // Status Validasi Admin
            $table->enum('status', ['Menunggu', 'Valid', 'Ditolak'])->default('Menunggu');
            $table->integer('poin_diberikan')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};

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
        Schema::create('certificates', function (Blueprint $table) {
            // UUID Primary Key
            $table->uuid('id')->primary();

            // Report and Hunter relations
            $table->char('report_id', 36)->unique();
            $table->foreign('report_id')->references('id')->on('laporans')->onDelete('cascade');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Certificate Metadata
            $table->string('certificate_number')->unique();
            $table->timestamp('issued_at');
            $table->decimal('cvss_score', 3, 1)->nullable();
            $table->string('severity', 32);

            // Storage and Verification Integrity
            $table->string('pdf_path')->nullable();
            $table->char('verification_hash', 64); // SHA-256

            $table->timestamps();

            // Indexes for fast lookup
            $table->index('user_id');
            $table->index('certificate_number');
            $table->index('verification_hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};

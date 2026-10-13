<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Enhancement 2 — Secure Audit Trail (NIST SP 800-61)
 *
 * Creates `laporan_activity_logs`: an append-only, tamper-evident log of
 * every security-relevant event on a Laporan.
 *
 * Design:
 *   - UUID PK (IDOR-resistant, consistent with laporans table).
 *   - `updated_at` omitted — logs are immutable records.
 *   - `causer_id` nullable to support system-generated events.
 *   - `details` JSON captures before/after state for forensic analysis.
 *   - Cascade delete on laporan_id (UU PDP data minimisation).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_activity_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->char('laporan_id', 36);
            $table->foreign('laporan_id')
                  ->references('id')
                  ->on('laporans')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('causer_id')->nullable();
            $table->foreign('causer_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');

            // Controlled vocabulary: STATUS_UPDATED, CVSS_ASSIGNED,
            // POC_DOWNLOADED, REPORT_SUBMITTED, POC_SCANNED
            $table->string('action', 60);

            $table->json('details')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            // Immutable — no updated_at
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_activity_logs');
    }
};

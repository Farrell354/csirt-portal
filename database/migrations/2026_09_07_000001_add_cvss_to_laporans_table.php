<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Enhancement 1 — CVSS v3.1 Scoring (ISO/IEC 30111)
 *
 * Adds two nullable columns to `laporans`:
 *   cvss_score  — computed CVSS v3.1 Base Score (0.0–10.0, 1 decimal)
 *   cvss_vector — canonical CVSS v3.1 vector string (stored for auditability)
 *
 * Both columns are nullable: existing reports and the hunter's
 * self-reported `severity` field remain fully intact (supplement, not replace).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->decimal('cvss_score', 3, 1)->nullable()->after('severity');
            $table->string('cvss_vector', 100)->nullable()->after('cvss_score');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['cvss_score', 'cvss_vector']);
        });
    }
};

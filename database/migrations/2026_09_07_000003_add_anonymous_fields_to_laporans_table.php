<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Enhancement 3 — Pseudonymous / Anonymous Reporting (ISO/IEC 29147 / UU PDP)
 *
 * Adds two nullable columns to `laporans`:
 *   is_anonymous — boolean flag indicating the hunter chose pseudonymous mode.
 *   pseudonym    — hunter-supplied handle (not real PII under UU PDP No.27/2022
 *                  if arbitrarily chosen by the submitter).
 *
 * When is_anonymous = true, the admin dashboard shows `pseudonym` instead of
 * the hunter's real encrypted name, applying data-minimisation principles.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->boolean('is_anonymous')->default(false)->after('poin_diberikan');
            $table->string('pseudonym', 80)->nullable()->after('is_anonymous');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn(['is_anonymous', 'pseudonym']);
        });
    }
};

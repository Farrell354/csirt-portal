<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Enhancement 4 — PoC Scan & Quarantine Pipeline
 *
 * Adds `scan_status` enum to `laporans`:
 *   'pending'     — newly uploaded, not yet scanned (default for new rows)
 *   'clean'       — passed all heuristic checks, safe to download
 *   'quarantined' — failed heuristic checks, download blocked pending review
 *
 * Migration strategy for existing rows (Q1 decision: option b — optimistic):
 *   All existing PoC files already passed the FileUploadService 3-pass
 *   validation pipeline (extension blocklist + magic-byte MIME sniff + UUID
 *   rename). Setting them to 'clean' avoids disrupting existing admin workflow.
 *   New uploads will start at 'pending' and be scanned immediately by
 *   PocScannerService before the request response is returned.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->enum('scan_status', ['pending', 'clean', 'quarantined'])
                  ->default('pending')
                  ->after('bukti_poc');
        });

        // Set all existing rows to 'clean' — they already passed FileUploadService
        // 3-pass validation and were stored before this pipeline was introduced.
        DB::table('laporans')->update(['scan_status' => 'clean']);
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('scan_status');
        });
    }
};

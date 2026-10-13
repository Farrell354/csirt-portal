<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add PoC integrity hash and EXIF-stripping provenance columns to `laporans`.
 *
 * poc_hash        — SHA-256 fingerprint of the final stored file binary.
 *                   Enables NIST SP 800-61 chain-of-custody verification.
 *                   Indexed for fast forensic lookup by hash value.
 *
 * is_exif_stripped — Boolean provenance flag: true when the upload pipeline
 *                   successfully stripped EXIF/IPTC/XMP privacy metadata from
 *                   the image before storage, per UU PDP No. 27/2022.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporans', function (Blueprint $table): void {
            $table->string('poc_hash', 64)->nullable()->index()->after('bukti_poc')
                ->comment('SHA-256 fingerprint of the stored PoC file (chain-of-custody)');
            $table->boolean('is_exif_stripped')->default(false)->after('poc_hash')
                ->comment('True when EXIF/IPTC/XMP metadata was scrubbed before storage (UU PDP compliance)');
        });
    }

    public function down(): void
    {
        Schema::table('laporans', function (Blueprint $table): void {
            $table->dropColumn(['poc_hash', 'is_exif_stripped']);
        });
    }
};

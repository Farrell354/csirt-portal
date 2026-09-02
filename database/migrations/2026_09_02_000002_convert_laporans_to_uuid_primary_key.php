<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * Defense in Depth — Authorization Layer
 *
 * Converts the `laporans` primary key from an auto-increment integer to a
 * UUID v4 string. This directly mitigates IDOR (Insecure Direct Object
 * Reference) attacks by removing the enumerable integer sequence from URLs.
 *
 * Migration strategy (safe for tables with existing data):
 *   1. Add a temporary `uuid_temp` CHAR(36) column.
 *   2. Populate it via PHP to guarantee UUID v4 uniqueness per row.
 *   3. Drop the old auto-increment `id` (after removing its FK dependencies).
 *   4. Rename `uuid_temp` → `id` and declare it as the PRIMARY KEY.
 *   5. Re-attach the `user_id` foreign key.
 *
 * Caution: the original sequential integer IDs are permanently lost.
 * The down() method creates fresh auto-increment IDs (not the originals).
 */
return new class extends Migration
{
    public function up(): void
    {
        // ── Step 1: Add temporary UUID column ────────────────────────────────
        Schema::table('laporans', function (Blueprint $table) {
            $table->char('uuid_temp', 36)->nullable()->after('id');
        });

        // ── Step 2: Populate a unique UUID v4 for every existing row ─────────
        // Chunked to avoid locking the full table for large datasets.
        DB::table('laporans')->orderBy('id')->chunkById(200, function ($rows) {
            foreach ($rows as $row) {
                DB::table('laporans')
                    ->where('id', $row->id)
                    ->update(['uuid_temp' => (string) Str::uuid()]);
            }
        });

        // ── Step 3: Drop the FK constraint on user_id first ──────────────────
        // The FK must be dropped before we can drop the PK column.
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // ── Step 4: Drop the old auto-increment integer id column ─────────────
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // ── Step 5: Rename uuid_temp → id ─────────────────────────────────────
        Schema::table('laporans', function (Blueprint $table) {
            $table->renameColumn('uuid_temp', 'id');
        });

        // ── Step 6: Make NOT NULL and set as PRIMARY KEY via raw DDL ───────────
        // Blueprint cannot set PK on an already-existing column in one pass,
        // so we use raw ALTER TABLE statements instead.
        DB::statement('ALTER TABLE laporans MODIFY id CHAR(36) NOT NULL');
        DB::statement('ALTER TABLE laporans ADD PRIMARY KEY (id)');

        // ── Step 7: Re-attach the user_id foreign key ────────────────────────
        Schema::table('laporans', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // ── Reverse: restore an auto-increment integer PK ─────────────────────
        // NOTE: Original integer IDs cannot be restored. New sequential IDs
        // will be assigned to all existing rows.

        // Drop FK
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Drop UUID primary key
        DB::statement('ALTER TABLE laporans DROP PRIMARY KEY');

        // Remove the UUID id column
        Schema::table('laporans', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        // Add new auto-increment integer id
        Schema::table('laporans', function (Blueprint $table) {
            $table->id()->first();
        });

        // Re-attach FK
        Schema::table('laporans', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
};

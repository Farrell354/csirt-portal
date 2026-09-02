<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Defense in Depth — Data Layer
 *
 * Backfills the `name` column from plaintext to AES-256-CBC ciphertext
 * to match the `encrypted` cast added to the User model.
 *
 * The column type is changed from VARCHAR(255) to TEXT because
 * an AES-256-CBC ciphertext of a ~255-char string is always longer
 * than 255 bytes after base64 encoding.
 *
 * This migration is idempotent: rows whose `name` is already a valid
 * Laravel ciphertext are skipped to prevent double-encryption if the
 * migration is accidentally re-run.
 */
return new class extends Migration
{
    public function up(): void
    {
        // 1. Widen the column to TEXT to accommodate ciphertext length.
        Schema::table('users', function (Blueprint $table) {
            $table->text('name')->change();
        });

        // 2. Backfill: encrypt each plaintext name in safe chunks.
        DB::table('users')->orderBy('id')->chunkById(100, function ($users) {
            foreach ($users as $user) {
                // Skip rows that are already valid Laravel ciphertext.
                try {
                    Crypt::decryptString($user->name);
                    // Decryption succeeded → already encrypted, skip.
                    continue;
                } catch (\Throwable) {
                    // Decryption failed → still plaintext. Proceed to encrypt.
                }

                DB::table('users')->where('id', $user->id)->update([
                    'name' => Crypt::encryptString($user->name),
                ]);
            }
        });
    }

    public function down(): void
    {
        // Decrypt all names back to plaintext and restore VARCHAR(255).
        DB::table('users')->orderBy('id')->chunkById(100, function ($users) {
            foreach ($users as $user) {
                try {
                    $plaintext = Crypt::decryptString($user->name);
                } catch (\Throwable) {
                    // Already plaintext or corrupted — leave as is.
                    continue;
                }

                DB::table('users')->where('id', $user->id)->update([
                    'name' => $plaintext,
                ]);
            }
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 255)->change();
        });
    }
};

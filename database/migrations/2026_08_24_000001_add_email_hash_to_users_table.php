<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_hash')->nullable()->after('email');
            $table->unique('email_hash');
        });

        // Backfill blind index dari email yang sudah terenkripsi.
        // Data lama yang masih plaintext juga tetap didukung.
        DB::table('users')->orderBy('id')->chunkById(100, function ($users) {
            foreach ($users as $user) {
                try {
                    $email = Crypt::decryptString($user->email);
                } catch (\Throwable) {
                    $email = $user->email;
                }

                DB::table('users')->where('id', $user->id)->update([
                    'email_hash' => hash('sha256', strtolower(trim($email))),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email_hash']);
            $table->dropColumn('email_hash');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menambah pembeda antara admin dan masyarakat (hunter)
            $table->string('role')->default('hunter')->after('email');

            // Sistem Gamification (Poin & Avatar)
            $table->integer('poin')->default(0)->after('role');
            $table->string('avatar')->nullable()->after('poin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'poin', 'avatar']);
        });
    }
};

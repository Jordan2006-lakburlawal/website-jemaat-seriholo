<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('profile_settings', function (Blueprint $table) {
            // Menambahkan kolom anggota_majelis jika belum ada
            if (!Schema::hasColumn('profile_settings', 'anggota_majelis')) {
                $table->text('anggota_majelis')->nullable()->after('bendahara_jemaat');
            }
        });
    }

    /**
     * Batalkan migrasi (rollback).
     */
    public function down(): void
    {
        Schema::table('profile_settings', function (Blueprint $table) {
            $table->dropColumn('anggota_majelis');
        });
    }
};
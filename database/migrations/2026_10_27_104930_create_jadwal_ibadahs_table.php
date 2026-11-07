<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_ibadahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ibadah'); // Contoh: Ibadah Minggu, Ibadah Sektor, dll
            $table->dateTime('waktu');
            $table->string('tempat'); // Contoh: Gedung Gereja Seriholo / Sektor 1
            $table->string('pelayan_firman');
            $table->string('bacaan_firman');
            $table->string('file_liturgi')->nullable(); // Untuk menyimpan path file PDF liturgi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadahs');
    }
};
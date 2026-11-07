<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->id();
            $table->text('sejarah_jemaat')->nullable();
            $table->integer('total_jemaat')->default(0);
            $table->integer('total_sektor')->default(0);
            $table->integer('total_unit')->default(0);
            $table->string('ketua_majelis')->nullable();
            $table->string('sekretaris_majelis')->nullable();
            $table->string('bendahara_jemaat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_settings');
    }
};
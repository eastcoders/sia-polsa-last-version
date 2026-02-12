<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('program_studis')) {
            Schema::create('program_studis', function (Blueprint $table) {
                $table->uuid('id_prodi')->primary();
                $table->uuid('id_perguruan_tinggi')->index();
                $table->string('kode_program_studi');
                $table->string('nama_program_studi');
                $table->string('status')->nullable();
                $table->unsignedInteger('id_jenjang_pendidikan')->nullable();
                $table->string('nama_jenjang_pendidikan')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};

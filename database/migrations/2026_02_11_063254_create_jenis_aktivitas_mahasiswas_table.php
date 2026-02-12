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
        if (!Schema::hasTable('jenis_aktivitas_mahasiswas')) {
            Schema::create('jenis_aktivitas_mahasiswas', function (Blueprint $table) {
                $table->integer('id_jenis_aktivitas_mahasiswa')->primary();
                $table->string('nama_jenis_aktivitas_mahasiswa');
                $table->boolean('untuk_kampus_merdeka')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_aktivitas_mahasiswas');
    }
};

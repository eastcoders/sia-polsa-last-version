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
        if (!Schema::hasTable('jenis_pendaftarans')) {
            Schema::create('jenis_pendaftarans', function (Blueprint $table) {
                $table->integer('id_jenis_daftar')->primary();
                $table->string('nama_jenis_daftar');
                $table->boolean('untuk_daftar_sekolah')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pendaftarans');
    }
};

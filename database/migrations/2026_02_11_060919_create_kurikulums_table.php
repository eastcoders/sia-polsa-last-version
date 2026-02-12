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
        Schema::create('kurikulums', function (Blueprint $table) {
            $table->uuid('id_kurikulum')->primary();
            $table->string('nama_kurikulum')->nullable();
            $table->uuid('id_prodi')->nullable()->index();
            $table->string('id_semester')->nullable()->index(); // Can be int or string depending on semester table
            $table->integer('jumlah_sks_lulus')->nullable();
            $table->integer('jumlah_sks_wajib')->nullable();
            $table->integer('jumlah_sks_pilihan')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kurikulums');
    }
};

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
        if (!Schema::hasTable('status_kepegawaians')) {
            Schema::create('status_kepegawaians', function (Blueprint $table) {
                $table->integer('id_status_pegawai')->primary();
                $table->string('nama_status_pegawai');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_kepegawaians');
    }
};

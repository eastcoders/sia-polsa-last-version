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
        if (!Schema::hasTable('jenis_prestasis')) {
            Schema::create('jenis_prestasis', function (Blueprint $table) {
                $table->integer('id_jenis_prestasi')->primary();
                $table->string('nama_jenis_prestasi');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_prestasis');
    }
};

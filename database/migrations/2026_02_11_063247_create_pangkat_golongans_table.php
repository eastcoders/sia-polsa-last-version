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
        if (!Schema::hasTable('pangkat_golongans')) {
            Schema::create('pangkat_golongans', function (Blueprint $table) {
                $table->string('id_pangkat_golongan')->primary();
                $table->string('kode_golongan')->nullable();
                $table->string('nama_pangkat');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pangkat_golongans');
    }
};

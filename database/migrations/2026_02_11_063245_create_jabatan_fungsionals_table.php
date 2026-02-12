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
        if (!Schema::hasTable('jabatan_fungsionals')) {
            Schema::create('jabatan_fungsionals', function (Blueprint $table) {
                $table->string('id_jabatan_fungsional')->primary();
                $table->string('nama_jabatan_fungsional');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan_fungsionals');
    }
};

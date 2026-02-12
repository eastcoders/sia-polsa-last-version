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
        if (!Schema::hasTable('jenis_tinggals')) {
            Schema::create('jenis_tinggals', function (Blueprint $table) {
                $table->integer('id_jenis_tinggal')->primary();
                $table->string('nama_jenis_tinggal');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_tinggals');
    }
};

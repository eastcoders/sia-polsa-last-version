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
        if (!Schema::hasTable('perguruan_tinggis')) {
            Schema::create('perguruan_tinggis', function (Blueprint $table) {
                $table->uuid('id_perguruan_tinggi')->primary();
                $table->string('kode_perguruan_tinggi')->nullable();
                $table->string('nama_perguruan_tinggi');
                $table->string('nama_singkat')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perguruan_tinggis');
    }
};

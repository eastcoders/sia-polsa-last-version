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
        if (!Schema::hasTable('bentuk_pendidikans')) {
            Schema::create('bentuk_pendidikans', function (Blueprint $table) {
                $table->integer('id_bentuk_pendidikan')->primary();
                $table->string('nama_bentuk_pendidikan');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bentuk_pendidikans');
    }
};

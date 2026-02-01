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
        Schema::create('walis', function (Blueprint $table) {
            $table->id();
            $table->string('id_mahasiswa')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('id_pendidikan')->nullable();
            $table->string('id_pekerjaan')->nullable();
            $table->string('id_penghasilan')->nullable();
            $table->timestamp('sync_at')->nullable();
            $table->enum('sync_status', ['pending', 'success', 'failed'])->nullable();
            $table->text('sync_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('walis');
    }
};

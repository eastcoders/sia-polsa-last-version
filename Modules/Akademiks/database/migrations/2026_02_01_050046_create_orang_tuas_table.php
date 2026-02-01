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
        Schema::create('orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->string('id_mahasiswa')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu_kandung');
            $table->string('nik_ayah')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('id_pekerjaan_ayah')->nullable();
            $table->string('id_pekerjaan_ibu')->nullable();
            $table->string('id_pendidikan_ayah')->nullable();
            $table->string('id_pendidikan_ibu')->nullable();
            $table->string('id_penghasilan_ayah')->nullable();
            $table->string('id_penghasilan_ibu')->nullable();
            $table->string('no_telp_ayah')->nullable();
            $table->string('no_telp_ibu')->nullable();
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
        Schema::dropIfExists('orang_tuas');
    }
};

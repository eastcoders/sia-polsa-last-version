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
        Schema::create('alamats', function (Blueprint $table) {
            $table->id();
            $table->string('id_mahasiswa')->nullable();

            $table->string('kewarganegaraan');
            $table->string('id_wilayah');
            $table->string('kelurahan');
            $table->string('dusun')->nullable();
            $table->string('rt_rw')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('jalan')->nullable();
            $table->string('id_jenis_tinggal')->nullable();
            $table->string('id_alat_transportasi')->nullable();
            $table->enum('penerima_kps', ['0', '1'])->default('0');
            $table->string('no_kps')->nullable();

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
        Schema::dropIfExists('alamats');
    }
};

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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('id_mahasiswa')->nullable();
            $table->string('id_server')->nullable();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('id_agamaa');
            $table->string('email')->unique('email');
            $table->string('no_telp');
            $table->string('nik')->unique();
            $table->string('nisn')->unique();
            $table->string('npwp')->nullable()->unique();
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
        Schema::dropIfExists('mahasiswas');
    }
};

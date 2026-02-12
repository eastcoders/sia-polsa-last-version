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
        Schema::table('program_studis', function (Blueprint $table) {
            if (Schema::hasColumn('program_studis', 'kode_program_studi')) {
                $table->string('kode_program_studi')->nullable()->change();
            } else {
                $table->string('kode_program_studi')->nullable();
            }

            if (Schema::hasColumn('program_studis', 'nama_program_studi')) {
                $table->string('nama_program_studi')->nullable()->change();
            } else {
                $table->string('nama_program_studi');
            }

            if (Schema::hasColumn('program_studis', 'status')) {
                $table->string('status')->nullable()->change();
            } else {
                $table->string('status')->nullable();
            }
            
            if (Schema::hasColumn('program_studis', 'id_jenjang_pendidikan')) {
                $table->unsignedInteger('id_jenjang_pendidikan')->nullable()->change();
            } else {
                $table->unsignedInteger('id_jenjang_pendidikan')->nullable();
            }

            if (Schema::hasColumn('program_studis', 'nama_jenjang_pendidikan')) {
                $table->string('nama_jenjang_pendidikan')->nullable()->change();
            } else {
                $table->string('nama_jenjang_pendidikan')->nullable();
            }

            if (Schema::hasColumn('program_studis', 'id_perguruan_tinggi')) {
                // Ensure index exists if adding? Or just nullable.
                 $table->string('id_perguruan_tinggi')->nullable()->change();
            } else {
                 $table->uuid('id_perguruan_tinggi')->nullable()->index();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('program_studis', function (Blueprint $table) {
            //
        });
    }
};

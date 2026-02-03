<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Akademiks\Database\Factories\RiwayatPendidikanFactory;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_mahasiswa',
        'id_registrasi_mahasiswa',
        'id_server',
        'nim',
        'id_jenis_daftar',
        'id_jalur_daftar',
        'id_periode_masuk',
        'tanggal_masuk',
        'id_pembiayaan',
        'id_prodi',
        'id_perguruan_tinggi',
        'biaya_awal',
        'id_prodi_asal',
        'id_perguruan_tinggi_asal',
        'sync_at',
        'sync_status',
        'sync_message'
    ];


    protected static function newFactory()
    {
        return \Modules\Akademiks\Database\Factories\RiwayatPendidikanFactory::new();
    }
}

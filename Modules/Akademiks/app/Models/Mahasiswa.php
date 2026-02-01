<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Akademiks\Database\Factories\MahasiswaFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_mahasiswa',
        'id_server',
        'nama_lengkap',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'id_agamaa',
        'email',
        'no_telp',
        'nik',
        'nisn',
        'npwp',
        'sync_at',
        'sync_status',
        'sync_message'
    ];


    // protected static function newFactory(): MahasiswaFactory
    // {
    //     // return MahasiswaFactory::new();
    // }
}

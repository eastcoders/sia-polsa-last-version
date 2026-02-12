<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'jenis_pendaftarans';
    protected $primaryKey = 'id_jenis_daftar';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_daftar',
        'nama_jenis_daftar',
        'untuk_daftar_sekolah',
    ];
}

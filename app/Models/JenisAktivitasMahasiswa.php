<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisAktivitasMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'jenis_aktivitas_mahasiswas';
    protected $primaryKey = 'id_jenis_aktivitas_mahasiswa';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_aktivitas_mahasiswa',
        'nama_jenis_aktivitas_mahasiswa',
        'untuk_kampus_merdeka',
    ];
}

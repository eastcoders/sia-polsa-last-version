<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'id_agama',
        'email',
        'no_telp',
        'nik',
        'nisn',
        'npwp',
        'sync_at',
        'sync_status',
        'sync_message',
    ];

    protected static function newFactory()
    {
        return \Modules\Akademiks\Database\Factories\MahasiswaFactory::new();
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'id_mahasiswa', 'id');
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'id_mahasiswa', 'id');
    }

    public function wali()
    {
        return $this->hasOne(Wali::class, 'id_mahasiswa', 'id');
    }

    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'id_mahasiswa', 'id');
    }
}

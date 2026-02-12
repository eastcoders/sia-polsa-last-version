<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisKeluar extends Model
{
    use HasFactory;

    protected $table = 'jenis_keluars';
    protected $primaryKey = 'id_jenis_keluar';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_jenis_keluar',
        'jenis_keluar',
        'apa_mahasiswa',
    ];
}

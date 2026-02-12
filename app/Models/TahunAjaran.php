<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TahunAjaran extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajarans';
    protected $primaryKey = 'id_tahun_ajaran';
    public $incrementing = false;
    // protected $keyType = 'int'; // Default is int

    protected $fillable = [
        'id_tahun_ajaran',
        'nama_tahun_ajaran',
        'a_periode_aktif',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}

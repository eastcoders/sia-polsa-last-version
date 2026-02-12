<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSertifikasi extends Model
{
    use HasFactory;

    protected $table = 'jenis_sertifikasis';
    protected $primaryKey = 'id_jenis_sertifikasi';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_sertifikasi',
        'nama_jenis_sertifikasi',
    ];
}

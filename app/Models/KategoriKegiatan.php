<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriKegiatan extends Model
{
    use HasFactory;

    protected $table = 'kategori_kegiatans';
    protected $primaryKey = 'id_kategori_kegiatan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kategori_kegiatan',
        'nama_kategori_kegiatan',
    ];
}

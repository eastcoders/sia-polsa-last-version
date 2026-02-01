<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Akademiks\Database\Factories\AlamatFactory;

class Alamat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_mahasiswa',
        'kewarganegaraan',
        'id_wilayah',
        'kelurahan',
        'dusun',
        'rt_rw',
        'kode_pos',
        'jalan',
        'id_jenis_tinggal',
        'id_alat_transportasi',
        'penerima_kps',
        'no_kps',
        'sync_at',
        'sync_status',
        'sync_message'
    ];


    // protected static function newFactory(): AlamatFactory
    // {
    //     // return AlamatFactory::new();
    // }
}

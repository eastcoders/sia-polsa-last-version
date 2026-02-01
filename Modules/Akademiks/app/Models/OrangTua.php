<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Akademiks\Database\Factories\OrangTuaFactory;

class OrangTua extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_mahasiswa',
        'nama_ayah',
        'nama_ibu_kandung',
        'nik_ayah',
        'nik_ibu',
        'tanggal_lahir_ayah',
        'tanggal_lahir_ibu',
        'id_pekerjaan_ayah',
        'id_pekerjaan_ibu',
        'id_pendidikan_ayah',
        'id_pendidikan_ibu',
        'id_penghasilan_ayah',
        'id_penghasilan_ibu',
        'no_telp_ayah',
        'no_telp_ibu',
        'sync_at',
        'sync_status',
        'sync_message'
    ];


    // protected static function newFactory(): OrangTuaFactory
    // {
    //     // return OrangTuaFactory::new();
    // }
}

<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Akademiks\Database\Factories\WaliFactory;

class Wali extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_mahasiswa',
        'nama_wali',
        'nik',
        'tanggal_lahir',
        'id_pendidikan',
        'id_pekerjaan',
        'id_penghasilan',
        'sync_at',
        'sync_status',
        'sync_message'
    ];


    // protected static function newFactory(): WaliFactory
    // {
    //     // return WaliFactory::new();
    // }
}

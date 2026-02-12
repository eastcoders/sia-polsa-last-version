<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulums';
    protected $primaryKey = 'id_kurikulum';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kurikulum',
        'nama_kurikulum',
        'id_prodi',
        'id_semester',
        'jumlah_sks_lulus',
        'jumlah_sks_wajib',
        'jumlah_sks_pilihan',
        'status',
    ];
}

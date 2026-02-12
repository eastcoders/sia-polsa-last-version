<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSubstansi extends Model
{
    use HasFactory;

    protected $table = 'jenis_substansis';
    protected $primaryKey = 'id_jenis_substansi';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_substansi',
        'nama_jenis_substansi',
    ];
}

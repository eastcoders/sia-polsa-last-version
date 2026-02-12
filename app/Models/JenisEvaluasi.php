<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisEvaluasi extends Model
{
    use HasFactory;

    protected $table = 'jenis_evaluasis';
    protected $primaryKey = 'id_jenis_evaluasi';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_evaluasi',
        'nama_jenis_evaluasi',
    ];
}

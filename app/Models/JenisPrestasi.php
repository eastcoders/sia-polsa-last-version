<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPrestasi extends Model
{
    use HasFactory;

    protected $table = 'jenis_prestasis';
    protected $primaryKey = 'id_jenis_prestasi';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_prestasi',
        'nama_jenis_prestasi',
    ];
}

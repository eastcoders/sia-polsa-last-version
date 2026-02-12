<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TingkatPrestasi extends Model
{
    use HasFactory;

    protected $table = 'tingkat_prestasis';
    protected $primaryKey = 'id_tingkat_prestasi';
    public $incrementing = false;

    protected $fillable = [
        'id_tingkat_prestasi',
        'nama_tingkat_prestasi',
    ];
}

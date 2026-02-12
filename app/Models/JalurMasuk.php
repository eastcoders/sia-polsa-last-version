<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JalurMasuk extends Model
{
    use HasFactory;

    protected $table = 'jalur_masuks';
    protected $primaryKey = 'id_jalur_masuk';
    public $incrementing = false;

    protected $fillable = [
        'id_jalur_masuk',
        'nama_jalur_masuk',
    ];
}

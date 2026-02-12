<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PangkatGolongan extends Model
{
    use HasFactory;

    protected $table = 'pangkat_golongans';
    protected $primaryKey = 'id_pangkat_golongan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pangkat_golongan',
        'kode_golongan',
        'nama_pangkat',
    ];
}

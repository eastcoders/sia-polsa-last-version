<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IkatanKerjaSdm extends Model
{
    use HasFactory;

    protected $table = 'ikatan_kerja_sdms';
    protected $primaryKey = 'id_ikatan_kerja';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_ikatan_kerja',
        'nama_ikatan_kerja',
    ];
}

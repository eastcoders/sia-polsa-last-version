<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelWilayah extends Model
{
    use HasFactory;

    protected $table = 'level_wilayahs';
    protected $primaryKey = 'id_level_wilayah';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'id_level_wilayah',
        'nama_level_wilayah',
    ];
}

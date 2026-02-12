<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Akademiks\database\factories\WilayahFactory;

class Wilayah extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'id_wilayah',
        'id_negara',
        'nama_wilayah',
        'id_induk_wilayah',
        'id_level_wilayah',
    ];

    protected static function newFactory()
    {
        return WilayahFactory::new();
    }
}

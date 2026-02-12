<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agama extends Model
{
    use HasFactory;

    protected $table = 'agamas';
    protected $primaryKey = 'id_agama';
    public $incrementing = false;

    protected $fillable = [
        'id_agama',
        'nama_agama',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Negara extends Model
{
    use HasFactory;

    protected $table = 'negaras';
    protected $primaryKey = 'id_negara';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_negara',
        'nama_negara',
    ];
}

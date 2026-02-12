<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fakultas extends Model
{
    use HasFactory;

    protected $table = 'fakultas';
    protected $primaryKey = 'id_fakultas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_fakultas',
        'id_perguruan_tinggi',
        'nama_fakultas',
    ];
}

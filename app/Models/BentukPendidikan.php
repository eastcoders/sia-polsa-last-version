<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BentukPendidikan extends Model
{
    use HasFactory;

    protected $table = 'bentuk_pendidikans';
    protected $primaryKey = 'id_bentuk_pendidikan';
    public $incrementing = false;

    protected $fillable = [
        'id_bentuk_pendidikan',
        'nama_bentuk_pendidikan',
    ];
}

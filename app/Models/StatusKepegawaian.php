<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusKepegawaian extends Model
{
    use HasFactory;

    protected $table = 'status_kepegawaians';
    protected $primaryKey = 'id_status_pegawai';
    public $incrementing = false;

    protected $fillable = [
        'id_status_pegawai',
        'nama_status_pegawai',
    ];
}

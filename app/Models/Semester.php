<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $table = 'semesters';
    protected $primaryKey = 'id_semester';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_semester',
        'id_tahun_ajaran',
        'nama_semester',
        'semester',
        'a_periode_aktif',
        'tanggal_mulai',
        'tanggal_selesai',
    ];
}

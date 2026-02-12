<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenjangPendidikan extends Model
{
    use HasFactory;

    protected $table = 'jenjang_pendidikans';
    protected $primaryKey = 'id_jenjang_didik';
    public $incrementing = false;

    protected $fillable = [
        'id_jenjang_didik',
        'nama_jenjang_didik',
    ];
}

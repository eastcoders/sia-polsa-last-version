<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JabatanFungsional extends Model
{
    use HasFactory;

    protected $table = 'jabatan_fungsionals';
    protected $primaryKey = 'id_jabatan_fungsional';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_jabatan_fungsional',
        'nama_jabatan_fungsional',
    ];
}

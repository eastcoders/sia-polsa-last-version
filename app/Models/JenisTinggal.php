<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisTinggal extends Model
{
    use HasFactory;

    protected $table = 'jenis_tinggals';
    protected $primaryKey = 'id_jenis_tinggal';
    public $incrementing = false;

    protected $fillable = [
        'id_jenis_tinggal',
        'nama_jenis_tinggal',
    ];
}

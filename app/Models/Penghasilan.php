<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghasilan extends Model
{
    use HasFactory;

    protected $table = 'penghasilans';
    protected $primaryKey = 'id_penghasilan';
    public $incrementing = false;

    protected $fillable = [
        'id_penghasilan',
        'nama_penghasilan',
    ];
}

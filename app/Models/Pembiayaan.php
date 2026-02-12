<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembiayaan extends Model
{
    use HasFactory;

    protected $table = 'pembiayaans';
    protected $primaryKey = 'id_pembiayaan';
    public $incrementing = false;

    protected $fillable = [
        'id_pembiayaan',
        'nama_pembiayaan',
    ];
}

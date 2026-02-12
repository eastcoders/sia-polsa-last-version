<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaans';
    protected $primaryKey = 'id_pekerjaan';
    public $incrementing = false;

    protected $fillable = [
        'id_pekerjaan',
        'nama_pekerjaan',
    ];
}

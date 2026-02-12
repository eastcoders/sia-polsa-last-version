<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlatTransportasi extends Model
{
    use HasFactory;

    protected $table = 'alat_transportasis';
    protected $primaryKey = 'id_alat_transportasi';
    public $incrementing = false;

    protected $fillable = [
        'id_alat_transportasi',
        'nama_alat_transportasi',
    ];
}

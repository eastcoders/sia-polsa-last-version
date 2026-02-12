<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LembagaPengangkat extends Model
{
    use HasFactory;

    protected $table = 'lembaga_pengangkats';
    protected $primaryKey = 'id_lembaga_angkat';
    public $incrementing = false;

    protected $fillable = [
        'id_lembaga_angkat',
        'nama_lembaga_angkat',
    ];
}

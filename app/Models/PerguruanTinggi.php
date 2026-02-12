<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerguruanTinggi extends Model
{
    use HasFactory;

    protected $table = 'perguruan_tinggis';
    protected $primaryKey = 'id_perguruan_tinggi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_perguruan_tinggi',
        'kode_perguruan_tinggi',
        'nama_perguruan_tinggi',
        'nama_singkat',
    ];
}

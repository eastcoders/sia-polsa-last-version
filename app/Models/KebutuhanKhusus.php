<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KebutuhanKhusus extends Model
{
    use HasFactory;

    protected $table = 'kebutuhan_khususes';
    protected $primaryKey = 'id_kebutuhan_khusus';
    public $incrementing = false;

    protected $fillable = [
        'id_kebutuhan_khusus',
        'nama_kebutuhan_khusus',
    ];
}

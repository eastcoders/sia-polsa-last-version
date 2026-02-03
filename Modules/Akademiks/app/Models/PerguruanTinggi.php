<?php

namespace Modules\Akademiks\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Akademiks\Database\Factories\PerguruanTinggiFactory;

class PerguruanTinggi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): PerguruanTinggiFactory
    // {
    //     // return PerguruanTinggiFactory::new();
    // }
}

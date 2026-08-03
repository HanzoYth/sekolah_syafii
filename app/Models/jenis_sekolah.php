<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jenis_sekolah extends Model
{
    protected $table = "jenis_sekolah";
    public $timestamps = false;

    protected $fillable = [
        "jenis"
    ];
}

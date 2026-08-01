<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cabang_guru extends Model
{
    protected $table = "cabang_guru";
    public $timestamps = true;

    protected $fillable = [
        "nama_cabang"
    ];
}

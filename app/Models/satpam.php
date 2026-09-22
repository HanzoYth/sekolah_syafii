<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class satpam extends Model
{
    protected $table = "satpam";
    public $timestamps = false;

    protected $fillable = [
        "nama",
        "tempat_lahir",
        "tanggal_lahir",
        "agama",
        "alamat",
        "gender",
        "cabang_id",
        "user_id"
    ];
}

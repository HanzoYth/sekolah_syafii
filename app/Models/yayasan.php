<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class yayasan extends Model
{
    protected $table = "yayasan";
    public $timestamps = false;

    protected $fillable = [
        "nama",
        "tempat_lahir",
        "tanggal_lahir",
        "agama",
        "alamat",
        "gender",
        "user_id"
    ];
}

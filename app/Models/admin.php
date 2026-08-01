<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = "admin";

    public $timestamps = false;

    protected $fillable = [
        "nama",
        "nig",
        "tempat_lahir",
        "tanggal_lahir",
        "agama",
        "alamat",
        "pendidikan_terakhir",  
        "url_foto",
        "user_id"
    ];
}

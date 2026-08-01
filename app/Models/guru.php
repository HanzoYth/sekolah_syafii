<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\akun;

class guru extends Model
{
    protected $table = "guru";
    
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
        "guru_honor",
        "guru_tetap",
        "koordinator_tahfiz",
        "pengampu_tahfiz",
        "kepala_sekolah",
        "cabang_id",
        "sekolah_id",
        "user_id",
    ];

    public function getUser(){
        return $this->belongsTo(akun::class,"user_id");
    }
}

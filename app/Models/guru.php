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
        "ktp",
        "kk",
        "ijazah",
        "guru_honor",
        "guru_tetap",
        "koordinator_tahfiz",
        "pengampu_tahfiz",
        "kepala_sekolah",
        "wakil_sekolah",
        "ast_krk",
        "gender",
        "cabang_id",
        "sekolah_id",
        "user_id",
        "bendahara",
        "operator",
        "satpam"
    ];

    public function getUser(){
        return $this->belongsTo(akun::class,"user_id");
    }

    public function getSekolah(){
        return $this->belongsTo(jenis_sekolah::class,"sekolah_id");
    }

    public function getCabang(){
        return $this->belongsTo(cabang_guru::class,"cabang_id");
    }

    public function getAbsen(){
        return $this->hasMany(master_absen_guru::class,"guru_id","id");
    }

    public function getGaji(){
        return $this->hasOne(gaji::class,"guru_id","id");
    }

    public function getTunjangan(){
        return $this->hasMany(tunjangan::class,"guru_id","id");
    }

    public function getTunjanganPotongan(){
        return $this->hasMany(tunjangan_potongan::class,"guru_id","id");
    }
}

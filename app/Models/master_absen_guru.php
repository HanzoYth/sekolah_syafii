<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\master_lokasi_absen_guru;
use App\Models\master_waktu_absen_guru;
use App\Models\guru;

class master_absen_guru extends Model
{
    protected $table = "master_absensi";
    public $timestamps = false;

    protected $fillable = [
        "waktu_masuk",
        "waktu_keluar",
        "tgl_masuk",        
        "status_kehadiran",
        "terlambat_menit",
        "cabang_id",
        "guru_id",
        "lokasi_id",
        "waktu_id"
    ];


    function getGuru(){
        return $this->belongsTo(guru::class,"guru_id");
    }
    function getLokasi(){
        return $this->belongsTo(master_lokasi_absen_guru::class,"lokasi_id");
    }

    function getWaktu(){
        return $this->belongsTo(master_waktu_absen_guru::class,"waktu_id");
    }
}

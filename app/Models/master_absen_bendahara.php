<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_absen_bendahara extends Model
{
    protected $table = "master_absensi_bendahara";
    public $timestamps = false;

    protected $fillable = [
        "waktu_masuk",
        "waktu_keluar",
        "tgl_masuk",        
        "status_kehadiran",
        "terlambat_menit",
        "cabang_id",
        "bendahara_id",
        "lokasi_id",
        "waktu_id"
    ];


    function getBendahara(){
        return $this->belongsTo(bendahara::class,"bendahara_id");
    }
    function getLokasi(){
        return $this->belongsTo(master_lokasi_absen_guru::class,"lokasi_id");
    }

    function getWaktu(){
        return $this->belongsTo(master_waktu_absen_guru::class,"waktu_id");
    }
}

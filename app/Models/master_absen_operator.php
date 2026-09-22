<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class master_absen_operator extends Model
{
    protected $table = "master_absensi_operator";
    public $timestamps = false;

    protected $fillable = [
        "waktu_masuk",
        "waktu_keluar",
        "tgl_masuk",        
        "status_kehadiran",
        "terlambat_menit",
        "cabang_id",
        "operator_id",
        "lokasi_id",
        "waktu_id"
    ];


    function getOperator(){
        return $this->belongsTo(operator::class,"operator_id");
    }
    function getLokasi(){
        return $this->belongsTo(master_lokasi_absen_guru::class,"lokasi_id");
    }

    function getWaktu(){
        return $this->belongsTo(master_waktu_absen_guru::class,"waktu_id");
    }
}

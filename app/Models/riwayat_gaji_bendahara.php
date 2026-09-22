<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class riwayat_gaji_bendahara extends Model
{
    protected $table = "riwayat_gaji_bendahara";
    protected $fillable = [
        "gaji_pokok",
        "gaji_honor",
        "gaji_tugas_tambahan",
        "potongan_tidak_hadir",
        "potongan_keterlambatan",
        "kasbon",
        "gaji_tambahan",
        "bonus",
        "ketidakhadiran",
        "keterlambatan",
        "bendahara_id"
    ];
}

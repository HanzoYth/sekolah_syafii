<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gaji_operator extends Model
{
    protected $table = "gaji_operator";
    protected $fillable = [
        "gaji_pokok",
        "gaji_honor",
        "gaji_tugas_tambahan",
        "potongan_tidak_hadir",
        "potongan_keterlambatan",
        "kasbon",
        "gaji_tambahan",
        "ketidakhadiran",
        "bonus",
        "operator_id"
    ];
}

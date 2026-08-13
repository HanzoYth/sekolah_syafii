<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class gaji extends Model
{
    protected $table = "gaji";
    protected $fillable = [
        "gaji_pokok",
        "gaji_honor",
        "gaji_tugas_tambahan",
        "potongan_tidak_hadir",
        "potongan_keterlambatan",
        "kasbon",
        "gaji_tambahan",
        "bonus",
        "guru_id"
    ];
}

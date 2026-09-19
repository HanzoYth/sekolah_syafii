<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_piket extends Model
{
    protected $table = "piket_guru";
    protected $fillable = [
        "tanggal",
        "jam",
        "id_guru"
    ];
}

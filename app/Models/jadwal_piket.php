<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_piket extends Model
{
    protected $table = "piket_guru";
    public $timestamps =false;
    protected $fillable = [
        "hari",
        "jam",
        "id_guru",
        "nama"
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class wallas extends Model
{
    protected $table = "wallas";
    public $timestamps = false;
    protected $fillable = [
        "guru_id",
        "kelas_id"
    ];
    public function guru() {
        return $this->belongsTo(guru::class, 'guru_id');
    }

    public function kelas() {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
}
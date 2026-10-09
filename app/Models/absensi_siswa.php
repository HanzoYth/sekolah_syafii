<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class absensi_siswa extends Model
{
    protected $table = 'absensi_siswa';
    protected $guarded = [];

    public function siswa()
    {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(jadwal_pelajaran::class, 'jadwal_pelajaran_id');
    }
}


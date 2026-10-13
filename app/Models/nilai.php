<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    protected $table = 'nilai';
    protected $guarded = [];

    public function siswa() {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }

    public function mata_pelajaran() {
        return $this->belongsTo(mata_pelajaran::class, 'mapel_id');
    }

    public function jenis_penilaian() {
        return $this->belongsTo(jenis_penilaian::class, 'jenis_penilaian_id');
    }

    public function guru() {
        return $this->belongsTo(guru::class, 'guru_id');
    }
}
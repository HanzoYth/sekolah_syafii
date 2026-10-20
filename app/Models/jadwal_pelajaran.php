<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_pelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';
    public $timestamps = false;
    protected $guarded = [];

    public function guru() {
        return $this->belongsTo(guru::class, 'guru_id');
    }

    public function kelas() {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }

    public function mata_pelajaran() {
        return $this->belongsTo(mata_pelajaran::class, 'mapel_id');
    }
    
    public function jam_pelajaran() {
        return $this->belongsTo(jam_pelajaran::class, 'jam_pelajaran_id');
    }

    public function tahun_ajaran() {
        return $this->belongsTo(tahun_ajaran::class, 'tahun_ajaran_id');
    }

    public function getKkm() {
        if (!$this->mata_pelajaran) {
            return 75;
        }
        $nama_kelas = $this->kelas ? ($this->kelas->nama_kelas ?? $this->kelas->nama_ruang ?? '') : '';
        $tingkat = mata_pelajaran::extractTingkat($nama_kelas);
        return $this->mata_pelajaran->getKkmTingkat($tingkat);
    }
}
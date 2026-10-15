<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    protected $table = "pengumuman";
    protected $fillable = [
        "judul",
        "penulis",
        "isi",
        "lampiran",
        "tanggal",
        "target_tipe",
        "target_role",
        "sekolah_id",
        "kelas_id",
        "siswa_id",
        "guru_id"
    ];

    public function sekolah() {
        return $this->belongsTo(jenis_sekolah::class, 'sekolah_id');
    }

    public function ruangKelas() {
        return $this->belongsTo(ruang_kelas::class, 'kelas_id');
    }

    public function siswa() {
        return $this->belongsTo(siswa::class, 'siswa_id');
    }

    public function guru() {
        return $this->belongsTo(guru::class, 'guru_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    protected $table = "siswa";

    protected $fillable = [
        "nama",
        "nis",
        "tempat_lahir",
        "tanggal_lahir",
        "gender",
        "alamat",
        "url_foto",
        "aktif",
        "kelas_id",
        "tahun_ajaran_id",
        "sekolah_id",
        "user_id"
    ];

    public function kelas()
    {
        return $this->belongsTo(ruang_kelas::class, 'kelas_id');
    }

    public function ruangKelas()
    {
        return $this->belongsTo(ruang_kelas::class, 'kelas_id');
    }

    public function sekolah()
    {
        return $this->belongsTo(jenis_sekolah::class, 'sekolah_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'tahun_ajaran_id');
    }
}

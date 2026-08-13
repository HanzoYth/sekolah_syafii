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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengaturan_rapor extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_rapor';

    protected $fillable = [
        'tahun_ajaran_id',
        'semester',
        'jenjang',
        'tempat_rapor',
        'tanggal_rapor',
        'nama_kepsek',
        'nip_kepsek',
        'ttd_kepsek',
        'ttd_walas',
        'catatan_walas_template'
    ];

    public function tahunAjaran()
    {
        return $this->belongsTo(tahun_ajaran::class, 'tahun_ajaran_id');
    }
}


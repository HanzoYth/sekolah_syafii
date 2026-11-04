<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru_pengganti extends Model
{
    use HasFactory;

    protected $table = 'guru_pengganti';
    protected $guarded = ['id'];
    protected $dates = ['tanggal', 'taken_at'];

    public function jadwal()
    {
        return $this->belongsTo(jadwal_pelajaran::class, 'jadwal_pelajaran_id');
    }

    public function guruAsli()
    {
        return $this->belongsTo(guru::class, 'guru_asli_id');
    }

    public function guruPengganti()
    {
        return $this->belongsTo(guru::class, 'guru_pengganti_id');
    }

    public function isKosong(): bool
    {
        return $this->status === 'kosong';
    }

    public function isDiambil(): bool
    {
        return $this->status === 'diambil';
    }

    /**
     * Memeriksa apakah guru tertentu memiliki jadwal bentrok di jam pelajaran ini
     */
    public function cekBentrokDenganGuru($guruId): bool
    {
        if (!$this->jadwal || !$this->jadwal->jam_pelajaran) {
            return false;
        }

        $hari = $this->jadwal->hari;
        $jamPelajaranId = $this->jadwal->jam_pelajaran_id;

        // 1. Cek apakah guru sudah punya jadwal mengajar tetap di hari dan jam yang sama
        $punyaJadwalTetap = jadwal_pelajaran::where('guru_id', $guruId)
            ->where('hari', strtolower($hari))
            ->where('jam_pelajaran_id', $jamPelajaranId)
            ->exists();

        if ($punyaJadwalTetap) {
            return true;
        }

        // 2. Cek apakah guru sudah mengambil jadwal pengganti lain pada tanggal & jam yang sama
        $sudahAmbilLain = self::where('guru_pengganti_id', $guruId)
            ->where('tanggal', $this->tanggal)
            ->where('id', '!=', $this->id)
            ->where('status', 'diambil')
            ->whereHas('jadwal', function($q) use ($jamPelajaranId) {
                $q->where('jam_pelajaran_id', $jamPelajaranId);
            })
            ->exists();

        return $sudahAmbilLain;
    }
}


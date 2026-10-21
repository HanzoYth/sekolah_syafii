<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    public $timestamps = true;
    protected $guarded = [];

    public function sekolah()
    {
        return $this->belongsTo(jenis_sekolah::class, 'sekolah_id');
    }

    public function kkm_tingkat()
    {
        return $this->hasMany(kkm_mapel_tingkat::class, 'mapel_id');
    }

    /**
     * Kode Jenjang Sekolah (SD, SMP, TK, atau UMUM)
     */
    public function getKodeJenjangAttribute(): string
    {
        if ($this->sekolah && !empty($this->sekolah->jenis)) {
            return strtoupper(trim($this->sekolah->jenis));
        }
        return 'UMUM';
    }

    /**
     * Cek apakah mata pelajaran ini milik Jenjang TK/PAUD (Penilaian deskriptif non-KKM)
     */
    public function getIsTkAttribute(): bool
    {
        $kode = strtolower($this->kode_jenjang);
        return str_contains($kode, 'tk') || str_contains($kode, 'paud');
    }

    /**
     * Dapatkan nilai KKM untuk tingkat kelas tertentu
     */
    public function getKkmTingkat($tingkat = null)
    {
        if ($tingkat === null || $tingkat === '') {
            return $this->kkm ?? 75;
        }

        $tingkatStr = (string)$tingkat;

        // Ambil dari relasi jika sudah di-load, atau query langsung
        if ($this->relationLoaded('kkm_tingkat')) {
            $record = $this->kkm_tingkat->firstWhere('tingkat', $tingkatStr);
        } else {
            $record = $this->kkm_tingkat()->where('tingkat', $tingkatStr)->first();
        }

        // Cek mapping alias untuk SMP (misal kelas 1 SMP = tingkat 7, dst.)
        if (!$record) {
            $aliasMap = [
                '1' => '7', '2' => '8', '3' => '9',
                '7' => '7', '8' => '8', '9' => '9',
                '10' => '10', '11' => '11', '12' => '12'
            ];
            if (isset($aliasMap[$tingkatStr]) && $aliasMap[$tingkatStr] !== $tingkatStr) {
                $target = $aliasMap[$tingkatStr];
                if ($this->relationLoaded('kkm_tingkat')) {
                    $record = $this->kkm_tingkat->firstWhere('tingkat', $target);
                } else {
                    $record = $this->kkm_tingkat()->where('tingkat', $target)->first();
                }
            }
        }

        if ($record && $record->kkm !== null) {
            return (int)$record->kkm;
        }

        return $this->kkm ?? 75;
    }

    /**
     * Ekstrak tingkatan kelas dari nama ruang kelas / nama kelas
     * Contoh: "SD Kelas 1 A" -> "1", "SMP Kelas 7 B" -> "7", "VII A" -> "7", "TK A" -> "A"
     */
    public static function extractTingkat($nama_kelas)
    {
        if (!$nama_kelas) return null;
        $nama = trim($nama_kelas);

        // Pola 1: "Kelas (\d+)" misal "SD Kelas 1 A", "SMP Kelas 8 REGULER"
        if (preg_match('/Kelas\s+(\d+)/i', $nama, $matches)) {
            return (string)$matches[1];
        }

        // Pola 2: Angka Romawi misal VII, VIII, IX, X, XI, XII
        if (preg_match('/\b(XII|XI|X|IX|VIII|VII|VI|V|IV|III|II|I)\b/i', $nama, $matches)) {
            $romawiMap = [
                'I' => '1', 'II' => '2', 'III' => '3', 'IV' => '4', 'V' => '5', 'VI' => '6',
                'VII' => '7', 'VIII' => '8', 'IX' => '9', 'X' => '10', 'XI' => '11', 'XII' => '12'
            ];
            $upper = strtoupper($matches[1]);
            if (isset($romawiMap[$upper])) {
                return $romawiMap[$upper];
            }
        }

        // Pola 3: TK A atau TK B
        if (preg_match('/TK\s+(?:Kelas\s+)?([AB])/i', $nama, $matches)) {
            return strtoupper($matches[1]);
        }

        // Pola 4: Angka berdiri sendiri
        if (preg_match('/\b(\d+)\b/', $nama, $matches)) {
            return (string)$matches[1];
        }

        return null;
    }
}
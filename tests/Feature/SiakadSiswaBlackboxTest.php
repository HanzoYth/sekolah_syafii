<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\siswa;

class SiakadSiswaBlackboxTest extends TestCase
{
    private array $siswaSession;
    private $siswa;

    protected function setUp(): void
    {
        parent::setUp();

        $this->siswa = siswa::with('kelas')->first();
        $this->siswaSession = [
            'role' => 's',
            'id' => $this->siswa ? $this->siswa->id : 1,
            'id_akun' => $this->siswa ? $this->siswa->user_id : 1,
            'nama' => $this->siswa ? $this->siswa->nama : 'Siswa Siakad',
            'hasLogin' => true,
        ];
    }

    /** 1. Dashboard Siswa */
    public function test_siswa_dashboard_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/dbs');
        $response->assertStatus(200);
        $response->assertSee('Presensi', false);
    }

    /** 2. Jadwal Pelajaran Siswa */
    public function test_siswa_jadwal_pelajaran_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/jadwal-siswa?tab=jadwal');
        $response->assertStatus(200);
        $response->assertSee('Jadwal', false);
    }

    /** 3. Absensi & Jurnal Belajar Siswa (Mapel) */
    public function test_siswa_absensi_jurnal_mapel_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/jadwal-siswa?tab=absensi_mapel');
        $response->assertStatus(200);
        $response->assertSee('Jurnal', false);
    }

    /** 4. Absensi Harian Siswa */
    public function test_siswa_absensi_harian_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/jadwal-siswa?tab=absensi_harian');
        $response->assertStatus(200);
        $response->assertSee('Kehadiran', false);
    }

    /** 5. Nilai & Transkrip Akademik Siswa */
    public function test_siswa_transkrip_nilai_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/rapor-siswa?tab=transkrip');
        $response->assertStatus(200);
        $response->assertSee('Nilai', false);
    }

    /** 6. Rapor Semester Digital */
    public function test_siswa_rapor_semester_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/rapor-siswa?tab=rapor');
        $response->assertStatus(200);
        $response->assertSee('Rapor', false);
    }

    /** 7. Riwayat Pembayaran Siswa */
    public function test_siswa_riwayat_pembayaran_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/pbs');
        $response->assertStatus(200);
        $response->assertSee('Pembayaran', false);
    }

    /** 8. Pengumuman Siswa */
    public function test_siswa_pengumuman_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/ps');
        $response->assertStatus(200);
        $response->assertSee('Pengumuman', false);
    }

    /** 9. Profil Siswa */
    public function test_siswa_profil_loads_successfully()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/pfs');
        $response->assertStatus(200);
        $response->assertSee('Profil', false);
    }

    /** 10. Security: Siswa cannot access Admin Dashboard */
    public function test_siswa_cannot_access_admin_dashboard()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/das');
        $response->assertRedirect('/sk/dbs');
    }

    /** 11. Security: Siswa cannot access Guru Dashboard */
    public function test_siswa_cannot_access_guru_dashboard()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/dsg');
        $response->assertRedirect('/sk/dbs');
    }

    /** 12. Edge Case: Siswa belum memiliki kelas (kelas_id null) */
    public function test_siswa_without_class_handles_gracefully()
    {
        $studentNullClass = siswa::whereNull('kelas_id')->first();
        if ($studentNullClass) {
            $session = [
                'role' => 's',
                'id' => $studentNullClass->id,
                'id_akun' => $studentNullClass->user_id,
                'nama' => $studentNullClass->nama,
                'hasLogin' => true,
            ];

            // Dashboard
            $res = $this->withSession($session)->get('/sk/dbs');
            $res->assertStatus(200);

            // Jadwal Siswa
            $resJadwal = $this->withSession($session)->get('/sk/jadwal-siswa?tab=jadwal');
            $resJadwal->assertStatus(200);

            // Transkrip
            $resRapor = $this->withSession($session)->get('/sk/rapor-siswa?tab=transkrip');
            $resRapor->assertStatus(200);
        } else {
            $this->markTestSkipped('Semua siswa sudah memiliki kelas.');
        }
    }
}

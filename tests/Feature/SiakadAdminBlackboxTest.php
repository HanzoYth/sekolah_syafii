<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\admin;
use App\Models\mata_pelajaran;
use App\Models\siswa;

class SiakadAdminBlackboxTest extends TestCase
{
    private array $adminSession;

    protected function setUp(): void
    {
        parent::setUp();
        
        $admin = admin::first();
        $this->adminSession = [
            'role' => 'a',
            'id' => $admin ? $admin->id : 1,
            'id_akun' => $admin ? $admin->user_id : 1,
            'nama' => $admin ? $admin->nama : 'Admin Siakad',
            'hasLogin' => true,
        ];
    }

    /** 1. Dashboard Admin */
    public function test_admin_dashboard_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/das');
        $response->assertStatus(200);
        $response->assertSee('SISTEM INFORMASI AKADEMIK', false);
    }

    /** 2. Kelola Mata Pelajaran */
    public function test_admin_kelola_mapel_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/kelola-mapel');
        $response->assertStatus(200);
        $response->assertSee('Mata Pelajaran', false);
    }

    /** 3. Bobot Penilaian & KKM */
    public function test_admin_bobot_penilaian_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/bobot-penilaian');
        $response->assertStatus(200);
        $response->assertSee('Bobot', false);
    }

    /** 4. Kelola Jadwal Pelajaran */
    public function test_admin_kelola_jadwal_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/kelola-jadwal');
        $response->assertStatus(200);
        $response->assertSee('Jadwal', false);
    }

    /** 5. Kelola Referensi (Tahun Ajaran & Jam Pelajaran) */
    public function test_admin_kelola_referensi_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/referensi');
        $response->assertStatus(200);
        $response->assertSee('Tahun Ajaran', false);
    }

    /** 6. Data Siswa (List, Detail, Edit) */
    public function test_admin_data_siswa_list_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/ds');
        $response->assertStatus(200);
        $response->assertSee('Data Siswa', false);
    }

    public function test_admin_detail_siswa_loads_successfully()
    {
        $siswa = siswa::first();
        if ($siswa) {
            $response = $this->withSession($this->adminSession)->get("/sk/dls/{$siswa->id}");
            $response->assertStatus(200);
        } else {
            $this->markTestSkipped('Belum ada data siswa di database.');
        }
    }

    public function test_admin_edit_siswa_form_loads_successfully()
    {
        $siswa = siswa::first();
        if ($siswa) {
            $response = $this->withSession($this->adminSession)->get("/sk/dts?id={$siswa->id}");
            $response->assertStatus(200);
        } else {
            $this->markTestSkipped('Belum ada data siswa di database.');
        }
    }

    /** 7. Kelola Ruang Kelas */
    public function test_admin_kelola_kelas_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/tk');
        $response->assertStatus(200);
        $response->assertSee('Kelas', false);
    }

    /** 8. Pembagian Kelas (Rombel) */
    public function test_admin_pembagian_kelas_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/pembagian-kelas');
        $response->assertStatus(200);
        $response->assertSee('Pembagian Kelas', false);
    }

    /** 9. Kelola Wali Kelas */
    public function test_admin_kelola_wali_kelas_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/kelola-wali-kelas');
        $response->assertStatus(200);
        $response->assertSee('Wali Kelas', false);
    }

    /** 10. Kenaikan & Kelulusan */
    public function test_admin_kenaikan_kelas_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/kenaikan-kelas');
        $response->assertStatus(200);
        $response->assertSee('Kenaikan', false);
    }

    /** 11. Kehadiran Guru */
    public function test_admin_laporan_absensi_guru_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/laporan-absensi-guru');
        $response->assertStatus(200);
        $response->assertSee('Kehadiran', false);
    }

    /** 12. Slip Pembayaran Guru */
    public function test_admin_slip_pembayaran_guru_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/gsp');
        $response->assertStatus(200);
    }

    /** 13. Kelola Pengumuman */
    public function test_admin_kelola_pengumuman_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/kelola-pengumuman');
        $response->assertStatus(200);
        $response->assertSee('Pengumuman', false);
    }

    /** 14. Keuangan: Pembayaran Pemeliharaan */
    public function test_admin_keuangan_pemeliharaan_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/ppl');
        $response->assertStatus(200);
    }

    /** 15. Keuangan: Buat Tagihan */
    public function test_admin_keuangan_buat_tagihan_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/bt');
        $response->assertStatus(200);
    }

    /** 16. Keuangan: Pembayaran IPP & Detail */
    public function test_admin_keuangan_pembayaran_ipp_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/pb');
        $response->assertStatus(200);
    }

    public function test_admin_keuangan_detail_pembayaran_loads_successfully()
    {
        $siswa = siswa::first();
        if ($siswa) {
            $response = $this->withSession($this->adminSession)->get("/sk/dp?id={$siswa->id}");
            $response->assertStatus(200);
        } else {
            $this->markTestSkipped('Belum ada data siswa di database.');
        }
    }

    /** 17. Keuangan: Uang Pangkal */
    public function test_admin_keuangan_uang_pangkal_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/pp');
        $response->assertStatus(200);
    }

    /** 18. Keuangan: Dana Pendidikan */
    public function test_admin_keuangan_dana_pendidikan_loads_successfully()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/pd');
        $response->assertStatus(200);
    }

    /** 19. CRUD Mata Pelajaran */
    public function test_admin_crud_mata_pelajaran()
    {
        $response = $this->withSession($this->adminSession)->post('/sk/simpan-mapel', [
            'nama_mapel' => 'Blackbox Test Subject',
            'sekolah_id' => 1,
            'kkm' => 78,
        ]);
        $response->assertRedirect();
        
        $mapel = mata_pelajaran::where('nama_mapel', 'Blackbox Test Subject')->first();
        $this->assertNotNull($mapel);

        // Update
        $responseUpdate = $this->withSession($this->adminSession)->post("/sk/update-mapel/{$mapel->id}", [
            'nama_mapel' => 'Blackbox Test Subject Updated',
            'sekolah_id' => 1,
            'kkm' => 82,
        ]);
        $responseUpdate->assertRedirect();
        $this->assertEquals('Blackbox Test Subject Updated', $mapel->fresh()->nama_mapel);

        // Delete
        $responseDelete = $this->withSession($this->adminSession)->get("/sk/hapus-mapel/{$mapel->id}");
        $responseDelete->assertRedirect();
        $this->assertNull(mata_pelajaran::find($mapel->id));
    }

    /** 20. CRUD Pengumuman Admin */
    public function test_admin_crud_pengumuman()
    {
        $response = $this->withSession($this->adminSession)->post('/sk/simpan-pengumuman', [
            'judul' => 'Uji Blackbox Pengumuman',
            'isi' => 'Konten pengumuman untuk verifikasi sistem.',
            'tanggal' => date('Y-m-d'),
            'target_tipe' => 'semua',
        ]);
        $response->assertRedirect();

        $pengumuman = \App\Models\pengumuman::where('judul', 'Uji Blackbox Pengumuman')->first();
        $this->assertNotNull($pengumuman);

        // Hapus pengumuman
        $responseHapus = $this->withSession($this->adminSession)->get("/sk/hapus-pengumuman/{$pengumuman->id}");
        $responseHapus->assertRedirect();
        $this->assertNull(\App\Models\pengumuman::find($pengumuman->id));
    }

    /** 21. Alur Pendaftaran Siswa Baru -> Database -> Halaman Admin */
    public function test_pendaftaran_siswa_tercatat_di_database_dan_muncul_di_admin()
    {
        $uniqueNis = 'PPDB-' . rand(10000, 99999);
        $namaSiswa = 'Calon Siswa Uji PPDB';

        // 1. Submit formulir pendaftaran siswa baru
        $response = $this->withSession($this->adminSession)->post('/sk/tbss', [
            'nama' => $namaSiswa,
            'nis' => $uniqueNis,
            'sekolah_id' => 1,
            'jenis_kelamin' => 'l',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => '2016-01-01',
            'alamat' => 'Alamat Uji Siswa Baru',
        ]);
        $response->assertRedirect('/sk/ds');

        // 2. Verifikasi data tersimpan di tabel database 'siswa'
        $siswaBaru = siswa::where('nis', $uniqueNis)->first();
        $this->assertNotNull($siswaBaru, 'Siswa harus tercatat di database.');
        $this->assertEquals($namaSiswa, $siswaBaru->nama);
        $this->assertNull($siswaBaru->kelas_id, 'Siswa baru belum memiliki kelas rombel.');

        // 3. Verifikasi siswa baru muncul di Halaman Data Siswa Admin (/sk/ds)
        $responseDs = $this->withSession($this->adminSession)->get('/sk/ds');
        $responseDs->assertStatus(200);
        $responseDs->assertSee($namaSiswa);
        $responseDs->assertSee($uniqueNis);

        // 4. Verifikasi siswa baru muncul di Halaman Pembagian Kelas (/sk/pembagian-kelas)
        $responseRombel = $this->withSession($this->adminSession)->get('/sk/pembagian-kelas');
        $responseRombel->assertStatus(200);
        $responseRombel->assertSee($namaSiswa);

        // 5. Verifikasi Detail Siswa dapat diakses (/sk/dls/{id})
        $responseDetail = $this->withSession($this->adminSession)->get("/sk/dls/{$siswaBaru->id}");
        $responseDetail->assertStatus(200);
        $responseDetail->assertSee($namaSiswa);

        // Bersihkan data uji pendaftaran
        $siswaBaru->delete();
    }

    /** 22. Security: Unauthenticated access */
    public function test_unauthenticated_user_cannot_access_admin_dashboard()
    {
        $response = $this->get('/sk/das');
        $response->assertRedirect('/');
    }
}

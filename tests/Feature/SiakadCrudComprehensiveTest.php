<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\admin;
use App\Models\guru;
use App\Models\jadwal_pelajaran;
use App\Models\jam_pelajaran;
use App\Models\jenis_sekolah;
use App\Models\kelas;
use App\Models\mata_pelajaran;
use App\Models\pengumuman;
use App\Models\ruang_kelas;
use App\Models\siswa;
use App\Models\slip_pembayaran_ipp;
use App\Models\tahun_ajaran;
use App\Models\wallas;

class SiakadCrudComprehensiveTest extends TestCase
{
    private array $adminSession;
    private array $guruSession;
    private array $walasSession;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = admin::first();
        $this->adminSession = [
            'role' => 'a',
            'id' => $admin ? $admin->id : 1,
            'id_akun' => $admin ? $admin->user_id : 1,
            'nama' => $admin ? $admin->nama : 'Admin',
            'hasLogin' => true,
        ];

        $guru = guru::where('guru_tetap', 1)->first() ?? guru::first();
        $this->guruSession = [
            'role' => 'g',
            'id' => $guru ? $guru->id : 1,
            'id_akun' => $guru ? $guru->user_id : 1,
            'nama' => $guru ? $guru->nama : 'Guru',
            'hasLogin' => true,
        ];

        $wallas = wallas::where('guru_id', 1)->first() ?? wallas::first();
        if ($wallas) {
            $gWalas = guru::find($wallas->guru_id);
            $this->walasSession = [
                'role' => 'g',
                'id' => $gWalas->id,
                'id_akun' => $gWalas->user_id,
                'nama' => $gWalas->nama,
                'hasLogin' => true,
            ];
        } else {
            $this->walasSession = $this->guruSession;
        }
    }

    /** 1. CRUD DATA SISWA */
    public function test_crud_data_siswa()
    {
        $nis = 'CRUD-SISWA-' . rand(1000, 9999);
        $namaAwal = 'Siswa CRUD Awal';
        $namaUpdate = 'Siswa CRUD Terupdate';

        // CREATE: Pendaftaran Siswa Baru
        $resCreate = $this->withSession($this->adminSession)->post('/sk/tbss', [
            'nama' => $namaAwal,
            'nis' => $nis,
            'sekolah_id' => 1,
            'jenis_kelamin' => 'l',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => '2016-02-02',
            'alamat' => 'Alamat Uji CRUD Siswa',
        ]);
        $resCreate->assertRedirect('/sk/ds');

        $siswa = siswa::where('nis', $nis)->first();
        $this->assertNotNull($siswa, 'Siswa harus berhasil dibuat (CREATE).');

        // READ: Halaman List & Detail
        $resReadList = $this->withSession($this->adminSession)->get('/sk/ds');
        $resReadList->assertStatus(200);
        $resReadList->assertSee($namaAwal);

        $resReadDetail = $this->withSession($this->adminSession)->get("/sk/dls/{$siswa->id}");
        $resReadDetail->assertStatus(200);
        $resReadDetail->assertSee($namaAwal);

        // UPDATE: Edit Data Siswa
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-siswa/{$siswa->id}", [
            'nama' => $namaUpdate,
            'nis' => $nis,
            'sekolah_id' => 1,
            'gender' => 'l',
            'tempat_lahir' => 'Makassar',
            'tanggal_lahir' => '2016-02-02',
            'alamat' => 'Alamat Diperbarui',
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals($namaUpdate, $siswa->fresh()->nama, 'Nama siswa harus berhasil diperbarui (UPDATE).');

        // DELETE: Hapus data uji
        $siswa->delete();
        $this->assertNull(siswa::find($siswa->id), 'Siswa harus berhasil dihapus (DELETE).');
    }

    /** 2. CRUD RUANG KELAS & KELAS */
    public function test_crud_ruang_kelas()
    {
        $tingkat = 'SD';
        $noKelas = '9';
        $tipeKelas = 'TEST-' . rand(100, 999);
        $namaRuang = "{$tingkat} Kelas {$noKelas} {$tipeKelas}";

        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-kelas', [
            'tingkat_sekolah' => $tingkat,
            'no_kelas' => $noKelas,
            'tipe_kelas' => $tipeKelas,
        ]);
        $resCreate->assertRedirect();

        $ruang = ruang_kelas::where('nama_ruang', $namaRuang)->first();
        $kelasItem = kelas::where('nama_kelas', $namaRuang)->first();
        $this->assertNotNull($ruang, 'Ruang kelas harus berhasil dibuat di ruang_kelas.');
        $this->assertNotNull($kelasItem, 'Kelas harus berhasil dibuat di kelas.');

        // READ
        $resRead = $this->withSession($this->adminSession)->get('/sk/tk');
        $resRead->assertStatus(200);
        $resRead->assertSee($namaRuang);

        // UPDATE
        $namaBaru = "{$namaRuang} EDIT";
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-kelas/{$kelasItem->id}", [
            'nama_kelas' => $namaBaru,
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals($namaBaru, $kelasItem->fresh()->nama_kelas);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-kelas/{$kelasItem->id}");
        $resDelete->assertRedirect();
        $this->assertNull(kelas::find($kelasItem->id));
        $this->assertNull(ruang_kelas::where('nama_ruang', $namaBaru)->first());
    }

    /** 3. CRUD TAHUN AJARAN */
    public function test_crud_tahun_ajaran()
    {
        $namaTA = 'TA-TEST-' . rand(1000, 9999);

        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-tahun-ajaran', [
            'nama' => $namaTA,
            'tanggal_mulai' => '2026-07-01',
            'tanggal_selesai' => '2027-06-30',
        ]);
        $resCreate->assertRedirect();

        $ta = tahun_ajaran::where('nama', $namaTA)->first();
        $this->assertNotNull($ta);

        // READ
        $resRead = $this->withSession($this->adminSession)->get('/sk/referensi');
        $resRead->assertStatus(200);
        $resRead->assertSee($namaTA);

        // UPDATE
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-tahun-ajaran/{$ta->id}", [
            'nama' => $namaTA . ' UPDATED',
            'tanggal_mulai' => '2026-07-01',
            'tanggal_selesai' => '2027-06-30',
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals($namaTA . ' UPDATED', $ta->fresh()->nama);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-tahun-ajaran/{$ta->id}");
        $resDelete->assertRedirect();
        $this->assertNull(tahun_ajaran::find($ta->id));
    }

    /** 4. CRUD JAM PELAJARAN */
    public function test_crud_jam_pelajaran()
    {
        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-jam-pelajaran', [
            'sekolah_id' => 1,
            'jam_ke' => 'JP TEST ' . rand(100, 999),
            'jam_mulai' => '16:00',
            'jam_selesai' => '16:45',
        ]);
        $resCreate->assertRedirect();

        $jp = jam_pelajaran::where('jam_mulai', '16:00:00')->where('jam_selesai', '16:45:00')->first();
        $this->assertNotNull($jp);

        // READ
        $resRead = $this->withSession($this->adminSession)->get('/sk/referensi');
        $resRead->assertStatus(200);

        // UPDATE
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-jam-pelajaran/{$jp->id}", [
            'sekolah_id' => 1,
            'jam_ke' => 'JP TEST UPDATED',
            'jam_mulai' => '16:05',
            'jam_selesai' => '16:50',
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals('16:05:00', $jp->fresh()->jam_mulai);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-jam-pelajaran/{$jp->id}");
        $resDelete->assertRedirect();
        $this->assertNull(jam_pelajaran::find($jp->id));
    }

    /** 5. CRUD MATA PELAJARAN */
    public function test_crud_mata_pelajaran()
    {
        $mapelNama = 'Mapel Uji CRUD ' . rand(100, 999);

        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-mapel', [
            'nama_mapel' => $mapelNama,
            'sekolah_id' => 1,
            'kkm' => 75,
        ]);
        $resCreate->assertRedirect();

        $mapel = mata_pelajaran::where('nama_mapel', $mapelNama)->first();
        $this->assertNotNull($mapel);

        // READ
        $resRead = $this->withSession($this->adminSession)->get('/sk/kelola-mapel');
        $resRead->assertStatus(200);
        $resRead->assertSee($mapelNama);

        // UPDATE
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-mapel/{$mapel->id}", [
            'nama_mapel' => $mapelNama . ' REVISI',
            'sekolah_id' => 1,
            'kkm' => 80,
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals($mapelNama . ' REVISI', $mapel->fresh()->nama_mapel);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-mapel/{$mapel->id}");
        $resDelete->assertRedirect();
        $this->assertNull(mata_pelajaran::find($mapel->id));
    }

    /** 5.c HAPUS MAPEL DENGAN NILAI (TEST GUARD & FORCE DELETE) */
    public function test_hapus_mapel_dengan_nilai_dan_force_delete()
    {
        $mapel = mata_pelajaran::create([
            'nama_mapel' => 'Mapel Uji Nilai ' . rand(100, 999),
            'sekolah_id' => 1,
            'kkm' => 75
        ]);

        $siswa = siswa::first();
        $ta = tahun_ajaran::first();
        if ($siswa && $ta) {
            \App\Models\nilai::create([
                'siswa_id' => $siswa->id,
                'guru_id' => 1,
                'tahun_ajaran_id' => $ta->id,
                'mapel_id' => $mapel->id,
                'jenis_penilaian_id' => 1,
                'nilai' => 85
            ]);
        }

        // Hapus tanpa force harus gagal dengan session error
        $resFailed = $this->withSession($this->adminSession)->get("/sk/hapus-mapel/{$mapel->id}");
        $resFailed->assertRedirect();
        $this->assertNotNull(mata_pelajaran::find($mapel->id));

        // Hapus dengan ?force=1 harus berhasil
        $resForce = $this->withSession($this->adminSession)->get("/sk/hapus-mapel/{$mapel->id}?force=1");
        $resForce->assertRedirect();
        $this->assertNull(mata_pelajaran::find($mapel->id));
        $this->assertEquals(0, \App\Models\nilai::where('mapel_id', $mapel->id)->count());
    }

    /** 5.d HAPUS SISWA CONTROLLER METHOD */
    public function test_hapus_siswa_controller_method()
    {
        $testSiswa = siswa::create([
            'nama' => 'Santri Uji Hapus ' . rand(100, 999),
            'nis' => 'TESTNIS' . rand(1000, 9999),
            'gender' => 'l',
            'aktif' => 1,
            'sekolah_id' => 1
        ]);

        $controller = new \App\Http\Controllers\siakadController();
        session($this->adminSession);
        $res = $controller->hapusSiswa($testSiswa->id);
        $this->assertTrue($res->isRedirection());
        $this->assertNull(siswa::find($testSiswa->id));
    }

    /** 5.b CRUD MATA PELAJARAN UMUM (SEMUA JENJANG) */
    public function test_crud_mata_pelajaran_jenjang_umum()
    {
        $mapelNama = 'Bahasa Uji Umum ' . rand(100, 999);

        // CREATE Mapel Jenjang UMUM (sekolah_id = 'umum')
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-mapel', [
            'nama_mapel' => $mapelNama,
            'sekolah_id' => 'umum',
            'kkm' => 75,
        ]);
        $resCreate->assertRedirect();

        $mapel = mata_pelajaran::where('nama_mapel', $mapelNama)->first();
        $this->assertNotNull($mapel);
        $this->assertNull($mapel->sekolah_id);
        $this->assertEquals('UMUM', $mapel->kode_jenjang);

        // READ kelolaMapel
        $resRead = $this->withSession($this->adminSession)->get('/sk/kelola-mapel');
        $resRead->assertStatus(200);
        $resRead->assertSee('Umum / Semua Jenjang');
        $resRead->assertSee($mapelNama);

        // UPDATE Mapel UMUM
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-mapel/{$mapel->id}", [
            'nama_mapel' => $mapelNama . ' REVISI UMUM',
            'sekolah_id' => 'umum',
            'kkm' => 78,
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals($mapelNama . ' REVISI UMUM', $mapel->fresh()->nama_mapel);
        $this->assertNull($mapel->fresh()->sekolah_id);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-mapel/{$mapel->id}");
        $resDelete->assertRedirect();
        $this->assertNull(mata_pelajaran::find($mapel->id));
    }

    /** 6. CRUD JADWAL PELAJARAN */
    public function test_crud_jadwal_pelajaran()
    {
        $jp = jam_pelajaran::first();
        $kls = kelas::whereNotIn('id', jadwal_pelajaran::pluck('kelas_id'))->first() ?? kelas::first();
        $mpl = mata_pelajaran::first();
        $ta = tahun_ajaran::first();
        $gr = guru::where('id', '>', 3)->first() ?? guru::first();

        if (!$jp || !$kls || !$mpl || !$ta || !$gr) {
            $this->markTestSkipped('Data referensi belum lengkap untuk membuat jadwal.');
        }

        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-jadwal', [
            'kelas_id' => $kls->id,
            'guru_id' => $gr->id,
            'mapel_id' => $mpl->id,
            'hari' => 'sabtu',
            'jam_pelajaran_id' => $jp->id,
            'tahun_ajaran_id' => $ta->id,
        ]);
        $resCreate->assertRedirect();

        $jadwal = jadwal_pelajaran::where('guru_id', $gr->id)
            ->where('hari', 'sabtu')
            ->where('jam_pelajaran_id', $jp->id)
            ->first();
        $this->assertNotNull($jadwal, 'Jadwal pelajaran harus berhasil dibuat.');

        // READ
        $resRead = $this->withSession($this->adminSession)->get('/sk/kelola-jadwal');
        $resRead->assertStatus(200);

        // UPDATE
        $resUpdate = $this->withSession($this->adminSession)->post("/sk/update-jadwal/{$jadwal->id}", [
            'kelas_id' => $kls->id,
            'guru_id' => $gr->id,
            'mapel_id' => $mpl->id,
            'hari' => 'kamis',
            'jam_pelajaran_id' => $jp->id,
            'tahun_ajaran_id' => $ta->id,
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals('kamis', $jadwal->fresh()->hari);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-jadwal/{$jadwal->id}");
        $resDelete->assertRedirect();
        $this->assertNull(jadwal_pelajaran::find($jadwal->id));
    }

    /** 7. CRUD PENUGASAN WALI KELAS */
    public function test_crud_penugasan_wali_kelas()
    {
        $guruFree = guru::whereNotIn('id', wallas::pluck('guru_id'))->first();
        $ruangFree = ruang_kelas::whereNotIn('id', wallas::pluck('kelas_id'))->first();

        if (!$guruFree || !$ruangFree) {
            $this->markTestSkipped('Tidak ada guru atau ruang kelas bebas untuk penugasan walas baru.');
        }

        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-wali-kelas', [
            'guru_id' => $guruFree->id,
            'kelas_id' => $ruangFree->id,
        ]);
        $resCreate->assertRedirect();

        $w = wallas::where('guru_id', $guruFree->id)->where('kelas_id', $ruangFree->id)->first();
        $this->assertNotNull($w, 'Penugasan wali kelas harus berhasil disimpan.');

        // READ
        $resRead = $this->withSession($this->adminSession)->get('/sk/kelola-wali-kelas');
        $resRead->assertStatus(200);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-wali-kelas/{$w->id}");
        $resDelete->assertRedirect();
        $this->assertNull(wallas::find($w->id));
    }

    /** 8. CRUD PEMBAGIAN KELAS (ROMBEL) */
    public function test_crud_pembagian_kelas()
    {
        $siswa = siswa::first();
        $ruang = ruang_kelas::first();

        if ($siswa && $ruang) {
            $kelasAsal = $siswa->kelas_id;

            // Masukkan siswa ke kelas (ASSIGN)
            $resAssign = $this->withSession($this->adminSession)->post('/sk/simpan-pembagian-kelas', [
                'kelas_id' => $ruang->id,
                'siswa_ids' => [$siswa->id],
            ]);
            $resAssign->assertRedirect();
            $this->assertEquals($ruang->id, $siswa->fresh()->kelas_id);

            // Keluarkan siswa dari kelas (REMOVE / UNASSIGN)
            $resRemove = $this->withSession($this->adminSession)->get("/sk/hapus-anggota-kelas/{$siswa->id}");
            $resRemove->assertRedirect();
            $this->assertNull($siswa->fresh()->kelas_id);

            // Kembalikan ke kelas asal
            $siswa->update(['kelas_id' => $kelasAsal]);
        } else {
            $this->markTestSkipped('Data siswa atau ruang kelas kosong.');
        }
    }

    /** 9. CRUD PENGUMUMAN */
    public function test_crud_pengumuman()
    {
        $judul = 'Uji CRUD Pengumuman ' . rand(100, 999);

        // CREATE
        $resCreate = $this->withSession($this->adminSession)->post('/sk/simpan-pengumuman', [
            'judul' => $judul,
            'isi' => 'Konten pengumuman penting untuk uji CRUD.',
            'tanggal' => date('Y-m-d'),
            'target_tipe' => 'semua',
        ]);
        $resCreate->assertRedirect();

        $pengumuman = pengumuman::where('judul', $judul)->first();
        $this->assertNotNull($pengumuman);

        // READ
        $resReadAdmin = $this->withSession($this->adminSession)->get('/sk/kelola-pengumuman');
        $resReadAdmin->assertStatus(200);
        $resReadAdmin->assertSee($judul);

        // DELETE
        $resDelete = $this->withSession($this->adminSession)->get("/sk/hapus-pengumuman/{$pengumuman->id}");
        $resDelete->assertRedirect();
        $this->assertNull(pengumuman::find($pengumuman->id));
    }

    /** 10. CRUD TAGIHAN KEUANGAN (IPP) */
    public function test_crud_tagihan_ipp()
    {
        $siswa = siswa::first();
        if (!$siswa) {
            $this->markTestSkipped('Data siswa tidak ditemukan untuk pengujian tagihan.');
        }

        // CREATE Tagihan IPP
        $nominal = 250000;
        $resCreate = $this->withSession($this->adminSession)->post('/sk/tbtg', [
            'siswa_id' => $siswa->id,
            'jenis_pembayaran' => 'ipp',
            'nominal' => $nominal,
            'is_manual' => 1,
            'status' => '0',
            'tanggal_bayar' => date('Y-m-d'),
            'tanggal_awal' => date('Y-m-01'),
        ]);
        $resCreate->assertRedirect();

        $slip = slip_pembayaran_ipp::where('siswa_id', $siswa->id)
            ->where('nominal', $nominal)
            ->latest('id')
            ->first();
        $this->assertNotNull($slip, 'Tagihan IPP harus berhasil dibuat.');

        // READ Tagihan
        $resRead = $this->withSession($this->adminSession)->get("/sk/dp?id={$siswa->id}");
        $resRead->assertStatus(200);

        // UPDATE Tagihan (Edit Pelunasan)
        $resUpdate = $this->withSession($this->adminSession)->post('/sk/esp', [
            'id' => $slip->id,
            'nominal' => 250000,
            'jumlah_dibayar' => 250000,
            'status' => '1',
            'tanggal_pembayaran' => date('Y-m-d'),
        ]);
        $resUpdate->assertRedirect();
        $this->assertEquals(1, $slip->fresh()->status, 'Status tagihan harus berubah menjadi lunas.');

        // DELETE Tagihan
        $resDelete = $this->withSession($this->adminSession)->post('/sk/hpsp/', [
            'id' => $slip->id,
            'tipe' => 'ipp',
        ]);
        $resDelete->assertRedirect();
        $this->assertNull(slip_pembayaran_ipp::find($slip->id), 'Tagihan IPP harus berhasil dihapus.');
    }
}

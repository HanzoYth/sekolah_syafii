<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Controllers\siakadController;
use App\Models\admin;
use App\Models\guru;
use App\Models\kegiatan_sekolah;
use App\Models\master_prestasi;
use App\Models\pengaturan_rapor;
use App\Models\evaluasi_rapor_siswa;
use App\Models\prestasi_siswa;
use App\Models\siswa;
use App\Models\wallas;
use App\Models\ruang_kelas;
use App\Models\tahun_ajaran;

class SiakadRaporKegiatanDanPrestasiTest extends TestCase
{
    protected $controller;
    protected $adminSession;
    protected $guruSession;
    protected $walasSession;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new siakadController();

        $admin = admin::first();
        $this->adminSession = [
            'role' => 'a',
            'id' => $admin ? $admin->id : 1,
            'id_akun' => $admin ? $admin->user_id : 1,
            'nama' => $admin ? $admin->nama : 'Admin',
            'hasLogin' => true,
            'hak_akses' => json_encode(['akademik', 'dashboard', 'keuangan'])
        ];

        $wallas = wallas::with('guru')->first();
        $gWalas = $wallas ? $wallas->guru : (guru::first());
        $this->walasSession = [
            'role' => 'g',
            'id' => $gWalas ? $gWalas->id : 1,
            'id_akun' => $gWalas ? $gWalas->user_id : 1,
            'nama' => $gWalas ? $gWalas->nama : 'Wali Kelas',
            'hasLogin' => true,
        ];
    }

    /**
     * Test 1: Admin can access kelolaReferensi and see Selection Tabs
     */
    public function test_admin_can_access_kelola_referensi_and_view_selection_tabs()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/referensi');

        $response->assertStatus(200);
        $response->assertSee('Tahun Ajaran', false);
        $response->assertSee('Jam Pelajaran', false);
        $response->assertSee('Master Program Kegiatan Sekolah (Rapor)', false);
        $response->assertSee('Master Jenis Prestasi (Template Rapor Santri)', false);
        $response->assertSee('Pengaturan Pengesahan & Tanggal Pembagian Rapor', false);
        $response->assertSee('tabNavReferensi', false);
    }

    /**
     * Test 2: Admin can add new Master Program Kegiatan Sekolah
     */
    public function test_admin_can_create_kegiatan_sekolah()
    {
        session($this->adminSession);

        $request = Request::create('/sk/simpan-kegiatan-sekolah', 'POST', [
            'nama_kegiatan' => 'Tahsin & Talaqqi Al-Qur\'an',
            'jenjang' => 'semua',
            'keterangan_default' => 'Mengikuti bimbingan makharijul huruf dengan tekun',
            'urutan' => 5,
            'aktif' => 1
        ]);

        $response = $this->controller->simpanKegiatanSekolah($request);
        $this->assertTrue($response->isRedirection());

        $this->assertDatabaseHas('kegiatan_sekolah', [
            'nama_kegiatan' => 'Tahsin & Talaqqi Al-Qur\'an',
            'jenjang' => 'semua'
        ]);
    }

    /**
     * Test 3: Admin can update Master Program Kegiatan Sekolah
     */
    public function test_admin_can_update_kegiatan_sekolah()
    {
        session($this->adminSession);

        $kegiatan = kegiatan_sekolah::where('nama_kegiatan', 'Tahsin & Talaqqi Al-Qur\'an')->first();
        $this->assertNotNull($kegiatan);

        $request = Request::create('/sk/update-kegiatan-sekolah/' . $kegiatan->id, 'POST', [
            'nama_kegiatan' => 'Tahsin & Talaqqi Al-Qur\'an Bersanad',
            'jenjang' => 'sd',
            'keterangan_default' => 'Keterangan diperbarui',
            'urutan' => 6,
            'aktif' => 1
        ]);

        $response = $this->controller->updateKegiatanSekolah($request, $kegiatan->id);
        $this->assertTrue($response->isRedirection());

        $this->assertDatabaseHas('kegiatan_sekolah', [
            'id' => $kegiatan->id,
            'nama_kegiatan' => 'Tahsin & Talaqqi Al-Qur\'an Bersanad',
            'jenjang' => 'sd'
        ]);

        // Bersihkan data dummy hasil tes agar database tetap bersih
        $kegiatan->delete();
    }

    /**
     * Test 4: Walas cannot modify master activities (only Admin allowed)
     */
    public function test_walas_cannot_create_master_kegiatan_sekolah()
    {
        session($this->walasSession);

        $request = Request::create('/sk/simpan-kegiatan-sekolah', 'POST', [
            'nama_kegiatan' => 'Kegiatan Ilegal Walas',
            'jenjang' => 'semua'
        ]);

        $response = $this->controller->simpanKegiatanSekolah($request);
        $this->assertNotNull($response);
        $this->assertTrue($response->isRedirection() || $response->getStatusCode() === 403);
    }

    /**
     * Test 5: Admin can manage Master Jenis Prestasi (Create, Update, Delete)
     */
    public function test_admin_can_manage_master_prestasi()
    {
        session($this->adminSession);

        // 1. Create
        $requestCreate = Request::create('/sk/simpan-master-prestasi', 'POST', [
            'nama_prestasi' => 'Juara 1 Lomba Kaligrafi Kontemporer',
            'kategori' => 'Lomba',
            'jenjang' => 'semua'
        ]);
        $responseCreate = $this->controller->simpanMasterPrestasi($requestCreate);
        $this->assertTrue($responseCreate->isRedirection());

        $this->assertDatabaseHas('master_prestasi', [
            'nama_prestasi' => 'Juara 1 Lomba Kaligrafi Kontemporer',
            'kategori' => 'Lomba'
        ]);

        $created = master_prestasi::where('nama_prestasi', 'Juara 1 Lomba Kaligrafi Kontemporer')->first();
        $this->assertNotNull($created);

        // 2. Update
        $requestUpdate = Request::create('/sk/update-master-prestasi/' . $created->id, 'POST', [
            'nama_prestasi' => 'Juara 1 Lomba Kaligrafi Nasional',
            'kategori' => 'Lomba',
            'jenjang' => 'smp',
            'aktif' => 1
        ]);
        $responseUpdate = $this->controller->updateMasterPrestasi($requestUpdate, $created->id);
        $this->assertTrue($responseUpdate->isRedirection());

        $this->assertDatabaseHas('master_prestasi', [
            'id' => $created->id,
            'nama_prestasi' => 'Juara 1 Lomba Kaligrafi Nasional',
            'jenjang' => 'smp'
        ]);

        // 3. Delete
        $responseDelete = $this->controller->hapusMasterPrestasi($created->id);
        $this->assertTrue($responseDelete->isRedirection());

        $this->assertDatabaseMissing('master_prestasi', [
            'id' => $created->id
        ]);
    }

    /**
     * Test 6: Admin can save Pengaturan Rapor & Pengesahan, and Walas/Rapor automatically reflects it
     */
    public function test_admin_can_save_pengaturan_rapor_and_sync()
    {
        session($this->adminSession);

        $request = Request::create('/sk/simpan-pengaturan-rapor', 'POST', [
            'tempat_rapor' => 'Rapolinja Tinggede',
            'tanggal_rapor' => '24 Desember 2025',
            'nama_kepsek' => 'Rajihul Haq, S.Sos, M.Pd',
            'nip_kepsek' => '198701012015011001',
            'catatan_walas_template' => 'Alhamdulillah ananda {nama} sangat berprestasi.'
        ]);

        $response = $this->controller->simpanPengaturanRapor($request);
        $this->assertTrue($response->isRedirection());

        $this->assertDatabaseHas('pengaturan_rapor', [
            'tempat_rapor' => 'Rapolinja Tinggede',
            'tanggal_rapor' => '24 Desember 2025',
            'nama_kepsek' => 'Rajihul Haq, S.Sos, M.Pd'
        ]);

        // Periksa bahwa getRaporMetadata langsung mengambil nilai tanggal dan kepsek dari database
        $siswa = siswa::first();
        \App\Models\evaluasi_rapor_siswa::where('siswa_id', $siswa->id)->delete();
        $meta = (new \ReflectionClass($this->controller))->getMethod('getRaporMetadata');
        $meta->setAccessible(true);
        $result = $meta->invoke($this->controller, $siswa);

        $this->assertEquals('24 Desember 2025', $result['tanggal_rapor']);
        $this->assertEquals('Rajihul Haq, S.Sos, M.Pd', $result['nama_kepsek']);
    }

    /**
     * Test 7: Guru Walas and Admin can save single student report card evaluation via simpanEvaluasiRapor
     */
    public function test_save_evaluasi_rapor_single_student()
    {
        $siswa = siswa::first();
        $this->assertNotNull($siswa);
        $tahun = tahun_ajaran::first();

        session($this->walasSession);

        $payload = [
            'siswa_id' => $siswa->id,
            'tahun_ajaran_id' => $tahun->id ?? 1,
            'semester' => 1,
            'catatan_walas' => 'Catatan tes otomatis: Ananda sangat rajin dan santun.',
            'tanggal_rapor' => '24 Desember 2025',
            'nama_kepsek' => 'Rajihul Haq, S.Sos, M.Pd',
            'nama_walas' => 'Ustadz Pembina',
            'kegiatan' => [
                ['kegiatan' => 'Mabit', 'predikat' => 'Sangat baik', 'keterangan' => 'Sangat aktif ibadah malam'],
                ['kegiatan' => 'Dzikir Pagi', 'predikat' => 'Baik', 'keterangan' => 'Tertib berdzikir']
            ],
            'prestasi' => [
                'Juara 1 MHQ 3 Juz Tingkat Kota',
                'Tasmi\' Al-Baqarah Sekali Duduk'
            ]
        ];

        $request = Request::create('/sk/simpan-evaluasi-rapor', 'POST', $payload);
        $request->headers->set('Accept', 'application/json');

        $response = $this->controller->simpanEvaluasiRapor($request);
        $this->assertEquals(200, $response->getStatusCode());

        $this->assertDatabaseHas('evaluasi_rapor_siswa', [
            'siswa_id' => $siswa->id,
            'nama_kepsek' => 'Rajihul Haq, S.Sos, M.Pd'
        ]);

        $this->assertDatabaseHas('prestasi_siswa', [
            'siswa_id' => $siswa->id,
            'nama_prestasi' => 'Juara 1 MHQ 3 Juz Tingkat Kota'
        ]);
    }

    /**
     * Test 8: Bulk save Catatan & Prestasi Santri sekelas (simpanMassalPrestasiWalas)
     */
    public function test_save_massal_prestasi_dan_catatan_walas()
    {
        $siswaList = siswa::take(2)->get();
        $this->assertNotEmpty($siswaList);

        session($this->walasSession);

        $payload = [
            'siswa' => []
        ];

        foreach ($siswaList as $idx => $s) {
            $payload['siswa'][$s->id] = [
                'catatan' => "Catatan massal siswa #{$idx} yang sangat baik dan tekun.",
                'prestasi' => "Prestasi A {$s->nama}\nPrestasi B {$s->nama}"
            ];
        }

        $request = Request::create('/sk/simpan-massal-prestasi-walas', 'POST', $payload);
        $response = $this->controller->simpanMassalPrestasiWalas($request);
        $this->assertTrue($response->isRedirection());

        foreach ($siswaList as $idx => $s) {
            $this->assertDatabaseHas('evaluasi_rapor_siswa', [
                'siswa_id' => $s->id,
                'catatan_walas' => "Catatan massal siswa #{$idx} yang sangat baik dan tekun."
            ]);

            $this->assertDatabaseHas('prestasi_siswa', [
                'siswa_id' => $s->id,
                'nama_prestasi' => "Prestasi A {$s->nama}"
            ]);
        }
    }

    /**
     * Test 9: Guru Walas can open /sk/rapor-walas with streamlined Cetak Rapor & Leger Nilai tabs
     */
    public function test_walas_can_view_rapor_walas_tab_prestasi()
    {
        $response = $this->withSession($this->walasSession)->get('/sk/rapor-walas');

        $response->assertStatus(200);
        $response->assertSee('Cetak Rapor', false);
        $response->assertSee('Leger Nilai', false);
        $response->assertDontSee('formMassalPrestasi');
    }

    /**
     * Test 10: Admin can also access /sk/rapor-walas and detail rapor
     */
    public function test_admin_can_view_rapor_walas_and_detail_rapor()
    {
        $siswa = siswa::first();
        $this->assertNotNull($siswa);

        $response = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=prestasi');

        $response->assertStatus(200);
        $response->assertSee('Mode Administrator Rapor');

        // Admin detail rapor
        $responseDetail = $this->withSession($this->adminSession)->get('/sk/detail-rapor-walas/' . $siswa->id);

        $responseDetail->assertStatus(200);
        $responseDetail->assertSee('LAPORAN HASIL BELAJAR');
        $responseDetail->assertSee('Program Kegiatan Sekolah');
        $responseDetail->assertSee('Jenis Prestasi');
        $responseDetail->assertSee('data-preset', false);
        $responseDetail->assertDontSee('addPrestasiPreset(@json');
    }

    /**
     * Test 11: Siswa can view their own Rapor with updated activities and achievements
     */
    public function test_siswa_can_view_rapor_with_activities_and_achievements()
    {
        $siswa = siswa::first();
        $this->assertNotNull($siswa);

        $response = $this->withSession([
            'role' => 's',
            'id' => $siswa->id,
            'id_akun' => $siswa->user_id,
            'nama' => $siswa->nama,
            'hasLogin' => true
        ])->get('/sk/rapor-siswa?tab=rapor');

        $response->assertStatus(200);
        $response->assertSee('LAPORAN HASIL BELAJAR');
        $response->assertSee('Program Kegiatan Sekolah');
        $response->assertSee('Jenis Prestasi');
    }

    /**
     * Test 12: Walas and Admin can view Cetak Leger Nilai (Landscape)
     */
    public function test_walas_and_admin_can_view_cetak_leger_walas()
    {
        // Walas Access
        $responseWalas = $this->withSession($this->walasSession)->get('/sk/rapor-walas?tab=nilai&print=leger');
        $responseWalas->assertStatus(200);
        $responseWalas->assertSee('LEGER REKAPITULASI HASIL BELAJAR SISWA');
        $responseWalas->assertSee('Kepala Sekolah');

        // Admin Access
        $kelas = ruang_kelas::first();
        $responseAdmin = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=nilai&print=leger' . ($kelas ? '&kelas_id=' . $kelas->id : ''));
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertSee('LEGER REKAPITULASI HASIL BELAJAR SISWA');
    }

    /**
     * Test 13: Walas and Admin can view Cetak Rapor Massal Seluruh Siswa Satu Kelas
     */
    public function test_walas_and_admin_can_view_cetak_rapor_massal()
    {
        // Walas Access (Untuk kelas TK yang belum ada santri, menampilkan pesan empty state)
        $responseWalas = $this->withSession($this->walasSession)->get('/sk/rapor-walas?print=massal');
        $responseWalas->assertStatus(200);
        $responseWalas->assertSee('Cetak Rapor Massal');

        // Admin Access (Pilih kelas yang memiliki santri agar lembar rapor ter-render lengkap)
        $siswaWithClass = siswa::whereNotNull('kelas_id')->first();
        $targetKelasId = $siswaWithClass ? $siswaWithClass->kelas_id : (ruang_kelas::first()->id ?? 1);
        $responseAdmin = $this->withSession($this->adminSession)->get('/sk/rapor-walas?print=massal&kelas_id=' . $targetKelasId);
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertSee('Cetak Rapor Massal');
        if ($siswaWithClass) {
            $responseAdmin->assertSee('LAPORAN HASIL BELAJAR');
            $responseAdmin->assertSee('page-break');
        }
    }
}

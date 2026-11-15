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
     * Test 1: Admin Data Referensi keeps Tahun Ajaran & Jam Pelajaran and redirects legacy Rapor tabs to /sk/rapor-walas
     */
    public function test_admin_can_access_kelola_referensi_and_view_selection_tabs()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/referensi');

        $response->assertStatus(200);
        $response->assertSee('Tahun Ajaran', false);
        $response->assertSee('Jam Pelajaran', false);
        $response->assertSee('tabNavReferensi', false);
        $response->assertDontSee('Master Program Kegiatan Sekolah (Rapor)', false);
        $response->assertDontSee('Master Jenis Prestasi', false);
        $response->assertDontSee('Pengaturan Pengesahan & Tanggal Pembagian Rapor', false);

        // Legacy query redirects cleanly to Manajemen Rapor Siswa
        $this->withSession($this->adminSession)->get('/sk/referensi?tab=pengesahan')
            ->assertRedirect('/sk/rapor-walas?tab=pengesahan');
        $this->withSession($this->adminSession)->get('/sk/referensi?tab=kegiatan')
            ->assertRedirect('/sk/rapor-walas?tab=kegiatan');
        $this->withSession($this->adminSession)->get('/sk/referensi?tab=prestasi')
            ->assertRedirect('/sk/rapor-walas?tab=template_prestasi');
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

    /**
     * Test 14: Admin Rapor Siswa (/sk/rapor-walas) hosts moved global Rapor tabs & Kepsek TTD upload while Guru stays clean
     */
    public function test_admin_kelola_referensi_renders_signature_upload_and_background_removal()
    {
        $refResponse = $this->withSession($this->adminSession)->get('/sk/referensi');
        $refResponse->assertStatus(200);
        $refResponse->assertDontSee('adminInputTtdKepsek', false);

        $response = $this->withSession($this->adminSession)->get('/sk/rapor-walas');
        $response->assertStatus(200);
        $response->assertSee('Rapor Siswa', false);
        $response->assertSee('Program Kegiatan Sekolah', false);
        $response->assertSee('Template Jenis Prestasi', false);
        $response->assertSee('Pengaturan Pengesahan', false);
        $response->assertSee('adminInputTtdKepsek', false);
        $response->assertDontSee('adminInputTtdWalas', false);
        $response->assertSee('Upload TTD Kepsek', false);
        $response->assertDontSee('Upload TTD Walas Default', false);
        $response->assertSee('Auto-Hapus Background Aktif', false);
        $response->assertSee('removeSignatureBackground', false);
        $response->assertSee('handleAdminSignatureUpload', false);
        $response->assertSee('formPengaturanRapor', false);
        $response->assertSee('addKegiatanModal', false);
        $response->assertSee('addPrestasiModal', false);

        // Guru Wali Kelas keeps focused Cetak Rapor view without Admin global tabs
        $guruResp = $this->withSession($this->walasSession)->get('/sk/rapor-walas');
        $guruResp->assertStatus(200);
        $guruResp->assertSee('Cetak Rapor', false);
        $guruResp->assertDontSee('formPengaturanRapor', false);
        $guruResp->assertDontSee('addKegiatanModal', false);
        $guruResp->assertDontSee('addPrestasiModal', false);
        $guruResp->assertDontSee('adminInputTtdKepsek', false);
    }

    /**
     * Test 15: Admin can save and clear Kepsek signature in simpanPengaturanRapor (non-admin blocked)
     */
    public function test_admin_can_save_and_clear_signatures_in_simpan_pengaturan_rapor()
    {
        $original = pengaturan_rapor::first();
        $snapshot = $original ? $original->only([
            'tempat_rapor', 'tanggal_rapor', 'nama_kepsek', 'nip_kepsek',
            'catatan_walas_template', 'ttd_kepsek'
        ]) : null;

        try {
            // Non-admin (Walas) must be rejected
            session($this->walasSession);
            $forbiddenReq = Request::create('/sk/simpan-pengaturan-rapor', 'POST', [
                'tempat_rapor' => 'Tinggede',
                'tanggal_rapor' => '20 Desember 2025',
                'nama_kepsek' => 'Test Illegal',
                'ttd_kepsek' => 'data:image/png;base64,ILLEGAL'
            ]);
            $forbiddenResp = $this->controller->simpanPengaturanRapor($forbiddenReq);
            $this->assertNotNull($forbiddenResp);
            $this->assertTrue($forbiddenResp->isRedirection() || $forbiddenResp->getStatusCode() === 403);

            // Admin saves Kepsek signature
            session($this->adminSession);
            $dummyKepsek = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';

            $saveReq = Request::create('/sk/simpan-pengaturan-rapor', 'POST', [
                'tempat_rapor' => $snapshot['tempat_rapor'] ?? 'Tinggede',
                'tanggal_rapor' => $snapshot['tanggal_rapor'] ?? '20 Desember 2025',
                'nama_kepsek' => $snapshot['nama_kepsek'] ?? 'Rajihul Haq, S.Sos',
                'nip_kepsek' => $snapshot['nip_kepsek'] ?? '-',
                'catatan_walas_template' => $snapshot['catatan_walas_template'] ?? '',
                'ttd_kepsek' => $dummyKepsek,
            ]);

            $saveResp = $this->controller->simpanPengaturanRapor($saveReq);
            $this->assertTrue($saveResp->isRedirection());

            $saved = pengaturan_rapor::first();
            $this->assertNotNull($saved);
            $this->assertEquals($dummyKepsek, $saved->ttd_kepsek);

            // Metadata rapor siswa otomatis mewarisi TTD Kepsek dari pengaturan_rapor
            $siswa = siswa::first();
            $this->assertNotNull($siswa);
            $metaMethod = (new \ReflectionClass($this->controller))->getMethod('getRaporMetadata');
            $metaMethod->setAccessible(true);
            $metaResult = $metaMethod->invoke($this->controller, $siswa);
            $this->assertEquals($dummyKepsek, $metaResult['ttd_kepsek']);

            // Admin clears Kepsek signature by passing empty string
            $clearReq = Request::create('/sk/simpan-pengaturan-rapor', 'POST', [
                'tempat_rapor' => $saved->tempat_rapor,
                'tanggal_rapor' => $saved->tanggal_rapor,
                'nama_kepsek' => $saved->nama_kepsek,
                'nip_kepsek' => $saved->nip_kepsek ?? '-',
                'catatan_walas_template' => $saved->catatan_walas_template ?? '',
                'ttd_kepsek' => '',
            ]);

            $clearResp = $this->controller->simpanPengaturanRapor($clearReq);
            $this->assertTrue($clearResp->isRedirection());

            $cleared = pengaturan_rapor::first();
            $this->assertNull($cleared->ttd_kepsek);
        } finally {
            if ($snapshot !== null && pengaturan_rapor::first()) {
                pengaturan_rapor::first()->update($snapshot);
            } elseif ($snapshot === null && pengaturan_rapor::first()) {
                pengaturan_rapor::first()->delete();
            }
        }
    }

    /**
     * Test 16: /sk/rapor-walas has class Walas TTD upload & read-only Kepsek preview; detailRaporWalas has no per-student upload
     */
    public function test_rapor_walas_has_class_upload_and_detail_rapor_is_preview_only()
    {
        $responseWalas = $this->withSession($this->walasSession)->get('/sk/rapor-walas');
        $responseWalas->assertStatus(200);
        $responseWalas->assertSee('Upload TTD Wali Kelas', false);
        $responseWalas->assertSee('handleClassWalasSignatureUpload', false);
        $responseWalas->assertSee('removeSignatureBackground', false);
        $responseWalas->assertSee('Pratinjau resmi (hanya Admin yang dapat mengubah TTD Kepala Sekolah)', false);
        $responseWalas->assertDontSee('Upload TTD Kepsek', false);

        // Admin on /sk/rapor-walas sees Rapor Siswa sidebar item & shortcut to Pengesahan tab
        $siswaWithClass = siswa::whereNotNull('kelas_id')->first();
        $targetKelasId = $siswaWithClass ? $siswaWithClass->kelas_id : (ruang_kelas::first()->id ?? 1);
        $responseAdmin = $this->withSession($this->adminSession)->get('/sk/rapor-walas?kelas_id=' . $targetKelasId);
        $responseAdmin->assertStatus(200);
        $responseAdmin->assertSee('Rapor Siswa', false);
        $responseAdmin->assertSee('Atur TTD Kepsek', false);
        $responseAdmin->assertDontSee('Ubah di Referensi', false);

        // When Admin opens a global tab, the per-class switcher starts hidden on SSR
        $responseGlobalTab = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=pengesahan');
        $responseGlobalTab->assertStatus(200);
        $responseGlobalTab->assertSee('Pengaturan Global Sekolah', false);
        $responseGlobalTab->assertSee('id="adminClassSwitcherWrapper" class="hidden', false);

        // Detail rapor per siswa tidak lagi punya form upload per siswa
        if ($siswaWithClass) {
            $responseDetail = $this->withSession($this->adminSession)->get('/sk/detail-rapor-walas/' . $siswaWithClass->id);
            $responseDetail->assertStatus(200);
            $responseDetail->assertSee('Pratinjau Tanda Tangan Pengesahan', false);
            $responseDetail->assertSee('Atur TTD Kelas di Rapor Siswa', false);
            $responseDetail->assertSee('Rapor Siswa &rarr; Pengesahan', false);
            $responseDetail->assertDontSee('fileTtdWalas', false);
            $responseDetail->assertDontSee('fileTtdKepsek', false);
        }
    }

    /**
     * Test 17: Walas and Admin can save/clear class TTD Walas on wallas table and propagate to all students in class
     */
    public function test_walas_and_admin_can_save_class_ttd_walas_and_sync_to_students()
    {
        $wallas = wallas::first();
        $this->assertNotNull($wallas);
        $siswaInClass = siswa::where('kelas_id', $wallas->kelas_id)->first();
        $otherKelas = wallas::where('kelas_id', '!=', $wallas->kelas_id)->first();

        $originalTtd = $wallas->ttd_walas;
        $gWalas = guru::find($wallas->guru_id);
        $ownerSession = [
            'role' => 'g',
            'id' => $gWalas->id,
            'id_akun' => $gWalas->user_id,
            'nama' => $gWalas->nama,
            'hasLogin' => true,
        ];

        try {
            // 1. Walas tidak boleh memanipulasi TTD kelas lain
            if ($otherKelas) {
                session($ownerSession);
                $spoofReq = Request::create('/sk/simpan-massal-prestasi-walas', 'POST', [
                    'action' => 'simpan_ttd_walas',
                    'kelas_id' => $otherKelas->kelas_id,
                    'ttd_walas' => 'data:image/png;base64,SPOOF'
                ]);
                $spoofReq->headers->set('Accept', 'application/json');
                $spoofResp = $this->controller->simpanMassalPrestasiWalas($spoofReq);
                $this->assertEquals(403, $spoofResp->getStatusCode());
            }

            // 2. Walas menyimpan TTD kelasnya sendiri
            session($ownerSession);
            $dummyWalas = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=';
            $saveReq = Request::create('/sk/simpan-massal-prestasi-walas', 'POST', [
                'action' => 'simpan_ttd_walas',
                'kelas_id' => $wallas->kelas_id,
                'ttd_walas' => $dummyWalas
            ]);
            $saveReq->headers->set('Accept', 'application/json');
            $saveResp = $this->controller->simpanMassalPrestasiWalas($saveReq);
            $this->assertEquals(200, $saveResp->getStatusCode());

            $wallas->refresh();
            $this->assertEquals($dummyWalas, $wallas->ttd_walas);

            if ($siswaInClass) {
                $metaMethod = (new \ReflectionClass($this->controller))->getMethod('getRaporMetadata');
                $metaMethod->setAccessible(true);
                $metaResult = $metaMethod->invoke($this->controller, $siswaInClass);
                $this->assertEquals($dummyWalas, $metaResult['ttd_walas']);
            }

            // 3. Admin membersihkan TTD wali kelas tersebut lewat kelas_id
            session($this->adminSession);
            $clearReq = Request::create('/sk/simpan-massal-prestasi-walas', 'POST', [
                'action' => 'simpan_ttd_walas',
                'kelas_id' => $wallas->kelas_id,
                'ttd_walas' => ''
            ]);
            $clearReq->headers->set('Accept', 'application/json');
            $clearResp = $this->controller->simpanMassalPrestasiWalas($clearReq);
            $this->assertEquals(200, $clearResp->getStatusCode());

            $wallas->refresh();
            $this->assertNull($wallas->ttd_walas);
        } finally {
            $wallas->update(['ttd_walas' => $originalTtd]);
        }
    }

    /**
     * Test 18: Admin Leger Nilai (/sk/rapor-walas?tab=nilai) renders read-only monitoring & class switcher while Guru keeps Edit Nilai
     */
    public function test_admin_leger_nilai_is_read_only_monitoring_with_class_switcher()
    {
        $targetKelasId = ruang_kelas::first()->id ?? 1;

        $respAdmin = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=nilai&kelas_id=' . $targetKelasId);
        $respAdmin->assertStatus(200);
        $respAdmin->assertSee('Monitoring Leger Nilai Kelas', false);
        $respAdmin->assertSee('Mode Monitoring Leger Nilai Admin', false);
        $respAdmin->assertSee('selectKelasAdminLeger', false);
        $respAdmin->assertSee('Cetak Leger Nilai (Landscape)', false);
        $respAdmin->assertSee('Status Monitoring', false);
        $respAdmin->assertDontSee('/sk/input-nilai-detail/', false);
        $respAdmin->assertDontSee('Akses Wali Kelas', false);

        // Pastikan Print Leger juga bisa diakses Admin untuk kelas terpilih
        $respPrint = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=nilai&print=leger&kelas_id=' . $targetKelasId);
        $respPrint->assertStatus(200);
        $respPrint->assertSee('Dokumen Leger Nilai Kelas', false);

        // Guru Wali Kelas tetap melihat mode Manajemen Nilai Kelas & tombol Aksi Wali Kelas
        $respWalas = $this->withSession($this->walasSession)->get('/sk/rapor-walas?tab=nilai');
        $respWalas->assertStatus(200);
        $respWalas->assertSee('Manajemen Nilai Kelas', false);
        $respWalas->assertSee('Akses Wali Kelas', false);
        $respWalas->assertSee('Aksi Wali Kelas', false);
        $respWalas->assertDontSee('Mode Monitoring Leger Nilai Admin', false);
        $respWalas->assertDontSee('selectKelasAdminLeger', false);
    }

    /**
     * Test 19: Exclusive Top 1-3 dynamic ranking badges, podium, and print leger badges render correctly
     */
    public function test_exclusive_top3_ranking_podium_and_dynamic_badges_render_for_ranked_class()
    {
        $rankedWallas = wallas::with('ruangKelas')
            ->get()
            ->first(function ($w) {
                $siswaIds = siswa::where('kelas_id', $w->kelas_id)->pluck('id');
                return $siswaIds->count() >= 3 && \App\Models\nilai::whereIn('siswa_id', $siswaIds)->count() > 0;
            });

        if (!$rankedWallas) {
            $this->markTestSkipped('Belum ada kelas dengan minimal 3 siswa bernilai untuk pengujian ranking Juara 1-3.');
        }

        // 1. Leger Nilai View: Dynamic Rank Badges 1-3, row highlights, and no standalone podium card
        $respLeger = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=nilai&kelas_id=' . $rankedWallas->kelas_id);
        $respLeger->assertStatus(200);
        $respLeger->assertDontSee('siakad-podium-shell', false);
        $respLeger->assertSee('siakad-rank-crest-crown', false);
        $respLeger->assertSee('siakad-rank-1', false);
        $respLeger->assertSee('siakad-rank-2', false);
        $respLeger->assertSee('siakad-rank-3', false);
        $respLeger->assertSee('siakad-rank-row-1', false);
        $respLeger->assertSee('Urutkan Leger Siswa', false);

        // 2. Rapor Walas View: Compact Dynamic Badges & row highlights
        $respRapor = $this->withSession($this->adminSession)->get('/sk/rapor-walas?kelas_id=' . $rankedWallas->kelas_id);
        $respRapor->assertStatus(200);
        $respRapor->assertDontSee('Peringkat Eksklusif Kelas', false);
        $respRapor->assertSee('siakad-rank-badge--compact', false);
        $respRapor->assertSee('siakad-rank-1', false);
        $respRapor->assertSee('siakad-rank-2', false);
        $respRapor->assertSee('siakad-rank-3', false);
        $respRapor->assertSee('Urutkan Daftar Rapor Siswa', false);

        // 3. Cetak Leger View: Print-safe Top-3 Badges
        $respPrint = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=nilai&print=leger&kelas_id=' . $rankedWallas->kelas_id);
        $respPrint->assertStatus(200);
        $respPrint->assertSee('siakad-rank-print-1', false);
        $respPrint->assertSee('siakad-rank-print-2', false);
        $respPrint->assertSee('siakad-rank-print-3', false);
    }

    /**
     * Test 20: Siswa final ranking & Top 3 strip display consistently when class grades are 100% complete
     */
    public function test_siswa_displays_final_ranking_and_top3_when_all_subjects_are_complete()
    {
        $gian = siswa::with('kelas')->find(2);
        if (!$gian || (int) $gian->kelas_id !== 6) {
            $this->markTestSkipped('Demo siswa Moh Gian Saputra pada SD Kelas 2B belum terseed.');
        }

        $siswaSession = [
            'role' => 's',
            'id' => $gian->id,
            'id_akun' => $gian->user_id,
            'nama' => $gian->nama,
            'hasLogin' => true,
        ];

        // 1. Dashboard Siswa menampilkan peringkat final siswa & Top 3 Juara Final Kelas
        $respDash = $this->withSession($siswaSession)->get('/sk/dbs');
        $respDash->assertStatus(200);
        $respDash->assertSee('siakad-rank-badge--compact', false);
        $respDash->assertSee('siakad-rank-1', false);
        $respDash->assertSee('Peringkat #1 dari 5 siswa', false);
        $respDash->assertSee('Top 3 Juara Final Kelas', false);
        $respDash->assertSee('Aisyah Humaira Putri', false);
        $respDash->assertSee('Muhammad Fatih Az-Zuhri', false);
        $respDash->assertDontSee('Fathimah Zahra Al-Munawwarah', false);
        $respDash->assertDontSee('Bilal Al-Habasyi', false);

        // 2. Rapor Siswa Tab Rincian Nilai menampilkan peringkat & Top 3 konsisten dengan Leger Walas
        $respRaporNilai = $this->withSession($siswaSession)->get('/sk/rapor-siswa');
        $respRaporNilai->assertStatus(200);
        $respRaporNilai->assertSee('Peringkat #1 dari 5 siswa', false);
        $respRaporNilai->assertSee('Top 3 Juara Final Kelas', false);
        $respRaporNilai->assertSee('siakad-rank-1', false);

        // 3. Tab Lembar Rapor resmi tetap bersih tanpa blok Top 3 Juara Kelas
        $respLembar = $this->withSession($siswaSession)->get('/sk/rapor-siswa?tab=rapor');
        $respLembar->assertStatus(200);
        $respLembar->assertDontSee('Top 3 Juara Final Kelas', false);

        // 4. Konsisten dengan Leger Walas kelas SD Kelas 2B
        $respWalasLeger = $this->withSession($this->adminSession)->get('/sk/rapor-walas?tab=nilai&kelas_id=6');
        $respWalasLeger->assertStatus(200);
        $respWalasLeger->assertSee('Moh Gian Saputra', false);
        $respWalasLeger->assertSee('siakad-rank-row-1', false);
    }

    /**
     * Test 21: Siswa ranking is strictly hidden when any class subject or component is incomplete
     */
    public function test_siswa_hides_partial_ranking_when_any_class_subject_component_is_incomplete()
    {
        $gian = siswa::find(2);
        if (!$gian || (int) $gian->kelas_id !== 6) {
            $this->markTestSkipped('Demo siswa Moh Gian Saputra pada SD Kelas 2B belum terseed.');
        }

        $siswaSession = [
            'role' => 's',
            'id' => $gian->id,
            'id_akun' => $gian->user_id,
            'nama' => $gian->nama,
            'hasLogin' => true,
        ];

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Hilangkan 1 komponen nilai teman sekelas sehingga kelengkapan menjadi 3/4 mapel lengkap
            \App\Models\nilai::where('siswa_id', 7)
                ->where('mapel_id', 48)
                ->where('jenis_penilaian_id', 4)
                ->delete();

            $respDash = $this->withSession($siswaSession)->get('/sk/dbs');
            $respDash->assertStatus(200);
            $respDash->assertDontSee('Top 3 Juara Final Kelas', false);
            $respDash->assertDontSee('data-rank-tier=', false);
            $respDash->assertDontSee('Peringkat #', false);
            $respDash->assertSee('Menunggu nilai lengkap (3/4 mapel)', false);

            $respRapor = $this->withSession($siswaSession)->get('/sk/rapor-siswa');
            $respRapor->assertStatus(200);
            $respRapor->assertDontSee('Top 3 Juara Final Kelas', false);
            $respRapor->assertDontSee('data-rank-tier=', false);
            $respRapor->assertDontSee('Peringkat #', false);
            $respRapor->assertSee('Peringkat Final Kelas Menunggu Kelengkapan Nilai (3/4 Mapel Lengkap)', false);
        } finally {
            \Illuminate\Support\Facades\DB::rollBack();
        }
    }

    /**
     * Test 22: Siswa portal omits teacher attendance status while preserving schedule and lesson materials
     */
    public function test_siswa_pages_omit_teacher_attendance_status()
    {
        $gian = siswa::find(2);
        if (!$gian || (int) $gian->kelas_id !== 6) {
            $this->markTestSkipped('Demo siswa Moh Gian Saputra pada SD Kelas 2B belum terseed.');
        }

        $siswaSession = [
            'role' => 's',
            'id' => $gian->id,
            'id_akun' => $gian->user_id,
            'nama' => $gian->nama,
            'hasLogin' => true,
        ];

        $respDash = $this->withSession($siswaSession)->get('/sk/dbs');
        $respDash->assertStatus(200);
        $respDash->assertDontSee('Guru Masuk', false);

        $respJadwal = $this->withSession($siswaSession)->get('/sk/jadwal-siswa');
        $respJadwal->assertStatus(200);
        $respJadwal->assertDontSee('Status Guru', false);
        $respJadwal->assertDontSee('Status kehadiran guru', false);
        $respJadwal->assertSee('Materi Hari Ini', false);
        $respJadwal->assertSee('Presensi Siswa', false);

        $respPengumuman = $this->withSession($siswaSession)->get('/sk/ps');
        $respPengumuman->assertStatus(200);
        $respPengumuman->assertDontSee('kehadiran guru di kelas', false);
    }

    /**
     * Test 23: SIAKAD topbar and Siswa pages format dates using Indonesian day and month names
     */
    public function test_siakad_dates_render_month_and_day_names_in_indonesian()
    {
        $gian = siswa::find(2);
        if (!$gian || (int) $gian->kelas_id !== 6) {
            $this->markTestSkipped('Demo siswa Moh Gian Saputra pada SD Kelas 2B belum terseed.');
        }

        $siswaSession = [
            'role' => 's',
            'id' => $gian->id,
            'id_akun' => $gian->user_id,
            'nama' => $gian->nama,
            'hasLogin' => true,
        ];

        \Carbon\Carbon::setTestNow(\Carbon\Carbon::create(2026, 12, 12, 9, 0, 0));
        try {
            $respDash = $this->withSession($siswaSession)->get('/sk/dbs');
            $respDash->assertStatus(200);
            $respDash->assertSee('Sabtu, 12 Desember 2026', false);
            $respDash->assertDontSee('Saturday', false);
            $respDash->assertDontSee('December', false);

            $respAdmin = $this->withSession($this->adminSession)->get('/sk/rapor-walas');
            $respAdmin->assertStatus(200);
            $respAdmin->assertSee('Sabtu, 12 Desember 2026', false);
        } finally {
            \Carbon\Carbon::setTestNow();
        }
    }

    /**
     * Test 24: Student Rapor displays official database achievements and strictly protects against stale 'test' localStorage drafts
     */
    public function test_student_rapor_displays_official_prestasi_and_protects_against_test_drafts()
    {
        $gian = siswa::where('nama', 'like', '%Moh Gian Saputra%')->first();
        if (!$gian) {
            $this->markTestSkipped('Demo siswa Moh Gian Saputra pada SD Kelas 2B belum terseed.');
        }

        $siswaSession = [
            'role' => 's',
            'id' => $gian->id,
            'id_akun' => $gian->user_id,
            'nama' => $gian->nama,
            'hasLogin' => true,
        ];

        // 1. Periksa tampilan resmi rapor siswa
        $responseSiswa = $this->withSession($siswaSession)->get('/sk/rapor-siswa?tab=rapor');
        $responseSiswa->assertStatus(200);

        // Prestasi resmi dari database harus tampil
        $dbPrestasi = prestasi_siswa::where('siswa_id', $gian->id)->pluck('nama_prestasi')->toArray();
        $this->assertNotEmpty($dbPrestasi);
        foreach ($dbPrestasi as $namaPrestasi) {
            $responseSiswa->assertSee(e($namaPrestasi), false);
        }

        // Baris dummy 'test' TIDAK boleh muncul
        $responseSiswa->assertDontSee('>test<', false);
        $responseSiswa->assertDontSee('>Test<', false);

        // Client-side script harus memiliki proteksi hasDbPrestasi dan pembersih 'test'
        $responseSiswa->assertSee('const hasDbPrestasi = true;', false);
        $responseSiswa->assertSee("p.trim().toLowerCase() !== 'test'", false);
        $responseSiswa->assertSee('delete data.prestasi;', false);

        // 2. Periksa tampilan detail rapor pada guru/walas Gian & admin
        $gianWallas = wallas::with('guru')->where('kelas_id', $gian->kelas_id)->first();
        $walasGianSession = $gianWallas && $gianWallas->guru ? [
            'role' => 'g',
            'id' => $gianWallas->guru->id,
            'id_akun' => $gianWallas->guru->user_id,
            'nama' => $gianWallas->guru->nama,
            'hasLogin' => true,
        ] : $this->adminSession;

        $responseWalas = $this->withSession($walasGianSession)->get('/sk/detail-rapor-walas/' . $gian->id);
        $responseWalas->assertStatus(200);
        foreach ($dbPrestasi as $namaPrestasi) {
            $responseWalas->assertSee(e($namaPrestasi), false);
        }
        $responseWalas->assertDontSee('>test<', false);
        $responseWalas->assertSee("p.trim().toLowerCase() !== 'test'", false);
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\admin;
use App\Models\guru;
use App\Models\siswa;
use App\Models\kelas;
use App\Models\ruang_kelas;
use App\Models\jam_pelajaran;
use App\Models\mata_pelajaran;
use App\Models\jadwal_pelajaran;
use App\Models\guru_pengganti;
use App\Models\absensi_mengajar_guru;
use App\Models\absensi_siswa;
use Carbon\Carbon;

class SiakadAbsensiDanInvalTest extends TestCase
{
    private guru $guruA;
    private guru $guruB;
    private array $sessionGuruA;
    private array $sessionGuruB;
    private jadwal_pelajaran $jadwalA;
    private ruang_kelas $ruangKelas;
    private string $testTanggal;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Siapkan 2 guru yang berbeda
        $gurus = guru::take(2)->get();
        if ($gurus->count() < 2) {
            $this->markTestSkipped('Dibutuhkan minimal 2 data guru di database untuk pengujian sistem guru pengganti.');
        }

        $this->guruA = $gurus[0];
        $this->guruB = $gurus[1];

        // Pastikan keduanya memiliki flag guru_tetap agar lolos guard isPengajar
        $this->guruA->guru_tetap = 1;
        $this->guruA->save();
        $this->guruB->guru_tetap = 1;
        $this->guruB->save();

        $this->sessionGuruA = [
            'role' => 'g',
            'id' => $this->guruA->id,
            'id_akun' => $this->guruA->user_id,
            'nama' => $this->guruA->nama,
            'hasLogin' => true,
        ];

        $this->sessionGuruB = [
            'role' => 'g',
            'id' => $this->guruB->id,
            'id_akun' => $this->guruB->user_id,
            'nama' => $this->guruB->nama,
            'hasLogin' => true,
        ];

        // 2. Siapkan ruang kelas dan pastikan ada siswa di dalamnya
        $this->ruangKelas = ruang_kelas::firstOrCreate(
            ['nama_ruang' => 'Kelas Uji Inval']
        );

        $kelas = kelas::firstOrCreate(
            ['nama_kelas' => 'Kelas Uji Inval']
        );

        // Pastikan ada minimal 2 siswa di kelas ini
        $existingSiswa = siswa::where('kelas_id', $this->ruangKelas->id)->count();
        if ($existingSiswa < 2) {
            // Tempatkan beberapa siswa ke kelas ini untuk keperluan pengujian
            $siswas = siswa::take(2)->get();
            foreach ($siswas as $s) {
                $s->kelas_id = $this->ruangKelas->id;
                $s->save();
            }
        }

        // 3. Siapkan jam pelajaran
        $jam = jam_pelajaran::firstOrCreate(
            ['jam_ke' => 99],
            [
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '09:30:00',
                'durasi_per_jp' => 45,
                'jumlah_jp' => 2,
            ]
        );

        // 4. Siapkan mata pelajaran
        $mapel = mata_pelajaran::firstOrCreate(
            ['nama_mapel' => 'Biologi Eksperimen'],
            [
                'kode_mapel' => 'BIO-EXP',
                'kkm' => 75,
            ]
        );

        // 5. Gunakan tanggal tetap (hari Senin) agar penentuan hari konsisten
        // Senin, 2026-11-02
        $this->testTanggal = '2026-11-02';

        // 6. Buat atau update jadwal_pelajaran milik Guru A di hari Senin
        $tahunAjaranId = \App\Models\tahun_ajaran::first()?->id ?? 3;
        $this->jadwalA = jadwal_pelajaran::firstOrCreate(
            [
                'guru_id' => $this->guruA->id,
                'hari' => 'senin',
                'jam_pelajaran_id' => $jam->id,
            ],
            [
                'mapel_id' => $mapel->id,
                'kelas_id' => $kelas->id,
                'tahun_ajaran_id' => $tahunAjaranId,
            ]
        );

        // Bersihkan data pengganti dan absensi pengujian sebelumnya untuk sesi ini
        guru_pengganti::where('jadwal_pelajaran_id', $this->jadwalA->id)
            ->where('tanggal', $this->testTanggal)
            ->delete();

        absensi_mengajar_guru::where('jadwal_pelajaran_id', $this->jadwalA->id)
            ->where('tanggal', $this->testTanggal)
            ->delete();

        absensi_siswa::where('jadwal_pelajaran_id', $this->jadwalA->id)
            ->where('tanggal', $this->testTanggal)
            ->delete();
    }

    // =========================================================================
    // BAGIAN 1: PENGUJIAN FITUR ABSENSI MATA PELAJARAN (GURU REGULER)
    // =========================================================================

    /**
     * 1. Guru Pengajar dapat membuka halaman Absensi Mapel pada tanggal jadwalnya
     */
    public function test_guru_can_view_absensi_mapel_page()
    {
        $response = $this->withSession($this->sessionGuruA)
            ->get("/sk/ass?tanggal={$this->testTanggal}&jadwal_id={$this->jadwalA->id}");

        $response->assertStatus(200);
        $response->assertSee('Absensi Mata Pelajaran', false);
        $response->assertSee('Biologi Eksperimen', false);
        $response->assertSee('Tahap 1: Presensi Masuk Kelas', false);
    }

    /**
     * 2. Validasi pencegahan: Absensi di tanggal masa depan harus ditolak
     */
    public function test_guru_cannot_do_absensi_in_future_date()
    {
        $futureDate = Carbon::tomorrow()->toDateString();

        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $futureDate,
                'aksi' => 'presensi_guru',
                'materi' => 'Materi Masa Depan',
            ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('absensi_mengajar_guru', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'tanggal' => $futureDate,
        ]);
    }

    /**
     * 3. Guru wajib melakukan Presensi Masuk (Tahap 1) sebelum bisa mengisi Absensi Siswa
     */
    public function test_guru_cannot_submit_student_attendance_before_presensi_masuk()
    {
        // Pastikan belum ada presensi guru
        $this->assertDatabaseMissing('absensi_mengajar_guru', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'tanggal' => $this->testTanggal,
        ]);

        $siswas = siswa::where('kelas_id', $this->ruangKelas->id)->take(2)->get();
        $absensiData = [];
        foreach ($siswas as $s) {
            $absensiData[$s->id] = ['status' => 'h', 'keterangan' => 'Hadir'];
        }

        // Coba langsung isi siswa tanpa presensi guru
        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'absensi_siswa',
                'absensi' => $absensiData,
            ]);

        $response->assertSessionHas('error');
        // Absensi siswa tidak boleh tersimpan
        $this->assertDatabaseMissing('absensi_siswa', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'tanggal' => $this->testTanggal,
        ]);
    }

    /**
     * 4. Guru berhasil melakukan Presensi Masuk Kelas dan mencatat Jurnal Materi (Tahap 1)
     */
    public function test_guru_presensi_masuk_and_jurnal_saves_successfully()
    {
        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'presensi_guru',
                'materi' => 'Pengenalan Struktur Sel Hewan dan Tumbuhan',
                'catatan' => 'Siswa sangat antusias saat demonstrasi mikroskop.',
            ]);

        $response->assertSessionHas('success');

        $this->assertDatabaseHas('absensi_mengajar_guru', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_id' => $this->guruA->id,
            'tanggal' => $this->testTanggal,
            'materi' => 'Pengenalan Struktur Sel Hewan dan Tumbuhan',
            'catatan' => 'Siswa sangat antusias saat demonstrasi mikroskop.',
        ]);
    }

    /**
     * 5. Guru berhasil mengisi dan menyimpan Presensi Siswa (Tahap 2) dengan berbagai status
     */
    public function test_guru_presensi_siswa_saves_successfully_with_various_statuses()
    {
        // 1. Jalankan tahap 1 terlebih dahulu
        $this->withSession($this->sessionGuruA)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'presensi_guru',
                'materi' => 'Materi Pembelajaran Genetika',
            ]);

        // 2. Ambil 2 siswa dari kelas
        $siswas = siswa::where('kelas_id', $this->ruangKelas->id)->take(2)->get();
        $this->assertGreaterThanOrEqual(2, $siswas->count(), 'Harus ada minimal 2 siswa.');

        $absensiPayload = [
            $siswas[0]->id => ['status' => 'h', 'keterangan' => 'Hadir tepat waktu'],
            $siswas[1]->id => ['status' => 's', 'keterangan' => 'Demam, surat dokter terlampir'],
        ];

        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'absensi_siswa',
                'absensi' => $absensiPayload,
            ]);

        $response->assertSessionHas('success');

        // Verifikasi tersimpan di database
        $this->assertDatabaseHas('absensi_siswa', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'siswa_id' => $siswas[0]->id,
            'tanggal' => $this->testTanggal,
            'status' => 'h',
            'keterangan' => 'Hadir tepat waktu',
        ]);

        $this->assertDatabaseHas('absensi_siswa', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'siswa_id' => $siswas[1]->id,
            'tanggal' => $this->testTanggal,
            'status' => 's',
            'keterangan' => 'Demam, surat dokter terlampir',
        ]);
    }

    /**
     * 6. Guru lain yang tidak berhak dilarang melakukan absensi pada jadwal guru A
     */
    public function test_unauthorized_teacher_cannot_submit_absensi_for_other_teacher()
    {
        $response = $this->withSession($this->sessionGuruB)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'presensi_guru',
                'materi' => 'Materi Ilegal',
            ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('absensi_mengajar_guru', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_id' => $this->guruB->id,
        ]);
    }

    // =========================================================================
    // BAGIAN 2: PENGUJIAN SISTEM GURU PENGGANTI (INVAL / JADWAL KOSONG)
    // =========================================================================

    /**
     * 7. Guru A dapat menandai jadwal mengajarnya sebagai KOSONG (Izin / Berhalangan)
     */
    public function test_guru_a_can_mark_schedule_as_empty()
    {
        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/tandai-jadwal-kosong', [
                'jadwal_pelajaran_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'alasan_izin' => 'Izin menghadiri bimbingan teknis kurikulum',
                'keterangan_tugas' => 'Mengerjakan LKS Biologi Halaman 45-50',
            ]);

        $response->assertSessionHas('success');

        // Verifikasi di database tabel guru_pengganti
        $this->assertDatabaseHas('guru_pengganti', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'tanggal' => $this->testTanggal,
            'status' => 'kosong',
            'alasan_izin' => 'Izin menghadiri bimbingan teknis kurikulum',
            'keterangan_tugas' => 'Mengerjakan LKS Biologi Halaman 45-50',
            'guru_pengganti_id' => null,
        ]);
    }

    /**
     * 8. Informasi jadwal kosong muncul di dashboard guru lain (Guru B)
     */
    public function test_empty_schedule_appears_on_guru_b_dashboard()
    {
        guru_pengganti::where('jadwal_pelajaran_id', $this->jadwalA->id)
            ->where('tanggal', Carbon::today()->toDateString())
            ->delete();

        // Tandai kosong
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'tanggal' => Carbon::today()->toDateString(), // Hari ini agar muncul di dashboard
            'status' => 'kosong',
            'alasan_izin' => 'Sakit mendadak',
            'keterangan_tugas' => 'Membaca Bab 3',
        ]);

        $response = $this->withSession($this->sessionGuruB)->get('/sk/dsg');

        $response->assertStatus(200);
        $response->assertSee('Sistem Guru Pengganti (Inval)', false);
        $response->assertSee('Biologi Eksperimen', false);
        $response->assertSee('Ambil Jadwal Pengganti', false);
    }

    /**
     * 9. Validasi: Guru A dilarang mengambil jadwal kosong miliknya sendiri
     */
    public function test_guru_a_cannot_claim_own_schedule()
    {
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'tanggal' => $this->testTanggal,
            'status' => 'kosong',
            'alasan_izin' => 'Izin',
        ]);

        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/ambil-jadwal-pengganti', [
                'id' => $slot->id,
            ]);

        $response->assertSessionHas('error');
        $this->assertEquals('kosong', $slot->fresh()->status);
        $this->assertNull($slot->fresh()->guru_pengganti_id);
    }

    /**
     * 10. Validasi: Guru yang memiliki jadwal bentrok dilarang mengambil jadwal pengganti
     */
    public function test_teacher_with_schedule_conflict_cannot_claim()
    {
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'tanggal' => $this->testTanggal,
            'status' => 'kosong',
            'alasan_izin' => 'Izin Dinas',
        ]);

        // Buat jadwal mengajar untuk Guru B pada hari dan jam yang persis sama
        $jadwalBentrokGuruB = jadwal_pelajaran::firstOrCreate(
            [
                'guru_id' => $this->guruB->id,
                'hari' => 'senin',
                'jam_pelajaran_id' => $this->jadwalA->jam_pelajaran_id,
            ],
            [
                'mapel_id' => $this->jadwalA->mapel_id,
                'kelas_id' => $this->jadwalA->kelas_id,
                'tahun_ajaran_id' => $this->jadwalA->tahun_ajaran_id ?? 3,
            ]
        );

        $response = $this->withSession($this->sessionGuruB)
            ->post('/sk/ambil-jadwal-pengganti', [
                'id' => $slot->id,
            ]);

        $response->assertSessionHas('error');
        $this->assertEquals('kosong', $slot->fresh()->status);

        // Bersihkan jadwal bentrok pengujian
        $jadwalBentrokGuruB->delete();
    }

    /**
     * 11. Guru B (tanpa bentrok) berhasil mengambil jadwal kosong sebagai Guru Pengganti
     */
    public function test_guru_b_successfully_claims_empty_schedule()
    {
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'tanggal' => $this->testTanggal,
            'status' => 'kosong',
            'alasan_izin' => 'Izin Dinas Luar',
        ]);

        // Pastikan Guru B tidak bentrok
        jadwal_pelajaran::where('guru_id', $this->guruB->id)
            ->where('hari', 'senin')
            ->where('jam_pelajaran_id', $this->jadwalA->jam_pelajaran_id)
            ->delete();

        $response = $this->withSession($this->sessionGuruB)
            ->post('/sk/ambil-jadwal-pengganti', [
                'id' => $slot->id,
            ]);

        $response->assertSessionHas('success');

        $freshSlot = $slot->fresh();
        $this->assertEquals('diambil', $freshSlot->status);
        $this->assertEquals($this->guruB->id, $freshSlot->guru_pengganti_id);
        $this->assertNotNull($freshSlot->taken_at);
    }

    /**
     * 12. Validasi: Jadwal yang sudah 'diambil' tidak dapat diambil lagi oleh guru lain
     */
    public function test_already_claimed_schedule_cannot_be_claimed_again()
    {
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'guru_pengganti_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'diambil',
            'taken_at' => now(),
        ]);

        // Guru ketiga mencoba mengambil
        $guruC = guru::whereNotIn('id', [$this->guruA->id, $this->guruB->id])->first();
        if ($guruC) {
            $guruC->guru_tetap = 1;
            $guruC->save();

            $sessionGuruC = [
                'role' => 'g',
                'id' => $guruC->id,
                'id_akun' => $guruC->user_id,
                'nama' => $guruC->nama,
                'hasLogin' => true,
            ];

            $response = $this->withSession($sessionGuruC)
                ->post('/sk/ambil-jadwal-pengganti', [
                    'id' => $slot->id,
                ]);

            $response->assertSessionHas('error');
            // Tetap diambil oleh Guru B
            $this->assertEquals($this->guruB->id, $slot->fresh()->guru_pengganti_id);
        }
    }

    /**
     * 13. Integrasi End-to-End: Guru Pengganti (Guru B) dapat mengakses Absensi Mapel dan mengabsen siswa
     */
    public function test_substitute_teacher_can_access_absensi_mapel_and_submit_attendance()
    {
        // 1. Buat slot status 'diambil' oleh Guru B
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'guru_pengganti_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'diambil',
            'taken_at' => now(),
        ]);

        // 2. Guru B membuka halaman Absensi Mapel untuk sesi ini
        $responseView = $this->withSession($this->sessionGuruB)
            ->get("/sk/ass?tanggal={$this->testTanggal}&jadwal_id={$this->jadwalA->id}");

        $responseView->assertStatus(200);
        $responseView->assertSee('Biologi Eksperimen', false);
        $responseView->assertSee('Guru Pengganti', false);

        // 3. Guru B melakukan Presensi Masuk (Tahap 1)
        $responseTahap1 = $this->withSession($this->sessionGuruB)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'presensi_guru',
                'materi' => 'Materi Pengganti: Review Praktikum Sel Hewan',
                'catatan' => 'Menggantikan Ustadz A karena izin dinas luar.',
            ]);

        $responseTahap1->assertSessionHas('success');

        // Pastikan presensi mengajar tercatat atas nama Guru B (guru pengganti)
        $this->assertDatabaseHas('absensi_mengajar_guru', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'materi' => 'Materi Pengganti: Review Praktikum Sel Hewan',
        ]);

        // 4. Guru B mengisi Absensi Siswa (Tahap 2)
        $siswas = siswa::where('kelas_id', $this->ruangKelas->id)->take(2)->get();
        $absensiPayload = [
            $siswas[0]->id => ['status' => 'h', 'keterangan' => 'Hadir dengan Guru Pengganti'],
            $siswas[1]->id => ['status' => 'i', 'keterangan' => 'Izin ke UKS'],
        ];

        $responseTahap2 = $this->withSession($this->sessionGuruB)
            ->post('/sk/simpan-absensi-mapel', [
                'jadwal_id' => $this->jadwalA->id,
                'tanggal' => $this->testTanggal,
                'aksi' => 'absensi_siswa',
                'absensi' => $absensiPayload,
            ]);

        $responseTahap2->assertSessionHas('success');

        // Pastikan absensi siswa tercatat dengan guru_id = Guru B
        $this->assertDatabaseHas('absensi_siswa', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'siswa_id' => $siswas[0]->id,
            'guru_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'h',
        ]);
        $this->assertDatabaseHas('absensi_siswa', [
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'siswa_id' => $siswas[1]->id,
            'guru_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'i',
        ]);
    }

    /**
     * 14. Guru Pengganti atau Admin dapat membatalkan komitmen jadwal pengganti
     */
    public function test_substitute_teacher_can_cancel_commitment()
    {
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'guru_pengganti_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'diambil',
            'taken_at' => now(),
        ]);

        // Guru B membatalkan komitmennya
        $response = $this->withSession($this->sessionGuruB)
            ->post('/sk/batalkan-jadwal-pengganti', [
                'id' => $slot->id,
            ]);

        $response->assertSessionHas('info');

        $freshSlot = $slot->fresh();
        $this->assertEquals('kosong', $freshSlot->status);
        $this->assertNull($freshSlot->guru_pengganti_id);
        $this->assertNull($freshSlot->taken_at);
    }

    /**
     * 15. Guru Asli melihat badge status "Kosong" atau "Digantikan" di halaman Absensi Mapel
     */
    public function test_original_teacher_sees_inval_badge_when_schedule_is_taken()
    {
        guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'guru_pengganti_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'diambil',
            'taken_at' => now(),
        ]);

        $response = $this->withSession($this->sessionGuruA)
            ->get("/sk/ass?tanggal={$this->testTanggal}&jadwal_id={$this->jadwalA->id}");

        $response->assertStatus(200);
        $response->assertSee('Digantikan', false);
        $response->assertSee($this->guruB->nama, false);
    }

    /**
     * 16. Validasi Keamanan: Pengguna tidak berwenang dilarang membatalkan jadwal pengganti milik orang lain
     */
    public function test_unauthorized_user_cannot_cancel_others_substitution()
    {
        $slot = guru_pengganti::create([
            'jadwal_pelajaran_id' => $this->jadwalA->id,
            'guru_asli_id' => $this->guruA->id,
            'guru_pengganti_id' => $this->guruB->id,
            'tanggal' => $this->testTanggal,
            'status' => 'diambil',
            'taken_at' => now(),
        ]);

        // Guru A (guru asli) mencoba membatalkan komitmen yang diambil Guru B (hanya guru pengganti atau admin yang berhak membatalkan komitmen)
        $response = $this->withSession($this->sessionGuruA)
            ->post('/sk/batalkan-jadwal-pengganti', [
                'id' => $slot->id,
            ]);

        $response->assertSessionHas('error');
        // Status tetap 'diambil' oleh Guru B
        $this->assertEquals('diambil', $slot->fresh()->status);
        $this->assertEquals($this->guruB->id, $slot->fresh()->guru_pengganti_id);
    }
}

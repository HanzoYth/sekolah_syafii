<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\guru;
use App\Models\jadwal_pelajaran;
use App\Models\wallas;
use App\Models\siswa;

class SiakadGuruBlackboxTest extends TestCase
{
    private array $guruSession;
    private array $walasSession;
    private $guruId;
    private $jadwal;
    private $wallas;

    protected function setUp(): void
    {
        parent::setUp();

        // Cari guru yang memiliki jadwal mengajar & wali kelas aktif dengan siswa
        $this->wallas = wallas::where('guru_id', 1)->first() ?? wallas::first();
        if ($this->wallas) {
            $guruWalas = guru::find($this->wallas->guru_id);
            $this->walasSession = [
                'role' => 'g',
                'id' => $guruWalas->id,
                'id_akun' => $guruWalas->user_id,
                'nama' => $guruWalas->nama,
                'hasLogin' => true,
            ];
        }

        // Gunakan jadwal id 12 atau jadwal yang memiliki siswa
        $this->jadwal = jadwal_pelajaran::find(12) ?? jadwal_pelajaran::first();
        $this->guruId = $this->jadwal ? $this->jadwal->guru_id : 1;
        $guruObj = guru::find($this->guruId);

        $this->guruSession = [
            'role' => 'g',
            'id' => $this->guruId,
            'id_akun' => $guruObj ? $guruObj->user_id : 1,
            'nama' => $guruObj ? $guruObj->nama : 'Guru Pengajar',
            'hasLogin' => true,
        ];
    }

    /** 1. Dashboard Guru */
    public function test_guru_dashboard_loads_successfully()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/dsg');
        $response->assertStatus(200);
        $response->assertSee('Jadwal Mengajar', false);
    }

    /** 2. Jadwal Mengajar Guru */
    public function test_guru_jadwal_mengajar_loads_successfully()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/jadwal-guru');
        $response->assertStatus(200);
        $response->assertSee('Jadwal Mengajar', false);
    }

    /** 3. Manajemen Nilai Guru */
    public function test_guru_manajemen_nilai_loads_successfully()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/nilai-guru');
        $response->assertStatus(200);
        $response->assertSee('Nilai', false);
    }

    /** 4. Detail Input Nilai Siswa */
    public function test_guru_detail_input_nilai_loads_successfully()
    {
        if ($this->jadwal) {
            $response = $this->withSession($this->guruSession)->get("/sk/input-nilai-detail/{$this->jadwal->id}");
            $response->assertStatus(200);
            $response->assertSee('Penilaian', false);
        } else {
            $this->markTestSkipped('Tidak ada jadwal pelajaran di database.');
        }
    }

    /** 5. Simpan Nilai Siswa */
    public function test_guru_simpan_nilai_siswa()
    {
        if ($this->jadwal) {
            $nama_kelas = $this->jadwal->kelas->nama_kelas ?? '';
            $ruang = \App\Models\ruang_kelas::where('nama_ruang', $nama_kelas)->first();
            $ruang_id = $ruang ? $ruang->id : $this->jadwal->kelas_id;
            $siswa = siswa::where('kelas_id', $ruang_id)->first() ?? siswa::first();
            if ($siswa) {
                $response = $this->withSession($this->guruSession)->post("/sk/simpan-nilai-siswa/{$this->jadwal->id}", [
                    'nilai' => [
                        $siswa->id => [
                            1 => 85, // Jenis penilaian 1
                        ]
                    ]
                ]);
                $response->assertRedirect();
            } else {
                $this->markTestSkipped('Tidak ada siswa pada kelas jadwal.');
            }
        } else {
            $this->markTestSkipped('Tidak ada jadwal pelajaran di database.');
        }
    }

    /** 6. Absensi Mata Pelajaran */
    public function test_guru_absensi_mapel_loads_successfully()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/ass');
        $response->assertStatus(200);
        $response->assertSee('Absensi Mata Pelajaran', false);
    }

    /** 7. Profil Guru */
    public function test_guru_profil_loads_successfully()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/pr');
        $response->assertStatus(200);
        $response->assertSee('Profil', false);
    }

    /** 8. Pengumuman Guru */
    public function test_guru_pengumuman_loads_successfully()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/pengumuman-guru');
        $response->assertStatus(200);
        $response->assertSee('Pengumuman', false);
    }

    /** 9. Wali Kelas: Data Siswa Binaan */
    public function test_walas_data_siswa_loads_successfully()
    {
        if ($this->wallas) {
            $response = $this->withSession($this->walasSession)->get('/sk/wali-kelas');
            $response->assertStatus(200);
            $response->assertSee('Wali Kelas', false);
        } else {
            $this->markTestSkipped('Belum ada penugasan wali kelas.');
        }
    }

    /** 10. Wali Kelas: Absensi Kelas */
    public function test_walas_absensi_kelas_loads_successfully()
    {
        if ($this->wallas) {
            $response = $this->withSession($this->walasSession)->get('/sk/absensi-walas');
            $response->assertStatus(200);
            $response->assertSee('Absensi', false);
        } else {
            $this->markTestSkipped('Belum ada penugasan wali kelas.');
        }
    }

    /** 11. Wali Kelas: Rapor & Manajemen Nilai Kelas */
    public function test_walas_rapor_kelas_loads_successfully()
    {
        if ($this->wallas) {
            $response = $this->withSession($this->walasSession)->get('/sk/rapor-walas');
            $response->assertStatus(200);
            $response->assertSee('Rapor', false);
        } else {
            $this->markTestSkipped('Belum ada penugasan wali kelas.');
        }
    }

    /** 12. Wali Kelas: Detail Cetak Rapor Siswa */
    public function test_walas_detail_rapor_siswa_loads_successfully()
    {
        if ($this->wallas) {
            $siswa = siswa::where('kelas_id', $this->wallas->kelas_id)->first();
            if ($siswa) {
                $response = $this->withSession($this->walasSession)->get("/sk/detail-rapor-walas/{$siswa->id}");
                $response->assertStatus(200);
                $response->assertSee('RAPOR', false);
            } else {
                $this->markTestSkipped('Tidak ada siswa di kelas walas.');
            }
        } else {
            $this->markTestSkipped('Belum ada penugasan wali kelas.');
        }
    }

    /** 13. Sistem Guru Pengganti (Inval) */
    public function test_guru_pengganti_flow()
    {
        if ($this->jadwal) {
            // Tandai jadwal kosong oleh guru asli
            $responseTandai = $this->withSession($this->guruSession)->post('/sk/tandai-jadwal-kosong', [
                'jadwal_pelajaran_id' => $this->jadwal->id,
                'alasan_izin' => 'Izin keperluan keluarga (Uji Blackbox)',
                'keterangan_tugas' => 'Mengerjakan LKS hal 20',
            ]);
            $responseTandai->assertRedirect();

            $slot = \App\Models\guru_pengganti::where('jadwal_pelajaran_id', $this->jadwal->id)
                ->where('status', 'kosong')
                ->latest()
                ->first();
            $this->assertNotNull($slot);

            // Guru lain mengambil jadwal
            $guruPengganti = guru::where('id', '!=', $this->guruId)->first();
            if ($guruPengganti) {
                $subSession = [
                    'role' => 'g',
                    'id' => $guruPengganti->id,
                    'id_akun' => $guruPengganti->user_id,
                    'nama' => $guruPengganti->nama,
                    'hasLogin' => true,
                ];

                $responseAmbil = $this->withSession($subSession)->post('/sk/ambil-jadwal-pengganti', [
                    'id' => $slot->id,
                ]);
                $responseAmbil->assertRedirect();
                $this->assertEquals('diambil', $slot->fresh()->status);
                $this->assertEquals($guruPengganti->id, $slot->fresh()->guru_pengganti_id);

                // Guru pengganti membatalkan jadwal
                $responseBatal = $this->withSession($subSession)->post('/sk/batalkan-jadwal-pengganti', [
                    'id' => $slot->id,
                ]);
                $responseBatal->assertRedirect();
                $this->assertEquals('kosong', $slot->fresh()->status);
            }

            // Bersihkan data uji slot
            $slot->delete();
        } else {
            $this->markTestSkipped('Tidak ada jadwal pelajaran di database.');
        }
    }

    /** 14. Non-Wali Kelas Access Guard */
    public function test_non_walas_cannot_access_walas_features()
    {
        $nonWalas = guru::whereNotIn('id', wallas::pluck('guru_id'))->first();
        if ($nonWalas) {
            $nonWalasSession = [
                'role' => 'g',
                'id' => $nonWalas->id,
                'id_akun' => $nonWalas->user_id,
                'nama' => $nonWalas->nama,
                'hasLogin' => true,
            ];

            $response = $this->withSession($nonWalasSession)->get('/sk/wali-kelas');
            $response->assertRedirect('/sk/dsg');
        } else {
            $this->markTestSkipped('Semua guru tercatat sebagai wali kelas.');
        }
    }
}

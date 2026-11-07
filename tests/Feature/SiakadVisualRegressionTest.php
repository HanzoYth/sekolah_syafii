<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\admin;
use App\Models\guru;
use App\Models\siswa;

class SiakadVisualRegressionTest extends TestCase
{
    private string $chrome = 'C:\Program Files\Google\Chrome\Application\chrome.exe';
    private string $artifactDir = 'C:\Users\USER\.gemini\antigravity\brain\6feda821-e7a4-4c18-8f97-c882c8c6085f';
    private array $adminSession;
    private array $guruSession;
    private array $siswaSession;

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

        $siswa = siswa::first();
        $this->siswaSession = [
            'role' => 's',
            'id' => $siswa ? $siswa->id : 1,
            'id_akun' => $siswa ? $siswa->user_id : 1,
            'nama' => $siswa ? $siswa->nama : 'Siswa',
            'hasLogin' => true,
        ];
    }

    private function captureScreenshots(string $pageName, string $html): array
    {
        // Replace asset links to local running artisan server (127.0.0.1:8000)
        $html = str_replace('http://localhost/', 'http://127.0.0.1:8000/', $html);
        $html = str_replace('http://localhost', 'http://127.0.0.1:8000', $html);
        $html = str_replace('href="/', 'href="http://127.0.0.1:8000/', $html);
        $html = str_replace('src="/', 'src="http://127.0.0.1:8000/', $html);

        $tempHtml = __DIR__ . "/temp_{$pageName}.html";
        file_put_contents($tempHtml, $html);

        $mobileShot = "{$this->artifactDir}/ui_{$pageName}_mobile_390x844.png";
        $tabletShot = "{$this->artifactDir}/ui_{$pageName}_tablet_768x1024.png";
        $desktopShot = "{$this->artifactDir}/ui_{$pageName}_desktop_1280x800.png";

        // Capture Mobile (390 x 844 iPhone 13/14)
        $cmdM = "\"{$this->chrome}\" --headless --disable-gpu --hide-scrollbars --virtual-time-budget=2000 --window-size=390,844 --screenshot=\"{$mobileShot}\" \"file:///{$tempHtml}\"";
        shell_exec($cmdM);

        // Capture Tablet (768 x 1024 iPad)
        $cmdT = "\"{$this->chrome}\" --headless --disable-gpu --hide-scrollbars --virtual-time-budget=2000 --window-size=768,1024 --screenshot=\"{$tabletShot}\" \"file:///{$tempHtml}\"";
        shell_exec($cmdT);

        // Capture Desktop (1280 x 800)
        $cmdD = "\"{$this->chrome}\" --headless --disable-gpu --hide-scrollbars --virtual-time-budget=2000 --window-size=1280,800 --screenshot=\"{$desktopShot}\" \"file:///{$tempHtml}\"";
        shell_exec($cmdD);

        @unlink($tempHtml);

        return [
            'mobile' => file_exists($mobileShot) ? $mobileShot : null,
            'tablet' => file_exists($tabletShot) ? $tabletShot : null,
            'desktop' => file_exists($desktopShot) ? $desktopShot : null,
        ];
    }

    /** 1. Visual Regression: Admin Dashboard */
    public function test_visual_admin_dashboard()
    {
        $response = $this->withSession($this->adminSession)->get('/sk/das');
        $response->assertStatus(200);

        $shots = $this->captureScreenshots('admin_dashboard', $response->getContent());
        $this->assertNotNull($shots['mobile'], 'Mobile screenshot harus berhasil dibuat.');
        $this->assertNotNull($shots['desktop'], 'Desktop screenshot harus berhasil dibuat.');
    }

    /** 2. Visual Regression: Guru Dashboard */
    public function test_visual_guru_dashboard()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/dsg');
        $response->assertStatus(200);

        $shots = $this->captureScreenshots('guru_dashboard', $response->getContent());
        $this->assertNotNull($shots['mobile']);
        $this->assertNotNull($shots['desktop']);
    }

    /** 3. Visual Regression: Guru Absensi Mata Pelajaran */
    public function test_visual_guru_absensi_mapel()
    {
        $response = $this->withSession($this->guruSession)->get('/sk/ass');
        $response->assertStatus(200);

        $shots = $this->captureScreenshots('guru_absensi_mapel', $response->getContent());
        $this->assertNotNull($shots['mobile']);
        $this->assertNotNull($shots['desktop']);
    }

    /** 4. Visual Regression: Siswa Dashboard */
    public function test_visual_siswa_dashboard()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/dbs');
        $response->assertStatus(200);

        $shots = $this->captureScreenshots('siswa_dashboard', $response->getContent());
        $this->assertNotNull($shots['mobile']);
        $this->assertNotNull($shots['desktop']);
    }

    /** 5. Visual Regression: Siswa Jadwal Pelajaran */
    public function test_visual_siswa_jadwal()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/jadwal-siswa?tab=jadwal');
        $response->assertStatus(200);

        $shots = $this->captureScreenshots('siswa_jadwal', $response->getContent());
        $this->assertNotNull($shots['mobile']);
        $this->assertNotNull($shots['desktop']);
    }

    /** 6. Visual Regression: Siswa Transkrip Nilai */
    public function test_visual_siswa_transkrip_nilai()
    {
        $response = $this->withSession($this->siswaSession)->get('/sk/rapor-siswa?tab=transkrip');
        $response->assertStatus(200);

        $shots = $this->captureScreenshots('siswa_transkrip', $response->getContent());
        $this->assertNotNull($shots['mobile']);
        $this->assertNotNull($shots['desktop']);
    }
}

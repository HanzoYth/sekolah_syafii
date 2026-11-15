<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "jenis_sekolah:\n" . json_encode(\App\Models\jenis_sekolah::all()->toArray(), JSON_PRETTY_PRINT) . "\n";
echo "pengaturan_rapor:\n" . json_encode(\App\Models\pengaturan_rapor::all()->map(fn($r) => $r->makeHidden(['ttd_kepsek', 'ttd_walas']))->toArray(), JSON_PRETTY_PRINT) . "\n";
echo "kegiatan_sekolah:\n" . json_encode(\App\Models\kegiatan_sekolah::all()->toArray(), JSON_PRETTY_PRINT) . "\n";
echo "master_prestasi:\n" . json_encode(\App\Models\master_prestasi::all()->toArray(), JSON_PRETTY_PRINT) . "\n";
echo "ruang_kelas:\n" . json_encode(\App\Models\ruang_kelas::all()->toArray(), JSON_PRETTY_PRINT) . "\n";

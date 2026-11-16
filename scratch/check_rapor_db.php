<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== pengaturan_rapor ===\n";
print_r(DB::table('pengaturan_rapor')->get()->toArray());

echo "\n=== Indexes pengaturan_rapor ===\n";
print_r(DB::select('SHOW INDEX FROM pengaturan_rapor'));

echo "\n=== Columns evaluasi_rapor_siswa ===\n";
print_r(DB::select('SHOW COLUMNS FROM evaluasi_rapor_siswa'));

echo "\n=== kegiatan_sekolah jenjang counts ===\n";
print_r(DB::table('kegiatan_sekolah')->select('jenjang', DB::raw('count(*) as cnt'))->groupBy('jenjang')->get()->toArray());

echo "\n=== master_prestasi jenjang counts ===\n";
print_r(DB::table('master_prestasi')->select('jenjang', DB::raw('count(*) as cnt'))->groupBy('jenjang')->get()->toArray());

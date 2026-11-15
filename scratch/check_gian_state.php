<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$mapelNames = DB::table('nilai')
    ->join('mata_pelajaran', 'nilai.mapel_id', '=', 'mata_pelajaran.id')
    ->where('nilai.siswa_id', 2)
    ->distinct()
    ->pluck('mata_pelajaran.nama_mapel');
print_r($mapelNames->toArray());

print_r(DB::table('pengaturan_rapor')->select('id', 'jenjang', 'nama_kepsek', 'tanggal_rapor')->get()->toArray());

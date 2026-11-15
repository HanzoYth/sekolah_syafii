<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$rows = DB::table('siswa')
    ->leftJoin('ruang_kelas', 'siswa.kelas_id', '=', 'ruang_kelas.id')
    ->leftJoin('jenis_sekolah', 'siswa.sekolah_id', '=', 'jenis_sekolah.id')
    ->select('siswa.id', 'siswa.nama', 'siswa.kelas_id', 'ruang_kelas.nama_ruang', 'siswa.sekolah_id', 'jenis_sekolah.jenis')
    ->limit(25)
    ->get();
print_r($rows->toArray());

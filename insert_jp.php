<?php
require "vendor/autoload.php";
$app = require_once "bootstrap/app.php";
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\App\Models\jenis_penilaian::insert([
    ["nama_jenis" => "Tugas", "bobot" => 20],
    ["nama_jenis" => "Ulangan Harian", "bobot" => 30],
    ["nama_jenis" => "UTS", "bobot" => 20],
    ["nama_jenis" => "UAS", "bobot" => 30]
]);

echo "Berhasil memasukkan data jenis penilaian.";

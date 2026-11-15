<?php
require 'd:\laragon\www\sekolahsyafii\vendor\autoload.php';
$app = require 'd:\laragon\www\sekolahsyafii\bootstrap\app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$gian = App\Models\siswa::where('nama', 'like', '%Gian%')->first();
echo "Testing for Gian: ID {$gian->id}, Nama: {$gian->nama}\n";

$siakadCtrl = app(App\Http\Controllers\siakadController::class);
$request = Illuminate\Http\Request::create('/sk/rapor-siswa?tab=rapor', 'GET');
$sessionStore = $app->make('session')->driver();
$sessionStore->flush();
$sessionStore->put('role', 's');
$sessionStore->put('id', $gian->id);
$sessionStore->put('id_akun', $gian->user_id);
$sessionStore->put('nama', $gian->nama);
$sessionStore->put('hasLogin', true);
$request->setLaravelSession($sessionStore);

$view = $siakadCtrl->raporSiswa($request);
$html = $view->render();

$dir = 'C:\Users\USER\.gemini\antigravity\brain\6feda821-e7a4-4c18-8f97-c882c8c6085f\scratch\verify_html';
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}
file_put_contents($dir . '\gian_rapor_clean.html', $html);

echo "HTML rendered successfully, size: " . strlen($html) . " bytes\n";
echo "Has 'Juara 1 Musabaqah': " . (str_contains($html, 'Juara 1 Musabaqah') ? 'YES' : 'NO') . "\n";
echo "Has 'Santri Teladan': " . (str_contains($html, 'Santri Teladan') ? 'YES' : 'NO') . "\n";
echo "Has '>test<': " . (str_contains($html, '>test<') ? 'YES' : 'NO') . "\n";
echo "Has '>Test<': " . (str_contains($html, '>Test<') ? 'YES' : 'NO') . "\n";
echo "Has 'hasDbPrestasi = true': " . (str_contains($html, 'const hasDbPrestasi = true;') ? 'YES' : 'NO') . "\n";

$files = @(
    "resources\views\modul\siakad\admin\kelolaMapel.blade.php",
    "resources\views\modul\siakad\admin\kelolaReferensi.blade.php",
    "resources\views\modul\siakad\admin\kelolaWallas.blade.php",
    "resources\views\modul\siakad\admin\pangkal.blade.php",
    "resources\views\modul\siakad\admin\pemeliharaan.blade.php",
    "resources\views\modul\siakad\admin\pendidikan.blade.php"
)

foreach ($file in $files) {
    if (Test-Path $file) {
        $content = Get-Content $file -Raw
        $content = $content -replace 'class="action-btns"', 'class="action-btns" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;"'
        $content = $content -replace 'class="action-buttons"', 'class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;"'
        Set-Content $file $content -NoNewline
        Write-Host "Patched $file"
    }
}

$jadwalFile = "resources\views\modul\siakad\admin\kelolaJadwal.blade.php"
if (Test-Path $jadwalFile) {
    $content = Get-Content $jadwalFile -Raw
    $content = $content -replace '(<td class="action-column">)\s*(<a.*?class="action-btn-ds edit".*?>.*?</a>)\s*(<a.*?class="action-btn-ds delete".*?>.*?</a>)\s*(</td>)', '$1<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 5px; white-space: nowrap;">$2$3</div>$4'
    Set-Content $jadwalFile $content -NoNewline
    Write-Host "Patched $jadwalFile"
}

$tambahKelasFile = "resources\views\modul\siakad\admin\tambahKelas.blade.php"
if (Test-Path $tambahKelasFile) {
    $content = Get-Content $tambahKelasFile -Raw
    $content = $content -replace '(<td style="text-align: center;">)\s*(<a.*?class="btn-action edit".*?>.*?</a>)\s*(<a.*?class="btn-action view".*?>.*?</a>)\s*(</td>)', '$1<div style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 5px; white-space: nowrap;">$2$3</div>$4'
    Set-Content $tambahKelasFile $content -NoNewline
    Write-Host "Patched $tambahKelasFile"
}

Remove-Item -Path "storage\framework\views\*.php" -Force -ErrorAction SilentlyContinue
Write-Host "View cache cleared."

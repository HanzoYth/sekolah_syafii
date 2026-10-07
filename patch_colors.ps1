$file = "resources\views\modul\siakad\admin\tambahKelas.blade.php"
$content = Get-Content $file -Raw

$content = $content -replace 'style="color: #105a41; border: 1px solid #dbe8e1; background: #e7f4ec; padding: 6px 10px; border-radius: 6px; text-decoration: none; margin-right: 5px;"', 'style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; text-decoration: none; background: #e9f2ff; color: #3875c5;"'
$content = $content -replace 'style="color: #dc2626; border: 1px solid #fecaca; background: #fef2f2; padding: 6px 10px; border-radius: 6px; text-decoration: none;"', 'style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; text-decoration: none; background: #f8e9e9; color: #b34d4d;"'
$content = $content -replace 'class="btn-action view"', 'class="btn-action delete"'

Set-Content $file $content -NoNewline
Remove-Item -Path "storage\framework\views\*.php" -Force -ErrorAction SilentlyContinue
Write-Host "Done"

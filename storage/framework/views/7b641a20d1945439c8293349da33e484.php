<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Raport Tahfizh Al-Qur'an — Versi Dummy</title>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root{--primary:#1f6f50;--dark:#14503a;--gold:#c9a227;--border:#e3dcc8;--muted:#777;--text:#222}
*{box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:#f1efe6;margin:0;padding:20px;color:var(--text)}
.wrap{max-width:900px;margin:0 auto}
.editor{background:#fff;border:1px solid var(--border);border-radius:14px;padding:20px;margin-bottom:24px}
.editor h3{margin:0 0 4px;font-size:18px}
.editor .sub{font-size:12px;color:var(--muted);margin:0 0 14px}
.bar{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:16px}
.btn{border:0;border-radius:8px;padding:10px 14px;font:600 12px 'Poppins';cursor:pointer;color:#fff;background:var(--primary)}
.btn.sec{background:#fff;color:var(--dark);border:1px solid var(--border)}
.btn.gold{background:var(--gold)}
.tabs{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:14px}
.tab{border:1px solid var(--border);background:#faf8f2;padding:8px 12px;border-radius:8px;font:600 12px 'Poppins';cursor:pointer}
.tab.active{background:var(--primary);color:#fff;border-color:var(--primary)}
.pane{display:none}.pane.active{display:block}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px}
.box{background:#faf8f2;border:1px solid var(--border);border-radius:10px;padding:14px;margin-bottom:14px}
.box h4{margin:0 0 10px;font-size:13px;color:var(--dark)}
label{display:block;font-size:12px;font-weight:600;margin-bottom:4px}
input[type=text],input[type=number],textarea{width:100%;padding:8px 10px;border:1px solid var(--border);border-radius:8px;font:13px 'Poppins'}
input[readonly]{background:#eee;font-weight:700}
.fg{margin-bottom:10px}
.radio{display:flex;gap:16px;font-size:13px}
.radio label{font-weight:500;cursor:pointer}

/* ===== DOKUMEN CETAK ===== */
.sheet{position:relative;background:#fff;padding:36px 40px;border:1px solid var(--border);font-size:12px;line-height:1.5}
.sheet .in{position:relative;z-index:1}
.wm{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;opacity:.07;font:800 90px 'Poppins';color:var(--primary);transform:rotate(-25deg);pointer-events:none;z-index:0}
.hd{text-align:center;margin-bottom:14px}
.hd h2{margin:0;font-size:15px}.hd h3{margin:3px 0 0;font-size:13px;font-weight:600}
.bio{margin-bottom:12px}.bio td{padding:2px 0}.bio .l{width:150px;font-weight:600}
.st{font-weight:700;margin:12px 0 4px;font-size:12.5px}
table.t{width:100%;border-collapse:collapse;margin-bottom:6px}
table.t th,table.t td{border:1px solid #333;padding:5px 6px;text-align:center}
table.t th{background:#f3efe0;font-size:11.5px}
.cat-t{font-weight:700;margin-top:14px}
.cat-s{font-weight:600;margin-top:6px;font-size:11.5px}
.cat-x{border:1px solid #333;min-height:34px;padding:5px 8px;white-space:pre-wrap}
.ttd{width:100%;text-align:center;font-size:11.5px;margin-top:22px;page-break-inside:avoid}
.ttd td{vertical-align:top}.sp{height:58px}
.leg{margin-top:14px;font-size:10.5px;border-top:1px solid #999;padding-top:6px}
@media print{
  body{background:#fff;padding:0}
  .no-print{display:none!important}
  .sheet{border:0;padding:0}
}
</style>
</head>
<body>
<?php if (isset($component)) { $__componentOriginal84bdda8141b034a96f80d0303326857e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84bdda8141b034a96f80d0303326857e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_tahfiz','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_tahfiz'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84bdda8141b034a96f80d0303326857e)): ?>
<?php $attributes = $__attributesOriginal84bdda8141b034a96f80d0303326857e; ?>
<?php unset($__attributesOriginal84bdda8141b034a96f80d0303326857e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84bdda8141b034a96f80d0303326857e)): ?>
<?php $component = $__componentOriginal84bdda8141b034a96f80d0303326857e; ?>
<?php unset($__componentOriginal84bdda8141b034a96f80d0303326857e); ?>
<?php endif; ?>
<div class="wrap">

<!-- ================= PANEL EDITOR ================= -->
<div class="editor no-print">
  <h3><i class="fa-solid fa-book-quran"></i> Raport Tahfizh Al-Qur'an (Mode Data Dummy)</h3>
  <p class="sub">Semua data di bawah adalah contoh. Ubah isian dan lihat hasilnya langsung di dokumen.</p>

  <div class="bar">
    <button class="btn" onclick="simpanDummy()"><i class="fa-solid fa-floppy-disk"></i> Simpan (Simulasi)</button>
    <button class="btn sec" onclick="resetDummy()"><i class="fa-solid fa-rotate-left"></i> Reset Dummy</button>
    <button class="btn gold" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak</button>
  </div>

  <div class="tabs">
    <button class="tab active" data-tab="identitas">1. Identitas Santri</button>
    <button class="tab" data-tab="ujian">2. Ujian & Kenaikan Juz</button>
    <button class="tab" data-tab="capaian">3. Pencapaian</button>
    <button class="tab" data-tab="catatan">4. Catatan Pengampu</button>
    <button class="tab" data-tab="ttd">5. Pengesahan</button>
  </div>

  <!-- 1. IDENTITAS (BARU: nama, kelas, umur, ortu bisa diganti) -->
  <div class="pane active" id="pane-identitas">
    <div class="grid">
      <div class="fg"><label>Nama Lengkap Santri</label><input type="text" data-k="nama"></div>
      <div class="fg"><label>Kelas</label><input type="text" data-k="kelas"></div>
      <div class="fg"><label>Umur</label><input type="text" data-k="umur"></div>
      <div class="fg"><label>Orang Tua / Wali</label><input type="text" data-k="ortu"></div>
    </div>
    <div class="grid">
      <div class="fg"><label>Semester</label>
        <select data-k="semester" style="width:100%;padding:8px;border:1px solid var(--border);border-radius:8px">
          <option value="GANJIL">Ganjil</option><option value="GENAP">Genap</option>
        </select></div>
      <div class="fg"><label>Tahun</label><input type="text" data-k="tahun"></div>
    </div>
  </div>

  <!-- 2. UJIAN -->
  <div class="pane" id="pane-ujian">
    <div class="box">
      <h4>B. Nilai Ujian Tahfizh (Ujian Akhir dikali 2 otomatis)</h4>
      <div class="grid">
        <div class="fg"><label>Ujian 1</label><input type="number" step="0.1" data-k="u1"></div>
        <div class="fg"><label>Ujian 2</label><input type="number" step="0.1" data-k="u2"></div>
        <div class="fg"><label>Ujian Akhir (x2)</label><input type="number" step="0.1" data-k="ua"></div>
        <div class="fg"><label>Jumlah</label><input type="text" id="o-jumlah" readonly></div>
        <div class="fg"><label>Rata-Rata</label><input type="text" id="o-rata" readonly></div>
        <div class="fg"><label>Predikat</label><input type="text" id="o-pred" readonly></div>
      </div>
    </div>
    <div class="grid">
      <div class="box"><h4>A. Ujian Kenaikan Juz</h4>
        <div class="fg"><label>Tanggal</label><input type="text" data-k="kj_tgl"></div>
        <div class="fg"><label>Juz</label><input type="text" data-k="kj_juz"></div>
        <div class="fg"><label>Predikat</label><input type="text" data-k="kj_pred"></div>
      </div>
      <div class="box"><h4>C. Tasmi' Akhir Semester</h4>
        <div class="fg"><label>Tanggal</label><input type="text" data-k="ts_tgl"></div>
        <div class="fg"><label>Jumlah Juz</label><input type="text" data-k="ts_juz"></div>
        <div class="fg"><label>Predikat</label><input type="text" data-k="ts_pred"></div>
      </div>
    </div>
  </div>

  <!-- 3. PENCAPAIAN -->
  <div class="pane" id="pane-capaian">
    <div class="grid">
      <div class="fg"><label>Hafalan Semester (Target)</label><input type="text" data-k="tg_sem"></div>
      <div class="fg"><label>Hafalan Semester (Tercapai)</label><input type="text" data-k="tc_sem"></div>
      <div class="fg"><label>Total Hafalan (Target)</label><input type="text" data-k="tg_tot"></div>
      <div class="fg"><label>Total Hafalan (Tercapai)</label><input type="text" data-k="tc_tot"></div>
    </div>
    <div class="box grid">
      <div><label>Tercapai Target Semester</label>
        <div class="radio">
          <label><input type="radio" name="rsem" value="1" onchange="setBool('sem_iya',true)"> Iya</label>
          <label><input type="radio" name="rsem" value="0" onchange="setBool('sem_iya',false)"> Tidak</label>
        </div></div>
      <div><label>Tercapai Target Kelas</label>
        <div class="radio">
          <label><input type="radio" name="rkls" value="1" onchange="setBool('kls_iya',true)"> Iya</label>
          <label><input type="radio" name="rkls" value="0" onchange="setBool('kls_iya',false)"> Tidak</label>
        </div></div>
    </div>
  </div>

  <!-- 4. CATATAN -->
  <div class="pane" id="pane-catatan">
    <div class="fg"><label>1. Bacaan (Makharijul Huruf, Tajwid)</label><textarea rows="3" data-k="c_bacaan"></textarea></div>
    <div class="fg"><label>2. Hafalan (Itqan/Kelancaran)</label><textarea rows="3" data-k="c_hafalan"></textarea></div>
    <div class="fg"><label>3. Akhlak</label><textarea rows="3" data-k="c_akhlak"></textarea></div>
  </div>

  <!-- 5. PENGESAHAN -->
  <div class="pane" id="pane-ttd">
    <div class="grid">
      <div class="fg"><label>Tempat</label><input type="text" data-k="tempat"></div>
      <div class="fg"><label>Tanggal Rapor</label><input type="text" data-k="tanggal"></div>
      <div class="fg"><label>Pengampu Halaqah</label><input type="text" data-k="pengampu"></div>
      <div class="fg"><label>Wali Kelas</label><input type="text" data-k="walas"></div>
      <div class="fg"><label>Label Wali Kelas</label><input type="text" data-k="role"></div>
      <div class="fg"><label>Kepala Sekolah</label><input type="text" data-k="kepsek"></div>
    </div>
  </div>
</div>

<!-- ================= DOKUMEN CETAK ================= -->
<div class="sheet" id="raporPrintArea">
  <div class="wm" aria-hidden="true">SDQU</div>
  <div class="in">

    <div class="hd">
      <h2>RAPORT TAHFIZH AL-QUR’AN SEMESTER <span data-p="semester"></span> <span data-p="tahun"></span></h2>
      <h3>SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE</h3>
    </div>

    <table class="bio">
      <tr><td class="l">NAMA LENGKAP</td><td width="15">:</td><td><span data-p="nama" data-upper></span></td></tr>
      <tr><td class="l">KELAS</td><td>:</td><td data-p="kelas"></td></tr>
      <tr><td class="l">UMUR</td><td>:</td><td data-p="umur"></td></tr>
      <tr><td class="l">ORANG TUA/WALI</td><td>:</td><td data-p="ortu"></td></tr>
    </table>

    <div class="st">A. UJIAN KENAIKAN JUZ</div>
    <table class="t">
      <tr><th width="45%">TANGGAL</th><th width="25%">JUZ</th><th>PREDIKAT</th></tr>
      <tr><td data-p="kj_tgl"></td><td data-p="kj_juz"></td><td data-p="kj_pred"></td></tr>
    </table>

    <div class="st">B. UJIAN TAHFIZH</div>
    <table class="t">
      <tr><th>UJIAN 1</th><th>UJIAN 2</th><th>UJIAN AKHIR</th><th>JUMLAH</th><th>NILAI RATA-RATA</th><th>PREDIKAT</th></tr>
      <tr>
        <td data-p="u1"></td><td data-p="u2"></td><td><span data-p="ua"></span> x 2</td>
        <td id="p-jumlah"></td><td id="p-rata"></td><td id="p-pred"></td>
      </tr>
    </table>

    <div class="st">C. TASMI’ AKHIR SEMESTER</div>
    <table class="t">
      <tr><th width="45%">TANGGAL</th><th width="25%">JUMLAH JUZ</th><th>PREDIKAT</th></tr>
      <tr><td data-p="ts_tgl"></td><td data-p="ts_juz"></td><td data-p="ts_pred"></td></tr>
    </table>

    <div class="st">D. PENCAPAIAN TAHFIZH</div>
    <table class="t">
      <tr><th colspan="2">HAFALAN SEMESTER</th><th colspan="2">TOTAL HAFALAN</th><th colspan="2">TERCAPAI TARGET SEMESTER</th><th colspan="2">TERCAPAI TARGET KELAS</th></tr>
      <tr><th>Target</th><th>Tercapai</th><th>Target</th><th>Tercapai</th><th>Iya</th><th>Tidak</th><th>Iya</th><th>Tidak</th></tr>
      <tr>
        <td data-p="tg_sem"></td><td data-p="tc_sem"></td><td data-p="tg_tot"></td><td data-p="tc_tot"></td>
        <td id="c-sem-y"></td><td id="c-sem-n"></td><td id="c-kls-y"></td><td id="c-kls-n"></td>
      </tr>
    </table>

    <div class="cat-t">CATATAN PENGAMPU HALAQAH :</div>
    <div class="cat-s">Bacaan (Makharijul Huruf. Tajwid)</div><div class="cat-x" data-p="c_bacaan"></div>
    <div class="cat-s">Hafalan (Itqan/Kelancaran)</div><div class="cat-x" data-p="c_hafalan"></div>
    <div class="cat-s">Akhlak</div><div class="cat-x" data-p="c_akhlak"></div>

    <table class="ttd">
      <tr>
        <td width="46%"><div>&nbsp;</div><div>Pengampu Halaqah,</div><div class="sp"></div>
          <strong style="text-decoration:underline" data-p="pengampu"></strong><div style="font-size:11px">Pengampu Halaqah</div></td>
        <td width="8%"></td>
        <td width="46%"><div><span data-p="tempat"></span>, <span data-p="tanggal"></span></div><div>Wali Kelas,</div><div class="sp"></div>
          <strong style="text-decoration:underline" data-p="walas"></strong><div style="font-size:11px" data-p="role"></div></td>
      </tr>
      <tr><td colspan="3" style="padding-top:14px">
        <div>Mengetahui,</div><div style="font-size:11px">Kepala Sekolah SDQU Imam Syafi’i</div><div class="sp"></div>
        <strong style="text-decoration:underline" data-p="kepsek"></strong>
      </td></tr>
    </table>

    <div class="leg"><strong>Keterangan Predikat :</strong><br>
      Mumtaz/A: 91-100 &nbsp;|&nbsp; Jayyid Jiddan/B: 83-90 &nbsp;|&nbsp; Jayyid/C: 72-82 &nbsp;|&nbsp; Maqbul/D: 61-71 &nbsp;|&nbsp; Dha’if/E: &lt;60</div>
  </div>
</div>

</div>

<script>
// ===== DATA DUMMY (nanti diganti data dari PHP/database) =====
const DUMMY = {
  nama: 'Muhammad Fauzan Al-Ghifari', kelas: '6 (Enam)', umur: '12 tahun', ortu: 'Bapak Ahmad Yusuf',
  semester: 'GANJIL', tahun: '2025',
  kj_tgl: '12 Desember 2025', kj_juz: '29', kj_pred: 'Jayyid/C',
  u1: 85, u2: 88, ua: 90,
  ts_tgl: '18 Desember 2025', ts_juz: '2', ts_pred: 'Jayyid Jiddan/B',
  tg_sem: '1 Juz', tc_sem: '1 Juz (QS. An-Naba’ s.d. QS. An-Naziat)',
  tg_tot: '3 Juz', tc_tot: '3 Juz (Juz 28, 29, 30)',
  sem_iya: true, kls_iya: true,
  c_bacaan: 'Makharijul huruf sudah baik, perlu memperhatikan hukum mad dan waqaf-ibtida’.',
  c_hafalan: 'Hafalan lancar dan mutqin, tetap jaga muraja’ah harian.',
  c_akhlak: 'Santun, disiplin, dan aktif dalam halaqah.',
  tempat: 'Tinggede', tanggal: '20 Desember 2025',
  pengampu: 'USTADZAH FATIMAH', walas: 'USTADZ ABDURRAHMAN', role: 'Wali Kelas 6', kepsek: 'USTADZ MUHAMMAD IKHSAN'
};
let D = JSON.parse(JSON.stringify(DUMMY));

const $ = (s, r = document) => r.querySelector(s);
const $$ = (s, r = document) => [...r.querySelectorAll(s)];

function predikat(n){
  if(n>=91) return 'Mumtaz/A';
  if(n>=83) return 'Jayyid Jiddan/B';
  if(n>=72) return 'Jayyid/C';
  if(n>=61) return 'Maqbul/D';
  return 'Dha’if/E';
}

function render(){
  // teks biasa
  $$('[data-p]').forEach(el=>{
    let v = D[el.dataset.p] ?? '';
    if(el.hasAttribute('data-upper')) v = String(v).toUpperCase();
    el.textContent = v;
  });
  // hitung ujian
  const u1=parseFloat(D.u1)||0, u2=parseFloat(D.u2)||0, ua=parseFloat(D.ua)||0;
  const jumlah=u1+u2+ua*2, rata=Math.round(jumlah/4*10)/10, pred=predikat(rata);
  const rataTxt=rata.toFixed(1).replace('.',',');
  $('#o-jumlah').value=jumlah; $('#o-rata').value=rataTxt; $('#o-pred').value=pred;
  $('#p-jumlah').textContent=jumlah; $('#p-rata').textContent=rataTxt; $('#p-pred').textContent=pred;
  // centang target
  $('#c-sem-y').textContent = D.sem_iya ? '√' : '';
  $('#c-sem-n').textContent = !D.sem_iya ? '√' : '';
  $('#c-kls-y').textContent = D.kls_iya ? '√' : '';
  $('#c-kls-n').textContent = !D.kls_iya ? '√' : '';
}

function setBool(k,v){ D[k]=v; render(); }

function fillInputs(){
  $$('[data-k]').forEach(el=>{ el.value = D[el.dataset.k] ?? ''; });
  $$('input[name=rsem]').forEach(r=> r.checked = (r.value==='1') === D.sem_iya);
  $$('input[name=rkls]').forEach(r=> r.checked = (r.value==='1') === D.kls_iya);
}

// binding input -> data -> preview
$$('[data-k]').forEach(el=>{
  const h = ()=>{ D[el.dataset.k]=el.value; render(); };
  el.addEventListener('input',h); el.addEventListener('change',h);
});

// tab editor
$$('.tab').forEach(b=> b.addEventListener('click',()=>{
  $$('.tab').forEach(x=>x.classList.remove('active'));
  $$('.pane').forEach(x=>x.classList.remove('active'));
  b.classList.add('active');
  $('#pane-'+b.dataset.tab).classList.add('active');
}));

function simpanDummy(){
  console.log('Data yang akan dikirim ke server:', D);
  alert('Simulasi simpan berhasil. Cek console (F12) untuk melihat datanya.');
}
function resetDummy(){
  if(!confirm('Kembalikan semua isian ke data dummy awal?')) return;
  D = JSON.parse(JSON.stringify(DUMMY)); fillInputs(); render();
}

fillInputs(); render();
</script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/raporSementara.blade.php ENDPATH**/ ?>
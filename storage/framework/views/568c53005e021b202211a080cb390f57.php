<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Nilai & Rapor Akademik Siswa','description' => 'Transkrip rincian nilai komponen (Tugas, UH, UTS, UAS) dan pratinjau dokumen Rapor Semester ananda '.e($siswa->nama).'.','position' => 'Siswa / Orang Tua','initials' => 'SW']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nilai & Rapor Akademik Siswa','description' => 'Transkrip rincian nilai komponen (Tugas, UH, UTS, UAS) dan pratinjau dokumen Rapor Semester ananda '.e($siswa->nama).'.','position' => 'Siswa / Orang Tua','initials' => 'SW']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Nilai & Rapor</span>
        </li>
     <?php $__env->endSlot(); ?>

    <?php
        $activeTab = $tab ?? request('tab', 'transkrip');
        $namaKelas = $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? '-');
    ?>

    <!-- Top Summary KPI Cards (Hidden when printing) -->
    <div class="no-print grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Mata Pelajaran</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($stats_akademik['mapel_dinilai'] ?? 0); ?> / <?php echo e($stats_akademik['total_mapel'] ?? count($rekap_nilai)); ?></h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mapel telah dinilai</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Rata-rata Nilai Akhir</p>
                <h3 class="text-xl font-bold text-emerald-600"><?php echo e(($stats_akademik['rata_rata'] ?? 0) > 0 ? number_format($stats_akademik['rata_rata'], 1) : '-'); ?></h3>
                <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Predikat: <?php echo e($stats_akademik['predikat_umum'] ?? '-'); ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Status Ketuntasan</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($stats_akademik['mapel_tuntas'] ?? 0); ?> Mapel</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mencapai batas KKM</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Wali Kelas</p>
                <h3 class="text-sm font-bold text-slate-800 line-clamp-1"><?php echo e($wallas->guru->nama ?? 'Belum Ditentukan'); ?></h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Kelas <?php echo e($namaKelas); ?></p>
            </div>
        </div>
    </div>

    <!-- Tab Bar & Print Button -->
    <div class="no-print flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex flex-wrap p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 self-start gap-1">
            <a href="/sk/rapor-siswa?tab=transkrip" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab !== 'rapor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-list-check"></i>
                <span>Rincian Nilai</span>
            </a>
            <a href="/sk/rapor-siswa?tab=rapor" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab === 'rapor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-file-contract"></i>
                <span>Lembar Rapor</span>
            </a>
        </div>

        <?php if($activeTab === 'rapor'): ?>
            <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-2 self-start sm:self-auto">
                <i class="fa-solid fa-print"></i> Cetak Rapor
            </button>
        <?php endif; ?>
    </div>

    <?php if($activeTab === 'rapor'): ?>
        <!-- TAB 2: LEMBAR RAPOR RESMI (SESUAI DOKUMEN WORD zaky.docx) -->
        <div class="print-area bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-12 text-slate-900 relative overflow-hidden">
            
            <!-- WATERMARK TRANSPARAN DI TENGAH LEMBAR RAPOR -->
            <?php if(!empty($raporMeta['watermark_logo'])): ?>
                <div class="watermark-overlay" aria-hidden="true">
                    <img src="<?php echo e($raporMeta['watermark_logo']); ?>" alt="Watermark Lembaga" class="watermark-image">
                </div>
            <?php endif; ?>

            <div class="rapor-content-container relative z-10">
                <!-- 1. IDENTITAS SISWA & SEKOLAH (2 KOLOM KOP) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-1.5 text-xs sm:text-sm font-sans mb-6 pb-4 border-b border-slate-300">
                    <!-- Kolom Kiri -->
                    <div class="space-y-1">
                        <div class="flex">
                            <span class="w-28 sm:w-32 font-bold text-slate-800">Nama Sekolah</span>
                            <span class="mr-2 font-bold">:</span>
                            <span class="font-bold text-slate-900 uppercase"><?php echo e($raporMeta['nama_sekolah']); ?></span>
                        </div>
                        <div class="flex">
                            <span class="w-28 sm:w-32 font-semibold text-slate-700">Nama</span>
                            <span class="mr-2">:</span>
                            <span class="font-bold text-slate-900 uppercase"><?php echo e($siswa->nama); ?></span>
                        </div>
                        <div class="flex">
                            <span class="w-28 sm:w-32 font-semibold text-slate-700">NISN</span>
                            <span class="mr-2">:</span>
                            <span class="font-mono font-medium text-slate-800"><?php echo e($siswa->nis ?? '-'); ?></span>
                        </div>
                        <div class="flex items-start">
                            <span class="w-28 sm:w-32 font-semibold text-slate-700 flex-shrink-0">Alamat</span>
                            <span class="mr-2 flex-shrink-0">:</span>
                            <span class="text-slate-800 leading-tight"><?php echo e($raporMeta['alamat_sekolah']); ?></span>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-1 md:pl-4">
                        <div class="flex">
                            <span class="w-32 sm:w-36 font-semibold text-slate-700">Kelas</span>
                            <span class="mr-2">:</span>
                            <span class="font-bold text-slate-900"><?php echo e($raporMeta['kelas_label']); ?></span>
                        </div>
                        <div class="flex">
                            <span class="w-32 sm:w-36 font-semibold text-slate-700">Fase</span>
                            <span class="mr-2">:</span>
                            <span class="font-bold text-slate-900"><?php echo e($raporMeta['fase']); ?></span>
                        </div>
                        <div class="flex">
                            <span class="w-32 sm:w-36 font-semibold text-slate-700">Semester</span>
                            <span class="mr-2">:</span>
                            <span class="text-slate-900 font-medium"><?php echo e(($tahun_aktif->semester ?? 1) == 1 ? '1 / Ganjil' : '2 / Genap'); ?></span>
                        </div>
                        <div class="flex">
                            <span class="w-32 sm:w-36 font-semibold text-slate-700">Tahun Pelajaran</span>
                            <span class="mr-2">:</span>
                            <span class="font-semibold text-slate-900"><?php echo e($tahun_aktif->nama ?? '2025/2026'); ?></span>
                        </div>
                    </div>
                </div>

                <!-- 2. JUDUL RAPOR -->
                <div class="text-center my-6">
                    <h1 class="text-lg sm:text-xl font-extrabold tracking-wider uppercase text-slate-900">LAPORAN HASIL BELAJAR</h1>
                </div>

                <!-- 3. TABEL CAPAIAN KOMPETENSI (NILAI AKADEMIK) -->
                <div class="mb-6 overflow-x-auto">
                    <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100/90 text-slate-900 font-bold text-center">
                                <th class="border border-slate-800 px-2 py-2.5 w-12">No</th>
                                <th class="border border-slate-800 px-3 py-2.5 text-left w-52 sm:w-60">Mata Pelajaran</th>
                                <th class="border border-slate-800 px-2 py-2.5 w-16">Nilai</th>
                                <th class="border border-slate-800 px-3 py-2.5 text-left">Capaian Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($rekap_nilai) > 0): ?>
                                <?php $rowIdx = 1; ?>
                                <?php $__currentLoopData = $rekap_nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel_id => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $adaNilai = !empty($data['ada_nilai']);
                                        $na = $data['nilai_akhir'];
                                        $namaMapel = $data['mata_pelajaran']->nama_mapel ?? 'Mata Pelajaran';
                                    ?>
                                    <tr>
                                        <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top"><?php echo e($rowIdx++); ?></td>
                                        <td class="border border-slate-800 px-3 py-2.5 font-semibold text-slate-900 align-top"><?php echo e($namaMapel); ?></td>
                                        <td class="border border-slate-800 px-2 py-2.5 text-center font-bold text-slate-900 align-top">
                                            <?php echo e($adaNilai ? number_format($na, 0) : '-'); ?>

                                        </td>
                                        <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed text-justify align-top">
                                            <?php echo e($data['deskripsi'] ?? '-'); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <!-- Baris Jumlah & Rata-rata Sesuai Dokumen Word -->
                                <tr class="font-bold bg-slate-50/60">
                                    <td colspan="2" class="border border-slate-800 px-4 py-2 text-left font-bold">Jumlah</td>
                                    <td class="border border-slate-800 px-2 py-2 text-center font-extrabold"><?php echo e(number_format($stats_akademik['total_nilai_akhir'] ?? 0, 0)); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 bg-slate-50/30"></td>
                                </tr>
                                <tr class="font-bold bg-slate-50/60">
                                    <td colspan="2" class="border border-slate-800 px-4 py-2 text-left font-bold">Rata-rata</td>
                                    <td class="border border-slate-800 px-2 py-2 text-center font-extrabold"><?php echo e(number_format($stats_akademik['rata_rata'] ?? 0, 0)); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 bg-slate-50/30"></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="border border-slate-800 px-4 py-6 text-center text-slate-500 italic">
                                        Belum ada data nilai mata pelajaran untuk semester ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- 4. TABEL PROGRAM KEGIATAN SEKOLAH -->
                <div class="mb-6 overflow-x-auto">
                    <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100/90 text-slate-900 font-bold text-center">
                                <th class="border border-slate-800 px-2 py-2.5 w-12">No</th>
                                <th class="border border-slate-800 px-3 py-2.5 text-left w-52 sm:w-60">Program Kegiatan Sekolah</th>
                                <th class="border border-slate-800 px-3 py-2.5 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="studentKegiatanBody">
                            <?php $__currentLoopData = $raporMeta['kegiatan_sekolah_default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                    <td class="border border-slate-800 px-3 py-2.5 font-semibold text-slate-900 align-top"><?php echo e($keg['kegiatan']); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed align-top"><?php echo e($keg['keterangan']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- 5. TABEL JENIS PRESTASI -->
                <div class="mb-6 overflow-x-auto">
                    <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100/90 text-slate-900 font-bold text-center">
                                <th class="border border-slate-800 px-2 py-2.5 w-12">No</th>
                                <th class="border border-slate-800 px-3 py-2.5 text-left">Jenis Prestasi</th>
                            </tr>
                        </thead>
                        <tbody id="studentPrestasiBody">
                            <?php $__empty_1 = true; $__currentLoopData = $raporMeta['prestasi_default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                    <td class="border border-slate-800 px-3 py-2.5 text-slate-900 font-medium align-top"><?php echo e($pres); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2 text-center">-</td>
                                    <td class="border border-slate-800 px-3 py-2 text-slate-500 italic">Tidak ada catatan prestasi khusus semester ini.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- 6. TABEL KETIDAKHADIRAN -->
                <div class="mb-6 overflow-x-auto w-full sm:w-80">
                    <table data-no-paginate="true" class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <tbody>
                            <tr>
                                <td class="border border-slate-800 px-3.5 py-1.5 font-medium w-48">Sakit</td>
                                <td class="border border-slate-800 px-3.5 py-1.5 text-center font-bold"><?php echo e($rekap_absen['s'] ?? 0); ?></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-800 px-3.5 py-1.5 font-medium">Izin</td>
                                <td class="border border-slate-800 px-3.5 py-1.5 text-center font-bold"><?php echo e($rekap_absen['i'] ?? 0); ?></td>
                            </tr>
                            <tr>
                                <td class="border border-slate-800 px-3.5 py-1.5 font-medium">Tanpa Keterangan</td>
                                <td class="border border-slate-800 px-3.5 py-1.5 text-center font-bold"><?php echo e($rekap_absen['a'] ?? 0); ?></td>
                            </tr>
                            <tr class="bg-slate-100/70 font-bold">
                                <td class="border border-slate-800 px-3.5 py-1.5">Jumlah</td>
                                <td class="border border-slate-800 px-3.5 py-1.5 text-center font-extrabold">
                                    <?php echo e(($rekap_absen['s'] ?? 0) + ($rekap_absen['i'] ?? 0) + ($rekap_absen['a'] ?? 0)); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 7. KOTAK CATATAN WALI KELAS -->
                <div class="mb-8">
                    <div class="border border-slate-800 p-0 overflow-hidden">
                        <div class="bg-slate-100/90 px-3.5 py-2 border-b border-slate-800 font-bold text-xs sm:text-sm text-slate-900">
                            Catatan Wali Kelas
                        </div>
                        <div id="studentCatatanWalas" class="p-4 text-xs sm:text-sm text-slate-800 leading-relaxed whitespace-pre-line min-h-[90px]">
<?php echo e($raporMeta['catatan_walas_default']); ?>

                        </div>
                    </div>
                </div>

                <!-- 8. TANDA TANGAN PENGESAHAN 3 KOLOM -->
                <div class="grid grid-cols-3 gap-4 pt-4 text-xs sm:text-sm text-center">
                    <!-- Kolom 1: Orang Tua / Wali -->
                    <div class="flex flex-col justify-between h-40">
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">Mengetahui</p>
                            <p class="font-medium text-slate-800 leading-tight">Orang Tua/Wali,</p>
                        </div>
                        <div>
                            <p class="font-bold text-slate-900 tracking-wider">....................................................</p>
                        </div>
                    </div>

                    <!-- Kolom 2: Wali Kelas -->
                    <div class="flex flex-col justify-between h-40">
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">&nbsp;</p>
                            <p class="font-medium text-slate-800 leading-tight">Wali Kelas <?php echo e($raporMeta['kelas_label']); ?>,</p>
                        </div>
                        <div>
                            <p id="studentWalasNama" class="font-bold underline text-slate-900">
                                <?php echo e($wallas->guru->nama ?? '....................................................'); ?>

                            </p>
                            <?php if(!empty($wallas->guru->nig)): ?>
                                <p class="text-[11px] text-slate-600 mt-0.5">NIG. <?php echo e($wallas->guru->nig); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Kolom 3: Kepala Sekolah -->
                    <div class="flex flex-col justify-between h-40">
                        <div>
                            <p id="studentTanggalRapor" class="font-medium text-slate-800 leading-tight">
                                Sigi, <?php echo e($raporMeta['tanggal_rapor']); ?>

                            </p>
                            <p class="font-medium text-slate-800 leading-tight">Kepala Sekolah,</p>
                        </div>
                        <div>
                            <p id="studentKepsekNama" class="font-bold underline text-slate-900">
                                <?php echo e($raporMeta['nama_kepsek']); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Sinkronisasi data custom yang disimpan wali kelas di perangkat
            document.addEventListener('DOMContentLoaded', function() {
                try {
                    const saved = localStorage.getItem('siakad_rapor_custom_<?php echo e($siswa->id); ?>');
                    const hasDbCatatan = <?php echo json_encode(!empty($raporMeta['has_evaluasi_db']), 15, 512) ?>;
                    if (saved) {
                        const data = JSON.parse(saved);
                        if (data.catatan && !hasDbCatatan) {
                            const c = document.getElementById('studentCatatanWalas');
                            if (c) c.textContent = data.catatan;
                        }
                        if (data.tanggal) {
                            const t = document.getElementById('studentTanggalRapor');
                            if (t) t.textContent = 'Sigi, ' + data.tanggal;
                        }
                        if (data.kepsek) {
                            const k = document.getElementById('studentKepsekNama');
                            if (k) k.textContent = data.kepsek;
                        }
                        if (data.walas) {
                            const w = document.getElementById('studentWalasNama');
                            if (w) w.textContent = data.walas;
                        }
                        if (data.kegiatan && Array.isArray(data.kegiatan)) {
                            const kb = document.getElementById('studentKegiatanBody');
                            if (kb) {
                                const defaultKegiatan = <?php echo json_encode($raporMeta['kegiatan_sekolah_default'], 15, 512) ?>;
                                const savedMap = {};
                                data.kegiatan.forEach(k => { if (k && k.kegiatan) savedMap[k.kegiatan] = k; });
                                const mergedKegiatan = defaultKegiatan.map(defKeg => {
                                    return savedMap[defKeg.kegiatan] ? savedMap[defKeg.kegiatan] : defKeg;
                                });
                                data.kegiatan.forEach(k => {
                                    if (k && k.kegiatan && !defaultKegiatan.some(d => d.kegiatan === k.kegiatan)) {
                                        mergedKegiatan.push(k);
                                    }
                                });
                                kb.innerHTML = mergedKegiatan.map((item, idx) => `
                                    <tr>
                                        <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top">${idx + 1}</td>
                                        <td class="border border-slate-800 px-3 py-2.5 font-semibold text-slate-900 align-top">${item.kegiatan}</td>
                                        <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed align-top">${item.keterangan}</td>
                                    </tr>
                                `).join('');
                            }
                        }
                        if (data.prestasi && Array.isArray(data.prestasi)) {
                            const pb = document.getElementById('studentPrestasiBody');
                            if (pb) {
                                if (data.prestasi.length === 0) {
                                    pb.innerHTML = `<tr><td class="border border-slate-800 px-2 py-2 text-center">-</td><td class="border border-slate-800 px-3 py-2 text-slate-500 italic">Tidak ada catatan prestasi khusus semester ini.</td></tr>`;
                                } else {
                                    pb.innerHTML = data.prestasi.map((item, idx) => `
                                        <tr>
                                            <td class="border border-slate-800 px-2 py-2.5 text-center font-medium align-top">${idx + 1}</td>
                                            <td class="border border-slate-800 px-3 py-2.5 text-slate-900 font-medium align-top">${item}</td>
                                        </tr>
                                    `).join('');
                                }
                            }
                        }
                    }
                } catch(e) {}
            });
        </script>
    <?php else: ?>
        <!-- TAB 1: TRANSKRIP RINCIAN NILAI KOMPONEN -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Rincian Capaian Nilai Per Komponen</h3>
                    <p class="text-xs text-slate-500">Daftar nilai Tugas, Ulangan Harian, UTS, dan UAS yang diinput oleh Guru Pengajar maupun Wali Kelas</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Tahun Ajaran <?php echo e($tahun_aktif->nama ?? '2026/2027'); ?>

                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-12 text-center">No</th>
                            <th class="px-5 py-3.5">Mata Pelajaran & Pengajar</th>
                            <th class="px-5 py-3.5 text-center">KKM</th>
                            <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="px-4 py-3.5 text-center">
                                    <?php echo e($jp->nama_jenis); ?>

                                    <span class="block text-[10px] font-normal text-slate-400">Bobot <?php echo e($jp->bobot); ?>%</span>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th class="px-5 py-3.5 text-center bg-emerald-50/70 text-emerald-900">Nilai Akhir</th>
                            <th class="px-5 py-3.5 text-center">Predikat</th>
                            <th class="px-5 py-3.5 text-center">Ketuntasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(count($rekap_nilai) > 0): ?>
                            <?php $__currentLoopData = $rekap_nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel_id => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $ada = $data['ada_nilai'] ?? true;
                                    $na = $data['nilai_akhir'];
                                    $predikat = $data['predikat'] ?? '-';
                                    $tuntas = $data['tuntas'] ?? ($na >= ($data['kkm'] ?? 75));
                                ?>
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-5 py-4">
                                        <span class="font-bold text-slate-800 block"><?php echo e($data['mata_pelajaran']->nama_mapel ?? '-'); ?></span>
                                        <span class="text-xs text-slate-400">
                                            <i class="fa-solid fa-chalkboard-user text-[10px] mr-1"></i> <?php echo e($data['guru_nama'] ?? '-'); ?>

                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-center font-mono text-xs font-semibold text-slate-500">
                                        <?php echo e($data['kkm'] ?? 75); ?>

                                    </td>
                                    <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $skor = $data['nilai_detail'][$jp->id] ?? null;
                                        ?>
                                        <td class="px-4 py-4 text-center font-mono">
                                            <?php if($skor !== null): ?>
                                                <span class="font-semibold text-slate-700"><?php echo e($skor); ?></span>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-300">-</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td class="px-5 py-4 text-center bg-emerald-50/30 font-extrabold text-base <?php echo e(!$ada ? 'text-slate-400' : ($tuntas ? 'text-emerald-700' : 'text-rose-600')); ?>">
                                        <?php echo e($ada ? number_format($na, 1) : '-'); ?>

                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if(!$ada): ?>
                                            <span class="text-xs text-slate-400">-</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-extrabold <?php echo e($predikat === 'A' ? 'bg-emerald-100 text-emerald-800' : ($predikat === 'B' ? 'bg-blue-100 text-blue-800' : ($predikat === 'C' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800'))); ?>">
                                                <?php echo e($predikat); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if(!$ada): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                Belum Input
                                            </span>
                                        <?php elseif($tuntas): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Tuntas
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-rotate-right mr-1 text-[10px]"></i> Perlu Remedi
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?php echo e(6 + count($jenis_penilaian)); ?>" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-folder-open text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Data Mata Pelajaran atau Nilai</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data nilai akan tampil secara otomatis setelah diinput oleh Guru Pengajar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <style>
        /* WATERMARK TRANSPARAN DI TENGAH LEMBAR RAPOR */
        .watermark-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 480px;
            max-width: 85%;
            pointer-events: none;
            user-select: none;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .watermark-image {
            width: 100%;
            height: auto;
            opacity: 0.07;
            filter: contrast(110%) brightness(95%);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .rapor-content-container {
            position: relative;
            z-index: 2;
        }

        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-area, .print-area * { visibility: visible; }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                padding: 10mm 12mm !important;
                margin: 0 !important;
                background: white !important;
                color: #000 !important;
            }

            .watermark-overlay {
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                display: flex !important;
                visibility: visible !important;
            }

            .watermark-image {
                visibility: visible !important;
                opacity: 0.08 !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            table {
                border-collapse: collapse !important;
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            th, td {
                border-color: #000 !important;
            }
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14)): ?>
<?php $attributes = $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14; ?>
<?php unset($__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14)): ?>
<?php $component = $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14; ?>
<?php unset($__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/siswa/raporSiswa.blade.php ENDPATH**/ ?>
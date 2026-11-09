<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leger Nilai Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?> - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm 12mm 12mm 12mm;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                color: #000 !important;
                font-size: 11px !important;
                padding: 0 !important;
            }
            .print-container {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                max-width: 100% !important;
            }
            table {
                border-collapse: collapse !important;
                width: 100% !important;
            }
            th, td {
                border: 1px solid #1e293b !important;
                padding: 4px 6px !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            .bg-header-th {
                background-color: #f1f5f9 !important;
            }
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
        }

        .leger-table th, .leger-table td {
            border: 1px solid #334155;
        }
    </style>
</head>
<body class="p-4 sm:p-6 lg:p-8">

    <!-- Top Floating Action Bar (Hidden on Print) -->
    <div class="no-print max-w-7xl mx-auto mb-6 bg-slate-900 text-white rounded-2xl p-4 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="/sk/rapor-walas?tab=nilai<?php echo e(session('role') === 'a' ? '&kelas_id='.($wallas->kelas_id ?? '') : ''); ?>" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h4 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-emerald-400"></i>
                    Dokumen Leger Nilai Kelas: <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?>

                </h4>
                <p class="text-xs text-slate-400 mt-0.5">Format cetak Landscape resmi untuk Rapat Kenaikan Kelas / Arsip Kurikulum.</p>
            </div>
        </div>
        <div class="flex items-center gap-2.5">
            <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md flex items-center gap-2">
                <i class="fa-solid fa-print"></i> Cetak Dokumen Leger (Print / PDF)
            </button>
        </div>
    </div>

    <!-- Container Lembar Cetak Leger (A4 Landscape) -->
    <div class="print-container max-w-7xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-6 sm:p-10 text-slate-900">
        
        <?php
            $nama_ruang_low = strtolower($wallas->ruangKelas->nama_ruang ?? '');
            $is_sd = str_contains($nama_ruang_low, 'sd') || preg_match('/\b(1|2|3|4|5|6)\b/', $nama_ruang_low);
            $logo_url = $is_sd ? asset('img/logo_sd.jpg') : asset('img/logo_smp.webp');
            $nama_instansi = $is_sd ? "SEKOLAH DASAR ISLAM AL-QUR'AN (SD Qu) IMAM SYAFI'I" : "SEKOLAH MENENGAH PERTAMA ISLAM AL-QUR'AN (SMP Qu) IMAM SYAFI'I";
        ?>

        <!-- KOP LEGER RESMI -->
        <div class="border-b-2 border-slate-800 pb-4 mb-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <img src="<?php echo e($logo_url); ?>" alt="Logo Lembaga" class="w-16 h-16 object-contain flex-shrink-0" onerror="this.src='<?php echo e(asset('img/logo_sklh.png')); ?>'">
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">YAYASAN IMAM SYAFI'I TINGGEDE</h3>
                    <h1 class="text-base sm:text-lg font-black uppercase text-slate-900 tracking-tight leading-tight"><?php echo e($nama_instansi); ?></h1>
                    <p class="text-xs text-slate-600 mt-0.5">Alamat: Jl. Poros Palu - Kulawi, Tinggede, Kec. Marawola, Kab. Sigi, Sulawesi Tengah</p>
                </div>
            </div>
            <div class="text-right flex-shrink-0">
                <span class="px-3 py-1 rounded bg-slate-100 border border-slate-300 font-bold text-xs uppercase tracking-wider">
                    DOKUMEN RESMI
                </span>
                <p class="text-[11px] text-slate-500 mt-1">Dicetak: <?php echo e(date('d/m/Y H:i')); ?></p>
            </div>
        </div>

        <div class="text-center mb-6">
            <h2 class="text-sm sm:text-base font-black uppercase tracking-wider text-slate-900">
                LEGER REKAPITULASI HASIL BELAJAR SISWA
            </h2>
            <p class="text-xs text-slate-700 font-medium mt-0.5">
                Tahun Ajaran <?php echo e($tahun_aktif->nama ?? '2025/2026'); ?> &mdash; Semester <?php echo e(($tahun_aktif->semester ?? 1) == 2 ? 'Genap (2)' : 'Ganjil (1)'); ?>

            </p>
        </div>

        <!-- Identitas Leger -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs mb-5 p-3 rounded-lg bg-slate-50 border border-slate-200">
            <div>
                <span class="text-slate-500">Kelas / Rombel:</span>
                <p class="font-bold text-slate-800"><?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?></p>
            </div>
            <div>
                <span class="text-slate-500">Wali Kelas:</span>
                <p class="font-bold text-slate-800"><?php echo e($wallas->guru->nama ?? 'Wali Kelas'); ?></p>
            </div>
            <div>
                <span class="text-slate-500">Jumlah Santri:</span>
                <p class="font-bold text-slate-800"><?php echo e(count($siswa)); ?> Siswa</p>
            </div>
            <div>
                <span class="text-slate-500">Rata-rata Kelas:</span>
                <p class="font-bold text-emerald-700"><?php echo e(number_format($stats_nilai['rata_kelas'] ?? 0, 1)); ?></p>
            </div>
        </div>

        <!-- TABEL LEGER NILAI LENGKAP -->
        <div class="overflow-x-auto mb-6">
            <table class="w-full text-xs text-center border-collapse border border-slate-800 leger-table">
                <thead>
                    <tr class="bg-slate-100 text-slate-900 font-bold bg-header-th">
                        <th rowspan="2" class="border border-slate-800 px-2 py-2 w-10">No</th>
                        <th rowspan="2" class="border border-slate-800 px-3 py-2 w-24">NIS</th>
                        <th rowspan="2" class="border border-slate-800 px-3 py-2 text-left min-w-[180px]">Nama Lengkap Siswa</th>
                        <th rowspan="2" class="border border-slate-800 px-2 py-2 w-10">L/P</th>
                        
                        <!-- Header Mata Pelajaran -->
                        <?php $__currentLoopData = $daftar_jadwal_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="border border-slate-800 px-2 py-1 text-[11px] whitespace-nowrap" title="<?php echo e($j->mata_pelajaran->nama_mapel ?? ''); ?>">
                                <?php echo e(\Illuminate\Support\Str::limit($j->mata_pelajaran->nama_mapel ?? 'Mapel', 12, '..')); ?>

                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <th rowspan="2" class="border border-slate-800 px-2 py-2 w-16 bg-slate-200/70">Total</th>
                        <th rowspan="2" class="border border-slate-800 px-2 py-2 w-14 bg-slate-200/70">Rata2</th>
                        <th rowspan="2" class="border border-slate-800 px-2 py-2 w-12 bg-slate-200/70">Pred</th>
                        <th rowspan="2" class="border border-slate-800 px-2 py-2 w-12 bg-emerald-100 text-emerald-900">Rank</th>
                    </tr>
                    <tr class="bg-slate-50 text-[10px] text-slate-600 font-semibold bg-header-th">
                        <?php $__currentLoopData = $daftar_jadwal_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <th class="border border-slate-800 px-1 py-1 text-slate-500">
                                KKM: <?php echo e($j->getKkm()); ?>

                            </th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-300">
                    <?php $__empty_1 = true; $__currentLoopData = $leger_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php $s = $row->siswa; ?>
                        <tr class="hover:bg-slate-50 <?php echo e($idx % 2 == 1 ? 'bg-slate-50/50' : 'bg-white'); ?>">
                            <td class="border border-slate-800 px-2 py-1.5 font-semibold text-slate-700"><?php echo e($idx + 1); ?></td>
                            <td class="border border-slate-800 px-2 py-1.5 font-mono text-slate-600"><?php echo e($s->nis ?? '-'); ?></td>
                            <td class="border border-slate-800 px-3 py-1.5 text-left font-semibold text-slate-900 whitespace-nowrap"><?php echo e($s->nama); ?></td>
                            <td class="border border-slate-800 px-2 py-1.5 font-medium"><?php echo e(strtoupper($s->gender ?? 'L') === 'P' || strtolower($s->gender ?? '') === 'perempuan' ? 'P' : 'L'); ?></td>

                            <!-- Nilai per Mapel -->
                            <?php $__currentLoopData = $daftar_jadwal_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $n_mapel = $row->nilai_mapel[$j->mapel_id] ?? ['ada' => false, 'nilai_akhir' => null, 'tuntas' => false];
                                ?>
                                <td class="border border-slate-800 px-2 py-1.5 font-semibold <?php echo e($n_mapel['ada'] ? ($n_mapel['tuntas'] ? 'text-slate-800' : 'text-rose-600') : 'text-slate-300'); ?>">
                                    <?php echo e($n_mapel['ada'] ? number_format($n_mapel['nilai_akhir'], 1) : '-'); ?>

                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <!-- Rekap Nilai -->
                            <td class="border border-slate-800 px-2 py-1.5 font-bold text-slate-900 bg-slate-50"><?php echo e(number_format($row->total_nilai, 1)); ?></td>
                            <td class="border border-slate-800 px-2 py-1.5 font-bold text-slate-900 bg-slate-50"><?php echo e(number_format($row->rata_rata, 1)); ?></td>
                            <td class="border border-slate-800 px-2 py-1.5 font-bold <?php echo e($row->predikat === 'A' ? 'text-emerald-700' : ($row->predikat === 'B' ? 'text-blue-700' : ($row->predikat === 'C' ? 'text-amber-700' : 'text-rose-700'))); ?> bg-slate-50"><?php echo e($row->predikat); ?></td>
                            <td class="border border-slate-800 px-2 py-1.5 font-black text-emerald-900 bg-emerald-50">#<?php echo e($row->peringkat); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="<?php echo e(8 + count($daftar_jadwal_mapel)); ?>" class="border border-slate-800 px-4 py-8 text-center text-slate-500">
                                Belum ada data santri di kelas ini.
                            </td>
                        </tr>
                    <?php endif; ?>

                    <!-- Baris Rata-rata Mapel Kelas -->
                    <?php if(count($leger_siswa) > 0): ?>
                        <tr class="bg-slate-100 font-bold text-slate-900 bg-header-th">
                            <td colspan="4" class="border border-slate-800 px-3 py-2 text-right uppercase">Rata-Rata Mata Pelajaran</td>
                            <?php $__currentLoopData = $daftar_jadwal_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $mapel_rekap = $rekap_mapel->firstWhere('mapel_id', $j->mapel_id);
                                ?>
                                <td class="border border-slate-800 px-2 py-2 text-center text-emerald-800 font-bold">
                                    <?php echo e($mapel_rekap ? number_format($mapel_rekap->rata_rata, 1) : '-'); ?>

                                </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <td colspan="4" class="border border-slate-800 px-2 py-2 text-center text-emerald-900 bg-slate-200">
                                Rata-Rata Kelas: <strong><?php echo e(number_format($stats_nilai['rata_kelas'] ?? 0, 1)); ?></strong>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tanda Tangan & Pengesahan Titimangsa -->
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 pt-6 text-xs text-slate-900 leading-relaxed page-avoid-break">
            <div>
                <p class="font-medium text-slate-600">Mengetahui,</p>
                <p class="font-bold text-slate-800">Kepala Sekolah,</p>
                <div class="h-20"></div>
                <p class="font-black underline text-slate-900"><?php echo e($pengaturan_rapor->nama_kepsek ?? 'Rajihul Haq, S.Sos'); ?></p>
                <p class="text-[11px] text-slate-600">NIP: <?php echo e($pengaturan_rapor->nip_kepsek ?? '-'); ?></p>
            </div>

            <div class="hidden sm:block"></div>

            <div class="text-right">
                <p class="font-medium text-slate-600">
                    <?php echo e($pengaturan_rapor->tempat_rapor ?? 'Sigi'); ?>, <?php echo e($pengaturan_rapor->tanggal_rapor ?? date('d F Y')); ?>

                </p>
                <p class="font-bold text-slate-800">Wali Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?>,</p>
                <div class="h-20"></div>
                <p class="font-black underline text-slate-900"><?php echo e($wallas->guru->nama ?? 'Wali Kelas'); ?></p>
                <p class="text-[11px] text-slate-600">NIG: <?php echo e($wallas->guru->nig ?? '-'); ?></p>
            </div>
        </div>

    </div>

</body>
</html>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/cetakLegerWalas.blade.php ENDPATH**/ ?>
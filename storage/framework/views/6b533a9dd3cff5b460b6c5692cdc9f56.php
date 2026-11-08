<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor Massal Kelas <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?> - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page {
            size: A4 portrait;
            margin: 12mm 15mm 15mm 15mm;
        }

        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background: white !important;
                color: #000 !important;
                padding: 0 !important;
            }
            .page-break {
                page-break-after: always !important;
                break-after: page !important;
            }
            .rapor-sheet {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
                margin-bottom: 0 !important;
                position: relative !important;
                min-height: 100vh !important;
            }
            .watermark-overlay {
                position: absolute !important;
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                pointer-events: none !important;
                z-index: 1 !important;
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

        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #f1f5f9;
            color: #0f172a;
        }

        .watermark-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 480px;
            max-width: 85%;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .watermark-image {
            width: 100%;
            height: auto;
            opacity: 0.07;
            filter: contrast(110%) brightness(95%);
            -webkit-print-color-adjust: exact;
        }
    </style>
</head>
<body class="p-4 sm:p-6 lg:p-8">

    <!-- Top Action Bar (Hidden on Print) -->
    <div class="no-print max-w-4xl mx-auto mb-6 bg-slate-900 text-white rounded-2xl p-4 shadow-lg flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <a href="/sk/rapor-walas<?php echo e(session('role') === 'a' ? '?kelas_id='.($wallas->kelas_id ?? '') : ''); ?>" class="w-9 h-9 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white flex items-center justify-center transition-colors">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h4 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa-solid fa-print text-emerald-400"></i>
                    Cetak Rapor Massal: <?php echo e($wallas->ruangKelas->nama_ruang ?? 'Kelas'); ?>

                </h4>
                <p class="text-xs text-slate-400 mt-0.5">
                    Menampilkan total <strong><?php echo e(count($data_massal)); ?></strong> berkas rapor santri siap cetak sekaligus.
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2.5">
            <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-md flex items-center gap-2">
                <i class="fa-solid fa-print"></i> Cetak Seluruh Rapor (Print / PDF)
            </button>
        </div>
    </div>

    <!-- LOOP SELURUH RAPOR SANTRI KELAS -->
    <?php if(empty($data_massal) || count($data_massal) === 0): ?>
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-12 text-center text-slate-500">
            <i class="fa-solid fa-users-slash text-4xl text-slate-300 mb-3"></i>
            <h4 class="text-base font-bold text-slate-700">Belum Ada Santri di Kelas Ini</h4>
            <p class="text-xs text-slate-400 mt-1">Tidak ada berkas rapor yang dapat dicetak karena rombel kelas ini belum memiliki data santri terdaftar.</p>
        </div>
    <?php endif; ?>

    <?php $__currentLoopData = $data_massal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $siswa = $item['siswa'];
            $rekap_nilai = $item['rekap_nilai'];
            $rekap_absensi = $item['rekap_absensi'];
            $rata_rata_rapor = $item['rata_rata_rapor'];
            $total_nilai_akhir = $item['total_nilai_akhir'];
            $raporMeta = $item['raporMeta'];
        ?>

        <div class="rapor-sheet max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-slate-200 p-8 sm:p-12 text-slate-900 relative overflow-hidden mb-8">
            
            <!-- WATERMARK OVERLAY (SD/SMP transparan, TK kosong tanpa logo) -->
            <?php if(!empty($raporMeta['watermark_logo'])): ?>
                <div class="watermark-overlay" aria-hidden="true">
                    <img src="<?php echo e($raporMeta['watermark_logo']); ?>" alt="Watermark Lembaga" class="watermark-image">
                </div>
            <?php endif; ?>

            <div class="relative z-10">
                
                <!-- 1. IDENTITAS SISWA & SEKOLAH (2 KOLOM KOP RESMI) -->
                <div class="mb-5 pb-3 border-b-2 border-slate-900">
                    <div class="grid grid-cols-2 gap-4 text-xs sm:text-sm">
                        <!-- Kolom Kiri: Siswa -->
                        <div class="space-y-1">
                            <div class="flex">
                                <span class="w-32 font-semibold text-slate-700">Nama Peserta Didik</span>
                                <span class="mr-2">:</span>
                                <span class="font-bold text-slate-900 uppercase"><?php echo e($siswa->nama); ?></span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-semibold text-slate-700">NIS / NISN</span>
                                <span class="mr-2">:</span>
                                <span class="text-slate-900"><?php echo e($siswa->nis ?? '-'); ?> / <?php echo e($siswa->nisn ?? '-'); ?></span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-semibold text-slate-700">Sekolah</span>
                                <span class="mr-2">:</span>
                                <span class="text-slate-900 font-semibold"><?php echo e($raporMeta['nama_sekolah']); ?></span>
                            </div>
                            <div class="flex">
                                <span class="w-32 font-semibold text-slate-700">Alamat</span>
                                <span class="mr-2">:</span>
                                <span class="text-slate-900">Tinggede, Marawola, Sigi</span>
                            </div>
                        </div>

                        <!-- Kolom Kanan: Kelas & Semester -->
                        <div class="space-y-1">
                            <div class="flex">
                                <span class="w-28 font-semibold text-slate-700">Kelas</span>
                                <span class="mr-2">:</span>
                                <span class="font-bold text-slate-900"><?php echo e($raporMeta['kelas_label']); ?></span>
                            </div>
                            <div class="flex">
                                <span class="w-28 font-semibold text-slate-700">Fase</span>
                                <span class="mr-2">:</span>
                                <span class="font-bold text-slate-900"><?php echo e($raporMeta['fase']); ?></span>
                            </div>
                            <div class="flex">
                                <span class="w-28 font-semibold text-slate-700">Semester</span>
                                <span class="mr-2">:</span>
                                <span class="text-slate-900"><?php echo e(($tahun_aktif->semester ?? 1) == 2 ? '2 (Genap)' : '1 (Ganjil)'); ?></span>
                            </div>
                            <div class="flex">
                                <span class="w-28 font-semibold text-slate-700">Tahun Pelajaran</span>
                                <span class="mr-2">:</span>
                                <span class="text-slate-900"><?php echo e($tahun_aktif->nama ?? '2025/2026'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. JUDUL RAPOR -->
                <div class="text-center mb-5">
                    <h2 class="text-base sm:text-lg font-bold tracking-wide uppercase text-slate-900">
                        LAPORAN HASIL BELAJAR
                    </h2>
                </div>

                <!-- 3. TABEL NILAI MATA PELAJARAN (CAPAIAN KOMPETENSI) -->
                <div class="mb-5 overflow-x-auto">
                    <table class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-900 font-bold text-center">
                                <th class="border border-slate-800 px-2 py-2 w-10">No</th>
                                <th class="border border-slate-800 px-3 py-2 text-left w-52 sm:w-60">Mata Pelajaran</th>
                                <th class="border border-slate-800 px-2 py-2 w-20">Nilai Akhir</th>
                                <th class="border border-slate-800 px-3 py-2 text-left">Capaian Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $__empty_1 = true; $__currentLoopData = $rekap_nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2 text-center font-medium align-top"><?php echo e($nomor++); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 font-semibold text-slate-900 align-top"><?php echo e($mapel); ?></td>
                                    <td class="border border-slate-800 px-2 py-2 text-center font-bold align-top <?php echo e($data['ada_nilai'] ? ($data['nilai_akhir'] >= ($data['kkm'] ?? 75) ? 'text-slate-900' : 'text-rose-600') : 'text-slate-400'); ?>">
                                        <?php echo e($data['ada_nilai'] ? number_format($data['nilai_akhir'], 0) : '-'); ?>

                                    </td>
                                    <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed align-top">
                                        <?php echo e($data['deskripsi']); ?>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="border border-slate-800 px-4 py-6 text-center text-slate-400 italic">
                                        Belum ada jadwal atau nilai mata pelajaran yang terdata.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- 4. TABEL PROGRAM KEGIATAN SEKOLAH -->
                <div class="mb-5 overflow-x-auto">
                    <table class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-900 font-bold text-center">
                                <th class="border border-slate-800 px-2 py-2 w-10">No</th>
                                <th class="border border-slate-800 px-3 py-2 text-left w-52 sm:w-60">Program Kegiatan Sekolah</th>
                                <th class="border border-slate-800 px-3 py-2 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $raporMeta['kegiatan_sekolah_default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 font-semibold text-slate-900 align-top"><?php echo e($keg['kegiatan']); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 text-xs sm:text-xs text-slate-800 leading-relaxed align-top"><?php echo e($keg['keterangan']); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- 5. TABEL JENIS PRESTASI -->
                <div class="mb-5 overflow-x-auto">
                    <table class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-900 font-bold text-center">
                                <th class="border border-slate-800 px-2 py-2 w-10">No</th>
                                <th class="border border-slate-800 px-3 py-2 text-left">Jenis Prestasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $raporMeta['prestasi_default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="border border-slate-800 px-2 py-2 text-center font-medium align-top"><?php echo e($loop->iteration); ?></td>
                                    <td class="border border-slate-800 px-3 py-2 text-slate-900 font-medium align-top"><?php echo e($pres); ?></td>
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
                <div class="mb-5 overflow-x-auto w-full sm:w-80">
                    <table class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-900 font-bold">
                                <th colspan="2" class="border border-slate-800 px-3 py-1.5 text-left">Ketidakhadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-slate-800 px-3 py-1 text-slate-700 w-36">Sakit</td>
                                <td class="border border-slate-800 px-3 py-1 text-center font-semibold text-slate-900"><?php echo e($rekap_absensi['sakit'] ?? 0); ?> hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-800 px-3 py-1 text-slate-700">Izin</td>
                                <td class="border border-slate-800 px-3 py-1 text-center font-semibold text-slate-900"><?php echo e($rekap_absensi['izin'] ?? 0); ?> hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-800 px-3 py-1 text-slate-700">Tanpa Keterangan</td>
                                <td class="border border-slate-800 px-3 py-1 text-center font-semibold text-slate-900"><?php echo e($rekap_absensi['alpa'] ?? 0); ?> hari</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 7. CATATAN WALI KELAS -->
                <div class="mb-6">
                    <table class="w-full border-collapse border border-slate-800 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-900 font-bold">
                                <th class="border border-slate-800 px-3 py-1.5 text-left">Catatan Wali Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border border-slate-800 p-3 sm:p-4 text-xs sm:text-xs text-slate-800 leading-relaxed font-sans min-h-[70px] whitespace-pre-line">
                                    <?php echo e($raporMeta['catatan_walas_default']); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 8. TANDA TANGAN (3 KOLOM PENGESAHAN) -->
                <div class="grid grid-cols-3 gap-2 sm:gap-4 text-center text-xs sm:text-sm pt-2">
                    <!-- Kolom 1: Orang Tua -->
                    <div class="flex flex-col justify-between h-36">
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">Mengetahui,</p>
                            <p class="font-medium text-slate-800 leading-tight">Orang Tua / Wali,</p>
                        </div>
                        <div>
                            <p class="font-bold underline text-slate-900">....................................................</p>
                        </div>
                    </div>

                    <!-- Kolom 2: Wali Kelas -->
                    <div class="flex flex-col justify-between h-36">
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">&nbsp;</p>
                            <p class="font-medium text-slate-800 leading-tight">Wali Kelas <?php echo e($raporMeta['kelas_label']); ?>,</p>
                        </div>
                        <div>
                            <p class="font-bold underline text-slate-900">
                                <?php echo e($wallas->guru->nama ?? 'Wali Kelas'); ?>

                            </p>
                            <?php if(!empty($wallas->guru->nig)): ?>
                                <p class="text-[11px] text-slate-600 mt-0.5">NIG. <?php echo e($wallas->guru->nig); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Kolom 3: Kepala Sekolah -->
                    <div class="flex flex-col justify-between h-36">
                        <div>
                            <p class="font-medium text-slate-800 leading-tight">
                                <?php echo e($raporMeta['tempat_rapor'] ?? 'Sigi'); ?>, <?php echo e($raporMeta['tanggal_rapor']); ?>

                            </p>
                            <p class="font-medium text-slate-800 leading-tight">Kepala Sekolah,</p>
                        </div>
                        <div>
                            <p class="font-bold underline text-slate-900">
                                <?php echo e($raporMeta['nama_kepsek']); ?>

                            </p>
                            <?php if(!empty($raporMeta['nip_kepsek']) && $raporMeta['nip_kepsek'] !== '-'): ?>
                                <p class="text-[11px] text-slate-600 mt-0.5">NIP. <?php echo e($raporMeta['nip_kepsek']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Pemisah Halaman Cetak Antar Santri -->
        <?php if(!$loop->last): ?>
            <div class="page-break"></div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</body>
</html>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/cetakRaporMassal.blade.php ENDPATH**/ ?>
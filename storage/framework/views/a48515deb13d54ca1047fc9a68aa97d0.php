<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Raport Tahfizh Al-Qur'an — SDQU Imam Syafi'i</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Rapor -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/rapor_walas.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">

    <style>
        body {
            background-color: #ECE8DE;
            margin: 0;
            padding: 20px 0 80px 0;
            font-family: 'Poppins', sans-serif;
        }

        .mass-print-toolbar {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 9999;
            background: #ffffff;
            border-radius: 50px;
            padding: 10px 22px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            display: flex;
            align-items: center;
            gap: 12px;
            border: 2px solid var(--primary-color);
        }

        .sheet-action-bar {
            max-width: 860px;
            margin: 0 auto 10px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            padding: 10px 18px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            border: 1px solid #d5ccbd;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-sheet-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 13px;
            font-size: 12px;
            font-weight: 700;
            border-radius: 8px;
            border: 1px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-sheet-dup {
            background: #e0f2fe;
            color: #0369a1;
            border-color: #7dd3fc;
        }
        .btn-sheet-dup:hover {
            background: #bae6fd;
        }

        .btn-sheet-edit {
            background: #FAF8F2;
            color: #333;
            border-color: #d5ccbd;
        }
        .btn-sheet-edit:hover {
            background: #f0ebe0;
        }

        .btn-sheet-print {
            background: #0B3B2E;
            color: #fff;
        }
        .btn-sheet-print:hover {
            background: #1B6B4F;
        }

        .btn-sheet-delete {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }
        .btn-sheet-delete:hover {
            background: #fee2e2;
        }

        .bio-interactive {
            transition: background 0.15s ease;
            padding: 2px 4px;
            border-radius: 4px;
            display: inline-block;
        }
        .bio-interactive:hover {
            background: rgba(16, 185, 129, 0.15);
            outline: 1px dashed #10b981;
            cursor: pointer;
        }

        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
            }
            .mass-print-toolbar,
            .sheet-action-bar,
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-after: always;
                break-after: page;
            }

            body.printing-single-sheet .rapor-print-container:not(.active-print-target),
            body.printing-single-sheet .page-break {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- FLOATING ACTION TOOLBAR (NO-PRINT) -->
    <div class="mass-print-toolbar no-print">
        <span style="font-size: 13px; font-weight: 700; color: var(--primary-dark);">
            <i class="fa-solid fa-layer-group"></i> Total: <?php echo e($daftar_siswa->count()); ?> Dokumen Raport
        </span>
        <!-- TOMBOL DUPLIKAT DI VISUAL CETAK -->
        <button type="button" onclick="openDuplicateModalFromPrint()" class="btn-tahfiz-secondary" style="border-radius: 30px; border-color: #0284c7; color: #0369a1; background: #e0f2fe; padding: 8px 18px; font-weight: 700; font-size: 12.5px;">
            <i class="fa-solid fa-copy"></i> Duplikat Rapor Baru
        </button>
        <button type="button" onclick="window.print()" class="btn-tahfiz-primary" style="border-radius: 30px; padding: 8px 18px; font-size: 12.5px;">
            <i class="fa-solid fa-print"></i> Cetak Seluruhnya
        </button>
        <button type="button" onclick="window.close()" class="btn-tahfiz-secondary" style="border-radius: 30px; padding: 8px 16px; font-size: 12.5px;">
            <i class="fa-solid fa-xmark"></i> Tutup
        </button>
    </div>

    <!-- LOOP SELURUH SANTRI DALAM ROMBEL -->
    <?php $__currentLoopData = $daftar_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $eval = $evaluasi_map->get($siswa->id);
            $template = \App\Models\evaluasi_rapor_tahfidz::getDefaultTemplate($siswa);

            // Nilai 4 Bulan
            $nb1 = $eval->nilai_bulan_1 ?? ($eval->ujian_1 ?? null);
            $nb2 = $eval->nilai_bulan_2 ?? ($eval->ujian_2 ?? null);
            $nb3 = $eval->nilai_bulan_3 ?? ($eval->ujian_akhir ?? null);
            $nb4 = $eval->nilai_bulan_4 ?? null;
            $hasScores = ($nb1 !== null || $nb2 !== null || $nb3 !== null || $nb4 !== null);
            $totalAkhir = $eval->ujian_jumlah ?? ($hasScores ? (($nb1 ?? 0) + ($nb2 ?? 0) + ($nb3 ?? 0) + ($nb4 ?? 0)) : null);
            $rata = $eval->ujian_rata_rata ?? ($hasScores ? round($totalAkhir / 4, 1) : null);
            $pred = $eval->ujian_predikat ?? ($rata !== null ? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rata) : '-');

            $semIya = ($eval->tercapai_target_semester ?? $template['tercapai_target_semester']);
            $klsIya = ($eval->tercapai_target_kelas ?? $template['tercapai_target_kelas']);

            $namaLengkapVal = $eval->nama_lengkap ?? $siswa->nama;
            $kelasLabelVal = $eval->kelas_label ?? $template['kelas_label'];
            $umurVal = $eval->umur ?? $template['umur'];
            $ortuVal = $eval->orang_tua ?? $template['orang_tua'];
        ?>

        <!-- ACTION BAR DI ATAS LEMBAR VISUAL (NO-PRINT) -->
        <div class="sheet-action-bar no-print">
            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <span style="font-size: 13.5px; font-weight: 700; color: #16241f;">
                    <i class="fa-solid fa-user-graduate text-emerald-600"></i>
                    <span id="labelNama-<?php echo e($siswa->id); ?>"><?php echo e(strtoupper($namaLengkapVal)); ?></span>
                </span>
                <span style="font-size: 11px; background: #e8f2ec; color: #1B6B4F; font-weight: 700; padding: 2px 8px; border-radius: 6px;">
                    <span id="labelKelas-<?php echo e($siswa->id); ?>"><?php echo e($kelasLabelVal); ?></span>
                </span>
                <?php if(!empty($siswa->is_manual)): ?>
                    <span style="font-size: 10.5px; background: #fef3c7; color: #92400e; font-weight: 800; padding: 2px 8px; border-radius: 6px; border: 1px solid #fcd34d;">
                        <i class="fa-solid fa-user-tag"></i> Non-Sistem
                    </span>
                <?php endif; ?>
            </div>

            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                <!-- TOMBOL DUPLIKAT LEMBAR INI -->
                <button type="button" onclick="openDuplicateModalFromSheet('<?php echo e($siswa->id); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>', '<?php echo e(addslashes($kelasLabelVal)); ?>', '<?php echo e(addslashes($umurVal)); ?>', '<?php echo e(addslashes($ortuVal)); ?>')" class="btn-sheet-action btn-sheet-dup" title="Duplikat lembar ini untuk santri non-sistem">
                    <i class="fa-solid fa-copy"></i> Duplikat Lembar Ini
                </button>
                <!-- TOMBOL UBAH DATA SANTRI LANGSUNG -->
                <button type="button" onclick="openEditBioModal('<?php echo e($siswa->id); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>', '<?php echo e(addslashes($kelasLabelVal)); ?>', '<?php echo e(addslashes($umurVal)); ?>', '<?php echo e(addslashes($ortuVal)); ?>')" class="btn-sheet-action btn-sheet-edit" title="Ubah Nama, Kelas, Umur, dan Orang Tua santri ini">
                    <i class="fa-solid fa-pen-to-square"></i> Ubah Data Santri
                </button>
                <!-- TOMBOL CETAK LEMBAR INI -->
                <button type="button" onclick="printSingleSheet('sheet-container-<?php echo e($siswa->id); ?>')" class="btn-sheet-action btn-sheet-print" title="Cetak lembar santri ini saja">
                    <i class="fa-solid fa-print"></i> Cetak Lembar Ini
                </button>
                <?php if(!empty($siswa->is_manual)): ?>
                    <button type="button" onclick="deleteManualRapor('<?php echo e(str_replace('manual-', '', $siswa->id)); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>')" class="btn-sheet-action btn-sheet-delete" title="Hapus santri non-sistem ini">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- LEMBAR FISIK VISUAL RAPORT TAHFIZH -->
        <div class="rapor-print-container" id="sheet-container-<?php echo e($siswa->id); ?>" style="margin-bottom: 30px;">

            <!-- WATERMARK LOGO RESMI TRANSPARAN DI TENGAH LEMBAR (UKURAN BESAR MEMENUHI KERTAS, TIDAK TERPOTONG) -->
            <div class="rapor-watermark-overlay" aria-hidden="true">
                <img src="<?php echo e(asset('img/logo_sd.jpg')); ?>" alt="Watermark SDQU Tinggede">
            </div>

            <div class="rapor-sheet-content">

                <!-- HEADER DOKUMEN -->
                <div class="tahfiz-doc-header">
                    <h2>RAPORT TAHFIZH AL-QUR’AN SEMESTER <?php echo e(($tahun_aktif->semester ?? 1) == 1 ? 'GANJIL' : 'GENAP'); ?> <?php echo e($tahun_aktif->nama ? preg_replace('/[^0-9]/', '', substr($tahun_aktif->nama, 0, 4)) : '2026'); ?></h2>
                    <h3>SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE</h3>
                </div>

                <!-- DATA IDENTITAS SANTRI (MANUAL / CUSTOM) -->
                <table class="tahfiz-bio-table">
                    <tr>
                        <td class="tahfiz-bio-label">NAMA LENGKAP</td>
                        <td style="width: 15px;">:</td>
                        <td>
                            <span class="bio-interactive" id="bioNama-<?php echo e($siswa->id); ?>" onclick="openEditBioModal('<?php echo e($siswa->id); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>', '<?php echo e(addslashes($kelasLabelVal)); ?>', '<?php echo e(addslashes($umurVal)); ?>', '<?php echo e(addslashes($ortuVal)); ?>')" title="Klik untuk ubah nama lengkap santri">
                                <?php echo e(strtoupper($namaLengkapVal)); ?>

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tahfiz-bio-label">KELAS</td>
                        <td>:</td>
                        <td>
                            <span class="bio-interactive" id="bioKelas-<?php echo e($siswa->id); ?>" onclick="openEditBioModal('<?php echo e($siswa->id); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>', '<?php echo e(addslashes($kelasLabelVal)); ?>', '<?php echo e(addslashes($umurVal)); ?>', '<?php echo e(addslashes($ortuVal)); ?>')" title="Klik untuk ubah kelas">
                                <?php echo e($kelasLabelVal); ?>

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tahfiz-bio-label">UMUR</td>
                        <td>:</td>
                        <td>
                            <span class="bio-interactive" id="bioUmur-<?php echo e($siswa->id); ?>" onclick="openEditBioModal('<?php echo e($siswa->id); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>', '<?php echo e(addslashes($kelasLabelVal)); ?>', '<?php echo e(addslashes($umurVal)); ?>', '<?php echo e(addslashes($ortuVal)); ?>')" title="Klik untuk ubah umur">
                                <?php echo e($umurVal); ?>

                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tahfiz-bio-label">ORANG TUA/WALI</td>
                        <td>:</td>
                        <td>
                            <span class="bio-interactive" id="bioOrtu-<?php echo e($siswa->id); ?>" onclick="openEditBioModal('<?php echo e($siswa->id); ?>', '<?php echo e(addslashes($namaLengkapVal)); ?>', '<?php echo e(addslashes($kelasLabelVal)); ?>', '<?php echo e(addslashes($umurVal)); ?>', '<?php echo e(addslashes($ortuVal)); ?>')" title="Klik untuk ubah orang tua/wali">
                                <?php echo e($ortuVal); ?>

                            </span>
                        </td>
                    </tr>
                </table>

                <!-- A. UJIAN KENAIKAN JUZ -->
                <div class="tahfiz-section-title">A. UJIAN KENAIKAN JUZ</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th style="width: 45%;">TANGGAL</th>
                            <th style="width: 25%;">JUZ</th>
                            <th style="width: 30%;">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;"><?php echo e($eval->kenaikan_juz_tanggal ?? $template['kenaikan_juz_tanggal']); ?></td>
                            <td style="text-align: center; font-weight: 700;"><?php echo e($eval->kenaikan_juz_nomor ?? $template['kenaikan_juz_nomor']); ?></td>
                            <td style="text-align: center; font-weight: 700;"><?php echo e($eval->kenaikan_juz_predikat ?? $template['kenaikan_juz_predikat']); ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- B. UJIAN TASMI' (4 BULAN DENGAN HEADER BISA DIEDIT) -->
                <div class="tahfiz-section-title">B. UJIAN TASMI’</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th style="width: 14%;"><?php echo e($eval->bulan_1_label ?? $template['bulan_1_label'] ?? 'AGUSTUS'); ?></th>
                            <th style="width: 14%;"><?php echo e($eval->bulan_2_label ?? $template['bulan_2_label'] ?? 'SEPTEMBER'); ?></th>
                            <th style="width: 14%;"><?php echo e($eval->bulan_3_label ?? $template['bulan_3_label'] ?? 'OKTOBER'); ?></th>
                            <th style="width: 14%;"><?php echo e($eval->bulan_4_label ?? $template['bulan_4_label'] ?? 'NOVEMBER'); ?></th>
                            <th style="width: 16%;">TOTAL NILAI AKHIR</th>
                            <th style="width: 14%;">NILAI RATA-RATA</th>
                            <th style="width: 14%;">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;"><?php echo e($nb1 !== null ? number_format($nb1, 0) : ''); ?></td>
                            <td style="text-align: center;"><?php echo e($nb2 !== null ? number_format($nb2, 0) : ''); ?></td>
                            <td style="text-align: center;"><?php echo e($nb3 !== null ? number_format($nb3, 0) : ''); ?></td>
                            <td style="text-align: center;"><?php echo e($nb4 !== null ? number_format($nb4, 0) : ''); ?></td>
                            <td style="text-align: center; font-weight: 700;"><?php echo e($totalAkhir !== null ? number_format($totalAkhir, 0) : ''); ?></td>
                            <td style="text-align: center; font-weight: 700;"><?php echo e($rata !== null ? number_format($rata, 1, ',', '') : ''); ?></td>
                            <td style="text-align: center; font-weight: 800;"><?php echo e($pred); ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- C. UJIAN TAHFIZ TERBUKA -->
                <div class="tahfiz-section-title">C. UJIAN TAHFIZ TERBUKA</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th style="width: 45%;">TANGGAL</th>
                            <th style="width: 25%;">JUMLAH JUZ</th>
                            <th style="width: 30%;">PREDIKAT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center;"><?php echo e($eval->ujian_terbuka_tanggal ?? ($eval->tasmi_tanggal ?? $template['ujian_terbuka_tanggal'] ?? '-')); ?></td>
                            <td style="text-align: center;"><?php echo e($eval->ujian_terbuka_jumlah_juz ?? ($eval->tasmi_jumlah_juz ?? $template['ujian_terbuka_jumlah_juz'] ?? '-')); ?></td>
                            <td style="text-align: center;"><?php echo e($eval->ujian_terbuka_predikat ?? ($eval->tasmi_predikat ?? $template['ujian_terbuka_predikat'] ?? '-')); ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- D. PENCAPAIAN TAHFIZH -->
                <div class="tahfiz-section-title">D. PENCAPAIAN TAHFIZH</div>
                <table class="tahfiz-table-clean">
                    <thead>
                        <tr>
                            <th colspan="2" style="width: 34%;">HAFALAN SEMESTER</th>
                            <th colspan="2" style="width: 34%;">TOTAL HAFALAN</th>
                            <th colspan="2" style="width: 16%;">TERCAPAI TARGET SEMESTER</th>
                            <th colspan="2" style="width: 16%;">TERCAPAI TARGET KELAS</th>
                        </tr>
                        <tr>
                            <th style="font-size: 11px;">Target</th>
                            <th style="font-size: 11px;">Tercapai</th>
                            <th style="font-size: 11px;">Target</th>
                            <th style="font-size: 11px;">Tercapai</th>
                            <th style="font-size: 11px; width: 8%;">Iya</th>
                            <th style="font-size: 11px; width: 8%;">Tidak</th>
                            <th style="font-size: 11px; width: 8%;">Iya</th>
                            <th style="font-size: 11px; width: 8%;">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; font-weight: 600;"><?php echo e($eval->target_semester ?? $template['target_semester']); ?></td>
                            <td style="font-size: 11px; line-height: 1.35;"><?php echo e($eval->tercapai_semester ?? $template['tercapai_semester']); ?></td>
                            <td style="text-align: center; font-weight: 600;"><?php echo e($eval->target_total ?? $template['target_total']); ?></td>
                            <td style="font-size: 11px; line-height: 1.35;"><?php echo e($eval->tercapai_total ?? $template['tercapai_total']); ?></td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;"><?php echo $semIya ? '√' : ''; ?></td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;"><?php echo !$semIya ? '√' : ''; ?></td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;"><?php echo $klsIya ? '√' : ''; ?></td>
                            <td style="text-align: center; font-weight: 800; font-size: 14px;"><?php echo !$klsIya ? '√' : ''; ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- CATATAN PENGAMPU HALAQAH -->
                <div class="tahfiz-catatan-wrapper">
                    <div class="tahfiz-catatan-title">CATATAN PENGAMPU HALAQAH :</div>

                    <div class="tahfiz-catatan-sub">Bacaan (Makharijul Huruf. Tajwid)</div>
                    <div class="tahfiz-catatan-text"><?php echo e($eval->catatan_bacaan ?? $template['catatan_bacaan']); ?></div>

                    <div class="tahfiz-catatan-sub">Hafalan (Itqan/Kelancaran)</div>
                    <div class="tahfiz-catatan-text"><?php echo e($eval->catatan_hafalan ?? $template['catatan_hafalan']); ?></div>

                    <div class="tahfiz-catatan-sub">Akhlak</div>
                    <div class="tahfiz-catatan-text"><?php echo e($eval->catatan_akhlak ?? $template['catatan_akhlak']); ?></div>
                </div>

                <!-- TANDA TANGAN & TITIMANGSA (3 TANDA TANGAN: KIRI PENGAMPU, KANAN WALI KELAS, TENGAH BAWAH KEPSEK) -->
                <div style="margin-top: 24px; page-break-inside: avoid;">
                    <table style="width: 100%; text-align: center; font-size: 11.5px; border-collapse: collapse; margin-bottom: 8px;">
                        <tr>
                            <!-- Kiri: Pengampu Halaqah -->
                            <td style="width: 46%; vertical-align: top;">
                                <div style="color: transparent; user-select: none;">&nbsp;</div>
                                <div style="font-weight: 500;">Tertanda,</div>
                                <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                    <?php if(!empty($eval->ttd_pengampu)): ?>
                                        <img src="<?php echo e($eval->ttd_pengampu); ?>" alt="TTD Pengampu" style="max-height: 52px;">
                                    <?php endif; ?>
                                </div>
                                <strong style="text-decoration: underline; font-size: 12.5px;"><?php echo e($eval->nama_pengampu ?? $template['nama_pengampu'] ?? 'NURUL ZHAFIRAH PUTRI'); ?></strong>
                                <div style="font-size: 11px; color: #333; margin-top: 2px;"><?php echo e($eval->role_pengampu_label ?? $template['role_pengampu_label'] ?? 'Pengampu Halaqah & Wali Kelas 5A'); ?></div>
                            </td>

                            <td style="width: 8%;"></td>

                            <!-- Kanan: Wali Kelas (disertai Titimangsa) -->
                            <td style="width: 46%; vertical-align: top;">
                                <div>
                                    <span><?php echo e($eval->tempat_rapor ?? $template['tempat_rapor']); ?></span>, 
                                    <span><?php echo e($eval->tanggal_rapor ?? $template['tanggal_rapor']); ?></span>
                                </div>
                                <div style="font-weight: 500;"><?php echo e($eval->role_walas_label ?? $template['role_walas_label'] ?? 'Wali Kelas'); ?>,</div>
                                <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                    <?php if(!empty($eval->ttd_walas)): ?>
                                        <img src="<?php echo e($eval->ttd_walas); ?>" alt="TTD Walas" style="max-height: 52px;">
                                    <?php endif; ?>
                                </div>
                                <strong style="text-decoration: underline; font-size: 12.5px;"><?php echo e($eval->nama_walas ?? $template['nama_walas'] ?? 'NURUL ZHAFIRAH PUTRI'); ?></strong>
                                <div style="font-size: 11px; color: #333; margin-top: 2px;"><?php echo e($eval->role_walas_label ?? $template['role_walas_label'] ?? 'Wali Kelas'); ?></div>
                            </td>
                        </tr>

                        <!-- Baris 2: Tengah Bawah Kepala Sekolah -->
                        <tr>
                            <td colspan="3" style="text-align: center; vertical-align: top; padding-top: 14px;">
                                <div style="display: inline-block; min-width: 250px;">
                                    <div style="font-weight: 500;">Mengetahui,</div>
                                    <div style="font-size: 11px; color: #333; margin-top: 1px;"><?php echo e($eval->role_kepsek_label ?? $template['role_kepsek_label'] ?? 'Kepala Sekolah SDQU Imam Syafi’i'); ?></div>
                                    <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                        <?php if(!empty($eval->ttd_kepsek)): ?>
                                            <img src="<?php echo e($eval->ttd_kepsek); ?>" alt="TTD Kepsek" style="max-height: 52px;">
                                        <?php endif; ?>
                                    </div>
                                    <strong style="text-decoration: underline; font-size: 12.5px;"><?php echo e($eval->nama_kepsek ?? $template['nama_kepsek'] ?? 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q'); ?></strong>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- KETERANGAN PREDIKAT (FOOTER ACUAN RESMI) -->
                <div class="tahfiz-predikat-legend">
                    <strong>Keterangan Predikat :</strong><br>
                    Mumtaz/ A: 91-100 &nbsp;&nbsp;|&nbsp;&nbsp; Jayyid Jiddan/B : 83-90 &nbsp;&nbsp;|&nbsp;&nbsp; Jayyid/C : 72-82 &nbsp;&nbsp;|&nbsp;&nbsp; Maqbul/D : 61-71 &nbsp;&nbsp;|&nbsp;&nbsp; Dha’if/E : &lt;60
                </div>

            </div>
        </div>

        <?php if(!$loop->last): ?>
            <div class="page-break"></div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- ============================================================ -->
    <!-- MODAL DUPLIKAT RAPOR (NON-SISTEM) LANGSUNG DI VISUAL CETAK   -->
    <!-- ============================================================ -->
    <div id="duplicateModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: #fff; width: 100%; max-width: 520px; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
            <div style="padding: 18px 24px; background: #0369a1; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h4 style="font-size: 15px; margin: 0; font-weight: 700;">
                        <i class="fa-solid fa-copy"></i> Duplikat Rapor (Santri Non-Sistem)
                    </h4>
                    <p style="font-size: 11.5px; margin: 3px 0 0 0; color: #bae6fd;">
                        Ubah nama dan informasi santri untuk langsung dicetak di visual rapor.
                    </p>
                </div>
                <button type="button" onclick="closeDuplicateModal()" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="duplicateForm" onsubmit="submitDuplicateRapor(event)" style="padding: 24px;">
                <input type="hidden" id="dupSourceSiswaId" name="source_siswa_id" value="">
                <input type="hidden" id="dupKelasId" name="kelas_id" value="<?php echo e($kelasInfo->id ?? ''); ?>">

                <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px; margin-bottom: 16px; font-size: 12px; color: #166534; line-height: 1.4;">
                    <i class="fa-solid fa-circle-info"></i> Format rapor visual akan disalin secara otomatis. Silakan lengkapi identitas santri yang ingin dicetak:
                </div>

                <!-- Input Nama Lengkap -->
                <div style="margin-bottom: 12px;">
                    <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                        Nama Lengkap Santri <span style="color: #dc2626;">*</span>
                    </label>
                    <input type="text" id="dupNamaLengkap" name="nama_lengkap" class="editor-form-control" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" placeholder="Contoh: AHMAD FAUZAN" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                            Kelas <span style="color: #dc2626;">*</span>
                        </label>
                        <input type="text" id="dupKelasLabel" name="kelas_label" class="editor-form-control" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" value="VI (ENAM)" required>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                            Umur <span style="color: #dc2626;">*</span>
                        </label>
                        <input type="text" id="dupUmur" name="umur" class="editor-form-control" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" value="12 TAHUN" required>
                    </div>
                </div>

                <div style="margin-bottom: 16px;">
                    <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                        Orang Tua / Wali <span style="color: #dc2626;">*</span>
                    </label>
                    <input type="text" id="dupOrangTua" name="orang_tua" class="editor-form-control" style="width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" value="Bpk. ABDURRAHMAN & Ibu FATIMAH" required>
                </div>

                <!-- Opsi Salin -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 14px; margin-bottom: 20px;">
                    <span style="font-size: 11.5px; font-weight: 700; color: #475569; display: block; margin-bottom: 8px;">Pilihan Salin Konten Rapor:</span>
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; margin-bottom: 6px; cursor: pointer;">
                        <input type="checkbox" name="copy_nilai" value="1" checked> Salin Nilai 4 Bulan Ujian Tasmi' & Nilai Terbuka
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; margin-bottom: 6px; cursor: pointer;">
                        <input type="checkbox" name="copy_capaian" value="1" checked> Salin Capaian Target & Kenaikan Juz
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; margin-bottom: 6px; cursor: pointer;">
                        <input type="checkbox" name="copy_catatan" value="1" checked> Salin Catatan Pengampu (Bacaan, Hafalan, Akhlak)
                    </label>
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 12px; color: #334155; cursor: pointer;">
                        <input type="checkbox" name="copy_ttd" value="1" checked> Salin Tanda Tangan & Titimangsa
                    </label>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                    <button type="button" onclick="closeDuplicateModal()" class="btn-sheet-action btn-sheet-edit" style="padding: 8px 16px;">Batal</button>
                    <button type="submit" id="btnSubmitDuplicate" class="btn-sheet-action btn-sheet-dup" style="padding: 8px 18px; font-weight: 700; font-size: 13px; background: #0284c7; color: #fff;">
                        <i class="fa-solid fa-copy"></i> Simpan & Tampilkan di Visual
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- MODAL EDIT CEPAT IDENTITAS SANTRI LANGSUNG DI VISUAL CETAK   -->
    <!-- ============================================================ -->
    <div id="editBioModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 10000; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: #fff; width: 100%; max-width: 480px; border-radius: 16px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.3);">
            <div style="padding: 16px 22px; background: #1B6B4F; color: #fff; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h4 style="font-size: 15px; margin: 0; font-weight: 700;">
                        <i class="fa-solid fa-pen-to-square"></i> Ubah Data Santri di Visual Rapor
                    </h4>
                    <p style="font-size: 11.5px; margin: 2px 0 0 0; color: #d1fae5;">
                        Teks yang diubah langsung tampil di lembar cetak dan tersimpan.
                    </p>
                </div>
                <button type="button" onclick="closeEditBioModal()" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="editBioForm" onsubmit="submitEditBio(event)" style="padding: 22px;">
                <input type="hidden" id="editSiswaId" name="siswa_id" value="">

                <div style="margin-bottom: 12px;">
                    <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                        Nama Lengkap Santri:
                    </label>
                    <input type="text" id="editNamaLengkap" name="nama_lengkap" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 12px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                            Kelas:
                        </label>
                        <input type="text" id="editKelasLabel" name="kelas_label" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                            Umur:
                        </label>
                        <input type="text" id="editUmur" name="umur" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                    </div>
                </div>

                <div style="margin-bottom: 18px;">
                    <label style="font-size: 12px; font-weight: 700; color: #333; margin-bottom: 4px; display: block;">
                        Orang Tua / Wali:
                    </label>
                    <input type="text" id="editOrangTua" name="orang_tua" class="editor-form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px;" required>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid #e2e8f0; padding-top: 14px;">
                    <button type="button" onclick="closeEditBioModal()" class="btn-sheet-action btn-sheet-edit" style="padding: 8px 16px;">Batal</button>
                    <button type="submit" id="btnSubmitBio" class="btn-sheet-action btn-sheet-print" style="padding: 8px 18px; font-size: 13px; background: #1B6B4F;">
                        <i class="fa-solid fa-floppy-disk"></i> Terapkan ke Lembar Ini
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT DUPLIKASI & INTERAKSI VISUAL -->
    <script>
        const POST_URL = '<?php echo e(url("/tf/gr/simpan-evaluasi-rapor")); ?>';
        const CSRF_TOKEN = '<?php echo e(csrf_token()); ?>';

        // 1. DUPLIKAT DARI TOOLBAR
        function openDuplicateModalFromPrint() {
            <?php
                $firstSiswa = $daftar_siswa->first();
                $firstSiswaId = $firstSiswa ? $firstSiswa->id : '';
                $firstEval = $firstSiswa ? $evaluasi_map->get($firstSiswa->id) : null;
                $firstTpl = $firstSiswa ? \App\Models\evaluasi_rapor_tahfidz::getDefaultTemplate($firstSiswa) : null;
            ?>
            openDuplicateModalFromSheet(
                '<?php echo e($firstSiswaId); ?>',
                '',
                '<?php echo e(addslashes($firstEval->kelas_label ?? $firstTpl['kelas_label'] ?? 'VI (ENAM)')); ?>',
                '<?php echo e(addslashes($firstEval->umur ?? $firstTpl['umur'] ?? '12 TAHUN')); ?>',
                '<?php echo e(addslashes($firstEval->orang_tua ?? $firstTpl['orang_tua'] ?? 'Bpk. ABDURRAHMAN & Ibu FATIMAH')); ?>'
            );
        }

        // 2. DUPLIKAT DARI LEMBAR SPESIFIK
        function openDuplicateModalFromSheet(siswaId, nama, kelas, umur, ortu) {
            document.getElementById('dupSourceSiswaId').value = siswaId;
            document.getElementById('dupNamaLengkap').value = '';
            document.getElementById('dupKelasLabel').value = kelas || 'VI (ENAM)';
            document.getElementById('dupUmur').value = umur || '12 TAHUN';
            document.getElementById('dupOrangTua').value = ortu || 'Bpk. ABDURRAHMAN & Ibu FATIMAH';

            document.getElementById('duplicateModal').style.display = 'flex';
            setTimeout(() => document.getElementById('dupNamaLengkap').focus(), 100);
        }

        function closeDuplicateModal() {
            document.getElementById('duplicateModal').style.display = 'none';
        }

        // 3. SUBMIT DUPLIKAT
        function submitDuplicateRapor(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitDuplicate');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menduplikat...';

            const form = document.getElementById('duplicateForm');
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());
            payload.action = 'duplicate';
            payload.is_duplikat = '1';
            payload.copy_nilai = form.querySelector('[name="copy_nilai"]').checked ? '1' : '0';
            payload.copy_capaian = form.querySelector('[name="copy_capaian"]').checked ? '1' : '0';
            payload.copy_catatan = form.querySelector('[name="copy_catatan"]').checked ? '1' : '0';
            payload.copy_ttd = form.querySelector('[name="copy_ttd"]').checked ? '1' : '0';

            fetch(POST_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Alhamdulillah! Rapor berhasil diduplikat untuk santri baru: ' + data.nama_lengkap);
                    // Reload halaman agar lembar baru langsung masuk ke visual cetak
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('siswa_id')) {
                        // Jika sedang melihat single sheet, buka single sheet untuk yang baru diduplikat
                        window.location.href = data.print_url || window.location.href;
                    } else {
                        window.location.reload();
                    }
                } else {
                    alert(data.message || 'Gagal menduplikat rapor.');
                    btn.disabled = false;
                    btn.innerHTML = originalHtml;
                }
            })
            .catch(err => {
                alert('Terjadi kesalahan saat memproses duplikasi rapor.');
                btn.disabled = false;
                btn.innerHTML = originalHtml;
            });
        }

        // 4. EDIT IDENTITAS SANTRI LANGSUNG
        function openEditBioModal(siswaId, nama, kelas, umur, ortu) {
            document.getElementById('editSiswaId').value = siswaId;
            document.getElementById('editNamaLengkap').value = nama;
            document.getElementById('editKelasLabel').value = kelas;
            document.getElementById('editUmur').value = umur;
            document.getElementById('editOrangTua').value = ortu;

            document.getElementById('editBioModal').style.display = 'flex';
            setTimeout(() => document.getElementById('editNamaLengkap').focus(), 100);
        }

        function closeEditBioModal() {
            document.getElementById('editBioModal').style.display = 'none';
        }

        function submitEditBio(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitBio');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

            const form = document.getElementById('editBioForm');
            const formData = new FormData(form);
            const payload = Object.fromEntries(formData.entries());
            payload.action = 'update_bio';

            fetch(POST_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;

                if (res.success && res.data) {
                    const sid = res.data.siswa_id;
                    const nm = (res.data.nama_lengkap || '').toUpperCase();
                    const kl = res.data.kelas_label || '';
                    const um = res.data.umur || '';
                    const ot = res.data.orang_tua || '';

                    // Update live pada visual DOM lembar tersebut
                    const elNama = document.getElementById('bioNama-' + sid);
                    if (elNama) elNama.innerText = nm;
                    const elKelas = document.getElementById('bioKelas-' + sid);
                    if (elKelas) elKelas.innerText = kl;
                    const elUmur = document.getElementById('bioUmur-' + sid);
                    if (elUmur) elUmur.innerText = um;
                    const elOrtu = document.getElementById('bioOrtu-' + sid);
                    if (elOrtu) elOrtu.innerText = ot;

                    const lblNama = document.getElementById('labelNama-' + sid);
                    if (lblNama) lblNama.innerText = nm;
                    const lblKelas = document.getElementById('labelKelas-' + sid);
                    if (lblKelas) lblKelas.innerText = kl;

                    closeEditBioModal();
                } else {
                    alert(res.message || 'Gagal menyimpan perubahan identitas.');
                }
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                alert('Terjadi kesalahan koneksi.');
            });
        }

        // 5. CETAK LEMBAR INI SAJA
        function printSingleSheet(containerId) {
            const targetContainer = document.getElementById(containerId);
            if (!targetContainer) {
                window.print();
                return;
            }

            document.querySelectorAll('.rapor-print-container').forEach(el => el.classList.remove('active-print-target'));
            targetContainer.classList.add('active-print-target');
            document.body.classList.add('printing-single-sheet');

            window.print();

            setTimeout(() => {
                document.body.classList.remove('printing-single-sheet');
                targetContainer.classList.remove('active-print-target');
            }, 1000);
        }

        // 6. HAPUS SANTRI MANUAL
        function deleteManualRapor(manualId, nama) {
            if (!confirm('Apakah Anda yakin ingin menghapus lembar rapor santri manual: ' + nama + '?')) return;

            fetch(POST_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    action: 'delete_manual',
                    manual_id: manualId
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Rapor santri manual berhasil dihapus.');
                    window.location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus.');
                }
            })
            .catch(err => alert('Terjadi kesalahan saat menghapus data.'));
        }
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/tahfiz/guru/cetakRaporMassal.blade.php ENDPATH**/ ?>
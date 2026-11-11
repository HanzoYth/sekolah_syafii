<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapor Tahfidz Al-Qur'an — SDQU Imam Syafi'i</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama Dashboard & Rapor Tahfiz -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboard.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/rapor_walas.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR TAHFIZ -->
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

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Raport Tahfizh Al-Qur'an</h2>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 4px;">
                        Monitoring ujian tahfidzh, kenaikan juz, tasmi', capaian hafalan santri, dan cetak dokumen resmi.
                    </p>
                </div>
                <div class="topbar-icons">
                    <a href="/tf/gr/dash" title="Dashboard Guru" style="color: var(--text-muted); text-decoration: none;">
                        <i class="fa-solid fa-house"></i>
                    </a>
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            
            <?php if(session('success')): ?>
                <div style="background: #E8F5E9; border: 1px solid #A5D6A7; color: #1B5E20; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-circle-check" style="font-size: 18px;"></i>
                        <div>
                            <strong style="font-size: 13px;">Berhasil!</strong>
                            <p style="font-size: 12px; margin: 0;"><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                    <button type="button" onclick="this.parentElement.remove()" style="background: none; border: none; cursor: pointer; color: #1B5E20;">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            <?php endif; ?>

            <!-- STATISTIK RINGKASAN RAPOR -->
            <div class="rapor-stats-grid">
                <div class="rapor-stat-card">
                    <div class="rapor-stat-icon emerald">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <div class="rapor-stat-info">
                        <h4>Kelas / Rombel</h4>
                        <?php
                            $currentKelas = $daftar_semua_kelas->firstWhere('id', $kelas_id);
                        ?>
                        <h3><?php echo e($currentKelas->nama_ruang ?? 'Kelas 6'); ?></h3>
                        <p>Tahun: <?php echo e($tahun_aktif->nama ?? '2025/2026'); ?> (Semester <?php echo e(($tahun_aktif->semester ?? 1) == 1 ? 'Ganjil' : 'Genap'); ?>)</p>
                    </div>
                </div>

                <div class="rapor-stat-card">
                    <div class="rapor-stat-icon gold">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="rapor-stat-info">
                        <h4>Total Santri</h4>
                        <h3><?php echo e($total_santri); ?> Santri</h3>
                        <p>Aktif dalam Rombel</p>
                    </div>
                </div>

                <div class="rapor-stat-card">
                    <div class="rapor-stat-icon blue">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </div>
                    <div class="rapor-stat-info">
                        <h4>Status Rapor Tersimpan</h4>
                        <h3><?php echo e($sudah_lengkap); ?> / <?php echo e($total_santri); ?></h3>
                        <p><?php echo e($belum_lengkap); ?> Santri Menggunakan Template Acuan</p>
                    </div>
                </div>

                <div class="rapor-stat-card">
                    <div class="rapor-stat-icon purple">
                        <i class="fa-solid fa-book-quran"></i>
                    </div>
                    <div class="rapor-stat-info">
                        <h4>Target Hafalan</h4>
                        <h3 style="font-size: 16px;">Target Semester: 1 Juz</h3>
                        <p>Target Keseluruhan Kelas: 9 Juz</p>
                    </div>
                </div>
            </div>

            <!-- TOOLBAR AKSI & FILTER KELAS -->
            <div class="rapor-toolbar-card">
                <!-- Tab Switcher -->
                <div class="rapor-tab-pills">
                    <a href="javascript:void(0)" onclick="switchTab('tab-cetak')" id="tabBtn-cetak" class="rapor-tab-pill active">
                        <i class="fa-solid fa-file-contract"></i> Cetak Dokumen Rapor
                    </a>
                    <a href="javascript:void(0)" onclick="switchTab('tab-leger')" id="tabBtn-leger" class="rapor-tab-pill">
                        <i class="fa-solid fa-table-list"></i> Leger Nilai Ujian Tahfidz
                    </a>
                </div>

                <!-- Filter & Cetak Massal -->
                <div class="rapor-action-buttons">
                    <!-- Dropdown Pilih Rombel -->
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <label for="selectKelas" style="font-size: 12px; font-weight: 600; color: var(--text-muted);">Pilih Kelas:</label>
                        <select id="selectKelas" onchange="changeKelas(this.value)" style="padding: 7px 12px; border-radius: 8px; border: 1px solid var(--border-color); font-size: 12px; background: #FAF8F2; font-weight: 600; color: var(--text-dark);">
                            <?php $__currentLoopData = $daftar_semua_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>" <?php echo e($kelas_id == $k->id ? 'selected' : ''); ?>>
                                    <?php echo e($k->nama_ruang); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Tombol Input Nilai & Cetak Massal -->
                    <?php
                        $inputNilaiUrl = request()->is('tf/gr/rapor*') 
                            ? url('/tf/gr/input-nilai?kelas_id='.$kelas_id)
                            : url('/tf/gr/rp?view=input_nilai&kelas_id='.$kelas_id);
                        $printMassalUrl = request()->is('tf/gr/rapor*') 
                            ? url('/tf/gr/rapor?print=massal&kelas_id='.$kelas_id)
                            : url('/tf/gr/rp?view=cetak_massal&kelas_id='.$kelas_id);
                    ?>
                    <a href="<?php echo e($inputNilaiUrl); ?>" class="btn-tahfiz-gold">
                        <i class="fa-solid fa-pen-to-square"></i> Input Nilai Rapor
                    </a>
                    <a href="<?php echo e($printMassalUrl); ?>" target="_blank" class="btn-tahfiz-primary">
                        <i class="fa-solid fa-print"></i> Cetak Rapor Massal
                    </a>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- TAB 1: DAFTAR SANTRI & CETAK RAPOR PER SISWA                -->
            <!-- ============================================================ -->
            <div id="content-tab-cetak">
                <div class="rapor-table-card">
                    <div class="rapor-table-header">
                        <h4>
                            <i class="fa-solid fa-users text-emerald-600"></i>
                            Daftar Santri — <?php echo e($currentKelas->nama_ruang ?? 'Kelas 6'); ?>

                        </h4>
                        <div class="rapor-search-box">
                            <i class="fa-solid fa-magnifying-glass" style="color: #999; font-size: 12px;"></i>
                            <input type="text" id="searchSantriInput" placeholder="Cari santri atau NISN..." onkeyup="filterSantriTable()">
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="rapor-table" id="santriTable">
                            <thead>
                                <tr>
                                    <th style="width: 45px; text-align: center;">No</th>
                                    <th>Nama Santri</th>
                                    <th>NISN</th>
                                    <th>Kenaikan Juz</th>
                                    <th style="text-align: center;">Ujian Tahfidzh</th>
                                    <th style="text-align: center;">Target Semester</th>
                                    <th style="text-align: center;">Status Data</th>
                                    <th style="text-align: right; width: 220px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $eval = $evaluasi_list->get($s->id);
                                        $initials = collect(explode(' ', $s->nama))->map(fn($part) => substr($part, 0, 1))->take(2)->join('');
                                        
                                        $u1 = $eval->ujian_1 ?? 75.0;
                                        $u2 = $eval->ujian_2 ?? 92.0;
                                        $ua = $eval->ujian_akhir ?? 75.0;
                                        $rataRata = $eval->ujian_rata_rata ?? round(($u1 + $u2 + ($ua * 2)) / 4, 1);
                                        $predikat = $eval->ujian_predikat ?? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rataRata);

                                        $juzKe = $eval->kenaikan_juz_nomor ?? '25';
                                        $juzPred = $eval->kenaikan_juz_predikat ?? 'Jayyid/C';

                                        // URL Detail Rapor
                                        $detailUrl = request()->is('tf/gr/rapor*')
                                            ? url('/tf/gr/detail-rapor/'.$s->id)
                                            : url('/tf/gr/rp?view=detail_rapor&siswa_id='.$s->id);
                                    ?>
                                    <tr class="santri-row">
                                        <td style="text-align: center; font-weight: 600; color: #666;">
                                            <?php echo e($loop->iteration); ?>

                                        </td>
                                        <td>
                                            <div class="rapor-student-cell">
                                                <div class="rapor-student-avatar">
                                                    <?php echo e(strtoupper($initials)); ?>

                                                </div>
                                                <div class="rapor-student-meta">
                                                    <h5><?php echo e($s->nama); ?></h5>
                                                    <span><?php echo e($s->gender == 'l' ? 'Ikhwan' : 'Akhwat'); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="font-family: monospace; font-size: 12px; color: #555;">
                                            <?php echo e($s->nis ?: '-'); ?>

                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: var(--primary-dark);">Juz <?php echo e($juzKe); ?></span>
                                            <span style="font-size: 11px; color: #666; display: block;">Predikat: <strong><?php echo e($juzPred); ?></strong></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span style="font-size: 13px; font-weight: 700; color: #111;"><?php echo e(number_format($rataRata, 1, ',', '.')); ?></span>
                                            <div style="margin-top: 2px;">
                                                <?php if(str_contains($predikat, 'Mumtaz') || str_contains($predikat, '/A')): ?>
                                                    <span class="rapor-badge sb"><i class="fa-solid fa-star"></i> <?php echo e($predikat); ?></span>
                                                <?php elseif(str_contains($predikat, 'Jayyid Jiddan') || str_contains($predikat, '/B')): ?>
                                                    <span class="rapor-badge bsh"><i class="fa-solid fa-check"></i> <?php echo e($predikat); ?></span>
                                                <?php elseif(str_contains($predikat, 'Jayyid') || str_contains($predikat, '/C')): ?>
                                                    <span class="rapor-badge mb"><?php echo e($predikat); ?></span>
                                                <?php else: ?>
                                                    <span class="rapor-badge bb"><?php echo e($predikat); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                                $targetOk = $eval ? $eval->tercapai_target_semester : false;
                                            ?>
                                            <?php if($targetOk): ?>
                                                <span class="rapor-badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span>
                                            <?php else: ?>
                                                <span class="rapor-badge warning"><i class="fa-solid fa-circle-xmark"></i> Belum Tercapai</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($eval): ?>
                                                <span class="rapor-badge success">
                                                    <i class="fa-solid fa-check-double"></i> Tersimpan
                                                </span>
                                            <?php else: ?>
                                                <span class="rapor-badge neutral">
                                                    <i class="fa-solid fa-file"></i> Template Acuan
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: right; white-space: nowrap;">
                                            <a href="<?php echo e($detailUrl); ?>" class="btn-tahfiz-primary" style="padding: 6px 12px; font-size: 11.5px;">
                                                <i class="fa-solid fa-print"></i> Lihat & Cetak
                                            </a>
                                            <button type="button" onclick="openQuickEvalModal(<?php echo e($s->id); ?>, '<?php echo e(addslashes($s->nama)); ?>', <?php echo e($u1); ?>, <?php echo e($u2); ?>, <?php echo e($ua); ?>, '<?php echo e($juzKe); ?>', '<?php echo e($juzPred); ?>')" class="btn-tahfiz-secondary" style="padding: 6px 10px; font-size: 11.5px;" title="Nilai Cepat">
                                                <i class="fa-solid fa-sliders"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="8" style="text-align: center; padding: 36px; color: #888;">
                                            <i class="fa-solid fa-user-xmark" style="font-size: 28px; margin-bottom: 8px; color: #bbb;"></i>
                                            <p style="margin: 0; font-size: 13px;">Belum ada santri terdaftar pada rombel ini.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- TAB 2: LEGER NILAI UJIAN TAHFIDZ                             -->
            <!-- ============================================================ -->
            <div id="content-tab-leger" style="display: none;">
                <div class="rapor-table-card">
                    <div class="rapor-table-header">
                        <h4>
                            <i class="fa-solid fa-table-list text-emerald-600"></i>
                            Leger Nilai Ujian Tahfidzh Al-Qur'an — <?php echo e($currentKelas->nama_ruang ?? 'Kelas 6'); ?>

                        </h4>
                        <span style="font-size: 11px; background: var(--gold-light); color: var(--gold); padding: 4px 10px; border-radius: 6px; font-weight: 700;">
                            Standar Penilaian SDQU Imam Syafi'i Tinggede
                        </span>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="rapor-table">
                            <thead>
                                <tr>
                                    <th style="width: 45px; text-align: center;">No</th>
                                    <th>Nama Santri</th>
                                    <th style="text-align: center;">Kenaikan Juz</th>
                                    <th style="text-align: center;">Ujian 1</th>
                                    <th style="text-align: center;">Ujian 2</th>
                                    <th style="text-align: center;">Ujian Akhir (x2)</th>
                                    <th style="text-align: center;">Jumlah Nilai</th>
                                    <th style="text-align: center;">Rata-rata</th>
                                    <th style="text-align: center;">Predikat</th>
                                    <th style="text-align: center;">Target Semester</th>
                                    <th style="text-align: right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $eval = $evaluasi_list->get($s->id);
                                        $u1 = $eval->ujian_1 ?? 75.0;
                                        $u2 = $eval->ujian_2 ?? 92.0;
                                        $ua = $eval->ujian_akhir ?? 75.0;
                                        $jml = $u1 + $u2 + ($ua * 2);
                                        $rata = round($jml / 4, 1);
                                        $pred = $eval->ujian_predikat ?? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rata);
                                        $juzNomor = $eval->kenaikan_juz_nomor ?? '25';
                                        $isTarget = $eval ? $eval->tercapai_target_semester : false;

                                        $detailUrl = request()->is('tf/gr/rapor*')
                                            ? url('/tf/gr/detail-rapor/'.$s->id)
                                            : url('/tf/gr/rp?view=detail_rapor&siswa_id='.$s->id);
                                    ?>
                                    <tr>
                                        <td style="text-align: center; font-weight: 600;"><?php echo e($loop->iteration); ?></td>
                                        <td style="font-weight: 600; color: #222;"><?php echo e($s->nama); ?></td>
                                        <td style="text-align: center; font-weight: 700; color: var(--primary-dark);">Juz <?php echo e($juzNomor); ?></td>
                                        <td style="text-align: center;"><?php echo e(number_format($u1, 1)); ?></td>
                                        <td style="text-align: center;"><?php echo e(number_format($u2, 1)); ?></td>
                                        <td style="text-align: center;"><?php echo e(number_format($ua, 1)); ?> <span style="font-size: 11px; color: #888;">(<?php echo e(number_format($ua * 2, 1)); ?>)</span></td>
                                        <td style="text-align: center; font-weight: 700;"><?php echo e(number_format($jml, 1)); ?></td>
                                        <td style="text-align: center; font-weight: 800; color: var(--primary-color);"><?php echo e(number_format($rata, 1, ',', '.')); ?></td>
                                        <td style="text-align: center;">
                                            <span class="rapor-badge <?php echo e(str_contains($pred, 'A') || str_contains($pred, 'Mumtaz') ? 'sb' : (str_contains($pred, 'B') ? 'bsh' : 'mb')); ?>">
                                                <?php echo e($pred); ?>

                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php if($isTarget): ?>
                                                <span class="rapor-badge success">Iya</span>
                                            <?php else: ?>
                                                <span class="rapor-badge warning">Tidak</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="text-align: right;">
                                            <a href="<?php echo e($detailUrl); ?>" class="btn-tahfiz-secondary" style="padding: 4px 10px; font-size: 11px;">
                                                <i class="fa-solid fa-file-invoice"></i> Buka Rapor
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- ============================================================ -->
    <!-- MODAL CEPAT EVALUASI UJIAN TAHFIDZ                          -->
    <!-- ============================================================ -->
    <div id="quickEvalModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: #fff; width: 100%; max-width: 520px; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div style="padding: 18px 24px; background: var(--primary-dark); color: #fff; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h4 style="font-size: 15px; margin: 0; font-weight: 700;">Penilaian Cepat Ujian Tahfidzh</h4>
                    <p id="modalSantriNama" style="font-size: 12px; margin: 2px 0 0 0; color: #A7D7C5;"></p>
                </div>
                <button type="button" onclick="closeQuickEvalModal()" style="background: none; border: none; color: #fff; font-size: 18px; cursor: pointer;">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="quickEvalForm" onsubmit="submitQuickEval(event)" style="padding: 24px;">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="siswa_id" id="modalSiswaId">
                <input type="hidden" name="semester" value="<?php echo e($tahun_aktif->semester ?? 1); ?>">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px;">
                    <div>
                        <label style="font-size: 11.5px; font-weight: 700; color: #444; margin-bottom: 4px; display: block;">Ujian Kenaikan Juz Ke-</label>
                        <input type="text" id="modalJuzNomor" class="editor-form-control" placeholder="Contoh: 25" value="25" required>
                    </div>
                    <div>
                        <label style="font-size: 11.5px; font-weight: 700; color: #444; margin-bottom: 4px; display: block;">Predikat Kenaikan Juz</label>
                        <select id="modalJuzPredikat" class="editor-form-control">
                            <option value="Mumtaz/A">Mumtaz / A</option>
                            <option value="Jayyid Jiddan/B">Jayyid Jiddan / B</option>
                            <option value="Jayyid/C" selected>Jayyid / C</option>
                            <option value="Maqbul/D">Maqbul / D</option>
                            <option value="Dha'if/E">Dha'if / E</option>
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1.2fr; gap: 10px; margin-bottom: 14px;">
                    <div>
                        <label style="font-size: 11.5px; font-weight: 700; color: #444; margin-bottom: 4px; display: block;">Ujian 1</label>
                        <input type="number" step="0.1" id="modalU1" class="editor-form-control" style="font-weight: 700; text-align: center;" oninput="recalcModal()" required>
                    </div>
                    <div>
                        <label style="font-size: 11.5px; font-weight: 700; color: #444; margin-bottom: 4px; display: block;">Ujian 2</label>
                        <input type="number" step="0.1" id="modalU2" class="editor-form-control" style="font-weight: 700; text-align: center;" oninput="recalcModal()" required>
                    </div>
                    <div>
                        <label style="font-size: 11.5px; font-weight: 700; color: #444; margin-bottom: 4px; display: block;">Ujian Akhir (x2)</label>
                        <input type="number" step="0.1" id="modalUA" class="editor-form-control" style="font-weight: 700; text-align: center;" oninput="recalcModal()" required>
                    </div>
                </div>

                <!-- Hasil Kalkulasi Otomatis -->
                <div style="background: #F4F0E6; border: 1px solid var(--border-color); border-radius: 8px; padding: 12px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <span style="font-size: 11px; color: #666; display: block;">Jumlah Nilai:</span>
                        <strong id="modalJumlah" style="font-size: 15px; color: #222;">317</strong>
                    </div>
                    <div style="text-align: center;">
                        <span style="font-size: 11px; color: #666; display: block;">Nilai Rata-rata:</span>
                        <strong id="modalRata" style="font-size: 16px; color: var(--primary-color);">79.2</strong>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-size: 11px; color: #666; display: block;">Predikat:</span>
                        <span id="modalPredikatBadge" class="rapor-badge mb" style="font-size: 12px;">Jayyid/C</span>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; border-top: 1px solid var(--border-color); padding-top: 16px;">
                    <button type="button" onclick="closeQuickEvalModal()" class="btn-tahfiz-secondary">Batal</button>
                    <button type="submit" id="btnSubmitModal" class="btn-tahfiz-primary">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Nilai
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        // Ganti Tab Cetak vs Leger
        function switchTab(tabId) {
            const cetakContent = document.getElementById('content-tab-cetak');
            const legerContent = document.getElementById('content-tab-leger');
            const btnCetak = document.getElementById('tabBtn-cetak');
            const btnLeger = document.getElementById('tabBtn-leger');

            if (tabId === 'tab-cetak') {
                cetakContent.style.display = 'block';
                legerContent.style.display = 'none';
                btnCetak.classList.add('active');
                btnLeger.classList.remove('active');
            } else {
                cetakContent.style.display = 'none';
                legerContent.style.display = 'block';
                btnCetak.classList.remove('active');
                btnLeger.classList.add('active');
            }
        }

        // Pindah Kelas via Select
        function changeKelas(kelasId) {
            const url = new URL(window.location.href);
            url.searchParams.set('kelas_id', kelasId);
            window.location.href = url.toString();
        }

        // Filter Santri Table via Search Box
        function filterSantriTable() {
            const query = document.getElementById('searchSantriInput').value.toLowerCase();
            const rows = document.querySelectorAll('#santriTable tbody tr.santri-row');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }

        // Kalkulasi Predikat Nilai Tahfidz
        function hitungPredikatTahfidz(nilai) {
            if (nilai >= 91) return 'Mumtaz/A';
            if (nilai >= 83) return 'Jayyid Jiddan/B';
            if (nilai >= 72) return 'Jayyid/C';
            if (nilai >= 61) return 'Maqbul/D';
            return 'Dha’if/E';
        }

        function recalcModal() {
            const u1 = parseFloat(document.getElementById('modalU1').value) || 0;
            const u2 = parseFloat(document.getElementById('modalU2').value) || 0;
            const ua = parseFloat(document.getElementById('modalUA').value) || 0;
            
            const jml = u1 + u2 + (ua * 2);
            const rata = Math.round((jml / 4) * 10) / 10;
            const pred = hitungPredikatTahfidz(rata);

            document.getElementById('modalJumlah').innerText = jml.toFixed(1);
            document.getElementById('modalRata').innerText = rata.toFixed(1);

            const badge = document.getElementById('modalPredikatBadge');
            badge.innerText = pred;
            badge.className = 'rapor-badge ' + (pred.includes('/A') ? 'sb' : (pred.includes('/B') ? 'bsh' : 'mb'));
        }

        function openQuickEvalModal(siswaId, nama, u1, u2, ua, juzNo, juzPred) {
            document.getElementById('modalSiswaId').value = siswaId;
            document.getElementById('modalSantriNama').innerText = 'Santri: ' + nama;
            document.getElementById('modalU1').value = u1;
            document.getElementById('modalU2').value = u2;
            document.getElementById('modalUA').value = ua;
            document.getElementById('modalJuzNomor').value = juzNo || '25';
            document.getElementById('modalJuzPredikat').value = juzPred || 'Jayyid/C';

            recalcModal();
            document.getElementById('quickEvalModal').style.display = 'flex';
        }

        function closeQuickEvalModal() {
            document.getElementById('quickEvalModal').style.display = 'none';
        }

        function submitQuickEval(e) {
            e.preventDefault();
            const btn = document.getElementById('btnSubmitModal');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

            const siswaId = document.getElementById('modalSiswaId').value;
            const u1 = parseFloat(document.getElementById('modalU1').value) || 0;
            const u2 = parseFloat(document.getElementById('modalU2').value) || 0;
            const ua = parseFloat(document.getElementById('modalUA').value) || 0;
            const juzNo = document.getElementById('modalJuzNomor').value;
            const juzPred = document.getElementById('modalJuzPredikat').value;

            const postUrl = '<?php echo e(url("/tf/gr/simpan-evaluasi-rapor")); ?>';

            fetch(postUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    siswa_id: siswaId,
                    ujian_1: u1,
                    ujian_2: u2,
                    ujian_akhir: ua,
                    kenaikan_juz_nomor: juzNo,
                    kenaikan_juz_predikat: juzPred
                })
            })
            .then(res => res.json())
            .then(data => {
                alert('Nilai Ujian Tahfidzh berhasil disimpan!');
                window.location.reload();
            })
            .catch(err => {
                window.location.reload();
            });
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/raporWalas.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Nilai Raport Tahfizh Al-Qur'an — SDQU Imam Syafi'i</title>
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
<?php
    $default_template = $default_template ?? \App\Models\evaluasi_rapor_tahfidz::getDefaultTemplate();
?>

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
        <main class="main-content" style="padding-bottom: 90px;">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Input Nilai Raport Tahfizh Al-Qur'an</h2>
                    <p style="font-size: 13px; color: var(--text-muted); margin-top: 4px;">
                        Input massal ujian tasmi' (4 bulan), kenaikan juz, ujian tahfiz terbuka, capaian target hafalan, dan data santri manual.
                    </p>
                </div>
                <div class="topbar-icons">
                    <?php
                        $raporUrl = request()->is('tf/gr/rapor*') || request()->is('tf/gr/input-nilai*')
                            ? url('/tf/gr/rapor?kelas_id='.$kelas_id)
                            : url('/tf/gr/rp?view=rapor&kelas_id='.$kelas_id);
                    ?>
                    <a href="<?php echo e($raporUrl); ?>" title="Ke Halaman Cetak Rapor" class="btn-tahfiz-secondary" style="padding: 6px 14px; font-size: 12px;">
                        <i class="fa-solid fa-file-contract"></i> Cetak Rapor
                    </a>
                    <a href="/tf/gr/dash" title="Dashboard Guru" style="color: var(--text-muted); text-decoration: none;">
                        <i class="fa-solid fa-house"></i>
                    </a>
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

            <!-- PILIH KELAS & INFO TAHUN AKADEMIK -->
            <div class="rapor-toolbar-card">
                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                    <label for="selectKelas" style="font-size: 13px; font-weight: 700; color: var(--primary-dark);">
                        <i class="fa-solid fa-school text-emerald-600"></i> Pilih Rombongan Belajar:
                    </label>
                    <select id="selectKelas" onchange="changeKelas(this.value)" style="padding: 8px 16px; border-radius: 10px; border: 1.5px solid var(--primary-color); font-size: 13px; background: #FAF8F2; font-weight: 700; color: var(--text-dark);">
                        <?php $__currentLoopData = $daftar_semua_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id); ?>" <?php echo e($kelas_id == $k->id ? 'selected' : ''); ?>>
                                <?php echo e($k->nama_ruang); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div style="display: flex; align-items: center; gap: 10px; font-size: 12px; color: var(--text-muted);">
                    <span><i class="fa-solid fa-calendar-check text-emerald-600"></i> Semester: <strong><?php echo e(($tahun_aktif->semester ?? 1) == 1 ? '1 (Ganjil)' : '2 (Genap)'); ?></strong></span>
                    <span>•</span>
                    <span>Tahun: <strong><?php echo e($tahun_aktif->nama ?? '2026'); ?></strong></span>
                    <span>•</span>
                    <span>Lembaga: <strong>SDQU Imam Syafi’i Tinggede</strong></span>
                </div>
            </div>

            <!-- FORM UTAMA INPUT NILAI MASSAL -->
            <?php
                $formAction = request()->is('tf/gr/input-nilai*')
                    ? url('/tf/gr/simpan-massal-nilai')
                    : url('/tf/gr/simpan-massal-nilai');
                
                $sampleEval = $evaluasi_list->first();
                $b1Val = $sampleEval->bulan_1_label ?? $default_template['bulan_1_label'] ?? 'AGUSTUS';
                $b2Val = $sampleEval->bulan_2_label ?? $default_template['bulan_2_label'] ?? 'SEPTEMBER';
                $b3Val = $sampleEval->bulan_3_label ?? $default_template['bulan_3_label'] ?? 'OKTOBER';
                $b4Val = $sampleEval->bulan_4_label ?? $default_template['bulan_4_label'] ?? 'NOVEMBER';
            ?>
            <form action="<?php echo e($formAction); ?>" method="POST" id="formInputNilai">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="kelas_id" value="<?php echo e($kelas_id); ?>">

                <!-- ============================================================ -->
                <!-- SECTION 1: MASTER PENGATURAN TEKS 4 BULAN, TARGET & PENGESAHAN-->
                <!-- ============================================================ -->
                <div class="input-nilai-card" style="margin-bottom: 20px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border-color); padding-bottom: 12px; margin-bottom: 16px; flex-wrap: wrap; gap: 8px;">
                        <h4 style="font-size: 15px; font-weight: 700; color: var(--primary-dark); margin: 0; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-sliders text-emerald-600"></i> Pengaturan Format Kelas (Teks 4 Bulan, Target & Pengesahan)
                        </h4>
                        <span style="font-size: 11px; background: #D1E7DD; color: #064E3B; padding: 4px 12px; border-radius: 6px; font-weight: 700;">
                            Otomatis Diterapkan ke Seluruh Santri di Rombel Ini
                        </span>
                    </div>

                    <!-- Teks 4 Bulan Bagian B -->
                    <div style="background: #FAF8F2; padding: 14px 16px; border-radius: 10px; border: 1px solid var(--border-color); margin-bottom: 14px;">
                        <label style="font-size: 12px; font-weight: 700; color: var(--primary-dark); display: block; margin-bottom: 8px;">
                            <i class="fa-solid fa-calendar-days text-emerald-600"></i> Teks Header 4 Bulan Bagian B (Bisa Diedit Bebas):
                        </label>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 10px;">
                            <div>
                                <label style="font-size: 11px; color: #555;">Bulan 1:</label>
                                <input type="text" name="bulan_1_label" id="masterBulan1" class="editor-form-control" value="<?php echo e($b1Val); ?>" oninput="updateTableMonthHeaders()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                            <div>
                                <label style="font-size: 11px; color: #555;">Bulan 2:</label>
                                <input type="text" name="bulan_2_label" id="masterBulan2" class="editor-form-control" value="<?php echo e($b2Val); ?>" oninput="updateTableMonthHeaders()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                            <div>
                                <label style="font-size: 11px; color: #555;">Bulan 3:</label>
                                <input type="text" name="bulan_3_label" id="masterBulan3" class="editor-form-control" value="<?php echo e($b3Val); ?>" oninput="updateTableMonthHeaders()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                            <div>
                                <label style="font-size: 11px; color: #555;">Bulan 4:</label>
                                <input type="text" name="bulan_4_label" id="masterBulan4" class="editor-form-control" value="<?php echo e($b4Val); ?>" oninput="updateTableMonthHeaders()" style="font-weight: 700; text-transform: uppercase;">
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 14px;">
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Target Hafalan Semester:</label>
                            <input type="text" name="target_semester" class="editor-form-control" value="<?php echo e($sampleEval->target_semester ?? $default_template['target_semester'] ?? '1 Juz'); ?>" required>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Target Total Hafalan Kelas:</label>
                            <input type="text" name="target_total" class="editor-form-control" value="<?php echo e($sampleEval->target_total ?? $default_template['target_total'] ?? '9 Juz'); ?>" required>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Tempat & Tanggal Titimangsa:</label>
                            <div style="display: flex; gap: 6px;">
                                <input type="text" name="tempat_rapor" class="editor-form-control" style="width: 85px;" value="<?php echo e($sampleEval->tempat_rapor ?? $default_template['tempat_rapor'] ?? 'Sigi'); ?>" required>
                                <input type="text" name="tanggal_rapor" class="editor-form-control" value="<?php echo e($sampleEval->tanggal_rapor ?? $default_template['tanggal_rapor'] ?? '19 Desember 2026'); ?>" required>
                            </div>
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Pengampu Halaqah (Kiri):</label>
                            <input type="text" name="nama_pengampu" class="editor-form-control" value="<?php echo e($sampleEval->nama_pengampu ?? $default_template['nama_pengampu'] ?? 'NURUL ZHAFIRAH PUTRI'); ?>" required>
                            <input type="text" name="role_pengampu_label" class="editor-form-control" style="margin-top: 4px; font-size: 11px;" value="<?php echo e($sampleEval->role_pengampu_label ?? $default_template['role_pengampu_label'] ?? 'Pengampu Halaqah & Wali Kelas 5A'); ?>">
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Wali Kelas (Kanan):</label>
                            <input type="text" name="nama_walas" class="editor-form-control" value="<?php echo e($sampleEval->nama_walas ?? $default_template['nama_walas'] ?? 'NURUL ZHAFIRAH PUTRI'); ?>" required>
                            <input type="text" name="role_walas_label" class="editor-form-control" style="margin-top: 4px; font-size: 11px;" value="<?php echo e($sampleEval->role_walas_label ?? $default_template['role_walas_label'] ?? 'Wali Kelas'); ?>" placeholder="Jabatan / Label (Contoh: Wali Kelas 6)">
                        </div>
                        <div class="editor-form-group" style="margin: 0;">
                            <label>Kepala Sekolah (Tengah Bawah):</label>
                            <input type="text" name="nama_kepsek" class="editor-form-control" value="<?php echo e($sampleEval->nama_kepsek ?? $default_template['nama_kepsek'] ?? 'NABILAH TUL ISLAMIYAH S.Pd.,S.Q'); ?>" required>
                            <input type="text" name="role_kepsek_label" class="editor-form-control" style="margin-top: 4px; font-size: 11px;" value="<?php echo e($sampleEval->role_kepsek_label ?? $default_template['role_kepsek_label'] ?? 'Kepala Sekolah SDQU Imam Syafi’i'); ?>" placeholder="Jabatan / Label (Contoh: Kepala Sekolah SDQU Imam Syafi’i)">
                        </div>
                    </div>

                    <!-- Keterangan Rumus & Skala Predikat Resmi -->
                    <div style="background: #D1E7DD; border: 1px solid #A5D6A7; border-radius: 8px; padding: 10px 14px; font-size: 11.5px; color: #064E3B;">
                        <strong style="color: #064E3B;"><i class="fa-solid fa-scale-balanced"></i> Skala Predikat Resmi SDQU Imam Syafi'i:</strong>
                        <span style="font-weight: 700; margin-left: 8px;">
                            Mumtaz/A: 91–100 &nbsp;|&nbsp; Jayyid Jiddan/B: 83–90 &nbsp;|&nbsp; Jayyid/C: 72–82 &nbsp;|&nbsp; Maqbul/D: 61–71 &nbsp;|&nbsp; Dha’if/E: &lt;60
                        </span>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- SECTION 2: TOOLBAR AKSI CEPAT & FILTER PENCARIAN              -->
                <!-- ============================================================ -->
                <div class="batch-action-toolbar">
                    <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                        <span style="font-size: 12px; font-weight: 700; color: var(--text-dark);">
                            <i class="fa-solid fa-wand-magic-sparkles text-emerald-600"></i> Aksi Cepat:
                        </span>
                        <button type="button" onclick="setTemplateValues()" class="quick-fill-btn bsh" title="Isi nilai contoh standar">
                            <i class="fa-solid fa-fill-drip"></i> Isi Nilai Standar (80, 85, 90, 85)
                        </button>
                        <button type="button" onclick="recalcAllRows()" class="quick-fill-btn sb" title="Hitung ulang seluruh rata-rata & predikat">
                            <i class="fa-solid fa-calculator"></i> Hitung Ulang Semua
                        </button>
                    </div>

                    <div class="rapor-search-box">
                        <i class="fa-solid fa-magnifying-glass" style="color: #999; font-size: 12px;"></i>
                        <input type="text" id="searchSantriInput" placeholder="Cari santri..." onkeyup="filterSantriTable()">
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- SECTION 3: TABEL MATRIKS PENILAIAN TAHFIDZ SELURUH SANTRI     -->
                <!-- ============================================================ -->
                <div class="rapor-table-card">
                    <div class="rapor-table-header">
                        <h4>
                            <i class="fa-solid fa-list-check text-emerald-600"></i>
                            Daftar Santri — <?php echo e($currentKelas->nama_ruang ?? 'Kelas 6'); ?> (<?php echo e(count($siswa)); ?> Santri)
                        </h4>
                        <div style="font-size: 12px; color: var(--text-muted);">
                            Data Nama, Kelas, Umur, Orang Tua, dan 4 Nilai Bulan dapat diisi langsung pada tabel.
                        </div>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="rapor-table" id="tableInputNilai">
                            <thead>
                                <tr>
                                    <th style="width: 35px; text-align: center;">No</th>
                                    <th style="min-width: 220px;">Data Santri (Nama, Kelas, Umur, Ortu)</th>
                                    <th style="min-width: 75px; text-align: center;" id="thBulan1"><?php echo e($b1Val); ?></th>
                                    <th style="min-width: 75px; text-align: center;" id="thBulan2"><?php echo e($b2Val); ?></th>
                                    <th style="min-width: 75px; text-align: center;" id="thBulan3"><?php echo e($b3Val); ?></th>
                                    <th style="min-width: 75px; text-align: center;" id="thBulan4"><?php echo e($b4Val); ?></th>
                                    <th style="min-width: 110px; text-align: center;">Total & Rata-rata</th>
                                    <th style="min-width: 120px; text-align: center;">Kenaikan Juz</th>
                                    <th style="min-width: 120px; text-align: center;">Tahfiz Terbuka</th>
                                    <th style="min-width: 140px;">Pencapaian Semester</th>
                                    <th style="min-width: 90px; text-align: center;">Target?</th>
                                    <th style="width: 60px; text-align: right;">Cetak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $eval = $evaluasi_list->get($s->id);
                                        $nb1 = $eval->nilai_bulan_1 ?? ($eval->ujian_1 ?? null);
                                        $nb2 = $eval->nilai_bulan_2 ?? ($eval->ujian_2 ?? null);
                                        $nb3 = $eval->nilai_bulan_3 ?? ($eval->ujian_akhir ?? null);
                                        $nb4 = $eval->nilai_bulan_4 ?? null;
                                        $hasScores = ($nb1 !== null || $nb2 !== null || $nb3 !== null || $nb4 !== null);
                                        $jml = $eval->ujian_jumlah ?? ($hasScores ? (($nb1 ?? 0) + ($nb2 ?? 0) + ($nb3 ?? 0) + ($nb4 ?? 0)) : null);
                                        $rata = $eval->ujian_rata_rata ?? ($hasScores ? round($jml / 4, 1) : null);
                                        $pred = $eval->ujian_predikat ?? ($rata !== null ? \App\Models\evaluasi_rapor_tahfidz::calculatePredikat($rata) : '-');

                                        $initials = collect(explode(' ', $s->nama))->map(fn($part) => substr($part, 0, 1))->take(2)->join('');

                                        $detailUrl = request()->is('tf/gr/input-nilai*') || request()->is('tf/gr/rapor*')
                                            ? url('/tf/gr/detail-rapor/'.$s->id)
                                            : url('/tf/gr/rp?view=detail_rapor&siswa_id='.$s->id);
                                    ?>
                                    <tr class="santri-input-row" data-id="<?php echo e($s->id); ?>">
                                        <td style="text-align: center; font-weight: 600; color: #666;">
                                            <?php echo e($loop->iteration); ?>

                                        </td>

                                        <!-- DATA SANTRI MANUAL (NAMA, KELAS, UMUR, ORTU) -->
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 4px;">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][nama_lengkap]" class="editor-form-control" style="font-size: 12px; font-weight: 700; padding: 4px 8px;" value="<?php echo e($eval->nama_lengkap ?? $s->nama); ?>" placeholder="Nama Lengkap">
                                                <div style="display: flex; gap: 4px;">
                                                    <input type="text" name="nilai[<?php echo e($s->id); ?>][kelas_label]" class="editor-form-control" style="font-size: 10.5px; padding: 3px 6px; width: 85px;" value="<?php echo e($eval->kelas_label ?? 'VI (ENAM)'); ?>" placeholder="Kelas">
                                                    <input type="text" name="nilai[<?php echo e($s->id); ?>][umur]" class="editor-form-control" style="font-size: 10.5px; padding: 3px 6px; width: 75px;" value="<?php echo e($eval->umur ?? '12 TAHUN'); ?>" placeholder="Umur">
                                                </div>
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][orang_tua]" class="editor-form-control" style="font-size: 10.5px; padding: 3px 6px;" value="<?php echo e($eval->orang_tua ?? 'Bpk. ZULFIKAR ABDUN & Ibu NAZMA SYAWIE'); ?>" placeholder="Orang Tua/Wali">
                                            </div>
                                        </td>

                                        <!-- Bulan 1 -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[<?php echo e($s->id); ?>][nilai_bulan_1]" id="nb1_<?php echo e($s->id); ?>" class="editor-form-control row-nb1" style="text-align: center; font-weight: 700; width: 65px; padding: 6px 3px;" value="<?php echo e($nb1); ?>" oninput="recalcRow(<?php echo e($s->id); ?>)">
                                        </td>

                                        <!-- Bulan 2 -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[<?php echo e($s->id); ?>][nilai_bulan_2]" id="nb2_<?php echo e($s->id); ?>" class="editor-form-control row-nb2" style="text-align: center; font-weight: 700; width: 65px; padding: 6px 3px;" value="<?php echo e($nb2); ?>" oninput="recalcRow(<?php echo e($s->id); ?>)">
                                        </td>

                                        <!-- Bulan 3 -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[<?php echo e($s->id); ?>][nilai_bulan_3]" id="nb3_<?php echo e($s->id); ?>" class="editor-form-control row-nb3" style="text-align: center; font-weight: 700; width: 65px; padding: 6px 3px;" value="<?php echo e($nb3); ?>" oninput="recalcRow(<?php echo e($s->id); ?>)">
                                        </td>

                                        <!-- Bulan 4 -->
                                        <td style="text-align: center;">
                                            <input type="number" step="0.1" name="nilai[<?php echo e($s->id); ?>][nilai_bulan_4]" id="nb4_<?php echo e($s->id); ?>" class="editor-form-control row-nb4" style="text-align: center; font-weight: 700; width: 65px; padding: 6px 3px;" value="<?php echo e($nb4); ?>" oninput="recalcRow(<?php echo e($s->id); ?>)">
                                        </td>

                                        <!-- Total & Rata-rata & Predikat -->
                                        <td style="text-align: center;">
                                            <div style="font-weight: 800; font-size: 13px; color: var(--primary-dark);" id="rataText_<?php echo e($s->id); ?>">
                                                <?php echo e($rata !== null ? number_format($rata, 1, ',', '') : '-'); ?>

                                            </div>
                                            <div style="font-size: 10px; color: #777;" id="totalText_<?php echo e($s->id); ?>">
                                                Tot: <?php echo e($jml !== null ? number_format($jml, 0) : '-'); ?>

                                            </div>
                                            <span class="rapor-badge bsh" style="margin-top: 2px;" id="predBadge_<?php echo e($s->id); ?>"><?php echo e($pred); ?></span>
                                        </td>

                                        <!-- Kenaikan Juz -->
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 3px;">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][kenaikan_juz_nomor]" class="editor-form-control" style="font-size: 11px; padding: 4px;" value="<?php echo e($eval->kenaikan_juz_nomor ?? '25'); ?>" placeholder="Juz">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][kenaikan_juz_predikat]" class="editor-form-control" style="font-size: 11px; padding: 4px;" value="<?php echo e($eval->kenaikan_juz_predikat ?? 'Jayyid/C'); ?>" placeholder="Predikat">
                                            </div>
                                        </td>

                                        <!-- Ujian Terbuka -->
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 3px;">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][ujian_terbuka_jumlah_juz]" class="editor-form-control" style="font-size: 11px; padding: 4px;" value="<?php echo e($eval->ujian_terbuka_jumlah_juz ?? ($eval->tasmi_jumlah_juz ?? '-')); ?>" placeholder="Jml Juz">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][ujian_terbuka_predikat]" class="editor-form-control" style="font-size: 11px; padding: 4px;" value="<?php echo e($eval->ujian_terbuka_predikat ?? ($eval->tasmi_predikat ?? '-')); ?>" placeholder="Predikat">
                                            </div>
                                        </td>

                                        <!-- Pencapaian Semester & Total -->
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 3px;">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][tercapai_semester]" class="editor-form-control" style="font-size: 10.5px; padding: 4px;" value="<?php echo e($eval->tercapai_semester ?? '<1 Juz (19 Hal)'); ?>" placeholder="Capaian Semester">
                                                <input type="text" name="nilai[<?php echo e($s->id); ?>][tercapai_total]" class="editor-form-control" style="font-size: 10.5px; padding: 4px;" value="<?php echo e($eval->tercapai_total ?? '6,5 Juz'); ?>" placeholder="Total Capaian">
                                            </div>
                                        </td>

                                        <!-- Target Tercapai? -->
                                        <td style="font-size: 11px; text-align: center;">
                                            <?php
                                                $semIya = ($eval->tercapai_target_semester ?? false);
                                                $klsIya = ($eval->tercapai_target_kelas ?? false);
                                            ?>
                                            <div style="display: flex; flex-direction: column; gap: 4px; align-items: center;">
                                                <label style="cursor: pointer; display: flex; align-items: center; gap: 3px;" title="Target Semester">
                                                    <input type="checkbox" name="nilai[<?php echo e($s->id); ?>][tercapai_target_semester]" value="1" <?php echo e($semIya ? 'checked' : ''); ?>>
                                                    <span>Sem</span>
                                                </label>
                                                <label style="cursor: pointer; display: flex; align-items: center; gap: 3px;" title="Target Kelas">
                                                    <input type="checkbox" name="nilai[<?php echo e($s->id); ?>][tercapai_target_kelas]" value="1" <?php echo e($klsIya ? 'checked' : ''); ?>>
                                                    <span>Kls</span>
                                                </label>
                                            </div>
                                        </td>

                                        <!-- Catatan Default -->
                                        <input type="hidden" name="nilai[<?php echo e($s->id); ?>][catatan_bacaan]" value="<?php echo e($eval->catatan_bacaan ?? $default_template['catatan_bacaan']); ?>">
                                        <input type="hidden" name="nilai[<?php echo e($s->id); ?>][catatan_hafalan]" value="<?php echo e($eval->catatan_hafalan ?? $default_template['catatan_hafalan']); ?>">
                                        <input type="hidden" name="nilai[<?php echo e($s->id); ?>][catatan_akhlak]" value="<?php echo e($eval->catatan_akhlak ?? $default_template['catatan_akhlak']); ?>">

                                        <!-- Aksi Rapor -->
                                        <td style="text-align: right; white-space: nowrap;">
                                            <a href="<?php echo e($detailUrl); ?>" target="_blank" class="btn-tahfiz-secondary" style="padding: 6px 10px; font-size: 11px;" title="Buka Detail Rapor">
                                                <i class="fa-solid fa-print"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="12" style="text-align: center; padding: 40px; color: #888;">
                                            Belum ada data santri pada rombel ini.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ============================================================ -->
                <!-- FLOATING STICKY ACTION BAR UNTUK SIMPAN MASSAL              -->
                <!-- ============================================================ -->
                <div class="sticky-save-bar">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <span style="font-size: 13px; font-weight: 700; color: var(--primary-dark);">
                            <i class="fa-solid fa-layer-group text-emerald-600"></i> Total: <?php echo e(count($siswa)); ?> Santri Rombel
                        </span>
                        <span style="font-size: 12px; color: var(--text-muted);">
                            Data nilai 4 bulan, data santri manual, target, dan pengesahan akan tersimpan langsung.
                        </span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        <a href="<?php echo e($raporUrl); ?>" class="btn-tahfiz-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Kembali ke Rapor
                        </a>
                        <button type="submit" id="btnSimpanMassal" class="btn-tahfiz-primary" style="padding: 10px 24px; font-size: 13px;">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Nilai Rapor
                        </button>
                    </div>
                </div>

            </form>

        </main>
    </div>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        function changeKelas(kelasId) {
            const url = new URL(window.location.href);
            url.searchParams.set('kelas_id', kelasId);
            window.location.href = url.toString();
        }

        function updateTableMonthHeaders() {
            const b1 = (document.getElementById('masterBulan1').value || 'AGUSTUS').toUpperCase();
            const b2 = (document.getElementById('masterBulan2').value || 'SEPTEMBER').toUpperCase();
            const b3 = (document.getElementById('masterBulan3').value || 'OKTOBER').toUpperCase();
            const b4 = (document.getElementById('masterBulan4').value || 'NOVEMBER').toUpperCase();

            document.getElementById('thBulan1').innerText = b1;
            document.getElementById('thBulan2').innerText = b2;
            document.getElementById('thBulan3').innerText = b3;
            document.getElementById('thBulan4').innerText = b4;
        }

        function calculatePredikat(num) {
            if (num === null || isNaN(num) || num === '') return '-';
            if (num >= 91) return 'Mumtaz/A';
            if (num >= 83) return 'Jayyid Jiddan/B';
            if (num >= 72) return 'Jayyid/C';
            if (num >= 61) return 'Maqbul/D';
            return 'Dha’if/E';
        }

        function recalcRow(siswaId) {
            const v1 = document.getElementById(`nb1_${siswaId}`).value;
            const v2 = document.getElementById(`nb2_${siswaId}`).value;
            const v3 = document.getElementById(`nb3_${siswaId}`).value;
            const v4 = document.getElementById(`nb4_${siswaId}`).value;

            const n1 = v1 !== '' ? parseFloat(v1) : null;
            const n2 = v2 !== '' ? parseFloat(v2) : null;
            const n3 = v3 !== '' ? parseFloat(v3) : null;
            const n4 = v4 !== '' ? parseFloat(v4) : null;

            const hasAny = (n1 !== null || n2 !== null || n3 !== null || n4 !== null);
            const total = (n1 || 0) + (n2 || 0) + (n3 || 0) + (n4 || 0);
            const rata = hasAny ? Math.round((total / 4) * 10) / 10 : null;
            const predikat = rata !== null ? calculatePredikat(rata) : '-';

            document.getElementById(`totalText_${siswaId}`).innerText = hasAny ? 'Tot: ' + total : 'Tot: -';
            document.getElementById(`rataText_${siswaId}`).innerText = rata !== null ? rata.toFixed(1).replace('.', ',') : '-';
            const badge = document.getElementById(`predBadge_${siswaId}`);
            badge.innerText = predikat;

            if (rata >= 91) badge.className = 'rapor-badge sb';
            else if (rata >= 83) badge.className = 'rapor-badge bsh';
            else if (rata >= 72) badge.className = 'rapor-badge bsh';
            else if (rata >= 61) badge.className = 'rapor-badge mb';
            else badge.className = 'rapor-badge bb';
        }

        function setTemplateValues() {
            document.querySelectorAll('.row-nb1').forEach(i => i.value = 80);
            document.querySelectorAll('.row-nb2').forEach(i => i.value = 85);
            document.querySelectorAll('.row-nb3').forEach(i => i.value = 90);
            document.querySelectorAll('.row-nb4').forEach(i => i.value = 85);
            recalcAllRows();
        }

        function recalcAllRows() {
            document.querySelectorAll('tr.santri-input-row').forEach(row => {
                const id = row.getAttribute('data-id');
                if (id) recalcRow(id);
            });
        }

        function filterSantriTable() {
            const query = document.getElementById('searchSantriInput').value.toLowerCase();
            const rows = document.querySelectorAll('#tableInputNilai tbody tr.santri-input-row');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        }

        document.getElementById('formInputNilai').addEventListener('submit', function(e) {
            const btn = document.getElementById('btnSimpanMassal');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan Seluruh Nilai...';
        });
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/tahfiz/guru/inputNilaiRapor.blade.php ENDPATH**/ ?>
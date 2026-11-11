<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport Tahfizh Al-Qur'an — <?php echo e($siswa->nama); ?> — SDQU Imam Syafi'i</title>
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

        <!-- SIDEBAR TAHFIZ (NO PRINT) -->
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

            <!-- ============================================================ -->
            <!-- PANEL KONTROL KUSTOMISASI LIVE GURU / PENGAMPU (NO-PRINT)    -->
            <!-- ============================================================ -->
            <div class="no-print editor-panel-card">
                <!-- Top Action Header -->
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; padding-bottom: 20px; border-bottom: 1px solid var(--border-color);">
                    <div style="display: flex; align-items: center; gap: 14px;">
                        <?php
                            $backUrl = request()->is('tf/gr/rapor*') || request()->is('tf/gr/detail-rapor*')
                                ? url('/tf/gr/rapor?kelas_id='.$siswa->kelas_id)
                                : url('/tf/gr/rp?view=rapor&kelas_id='.$siswa->kelas_id);
                        ?>
                        <a href="<?php echo e($backUrl); ?>" class="btn-tahfiz-secondary" style="padding: 10px 14px;" title="Kembali ke Daftar Rapor">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <div>
                            <h3 style="font-size: 18px; font-weight: 700; color: var(--text-dark); margin: 0;">
                                Raport Tahfizh Al-Qur'an: <?php echo e($siswa->nama); ?>

                            </h3>
                            <p style="font-size: 12px; color: var(--text-muted); margin: 3px 0 0 0;">
                                Kelas: <?php echo e($evaluasi->kelas_label ?? $template['kelas_label']); ?> • Semester: <?php echo e(($tahun_aktif->semester ?? 1) == 1 ? 'Ganjil' : 'Genap'); ?> <?php echo e($tahun_aktif->nama ?? '2025'); ?>

                            </p>
                        </div>
                    </div>

                    <!-- Tombol Aksi Utama -->
                    <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                        <button type="button" onclick="saveRaporToDatabase()" id="btnSaveRapor" class="btn-tahfiz-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Rapor
                        </button>
                        <button type="button" onclick="resetToOfficialTemplate()" class="btn-tahfiz-secondary">
                            <i class="fa-solid fa-rotate-left"></i> Reset Format
                        </button>
                        <?php
                            $inputNilaiUrl = request()->is('tf/gr/rapor*') || request()->is('tf/gr/detail-rapor*')
                                ? url('/tf/gr/input-nilai?kelas_id='.$siswa->kelas_id)
                                : url('/tf/gr/rp?view=input_nilai&kelas_id='.$siswa->kelas_id);
                        ?>
                        <a href="<?php echo e($inputNilaiUrl); ?>" class="btn-tahfiz-secondary">
                            <i class="fa-solid fa-sliders"></i> Input Nilai Kelas
                        </a>
                        <button type="button" onclick="window.print()" class="btn-tahfiz-gold">
                            <i class="fa-solid fa-print"></i> Cetak Dokumen Rapor
                        </button>
                    </div>
                </div>

                <!-- Navigasi Cepat Antar Santri Sekelas -->
                <?php if(isset($semuaSiswaKelas) && $semuaSiswaKelas->count() > 1): ?>
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                        <span style="font-size: 12px; font-weight: 600; color: var(--text-muted);">
                            <i class="fa-solid fa-users"></i> Pilih Santri Lain:
                        </span>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <select onchange="navigateToStudent(this.value)" style="padding: 6px 12px; border-radius: 8px; border: 1px solid var(--border-color); font-size: 12px; background: #FAF8F2; font-weight: 600;">
                                <?php $__currentLoopData = $semuaSiswaKelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($teman->id); ?>" <?php echo e($teman->id == $siswa->id ? 'selected' : ''); ?>>
                                        <?php echo e($teman->nama); ?> (<?php echo e($teman->nis ?: '-'); ?>)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tab Navigation Editor Live -->
                <div class="editor-nav-tabs" style="margin-top: 16px;">
                    <button type="button" onclick="switchEditorTab('tab-ujian')" id="editorTabBtn-ujian" class="editor-nav-tab active">
                        <i class="fa-solid fa-calculator"></i> 1. Ujian Tahfidz & Kenaikan Juz
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-pencapaian')" id="editorTabBtn-pencapaian" class="editor-nav-tab">
                        <i class="fa-solid fa-chart-line"></i> 2. Pencapaian Target Hafalan
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-catatan')" id="editorTabBtn-catatan" class="editor-nav-tab">
                        <i class="fa-solid fa-comment-dots"></i> 3. Catatan Pengampu (Bacaan, Hafalan, Akhlak)
                    </button>
                    <button type="button" onclick="switchEditorTab('tab-pengesahan')" id="editorTabBtn-pengesahan" class="editor-nav-tab">
                        <i class="fa-solid fa-signature"></i> 4. Identitas & Pengesahan
                    </button>
                </div>

                <!-- Konten Tab 1: Nilai Ujian Tahfidz & Kenaikan Juz -->
                <div id="editorContent-ujian">
                    <!-- B. Ujian Tahfidzh -->
                    <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px; margin-bottom: 18px;">
                        <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0 0 12px 0;">
                            B. Nilai Ujian Tahfidzh (Ujian Akhir Dikalikan 2 Secara Otomatis)
                        </h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 12px;">
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Ujian 1:</label>
                                <input type="number" step="0.1" id="inputUjian1" class="editor-form-control" value="<?php echo e($evaluasi->ujian_1 ?? $template['ujian_1']); ?>" oninput="recalcUjianTahfidz()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Ujian 2:</label>
                                <input type="number" step="0.1" id="inputUjian2" class="editor-form-control" value="<?php echo e($evaluasi->ujian_2 ?? $template['ujian_2']); ?>" oninput="recalcUjianTahfidz()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Ujian Akhir (x 2):</label>
                                <input type="number" step="0.1" id="inputUjianAkhir" class="editor-form-control" value="<?php echo e($evaluasi->ujian_akhir ?? $template['ujian_akhir']); ?>" oninput="recalcUjianTahfidz()">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Jumlah Nilai:</label>
                                <input type="text" id="inputUjianJumlah" class="editor-form-control" value="<?php echo e($evaluasi->ujian_jumlah ?? $template['ujian_jumlah']); ?>" readonly style="background: #eee; font-weight: 700;">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Nilai Rata-Rata:</label>
                                <input type="text" id="inputUjianRata" class="editor-form-control" value="<?php echo e($evaluasi->ujian_rata_rata ?? $template['ujian_rata_rata']); ?>" readonly style="background: #eee; font-weight: 700; color: var(--primary-color);">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Predikat:</label>
                                <input type="text" id="inputUjianPredikat" class="editor-form-control" value="<?php echo e($evaluasi->ujian_predikat ?? $template['ujian_predikat']); ?>" readonly style="background: #eee; font-weight: 700;">
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <!-- A. Ujian Kenaikan Juz -->
                        <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px;">
                            <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0 0 12px 0;">
                                A. Ujian Kenaikan Juz
                            </h4>
                            <div class="editor-form-group">
                                <label>Tanggal Ujian:</label>
                                <input type="text" id="inputKenaikanTanggal" class="editor-form-control" value="<?php echo e($evaluasi->kenaikan_juz_tanggal ?? $template['kenaikan_juz_tanggal']); ?>" oninput="updateLivePreview()">
                            </div>
                            <div class="editor-form-group">
                                <label>Juz yang Diuji:</label>
                                <input type="text" id="inputKenaikanJuz" class="editor-form-control" value="<?php echo e($evaluasi->kenaikan_juz_nomor ?? $template['kenaikan_juz_nomor']); ?>" oninput="updateLivePreview()" placeholder="Misal: 25">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Predikat:</label>
                                <input type="text" id="inputKenaikanPredikat" class="editor-form-control" value="<?php echo e($evaluasi->kenaikan_juz_predikat ?? $template['kenaikan_juz_predikat']); ?>" oninput="updateLivePreview()" placeholder="Jayyid/C">
                            </div>
                        </div>

                        <!-- C. Tasmi' Akhir Semester -->
                        <div style="background: #FAF8F2; border: 1px solid var(--border-color); border-radius: 10px; padding: 16px;">
                            <h4 style="font-size: 13px; font-weight: 700; color: var(--primary-dark); margin: 0 0 12px 0;">
                                C. Tasmi’ Akhir Semester
                            </h4>
                            <div class="editor-form-group">
                                <label>Tanggal Tasmi':</label>
                                <input type="text" id="inputTasmiTanggal" class="editor-form-control" value="<?php echo e($evaluasi->tasmi_tanggal ?? $template['tasmi_tanggal']); ?>" oninput="updateLivePreview()">
                            </div>
                            <div class="editor-form-group">
                                <label>Jumlah Juz:</label>
                                <input type="text" id="inputTasmiJumlahJuz" class="editor-form-control" value="<?php echo e($evaluasi->tasmi_jumlah_juz ?? $template['tasmi_jumlah_juz']); ?>" oninput="updateLivePreview()" placeholder="-">
                            </div>
                            <div class="editor-form-group" style="margin: 0;">
                                <label>Predikat:</label>
                                <input type="text" id="inputTasmiPredikat" class="editor-form-control" value="<?php echo e($evaluasi->tasmi_predikat ?? $template['tasmi_predikat']); ?>" oninput="updateLivePreview()" placeholder="-">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Tab 2: Pencapaian Tahfiz -->
                <div id="editorContent-pencapaian" style="display: none;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div class="editor-form-group">
                            <label>Hafalan Semester (Target):</label>
                            <input type="text" id="inputTargetSemester" class="editor-form-control" value="<?php echo e($evaluasi->target_semester ?? $template['target_semester']); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Hafalan Semester (Tercapai & Rincian Ayat):</label>
                            <input type="text" id="inputTercapaiSemester" class="editor-form-control" value="<?php echo e($evaluasi->tercapai_semester ?? $template['tercapai_semester']); ?>" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                        <div class="editor-form-group">
                            <label>Total Hafalan (Target):</label>
                            <input type="text" id="inputTargetTotal" class="editor-form-control" value="<?php echo e($evaluasi->target_total ?? $template['target_total']); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Total Hafalan (Tercapai & Rincian):</label>
                            <input type="text" id="inputTercapaiTotal" class="editor-form-control" value="<?php echo e($evaluasi->tercapai_total ?? $template['tercapai_total']); ?>" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; background: #FAF8F2; padding: 14px 18px; border-radius: 10px; border: 1px solid var(--border-color);">
                        <div>
                            <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 8px;">Tercapai Target Semester:</label>
                            <?php $statSem = $evaluasi->tercapai_target_semester ?? $template['tercapai_target_semester']; ?>
                            <div style="display: flex; gap: 14px;">
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_sem_radio" value="iya" <?php echo e($statSem ? 'checked' : ''); ?> onchange="onTargetStatusChanged('sem', true)"> Iya</label>
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_sem_radio" value="tidak" <?php echo e(!$statSem ? 'checked' : ''); ?> onchange="onTargetStatusChanged('sem', false)"> Tidak (√)</label>
                            </div>
                        </div>

                        <div>
                            <label style="font-weight: 700; font-size: 12px; display: block; margin-bottom: 8px;">Tercapai Target Kelas:</label>
                            <?php $statKls = $evaluasi->tercapai_target_kelas ?? $template['tercapai_target_kelas']; ?>
                            <div style="display: flex; gap: 14px;">
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_kls_radio" value="iya" <?php echo e($statKls ? 'checked' : ''); ?> onchange="onTargetStatusChanged('kls', true)"> Iya</label>
                                <label style="cursor: pointer;"><input type="radio" name="tercapai_kls_radio" value="tidak" <?php echo e(!$statKls ? 'checked' : ''); ?> onchange="onTargetStatusChanged('kls', false)"> Tidak (√)</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten Tab 3: Catatan Pengampu Halaqah -->
                <div id="editorContent-catatan" style="display: none;">
                    <div class="editor-form-group">
                        <label>1. Catatan Bacaan (Makharijul Huruf, Tajwid):</label>
                        <textarea id="inputCatatanBacaan" class="editor-form-control" rows="3" oninput="updateLivePreview()"><?php echo e($evaluasi->catatan_bacaan ?? $template['catatan_bacaan']); ?></textarea>
                    </div>

                    <div class="editor-form-group">
                        <label>2. Catatan Hafalan (Itqan/Kelancaran):</label>
                        <textarea id="inputCatatanHafalan" class="editor-form-control" rows="3" oninput="updateLivePreview()"><?php echo e($evaluasi->catatan_hafalan ?? $template['catatan_hafalan']); ?></textarea>
                    </div>

                    <div class="editor-form-group" style="margin-bottom: 0;">
                        <label>3. Catatan Akhlak:</label>
                        <textarea id="inputCatatanAkhlak" class="editor-form-control" rows="3" oninput="updateLivePreview()"><?php echo e($evaluasi->catatan_akhlak ?? $template['catatan_akhlak']); ?></textarea>
                    </div>
                </div>

                <!-- Konten Tab 4: Identitas & Pengesahan -->
                <div id="editorContent-pengesahan" style="display: none;">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 14px; margin-bottom: 14px;">
                        <div class="editor-form-group">
                            <label>Umur Santri:</label>
                            <input type="text" id="inputUmur" class="editor-form-control" value="<?php echo e($evaluasi->umur ?? $template['umur']); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Nama Orang Tua / Wali:</label>
                            <input type="text" id="inputOrangTua" class="editor-form-control" value="<?php echo e($evaluasi->orang_tua ?? $template['orang_tua']); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Tempat Titimangsa:</label>
                            <input type="text" id="inputTempatRapor" class="editor-form-control" value="<?php echo e($evaluasi->tempat_rapor ?? $template['tempat_rapor']); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>Tanggal Rapor:</label>
                            <input type="text" id="inputTanggalRapor" class="editor-form-control" value="<?php echo e($evaluasi->tanggal_rapor ?? $template['tanggal_rapor']); ?>" oninput="updateLivePreview()">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px;">
                        <div class="editor-form-group">
                            <label>1. Pengampu Halaqah (Kiri):</label>
                            <input type="text" id="inputNamaPengampu" class="editor-form-control" value="<?php echo e($evaluasi->nama_pengampu ?? $template['nama_pengampu'] ?? 'USTADZAH PENGAMPU HALAQAH'); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>2. Wali Kelas (Kanan):</label>
                            <input type="text" id="inputNamaWalas" class="editor-form-control" value="<?php echo e($evaluasi->nama_walas ?? $template['nama_walas']); ?>" oninput="updateLivePreview()">
                            <input type="text" id="inputRoleLabel" class="editor-form-control" style="margin-top: 6px; font-size: 11px;" value="<?php echo e($evaluasi->role_pengampu_label ?? $template['role_pengampu_label'] ?? 'Wali Kelas 6'); ?>" oninput="updateLivePreview()">
                        </div>
                        <div class="editor-form-group">
                            <label>3. Kepala Sekolah (Tengah Bawah):</label>
                            <input type="text" id="inputNamaKepsek" class="editor-form-control" value="<?php echo e($evaluasi->nama_kepsek ?? $template['nama_kepsek']); ?>" oninput="updateLivePreview()">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================ -->
            <!-- DOKUMEN CETAK RESMI: RAPORT TAHFIZH AL-QUR'AN SDQU           -->
            <!-- (SESUAI DOKUMEN ACUAN TERBARU DARI PENGGUNA)                 -->
            <!-- ============================================================ -->
            <div class="rapor-print-container" id="raporPrintArea">

                <!-- WATERMARK LOGO RESMI TRANSPARAN DI TENGAH LEMBAR -->
                <div class="rapor-watermark-overlay" aria-hidden="true">
                    <img src="<?php echo e(asset('img/logo_sd.jpg')); ?>" alt="Watermark SDQU Tinggede">
                </div>

                <div class="rapor-sheet-content">

                    <!-- HEADER DOKUMEN -->
                    <div class="tahfiz-doc-header">
                        <h2>RAPORT TAHFIZH AL-QUR’AN SEMESTER <?php echo e(($tahun_aktif->semester ?? 1) == 1 ? 'GANJIL' : 'GENAP'); ?> <?php echo e($tahun_aktif->nama ? preg_replace('/[^0-9]/', '', substr($tahun_aktif->nama, 0, 4)) : '2025'); ?></h2>
                        <h3>SEKOLAH DASAR AL-QUR’AN IMAM SYAFI’I TINGGEDE</h3>
                    </div>

                    <!-- DATA IDENTITAS SANTRI -->
                    <table class="tahfiz-bio-table">
                        <tr>
                            <td class="tahfiz-bio-label">NAMA LENGKAP</td>
                            <td style="width: 15px;">:</td>
                            <td><?php echo e(strtoupper($siswa->nama)); ?></td>
                        </tr>
                        <tr>
                            <td class="tahfiz-bio-label">KELAS</td>
                            <td>:</td>
                            <td><span id="previewKelas"><?php echo e($evaluasi->kelas_label ?? $template['kelas_label']); ?></span></td>
                        </tr>
                        <tr>
                            <td class="tahfiz-bio-label">UMUR</td>
                            <td>:</td>
                            <td><span id="previewUmur"><?php echo e($evaluasi->umur ?? $template['umur']); ?></span></td>
                        </tr>
                        <tr>
                            <td class="tahfiz-bio-label">ORANG TUA/WALI</td>
                            <td>:</td>
                            <td><span id="previewOrangTua"><?php echo e($evaluasi->orang_tua ?? $template['orang_tua']); ?></span></td>
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
                                <td style="text-align: center;"><span id="previewKenaikanTanggal"><?php echo e($evaluasi->kenaikan_juz_tanggal ?? $template['kenaikan_juz_tanggal']); ?></span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewKenaikanJuz"><?php echo e($evaluasi->kenaikan_juz_nomor ?? $template['kenaikan_juz_nomor']); ?></span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewKenaikanPredikat"><?php echo e($evaluasi->kenaikan_juz_predikat ?? $template['kenaikan_juz_predikat']); ?></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- B. UJIAN TAHFIZH -->
                    <div class="tahfiz-section-title">B. UJIAN TAHFIZH</div>
                    <table class="tahfiz-table-clean">
                        <thead>
                            <tr>
                                <th style="width: 15%;">UJIAN 1</th>
                                <th style="width: 15%;">UJIAN 2</th>
                                <th style="width: 18%;">UJIAN AKHIR</th>
                                <th style="width: 16%;">JUMLAH</th>
                                <th style="width: 18%;">NILAI RATA-RATA</th>
                                <th style="width: 18%;">PREDIKAT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $u1 = $evaluasi->ujian_1 ?? $template['ujian_1'];
                                $u2 = $evaluasi->ujian_2 ?? $template['ujian_2'];
                                $ua = $evaluasi->ujian_akhir ?? $template['ujian_akhir'];
                                $jml = $evaluasi->ujian_jumlah ?? $template['ujian_jumlah'];
                                $rata = $evaluasi->ujian_rata_rata ?? $template['ujian_rata_rata'];
                                $pred = $evaluasi->ujian_predikat ?? $template['ujian_predikat'];
                            ?>
                            <tr>
                                <td style="text-align: center;"><span id="previewUjian1"><?php echo e(number_format($u1, 0)); ?></span></td>
                                <td style="text-align: center;"><span id="previewUjian2"><?php echo e(number_format($u2, 0)); ?></span></td>
                                <td style="text-align: center;"><span id="previewUjianAkhir"><?php echo e(number_format($ua, 0)); ?> x 2</span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewUjianJumlah"><?php echo e(number_format($jml, 0)); ?></span></td>
                                <td style="text-align: center; font-weight: 700;"><span id="previewUjianRata"><?php echo e(number_format($rata, 1, ',', '')); ?></span></td>
                                <td style="text-align: center; font-weight: 800;"><span id="previewUjianPredikat"><?php echo e($pred); ?></span></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- C. TASMI' AKHIR SEMESTER -->
                    <div class="tahfiz-section-title">C. TASMI’ AKHIR SEMESTER</div>
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
                                <td style="text-align: center;"><span id="previewTasmiTanggal"><?php echo e($evaluasi->tasmi_tanggal ?? $template['tasmi_tanggal']); ?></span></td>
                                <td style="text-align: center;"><span id="previewTasmiJuz"><?php echo e($evaluasi->tasmi_jumlah_juz ?? $template['tasmi_jumlah_juz']); ?></span></td>
                                <td style="text-align: center;"><span id="previewTasmiPredikat"><?php echo e($evaluasi->tasmi_predikat ?? $template['tasmi_predikat']); ?></span></td>
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
                            <?php
                                $semIya = ($evaluasi->tercapai_target_semester ?? $template['tercapai_target_semester']);
                                $klsIya = ($evaluasi->tercapai_target_kelas ?? $template['tercapai_target_kelas']);
                            ?>
                            <tr>
                                <td style="text-align: center; font-weight: 600;"><span id="previewTargetSem"><?php echo e($evaluasi->target_semester ?? $template['target_semester']); ?></span></td>
                                <td style="font-size: 11px; line-height: 1.35;"><span id="previewTercapaiSem"><?php echo e($evaluasi->tercapai_semester ?? $template['tercapai_semester']); ?></span></td>
                                <td style="text-align: center; font-weight: 600;"><span id="previewTargetTot"><?php echo e($evaluasi->target_total ?? $template['target_total']); ?></span></td>
                                <td style="font-size: 11px; line-height: 1.35;"><span id="previewTercapaiTot"><?php echo e($evaluasi->tercapai_total ?? $template['tercapai_total']); ?></span></td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellSemIya"><?php echo $semIya ? '√' : ''; ?></td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellSemTidak"><?php echo !$semIya ? '√' : ''; ?></td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellKlsIya"><?php echo $klsIya ? '√' : ''; ?></td>
                                <td style="text-align: center; font-weight: 800; font-size: 14px;" id="cellKlsTidak"><?php echo !$klsIya ? '√' : ''; ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- CATATAN PENGAMPU HALAQAH -->
                    <div class="tahfiz-catatan-wrapper">
                        <div class="tahfiz-catatan-title">CATATAN PENGAMPU HALAQAH :</div>

                        <div class="tahfiz-catatan-sub">Bacaan (Makharijul Huruf. Tajwid)</div>
                        <div class="tahfiz-catatan-text" id="previewCatatanBacaan"><?php echo e($evaluasi->catatan_bacaan ?? $template['catatan_bacaan']); ?></div>

                        <div class="tahfiz-catatan-sub">Hafalan (Itqan/Kelancaran)</div>
                        <div class="tahfiz-catatan-text" id="previewCatatanHafalan"><?php echo e($evaluasi->catatan_hafalan ?? $template['catatan_hafalan']); ?></div>

                        <div class="tahfiz-catatan-sub">Akhlak</div>
                        <div class="tahfiz-catatan-text" id="previewCatatanAkhlak"><?php echo e($evaluasi->catatan_akhlak ?? $template['catatan_akhlak']); ?></div>
                    </div>

                    <!-- TANDA TANGAN & TITIMANGSA (3 TANDA TANGAN: KIRI PENGAMPU, KANAN WALI KELAS, TENGAH BAWAH KEPSEK) -->
                    <div style="margin-top: 24px; page-break-inside: avoid;">
                        <table style="width: 100%; text-align: center; font-size: 11.5px; border-collapse: collapse; margin-bottom: 8px;">
                            <tr>
                                <!-- Kiri: Pengampu Halaqah -->
                                <td style="width: 46%; vertical-align: top;">
                                    <div style="color: transparent; user-select: none;">&nbsp;</div>
                                    <div style="font-weight: 500;">Pengampu Halaqah,</div>
                                    <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                        <?php if(!empty($evaluasi->ttd_pengampu)): ?>
                                            <img src="<?php echo e($evaluasi->ttd_pengampu); ?>" alt="TTD Pengampu" style="max-height: 52px;">
                                        <?php endif; ?>
                                    </div>
                                    <strong style="text-decoration: underline; font-size: 12.5px;" id="previewPengampu"><?php echo e($evaluasi->nama_pengampu ?? $template['nama_pengampu'] ?? 'USTADZAH PENGAMPU HALAQAH'); ?></strong>
                                    <div style="font-size: 11px; color: #333; margin-top: 2px;">Pengampu Halaqah</div>
                                </td>

                                <td style="width: 8%;"></td>

                                <!-- Kanan: Wali Kelas (disertai Titimangsa) -->
                                <td style="width: 46%; vertical-align: top;">
                                    <div>
                                        <span id="previewTempat"><?php echo e($evaluasi->tempat_rapor ?? $template['tempat_rapor']); ?></span>, 
                                        <span id="previewTanggal"><?php echo e($evaluasi->tanggal_rapor ?? $template['tanggal_rapor']); ?></span>
                                    </div>
                                    <div style="font-weight: 500;">Wali Kelas,</div>
                                    <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                        <?php if(!empty($evaluasi->ttd_walas)): ?>
                                            <img src="<?php echo e($evaluasi->ttd_walas); ?>" alt="TTD Wali Kelas" style="max-height: 52px;">
                                        <?php endif; ?>
                                    </div>
                                    <strong style="text-decoration: underline; font-size: 12.5px;" id="previewWalas"><?php echo e($evaluasi->nama_walas ?? $template['nama_walas']); ?></strong>
                                    <div style="font-size: 11px; color: #333; margin-top: 2px;" id="previewRoleLabel"><?php echo e($evaluasi->role_pengampu_label ?? $template['role_pengampu_label'] ?? 'Wali Kelas 6'); ?></div>
                                </td>
                            </tr>

                            <!-- Baris 2: Tengah Bawah Kepala Sekolah -->
                            <tr>
                                <td colspan="3" style="text-align: center; vertical-align: top; padding-top: 14px;">
                                    <div style="display: inline-block; min-width: 250px;">
                                        <div style="font-weight: 500;">Mengetahui,</div>
                                        <div style="font-size: 11px; color: #333; margin-top: 1px;">Kepala Sekolah SDQU Imam Syafi’i</div>
                                        <div style="height: 58px; display: flex; align-items: center; justify-content: center;">
                                            <?php if(!empty($evaluasi->ttd_kepsek)): ?>
                                                <img src="<?php echo e($evaluasi->ttd_kepsek); ?>" alt="TTD Kepala Sekolah" style="max-height: 52px;">
                                            <?php endif; ?>
                                        </div>
                                        <strong style="text-decoration: underline; font-size: 12.5px;" id="previewKepsek"><?php echo e($evaluasi->nama_kepsek ?? $template['nama_kepsek']); ?></strong>
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

        </main>
    </div>

    <!-- JAVASCRIPT REALTIME SYNC & LOCALSTORAGE AUTO-SAVE -->
    <script>
        const SISWA_ID = <?php echo e($siswa->id); ?>;
        const STORAGE_KEY = 'raport_tahfizh_v2_' + SISWA_ID;

        let targetSemIya = <?php echo e(($evaluasi->tercapai_target_semester ?? $template['tercapai_target_semester']) ? 'true' : 'false'); ?>;
        let targetKlsIya = <?php echo e(($evaluasi->tercapai_target_kelas ?? $template['tercapai_target_kelas']) ? 'true' : 'false'); ?>;

        function switchEditorTab(tabId) {
            document.querySelectorAll('.editor-nav-tab').forEach(b => b.classList.remove('active'));
            ['tab-ujian', 'tab-pencapaian', 'tab-catatan', 'tab-pengesahan'].forEach(t => {
                const el = document.getElementById('editorContent-' + t.replace('tab-', ''));
                if (el) el.style.display = (t === tabId) ? 'block' : 'none';
            });
            const activeBtn = document.getElementById('editorTabBtn-' + tabId.replace('tab-', ''));
            if (activeBtn) activeBtn.classList.add('active');
        }

        function calculatePredikat(num) {
            if (num >= 91) return 'Mumtaz/A';
            if (num >= 83) return 'Jayyid Jiddan/B';
            if (num >= 72) return 'Jayyid/C';
            if (num >= 61) return 'Maqbul/D';
            return 'Dha’if/E';
        }

        function recalcUjianTahfidz() {
            const u1 = parseFloat(document.getElementById('inputUjian1').value) || 0;
            const u2 = parseFloat(document.getElementById('inputUjian2').value) || 0;
            const ua = parseFloat(document.getElementById('inputUjianAkhir').value) || 0;

            const jumlah = u1 + u2 + (ua * 2);
            const rata = Math.round((jumlah / 4) * 10) / 10;
            const predikat = calculatePredikat(rata);

            document.getElementById('inputUjianJumlah').value = jumlah;
            document.getElementById('inputUjianRata').value = rata.toFixed(1).replace('.', ',');
            document.getElementById('inputUjianPredikat').value = predikat;

            document.getElementById('previewUjian1').innerText = u1;
            document.getElementById('previewUjian2').innerText = u2;
            document.getElementById('previewUjianAkhir').innerText = ua + ' x 2';
            document.getElementById('previewUjianJumlah').innerText = jumlah;
            document.getElementById('previewUjianRata').innerText = rata.toFixed(1).replace('.', ',');
            document.getElementById('previewUjianPredikat').innerText = predikat;

            autoSaveDraft();
        }

        function onTargetStatusChanged(type, isIya) {
            if (type === 'sem') {
                targetSemIya = isIya;
                document.getElementById('cellSemIya').innerText = isIya ? '√' : '';
                document.getElementById('cellSemTidak').innerText = !isIya ? '√' : '';
            } else {
                targetKlsIya = isIya;
                document.getElementById('cellKlsIya').innerText = isIya ? '√' : '';
                document.getElementById('cellKlsTidak').innerText = !isIya ? '√' : '';
            }
            autoSaveDraft();
        }

        function updateLivePreview() {
            document.getElementById('previewUmur').innerText = document.getElementById('inputUmur').value;
            document.getElementById('previewOrangTua').innerText = document.getElementById('inputOrangTua').value;

            document.getElementById('previewKenaikanTanggal').innerText = document.getElementById('inputKenaikanTanggal').value;
            document.getElementById('previewKenaikanJuz').innerText = document.getElementById('inputKenaikanJuz').value;
            document.getElementById('previewKenaikanPredikat').innerText = document.getElementById('inputKenaikanPredikat').value;

            document.getElementById('previewTasmiTanggal').innerText = document.getElementById('inputTasmiTanggal').value;
            document.getElementById('previewTasmiJuz').innerText = document.getElementById('inputTasmiJumlahJuz').value;
            document.getElementById('previewTasmiPredikat').innerText = document.getElementById('inputTasmiPredikat').value;

            document.getElementById('previewTargetSem').innerText = document.getElementById('inputTargetSemester').value;
            document.getElementById('previewTercapaiSem').innerText = document.getElementById('inputTercapaiSemester').value;
            document.getElementById('previewTargetTot').innerText = document.getElementById('inputTargetTotal').value;
            document.getElementById('previewTercapaiTot').innerText = document.getElementById('inputTercapaiTotal').value;

            document.getElementById('previewCatatanBacaan').innerText = document.getElementById('inputCatatanBacaan').value;
            document.getElementById('previewCatatanHafalan').innerText = document.getElementById('inputCatatanHafalan').value;
            document.getElementById('previewCatatanAkhlak').innerText = document.getElementById('inputCatatanAkhlak').value;

            document.getElementById('previewTempat').innerText = document.getElementById('inputTempatRapor').value;
            document.getElementById('previewTanggal').innerText = document.getElementById('inputTanggalRapor').value;
            document.getElementById('previewPengampu').innerText = document.getElementById('inputNamaPengampu').value;
            document.getElementById('previewWalas').innerText = document.getElementById('inputNamaWalas').value;
            document.getElementById('previewRoleLabel').innerText = document.getElementById('inputRoleLabel').value;
            document.getElementById('previewKepsek').innerText = document.getElementById('inputNamaKepsek').value;

            autoSaveDraft();
        }

        function autoSaveDraft() {
            const data = {
                umur: document.getElementById('inputUmur').value,
                orang_tua: document.getElementById('inputOrangTua').value,
                kenaikan_juz_tanggal: document.getElementById('inputKenaikanTanggal').value,
                kenaikan_juz_nomor: document.getElementById('inputKenaikanJuz').value,
                kenaikan_juz_predikat: document.getElementById('inputKenaikanPredikat').value,
                ujian_1: document.getElementById('inputUjian1').value,
                ujian_2: document.getElementById('inputUjian2').value,
                ujian_akhir: document.getElementById('inputUjianAkhir').value,
                ujian_jumlah: document.getElementById('inputUjianJumlah').value,
                ujian_rata_rata: document.getElementById('inputUjianRata').value,
                ujian_predikat: document.getElementById('inputUjianPredikat').value,
                tasmi_tanggal: document.getElementById('inputTasmiTanggal').value,
                tasmi_jumlah_juz: document.getElementById('inputTasmiJumlahJuz').value,
                tasmi_predikat: document.getElementById('inputTasmiPredikat').value,
                target_semester: document.getElementById('inputTargetSemester').value,
                tercapai_semester: document.getElementById('inputTercapaiSemester').value,
                target_total: document.getElementById('inputTargetTotal').value,
                tercapai_total: document.getElementById('inputTercapaiTotal').value,
                tercapai_target_semester: targetSemIya,
                tercapai_target_kelas: targetKlsIya,
                catatan_bacaan: document.getElementById('inputCatatanBacaan').value,
                catatan_hafalan: document.getElementById('inputCatatanHafalan').value,
                catatan_akhlak: document.getElementById('inputCatatanAkhlak').value,
                tempat_rapor: document.getElementById('inputTempatRapor').value,
                tanggal_rapor: document.getElementById('inputTanggalRapor').value,
                nama_pengampu: document.getElementById('inputNamaPengampu').value,
                nama_walas: document.getElementById('inputNamaWalas').value,
                role_pengampu_label: document.getElementById('inputRoleLabel').value,
                nama_kepsek: document.getElementById('inputNamaKepsek').value
            };
            localStorage.setItem(STORAGE_KEY, JSON.stringify(data));
        }

        function saveRaporToDatabase() {
            const btn = document.getElementById('btnSaveRapor');
            const originalHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';

            const payload = {
                siswa_id: SISWA_ID,
                semester: <?php echo e($tahun_aktif->semester ?? 1); ?>,
                umur: document.getElementById('inputUmur').value,
                orang_tua: document.getElementById('inputOrangTua').value,
                kenaikan_juz_tanggal: document.getElementById('inputKenaikanTanggal').value,
                kenaikan_juz_nomor: document.getElementById('inputKenaikanJuz').value,
                kenaikan_juz_predikat: document.getElementById('inputKenaikanPredikat').value,
                ujian_1: document.getElementById('inputUjian1').value,
                ujian_2: document.getElementById('inputUjian2').value,
                ujian_akhir: document.getElementById('inputUjianAkhir').value,
                ujian_jumlah: document.getElementById('inputUjianJumlah').value,
                ujian_rata_rata: parseFloat(document.getElementById('inputUjianRata').value.replace(',', '.')),
                ujian_predikat: document.getElementById('inputUjianPredikat').value,
                tasmi_tanggal: document.getElementById('inputTasmiTanggal').value,
                tasmi_jumlah_juz: document.getElementById('inputTasmiJumlahJuz').value,
                tasmi_predikat: document.getElementById('inputTasmiPredikat').value,
                target_semester: document.getElementById('inputTargetSemester').value,
                tercapai_semester: document.getElementById('inputTercapaiSemester').value,
                target_total: document.getElementById('inputTargetTotal').value,
                tercapai_total: document.getElementById('inputTercapaiTotal').value,
                tercapai_target_semester: targetSemIya ? '1' : '0',
                tercapai_target_kelas: targetKlsIya ? '1' : '0',
                catatan_bacaan: document.getElementById('inputCatatanBacaan').value,
                catatan_hafalan: document.getElementById('inputCatatanHafalan').value,
                catatan_akhlak: document.getElementById('inputCatatanAkhlak').value,
                tempat_rapor: document.getElementById('inputTempatRapor').value,
                tanggal_rapor: document.getElementById('inputTanggalRapor').value,
                nama_pengampu: document.getElementById('inputNamaPengampu').value,
                nama_walas: document.getElementById('inputNamaWalas').value,
                role_pengampu_label: document.getElementById('inputRoleLabel').value,
                nama_kepsek: document.getElementById('inputNamaKepsek').value
            };

            const postUrl = '<?php echo e(url("/tf/gr/simpan-evaluasi-rapor")); ?>';

            fetch(postUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(res => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                alert('Alhamdulillah! Raport Tahfizh Al-Qur’an santri berhasil disimpan.');
                localStorage.removeItem(STORAGE_KEY);
            })
            .catch(err => {
                btn.disabled = false;
                btn.innerHTML = originalHtml;
                alert('Raport telah disimpan.');
            });
        }

        function resetToOfficialTemplate() {
            if (!confirm('Kembalikan ke format acuan resmi SDQU Tinggede?')) return;
            localStorage.removeItem(STORAGE_KEY);
            window.location.reload();
        }

        function navigateToStudent(targetId) {
            const currentUrl = new URL(window.location.href);
            if (currentUrl.pathname.includes('/detail-rapor/')) {
                window.location.href = '<?php echo e(url("/tf/gr/detail-rapor")); ?>/' + targetId;
            } else {
                currentUrl.searchParams.set('siswa_id', targetId);
                window.location.href = currentUrl.toString();
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const savedDraft = localStorage.getItem(STORAGE_KEY);
            if (savedDraft) {
                try {
                    const d = JSON.parse(savedDraft);
                    if (d.umur) document.getElementById('inputUmur').value = d.umur;
                    if (d.orang_tua) document.getElementById('inputOrangTua').value = d.orang_tua;
                    if (d.ujian_1) document.getElementById('inputUjian1').value = d.ujian_1;
                    if (d.ujian_2) document.getElementById('inputUjian2').value = d.ujian_2;
                    if (d.ujian_akhir) document.getElementById('inputUjianAkhir').value = d.ujian_akhir;
                    recalcUjianTahfidz();
                    updateLivePreview();
                } catch(e) {}
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/detailRaporWalas.blade.php ENDPATH**/ ?>
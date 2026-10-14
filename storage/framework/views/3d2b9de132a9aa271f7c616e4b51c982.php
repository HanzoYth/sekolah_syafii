<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Hafalan - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/monitoring.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
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
                <div class="topbar-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Monitoring Hafalan</span></p>
                    <h2>Monitoring Setoran & Perkembangan Siswa</h2>
                </div>
                <div class="topbar-icons">
                    <div class="notification-badge-wrapper">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC SUMMARY CARDS (4 KOTAK) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>282</h3>
                    <p>Total Setoran Hari Ini</p>
                </div>
                <div class="stat-card">
                    <h3>1.410</h3>
                    <p>Total Baris Ziyadah Pekan Ini</p>
                </div>
                <div class="stat-card">
                    <h3>94%</h3>
                    <p>Predikat Lancar (Mumtaz)</p>
                </div>
                <div class="stat-card warning-card">
                    <h3>18</h3>
                    <p>Siswa Perlu Perhatian Khusus</p>
                </div>
            </div>

            <!-- TOOLBAR: FILTER, PENCARIAN & EXPORT -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama siswa, NISN, atau surah...">
                </div>
                <div class="toolbar-filters">
                    <select class="form-control-select">
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 1B</option>
                        <option>Kelas 2B</option>
                    </select>
                    <select class="form-control-select">
                        <option>Semua Halaqah</option>
                        <option>Halaqah 1</option>
                        <option>Halaqah 2</option>
                    </select>
                    <select class="form-control-select">
                        <option>Kualitas: Semua</option>
                        <option>Lancar (A)</option>
                        <option>Kurang Lancar (B/C)</option>
                    </select>
                    <input type="date" class="form-control-select" value="2026-10-13">
                </div>
                <button class="btn-action-outline">
                    <i class="fa-solid fa-file-pdf"></i> Export Laporan
                </button>
            </div>

            <!-- TABEL REAL-TIME SETORAN HARI INI -->
            <div class="table-card">
                <div class="table-header-flex">
                    <div>
                        <h4>Jurnal Live Setoran Siswa</h4>
                        <p class="subtitle-text">Pantauan hasil input setoran hafalan baru (Ziyadah) dan Murajaah dari para pengampu</p>
                    </div>
                    <span class="text-muted text-sm">Update Terakhir: Hari Ini, 09:41 WITA</span>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal & Waktu</th>
                                <th>Siswa & Kelas</th>
                                <th>Pengampu</th>
                                <th>Hafalan Baru (Ziyadah)</th>
                                <th>Murajaah</th>
                                <th>Kualitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>13/10/2026</strong><br>
                                    <small class="text-muted">08:15 WITA</small>
                                </td>
                                <td>
                                    <span class="cell-strong">Ali</span>
                                    <small class="text-muted">Kelas 1A — Halaqah 1</small>
                                </td>
                                <td>Ustadz Ahmad, S.Pd.</td>
                                <td>
                                    <span class="badge-tag">An-Naba: 1-10</span><br>
                                    <small class="text-muted">5 Baris (Juz 30)</small>
                                </td>
                                <td>An-Naba: 1-5 (2 Ayat)</td>
                                <td><span class="badge success"><i class="fa-solid fa-star"></i> Lancar (A)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalRiwayatSiswa').classList.add('show')">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>13/10/2026</strong><br>
                                    <small class="text-muted">08:10 WITA</small>
                                </td>
                                <td>
                                    <span class="cell-strong">Budi</span>
                                    <small class="text-muted">Kelas 1A — Halaqah 1</small>
                                </td>
                                <td>Ustadz Ahmad, S.Pd.</td>
                                <td>
                                    <span class="badge-tag alert">An-Naba: 6-8</span><br>
                                    <small class="text-muted">3 Baris (Tidak Capai Target)</small>
                                </td>
                                <td>An-Naba: 1-5 (2 Ayat)</td>
                                <td><span class="badge warning"><i class="fa-solid fa-triangle-exclamation"></i> Belum Lancar (C)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalRiwayatSiswa').classList.add('show')">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>13/10/2026</strong><br>
                                    <small class="text-muted">08:02 WITA</small>
                                </td>
                                <td>
                                    <span class="cell-strong">Citra</span>
                                    <small class="text-muted">Kelas 1A — Halaqah 2</small>
                                </td>
                                <td>Ustadzah Aisyah, Lc.</td>
                                <td>
                                    <span class="badge-tag">An-Nazi'at: 1-8</span><br>
                                    <small class="text-muted">4 Baris (Juz 30)</small>
                                </td>
                                <td>An-Naba: 1-40 (1 Surah)</td>
                                <td><span class="badge success"><i class="fa-solid fa-star"></i> Lancar (A)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalRiwayatSiswa').classList.add('show')">
                                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECTION SISWA PERKEMBANGAN TERTIANGGAL -->
            <div class="detail-row">
                <div class="detail-box alert-box-full">
                    <div class="detail-header-tag danger-tag">
                        <i class="fa-solid fa-triangle-exclamation"></i> PERHATIAN KHUSUS ADMIN
                    </div>
                    <h3>Daftar Siswa Tertinggal / Belum Capai Target</h3>
                    <p class="subtitle-text">Siswa yang terdeteksi sering tidak mencapai target atau nilai kriteria kurang lancar selama 3 hari berturut-turut.</p>

                    <div class="table-responsive mt-15">
                        <table class="table-compact">
                            <thead>
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Kelas & Halaqah</th>
                                    <th>Capaian Target Pekan Ini</th>
                                    <th>Kondisi Dominan</th>
                                    <th>Pengampu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="cell-strong">Budi</span></td>
                                    <td>Kelas 1A (Halaqah 1)</td>
                                    <td><span class="text-red font-bold">40%</span> (8 dari 20 baris)</td>
                                    <td><span class="badge warning">Sering Belum Lancar</span></td>
                                    <td>Ustadz Ahmad</td>
                                    <td>
                                        <button class="btn-action-outline btn-xs" onclick="document.getElementById('modalRiwayatSiswa').classList.add('show')">
                                            <i class="fa-solid fa-chart-line"></i> Evaluasi
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="cell-strong">Dafa</span></td>
                                    <td>Kelas 2B (Halaqah 1)</td>
                                    <td><span class="text-red font-bold">25%</span> (5 dari 20 baris)</td>
                                    <td><span class="badge danger">Sering Absen Setor</span></td>
                                    <td>Ustadz Fajar</td>
                                    <td>
                                        <button class="btn-action-outline btn-xs" onclick="document.getElementById('modalRiwayatSiswa').classList.add('show')">
                                            <i class="fa-solid fa-chart-line"></i> Evaluasi
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL RIWAYAT SETORAN PER SISWA -->
    <div class="modal-overlay" id="modalRiwayatSiswa">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">RIWAYAT HAFALAN SISWA</span>
                    <h3>Rekapitulasi Jurnal Setoran</h3>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalRiwayatSiswa').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="student-profile">
                    <div class="avatar"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="student-info">
                        <h4>Ali</h4>
                        <p>Kelas: 1A | Halaqah 1 (Ustadz Ahmad)</p>
                        <p>Posisi Target: Juz 30 — Total Ziyadah Bulan Ini: 85 Baris</p>
                    </div>
                </div>

                <!-- DUMMY CHART DENGAN STRUKTUR DARI REFERENSI CSS -->
                <div class="chart-box">
                    <h5>Perkembangan Setoran Baris (7 Hari Terakhir)</h5>
                    <div class="dummy-chart">
                        <div class="bar" style="height: 60%;"></div>
                        <div class="bar" style="height: 80%;"></div>
                        <div class="bar" style="height: 100%;"></div>
                        <div class="bar" style="height: 50%;"></div>
                        <div class="bar" style="height: 70%;"></div>
                        <div class="bar" style="height: 90%;"></div>
                        <div class="bar" style="height: 100%;"></div>
                    </div>
                    <div class="chart-labels">
                        <span>07/10</span><span>08/10</span><span>09/10</span><span>10/10</span><span>11/10</span><span>12/10</span><span>13/10</span>
                    </div>
                </div>

                <div class="history-section">
                    <h5>Jurnal Riwayat Terperinci</h5>
                    <table class="table-compact text-sm">
                        <thead>
                            <tr>
                                <th>Tgl</th>
                                <th>Ziyadah (Setoran Baru)</th>
                                <th>Murojaah</th>
                                <th>Kualitas / Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>13/10</td>
                                <td>5 Baris <small class="text-muted">(An-Naba: 1-10)</small></td>
                                <td>2 Ayat <small class="text-muted">(An-Naba: 1-5)</small></td>
                                <td><span class="text-green font-bold"><i class="fa-solid fa-circle-check"></i> Lancar (A)</span></td>
                            </tr>
                            <tr>
                                <td>12/10</td>
                                <td>4 Baris <small class="text-muted">('Abasa: 1-10)</small></td>
                                <td>3 Ayat <small class="text-muted">('Abasa: 1-3)</small></td>
                                <td><span class="text-green font-bold"><i class="fa-solid fa-circle-check"></i> Lancar (A)</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer-action">
                    <button type="button" class="btn-back" onclick="document.getElementById('modalRiwayatSiswa').classList.remove('show')">Tutup</button>
                    <button type="button" class="btn-outline"><i class="fa-solid fa-print"></i> Cetak Rapor Hafalan</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/admin/monitoring.blade.php ENDPATH**/ ?>
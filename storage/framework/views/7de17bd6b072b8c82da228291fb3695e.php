<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan & Rekapitulasi - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/laporan.css')); ?>">
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
                    <p class="breadcrumb">Tahfiz Digital / <span>Laporan & Rekapitulasi</span></p>
                    <h2>Laporan & Rekapitulasi Tahfiz</h2>
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
                    <h3>300</h3>
                    <p>Total Siswa Terekap</p>
                </div>
                <div class="stat-card">
                    <h3>5.840</h3>
                    <p>Total Baris Ziyadah Bulan Ini</p>
                </div>
                <div class="stat-card">
                    <h3>96%</h3>
                    <p>Tingkat Kehadiran Setoran</p>
                </div>
                <div class="stat-card">
                    <h3>15</h3>
                    <p>Laporan Halaqah Selesai</p>
                </div>
            </div>

            <!-- CARD FILTER DAN PARAMETER LAPORAN -->
            <div class="table-card mb-28">
                <div class="table-header-flex">
                    <div>
                        <h4>Filter & Parameter Rekapitulasi</h4>
                        <p class="subtitle-text">Tentukan rentang periode, kelas, halaqah, atau filter kustom sebelum mengunduh rekap</p>
                    </div>
                </div>

                <form action="#" method="GET">
                    <div class="filter-grid-4">
                        <div class="filter-group">
                            <label><i class="fa-solid fa-calendar-days"></i> Periode Laporan</label>
                            <select class="form-control-select">
                                <option value="harian">Harian</option>
                                <option value="mingguan">Mingguan</option>
                                <option value="bulanan" selected>Bulanan (Oktober 2026)</option>
                                <option value="semester">Semester Ini</option>
                                <option value="custom">Rentang Tanggal Kustom</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fa-solid fa-calendar"></i> Dari Tanggal - Sampai</label>
                            <div class="input-inline-grid">
                                <input type="date" class="form-control-select" value="2026-10-01">
                                <input type="date" class="form-control-select" value="2026-10-13">
                            </div>
                        </div>
                        <div class="filter-group">
                            <label><i class="fa-solid fa-school"></i> Pilih Kelas</label>
                            <select class="form-control-select">
                                <option>Semua Kelas</option>
                                <option>Kelas 1A</option>
                                <option>Kelas 1B</option>
                                <option>Kelas 2B</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fa-solid fa-users-rectangle"></i> Pilih Halaqah</label>
                            <select class="form-control-select">
                                <option>Semua Halaqah</option>
                                <option>Halaqah 1</option>
                                <option>Halaqah 2</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fa-solid fa-chalkboard-user"></i> Guru / Pengampu</label>
                            <select class="form-control-select">
                                <option>Semua Guru</option>
                                <option>Ustadz Ahmad, S.Pd.</option>
                                <option>Ustadzah Aisyah, Lc.</option>
                                <option>Ustadz Fajar Pratama, M.Ag.</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label><i class="fa-solid fa-user-graduate"></i> Siswa Spesifik</label>
                            <select class="form-control-select">
                                <option>Semua Siswa</option>
                                <option>Ali (NISN: 0081234561)</option>
                                <option>Budi (NISN: 0081234562)</option>
                                <option>Citra (NISN: 0081234563)</option>
                            </select>
                        </div>
                        <div class="filter-group filter-btn-group">
                            <button type="submit" class="btn-primary-gold">
                                <i class="fa-solid fa-filter"></i> Terapkan Filter
                            </button>
                        </div>
                    </div>
                </form>

                <!-- TOMBOL EKSPOR & AHMAD LOG -->
                <div class="export-bar">
                    <span class="text-muted text-sm"><i class="fa-solid fa-circle-info"></i> Menampilkan rekapitulasi data berdasarkan filter aktif.</span>
                    <div class="export-buttons">
                        <button class="btn-action-outline btn-pdf">
                            <i class="fa-solid fa-file-pdf"></i> Unduh Laporan (PDF)
                        </button>
                        <button class="btn-action-outline btn-excel">
                            <i class="fa-solid fa-file-excel"></i> Ekspor Data (Excel)
                        </button>
                    </div>
                </div>
            </div>

            <!-- TABEL HASIL REKAPITULASI LAPORAN -->
            <div class="table-card">
                <div class="table-header-flex">
                    <div>
                        <h4>Preview Rekapitulasi Hafalan Siswa</h4>
                        <p class="subtitle-text">Ringkasan total setoran Ziyadah, Murojaah, serta rata-rata predikat selama periode berjalan</p>
                    </div>
                    <span class="text-muted text-sm">Total 4 Siswa Teraplikasi</span>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN & Nama Siswa</th>
                                <th>Kelas / Halaqah</th>
                                <th>Guru Pengampu</th>
                                <th>Total Ziyadah (Baris)</th>
                                <th>Capaian Surah / Juz</th>
                                <th>Rata-rata Predikat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <span class="cell-strong">Ali</span>
                                    <small class="text-muted">NISN: 0081234561</small>
                                </td>
                                <td>Kelas 1A — Halaqah 1</td>
                                <td>Ustadz Ahmad, S.Pd.</td>
                                <td><span class="badge-count">85 Baris</span></td>
                                <td>An-Naba s.d. Abasa (Juz 30)</td>
                                <td><span class="badge success"><i class="fa-solid fa-star"></i> Mumtaz (A)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalDetailRekap').classList.add('show')">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <span class="cell-strong">Budi</span>
                                    <small class="text-muted">NISN: 0081234562</small>
                                </td>
                                <td>Kelas 1A — Halaqah 1</td>
                                <td>Ustadz Ahmad, S.Pd.</td>
                                <td><span class="badge-count empty">40 Baris</span></td>
                                <td>An-Naba: 1-20 (Juz 30)</td>
                                <td><span class="badge warning"><i class="fa-solid fa-triangle-exclamation"></i> Jayyid (C)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalDetailRekap').classList.add('show')">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <span class="cell-strong">Citra</span>
                                    <small class="text-muted">NISN: 0081234563</small>
                                </td>
                                <td>Kelas 1A — Halaqah 2</td>
                                <td>Ustadzah Aisyah, Lc.</td>
                                <td><span class="badge-count">90 Baris</span></td>
                                <td>An-Nazi'at s.d. Al-Infitar</td>
                                <td><span class="badge success"><i class="fa-solid fa-star"></i> Mumtaz (A)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalDetailRekap').classList.add('show')">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <span class="cell-strong">Dafa</span>
                                    <small class="text-muted">NISN: 0081234564</small>
                                </td>
                                <td>Kelas 2B — Halaqah 1</td>
                                <td>Ustadz Fajar Pratama</td>
                                <td><span class="badge-count empty">25 Baris</span></td>
                                <td>Al-A'la: 1-10</td>
                                <td><span class="badge danger"><i class="fa-solid fa-xmark"></i> Kurang (D)</span></td>
                                <td>
                                    <button class="btn-xs" onclick="document.getElementById('modalDetailRekap').classList.add('show')">
                                        <i class="fa-solid fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL DETAIL REKAP SISWA -->
    <div class="modal-overlay" id="modalDetailRekap">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">DETAIL LAPORAN PERIODE</span>
                    <h3>Rincian Rekapitulasi Siswa</h3>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalDetailRekap').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="student-profile">
                    <div class="avatar"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="student-info">
                        <h4>Ali</h4>
                        <p>Kelas: 1A | Halaqah 1 (Ustadz Ahmad, S.Pd.)</p>
                        <p>Periode: 01 Oktober 2026 - 13 Oktober 2026</p>
                    </div>
                </div>

                <div class="history-section mt-15">
                    <h5>Log Rincian Setoran Harian</h5>
                    <table class="table-compact text-sm">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Hafalan Baru (Ziyadah)</th>
                                <th>Hafalan Ulang (Murojaah)</th>
                                <th>Predikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>13/10/2026</td>
                                <td>5 Baris (An-Naba: 1-10)</td>
                                <td>2 Ayat (An-Naba: 1-5)</td>
                                <td><span class="text-green font-bold">Lancar (A)</span></td>
                            </tr>
                            <tr>
                                <td>12/10/2026</td>
                                <td>4 Baris ('Abasa: 1-10)</td>
                                <td>3 Ayat ('Abasa: 1-3)</td>
                                <td><span class="text-green font-bold">Lancar (A)</span></td>
                            </tr>
                            <tr>
                                <td>11/10/2026</td>
                                <td>5 Baris ('Abasa: 11-20)</td>
                                <td>2 Ayat ('Abasa: 4-5)</td>
                                <td><span class="text-green font-bold">Lancar (A)</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer-action">
                    <button type="button" class="btn-back" onclick="document.getElementById('modalDetailRekap').classList.remove('show')">Tutup</button>
                    <button type="button" class="btn-primary-gold"><i class="fa-solid fa-print"></i> Cetak Rekap Individu</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/admin/laporan.blade.php ENDPATH**/ ?>
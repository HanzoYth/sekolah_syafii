<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/riwayatlaporansiswa.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR SISWA -->
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
                    <h2>Riwayat & Laporan Hafalan 📊</h2>
                    <p class="subtitle-text">Pantau seluruh catatan perkembangan hafalan harian, pekanan, dan bulanan Anda.</p>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- CARD RINGKASAN REKAPITULASI -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>24 Hari</h3>
                    <p>Total Kehadiran Setoran</p>
                </div>
                <div class="stat-card">
                    <h3>120 Baris</h3>
                    <p>Total Ziyadah (Bulan Ini)</p>
                </div>
                <div class="stat-card">
                    <h3>45 Ayat</h3>
                    <p>Total Murojaah (Bulan Ini)</p>
                </div>
                <div class="stat-card">
                    <h3>92%</h3>
                    <p>Rata-rata Kelancaran</p>
                </div>
            </div>

            <!-- SECTION TAB LAPORAN & FILTER -->
            <div class="table-card">
                
                <!-- HEADER & CONTROL BAR -->
                <div class="report-header-flex">
                    <!-- Tab Filter Kategori Laporan -->
                    <div class="report-tabs">
                        <button type="button" class="tab-btn active" data-tab="harian">
                            <i class="fa-solid fa-calendar-day"></i> Laporan Harian
                        </button>
                        <button type="button" class="tab-btn" data-tab="pekanan">
                            <i class="fa-solid fa-calendar-week"></i> Laporan Pekanan
                        </button>
                        <button type="button" class="tab-btn" data-tab="bulanan">
                            <i class="fa-solid fa-calendar-days"></i> Laporan Bulanan
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="report-actions">
                        <input type="month" value="2026-10" class="input-date-sm">
                        <button type="button" class="btn-outline-sm">
                            <i class="fa-solid fa-file-pdf"></i> Ekspor PDF
                        </button>
                    </div>
                </div>

                <!-- CONTENT 1: LAPORAN HARIAN -->
                <div class="tab-content active" id="tab-harian">
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hari / Tanggal</th>
                                    <th>Ziyadah</th>
                                    <th>Murojaah</th>
                                    <th>Jml. Baris</th>
                                    <th>Kondisi Hafalan</th>
                                    <th>Nilai / Predikat</th>
                                    <th>Catatan Ustadz</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Senin, 19/10/2026</td>
                                    <td>An-Naba: 1-5</td>
                                    <td>An-Naba: 1-2</td>
                                    <td>5 Baris</td>
                                    <td><span class="badge-text green">Lancar</span></td>
                                    <td><span class="badge success">A (Sangat Baik)</span></td>
                                    <td><small><i>Makhraj huruf 'Ain sudah lebih jelas. Pertahankan.</i></small></td>
                                </tr>
                                <tr>
                                    <td>Jumat, 16/10/2026</td>
                                    <td>An-Naba: 1-4</td>
                                    <td>An-Naba: 1-3</td>
                                    <td>4 Baris</td>
                                    <td><span class="badge-text green">Lancar</span></td>
                                    <td><span class="badge success">A (Sangat Baik)</span></td>
                                    <td><small><i>Bagus, tajwid sudah tepat.</i></small></td>
                                </tr>
                                <tr>
                                    <td>Kamis, 15/10/2026</td>
                                    <td>'Abasa: 1-5</td>
                                    <td>'Abasa: 1-2</td>
                                    <td>5 Baris</td>
                                    <td><span class="badge-text green">Lancar</span></td>
                                    <td><span class="badge success">B+ (Baik)</span></td>
                                    <td><small><i>Hati-hati di ayat ke-3 mad jaiz-nya.</i></small></td>
                                </tr>
                                <tr>
                                    <td>Rabu, 14/10/2026</td>
                                    <td>'Abasa: 1-3</td>
                                    <td>-</td>
                                    <td>3 Baris</td>
                                    <td><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/siswa/riwayatlaporan.blade.php ENDPATH**/ ?>
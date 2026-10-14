<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/admin_dashboard.css')); ?>">
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
                    <p class="breadcrumb">Tahfiz Digital / <span>Dashboard Admin</span></p>
                    <h2>Selamat datang, Administrator</h2>
                </div>
                <div class="topbar-icons">
                    <div class="notification-badge-wrapper">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC CARDS (6 KOTAK UTAMA) -->
            <div class="stats-grid-admin">
                <div class="stat-card">
                    <div class="stat-icon emerald"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="stat-info">
                        <h3>300</h3>
                        <p>Total Siswa Aktif</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon gold"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <div class="stat-info">
                        <h3>15</h3>
                        <p>Total Guru / Pengampu</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon emerald"><i class="fa-solid fa-school"></i></div>
                    <div class="stat-info">
                        <h3>6</h3>
                        <p>Jumlah Kelas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon gold"><i class="fa-solid fa-users-rectangle"></i></div>
                    <div class="stat-info">
                        <h3>15</h3>
                        <p>Kelompok Halaqah</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fa-solid fa-clipboard-check"></i></div>
                    <div class="stat-info">
                        <h3>11</h3>
                        <p>Setoran Hari Ini</p>
                    </div>
                </div>
                <div class="stat-card alert-card">
                    <div class="stat-icon red"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="stat-info">
                        <h3>4</h3>
                        <p>Halaqah Belum Setor</p>
                    </div>
                </div>
            </div>

            <!-- ROW GRAFIK PERKEMBANGAN & SISWA BELUM MENYETOR -->
            <div class="dashboard-grid-row">
                
                <!-- GRAFIK PERKEMBANGAN HAFALAN MINGGUAN -->
                <div class="dashboard-card chart-section">
                    <div class="card-header-flex">
                        <h4>Grafik Perkembangan Hafalan Mingguan</h4>
                        <select class="select-sm">
                            <option>Pekan Ini (Juni 2026)</option>
                            <option>Pekan Lalu</option>
                        </select>
                    </div>
                    <div class="chart-container-dummy">
                        <div class="dummy-bar-group">
                            <div class="bar" style="height: 60%;" data-value="180"></div>
                            <span>Senin</span>
                        </div>
                        <div class="dummy-bar-group">
                            <div class="bar" style="height: 75%;" data-value="220"></div>
                            <span>Selasa</span>
                        </div>
                        <div class="dummy-bar-group">
                            <div class="bar" style="height: 85%;" data-value="250"></div>
                            <span>Rabu</span>
                        </div>
                        <div class="dummy-bar-group">
                            <div class="bar" style="height: 70%;" data-value="210"></div>
                            <span>Kamis</span>
                        </div>
                        <div class="dummy-bar-group">
                            <div class="bar" style="height: 90%;" data-value="280"></div>
                            <span>Jumat</span>
                        </div>
                        <div class="dummy-bar-group">
                            <div class="bar" style="height: 40%;" data-value="120"></div>
                            <span>Sabtu</span>
                        </div>
                    </div>
                    <p class="chart-footer-note"><i class="fa-solid fa-chart-line"><b> Rata-rata setoran harian stabil meningkat 12% dari pekan lalu.</b></i></p>
                </div>

                <!-- SISWA YANG BELUM MENYETOR HARI INI -->
                <div class="dashboard-card alert-section">
                    <div class="card-header-flex">
                        <h4>Belum Menyetor Hari Ini</h4>
                        <span class="badge danger">4 Halaqah</span>
                    </div>
                    <div class="alert-list">
                        <div class="alert-item">
                            <div class="alert-meta">
                                <strong>Kelas 2B - Halaqah 1</strong>
                                <p>Pengampu: Ustadz Fajar Pratama</p>
                            </div>
                            <button class="btn-reminder"><i class="fa-solid fa-bell"></i> Ingatkan</button>
                        </div>
                        <div class="alert-item">
                            <div class="alert-meta">
                                <strong>Kelas 2B - Halaqah 3</strong>
                                <p>Pengampu: Belum Ditentukan</p>
                            </div>
                            <button class="btn-reminder"><i class="fa-solid fa-bell"></i> Alih Tugas</button>
                        </div>
                        <div class="alert-item">
                            <div class="alert-meta">
                                <strong>Kelas 3B - Halaqah 2</strong>
                                <p>Pengampu: Ustadz Zaky, Lc.</p>
                            </div>
                            <button class="btn-reminder"><i class="fa-solid fa-bell"></i> Ingatkan</button>
                        </div>
                        <div class="alert-item">
                            <div class="alert-meta">
                                <strong>Kelas 4A - Halaqah 1</strong>
                                <p>Pengampu: Ustadzah Maryam</p>
                            </div>
                            <button class="btn-reminder"><i class="fa-solid fa-bell"></i> Ingatkan</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ROW: AKTIVITAS TERBARU GURU & SISWA -->
            <div class="dashboard-card mt-25">
                <div class="card-header-flex">
                    <h4>Aktivitas Terbaru Guru & Siswa</h4>
                    <button class="btn-outline-sm">Lihat Semua Log</button>
                </div>
                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Pengampu / Guru</th>
                                <th>Kelas & Halaqah</th>
                                <th>Aktivitas / Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>08:15 WIB</td>
                                <td class="cell-strong">Ustadz Ahmad, S.Pd.</td>
                                <td>Kelas 1A (Halaqah 1)</td>
                                <td>Menginput setoran 12 siswa (Ziyadah An-Naba: 1-5)</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Selesai</span></td>
                            </tr>
                            <tr>
                                <td>08:02 WIB</td>
                                <td class="cell-strong">Ustadzah Aisyah, Lc.</td>
                                <td>Kelas 1A (Halaqah 2)</td>
                                <td>Menginput setoran 11 siswa (Ziyadah An-Nazi'at: 1-6)</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Selesai</span></td>
                            </tr>
                            <tr>
                                <td>Kemarin</td>
                                <td class="cell-strong">Administrator</td>
                                <td>Sistem Manajemen</td>
                                <td>Memperbarui data penempatan siswa kelas 2B</td>
                                <td><span class="badge info"><i class="fa-solid fa-circle-info"></i> Sistem</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/admin/dashboard.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama Dashboard Guru -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboard.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR -->
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
                    <h2>Monitoring Halaqah & Laporan Harian</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- KARTU UTAMA RINGKASAN SESUAI REFERENSI GAMBAR -->
            <div class="dashboard-card-section">
                
                <!-- HEADER RINGKASAN & TAB PILIHAN HALAQAH -->
                <div class="summary-header-row">
                    <h3 class="summary-title">Ringkasan</h3>
                    <div class="halaqah-tabs">
                        <button type="button" class="tab-btn active">Semua Halaqah</button>
                        <button type="button" class="tab-btn">Halaqah 2</button>
                        <button type="button" class="tab-btn">Halaqah 4</button>
                    </div>
                </div>

                <!-- 4 KOTAK STATISTIK (TOTAL SISWA, SUDAH INPUT, BELUM INPUT, TANGGAL) -->
                <div class="stats-grid-modern">
                    <div class="stat-box-modern blue-bg">
                        <h3>14</h3>
                        <p>TOTAL SISWA</p>
                    </div>
                    <div class="stat-box-modern green-bg">
                        <h3>7</h3>
                        <p>SUDAH INPUT</p>
                    </div>
                    <div class="stat-box-modern red-bg">
                        <h3>7</h3>
                        <p>BELUM INPUT</p>
                    </div>
                    <div class="stat-box-modern date-bg">
                        <span class="date-box-label">TANGGAL</span>
                        <div class="date-input-wrapper">
                            <input type="date" value="2026-10-21">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL AKSI UTAMA (INPUT LAPORAN & LIHAT LAPORAN SEBELUMNYA) -->
            <div class="action-buttons-grid">
                <a href="/tf/gr/lp" class="action-card-btn primary-blue">
                    <div class="icon-circle-lg">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span>Input Laporan Harian</span>
                </a>

                <a href="/tf/gr/rp" class="action-card-btn white-card">
                    <div class="icon-circle-lg outline">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                    <span>Lihat Laporan Sebelumnya</span>
                </a>
            </div>

        </main>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/dashboard.blade.php ENDPATH**/ ?>
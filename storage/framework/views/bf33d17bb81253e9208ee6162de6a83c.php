<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaqah Saya - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Halaman Halaqah Guru -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboard.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/halaqah_saya.css')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR GURU -->
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
                    <h2>Kelola Halaqah Saya</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- CARD INFORMASI HALAQAH GURU -->
            <div class="halaqah-info-card">
                <div class="halaqah-info-main">
                    <h3>Halaqah 1 — Kelas 1A</h3>
                    <p>Pengampu: <strong>Ustadz Ahmad, S.Pd.</strong> | Tahun Ajaran 2026/2027</p>
                </div>
                <div class="halaqah-badges">
                    <span class="badge-gold"><i class="fa-solid fa-graduation-cap"></i> Kelas 1A</span>
                    <span class="badge-info"><i class="fa-solid fa-users"></i> Total 20 Siswa</span>
                </div>
            </div>

            <!-- RINGKASAN STATISTIK RINGKAS HARIAN -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>20</h3>
                    <p>Total Siswa Halaqah</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--green-text);">
                    <h3 class="text-green">16</h3>
                    <p>Sudah Setor Hari Ini</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--yellow-text);">
                    <h3 style="color: var(--yellow-text);">2</h3>
                    <p>Izin / Sakit</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--red-text);">
                    <h3 style="color: var(--red-text);">2</h3>
                    <p>Belum Setor</p>
                </div>
            </div>

            <!-- TABLE CARD DATA SISWA -->
            <div class="table-card">
                <div class="search-filter-bar">
                    <h4><i class="fa-solid fa-user-graduate"></i> Daftar Siswa Binaan</h4>
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchSiswa" placeholder="Cari nama siswa atau NISN...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact" id="tableSiswa">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Capaian Terakhir</th>
                                <th>Status Setoran Hari Ini</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $currentDate = date('d/m/Y'); ?>

                            <!-- Siswa 1 -->
                            <tr>
                                <td>1</td>
                                <td>222301001</td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar">AF</div>
                                        <span class="cell-strong">Ahmad Fauzi</span>
                                    </div>
                                </td>
                                <td>Kelas 1A</td>
                                <td>Juz 30 — Surah An-Naba' (1-20)</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah Setor</span></td>
                                <td class="text-center">
                                    <!-- Tombol dialihkan langsung ke halaman input laporan untuk siswa tertentu -->
                                    <a href="<?php echo e(url('/laporan/input?nisn=222301001')); ?>" class="btn-xs" style="text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                        <i class="fa-solid fa-pen-to-square"></i> Input Laporan
                                    </a>
                                </td>
                            </tr>

                            <!-- Siswa 2 -->
                            <tr>
                                <td>2</td>
                                <td>222301002</td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar">AN</div>
                                        <span class="cell-strong">Aisyah Nurbalqis</span>
                                    </div>
                                </td>
                                <td>Kelas 1A</td>
                                <td>Juz 30 — Surah An-Nazi'at (1-15)</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah Setor</span></td>
                                <td class="text-center">
                                    <a href="<?php echo e(url('/laporan/input?nisn=222301002')); ?>" class="btn-xs" style="text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                                        <i class="fa-solid fa-pen-to-square"></i> Input Laporan
                                    </a>
                                </td>
                            </tr>

                            <!-- Siswa 3 (Belum Setor) -->
                            <tr>
                                <td>3</td>
                                <td>222301003</td>
                                <td>
                                    <div class="student-name-cell">
                                        <div class="student-avatar" style="background: var(--gold-gradient); color: var(--primary-darker);">MB</div>
                                        <span class="cell-strong">Muhammad Bilal</span>
                                    </div>
                                </td>
                                <td>Kelas 1A</td>
                                <td>Juz 30 — Surah Abasa (1-10)</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum Setor</span></td>
                                <td class="text-center">
                                    <a href="<?php echo e(url('/laporan/input?nisn=222301003')); ?>" class="btn-xs" style="text-decoration: none; display: inline-flex; align-items: center; gap: 4px; background: var(--red-bg); color: var(--red-text); border-color: var(--border-color);">
                                        <i class="fa-solid fa-pen-to-square"></i> Input Laporan
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- JAVASCRIPT HANYA UNTUK SEARCH REAL-TIME -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchSiswa');
            searchInput.addEventListener('keyup', function () {
                const filter = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('#tableSiswa tbody tr');

                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/Halaqah_saya.blade.php ENDPATH**/ ?>
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

            <!-- TOOLBAR ATAS: FILTER & PENCARIAN -->
            <div class="filter-toolbar-box">
                <div class="filter-left-options">
                    <div class="dropdown-filter">
                        <span>Halaqah</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-filter">
                        <span>Naik</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </div>
                <div class="filter-right-options">
                    <div class="search-field-custom">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchSiswa" placeholder="Cari...">
                    </div>
                    <button class="btn-filter-badge" title="Filter Lanjutan">
                        <i class="fa-solid fa-filter"></i>
                        <span class="badge-count">0</span>
                    </button>
                </div>
            </div>

            <!-- TABLE CARD DAFTAR SISWA BERDASARKAN HALAQAH -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table-halaqah-modern" id="tableSiswa">
                        <thead>
                            <tr>
                                <th>Nama Siswa <i class="fa-solid fa-chevron-down text-xs"></i></th>
                                <th class="text-right">Status Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- KELOMPOK HALAQAH 1: Kelas 1A - Halaqah 2 -->
                            <tr class="halaqah-group-row" onclick="toggleGroup(this)">
                                <td colspan="2">
                                    <div class="group-header-content">
                                        <span>Halaqah: Kelas 1A - Halaqah 2</span>
                                        <i class="fa-solid fa-chevron-down toggle-icon"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr class="student-row">
                                <td>Khayra</td>
                                <td class="text-right">
                                    <div class="action-status-cell">
                                        <span class="badge-status-gray">Belum Input</span>
                                        <a href="<?php echo e(url('/laporan/input?nama=Khayra')); ?>" class="btn-input-laporan">
                                            <i class="fa-solid fa-plus"></i> Input Laporan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="student-row">
                                <td>Galena Aisyah</td>
                                <td class="text-right">
                                    <div class="action-status-cell">
                                        <span class="badge-status-gray">Belum Input</span>
                                        <a href="<?php echo e(url('/laporan/input?nama=Galena')); ?>" class="btn-input-laporan">
                                            <i class="fa-solid fa-plus"></i> Input Laporan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="student-row">
                                <td>Feisya</td>
                                <td class="text-right">
                                    <div class="action-status-cell">
                                        <span class="badge-status-gray">Belum Input</span>
                                        <a href="<?php echo e(url('/laporan/input?nama=Feisya')); ?>" class="btn-input-laporan">
                                            <i class="fa-solid fa-plus"></i> Input Laporan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="student-row">
                                <td>Besse Adzkia</td>
                                <td class="text-right">
                                    <div class="action-status-cell">
                                        <span class="badge-status-gray">Belum Input</span>
                                        <a href="<?php echo e(url('/laporan/input?nama=Besse')); ?>" class="btn-input-laporan">
                                            <i class="fa-solid fa-plus"></i> Input Laporan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="student-row">
                                <td>Aisyah Aqila Mustafa</td>
                                <td class="text-right">
                                    <div class="action-status-cell">
                                        <span class="badge-status-gray">Belum Input</span>
                                        <a href="<?php echo e(url('/laporan/input?nama=Aisyah')); ?>" class="btn-input-laporan">
                                            <i class="fa-solid fa-plus"></i> Input Laporan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="student-row">
                                <td>Adiba Rizky Nurjannah</td>
                                <td class="text-right">
                                    <div class="action-status-cell">
                                        <span class="badge-status-gray">Belum Input</span>
                                        <a href="<?php echo e(url('/laporan/input?nama=Adiba')); ?>" class="btn-input-laporan">
                                            <i class="fa-solid fa-plus"></i> Input Laporan
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- KELOMPOK HALAQAH 2: Kelas 1B - Halaqah 4 (Expanded State dengan Chevron Up) -->
                            <tr class="halaqah-group-row expanded" onclick="toggleGroup(this)">
                                <td colspan="2">
                                    <div class="group-header-content">
                                        <span>Halaqah: Kelas 1B - Halaqah 4</span>
                                        <i class="fa-solid fa-chevron-up toggle-icon"></i>
                                    </div>
                                </td>
                            </tr>
                            <!-- Tambahkan baris siswa untuk kelompok ini jika diperlukan -->
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION FOOTER -->
                <div class="table-pagination-footer">
                    <span class="pagination-info">Menampilkan 1 sampai 14 dari 14 hasil</span>
                    <div class="pagination-per-page">
                        <span>per halaman</span>
                        <select class="select-per-page">
                            <option value="50" selected>50</option>
                            <option value="25">25</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- JAVASCRIPT: PENCARIAN REAL-TIME & TOGGLE ACCORDION GROUP -->
    <script>
        function toggleGroup(row) {
            row.classList.toggle('expanded');
            const icon = row.querySelector('.toggle-icon');
            if (row.classList.contains('expanded')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchSiswa');
            searchInput.addEventListener('keyup', function () {
                const filter = searchInput.value.toLowerCase();
                const rows = document.querySelectorAll('#tableSiswa tbody tr.student-row');

                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\tahfiz\guru\Halaqah_saya.blade.php ENDPATH**/ ?>
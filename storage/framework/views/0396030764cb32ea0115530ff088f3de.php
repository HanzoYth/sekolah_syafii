<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Tahfiz - Digital Tahfiz</title>
    <!-- Google Fonts: Amiri (Arab) + Poppins (Body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Riwayat Laporan -->
    
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/riwayat_laporan.css')); ?>?v=<?php echo e(time()); ?>">
    
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
                    <h2>Riwayat Laporan Hafalan Siswa</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- CARD REKAP LAPORAN HAFALAN SISWA -->
            <div class="table-card card-rekap-laporan">
                
                <!-- 1. HEADER PERIODE & TOMBOL EXPORT PDF -->
                <div class="header-periode-bar">
                    <div class="periode-pills-group">
                        <button type="button" class="btn-pill active">Semua</button>
                        <button type="button" class="btn-pill">Harian</button>
                        <button type="button" class="btn-pill">Pekanan</button>
                        <button type="button" class="btn-pill">Bulanan</button>
                    </div>
                    <a href="" target="_blank" class="btn-export-pdf">
                        <i class="fa-solid fa-file-arrow-down"></i> Export PDF
                    </a>
                </div>

                <!-- 2. TOOLBAR PENCARIAN & FILTER -->
                <div class="search-filter-row">
                    <div class="search-input-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchRiwayat" placeholder="Cari">
                    </div>
                    <button type="button" class="btn-filter-icon" title="Filter Tambahan">
                        <i class="fa-solid fa-filter"></i>
                        <span class="badge-count">0</span>
                    </button>
                </div>

                <!-- 3. TABEL DATA RIWAYAT SETORAN -->
                <div class="table-responsive">
                    <table class="table-riwayat-custom" id="tableRiwayat">
                        <thead>
                            <tr>
                                <th>Tanggal <i class="fa-solid fa-chevron-down text-xs"></i></th>
                                <th>Siswa <i class="fa-solid fa-chevron-up text-xs"></i></th>
                                <th>Surah</th>
                                <th>Status</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- ITEM 1 -->
                            <tr>
                                <td class="col-tanggal">
                                    <span class="date-txt">19 Okt 2026</span>
                                    <span class="time-txt">00:45 WIB</span>
                                </td>
                                <td class="col-siswa">
                                    <strong class="student-fullname">Adiba Rizky Nurjannah</strong>
                                    <span class="student-meta">Halaqah: Halaqah 4</span>
                                    <span class="student-meta">Kelas: 1B</span>
                                </td>
                                <td class="col-surah">
                                    <div class="surah-item-row">
                                        <span class="code-tag">Z:</span>
                                        <span class="arabic-txt">الكوثر</span>
                                        <span class="latin-txt">(Al-Kausar): 1</span>
                                    </div>
                                    <div class="surah-item-row">
                                        <span class="code-tag">M:</span>
                                        <span class="arabic-txt">الإخلاص</span>
                                        <span class="latin-txt">(Al-Ikhlas): 1-4</span>
                                    </div>
                                    <div class="surah-item-row sub-murojaah">
                                        <span class="arabic-txt">الفلق</span>
                                        <span class="latin-txt">(Al-Falaq): 1-5</span>
                                    </div>
                                    <div class="surah-item-row sub-murojaah">
                                        <span class="arabic-txt">الناس</span>
                                        <span class="latin-txt">(An-Nas): 1-6</span>
                                    </div>
                                </td>
                                <td class="col-status">
                                    <div class="status-badges-group">
                                        <span class="badge-pill outline-dark">Belum Lancar</span>
                                        <span class="badge-pill outline-dark">Belum Tercapai</span>
                                    </div>
                                    <div class="target-details">
                                        <strong>Juz 30</strong>
                                        <span>Target: 1 baris</span>
                                        <span>Disetor 1 baris</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-btn-vertical">
                                        <button type="button" class="btn-action-sm btn-catatan" 
                                            onclick="openCatatanModal('Adiba Rizky Nurjannah', 'Tidak ada catatan khusus.')">
                                            <i class="fa-solid fa-comment-dots"></i> Catatan
                                        </button>
                                        <button type="button" class="btn-action-sm btn-pr" 
                                            onclick="openPrModal('Adiba Rizky Nurjannah', 'PR Ziyadah: Al-Kausar: 2-3', 'PR Murojaah: An-Nas: 1-6')">
                                            <i class="fa-solid fa-bookmark"></i> PR
                                        </button>
                                        <button type="button" class="btn-action-sm btn-lihat" 
                                            onclick="openDetailLaporanModal('19 Okt 2026', 'Adiba Rizky Nurjannah', 'Juz 30', '1 baris / 1 baris', 'Belum Tercapai', 'Al-Kausar: 1', 'Al-Ikhlas: 1-4')">
                                            <i class="fa-solid fa-eye"></i> Lihat
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ITEM 2 -->
                            <tr>
                                <td class="col-tanggal">
                                    <span class="date-txt">16 Okt 2026</span>
                                    <span class="time-txt">03:17 WIB</span>
                                </td>
                                <td class="col-siswa">
                                    <strong class="student-fullname">Adiba Rizky Nurjannah</strong>
                                    <span class="student-meta">Halaqah: Halaqah 4</span>
                                    <span class="student-meta">Kelas: 1B</span>
                                </td>
                                <td class="col-surah">
                                    <div class="surah-item-row">
                                        <span class="code-tag">Z:</span>
                                        <span class="arabic-txt">الكافرون</span>
                                        <span class="latin-txt">(Al-Kafirun): 1-6</span>
                                    </div>
                                    <div class="surah-item-row">
                                        <span class="code-tag">M:</span>
                                        <span class="arabic-txt">النصر</span>
                                        <span class="latin-txt">(An-Nasr): 1-3</span>
                                    </div>
                                    <div class="surah-item-row sub-murojaah">
                                        <span class="arabic-txt">المسد</span>
                                        <span class="latin-txt">(Al-Lahab): 1-5</span>
                                    </div>
                                </td>
                                <td class="col-status">
                                    <div class="status-badges-group">
                                        <span class="badge-pill outline-dark">Lancar</span>
                                        <span class="badge-pill outline-dark">Tercapai</span>
                                    </div>
                                    <div class="target-details">
                                        <strong>Juz 30</strong>
                                        <span>Target: 1 baris</span>
                                        <span>Disetor 1 baris</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-btn-vertical">
                                        <button type="button" class="btn-action-sm btn-catatan"
                                            onclick="openCatatanModal('Adiba Rizky Nurjannah', 'Hafalan sangat lancar dan tajwid tepat.')">
                                            <i class="fa-solid fa-comment-dots"></i> Catatan
                                        </button>
                                        <button type="button" class="btn-action-sm btn-pr"
                                            onclick="openPrModal('Adiba Rizky Nurjannah', 'PR Ziyadah: Al-Kausar: 1', 'PR Murojaah: Al-Kafirun: 1-6')">
                                            <i class="fa-solid fa-bookmark"></i> PR
                                        </button>
                                        <button type="button" class="btn-action-sm btn-lihat"
                                            onclick="openDetailLaporanModal('16 Okt 2026', 'Adiba Rizky Nurjannah', 'Juz 30', '1 baris / 1 baris', 'Tercapai', 'Al-Kafirun: 1-6', 'An-Nasr: 1-3')">
                                            <i class="fa-solid fa-eye"></i> Lihat
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ITEM 3 -->
                            <tr>
                                <td class="col-tanggal">
                                    <span class="date-txt">14 Okt 2026</span>
                                    <span class="time-txt">02:28 WIB</span>
                                </td>
                                <td class="col-siswa">
                                    <strong class="student-fullname">Adiba Rizky Nurjannah</strong>
                                    <span class="student-meta">Halaqah: Halaqah 4</span>
                                    <span class="student-meta">Kelas: 1B</span>
                                </td>
                                <td class="col-surah">
                                    <div class="surah-item-row">
                                        <span class="code-tag">Z:</span>
                                        <span class="arabic-txt">الكافرون</span>
                                        <span class="latin-txt">(Al-Kafirun): 1-4</span>
                                    </div>
                                    <div class="surah-item-row">
                                        <span class="code-tag">M:</span>
                                        <span class="arabic-txt">الإخلاص</span>
                                        <span class="latin-txt">(Al-Ikhlas): 1-4</span>
                                    </div>
                                    <div class="surah-item-row sub-murojaah">
                                        <span class="arabic-txt">الفلق</span>
                                        <span class="latin-txt">(Al-Falaq): 1-5</span>
                                    </div>
                                    <div class="surah-item-row sub-murojaah">
                                        <span class="arabic-txt">الناس</span>
                                        <span class="latin-txt">(An-Nas): 1-6</span>
                                    </div>
                                </td>
                                <td class="col-status">
                                    <div class="status-badges-group">
                                        <span class="badge-pill outline-dark">Lancar</span>
                                        <span class="badge-pill outline-dark">Tercapai</span>
                                    </div>
                                    <div class="target-details">
                                        <strong>Juz 30</strong>
                                        <span>Target: 1 baris</span>
                                        <span>Disetor 1 baris</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-btn-vertical">
                                        <button type="button" class="btn-action-sm btn-catatan"
                                            onclick="openCatatanModal('Adiba Rizky Nurjannah', 'Makhraj huruf fathah perlu diperhatikan.')">
                                            <i class="fa-solid fa-comment-dots"></i> Catatan
                                        </button>
                                        <button type="button" class="btn-action-sm btn-pr"
                                            onclick="openPrModal('Adiba Rizky Nurjannah', 'PR Ziyadah: Al-Kafirun: 5-6', 'PR Murojaah: Al-Ikhlas')">
                                            <i class="fa-solid fa-bookmark"></i> PR
                                        </button>
                                        <button type="button" class="btn-action-sm btn-lihat"
                                            onclick="openDetailLaporanModal('14 Okt 2026', 'Adiba Rizky Nurjannah', 'Juz 30', '1 baris / 1 baris', 'Tercapai', 'Al-Kafirun: 1-4', 'Al-Ikhlas: 1-4')">
                                            <i class="fa-solid fa-eye"></i> Lihat
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- ITEM 4 -->
                            <tr>
                                <td class="col-tanggal">
                                    <span class="date-txt">12 Okt 2026</span>
                                    <span class="time-txt">04:33 WIB</span>
                                </td>
                                <td class="col-siswa">
                                    <strong class="student-fullname">Adiba Rizky Nurjannah</strong>
                                    <span class="student-meta">Halaqah: Halaqah 4</span>
                                    <span class="student-meta">Kelas: 1B</span>
                                </td>
                                <td class="col-surah">
                                    <div class="surah-item-row">
                                        <span class="code-tag">Z:</span>
                                        <span class="arabic-txt">الكافرون</span>
                                        <span class="latin-txt">(Al-Kafirun): 1-4</span>
                                    </div>
                                    <div class="surah-item-row">
                                        <span class="code-tag">M:</span>
                                        <span class="arabic-txt">النصر</span>
                                        <span class="latin-txt">(An-Nasr): 1-3</span>
                                    </div>
                                    <div class="surah-item-row sub-murojaah">
                                        <span class="arabic-txt">المسد</span>
                                        <span class="latin-txt">(Al-Lahab): 1-5</span>
                                    </div>
                                </td>
                                <td class="col-status">
                                    <div class="status-badges-group">
                                        <span class="badge-pill outline-dark">Belum Lancar</span>
                                        <span class="badge-pill outline-dark">Belum Tercapai</span>
                                    </div>
                                    <div class="target-details">
                                        <strong>Juz 30</strong>
                                        <span>Target: 1 baris</span>
                                        <span>Disetor 1 baris</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-btn-vertical">
                                        <button type="button" class="btn-action-sm btn-catatan"
                                            onclick="openCatatanModal('Adiba Rizky Nurjannah', 'Perlu murojaah ulang di rumah.')">
                                            <i class="fa-solid fa-comment-dots"></i> Catatan
                                        </button>
                                        <button type="button" class="btn-action-sm btn-pr"
                                            onclick="openPrModal('Adiba Rizky Nurjannah', 'PR Ziyadah: Ulangi Al-Kafirun 1-4', 'PR Murojaah: An-Nasr')">
                                            <i class="fa-solid fa-bookmark"></i> PR
                                        </button>
                                        <button type="button" class="btn-action-sm btn-lihat"
                                            onclick="openDetailLaporanModal('12 Okt 2026', 'Adiba Rizky Nurjannah', 'Juz 30', '1 baris / 1 baris', 'Belum Tercapai', 'Al-Kafirun: 1-4', 'An-Nasr: 1-3')">
                                            <i class="fa-solid fa-eye"></i> Lihat
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>

    <!-- MODAL POP-UP CATATAN -->
    <div class="modal-overlay" id="catatanModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3><i class="fa-solid fa-comment-dots"></i> Catatan Guru</h3>
                <button type="button" class="modal-close" onclick="closeCatatanModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p><strong>Siswa:</strong> <span id="catatanNamaSiswa">-</span></p>
                <div class="modal-content-box mt-10"<?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/guru/riwayat.blade.php ENDPATH**/ ?>
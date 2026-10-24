<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Dashboard Siswa -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboard.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboardsiswa.css')); ?>?v=<?php echo e(time()); ?>">
    
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
                    <h2>Assalamu'alaikum, Razak 👋</h2>
                    <p class="subtitle-text">Tetap semangat menambah dan menjaga hafalan Al-Qur'an hari ini.</p>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Siswa"></i>
                </div>
            </header>

            <!-- KARTU BANNER PROFIL SISWA (SESUAI GAMBAR REFERENSI) -->
            <div class="student-profile-banner">
                <!-- Avatar Inisial Besar -->
                <div class="avatar-large">RA</div>

                <!-- Detail Nama & Grid Informasi -->
                <div class="student-banner-body">
                    <div class="student-name-row">
                        <div>
                            <h3>Razak</h3>
                            <span class="nis-text">NIS: 222301005</span>
                        </div>
                        <button type="button" class="btn-toggle-collapse" title="Sembunyikan / Tampilkan">
                            <i class="fa-solid fa-chevron-up"></i>
                        </button>
                    </div>

                    <!-- 4 Card Informasi (Kelas, Halaqah, Pengampu, Juz Saat Ini) -->
                    <div class="profile-info-cards-grid">
                        <div class="info-card-item">
                            <div class="info-card-icon"><i class="fa-solid fa-building-columns"></i></div>
                            <div class="info-card-text">
                                <small>KELAS</small>
                                <strong>1A</strong>
                            </div>
                        </div>

                        <div class="info-card-item">
                            <div class="info-card-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                            <div class="info-card-text">
                                <small>HALAQAH</small>
                                <strong>Halaqah 2</strong>
                            </div>
                        </div>

                        <div class="info-card-item">
                            <div class="info-card-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <div class="info-card-text">
                                <small>PENGAMPU</small>
                                <strong>Ustadzah Rayhanah Qurri...</strong>
                            </div>
                        </div>

                        <div class="info-card-item">
                            <div class="info-card-icon"><i class="fa-solid fa-book-open"></i></div>
                            <div class="info-card-text">
                                <small>JUZ SAAT INI</small>
                                <strong>Juz 30</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD PESAN & INFORMASI (SESUAI DENGAN TAMPILAN GAMBAR REFERENSI) -->
            <div class="table-card messages-info-card">
                <div class="messages-card-header">
                    <h4><i class="fa-solid fa-clipboard-list icon-header"></i> Pesan & Informasi</h4>
                </div>

                <div class="messages-card-body">
                    <!-- 1. PENGUMUMAN TERBARU -->
                    <div class="message-section-block">
                        <span class="block-label announcement-label">
                            <i class="fa-solid fa-bullhorn"></i> PENGUMUMAN TERBARU
                        </span>
                        <h5 class="announcement-title">⏰ 🗓️ Jadwal Tasmi' Siswa</h5>
                        <p class="announcement-desc">
                            Berikut kami lampirkan jadwal tasmi' siswa sebagai informasi bagi siswa dan orang tua. Semoga kegiatan tasmi' berjalan lancar dan menjadi motivasi untuk terus menjaga serta meningkatkan hafalan Al-Qur'an. 🤲 ✨ 📑 Jika nama ananda Sholeh/ah belum tercantum pada flyer jadwal tasmi' mohon segera menghubungi pengampu halaqah...
                        </p>
                        <a href="#" class="read-more-link">Baca selengkapnya &rarr;</a>
                    </div>

                    <hr class="section-divider">

                    <!-- 2. CATATAN GURU -->
                    <div class="message-section-block">
                        <span class="block-label teacher-note-label">
                            <i class="fa-solid fa-comment-dots"></i> CATATAN GURU
                        </span>
                        <p class="teacher-note-text">Barakallahu fiik 🌱</p>
                    </div>

                    <hr class="section-divider">

                    <!-- 3. TUGAS / PR DI RUMAH -->
                    <div class="message-section-block">
                        <span class="block-label homework-label">
                            <i class="fa-solid fa-book-bookmark"></i> TUGAS / PR DI RUMAH
                        </span>
                        <div class="homework-item-row">
                            <span class="code-badge ziyadah-badge">Z</span>
                            <span class="homework-text">Al-Fil (1-2)</span>
                        </div>
                        <div class="homework-item-row">
                            <span class="code-badge murojaah-badge">M</span>
                            <span class="homework-text">Quraisy (1-4)</span>
                        </div>
                    </div>
                </div>

                <!-- FOOTER TANGGAL SETORAN -->
                <div class="messages-card-footer">
                    <span>Setoran: 21 Oktober 2026</span>
                </div>
            </div>

            <!-- ROW GRAFIK PERKEMBANGAN & STATUS SETORAN -->
            <div class="summary-filter-row">
                <!-- GRAFIK PERKEMBANGAN HAFALAN -->
                <div class="summary-box" style="flex: 2;">
                    <div class="chart-header-flex">
                        <h4><i class="fa-solid fa-chart-line"></i> Grafik Perkembangan Hafalan</h4>
                        
                        <div class="chart-controls">
                            <div class="type-toggle">
                                <button type="button" class="btn-toggle active" data-type="ziyadah">Ziyadah</button>
                                <button type="button" class="btn-toggle" data-type="murojaah">Murojaah</button>
                            </div>
                            
                            <select class="select-range-sm" id="timeRangeSelect">
                                <option value="7">7 Hari Terakhir</option>
                                <option value="14">14 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <div class="chart-box">
                        <div class="dummy-chart" id="chartBars">
                            <div class="bar" style="height: 40%;" title="17/10: 2 Baris"></div>
                            <div class="bar" style="height: 60%;" title="18/10: 3 Baris"></div>
                            <div class="bar" style="height: 80%;" title="19/10: 4 Baris"></div>
                            <div class="bar" style="height: 50%;" title="20/10: 2.5 Baris"></div>
                            <div class="bar" style="height: 90%;" title="21/10: 4.5 Baris"></div>
                        </div>
                        <div class="chart-labels">
                            <span>17/10</span><span>18/10</span><span>19/10</span><span>20/10</span><span>21/10</span>
                        </div>
                    </div>
                </div>

                <!-- RINGKASAN CAPAIAN JUZ -->
                <div class="filter-box" style="flex: 1;">
                    <h4><i class="fa-solid fa-star"></i> Status Target</h4>
                    <div class="status-card-today">
                        <div class="status-item">
                            <label>Capaian Target Bulan Ini:</label>
                            <span class="badge success"><i class="fa-solid fa-circle-check"></i> 85% (Tercapai)</span>
                        </div>
                        <div class="status-item mt-15">
                            <label>Predikat Kelancaran:</label>
                            <span class="badge-text green"><i class="fa-solid fa-award"></i> Sangat Baik</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABEL RIWAYAT SETORAN HAFALAN -->
            <div class="table-card mt-20">
                <div class="table-header-flex">
                    <h4><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Setoran Hafalan</h4>
                    <div class="filter-group-inline">
                        <input type="date" value="2026-10-21" class="input-date-sm">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table-riwayat-siswa">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Setoran Ziyadah</th>
                                <th>Setoran Murojaah</th>
                                <th>Jumlah Baris</th>
                                <th>Kondisi</th>
                                <th>Target</th>
                                <th>Catatan Ustadz</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>21/10/2026</td>
                                <td>Al-Fil: 1-2</td>
                                <td>Quraisy: 1-4</td>
                                <td>5 Baris</td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td><small><i>Barakallahu fiik 🌱</i></small></td>
                            </tr>
                            <tr>
                                <td>19/10/2026</td>
                                <td>Al-Humazah: 1-9</td>
                                <td>At-Takasur: 1-8</td>
                                <td>4 Baris</td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td><small><i>Tajwid dan makhraj huruf sudah pas.</i></small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- SCRIPT INTERAKSI TOGGLE & CHART -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtns = document.querySelectorAll('.type-toggle .btn-toggle');
            const timeRangeSelect = document.getElementById('timeRangeSelect');

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    toggleBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\tahfiz\siswa\dasboard.blade.php ENDPATH**/ ?>
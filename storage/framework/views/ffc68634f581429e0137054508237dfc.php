<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pekerjaan Rumah & Pengumuman - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/pengumumansiswa.css')); ?>">
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
                    <h2>Pekerjaan Rumah & Pengumuman 📌</h2>
                    <p class="subtitle-text">Pantau tugas murajaah/ziyadah di rumah dan informasi penting dari halaqah Anda.</p>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC CARDS SISWA -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>2 Tugas</h3>
                    <p>PR Aktif Perlu Diselesaikan</p>
                </div>
                <div class="stat-card">
                    <h3>23 Okt 2026</h3>
                    <p>Tenggat PR Terdekat</p>
                </div>
                <div class="stat-card">
                    <h3>3 Pengumuman</h3>
                    <p>Informasi Bulan Ini</p>
                </div>
                <div class="stat-card">
                    <h3>100%</h3>
                    <p>Tingkat Pengumpulan PR</p>
                </div>
            </div>

            <!-- TABEL PEKERJAAN RUMAH (PR) -->
            <div class="table-card">
                <div class="card-header-title">
                    <h4><i class="fa-solid fa-book-open-reader style-gold"></i> Daftar Pekerjaan Rumah (PR) Hafalan</h4>
                    <span class="badge success"><i class="fa-solid fa-clock-rotate-left"></i> Semester Ganjil 2026/2027</span>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Materi / Surah PR</th>
                                <th>Jenis Tugas</th>
                                <th>Pengampu</th>
                                <th>Tenggat Waktu</th>
                                <th>Status PR</th>
                                <th>Catatan / Instruksi Ustadz</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>An-Naba: Ayat 1 - 15</strong></td>
                                <td>Murajaah Mandiri</td>
                                <td>Ustadz Ahmad</td>
                                <td>23/10/2026 (08.00)</td>
                                <td><span class="badge danger"><i class="fa-solid fa-hourglass-half"></i> Belum Selesai</span></td>
                                <td><small><i>Ulangi minimal 5x putaran sebelum setoran di halaqah esok hari.</i></small></td>
                                <td>
                                    <button type="button" class="btn-xs btn-submit">Tandai Selesai</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>An-Nazi'at: Ayat 1 - 10</strong></td>
                                <td>Ziyadah (Persiapan)</td>
                                <td>Ustadz Ahmad</td>
                                <td>25/10/2026 (08.00)</td>
                                <td><span class="badge danger"><i class="fa-solid fa-hourglass-half"></i> Belum Selesai</span></td>
                                <td><small><i>Perhatikan makhraj huruf Dhad dan Shad pada ayat 6-8.</i></small></td>
                                <td>
                                    <button type="button" class="btn-xs btn-submit">Tandai Selesai</button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>'Abasa: Ayat 1 - 42</strong></td>
                                <td>Tasmi' Kelompok</td>
                                <td>Ustadz Ahmad</td>
                                <td>18/10/2026</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah Dinilai</span></td>
                                <td><small><i>MasyaAllah, bacaan sangat lancar dan tartil.</i></small></td>
                                <td>
                                    <button type="button" class="btn-xs" disabled style="opacity:0.6; cursor:not-allowed;">Selesai</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SECTION PENGUMUMAN HALAQAH & SEKOLAH -->
            <div class="info-card-section">
                <div class="card-header-title">
                    <h4><i class="fa-solid fa-bullhorn style-gold"></i> Pengumuman & Informasi Terbaru</h4>
                    <span class="badge-count">3 Pengumuman</span>
                </div>

                <div class="info-list">
                    <!-- Pengumuman 1 -->
                    <div class="info-item unread">
                        <div class="info-icon bg-green">
                            <i class="fa-solid fa-star-and-crescent"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-meta">
                                <span class="sender-name">Ustadz Ahmad (Pengampu Halaqah 1)</span>
                                <span class="info-date">19 Okt 2026, 09:00 WITA</span>
                            </div>
                            <p class="info-message"><strong>Jadwal Ujian Tasmi' Pekanan:</strong> Diberitahukan kepada santri Halaqah 1 bahwa evaluasi Tasmi' Juz 29 akan dilaksanakan pada hari Sabtu, 24 Oktober 2026. Harap memaksimalkan murajaah di rumah.</p>
                        </div>
                    </div>

                    <!-- Pengumuman 2 -->
                    <div class="info-item">
                        <div class="info-icon bg-blue">
                            <i class="fa-solid fa-mosque"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-meta">
                                <span class="sender-name">Panitia Tahfiz Digital</span>
                                <span class="info-date">15 Okt 2026, 14:30 WITA</span>
                            </div>
                            <p class="info-message"><strong>Kegiatan Mabit & Khataman Al-Qur'an:</strong> InsyaAllah kegiatan Mabit bulanan akan dilaksanakan pada akhir bulan ini di Masjid Utama Sekolah. Informasi detail susunan acara akan dibagikan pekan depan.</p>
                        </div>
                    </div>

                    <!-- Pengumuman 3 -->
                    <div class="info-item">
                        <div class="info-icon bg-green">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-meta">
                                <span class="sender-name">Koordinator Tahfiz</span>
                                <span class="info-date">10 Okt 2026, 08:00 WITA</span>
                            </div>
                            <p class="info-message"><strong>Perubahan Jam Halaqah Pagi:</strong> Selama pekan evaluasi, halaqah ziyadah pagi dimulai pukul 07.15 WITA tepat. Dimohon santri hadir 10 menit sebelum kegiatan dimulai.</p>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/siswa/pengumumansiswa.blade.php ENDPATH**/ ?>
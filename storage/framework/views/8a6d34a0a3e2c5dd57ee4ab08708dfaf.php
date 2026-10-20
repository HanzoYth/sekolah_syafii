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
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/dashboardsiswa.css')); ?>">
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
                    <h2>Assalamu'alaikum, hafiz! 👋</h2>
                    <p class="subtitle-text">Tetap semangat menambah dan menjaga hafalan Al-Qur'an hari ini.</p>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- PROFILE SUMMARY CARD -->
            <div class="student-profile-banner">
                <div class="student-profile">
                    <div class="avatar"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="student-info">
                        <h3>Ali Rahman</h3>
                        <p>Kelas: <strong>1A</strong> | Halaqah: <strong>Halaqah 1</strong></p>
                        <p>Pengampu: <strong>Ustadz Ahmad</strong></p>
                    </div>
                </div>
                <div class="target-today-badge">
                    <span>Target Hari Ini:</span>
                    <strong>5 Baris Ziyadah</strong>
                </div>
            </div>

            <!-- STATISTIC CARDS SISWA -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Juz 29</h3>
                    <p>Posisi Hafalan saat Ini</p>
                </div>
                <div class="stat-card">
                    <h3>85%</h3>
                    <p>Capaian Target Bulan Ini</p>
                </div>
                <div class="stat-card">
                    <h3>12</h3>
                    <p>Halaman Dihafal (Bulan Ini)</p>
                </div>
                <div class="stat-card">
                    <h3>Sangat Baik</h3>
                    <p>Predikat Kelancaran</p>
                </div>
            </div>

            <!-- SECTION PESAN & INFORMASI DARI USTADZ / USTADZAH -->
            <div class="info-card-section mb-20">
                <div class="card-header-flex">
                    <h4><i class="fa-solid fa-bullhorn icon-title"></i> Pesan & Informasi dari Ustadz/Ustadzah</h4>
                    <span class="badge-count">2 Baru</span>
                </div>
                <div class="info-list">
                    <div class="info-item unread">
                        <div class="info-icon bg-green">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-meta">
                                <span class="sender-name">Ustadz Ahmad</span>
                                <span class="info-date">Hari ini, 08:30 WITA</span>
                            </div>
                            <p class="info-message">MasyaAllah Ali, kelancaran di Surah An-Naba' sudah baik. Jangan lupa nanti malam diulang kembali ayat 1-10 untuk persiapan mutqin esok hari.</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon bg-blue">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-meta">
                                <span class="sender-name">Ustadzah Nurul (Koordinator Tahfiz)</span>
                                <span class="info-date">21/06/2026</span>
                            </div>
                            <p class="info-message">Diberitahukan kepada seluruh siswa Halaqah 1 bahwa evaluasi bulanan (Tasmi') akan dilaksanakan pada hari Sabtu pekan depan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ROW GRAPH & STATUS HARI INI -->
            <div class="summary-filter-row">
                
                <!-- PROGRESS GRAFIK DENGAN FILTER TIPE & RENTANG WAKTU -->
                <div class="summary-box" style="flex: 2;">
                    <div class="chart-header-flex">
                        <h4>Grafik Perkembangan Hafalan</h4>
                        
                        <div class="chart-controls">
                            <!-- Toggle Jenis Hafalan -->
                            <div class="type-toggle">
                                <button type="button" class="btn-toggle active" data-type="ziyadah">Ziyadah</button>
                                <button type="button" class="btn-toggle" data-type="murojaah">Murojaah</button>
                            </div>
                            
                            <!-- Filter Rentang Waktu -->
                            <select class="select-range-sm" id="timeRangeSelect">
                                <option value="7">7 Hari Terakhir</option>
                                <option value="14">14 Hari Terakhir</option>
                                <option value="30">30 Hari Terakhir</option>
                                <option value="90">3 Bulan Terakhir</option>
                            </select>
                        </div>
                    </div>

                    <div class="chart-box">
                        <div class="dummy-chart" id="chartBars">
                            <div class="bar" style="height: 40%;" title="17/06: 2 Baris"></div>
                            <div class="bar" style="height: 60%;" title="18/06: 3 Baris"></div>
                            <div class="bar" style="height: 80%;" title="19/06: 4 Baris"></div>
                            <div class="bar" style="height: 50%;" title="20/06: 2.5 Baris"></div>
                            <div class="bar" style="height: 70%;" title="21/06: 3.5 Baris"></div>
                            <div class="bar" style="height: 90%;" title="22/06: 4.5 Baris"></div>
                            <div class="bar" style="height: 100%;" title="23/06: 5 Baris"></div>
                        </div>
                        <div class="chart-labels" id="chartLabels">
                            <span>17/06</span><span>18/06</span><span>19/06</span><span>20/06</span><span>21/06</span><span>22/06</span><span>23/06</span>
                        </div>
                    </div>
                </div>

                <!-- SETORAN HARI INI -->
                <div class="filter-box" style="flex: 1;">
                    <h4>Status Setoran Hari Ini</h4>
                    <div class="status-card-today">
                        <div class="status-item">
                            <label>Ziyadah (Setoran Baru):</label>
                            <span class="badge success"><i class="fa-solid fa-circle-check"></i> An-Naba: 1-5 (5 Baris)</span>
                        </div>
                        <div class="status-item mt-15">
                            <label>Murojaah (Pengulangan):</label>
                            <span class="badge success"><i class="fa-solid fa-circle-check"></i> An-Naba: 1-2 (2 Ayat)</span>
                        </div>
                        <div class="status-item mt-15">
                            <label>Kondisi Hafalan:</label>
                            <span class="badge-text green"><i class="fa-solid fa-star"></i> Lancar</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TABEL RIWAYAT SETORAN HAFALAN -->
            <div class="table-card">
                <div class="table-header-flex">
                    <h4>Riwayat Setoran Hafalan</h4>
                    <div class="filter-group-inline">
                        <input type="date" value="2026-06-23" class="input-date-sm">
                    </div>
                </div>
                <div class="table-responsive">
                    <table>
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
                                <td>23/06/2026</td>
                                <td>An-Naba: 1-5</td>
                                <td>An-Naba: 1-2</td>
                                <td>5 Baris</td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td><small><i>Makhraj huruf 'Ain sudah lebih jelas. Pertahankan.</i></small></td>
                            </tr>
                            <tr>
                                <td>22/06/2026</td>
                                <td>An-Naba: 1-4</td>
                                <td>An-Naba: 1-3</td>
                                <td>4 Baris</td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td><small><i>Bagus, tajwid sudah tepat.</i></small></td>
                            </tr>
                            <tr>
                                <td>21/06/2026</td>
                                <td>'Abasa: 1-5</td>
                                <td>'Abasa: 1-2</td>
                                <td>5 Baris</td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                <td><small><i>Hati-hati di ayat ke-3 mad jaiz-nya.</i></small></td>
                            </tr>
                            <tr>
                                <td>20/06/2026</td>
                                <td>'Abasa: 1-3</td>
                                <td>-</td>
                                <td>3 Baris</td>
                                <td><span class="badge-text red">Belum Lancar</span></td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Tidak Tercapai</span></td>
                                <td><small><i>Perlu diulang kembali di rumah sebelum setoran.</i></small></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-15">
                    <button class="btn-outline"><i class="fa-solid fa-clock-rotate-left"></i> Lihat Seluruh Riwayat Setoran</button>
                </div>
            </div>

        </main>
    </div>

    <!-- SCRIPT INTERAKSI GRAPH & TOGGLE -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtns = document.querySelectorAll('.type-toggle .btn-toggle');
            const timeRangeSelect = document.getElementById('timeRangeSelect');

            toggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    toggleBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const selectedType = this.getAttribute('data-type');
                    const selectedRange = timeRangeSelect.value;
                    
                    // Di sini Anda dapat menambahkan fetch AJAX / update Chart JS sesuai parameter
                    console.log(`Fetch data untuk tipe: ${selectedType}, rentang: ${selectedRange} hari`);
                });
            });

            timeRangeSelect.addEventListener('change', function() {
                const activeType = document.querySelector('.type-toggle .btn-toggle.active').getAttribute('data-type');
                const selectedRange = this.value;
                
                // Di sini Anda dapat menambahkan fetch AJAX / update Chart JS sesuai parameter
                console.log(`Fetch data untuk tipe: ${activeType}, rentang: ${selectedRange} hari`);
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/siswa/dasboard.blade.php ENDPATH**/ ?>
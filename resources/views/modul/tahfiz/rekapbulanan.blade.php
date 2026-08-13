<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Bulanan - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/rekap_bulanan.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER + NAVIGASI BULAN -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Rekap Bulanan</span></p>
                    <h1>Rekap Bulanan</h1>
                </div>
                <div class="page-header-right">
                    <div class="month-nav">
                        <button class="month-nav-btn" title="Bulan sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="month-nav-current">
                            <i class="fa-regular fa-calendar-days"></i>
                            Juni 2026
                        </div>
                        <button class="month-nav-btn" title="Bulan berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Export</button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT BULANAN -->
            <div class="quick-stats">
                <div class="stat-pill">
                    <i class="fa-solid fa-book-quran"></i>
                    <div>
                        <h4>18</h4>
                        <p>Halaman Bertambah (Rata-rata/Siswa)</p>
                    </div>
                </div>
                <div class="stat-pill success">
                    <i class="fa-solid fa-chart-line"></i>
                    <div>
                        <h4>91%</h4>
                        <p>Konsistensi Input Halaqah</p>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-layer-group"></i>
                    <div>
                        <h4>34</h4>
                        <p>Siswa Naik Juz Bulan Ini</p>
                    </div>
                </div>
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>15</h4>
                        <p>Siswa Stagnan (Tanpa Progress)</p>
                    </div>
                </div>
            </div>

            <!-- 2b. GRAFIK TREN 4 MINGGUAN -->
            <div class="chart-card">
                <h4>
                    Tren Capaian Mingguan
                    <span class="chart-sub">Rata-rata persentase capaian target per minggu selama Juni 2026</span>
                </h4>
                <div class="week-trend-chart">
                    <div class="week-trend-bar-wrap">
                        <span class="week-trend-value">84%</span>
                        <div class="week-trend-bar" style="height: 84%;"></div>
                    </div>
                    <div class="week-trend-bar-wrap">
                        <span class="week-trend-value">88%</span>
                        <div class="week-trend-bar" style="height: 88%;"></div>
                    </div>
                    <div class="week-trend-bar-wrap">
                        <span class="week-trend-value">79%</span>
                        <div class="week-trend-bar" style="height: 79%;"></div>
                    </div>
                    <div class="week-trend-bar-wrap">
                        <span class="week-trend-value">91%</span>
                        <div class="week-trend-bar" style="height: 91%;"></div>
                    </div>
                </div>
                <div class="week-trend-labels">
                    <span>Minggu 1</span>
                    <span>Minggu 2</span>
                    <span>Minggu 3</span>
                    <span>Minggu 4</span>
                </div>
            </div>

            <!-- 2c. LEADERBOARD KECEPATAN PROGRESS HALAQAH -->
            <div class="chart-card">
                <h4>Halaqah Paling Konsisten Bulan Ini</h4>
                <div class="hbar-list">
                    <div class="hbar-row">
                        <span class="hbar-rank">1</span>
                        <span class="hbar-label">Kelas 3A - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 98%;"></div></div>
                        <span class="hbar-value">98%</span>
                    </div>
                    <div class="hbar-row">
                        <span class="hbar-rank">2</span>
                        <span class="hbar-label">Kelas 1A - Halaqah 2</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 94%;"></div></div>
                        <span class="hbar-value">94%</span>
                    </div>
                    <div class="hbar-row">
                        <span class="hbar-rank">3</span>
                        <span class="hbar-label">Kelas 1A - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 87%;"></div></div>
                        <span class="hbar-value">87%</span>
                    </div>
                    <div class="hbar-row pending">
                        <span class="hbar-rank">-</span>
                        <span class="hbar-label">Kelas 2B - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 45%;"></div></div>
                        <span class="hbar-value">6 hari kosong</span>
                    </div>
                </div>
            </div>

            <!-- 3. FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama siswa...">
                </div>
                <div class="toolbar-filters">
                    <select>
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                    <select>
                        <option>Semua Halaqah</option>
                        <option>Halaqah 1</option>
                        <option>Halaqah 2</option>
                    </select>
                    <select>
                        <option>Semua Progress</option>
                        <option>Naik Juz</option>
                        <option>Stagnan</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL PROGRESS HAFALAN PER SISWA -->
            <div class="table-card">
                <h4>Progress Hafalan Per Siswa</h4>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas / Halaqah</th>
                                <th>Posisi Awal Bulan</th>
                                <th>Posisi Akhir Bulan</th>
                                <th>Halaman Bertambah</th>
                                <th>Konsistensi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell-strong">Ali</td>
                                <td>1A - Halaqah 1</td>
                                <td class="juz-progress"><span class="juz-old">Juz 28</span></td>
                                <td class="juz-progress"><span class="juz-new">Juz 29</span></td>
                                <td>22 halaman</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 96%;"></div>
                                    </div>
                                    <span class="progress-mini-label">96%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-arrow-trend-up"></i> Naik Juz</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row-pending">
                                <td class="cell-strong">Budi</td>
                                <td>1A - Halaqah 1</td>
                                <td class="juz-progress"><span class="juz-old">Juz 27</span></td>
                                <td class="juz-progress"><span class="juz-new">Juz 27</span></td>
                                <td>3 halaman</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 38%;"></div>
                                    </div>
                                    <span class="progress-mini-label">38%</span>
                                </td>
                                <td><span class="badge danger"><i class="fa-solid fa-triangle-exclamation"></i> Stagnan</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Ingatkan Wali/Pengampu" class="highlight"><i class="fa-solid fa-bell"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Citra</td>
                                <td>1A - Halaqah 1</td>
                                <td class="juz-progress"><span class="juz-old">Juz 30</span></td>
                                <td class="juz-progress"><span class="juz-new">Juz 30</span></td>
                                <td>14 halaman</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 82%;"></div>
                                    </div>
                                    <span class="progress-mini-label">82%</span>
                                </td>
                                <td><span class="badge warning"><i class="fa-solid fa-minus"></i> Dalam Juz</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Dafa</td>
                                <td>1A - Halaqah 1</td>
                                <td class="juz-progress"><span class="juz-old">Juz 26</span></td>
                                <td class="juz-progress"><span class="juz-new">Juz 28</span></td>
                                <td>28 halaman</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">100%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-arrow-trend-up"></i> Naik Juz</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <h4>Belum ada data untuk bulan ini</h4>
                    <p>Belum ada laporan yang tercatat pada bulan yang dipilih.</p>
                </div>
                --}}
            </div>

            <!-- 5. CATATAN EVALUASI KOORDINATOR -->
            <div class="evaluation-card">
                <h4><i class="fa-solid fa-pen-to-square"></i> Catatan Evaluasi Bulanan</h4>

                <div class="evaluation-list">
                    <div class="evaluation-item">
                        <div class="evaluation-avatar"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="evaluation-item-body">
                            <h5>Kelas 2B - Halaqah 1</h5>
                            <p>Konsistensi input menurun drastis bulan ini, perlu ditindaklanjuti dengan pengampu terkait kendala yang dihadapi.</p>
                        </div>
                    </div>
                    <div class="evaluation-item">
                        <div class="evaluation-avatar"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="evaluation-item-body">
                            <h5>Kelas 3A - Halaqah 1</h5>
                            <p>Progress sangat baik, rata-rata siswa naik 1 juz penuh. Bisa dijadikan contoh best practice untuk halaqah lain.</p>
                        </div>
                    </div>
                </div>

                <textarea class="evaluation-textarea mt-15" placeholder="Tulis catatan evaluasi baru untuk bulan ini..."></textarea>
                <div class="evaluation-footer">
                    <button class="btn-primary-gold"><i class="fa-solid fa-floppy-disk"></i> Simpan Catatan</button>
                </div>
            </div>

        </main>
    </div>

    <!-- 6. MODAL DETAIL PROGRESS SISWA -->
    <div class="modal-overlay" id="modalDetailSiswa">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">DETAIL PROGRESS BULANAN</span>
                    <h3>Ali — Kelas 1A, Halaqah 1</h3>
                    <p class="modal-subtitle">Periode: Juni 2026</p>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalDetailSiswa').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">

                <div class="modal-juz-summary">
                    <div class="modal-juz-box">
                        <span class="juz-label">Awal Bulan</span>
                        <div class="juz-num">Juz 28</div>
                    </div>
                    <i class="fa-solid fa-arrow-right-long modal-juz-arrow"></i>
                    <div class="modal-juz-box">
                        <span class="juz-label">Akhir Bulan</span>
                        <div class="juz-num">Juz 29</div>
                    </div>
                    <i class="fa-solid fa-arrow-right-long modal-juz-arrow"></i>
                    <div class="modal-juz-box">
                        <span class="juz-label">Estimasi Khatam</span>
                        <div class="juz-num" style="font-size: 1rem;">~4 bulan lagi</div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>Minggu</th>
                                <th>Total Ziyadah</th>
                                <th>Hari Capai Target</th>
                                <th>Kondisi Dominan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell-strong">Minggu 1</td>
                                <td>28 baris</td>
                                <td>6/6</td>
                                <td>Lancar</td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Minggu 2</td>
                                <td>26 baris</td>
                                <td>5/6</td>
                                <td>Lancar</td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Minggu 3</td>
                                <td>24 baris</td>
                                <td>5/6</td>
                                <td>Lancar</td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Minggu 4</td>
                                <td>30 baris</td>
                                <td>6/6</td>
                                <td>Lancar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalDetailSiswa').classList.remove('show')">Tutup</button>
                <button class="btn-primary-gold"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>
            </div>
        </div>
    </div>

</body>
</html>
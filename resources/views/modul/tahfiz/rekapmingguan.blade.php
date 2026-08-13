<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Mingguan - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/rekap_mingguan.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER + NAVIGASI MINGGU -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Rekap Mingguan</span></p>
                    <h1>Rekap Mingguan</h1>
                </div>
                <div class="page-header-right">
                    <div class="week-nav">
                        <button class="week-nav-btn" title="Minggu sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="week-nav-current">
                            <i class="fa-regular fa-calendar-days"></i>
                            16 – 22 Juni 2026
                        </div>
                        <button class="week-nav-btn" title="Minggu berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Export</button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT MINGGUAN -->
            <div class="quick-stats">
                <div class="stat-pill">
                    <i class="fa-solid fa-book-quran"></i>
                    <div>
                        <h4>1.284</h4>
                        <p>Total Baris Ziyadah</p>
                    </div>
                </div>
                <div class="stat-pill success">
                    <i class="fa-solid fa-chart-line"></i>
                    <div>
                        <h4>86%</h4>
                        <p>Rata-rata Capaian Harian</p>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-medal"></i>
                    <div>
                        <h4>212</h4>
                        <p>Siswa Konsisten (≥5 Hari)</p>
                    </div>
                </div>
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>23</h4>
                        <p>Siswa Perlu Perhatian</p>
                    </div>
                </div>
            </div>

            <!-- 2b. GRAFIK TREN HARIAN DALAM SEMINGGU (Senin-Sabtu aktif, Minggu libur) -->
            <div class="chart-card">
                <h4>Tren Capaian Harian (Senin–Minggu)</h4>
                <div class="weekday-chart">
                    <div class="weekday-bar-wrap">
                        <span class="weekday-bar-value">82%</span>
                        <div class="weekday-bar" style="height: 82%;"></div>
                    </div>
                    <div class="weekday-bar-wrap">
                        <span class="weekday-bar-value">90%</span>
                        <div class="weekday-bar" style="height: 90%;"></div>
                    </div>
                    <div class="weekday-bar-wrap">
                        <span class="weekday-bar-value">88%</span>
                        <div class="weekday-bar" style="height: 88%;"></div>
                    </div>
                    <div class="weekday-bar-wrap">
                        <span class="weekday-bar-value">91%</span>
                        <div class="weekday-bar" style="height: 91%;"></div>
                    </div>
                    <div class="weekday-bar-wrap">
                        <span class="weekday-bar-value">79%</span>
                        <div class="weekday-bar" style="height: 79%;"></div>
                    </div>
                    <div class="weekday-bar-wrap">
                        <span class="weekday-bar-value">85%</span>
                        <div class="weekday-bar" style="height: 85%;"></div>
                    </div>
                    <div class="weekday-bar-wrap pending">
                        <span class="weekday-bar-value">Libur</span>
                        <div class="weekday-bar" style="height: 8%;"></div>
                    </div>
                </div>
                <div class="weekday-labels">
                    <span>Senin</span>
                    <span>Selasa</span>
                    <span>Rabu</span>
                    <span>Kamis</span>
                    <span>Jumat</span>
                    <span>Sabtu</span>
                    <span>Minggu</span>
                </div>
            </div>

            <!-- 2c. LEADERBOARD HALAQAH MINGGU INI -->
            <div class="chart-card">
                <h4>Peringkat Halaqah Minggu Ini</h4>
                <div class="hbar-list">
                    <div class="hbar-row">
                        <span class="hbar-rank">1</span>
                        <span class="hbar-label">Kelas 3A - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 97%;"></div></div>
                        <span class="hbar-value">97%</span>
                    </div>
                    <div class="hbar-row">
                        <span class="hbar-rank">2</span>
                        <span class="hbar-label">Kelas 1A - Halaqah 2</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 93%;"></div></div>
                        <span class="hbar-value">93%</span>
                    </div>
                    <div class="hbar-row">
                        <span class="hbar-rank">3</span>
                        <span class="hbar-label">Kelas 1A - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 85%;"></div></div>
                        <span class="hbar-value">85%</span>
                    </div>
                    <div class="hbar-row pending">
                        <span class="hbar-rank">-</span>
                        <span class="hbar-label">Kelas 2B - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 40%;"></div></div>
                        <span class="hbar-value">2 hari kosong</span>
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
                        <option>Semua Kondisi</option>
                        <option>Konsisten</option>
                        <option>Perlu Perhatian</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL REKAP PER SISWA -->
            <div class="table-card">
                <h4>Rekap Capaian Per Siswa</h4>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas / Halaqah</th>
                                <th>Total Ziyadah</th>
                                <th>Total Murojaah</th>
                                <th>Hari Capai Target</th>
                                <th>Tren</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell-strong">Ali</td>
                                <td>1A - Halaqah 1</td>
                                <td>28 baris</td>
                                <td>11 ayat</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">6/6</span>
                                </td>
                                <td><span class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> Naik</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Konsisten</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row-pending">
                                <td class="cell-strong">Budi</td>
                                <td>1A - Halaqah 1</td>
                                <td>14 baris</td>
                                <td>6 ayat</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 33%;"></div>
                                    </div>
                                    <span class="progress-mini-label">2/6</span>
                                </td>
                                <td><span class="trend down"><i class="fa-solid fa-arrow-trend-down"></i> Turun</span></td>
                                <td><span class="badge danger"><i class="fa-solid fa-triangle-exclamation"></i> Perlu Perhatian</span></td>
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
                                <td>24 baris</td>
                                <td>10 ayat</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 83%;"></div>
                                    </div>
                                    <span class="progress-mini-label">5/6</span>
                                </td>
                                <td><span class="trend stable"><i class="fa-solid fa-minus"></i> Stabil</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Konsisten</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Dafa</td>
                                <td>1A - Halaqah 1</td>
                                <td>32 baris</td>
                                <td>12 ayat</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">6/6</span>
                                </td>
                                <td><span class="trend up"><i class="fa-solid fa-arrow-trend-up"></i> Naik</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Konsisten</span></td>
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
                    <h4>Belum ada data untuk minggu ini</h4>
                    <p>Belum ada laporan harian yang tercatat pada rentang minggu yang dipilih.</p>
                </div>
                --}}
            </div>

            <!-- 5. PERHATIAN KHUSUS -->
            <div class="attention-card">
                <h4><i class="fa-solid fa-triangle-exclamation"></i> Perlu Perhatian Minggu Ini</h4>
                <div class="attention-list">
                    <div class="attention-item">
                        <div class="attention-item-info">
                            <div class="attention-avatar"><i class="fa-solid fa-user"></i></div>
                            <div>
                                <h5>Budi — Kelas 1A, Halaqah 1</h5>
                                <p>Hanya capai target 2 dari 6 hari, cenderung menurun dari minggu lalu</p>
                            </div>
                        </div>
                        <button class="btn-outline">Lihat Detail</button>
                    </div>
                    <div class="attention-item">
                        <div class="attention-item-info">
                            <div class="attention-avatar"><i class="fa-solid fa-user"></i></div>
                            <div>
                                <h5>Fajar — Kelas 2B, Halaqah 1</h5>
                                <p>Tidak ada input sama sekali selama 3 hari terakhir</p>
                            </div>
                        </div>
                        <button class="btn-outline">Lihat Detail</button>
                    </div>
                </div>
            </div>

        </main>
    </div>

    <!-- 6. MODAL DETAIL REKAP SISWA -->
    <div class="modal-overlay" id="modalDetailSiswa">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">DETAIL REKAP MINGGUAN</span>
                    <h3>Ali — Kelas 1A, Halaqah 1</h3>
                    <p class="modal-subtitle">Periode: 16 – 22 Juni 2026</p>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalDetailSiswa').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>Hari / Tanggal</th>
                                <th>Ziyadah</th>
                                <th>Murojaah</th>
                                <th>Kondisi</th>
                                <th>Capaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Senin, 16/06</td>
                                <td>5 baris <small>(An-Naba: 1-5)</small></td>
                                <td>2 ayat</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>Selasa, 17/06</td>
                                <td>5 baris <small>(An-Naba: 6-10)</small></td>
                                <td>2 ayat</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>Rabu, 18/06</td>
                                <td>4 baris <small>(An-Naba: 11-14)</small></td>
                                <td>2 ayat</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>Kamis, 19/06</td>
                                <td>5 baris <small>(An-Naba: 15-19)</small></td>
                                <td>2 ayat</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>Jumat, 20/06</td>
                                <td>5 baris <small>(An-Naba: 20-24)</small></td>
                                <td>3 ayat</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>Sabtu, 21/06</td>
                                <td>4 baris <small>(An-Naba: 25-28)</small></td>
                                <td>2 ayat</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>Minggu, 22/06</td>
                                <td class="cell-empty">Libur</td>
                                <td class="cell-empty">-</td>
                                <td class="cell-empty">-</td>
                                <td class="cell-empty">-</td>
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
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
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboardsiswa.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR SISWA -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Assalamu'alaikum, Ali! 👋</h2>
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

            <!-- ROW GRAPH & STATUS HARI INI -->
            <div class="summary-filter-row">
                
                <!-- PROGRESS GRAFIK -->
                <div class="summary-box" style="flex: 2;">
                    <h4>Grafik Perkembangan Hafalan (7 Hari Terakhir)</h4>
                    <div class="chart-box">
                        <div class="dummy-chart">
                            <div class="bar" style="height: 40%;" title="17/06: 2 Baris"></div>
                            <div class="bar" style="height: 60%;" title="18/06: 3 Baris"></div>
                            <div class="bar" style="height: 80%;" title="19/06: 4 Baris"></div>
                            <div class="bar" style="height: 50%;" title="20/06: 2.5 Baris"></div>
                            <div class="bar" style="height: 70%;" title="21/06: 3.5 Baris"></div>
                            <div class="bar" style="height: 90%;" title="22/06: 4.5 Baris"></div>
                            <div class="bar" style="height: 100%;" title="23/06: 5 Baris"></div>
                        </div>
                        <div class="chart-labels">
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

</body>
</html>
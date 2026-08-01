<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Koordinator - Tahfiz Digital</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}">
</head>
<body>

    <div class="dashboard-container">
        
        <!-- WADAH TEMPLATE SIDEBAR -->
            <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <h2>Selamat datang, Koordinator</h2>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC CARDS (4 KOTAK ANGKA) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>6</h3>
                    <p>Kelas</p>
                </div>
                <div class="stat-card">
                    <h3>15</h3>
                    <p>Halaqah</p>
                </div>
                <div class="stat-card">
                    <h3>300</h3>
                    <p>Siswa</p>
                </div>
                <div class="stat-card">
                    <h3>12</h3>
                    <p>Laporan Hari Ini</p>
                </div>
            </div>

            <!-- ROW: RINGKASAN HARI INI & FILTER -->
            <div class="summary-filter-row">
                <!-- RINGKASAN HARI INI -->
                <div class="summary-box">
                    <h4>Ringkasan Hari Ini</h4>
                    <div class="summary-cards">
                        <div class="sum-card green">
                            <h3>11</h3>
                            <p>Halaqah sudah input</p>
                        </div>
                        <div class="sum-card yellow">
                            <h3>4</h3>
                            <p>Halaqah belum input</p>
                        </div>
                        <div class="sum-card red">
                            <h3>18</h3>
                            <p>Siswa tidak capai target</p>
                        </div>
                    </div>
                </div>

                <!-- FILTER -->
                <div class="filter-box">
                    <h4>Filter</h4>
                    <div class="filter-group">
                        <label>Kelas</label>
                        <select><option>Semua Kelas</option></select>
                    </div>
                    <div class="filter-group">
                        <label>Halaqah</label>
                        <select><option>Semua Halaqah</option></select>
                    </div>
                    <div class="filter-group">
                        <label>Tanggal</label>
                        <input type="date" value="2026-06-23">
                    </div>
                </div>
            </div>

            <!-- TABEL DAFTAR HALAQAH -->
            <div class="table-card">
                <h4>Daftar Halaqah</h4>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Nama Halaqah</th>
                                <th>Pengampu</th>
                                <th>Siswa</th>
                                <th>Input Hari Ini</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kelas 1A</td>
                                <td>Halaqah 1</td>
                                <td>Ustadz Ahmad</td>
                                <td>12</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Kelas 1A</td>
                                <td>Halaqah 2</td>
                                <td>Ustadzah Aisyah</td>
                                <td>11</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Kelas 2B</td>
                                <td>Halaqah 1</td>
                                <td>Ustadz Fajar</td>
                                <td>13</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Kelas 3A</td>
                                <td>Halaqah 1</td>
                                <td>Ustadzah Rina</td>
                                <td>10</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-15">
                    <button class="btn-outline"><i class="fa-solid fa-eye"></i> Lihat Semua Halaqah</button>
                </div>
            </div>

            <!-- ROW DETAIL (DETAIL HALAQAH & DETAIL SISWA VIEW) -->
            <div class="detail-row">
                <!-- DETAIL HALAQAH -->
                <div class="detail-box">
                    <div class="detail-header-tag">DETAIL HALAQAH (KOORDINATOR VIEW)</div>
                    <div class="detail-action-bar">
                        <button class="btn-back">&lt; Kembali</button>
                        <div class="action-right">
                            <button class="btn-action-outline"><i class="fa-solid fa-user-pen"></i> Alih Pengampu</button>
                            <button class="btn-action-outline"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                    <h3>Kelas 1A - Halaqah 1</h3>
                    <p class="subtitle-text">Pengampu: Ustadz Ahmad | Tanggal: 23/06/2026</p>

                    <div class="table-responsive mt-15">
                        <table class="table-compact">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Target Harian (baris)</th>
                                    <th>Capaian</th>
                                    <th>Jumlah Baris</th>
                                    <th>Kondisi Hafalan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Ali</td>
                                    <td>5</td>
                                    <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                    <td>5</td>
                                    <td>Lancar</td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Budi</td>
                                    <td>5</td>
                                    <td><span class="badge-text red"><i class="fa-solid fa-circle-xmark"></i> Tidak Tercapai</span></td>
                                    <td>3</td>
                                    <td>Belum Lancar</td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Citra</td>
                                    <td>4</td>
                                    <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                    <td>4</td>
                                    <td>Lancar</td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Dafa</td>
                                    <td>6</td>
                                    <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                                    <td>6</td>
                                    <td>Lancar</td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="bottom-btns">
                        <button class="btn-action-outline"><i class="fa-solid fa-calendar-week"></i> Rekap Mingguan</button>
                        <button class="btn-action-outline"><i class="fa-solid fa-calendar-days"></i> Rekap Bulanan</button>
                    </div>
                </div>

                <!-- DETAIL SISWA -->
                <div class="detail-box">
                    <div class="detail-header-tag">DETAIL SISWA</div>
                    <button class="btn-back mb-10">&lt; Kembali</button>

                    <div class="student-profile">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="student-info">
                            <h4>Ali</h4>
                            <p>Kelas: 1A | Halaqah 1</p>
                            <p>Juz: 29</p>
                        </div>
                    </div>

                    <div class="chart-box">
                        <h5>Progress Hafalan</h5>
                        <div class="dummy-chart">
                            <div class="bar" style="height: 40%;"></div>
                            <div class="bar" style="height: 60%;"></div>
                            <div class="bar" style="height: 80%;"></div>
                            <div class="bar" style="height: 50%;"></div>
                            <div class="bar" style="height: 70%;"></div>
                            <div class="bar" style="height: 90%;"></div>
                            <div class="bar" style="height: 100%;"></div>
                        </div>
                        <div class="chart-labels">
                            <span>17/06</span><span>18/06</span><span>19/06</span><span>20/06</span><span>21/06</span><span>22/06</span><span>23/06</span>
                        </div>
                    </div>

                    <div class="history-section">
                        <h5>Riwayat Terbaru</h5>
                        <table class="table-compact text-sm">
                            <thead>
                                <tr>
                                    <th>Tgl</th>
                                    <th>Ziyadah</th>
                                    <th>Murojaah</th>
                                    <th>Kondisi</th>
                                    <th>Capaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>23/06</td>
                                    <td>5 baris<br><small>(An-Naba: 1-5)</small></td>
                                    <td>2 ayat<br><small>(An-Naba: 1-2)</small></td>
                                    <td>Lancar</td>
                                    <td><i class="fa-solid fa-circle-check text-green"></i></td>
                                </tr>
                                <tr>
                                    <td>22/06</td>
                                    <td>4 baris<br><small>(An-Naba: 1-4)</small></td>
                                    <td>3 ayat<br><small>(An-Naba: 1-3)</small></td>
                                    <td>Lancar</td>
                                    <td><i class="fa-solid fa-circle-check text-green"></i></td>
                                </tr>
                                <tr>
                                    <td>21/06</td>
                                    <td>5 baris<br><small>('Abasa: 1-5)</small></td>
                                    <td>2 ayat<br><small>('Abasa: 1-2)</small></td>
                                    <td>Lancar</td>
                                    <td><i class="fa-solid fa-circle-check text-green"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- SCRIPT MEMANGGIL SIDEBAR TEMPLATE -->
    <script>
        fetch('sidebar.html')
            .then(response => response.text())
            .then(data => {
                document.getElementById('sidebar-container').innerHTML = data;
            })
            .catch(error => console.error('Gagal memuat sidebar:', error));
    </script>
</body>
</html>
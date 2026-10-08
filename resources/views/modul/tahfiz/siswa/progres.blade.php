<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progres Hafalan - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/progres.css') }}">
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
                    <h2>Progres Hafalan Al-Qur'an 📖</h2>
                    <p class="subtitle-text">Pantau statistik, capaian per Juz, dan target hafalanmu secara detail.</p>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- KARTU OVERVIEW RINGKASAN CAPAIAN -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>2.5 Juz</h3>
                    <p>Total Terhafal</p>
                </div>
                <div class="stat-card">
                    <h3>75 Baris</h3>
                    <p>Pencapaian Bulan Ini</p>
                </div>
                <div class="stat-card">
                    <h3>88%</h3>
                    <p>Rata-rata Kelancaran</p>
                </div>
                <div class="stat-card">
                    <h3>Juz 30</h3>
                    <p>Target Berikutnya</p>
                </div>
            </div>

            <!-- PROGRES TOTAL (PROGRESS BAR LARGE) -->
            <div class="overview-progress-card">
                <div class="progress-header">
                    <div>
                        <h4>Progress Keseluruhan Target Hafalan</h4>
                        <p class="subtitle-dark">Target Tahunan: <strong>3 Juz (Juz 30, 29, & 28)</strong></p>
                    </div>
                    <span class="progress-percentage">83%</span>
                </div>
                <div class="progress-bar-wrapper">
                    <div class="progress-bar-fill" style="width: 83%;"></div>
                </div>
                <div class="progress-footer-info">
                    <span><i class="fa-solid fa-book-quran"></i> Sudah Dihafal: <strong>2 Juz + 15 Halaman</strong></span>
                    <span><i class="fa-solid fa-flag"></i> Sisa Target: <strong>15 Halaman</strong></span>
                </div>
            </div>

            <!-- TABEL / GRID JUZ PROGRESS -->
            <div class="table-card">
                <div class="table-header-flex">
                    <h4>Peta Hafalan Per Juz</h4>
                    <div class="filter-group-inline">
                        <select class="input-select-sm">
                            <option value="all">Semua Juz Target</option>
                            <option value="30">Juz 30 (Juz 'Amma)</option>
                            <option value="29">Juz 29 (Tabarak)</option>
                            <option value="28">Juz 28 (Qad Sami'a)</option>
                        </select>
                    </div>
                </div>

                <div class="juz-grid">
                    <!-- CARD JUZ 30 (SELESAI) -->
                    <div class="juz-card completed">
                        <div class="juz-card-header">
                            <h5>Juz 30</h5>
                            <span class="badge success"><i class="fa-solid fa-check"></i> Selesai (100%)</span>
                        </div>
                        <p class="juz-detail-text">An-Naba s/d An-Nas (37 Surah)</p>
                        <div class="juz-mini-progress">
                            <div class="bar-fill" style="width: 100%;"></div>
                        </div>
                        <div class="juz-card-footer">
                            <span class="text-sm">Predikat: <strong class="text-green">Mumtaz</strong></span>
                            <button class="btn-xs"><i class="fa-solid fa-eye"></i> Rincian</button>
                        </div>
                    </div>

                    <!-- CARD JUZ 29 (SEDANG BERJALAN) -->
                    <div class="juz-card in-progress">
                        <div class="juz-card-header">
                            <h5>Juz 29</h5>
                            <span class="badge warning"><i class="fa-solid fa-spinner"></i> Progres (65%)</span>
                        </div>
                        <p class="juz-detail-text">Al-Mulk s/d Al-Mursalat</p>
                        <div class="juz-mini-progress">
                            <div class="bar-fill" style="width: 65%;"></div>
                        </div>
                        <div class="juz-card-footer">
                            <span class="text-sm">Posisi: <strong>Al-Haqqah</strong></span>
                            <button class="btn-xs"><i class="fa-solid fa-eye"></i> Rincian</button>
                        </div>
                    </div>

                    <!-- CARD JUZ 28 (BELUM DIMULAI) -->
                    <div class="juz-card pending">
                        <div class="juz-card-header">
                            <h5>Juz 28</h5>
                            <span class="badge gray"><i class="fa-regular fa-circle"></i> Belum Dimulai</span>
                        </div>
                        <p class="juz-detail-text">Al-Mujadila s/d At-Tahrim</p>
                        <div class="juz-mini-progress">
                            <div class="bar-fill" style="width: 0%;"></div>
                        </div>
                        <div class="juz-card-footer">
                            <span class="text-sm">Target: <strong>Semester 2</strong></span>
                            <button class="btn-xs" disabled><i class="fa-solid fa-lock"></i> Terkunci</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RINCIAN SURAH DALAM JUZ YANG SEDANG DIHAFAL -->
            <div class="table-card">
                <div class="table-header-flex">
                    <h4>Rincian Surah pada Juz 29 (Sedang Berjalan)</h4>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Surah</th>
                                <th>Jumlah Ayat</th>
                                <th>Status Setoran</th>
                                <th>Kelancaran</th>
                                <th>Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>67</td>
                                <td><strong>Al-Mulk</strong></td>
                                <td>30 Ayat</td>
                                <td><span class="badge success"><i class="fa-solid fa-check"></i> Lunas</span></td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td>10/06/2026</td>
                            </tr>
                            <tr>
                                <td>68</td>
                                <td><strong>Al-Qalam</strong></td>
                                <td>52 Ayat</td>
                                <td><span class="badge success"><i class="fa-solid fa-check"></i> Lunas</span></td>
                                <td><span class="badge-text green">Lancar</span></td>
                                <td>18/06/2026</td>
                            </tr>
                            <tr>
                                <td>69</td>
                                <td><strong>Al-Haqqah</strong></td>
                                <td>52 Ayat</td>
                                <td><span class="badge warning"><i class="fa-solid fa-spinner"></i> Proses (Ayat 1-24)</span></td>
                                <td><span class="badge-text yellow">Cukup</span></td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>70</td>
                                <td><strong>Al-Ma'arij</strong></td>
                                <td>44 Ayat</td>
                                <td><span class="badge gray">Belum</span></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
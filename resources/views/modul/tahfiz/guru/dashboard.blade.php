<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama Dashboard Guru -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Monitoring Halaqah & Laporan Harian</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- KARTU UTAMA RINGKASAN SESUAI REFERENSI GAMBAR -->
            <div class="dashboard-card-section">
                
                <!-- HEADER RINGKASAN & TAB PILIHAN HALAQAH -->
                <div class="summary-header-row">
                    <h3 class="summary-title">Ringkasan</h3>
                    <div class="halaqah-tabs">
                        <button type="button" class="tab-btn active">Semua Halaqah</button>
                        <button type="button" class="tab-btn">Halaqah 2</button>
                        <button type="button" class="tab-btn">Halaqah 4</button>
                    </div>
                </div>

                <!-- 4 KOTAK STATISTIK (TOTAL SISWA, SUDAH INPUT, BELUM INPUT, TANGGAL) -->
                <div class="stats-grid-modern">
                    <div class="stat-box-modern blue-bg">
                        <h3>14</h3>
                        <p>TOTAL SISWA</p>
                    </div>
                    <div class="stat-box-modern green-bg">
                        <h3>7</h3>
                        <p>SUDAH INPUT</p>
                    </div>
                    <div class="stat-box-modern red-bg">
                        <h3>7</h3>
                        <p>BELUM INPUT</p>
                    </div>
                    <div class="stat-box-modern date-bg">
                        <span class="date-box-label">TANGGAL</span>
                        <div class="date-input-wrapper">
                            <input type="date" value="2026-10-21">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- TOMBOL AKSI UTAMA (INPUT LAPORAN & LIHAT LAPORAN SEBELUMNYA) -->
            <div class="action-buttons-grid">
                <a href="/tf/gr/lp" class="action-card-btn primary-blue">
                    <div class="icon-circle-lg">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span>Input Laporan Harian</span>
                </a>

                <a href="/tf/gr/rp" class="action-card-btn white-card">
                    <div class="icon-circle-lg outline">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                    <span>Lihat Laporan Sebelumnya</span>
                </a>
            </div>

        </main>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/pengumuman.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <h2>Pengumuman Tahfiz</h2>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC CARDS (RINGKASAN PENGUMUMAN) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>12</h3>
                    <p>Total Pengumuman</p>
                </div>
                <div class="stat-card">
                    <h3>8</h3>
                    <p>Pengumuman Aktif</p>
                </div>
                <div class="stat-card">
                    <h3>3</h3>
                    <p>Penting / Mendesak</p>
                </div>
                <div class="stat-card">
                    <h3>1</h3>
                    <p>Draft</p>
                </div>
            </div>

            <!-- ACTION BAR & FILTER ROW -->
            <div class="action-filter-row">
                <button class="btn-primary" onclick="openModalTambah()">
                    <i class="fa-solid fa-plus"></i> Buat Pengumuman Baru
                </button>
                <div class="filter-group-inline">
                    <div class="filter-item">
                        <select>
                            <option value="">Semua Sasaran</option>
                            <option value="semua">Semua (Umum)</option>
                            <option value="ustadz">Seluruh Ustadz/ah</option>
                            <option value="siswa">Seluruh Siswa</option>
                            <option value="orangtua">Orang Tua / Wali</option>
                        </select>
                    </div>
                    <div class="filter-item">
                        <select>
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="draft">Draft</option>
                            <option value="arsip">Arsip</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- DAFTAR PENGUMUMAN (CARDS LIST) -->
            <div class="announcement-list">

                <!-- CARD PENGUMUMAN 1 (PENTING) -->
                <div class="announcement-card priority-high">
                    <div class="card-header">
                        <div class="badge-group">
                            <span class="badge badge-danger"><i class="fa-solid fa-triangle-exclamation"></i> Penting</span>
                            <span class="badge badge-info"><i class="fa-solid fa-users"></i> Semua Ustadz/ah</span>
                        </div>
                        <span class="announcement-date"><i class="fa-regular fa-calendar"></i> 23 Jun 2026</span>
                    </div>
                    <h3 class="announcement-title">Jadwal Tasmi' Hafalan 3 Juz Bulan Juni</h3>
                    <p class="announcement-body">
                        Diberitahukan kepada seluruh Ustadz/ah pengampu halaqah bahwa agenda Ujian Tasmi' Sekretariat Tahfiz akan dilaksanakan pada Sabtu, 27 Juni 2026. Mohon mempersiapkan data siswa yang sudah siap diuji.
                    </p>
                    <div class="card-footer">
                        <span class="author-info"><i class="fa-solid fa-user-pen"></i> Ditulis oleh: Koordinator Tahfiz</span>
                        <div class="action-buttons">
                            <button class="btn-sm-outline"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            <button class="btn-sm-danger"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                        </div>
                    </div>
                </div>

                <!-- CARD PENGUMUMAN 2 (INFORMASI UMUM) -->
                <div class="announcement-card">
                    <div class="card-header">
                        <div class="badge-group">
                            <span class="badge badge-success"><i class="fa-solid fa-bullhorn"></i> Informasi</span>
                            <span class="badge badge-info"><i class="fa-solid fa-graduation-cap"></i> Orang Tua & Siswa</span>
                        </div>
                        <span class="announcement-date"><i class="fa-regular fa-calendar"></i> 20 Jun 2026</span>
                    </div>
                    <h3 class="announcement-title">Libur Idul Adha & Target Murojaah Mandiri di Rumah</h3>
                    <p class="announcement-body">
                        Menjelang libur Hari Raya Idul Adha, kegiatan Halaqah Tatap Muka diliburkan mulai tanggal 28 s.d 30 Juni. Siswa diwajibkan mencatat murojaah mandiri melalui buku mutaba'ah digital.
                    </p>
                    <div class="card-footer">
                        <span class="author-info"><i class="fa-solid fa-user-pen"></i> Ditulis oleh: Admin Sekolah</span>
                        <div class="action-buttons">
                            <button class="btn-sm-outline"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                            <button class="btn-sm-danger"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                        </div>
                    </div>
                </div>

                <!-- CARD PENGUMUMAN 3 (DRAFT) -->
                <div class="announcement-card draft">
                    <div class="card-header">
                        <div class="badge-group">
                            <span class="badge badge-warning"><i class="fa-solid fa-file-lines"></i> Draft</span>
                            <span class="badge badge-info"><i class="fa-solid fa-users"></i> Internal Pengampu</span>
                        </div>
                        <span class="announcement-date"><i class="fa-regular fa-calendar"></i> 18 Jun 2026</span>
                    </div>
                    <h3 class="announcement-title">Rapat Evaluasi Capaian Ziayadah Semester Genap</h3>
                    <p class="announcement-body">
                        Draf pengumuman rapat evaluasi target setoran hafalan murid target akhir semester. (Belum dipublikasikan)
                    </p>
                    <div class="card-footer">
                        <span class="author-info"><i class="fa-solid fa-user-pen"></i> Ditulis oleh: Koordinator Tahfiz</span>
                        <div class="action-buttons">
                            <button class="btn-sm-outline"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
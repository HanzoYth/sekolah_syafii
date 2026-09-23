<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <x-sidebar_siakad />

        <main class="main-content siakad-overview">
            <header class="overview-hero">
                <div class="overview-pattern" aria-hidden="true"></div>
                <div class="overview-hero-content">
                    <div>
                        <p class="arabic-greeting">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <p class="eyebrow">DASHBOARD ADMIN SIAKAD</p>
                        <h1>Assalamu'alaikum, Admin</h1>
                        <p class="hero-subtitle">Pantau aktivitas sekolah dan selesaikan pekerjaan penting hari ini.</p>
                    </div>
                    <div class="academic-period"><i class="fa-regular fa-calendar-days"></i><div><span>Selasa, 04 Agustus 2026</span><strong>TP 2026/2027 · Semester Ganjil</strong></div></div>
                </div>
            </header>

            <section class="overview-section" aria-labelledby="statistik-title">
                <div class="section-heading"><div><p class="section-kicker">RINGKASAN SEKOLAH</p><h2 id="statistik-title">Statistik utama</h2></div><span class="updated-label"><i class="fa-solid fa-arrows-rotate"></i> Diperbarui hari ini</span></div>
                <div class="overview-stat-grid">
                    <article class="overview-stat-card"><span class="stat-icon emerald"><i class="fa-solid fa-user-graduate"></i></span><div><strong>842</strong><span>Siswa aktif</span></div></article>
                    <article class="overview-stat-card"><span class="stat-icon blue"><i class="fa-solid fa-chalkboard-user"></i></span><div><strong>56</strong><span>Guru &amp; staf</span></div></article>
                    <article class="overview-stat-card"><span class="stat-icon gold"><i class="fa-solid fa-school"></i></span><div><strong>28</strong><span>Rombel / kelas</span></div></article>
                    <article class="overview-stat-card"><span class="stat-icon violet"><i class="fa-solid fa-chart-line"></i></span><div><strong>96,4%</strong><span>Kehadiran hari ini</span><small><i class="fa-solid fa-arrow-trend-up"></i> 1,2% dari bulan lalu</small></div></article>
                </div>
            </section>

            <section class="overview-main-grid" aria-label="Informasi prioritas">
                <article class="dashboard-panel">
                    <div class="panel-heading"><div><p class="section-kicker">PRIORITAS HARI INI</p><h2>Perlu ditindaklanjuti</h2></div><span class="count-badge">12 item</span></div>
                    <ul class="follow-up-list">
                        <li><span class="follow-up-icon warning"><i class="fa-solid fa-user-clock"></i></span><div><strong>Absensi belum diinput</strong><p>3 kelas belum mengirim absensi hari ini.</p></div><a href="#daftar-kelas">Tinjau <i class="fa-solid fa-chevron-right"></i></a></li>
                        <li><span class="follow-up-icon danger"><i class="fa-solid fa-file-circle-exclamation"></i></span><div><strong>Data siswa belum lengkap</strong><p>6 profil siswa membutuhkan pembaruan data.</p></div><a href="#">Tinjau <i class="fa-solid fa-chevron-right"></i></a></li>
                        <li><span class="follow-up-icon info"><i class="fa-solid fa-envelope-open-text"></i></span><div><strong>Pengajuan izin masuk</strong><p>3 pengajuan sedang menunggu persetujuan.</p></div><a href="#">Tinjau <i class="fa-solid fa-chevron-right"></i></a></li>
                        <li><span class="follow-up-icon success"><i class="fa-solid fa-wallet"></i></span><div><strong>Pembayaran SPP jatuh tempo</strong><p>11 tagihan jatuh tempo dalam 3 hari.</p></div><a href="#">Tinjau <i class="fa-solid fa-chevron-right"></i></a></li>
                    </ul>
                </article>
                <article class="dashboard-panel attendance-panel">
                    <div class="panel-heading"><div><p class="section-kicker">KEHADIRAN</p><h2>Ringkasan hari ini</h2></div><a class="text-link" href="#">Lihat rekap</a></div>
                    <div class="attendance-progress"><div class="attendance-percent"><strong>96,4%</strong><span>tercatat hadir</span></div><div class="progress-ring" aria-hidden="true"><span><i class="fa-solid fa-check"></i></span></div></div>
                    <div class="attendance-breakdown"><div><span class="dot hadir"></span><strong>798</strong><small>Hadir</small></div><div><span class="dot izin"></span><strong>27</strong><small>Izin / sakit</small></div><div><span class="dot alpa"></span><strong>9</strong><small>Alpa</small></div><div><span class="dot late"></span><strong>8</strong><small>Terlambat</small></div></div>
                </article>
            </section>

            <section class="overview-main-grid school-info-grid" aria-label="Informasi sekolah">
                <article class="dashboard-panel"><div class="panel-heading"><div><p class="section-kicker">INFORMASI SEKOLAH</p><h2>Pengumuman terbaru</h2></div><a class="text-link" href="#">Lihat semua</a></div>
                    <ul class="overview-list announcement-list">
                        <li><span class="list-icon emerald"><i class="fa-solid fa-bullhorn"></i></span><div><strong>Pembagian Rapor Tengah Semester</strong><p>Rapor dibagikan oleh wali kelas kepada wali murid.</p></div><time>02 Agu</time></li>
                        <li><span class="list-icon gold"><i class="fa-solid fa-money-check-dollar"></i></span><div><strong>Batas Pembayaran SPP Agustus</strong><p>Pembayaran paling lambat tanggal 10 Agustus 2026.</p></div><time>01 Agu</time></li>
                        <li><span class="list-icon blue"><i class="fa-solid fa-flag"></i></span><div><strong>Libur Nasional &amp; Cuti Bersama</strong><p>KBM diliburkan sesuai kalender pendidikan.</p></div><time>29 Jul</time></li>
                    </ul>
                </article>
                <article class="dashboard-panel"><div class="panel-heading"><div><p class="section-kicker">AGENDA</p><h2>Kalender akademik</h2></div><a class="text-link" href="#">Lihat semua</a></div>
                    <ul class="overview-list calendar-list">
                        <li><time class="calendar-date"><strong>12</strong><span>Agu</span></time><div><strong>Penilaian Tengah Semester</strong><p>Berlaku untuk seluruh jenjang.</p></div></li>
                        <li><time class="calendar-date"><strong>17</strong><span>Agu</span></time><div><strong>Upacara HUT RI</strong><p>Libur kegiatan belajar mengajar.</p></div></li>
                        <li><time class="calendar-date"><strong>25</strong><span>Agu</span></time><div><strong>Rapat Wali Murid</strong><p>Aula sekolah, pukul 09.00 WITA.</p></div></li>
                    </ul>
                </article>
            </section>

            <section class="dashboard-panel class-panel" id="daftar-kelas">
                <div class="panel-heading"><div><p class="section-kicker">MONITORING KELAS</p><h2>Ringkasan kehadiran kelas</h2></div><a class="text-link" href="#">Lihat semua kelas</a></div>
                <div class="table-responsive overview-table-wrap"><table class="overview-table"><thead><tr><th>Kelas</th><th>Jenjang</th><th>Wali Kelas</th><th>Jumlah Siswa</th><th>Kehadiran Hari Ini</th><th>Status</th></tr></thead><tbody>
                    <tr><td><strong>Kelas 1A</strong></td><td><span class="level-pill">SD</span></td><td>Ustadzah Fitri</td><td>28 siswa</td><td><span class="attendance-value good">98%</span></td><td><span class="status-pill complete"><i class="fa-solid fa-circle-check"></i> Lengkap</span></td></tr>
                    <tr><td><strong>Kelas 2B</strong></td><td><span class="level-pill">SD</span></td><td>Ustadz Rahman</td><td>30 siswa</td><td><span class="attendance-value good">95%</span></td><td><span class="status-pill complete"><i class="fa-solid fa-circle-check"></i> Lengkap</span></td></tr>
                    <tr><td><strong>Kelas 7A</strong></td><td><span class="level-pill">SMP</span></td><td>Ustadzah Ani</td><td>32 siswa</td><td><span class="attendance-value caution">87%</span></td><td><span class="status-pill attention"><i class="fa-solid fa-triangle-exclamation"></i> Perlu perhatian</span></td></tr>
                    <tr><td><strong>TK B1</strong></td><td><span class="level-pill">TK</span></td><td>Ustadzah Sari</td><td>20 siswa</td><td><span class="attendance-value good">100%</span></td><td><span class="status-pill pending"><i class="fa-solid fa-clock"></i> Belum input</span></td></tr>
                </tbody></table></div>
            </section>

            <section class="quick-action-section" aria-labelledby="aksi-cepat-title">
                <div class="section-heading"><div><p class="section-kicker">PINTASAN</p><h2 id="aksi-cepat-title">Aksi cepat</h2></div></div>
                <div class="quick-action-grid">
                    <a href="#" class="quick-action"><span class="quick-icon emerald"><i class="fa-solid fa-user-plus"></i></span><span>Tambah siswa</span></a><a href="#" class="quick-action"><span class="quick-icon blue"><i class="fa-solid fa-clipboard-check"></i></span><span>Input absensi</span></a><a href="#" class="quick-action"><span class="quick-icon gold"><i class="fa-solid fa-users-rectangle"></i></span><span>Kelola kelas</span></a><a href="#" class="quick-action"><span class="quick-icon violet"><i class="fa-solid fa-user-tie"></i></span><span>Kelola guru</span></a><a href="#" class="quick-action"><span class="quick-icon rose"><i class="fa-solid fa-bullhorn"></i></span><span>Buat pengumuman</span></a><a href="#" class="quick-action"><span class="quick-icon slate"><i class="fa-solid fa-file-export"></i></span><span>Export laporan</span></a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

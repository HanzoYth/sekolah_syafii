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
            <x-siakad.topbar title="Dashboard Admin" description="Pantau ringkasan data akademik dan administrasi pembayaran." position="Administrator SIAKAD" initials="AD" />

            <header class="overview-hero">
                <div class="overview-pattern" aria-hidden="true"></div>
                <div class="overview-hero-content">
                    <div>
                        <p class="arabic-greeting">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <p class="eyebrow">DASHBOARD ADMIN SIAKAD</p>
                        <h1>Assalamu'alaikum, Admin</h1>
                        <p class="hero-subtitle">Pantau data sekolah dan administrasi yang membutuhkan perhatian.</p>
                    </div>
                    <div class="academic-period"><i class="fa-regular fa-calendar-days"></i><div><span>{{ now()->locale('id')->translatedFormat('l, d F Y') }}</span><strong>Ringkasan data SIAKAD</strong></div></div>
                </div>
            </header>

            <section class="overview-section" aria-labelledby="statistik-title">
                <div class="section-heading"><div><p class="section-kicker">RINGKASAN SEKOLAH</p><h2 id="statistik-title">Statistik utama</h2></div><span class="updated-label"><i class="fa-solid fa-database"></i> Data saat ini</span></div>
                <div class="overview-stat-grid">
                    <article class="overview-stat-card"><span class="stat-icon emerald"><i class="fa-solid fa-user-graduate"></i></span><div><strong>{{ number_format($jumlahSiswa) }}</strong><span>Siswa terdaftar</span><small>{{ number_format($jumlahSiswaAktif) }} siswa aktif</small></div></article>
                    <article class="overview-stat-card"><span class="stat-icon blue"><i class="fa-solid fa-file-invoice-dollar"></i></span><div><strong>{{ number_format($jumlahTagihan) }}</strong><span>Tagihan akademik</span><small>IPP, pangkal, dan pendidikan</small></div></article>
                    <article class="overview-stat-card"><span class="stat-icon gold"><i class="fa-solid fa-school"></i></span><div><strong>{{ number_format($jumlahKelas) }}</strong><span>Rombel / kelas</span><small>Data kelas terdaftar</small></div></article>
                    <article class="overview-stat-card"><span class="stat-icon violet"><i class="fa-solid fa-triangle-exclamation"></i></span><div><strong>{{ number_format($jumlahTunggakan) }}</strong><span>Tagihan menunggak</span><small>Memerlukan tindak lanjut</small></div></article>
                </div>
            </section>

            <section class="overview-main-grid" aria-label="Informasi prioritas">
                <article class="dashboard-panel">
                    <div class="panel-heading"><div><p class="section-kicker">PRIORITAS</p><h2>Perlu ditindaklanjuti</h2></div><span class="count-badge">{{ number_format($jumlahTunggakan) }} tagihan</span></div>
                    <ul class="follow-up-list">
                        <li><span class="follow-up-icon danger"><i class="fa-solid fa-file-circle-exclamation"></i></span><div><strong>Tagihan belum lunas</strong><p>{{ number_format($jumlahTunggakan) }} tagihan tercatat belum lunas pada data pembayaran.</p></div><a href="/sk/pb">Tinjau <i class="fa-solid fa-chevron-right"></i></a></li>
                        <li><span class="follow-up-icon info"><i class="fa-solid fa-users"></i></span><div><strong>Data siswa terdaftar</strong><p>{{ number_format($jumlahSiswa) }} siswa tercatat dalam sistem akademik.</p></div><a href="/sk/ds">Lihat siswa <i class="fa-solid fa-chevron-right"></i></a></li>
                        <li><span class="follow-up-icon success"><i class="fa-solid fa-school"></i></span><div><strong>Ruang kelas</strong><p>{{ number_format($jumlahKelas) }} ruang kelas tersedia untuk pengelolaan akademik.</p></div><a href="/sk/tk">Kelola <i class="fa-solid fa-chevron-right"></i></a></li>
                    </ul>
                </article>
                <article class="dashboard-panel attendance-panel">
                    <div class="panel-heading"><div><p class="section-kicker">PEMBAYARAN</p><h2>Ringkasan administrasi</h2></div><a class="text-link" href="/sk/pb">Lihat IPP</a></div>
                    <div class="attendance-progress"><div class="attendance-percent"><strong>{{ number_format($jumlahTagihan) }}</strong><span>tagihan tercatat</span></div><div class="progress-ring" aria-hidden="true"><span><i class="fa-solid fa-wallet"></i></span></div></div>
                    <div class="attendance-breakdown"><div><span class="dot hadir"></span><strong>{{ number_format($jumlahTagihan - $jumlahTunggakan) }}</strong><small>Lunas</small></div><div><span class="dot alpa"></span><strong>{{ number_format($jumlahTunggakan) }}</strong><small>Menunggak</small></div><div><span class="dot izin"></span><strong>{{ number_format($jumlahSiswa) }}</strong><small>Siswa</small></div><div><span class="dot late"></span><strong>{{ number_format($jumlahKelas) }}</strong><small>Kelas</small></div></div>
                </article>
            </section>

            <section class="dashboard-panel class-panel" id="daftar-kelas">
                <div class="panel-heading"><div><p class="section-kicker">DATA KELAS</p><h2>Ringkasan siswa per kelas</h2></div><a class="text-link" href="/sk/tk">Kelola kelas</a></div>
                <div class="table-responsive overview-table-wrap"><table class="overview-table"><thead><tr><th>Kelas</th><th>Jumlah Siswa</th><th>Status Data</th></tr></thead><tbody>
                    @forelse ($kelasDenganSiswa as $kelas)
                        <tr><td><strong>{{ $kelas->nama_ruang }}</strong></td><td>{{ number_format($kelas->jumlah_siswa) }} siswa</td><td><span class="status-pill complete"><i class="fa-solid fa-circle-check"></i> Terdaftar</span></td></tr>
                    @empty
                        <tr><td colspan="3" class="overview-empty">Belum ada data kelas yang dapat ditampilkan.</td></tr>
                    @endforelse
                </tbody></table></div>
            </section>

            <section class="quick-action-section" aria-labelledby="aksi-cepat-title">
                <div class="section-heading"><div><p class="section-kicker">PINTASAN</p><h2 id="aksi-cepat-title">Aksi cepat</h2></div></div>
                <div class="quick-action-grid">
                    <a href="/sk/ds" class="quick-action"><span class="quick-icon emerald"><i class="fa-solid fa-user-graduate"></i></span><span>Data siswa</span></a><a href="/sk/bt" class="quick-action"><span class="quick-icon blue"><i class="fa-solid fa-file-circle-plus"></i></span><span>Buat tagihan</span></a><a href="/sk/tk" class="quick-action"><span class="quick-icon gold"><i class="fa-solid fa-users-rectangle"></i></span><span>Kelola kelas</span></a><a href="/sk/pb" class="quick-action"><span class="quick-icon violet"><i class="fa-solid fa-wallet"></i></span><span>Pembayaran IPP</span></a><a href="/sk/pp" class="quick-action"><span class="quick-icon rose"><i class="fa-solid fa-money-check-dollar"></i></span><span>Uang pangkal</span></a><a href="/sk/pd" class="quick-action"><span class="quick-icon slate"><i class="fa-solid fa-graduation-cap"></i></span><span>Pendidikan</span></a>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

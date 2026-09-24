<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dashboardSiswa.css') }}?v={{ time() }}">
</head>
<body>
    <div class="dashboard-container student-dashboard">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar :name="$data_siswa->nama" position="Siswa" initials="SW" title="Dashboard Siswa" description="Pantau informasi akademik dan aktivitas belajar Anda." />

            <section class="student-stat-grid" aria-label="Ringkasan akademik">
                <article class="student-stat-card"><span class="student-stat-icon attendance"><i class="fa-solid fa-clipboard-check"></i></span><div><small>Kehadiran bulan ini</small><strong>96%</strong><em>24 dari 25 hari hadir</em></div></article>
                <article class="student-stat-card"><span class="student-stat-icon grade"><i class="fa-solid fa-star"></i></span><div><small>Rata-rata nilai</small><strong>89</strong><em>Baik sekali</em></div></article>
                <article class="student-stat-card"><span class="student-stat-icon bill"><i class="fa-solid fa-wallet"></i></span><div><small>Status pembayaran</small><strong>Lunas</strong><em>Periode Agustus 2026</em></div></article>
                <article class="student-stat-card"><span class="student-stat-icon news"><i class="fa-solid fa-bullhorn"></i></span><div><small>Pengumuman baru</small><strong>3</strong><em>Informasi perlu dibaca</em></div></article>
            </section>

            <section class="student-dashboard-grid">
                <article class="student-panel schedule-panel">
                    <div class="student-panel-heading"><div><p>AKTIVITAS HARI INI</p><h3>Jadwal pelajaran</h3></div><span class="today-badge"><i class="fa-regular fa-calendar"></i> Hari ini</span></div>
                    <ul class="schedule-list">
                        <li><time>07.30<small>08.10</small></time><span class="schedule-line emerald"></span><div><strong>Al-Qur'an Hadits</strong><p>Ustadzah Fitri · Ruang {{ $data_kelas->nama_ruang }}</p></div><span class="schedule-status done">Selesai</span></li>
                        <li><time>08.10<small>08.50</small></time><span class="schedule-line blue"></span><div><strong>Matematika</strong><p>Ustadz Rahman · Ruang {{ $data_kelas->nama_ruang }}</p></div><span class="schedule-status active">Berlangsung</span></li>
                        <li><time>09.10<small>09.50</small></time><span class="schedule-line gold"></span><div><strong>Bahasa Indonesia</strong><p>Ustadzah Sari · Ruang {{ $data_kelas->nama_ruang }}</p></div><span class="schedule-status upcoming">Berikutnya</span></li>
                    </ul>
                    <p class="student-panel-note"><i class="fa-solid fa-circle-info"></i> Jadwal lengkap akan tersedia pada menu akademik.</p>
                </article>

                <article class="student-panel payment-panel">
                    <div class="student-panel-heading"><div><p>ADMINISTRASI</p><h3>Status pembayaran</h3></div><a href="/sk/pbs">Lihat detail</a></div>
                    <div class="payment-status-card"><span><i class="fa-solid fa-circle-check"></i></span><div><strong>Pembayaran lunas</strong><p>Tidak ada tagihan aktif pada periode ini.</p></div></div>
                    <div class="payment-info"><div><span>Periode</span><strong>Agustus 2026</strong></div><div><span>Total dibayar</span><strong>Rp 1.000.000</strong></div></div>
                    <a href="/sk/pbs" class="student-primary-action"><i class="fa-solid fa-receipt"></i> Lihat slip pembayaran</a>
                </article>
            </section>

            <section class="student-dashboard-grid lower-grid">
                <article class="student-panel">
                    <div class="student-panel-heading"><div><p>PERKEMBANGAN AKADEMIK</p><h3>Nilai terbaru</h3></div><span class="score-average">Rata-rata: 89</span></div>
                    <ul class="grade-list"><li><span>Matematika</span><span class="grade-bar"><i style="width:88%"></i></span><strong>88</strong></li><li><span>Bahasa Indonesia</span><span class="grade-bar"><i style="width:92%"></i></span><strong>92</strong></li><li><span>Al-Qur'an Hadits</span><span class="grade-bar"><i style="width:95%"></i></span><strong>95</strong></li><li><span>IPA</span><span class="grade-bar"><i style="width:85%"></i></span><strong>85</strong></li></ul>
                </article>

                <article class="student-panel">
                    <div class="student-panel-heading"><div><p>INFORMASI SEKOLAH</p><h3>Pengumuman terbaru</h3></div><a href="/sk/ps">Lihat semua</a></div>
                    <ul class="student-announcement-list">
                        <li><span class="announcement-icon gold"><i class="fa-solid fa-file-pen"></i></span><div><strong>Pembagian Rapor Tengah Semester</strong><p>Rapor dibagikan melalui wali kelas masing-masing.</p></div><time>02 Agu</time></li>
                        <li><span class="announcement-icon emerald"><i class="fa-solid fa-calendar-days"></i></span><div><strong>Penilaian Tengah Semester</strong><p>Persiapkan diri untuk asesmen pada 12 Agustus.</p></div><time>01 Agu</time></li>
                        <li><span class="announcement-icon blue"><i class="fa-solid fa-flag"></i></span><div><strong>Libur Nasional &amp; Cuti Bersama</strong><p>Kegiatan belajar mengikuti kalender pendidikan.</p></div><time>29 Jul</time></li>
                    </ul>
                </article>
            </section>
        </main>
    </div>
    <script>function closeToast(){document.getElementById('errorToast')?.remove();}window.setTimeout(closeToast,5000);</script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Siswa - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/profilSiswa.css') }}?v={{ time() }}">
</head>
<body>
    <div class="dashboard-container student-profile-page">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar :name="$data_siswa->nama" position="Siswa" initials="SW" title="Profil Siswa" description="Tinjau informasi akademik dan data pribadi Anda." />

            @if(session('eror'))
                <div class="profile-alert" id="errorToast"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('eror') }}</span><button type="button" onclick="closeToast()" aria-label="Tutup pesan">&times;</button></div>
            @endif

            <section class="profile-hero">
                <img class="profile-photo" src="{{ route('file.show', $data_siswa->url_foto) }}" alt="Foto {{ $data_siswa->nama }}">
                <div class="profile-hero-info"><p>PROFIL AKADEMIK SISWA</p><h2>{{ $data_siswa->nama }}</h2><span><i class="fa-solid fa-id-card"></i> NIS: {{ $data_siswa->nis }}</span><span><i class="fa-solid fa-school"></i> {{ $data_kelas->nama_ruang }}</span></div>
                <span class="profile-active"><i class="fa-solid fa-circle-check"></i> Siswa aktif</span>
            </section>

            <section class="profile-status-grid" aria-label="Status profil">
                <article><span class="profile-status-icon emerald"><i class="fa-solid fa-school"></i></span><div><small>Kelas aktif</small><strong>{{ $data_kelas->nama_ruang }}</strong></div></article>
                <article><span class="profile-status-icon gold"><i class="fa-solid fa-calendar-check"></i></span><div><small>Tahun ajaran</small><strong>2026/2027</strong></div></article>
                <article><span class="profile-status-icon blue"><i class="fa-solid fa-user-check"></i></span><div><small>Status data</small><strong>Terverifikasi</strong></div></article>
            </section>

            <section class="profile-grid">
                <article class="profile-card personal-card">
                    <div class="profile-card-heading"><span class="heading-icon emerald"><i class="fa-solid fa-id-card"></i></span><div><p>IDENTITAS</p><h3>Data pribadi</h3></div></div>
                    <dl class="profile-details"><div><dt>NIS / NISN</dt><dd>{{ $data_siswa->nis }}</dd></div><div><dt>Jenis kelamin</dt><dd>{{ $data_siswa->jenis_kelamin ?? 'Belum tersedia' }}</dd></div><div><dt>Tempat, tanggal lahir</dt><dd>{{ ($data_siswa->tempat_lahir ?? 'Belum tersedia') }}{{ !empty($data_siswa->tanggal_lahir) ? ', ' . \Carbon\Carbon::parse($data_siswa->tanggal_lahir)->translatedFormat('d F Y') : '' }}</dd></div><div><dt>Agama</dt><dd>{{ $data_siswa->agama ?? 'Islam' }}</dd></div><div class="wide"><dt>Alamat</dt><dd>{{ $data_siswa->alamat ?? 'Belum tersedia' }}</dd></div></dl>
                </article>

                <article class="profile-card academic-card">
                    <div class="profile-card-heading"><span class="heading-icon gold"><i class="fa-solid fa-graduation-cap"></i></span><div><p>AKADEMIK</p><h3>Data sekolah</h3></div></div>
                    <dl class="profile-details single"><div><dt>Kelas</dt><dd>{{ $data_kelas->nama_ruang }}</dd></div><div><dt>Tahun ajaran</dt><dd>2026/2027 · Semester Ganjil</dd></div><div><dt>Wali kelas</dt><dd>Ustadzah Fitri</dd></div><div><dt>Status siswa</dt><dd><span class="inline-active"><i class="fa-solid fa-circle"></i> Aktif</span></dd></div></dl>
                </article>
            </section>

            <section class="profile-card account-card">
                <div class="profile-card-heading"><span class="heading-icon blue"><i class="fa-solid fa-shield-halved"></i></span><div><p>KEAMANAN AKUN</p><h3>Informasi akses</h3></div></div>
                <div class="account-note"><i class="fa-solid fa-lock"></i><div><strong>Data akun Anda terlindungi</strong><p>Untuk memperbarui data pribadi, foto, atau kata sandi, silakan hubungi administrasi sekolah.</p></div></div>
            </section>
        </main>
    </div>
    <script>function closeToast(){document.getElementById('errorToast')?.remove();}window.setTimeout(closeToast,5000);</script>
</body>
</html>

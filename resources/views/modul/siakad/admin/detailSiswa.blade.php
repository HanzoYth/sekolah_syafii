<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Siswa - SIAKAD</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/detailsiswa.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>
    @php
        $isPerempuan = ($data_siswa->gender ?? '') === 'p';
        $isAktif = !isset($data_siswa->aktif) || (int) $data_siswa->aktif === 1;
        $namaKelas = $data_kelas->nama_ruang ?? 'Belum ditempatkan';
        $tanggalLahir = !empty($data_siswa->tanggal_lahir)
            ? \Carbon\Carbon::parse($data_siswa->tanggal_lahir)->locale('id')->translatedFormat('d F Y')
            : 'Belum tersedia';
    @endphp

    <div class="dashboard-container student-detail-page">
        <x-sidebar_siakad />

        <main class="main-content">
            <x-siakad.topbar
                title="Detail Siswa"
                description="Tinjau informasi profil dan akademik siswa."
                position="Administrator SIAKAD"
                initials="AD"
            />

            <div class="student-detail-content">
                <section class="detail-heading" aria-labelledby="page-title">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-user-graduate"></i> Manajemen Akademik</span>
                        <h1 id="page-title">Profil Siswa</h1>
                        <p>Informasi terdaftar untuk siswa pada sistem akademik.</p>
                    </div>
                    <a href="{{ url()->previous() }}" class="back-link"><i class="fa-solid fa-arrow-left"></i> Kembali ke daftar</a>
                </section>

                <section class="profile-hero" aria-label="Ringkasan siswa">
                    <div class="profile-photo-wrap">
                        @if (!empty($data_siswa->url_foto))
                            <img src="{{ route('file.show', $data_siswa->url_foto) }}" alt="Foto {{ $data_siswa->nama }}" class="profile-photo">
                        @else
                            <span class="profile-photo photo-fallback"><i class="fa-solid fa-user"></i></span>
                        @endif
                    </div>
                    <div class="profile-hero-main">
                        <span class="profile-label">SISWA TERDAFTAR</span>
                        <h2>{{ $data_siswa->nama }}</h2>
                        <p><i class="fa-solid fa-id-card"></i> NIS: {{ $data_siswa->nis }}</p>
                        <div class="profile-tags">
                            <span class="tag class-tag"><i class="fa-solid fa-school"></i> {{ $namaKelas }}</span>
                            <span class="tag {{ $isAktif ? 'active-tag' : 'inactive-tag' }}"><i class="fa-solid {{ $isAktif ? 'fa-circle-check' : 'fa-circle-pause' }}"></i> {{ $isAktif ? 'Siswa aktif' : 'Siswa nonaktif' }}</span>
                        </div>
                    </div>
                    <div class="profile-hero-side">
                        <span>Jenis kelamin</span>
                        <strong><i class="fa-solid {{ $isPerempuan ? 'fa-venus' : 'fa-mars' }}"></i> {{ $isPerempuan ? 'Perempuan' : 'Laki-laki' }}</strong>
                    </div>
                </section>

                <div class="detail-layout">
                    <section class="detail-card" aria-labelledby="personal-title">
                        <div class="card-heading">
                            <span class="card-icon"><i class="fa-solid fa-id-card"></i></span>
                            <div><h2 id="personal-title">Informasi Pribadi</h2><p>Data identitas dasar siswa.</p></div>
                        </div>
                        <dl class="info-list">
                            <div><dt>NIS</dt><dd>{{ $data_siswa->nis }}</dd></div>
                            <div><dt>Jenis kelamin</dt><dd>{{ $isPerempuan ? 'Perempuan' : 'Laki-laki' }}</dd></div>
                            <div><dt>Tempat lahir</dt><dd>{{ $data_siswa->tempat_lahir ?: 'Belum tersedia' }}</dd></div>
                            <div><dt>Tanggal lahir</dt><dd>{{ $tanggalLahir }}</dd></div>
                            <div class="wide"><dt>Alamat</dt><dd>{{ $data_siswa->alamat ?: 'Belum tersedia' }}</dd></div>
                        </dl>
                    </section>

                    <aside class="detail-card academic-card" aria-labelledby="academic-title">
                        <div class="card-heading">
                            <span class="card-icon"><i class="fa-solid fa-school"></i></span>
                            <div><h2 id="academic-title">Status Akademik</h2><p>Penempatan siswa saat ini.</p></div>
                        </div>
                        <dl class="academic-list">
                            <div><dt>Kelas</dt><dd>{{ $namaKelas }}</dd></div>
                            <div><dt>Status siswa</dt><dd><span class="inline-status {{ $isAktif ? 'active' : 'inactive' }}"><i class="fa-solid fa-circle"></i> {{ $isAktif ? 'Aktif' : 'Nonaktif' }}</span></dd></div>
                            <div><dt>ID data siswa</dt><dd>#{{ $data_siswa->id }}</dd></div>
                        </dl>
                    </aside>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

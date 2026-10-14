<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <title>Sekolah Islam Al-Qur'an Imam Syafi'i</title>
    <meta name="description" content="Pendidikan Al-Qur'an terpadu dengan metode modern untuk mencetak generasi rabbani berakhlak Al-Qur'an.">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Leaflet CSS (baru, untuk peta) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v={{ time() }}">
</head>
<body>

    <!--
        CATATAN:
        Section yang diberi atribut "hidden" hanya DISEMBUNYIKAN sementara (kodenya tetap ada).
        Untuk menampilkannya lagi, cukup hapus kata  hidden  dari tag <section> / <footer> tersebut.
        CSS (welcome.css) tidak diubah sama sekali.
    -->

    <!-- ======== NAVBAR (TIDAK DIUBAH) ======== -->
    <nav class="navbar" id="navbar" aria-label="Navigasi utama">
        <div class="container navbar-container">
            <a href="#home" class="logo">
                <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah">
                <span>Sekolah Qur'an Imam Syafi'i</span>
            </a>

            <button class="menu-toggle" id="mobile-menu" type="button"
                aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="nav-menu-wrapper">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </button>

            <div class="nav-menu-wrapper" id="nav-menu-wrapper">
                <ul class="nav-links">
                    <li><a href="#home">Beranda</a></li>

                    <li class="has-dropdown">
                        <a href="/prof">Profil Sekolah <i class="fa-solid" aria-hidden="true"></i></a>
                    </li>

                    <li class="has-dropdown">
                        <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            Akademik <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#program">Jenjang Pendidikan</a></li>
                            <li><a href="#program">Kurikulum</a></li>
                            <li><a href="#program">Sistem Pembelajaran</a></li>
                            <li><a href="#berita">Kalender Akademik</a></li>
                            <li><a href="#ppdb">Informasi Tahun Ajaran</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            Program <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#program">Program Tahfiz Al-Qur'an</a></li>
                            <li><a href="#program">Program Tahsin</a></li>
                            <li><a href="#program">Pendidikan Karakter dan Adab</a></li>
                            <li><a href="#program">Ekstrakurikuler</a></li>
                            <li><a href="#program">Kegiatan Keagamaan</a></li>
                            <li><a href="#program">Kegiatan Sosial dan Edukasi</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            Galeri <i class="fa-solid " aria-hidden="true"></i>
                        </button>
                    </li>

                    <li class="has-dropdown">
                        <button type="button" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                            Informasi <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#berita">Berita Sekolah</a></li>
                            <li><a href="#berita">Pengumuman</a></li>
                            <li><a href="#berita">Agenda Kegiatan</a></li>
                        </ul>
                    </li>

                    <li><a href="#prestasi">Prestasi</a></li>
                    <li><a href="#ppdb">PPDB</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
                <div class="auth-buttons">
                    <a class="btn-started" id="openSignup" href="/reg">Mulai</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ======== 1. HERO (TAMPIL) ======== -->
    <section id="home" class="hero" style="--hero-bg: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');">
        <div class="container">
            <div class="hero-wrapper">
                <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                    <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <div class="hero-name">Sekolah Islam Al-Qur'an Imam Syafi'i</div>
                    <h1>Mencetak Generasi Rabbani Berakhlak <span class="highlight">Al-Qur'an</span></h1>
                    <p>Pendidikan Al-Qur'an terpadu dengan metode modern untuk mendidik generasi yang mencintai dan mengamalkan Al-Qur'an sesuai pemahaman salafus shalih.</p>
                    <div class="hero-btns">
                        <a href="#profil" class="btn-primary">Profil Sekolah</a>
                        <a href="#ppdb" class="btn-secondary">Informasi PPDB</a>
                    </div>
                </div>
                <div class="hero-image" data-aos="fade-left" data-aos-duration="1000">
                    <img src="{{ asset('img/ft_1.jpeg') }}?v={{ time() }}" alt="Kegiatan belajar di Sekolah Al-Qur'an Imam Syafi'i">
                </div>
            </div>
        </div>
        <div class="hero-overlay"></div>
    </section>

    <!-- ======== 2. SAMBUTAN KEPALA SEKOLAH (DISEMBUNYIKAN) ======== -->
    <section id="sambutan" class="section" hidden>
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Sambutan Kepala Sekolah</h2>
            <div class="sambutan-wrapper" data-aos="fade-up">
                <div class="sambutan-foto thumb">
                    <!-- ISI: ganti dengan foto kepala sekolah, contoh:
                         <img src="{{ asset('img/kepsek.jpg') }}" alt="Foto Kepala Sekolah" loading="lazy"> -->
                    <i class="fa-solid fa-user-tie thumb-icon" aria-hidden="true"></i>
                </div>
                <div class="sambutan-isi">
                    <!-- ISI: sambutan singkat kepala sekolah -->
                    <p class="ph">Sambutan singkat Kepala Sekolah akan ditampilkan di sini.</p>
                    <div class="sambutan-nama">
                        <!-- ISI: nama dan jabatan -->
                        <strong class="ph">Nama Kepala Sekolah</strong>
                        <span>Kepala Sekolah</span>
                    </div>
                    <a href="#sambutan" class="btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 3. PROFIL SINGKAT (+ KEUNGGULAN) (TAMPIL) ======== -->
    <section id="profil" class="section alt">
        <div class="container">
            <div class="keunggulan-wrapper">
                <div class="keunggulan-img" data-aos="fade-right">
                    <img src="{{ asset('img/ft_2.jpeg') }}?v={{ time() }}" alt="Santri sedang mengaji" loading="lazy">
                </div>
                <div class="keunggulan-content" data-aos="fade-left">
                    <h2 class="section-title left">Profil Singkat Sekolah</h2>
                    <!-- ISI: deskripsi sekolah -->
                    <p class="lead-text ph">Deskripsi singkat sekolah akan ditampilkan di sini.</p>

                    <div class="visi-misi">
                        <h3>Visi</h3>
                        <!-- ISI: visi sekolah -->
                        <p class="ph">Visi sekolah akan ditampilkan di sini.</p>
                        <h3>Misi</h3>
                        <!-- ISI: misi sekolah (satu <li> per poin) -->
                        <ul class="misi-list">
                            <li class="ph">Poin misi sekolah akan ditampilkan di sini.</li>
                        </ul>
                    </div>

                    <ul class="check-list">
                        <li><i class="fa-solid fa-check-circle"></i> Pengajar Bersanad & Kompeten</li>
                        <li><i class="fa-solid fa-check-circle"></i> Metode Pembelajaran Modern & Efektif</li>
                        <li><i class="fa-solid fa-check-circle"></i> Lingkungan Islami & Kondusif</li>
                        <li><i class="fa-solid fa-check-circle"></i> Fasilitas Lengkap & Nyaman</li>
                    </ul>
                    <a href="#profil" class="btn-primary">Profil Lengkap</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 4. STATISTIK (DISEMBUNYIKAN) ======== -->
    <!-- ISI: ganti tanda "—" dengan angka resmi. Jangan isi angka perkiraan. -->
    <section id="statistik" class="statistik" aria-label="Statistik sekolah" hidden>
        <div class="container">
            <div class="stat-grid">
                <div class="stat-card" data-aos="zoom-in">
                    <i class="fa-solid fa-user-graduate" aria-hidden="true"></i>
                    <strong>—</strong><span>Peserta Didik</span>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="80">
                    <i class="fa-solid fa-chalkboard-user" aria-hidden="true"></i>
                    <strong>—</strong><span>Guru</span>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="160">
                    <i class="fa-solid fa-book-quran" aria-hidden="true"></i>
                    <strong>—</strong><span>Program Pendidikan</span>
                </div>
                <div class="stat-card" data-aos="zoom-in" data-aos-delay="240">
                    <i class="fa-solid fa-trophy" aria-hidden="true"></i>
                    <strong>—</strong><span>Prestasi</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 5. PROGRAM UNGGULAN (TAMPIL) ======== -->
    <section id="program" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Program Unggulan</h2>
            <div class="program-grid">
                <div class="program-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fa-solid fa-book-open-reader icon-card" aria-hidden="true"></i>
                    <h3>Tahfizhul Qur'an</h3>
                    <p>Program menghafal Al-Qur'an 30 juz dengan target mutqin dan tajwid yang benar.</p>
                    <a href="#program" class="card-link">Lihat detail <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="program-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fa-solid fa-graduation-cap icon-card" aria-hidden="true"></i>
                    <h3>Madrasah Diniyah</h3>
                    <p>Pembelajaran ilmu syar'i dasar (Aqidah, Fiqih, Adab) sesuai pemahaman Imam Syafi'i.</p>
                    <a href="#program" class="card-link">Lihat detail <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="program-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fa-solid fa-language icon-card" aria-hidden="true"></i>
                    <h3>Bahasa Arab</h3>
                    <p>Kuasai bahasa Al-Qur'an aktif dan pasif untuk memahami wahyu lebih dalam.</p>
                    <a href="#program" class="card-link">Lihat detail <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 6. GALERI KEGIATAN TERBARU (DISEMBUNYIKAN) ======== -->
    <!-- ISI: ganti src/judul/tanggal/kategori sesuai foto asli. Salin satu <figure> untuk menambah foto. -->
    <section id="galeri" class="section alt" hidden>
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Galeri Kegiatan Terbaru</h2>
            <div class="galeri-grid">
                <figure class="galeri-item" data-aos="fade-up">
                    <button type="button" class="galeri-btn thumb" data-lightbox
                        data-full="{{ asset('img/ft_1.jpeg') }}" data-caption="Judul kegiatan" aria-label="Perbesar foto kegiatan">
                        <img src="{{ asset('img/ft_1.jpeg') }}" alt="Foto kegiatan sekolah" loading="lazy">
                    </button>
                    <figcaption>
                        <span class="badge">Kategori</span>
                        <h3>Judul kegiatan</h3>
                        <time class="ph">Tanggal kegiatan</time>
                    </figcaption>
                </figure>
                <figure class="galeri-item" data-aos="fade-up" data-aos-delay="100">
                    <button type="button" class="galeri-btn thumb" data-lightbox
                        data-full="{{ asset('img/ft_2.jpeg') }}" data-caption="Judul kegiatan" aria-label="Perbesar foto kegiatan">
                        <img src="{{ asset('img/ft_2.jpeg') }}" alt="Foto kegiatan mengaji" loading="lazy">
                    </button>
                    <figcaption>
                        <span class="badge">Kategori</span>
                        <h3>Judul kegiatan</h3>
                        <time class="ph">Tanggal kegiatan</time>
                    </figcaption>
                </figure>
                <figure class="galeri-item" data-aos="fade-up" data-aos-delay="200">
                    <button type="button" class="galeri-btn thumb" data-lightbox
                        data-full="{{ asset('img/bg_skl.jpeg') }}" data-caption="Judul kegiatan" aria-label="Perbesar foto kegiatan">
                        <img src="{{ asset('img/bg_skl.jpeg') }}" alt="Foto lingkungan sekolah" loading="lazy">
                    </button>
                    <figcaption>
                        <span class="badge">Kategori</span>
                        <h3>Judul kegiatan</h3>
                        <time class="ph">Tanggal kegiatan</time>
                    </figcaption>
                </figure>
            </div>
            <div class="section-action">
                <a href="#galeri" class="btn-primary">Lihat Semua Galeri</a>
            </div>
        </div>
    </section>

    <!-- ======== 7. BERITA & PENGUMUMAN (DISEMBUNYIKAN) ======== -->
    <section id="berita" class="section" hidden>
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Berita dan Pengumuman</h2>
            <div class="berita-layout">
                <div class="berita-list">
                    <!-- ISI: salin <article> ini untuk setiap berita -->
                    <article class="berita-card" data-aos="fade-up">
                        <div class="berita-img thumb">
                            <i class="fa-regular fa-newspaper thumb-icon" aria-hidden="true"></i>
                        </div>
                        <div class="berita-body">
                            <time class="ph">Tanggal publikasi</time>
                            <h3>Judul berita</h3>
                            <p class="ph">Ringkasan berita akan ditampilkan di sini.</p>
                            <a class="card-link" href="#berita">Baca selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                    <article class="berita-card" data-aos="fade-up" data-aos-delay="100">
                        <div class="berita-img thumb">
                            <i class="fa-regular fa-newspaper thumb-icon" aria-hidden="true"></i>
                        </div>
                        <div class="berita-body">
                            <time class="ph">Tanggal publikasi</time>
                            <h3>Judul berita</h3>
                            <p class="ph">Ringkasan berita akan ditampilkan di sini.</p>
                            <a class="card-link" href="#berita">Baca selengkapnya <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </article>
                </div>

                <aside class="pengumuman" data-aos="fade-left">
                    <h3><i class="fa-solid fa-bullhorn" aria-hidden="true"></i> Pengumuman</h3>
                    <ul>
                        <li>
                            <time class="ph">Tanggal</time>
                            <a href="#berita">Judul pengumuman</a>
                        </li>
                        <li>
                            <time class="ph">Tanggal</time>
                            <a href="#berita">Judul pengumuman</a>
                        </li>
                    </ul>
                    <a href="#berita" class="card-link">Semua pengumuman <i class="fa-solid fa-arrow-right"></i></a>
                </aside>
            </div>
        </div>
    </section>

    <!-- ======== 8. PRESTASI (DISEMBUNYIKAN) ======== -->
    <section id="prestasi" class="section alt" hidden>
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Prestasi Sekolah</h2>
            <div class="prestasi-grid">
                <!-- ISI: salin <div class="prestasi-card"> untuk setiap prestasi asli -->
                <div class="prestasi-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="prestasi-icon"><i class="fa-solid fa-trophy" aria-hidden="true"></i></div>
                    <span class="badge">Tingkat perlombaan</span>
                    <h3>Nama prestasi</h3>
                    <p class="ph">Nama penerima · Tahun</p>
                </div>
                <div class="prestasi-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="prestasi-icon"><i class="fa-solid fa-medal" aria-hidden="true"></i></div>
                    <span class="badge">Tingkat perlombaan</span>
                    <h3>Nama prestasi</h3>
                    <p class="ph">Nama penerima · Tahun</p>
                </div>
                <div class="prestasi-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="prestasi-icon"><i class="fa-solid fa-award" aria-hidden="true"></i></div>
                    <span class="badge">Tingkat perlombaan</span>
                    <h3>Nama prestasi</h3>
                    <p class="ph">Nama penerima · Tahun</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 9. FASILITAS (DISEMBUNYIKAN) ======== -->
    <section id="fasilitas" class="section" hidden>
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Fasilitas Sekolah</h2>
            <div class="fasilitas-grid">
                <!-- ISI: ganti dengan fasilitas yang benar-benar ada; tambahkan <img> pada .thumb bila ada fotonya -->
                <div class="fasilitas-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="fasilitas-img thumb"><i class="fa-solid fa-school thumb-icon" aria-hidden="true"></i></div>
                    <h3>Nama fasilitas</h3>
                    <p class="ph">Deskripsi fasilitas.</p>
                </div>
                <div class="fasilitas-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="fasilitas-img thumb"><i class="fa-solid fa-mosque thumb-icon" aria-hidden="true"></i></div>
                    <h3>Nama fasilitas</h3>
                    <p class="ph">Deskripsi fasilitas.</p>
                </div>
                <div class="fasilitas-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="fasilitas-img thumb"><i class="fa-solid fa-book thumb-icon" aria-hidden="true"></i></div>
                    <h3>Nama fasilitas</h3>
                    <p class="ph">Deskripsi fasilitas.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 10. PPDB (DISEMBUNYIKAN) ======== -->
    <section id="ppdb" class="ppdb" hidden>
        <div class="container">
            <div class="ppdb-box" data-aos="zoom-in">
                <h2>Penerimaan Peserta Didik Baru (PPDB)</h2>
                <!-- ISI: ubah teks ini bila status/jadwal pendaftaran sudah pasti -->
                <p>Dapatkan informasi pendaftaran, persyaratan, dan jadwal terbaru langsung dari panitia sekolah.</p>
                <div class="ppdb-btns">
                    <a href="#kontak" class="btn-started">Hubungi Panitia</a>
                    <a href="/reg" class="btn-secondary">Halaman Pendaftaran</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 11. FAQ (DISEMBUNYIKAN) ======== -->
    <section id="faq" class="section alt" hidden>
        <div class="container narrow">
            <h2 class="section-title" data-aos="fade-up">Pertanyaan yang Sering Diajukan</h2>
            <div class="faq-list" data-aos="fade-up">
                <!-- ISI: tulis jawaban resmi di setiap <p> -->
                <details>
                    <summary>Bagaimana cara mendaftar?</summary>
                    <p class="ph">Jawaban akan diisi sesuai informasi resmi sekolah.</p>
                </details>
                <details>
                    <summary>Apa saja persyaratan pendaftaran?</summary>
                    <p class="ph">Jawaban akan diisi sesuai informasi resmi sekolah.</p>
                </details>
                <details>
                    <summary>Jenjang pendidikan apa yang tersedia?</summary>
                    <p class="ph">Jawaban akan diisi sesuai informasi resmi sekolah.</p>
                </details>
                <details>
                    <summary>Bagaimana cara menghubungi pihak sekolah?</summary>
                    <p class="ph">Jawaban akan diisi sesuai informasi resmi sekolah.</p>
                </details>
            </div>
        </div>
    </section>

    <!-- ======== 12. LOKASI & KONTAK (TAMPIL, PETA LEAFLET) ======== -->
    <section id="kontak" class="section">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Lokasi dan Kontak</h2>
            <div class="kontak-grid">
                <div class="kontak-info" data-aos="fade-right">
                    <!-- ISI: semua data kontak di bawah ini dengan data asli sekolah -->
                    <ul>
                        <li><i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                            <div><strong>Alamat</strong><span class="ph">Alamat sekolah</span></div></li>
                        <li><i class="fa-solid fa-phone" aria-hidden="true"></i>
                            <div><strong>Telepon</strong><span class="ph">Nomor telepon</span></div></li>
                        <li><i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                            <div><strong>WhatsApp</strong><span class="ph">Nomor WhatsApp resmi</span></div></li>
                        <li><i class="fa-solid fa-envelope" aria-hidden="true"></i>
                            <div><strong>Email</strong><span class="ph">Email resmi</span></div></li>
                        <li><i class="fa-solid fa-clock" aria-hidden="true"></i>
                            <div><strong>Jam Layanan</strong><span class="ph">Jam layanan</span></div></li>
                    </ul>
                </div>
                <div class="kontak-map" data-aos="fade-left">
                    <!-- Peta Leaflet. Style inline dipakai supaya welcome.css tidak perlu diubah.
                         z-index:0 menjaga peta tidak menimpa navbar saat discroll. -->
                    <div id="map" role="region" aria-label="Peta lokasi sekolah"
                         style="width:100%;height:100%;min-height:340px;position:relative;z-index:0;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 13. FOOTER (TAMPIL) ======== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah">
                        <span>Sekolah Al-Qur'an Imam Syafi'i</span>
                    </div>
                    <p>Pendidikan Al-Qur'an terpadu untuk mencetak generasi rabbani berakhlak Al-Qur'an.</p>
                </div>
                <div>
                    <h4>Tautan</h4>
                    <ul>
                        <li><a href="#profil">Profil Sekolah</a></li>
                        <li><a href="#program">Program</a></li>
                        <li><a href="#galeri">Galeri</a></li>
                        <li><a href="#berita">Informasi</a></li>
                        <li><a href="#ppdb">PPDB</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Kontak</h4>
                    <ul>
                        <li class="ph">Alamat sekolah</li>
                        <li class="ph">Nomor telepon / WhatsApp</li>
                        <li class="ph">Email resmi</li>
                    </ul>
                </div>
                <div>
                    <h4>Media Sosial</h4>
                    <!-- ISI: ganti href="#" dengan akun resmi; hapus ikon yang tidak dipakai -->
                    <div class="sosmed">
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="year">2026</span> Sekolah Al-Qur'an Imam Syafi'i. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ======== LIGHTBOX ======== -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto" hidden>
        <button type="button" class="lb-close" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
        <button type="button" class="lb-nav lb-prev" aria-label="Foto sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
        <figure>
            <img src="" alt="">
            <figcaption class="lb-caption"></figcaption>
        </figure>
        <button type="button" class="lb-nav lb-next" aria-label="Foto berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    <!-- ======== SCRIPTS ======== -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Leaflet JS (baru, untuk peta) -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        AOS.init({ once: true });
        document.getElementById('year').textContent = new Date().getFullYear();

        function forceViewportReflow() {
            var viewportMeta = document.querySelector('meta[name="viewport"]');
            if (viewportMeta) {
                var original = viewportMeta.getAttribute('content');
                viewportMeta.setAttribute('content', original + ', shrink-to-fit=no');
                setTimeout(function () { viewportMeta.setAttribute('content', original); }, 50);
            }
            window.scrollTo(0, 1);
            requestAnimationFrame(function () {
                window.scrollTo(0, 0);
                window.dispatchEvent(new Event('resize'));
                window.dispatchEvent(new Event('orientationchange'));
            });
        }
        forceViewportReflow();
        [0, 100, 300, 600, 1000, 2000].forEach(function (delay) { setTimeout(forceViewportReflow, delay); });
        window.addEventListener('load', forceViewportReflow);

        // ===== Navbar: hamburger + dropdown =====
        (function () {
            var NAV_BREAKPOINT = 1240; // samakan dengan @media (max-width: 1240px) di CSS
            var navbar = document.getElementById('navbar');
            var toggleBtn = document.getElementById('mobile-menu');
            if (!navbar || !toggleBtn) return;
            var dropdowns = navbar.querySelectorAll('.has-dropdown');

            function closeDropdowns(except) {
                dropdowns.forEach(function (d) {
                    if (d !== except) {
                        d.classList.remove('open');
                        d.querySelector('.dropdown-toggle').setAttribute('aria-expanded', 'false');
                    }
                });
            }
            function closeMobileNav() {
                navbar.classList.remove('mobile-nav-open');
                toggleBtn.classList.remove('active');
                toggleBtn.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('mobile-nav-locked');
                closeDropdowns();
            }
            function toggleMobileNav() {
                var isOpen = navbar.classList.toggle('mobile-nav-open');
                toggleBtn.classList.toggle('active', isOpen);
                toggleBtn.setAttribute('aria-expanded', String(isOpen));
                document.body.classList.toggle('mobile-nav-locked', isOpen);
            }

            toggleBtn.addEventListener('click', toggleMobileNav);

            dropdowns.forEach(function (d) {
                var btn = d.querySelector('.dropdown-toggle');
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    var isOpen = d.classList.toggle('open');
                    btn.setAttribute('aria-expanded', String(isOpen));
                    closeDropdowns(d);
                });
            });

            navbar.querySelectorAll('.nav-links a, .auth-buttons a').forEach(function (link) {
                link.addEventListener('click', closeMobileNav);
            });

            document.addEventListener('click', function (e) {
                if (!navbar.contains(e.target)) closeDropdowns();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeDropdowns();
            });
            window.addEventListener('resize', function () {
                if (window.innerWidth > NAV_BREAKPOINT) closeMobileNav();
            });
        })();

        // ===== Lightbox galeri =====
        (function () {
            var items = [].slice.call(document.querySelectorAll('[data-lightbox]'));
            var box = document.getElementById('lightbox');
            if (!box || !items.length) return;
            var img = box.querySelector('img');
            var cap = box.querySelector('.lb-caption');
            var idx = 0;

            function show(i) {
                idx = (i + items.length) % items.length;
                img.src = items[idx].getAttribute('data-full');
                img.alt = items[idx].getAttribute('data-caption') || '';
                cap.textContent = items[idx].getAttribute('data-caption') || '';
            }
            function open(i) {
                show(i);
                box.hidden = false;
                document.body.classList.add('mobile-nav-locked');
                box.querySelector('.lb-close').focus();
            }
            function close() {
                box.hidden = true;
                img.src = '';
                document.body.classList.remove('mobile-nav-locked');
            }

            items.forEach(function (el, i) { el.addEventListener('click', function () { open(i); }); });
            box.querySelector('.lb-close').addEventListener('click', close);
            box.querySelector('.lb-prev').addEventListener('click', function () { show(idx - 1); });
            box.querySelector('.lb-next').addEventListener('click', function () { show(idx + 1); });
            box.addEventListener('click', function (e) { if (e.target === box) close(); });
            document.addEventListener('keydown', function (e) {
                if (box.hidden) return;
                if (e.key === 'Escape') close();
                if (e.key === 'ArrowLeft') show(idx - 1);
                if (e.key === 'ArrowRight') show(idx + 1);
            });
        })();

        // ===== Peta Leaflet (OpenStreetMap) =====
        (function () {
            var el = document.getElementById('map');
            if (!el || typeof L === 'undefined') return;

            // GANTI dengan koordinat asli sekolah
            // (Google Maps: klik kanan lokasi -> klik angka koordinat untuk menyalin)
            var LAT = -0.9267058875927435;
            var LNG = 119.87149370241973;
            var NAMA = "Sekolah Al-Qur'an Imam Syafi'i";

            var map = L.map(el, { scrollWheelZoom: false }).setView([LAT, LNG], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>'
            }).addTo(map);

            L.marker([LAT, LNG]).addTo(map)
                .bindPopup('<strong>' + NAMA + '</strong><br><a href="https://www.google.com/maps?q=' + LAT + ',' + LNG + '" target="_blank" rel="noopener">Buka di Google Maps</a>')
                .openPopup();

            // Scroll-zoom aktif hanya setelah peta diklik, supaya scroll halaman tidak tersangkut
            map.on('click', function () { map.scrollWheelZoom.enable(); });
            map.on('mouseout', function () { map.scrollWheelZoom.disable(); });

            // Ukuran peta dihitung ulang setelah animasi AOS / reflow selesai
            [300, 1200, 2500].forEach(function (d) { setTimeout(function () { map.invalidateSize(); }, d); });
            window.addEventListener('load', function () { map.invalidateSize(); });
            window.addEventListener('resize', function () { map.invalidateSize(); });
        })();
    </script>
</body>
</html>
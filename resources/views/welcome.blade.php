<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title>Sekolah Islam Al-Qur'an Imam Syafi'i</title>
    <meta name="description" content="Pendidikan Al-Qur'an terpadu dengan metode modern untuk mencetak generasi rabbani berakhlak Al-Qur'an sesuai pemahaman salafus shalih.">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- PWA & Mobile Web App Meta Tags -->
    <meta name="theme-color" content="#0b2e1b">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Sekolah Syafi'i">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo_sklh.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v={{ time() }}">
</head>
<body>

    <!-- Indikator Progress Scroll di Atas Layar -->
    <div class="scroll-progress-bar" id="scrollProgressBar" aria-hidden="true"></div>

    <!-- ======== NAVBAR (6 MENU RAMPING & FUNGSIONAL) ======== -->
    <nav class="navbar" id="navbar" aria-label="Navigasi utama">
        <div class="container">
            <a href="#home" class="logo">
                <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah Islam Al-Qur'an Imam Syafi'i">
                <div>
                    <span>Sekolah Qur'an Imam Syafi'i</span>
                    <small class="logo-sub">Pendidikan Islam & Tahfizhul Qur'an</small>
                </div>
            </a>

            <button class="menu-toggle" id="mobile-menu" type="button"
                aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="nav-menu-wrapper">
                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
            </button>

            <div class="nav-menu-wrapper" id="nav-menu-wrapper">
                <ul class="nav-links">
                    <li><a href="/" class="nav-spy active" data-section="#home">Beranda</a></li>
                    <li><a href="/prof?halaman=profil" class="nav-spy" data-section="#profil">Profil</a></li>
                    <li><a href="/prof?halaman=program" class="nav-spy" data-section="#program">Pendidikan & Program</a></li>
                    <li><a href="/prof?halaman=galeri" class="nav-spy" data-section="#galeri">Galeri & Kegiatan</a></li>
                    <li><a href="/prof?halaman=ppdb" class="nav-spy" data-section="#ppdb">PPDB</a></li>
                    <li><a href="/prof?halaman=kontak" class="nav-spy" data-section="#kontak">Kontak</a></li>
                </ul>
                <div class="auth-buttons">
                    <a class="btn-started" id="openSignup" href="/reg">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ======== 1. HERO SECTION (MULTI-LAYER 3D PARALLAX) ======== -->
    <section id="home" class="hero parallax-section" style="--hero-bg: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');">
        <!-- Layer 1: Background Image Parallax (bergerak lambat saat scroll) -->
        <div class="hero-bg-parallax" data-parallax-hero="0.38"></div>

        <!-- Layer 2: Vignette & Drifting Islamic Star Pattern -->
        <div class="hero-overlay" id="heroParticles"></div>
        <div class="hero-pattern-parallax" data-parallax-hero="0.22" data-mouse-speed="14"></div>

        <!-- Layer 3 & 4: Konten Utama & Mihrab Showcase -->
        <div class="container">
            <div class="hero-wrapper">
                <!-- Kolom Kiri: Teks Utama -->
                <div class="hero-content" data-parallax-hero="-0.08" data-aos="fade-right">
                    <div class="hero-badge-top">
                        <i class="fa-solid fa-mosque"></i>
                        <span>Yayasan Pendidikan Islam & Tahfizhul Qur'an</span>
                    </div>
                    <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <h1>Mencetak Generasi Rabbani Berakhlak <span class="highlight">Al-Qur'an</span></h1>
                    <p class="hero-desc">
                        Pendidikan Islam terpadu yang memadukan kurikulum Tahfizhul Qur'an, ilmu syar'i sesuai pemahaman salafus shalih, serta ilmu pengetahuan umum dengan sistem akademik modern.
                    </p>
                    <div class="hero-btns">
                        <a href="/reg" class="btn-started">
                            <i class="fa-solid fa-right-to-bracket"></i> Login Sistem
                        </a>
                        <button type="button" class="btn-secondary" data-trigger-pwa-install style="cursor: pointer;">
                            <i class="fa-solid fa-mobile-screen-button"></i> Install Aplikasi
                        </button>
                        <a href="#ppdb" class="btn-secondary">
                            <i class="fa-solid fa-user-plus"></i> Info PPDB
                        </a>
                    </div>

                    <!-- Ringkasan Keunggulan Singkat -->
                    <div class="hero-value-strip">
                        <div class="hero-mini-stat">
                            <i class="fa-solid fa-book-quran"></i>
                            <div>
                                <strong>Tahfizh Mutqin</strong>
                                <span>Bersanad & Bertajwid</span>
                            </div>
                        </div>
                        <div class="hero-mini-stat">
                            <i class="fa-solid fa-heart"></i>
                            <div>
                                <strong>Beradab & Berilmu</strong>
                                <span>Manhaj Imam Syafi'i</span>
                            </div>
                        </div>
                        <div class="hero-mini-stat">
                            <i class="fa-solid fa-laptop-code"></i>
                            <div>
                                <strong>SIAKAD Terpadu</strong>
                                <span>Pantau Nilai & Absensi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Multi-Layer Parallax Arch Stage -->
                <div class="hero-stage" data-aos="fade-left">
                    <div class="hero-glow-orb"></div>
                    <div class="hero-ring-backdrop" data-mouse-speed="-22"></div>

                    <!-- Bingkai Utama Mihrab -->
                    <div class="hero-arch-main" data-parallax-hero="-0.18" data-mouse-speed="16">
                        <img src="{{ asset('img/ft_1.jpeg') }}?v={{ time() }}" alt="Kegiatan belajar santri Sekolah Al-Qur'an Imam Syafi'i" data-parallax-hero="0.14">
                    </div>

                    <!-- Bingkai Kedua (Floating Frame bergerak dengan kecepatan berbeda) -->
                    <div class="hero-arch-secondary" data-parallax-hero="-0.34" data-mouse-speed="-26">
                        <img src="{{ asset('img/foto_1.jpeg') }}?v={{ time() }}" alt="Suasana halaqah Al-Qur'an">
                    </div>

                    <!-- Floating Glass Badges -->
                    <div class="floating-badge badge-top-right" data-parallax-hero="-0.28" data-mouse-speed="28">
                        <i class="fa-solid fa-book-open-reader"></i>
                        <div>
                            <strong>Tahfizhul Qur'an</strong>
                            <span>Program Unggulan 30 Juz</span>
                        </div>
                    </div>

                    <div class="floating-badge badge-bottom-right" data-parallax-hero="-0.14" data-mouse-speed="-18">
                        <i class="fa-solid fa-award"></i>
                        <div>
                            <strong>Kurikulum Terpadu</strong>
                            <span>Diniyah & Akademik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ornamental Curve Divider -->
        <div class="hero-wave-divider">
            <svg viewBox="0 0 1440 80" preserveAspectRatio="none" fill="#ffffff">
                <path d="M0,32 C320,90 560,0 720,42 C880,84 1120,10 1440,36 L1440,80 L0,80 Z"></path>
            </svg>
        </div>
    </section>

    <!-- ======== 2. PROFIL, VISI-MISI & FASILITAS (TERPADU) ======== -->
    <section id="profil" class="section alt parallax-section">
        <!-- Ornamen Cincin Bintang Parallax di Latar -->
        <div class="parallax-ring spin" style="left: -200px; top: 40px;" data-parallax-speed="0.18"></div>

        <div class="container">
            <div class="profil-grid">
                <!-- Tumpukan 2 Foto Parallax yang Bergerak Berbeda Kecepatan Saat Scroll -->
                <div class="profil-visual-stack" data-aos="fade-right">
                    <div class="profil-exp-badge" data-parallax-speed="-0.16">
                        <strong>100%</strong>
                        <span>Pendidikan Berbasis<br>Al-Qur'an & Sunnah</span>
                    </div>

                    <div class="profil-main-frame" data-parallax-speed="0.06">
                        <img src="{{ asset('img/ft_2.jpeg') }}?v={{ time() }}" alt="Santri sedang menghafal Al-Qur'an" loading="lazy" data-parallax-img="0.16">
                    </div>

                    <div class="profil-sub-frame" data-parallax-speed="-0.18">
                        <img src="{{ asset('img/foto_2.jpeg') }}?v={{ time() }}" alt="Kegiatan pembelajaran di kelas" loading="lazy">
                    </div>
                </div>

                <!-- Konten Profil, Visi & Misi -->
                <div class="profil-content" data-aos="fade-left">
                    <span class="section-eyebrow"><i class="fa-solid fa-kaaba"></i> Tentang Kami</span>
                    <h2 class="section-title left">Membangun Fondasi Iman, Ilmu & Akhlak Mulia</h2>
                    <p class="lead-text">
                        <strong>Sekolah Islam Al-Qur'an Imam Syafi'i</strong> hadir sebagai lembaga pendidikan Islam yang berkomitmen membimbing peserta didik agar mencintai Al-Qur'an, memahami pokok-pokok agama sesuai manhaj Ahlussunnah wal Jama'ah, serta unggul dalam prestasi akademik.
                    </p>

                    <div class="visi-misi-cards">
                        <div class="vm-card">
                            <h3><i class="fa-solid fa-eye"></i> Visi Sekolah</h3>
                            <p>Terwujudnya generasi Rabbani yang hafizh Al-Qur'an, berakidah lurus, berakhlak mulia, dan unggul dalam ilmu pengetahuan sesuai pemahaman salafus shalih.</p>
                        </div>
                        <div class="vm-card">
                            <h3><i class="fa-solid fa-bullseye"></i> Misi Utama</h3>
                            <ul>
                                <li><i class="fa-solid fa-check"></i> Menyelenggarakan pembelajaran Tahsin & Tahfizh Al-Qur'an bersanad.</li>
                                <li><i class="fa-solid fa-check"></i> Menanamkan adab Islami dan ibadah harian sejak usia dini.</li>
                                <li><i class="fa-solid fa-check"></i> Mengembangkan potensi akademik & bahasa Arab secara terpadu.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="check-grid">
                        <div class="check-item"><i class="fa-solid fa-certificate"></i> Pengajar Bersanad & Kompeten</div>
                        <div class="check-item"><i class="fa-solid fa-book-open"></i> Kurikulum Diniyah & Nasional</div>
                        <div class="check-item"><i class="fa-solid fa-shield-heart"></i> Lingkungan Islami & Kondusif</div>
                        <div class="check-item"><i class="fa-solid fa-mobile-screen-button"></i> Sistem SIAKAD Terintegrasi</div>
                    </div>
                </div>
            </div>

            <!-- Sub-Section Fasilitas Sekolah (Digabung ke Profil agar ringkas & utuh) -->
            <div class="fasilitas-subblock" data-aos="fade-up">
                <div class="fasilitas-subhead">
                    <div>
                        <span class="section-eyebrow"><i class="fa-solid fa-building-columns"></i> Sarana & Prasarana</span>
                        <h3>Fasilitas Penunjang Pembelajaran</h3>
                    </div>
                    <p class="section-subtitle">Dirancang untuk menciptakan suasana belajar dan menghafal Al-Qur'an yang tenang, aman, dan nyaman.</p>
                </div>

                <div class="fasilitas-grid">
                    <div class="fasilitas-card" data-parallax-speed="-0.04">
                        <div class="fasilitas-icon"><i class="fa-solid fa-mosque"></i></div>
                        <h4>Mushalla & Area Halaqah</h4>
                        <p>Pusat kegiatan sholat berjamaah, setoran hafalan Al-Qur'an (halaqah), dan pembinaan dzikir harian.</p>
                    </div>
                    <div class="fasilitas-card" data-parallax-speed="0.04">
                        <div class="fasilitas-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                        <h4>Ruang Kelas Kondusif</h4>
                        <p>Ruang belajar bersih, sirkulasi udara baik, dan rasio siswa terukur agar pendampingan guru lebih fokus.</p>
                    </div>
                    <div class="fasilitas-card" data-parallax-speed="-0.04">
                        <div class="fasilitas-icon"><i class="fa-solid fa-book"></i></div>
                        <h4>Perpustakaan & Literasi</h4>
                        <p>Koleksi mushaf, kitab turats, buku kisah teladan Nabi & sahabat, serta ensiklopedia ilmu pengetahuan.</p>
                    </div>
                    <div class="fasilitas-card" data-parallax-speed="0.04">
                        <div class="fasilitas-icon"><i class="fa-solid fa-futbol"></i></div>
                        <h4>Area Bermain & Olahraga</h4>
                        <p>Sarana aktivitas fisik, olahraga sunnah, dan kegiatan ekstrakurikuler yang mendukung tumbuh kembang santri.</p>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 34px;" data-aos="fade-up">
                    <a href="/prof?halaman=profil" class="btn-started">
                        <i class="fa-solid fa-compass"></i> Buka Halaman Profil & Nilai Inti Lengkap &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== PARALLAX BANNER: HADITS & SOROTAN ANGKA ======== -->
    <section class="parallax-banner parallax-section" aria-label="Kutipan dan Statistik Sekolah">
        <div class="parallax-bg-wrap">
            <div class="parallax-bg-layer" style="background-image: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');" data-parallax-bg="0.34"></div>
        </div>
        <div class="parallax-ornament-layer" data-parallax-speed="0.16"></div>
        <div class="parallax-banner-overlay"></div>

        <div class="container">
            <div class="quote-box" data-aos="zoom-in">
                <p class="quote-arabic">« خَيْرُكُمْ مَنْ تَعَلَّمَ الْقُرْآنَ وَعَلَّمَهُ »</p>
                <p class="quote-translation">"Sebaik-baik kalian adalah orang yang mempelajari Al-Qur'an dan mengajarkannya." (HR. Bukhari)</p>
            </div>

            <div class="stat-grid" id="statCounterSection">
                <div class="stat-card" data-aos="fade-up">
                    <i class="fa-solid fa-layer-group"></i>
                    <strong><span class="counter-num" data-target="3">3</span> Jenjang</strong>
                    <span>TK / PAUD, SD & SMP</span>
                </div>
                <div class="stat-card" data-aos="fade-up" data-aos-delay="80">
                    <i class="fa-solid fa-book-quran"></i>
                    <strong><span class="counter-num" data-target="30">30</span> Juz</strong>
                    <span>Kurikulum Tahfizh Bertahap</span>
                </div>
                <div class="stat-card" data-aos="fade-up" data-aos-delay="160">
                    <i class="fa-solid fa-user-check"></i>
                    <strong><span class="counter-num" data-target="100">100</span>%</strong>
                    <span>Pembinaan Adab & Ibadah</span>
                </div>
                <div class="stat-card" data-aos="fade-up" data-aos-delay="240">
                    <i class="fa-solid fa-chart-line"></i>
                    <strong><span class="counter-num" data-target="24">24</span>/7</strong>
                    <span>Akses SIAKAD & Monitoring</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 3. PENDIDIKAN & PROGRAM UNGGULAN (GABUNGAN AKADEMIK + PROGRAM) ======== -->
    <section id="program" class="section parallax-section">
        <div class="parallax-bg-wrap">
            <div class="parallax-bg-layer" style="background-image: url('{{ asset('img/ft_2.jpeg') }}?v={{ time() }}');" data-parallax-bg="0.32"></div>
        </div>
        <div class="parallax-ornament-layer" data-parallax-speed="-0.15"></div>
        <div class="program-overlay"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow light"><i class="fa-solid fa-graduation-cap"></i> Akademik & Kurikulum</span>
                <h2 class="section-title">Jenjang Pendidikan & Program Unggulan</h2>
                <p class="section-subtitle light">
                    Sinergi pendidikan formal dan diniyah yang berkesinambungan untuk membekali peserta didik dengan hafalan Al-Qur'an, bahasa Arab, dan kompetensi akademik.
                </p>
            </div>

            <!-- Jenjang Pendidikan -->
            <div class="jenjang-strip" data-aos="fade-up">
                <div class="jenjang-card">
                    <div class="jenjang-badge">TK</div>
                    <div>
                        <h3>TK / PAUD Al-Qur'an</h3>
                        <p>Pengenalan huruf hijaiyah dengan metode menyenangkan, hafalan surat pendek, doa harian, dan pembiasaan adab Islami.</p>
                    </div>
                </div>
                <div class="jenjang-card">
                    <div class="jenjang-badge">SD</div>
                    <div>
                        <h3>SD Islam Terpadu</h3>
                        <p>Penguatan bacaan Al-Qur'an bertajwid (Tahsin), target hafalan juz pilihan, dasar akidah-fiqih, dan kurikulum akademik nasional.</p>
                    </div>
                </div>
                <div class="jenjang-card">
                    <div class="jenjang-badge">SMP</div>
                    <div>
                        <h3>SMP Islam Terpadu</h3>
                        <p>Akselerasi Tahfizh 30 Juz mutqin, pendalaman bahasa Arab aktif, kajian kitab dasar Mazhab Syafi'i, serta sains & teknologi.</p>
                    </div>
                </div>
            </div>

            <!-- 4 Kartu Mihrab Program Unggulan (dengan 3D Tilt Interaktif) -->
            <div class="program-grid">
                <div class="program-card tilt-card" data-aos="fade-up" data-aos-delay="50">
                    <div class="icon-card"><i class="fa-solid fa-book-open-reader"></i></div>
                    <h3>Tahfizhul Qur'an & Tahsin</h3>
                    <p>Perbaikan makharijul huruf dan sifat huruf secara talaqqi sebelum memasuki setoran hafalan baru (ziyadah) dan muraja'ah terjadwal.</p>
                    <span class="program-tag">Target Hafalan Mutqin</span>
                </div>

                <div class="program-card tilt-card" data-aos="fade-up" data-aos-delay="120">
                    <div class="icon-card"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Madrasah Diniyah</h3>
                    <p>Pembelajaran ilmu syar'i terstruktur meliputi Aqidah Ahlussunnah, Fiqih Ibadah Mazhab Syafi'i, Hadits Pilihan, dan Sirah Nabawiyah.</p>
                    <span class="program-tag">Ilmu Syar'i Dasar</span>
                </div>

                <div class="program-card tilt-card" data-aos="fade-up" data-aos-delay="190">
                    <div class="icon-card"><i class="fa-solid fa-language"></i></div>
                    <h3>Bahasa Arab</h3>
                    <p>Pembiasaan kosakata (mufradat), percakapan harian (muhadatsah), dan kaidah bahasa Arab untuk memahami ayat Al-Qur'an.</p>
                    <span class="program-tag">Aktif & Pasif</span>
                </div>

                <div class="program-card tilt-card" data-aos="fade-up" data-aos-delay="260">
                    <div class="icon-card"><i class="fa-solid fa-hands-praying"></i></div>
                    <h3>Pendidikan Adab & Karakter</h3>
                    <p>Pembinaan akhlak terhadap orang tua dan guru, kedisiplinan ibadah harian, serta kegiatan ekstrakurikuler yang positif.</p>
                    <span class="program-tag">Karakter Rabbani</span>
                </div>
            </div>

            <div style="text-align: center; margin-top: 38px;" data-aos="fade-up">
                <a href="/prof?halaman=program" class="btn-started">
                    <i class="fa-solid fa-graduation-cap"></i> Lihat Detail Kurikulum & Rutinitas Harian &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- ======== 4. GALERI KEGIATAN & PRESTASI (AKTIF & INTERAKTIF) ======== -->
    <section id="galeri" class="section parallax-section">
        <div class="parallax-ring spin" style="right: -220px; top: 80px;" data-parallax-speed="-0.15"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-camera-retro"></i> Dokumentasi & Aktivitas</span>
                <h2 class="section-title">Galeri Kegiatan & Pembinaan Santri</h2>
                <p class="section-subtitle">
                    Potret keseharian santri dalam menghafal Al-Qur'an, mengikuti kegiatan belajar mengajar, serta pembinaan karakter di lingkungan sekolah.
                </p>
            </div>

            <!-- Filter Kategori Galeri -->
            <div class="galeri-filter-bar" data-aos="fade-up">
                <button type="button" class="galeri-filter-btn active" data-filter="all">Semua Kegiatan</button>
                <button type="button" class="galeri-filter-btn" data-filter="tahfizh">Halaqah & Tahfizh</button>
                <button type="button" class="galeri-filter-btn" data-filter="kbm">Kegiatan Belajar</button>
                <button type="button" class="galeri-filter-btn" data-filter="lingkungan">Lingkungan Sekolah</button>
            </div>

            <!-- Grid Galeri -->
            <div class="galeri-grid" id="galeriGrid">
                <figure class="galeri-item" data-category="tahfizh" data-aos="fade-up">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/ft_2.jpeg') }}" data-caption="Halaqah Tahfizhul Qur'an — Setoran hafalan dan perbaikan tajwid bersama muhaffizh">
                        <img src="{{ asset('img/ft_2.jpeg') }}" alt="Halaqah Tahfizhul Qur'an" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-book-quran"></i> Halaqah & Tahfizh</span>
                        <h3>Talaqqi & Setoran Hafalan</h3>
                        <p>Bimbingan intensif bacaan dan setoran hafalan Al-Qur'an secara berhadapan langsung dengan pengajar.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="kbm" data-aos="fade-up" data-aos-delay="80">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/ft_1.jpeg') }}" data-caption="Kegiatan Belajar Mengajar — Suasana pembelajaran interaktif di kelas">
                        <img src="{{ asset('img/ft_1.jpeg') }}" alt="Kegiatan Belajar Mengajar" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-chalkboard-user"></i> Kegiatan Belajar</span>
                        <h3>Pembelajaran Kelas Terpadu</h3>
                        <p>Suasana belajar yang aktif, tertib, dan menyenangkan dengan pendampingan penuh dari para ustadz/ustadzah.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="tahfizh" data-aos="fade-up" data-aos-delay="160">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/foto_1.jpeg') }}" data-caption="Muraja'ah Bersama — Penguatan hafalan rutin setiap pagi sebelum memulai pelajaran">
                        <img src="{{ asset('img/foto_1.jpeg') }}" alt="Muraja'ah Bersama" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-repeat"></i> Halaqah & Tahfizh</span>
                        <h3>Muraja'ah Pagi Terjadwal</h3>
                        <p>Rutinitas menjaga kualitas hafalan lama agar tetap kokoh (mutqin) di dalam ingatan peserta didik.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="kbm" data-aos="fade-up">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/foto_2.jpeg') }}" data-caption="Pembinaan Adab & Praktek Ibadah — Penanaman akhlak mulia sejak dini">
                        <img src="{{ asset('img/foto_2.jpeg') }}" alt="Pembinaan Adab dan Ibadah" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-hands-holding-child"></i> Kegiatan Belajar</span>
                        <h3>Pembinaan Adab & Ibadah</h3>
                        <p>Praktek langsung tata cara wudhu, sholat sesuai sunnah, serta adab pergaulan sehari-hari.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="lingkungan" data-aos="fade-up" data-aos-delay="80">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/bg_skl.jpeg') }}" data-caption="Lingkungan Sekolah Islam Al-Qur'an Imam Syafi'i yang asri dan kondusif">
                        <img src="{{ asset('img/bg_skl.jpeg') }}" alt="Lingkungan Sekolah" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-school"></i> Lingkungan Sekolah</span>
                        <h3>Suasana Kampus yang Kondusif</h3>
                        <p>Area sekolah yang tenang dan mendukung konsentrasi santri dalam menuntut ilmu dan menghafal.</p>
                    </figcaption>
                </figure>

                <figure class="galeri-item" data-category="lingkungan" data-aos="fade-up" data-aos-delay="160">
                    <button type="button" class="galeri-btn" data-lightbox
                        data-full="{{ asset('img/ft_1.jpeg') }}" data-caption="Evaluasi & Tasmi' Hafalan — Uji kelancaran hafalan santri secara berkala">
                        <img src="{{ asset('img/ft_1.jpeg') }}" alt="Evaluasi dan Tasmi Hafalan" loading="lazy">
                        <span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
                    </button>
                    <figcaption>
                        <span class="badge"><i class="fa-solid fa-award"></i> Capaian Santri</span>
                        <h3>Ujian Tasmi' & Evaluasi</h3>
                        <p>Uji publik kelancaran hafalan per juz sebagai tolok ukur ketuntasan sebelum melanjutkan ke juz berikutnya.</p>
                    </figcaption>
                </figure>
            </div>

            <!-- Sorotan Fokus Prestasi & Kompetensi Santri (Digabung dalam Section Galeri) -->
            <div class="prestasi-strip" data-aos="fade-up">
                <div class="prestasi-strip-header">
                    <h3>Fokus Capaian & Prestasi Peserta Didik</h3>
                    <p>Setiap peserta didik dibina untuk meraih keunggulan dalam 3 pilar kompetensi utama:</p>
                </div>
                <div class="prestasi-grid">
                    <div class="prestasi-card">
                        <div class="prestasi-icon"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);">Pilar 1</span>
                            <h4>Musabaqah Hifzhil Qur'an</h4>
                            <p>Kesiapan mental dan kualitas bacaan santri dalam mengikuti ajang MHQ & ujian tasmi' berkala.</p>
                        </div>
                    </div>
                    <div class="prestasi-card">
                        <div class="prestasi-icon"><i class="fa-solid fa-medal"></i></div>
                        <div>
                            <span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);">Pilar 2</span>
                            <h4>Kompetensi Bahasa & Diniyah</h4>
                            <p>Penguasaan materi hafalan hadits, doa harian, fiqih ibadah, serta percakapan bahasa Arab.</p>
                        </div>
                    </div>
                    <div class="prestasi-card">
                        <div class="prestasi-icon"><i class="fa-solid fa-star"></i></div>
                        <div>
                            <span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);">Pilar 3</span>
                            <h4>Ketuntasan Akademik & Rapor</h4>
                            <p>Pemantauan nilai akademik dan kehadiran secara transparan melalui sistem rapor digital SIAKAD.</p>
                        </div>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 28px;">
                    <a href="/prof?halaman=galeri" class="btn-started">
                        <i class="fa-solid fa-camera-retro"></i> Buka Halaman Galeri & Agenda Kegiatan &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 5. PPDB & FAQ PENDAFTARAN (TERPADU) ======== -->
    <section id="ppdb" class="section ppdb-section parallax-section">
        <div class="container">
            <!-- Parallax Banner PPDB -->
            <div class="ppdb-banner" data-aos="zoom-in">
                <div class="parallax-bg-wrap">
                    <div class="parallax-bg-layer" style="background-image: url('{{ asset('img/bg_skl.jpeg') }}?v={{ time() }}');" data-parallax-bg="0.28"></div>
                </div>
                <div class="parallax-ornament-layer" data-parallax-speed="0.12"></div>
                <div class="ppdb-banner-overlay"></div>

                <div class="ppdb-banner-content">
                    <span class="section-eyebrow light"><i class="fa-solid fa-calendar-check"></i> Penerimaan Peserta Didik Baru</span>
                    <h2>Mari Bergabung Bersama Keluarga Besar Sekolah Al-Qur'an Imam Syafi'i</h2>
                    <p>
                        Siapkan masa depan putra-putri Anda menjadi generasi penghafal Al-Qur'an yang berilmu dan beradab mulia. Berikut tahapan mudah pendaftaran peserta didik baru:
                    </p>

                    <!-- 4 Langkah Pendaftaran -->
                    <div class="ppdb-steps-grid">
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">1</span>
                            <h4>Registrasi Akun / Formulir</h4>
                            <p>Daftar secara daring melalui portal atau datang langsung ke sekretariat PPDB sekolah.</p>
                        </div>
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">2</span>
                            <h4>Verifikasi Berkas</h4>
                            <p>Lengkapi dokumen KK, Akta Kelahiran, pas foto, dan dokumen pendukung lainnya.</p>
                        </div>
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">3</span>
                            <h4>Observasi & Pemetaan</h4>
                            <p>Observasi kesiapan belajar santri serta wawancara bersama orang tua/wali.</p>
                        </div>
                        <div class="ppdb-step">
                            <span class="ppdb-step-num">4</span>
                            <h4>Daftar Ulang & Masuk</h4>
                            <p>Pengumuman hasil seleksi, penyelesaian administrasi, dan pembagian kelas di SIAKAD.</p>
                        </div>
                    </div>

                    <div class="ppdb-btns">
                        <a href="/reg" class="btn-started">
                            <i class="fa-solid fa-file-signature"></i> Buka Halaman Pendaftaran / Portal
                        </a>
                        <a href="/prof?halaman=ppdb" class="btn-secondary">
                            <i class="fa-solid fa-list-check"></i> Rincian Syarat & Panduan PPDB
                        </a>
                        <a href="/prof?halaman=kontak" class="btn-secondary">
                            <i class="fa-brands fa-whatsapp"></i> Hubungi Panitia PPDB
                        </a>
                    </div>
                </div>
            </div>

            <!-- FAQ Accordion (Tanpa Placeholder Kosong) -->
            <div class="faq-wrapper" data-aos="fade-up">
                <div class="faq-head">
                    <span class="section-eyebrow"><i class="fa-solid fa-circle-question"></i> Tanya Jawab (FAQ)</span>
                    <h3>Pertanyaan yang Sering Diajukan</h3>
                </div>
                <div class="faq-list">
                    <details open>
                        <summary>Bagaimana cara mendaftar sebagai santri baru?</summary>
                        <p>Pendaftaran dapat dilakukan dengan mengunjungi langsung sekretariat Sekolah Islam Al-Qur'an Imam Syafi'i pada jam kerja, atau mengakses tombol <strong>Portal SIAKAD / Pendaftaran</strong> di bagian atas halaman ini untuk registrasi akun awal.</p>
                    </details>
                    <details>
                        <summary>Apa saja dokumen persyaratan pendaftaran yang perlu disiapkan?</summary>
                        <p>Calon wali santri cukup menyiapkan fotokopi Kartu Keluarga (KK), Akta Kelahiran, KTP kedua orang tua, pas foto terbaru ukuran 3x4, serta surat pindah/ijazah jenjang sebelumnya (untuk jenjang lanjutan).</p>
                    </details>
                    <details>
                        <summary>Apakah calon siswa harus sudah lancar membaca Al-Qur'an saat mendaftar?</summary>
                        <p>Tidak harus. Setiap siswa baru akan mengikuti pemetaan kemampuan awal (placement test) dan akan dibimbing dari dasar melalui program <strong>Tahsin</strong> sebelum melanjutkan ke tahap <strong>Tahfizhul Qur'an</strong> sesuai kemampuannya.</p>
                    </details>
                    <details>
                        <summary>Bagaimana orang tua memantau perkembangan nilai, jadwal, dan SPP anak?</summary>
                        <p>Sekolah telah dilengkapi dengan sistem <strong>SIAKAD Digital</strong>. Orang tua dan siswa dapat masuk melalui menu <strong>Portal SIAKAD</strong> menggunakan HP maupun komputer untuk melihat jadwal harian, jurnal materi guru, absensi, nilai rapor, hingga rincian pembayaran.</p>
                    </details>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 5B. INFORMASI & DOWNLOAD WEB APP (PWA) ======== -->
    <section id="install-app" class="section parallax-section" style="padding-top: 30px; padding-bottom: 40px;">
        <div class="container">
            <div class="webapp-banner-card" data-aos="fade-up">
                <div class="parallax-ornament-layer" data-parallax-speed="0.12"></div>

                <div class="webapp-grid">
                    <!-- Kiri: Informasi & Tombol Install -->
                    <div class="webapp-content">
                        <span class="section-eyebrow light">
                            <i class="fa-solid fa-mobile-screen-button"></i> Aplikasi Portal & SIAKAD (Web App)
                        </span>
                        <h2>Pasang Aplikasi <span class="highlight">Sekolah Syafi'i</span> di Perangkat Anda</h2>
                        <p class="webapp-lead">
                            Kini sistem informasi sekolah, portal SIAKAD, dan monitoring Tahfizh telah mendukung teknologi <strong>Progressive Web App (PWA)</strong>. Pasang langsung di layar utama HP atau laptop Anda untuk akses satu ketukan layaknya aplikasi native tanpa membebani memori.
                        </p>

                        <div class="webapp-features-list">
                            <div class="webapp-feature-pill">
                                <i class="fa-solid fa-bolt"></i>
                                <span>Akses 1 Ketukan dari Layar Utama HP</span>
                            </div>
                            <div class="webapp-feature-pill">
                                <i class="fa-solid fa-feather-pointed"></i>
                                <span>Sangat Ringan & Hemat Memori</span>
                            </div>
                            <div class="webapp-feature-pill">
                                <i class="fa-solid fa-expand"></i>
                                <span>Tampilan Layar Penuh (Standalone)</span>
                            </div>
                            <div class="webapp-feature-pill">
                                <i class="fa-solid fa-arrows-rotate"></i>
                                <span>Update Otomatis Tanpa Re-install</span>
                            </div>
                        </div>

                        <div class="webapp-actions">
                            <button type="button" class="btn-install-pwa" data-trigger-pwa-install>
                                <i class="fa-solid fa-download"></i>
                                <span class="pwa-btn-label">Download / Install Aplikasi</span>
                            </button>
                            <button type="button" class="btn-guide-pwa" id="btnOpenPwaGuide">
                                <i class="fa-solid fa-circle-question"></i> Cara Pasang di HP & Laptop
                            </button>
                        </div>
                    </div>

                    <!-- Kanan: Kartu Pratinjau Ikon Aplikasi -->
                    <div class="webapp-preview-stage">
                        <div class="webapp-phone-frame tilt-card">
                            <div class="webapp-phone-notch"></div>
                            <div class="webapp-app-icon">
                                <img src="{{ asset('img/logo_sklh.png') }}?v={{ time() }}" alt="Ikon Aplikasi Sekolah Syafi'i">
                            </div>
                            <h4>Sekolah Syafi'i</h4>
                            <span class="app-sub">Portal Akademik, SIAKAD & Tahfizh</span>

                            <div style="font-size: 0.78rem; color: #53665b; background: #f3f7f4; padding: 10px 12px; border-radius: 12px; margin-bottom: 14px; line-height: 1.5;">
                                <i class="fa-solid fa-circle-check" style="color: #145a32;"></i>
                                Tersedia untuk Siswa/Wali Santri, Guru, dan Admin
                            </div>

                            <div class="webapp-platform-badges">
                                <span class="platform-chip"><i class="fa-brands fa-android"></i> Android</span>
                                <span class="platform-chip"><i class="fa-brands fa-apple"></i> iOS / iPhone</span>
                                <span class="platform-chip"><i class="fa-solid fa-laptop"></i> Desktop</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== 6. LOKASI & KONTAK (PETA INTERAKTIF LEAFLET) ======== -->
    <section id="kontak" class="section parallax-section">
        <div class="parallax-ring spin" style="left: -220px; bottom: -180px;" data-parallax-speed="0.14"></div>

        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <span class="section-eyebrow"><i class="fa-solid fa-map-location-dot"></i> Hubungi Kami</span>
                <h2 class="section-title">Lokasi & Informasi Kontak</h2>
                <p class="section-subtitle">
                    Silakan kunjungi kampus kami atau hubungi layanan administrasi sekolah untuk konsultasi pendidikan dan informasi PPDB.
                </p>
            </div>

            <div class="kontak-grid">
                <div class="kontak-info" data-aos="fade-right">
                    <ul>
                        <li>
                            <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                            <div>
                                <strong>Alamat Kampus</strong>
                                <span>Kota Palu, Sulawesi Tengah (Klik penanda pada peta di samping untuk rute Google Maps langsung)</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-clock" aria-hidden="true"></i>
                            <div>
                                <strong>Jam Layanan Sekretariat</strong>
                                <span>Senin – Sabtu: 07.30 – 15.30 WITA (Hari Ahad & Libur Nasional Tutup)</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                            <div>
                                <strong>Layanan Informasi & PPDB</strong>
                                <span>Hubungi Tata Usaha / Panitia Penerimaan Siswa Baru di Sekretariat Sekolah</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-laptop" aria-hidden="true"></i>
                            <div>
                                <strong>Layanan Akademik Digital (SIAKAD)</strong>
                                <span>Akses portal Siswa, Guru, dan Admin secara daring melalui menu <a href="/reg" style="color: var(--primary); font-weight: 600; text-decoration: underline;">Portal SIAKAD</a></span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="kontak-map" data-aos="fade-left">
                    <div id="map" role="region" aria-label="Peta lokasi sekolah"
                         style="width:100%;height:100%;min-height:380px;position:relative;z-index:0;"></div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 36px;" data-aos="fade-up">
                <a href="/prof?halaman=kontak" class="btn-started">
                    <i class="fa-solid fa-paper-plane"></i> Buka Halaman Kontak & Form Konsultasi Cepat &rarr;
                </a>
            </div>
        </div>
    </section>

    <!-- ======== FOOTER ======== -->
    <footer class="footer">
        <div class="parallax-ornament-layer" style="opacity: 0.08;"></div>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="{{ asset('img/logo.png') }}?v={{ time() }}" alt="Logo Sekolah">
                        <span>Sekolah Al-Qur'an Imam Syafi'i</span>
                    </div>
                    <p>Lembaga pendidikan Islam terpadu yang berfokus pada Tahfizhul Qur'an, penanaman akidah & adab salafus shalih, serta keunggulan akademik.</p>
                    <div class="sosmed">
                        <a href="/prof?halaman=kontak" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="/prof?halaman=kontak" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="/prof?halaman=kontak" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h4>Halaman Utama</h4>
                    <ul>
                        <li><a href="/">Beranda (Landing Page)</a></li>
                        <li><a href="/prof?halaman=profil">Halaman Profil & Fasilitas</a></li>
                        <li><a href="/prof?halaman=program">Halaman Pendidikan & Program</a></li>
                        <li><a href="/prof?halaman=galeri">Halaman Galeri & Kegiatan</a></li>
                        <li><a href="/prof?halaman=ppdb">Halaman Informasi PPDB</a></li>
                        <li><a href="/prof?halaman=kontak">Halaman Lokasi & Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Program Unggulan</h4>
                    <ul>
                        <li><a href="/prof?halaman=program">Tahfizhul Qur'an 30 Juz</a></li>
                        <li><a href="/prof?halaman=program">Tahsin & Talaqqi Bacaan</a></li>
                        <li><a href="/prof?halaman=program">Madrasah Diniyah</a></li>
                        <li><a href="/prof?halaman=program">Bahasa Arab Aktif</a></li>
                        <li><a href="/prof?halaman=program">Pembinaan Adab Harian</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Akses Sistem</h4>
                    <ul>
                        <li><a href="/reg"><i class="fa-solid fa-right-to-bracket"></i> Login Portal SIAKAD</a></li>
                        <li><a href="#install-app"><i class="fa-solid fa-mobile-screen-button"></i> Install Aplikasi (Web App)</a></li>
                        <li><a href="/prof?halaman=ppdb"><i class="fa-solid fa-user-plus"></i> Alur & Syarat Pendaftaran</a></li>
                        <li><a href="/prof?halaman=kontak"><i class="fa-solid fa-location-dot"></i> Peta Lokasi Sekolah</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <span id="year">2026</span> Sekolah Islam Al-Qur'an Imam Syafi'i. Seluruh hak cipta dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- ======== LIGHTBOX GALERI ======== -->
    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto" hidden>
        <button type="button" class="lb-close" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>
        <button type="button" class="lb-nav lb-prev" aria-label="Foto sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
        <figure>
            <img src="" alt="">
            <figcaption class="lb-caption"></figcaption>
        </figure>
        <button type="button" class="lb-nav lb-next" aria-label="Foto berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    <!-- ======== MODAL PANDUAN INSTALL WEB APP (PWA) ======== -->
    <div class="pwa-modal-backdrop" id="pwaInstallModal" role="dialog" aria-modal="true" aria-labelledby="pwaModalTitle" hidden>
        <div class="pwa-modal-card">
            <div class="pwa-modal-header">
                <h3 id="pwaModalTitle">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    Panduan Pasang Aplikasi (Web App)
                </h3>
                <button type="button" class="pwa-modal-close" id="btnClosePwaModal" aria-label="Tutup panduan">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="pwa-modal-body">
                <div class="pwa-guide-tabs" role="tablist">
                    <button type="button" class="pwa-tab-btn active" data-pwa-tab="android">
                        <i class="fa-brands fa-android"></i> Android
                    </button>
                    <button type="button" class="pwa-tab-btn" data-pwa-tab="ios">
                        <i class="fa-brands fa-apple"></i> iPhone / iOS
                    </button>
                    <button type="button" class="pwa-tab-btn" data-pwa-tab="desktop">
                        <i class="fa-solid fa-laptop"></i> Laptop / PC
                    </button>
                </div>

                <!-- Panel Android -->
                <div class="pwa-guide-panel active" id="pwa-panel-android">
                    <ul class="pwa-step-list">
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">1</span>
                            <div>Buka website ini menggunakan browser <strong>Google Chrome</strong> di HP Android Anda.</div>
                        </li>
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">2</span>
                            <div>Ketuk ikon <strong>Titik Tiga (<i class="fa-solid fa-ellipsis-vertical"></i>)</strong> di pojok kanan atas layar Chrome.</div>
                        </li>
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">3</span>
                            <div>Pilih menu <strong>"Instal aplikasi"</strong> atau <strong>"Tambahkan ke layar utama"</strong>, lalu konfirmasi <strong>Instal</strong>.</div>
                        </li>
                    </ul>
                </div>

                <!-- Panel iOS -->
                <div class="pwa-guide-panel" id="pwa-panel-ios">
                    <ul class="pwa-step-list">
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">1</span>
                            <div>Buka website ini melalui browser <strong>Safari</strong> di iPhone atau iPad Anda.</div>
                        </li>
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">2</span>
                            <div>Ketuk tombol <strong>Bagikan / Share (<i class="fa-solid fa-arrow-up-from-bracket"></i>)</strong> pada bilah navigasi bawah Safari.</div>
                        </li>
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">3</span>
                            <div>Gulir ke bawah dan pilih <strong>"Tambah ke Layar Utama" (Add to Home Screen)</strong>, lalu ketuk <strong>Tambah</strong>.</div>
                        </li>
                    </ul>
                </div>

                <!-- Panel Desktop -->
                <div class="pwa-guide-panel" id="pwa-panel-desktop">
                    <ul class="pwa-step-list">
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">1</span>
                            <div>Buka website ini di browser <strong>Google Chrome</strong> atau <strong>Microsoft Edge</strong> pada komputer/laptop.</div>
                        </li>
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">2</span>
                            <div>Klik ikon <strong>Install (<i class="fa-solid fa-computer"></i> / <i class="fa-solid fa-download"></i>)</strong> yang muncul di sisi kanan kolom alamat URL (Address Bar).</div>
                        </li>
                        <li class="pwa-step-item">
                            <span class="pwa-step-num">3</span>
                            <div>Klik <strong>Instal</strong>, dan pintasan aplikasi Sekolah Syafi'i akan tampil di Desktop/Start Menu Anda.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ======== SCRIPTS ======== -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        AOS.init({
            once: false,
            mirror: true,
            duration: 850,
            easing: 'ease-out-cubic',
            offset: 80
        });
        document.getElementById('year').textContent = new Date().getFullYear();

        // ===== 1. ENGINE MULTI-LAYER PARALLAX (SCROLL + MOUSE 3D) =====
        (function () {
            var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (reduceMotion) return;

            var heroEls = [].slice.call(document.querySelectorAll('[data-parallax-hero]'));
            var speedEls = [].slice.call(document.querySelectorAll('[data-parallax-speed]'));
            var imgEls = [].slice.call(document.querySelectorAll('[data-parallax-img]'));
            var bgEls = [].slice.call(document.querySelectorAll('[data-parallax-bg]'));
            var mouseEls = [].slice.call(document.querySelectorAll('[data-mouse-speed]'));
            var progressBar = document.getElementById('scrollProgressBar');
            var navbar = document.getElementById('navbar');

            var ticking = false;
            var mouseX = 0, mouseY = 0;
            var targetMouseX = 0, targetMouseY = 0;

            function updateScrollParallax() {
                var scrollY = window.pageYOffset || document.documentElement.scrollTop;
                var vh = window.innerHeight || 800;
                var docHeight = Math.max(document.body.scrollHeight, document.documentElement.scrollHeight) - vh;

                // Top scroll progress bar
                if (progressBar && docHeight > 0) {
                    progressBar.style.width = Math.min(100, Math.max(0, (scrollY / docHeight) * 100)) + '%';
                }

                // Navbar shrink state
                if (navbar) {
                    navbar.classList.toggle('scrolled', scrollY > 40);
                }

                // A. Hero multi-layer parallax (gabungan scroll + mouse 3D tanpa konflik)
                if (scrollY < vh * 1.4) {
                    for (var i = 0; i < heroEls.length; i++) {
                        var el = heroEls[i];
                        var speed = parseFloat(el.getAttribute('data-parallax-hero')) || 0;
                        var mFactor = parseFloat(el.getAttribute('data-mouse-speed')) || 0;
                        var yPos = (scrollY * speed) + (mouseY * mFactor);
                        var xPos = mouseX * mFactor;
                        if (el.classList.contains('hero-bg-parallax')) {
                            var scale = 1.14 + (scrollY * 0.00014);
                            el.style.transform = 'translate3d(' + xPos.toFixed(1) + 'px, ' + yPos.toFixed(1) + 'px, 0) scale(' + scale.toFixed(3) + ')';
                        } else {
                            el.style.transform = 'translate3d(' + xPos.toFixed(1) + 'px, ' + yPos.toFixed(1) + 'px, 0)';
                        }
                    }
                }

                // B. Section-relative floating elements ([data-parallax-speed])
                for (var j = 0; j < speedEls.length; j++) {
                    var sEl = speedEls[j];
                    var rect = sEl.getBoundingClientRect();
                    if (rect.bottom > -200 && rect.top < vh + 200) {
                        var centerOffset = (rect.top + rect.height * 0.5) - (vh * 0.5);
                        var spd = parseFloat(sEl.getAttribute('data-parallax-speed')) || 0;
                        var shiftY = centerOffset * spd;
                        sEl.style.transform = 'translate3d(0, ' + shiftY.toFixed(1) + 'px, 0)';
                    }
                }

                // C. Inside-frame image parallax ([data-parallax-img])
                for (var k = 0; k < imgEls.length; k++) {
                    var iEl = imgEls[k];
                    var pRect = iEl.parentElement.getBoundingClientRect();
                    if (pRect.bottom > -100 && pRect.top < vh + 100) {
                        var progress = (vh - pRect.top) / (vh + pRect.height);
                        var move = (progress - 0.5) * 90 * (parseFloat(iEl.getAttribute('data-parallax-img')) || 0.16);
                        iEl.style.transform = 'translate3d(0, ' + move.toFixed(1) + 'px, 0) scale(1.12)';
                    }
                }

                // D. Full-bleed section background parallax ([data-parallax-bg])
                for (var m = 0; m < bgEls.length; m++) {
                    var bEl = bgEls[m];
                    var sec = bEl.closest('.parallax-section') || bEl.parentElement;
                    var sRect = sec.getBoundingClientRect();
                    if (sRect.bottom > -150 && sRect.top < vh + 150) {
                        var bSpeed = parseFloat(bEl.getAttribute('data-parallax-bg')) || 0.3;
                        var bOffset = (vh * 0.5 - (sRect.top + sRect.height * 0.5)) * bSpeed;
                        bEl.style.transform = 'translate3d(0, ' + bOffset.toFixed(1) + 'px, 0) scale(1.15)';
                    }
                }

                ticking = false;
            }

            window.addEventListener('scroll', function () {
                if (!ticking) {
                    window.requestAnimationFrame(updateScrollParallax);
                    ticking = true;
                }
            }, { passive: true });

            window.addEventListener('resize', updateScrollParallax);
            updateScrollParallax();

            // E. Interactive Mouse-Move 3D Parallax on Hero (Desktop)
            var heroSection = document.getElementById('home');
            if (heroSection && window.matchMedia('(hover: hover)').matches) {
                heroSection.addEventListener('mousemove', function (e) {
                    var w = window.innerWidth;
                    var h = window.innerHeight;
                    targetMouseX = (e.clientX / w - 0.5);
                    targetMouseY = (e.clientY / h - 0.5);
                });

                function animateMouseParallax() {
                    mouseX += (targetMouseX - mouseX) * 0.08;
                    mouseY += (targetMouseY - mouseY) * 0.08;
                    var scrollY = window.pageYOffset || 0;
                    if (scrollY < window.innerHeight) {
                        for (var n = 0; n < mouseEls.length; n++) {
                            var mEl = mouseEls[n];
                            var factor = parseFloat(mEl.getAttribute('data-mouse-speed')) || 15;
                            var hSpeed = parseFloat(mEl.getAttribute('data-parallax-hero')) || 0;
                            var yScroll = scrollY * hSpeed;
                            var dx = mouseX * factor;
                            var dy = mouseY * factor + yScroll;
                            mEl.style.transform = 'translate3d(' + dx.toFixed(1) + 'px, ' + dy.toFixed(1) + 'px, 0)';
                        }
                    }
                    requestAnimationFrame(animateMouseParallax);
                }
                requestAnimationFrame(animateMouseParallax);
            }

            // F. 3D Card Tilt pada Kartu Program
            var tiltCards = document.querySelectorAll('.tilt-card');
            if (window.matchMedia('(hover: hover)').matches) {
                tiltCards.forEach(function (card) {
                    card.addEventListener('mousemove', function (e) {
                        var r = card.getBoundingClientRect();
                        var x = (e.clientX - r.left) / r.width - 0.5;
                        var y = (e.clientY - r.top) / r.height - 0.5;
                        card.style.transform = 'perspective(700px) rotateY(' + (x * 10).toFixed(1) + 'deg) rotateX(' + (-y * 10).toFixed(1) + 'deg) translateY(-8px)';
                    });
                    card.addEventListener('mouseleave', function () {
                        card.style.transform = '';
                    });
                });
            }

            // G. Animasi Counter Angka pada Parallax Banner
            var counterWrap = document.getElementById('statCounterSection');
            if (counterWrap && 'IntersectionObserver' in window) {
                var obs = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            counterWrap.querySelectorAll('.counter-num').forEach(function (el) {
                                var target = parseInt(el.getAttribute('data-target'), 10) || 0;
                                var start = 0;
                                var duration = 1100;
                                var startTime = null;
                                function step(ts) {
                                    if (!startTime) startTime = ts;
                                    var prog = Math.min((ts - startTime) / duration, 1);
                                    var eased = 1 - Math.pow(1 - prog, 3);
                                    el.textContent = Math.floor(eased * target);
                                    if (prog < 1) requestAnimationFrame(step);
                                    else el.textContent = target;
                                }
                                requestAnimationFrame(step);
                            });
                        }
                    });
                }, { threshold: 0.35 });
                obs.observe(counterWrap);
            }
        })();

        // ===== 2. PARTIKEL EMAS MELAYANG DI HERO =====
        (function () {
            var overlay = document.getElementById('heroParticles');
            if (!overlay) return;
            if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

            var COUNT = window.innerWidth < 768 ? 14 : 26;
            for (var i = 0; i < COUNT; i++) {
                var p = document.createElement('span');
                var size = 3 + Math.random() * 6;
                p.className = 'particle';
                p.style.left = (Math.random() * 100) + '%';
                p.style.width = size + 'px';
                p.style.height = size + 'px';
                p.style.setProperty('--o', (0.35 + Math.random() * 0.55).toFixed(2));
                p.style.setProperty('--dx', (Math.random() * 80 - 40).toFixed(0) + 'px');
                p.style.animationDuration = (9 + Math.random() * 13).toFixed(1) + 's';
                p.style.animationDelay = (-Math.random() * 22).toFixed(1) + 's';
                p.setAttribute('aria-hidden', 'true');
                overlay.appendChild(p);
            }
        })();

        // ===== 3. NAVBAR MOBILE & SCROLL-SPY ACTIVE MENU =====
        (function () {
            var NAV_BREAKPOINT = 1080;
            var navbar = document.getElementById('navbar');
            var toggleBtn = document.getElementById('mobile-menu');
            var spyLinks = [].slice.call(document.querySelectorAll('.nav-spy'));

            function closeMobileNav() {
                if (!navbar || !toggleBtn) return;
                navbar.classList.remove('mobile-nav-open');
                toggleBtn.classList.remove('active');
                toggleBtn.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('mobile-nav-locked');
            }
            if (toggleBtn && navbar) {
                toggleBtn.addEventListener('click', function () {
                    var isOpen = navbar.classList.toggle('mobile-nav-open');
                    toggleBtn.classList.toggle('active', isOpen);
                    toggleBtn.setAttribute('aria-expanded', String(isOpen));
                    document.body.classList.toggle('mobile-nav-locked', isOpen);
                });
                navbar.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', closeMobileNav);
                });
                window.addEventListener('resize', function () {
                    if (window.innerWidth > NAV_BREAKPOINT) closeMobileNav();
                });
            }

            // Scroll-Spy untuk menandai menu aktif sesuai section di landing page
            var sections = spyLinks.map(function (link) {
                var id = link.getAttribute('data-section') || link.getAttribute('href');
                return id && id.startsWith('#') ? document.querySelector(id) : null;
            });

            window.addEventListener('scroll', function () {
                var scrollPos = (window.pageYOffset || document.documentElement.scrollTop) + 180;
                var currentIdx = 0;
                for (var i = 0; i < sections.length; i++) {
                    if (sections[i] && sections[i].offsetTop <= scrollPos) {
                        currentIdx = i;
                    }
                }
                spyLinks.forEach(function (link, idx) {
                    link.classList.toggle('active', idx === currentIdx);
                });
            }, { passive: true });
        })();

        // ===== 4. FILTER KATEGORI GALERI & LIGHTBOX =====
        (function () {
            var filterBtns = [].slice.call(document.querySelectorAll('.galeri-filter-btn'));
            var galeriItems = [].slice.call(document.querySelectorAll('#galeriGrid .galeri-item'));

            filterBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var cat = btn.getAttribute('data-filter');
                    filterBtns.forEach(function (b) { b.classList.toggle('active', b === btn); });
                    galeriItems.forEach(function (item) {
                        var match = (cat === 'all' || item.getAttribute('data-category') === cat);
                        item.style.display = match ? '' : 'none';
                    });
                    if (typeof AOS !== 'undefined') AOS.refresh();
                });
            });

            // Lightbox
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

        // ===== 5. PETA INTERAKTIF LEAFLET (OPENSTREETMAP) =====
        (function () {
            var el = document.getElementById('map');
            if (!el || typeof L === 'undefined') return;

            var LAT = -0.9267058875927435;
            var LNG = 119.87149370241973;
            var NAMA = "Sekolah Islam Al-Qur'an Imam Syafi'i";

            var map = L.map(el, { scrollWheelZoom: false }).setView([LAT, LNG], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>'
            }).addTo(map);

            L.marker([LAT, LNG]).addTo(map)
                .bindPopup('<strong>' + NAMA + '</strong><br><a href="https://www.google.com/maps?q=' + LAT + ',' + LNG + '" target="_blank" rel="noopener">Buka Rute di Google Maps &rarr;</a>')
                .openPopup();

            map.on('click', function () { map.scrollWheelZoom.enable(); });
            map.on('mouseout', function () { map.scrollWheelZoom.disable(); });

            [300, 1200, 2500].forEach(function (d) { setTimeout(function () { map.invalidateSize(); }, d); });
            window.addEventListener('load', function () { map.invalidateSize(); });
            window.addEventListener('resize', function () { map.invalidateSize(); });
        })();

        // ===== 6. SERVICE WORKER & PWA INSTALL HANDLER =====
        (function () {
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function () {
                    navigator.serviceWorker.register('/sw.js').catch(function () {});
                });
            }

            var deferredPrompt = null;
            var installBtns = [].slice.call(document.querySelectorAll('[data-trigger-pwa-install]'));
            var guideBtn = document.getElementById('btnOpenPwaGuide');
            var modal = document.getElementById('pwaInstallModal');
            var closeBtn = document.getElementById('btnClosePwaModal');
            var tabBtns = [].slice.call(document.querySelectorAll('[data-pwa-tab]'));

            window.addEventListener('beforeinstallprompt', function (e) {
                e.preventDefault();
                deferredPrompt = e;
            });

            function openGuideModal() {
                if (!modal) return;
                // Otomatis pilih tab sesuai perangkat pengguna
                var ua = navigator.userAgent || '';
                var defaultTab = 'android';
                if (/iPad|iPhone|iPod/.test(ua)) {
                    defaultTab = 'ios';
                } else if (!/Android|Mobile/i.test(ua)) {
                    defaultTab = 'desktop';
                }
                switchGuideTab(defaultTab);
                modal.hidden = false;
                document.body.classList.add('mobile-nav-locked');
            }

            function closeGuideModal() {
                if (!modal) return;
                modal.hidden = true;
                document.body.classList.remove('mobile-nav-locked');
            }

            function switchGuideTab(tabName) {
                tabBtns.forEach(function (b) {
                    b.classList.toggle('active', b.getAttribute('data-pwa-tab') === tabName);
                });
                ['android', 'ios', 'desktop'].forEach(function (name) {
                    var panel = document.getElementById('pwa-panel-' + name);
                    if (panel) panel.classList.toggle('active', name === tabName);
                });
            }

            installBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    if (deferredPrompt) {
                        deferredPrompt.prompt();
                        deferredPrompt.userChoice.then(function () {
                            deferredPrompt = null;
                        });
                    } else {
                        openGuideModal();
                    }
                });
            });

            if (guideBtn) guideBtn.addEventListener('click', openGuideModal);
            if (closeBtn) closeBtn.addEventListener('click', closeGuideModal);
            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeGuideModal();
                });
            }
            tabBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    switchGuideTab(btn.getAttribute('data-pwa-tab'));
                });
            });
            document.addEventListener('keydown', function (e) {
                if (modal && !modal.hidden && e.key === 'Escape') closeGuideModal();
            });
        })();
    </script>
</body>
</html>

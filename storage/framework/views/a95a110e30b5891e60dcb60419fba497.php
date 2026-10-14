<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil Resmi - Madrasah / Sekolah Unggulan</title>
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <!-- FontAwesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="<?php echo e(asset('css/profile_sekolah.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <!-- 1. NAVBAR & HEADER -->
    <header class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="logo">
                <i class="fa-solid fa-graduation-cap"></i>
                <span>Madrasah Unggulan Al-Ihsan</span>
            </a>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <div class="nav-menu-wrapper" id="navMenuWrapper">
                <nav>
                    <ul class="nav-links">
                        <li><a href="#beranda">Beranda</a></li>
                        <li class="has-dropdown" id="dropdownProfile">
                            <button class="dropdown-toggle" aria-expanded="false">
                                Profil <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#tentang">Tentang Sekolah</a></li>
                                <li><a href="#sejarah">Sejarah Sekolah</a></li>
                                <li><a href="#visimisi">Visi & Misi</a></li>
                                <li><a href="#legalitas">Identitas & Legalitas</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown" id="dropdownCivitas">
                            <button class="dropdown-toggle" aria-expanded="false">
                                Civitas <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#struktur">Struktur Organisasi</a></li>
                                <li><a href="#guru">Guru & Tenaga Kependidikan</a></li>
                            </ul>
                        </li>
                        <li><a href="#fasilitas">Fasilitas</a></li>
                        <li><a href="#kontak">Kontak</a></li>
                    </ul>
                </nav>
                <div class="auth-buttons">
                    <a href="#ppdb" class="btn-started"><i class="fa-solid fa-user-plus"></i> PPDB Online</a>
                </div>
            </div>
        </div>
    </header>

    <!-- 2. HERO SECTION -->
    <section class="hero" id="beranda">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-wrapper">
                <div class="hero-content">
                    <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</p>
                    <span class="hero-name">Selamat Datang di Portal Resmi</span>
                    <h1>Membentuk Generasi <span class="highlight">Unggul, Berkarakter & Islami</span></h1>
                    <p>Lembaga pendidikan terpadu yang memadukan kurikulum nasional dan nilai-nilai keislaman mutakhir untuk mencetak pemimpin masa depan yang cerdas spiritual maupun intelektual.</p>
                    <div class="hero-btns">
                        <a href="#tentang" class="btn-primary">Jelajahi Profil <i class="fa-solid fa-arrow-right"></i></a>
                        <a href="#fasilitas" class="btn-secondary">Lihat Fasilitas</a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1580582932707-520aed937b7b?q=80&w=800&auto=format&fit=crop" alt="Gedung Sekolah" onerror="this.src='https://placehold.co/400x500/0f3822/d4af37?text=Madrasah'">
                </div>
            </div>
        </div>
    </section>

    <!-- STATISTIK -->
    <section class="statistik">
        <div class="container">
            <div class="stat-grid">
                <div class="stat-card">
                    <i class="fa-solid fa-user-graduate"></i>
                    <strong>1.250+</strong>
                    <span>Siswa Aktif</span>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <strong>85+</strong>
                    <span>Guru & Staf Ahli</span>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-award"></i>
                    <strong>45+</strong>
                    <span>Prestasi Kejuaraan</span>
                </div>
                <div class="stat-card">
                    <i class="fa-solid fa-building-columns"></i>
                    <strong>30+</strong>
                    <span>Fasilitas Modern</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. TENTANG SEKOLAH & SAMBUTAN -->
    <section class="section alt" id="tentang">
        <div class="container">
            <h2 class="section-title">Sambutan Kepala Sekolah</h2>
            <div class="sambutan-wrapper">
                <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=600&auto=format&fit=crop" alt="Kepala Sekolah" class="sambutan-foto" onerror="this.src='https://placehold.co/300x375/0f3822/d4af37?text=Kepala+Sekolah'">
                <div class="sambutan-isi">
                    <div class="sambutan-nama">
                        <strong>Dr. H. Ahmad Fauzi, M.Pd.I</strong>
                        <span>Kepala Madrasah Al-Ihsan</span>
                    </div>
                    <p>Assalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                    <p>Puji syukur senantiasa kita panjatkan ke hadirat Allah SWT atas limpahan rahmat dan karunia-Nya. Website profil ini hadir sebagai jendela informasi bagi masyarakat luas mengenai eksistensi, program unggulan, serta dedikasi madrasah kami dalam dunia pendidikan.</p>
                    <p>Kami berkomitmen untuk terus meningkatkan mutu pendidikan berbasis karakter, sains, dan teknologi guna menghadapi tantangan zaman global tanpa meninggalkan akar nilai-nilai keagamaan.</p>
                </div>
            </div>

            <div style="margin-top: 80px;" class="keunggulan-wrapper">
                <div class="keunggulan-content">
                    <h2 class="section-title left">Profil Singkat & Keunggulan</h2>
                    <p class="lead-text">Madrasah Al-Ihsan berdiri di atas lahan strategis dengan lingkungan yang asri, kondusif, dan islami. Kami mengintegrasikan kurikulum merdeka dengan pesantren modern.</p>
                    <ul class="check-list">
                        <li><i class="fa-solid fa-circle-check"></i> Program Tahfidz Al-Qur'an 3 Juz Mutqin</li>
                        <li><i class="fa-solid fa-circle-check"></i> Pembelajaran Bilingual (Bahasa Arab & Inggris Aktif)</li>
                        <li><i class="fa-solid fa-circle-check"></i> Laboratorium Komputer & Sains Berstandar Internasional</li>
                        <li><i class="fa-solid fa-circle-check"></i> Ekstrakurikuler Robotika, Panahan, dan Seni Islami</li>
                    </ul>
                </div>
                <div class="keunggulan-img">
                    <img src="https://images.unsplash.com/photo-1509062522246-3755977927d7?q=80&w=800&auto=format&fit=crop" alt="Aktivitas Belajar" onerror="this.src='https://placehold.co/600x400/0f3822/d4af37?text=Aktivitas+Siswa'">
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SEJARAH SEKOLAH -->
    <section class="section" id="sejarah">
        <div class="container">
            <h2 class="section-title">Sejarah Perkembangan Sekolah</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="year">Tahun 2005</span>
                        <h3>Peletakan Batu Pertama</h3>
                        <p>Berawal dari wakaf tanah seluas 1 hektar oleh tokoh masyarakat setempat, yayasan resmi mendirikan gedung kelas sederhana tingkat dasar.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="year">Tahun 2012</span>
                        <h3>Ekspansi Jenjang Menengah</h3>
                        <p>Melihat tingginya animo masyarakat, madrasah memperluas layanan pendidikan dengan membuka tingkat Madrasah Tsanawiyah (MTs) terpadu.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="year">Tahun 2018</span>
                        <h3>Akreditasi Unggul & Modernisasi</h3>
                        <p>Meraih predikat Akreditasi Unggul (A) dari BAN-S/M serta meluncurkan fasilitas digital learning dan laboratorium terpadu.</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <span class="year">Tahun 2024 - Sekarang</span>
                        <h3>Transformasi Madrasah Digital</h3>
                        <p>Menjadi role model sekolah ramah anak berbasis teknologi informasi dan pusat pengembangan kader tahfidz berwawasan global.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. VISI DAN MISI -->
    <section class="section alt" id="visimisi">
        <div class="container">
            <h2 class="section-title">Visi dan Misi Sekolah</h2>
            <div class="visi-misi-grid">
                <div class="vm-card">
                    <h3><i class="fa-solid fa-bullseye"></i> Visi Madrasah</h3>
                    <p>"Terwujudnya lembaga pendidikan Islam yang unggul dalam prestasi, berkarakter qur'ani, menguasai ilmu pengetahuan dan teknologi, serta berwawasan global."</p>
                </div>
                <div class="vm-card">
                    <h3><i class="fa-solid fa-list-check"></i> Misi Madrasah</h3>
                    <ul>
                        <li>Menyelenggarakan pendidikan holistik berbasis nilai-nilai tauhid dan akhlakul karimah.</li>
                        <li>Mengembangkan potensi akademik dan non-akademik peserta didik melalui pembelajaran interaktif.</li>
                        <li>Membudayakan hafalan Al-Qur'an dan kecintaan terhadap literasi sains.</li>
                        <li>Membekali keterampilan teknologi informasi serta kemampuan komunikasi bahasa internasional.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. STRUKTUR ORGANISASI -->
    <section class="section" id="struktur">
        <div class="container">
            <h2 class="section-title">Struktur Organisasi Pimpinan</h2>
            <div class="org-container">
                <div class="org-level-1">
                    <div class="org-card">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=400&auto=format&fit=crop" alt="Ketua Yayasan" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Yayasan'">
                        <h4>Drs. H. M. Zulkarnain</h4>
                        <span>Ketua Yayasan Al-Ihsan</span>
                    </div>
                </div>
                <div style="width: 2px; height: 30px; background: var(--accent);"></div>
                <div class="org-level-grid">
                    <div class="org-card">
                        <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=400&auto=format&fit=crop" alt="Kepala Madrasah" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Kepala'">
                        <h4>Dr. H. Ahmad Fauzi, M.Pd.I</h4>
                        <span>Kepala Madrasah</span>
                    </div>
                    <div class="org-card">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop" alt="Wakur" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Kurikulum'">
                        <h4>Siti Aminah, M.Pd</h4>
                        <span>Wakil Kepala Bid. Kurikulum</span>
                    </div>
                    <div class="org-card">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop" alt="Kesiswaan" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Kesiswaan'">
                        <h4>Ust. M. Ridwan, S.Pd</h4>
                        <span>Wakil Kepala Bid. Kesiswaan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. GURU DAN TENAGA KEPENDIDIKAN -->
    <section class="section alt" id="guru">
        <div class="container">
            <h2 class="section-title">Guru & Tenaga Kependidikan</h2>
            
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="agama">Pendidikan Agama</button>
                <button class="filter-btn" data-filter="sains">Sains & Matematika</button>
                <button class="filter-btn" data-filter="bahasa">Bahasa</button>
            </div>

            <div class="direktori-grid" id="direktoriGrid">
                <div class="direktori-card" data-category="agama">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400&auto=format&fit=crop" alt="Guru" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Guru'">
                    <h3>Ust. H. Ibrahim, Lc.</h3>
                    <span class="jabatan">Guru Pembina Tahfidz</span>
                    <span class="bidang">Al-Qur'an & Hadist</span>
                </div>
                <div class="direktori-card" data-category="sains">
                    <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?q=80&w=400&auto=format&fit=crop" alt="Guru" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Guru'">
                    <h3>Dewi Lestari, S.Si</h3>
                    <span class="jabatan">Guru Mata Pelajaran</span>
                    <span class="bidang">Fisika & Biologi</span>
                </div>
                <div class="direktori-card" data-category="bahasa">
                    <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400&auto=format&fit=crop" alt="Guru" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Guru'">
                    <h3>Rahmat Hidayat, M.Pd</h3>
                    <span class="jabatan">Guru Bahasa Asing</span>
                    <span class="bidang">Bahasa Inggris & Arab</span>
                </div>
                <div class="direktori-card" data-category="sains">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=400&auto=format&fit=crop" alt="Guru" onerror="this.src='https://placehold.co/150x150/0f3822/d4af37?text=Guru'">
                    <h3>Nurul Hidayah, M.Sc</h3>
                    <span class="jabatan">Guru Matematika</span>
                    <span class="bidang">Matematika Lanjut</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. FASILITAS SEKOLAH -->
    <section class="section" id="fasilitas">
        <div class="container">
            <h2 class="section-title">Fasilitas Sekolah</h2>
            <div class="fasilitas-grid">
                <div class="fasilitas-card">
                    <div class="fasilitas-img">
                        <img src="https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=600&auto=format&fit=crop" alt="Laboratorium Komputer" onerror="this.src='https://placehold.co/400x250/0f3822/d4af37?text=Lab+Komputer'">
                    </div>
                    <h3>Laboratorium Komputer</h3>
                    <p>Dilengkapi perangkat PC spesifikasi tinggi dan akses internet berkecepatan tinggi untuk praktikum informatika.</p>
                </div>
                <div class="fasilitas-card">
                    <div class="fasilitas-img">
                        <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=600&auto=format&fit=crop" alt="Perpustakaan" onerror="this.src='https://placehold.co/400x250/0f3822/d4af37?text=Perpustakaan'">
                    </div>
                    <h3>Perpustakaan Digital & Buku</h3>
                    <p>Ribuan koleksi buku fisik literatur umum & keagamaan serta e-library terintegrasi untuk kenyamanan membaca siswa.</p>
                </div>
                <div class="fasilitas-card">
                    <div class="fasilitas-img">
                        <img src="https://images.unsplash.com/photo-1519452635265-7b1fbfd1e4e0?q=80&w=600&auto=format&fit=crop" alt="Masjid Kampus" onerror="this.src='https://placehold.co/400x250/0f3822/d4af37?text=Masjid'">
                    </div>
                    <h3>Masjid Ulul Albab</h3>
                    <p>Pusat kegiatan ibadah harian, shalat berjamaah, tahsin, dan kajian keislaman rutin siswa dan guru.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. IDENTITAS & LEGALITAS SEKOLAH -->
    <section class="section alt" id="legalitas">
        <div class="container">
            <h2 class="section-title">Identitas & Legalitas Sekolah</h2>
            <div class="legalitas-container">
                <table class="legalitas-table">
                    <tr>
                        <th>Nama Sekolah</th>
                        <td>Madrasah Al-Ihsan Terpadu</td>
                    </tr>
                    <tr>
                        <th>NPSN / NSM</th>
                        <td>69981234 / 121231710001</td>
                    </tr>
                    <tr>
                        <th>Akreditasi</th>
                        <td>A (Unggul) - SK BAN-S/M No. 145/SK/BAN-M/XI/2018</td>
                    </tr>
                    <tr>
                        <th>Kurikulum</th>
                        <td>Kurikulum Merdeka & Kurikulum Pesantren Terpadu</td>
                    </tr>
                    <tr>
                        <th>Alamat Lengkap</th>
                        <td>Jl. Pendidikan Islam No. 45, Kel. Sukamaju, Kec. Kembangan, Kota Metropolitan</td>
                    </tr>
                    <tr>
                        <th>Nomor SK Pendirian</th>
                        <td>SK Menteri Agama RI No. 452 Tahun 2005</td>
                    </tr>
                    <tr>
                        <th>Email Resmi</th>
                        <td>info@madrasahalihsan.sch.id</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <!-- KONTAK & MAPS -->
    <section class="section" id="kontak">
        <div class="container">
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="kontak-grid">
                <div class="kontak-info">
                    <ul>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <div>
                                <strong>Alamat Kampus</strong>
                                <span>Jl. Pendidikan Islam No. 45, Kembangan, Kota Metropolitan</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <div>
                                <strong>Telepon / WhatsApp</strong>
                                <span>+62 812-3456-7890</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <div>
                                <strong>Email Resmi</strong>
                                <span>info@madrasahalihsan.sch.id</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa-solid fa-clock"></i>
                            <div>
                                <strong>Jam Operasional</strong>
                                <span>Senin - Jumat: 07.00 - 16.00 WIB</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="kontak-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.295175953046!2d106.824964!3d-6.200000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDknMjkuOSJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-logo">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Madrasah Al-Ihsan</span>
                    </div>
                    <p>Membentuk generasi cerdas, berakhlak mulia, dan siap menghadapi tantangan global dengan landasan keimanan yang kokoh.</p>
                    <div class="sosmed">
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="Youtube"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" aria-label="Whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
                <div>
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#tentang">Tentang Sekolah</a></li>
                        <li><a href="#sejarah">Sejarah</a></li>
                        <li><a href="#visimisi">Visi Misi</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Civitas & Fasilitas</h4>
                    <ul>
                        <li><a href="#struktur">Struktur Organisasi</a></li>
                        <li><a href="#guru">Direktori Guru</a></li>
                        <li><a href="#fasilitas">Fasilitas Utama</a></li>
                        <li><a href="#legalitas">Legalitas Resmi</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Pendaftaran</h4>
                    <ul>
                        <li><a href="#ppdb">PPDB Online 2026/2027</a></li>
                        <li><a href="#kontak">Brosur & Panduan</a></li>
                        <li><a href="#kontak">Konsultasi Beasiswa</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Madrasah Al-Ihsan. Hak Cipta Dilindungi Undang-Undang.</p>
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const menuToggle = document.getElementById('menuToggle');
            const navbar = document.getElementById('navbar');
            
            if (menuToggle) {
                menuToggle.addEventListener('click', () => {
                    menuToggle.classList.toggle('active');
                    navbar.classList.toggle('mobile-nav-open');
                    document.body.classList.toggle('mobile-nav-locked');
                });
            }

            // Dropdown Accordion for Mobile & Desktop
            const dropdowns = document.querySelectorAll('.has-dropdown');
            dropdowns.forEach(drop => {
                const toggleBtn = drop.querySelector('.dropdown-toggle');
                toggleBtn.addEventListener('click', (e) => {
                    if (window.innerWidth <= 1240) {
                        e.preventDefault();
                        drop.classList.toggle('open');
                        const expanded = drop.classList.contains('open');
                        toggleBtn.setAttribute('aria-expanded', expanded);
                    }
                });
            });

            // Close mobile menu on link click
            document.querySelectorAll('.nav-links a:not(.dropdown-toggle)').forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth <= 1240) {
                        menuToggle.classList.remove('active');
                        navbar.classList.remove('mobile-nav-open');
                        document.body.classList.remove('mobile-nav-locked');
                        dropdowns.forEach(d => d.classList.remove('open'));
                    }
                });
            });

            // Filter Guru & Tenaga Kependidikan
            const filterBtns = document.querySelectorAll('.filter-btn');
            const direktoriCards = document.querySelectorAll('.direktori-card');

            filterBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    filterBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const filterValue = btn.getAttribute('data-filter');

                    direktoriCards.forEach(card => {
                        if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/profile_sekolah.blade.php ENDPATH**/ ?>
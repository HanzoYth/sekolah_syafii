<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <title>Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts: Poppins & Amiri -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}?v={{ filemtime(public_path('css/welcome.css')) }}">
</head>
<body>

    <!-- ======== NAVBAR ======== -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="logo">
                <img src="{{asset('img/logo.png')}}" alt="">
                <span>Imam Syafi'i</span>
            </a>
            <ul class="nav-links">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#program">Program</a></li>
                <li><a href="#keunggulan">Keunggulan</a></li>
            </ul>
            <div class="auth-buttons">
                <a class="btn-started" id="openSignup" href="/reg">Mulai</a>
            </div>
            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" id="mobile-menu" type="button"
                aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="navbar">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </nav>

    <!-- ======== HERO SECTION ======== -->
<section id="home" class="hero" style="--hero-bg: url('{{ asset('img/foto_1.jpeg') }}');">
    <div class="container">
        <!-- TAMBAHKAN CLASS hero-wrapper DI SINI -->
        <div class="hero-wrapper">
            
            <!-- Kiri: Teks -->
            <div class="hero-content" data-aos="fade-right" data-aos-duration="1000">
                <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h1>Mencetak Generasi Rabbani Berakhlak<span class="highlight">Al-Qur'an</span></h1>
                <p>Pendidikan Al-Qur'an terpadu dengan metode modern untuk mendidik generasi yang mencintai dan mengamalkan Al-Qur'an sesuai pemahaman salafus shalih.</p>
                <div class="hero-btns">
                    <a href="#program" class="btn-primary">Pelajari Program</a>
                    <a href="/reg" class="btn-secondary">Daftar Sekarang</a>
                </div>
            </div>

            <!-- Kanan: Foto -->
            <div class="hero-image" data-aos="fade-left" data-aos-duration="1000">
                <img src="{{asset('img/foto_2.jpeg')}}" alt="Hero Image">
            </div>

        </div> <!-- Akhir dari hero-wrapper -->
    </div>
    <div class="hero-overlay"></div>
</section>

    <!-- ======== PROGRAM SECTION ======== -->
    <section id="program" class="program">
        <div class="container">
            <h2 class="section-title" data-aos="fade-up">Program Unggulan</h2>
            <div class="program-grid">
                <!-- Card 1 -->
                <div class="program-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fa-solid fa-book-open-reader icon-card"></i>
                    <h3>Tahfizhul Qur'an</h3>
                    <p>Program menghafal Al-Qur'an 30 juz dengan target mutqin dan tajwid yang benar.</p>
                </div>
                <!-- Card 2 -->
                <div class="program-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fa-solid fa-graduation-cap icon-card"></i>
                    <h3>Madrasah Diniyah</h3>
                    <p>Pembelajaran ilmu syar'i dasar (Aqidah, Fiqih, Adab) sesuai pemahaman Imam Syafi'i.</p>
                </div>
                <!-- Card 3 -->
                <div class="program-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fa-solid fa-language icon-card"></i>
                    <h3>Bahasa Arab</h3>
                    <p>Kuasai bahasa Al-Qur'an aktif dan pasif untuk memahami wahyu lebih dalam.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== KEUNGGULAN SECTION ======== -->
    <section id="keunggulan" class="keunggulan">
        <div class="container">
            <div class="keunggulan-wrapper">
                <div class="keunggulan-img" data-aos="fade-right">
                    <img src="{{asset('img/foto_1.jpeg')}}" alt="Mengaji">
                </div>
                <div class="keunggulan-content" data-aos="fade-left">
                    <h2 class="section-title left">Mengapa Memilih Kami?</h2>
                    <ul>
                        <li><i class="fa-solid fa-check-circle"></i> Pengajar Bersanad & Kompeten</li>
                        <li><i class="fa-solid fa-check-circle"></i> Metode Pembelajaran Modern & Efektif</li>
                        <li><i class="fa-solid fa-check-circle"></i> Lingkungan Islami & Kondusif</li>
                        <li><i class="fa-solid fa-check-circle"></i> Fasilitas Lengkap & Nyaman</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ======== FOOTER ======== -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Sekolah Al-Qur'an Imam Syafi'i. All rights reserved.</p>
        </div>
    </footer>

    <!-- ======== SCRIPTS ======== -->
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // 1. Inisialisasi AOS Animation
        AOS.init({
            once: true,
        });

        // FIX BARU (v2 - lebih agresif): sebagian browser/WebView Android salah
        // hitung lebar viewport saat pertama kali halaman dimuat, dan baru benar
        // setelah ada "reflow" (itu sebabnya kalau discroll manual baru rapi).
        // Dulu fix ini cuma dipasang di window.load (baru jalan setelah SEMUA
        // gambar termasuk foto hero yg besar selesai didownload -> telat).
        // Sekarang dipasang lebih awal (langsung + beberapa kali di awal) supaya
        // bug-nya ketutup sebelum sempat kelihatan oleh user.
        function forceViewportReflow() {
            // FIX BARU (v3): paksa browser membaca ULANG meta viewport-nya.
            // Ini menyasar bug "zoom nyangkut dari kunjungan/reload sebelumnya"
            // di Chrome Android, yang membuat halaman terlihat menyempit sesaat
            // sampai ada interaksi. Caranya: utak-atik sedikit atribut content
            // meta viewport, browser akan mereset skala zoom-nya ke normal.
            var viewportMeta = document.querySelector('meta[name="viewport"]');
            if (viewportMeta) {
                var original = viewportMeta.getAttribute('content');
                viewportMeta.setAttribute('content', original + ', shrink-to-fit=no');
                setTimeout(function () {
                    viewportMeta.setAttribute('content', original);
                }, 50);
            }
            window.scrollTo(0, 1);
            requestAnimationFrame(function () {
                window.scrollTo(0, 0);
                window.dispatchEvent(new Event('resize'));
                window.dispatchEvent(new Event('orientationchange'));
            });
        }
        // Jalankan langsung begitu script ini dieksekusi (paling awal)
        forceViewportReflow();
        // Jalankan lagi beberapa kali di detik-detik pertama (jaga-jaga kalau
        // browser baru selesai menghitung ulang viewport-nya belakangan)
        [0, 100, 300, 600, 1000, 2000].forEach(function (delay) {
            setTimeout(forceViewportReflow, delay);
        });
        // Dan tetap jalankan sekali lagi saat semua resource (gambar dll) selesai
        window.addEventListener('load', forceViewportReflow);

        // 2. Toggle dropdown menu mobile (hamburger)
        (function () {
            var navbar = document.getElementById('navbar');
            var toggleBtn = document.getElementById('mobile-menu');
            if (!navbar || !toggleBtn) return;

            function closeMobileNav() {
                navbar.classList.remove('mobile-nav-open');
                toggleBtn.classList.remove('active');
                toggleBtn.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('mobile-nav-locked');
            }

            function toggleMobileNav() {
                var isOpen = navbar.classList.toggle('mobile-nav-open');
                toggleBtn.classList.toggle('active', isOpen);
                toggleBtn.setAttribute('aria-expanded', String(isOpen));
                document.body.classList.toggle('mobile-nav-locked', isOpen);
            }

            toggleBtn.addEventListener('click', toggleMobileNav);

            // Tutup menu otomatis saat salah satu link/tombol diklik
            navbar.querySelectorAll('.nav-links a, .auth-buttons a').forEach(function (link) {
                link.addEventListener('click', closeMobileNav);
            });

            // Reset saat resize kembali ke layar besar
            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) {
                    closeMobileNav();
                }
            });
        })();
    </script>
</body>
</html>
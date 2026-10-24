<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <title><?php echo $__env->yieldContent('title', "Sekolah Islam Al-Qur'an Imam Syafi'i"); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', "Pendidikan Al-Qur'an terpadu dengan metode modern untuk mencetak generasi rabbani berakhlak Al-Qur'an sesuai pemahaman salafus shalih."); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/welcome.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <!-- Indikator Progress Scroll di Atas Layar -->
    <div class="scroll-progress-bar" id="scrollProgressBar" aria-hidden="true"></div>

    <!-- ======== NAVBAR UTAMA ======== -->
    <nav class="navbar" id="navbar" aria-label="Navigasi utama">
        <div class="container">
            <a href="/" class="logo">
                <img src="<?php echo e(asset('img/logo.png')); ?>?v=<?php echo e(time()); ?>" alt="Logo Sekolah Islam Al-Qur'an Imam Syafi'i">
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
                    <li><a href="/" class="<?php echo e(($activePage ?? '') === 'beranda' ? 'active' : ''); ?>">Beranda</a></li>
                    <li><a href="/prof?halaman=profil" class="<?php echo e(($activePage ?? '') === 'profil' ? 'active' : ''); ?>">Profil</a></li>
                    <li><a href="/prof?halaman=program" class="<?php echo e(($activePage ?? '') === 'program' ? 'active' : ''); ?>">Pendidikan & Program</a></li>
                    <li><a href="/prof?halaman=galeri" class="<?php echo e(($activePage ?? '') === 'galeri' ? 'active' : ''); ?>">Galeri & Kegiatan</a></li>
                    <li><a href="/prof?halaman=ppdb" class="<?php echo e(($activePage ?? '') === 'ppdb' ? 'active' : ''); ?>">PPDB</a></li>
                    <li><a href="/prof?halaman=kontak" class="<?php echo e(($activePage ?? '') === 'kontak' ? 'active' : ''); ?>">Kontak</a></li>
                </ul>
                <div class="auth-buttons">
                    <a class="btn-started" id="openSignup" href="/reg">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ======== PARALLAX SUB-HERO HEADER ======== -->
    <header id="home" class="page-hero parallax-section" style="--hero-bg: url('<?php echo $__env->yieldContent('hero_bg', asset('img/bg_skl.jpeg')); ?>');">
        <!-- Layer 1: Parallax Background -->
        <div class="hero-bg-parallax" data-parallax-hero="0.36"></div>

        <!-- Layer 2: Vignette, Particles & Drifting Islamic Star Pattern -->
        <div class="hero-overlay" id="heroParticles"></div>
        <div class="hero-pattern-parallax" data-parallax-hero="0.22" data-mouse-speed="14"></div>

        <!-- Layer 3: Konten Header Halaman -->
        <div class="container">
            <div class="page-hero-content" data-parallax-hero="-0.08" data-aos="fade-up">
                <nav class="page-breadcrumb" aria-label="Breadcrumb">
                    <a href="/"><i class="fa-solid fa-house"></i> Beranda</a>
                    <span class="sep"><i class="fa-solid fa-chevron-right"></i></span>
                    <span><?php echo $__env->yieldContent('breadcrumb', 'Halaman'); ?></span>
                </nav>

                <div>
                    <span class="section-eyebrow light">
                        <i class="<?php echo $__env->yieldContent('eyebrow_icon', 'fa-solid fa-mosque'); ?>"></i>
                        <?php echo $__env->yieldContent('eyebrow_text', "Sekolah Islam Al-Qur'an Imam Syafi'i"); ?>
                    </span>
                </div>

                <h1><?php echo $__env->yieldContent('hero_title'); ?></h1>
                <p><?php echo $__env->yieldContent('hero_desc'); ?></p>

                <div class="hero-btns" style="justify-content: center; margin-top: 26px; margin-bottom: 0;">
                    <a href="/reg" class="btn-started">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Sistem
                    </a>
                    <?php echo $__env->yieldContent('hero_actions'); ?>
                </div>
            </div>
        </div>

        <!-- Ornamental Curve Divider -->
        <div class="hero-wave-divider">
            <svg viewBox="0 0 1440 80" preserveAspectRatio="none" fill="<?php echo $__env->yieldContent('wave_color', '#f3f6f1'); ?>">
                <path d="M0,32 C320,90 560,0 720,42 C880,84 1120,10 1440,36 L1440,80 L0,80 Z"></path>
            </svg>
        </div>
    </header>

    <!-- ======== KONTEN UTAMA HALAMAN ======== -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- ======== FOOTER ======== -->
    <footer class="footer">
        <div class="parallax-ornament-layer" style="opacity: 0.08;"></div>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <img src="<?php echo e(asset('img/logo.png')); ?>?v=<?php echo e(time()); ?>" alt="Logo Sekolah">
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
                        <li><a href="/prof?halaman=profil">Profil & Fasilitas</a></li>
                        <li><a href="/prof?halaman=program">Pendidikan & Program</a></li>
                        <li><a href="/prof?halaman=galeri">Galeri & Kegiatan</a></li>
                        <li><a href="/prof?halaman=ppdb">Informasi PPDB</a></li>
                        <li><a href="/prof?halaman=kontak">Lokasi & Kontak</a></li>
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
                        <li><a href="/prof?halaman=ppdb"><i class="fa-solid fa-user-plus"></i> Panduan Pendaftaran</a></li>
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

                if (progressBar && docHeight > 0) {
                    progressBar.style.width = Math.min(100, Math.max(0, (scrollY / docHeight) * 100)) + '%';
                }

                if (navbar) {
                    navbar.classList.toggle('scrolled', scrollY > 40);
                }

                // A. Hero multi-layer parallax
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
        })();

        // ===== 2. PARTIKEL CAHAYA EMAS DI HERO =====
        (function () {
            var overlay = document.getElementById('heroParticles');
            if (!overlay) return;
            for (var i = 0; i < 16; i++) {
                var p = document.createElement('span');
                p.className = 'particle';
                var size = Math.random() * 5 + 2;
                p.style.width = size + 'px';
                p.style.height = size + 'px';
                p.style.left = (Math.random() * 100) + '%';
                p.style.animationDuration = (Math.random() * 14 + 12) + 's';
                p.style.animationDelay = (-Math.random() * 20).toFixed(1) + 's';
                p.setAttribute('aria-hidden', 'true');
                overlay.appendChild(p);
            }
        })();

        // ===== 3. NAVBAR MOBILE =====
        (function () {
            var NAV_BREAKPOINT = 1080;
            var navbar = document.getElementById('navbar');
            var toggleBtn = document.getElementById('mobile-menu');

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

        // ===== 5. PETA INTERAKTIF LEAFLET (JIKA ADA #map DI HALAMAN) =====
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
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/layouts/public.blade.php ENDPATH**/ ?>
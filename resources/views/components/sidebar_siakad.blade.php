<div>
    <!-- SIDEBAR COMPONENT -->

    <!-- TOMBOL HAMBURGER (hanya tampil di mobile, via CSS) -->
    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- OVERLAY GELAP SAAT SIDEBAR TERBUKA DI MOBILE -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        {{-- CSS khusus siakad --}}
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_siakad.css') }}?v={{ time() }}">

        {{-- Header sidebar --}}
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>SIAKAD</span>
            </div>
        </div>

        <div class="sidebar-menu-wrapper">
            {{-- Dashboard: umum untuk semua role --}}
            <div class="menu-section" id="section-umum">
                <ul class="menu-list">
                    <li class="menu-item active">
                        @if (session('role') == "a")
                            <a href="/sk/das">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif (session('role') == "g")
                            <a href="/sk/dg">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        @elseif (session('role') == "s")
                            <a href="/sk/dbs">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        @endif
                    </li>
                </ul>
            </div>

            {{-- ================= ROLE ADMIN ================= --}}
            @if (session('role') === 'a')
                <div class="menu-section" id="section-admin">
                    <span class="menu-label">ADMINISTRATOR</span>
                    <ul class="menu-list">
                        {{-- Dropdown Submenu Pembayaran --}}
                        <li class="menu-item">
                            <details class="submenu-wrapper">
                                <summary class="menu-link">
                                    <div class="menu-link-content">
                                        <i class="fa-solid fa-file-invoice-dollar"></i>
                                        <span>Pembayaran</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down submenu-icon"></i>
                                </summary>
                                <ul class="submenu-list">
                                    <li class="submenu-item">
                                        <a href="/sk/bt">
                                            <i class="fa-solid fa-file-circle-plus"></i>
                                            <span>Buat Tagihan</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/sk/pb">
                                            <i class="fa-solid fa-wallet"></i>
                                            <span>Pembayaran IPP</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/sk/pp">
                                            <i class="fa-solid fa-piggy-bank"></i>
                                            <span>Pembayaran Pangkal</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/sk/pd">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                            <span>Pembayaran pendidikan</span>
                                        </a>
                                    </li>
                                     <li class="submenu-item">
                                         <a href="/sk/ppl">
                                             <i class="fa-solid fa-wrench"></i>
                                           <span>Pembayaran pemeliharaan</span>
                                         </a>
                                    </li>
                                </ul>
                            </details>
                        </li>

                        <li class="menu-item">
                            <a href="/sk/ds">
                                <i class="fa-solid fa-id-card"></i>
                                <span>Daftar Siswa</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/sk/tk">
                                <i class="fa-solid fa-door-open"></i>
                                <span>tambah kelas</span>
                            </a>
                        </li>
                    </ul>
                </div>

            {{-- ================= ROLE GURU ================= --}}
            @elseif (session('role') === 'g')
                <div class="menu-section" id="section-guru">
                    <span class="menu-label">MENU GURU</span>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="/sk/pb">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <span>Slip Pembayaran</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/sk/pr">
                                <i class="fa-solid fa-id-card"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href='/sk/ass'>
                                <i class="fa-solid fa-id-card"></i>
                                <span>absenSiswa</span>
                            </a>
                        </li>
                    </ul>
                </div>

            {{-- ================= ROLE SISWA ================= --}}
            @elseif (session('role') === 's')
                <div class="menu-section" id="section-siswa">
                    <span class="menu-label">MENU SISWA</span>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="/sk/pbs">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <span>Slip Pembayaran</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/sk/pfs">
                                <i class="fa-solid fa-id-card"></i>
                                <span>Profil</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/sk/ps">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

        <div class="sidebar-footer">
            <a href="/mod" class="logout-btn" style="margin-bottom:10px;">
                <i class="fas fa-cubes"></i>
                <span>Modul</span>
            </a>
            <a href="/reg/logout" class="logout-btn">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span>Keluar</span>
            </a>
        </div>
    </aside>
</div>

<script>
(function () {
    var sidebar     = document.getElementById('sidebar');
    var hamburger   = document.getElementById('mobile-hamburger-btn');
    var overlay     = document.getElementById('sidebar-overlay');

    if (!sidebar) return;

    var MOBILE_BREAKPOINT = 768;

    function isMobile() {
        return window.innerWidth <= MOBILE_BREAKPOINT;
    }

    function openMobileSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    function toggleMobileSidebar() {
        if (sidebar.classList.contains('open')) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    }

    if (hamburger) {
        hamburger.addEventListener('click', toggleMobileSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', closeMobileSidebar);
    }

    sidebar.querySelectorAll('.menu-item > a, .submenu-item > a, .logout-btn').forEach(function (link) {
        link.addEventListener('click', function () {
            if (isMobile()) {
                closeMobileSidebar();
            }
        });
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeMobileSidebar();
        }
    });

    window.addEventListener('resize', function () {
        if (!isMobile()) {
            closeMobileSidebar();
        }
    });
})();
</script>

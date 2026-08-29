<div>
    <!-- SIDEBAR COMPONENT -->

    <!-- TOMBOL HAMBURGER (hanya tampil di mobile, via CSS) -->
    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- OVERLAY GELAP SAAT SIDEBAR TERBUKA DI MOBILE -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_guru.css') }}">
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>EduHRIS</span>
            </div>
            <button class="toggle-btn" id="sidebar-toggle" aria-label="Ciutkan sidebar">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </div>
        @php
            $route = $_SERVER['REQUEST_URI'];
            
            // Helper untuk mengecek submenu aktif
            $isMasterDataActive = in_array($route, ['/gr/cb', '/gr/klgr', '/gr/klab', '/gr/klgjgr', '/gr/tgm']);
            $isLaporanActive    = in_array($route, ['/gr/lpabs', '/gr/apgjgr']);
        @endphp
        <div class="sidebar-menu-wrapper">
            <!-- ================= MENU GURU ================= -->
            @if(session('role') == "g")
                <div class="menu-section" id="section-guru">
                    <span class="menu-label">MODUL GURU</span>
                    <ul class="menu-list">
                        <li class="menu-item {{$route == '/gr/das' ? 'active' : ''}}">
                            <a href="/gr/das">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item {{$route == '/gr/abs' ? 'active' : ''}}">
                            <a href="/gr/abs">
                                <i class="fa-solid fa-user-check"></i>
                                <span>Absensi Presensi</span>
                            </a>
                        </li>
                        <li class="menu-item {{$route == '/gr/pgjgr' ? 'active' : ''}}">
                            <a href="/gr/pgjgr">
                                <i class="fa-solid fa-file-signature"></i>
                                <span>Pengajuan Izin/Cuti</span>
                            </a>
                        </li>
                        <li class="menu-item {{$route == '/gr/slpgjgr' ? 'active' : ''}}">
                            <a href="/gr/slpgjgr">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <span>Slip Gaji</span>
                            </a>
                        </li>
                        <li class="menu-item {{$route == '/gr/pggr' ? 'active' : ''}}">
                            <a href="/gr/pggr">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                        <li class="menu-item {{$route == '/gr/edprgr' ? 'active' : ''}}">
                            <a href="/gr/edprgr">
                                <i class="fa-solid fa-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @elseif (session('role') == "a")
                <!-- ================= MENU ADMIN GURU ================= -->
                <div class="menu-section" id="section-admin">
                    <span class="menu-label">ADMINISTRATOR HR</span>
                    <ul class="menu-list">
                        <li class="menu-item {{$route == '/gr/dasa' ? 'active' : ''}}">
                            <a href="/gr/dasa">
                                <i class="fa-solid fa-chart-line"></i>
                                <span>Dashboard Admin</span>
                            </a>
                        </li>

                        <!-- SUBMENU MASTER DATA -->
                        <li class="menu-item has-submenu {{$isMasterDataActive ? 'active' : ''}}">
                            <details class="submenu-wrapper" {{$isMasterDataActive ? 'open' : ''}}>
                                <summary class="menu-link">
                                    <div class="menu-link-content">
                                        <i class="fa-solid fa-database"></i>
                                        <span>Master Data</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down submenu-icon"></i>
                                </summary>
                                <ul class="submenu-list">
                                    <li class="submenu-item {{$route == '/gr/cb' ? 'active' : ''}}">
                                        <a href="/gr/cb">
                                            <i class="fa-solid fa-school"></i>
                                            <span>Cabang Sekolah</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item {{$route == '/gr/klgr' ? 'active' : ''}}">
                                        <a href="/gr/klgr">
                                            <i class="fa-solid fa-users-gear"></i>
                                            <span>Kelola Data Guru</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item {{$route == '/gr/klab' ? 'active' : ''}}">
                                        <a href="/gr/klab">
                                            <i class="fa-solid fa-clipboard-user"></i>
                                            <span>Kelola Absen Guru</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item {{$route == '/gr/klgjgr' ? 'active' : ''}}">
                                        <a href="/gr/klgjgr">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                            <span>Gaji</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item {{$route == '/gr/tgm' ? 'active' : ''}}">
                                        <a href="/gr/tgm">
                                            <i class="fa-solid fa-calendar-day"></i>
                                            <span>Tanggal Merah</span>
                                        </a>
                                    </li>
                                </ul>
                            </details>
                        </li>

                        <!-- MENU LAPORAN HR DENGAN SUBMENU -->
                        <li class="menu-item has-submenu {{$isLaporanActive ? 'active' : ''}}">
                            <details class="submenu-wrapper" {{$isLaporanActive ? 'open' : ''}}>
                                <summary class="menu-link">
                                    <div class="menu-link-content">
                                        <i class="fa-solid fa-file-lines"></i>
                                        <span>Laporan HR</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down submenu-icon"></i>
                                </summary>
                                <ul class="submenu-list">
                                    <li class="submenu-item {{$route == '/gr/lpabs' ? 'active' : ''}}">
                                        <a href="/gr/lpabs">
                                            <i class="fa-solid fa-clipboard-user"></i>
                                            <span>Laporan Absen</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item {{$route == '/gr/apgjgr' ? 'active' : ''}}">
                                        <a href="/gr/apgjgr">
                                            <i class="fa-solid fa-file-circle-check"></i>
                                            <span>Laporan Pengajuan</span>
                                        </a>
                                    </li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </div>
            @endif
        </div>

        <div class="sidebar-footer">
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
    var collapseBtn = document.getElementById('sidebar-toggle');

    if (!sidebar) return;

    var MOBILE_BREAKPOINT = 768;

    function isMobile() {
        return window.innerWidth <= MOBILE_BREAKPOINT;
    }

    // ===== Mobile: buka/tutup via hamburger + overlay =====
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

    // Tutup sidebar mobile otomatis saat salah satu menu diklik
    sidebar.querySelectorAll('.menu-item > a, .submenu-item > a, .logout-btn').forEach(function (link) {
        link.addEventListener('click', function () {
            if (isMobile()) {
                closeMobileSidebar();
            }
        });
    });

    // Tutup sidebar mobile dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && sidebar.classList.contains('open')) {
            closeMobileSidebar();
        }
    });

    // ===== Desktop: collapse/expand via tombol panah =====
    if (collapseBtn) {
        collapseBtn.addEventListener('click', function () {
            if (isMobile()) {
                closeMobileSidebar();
                return;
            }
            sidebar.classList.toggle('collapsed');
            localStorage.setItem('sidebar-collapsed', sidebar.classList.contains('collapsed'));
        });

        if (!isMobile() && localStorage.getItem('sidebar-collapsed') === 'true') {
            sidebar.classList.add('collapsed');
        }
    }

    // Reset state saat resize melewati breakpoint
    window.addEventListener('resize', function () {
        if (!isMobile()) {
            closeMobileSidebar();
        }
    });
})();
</script>
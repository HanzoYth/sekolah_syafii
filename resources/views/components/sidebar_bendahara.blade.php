<div>
    <!-- SIDEBAR COMPONENT -->

    <!-- TOMBOL HAMBURGER (hanya tampil di mobile, via CSS) -->
    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- OVERLAY GELAP SAAT SIDEBAR TERBUKA DI MOBILE -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_guru.css') }}?v={{ time() }}">
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>EduHRIS</span>
            </div>
        </div>
        @php
            $route = $_SERVER['REQUEST_URI'];
            
            // Helper untuk mengecek submenu aktif
        @endphp
        <div class="sidebar-menu-wrapper">
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
                </ul>
            </div>
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

    // Reset state saat resize melewati breakpoint
    window.addEventListener('resize', function () {
        if (!isMobile()) {
            closeMobileSidebar();
        }
    });
})();
</script>
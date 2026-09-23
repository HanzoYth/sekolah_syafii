<div>
    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="teacher-sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar teacher-sidebar" id="teacher-sidebar">
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_siakad.css') }}?v={{ time() }}">

        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>SIAKAD</span>
            </div>
            <span class="teacher-sidebar-role">PORTAL GURU</span>
        </div>

        <div class="sidebar-menu-wrapper">
            <div class="menu-section">
                <ul class="menu-list">
                    <li class="menu-item {{ request()->is('sk/dg') ? 'active' : '' }}">
                        <a href="/sk/dg"><i class="fa-solid fa-house"></i><span>Dashboard</span></a>
                    </li>
                </ul>
            </div>

            <div class="menu-section" id="section-guru">
                <span class="menu-label">MENU GURU</span>
                <ul class="menu-list">
                    <li class="menu-item"><a href="#jadwal-mengajar"><i class="fa-solid fa-calendar-week"></i><span>Jadwal Mengajar</span></a></li>
                    <li class="menu-item {{ request()->is('sk/ass') ? 'active' : '' }}"><a href="/sk/ass"><i class="fa-solid fa-clipboard-user"></i><span>Absensi Siswa</span></a></li>
                    <li class="menu-item"><a href="/sk/pb"><i class="fa-solid fa-file-invoice-dollar"></i><span>Slip Pembayaran</span></a></li>
                    <li class="menu-item"><a href="/sk/pr"><i class="fa-solid fa-id-card"></i><span>Profil Saya</span></a></li>
                </ul>
            </div>
        </div>

        <div class="sidebar-footer">
            <a href="/mod" class="logout-btn" style="margin-bottom:10px;"><i class="fas fa-cubes"></i><span>Modul</span></a>
            <a href="/reg/logout" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Keluar</span></a>
        </div>
    </aside>
</div>

<script>
(function () {
    var sidebar = document.getElementById('teacher-sidebar');
    var hamburger = document.getElementById('mobile-hamburger-btn');
    var overlay = document.getElementById('sidebar-overlay');

    if (!sidebar) return;

    function isMobile() { return window.innerWidth <= 768; }
    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', function () {
        var isOpen = sidebar.classList.toggle('open');
        overlay.classList.toggle('active', isOpen);
        hamburger.setAttribute('aria-expanded', String(isOpen));
        document.body.style.overflow = isOpen ? 'hidden' : '';
    });
    if (overlay) overlay.addEventListener('click', closeSidebar);
    sidebar.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () { if (isMobile()) closeSidebar(); });
    });
    window.addEventListener('resize', function () { if (!isMobile()) closeSidebar(); });
})();
</script>

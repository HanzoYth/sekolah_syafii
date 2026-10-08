<div>
    <!-- SIDEBAR TAHFIZ -->

    <!-- TOMBOL HAMBURGER (hanya tampil di mobile, via CSS) -->
    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- OVERLAY GELAP SAAT SIDEBAR TERBUKA DI MOBILE -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_tahfiz.css') }}?v={{ time() }}">

        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-quran"></i>
                <span>Tahfiz Digital</span>
            </div>
        </div>

        @php
            // buang query string supaya ?page=2 dll tidak merusak penanda active
            $route = strtok($_SERVER['REQUEST_URI'], '?');
        @endphp

        <div class="sidebar-menu-wrapper">

            {{-- ================= MENU ADMIN ================= --}}
            @if(session('role') == "a")
                <div class="menu-section" id="section-admin">
                    <span class="menu-label">ADMINISTRATOR</span>
                    <ul class="menu-list">
                        <li class="menu-item {{ $route == '/tf/das' ? 'active' : '' }}">
                            <a href="/tf/das">
                                <i class="fa-solid fa-gauge"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/kls' ? 'active' : '' }}">
                            <a href="/tf/kls">
                                <i class="fa-solid fa-school"></i>
                                <span>Kelas &amp; Halaqah</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/ss' ? 'active' : '' }}">
                            <a href="/tf/ss">
                                <i class="fa-solid fa-users"></i>
                                <span>Siswa</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/pg' ? 'active' : '' }}">
                            <a href="/tf/pg">
                                <i class="fa-solid fa-user-tie"></i>
                                <span>Pengampu</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/lh' ? 'active' : '' }}">
                            <a href="/tf/lh">
                                <i class="fa-solid fa-file-lines"></i>
                                <span>Laporan Harian</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/rm' ? 'active' : '' }}">
                            <a href="/tf/rm">
                                <i class="fa-solid fa-calendar-week"></i>
                                <span>Rekap Mingguan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/rb' ? 'active' : '' }}">
                            <a href="/tf/rb">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Rekap Bulanan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/pgm' ? 'active' : '' }}">
                            <a href="/tf/pgm">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/nt' ? 'active' : '' }}">
                            <a href="/tf/nt">
                                <i class="fa-solid fa-bell"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                    </ul>
                </div>

            {{-- ================= MENU GURU / PENGAMPU ================= --}}
            @elseif(session('role') == "g")
                <div class="menu-section" id="section-guru">
                    <span class="menu-label">MODUL PENGAMPU</span>
                    <ul class="menu-list">
                        <li class="menu-item {{ $route == '/tf/gr/das' ? 'active' : '' }}">
                            <a href="/tf/gr/das">
                                <i class="fa-solid fa-gauge"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/hq' ? 'active' : '' }}">
                            <a href="/tf/gr/hq">
                                <i class="fa-solid fa-people-group"></i>
                                <span>Halaqah Saya</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/ss' ? 'active' : '' }}">
                            <a href="/tf/gr/ss">
                                <i class="fa-solid fa-users"></i>
                                <span>Siswa Binaan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/stor' ? 'active' : '' }}">
                            <a href="/tf/gr/stor">
                                <i class="fa-solid fa-book-open-reader"></i>
                                <span>Input Setoran</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/lh' ? 'active' : '' }}">
                            <a href="/tf/gr/lh">
                                <i class="fa-solid fa-file-lines"></i>
                                <span>Laporan Harian</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/rm' ? 'active' : '' }}">
                            <a href="/tf/gr/rm">
                                <i class="fa-solid fa-calendar-week"></i>
                                <span>Rekap Mingguan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/rb' ? 'active' : '' }}">
                            <a href="/tf/gr/rb">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Rekap Bulanan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/pgm' ? 'active' : '' }}">
                            <a href="/tf/gr/pgm">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/nt' ? 'active' : '' }}">
                            <a href="/tf/gr/nt">
                                <i class="fa-solid fa-bell"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/gr/prf' ? 'active' : '' }}">
                            <a href="/tf/gr/prf">
                                <i class="fa-solid fa-user"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>

            {{-- ================= MENU SISWA ================= --}}
            @elseif(session('role') == "s")
                <div class="menu-section" id="section-siswa">
                    <span class="menu-label">MODUL SISWA</span>
                    <ul class="menu-list">
                        <li class="menu-item {{ $route == '/tf/sw/dass' ? 'active' : '' }}">
                            <a href="/tf/sw/dass">
                                <i class="fa-solid fa-gauge"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/hgh' ? 'active' : '' }}">
                            <a href="/tf/sw/pgh">
                                <i class="fa-solid fa-book-quran"></i>
                                <span>Progres Hafalan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/lh' ? 'active' : '' }}">
                            <a href="/tf/sw/lh">
                                <i class="fa-solid fa-file-lines"></i>
                                <span>Laporan Harian</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/rm' ? 'active' : '' }}">
                            <a href="/tf/sw/rm">
                                <i class="fa-solid fa-calendar-week"></i>
                                <span>Rekap Mingguan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/rb' ? 'active' : '' }}">
                            <a href="/tf/sw/rb">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>Rekap Bulanan</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/pgm' ? 'active' : '' }}">
                            <a href="/tf/sw/pgm">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/nt' ? 'active' : '' }}">
                            <a href="/tf/sw/nt">
                                <i class="fa-solid fa-bell"></i>
                                <span>Notifikasi</span>
                            </a>
                        </li>
                        <li class="menu-item {{ $route == '/tf/sw/prf' ? 'active' : '' }}">
                            <a href="/tf/sw/prf">
                                <i class="fa-solid fa-circle-user"></i>
                                <span>Profile</span>
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


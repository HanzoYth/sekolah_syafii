<div>
    <!-- SIDEBAR COMPONENT -->
    <aside class="sidebar" id="sidebar">
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_guru.css') }}">
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>EduHRIS</span>
            </div>
            <button class="toggle-btn" id="sidebar-toggle">
                <i class="fa-solid fa-angles-left"></i>
            </button>
        </div>

        <div class="sidebar-menu-wrapper">
            <!-- ================= MENU GURU ================= -->
            @if(session('role') == "g")
                <div class="menu-section" id="section-guru">
                    <span class="menu-label">MODUL GURU</span>
                    <ul class="menu-list">
                        <li class="menu-item active">
                            <a href="/gr/das">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#profil">
                                <i class="fa-solid fa-id-card"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="/gr/abs">
                                <i class="fa-solid fa-user-check"></i>
                                <span>Absensi Presensi</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#izin">
                                <i class="fa-solid fa-file-signature"></i>
                                <span>Pengajuan Izin/Cuti</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#payroll">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <span>Slip Gaji</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#dokumen">
                                <i class="fa-solid fa-folder-open"></i>
                                <span>Dokumen Saya</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="#pengumuman">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                    </ul>
                </div>
            @elseif (session('role') == "a")
                <!-- ================= MENU ADMIN GURU ================= -->
                <div class="menu-section" id="section-admin">
                    <span class="menu-label">ADMINISTRATOR HR</span>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="/gr/dasa">
                                <i class="fa-solid fa-chart-line"></i>
                                <span>Dashboard Admin</span>
                            </a>
                        </li>

                        <!-- SUBMENU MASTER DATA (REPLACEMENT FOR PENGATURAN ABSENSI) -->
                        <li class="menu-item has-submenu">
                            <details class="submenu-wrapper">
                                <summary class="menu-link">
                                    <div class="menu-link-content">
                                        <i class="fa-solid fa-database"></i>
                                        <span>Master Data</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down submenu-icon"></i>
                                </summary>
                                <ul class="submenu-list">
                                    <li class="submenu-item">
                                        <a href="/gr/cb">
                                            <i class="fa-solid fa-school"></i>
                                            <span>Cabang Sekolah</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/gr/klgr">
                                            <i class="fa-solid fa-users-gear"></i>
                                            <span>Kelola Data Guru</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/gr/klab">
                                            <i class="fa-solid fa-clipboard-user"></i>
                                            <span>Kelola Absen Guru</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/gr/klgjgr">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                            <span>Gaji</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="/gr/tgm">
                                            <i class="fa-solid fa-calendar-day"></i>
                                            <span>Tanggal Merah</span>
                                        </a>
                                    </li>
                                </ul>
                            </details>
                        </li>
                        <li class="menu-item">
                            <a href="#persetujuan-izin">
                                <i class="fa-solid fa-clipboard-check"></i>
                                <span>Persetujuan Izin</span>
                            </a>
                        </li>
                        
                        <!-- MENU LAPORAN HR DENGAN SUBMENU -->
                        <li class="menu-item has-submenu">
                            <details class="submenu-wrapper">
                                <summary class="menu-link">
                                    <div class="menu-link-content">
                                        <i class="fa-solid fa-file-lines"></i>
                                        <span>Laporan HR</span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down submenu-icon"></i>
                                </summary>
                                <ul class="submenu-list">
                                    <li class="submenu-item">
                                        <a href="/gr/lpabs">
                                            <i class="fa-solid fa-clipboard-user"></i>
                                            <span>Laporan Absen</span>
                                        </a>
                                    </li>
                                    <li class="submenu-item">
                                        <a href="#laporan-pengajuan">
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
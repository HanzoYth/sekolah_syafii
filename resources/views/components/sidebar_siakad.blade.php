<div>
    <!-- SIDEBAR COMPONENT -->
    <aside class="sidebar" id="sidebar">
        {{-- CSS khusus siakad --}}
        <link rel="stylesheet" href="{{ asset('css/sidebar/sidebar_siakad.css') }}">

        {{-- Header sidebar --}}
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>SIAKAD</span>
            </div>
            <button class="toggle-btn" id="sidebar-toggle">
                <i class="fa-solid fa-angles-left"></i>
            </button>
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
                                            <i class="fa-solid fa-wallet"></i>
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
                                            <i class="fa-solid fa-piggy-bank"></i>
                                            <span>Pembayaran pendidikan</span>
                                        </a>
                                    </li>
                                </ul>
                            </details>
                        </li>

                        <li class="menu-item">
                            <a href="/sk/ds">
                                <i class="fa-solid fa-id-card"></i>
                                <span>Data Siswa</span>
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
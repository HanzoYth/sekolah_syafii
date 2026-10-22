<div>
    <!-- SIDEBAR COMPONENT -->
    
    <link rel="stylesheet" href="<?php echo e(asset('css/sidebar/sidebar_siakad.css')); ?>?v=<?php echo e(time()); ?>">

    <!-- TOMBOL HAMBURGER (hanya tampil di mobile, via CSS) -->
    <button class="mobile-hamburger-btn" id="mobile-hamburger-btn" aria-label="Buka menu" aria-expanded="false" aria-controls="sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    <!-- OVERLAY GELAP SAAT SIDEBAR TERBUKA DI MOBILE -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <aside class="sidebar" id="sidebar">

        
        <div class="sidebar-header">
            <div class="brand-logo">
                <i class="fa-solid fa-mosque"></i>
                <span>SIAKAD</span>
            </div>
        </div>

        <div class="sidebar-menu-wrapper">
            
            <div class="menu-section" id="section-umum">
                <ul class="menu-list">
                    <li class="menu-item <?php echo e(request()->is('sk/das', 'sk/dsg', 'sk/dbs') ? 'active' : ''); ?>">
                        <?php if(session('role') == "a"): ?>
                            <a href="/sk/das">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        <?php elseif(session('role') == "g"): ?>
                            <a href="/sk/dsg">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        <?php elseif(session('role') == "s"): ?>
                            <a href="/sk/dbs">
                                <i class="fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>

            
            <?php if(session('role') === 'a'): ?>
                <div class="menu-section" id="section-admin-akademik">
                    <span class="menu-label">AKADEMIK</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/kelola-mapel') ? 'active' : ''); ?>">
                            <a href="/sk/kelola-mapel">
                                <i class="fa-solid fa-book"></i>
                                <span>Mata Pelajaran</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/bobot-penilaian') ? 'active' : ''); ?>">
                            <a href="/sk/bobot-penilaian">
                                <i class="fa-solid fa-sliders"></i>
                                <span>Bobot & KKM Nilai</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/kelola-jadwal') ? 'active' : ''); ?>">
                            <a href="/sk/kelola-jadwal">
                                <i class="fa-solid fa-calendar-alt"></i>
                                <span>Kelola Jadwal</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/referensi') ? 'active' : ''); ?>">
                            <a href="/sk/referensi">
                                <i class="fa-solid fa-database"></i>
                                <span>Data Referensi</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/ds', 'sk/dls/*', 'sk/dts') ? 'active' : ''); ?>">
                            <a href="/sk/ds">
                                <i class="fa-solid fa-user-graduate"></i>
                                <span>Data Siswa</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/tk') ? 'active' : ''); ?>">
                            <a href="/sk/tk">
                                <i class="fa-solid fa-school"></i>
                                <span>Kelola Kelas</span>
                            </a>
                            
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/pembagian-kelas') ? 'active' : ''); ?>">
                            <a href="/sk/pembagian-kelas">
                                <i class="fa-solid fa-users-cog"></i>
                                <span>Pembagian Kelas</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/kelola-wali-kelas') ? 'active' : ''); ?>">
                            <a href="/sk/kelola-wali-kelas">
                                <i class="fa-solid fa-user-tie"></i>
                                <span>Wali Kelas</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/kenaikan-kelas') ? 'active' : ''); ?>">
                            <a href="/sk/kenaikan-kelas">
                                <i class="fa-solid fa-graduation-cap"></i>
                                <span>Kenaikan & Kelulusan</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/laporan-absensi-guru') ? 'active' : ''); ?>">
                            <a href="/sk/laporan-absensi-guru">
                                <i class="fa-solid fa-user-clock"></i>
                                <span>Kehadiran Guru</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/gsp*') ? 'active' : ''); ?>">
                            <a href="/sk/gsp">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <span>Slip Pembayaran Guru</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/kelola-pengumuman') ? 'active' : ''); ?>">
                            <a href="/sk/kelola-pengumuman">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Kelola Pengumuman</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="menu-section" id="section-admin-pembayaran">
                    <span class="menu-label">ADMINISTRASI PEMBAYARAN</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/bt', 'sk/pb', 'sk/pp', 'sk/pd', 'sk/ppl') ? 'active' : ''); ?>">
                            <details class="submenu-wrapper" <?php echo e(request()->is('sk/bt', 'sk/pb', 'sk/pp', 'sk/pd', 'sk/ppl') ? 'open' : ''); ?>>
                                <summary class="menu-link">
                                    <div class="menu-link-content"><i class="fa-solid fa-file-invoice-dollar"></i><span>Pembayaran</span></div>
                                    <i class="fa-solid fa-chevron-down submenu-icon"></i>
                                </summary>
                                <ul class="submenu-list">
                                    <li class="submenu-item <?php echo e(request()->is('sk/bt') ? 'active' : ''); ?>"><a href="/sk/bt"><i class="fa-solid fa-file-circle-plus"></i><span>Buat Tagihan</span></a></li>
                                    <li class="submenu-item <?php echo e(request()->is('sk/pb') ? 'active' : ''); ?>"><a href="/sk/pb"><i class="fa-solid fa-wallet"></i><span>Pembayaran IPP</span></a></li>
                                    <li class="submenu-item <?php echo e(request()->is('sk/pp') ? 'active' : ''); ?>"><a href="/sk/pp"><i class="fa-solid fa-money-check-dollar"></i><span>Uang Pangkal</span></a></li>
                                    <li class="submenu-item <?php echo e(request()->is('sk/pd') ? 'active' : ''); ?>"><a href="/sk/pd"><i class="fa-solid fa-graduation-cap"></i><span>Pendidikan</span></a></li>
                                    <li class="submenu-item <?php echo e(request()->is('sk/ppl') ? 'active' : ''); ?>"><a href="/sk/ppl"><i class="fa-solid fa-screwdriver-wrench"></i><span>Pemeliharaan</span></a></li>
                                </ul>
                            </details>
                        </li>
                    </ul>
                </div>

            
            <?php elseif(session('role') === 'g'): ?>
                <?php
                    // Cek peran guru: status di modul guru (tetap/honor), penugasan jadwal, dan wali kelas
                    $guruId = session('id');
                    $guruData = $guruId ? \App\Models\guru::find($guruId) : null;
                    $isWallas = $guruId ? \App\Models\wallas::where('guru_id', $guruId)->exists() : false;
                    // Wali kelas sudah tentu menjadi guru pengajar juga, bahkan jika checkbox di modul guru dimatikan
                    $isPengajar = $isWallas || ($guruData ? ($guruData->guru_tetap || $guruData->guru_honor || \App\Models\jadwal_pelajaran::where('guru_id', $guruId)->exists()) : false);
                ?>

                <?php if($isPengajar): ?>
                <div class="menu-section" id="section-guru-pengajar">
                    <span class="menu-label">MENU PENGAJAR</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/jadwal-guru') ? 'active' : ''); ?>">
                            <a href="/sk/jadwal-guru">
                                <i class="fa-solid fa-calendar-week"></i>
                                <span>Jadwal Mengajar</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/nilai-guru') || (request()->is('sk/input-nilai-detail/*') && request('from') !== 'walas') ? 'active' : ''); ?>">
                            <a href="/sk/nilai-guru">
                                <i class="fa-solid fa-star"></i>
                                <span>Manajemen Nilai</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/ass') ? 'active' : ''); ?>">
                            <a href="/sk/ass">
                                <i class="fa-solid fa-clipboard-list"></i>
                                <span>Absensi Mapel</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if($isWallas): ?>
                <div class="menu-section" id="section-guru-walas" style="margin-top: 15px;">
                    <span class="menu-label">MENU WALI KELAS</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/wali-kelas') ? 'active' : ''); ?>">
                            <a href="/sk/wali-kelas">
                                <i class="fa-solid fa-users-rectangle"></i>
                                <span>Data Siswa (Wali Kelas)</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/absensi-walas') ? 'active' : ''); ?>">
                            <a href="/sk/absensi-walas">
                                <i class="fa-solid fa-clipboard-user"></i>
                                <span>Absensi Kelas</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e((request()->is('sk/rapor-walas') && request('tab') === 'nilai') || (request()->is('sk/input-nilai-detail/*') && request('from') === 'walas') ? 'active' : ''); ?>">
                            <a href="/sk/rapor-walas?tab=nilai">
                                <i class="fa-solid fa-sliders"></i>
                                <span>Manajemen Nilai Kelas</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e((request()->is('sk/rapor-walas') && request('tab') !== 'nilai') || request()->is('sk/detail-rapor-walas/*') ? 'active' : ''); ?>">
                            <a href="/sk/rapor-walas">
                                <i class="fa-solid fa-file-contract"></i>
                                <span>Cetak Rapor</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php endif; ?>

                <div class="menu-section" id="section-guru-umum" style="margin-top: 15px;">
                    <span class="menu-label">UMUM</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/pengumuman-guru') ? 'active' : ''); ?>">
                            <a href="/sk/pengumuman-guru">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                    </ul>
                </div>

            
            <?php elseif(session('role') === 's'): ?>
                <div class="menu-section" id="section-siswa">
                    <span class="menu-label">AKADEMIK & MONITORING</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/jadwal-siswa') && !in_array(request('tab'), ['absensi_mapel', 'absensi_harian']) ? 'active' : ''); ?>">
                            <a href="/sk/jadwal-siswa?tab=jadwal">
                                <i class="fa-solid fa-calendar-week"></i>
                                <span>Jadwal Pelajaran</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/jadwal-siswa') && in_array(request('tab'), ['absensi_mapel', 'absensi_harian']) ? 'active' : ''); ?>">
                            <a href="/sk/jadwal-siswa?tab=absensi_mapel">
                                <i class="fa-solid fa-clipboard-check"></i>
                                <span>Absensi & Jurnal Belajar</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/rapor-siswa') && request('tab') !== 'rapor' ? 'active' : ''); ?>">
                            <a href="/sk/rapor-siswa?tab=transkrip">
                                <i class="fa-solid fa-star"></i>
                                <span>Nilai & Transkrip</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/rapor-siswa') && request('tab') === 'rapor' ? 'active' : ''); ?>">
                            <a href="/sk/rapor-siswa?tab=rapor">
                                <i class="fa-solid fa-file-contract"></i>
                                <span>Rapor Semester</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="menu-section" id="section-siswa-administrasi" style="margin-top: 15px;">
                    <span class="menu-label">ADMINISTRASI</span>
                    <ul class="menu-list">
                        <li class="menu-item <?php echo e(request()->is('sk/pbs', 'sk/dsp') ? 'active' : ''); ?>">
                            <a href="/sk/pbs">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                                <span>Riwayat Pembayaran</span>
                            </a>
                        </li>
                        <li class="menu-item <?php echo e(request()->is('sk/ps') ? 'active' : ''); ?>">
                            <a href="/sk/ps">
                                <i class="fa-solid fa-bullhorn"></i>
                                <span>Pengumuman</span>
                            </a>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>
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

    var MOBILE_BREAKPOINT = 1024;

    function isMobile() {
        return window.innerWidth <= MOBILE_BREAKPOINT;
    }

    function openMobileSidebar() {
        sidebar.classList.add('open');
        if (overlay) overlay.classList.add('active');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeMobileSidebar() {
        sidebar.classList.remove('open');
        if (overlay) overlay.classList.remove('active');
        if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
    }

    function toggleMobileSidebar() {
        if (sidebar.classList.contains('open')) {
            closeMobileSidebar();
        } else {
            openMobileSidebar();
        }
    }

    // Expose helpers globally for topbar / other buttons
    window.toggleSiakadSidebar = toggleMobileSidebar;
    window.openSiakadSidebar   = openMobileSidebar;
    window.closeSiakadSidebar  = closeMobileSidebar;

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

<?php echo $__env->make('components.siakad.loader', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/components/siakad/sidebar.blade.php ENDPATH**/ ?>
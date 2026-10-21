<link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/shared/components.css')); ?>?v=<?php echo e(time()); ?>">

<header class="siakad-topbar">
    <div class="siakad-topbar-pattern" aria-hidden="true"></div>
    <div class="siakad-topbar-content">
        <div class="siakad-topbar-title">
            <button class="topbar-hamburger-btn" id="topbar-hamburger-btn" type="button" aria-label="Buka Menu SIAKAD" onclick="if(window.toggleSiakadSidebar){window.toggleSiakadSidebar();}else{var h=document.getElementById('mobile-hamburger-btn');if(h)h.click();}">
                <i class="fa-solid fa-bars"></i>
            </button>
            <p class="siakad-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <div>
                <p class="siakad-topbar-kicker">SISTEM INFORMASI AKADEMIK</p>
                <h1><?php echo e($title); ?></h1>
                <p><?php echo $description; ?></p>
            </div>
        </div>

        <div class="siakad-topbar-actions">
            <div class="siakad-date" aria-label="Tanggal hari ini">
                <i class="fa-regular fa-calendar-days"></i>
                <span><?php echo e(now()->translatedFormat('l, d F Y')); ?></span>
            </div>

            <!-- ============================================== -->
            <!-- DROPDOWN NOTIFIKASI & PENGUMUMAN               -->
            <!-- ============================================== -->
            <div class="siakad-dropdown-container" id="notifDropdownContainer">
                <button class="siakad-notification" id="siakadNotifBtn" type="button" aria-label="Notifikasi & Pengumuman" aria-expanded="false" title="Notifikasi & Pengumuman">
                    <i class="fa-regular fa-bell text-base"></i>
                    <?php if($notificationCount > 0): ?>
                        <span class="siakad-notif-pulse"></span>
                        <span class="siakad-notif-badge"><?php echo e($notificationCount > 9 ? '9+' : $notificationCount); ?></span>
                    <?php endif; ?>
                </button>

                <div class="siakad-dropdown-panel notif-panel" id="siakadNotifPanel" style="display: none;" role="menu">
                    <div class="notif-dropdown-header">
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-bell"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-sm">Notifikasi & Pengumuman</h3>
                        </div>
                        <?php if($notificationCount > 0): ?>
                            <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                <?php echo e($notificationCount); ?> Baru
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="notif-dropdown-list">
                        <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <a href="<?php echo e($announcementsUrl); ?>" class="notif-list-item" role="menuitem">
                                <div class="notif-item-icon">
                                    <i class="fa-solid fa-bullhorn text-xs"></i>
                                </div>
                                <div class="notif-item-body">
                                    <div class="notif-item-header">
                                        <h4 class="notif-item-title"><?php echo e($notif->judul); ?></h4>
                                        <span class="notif-item-time">
                                            <?php echo e($notif->tanggal ? \Carbon\Carbon::parse($notif->tanggal)->locale('id')->diffForHumans() : 'Baru'); ?>

                                        </span>
                                    </div>
                                    <p class="notif-item-snippet"><?php echo e(Str::limit(strip_tags($notif->isi), 60)); ?></p>
                                    <div class="notif-item-footer">
                                        <span class="notif-item-tag">
                                            <?php echo e(ucfirst($notif->target_tipe)); ?>

                                        </span>
                                        <?php if($notif->lampiran): ?>
                                            <span class="notif-item-attach">
                                                <i class="fa-solid fa-paperclip text-[10px]"></i> Lampiran
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="notif-empty-state">
                                <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-lg mx-auto mb-2">
                                    <i class="fa-regular fa-bell-slash"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Tidak ada pengumuman baru</h4>
                                <p class="text-xs text-slate-400 mt-0.5">Pengumuman sekolah terbaru akan ditampilkan di sini.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="notif-dropdown-footer">
                        <a href="<?php echo e($announcementsUrl); ?>" class="notif-view-all">
                            <span>Buka Pusat Pengumuman</span>
                            <i class="fa-solid fa-arrow-right text-[11px]"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- ============================================== -->
            <!-- DROPDOWN PROFIL PENGGUNA                       -->
            <!-- ============================================== -->
            <div class="siakad-dropdown-container" id="profileDropdownContainer">
                <div class="siakad-profile" id="siakadProfileBtn" role="button" tabindex="0" aria-label="Menu Profil <?php echo e($currentName); ?>" aria-expanded="false" title="Menu Profil">
                    <?php if($currentPhoto): ?>
                        <img src="<?php echo e($currentPhoto); ?>" alt="Foto <?php echo e($currentName); ?>" class="siakad-profile-avatar" style="object-fit: cover; padding: 0;">
                    <?php else: ?>
                        <span class="siakad-profile-avatar"><?php echo e($currentInitials); ?></span>
                    <?php endif; ?>
                    <span class="siakad-profile-detail">
                        <strong><?php echo e($currentName); ?></strong>
                        <small><?php echo e($currentPosition); ?></small>
                    </span>
                    <i class="fa-solid fa-chevron-down siakad-profile-chevron" id="siakadProfileChevron" aria-hidden="true"></i>
                </div>

                <div class="siakad-dropdown-panel profile-panel" id="siakadProfilePanel" style="display: none;" role="menu">
                    <!-- Header Info Pengguna -->
                    <div class="profile-panel-header">
                        <div class="profile-panel-avatar-wrap">
                            <?php if($currentPhoto): ?>
                                <img src="<?php echo e($currentPhoto); ?>" alt="Foto <?php echo e($currentName); ?>" class="profile-panel-avatar-img">
                            <?php else: ?>
                                <div class="profile-panel-avatar-initial"><?php echo e($currentInitials); ?></div>
                            <?php endif; ?>
                            <span class="profile-online-badge" title="Status Online"></span>
                        </div>
                        <div class="profile-panel-user">
                            <h4 class="profile-panel-name"><?php echo e($currentName); ?></h4>
                            <span class="profile-panel-role"><?php echo e($currentPosition); ?></span>
                            <?php if($userIdentifier): ?>
                                <span class="profile-panel-id"><?php echo e($userIdentifier); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Daftar Menu Navigasi -->
                    <div class="profile-panel-menu">
                        <?php if($profileUrl): ?>
                            <a href="<?php echo e($profileUrl); ?>" class="profile-menu-link <?php echo e(request()->is('sk/pr', 'sk/pfs', 'gr/prad') ? 'active-profile' : ''); ?>" role="menuitem">
                                <div class="profile-menu-icon bg-emerald-50 text-emerald-700">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="profile-menu-text font-bold text-slate-800">
                                        <?php if(session('role') === 'g'): ?>
                                            Profil Guru
                                        <?php elseif(session('role') === 's'): ?>
                                            Profil Siswa
                                        <?php else: ?>
                                            Profil Saya
                                        <?php endif; ?>
                                    </span>
                                    <span class="profile-menu-sub">
                                        <?php if(session('role') === 'g'): ?>
                                            Informasi kepegawaian & data diri
                                        <?php elseif(session('role') === 's'): ?>
                                            Biodata diri & informasi akademik
                                        <?php else: ?>
                                            Informasi profil & akun
                                        <?php endif; ?>
                                    </span>
                                </div>
                                <i class="fa-solid fa-chevron-right text-[10px] text-slate-400"></i>
                            </a>
                            <div class="profile-menu-hr"></div>
                        <?php endif; ?>

                        <a href="<?php echo e($dashboardUrl); ?>" class="profile-menu-link" role="menuitem">
                            <div class="profile-menu-icon bg-blue-50 text-blue-700">
                                <i class="fa-solid fa-gauge-high"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="profile-menu-text font-semibold text-slate-800">Dashboard</span>
                                <span class="profile-menu-sub">Halaman utama akademik</span>
                            </div>
                        </a>

                        <?php if($isWallas): ?>
                            <a href="/sk/wali-kelas" class="profile-menu-link" role="menuitem">
                                <div class="profile-menu-icon bg-amber-50 text-amber-700">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="profile-menu-text font-semibold text-slate-800">Kelola Perwalian</span>
                                    <span class="profile-menu-sub"><?php echo e($waliKelasNama ? 'Rombel ' . $waliKelasNama : 'Wali Kelas'); ?></span>
                                </div>
                            </a>
                        <?php endif; ?>

                        <a href="<?php echo e($announcementsUrl); ?>" class="profile-menu-link" role="menuitem">
                            <div class="profile-menu-icon bg-purple-50 text-purple-700">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="profile-menu-text font-semibold text-slate-800">Pengumuman</span>
                                <span class="profile-menu-sub">Pusat informasi sekolah</span>
                            </div>
                        </a>

                        <div class="profile-menu-hr"></div>

                        <a href="/mod" class="profile-menu-link" role="menuitem">
                            <div class="profile-menu-icon bg-slate-100 text-slate-600">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="profile-menu-text font-medium text-slate-700">Pilih Modul</span>
                                <span class="profile-menu-sub">Kembali ke portal modul</span>
                            </div>
                        </a>

                        <div class="profile-menu-hr"></div>

                        <a href="/reg/logout" class="profile-menu-link logout-link" role="menuitem">
                            <div class="profile-menu-icon bg-rose-50 text-rose-600">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="profile-menu-text font-bold text-rose-600">Keluar Sistem</span>
                                <span class="profile-menu-sub text-rose-400">Akhiri sesi login ini</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* =====================================================================
   SIAKAD TOPBAR DROPDOWNS (NOTIF & PROFILE)
   ===================================================================== */
.siakad-dropdown-container {
    position: relative;
    display: inline-flex;
    align-items: center;
}

.siakad-notification {
    position: relative;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease;
}
.siakad-notification:hover,
.siakad-notification[aria-expanded="true"] {
    background: rgba(255, 255, 255, 0.22);
    border-color: rgba(216, 185, 74, 0.6);
}
.siakad-notification:active {
    transform: scale(0.96);
}

.siakad-notif-pulse {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: rgba(239, 68, 68, 0.6);
    animation: siakadPulse 1.8s infinite;
}

.siakad-notif-badge {
    position: absolute;
    top: -3px;
    right: -4px;
    min-width: 17px;
    height: 17px;
    padding: 0 4px;
    border-radius: 10px;
    background: #ef4444;
    color: #ffffff;
    font-size: 10px;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #0d5c3a;
    line-height: 1;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

@keyframes siakadPulse {
    0% { transform: scale(0.95); opacity: 0.8; }
    70% { transform: scale(1.6); opacity: 0; }
    100% { transform: scale(0.95); opacity: 0; }
}

.siakad-topbar-actions {
    display: flex !important;
    align-items: center !important;
    gap: 13px !important;
    flex-shrink: 0 !important;
}

.siakad-dropdown-container {
    position: relative !important;
    display: inline-flex !important;
    align-items: center !important;
    flex-shrink: 0 !important;
}

.siakad-profile {
    display: inline-flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 5px 14px 5px 6px !important;
    border: 1px solid rgba(255, 255, 255, 0.22) !important;
    border-radius: 14px !important;
    background: rgba(255, 255, 255, 0.12) !important;
    flex-shrink: 0 !important;
    min-width: max-content !important;
    box-sizing: border-box !important;
    cursor: pointer !important;
    user-select: none !important;
    transition: background 0.2s ease, border-color 0.2s ease !important;
}
.siakad-profile:hover,
.siakad-profile[aria-expanded="true"] {
    background: rgba(255, 255, 255, 0.22) !important;
    border-color: rgba(216, 185, 74, 0.6) !important;
}

.siakad-profile-avatar {
    display: inline-grid !important;
    width: 34px !important;
    height: 34px !important;
    place-items: center !important;
    border: 2px solid #f8d46d !important;
    border-radius: 50% !important;
    color: #0d5c3a !important;
    background: #ecfdf5 !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    flex-shrink: 0 !important;
    overflow: hidden !important;
}

.siakad-profile-detail {
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    min-width: 0 !important;
    text-align: left !important;
}

.siakad-profile-detail strong,
.siakad-profile-detail small {
    display: block !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: ellipsis !important;
}

.siakad-profile-detail strong {
    color: #ffffff !important;
    font-size: 12px !important;
    font-weight: 700 !important;
    line-height: 1.25 !important;
    max-width: 160px !important;
}

.siakad-profile-detail small {
    margin-top: 2px !important;
    color: #d1fae5 !important;
    font-size: 10px !important;
    font-weight: 500 !important;
    line-height: 1.2 !important;
    max-width: 160px !important;
}

.siakad-profile-chevron {
    color: #d1fae5 !important;
    font-size: 10px !important;
    flex-shrink: 0 !important;
    margin-left: 2px !important;
    transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
.siakad-profile-chevron.open {
    transform: rotate(180deg) !important;
}

/* Panel Dasar */
.siakad-dropdown-panel {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    background: #ffffff;
    color: #1e293b;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 16px 36px -4px rgba(15, 23, 42, 0.16), 0 6px 12px -2px rgba(15, 23, 42, 0.06);
    z-index: 99999;
    text-align: left;
    overflow: hidden;
    animation: siakadDropFade 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes siakadDropFade {
    from {
        opacity: 0;
        transform: translateY(-8px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Panel Notifikasi */
.notif-panel {
    width: 350px;
    max-width: calc(100vw - 32px);
}

.notif-dropdown-header {
    padding: 14px 16px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.notif-dropdown-header h3 {
    margin: 0 !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #1e293b !important;
}

.notif-dropdown-header span {
    color: #065f46 !important;
}

.notif-dropdown-list {
    max-height: 350px;
    overflow-y: auto;
}

.notif-list-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 16px;
    border-bottom: 1px solid #f1f5f9;
    text-decoration: none;
    transition: background 0.15s ease;
}
.notif-list-item:hover {
    background: #f8fafc;
}

.notif-item-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: #ecfdf5;
    color: #059669;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}

.notif-item-body {
    flex: 1;
    min-width: 0;
}

.notif-item-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 2px;
}

.notif-item-title {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.3;
}

.notif-item-time {
    font-size: 10px;
    color: #94a3b8;
    white-space: nowrap;
    font-weight: 500;
}

.notif-item-snippet {
    font-size: 12px;
    color: #64748b;
    line-height: 1.35;
    margin: 2px 0 6px 0;
}

.notif-item-footer {
    display: flex;
    align-items: center;
    gap: 6px;
}

.notif-item-tag {
    display: inline-block;
    padding: 2px 7px;
    border-radius: 4px;
    font-size: 10px;
    font-weight: 700;
    background: #f1f5f9;
    color: #475569;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.notif-item-attach {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    font-size: 10px;
    font-weight: 600;
    color: #0284c7;
}

.notif-empty-state {
    padding: 32px 20px;
    text-align: center;
}

.notif-empty-state h4 {
    margin: 0 !important;
    font-size: 14px !important;
    font-weight: 700 !important;
    color: #334155 !important;
}

.notif-empty-state p {
    margin: 4px 0 0 0 !important;
    font-size: 12px !important;
    color: #64748b !important;
}

.notif-dropdown-footer {
    padding: 10px 16px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    text-align: center;
}

.notif-view-all {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 700;
    color: #10b981;
    text-decoration: none;
    transition: color 0.15s ease;
}
.notif-view-all:hover {
    color: #047857;
}

/* Panel Profil */
.profile-panel {
    width: 290px;
    max-width: calc(100vw - 32px);
}

.profile-panel-header {
    padding: 16px;
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    border-bottom: 1px solid #dcfce7;
    display: flex;
    align-items: center;
    gap: 12px;
}

.profile-panel-avatar-wrap {
    position: relative;
    flex-shrink: 0;
}

.profile-panel-avatar-img,
.profile-panel-avatar-initial {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 2px solid #10b981;
}

.profile-panel-avatar-initial {
    background: #10b981;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    font-weight: 800;
    letter-spacing: 0.5px;
}

.profile-online-badge {
    position: absolute;
    bottom: 0;
    right: 0;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #22c55e;
    border: 2px solid #ffffff;
}

.profile-panel-user {
    min-width: 0;
    flex: 1;
}

.profile-panel-name {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    line-height: 1.25;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin: 0;
}

.profile-panel-role {
    display: inline-block;
    padding: 1px 8px;
    margin-top: 3px;
    border-radius: 12px;
    font-size: 10px;
    font-weight: 700;
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.profile-panel-id {
    font-size: 11px;
    color: #64748b;
    margin: 3px 0 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.profile-panel-menu {
    padding: 6px 0;
}

.profile-menu-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 16px;
    text-decoration: none;
    transition: background 0.15s ease;
}
.profile-menu-link:hover {
    background: #f8fafc;
}
.profile-menu-link.active-profile {
    background: #f0fdf4 !important;
    border-left: 3px solid #166534 !important;
}
.profile-menu-link.active-profile .profile-menu-text {
    color: #166534 !important;
    font-weight: 800 !important;
}
.profile-menu-link.active-profile .profile-menu-icon {
    background: #166534 !important;
    color: #ffffff !important;
}

.profile-menu-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}

.profile-menu-text {
    display: block;
    font-size: 13px;
    line-height: 1.25;
}

.profile-menu-sub {
    display: block;
    font-size: 11px;
    color: #94a3b8;
    line-height: 1.2;
    margin-top: 1px;
}

.profile-menu-hr {
    height: 1px;
    background: #f1f5f9;
    margin: 6px 0;
}

.profile-menu-link.logout-link:hover {
    background: #fff1f2;
}
.profile-menu-link.logout-link:hover .profile-menu-icon {
    background: #ffe4e6;
}

/* Responsif Mobile Dropdown */
@media (max-width: 700px) {
    .notif-panel,
    .profile-panel {
        position: fixed !important;
        top: 130px;
        bottom: auto !important;
        right: 12px !important;
        left: 12px !important;
        width: auto !important;
        max-width: calc(100vw - 24px) !important;
        margin-top: 0 !important;
        max-height: calc(100vh - 150px) !important;
        box-sizing: border-box !important;
        border-radius: 16px !important;
        box-shadow: 0 20px 40px -6px rgba(15, 23, 42, 0.25) !important;
    }

    .notif-dropdown-list {
        max-height: calc(100vh - 250px) !important;
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch;
    }

    .profile-panel-menu {
        max-height: calc(100vh - 250px) !important;
        overflow-y: auto !important;
        -webkit-overflow-scrolling: touch;
    }
}
</style>

<script>
(function() {
    function initSiakadTopbars() {
        const notifBtn = document.getElementById('siakadNotifBtn');
        const notifPanel = document.getElementById('siakadNotifPanel');
        const profileBtn = document.getElementById('siakadProfileBtn');
        const profilePanel = document.getElementById('siakadProfilePanel');
        const profileChevron = document.getElementById('siakadProfileChevron');

        function updateDropdownPosition(btn, panel) {
            if (!btn || !panel) return;
            if (window.innerWidth <= 700) {
                const rect = btn.getBoundingClientRect();
                // Hitung posisi top tepat di bawah tombol (rect.bottom + 8px).
                // Beri batas minimal (16px) agar tidak pernah berada di area notch / status bar HP
                let topPos = Math.round(rect.bottom + 8);
                if (topPos < 16) topPos = 16;
                if (topPos > window.innerHeight - 150) {
                    topPos = Math.max(16, window.innerHeight - 150);
                }

                panel.style.position = 'fixed';
                panel.style.top = topPos + 'px';
                panel.style.left = '12px';
                panel.style.right = '12px';
                panel.style.width = 'auto';
                panel.style.maxWidth = 'calc(100vw - 24px)';
                panel.style.bottom = 'auto';

                // Hitung tinggi maksimal agar panel tidak terpotong di bagian bawah layar
                const availableHeight = window.innerHeight - topPos - 16;
                panel.style.maxHeight = availableHeight + 'px';

                const list = panel.querySelector('.notif-dropdown-list');
                if (list) {
                    const listMaxH = Math.max(120, availableHeight - 100);
                    list.style.maxHeight = listMaxH + 'px';
                    list.style.overflowY = 'auto';
                    list.style.webkitOverflowScrolling = 'touch';
                }

                const profileMenu = panel.querySelector('.profile-panel-menu');
                if (profileMenu) {
                    const menuMaxH = Math.max(120, availableHeight - 90);
                    profileMenu.style.maxHeight = menuMaxH + 'px';
                    profileMenu.style.overflowY = 'auto';
                    profileMenu.style.webkitOverflowScrolling = 'touch';
                }
            } else {
                panel.style.position = '';
                panel.style.top = '';
                panel.style.left = '';
                panel.style.right = '';
                panel.style.width = '';
                panel.style.maxWidth = '';
                panel.style.bottom = '';
                panel.style.maxHeight = '';
                const list = panel.querySelector('.notif-dropdown-list');
                if (list) {
                    list.style.maxHeight = '';
                    list.style.overflowY = '';
                }
                const profileMenu = panel.querySelector('.profile-panel-menu');
                if (profileMenu) {
                    profileMenu.style.maxHeight = '';
                    profileMenu.style.overflowY = '';
                }
            }
        }

        function closeAllDropdowns() {
            if (notifPanel) notifPanel.style.display = 'none';
            if (profilePanel) profilePanel.style.display = 'none';
            if (notifBtn) notifBtn.setAttribute('aria-expanded', 'false');
            if (profileBtn) profileBtn.setAttribute('aria-expanded', 'false');
            if (profileChevron) profileChevron.classList.remove('open');
        }

        if (notifBtn && notifPanel) {
            notifBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const isCurrentlyOpen = notifPanel.style.display === 'block';
                closeAllDropdowns();
                if (!isCurrentlyOpen) {
                    notifPanel.style.display = 'block';
                    notifBtn.setAttribute('aria-expanded', 'true');
                    updateDropdownPosition(notifBtn, notifPanel);
                }
            });
        }

        if (profileBtn && profilePanel) {
            profileBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const isCurrentlyOpen = profilePanel.style.display === 'block';
                closeAllDropdowns();
                if (!isCurrentlyOpen) {
                    profilePanel.style.display = 'block';
                    profileBtn.setAttribute('aria-expanded', 'true');
                    if (profileChevron) profileChevron.classList.add('open');
                    updateDropdownPosition(profileBtn, profilePanel);
                }
            });

            // Aksesibilitas keyboard Enter / Spasi
            profileBtn.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    profileBtn.click();
                }
            });
        }

        // Reposisi saat resize window atau orientasi HP berubah
        window.addEventListener('resize', function() {
            if (notifPanel && notifPanel.style.display === 'block') {
                updateDropdownPosition(notifBtn, notifPanel);
            }
            if (profilePanel && profilePanel.style.display === 'block') {
                updateDropdownPosition(profileBtn, profilePanel);
            }
        });

        // Reposisi saat scroll layar
        window.addEventListener('scroll', function() {
            if (notifPanel && notifPanel.style.display === 'block') {
                updateDropdownPosition(notifBtn, notifPanel);
            }
            if (profilePanel && profilePanel.style.display === 'block') {
                updateDropdownPosition(profileBtn, profilePanel);
            }
        }, { passive: true });

        // Tutup saat klik di luar
        document.addEventListener('click', function(e) {
            const inNotif = notifPanel && notifPanel.contains(e.target);
            const inNotifBtn = notifBtn && notifBtn.contains(e.target);
            const inProfile = profilePanel && profilePanel.contains(e.target);
            const inProfileBtn = profileBtn && profileBtn.contains(e.target);

            if (!inNotif && !inNotifBtn && !inProfile && !inProfileBtn) {
                closeAllDropdowns();
            }
        });

        // Tutup saat tekan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAllDropdowns();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSiakadTopbars);
    } else {
        initSiakadTopbars();
    }
})();
</script>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/topbar-profile.blade.php ENDPATH**/ ?>
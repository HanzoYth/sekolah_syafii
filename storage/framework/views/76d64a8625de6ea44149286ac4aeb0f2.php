<link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/shared/components.css')); ?>?v=<?php echo e(time()); ?>">

<header class="siakad-topbar">
    <div class="siakad-topbar-pattern" aria-hidden="true"></div>
    <div class="siakad-topbar-content">
        <div class="siakad-topbar-title">
            <p class="siakad-arabic">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
            <div>
                <p class="siakad-topbar-kicker">SISTEM INFORMASI AKADEMIK</p>
                <h1><?php echo e($title); ?></h1>
                <p><?php echo e($description); ?></p>
            </div>
        </div>

        <div class="siakad-topbar-actions">
            <div class="siakad-date" aria-label="Tanggal hari ini"><i class="fa-regular fa-calendar-days"></i><span><?php echo e(now()->translatedFormat('l, d F Y')); ?></span></div>
            <button class="siakad-notification" type="button" aria-label="Notifikasi"><i class="fa-regular fa-bell"></i><span></span></button>
            <div class="siakad-profile" aria-label="Profil <?php echo e($currentName); ?>">
                <?php if($currentPhoto): ?>
                    <img src="<?php echo e($currentPhoto); ?>" alt="Foto <?php echo e($currentName); ?>" class="siakad-profile-avatar" style="object-fit: cover; padding: 0;">
                <?php else: ?>
                    <span class="siakad-profile-avatar"><?php echo e($currentInitials); ?></span>
                <?php endif; ?>
                <span class="siakad-profile-detail"><strong><?php echo e($currentName); ?></strong><small><?php echo e($currentPosition); ?></small></span>
                <i class="fa-solid fa-chevron-down siakad-profile-chevron" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</header>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/topbar-profile.blade.php ENDPATH**/ ?>
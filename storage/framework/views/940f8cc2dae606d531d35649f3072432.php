<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi — Sekolah Islam Al-Qur'an Imam Syafi'i</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('/css/activity_reg.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="auth-bg-layer" style="background-image: url('<?php echo e(asset('img/bg_skl.jpeg')); ?>?v=<?php echo e(time()); ?>');" data-mouse-speed="-14"></div>
    <div class="auth-pattern-overlay" data-mouse-speed="18"></div>
    <div class="auth-glow-orb"></div>

    <div class="auth-card-container">
        <div class="auth-card-top-accent"></div>

        <div class="auth-card-inner">
            <div class="auth-identity-header">
                <a href="/" class="auth-seal-link">
                    <img src="<?php echo e(asset('img/logo.png')); ?>?v=<?php echo e(time()); ?>" alt="Logo Sekolah">
                </a>
                <p class="auth-basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h1 class="auth-school-name">Pemulihan Kata Sandi</h1>
                <p class="auth-portal-subtitle">Sekolah Islam Al-Qur'an Imam Syafi'i</p>
            </div>

            <div class="form-wrapper active">
                <p class="form-section-note">
                    Masukkan alamat email yang terdaftar pada akun Anda. Sistem akan mengirimkan tautan untuk mengatur ulang kata sandi.
                </p>

                <form action="/reg/krm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="field-group">
                        <label class="field-label" for="resetEmail">Alamat Email Terdaftar</label>
                        <div class="input-group">
                            <i class="fa-solid fa-envelope"></i>
                            <input id="resetEmail" name="email" type="email" placeholder="Masukkan email akun Anda" required autofocus>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Kirim Tautan Pemulihan</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="auth-card-footer">
            <a href="/reg" class="back-home">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Masuk
            </a>
            <a href="/" class="footer-help-link">Beranda</a>
        </div>

        <?php if (isset($component)) { $__componentOriginal0681b545d180d4f9d8ad2ed4614031e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2 = $attributes; } ?>
<?php $component = App\View\Components\Warning::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('warning'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Warning::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2)): ?>
<?php $attributes = $__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2; ?>
<?php unset($__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0681b545d180d4f9d8ad2ed4614031e2)): ?>
<?php $component = $__componentOriginal0681b545d180d4f9d8ad2ed4614031e2; ?>
<?php unset($__componentOriginal0681b545d180d4f9d8ad2ed4614031e2); ?>
<?php endif; ?>
    </div>

</body>
</html>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\auth\lupa_sandi.blade.php ENDPATH**/ ?>
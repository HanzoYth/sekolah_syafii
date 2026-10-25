<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi — Sekolah Islam Al-Qur'an Imam Syafi'i</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('/css/activity_reg.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="auth-bg-layer" style="background-image: url('<?php echo e(asset('img/bg_skl.jpeg')); ?>?v=<?php echo e(time()); ?>');"></div>
    <div class="auth-pattern-overlay"></div>
    <div class="auth-glow-orb"></div>

    <div class="auth-card-container">
        <div class="auth-card-top-accent"></div>

        <div class="auth-card-inner">
            <div class="auth-identity-header">
                <a href="/" class="auth-seal-link">
                    <img src="<?php echo e(asset('img/logo.png')); ?>?v=<?php echo e(time()); ?>" alt="Logo Sekolah">
                </a>
                <p class="auth-basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h1 class="auth-school-name">Atur Ulang Kata Sandi</h1>
                <p class="auth-portal-subtitle"><?php echo e($email); ?></p>
            </div>

            <div class="form-wrapper active">
                <form action="/reg/rst" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="email" value="<?php echo e($email); ?>">

                    <div class="field-group">
                        <label class="field-label" for="newPassword">Kata Sandi Baru</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock"></i>
                            <input id="newPassword" class="has-toggle" name="password" type="password" placeholder="Masukkan kata sandi baru" required>
                            <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('newPassword', this)"></i>
                        </div>
                    </div>

                    <div class="field-group">
                        <label class="field-label" for="confirmPassword">Konfirmasi Kata Sandi Baru</label>
                        <div class="input-group">
                            <i class="fa-solid fa-shield-halved"></i>
                            <input id="confirmPassword" class="has-toggle" name="password_confirmation" type="password" placeholder="Ulangi kata sandi baru" required>
                            <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('confirmPassword', this)"></i>
                        </div>
                    </div>

                    <div class="password-hint">
                        <i class="fa-solid fa-circle-info"></i>
                        Minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, dan angka.
                    </div>

                    <button type="submit" class="btn-submit">
                        <span>Simpan Kata Sandi Baru</span>
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="auth-card-footer">
            <a href="/reg" class="back-home">
                <i class="fa-solid fa-arrow-left"></i> Batal & Kembali ke Masuk
            </a>
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

    <script>
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                iconElement.classList.remove('fa-eye');
                iconElement.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                iconElement.classList.remove('fa-eye-slash');
                iconElement.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\auth\lupa_sandi_password.blade.php ENDPATH**/ ?>
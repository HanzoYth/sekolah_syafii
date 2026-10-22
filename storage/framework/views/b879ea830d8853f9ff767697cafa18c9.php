<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Sandi - Generasi Rabbani</title>
    
    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Terpisah -->
    <link rel="stylesheet" href="<?php echo e(asset('css/lupa_sandi_password.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="auth-card-container">
        <!-- SISI KIRI: INFORMASI SEKOLAH -->
        <div class="auth-brand-side">
            <div class="brand-overlay"></div>
            <div class="brand-content">
                <div class="brand-logo">
                    <i class="fas fa-quran"></i>
                    <span>Rabbani</span>
                </div>
                <p class="basmalah">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                <h2>Pembaruan Kata Sandi <span class="highlight">Akun Santri</span></h2>
                <p class="brand-desc">
                    Buat kata sandi baru yang kuat dan mudah diingat untuk memastikan keamanan akun Anda tetap terjaga.
                </p>
                <div class="brand-features">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Enkripsi Kata Sandi Aman</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Akses Langsung Ke Portal</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: FORM RESET PASSWORD -->
        <div class="auth-form-side">
            <div class="form-wrapper active">
                <div class="form-header">
                    <h3>Buat Kata Sandi Baru 🔑</h3>
                    <p>Masukkan kata sandi baru Anda di bawah ini</p>
                </div>

                <form action="/reg/rst" method="POST">
                    <?php echo csrf_field(); ?>
                    <!-- Hidden Token (biasanya dikirim dari link email Laravel) -->
                    <input type="hidden" name="email" value="<?php echo e($email); ?>">

                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input id="newPassword" name="password" type="password" placeholder="Kata Sandi Baru" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('newPassword', this)"></i>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-shield-alt"></i>
                        <input id="confirmPassword" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi Baru" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('confirmPassword', this)"></i>
                    </div>

                    <button type="submit" class="btn-submit">Simpan Kata Sandi Baru</button>
                </form>
            </div>

            <a href="/reg" class="back-home">
                <i class="fas fa-arrow-left"></i> Batal & Kembali ke Masuk
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

    <!-- JavaScript Toggle Show/Hide Password -->
    <script>
        function togglePassword(inputId, iconElement) {
            const input = document.getElementById(inputId);
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
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\auth\lupa_sandi_password.blade.php ENDPATH**/ ?>
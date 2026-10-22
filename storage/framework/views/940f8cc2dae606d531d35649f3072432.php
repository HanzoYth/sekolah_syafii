<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Sandi - Generasi Rabbani</title>
    
    <!-- Font & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Terpisah -->
      <link rel="stylesheet" href="<?php echo e(asset('css/lupa_sandi.css')); ?>?v=<?php echo e(time()); ?>">
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
                <h2>Pemulihan Akses <span class="highlight">Akun Santri</span></h2>
                <p class="brand-desc">
                    Jangan khawatir jika Anda melupakan kata sandi. Masukkan email atau nomor WhatsApp yang terdaftar untuk menerima instruksi pemulihan.
                </p>
                <div class="brand-features">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Proses Verifikasi Aman</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-clock"></i>
                        <span>Bantuan Respons Cepat</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: FORM LUPA PASSWORD -->
        <div class="auth-form-side">
            <div class="form-wrapper active">
                <div class="form-header">
                    <h3>Lupa Kata Sandi? 🔒</h3>
                    <p>Masukkan email terdaftar untuk mengatur ulang kata sandi Anda</p>
                </div>

                <form action="/reg/krm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input name="email" type="email" placeholder="Masukkan Alamat Email" required autofocus>
                    </div>

                    <button type="submit" class="btn-submit">Kirim Link Reset</button>
                </form>
            </div>

            <a href="/reg" class="back-home">
                <i class="fas fa-arrow-left"></i> Kembali ke Halaman Masuk
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

</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\auth\lupa_sandi.blade.php ENDPATH**/ ?>
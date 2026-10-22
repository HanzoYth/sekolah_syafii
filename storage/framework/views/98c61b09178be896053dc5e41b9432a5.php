<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP — HRIS Guru</title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&family=Source+Serif+4:opsz,wght@8..60,400;8..60,600;8..60,700&display=swap" rel="stylesheet">

    <!-- CSS OTP -->
    <link rel="stylesheet" href="<?php echo e(asset('css/otp.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <p class="loading-text">Menyiapkan kode verifikasi...</p>
        </div>
    </div>

    <div class="otp-wrapper" id="otpWrapper">
        <div class="otp-card">
            <div class="otp-header">
                <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
                <div class="icon-badge"><i class="fa-solid fa-shield-halved"></i></div>
                <h2>Verifikasi Kode OTP</h2>
                <p>Masukkan 6 digit kode keamanan yang telah dikirimkan ke nomor WhatsApp / Email Anda.</p>
            </div>

            <form action="/gr/ckotp" method="POST" class="otp-form">
                <?php echo csrf_field(); ?>
                <div class="otp-inputs">
                    <input type="number" min="0" max="9" class="otp-field" autofocus placeholder="•" required>
                    <input type="number" min="0" max="9" class="otp-field" placeholder="•" disabled required>
                    <input type="number" min="0" max="9" class="otp-field" placeholder="•" disabled required>
                    <input type="number" min="0" max="9" class="otp-field" placeholder="•" disabled required>
                    <input type="number" min="0" max="9" class="otp-field" placeholder="•" disabled required>
                    <input type="number" min="0" max="9" class="otp-field" placeholder="•" disabled required>
                    <input type="hidden" id="value_otp" name="otp">
                </div>

                <div class="otp-timer-info">
                    <p>Tidak menerima kode? <a href="/gr/totp" class="btn-resend">Kirim Ulang</a></p>
                </div>

                <button type="submit" class="btn-verify">
                    <i class="fa-solid fa-check-circle"></i> VERIFIKASI SEKARANG
                </button>
            </form>

            <div class="otp-footer">
                <?php if(session('role') == 'g'): ?>
                    <a href="/gr/abs"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Absen</a>
                <?php elseif(session('role') == 'b'): ?>
                    <a href="/bd/abs"><i class="fa-solidz fa-arrow-left"></i> Kembali ke Halaman Absen</a>
                <?php elseif(session('role') == "o"): ?>
                    <a href="/gr/abs"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Absen</a>
                <?php else: ?>
                    <a href="/gr/abs"><i class="fa-solid fa-arrow-left"></i> Kembali ke Halaman Absen</a>
                <?php endif; ?>
            </div>
        </div>
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
    <script src="<?php echo e(asset('js/auth/time_otp.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\auth\otp.blade.php ENDPATH**/ ?>
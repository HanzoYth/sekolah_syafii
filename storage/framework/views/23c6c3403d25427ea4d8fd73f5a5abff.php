<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi Kehadiran Guru & Staf</title>

    <!-- FontAwesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS & Google Fonts Arabic -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Asset CSS khusus Absensi -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/absensi.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>
    <?php if (isset($component)) { $__componentOriginale234f8d1d87fff37708f17b59eb20f90 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale234f8d1d87fff37708f17b59eb20f90 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_guru','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_guru'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale234f8d1d87fff37708f17b59eb20f90)): ?>
<?php $attributes = $__attributesOriginale234f8d1d87fff37708f17b59eb20f90; ?>
<?php unset($__attributesOriginale234f8d1d87fff37708f17b59eb20f90); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale234f8d1d87fff37708f17b59eb20f90)): ?>
<?php $component = $__componentOriginale234f8d1d87fff37708f17b59eb20f90; ?>
<?php unset($__componentOriginale234f8d1d87fff37708f17b59eb20f90); ?>
<?php endif; ?>
    <div class="presensi-container">
        
        <!-- Banner Islami Top -->
        <div class="islamic-banner">
            <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
            <div class="banner-title">
                <h2>Presensi Kehadiran Guru & Staf</h2>
                <p>"Niatkan langkah mengajar sebagai ibadah untuk mencetak generasi Rabbani."</p>
            </div>
        </div>

        <!-- Ringkasan Stat Cards Hari Ini & Bulan Ini -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon bulan-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="stat-info">
                    <span class="label">Hadir Bulan Ini</span>
                    <div class="value"><?php echo e($total_kehadiran); ?> Hari</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon terlambat-icon"><i class="fa-solid fa-clock-rotate-left"></i></div>
                <div class="stat-info">
                    <span class="label">Total Terlambat</span>
                    <div class="value"><?php echo e($total_lambat); ?> Kali</div>
                </div>
            </div>
        </div>

        <!-- Area Peta & Tombol Aksi -->
        <div class="presensi-grid">
            <!-- Panel Kiri: Peta Geolocation -->
            <div class="card-panel">
                <div class="panel-header">
                    <h4><i class="fa-solid fa-map-location-dot"></i> Peta Lokasi Presensi</h4>
                    <!-- Badge Cabang Dinamis -->
                    <span class="badge-date">
                        <i class="fa-solid fa-building-flag"></i> <?php echo e($cabang->nama_cabang ?? 'Kota Palu'); ?>

                    </span>
                </div>
                
                <div id="map"></div>

                <div class="coordinate-box">
                    <input type="hidden" id="latitude" value="<?php echo e($lokasi->latitude); ?>">
                    <input type="hidden" id="longitude" value="<?php echo e($lokasi->longitude); ?>">
                    <input type="hidden" id="radius" value="<?php echo e($lokasi->radius); ?>">
                    <div class="coord-item">Latitude: <span id="user-lat">Mengambil...</span></div>
                    <div class="coord-item">Longitude: <span id="user-lng">Mengambil...</span></div>
                </div>

                <div id="location-status" class="location-status status-warn">
                    <i class="fa-solid fa-spinner fa-spin"></i> Mendeteksi lokasi Anda...
                </div>
            </div>

            <!-- Panel Kanan: Jam & Tombol Absen -->
            <div class="card-panel" style="display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div class="panel-header">
                        <h4><i class="fa-solid fa-stopwatch"></i> Waktu Server Presensi</h4>
                    </div>

                    <div class="clock-display">
                        <div class="live-time" id="live-time">00:00:00 WITA</div>
                        <div class="live-date" id="live-date">Memuat tanggal...</div>
                    </div>
                </div>

                <!-- Action Form/Button -->
                <form action="/gr/acabs/" method="GET" class="action-buttons">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="latitude" id="input-lat">
                    <input type="hidden" name="longitude" id="input-lng">
                    <input type="hidden" name="id" value="<?php echo e(session('id')); ?>" id="input-id">

                    <button class="btn-absen btn-masuk" id="absen" disabled>
                            <i class="fa-solid fa-right-to-bracket"></i> ABSEN MASUK
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Pustaka Leaflet JS & Script Khusus -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="<?php echo e(asset('js/modul/guru/absensi.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\guru\g\presensi_absen.blade.php ENDPATH**/ ?>
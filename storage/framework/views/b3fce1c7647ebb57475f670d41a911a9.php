<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Absensi & Lokasi Valid</title>

    <!-- FontAwesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet CSS & Google Fonts -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Pengaturan Absensi -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/setting_absen.css')); ?>?v=<?php echo e(time()); ?>">
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

    <!-- Main Wrapper agar tidak tertutup Sidebar -->
    <main class="main-wrapper">
        <div class="presensi-container">
            
            <!-- Banner Header Top -->
            <div class="islamic-banner">
                <div class="banner-content">
                    <div class="bismillah-text">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</div>
                    <div class="banner-title">
                        <h2>Pengaturan Lokasi & Jam Kerja Presensi</h2>
                        <p>Konfigurasi titik koordinat GPS, radius jangkauan validasi, dan jam operasional harian.</p>
                    </div>
                </div>
                <div class="banner-badge">
                    <i class="fa-solid fa-shield-halved"></i> Panel Administrator
                </div>
            </div>

            <form action="/gr/crtabs/<?php echo e($id); ?>" method="POST" id="form-pengaturan-absensi">
                <?php echo csrf_field(); ?>
                <div class="presensi-grid">
                    
                    <!-- Panel Kiri: Map Interaktif & Detail Koordinat -->
                    <div class="card-panel">
                        <div class="panel-header">
                            <div class="panel-header-title">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <div>
                                    <h4>Peta & Titik Lokasi Valid</h4>
                                    <small>Tentukan titik pusat dan jangkauan radius presensi</small>
                                </div>
                            </div>
                            <span class="badge-hint"><i class="fa-solid fa-hand-pointer"></i> Drag Pin / Klik Peta</span>
                        </div>

                        <!-- Peta Leaflet -->
                        <div id="map-setting"></div>

                        <!-- Input Nama Cabang, Nama Tempat & Radius -->
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="nama_cabang"><i class="fa-solid fa-store"></i> Nama Cabang</label>
                                <input type="text" id="nama_cabang" name="nama_cabang" class="form-control" placeholder="Contoh: Cabang Pusat" value="<?php echo e($cabang->nama_cabang); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_lokasi"><i class="fa-solid fa-building"></i> Nama Lokasi / Gedung</label>
                                <input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" placeholder="Contoh: Gedung Utama Sekolah" value="<?php echo e($lokasi->nama_lokasi); ?>" required>
                            </div>
                            <div class="form-group short-input">
                                <label for="radius"><i class="fa-solid fa-circle-dot"></i> Radius (Meter)</label>
                                <div class="input-with-suffix">
                                    <input type="number" id="radius" name="radius" class="form-control" value="<?php echo e($lokasi->radius); ?>" min="10" max="5000" required>
                                    <span class="suffix">m</span>
                                </div>
                            </div>
                        </div>

                        <!-- Input Koordinat (Latitude & Longitude) -->
                        <div class="form-group-row">
                            <div class="form-group">
                                <label for="latitude"><i class="fa-solid fa-location-crosshairs"></i> Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-control readonly-input" value="<?php echo e($lokasi->latitude); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="longitude"><i class="fa-solid fa-location-crosshairs"></i> Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-control readonly-input" value="<?php echo e($lokasi->longitude); ?>" required>
                            </div>
                        </div>

                        <div class="coordinate-info-box">
                            <i class="fa-solid fa-circle-info"></i>
                            <span>Geser pin merah atau klik area peta untuk memperbarui nilai latitude & longitude secara otomatis.</span>
                        </div>
                    </div>

                    <!-- Panel Kanan: Atur Jam Kerja (Senin - Sabtu) -->
                    <div class="card-panel panel-right">
                        <div>
                            <div class="panel-header">
                                <div class="panel-header-title">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    <div>
                                        <h4>Jadwal Jam Kerja Operasional</h4>
                                        <small>Batas waktu presensi masuk & pulang (Senin - Sabtu)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="schedule-container">
                                <!-- Hari Senin -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Senin</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_senin" value="<?php echo e($waktu[0]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_senin" value="<?php echo e($waktu[0]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Selasa -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Selasa</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_selasa" value="<?php echo e($waktu[1]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_selasa" value="<?php echo e($waktu[1]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Rabu -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Rabu</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_rabu" value="<?php echo e($waktu[2]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_rabu" value="<?php echo e($waktu[2]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Kamis -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Kamis</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_kamis" value="<?php echo e($waktu[3]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_kamis" value="<?php echo e($waktu[3]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Jumat -->
                                <div class="schedule-row jumat-highlight">
                                    <div class="day-label"><i class="fa-solid fa-star"></i> Jumat</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_jumat" value="<?php echo e($waktu[4]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_jumat" value="<?php echo e($waktu[4]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hari Sabtu -->
                                <div class="schedule-row">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> Sabtu</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_sabtu" value="<?php echo e($waktu[5]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_sabtu" value="<?php echo e($waktu[5]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hari Sabtu -->
                                <div class="schedule-row" style="display: none;">
                                    <div class="day-label"><i class="fa-regular fa-calendar-check"></i> minggu</div>
                                    <div class="time-inputs">
                                        <div class="time-field">
                                            <small>Masuk</small>
                                            <input type="time" name="jam_masuk_minggu" value="<?php echo e($waktu[6]->waktu_masuk); ?>" class="form-control" required>
                                        </div>
                                        <span class="separator"><i class="fa-solid fa-arrow-right-long"></i></span>
                                        <div class="time-field">
                                            <small>Pulang</small>
                                            <input type="time" name="jam_keluar_minggu" value="<?php echo e($waktu[6]->waktu_keluar); ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="action-footer">
                            <button type="submit" class="btn-save">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan Seluruh Pengaturan
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </main>
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
    <!-- Leaflet JS & Script Map Interaktif -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="<?php echo e(asset('js/modul/guru/setting_absen.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\guru\a\setting_absen.blade.php ENDPATH**/ ?>
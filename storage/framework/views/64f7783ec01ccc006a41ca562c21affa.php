<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS Guru - Dashboard</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/das_ad_gr.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/dashboard_guru.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="app-layout">
        
        <!-- INCLUDE SIDEBAR -->
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

        <!-- MAIN CONTENT AREA -->
        <main class="main-content">
            
            <!-- TOP NAVBAR -->
            <header class="topbar">
                <div class="page-title">
                    <h2>Dashboard Utama</h2>
                    <p>Selamat datang kembali, <strong><?php echo e($data_guru->nama); ?></strong></p>
                </div>
                <div class="topbar-actions">
                    <div class="user-profile">
                        <img src="<?php echo e(route('file.show',$data_guru->url_foto)); ?>" alt="Foto Profil">
                        <div class="user-info">
                            <span class="name"><?php echo e($data_guru->nama); ?></span>
                            <?php if($data_guru->bendahara): ?>
                                <span class="role">bendahara</span>
                            <?php elseif($data_guru->operator): ?>
                                <span class="role">operator</span>
                            <?php elseif($data_guru->satpam): ?>
                                <span class="role">satpam</span>
                            <?php else: ?>
                                <span class="role"><?php echo e($data_guru->guru_tetap ? "guru tetap" : "guru honor"); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <div class="content-body">
                <!-- Hidden Input Koordinat Lokasi Sekolah (Data Dummy) -->
                <input type="hidden" class="latitude" value="<?php echo e($latitude); ?>">
                <input type="hidden" class="longitude" value="<?php echo e($longitude); ?>">
                
                <!-- 1. STATISTIC CARDS -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon bg-primary-light">
                            <i class="fa-solid fa-calendar-check text-primary"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Ketidakhadiran Bulan Ini</span>
                            <h3><?php echo e($data_ketidakhadiran); ?></h3>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-warning-light">
                            <i class="fa-solid fa-user-clock text-warning"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Terlambat(menit) hari ini</span>
                            <small><?php echo e($data_terlambat); ?></small>
                            <!-- <h3>15 <small>menit</small></h3> -->
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon bg-info-light">
                            <i class="fa-solid fa-mug-hot text-info"></i>
                        </div>
                        <div class="stat-data">
                            <span class="label">Jumlah Pengajuan</span>
                            <h3>0</h3>
                        </div>
                    </div>
                </div>

                <!-- 2. MAIN SECTION: PRESENSI, JADWAL PIKET & PENGUMUMAN -->
                <div class="dashboard-grid">
                    
                    <!-- Widget Absensi Hari Ini -->
                    <div class="card widget-presensi">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-location-dot"></i> Presensi Hari Ini</h4>
                            <span class="date-badge"><?php echo e($nama_hari); ?>, <?php echo e($tanggal_hari_ini); ?></span>
                        </div>
                        <div class="card-body">
                            <?php if($cek_sudah_absen): ?>
                                <div class="status-box status-success">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <div>
                                        <h5>Sudah Absen Masuk</h5>
                                        <p>Tercatat pukul <?php echo e(Carbon\Carbon::parse($jam_masuk)->translatedFormat('H:i')); ?> WITA</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php if($cek_status_absen): ?>
                                    <?php if($status_absen->status_kehadiran == 's'): ?>
                                        <div class="status-box status-warning">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            <div>
                                                <h5>Anda Di Statuskan Sakit</h5>
                                                <p>semoga lekas sembuh</p>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="status-box status-warning">
                                            <i class="fa-solid fa-circle-xmark"></i>
                                            <div>
                                                <h5>Anda Di Statuskan Izin</h5>
                                                <p>semoga urusannya di lancarkan</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="status-box status-warning">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                        <div>
                                            <h5>Belum Melakukan Absen</h5>
                                            <p>harap melakukan absen segera</p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <div class="time-tracker">
                                <div class="time-box">
                                    <span class="time-title">Jam Masuk</span>
                                    <span class="time-value"><?php echo e($jam_masuk); ?></span>
                                </div>
                                <div class="time-divider"><i class="fa-solid fa-arrow-right"></i></div>
                                <div class="time-box">
                                    <span class="time-title">Jam Pulang</span>
                                    <span class="time-value"><?php echo e($jam_keluar); ?></span>
                                </div>
                            </div>

                            <!-- Element untuk Menampilkan Pesan Radius Geolocation -->
                            <div id="location-status" style="margin-top: 15px; font-size: 0.9rem;"></div>

                            <?php
                                $bolehAbsenPulangSecaraBisnis = $cek_sudah_absen && $cek_sudah_keluar && !$cek_sudah_absen_oleh_admin;
                            ?>
                            <div class="action-buttons" style="margin-top: 15px;">
                                <button
                                    class="btn btn-primary"
                                    id="btn_keluar"
                                    data-status="<?php echo e($bolehAbsenPulangSecaraBisnis ? 'boleh' : 'tidak'); ?>"
                                    disabled
                                >
                                    <i class="fa-solid fa-right-from-bracket"></i> Absen Pulang
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php if(!$data_guru->bendahara && !$data_guru->operator && !$data_guru->satpam): ?>
                        <!-- CARD BARU: Widget Jadwal Piket Guru -->
                        <div class="card widget-piket">
                            <div class="card-header">
                                <h4><i class="fa-solid fa-user-shield"></i> Jadwal Piket Minggu Ini</h4>
                                <span class="badge-status-piket">Aktif</span>
                            </div>
                            <div class="card-body">
                                <div class="piket-list">
                                    <?php $__currentLoopData = $data_piket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $piket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            Carbon\Carbon::setlocale("id");
                                            $cek_hari_ini = Carbon\Carbon::now()->translatedFormat("l") == $piket->hari;
                                        ?>
                                        <div class="piket-item <?php echo e($cek_hari_ini ? 'piket-today' : ''); ?>">
                                            <div class="piket-date-box">
                                                <span class="piket-day"><?php echo e($piket->hari); ?></span>
                                            </div>
                                            <div class="piket-info">
                                                <h5><?php echo e($piket->nama); ?></h5>
                                                <p><i class="fa-regular fa-clock"></i> <?php echo e(Carbon\Carbon::parse($piket->jam)->translatedFormat('H:i')); ?> WITA</p>
                                            </div>
                                            <?php if($cek_hari_ini): ?>
                                                <span class="badge-today">Hari Ini</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Pengumuman Terbaru -->
                    <div class="card widget-pengumuman">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-bullhorn"></i> Pengumuman Sekolah</h4>
                            <a href="/gr/pggr" class="link-more">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="announcement-list">
                                <?php $__currentLoopData = $data_pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="announcement-item">
                                        <div class="badge-date"><?php echo e(Carbon\Carbon::parse($value->tanggal)->translatedFormat("d")); ?> <?php echo e(strtoupper(Carbon\Carbon::parse($value->tanggal)->translatedFormat("M"))); ?></div>
                                        <div class="announcement-text">
                                            <h5><?php echo e($value->judul); ?></h5>
                                            <p><?php echo e($value->isi); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
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

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const RADIUS_METER = 500;

        const statusElement = document.getElementById('location-status');
        const button = document.getElementById('btn_keluar');

        function updateButtonState(bolehKarenaLokasi) {
            if (!button) return;

            const bolehSecaraBisnis = button.dataset.status === "boleh";

            if (bolehKarenaLokasi && bolehSecaraBisnis) {
                button.removeAttribute("disabled");
            } else {
                button.setAttribute("disabled", "");
            }
        }

        function tampilkanPesanLokasi(html, className) {
            if (!statusElement) return;
            statusElement.className = className;
            statusElement.innerHTML = html;
        }

        const isSecureContext = window.isSecureContext ||
            location.protocol === 'https:' ||
            location.hostname === 'localhost';

        if (!isSecureContext) {
            tampilkanPesanLokasi(
                '<i class="fa-solid fa-triangle-exclamation" style="color:#e63946;"></i> ' +
                'Deteksi lokasi butuh koneksi HTTPS. Buka halaman ini lewat https:// agar absen pulang bisa aktif.',
                'location-status status-warn'
            );
            updateButtonState(false);
        } else if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function (position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;
                    const akurasi = position.coords.accuracy;

                    const latInput = document.querySelector(".latitude");
                    const lngInput = document.querySelector(".longitude");

                    if (!latInput || !lngInput) return;

                    const dataLatitude = parseFloat(latInput.value);
                    const dataLongitude = parseFloat(lngInput.value);

                    const distance = calculateDistance(dataLatitude, dataLongitude, userLat, userLng);
                    const dalamRadius = distance <= RADIUS_METER;

                    if (dalamRadius) {
                        tampilkanPesanLokasi(
                            '<i class="fa-solid fa-circle-check" style="color: #2ec4b6;"></i> ' +
                            'Anda berada dalam radius presensi (' + Math.round(distance) + ' meter dari sekolah).',
                            'location-status status-ok'
                        );
                    } else {
                        let pesanAkurasi = '';
                        if (akurasi && akurasi > 200) {
                            pesanAkurasi = ' Akurasi lokasi perangkat ini rendah (\u00b1' + Math.round(akurasi) +
                                ' m) \u2014 coba gunakan HP dengan GPS aktif untuk hasil lebih akurat.';
                        }

                        tampilkanPesanLokasi(
                            '<i class="fa-solid fa-triangle-exclamation" style="color: #e63946;"></i> ' +
                            'Anda di luar radius presensi (' + Math.round(distance) + ' meter dari sekolah).' + pesanAkurasi,
                            'location-status status-warn'
                        );
                    }

                    updateButtonState(dalamRadius);
                },
                function (error) {
                    let pesan = 'Gagal mendapatkan lokasi Anda.';
                    if (error.code === error.PERMISSION_DENIED) {
                        pesan = 'Izin lokasi ditolak. Aktifkan izin lokasi di browser/perangkat Anda untuk bisa absen pulang.';
                    } else if (error.code === error.POSITION_UNAVAILABLE) {
                        pesan = 'Lokasi tidak tersedia. Pastikan GPS/Location Service perangkat Anda aktif.';
                    } else if (error.code === error.TIMEOUT) {
                        pesan = 'Waktu pencarian lokasi habis. Coba lagi di area dengan sinyal lebih baik.';
                    }

                    console.warn("Gagal mendapatkan lokasi: " + error.message);
                    tampilkanPesanLokasi(
                        '<i class="fa-solid fa-triangle-exclamation" style="color: #e63946;"></i> ' + pesan,
                        'location-status status-warn'
                    );
                    updateButtonState(false);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0
                }
            );
        } else {
            tampilkanPesanLokasi(
                '<i class="fa-solid fa-triangle-exclamation" style="color: #e63946;"></i> ' +
                'Browser Anda tidak mendukung Geolocation.',
                'location-status status-warn'
            );
            updateButtonState(false);
        }

        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371e3;
            const φ1 = lat1 * Math.PI / 180;
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) +
                    Math.cos(φ1) * Math.cos(φ2) *
                    Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; 
        }

        function closeToast() {
            const toast = document.getElementById('errorToast');
            if (toast) {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                }, 400);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.getElementById('errorToast');
            if (toast) {
                setTimeout(() => {
                    closeToast();
                }, 5000);
            }

            if (button) {
                button.addEventListener('click', () => {
                    if (button.hasAttribute('disabled')) return;
                    window.location.href = "/gr/klabs";
                });
            }
        });
    </script>
</body>
</html> <?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\guru\g\dashboard.blade.php ENDPATH**/ ?>
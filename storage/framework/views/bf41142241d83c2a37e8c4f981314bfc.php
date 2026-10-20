<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Siswa - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/profilsiswa.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR SISWA -->
        <?php if (isset($component)) { $__componentOriginal84bdda8141b034a96f80d0303326857e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84bdda8141b034a96f80d0303326857e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_tahfiz','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_tahfiz'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84bdda8141b034a96f80d0303326857e)): ?>
<?php $attributes = $__attributesOriginal84bdda8141b034a96f80d0303326857e; ?>
<?php unset($__attributesOriginal84bdda8141b034a96f80d0303326857e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84bdda8141b034a96f80d0303326857e)): ?>
<?php $component = $__componentOriginal84bdda8141b034a96f80d0303326857e; ?>
<?php unset($__componentOriginal84bdda8141b034a96f80d0303326857e); ?>
<?php endif; ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Profil Siswa 👤</h2>
                    <p class="subtitle-text">Informasi biodata diri, data akademik, dan akun pengguna Tahfiz Digital.</p>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell"></i>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- PROFILE SUMMARY BANNER -->
            <div class="student-profile-banner">
                <div class="student-profile">
                    <div class="avatar"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="student-info">
                        <h3>Ali Rahman</h3>
                        <p>NISN: <strong>0081234567</strong> | NIS: <strong>202601001</strong></p>
                        <p>Status Santri: <span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></p>
                    </div>
                </div>
                <div class="target-today-badge">
                    <span>Capaian Hafalan:</span>
                    <strong>2 Juz (Juz 30 & 29)</strong>
                </div>
            </div>

            <!-- STATISTIC CARDS SISWA -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Kelas 1A</h3>
                    <p>Tingkat / Kelas</p>
                </div>
                <div class="stat-card">
                    <h3>Halaqah 1</h3>
                    <p>Kelompok Halaqah</p>
                </div>
                <div class="stat-card">
                    <h3>Ustadz Ahmad</h3>
                    <p>Pengampu Tahfiz</p>
                </div>
                <div class="stat-card">
                    <h3>2025/2026</h3>
                    <p>Tahun Ajaran</p>
                </div>
            </div>

            <!-- DATA BIODATA LENGKAP -->
            <div class="summary-filter-row">
                
                <!-- DATA PRIBADI & AKADEMIK -->
                <div class="summary-box" style="flex: 2;">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-address-card style-gold"></i> Biodata Lengkap Siswa</h4>
                        <button type="button" class="btn-outline-sm">
                            <i class="fa-solid fa-pen-to-square"></i> Ajukan Perubahan
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table-compact">
                            <tbody>
                                <tr>
                                    <td class="cell-strong" style="width: 30%;">Nama Lengkap</td>
                                    <td>Ali Rahman</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">Nama Panggilan</td>
                                    <td>Ali</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">Jenis Kelamin</td>
                                    <td>Laki-laki</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">Tempat, Tanggal Lahir</td>
                                    <td>Makassar, 12 Agustus 2018</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">Nomor Induk Santri (NIS)</td>
                                    <td>202601001</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">NISN</td>
                                    <td>0081234567</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">Alamat Tempat Tinggal</td>
                                    <td>Jl. Ahmad Yani No. 45, Makassar, Sulawesi Selatan</td>
                                </tr>
                                <tr>
                                    <td class="cell-strong">Tanggal Masuk Tahfiz</td>
                                    <td>15 Juli 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- DATA ORANG TUA / WALI & AKUN -->
                <div class="filter-box" style="flex: 1;">
                    <h4><i class="fa-solid fa-users style-gold"></i> Data Orang Tua / Wali</h4>
                    
                    <div class="status-card-today">
                        <div class="status-item">
                            <label>Nama Ayah:</label>
                            <span class="cell-strong">Rahman Hidayat</span>
                        </div>
                        <div class="status-item mt-15">
                            <label>Nama Ibu:</label>
                            <span class="cell-strong">Siti Aminah</span>
                        </div>
                        <div class="status-item mt-15">
                            <label>No. WhatsApp Orang Tua:</label>
                            <span class="badge success"><i class="fa-brands fa-whatsapp"></i> 081234567890</span>
                        </div>
                        <div class="status-item mt-15">
                            <label>Pekerjaan Orang Tua:</label>
                            <span>Wiraswasta</span>
                        </div>
                    </div>

                    <h4 class="mt-15" style="margin-top: 25px;"><i class="fa-solid fa-key style-gold"></i> Keamanan Akun</h4>
                    <div class="status-card-today">
                        <div class="status-item">
                            <label>Username / Email:</label>
                            <span class="cell-strong">ali.rahman@tahfiz.sch.id</span>
                        </div>
                        <div class="mt-15">
                            <button type="button" class="btn-pdf w-100" style="background-color: var(--primary-light); color: var(--primary-dark); border-color: var(--primary-color);">
                                <i class="fa-solid fa-lock"></i> Ubah Kata Sandi
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/siswa/profilsiswa.blade.php ENDPATH**/ ?>
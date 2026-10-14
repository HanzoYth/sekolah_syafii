<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Siswa - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/tahfiz/manajemen_siswa.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
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
                <div class="topbar-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Manajemen Siswa</span></p>
                    <h2>Manajemen Data Siswa</h2>
                </div>
                <div class="topbar-icons">
                    <div class="notification-badge-wrapper">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC SUMMARY CARDS -->
            <div class="stats-grid-admin">
                <div class="stat-card">
                    <div class="stat-icon emerald"><i class="fa-solid fa-user-graduate"></i></div>
                    <div class="stat-info">
                        <h3>300</h3>
                        <p>Total Seluruh Siswa</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon gold"><i class="fa-solid fa-school"></i></div>
                    <div class="stat-info">
                        <h3>6</h3>
                        <p>Total Kelas Aktif</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
                    <div class="stat-info">
                        <h3>292</h3>
                        <p>Siswa Aktif (Masuk)</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fa-solid fa-user-slash"></i></div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Akun Nonaktif / Cuti</p>
                    </div>
                </div>
            </div>

            <!-- TOOLBAR: FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama siswa atau NISN...">
                </div>
                <div class="toolbar-filters">
                    <select class="form-control-select">
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                    <select class="form-control-select">
                        <option>Semua Halaqah</option>
                        <option>Halaqah 1</option>
                        <option>Halaqah 2</option>
                    </select>
                    <select class="form-control-select">
                        <option>Status: Semua</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                    </select>
                </div>
                <button class="btn-primary-gold" onclick="document.getElementById('modalTambahSiswa').classList.add('show')">
                    <i class="fa-solid fa-user-plus"></i> Tambah Siswa
                </button>
            </div>

            <!-- TABEL DATA SISWA -->
            <div class="table-card">
                <div class="table-header-flex">
                    <h4>Daftar Seluruh Siswa Tahfiz</h4>
                    <span class="text-muted text-sm">Menampilkan 1-4 dari 300 siswa</span>
                </div>
                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa & NISN</th>
                                <th>Kelas</th>
                                <th>Halaqah & Pengampu</th>
                                <th>Juz Saat Ini</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="student-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Ali</span>
                                            <small class="text-muted">NISN: 0081234561</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kelas 1A</td>
                                <td>
                                    <strong>Halaqah 1</strong><br>
                                    <small class="text-muted">Ustadz Ahmad</small>
                                </td>
                                <td><span class="badge-juz">Juz 29</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Pindah Halaqah" onclick="document.getElementById('modalPindahHalaqah').classList.add('show')"><i class="fa-solid fa-right-left"></i></button>
                                        <button title="Edit Data" onclick="document.getElementById('modalTambahSiswa').classList.add('show')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Nonaktifkan Akun" class="highlight"><i class="fa-solid fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="student-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Budi</span>
                                            <small class="text-muted">NISN: 0081234562</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kelas 1A</td>
                                <td>
                                    <strong>Halaqah 1</strong><br>
                                    <small class="text-muted">Ustadz Ahmad</small>
                                </td>
                                <td><span class="badge-juz">Juz 29</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Pindah Halaqah" onclick="document.getElementById('modalPindahHalaqah').classList.add('show')"><i class="fa-solid fa-right-left"></i></button>
                                        <button title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Nonaktifkan Akun" class="highlight"><i class="fa-solid fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="student-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Citra</span>
                                            <small class="text-muted">NISN: 0081234563</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kelas 1A</td>
                                <td>
                                    <strong>Halaqah 2</strong><br>
                                    <small class="text-muted">Ustadzah Aisyah</small>
                                </td>
                                <td><span class="badge-juz">Juz 30</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Pindah Halaqah"><i class="fa-solid fa-right-left"></i></button>
                                        <button title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Nonaktifkan Akun" class="highlight"><i class="fa-solid fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="student-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Dafa</span>
                                            <small class="text-muted">NISN: 0081234564</small>
                                        </div>
                                    </div>
                                </td>
                                <td>Kelas 2B</td>
                                <td>
                                    <strong>Halaqah 1</strong><br>
                                    <small class="text-muted">Ustadz Fajar</small>
                                </td>
                                <td><span class="badge-juz">Juz 28</span></td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Nonaktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Pindah Halaqah"><i class="fa-solid fa-right-left"></i></button>
                                        <button title="Edit Data"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Aktifkan Kembali Akun" class="success-btn"><i class="fa-solid fa-check"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL TAMBAH / EDIT SISWA -->
    <div class="modal-overlay" id="modalTambahSiswa">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">FORM DATA SISWA</span>
                    <h3>Tambah / Ubah Siswa</h3>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalTambahSiswa').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group-stack">
                        <label>Nama Lengkap Siswa</label>
                        <input type="text" class="input-control" placeholder="Cth: Muhammad Al Fatih" required>
                    </div>
                    <div class="form-group-stack">
                        <label>NISN</label>
                        <input type="text" class="input-control" placeholder="Nomor Induk Siswa Nasional" required>
                    </div>
                    <div class="form-row-grid">
                        <div class="form-group-stack">
                            <label>Kelas</label>
                            <select class="input-control">
                                <option>Kelas 1A</option>
                                <option>Kelas 1B</option>
                                <option>Kelas 2B</option>
                            </select>
                        </div>
                        <div class="form-group-stack">
                            <label>Kelompok Halaqah</label>
                            <select class="input-control">
                                <option>Halaqah 1 (Ustadz Ahmad)</option>
                                <option>Halaqah 2 (Ustadzah Aisyah)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group-stack">
                        <label>Posisi Juz Saat Ini</label>
                        <select class="input-control">
                            <option>Juz 29</option>
                            <option>Juz 30</option>
                            <option>Juz 28</option>
                        </select>
                    </div>
                    <div class="modal-footer-action">
                        <button type="button" class="btn-back" onclick="document.getElementById('modalTambahSiswa').classList.remove('show')">Batal</button>
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-floppy-disk"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PINDAH HALAQAH -->
    <div class="modal-overlay" id="modalPindahHalaqah">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">MUTASI HALAQAH</span>
                    <h3>Pindahkan Siswa ke Halaqah Lain</h3>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalPindahHalaqah').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="alert-item mb-15">
                        <div class="alert-meta">
                            <strong>Siswa Terpilih: Ali (Kelas 1A)</strong>
                            <p>Halaqah Saat Ini: Halaqah 1 (Ustadz Ahmad)</p>
                        </div>
                    </div>
                    <div class="form-group-stack">
                        <label>Pindah ke Kelas Tujuan</label>
                        <select class="input-control">
                            <option value="1a">Kelas 1A</option>
                            <option value="2b">Kelas 2B</option>
                        </select>
                    </div>
                    <div class="form-group-stack">
                        <label>Pilih Halaqah & Pengampu Baru</label>
                        <select class="input-control">
                            <option>Halaqah 2 - Ustadzah Aisyah, Lc.</option>
                            <option>Halaqah 1 - Ustadz Fajar Pratama</option>
                        </select>
                    </div>
                    <div class="modal-footer-action">
                        <button type="button" class="btn-back" onclick="document.getElementById('modalPindahHalaqah').classList.remove('show')">Batal</button>
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-right-left"></i> Pindahkan Siswa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/tahfiz/admin/manajemen.blade.php ENDPATH**/ ?>
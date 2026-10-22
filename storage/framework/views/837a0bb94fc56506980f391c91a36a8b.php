<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa - Sekolah Al-Qur'an Imam Syafi'i</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <!-- CSS Form Admin -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/formulir_siswa.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <!-- CONTAINER UTAMA -->
    <div class="form-guru-container">
        
        <!-- HEADER / TOPBAR -->
        <header class="topbar">
            <div class="topbar-title">
                <h2>Tambah Data Siswa</h2>
                <p>Input data pribadi dan akademik siswa</p>
            </div>
            <?php if(session('role') === 'a'): ?>
                <a href="/sk/ds" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Data Siswa
                </a>
            <?php else: ?>
                <a href="/reg/logout" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Keluar
                </a>
            <?php endif; ?>

        </header>

        <!-- KONTEN FORM -->
        <section class="content-body">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-user-graduate"></i> Formulir Bio Data Siswa</h3>
                </div>

                <form id="formSiswa" action="/sk/tbss" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-grid">
                        
                        <!-- 1. NAMA LENGKAP ($table->string('nama')) -->
                        <div class="form-group full-width">
                            <label for="namaSiswa">Nama Lengkap <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" id="namaSiswa" name="nama" value="<?php echo e(old('nama')); ?>" placeholder="Contoh: Abdullah Ahmad" required autocomplete="off">
                            </div>
                        </div>

                        <!-- 2. NIS ($table->string('nis')->unique()) -->
                        <div class="form-group">
                            <label for="nis">Nomor Induk Siswa (NIS) <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-id-badge"></i>
                                <input type="text" id="nis" name="nis" value="<?php echo e(old('nis')); ?>" placeholder="Contoh: 23241001" required autocomplete="off">
                            </div>
                        </div>

                        <!-- 4. TEMPAT LAHIR ($table->string('tempat_lahir')->nullable()) -->
                        <div class="form-group">
                            <label for="tempatLahir">Tempat Lahir</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-location-dot"></i>
                                <input type="text" id="tempatLahir" name="tempat_lahir" value="<?php echo e(old('tempat_lahir')); ?>" placeholder="Contoh: Jakarta" autocomplete="off">
                            </div>
                        </div>

                        <!-- 5. TANGGAL LAHIR ($table->date('tanggal_lahir')->nullable()) -->
                        <div class="form-group">
                            <label for="tanggalLahir">Tanggal Lahir</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-calendar-days"></i>
                                <input type="date" id="tanggalLahir" name="tanggal_lahir" value="<?php echo e(old('tanggal_lahir')); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-mosque"></i>
                                <input type="text" id="agama" name="agama" value="<?php echo e(old('agama', 'Islam')); ?>" class="form-control" placeholder="Agama">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenisSekolah">Jenis Sekolah <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-building-columns"></i>
                                <select id="jenisSekolah" name="sekolah_id" required>
                                    <option value="" disabled selected>-- Pilih jenis sekolah --</option>
                                    <?php $__currentLoopData = $data_jenis_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->jenis); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <!-- 6. JENIS KELAMIN ($table->enum('jenis_kelamin', ['l', 'p'])) -->
                        <div class="form-group">
                            <label for="jenisKelamin">Jenis Kelamin <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-venus-mars"></i>
                                <select id="jenisKelamin" name="jenis_kelamin" required>
                                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- 7. KELAS ($table->foreignId('kelas_id')) -->
                        <div class="form-group">
                            <label for="kelasId">Kelas</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-chalkboard-user"></i>
                                <select id="kelasId" name="kelas_id">
                                    <option value="" selected>-- Pilih Kelas --</option>
                                    <?php $__currentLoopData = $data_ruang_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->nama_ruang); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <!-- 8. TAHUN AJARAN ($table->foreignId('tahun_ajaran_id')) -->
                        <div class="form-group full-width">
                            <label for="tahunAjaranId">Tahun Ajaran</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-calendar-check"></i>
                                <select id="tahunAjaranId" name="tahun_ajaran_id">
                                    <option value="" selected>-- Pilih Tahun Ajaran --</option>
                                    <?php $__currentLoopData = $data_tahun_ajaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>"><?php echo e($value->nama); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <!-- 9. UPLOAD FOTO / URL FOTO ($table->string('url_foto')->nullable()) -->
                        <div class="form-group full-width">
                            <label for="inputFoto">Foto Profil Siswa <span style="font-size: 11px; font-weight: normal; color: #64748b;">(Opsional, format JPG/PNG maks. 2MB)</span></label>
                            <div class="photo-preview-container">
                                <div class="avatar-preview" id="avatarPreview">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <div class="input-wrapper">
                                    <i class="fa-solid fa-upload"></i>
                                    <input type="file" id="inputFoto" name="url_foto" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <!-- 10. ALAMAT LENGKAP ($table->string('alamat')->nullable()) -->
                        <div class="form-group full-width">
                            <label for="alamat">Alamat Lengkap</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-map-location-dot"></i>
                                <textarea id="alamat" name="alamat" placeholder="Masukkan alamat domisili siswa..."></textarea>
                            </div>
                        </div>

                    </div>

                    <!-- BUTTON ACTIONS -->
                    <div class="form-actions">
                        <button type="reset" class="btn-reset" id="btnReset">Reset</button>
                        <button type="submit" class="btn-save">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Data Siswa
                        </button>
                    </div>
                </form>

            </div>
        </section>

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

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const inputFoto = document.getElementById('inputFoto');
        const avatarPreview = document.getElementById('avatarPreview');
        const defaultAvatarHtml = '<i class="fa-solid fa-user"></i>';

        // Live Preview Foto
        inputFoto.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview Foto">`;
                };
                reader.readAsDataURL(file);
            } else {
                avatarPreview.innerHTML = defaultAvatarHtml;
            }
        });

        // Reset Handler
        document.getElementById('btnReset').addEventListener('click', () => {
            setTimeout(() => {
                avatarPreview.innerHTML = defaultAvatarHtml;
            }, 10);
        });
    </script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\guru\formulir_siswa.blade.php ENDPATH**/ ?>
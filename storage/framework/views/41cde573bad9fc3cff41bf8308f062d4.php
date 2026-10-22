<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru - Dashboard Tahfiz</title>
    <!-- Font Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/guru/profile.css')); ?>?v=<?php echo e(time()); ?>">
</head>


<body>
    <div class="app-layout">
        
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

        <main class="main-content">
            <div class="edit-container">
                <!-- HEADER DASHBOARD -->
                <div class="edit-header">
                    <div class="header-title">
                        <h2><i class="fa-solid fa-user-pen header-icon"></i> Edit Profil Anda</h2>
                        <p>Perbarui informasi biodata serta kredensial akun akses guru secara berkala.</p>
                    </div>
                </div>

                <!-- FORM CARD -->
                <div class="edit-card">
                    <form action="/gr/upprgr" method="POST" enctype="multipart/form-data" id="profileForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($data_guru->id); ?>" name="id_guru" id="id_guru">  
                        
                        <!-- SECTION 1: FOTO PROFIL -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-camera"></i></span>
                                <div>
                                    <h3>Foto Profil</h3>
                                    <small>Format pendukung: JPG, JPEG, PNG (Maks. 2MB)</small>
                                </div>
                            </div>
                            <div class="photo-upload-wrapper">
                                <div class="photo-preview-container">
                                    <img src="<?php echo e(route('file.show', $data_guru->url_foto)); ?>" alt="Foto Profil Guru" class="photo-preview" id="previewFoto">
                                    <label for="foto" class="photo-overlay-btn" title="Ubah Foto">
                                        <i class="fa-solid fa-pen"></i>
                                    </label>
                                </div>
                                <div class="photo-input-group">
                                    <label for="foto" class="custom-file-label">
                                        <i class="fa-solid fa-cloud-arrow-up"></i> Pilih Foto Baru
                                    </label>
                                    <input type="file" id="foto" name="foto" class="file-input-hidden" accept="image/*" onchange="previewImage(event)">
                                    <span class="file-name-indicator" id="fileName">Belum ada file baru dipilih</span>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: BIODATA PRIBADI -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-address-card"></i></span>
                                <div>
                                    <h3>Biodata Pribadi</h3>
                                    <small>Informasi pribadi dan identitas pengajar</small>
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap & Gelar</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input type="text" id="nama" name="nama" class="form-control" value="<?php echo e($data_guru->nama); ?>" required placeholder="Nama lengkap beserta gelar">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nig">NIG (Nomor Induk Guru)</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-id-badge input-icon"></i>
                                        <input type="text" id="nig" name="nig" class="form-control" value="<?php echo e($data_guru->nig); ?>" required placeholder="Nomor Induk Guru">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="wa">Nomor WhatsApp Aktif</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-brands fa-whatsapp input-icon"></i>
                                        <input type="text" id="wa" name="wa" class="form-control" value="<?php echo e($nomor_wa); ?>" required placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-location-dot input-icon"></i>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="<?php echo e($data_guru->tempat_lahir); ?>" required placeholder="Kota kelahiran">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-calendar-day input-icon"></i>
                                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?php echo e($data_guru->tanggal_lahir); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-mosque input-icon"></i>
                                        <input type="text" id="agama" name="agama" class="form-control" value="<?php echo e($data_guru->agama); ?>" required placeholder="Agama">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-graduation-cap input-icon"></i>
                                        <select id="pendidikan_terakhir" name="pendidikan_terakhir" class="form-control" required>
                                            <option value="" disabled>-- Pilih Pendidikan --</option>
                                            <option value="smp" <?php echo e($data_guru->pendidikan_terakhir == 'smp' ? 'selected' : ""); ?>>SMP / Sederajat</option>
                                            <option value="sma" <?php echo e($data_guru->pendidikan_terakhir == 'sma' ? 'selected' : ""); ?>>SMA / MA / Sederajat</option>
                                            <option value="s1" <?php echo e($data_guru->pendidikan_terakhir == 's1' ? 'selected' : ""); ?>>S1 (Sarjana)</option>
                                            <option value="s2" <?php echo e($data_guru->pendidikan_terakhir == 's2' ? 'selected' : ""); ?>>S2 (Magister)</option>
                                            <option value="s3" <?php echo e($data_guru->pendidikan_terakhir == 's3' ? 'selected' : ""); ?>>S3 (Doktor)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group span-2">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-house input-icon textarea-icon"></i>
                                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required placeholder="Alamat domisili lengkap"><?php echo e($data_guru->alamat); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION: DOKUMEN PENDUKUNG (KTP, KK, IJAZAH) -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-file-contract"></i></span>
                                <div>
                                    <h3>Dokumen Pendukung</h3>
                                    <small>Upload berkas identitas dan kualifikasi (PDF, JPG, JPEG, PNG - Maks. 2MB)</small>
                                </div>
                            </div>

                            <?php
                                // kunci = nama kolom di tabel guru
                                // input = nama input file yang dibaca controller
                                $dokumen = [
                                    'ktp'    => ['label' => 'Kartu Tanda Penduduk (KTP)', 'input' => 'file_ktp',    'tombol' => 'Pilih File KTP',    'ikon' => 'fa-id-card', 'lebar' => false],
                                    'kk'     => ['label' => 'Kartu Keluarga (KK)',       'input' => 'file_kk',     'tombol' => 'Pilih File KK',     'ikon' => 'fa-users',   'lebar' => false],
                                    'ijazah' => ['label' => 'Ijazah Terakhir',            'input' => 'file_ijazah', 'tombol' => 'Pilih File Ijazah', 'ikon' => 'fa-scroll',  'lebar' => true],
                                ];
                            ?>

                            <div class="form-grid">
                                <?php $__currentLoopData = $dokumen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kolom => $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $berkas = $data_guru->$kolom; ?>

                                    <div class="form-group <?php echo e($doc['lebar'] ? 'span-2' : ''); ?>">
                                        <label for="<?php echo e($doc['input']); ?>"><?php echo e($doc['label']); ?></label>

                                        <div class="doc-card">
                                            <!-- Berkas yang sudah tersimpan -->
                                            <div class="doc-saved">
                                                <span class="doc-thumb">
                                                    <i class="fa-solid <?php echo e($berkas ? 'fa-file-lines' : 'fa-file'); ?>"></i>
                                                </span>

                                                <div class="doc-meta">
                                                    <?php if($berkas): ?>
                                                        <span class="doc-name"><?php echo e(basename($berkas)); ?></span>
                                                        <span class="doc-status is-saved">
                                                            <i class="fa-solid fa-circle-check"></i> Sudah diunggah
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="doc-name">Belum ada berkas tersimpan</span>
                                                        <span class="doc-status is-empty">
                                                            <i class="fa-solid fa-circle-exclamation"></i> Belum diunggah
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if($berkas): ?>
                                                    <a href="<?php echo e(route('pdf.show', $berkas)); ?>" target="_blank" rel="noopener" class="btn-view-doc">
                                                        <i class="fa-solid fa-eye"></i> Lihat
                                                    </a>
                                                <?php else: ?>
                                                    <span class="btn-view-doc is-disabled" aria-disabled="true">
                                                        <i class="fa-solid fa-eye"></i> Lihat
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Ganti dengan berkas baru -->
                                            <div class="doc-upload">
                                                <label for="<?php echo e($doc['input']); ?>" class="custom-file-label">
                                                    <i class="fa-solid <?php echo e($doc['ikon']); ?>"></i> <?php echo e($doc['tombol']); ?>

                                                </label>
                                                <input type="file" id="<?php echo e($doc['input']); ?>" name="<?php echo e($doc['input']); ?>" class="file-input-hidden" accept="image/*,.pdf" onchange="showFileName(event, '<?php echo e($kolom); ?>')">
                                                <span class="file-name-indicator" id="fileName-<?php echo e($kolom); ?>">Belum ada file baru dipilih</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- SECTION 3: STATUS & PERAN GURU -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-user-shield"></i></span>
                                <div>
                                    <h3>Status & Peran Guru</h3>
                                    <small>Penugasan akademik (Read-only)</small>
                                </div>
                            </div>

                            <div class="checkbox-grid">
                                <label class="checkbox-card <?php echo e($data_guru->guru_tetap ? 'active' : ''); ?>">
                                    <input type="checkbox" name="guru_tetap" value="0" disabled <?php echo e($data_guru->guru_tetap ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-user-check"></i>
                                        <span>Guru Tetap</span>
                                    </div>
                                </label>

                                <label class="checkbox-card <?php echo e($data_guru->guru_honor ? 'active' : ''); ?>">
                                    <input type="checkbox" name="guru_honor" value="0" disabled <?php echo e($data_guru->guru_honor ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-user-clock"></i>
                                        <span>Guru Honor</span>
                                    </div>
                                </label>

                                <label class="checkbox-card <?php echo e($data_guru->pengampu_tahfiz ? 'active' : ''); ?>">
                                    <input type="checkbox" name="pengampu_tahfiz" value="0" disabled <?php echo e($data_guru->pengampu_tahfiz ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-book-quran"></i>
                                        <span>Pengampu Tahfiz</span>
                                    </div>
                                </label>

                                <label class="checkbox-card <?php echo e($data_guru->koordinator_tahfiz ? 'active' : ''); ?>">
                                    <input type="checkbox" name="koordinator_tahfiz" value="0" disabled <?php echo e($data_guru->koordinator_tahfiz ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-crown"></i>
                                        <span>Koordinator Tahfiz</span>
                                    </div>
                                </label>

                                <label class="checkbox-card <?php echo e($data_guru->wakil_sekolah ? 'active' : ''); ?>">
                                    <input type="checkbox" name="wakil_sekolah" value="0" disabled <?php echo e($data_guru->wakil_sekolah ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Wakil Kepala Sekolah</span>
                                    </div>
                                </label>

                                <label class="checkbox-card <?php echo e($data_guru->kepala_sekolah ? 'active' : ''); ?>">
                                    <input type="checkbox" name="kepala_sekolah" value="0" disabled <?php echo e($data_guru->kepala_sekolah ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Kepala Sekolah</span>
                                    </div>
                                </label>

                                <label class="checkbox-card <?php echo e($data_guru->ast_krk ? 'active' : ''); ?>">
                                    <input type="checkbox" name="kepala_sekolah" value="0" disabled <?php echo e($data_guru->ast_krk ? 'checked' : ""); ?>>
                                    <div class="checkbox-content">
                                        <i class="fa-solid fa-award"></i>
                                        <span>Asisten Kurikulum</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- SECTION 4: CABANG & SEKOLAH -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-building-columns"></i></span>
                                <div>
                                    <h3>Penempatan Unit</h3>
                                    <small>Cabang dan unit sekolah terdaftar (Read-only)</small>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="cabang_id">Cabang Unit</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-sitemap input-icon"></i>
                                        <select id="cabang_id" name="cabang_id" class="form-control" disabled>
                                            <option value="">-- Pilih Cabang --</option>
                                            <?php $__currentLoopData = $data_cabang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($cb->id); ?>" <?php echo e($cb->id == $data_guru->cabang_id ? 'selected' : ''); ?>><?php echo e($cb->nama_cabang); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sekolah_id">Unit Sekolah</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-school input-icon"></i>
                                        <select id="sekolah_id" name="sekolah_id" class="form-control" disabled>
                                            <option value="">-- Pilih Sekolah --</option>
                                            <?php $__currentLoopData = $data_jenis_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $djs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($djs->id); ?>" <?php echo e($djs->id == $data_guru->sekolah_id ? 'selected' : ''); ?>><?php echo e($djs->jenis); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 5: DATA AKUN -->
                        <div class="form-section">
                            <div class="section-title">
                                <span class="icon-box"><i class="fa-solid fa-shield-halved"></i></span>
                                <div>
                                    <h3>Kredensial Akun</h3>
                                    <small>Pengaturan nama pengguna dan kata sandi login</small>
                                </div>
                            </div>

                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-at input-icon"></i>
                                        <input type="text" id="username" name="username" class="form-control" value="<?php echo e($data_akun->username); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email">Alamat Email</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input type="email" id="email" name="email" class="form-control" value="<?php echo e($data_akun->email); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group span-2">
                                    <label for="password">Password Baru <span class="label-hint">(Kosongkan jika tidak ingin mengubah password)</span></label>
                                    <div class="input-icon-wrapper">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••••••">
                                        <button type="button" class="btn-toggle-password" onclick="togglePasswordVisibility()">
                                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMIT -->
                        <div class="form-actions">
                            <button type="submit" class="btn-submit" id="submitBtn">
                                <i class="fa-solid fa-floppy-disk"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>

                    </form>
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

    <script>
        function previewImage(event) {
            const input = event.target;
            const fileNameText = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewFoto').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
                fileNameText.textContent = input.files[0].name;
            }
        }

        /* Tampilkan nama file baru yang dipilih (KTP, KK, Ijazah) */
        function showFileName(event, kolom) {
            const file = event.target.files && event.target.files[0];
            document.getElementById('fileName-' + kolom).textContent =
                file ? file.name : 'Belum ada file baru dipilih';
        }

        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        document.querySelectorAll(".checkbox-card").forEach(item => {
            const input = item.querySelector("input");
            input.value = input.hasAttribute("checked") ? 1 : 0;
            input.addEventListener('change', (e) => {
                e.target.value = e.target.checked ? 1 : 0;
            });
        });

        document.getElementById('profileForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.classList.add('loading');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> <span>Menyimpan...</span>';
        });
    </script>
</body>
</html><?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\guru\g\profile.blade.php ENDPATH**/ ?>
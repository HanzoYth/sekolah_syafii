<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa - Islamic Smart School</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/editsiswa.css')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

<div class="app-shell">
    

    <div class="main-content">
        <header class="topbar">
            <div class="topbar-inner">
                <div class="topbar-title">
                    <span class="font-arabic">Ø¨ÙØ³Ù’Ù…Ù Ø§Ù„Ù„ÙŽÙ‘Ù‡Ù Ø§Ù„Ø±ÙŽÙ‘Ø­Ù’Ù…ÙŽÙ°Ù†Ù Ø§Ù„Ø±ÙŽÙ‘Ø­ÙÙŠÙ…Ù</span>
                    <h1>Edit Data Santri / Siswa</h1>
                    <p>Perbarui Informasi Profil dan Akademik Siswa</p>
                </div>
                <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline">
                    <i class="fa-solid fa-arrow-left"></i> Batal
                </a>
            </div>
        </header>

        <main class="page">
            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Edit Data Siswa','description' => 'Perbarui informasi siswa pada SIAKAD.','position' => 'Administrator SIAKAD','initials' => 'AD'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.topbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Siakad\Topbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a1f63a2a79d284712d591a40114df0d)): ?>
<?php $attributes = $__attributesOriginal1a1f63a2a79d284712d591a40114df0d; ?>
<?php unset($__attributesOriginal1a1f63a2a79d284712d591a40114df0d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a1f63a2a79d284712d591a40114df0d)): ?>
<?php $component = $__componentOriginal1a1f63a2a79d284712d591a40114df0d; ?>
<?php unset($__componentOriginal1a1f63a2a79d284712d591a40114df0d); ?>
<?php endif; ?>
            <div class="card form-card">
                <form action="#" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <h3 class="card-title"><i class="fa-solid fa-user-pen"></i> Data Pribadi Siswa</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nisn">NISN <span class="required">*</span></label>
                            <input type="text" id="nisn" name="nisn" value="0051234567" required>
                        </div>
                        <div class="form-group">
                            <label for="nis">NIS <span class="required">*</span></label>
                            <input type="text" id="nis" name="nis" value="202301" required>
                        </div>
                        <div class="form-group full-width">
                            <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="Ahmad Al-Fatih" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin <span class="required">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="L" selected>Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas <span class="required">*</span></label>
                            <select id="kelas" name="kelas" required>
                                <option value="X-A Tahfidz" selected>X-A Tahfidz</option>
                                <option value="XI-B IPA">XI-B IPA</option>
                                <option value="XII-A IPS">XII-A IPS</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="foto">Foto Profil Siswa</label>
                            <input type="file" id="foto" name="foto" class="file-input">
                            <small class="help-text">Format: JPG, PNG. Maksimal 2MB.</small>
                        </div>
                    </div>

                    <h3 class="card-title mt-20"><i class="fa-solid fa-people-roof"></i> Data Orang Tua / Wali</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" id="nama_ayah" name="nama_ayah" value="Muhammad Ibrahim">
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" id="nama_ibu" name="nama_ibu" value="Siti Aminah">
                        </div>
                        <div class="form-group full-width">
                            <label for="no_wa">No. WhatsApp Orang Tua</label>
                            <input type="text" id="no_wa" name="no_wa" value="081234567890">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-gold">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

</body>
</html>



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\editSiswa.blade.php ENDPATH**/ ?>
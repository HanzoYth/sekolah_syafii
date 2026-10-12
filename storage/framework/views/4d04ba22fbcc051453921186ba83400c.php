<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Tambah Ruang Kelas</title>
    
    <!-- Font Poppins & FontAwesome Icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Load CSS Terpisah -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/tambahKelas.css')); ?>?v=<?php echo e(time()); ?>">
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

    
    <div class="main-content">
        
        <!-- Topbar Section -->
        <div class="topbar">
            <div class="topbar-left">
                <span class="topbar-eyebrow">MODUL SIAKAD</span>
                <h2>Tambah Ruang Kelas</h2>
            </div>
            <div class="topbar-icons">
                <div class="academic-pill">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>T.A. 2025/2026</span>
                </div>
                <div class="icon-bell-wrap">
                    <i class="fa-regular fa-bell"></i>
                </div>
            </div>
        </div>

        <!-- Form Card Container -->
        <div class="form-card">
            
            <!-- Form Header -->
            <div class="form-header">
                <div class="form-header-icon">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <div class="form-header-text">
                    <h3>Formulir Kelas Baru</h3>
                    <p>Lengkapi detail jenjang, nomor, tipe, dan program kelas di bawah ini.</p>
                </div>
            </div>

            <!-- FORM UTAMA (Diberi ID 'form-tambah-kelas') -->
            <form action="/gr/tmbkls" method="POST" id="form-tambah-kelas">
                <?php echo csrf_field(); ?>

                <div class="form-body">

                    <!-- Input 1: Select Tingkat Sekolah -->
                    <div class="form-field">
                        <label for="tingkat_sekolah">
                            <i class="fa-solid fa-school"></i> Tingkat / Jenjang Sekolah
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-layer-group"></i>
                            <select name="tingkat_sekolah" id="tingkat_sekolah" required>
                                <option value="" disabled selected>-- Pilih Jenjang Sekolah --</option>
                                <option value="TK">TK (Taman Kanak-Kanak)</option>
                                <option value="SD">SD (Sekolah Dasar)</option>
                                <option value="SMP">SMP (Sekolah Menengah Pertama)</option>
                                <option value="SMA">SMA (Sekolah Menengah Atas)</option>
                            </select>
                        </div>
                        <span class="field-hint">Pilih tingkatan pendidikan untuk kelas yang dibuat.</span>
                    </div>

                    <!-- Row Grid untuk Input 2 & 3 -->
                    <div class="form-row">
                        
                        <!-- Input 2: Select Nomor / Tingkat Kelas (1 - 12) -->
                        <div class="form-field">
                            <label for="no_kelas">
                                <i class="fa-solid fa-arrow-down-1-9"></i> Nomor / Tingkat Kelas
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-hashtag"></i>
                                <select name="no_kelas" id="no_kelas" required>
                                    <option value="" disabled selected>-- Pilih Tingkat (1 - 12) --</option>
                                    <?php for($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo e($i); ?>">Tingkat / Kelas <?php echo e($i); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                            <span class="field-hint">Kosongkan Saja Ketika Anda Memilih TK, Kalau Tidak, Pilih angka tingkat kelas dari 1 hingga 12.</span>
                        </div>

                        <!-- Input 3: Select Tipe Kelas -->
                        <div class="form-field">
                            <label for="tipe_kelas">
                                <i class="fa-solid fa-font"></i> Tipe / Nama Paralel Kelas
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-solid fa-shapes"></i>
                                <?php
                                    $data_alfabet =["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
                                ?>
                                <select name="tipe_kelas" id="tipe_kelas" required>
                                    <option value="" disabled selected>-- Pilih Tipe / Jurusan --</option>
                                    <?php $__currentLoopData = $data_alfabet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <option value="UNGGULAN">Unggulan</option>
                                </select>
                            </div>
                            <span class="field-hint">Pilih rombel atau jurusan paralel kelas.</span>
                        </div>

                    </div>

                </div>

                <!-- Form Footer Buttons -->
                <div class="form-footer">
                    <a href="javascript:history.back()" class="btn-form-cancel">Batal</a>
                    <button type="submit" class="btn-form-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Kelas
                    </button>
                </div>

            </form>

            <!-- SELECT TAMBAHAN DI LUAR TAG <form> -->
            <!-- Dihubungkan ke form menggunakan atribut form="form-tambah-kelas" -->
            <div class="external-select-wrapper">
                <div class="form-field">
                    <label for="program_kelas">
                        <i class="fa-solid fa-bookmark"></i> Kelas Yang Tersedia
                    </label>
                    <div class="input-icon-wrapper">
                        <i class="fa-solid fa-award"></i>
                        <select name="program_kelas" id="program_kelas" form="form-tambah-kelas">
                            <?php $__currentLoopData = $data_ruang_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ruang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $ruang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option><?php echo e($value); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
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

</body>

<script>    
    document.getElementById("tingkat_sekolah").addEventListener("change",(e) => {  
        let kelas = document.getElementById("no_kelas");  
        if (e.target.value.toLowerCase() == "tk"){
            kelas.removeAttribute("required");
            kelas.setAttribute("disabled","");
        }else{
            kelas.setAttribute("required","");
            kelas.removeAttribute("disabled");
        }
    })
</script>

</html><?php /**PATH C:\laragon\www\project_sekolah\sekolah_syafii\resources\views/modul/guru/a/tambah_kelas.blade.php ENDPATH**/ ?>
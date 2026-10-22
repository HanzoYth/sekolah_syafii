<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruang Kelas - SIAKAD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/dasboard.css')); ?>">
    <style>
        .mapel-container { padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; max-width: 500px; }
        .mapel-header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #0d5c3a; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 15px; }
        .form-group label { font-size: 13px; font-weight: 600; color: #475569; }
        .form-group input { padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; }
        .btn-submit { background: #0d5c3a; color: white; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; }
        .btn-cancel { background: #cbd5e1; color: #334155; padding: 10px 20px; border: none; border-radius: 6px; font-weight: bold; text-decoration: none; display: inline-block; text-align: center; }
        @media (max-width: 640px) {
            .mapel-container { width: 100%; max-width: 100%; padding: 16px; }
            .btn-actions { flex-direction: column; width: 100%; }
            .btn-submit, .btn-cancel { width: 100%; text-align: center; display: block; box-sizing: border-box; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <?php if (isset($component)) { $__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_siakad','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_siakad'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4)): ?>
<?php $attributes = $__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4; ?>
<?php unset($__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4)): ?>
<?php $component = $__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4; ?>
<?php unset($__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4); ?>
<?php endif; ?>
        <main class="main-content">
            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Ruang Kelas','description' => 'Edit nama ruang kelas terdaftar.','position' => 'Admin SIAKAD','initials' => 'AD'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <div class="mapel-container">
                <div class="mapel-header"><i class="fa-solid fa-pen-to-square"></i> Edit Ruang Kelas</div>
                <form action="/sk/update-kelas/<?php echo e($kelas->id); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Nama Ruang Kelas</label>
                        <input type="text" name="nama_kelas" value="<?php echo e($kelas->nama_kelas); ?>" required>
                    </div>
                    <div class="btn-actions" style="display: flex; gap: 10px; flex-wrap: wrap;">
                        <button type="submit" class="btn-submit"><i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan</button>
                        <a href="/sk/tk" class="btn-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>


<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\editKelas.blade.php ENDPATH**/ ?>
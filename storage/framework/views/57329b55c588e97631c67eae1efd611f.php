<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'SIAKAD'); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <?php echo $__env->make('components.siakad.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        .page-container { padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .page-header { border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .page-title { font-size: 18px; font-weight: bold; color: #0d5c3a; margin: 0; display: flex; align-items: center; gap: 8px; }
        .alert-toast { padding: 16px 20px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #a7f3d0; margin-bottom: 20px; font-weight: 500; font-size: 0.95rem; }
        .alert-error { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <?php if (isset($component)) { $__componentOriginala9979112b0e096e91e5f9278b4195051 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala9979112b0e096e91e5f9278b4195051 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.sidebar','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala9979112b0e096e91e5f9278b4195051)): ?>
<?php $attributes = $__attributesOriginala9979112b0e096e91e5f9278b4195051; ?>
<?php unset($__attributesOriginala9979112b0e096e91e5f9278b4195051); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala9979112b0e096e91e5f9278b4195051)): ?>
<?php $component = $__componentOriginala9979112b0e096e91e5f9278b4195051; ?>
<?php unset($__componentOriginala9979112b0e096e91e5f9278b4195051); ?>
<?php endif; ?>
        <main class="main-content">
            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => ''.e($pageTitle ?? ($title ?? 'Dashboard SIAKAD')).'','description' => ''.e($pageDescription ?? ($subtitle ?? 'Kelola sistem akademik dengan mudah.')).'','position' => ''.e(session('role') == 'g' ? 'Guru' : (session('role') == 'a' ? 'Admin' : 'Siswa')).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            <div class="page-container">
                <?php if(session('success')): ?>
                    <div class="alert-toast">
                        <i class="fa-solid fa-circle-check"></i> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="alert-toast alert-error">
                        <i class="fa-solid fa-circle-exclamation"></i> <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo e($slot); ?>

            </div>
        </main>
    </div>
    
    <?php echo e($scripts ?? ''); ?>

</body>
</html>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad-layout.blade.php ENDPATH**/ ?>
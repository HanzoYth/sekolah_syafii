<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'title',
    'icon' => null,
    'iconColor' => '#166534',
    'iconBg' => '#dcfce7'
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id',
    'title',
    'icon' => null,
    'iconColor' => '#166534',
    'iconBg' => '#dcfce7'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div id="<?php echo e($id); ?>" style="display: none; position: fixed; inset: 0; z-index: 1000; align-items: center; justify-content: center;">
    <!-- Backdrop -->
    <div style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px);" onclick="closeModal('<?php echo e($id); ?>')"></div>
    
    <!-- Modal Content -->
    <div style="position: relative; background: white; border-radius: 16px; padding: 30px; width: 90%; max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); transform: scale(0.95); opacity: 0; transition: all 0.2s ease-out; animation: modalIn 0.3s forwards;">
        
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
            <?php if($icon): ?>
            <div style="width: 60px; height: 60px; border-radius: 16px; background: <?php echo e($iconBg); ?>; color: <?php echo e($iconColor); ?>; display: flex; align-items: center; justify-content: center; font-size: 1.6rem;">
                <i class="fa-solid <?php echo e($icon); ?>"></i>
            </div>
            <?php endif; ?>
            <h3 style="margin: 0; font-size: 1.25rem; color: #1e293b;"><?php echo e($title); ?></h3>
        </div>

        <div>
            <?php echo e($slot); ?>

        </div>
    </div>
</div>

<style>
@keyframes modalIn {
    to { transform: scale(1); opacity: 1; }
}
</style>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/ui/modal.blade.php ENDPATH**/ ?>
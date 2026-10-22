<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'primary', // primary, secondary, danger, warning, success
    'icon' => null,
    'href' => null,
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
    'type' => 'primary', // primary, secondary, danger, warning, success
    'icon' => null,
    'href' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $baseClasses = 'inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg transition-colors border';
    
    $colorClasses = [
        'primary' => 'bg-[#0d5c3a] text-white border-transparent hover:bg-[#064e3b]',
        'secondary' => 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50',
        'danger' => 'bg-red-500 text-white border-transparent hover:bg-red-600',
        'warning' => 'bg-yellow-500 text-white border-transparent hover:bg-yellow-600',
        'success' => 'bg-emerald-500 text-white border-transparent hover:bg-emerald-600',
    ];

    $classes = $baseClasses . ' ' . ($colorClasses[$type] ?? $colorClasses['primary']);
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php if($icon): ?> <i class="<?php echo e($icon); ?>"></i> <?php endif; ?>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php if($icon): ?> <i class="<?php echo e($icon); ?>"></i> <?php endif; ?>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\components\siakad\ui\button.blade.php ENDPATH**/ ?>
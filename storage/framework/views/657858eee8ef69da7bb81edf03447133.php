<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'success', // success, error, warning, info
    'message' => ''
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
    'type' => 'success', // success, error, warning, info
    'message' => ''
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $bg = match($type) {
        'success' => '#ecfdf5',
        'error' => '#fef2f2',
        'warning' => '#fefce8',
        'info' => '#eff6ff',
        default => '#ecfdf5',
    };
    $border = match($type) {
        'success' => '#a7f3d0',
        'error' => '#fecaca',
        'warning' => '#fef08a',
        'info' => '#bfdbfe',
        default => '#a7f3d0',
    };
    $text = match($type) {
        'success' => '#065f46',
        'error' => '#991b1b',
        'warning' => '#854d0e',
        'info' => '#1e40af',
        default => '#065f46',
    };
    $icon = match($type) {
        'success' => 'fa-circle-check',
        'error' => 'fa-circle-exclamation',
        'warning' => 'fa-triangle-exclamation',
        'info' => 'fa-circle-info',
        default => 'fa-circle-check',
    };
?>

<div style="padding: 16px 20px; background: <?php echo e($bg); ?>; color: <?php echo e($text); ?>; border-radius: 12px; border: 1px solid <?php echo e($border); ?>; margin-bottom: 20px; font-weight: 500; font-size: 0.95rem; display: flex; align-items: center; gap: 10px;">
    <i class="fa-solid <?php echo e($icon); ?>" style="font-size: 1.2rem;"></i>
    <div>
        <?php echo e($message); ?>

        <?php echo e($slot); ?>

    </div>
</div>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/ui/alert.blade.php ENDPATH**/ ?>
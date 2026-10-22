<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'value',
    'icon',
    'color' => 'success' // success, warning, danger, info, primary
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
    'title',
    'value',
    'icon',
    'color' => 'success' // success, warning, danger, info, primary
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $colors = [
        'success' => ['border' => '#86efac', 'bg' => '#f0fdf4', 'icon' => '#16a34a'],
        'warning' => ['border' => '#fde047', 'bg' => '#fefce8', 'icon' => '#eab308'],
        'danger'  => ['border' => '#fca5a5', 'bg' => '#fef2f2', 'icon' => '#ef4444'],
        'info'    => ['border' => '#93c5fd', 'bg' => '#eff6ff', 'icon' => '#3b82f6'],
        'primary' => ['border' => '#e2e8f0', 'bg' => '#f8fafc', 'icon' => '#64748b'],
    ];

    $style = $colors[$color] ?? $colors['primary'];
?>

<div style="background: <?php echo e($style['bg']); ?>; padding: 16px; border-radius: 8px; border: 1px solid <?php echo e($style['border']); ?>; display: flex; align-items: center; gap: 15px; min-width: 160px; flex: 1;">
    <i class="<?php echo e($icon); ?>" style="font-size: 24px; color: <?php echo e($style['icon']); ?>;"></i>
    <div>
        <strong style="display: block; font-size: 20px; color: #1e293b; line-height: 1;"><?php echo e($value); ?></strong>
        <span style="font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; display: block;"><?php echo e($title); ?></span>
    </div>
</div>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\components\siakad\ui\card-rekap.blade.php ENDPATH**/ ?>
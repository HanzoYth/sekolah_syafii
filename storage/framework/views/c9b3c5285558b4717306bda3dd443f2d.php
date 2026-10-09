<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['headers' => []]));

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

foreach (array_filter((['headers' => []]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div style="overflow-x: auto; background: white; border-radius: 8px; border: 1px solid #e2e8f0; margin-top: 15px;">
    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead>
            <tr>
                <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th style="background: #f0fdf4; padding: 12px 16px; font-weight: 600; color: #166534; border-bottom: 2px solid #dcfce7;">
                        <?php echo e($header); ?>

                    </th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php echo e($slot); ?>

        </tbody>
    </table>
</div>

<style>
    /* CSS Scoped to Table */
    table tbody tr:hover { background: #f8fafc; }
    table tbody td { padding: 12px 16px; border-bottom: 1px solid #f1f5f9; color: #475569; vertical-align: middle; }
</style>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/ui/table.blade.php ENDPATH**/ ?>
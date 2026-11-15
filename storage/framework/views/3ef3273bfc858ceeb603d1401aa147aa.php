<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'rank' => '-',
    'variant' => 'table', // 'table' | 'compact' | 'print'
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
    'rank' => '-',
    'variant' => 'table', // 'table' | 'compact' | 'print'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $isRanked = is_numeric($rank) && (int) $rank > 0;
    $rankNum = $isRanked ? (int) $rank : null;
    $isTop3 = $isRanked && $rankNum <= 3;

    $tierMeta = [
        1 => ['label' => 'Juara 1', 'icon' => 'fa-solid fa-crown', 'title' => 'Peringkat 1 — Juara Kelas'],
        2 => ['label' => 'Juara 2', 'icon' => 'fa-solid fa-medal', 'title' => 'Peringkat 2 — Juara Kelas'],
        3 => ['label' => 'Juara 3', 'icon' => 'fa-solid fa-award', 'title' => 'Peringkat 3 — Juara Kelas'],
    ];
    $meta = $isTop3 ? $tierMeta[$rankNum] : null;
?>

<?php if(!$isRanked): ?>
    <span class="text-xs text-slate-400 font-medium">-</span>
<?php elseif($variant === 'print'): ?>
    <?php if($isTop3): ?>
        <span class="siakad-rank-print siakad-rank-print-<?php echo e($rankNum); ?>" title="<?php echo e($meta['title']); ?>">
            <i class="<?php echo e($meta['icon']); ?> text-[8.5px]"></i>
            <span><?php echo e($rankNum); ?></span>
        </span>
    <?php else: ?>
        <span class="font-bold text-slate-700">#<?php echo e($rankNum); ?></span>
    <?php endif; ?>
<?php else: ?>
    <span
        <?php echo e($attributes->merge([
            'class' => 'siakad-rank-badge '
                . ($variant === 'compact' ? 'siakad-rank-badge--compact ' : '')
                . ($isTop3 ? 'siakad-rank-badge--top3 siakad-rank-' . $rankNum : 'siakad-rank-other'),
            'title' => $meta['title'] ?? ('Peringkat #' . $rankNum),
        ])); ?>

        data-rank-tier="<?php echo e($rankNum); ?>"
    >
        <?php if($isTop3): ?>
            <span class="siakad-rank-crest-wrap">
                <?php if($rankNum === 1): ?>
                    <i class="fa-solid fa-crown siakad-rank-crest-crown" aria-hidden="true"></i>
                <?php endif; ?>
                <span class="siakad-rank-coin" aria-label="Peringkat <?php echo e($rankNum); ?>"><?php echo e($rankNum); ?></span>
            </span>
            <span class="siakad-rank-meta">
                <?php if($rankNum !== 1): ?>
                    <i class="<?php echo e($meta['icon']); ?> siakad-rank-icon <?php echo e($variant === 'compact' ? 'text-[9px]' : 'text-[10px]'); ?>"></i>
                <?php endif; ?>
                <span class="siakad-rank-tier-label"><?php echo e($meta['label']); ?></span>
            </span>
        <?php else: ?>
            <span class="siakad-rank-meta">
                <span class="<?php echo e($variant === 'compact' ? 'text-[10.5px]' : 'text-[11px]'); ?> font-bold tracking-tight text-slate-600">#<?php echo e($rankNum); ?></span>
            </span>
        <?php endif; ?>
    </span>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/rank-badge.blade.php ENDPATH**/ ?>
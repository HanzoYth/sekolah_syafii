<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'leger' => collect(),
    'kelasNama' => '-',
    'compact' => false,
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
    'leger' => collect(),
    'kelasNama' => '-',
    'compact' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $top3 = collect($leger)
        ->filter(fn($item) => is_numeric($item->peringkat ?? null) && (int) $item->peringkat > 0 && (int) $item->peringkat <= 3)
        ->sortBy(fn($item) => (int) $item->peringkat)
        ->take(3)
        ->values();
?>

<?php if($top3->count() > 0): ?>
    <?php if($compact): ?>
        
        <div class="px-6 py-3.5 bg-gradient-to-r from-emerald-950 via-emerald-900 to-teal-900 border-b border-emerald-800/80 flex flex-col lg:flex-row lg:items-center justify-between gap-3">
            <div class="flex items-center gap-2.5 text-amber-200 flex-shrink-0">
                <span class="w-7 h-7 rounded-lg bg-amber-400/20 border border-amber-300/40 flex items-center justify-center text-amber-300 text-xs">
                    <i class="fa-solid fa-trophy"></i>
                </span>
                <div>
                    <p class="text-[11px] font-bold uppercase tracking-wider text-amber-300 leading-none">Peringkat Eksklusif Kelas</p>
                    <p class="text-[10px] text-emerald-200/85 mt-0.5">Top <?php echo e($top3->count()); ?> peraih rata-rata tertinggi</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <?php $__currentLoopData = $top3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $r = (int) $item->peringkat; ?>
                    <a href="/sk/detail-rapor-walas/<?php echo e($item->siswa->id); ?>"
                       class="group inline-flex items-center gap-2.5 pl-1.5 pr-3 py-1 rounded-full bg-white/95 hover:bg-white shadow-sm border <?php echo e($r === 1 ? 'border-amber-300 ring-1 ring-amber-300/60' : ($r === 2 ? 'border-slate-300' : 'border-orange-300')); ?> transition-all">
                        <?php if (isset($component)) { $__componentOriginal857dd9638daa2acd55509dbe6d317237 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal857dd9638daa2acd55509dbe6d317237 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.rank-badge','data' => ['rank' => $r,'variant' => 'compact']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.rank-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rank' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($r),'variant' => 'compact']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal857dd9638daa2acd55509dbe6d317237)): ?>
<?php $attributes = $__attributesOriginal857dd9638daa2acd55509dbe6d317237; ?>
<?php unset($__attributesOriginal857dd9638daa2acd55509dbe6d317237); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal857dd9638daa2acd55509dbe6d317237)): ?>
<?php $component = $__componentOriginal857dd9638daa2acd55509dbe6d317237; ?>
<?php unset($__componentOriginal857dd9638daa2acd55509dbe6d317237); ?>
<?php endif; ?>
                        <span class="text-xs font-bold text-slate-800 group-hover:text-emerald-700 transition-colors max-w-[150px] truncate"><?php echo e($item->siswa->nama); ?></span>
                        <span class="text-[11px] font-extrabold <?php echo e($r === 1 ? 'text-amber-700 bg-amber-50' : ($r === 2 ? 'text-slate-700 bg-slate-100' : 'text-orange-700 bg-orange-50')); ?> px-1.5 py-0.5 rounded"><?php echo e(number_format($item->rata_rata, 1)); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php else: ?>
        
        <section class="siakad-podium-shell rounded-2xl p-5 sm:p-6 mb-8 text-white" aria-label="Podium Juara 1 sampai 3">
            <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-xl bg-amber-400/15 border border-amber-300/40 text-amber-300 flex items-center justify-center text-lg shadow-inner flex-shrink-0">
                        <i class="fa-solid fa-crown siakad-rank-icon"></i>
                    </div>
                    <div>
                        <div class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-300">
                            <span class="siakad-twinkle-dot">✦</span>
                            <span>Peringkat Eksklusif Kelas <?php echo e($kelasNama); ?></span>
                            <span class="siakad-twinkle-dot" style="animation-delay: 0.9s">✦</span>
                        </div>
                        <h3 class="text-lg sm:text-xl font-extrabold text-white tracking-tight mt-0.5">
                            Top <?php echo e($top3->count()); ?> Bintang Prestasi Akademik
                        </h3>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[11px] font-semibold bg-white/10 border border-white/15 text-emerald-100 backdrop-blur-sm">
                        <i class="fa-solid fa-award text-amber-300"></i>
                        Juara 1 &ndash; <?php echo e($top3->count()); ?> Terbaik
                    </span>
                </div>
            </div>

            <?php
                // Desktop architectural podium order: #2 left, #1 center elevated, #3 right
                // Mobile linear order: #1 top, #2 second, #3 third
                $orderClasses = [
                    1 => 'order-1 md:order-2 md:-mt-3',
                    2 => 'order-2 md:order-1 md:mt-2',
                    3 => 'order-3 md:order-3 md:mt-4',
                ];
                $tierConfig = [
                    1 => [
                        'title' => 'Juara 1',
                        'subtitle' => 'Peringkat Pertama',
                        'icon' => 'fa-solid fa-crown',
                        'badgeBg' => 'bg-amber-400 text-amber-950',
                        'avatarRing' => 'ring-2 ring-amber-300 bg-gradient-to-br from-amber-300 to-amber-500 text-amber-950',
                        'scoreColor' => 'text-amber-200',
                        'barHeight' => 'h-2 bg-gradient-to-r from-amber-300 via-yellow-400 to-amber-500',
                    ],
                    2 => [
                        'title' => 'Juara 2',
                        'subtitle' => 'Peringkat Kedua',
                        'icon' => 'fa-solid fa-medal',
                        'badgeBg' => 'bg-slate-200 text-slate-900',
                        'avatarRing' => 'ring-2 ring-slate-200 bg-gradient-to-br from-slate-100 to-slate-400 text-slate-900',
                        'scoreColor' => 'text-slate-100',
                        'barHeight' => 'h-1.5 bg-gradient-to-r from-slate-200 via-white to-slate-400',
                    ],
                    3 => [
                        'title' => 'Juara 3',
                        'subtitle' => 'Peringkat Ketiga',
                        'icon' => 'fa-solid fa-award',
                        'badgeBg' => 'bg-orange-300 text-orange-950',
                        'avatarRing' => 'ring-2 ring-orange-300 bg-gradient-to-br from-orange-200 to-orange-500 text-orange-950',
                        'scoreColor' => 'text-orange-200',
                        'barHeight' => 'h-1.5 bg-gradient-to-r from-orange-300 via-amber-400 to-orange-600',
                    ],
                ];
                $gridCols = $top3->count() === 1 ? 'md:grid-cols-1 max-w-md mx-auto' : ($top3->count() === 2 ? 'md:grid-cols-2 max-w-3xl mx-auto' : 'md:grid-cols-3');
            ?>

            <div class="relative z-10 grid grid-cols-1 <?php echo e($gridCols); ?> gap-4 sm:gap-5 items-stretch">
                <?php $__currentLoopData = $top3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $r = (int) $item->peringkat;
                        $cfg = $tierConfig[$r];
                        $orderCls = $top3->count() === 3 ? ($orderClasses[$r] ?? '') : '';
                    ?>
                    <div class="siakad-podium-card siakad-podium-card--<?php echo e($r); ?> <?php echo e($orderCls); ?> flex flex-col justify-between">
                        
                        <span class="siakad-podium-watermark text-white" aria-hidden="true">0<?php echo e($r); ?></span>

                        <div class="p-5 flex-1 flex flex-col justify-between gap-4 relative z-10">
                            
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3.5">
                                    <div class="siakad-hero-numeral-seal" aria-label="Peringkat <?php echo e($r); ?>">
                                        <span><?php echo e($r); ?></span>
                                    </div>
                                    <div>
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-wider shadow-sm <?php echo e($cfg['badgeBg']); ?>">
                                            <i class="<?php echo e($cfg['icon']); ?> text-[10px]"></i>
                                            <?php echo e($cfg['title']); ?>

                                        </span>
                                        <p class="text-[11px] text-emerald-100/80 font-medium mt-1"><?php echo e($cfg['subtitle']); ?></p>
                                    </div>
                                </div>
                                <?php if(($item->predikat ?? '-') !== '-'): ?>
                                    <span class="px-2 py-0.5 rounded-lg text-[11px] font-extrabold bg-white/15 border border-white/20 text-white" title="Predikat Nilai">
                                        <?php echo e($item->predikat); ?>

                                    </span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="flex items-center gap-3 bg-black/20 rounded-xl p-3 border border-white/10">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-extrabold text-xs uppercase flex-shrink-0 shadow-sm <?php echo e($cfg['avatarRing']); ?>">
                                    <?php echo e(strtoupper(substr($item->siswa->nama ?? 'S', 0, 2))); ?>

                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-bold text-white truncate leading-snug" title="<?php echo e($item->siswa->nama); ?>">
                                        <?php echo e($item->siswa->nama); ?>

                                    </h4>
                                    <p class="text-[11px] font-mono text-emerald-200/75 truncate">
                                        NIS: <?php echo e($item->siswa->nis ?? '-'); ?>

                                    </p>
                                </div>
                            </div>

                            
                            <div class="flex items-end justify-between gap-2 pt-1">
                                <div class="flex items-center gap-4">
                                    <div>
                                        <span class="block text-[10px] uppercase tracking-wider text-emerald-200/75 font-semibold">Rata-Rata</span>
                                        <span class="text-2xl font-black tracking-tight leading-none <?php echo e($cfg['scoreColor']); ?>">
                                            <?php echo e(number_format($item->rata_rata, 1)); ?>

                                        </span>
                                    </div>
                                    <div class="h-7 w-px bg-white/15"></div>
                                    <div>
                                        <span class="block text-[10px] uppercase tracking-wider text-emerald-200/75 font-semibold">Total</span>
                                        <span class="text-sm font-bold text-white/95 leading-none">
                                            <?php echo e(number_format($item->total_nilai, 1)); ?>

                                        </span>
                                    </div>
                                </div>

                                <a href="/sk/detail-rapor-walas/<?php echo e($item->siswa->id); ?>"
                                   class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-white/15 hover:bg-white hover:text-emerald-950 text-white border border-white/20 text-[11px] font-bold transition-all whitespace-nowrap">
                                    <i class="fa-solid fa-file-lines text-[10px]"></i>
                                    Rapor
                                </a>
                            </div>
                        </div>

                        
                        <div class="w-full <?php echo e($cfg['barHeight']); ?>"></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/top-podium.blade.php ENDPATH**/ ?>
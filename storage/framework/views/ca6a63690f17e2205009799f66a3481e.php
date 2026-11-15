<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'ranking' => [],
    'currentSiswaId' => null,
    'kelasNama' => '',
    'showPendingHint' => false,
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
    'ranking' => [],
    'currentSiswaId' => null,
    'kelasNama' => '',
    'showPendingHint' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $finalReady = (bool) ($ranking['final_ready'] ?? false);
    $top3 = collect($ranking['top3'] ?? []);
    $peringkatSiswa = $ranking['peringkat_siswa'] ?? null;
    $totalSiswa = (int) ($ranking['total_siswa'] ?? 0);
    $mapelLengkap = (int) ($ranking['mapel_lengkap'] ?? 0);
    $totalMapel = (int) ($ranking['total_mapel'] ?? 0);
?>

<?php if($finalReady && $top3->isNotEmpty()): ?>
    <div <?php echo e($attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8'])); ?>>
        <div class="px-5 py-3.5 bg-gradient-to-r from-emerald-800 via-emerald-900 to-teal-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-lg bg-amber-400/20 border border-amber-300/30 text-amber-300 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-trophy text-sm"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-bold tracking-tight text-white">Top 3 Juara Final Kelas<?php echo e($kelasNama ? ' — ' . $kelasNama : ''); ?></h3>
                    <p class="text-[11px] text-emerald-100/85">Peringkat resmi berdasarkan kelengkapan 100% seluruh komponen nilai mata pelajaran</p>
                </div>
            </div>
            <?php if($peringkatSiswa): ?>
                <div class="inline-flex items-center flex-wrap gap-2 px-3 py-1.5 rounded-full bg-white shadow-sm text-xs font-semibold text-slate-700 self-start sm:self-auto">
                    <span class="text-slate-500">Peringkat Kamu:</span>
                    <?php if (isset($component)) { $__componentOriginal857dd9638daa2acd55509dbe6d317237 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal857dd9638daa2acd55509dbe6d317237 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.rank-badge','data' => ['rank' => $peringkatSiswa,'variant' => 'compact']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.rank-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rank' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($peringkatSiswa),'variant' => 'compact']); ?>
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
                    <span class="text-[11px] text-slate-500 font-medium">dari <?php echo e($totalSiswa); ?> siswa</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="p-4 sm:p-5 bg-slate-50/40">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
                <?php $__currentLoopData = $top3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $juara): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isMe = $currentSiswaId && ((int) $juara->siswa_id === (int) $currentSiswaId);
                        $tierStyle = match ((int) $juara->peringkat) {
                            1 => [
                                'card' => 'border-amber-300/90 bg-gradient-to-br from-amber-50/70 via-white to-white',
                                'avatar' => 'bg-amber-100 text-amber-800 border-amber-200',
                            ],
                            2 => [
                                'card' => 'border-slate-300 bg-gradient-to-br from-slate-50/80 via-white to-white',
                                'avatar' => 'bg-slate-200/80 text-slate-700 border-slate-300',
                            ],
                            default => [
                                'card' => 'border-orange-200 bg-gradient-to-br from-orange-50/60 via-white to-white',
                                'avatar' => 'bg-orange-100 text-orange-800 border-orange-200',
                            ],
                        };
                    ?>
                    <div class="rounded-xl border <?php echo e($tierStyle['card']); ?> <?php echo e($isMe ? 'ring-2 ring-emerald-500/80 shadow-sm' : ''); ?> p-4 transition-all">
                        <div class="flex items-center justify-between flex-wrap gap-2 mb-3">
                            <?php if (isset($component)) { $__componentOriginal857dd9638daa2acd55509dbe6d317237 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal857dd9638daa2acd55509dbe6d317237 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.rank-badge','data' => ['rank' => $juara->peringkat,'variant' => 'compact']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.rank-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rank' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($juara->peringkat),'variant' => 'compact']); ?>
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
                            <div class="flex items-center flex-wrap gap-1.5">
                                <?php if($isMe): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-600 text-white">
                                        Kamu
                                    </span>
                                <?php endif; ?>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    Predikat <?php echo e($juara->predikat); ?>

                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full border <?php echo e($tierStyle['avatar']); ?> flex items-center justify-center font-bold text-xs flex-shrink-0">
                                <?php echo e($juara->inisial); ?>

                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-slate-800 truncate" title="<?php echo e($juara->nama); ?>"><?php echo e($juara->nama); ?></h4>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Rata-rata Final: <span class="font-bold text-slate-800"><?php echo e(number_format($juara->rata_rata, 1)); ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php elseif($showPendingHint && $totalMapel > 0): ?>
    <div <?php echo e($attributes->merge(['class' => 'rounded-xl border border-amber-200/80 bg-amber-50/70 px-4 py-3 mb-6 flex items-center gap-3 text-xs text-amber-900'])); ?>>
        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-hourglass-half"></i>
        </div>
        <div>
            <p class="font-bold text-amber-950">Peringkat Final Kelas Menunggu Kelengkapan Nilai (<?php echo e($mapelLengkap); ?>/<?php echo e($totalMapel); ?> Mapel Lengkap)</p>
            <p class="text-[11px] text-amber-800 mt-0.5">Peringkat kelas dan daftar 3 Juara Terbaik akan muncul otomatis setelah seluruh komponen nilai untuk semua mata pelajaran selesai diinput 100%.</p>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/top3-siswa-strip.blade.php ENDPATH**/ ?>
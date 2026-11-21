<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['paginator']));

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

foreach (array_filter((['paginator']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $total = $paginator ? (method_exists($paginator, 'total') ? $paginator->total() : count($paginator)) : 0;
    $currentPage = $paginator && method_exists($paginator, 'currentPage') ? $paginator->currentPage() : 1;
    $lastPage = $paginator && method_exists($paginator, 'lastPage') ? max(1, $paginator->lastPage()) : 1;
    $firstItem = $paginator && method_exists($paginator, 'firstItem') ? ($paginator->firstItem() ?? 0) : ($total > 0 ? 1 : 0);
    $lastItem = $paginator && method_exists($paginator, 'lastItem') ? ($paginator->lastItem() ?? $total) : $total;
    $startPage = max(1, $currentPage - 2);
    $endPage = min($lastPage, $currentPage + 2);
?>

<?php if (! $__env->hasRenderedOnce('7d6274ac-e4df-44d6-87b4-f43b60cd27d1')): $__env->markAsRenderedOnce('7d6274ac-e4df-44d6-87b4-f43b60cd27d1'); ?>
    <style>
        .siakad-server-pagination {
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            padding: 14px 16px 12px 16px !important;
            background: #f8fafc !important;
            border-top: 1px solid #e2e8f0 !important;
            text-align: center !important;
            box-sizing: border-box !important;
        }
        .siakad-server-pagination-info {
            font-size: 0.75rem !important;
            color: #64748b !important;
            font-weight: 500 !important;
            margin-bottom: 8px !important;
        }
        .siakad-server-pagination-info strong {
            color: #1e293b !important;
            font-weight: 700 !important;
        }
        .siakad-server-pagination .pagination {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            list-style: none !important;
            margin: 0 auto !important;
            padding: 4px !important;
            gap: 4px !important;
            flex-wrap: wrap !important;
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 999px !important;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04) !important;
        }
        .siakad-server-pagination .pagination .page-item {
            display: inline-flex !important;
            margin: 0 !important;
        }
        .siakad-server-pagination .pagination .page-link {
            min-width: 34px !important;
            height: 34px !important;
            padding: 0 11px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            border-radius: 999px !important;
            border: none !important;
            background: transparent !important;
            color: #64748b !important;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif !important;
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            text-decoration: none !important;
            line-height: 1 !important;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .siakad-server-pagination .pagination .page-link::before,
        .siakad-server-pagination .pagination .page-link::after {
            content: none !important;
            display: none !important;
        }
        .siakad-server-pagination .pagination a.page-link:hover {
            background: #f1f5f9 !important;
            color: #0f172a !important;
        }
        .siakad-server-pagination .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25) !important;
            font-weight: 700 !important;
        }
        .siakad-server-pagination .pagination .page-item.disabled .page-link {
            opacity: 0.4 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
        }
    </style>
<?php endif; ?>

<?php if($total > 0): ?>
    <div class="siakad-server-pagination pagination-wrap">
        <div class="siakad-server-pagination-info">
            Menampilkan <strong><?php echo e($firstItem); ?></strong> - <strong><?php echo e($lastItem); ?></strong> dari <strong><?php echo e($total); ?></strong> data
        </div>
        <nav aria-label="Navigasi Halaman">
            <ul class="pagination">
                <?php if($paginator->onFirstPage()): ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" title="Halaman Sebelumnya"><i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i></span>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" title="Halaman Sebelumnya">
                            <i class="fa-solid fa-chevron-left" style="font-size: 11px;"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if($startPage > 1): ?>
                    <li class="page-item"><a class="page-link" href="<?php echo e($paginator->url(1)); ?>">1</a></li>
                    <?php if($startPage > 2): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                <?php endif; ?>

                <?php for($p = $startPage; $p <= $endPage; $p++): ?>
                    <?php if($p === $currentPage): ?>
                        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo e($p); ?></span></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($paginator->url($p)); ?>"><?php echo e($p); ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if($endPage < $lastPage): ?>
                    <?php if($endPage < $lastPage - 1): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                    <li class="page-item"><a class="page-link" href="<?php echo e($paginator->url($lastPage)); ?>"><?php echo e($lastPage); ?></a></li>
                <?php endif; ?>

                <?php if($paginator->hasMorePages()): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" title="Halaman Selanjutnya">
                            <i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="page-item disabled" aria-disabled="true">
                        <span class="page-link" title="Halaman Selanjutnya"><i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i></span>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/server-pagination.blade.php ENDPATH**/ ?>
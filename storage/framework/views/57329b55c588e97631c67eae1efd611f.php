<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'pageTitle' => null,
    'subtitle' => null,
    'description' => null,
    'pageDescription' => null,
    'position' => null,
    'initials' => null,
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
    'title' => null,
    'pageTitle' => null,
    'subtitle' => null,
    'description' => null,
    'pageDescription' => null,
    'position' => null,
    'initials' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title><?php echo e($pageTitle ?? ($title ?? 'SIAKAD')); ?></title>
    
    <!-- PWA & Mobile Meta Tags -->
    <meta name="theme-color" content="#0d5c3a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="SIAKAD">
    <link rel="manifest" href="<?php echo e(asset('manifest.json')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('img/logo_sklh.png')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php echo $__env->make('components.siakad.styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <style>
        .page-container { 
            padding: 24px; 
            background: #fff; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
            margin-top: 20px; 
            animation: siakadPageEnter 0.25s ease-out; 
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
        }
        .page-header { 
            border-bottom: 2px solid #ecfdf5; 
            padding-bottom: 15px; 
            margin-bottom: 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            flex-wrap: wrap;
            gap: 12px;
        }
        .page-title { 
            font-size: 18px; 
            font-weight: bold; 
            color: #0d5c3a; 
            margin: 0; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            flex-wrap: wrap;
        }
        .alert-toast { 
            padding: 16px 20px; 
            background: #ecfdf5; 
            color: #065f46; 
            border-radius: 8px; 
            border: 1px solid #a7f3d0; 
            margin-bottom: 20px; 
            font-weight: 500; 
            font-size: 0.95rem; 
        }
        .alert-error { 
            background: #fef2f2; 
            color: #991b1b; 
            border-color: #fecaca; 
        }
        @keyframes siakadPageEnter {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Breakpoints for SIAKAD Layout */
        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0 !important;
                width: 100% !important;
                padding: 16px !important;
                box-sizing: border-box;
            }
        }
        @media (max-width: 768px) {
            .main-content {
                padding: 12px !important;
            }
            .page-container { 
                padding: 16px 14px; 
                margin-top: 14px; 
                border-radius: 10px; 
            }
            .page-header { 
                flex-direction: column; 
                align-items: flex-start; 
                gap: 12px; 
            }
            .page-title { 
                font-size: 16px; 
            }
        }
        @media (max-width: 480px) {
            .main-content {
                padding: 8px !important;
            }
            .page-container { 
                padding: 12px 10px; 
                margin-top: 10px; 
            }
        }
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
            <?php
                $finalTitle = $pageTitle ?? ($title ?? 'Dashboard SIAKAD');
                $finalDescription = $pageDescription ?? ($description ?? ($subtitle ?? 'Kelola sistem akademik dengan mudah.'));
                $finalPosition = $position ?? (session('role') == 'g' ? 'Guru' : (session('role') == 'a' ? 'Admin' : 'Siswa'));
            ?>
            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => $finalTitle,'description' => $finalDescription,'position' => $finalPosition] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
                <?php echo $__env->make('components.warning', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php echo e($slot); ?>

            </div>
        </main>
    </div>

    <?php echo e($scripts ?? ''); ?>


    <!-- Universal Centered Table Pagination (Max 5 Data per Table) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initSiakadUniversalTablePagination();
        });

        window.refreshSiakadPagination = function() {
            if (window._siakadPagRenderers) {
                window._siakadPagRenderers.forEach(fn => fn());
            }
        };

        function initSiakadUniversalTablePagination() {
            window._siakadPagRenderers = [];
            const tables = document.querySelectorAll('table');

            tables.forEach((table, tableIndex) => {
                if (table.hasAttribute('data-no-paginate')) return;
                if (table.closest('.modal-card, .flatpickr-calendar, .dropdown-menu, .modal-overlay, #modalEditPembayaran, #modalPengumuman')) return;

                // Cek jika parent card sudah memiliki pagination server-side (misal: pembayaran IPP links())
                const parentCard = table.closest('.table-card, .card') || table.parentElement;
                if (parentCard && parentCard.querySelector('.pagination-wrap, .pagination-container') && !table.hasAttribute('data-force-paginate')) {
                    const pagWrap = parentCard.querySelector('.pagination-wrap, .pagination-container');
                    if (pagWrap) {
                        pagWrap.style.display = 'flex';
                        pagWrap.style.justifyContent = 'center';
                        pagWrap.style.alignItems = 'center';
                    }
                    return;
                }

                const tbody = table.querySelector('tbody');
                if (!tbody) return;

                const PAGE_SIZE = parseInt(table.getAttribute('data-page-size') || 5, 10);
                let currentPage = 1;
                const pagContainerId = 'siakad-pag-table-' + (table.id || tableIndex);

                function isEmptyStateRow(tr) {
                    if (tr.classList.contains('empty-row')) return true;
                    if (tr.hasAttribute('data-empty-state')) return true;
                    if (tr.id && (tr.id === 'filterEmpty' || tr.id.toLowerCase().includes('empty'))) return true;
                    return false;
                }

                function isControlRow(tr) {
                    if (isEmptyStateRow(tr)) return false;
                    const td = tr.querySelector('td[colspan]');
                    return td && tr.children.length === 1 && !tr.querySelector('input.check-siswa, input.siswa-checkbox');
                }

                function getActiveRows() {
                    return Array.from(tbody.querySelectorAll('tr')).filter(tr => {
                        if (isEmptyStateRow(tr)) return false;
                        if (isControlRow(tr)) return false;
                        if (tr.getAttribute('data-filtered-out') === 'true') return false;
                        return true;
                    });
                }

                const allDataRows = Array.from(tbody.querySelectorAll('tr')).filter(tr => !isEmptyStateRow(tr) && !isControlRow(tr));
                if (allDataRows.length <= PAGE_SIZE && !table.hasAttribute('data-force-paginate')) {
                    return;
                }

                let pagWrapper = document.getElementById(pagContainerId);
                if (!pagWrapper) {
                    pagWrapper = document.createElement('div');
                    pagWrapper.id = pagContainerId;
                    pagWrapper.className = 'siakad-pagination-wrapper w-full flex flex-col items-center justify-center pt-4 pb-2 my-2 border-t border-slate-100';
                    const overflowWrapper = table.closest('.overflow-x-auto, [style*="overflow-x: auto"]') || table.parentElement || table;
                    overflowWrapper.parentNode.insertBefore(pagWrapper, overflowWrapper.nextSibling);
                }

                function renderTablePagination() {
                    const allRows = Array.from(tbody.querySelectorAll('tr')).filter(tr => !isEmptyStateRow(tr));
                    const activeRows = getActiveRows();
                    const totalRows = activeRows.length;
                    const totalPages = Math.ceil(totalRows / PAGE_SIZE) || 1;

                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    const startIdx = (currentPage - 1) * PAGE_SIZE;
                    const endIdx = startIdx + PAGE_SIZE;

                    // Pastikan baris kontrol/header khusus (seperti Pilih Semua) tetap terlihat
                    Array.from(tbody.querySelectorAll('tr')).forEach(tr => {
                        if (isControlRow(tr)) tr.style.display = '';
                    });

                    // Sembunyikan semua row yang filtered out
                    allRows.forEach(row => {
                        if (row.getAttribute('data-filtered-out') === 'true') {
                            row.style.display = 'none';
                        }
                    });

                    // Tampilkan row aktif sesuai halaman saat ini
                    activeRows.forEach((row, idx) => {
                        if (idx >= startIdx && idx < endIdx) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    if (totalRows <= PAGE_SIZE) {
                        if (totalRows === 0) {
                            pagWrapper.innerHTML = '';
                            return;
                        }
                        pagWrapper.innerHTML = `
                            <div class="text-xs text-slate-500 font-medium my-1 text-center">
                                Menampilkan <span class="font-bold text-slate-700">${totalRows}</span> data
                            </div>
                        `;
                        return;
                    }

                    const showingStart = totalRows === 0 ? 0 : startIdx + 1;
                    const showingEnd = Math.min(endIdx, totalRows);

                    let buttonsHtml = '';
                    buttonsHtml += `
                        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                            <button type="button" class="page-link" ${currentPage === 1 ? 'disabled' : ''} data-target-page="${currentPage - 1}" title="Halaman Sebelumnya">
                                <i class="fa-solid fa-chevron-left text-[11px]"></i>
                            </button>
                        </li>
                    `;

                    let startPage = Math.max(1, currentPage - 2);
                    let endPage = Math.min(totalPages, currentPage + 2);

                    if (startPage > 1) {
                        buttonsHtml += `<li class="page-item"><button type="button" class="page-link" data-target-page="1">1</button></li>`;
                        if (startPage > 2) buttonsHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                    }

                    for (let p = startPage; p <= endPage; p++) {
                        buttonsHtml += `
                            <li class="page-item ${p === currentPage ? 'active' : ''}">
                                <button type="button" class="page-link ${p === currentPage ? 'active' : ''}" data-target-page="${p}">${p}</button>
                            </li>
                        `;
                    }

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) buttonsHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                        buttonsHtml += `<li class="page-item"><button type="button" class="page-link" data-target-page="${totalPages}">${totalPages}</button></li>`;
                    }

                    buttonsHtml += `
                        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                            <button type="button" class="page-link" ${currentPage === totalPages ? 'disabled' : ''} data-target-page="${currentPage + 1}" title="Halaman Selanjutnya">
                                <i class="fa-solid fa-chevron-right text-[11px]"></i>
                            </button>
                        </li>
                    `;

                    pagWrapper.innerHTML = `
                        <div class="text-xs text-slate-500 mb-2 font-medium text-center">
                            Menampilkan <span class="font-bold text-slate-700">${showingStart}</span> - <span class="font-bold text-slate-700">${showingEnd}</span> dari <span class="font-bold text-slate-700">${totalRows}</span> data
                        </div>
                        <nav class="flex justify-center items-center">
                            <ul class="pagination">
                                ${buttonsHtml}
                            </ul>
                        </nav>
                    `;

                    pagWrapper.querySelectorAll('button[data-target-page]').forEach(btn => {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            currentPage = parseInt(this.getAttribute('data-target-page'));
                            renderTablePagination();
                        });
                    });
                }

                renderTablePagination();
                window._siakadPagRenderers.push(() => {
                    currentPage = 1;
                    renderTablePagination();
                });
            });
        }
        
        // Auto refresh pagination on search/filter input or select change
        document.addEventListener('input', function(e) {
            if (e.target && (e.target.matches('input[type="text"], input[type="search"]') || (e.target.id && e.target.id.toLowerCase().includes('search')))) {
                setTimeout(window.refreshSiakadPagination, 50);
            }
        });
        document.addEventListener('change', function(e) {
            if (e.target && e.target.matches('select')) {
                setTimeout(window.refreshSiakadPagination, 50);
            }
        });
    </script>
</body>
</html>

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad-layout.blade.php ENDPATH**/ ?>
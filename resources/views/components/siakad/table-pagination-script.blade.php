{{-- Universal SIAKAD Client-Side Table Pagination Script & Pill Styles --}}
<style>
    .siakad-pagination-wrapper {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        text-align: center !important;
        padding: 14px 12px 8px 12px !important;
        margin: 8px auto 4px auto !important;
        border-top: 1px solid #f1f5f9 !important;
        box-sizing: border-box !important;
    }

    .siakad-pagination-info {
        font-size: 0.75rem !important;
        line-height: 1.4 !important;
        color: #64748b !important;
        font-weight: 500 !important;
        margin-bottom: 8px !important;
        text-align: center !important;
    }

    .siakad-pagination-info strong {
        color: #1e293b !important;
        font-weight: 700 !important;
    }

    .siakad-pagination-wrapper nav {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 auto !important;
    }

    .siakad-pagination-wrapper .pagination {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        list-style: none !important;
        margin: 0 auto !important;
        padding: 4px !important;
        gap: 4px !important;
        flex-wrap: wrap !important;
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 999px !important;
    }

    .siakad-pagination-wrapper .pagination .page-item {
        display: inline-flex !important;
        margin: 0 !important;
    }

    .siakad-pagination-wrapper .pagination button.page-link,
    .siakad-pagination-wrapper .pagination .page-link {
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
        cursor: pointer !important;
        line-height: 1 !important;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: none !important;
        outline: none !important;
    }
    .siakad-pagination-wrapper .pagination .page-link::before,
    .siakad-pagination-wrapper .pagination .page-link::after {
        content: none !important;
        display: none !important;
    }

    .siakad-pagination-wrapper .pagination .page-item.active button.page-link,
    .siakad-pagination-wrapper .pagination button.page-link.active {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25) !important;
        font-weight: 700 !important;
    }

    .siakad-pagination-wrapper .pagination button.page-link:hover:not(.active):not(:disabled) {
        background: #e2e8f0 !important;
        color: #0f172a !important;
    }

    .siakad-pagination-wrapper .pagination .page-item.disabled button.page-link,
    .siakad-pagination-wrapper .pagination .page-item.disabled span.page-link,
    .siakad-pagination-wrapper .pagination button.page-link:disabled {
        opacity: 0.4 !important;
        cursor: not-allowed !important;
        pointer-events: none !important;
    }

    @media print {
        .siakad-pagination-wrapper {
            display: none !important;
        }
    }
</style>

<script>
    (function () {
        if (window.__siakadPaginationBooted) return;
        window.__siakadPaginationBooted = true;

        function bootSiakadPagination() {
            initSiakadUniversalTablePagination();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', bootSiakadPagination);
        } else {
            bootSiakadPagination();
        }

        window.refreshSiakadPagination = function () {
            if (window._siakadPagRenderers) {
                window._siakadPagRenderers.forEach(function (fn) {
                    fn();
                });
            }
        };

        window.goToSiakadTablePageForRow = function (row) {
            if (row && typeof row._siakadGoToPage === 'function') {
                return row._siakadGoToPage();
            }
            return false;
        };

        function initSiakadUniversalTablePagination() {
            window._siakadPagRenderers = [];
            var tables = document.querySelectorAll('table');
            var usedPagIds = new Set();

            tables.forEach(function (table, tableIndex) {
                if (table.hasAttribute('data-no-paginate')) return;
                if (table.closest('.modal-card, .flatpickr-calendar, .dropdown-menu, .modal-overlay, [role="dialog"], .fixed.inset-0, #modalEditPembayaran, #modalPengumuman, #modalDetailGuru, #modalKeluarkanSiswa')) return;

                // Jangan paginasi dokumen lembar rapor / area cetak
                if (table.closest('.print-area, .rapor-content-container, .rapor-paper, .rapor-sheet, .rapor-container, .cetak-rapor, .rapor-santri-sheet, #raporContent, #printArea, [data-no-paginate="true"]')) return;
                if (window.location.pathname.includes('detail-rapor') || window.location.pathname.includes('cetak-rapor') || window.location.pathname.includes('cetak-leger') || window.location.pathname.includes('lembar-rapor') || window.location.pathname.includes('detail-pembayaran')) {
                    if (table.closest('.print-area, .rapor-content-container, .border-slate-800, #printArea, .receipt-table') || table.classList.contains('receipt-table') || table.classList.contains('leger-table')) return;
                }

                // Cek jika parent container sudah memiliki pagination server-side (misal pembayaran IPP/Pangkal/Pendidikan/Pengumuman/Pemeliharaan)
                var parentCard = table.closest('.table-card, .card, .bg-white.rounded-xl, .bg-white.rounded-2xl') || (table.parentElement ? table.parentElement.parentElement : null) || table.parentElement;
                if (parentCard && !table.hasAttribute('data-force-paginate')) {
                    var existingServerPag = parentCard.querySelector('.pagination-wrap, .pagination-container, .siakad-server-pagination');
                    if (existingServerPag) {
                        existingServerPag.style.display = 'flex';
                        existingServerPag.style.justifyContent = 'center';
                        existingServerPag.style.alignItems = 'center';
                        return;
                    }
                }

                var tbody = Array.from(table.tBodies || []).find(function (tb) {
                    return tb.rows && tb.rows.length > 0;
                }) || table.querySelector('tbody');
                if (!tbody) return;

                var PAGE_SIZE = parseInt(table.getAttribute('data-page-size') || '5', 10);
                if (isNaN(PAGE_SIZE) || PAGE_SIZE < 1) PAGE_SIZE = 5;
                var currentPage = 1;

                var baseId = 'siakad-pag-table-' + (table.id || ('idx-' + tableIndex));
                var pagContainerId = baseId;
                var suffix = 1;
                while (usedPagIds.has(pagContainerId)) {
                    pagContainerId = baseId + '-' + suffix++;
                }
                usedPagIds.add(pagContainerId);

                function isEmptyStateRow(tr) {
                    if (tr.classList.contains('empty-row')) return true;
                    if (tr.hasAttribute('data-empty-state')) return true;
                    if (tr.id && (tr.id === 'filterEmpty' || tr.id.toLowerCase().includes('empty'))) return true;
                    if (tr.children.length === 1) {
                        var td = tr.querySelector('td[colspan]');
                        if (td && !tr.querySelector('input, select, button, a')) {
                            var txt = (td.textContent || '').trim().toLowerCase();
                            if (txt.includes('belum ada') || txt.includes('tidak ada') || txt.includes('tidak ditemukan') || txt.includes('kosong') || txt.includes('lainnya')) {
                                return true;
                            }
                        }
                    }
                    return false;
                }

                function isControlRow(tr) {
                    if (isEmptyStateRow(tr)) return false;
                    var td = tr.querySelector('td[colspan]');
                    return !!(td && tr.children.length === 1 && !tr.querySelector('input.check-siswa, input.siswa-checkbox'));
                }

                function getDirectTbodyRows() {
                    return Array.from(tbody.children).filter(function (el) {
                        return el.tagName === 'TR';
                    });
                }

                function getActiveRows() {
                    return getDirectTbodyRows().filter(function (tr) {
                        if (isEmptyStateRow(tr)) return false;
                        if (isControlRow(tr)) return false;
                        if (tr.getAttribute('data-filtered-out') === 'true') return false;
                        if (tr.hidden || tr.classList.contains('hide') || tr.classList.contains('is-hidden')) return false;
                        return true;
                    });
                }

                var initialDataRows = getDirectTbodyRows().filter(function (tr) {
                    return !isEmptyStateRow(tr) && !isControlRow(tr);
                });
                if (initialDataRows.length === 0 && !table.hasAttribute('data-force-paginate')) {
                    return;
                }

                var pagWrapper = document.getElementById(pagContainerId);
                if (!pagWrapper) {
                    pagWrapper = document.createElement('div');
                    pagWrapper.id = pagContainerId;
                    pagWrapper.className = 'siakad-pagination-wrapper';
                    var overflowWrapper = table.closest('.overflow-x-auto, .table-responsive, [style*="overflow-x"]') || table.parentElement || table;
                    if (overflowWrapper.parentNode) {
                        overflowWrapper.parentNode.insertBefore(pagWrapper, overflowWrapper.nextSibling);
                    }
                }

                function renderTablePagination() {
                    var allRows = getDirectTbodyRows().filter(function (tr) {
                        return !isEmptyStateRow(tr);
                    });
                    var activeRows = getActiveRows();
                    var totalRows = activeRows.length;
                    var totalPages = Math.max(1, Math.ceil(totalRows / PAGE_SIZE));

                    if (currentPage > totalPages) currentPage = totalPages;
                    if (currentPage < 1) currentPage = 1;

                    var startIdx = (currentPage - 1) * PAGE_SIZE;
                    var endIdx = startIdx + PAGE_SIZE;

                    // Pastikan baris kontrol/header khusus (seperti Pilih Semua) tetap terlihat
                    getDirectTbodyRows().forEach(function (tr) {
                        if (isControlRow(tr)) tr.style.removeProperty('display');
                    });

                    // Sembunyikan row yang difilter
                    allRows.forEach(function (row) {
                        var isOut = row.getAttribute('data-filtered-out') === 'true' || row.hidden || row.classList.contains('hide') || row.classList.contains('is-hidden');
                        if (isOut) {
                            row.style.display = 'none';
                        }
                    });

                    // Atur visibilitas row aktif per halaman
                    activeRows.forEach(function (row, idx) {
                        row._siakadGoToPage = function () {
                            var targetPage = Math.floor(idx / PAGE_SIZE) + 1;
                            if (targetPage !== currentPage) {
                                currentPage = targetPage;
                                renderTablePagination();
                            }
                            return true;
                        };

                        if (idx >= startIdx && idx < endIdx) {
                            row.style.removeProperty('display');
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    if (totalRows === 0) {
                        pagWrapper.innerHTML = '';
                        return;
                    }

                    var showingStart = startIdx + 1;
                    var showingEnd = Math.min(endIdx, totalRows);

                    var buttonsHtml = '';
                    buttonsHtml +=
                        '<li class="page-item ' + (currentPage === 1 ? 'disabled' : '') + '">' +
                            '<button type="button" class="page-link" ' + (currentPage === 1 ? 'disabled' : '') + ' data-target-page="' + (currentPage - 1) + '" title="Halaman Sebelumnya">' +
                                '<i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>' +
                            '</button>' +
                        '</li>';

                    var startPage = Math.max(1, currentPage - 2);
                    var endPage = Math.min(totalPages, currentPage + 2);

                    if (startPage > 1) {
                        buttonsHtml += '<li class="page-item"><button type="button" class="page-link" data-target-page="1">1</button></li>';
                        if (startPage > 2) buttonsHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                    }

                    for (var p = startPage; p <= endPage; p++) {
                        buttonsHtml +=
                            '<li class="page-item ' + (p === currentPage ? 'active' : '') + '">' +
                                '<button type="button" class="page-link ' + (p === currentPage ? 'active' : '') + '" data-target-page="' + p + '">' + p + '</button>' +
                            '</li>';
                    }

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) buttonsHtml += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        buttonsHtml += '<li class="page-item"><button type="button" class="page-link" data-target-page="' + totalPages + '">' + totalPages + '</button></li>';
                    }

                    buttonsHtml +=
                        '<li class="page-item ' + (currentPage === totalPages ? 'disabled' : '') + '">' +
                            '<button type="button" class="page-link" ' + (currentPage === totalPages ? 'disabled' : '') + ' data-target-page="' + (currentPage + 1) + '" title="Halaman Selanjutnya">' +
                                '<i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>' +
                            '</button>' +
                        '</li>';

                    pagWrapper.innerHTML =
                        '<div class="siakad-pagination-info">' +
                            'Menampilkan <strong>' + showingStart + '</strong> - <strong>' + showingEnd + '</strong> dari <strong>' + totalRows + '</strong> data' +
                        '</div>' +
                        '<nav aria-label="Navigasi Halaman Tabel">' +
                            '<ul class="pagination">' + buttonsHtml + '</ul>' +
                        '</nav>';

                    pagWrapper.querySelectorAll('button[data-target-page]').forEach(function (btn) {
                        btn.addEventListener('click', function (e) {
                            e.preventDefault();
                            var target = parseInt(this.getAttribute('data-target-page'), 10);
                            if (!isNaN(target)) {
                                currentPage = target;
                                renderTablePagination();
                            }
                        });
                    });
                }

                renderTablePagination();
                window._siakadPagRenderers.push(function () {
                    currentPage = 1;
                    renderTablePagination();
                });
            });
        }

        // Auto refresh pagination saat input pencarian / select filter berubah
        document.addEventListener('input', function (e) {
            if (e.target && (e.target.matches('input[type="text"], input[type="search"]') || (e.target.id && e.target.id.toLowerCase().includes('search')))) {
                setTimeout(window.refreshSiakadPagination, 50);
            }
        });
        document.addEventListener('change', function (e) {
            if (e.target && e.target.matches('select')) {
                setTimeout(window.refreshSiakadPagination, 50);
            }
        });
    })();
</script>

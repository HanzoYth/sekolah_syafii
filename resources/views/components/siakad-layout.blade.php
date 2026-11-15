@props([
    'title' => null,
    'pageTitle' => null,
    'subtitle' => null,
    'description' => null,
    'pageDescription' => null,
    'position' => null,
    'initials' => null,
])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ $pageTitle ?? ($title ?? 'SIAKAD') }}</title>
    
    <!-- PWA & Mobile Meta Tags -->
    <meta name="theme-color" content="#0d5c3a">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="SIAKAD">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/logo_sklh.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.siakad.styles')
    @include('components.siakad.rank-styles')
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
        <x-siakad.sidebar />
        <main class="main-content">
            @php
                $finalTitle = $pageTitle ?? ($title ?? 'Dashboard SIAKAD');
                $finalDescription = $pageDescription ?? ($description ?? ($subtitle ?? 'Kelola sistem akademik dengan mudah.'));
                $finalPosition = $position ?? (session('role') == 'g' ? 'Guru' : (session('role') == 'a' ? 'Admin' : 'Siswa'));
            @endphp
            <x-siakad.topbar 
                :title="$finalTitle" 
                :description="$finalDescription" 
                :position="$finalPosition" 
            />

            <div class="page-container">
                @include('components.siakad.flash-alert')
                @include('components.siakad.dialog-modal')

                {{ $slot }}
            </div>
        </main>
    </div>

    {{ $scripts ?? '' }}

    @include('components.siakad.table-pagination-script')

    <script>

        window.sortSiakadRankingTable = function(tableId, mode, triggerBtn) {
            const table = document.getElementById(tableId);
            if (!table) return;
            const tbody = table.querySelector('tbody');
            if (!tbody) return;

            const rows = Array.from(tbody.querySelectorAll('tr[data-orig-index]'));
            if (rows.length === 0) return;

            rows.sort((a, b) => {
                if (mode === 'rank') {
                    const ra = parseInt(a.getAttribute('data-rank') || '999999', 10);
                    const rb = parseInt(b.getAttribute('data-rank') || '999999', 10);
                    if (ra !== rb) return ra - rb;
                }
                const oa = parseInt(a.getAttribute('data-orig-index') || '0', 10);
                const ob = parseInt(b.getAttribute('data-orig-index') || '0', 10);
                return oa - ob;
            });

            rows.forEach((tr, idx) => {
                tbody.appendChild(tr);
                const noCell = tr.querySelector('td[data-row-number="true"]');
                if (noCell) {
                    noCell.textContent = idx + 1;
                }
            });

            if (triggerBtn) {
                const group = triggerBtn.closest('[role="group"]');
                if (group) {
                    group.querySelectorAll('button').forEach(btn => {
                        const isActive = btn === triggerBtn;
                        btn.classList.toggle('bg-white', isActive);
                        btn.classList.toggle('font-bold', isActive);
                        btn.classList.toggle('shadow-sm', isActive);
                        btn.classList.toggle('border', isActive);
                        btn.classList.toggle('border-slate-200/80', isActive);
                        btn.classList.toggle('text-emerald-700', isActive && mode !== 'rank');
                        btn.classList.toggle('text-amber-700', isActive && mode === 'rank');
                        btn.classList.toggle('font-semibold', !isActive);
                        btn.classList.toggle('text-slate-600', !isActive);
                    });
                }
            }

            if (window.refreshSiakadPagination) {
                window.refreshSiakadPagination();
            }
        };
    </script>
</body>
</html>


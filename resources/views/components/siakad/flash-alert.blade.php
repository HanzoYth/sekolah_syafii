{{-- Flash Notification Toast Khusus Modul SIAKAD --}}
@php
    $flashAlerts = [];
    if (session('error') || session('eror')) {
        $flashAlerts[] = [
            'type' => 'error',
            'title' => 'Perhatian',
            'messages' => [session('error') ?? session('eror')],
        ];
    }
    if (session('warning')) {
        $flashAlerts[] = [
            'type' => 'warning',
            'title' => 'Peringatan',
            'messages' => [session('warning')],
        ];
    }
    if (session('info')) {
        $flashAlerts[] = [
            'type' => 'info',
            'title' => 'Informasi',
            'messages' => [session('info')],
        ];
    }
    if (session('success')) {
        $flashAlerts[] = [
            'type' => 'success',
            'title' => 'Berhasil',
            'messages' => [session('success')],
        ];
    }
    if (isset($errors) && $errors->any()) {
        $flashAlerts[] = [
            'type' => 'error',
            'title' => 'Validasi Gagal',
            'messages' => $errors->all(),
        ];
    }
@endphp

@once
    <style>
        #siakad-flash-stack {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 99995;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 420px;
            width: calc(100vw - 32px);
            pointer-events: none;
        }
        .siakad-flash-card {
            pointer-events: auto;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 14px 32px rgba(15, 23, 42, 0.14), 0 4px 10px rgba(15, 23, 42, 0.06);
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            animation: siakadFlashIn 0.35s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            position: relative;
            overflow: hidden;
        }
        .siakad-flash-card.is-leaving {
            animation: siakadFlashOut 0.3s ease forwards;
        }
        .siakad-flash-card.is-success { border-left: 5px solid #10b981; }
        .siakad-flash-card.is-error   { border-left: 5px solid #ef4444; }
        .siakad-flash-card.is-warning { border-left: 5px solid #f59e0b; }
        .siakad-flash-card.is-info    { border-left: 5px solid #3b82f6; }

        .siakad-flash-icon {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }
        .siakad-flash-card.is-success .siakad-flash-icon { background: #ecfdf5; color: #059669; }
        .siakad-flash-card.is-error   .siakad-flash-icon { background: #fef2f2; color: #dc2626; }
        .siakad-flash-card.is-warning .siakad-flash-icon { background: #fffbeb; color: #d97706; }
        .siakad-flash-card.is-info    .siakad-flash-icon { background: #eff6ff; color: #2563eb; }

        .siakad-flash-body {
            flex: 1;
            min-width: 0;
        }
        .siakad-flash-title {
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin: 0 0 2px 0;
            color: #0f172a;
        }
        .siakad-flash-msg {
            font-size: 0.83rem;
            line-height: 1.45;
            color: #334155;
            margin: 0;
            word-break: break-word;
        }
        .siakad-flash-msg + .siakad-flash-msg {
            margin-top: 4px;
        }
        .siakad-flash-close {
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            border-radius: 6px;
            line-height: 1;
            font-size: 14px;
            transition: all 0.15s ease;
            flex-shrink: 0;
        }
        .siakad-flash-close:hover {
            background: #f1f5f9;
            color: #334155;
        }
        @keyframes siakadFlashIn {
            from { opacity: 0; transform: translateX(28px) scale(0.97); }
            to   { opacity: 1; transform: translateX(0) scale(1); }
        }
        @keyframes siakadFlashOut {
            from { opacity: 1; transform: translateX(0) scale(1); }
            to   { opacity: 0; transform: translateX(28px) scale(0.97); }
        }
        @media (max-width: 640px) {
            #siakad-flash-stack {
                top: 12px;
                right: 12px;
                left: 12px;
                width: auto;
                max-width: none;
            }
        }
        @media print {
            #siakad-flash-stack {
                display: none !important;
            }
        }
    </style>
@endonce

<div id="siakad-flash-stack" aria-live="polite">
    @foreach($flashAlerts as $alertItem)
        @php
            $t = $alertItem['type'];
            $iconClass = match($t) {
                'success' => 'fa-circle-check',
                'warning' => 'fa-triangle-exclamation',
                'info'    => 'fa-circle-info',
                default   => 'fa-circle-exclamation',
            };
        @endphp
        <div class="siakad-flash-card is-{{ $t }}" data-siakad-auto-dismiss="5500">
            <div class="siakad-flash-icon">
                <i class="fa-solid {{ $iconClass }}"></i>
            </div>
            <div class="siakad-flash-body">
                <p class="siakad-flash-title">{{ $alertItem['title'] }}</p>
                @foreach($alertItem['messages'] as $msg)
                    <p class="siakad-flash-msg">{{ $msg }}</p>
                @endforeach
            </div>
            <button type="button" class="siakad-flash-close" onclick="window.closeSiakadFlash(this.closest('.siakad-flash-card'))" aria-label="Tutup notifikasi">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endforeach
</div>

<script>
    (function () {
        if (window.__siakadFlashBooted) return;
        window.__siakadFlashBooted = true;

        window.closeSiakadFlash = function (card) {
            if (!card || card.classList.contains('is-leaving')) return;
            card.classList.add('is-leaving');
            setTimeout(function () {
                if (card.parentNode) card.parentNode.removeChild(card);
            }, 300);
        };

        document.querySelectorAll('.siakad-flash-card[data-siakad-auto-dismiss]').forEach(function (card) {
            var delay = parseInt(card.getAttribute('data-siakad-auto-dismiss') || '5500', 10);
            var timer = setTimeout(function () {
                window.closeSiakadFlash(card);
            }, delay);

            card.addEventListener('mouseenter', function () {
                clearTimeout(timer);
            });
            card.addEventListener('mouseleave', function () {
                timer = setTimeout(function () {
                    window.closeSiakadFlash(card);
                }, 2500);
            });
        });
    })();
</script>


<?php if (! $__env->hasRenderedOnce('7d8db3af-45b5-48c4-9990-a516f8872e92')): $__env->markAsRenderedOnce('7d8db3af-45b5-48c4-9990-a516f8872e92'); ?>
    <style>
        #siakadDialogOverlay {
            position: fixed;
            inset: 0;
            z-index: 99990;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 16px;
            background: rgba(15, 23, 42, 0.48);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        #siakadDialogOverlay.is-open {
            display: flex;
            animation: siakadDialogFade 0.18s ease-out forwards;
        }
        #siakadDialogCard {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 24px 48px rgba(15, 23, 42, 0.22);
            padding: 24px;
            box-sizing: border-box;
            transform: scale(0.95);
            opacity: 0;
            animation: siakadDialogPop 0.22s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        .siakad-dialog-head {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .siakad-dialog-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .siakad-dialog-icon.is-emerald { background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; }
        .siakad-dialog-icon.is-warning { background: #fffbeb; color: #d97706; border: 1px solid #fde68a; }
        .siakad-dialog-icon.is-danger  { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }
        .siakad-dialog-icon.is-info    { background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; }

        .siakad-dialog-title {
            margin: 0;
            font-size: 1.02rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.35;
        }
        .siakad-dialog-msg {
            margin: 6px 0 0 0;
            font-size: 0.84rem;
            color: #475569;
            line-height: 1.55;
        }
        .siakad-dialog-detail {
            margin-top: 14px;
            padding: 12px 14px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 0.8rem;
            color: #334155;
            line-height: 1.55;
        }
        .siakad-dialog-detail:empty {
            display: none;
        }
        .siakad-dialog-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }
        .siakad-dialog-btn {
            padding: 10px 18px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            transition: all 0.18s ease;
        }
        .siakad-dialog-btn-cancel {
            background: #f1f5f9;
            color: #475569;
        }
        .siakad-dialog-btn-cancel:hover {
            background: #e2e8f0;
            color: #0f172a;
        }
        .siakad-dialog-btn-ok.is-emerald { background: #059669; color: #ffffff; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.25); }
        .siakad-dialog-btn-ok.is-emerald:hover { background: #047857; }
        .siakad-dialog-btn-ok.is-warning { background: #d97706; color: #ffffff; box-shadow: 0 4px 12px rgba(217, 119, 6, 0.25); }
        .siakad-dialog-btn-ok.is-warning:hover { background: #b45309; }
        .siakad-dialog-btn-ok.is-danger  { background: #dc2626; color: #ffffff; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25); }
        .siakad-dialog-btn-ok.is-danger:hover  { background: #b91c1c; }
        .siakad-dialog-btn-ok.is-info    { background: #2563eb; color: #ffffff; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25); }
        .siakad-dialog-btn-ok.is-info:hover    { background: #1d4ed8; }

        @keyframes siakadDialogFade {
            from { opacity: 0; }
            to   { opacity: 1; }
        }
        @keyframes siakadDialogPop {
            to { transform: scale(1); opacity: 1; }
        }
    </style>

    <div id="siakadDialogOverlay" role="dialog" aria-modal="true" aria-labelledby="siakadDialogTitle">
        <div id="siakadDialogCard">
            <div class="siakad-dialog-head">
                <div id="siakadDialogIconWrap" class="siakad-dialog-icon is-emerald">
                    <i id="siakadDialogIcon" class="fa-solid fa-circle-question"></i>
                </div>
                <div style="flex: 1; min-width: 0;">
                    <h3 id="siakadDialogTitle" class="siakad-dialog-title">Konfirmasi</h3>
                    <p id="siakadDialogMessage" class="siakad-dialog-msg"></p>
                </div>
            </div>
            <div id="siakadDialogDetail" class="siakad-dialog-detail"></div>
            <div class="siakad-dialog-actions">
                <button type="button" id="siakadDialogCancelBtn" class="siakad-dialog-btn siakad-dialog-btn-cancel">Batal</button>
                <button type="button" id="siakadDialogConfirmBtn" class="siakad-dialog-btn siakad-dialog-btn-ok is-emerald">Ya, Lanjutkan</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            if (window.SiakadAlert) return;

            var overlay = document.getElementById('siakadDialogOverlay');
            var iconWrap = document.getElementById('siakadDialogIconWrap');
            var iconEl = document.getElementById('siakadDialogIcon');
            var titleEl = document.getElementById('siakadDialogTitle');
            var msgEl = document.getElementById('siakadDialogMessage');
            var detailEl = document.getElementById('siakadDialogDetail');
            var cancelBtn = document.getElementById('siakadDialogCancelBtn');
            var confirmBtn = document.getElementById('siakadDialogConfirmBtn');

            var activeResolver = null;
            var activeOnConfirm = null;

            function defaultIconFor(variant) {
                if (variant === 'danger') return 'fa-triangle-exclamation';
                if (variant === 'warning') return 'fa-triangle-exclamation';
                if (variant === 'info') return 'fa-circle-info';
                return 'fa-circle-check';
            }

            function closeDialog(result) {
                overlay.classList.remove('is-open');
                var resolver = activeResolver;
                var cb = activeOnConfirm;
                activeResolver = null;
                activeOnConfirm = null;
                if (result && typeof cb === 'function') {
                    cb();
                }
                if (typeof resolver === 'function') {
                    resolver(Boolean(result));
                }
            }

            cancelBtn.addEventListener('click', function () {
                closeDialog(false);
            });

            confirmBtn.addEventListener('click', function () {
                closeDialog(true);
            });

            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) {
                    closeDialog(false);
                }
            });

            document.addEventListener('keydown', function (e) {
                if (!overlay.classList.contains('is-open')) return;
                if (e.key === 'Escape') {
                    e.preventDefault();
                    closeDialog(false);
                }
            });

            function openDialog(opts) {
                opts = opts || {};
                var variant = opts.variant || 'emerald';
                var isAlertOnly = Boolean(opts.alertOnly);

                iconWrap.className = 'siakad-dialog-icon is-' + variant;
                iconEl.className = 'fa-solid ' + (opts.icon || defaultIconFor(variant));
                titleEl.textContent = opts.title || (isAlertOnly ? 'Informasi' : 'Konfirmasi Tindakan');
                msgEl.textContent = opts.message || '';

                if (opts.detailHtml) {
                    detailEl.innerHTML = opts.detailHtml;
                } else {
                    detailEl.innerHTML = '';
                }

                cancelBtn.style.display = isAlertOnly ? 'none' : 'inline-flex';
                cancelBtn.textContent = opts.cancelText || 'Batal';
                confirmBtn.className = 'siakad-dialog-btn siakad-dialog-btn-ok is-' + variant;
                confirmBtn.textContent = opts.confirmText || (isAlertOnly ? 'Mengerti' : 'Ya, Lanjutkan');
                activeOnConfirm = opts.onConfirm || null;

                overlay.classList.add('is-open');
                setTimeout(function () {
                    confirmBtn.focus();
                }, 20);

                return new Promise(function (resolve) {
                    activeResolver = resolve;
                });
            }

            function spawnToast(message, variant) {
                variant = variant || 'info';
                var stack = document.getElementById('siakad-flash-stack');
                if (!stack) {
                    stack = document.createElement('div');
                    stack.id = 'siakad-flash-stack';
                    document.body.appendChild(stack);
                }
                var titles = { success: 'Berhasil', error: 'Perhatian', warning: 'Peringatan', info: 'Informasi' };
                var icons = { success: 'fa-circle-check', error: 'fa-circle-exclamation', warning: 'fa-triangle-exclamation', info: 'fa-circle-info' };
                var card = document.createElement('div');
                card.className = 'siakad-flash-card is-' + variant;
                card.innerHTML =
                    '<div class="siakad-flash-icon"><i class="fa-solid ' + (icons[variant] || 'fa-circle-info') + '"></i></div>' +
                    '<div class="siakad-flash-body">' +
                        '<p class="siakad-flash-title">' + (titles[variant] || 'Informasi') + '</p>' +
                        '<p class="siakad-flash-msg"></p>' +
                    '</div>' +
                    '<button type="button" class="siakad-flash-close" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button>';
                card.querySelector('.siakad-flash-msg').textContent = message || '';
                card.querySelector('.siakad-flash-close').addEventListener('click', function () {
                    if (window.closeSiakadFlash) window.closeSiakadFlash(card);
                    else card.remove();
                });
                stack.appendChild(card);
                setTimeout(function () {
                    if (window.closeSiakadFlash) window.closeSiakadFlash(card);
                    else if (card.parentNode) card.parentNode.removeChild(card);
                }, 4800);
            }

            window.SiakadAlert = {
                confirm: function (opts) {
                    return openDialog(Object.assign({ alertOnly: false }, opts));
                },
                alert: function (opts) {
                    return openDialog(Object.assign({ alertOnly: true }, opts));
                },
                success: function (title, message) {
                    return openDialog({ alertOnly: true, variant: 'emerald', icon: 'fa-circle-check', title: title, message: message });
                },
                warning: function (title, message) {
                    return openDialog({ alertOnly: true, variant: 'warning', icon: 'fa-triangle-exclamation', title: title, message: message });
                },
                error: function (title, message) {
                    return openDialog({ alertOnly: true, variant: 'danger', icon: 'fa-circle-exclamation', title: title, message: message });
                },
                info: function (title, message) {
                    return openDialog({ alertOnly: true, variant: 'info', icon: 'fa-circle-info', title: title, message: message });
                },
                toast: spawnToast
            };

            // Tangani form deklaratif [data-siakad-confirm] pada capture phase (sebelum loader.blade.php)
            document.addEventListener('submit', function (e) {
                var form = e.target;
                if (!form || form.tagName !== 'FORM') return;
                if (!form.hasAttribute('data-siakad-confirm')) return;

                if (form.dataset.siakadConfirmed === '1') {
                    delete form.dataset.siakadConfirmed;
                    return;
                }

                e.preventDefault();
                e.stopImmediatePropagation();

                openDialog({
                    title: form.getAttribute('data-confirm-title') || 'Konfirmasi',
                    message: form.getAttribute('data-siakad-confirm'),
                    detailHtml: form.getAttribute('data-confirm-detail') || '',
                    variant: form.getAttribute('data-confirm-variant') || 'emerald',
                    icon: form.getAttribute('data-confirm-icon') || '',
                    confirmText: form.getAttribute('data-confirm-ok') || 'Ya, Lanjutkan',
                    cancelText: form.getAttribute('data-confirm-cancel') || 'Batal',
                    onConfirm: function () {
                        form.dataset.siakadConfirmed = '1';
                        if (typeof form.requestSubmit === 'function') {
                            form.requestSubmit();
                        } else {
                            form.submit();
                        }
                    }
                });
            }, true);
        })();
    </script>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/siakad/dialog-modal.blade.php ENDPATH**/ ?>
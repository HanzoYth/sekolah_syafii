{{-- ============================================================
     KOMPONEN VISUAL EDITOR WEBSITE KHUSUS ADMIN (DRAGGABLE & LIVELY)
     1. Pop-up Card Bebas Digerakkan (Draggable dengan Touch & Mouse)
     2. Desain Lebih Hidup (Spring Animations, Glowing Dots, Sparkle Icons)
     3. Mode Edit Visual & Undo / Redo Sesi
     4. Inline Contenteditable & Hover Image Replace
============================================================ --}}
<link rel="stylesheet" href="{{ asset('css/admin-home-editor.css') }}?v={{ time() }}">

<!-- FLOATING CHATBOT-STYLE WIDGET -->
<div id="adminFloatingWidget" aria-label="Editor Tampilan Website">
    <!-- POPUP MENU CARD (DRAGGABLE DARI HEADER) -->
    <div id="adminEditorPopupCard" class="admin-editor-card" role="dialog" aria-hidden="true">
        <!-- HEADER DENGAN HANDLE DRAG -->
        <div class="admin-card-header" id="adminCardDragHandle" title="Tahan & geser untuk memindahkan posisi menu ini">
            <div class="drag-grip-indicator"></div>
            <div class="admin-card-title">
                <i class="fa-solid fa-wand-magic-sparkles wand-icon"></i>
                <div>
                    <h4>Editor Tampilan <small style="font-size: 0.65rem; background: rgba(234, 179, 8, 0.25); padding: 1px 6px; border-radius: 999px; color: #fde047; font-weight: 600;">Draggable</small></h4>
                    <span>Admin: {{ session('nama') ?? 'Administrator' }}</span>
                </div>
            </div>
            <div class="header-btn-group">
                <button type="button" class="btn-card-snap" onclick="resetPopupPosition(event)" title="Kembalikan posisi popup ke pojok awal">
                    <i class="fa-solid fa-arrows-to-dot"></i>
                </button>
                <button type="button" class="btn-card-close" onclick="toggleEditorPopup(false)" title="Tutup Menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </div>

        <div class="admin-card-body">
            <!-- MODE EDIT SWITCH -->
            <div class="admin-switch-row" id="adminSwitchRow">
                <div class="switch-label">
                    <strong>
                        <span class="live-status-dot" id="liveStatusDot"></span>
                        Mode Edit Visual
                    </strong>
                    <small id="modeStatusText">Nonaktif (Pratinjau)</small>
                </div>
                <label class="toggle-switch">
                    <input type="checkbox" id="toggleEditModeSwitch" onchange="toggleEditMode(this.checked)">
                    <span class="slider"></span>
                </label>
            </div>

            <div class="editor-guide-tip">
                <i class="fa-solid fa-circle-info"></i>
                <span>Saat aktif, <strong>klik teks langsung</strong> untuk mengetik dan <strong>hover ke gambar</strong> untuk mengganti foto. Header menu ini bisa <strong>digerakkan bebas</strong>.</span>
            </div>

            <!-- UNDO & REDO CONTROLS -->
            <div class="history-controls-box">
                <div class="history-header">
                    <span><i class="fa-solid fa-clock-rotate-left"></i> Riwayat Sesi:</span>
                    <span class="history-counter" id="historyCounterBadge">0 Perubahan</span>
                </div>
                <div class="history-btn-group">
                    <button type="button" class="btn-history" id="btnAdminUndo" onclick="performUndo()" disabled title="Batalkan perubahan terakhir (Ctrl+Z)">
                        <i class="fa-solid fa-rotate-left"></i> Undo
                    </button>
                    <button type="button" class="btn-history" id="btnAdminRedo" onclick="performRedo()" disabled title="Ulangi perubahan (Ctrl+Y)">
                        <i class="fa-solid fa-rotate-right"></i> Redo
                    </button>
                </div>
                <div class="shortcut-hint">
                    Pintasan: <kbd>Ctrl+Z</kbd> (Undo) &bull; <kbd>Ctrl+Y</kbd> (Redo)
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="admin-card-actions">
                <button type="button" class="btn-save-session" onclick="saveAllCurrentChanges()">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Sesi
                </button>
                <a href="/sk/das" class="btn-dashboard-link">
                    <i class="fa-solid fa-gauge-high"></i> Buka Dashboard SIAKAD
                </a>
            </div>
        </div>
    </div>

    <!-- FLOATING LAUNCHER BUTTON (BULAT SEPERTI CHATBOT) -->
    <button type="button" id="adminLauncherBtn" class="admin-launcher-btn" onclick="toggleEditorPopup()" title="Buka Editor Tampilan Website">
        <i class="fa-solid fa-wand-magic-sparkles" id="launcherIcon"></i>
        <span class="launcher-pulse"></span>
    </button>
</div>

<!-- HIDDEN FILE INPUT UNTUK GANTI FOTO INSTAN -->
<input type="file" id="adminInstantImgInput" accept="image/*" style="display: none;">

<!-- TOAST NOTIFICATION -->
<div id="adminEditorToast" role="status" aria-live="polite">
    <i class="fa-solid fa-circle-check"></i>
    <span id="adminEditorToastMsg">Perubahan berhasil!</span>
</div>

<!-- SCRIPT ENGINE EDITOR VISUAL DENGAN DRAGGABLE, UNDO & REDO -->
<script>
    (function () {
        var isEditMode = false;
        var isPopupOpen = false;
        var activeImageTarget = null;
        var PAGE_STORAGE_KEY = 'syafii_editor_' + (window.location.pathname + window.location.search).replace(/[^a-zA-Z0-9]/g, '_');
        
        // Riwayat Undo & Redo (Sesi)
        var undoHistory = [];
        var redoHistory = [];

        function initEditor() {
            setupImageOverlays();
            restoreSavedContent();
            updateHistoryUI();
            setupGlobalTextInterceptor();
            initDraggablePopup();
            restorePopupPosition();
        }

        // ============================================================
        // DRAGGABLE ENGINE (POPUP BEBAS DIGERAKKAN DENGAN MOUSE/TOUCH)
        // ============================================================
        function initDraggablePopup() {
            var card = document.getElementById('adminEditorPopupCard');
            var handle = document.getElementById('adminCardDragHandle');
            if (!card || !handle) return;

            var startX = 0, startY = 0, initLeft = 0, initTop = 0;
            var isDragging = false;

            // Mouse Events
            handle.addEventListener('mousedown', function (e) {
                if (e.target.closest('button, a, input')) return;
                e.preventDefault();

                isDragging = true;
                startX = e.clientX;
                startY = e.clientY;

                var rect = card.getBoundingClientRect();
                initLeft = rect.left;
                initTop = rect.top;

                card.classList.add('is-dragging');
                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('mouseup', onMouseUp);
            });

            function onMouseMove(e) {
                if (!isDragging) return;
                e.preventDefault();

                var dx = e.clientX - startX;
                var dy = e.clientY - startY;

                var newLeft = initLeft + dx;
                var newTop = initTop + dy;

                // Batas Viewport Layar (Clamping agar tidak keluar layar)
                var pad = 10;
                var maxLeft = window.innerWidth - card.offsetWidth - pad;
                var maxTop = window.innerHeight - card.offsetHeight - pad;

                newLeft = Math.max(pad, Math.min(newLeft, maxLeft));
                newTop = Math.max(pad, Math.min(newTop, maxTop));

                card.style.position = 'fixed';
                card.style.left = newLeft + 'px';
                card.style.top = newTop + 'px';
                card.style.right = 'auto';
                card.style.bottom = 'auto';
            }

            function onMouseUp() {
                if (!isDragging) return;
                isDragging = false;
                card.classList.remove('is-dragging');
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);

                // Simpan posisi terakhir di sesi
                sessionStorage.setItem('syafii_popup_pos', JSON.stringify({
                    left: card.style.left,
                    top: card.style.top
                }));
            }

            // Touch Events (Mobile / Tablet Support)
            handle.addEventListener('touchstart', function (e) {
                if (e.target.closest('button, a, input')) return;
                var touch = e.touches[0];
                isDragging = true;
                startX = touch.clientX;
                startY = touch.clientY;

                var rect = card.getBoundingClientRect();
                initLeft = rect.left;
                initTop = rect.top;

                card.classList.add('is-dragging');
                document.addEventListener('touchmove', onTouchMove, { passive: false });
                document.addEventListener('touchend', onTouchEnd);
            }, { passive: true });

            function onTouchMove(e) {
                if (!isDragging) return;
                e.preventDefault();
                var touch = e.touches[0];
                var dx = touch.clientX - startX;
                var dy = touch.clientY - startY;

                var newLeft = initLeft + dx;
                var newTop = initTop + dy;

                var pad = 8;
                var maxLeft = window.innerWidth - card.offsetWidth - pad;
                var maxTop = window.innerHeight - card.offsetHeight - pad;

                newLeft = Math.max(pad, Math.min(newLeft, maxLeft));
                newTop = Math.max(pad, Math.min(newTop, maxTop));

                card.style.position = 'fixed';
                card.style.left = newLeft + 'px';
                card.style.top = newTop + 'px';
                card.style.right = 'auto';
                card.style.bottom = 'auto';
            }

            function onTouchEnd() {
                if (!isDragging) return;
                isDragging = false;
                card.classList.remove('is-dragging');
                document.removeEventListener('touchmove', onTouchMove);
                document.removeEventListener('touchend', onTouchEnd);

                sessionStorage.setItem('syafii_popup_pos', JSON.stringify({
                    left: card.style.left,
                    top: card.style.top
                }));
            }
        }

        window.resetPopupPosition = function (e) {
            if (e) e.stopPropagation();
            var card = document.getElementById('adminEditorPopupCard');
            if (!card) return;

            card.style.position = 'fixed';
            card.style.left = 'auto';
            card.style.top = 'auto';
            card.style.right = '24px';
            card.style.bottom = '96px';
            sessionStorage.removeItem('syafii_popup_pos');
            showToast('Posisi popup dikembalikan ke pojok kanan bawah.');
        };

        function restorePopupPosition() {
            try {
                var pos = JSON.parse(sessionStorage.getItem('syafii_popup_pos'));
                if (pos && pos.left && pos.top) {
                    var card = document.getElementById('adminEditorPopupCard');
                    if (card) {
                        card.style.position = 'fixed';
                        card.style.left = pos.left;
                        card.style.top = pos.top;
                        card.style.right = 'auto';
                        card.style.bottom = 'auto';
                    }
                }
            } catch (err) {}
        }

        // ============================================================
        // POPUP TOGGLE
        // ============================================================
        window.toggleEditorPopup = function (forceState) {
            var card = document.getElementById('adminEditorPopupCard');
            var icon = document.getElementById('launcherIcon');
            if (forceState !== undefined) {
                isPopupOpen = forceState;
            } else {
                isPopupOpen = !isPopupOpen;
            }

            if (isPopupOpen) {
                card.classList.add('active');
                icon.className = 'fa-solid fa-xmark';
            } else {
                card.classList.remove('active');
                icon.className = 'fa-solid fa-wand-magic-sparkles';
            }
        };

        // ============================================================
        // MODE EDIT TOGGLE
        // ============================================================
        window.toggleEditMode = function (enabled) {
            isEditMode = enabled;
            var statusText = document.getElementById('modeStatusText');
            var switchRow = document.getElementById('adminSwitchRow');
            var dot = document.getElementById('liveStatusDot');

            if (enabled) {
                document.body.classList.add('editor-mode-active');
                if (statusText) statusText.textContent = 'Aktif (Siap Edit)';
                if (switchRow) switchRow.classList.add('is-active');
                if (dot) dot.classList.add('active');
                scanAndMakeAllTextsEditable(true);
                showToast('Mode Edit Aktif! Klik teks langsung untuk mengetik, atau arahkan kursor ke foto untuk mengganti.');
            } else {
                document.body.classList.remove('editor-mode-active');
                if (statusText) statusText.textContent = 'Nonaktif (Pratinjau)';
                if (switchRow) switchRow.classList.remove('is-active');
                if (dot) dot.classList.remove('active');
                scanAndMakeAllTextsEditable(false);
                showToast('Mode Pratinjau Normal Aktif.');
            }
        };

        // ============================================================
        // SISTEM PROTEKSI: ELEMEN YANG TIDAK BOLEH DIEDIT SAMA SEKALI
        // ============================================================
        function isProtectedElement(el) {
            if (!el) return true;
            // 1. Bar editor & widget popup
            if (el.closest('#adminFloatingWidget') || el.closest('#adminEditorToast')) return true;
            // 2. Navbar, Menu Navigasi, Logo, & Breadcrumb
            if (el.closest('.navbar') || el.closest('nav') || el.closest('.logo') || el.closest('.page-breadcrumb')) return true;
            // 3. Semua Tombol Aksi (Buttons & Button Links)
            if (el.closest('button') || el.closest('.btn-started') || el.closest('.btn-secondary') || el.closest('.hero-btns') || el.closest('.auth-buttons') || el.closest('.btn-action') || el.closest('.menu-toggle')) return true;
            // 4. Form Kontak & Formulir Input
            if (el.closest('form') || el.closest('input') || el.closest('textarea') || el.closest('select')) return true;
            // 5. Teks Sakral Arab (Basmalah & Matan Hadits Berbahasa Arab)
            if (el.closest('.basmalah') || el.classList.contains('basmalah') || el.closest('[lang="ar"]') || (el.classList && el.classList.contains('arabic-quote'))) return true;
            // 6. Peta Lokasi / Leaflet Map
            if (el.closest('#map') || el.closest('.leaflet-container')) return true;
            // 7. Footer Copyright / Tahun Otomatis
            if (el.closest('.copyright') || el.id === 'year' || el.closest('.footer-bottom')) return true;

            return false;
        }

        // ============================================================
        // 1. FITUR TEKS: ELEMEN KONTEN YANG DIPERBOLEHKAN DIEDIT
        // ============================================================
        var editableSelectors = [
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'li', 'blockquote',
            'span.section-eyebrow', '.lead-text', '.hero-desc',
            '.check-item', '.stat-number', '.stat-desc', '.stat-item-desc',
            '.hero-mini-stat strong', '.hero-mini-stat span',
            '.floating-badge strong', '.floating-badge span',
            '.profil-exp-badge strong', '.profil-exp-badge span',
            '.fasilitas-card h4', '.fasilitas-card p',
            '.vm-card h3', '.vm-card p', '.vm-card li',
            '.program-card h3', '.program-card p',
            '.galeri-caption h4', '.galeri-caption p',
            '.step-title', '.step-desc', '.contact-item-text'
        ].join(', ');

        function getEditableElements() {
            var all = document.querySelectorAll(editableSelectors);
            var filtered = [];
            all.forEach(function (el) {
                if (!isProtectedElement(el)) {
                    filtered.push(el);
                }
            });
            return filtered;
        }

        function scanAndMakeAllTextsEditable(enable) {
            var elements = getEditableElements();
            elements.forEach(function (el, idx) {
                var textKey = el.getAttribute('data-admin-text-key');
                if (!textKey) {
                    textKey = 'txt_' + idx + '_' + el.tagName.toLowerCase();
                    el.setAttribute('data-admin-text-key', textKey);
                }

                if (enable) {
                    el.contentEditable = 'true';
                    el.setAttribute('data-editor-text', 'true');
                    el.title = 'Klik untuk mengetik perubahan teks secara langsung';

                    el.onfocus = function () {
                        el._beforeText = el.innerHTML;
                    };

                    el.onblur = function () {
                        var oldText = el._beforeText;
                        var newText = el.innerHTML;
                        if (oldText !== undefined && oldText !== newText) {
                            pushHistoryAction({
                                type: 'text',
                                key: textKey,
                                oldVal: oldText,
                                newVal: newText
                            });
                            saveToPageStorage(textKey, newText);
                            showToast('Teks berhasil diperbarui!');
                        }
                    };
                } else {
                    el.contentEditable = 'false';
                    el.removeAttribute('data-editor-text');
                    el.removeAttribute('title');
                }
            });
        }

        // Global Interceptor: Hanya teks konten yang boleh diedit, tombol & navigasi tetap berfungsi normal!
        function setupGlobalTextInterceptor() {
            document.addEventListener('click', function (e) {
                if (!isEditMode) return;
                var target = e.target;
                
                // JIKA TERMASUK ELEMEN DILINDUNGI (TOMBOL, NAVIGASI, FORM, TEKS ARAB), JANGAN DIUBAH!
                if (isProtectedElement(target)) {
                    return; // Biarkan tombol dan navigasi berfungsi normal
                }

                if (target.tagName !== 'IMG' && target.tagName !== 'SVG' && target.tagName !== 'PATH' && target.tagName !== 'INPUT') {
                    if (target.contentEditable !== 'true') {
                        target.contentEditable = 'true';
                        target.setAttribute('data-editor-text', 'true');
                        var textKey = target.getAttribute('data-admin-text-key');
                        if (!textKey) {
                            textKey = 'dyn_txt_' + Math.random().toString(36).substr(2, 9);
                            target.setAttribute('data-admin-text-key', textKey);
                        }
                        target.focus();
                        target._beforeText = target.innerHTML;
                        target.onblur = function () {
                            var oldText = target._beforeText;
                            var newText = target.innerHTML;
                            if (oldText !== undefined && oldText !== newText) {
                                pushHistoryAction({
                                    type: 'text',
                                    key: textKey,
                                    oldVal: oldText,
                                    newVal: newText
                                });
                                saveToPageStorage(textKey, newText);
                                showToast('Teks berhasil diperbarui!');
                            }
                        };
                    }
                }
            }, true);
        }

        // ============================================================
        // 2. FITUR GAMBAR: HOVER UNTUK GANTI FOTO
        // ============================================================
        function setupImageOverlays() {
            var imgs = document.querySelectorAll('section img, header img, footer img, .hero-stage img, .profil-visual-stack img, .galeri-grid img, .fasilitas-grid img, main img');
            
            imgs.forEach(function (img, idx) {
                if (img.closest('.navbar') || img.closest('.logo') || img.closest('nav') || img.closest('#adminFloatingWidget')) {
                    return;
                }

                var imgKey = 'img_' + idx;
                img.setAttribute('data-admin-img-key', imgKey);

                var parent = img.parentElement;
                if (!parent || parent.classList.contains('logo')) return;

                parent.classList.add('admin-img-wrapper');

                if (!parent.querySelector('.btn-admin-change-img')) {
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn-admin-change-img';
                    btn.innerHTML = '<i class="fa-solid fa-camera"></i> Ganti Foto';
                    btn.onclick = function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        if (!isEditMode) {
                            showToast('Aktifkan switch "Mode Edit Visual" di menu editor untuk mengganti foto.');
                            toggleEditorPopup(true);
                            return;
                        }
                        triggerImageChooser(img);
                    };
                    parent.appendChild(btn);
                }
            });

            var fileInput = document.getElementById('adminInstantImgInput');
            fileInput.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (!file || !activeImageTarget) return;

                var reader = new FileReader();
                reader.onload = function (evt) {
                    var b64 = evt.target.result;
                    var oldSrc = activeImageTarget.src;
                    var key = activeImageTarget.getAttribute('data-admin-img-key');

                    activeImageTarget.src = b64;

                    pushHistoryAction({
                        type: 'image',
                        key: key,
                        oldVal: oldSrc,
                        newVal: b64
                    });

                    saveToPageStorage(key, b64);
                    showToast('Foto berhasil diganti!');
                };
                reader.readAsDataURL(file);
            });
        }

        function triggerImageChooser(imgEl) {
            activeImageTarget = imgEl;
            var fileInput = document.getElementById('adminInstantImgInput');
            fileInput.value = '';
            fileInput.click();
        }

        // ============================================================
        // 3. FITUR UNDO & REDO SESI
        // ============================================================
        function pushHistoryAction(action) {
            undoHistory.push(action);
            redoHistory = [];
            updateHistoryUI(true);
        }

        window.performUndo = function () {
            if (undoHistory.length === 0) return;

            var action = undoHistory.pop();
            redoHistory.push(action);

            applyHistoryActionValue(action, action.oldVal);
            saveToPageStorage(action.key, action.oldVal);
            updateHistoryUI(true);
            showToast('Undo: Perubahan terakhir dibatalkan.');
        };

        window.performRedo = function () {
            if (redoHistory.length === 0) return;

            var action = redoHistory.pop();
            undoHistory.push(action);

            applyHistoryActionValue(action, action.newVal);
            saveToPageStorage(action.key, action.newVal);
            updateHistoryUI(true);
            showToast('Redo: Perubahan diterapkan kembali.');
        };

        function applyHistoryActionValue(action, val) {
            if (action.type === 'text') {
                var el = document.querySelector('[data-admin-text-key="' + action.key + '"]');
                if (el) el.innerHTML = val;
            } else if (action.type === 'image') {
                var img = document.querySelector('[data-admin-img-key="' + action.key + '"]');
                if (img) img.src = val;
            }
        }

        function updateHistoryUI(popAnim) {
            var btnUndo = document.getElementById('btnAdminUndo');
            var btnRedo = document.getElementById('btnAdminRedo');
            var badge = document.getElementById('historyCounterBadge');

            if (btnUndo) btnUndo.disabled = (undoHistory.length === 0);
            if (btnRedo) btnRedo.disabled = (redoHistory.length === 0);

            if (badge) {
                badge.textContent = undoHistory.length + ' Perubahan';
                if (popAnim) {
                    badge.classList.add('pop');
                    setTimeout(function () { badge.classList.remove('pop'); }, 250);
                }
            }
        }

        // Keyboard Shortcuts (Ctrl+Z & Ctrl+Y)
        window.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && !e.altKey) {
                if (e.key === 'z' && !e.shiftKey) {
                    if (undoHistory.length > 0) {
                        e.preventDefault();
                        performUndo();
                    }
                } else if (e.key === 'y' || (e.key === 'z' && e.shiftKey) || (e.key === 'Z' && e.shiftKey)) {
                    if (redoHistory.length > 0) {
                        e.preventDefault();
                        performRedo();
                    }
                }
            }
        });

        // ============================================================
        // 4. PERSISTENSI SESI
        // ============================================================
        function getPageStorage() {
            try {
                return JSON.parse(sessionStorage.getItem(PAGE_STORAGE_KEY)) || {};
            } catch (e) {
                return {};
            }
        }

        function saveToPageStorage(key, val) {
            var data = getPageStorage();
            data[key] = val;
            sessionStorage.setItem(PAGE_STORAGE_KEY, JSON.stringify(data));
        }

        function restoreSavedContent() {
            var data = getPageStorage();
            var elements = getEditableElements();

            elements.forEach(function (el, idx) {
                var textKey = 'txt_' + idx + '_' + el.tagName.toLowerCase();
                el.setAttribute('data-admin-text-key', textKey);
                if (data[textKey] !== undefined) {
                    el.innerHTML = data[textKey];
                }
            });

            var imgs = document.querySelectorAll('[data-admin-img-key]');
            imgs.forEach(function (img) {
                var key = img.getAttribute('data-admin-img-key');
                if (data[key]) {
                    img.src = data[key];
                }
            });
        }

        window.saveAllCurrentChanges = function () {
            showToast('Semua perubahan sesi ini telah tersimpan di browser!');
        };

        function showToast(msg) {
            var toast = document.getElementById('adminEditorToast');
            var msgEl = document.getElementById('adminEditorToastMsg');
            if (!toast || !msgEl) return;

            msgEl.textContent = msg;
            toast.classList.add('show');
            clearTimeout(toast._timeout);
            toast._timeout = setTimeout(function () {
                toast.classList.remove('show');
            }, 3200);
        }

        // Inisialisasi saat DOM siap
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEditor);
        } else {
            initEditor();
        }
    })();
</script>

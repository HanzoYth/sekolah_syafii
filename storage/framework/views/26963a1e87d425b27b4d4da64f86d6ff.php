
<link rel="stylesheet" href="<?php echo e(asset('css/admin-home-editor.css')); ?>?v=<?php echo e(time()); ?>">

<!-- FLOATING CHATBOT-STYLE WIDGET -->
<div id="adminFloatingWidget" aria-label="Editor Tampilan Website">
    <div id="adminEditorPopupCard" class="admin-editor-card" role="dialog" aria-hidden="true">
        <div class="admin-card-header" id="adminCardDragHandle" title="Tahan &amp; geser untuk memindahkan posisi menu ini">
            <div class="drag-grip-indicator"></div>
            <div class="admin-card-title">
                <i class="fa-solid fa-wand-magic-sparkles wand-icon"></i>
                <div>
                    <h4>Editor Cerdas <small style="font-size: 0.64rem; background: rgba(234, 179, 8, 0.25); padding: 1px 6px; border-radius: 999px; color: #fde047; font-weight: 600;">Pro</small></h4>
                    <span>Admin: <?php echo e(session('nama') ?? 'Administrator'); ?></span>
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
            <!-- STATUS SINKRONISASI -->
            <div class="admin-sync-badge" id="adminSyncBadge">
                <i class="fa-solid fa-database"></i>
                <span id="adminSyncBadgeText">Memuat status konten...</span>
            </div>

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
                <span>Saat aktif: <strong>klik teks</strong> untuk edit, <strong>hover foto</strong> untuk ganti, atau gunakan tombol <strong>+ Tambah</strong> di tiap bagian.</span>
            </div>

            <!-- PANEL TAMBAH CARD PADA MENU YANG ADA -->
            <div class="admin-add-section-box" id="adminAddCardBox">
                <div class="admin-add-header">
                    <span><i class="fa-solid fa-square-plus"></i> Tambah Card Konten</span>
                    <small style="color: #047857; font-weight: 600;">Menu Aktif</small>
                </div>

                <div class="admin-quick-grid" id="adminQuickGrid">
                    <button type="button" class="admin-quick-btn" id="btnQuickAddGallery" onclick="openQuickAddByType('gallery')">
                        <i class="fa-solid fa-images"></i> + Kegiatan / Galeri
                    </button>
                    <button type="button" class="admin-quick-btn" id="btnQuickAddProgram" onclick="openQuickAddByType('program')">
                        <i class="fa-solid fa-book-open-reader"></i> + Program
                    </button>
                    <button type="button" class="admin-quick-btn" id="btnQuickAddFacility" onclick="openQuickAddByType('card_icon')">
                        <i class="fa-solid fa-building-columns"></i> + Fasilitas / Agenda
                    </button>
                    <button type="button" class="admin-quick-btn" id="btnQuickAddAchievement" onclick="openQuickAddByType('prestasi')">
                        <i class="fa-solid fa-trophy"></i> + Pilar / Prestasi
                    </button>
                </div>

                <div class="admin-target-row" title="Pilih menu/bagian yang ada di halaman ini untuk menambah card baru">
                    <select class="admin-target-select" id="adminQuickContainerSelect" aria-label="Pilih bagian target"></select>
                    <button type="button" class="admin-target-go-btn" id="btnQuickAddToSelectedContainer" onclick="openSelectedContainerAddModal()">
                        + Card
                    </button>
                </div>
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
                <div class="admin-actions-split">
                    <button type="button" class="btn-save-session" id="btnSavePublishEditor" onclick="saveAndPublishChanges()">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Simpan &amp; Publikasikan
                    </button>
                    <button type="button" class="btn-admin-reset" id="btnResetEditorDefault" onclick="confirmResetToDefault()" title="Kembalikan halaman ke tampilan bawaan">
                        <i class="fa-solid fa-arrow-rotate-left"></i> Reset
                    </button>
                </div>
                <a href="/sk/das" class="btn-dashboard-link">
                    <i class="fa-solid fa-gauge-high"></i> Buka Dashboard SIAKAD
                </a>
            </div>
        </div>
    </div>

    <button type="button" id="adminLauncherBtn" class="admin-launcher-btn" onclick="toggleEditorPopup()" title="Buka Editor Tampilan Website">
        <i class="fa-solid fa-wand-magic-sparkles" id="launcherIcon"></i>
        <span class="launcher-pulse"></span>
    </button>
</div>

<!-- HIDDEN FILE INPUT UNTUK GANTI FOTO INSTAN -->
<input type="file" id="adminInstantImgInput" accept="image/*" style="display: none;">

<!-- MODAL 1: TAMBAH CARD KONTEN -->
<div class="admin-modal-backdrop" id="adminAddModalBackdrop" role="dialog" aria-modal="true" hidden>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fa-solid fa-square-plus"></i> <span id="adminAddModalTitle">Tambah Card Konten</span></h3>
            <button type="button" class="admin-modal-close" onclick="closeAddModal()" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="admin-modal-body" id="adminAddModalBody"></div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-modal-btn-cancel" onclick="closeAddModal()">Batal</button>
            <button type="button" class="admin-modal-btn-save" id="adminAddModalSubmitBtn">
                <i class="fa-solid fa-check"></i> Tambahkan ke Halaman
            </button>
        </div>
    </div>
</div>

<!-- MODAL 2: PILIH IKON -->
<div class="admin-modal-backdrop" id="adminIconPickerModalBackdrop" role="dialog" aria-modal="true" hidden>
    <div class="admin-modal-box">
        <div class="admin-modal-header">
            <h3><i class="fa-solid fa-icons"></i> Pilih Ikon</h3>
            <button type="button" class="admin-modal-close" onclick="closeIconPicker()" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <input type="text" id="adminIconSearchInput" class="admin-form-control" placeholder="Cari kata kunci ikon (mis: quran, masjid, piala, buku, waktu)...">
            </div>
            <div class="admin-icon-grid" id="adminIconGrid"></div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-modal-btn-cancel" onclick="closeIconPicker()">Tutup</button>
        </div>
    </div>
</div>

<!-- MODAL 3: KONFIRMASI HAPUS / RESET -->
<div class="admin-modal-backdrop" id="adminConfirmModalBackdrop" role="dialog" aria-modal="true" hidden>
    <div class="admin-modal-box admin-modal-box--sm">
        <div class="admin-modal-header">
            <h3><i class="fa-solid fa-triangle-exclamation"></i> <span id="adminConfirmTitle">Konfirmasi</span></h3>
            <button type="button" class="admin-modal-close" onclick="closeConfirmModal()" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="admin-modal-body">
            <p id="adminConfirmMessage" style="margin: 0; font-size: 0.88rem; color: #334155; line-height: 1.6;"></p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-modal-btn-cancel" onclick="closeConfirmModal()">Batal</button>
            <button type="button" class="admin-modal-btn-save danger" id="adminConfirmActionBtn">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

<!-- TOAST NOTIFICATION -->
<div id="adminEditorToast" role="status" aria-live="polite">
    <i class="fa-solid fa-circle-check"></i>
    <span id="adminEditorToastMsg">Perubahan berhasil!</span>
</div>

<!-- SCRIPT ENGINE EDITOR CERDAS -->
<script>
    (function () {
        'use strict';

        var CSRF_TOKEN = <?php echo json_encode(csrf_token(), 15, 512) ?>;
        var StateEngine = null;
        var isBooted = false;

        var isEditMode = false;
        var isPopupOpen = false;
        var activeImageTarget = null;
        var undoHistory = [];
        var redoHistory = [];
        var MAX_HISTORY = 40;

        var state = null;
        var syncMode = 'default';

        function getEngine() {
            if (!StateEngine && window.SyafiiPageState) {
                StateEngine = window.SyafiiPageState;
            }
            return StateEngine;
        }

        function ensureBooted() {
            if (!isBooted) {
                initEditor();
            }
            return Boolean(isBooted && getEngine());
        }

        var CURATED_ICONS = [
            { cls: 'fa-solid fa-book-quran', tags: 'quran tahfizh kitab hafalan islam' },
            { cls: 'fa-solid fa-mosque', tags: 'masjid mushalla ibadah islam' },
            { cls: 'fa-solid fa-book-open-reader', tags: 'baca talaqqi belajar kitab program' },
            { cls: 'fa-solid fa-graduation-cap', tags: 'lulus wisuda pendidikan sekolah sarjana' },
            { cls: 'fa-solid fa-chalkboard-user', tags: 'guru kelas mengajar kbm pelajaran' },
            { cls: 'fa-solid fa-hands-praying', tags: 'doa dzikir adab ibadah akhlak' },
            { cls: 'fa-solid fa-trophy', tags: 'piala juara prestasi lomba menang' },
            { cls: 'fa-solid fa-medal', tags: 'medali penghargaan prestasi juara' },
            { cls: 'fa-solid fa-award', tags: 'penghargaan sertifikat musabaqah' },
            { cls: 'fa-solid fa-star', tags: 'bintang unggulan favorit utama' },
            { cls: 'fa-solid fa-heart', tags: 'hati ukhuwah sayang kasih' },
            { cls: 'fa-solid fa-shield-heart', tags: 'aman kondusif lingkungan perlindungan' },
            { cls: 'fa-solid fa-users', tags: 'santri siswa guru jamaah komunitas' },
            { cls: 'fa-solid fa-user-check', tags: 'siswa santri daftar validasi' },
            { cls: 'fa-solid fa-calendar-days', tags: 'kalender agenda jadwal acara' },
            { cls: 'fa-solid fa-clock', tags: 'waktu jam jadwal harian' },
            { cls: 'fa-regular fa-sun', tags: 'pagi dhuha cerah harian' },
            { cls: 'fa-solid fa-camera', tags: 'foto kamera dokumentasi galeri' },
            { cls: 'fa-solid fa-images', tags: 'galeri album foto kegiatan' },
            { cls: 'fa-solid fa-school', tags: 'sekolah gedung kampus bangunan' },
            { cls: 'fa-solid fa-building-columns', tags: 'fasilitas gedung sarana prasarana' },
            { cls: 'fa-solid fa-book', tags: 'buku perpustakaan literasi modul' },
            { cls: 'fa-solid fa-book-open', tags: 'kurikulum pelajaran kitab bacaan' },
            { cls: 'fa-solid fa-language', tags: 'bahasa arab inggris muhadatsah' },
            { cls: 'fa-solid fa-microphone-lines', tags: 'tasmi pidato khitobah ceramah' },
            { cls: 'fa-solid fa-campground', tags: 'rihlah kemah outdoor alam pramuka' },
            { cls: 'fa-solid fa-certificate', tags: 'bersanad sertifikat ijazah kompetensi' },
            { cls: 'fa-solid fa-check', tags: 'centang poin checklist ya' },
            { cls: 'fa-solid fa-circle-check', tags: 'centang syarat ketentuan beres' },
            { cls: 'fa-solid fa-scale-balanced', tags: 'fiqih hukum syari adil diniah' },
            { cls: 'fa-solid fa-lightbulb', tags: 'ide inovasi cerdas kreatif' },
            { cls: 'fa-solid fa-compass', tags: 'arah visi misi tujuan' },
            { cls: 'fa-solid fa-laptop-code', tags: 'komputer teknologi sains lab it' },
            { cls: 'fa-solid fa-seedling', tags: 'tumbuh karakter bina dini' },
            { cls: 'fa-solid fa-hand-holding-heart', tags: 'peduli sosial infaq akhlak' },
            { cls: 'fa-solid fa-location-dot', tags: 'lokasi alamat peta rute' },
            { cls: 'fa-solid fa-phone', tags: 'telepon kontak hubung call' },
            { cls: 'fa-solid fa-envelope', tags: 'email pesan surat kontak' },
            { cls: 'fa-brands fa-whatsapp', tags: 'whatsapp wa chat panitia' },
            { cls: 'fa-solid fa-bullhorn', tags: 'pengumuman info ppdb siar' },
            { cls: 'fa-solid fa-layer-group', tags: 'jenjang paket program susun' },
            { cls: 'fa-solid fa-wand-magic-sparkles', tags: 'spesial unggulan baru kustom' }
        ];

        function computeInitialSyncStatus() {
            var draft = StateEngine.readLocalDraft();
            if (draft) {
                var pubStr = JSON.stringify(StateEngine.publishedData || StateEngine.normalizeState({}));
                if (JSON.stringify(draft) !== pubStr) {
                    return 'dirty';
                }
            }
            if (StateEngine.publishedData) {
                return 'saved';
            }
            return 'default';
        }

        function cloneState(st) {
            return StateEngine.normalizeState(JSON.parse(JSON.stringify(st || {})));
        }

        function updateSyncBadge(mode, customText) {
            syncMode = mode || syncMode;
            var badge = document.getElementById('adminSyncBadge');
            var text = document.getElementById('adminSyncBadgeText');
            if (!badge || !text) return;

            badge.classList.remove('is-dirty', 'is-saved');
            if (mode === 'dirty') {
                badge.classList.add('is-dirty');
                text.textContent = customText || 'Draf lokal (klik Simpan & Publikasikan)';
            } else if (mode === 'saved') {
                badge.classList.add('is-saved');
                text.textContent = customText || 'Tersinkronisasi dengan Database';
            } else if (mode === 'local-only') {
                badge.classList.add('is-dirty');
                text.textContent = customText || 'Draf tersimpan di browser';
            } else {
                text.textContent = customText || 'Tampilan bawaan website';
            }
        }

        function initEditor() {
            if (isBooted) return;
            var eng = getEngine();
            if (!eng) return;

            isBooted = true;
            state = eng.getInitialState();
            syncMode = computeInitialSyncStatus();

            setupFileInputHandler();
            refreshEditorControls();
            populateContainerDropdown();
            setupGlobalTextInterceptor();
            initDraggablePopup();
            restorePopupPosition();
            updateHistoryUI();
            updateSyncBadge(syncMode);

            window.addEventListener('resize', clampPopupCardToViewport);

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    closeAddModal();
                    closeIconPicker();
                    closeConfirmModal();
                }
            });
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
                var pad = 10;
                var maxLeft = Math.max(pad, window.innerWidth - card.offsetWidth - pad);
                var maxTop = Math.max(pad, window.innerHeight - card.offsetHeight - pad);
                var newLeft = Math.max(pad, Math.min(initLeft + (e.clientX - startX), maxLeft));
                var newTop = Math.max(pad, Math.min(initTop + (e.clientY - startY), maxTop));
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
                sessionStorage.setItem('syafii_popup_pos', JSON.stringify({ left: card.style.left, top: card.style.top }));
            }

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
                var pad = 8;
                var maxLeft = Math.max(pad, window.innerWidth - card.offsetWidth - pad);
                var maxTop = Math.max(pad, window.innerHeight - card.offsetHeight - pad);
                var newLeft = Math.max(pad, Math.min(initLeft + (touch.clientX - startX), maxLeft));
                var newTop = Math.max(pad, Math.min(initTop + (touch.clientY - startY), maxTop));
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
                sessionStorage.setItem('syafii_popup_pos', JSON.stringify({ left: card.style.left, top: card.style.top }));
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

        function clampPopupCardToViewport() {
            var card = document.getElementById('adminEditorPopupCard');
            if (!card || !card.classList.contains('active')) return;
            if (!card.style.left || card.style.left === 'auto') return;

            var pad = 10;
            var leftVal = parseFloat(card.style.left) || pad;
            var topVal = parseFloat(card.style.top) || pad;
            var maxLeft = Math.max(pad, window.innerWidth - card.offsetWidth - pad);
            var maxTop = Math.max(pad, window.innerHeight - card.offsetHeight - pad);

            card.style.left = Math.max(pad, Math.min(leftVal, maxLeft)) + 'px';
            card.style.top = Math.max(pad, Math.min(topVal, maxTop)) + 'px';
        }

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

        window.toggleEditorPopup = function (forceState) {
            ensureBooted();
            var card = document.getElementById('adminEditorPopupCard');
            var icon = document.getElementById('launcherIcon');
            if (!card || !icon) return;
            isPopupOpen = (forceState !== undefined) ? forceState : !isPopupOpen;
            if (isPopupOpen) {
                card.classList.add('active');
                card.setAttribute('aria-hidden', 'false');
                icon.className = 'fa-solid fa-xmark';
                clampPopupCardToViewport();
            } else {
                card.classList.remove('active');
                card.setAttribute('aria-hidden', 'true');
                icon.className = 'fa-solid fa-wand-magic-sparkles';
            }
        };

        window.toggleEditMode = function (enabled) {
            ensureBooted();
            isEditMode = enabled;
            var statusText = document.getElementById('modeStatusText');
            var switchRow = document.getElementById('adminSwitchRow');
            var dot = document.getElementById('liveStatusDot');

            if (enabled) {
                document.body.classList.add('editor-mode-active');
                if (statusText) statusText.textContent = 'Aktif (Siap Edit & Tambah)';
                if (switchRow) switchRow.classList.add('is-active');
                if (dot) dot.classList.add('active');
                refreshEditorControls();
                showToast('Mode Edit Aktif! Klik teks, ganti foto, atau gunakan tombol + Tambah.');
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
        // SNAPSHOT STATE + UNDO / REDO ENGINE
        // ============================================================
        function commitMutation(mutatorFn, toastMsg, options) {
            options = options || {};
            var before = cloneState(state);
            mutatorFn(state);
            var after = cloneState(state);

            if (JSON.stringify(before) === JSON.stringify(after)) {
                return false;
            }

            undoHistory.push({ before: before, after: after });
            if (undoHistory.length > MAX_HISTORY) {
                undoHistory.shift();
            }
            redoHistory = [];

            StateEngine.writeLocalDraft(state);

            if (!options.skipDomRebuild) {
                applyStateAndRefresh(state);
            }
            updateHistoryUI(true);
            updateSyncBadge('dirty');

            if (toastMsg) {
                showToast(toastMsg);
            }
            return true;
        }

        function applyStateAndRefresh(targetState) {
            state = cloneState(targetState);
            StateEngine.applyFullState(state);
            StateEngine.writeLocalDraft(state);
            refreshEditorControls();
            populateContainerDropdown();
        }

        window.performUndo = function () {
            if (!ensureBooted() || undoHistory.length === 0) return;
            var entry = undoHistory.pop();
            redoHistory.push(entry);
            applyStateAndRefresh(entry.before);
            updateHistoryUI(true);
            updateSyncBadge('dirty');
            showToast('Undo: Perubahan terakhir dibatalkan.');
        };

        window.performRedo = function () {
            if (!ensureBooted() || redoHistory.length === 0) return;
            var entry = redoHistory.pop();
            undoHistory.push(entry);
            applyStateAndRefresh(entry.after);
            updateHistoryUI(true);
            updateSyncBadge('dirty');
            showToast('Redo: Perubahan diterapkan kembali.');
        };

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

        window.addEventListener('keydown', function (e) {
            if ((e.ctrlKey || e.metaKey) && !e.altKey) {
                var activeEl = document.activeElement;
                if (activeEl && activeEl.closest && activeEl.closest('#adminAddModalBackdrop')) return;
                if (e.key === 'z' && !e.shiftKey && undoHistory.length > 0) {
                    e.preventDefault();
                    performUndo();
                } else if ((e.key === 'y' || ((e.key === 'z' || e.key === 'Z') && e.shiftKey)) && redoHistory.length > 0) {
                    e.preventDefault();
                    performRedo();
                }
            }
        });

        // ============================================================
        // TEKS INLINE EDITING (AMAN DARI OVERLAY/AKSI TOOLBAR)
        // ============================================================
        function extractCleanInnerHtml(el) {
            var clone = el.cloneNode(true);
            clone.querySelectorAll('.admin-item-actions, .btn-admin-change-img').forEach(function (tool) {
                tool.remove();
            });
            return StateEngine.sanitizeHtml(clone.innerHTML);
        }

        function syncLightboxCaptionForNode(el) {
            var item = el ? el.closest('.galeri-item') : null;
            if (!item) return;
            var btn = item.querySelector('[data-lightbox]');
            if (!btn) return;
            var h = item.querySelector('figcaption h3');
            var p = item.querySelector('figcaption p');
            var t = h ? h.textContent.trim() : '';
            var d = p ? p.textContent.trim() : '';
            btn.setAttribute('data-caption', t + (d ? ' — ' + d : ''));
        }

        function scanAndMakeAllTextsEditable(enable) {
            document.querySelectorAll('[data-editor-key]').forEach(function (el) {
                if (StateEngine.isProtectedElement(el)) return;
                var key = el.getAttribute('data-editor-key');

                if (enable) {
                    el.contentEditable = 'true';
                    el.setAttribute('data-editor-text', 'true');
                    el.title = 'Klik untuk mengedit teks ini secara langsung';

                    el.onfocus = function () {
                        el._beforeText = extractCleanInnerHtml(el);
                    };

                    el.onblur = function () {
                        var oldText = el._beforeText;
                        var newText = extractCleanInnerHtml(el);
                        if (oldText !== undefined && oldText !== newText) {
                            syncLightboxCaptionForNode(el);
                            commitMutation(function (st) {
                                st.texts[key] = newText;
                            }, 'Teks berhasil diperbarui!', { skipDomRebuild: true });
                        }
                    };
                } else {
                    el.contentEditable = 'false';
                    el.removeAttribute('data-editor-text');
                    el.removeAttribute('title');
                    el.onfocus = null;
                    el.onblur = null;
                }
            });
        }

        function setupGlobalTextInterceptor() {
            document.addEventListener('click', function (e) {
                if (!isEditMode) return;
                var target = e.target;
                if (!target || StateEngine.isProtectedElement(target)) return;

                var editableEl = target.closest('[data-editor-key]');
                if (!editableEl || StateEngine.isProtectedElement(editableEl)) return;

                if (editableEl.tagName === 'SUMMARY') {
                    e.preventDefault();
                    var details = editableEl.closest('details');
                    if (details) details.open = true;
                }

                if (editableEl.contentEditable !== 'true') {
                    editableEl.contentEditable = 'true';
                    editableEl.setAttribute('data-editor-text', 'true');
                }
            }, true);
        }

        // ============================================================
        // GAMBAR: HOVER GANTI FOTO + KOMPRESI OTOMATIS CANVAS
        // ============================================================
        function compressImageFile(file, callback) {
            var reader = new FileReader();
            reader.onload = function (evt) {
                var rawDataUrl = evt.target.result;
                var img = new Image();
                img.onload = function () {
                    var maxW = 1000;
                    var w = img.naturalWidth || img.width;
                    var h = img.naturalHeight || img.height;
                    if (!w || !h) {
                        callback(rawDataUrl);
                        return;
                    }
                    if (w > maxW) {
                        h = Math.round((h * maxW) / w);
                        w = maxW;
                    }
                    var canvas = document.createElement('canvas');
                    canvas.width = w;
                    canvas.height = h;
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, w, h);
                    var mime = (file.type === 'image/png' || file.type === 'image/webp') ? file.type : 'image/jpeg';
                    var quality = (mime === 'image/png') ? undefined : 0.82;
                    try {
                        var compressed = canvas.toDataURL(mime, quality);
                        callback(compressed);
                    } catch (err) {
                        callback(rawDataUrl);
                    }
                };
                img.onerror = function () { callback(rawDataUrl); };
                img.src = rawDataUrl;
            };
            reader.readAsDataURL(file);
        }

        function setupImageOverlays() {
            document.querySelectorAll('img[data-editor-img-key]').forEach(function (img) {
                var parent = img.parentElement;
                if (!parent || parent.classList.contains('logo')) return;
                parent.classList.add('admin-img-wrapper');

                if (!parent.querySelector('.btn-admin-change-img')) {
                    var btn = document.createElement('span');
                    btn.setAttribute('role', 'button');
                    btn.setAttribute('tabindex', '0');
                    btn.setAttribute('contenteditable', 'false');
                    btn.className = 'btn-admin-change-img';
                    btn.innerHTML = '<i class="fa-solid fa-camera"></i> Ganti Foto';
                    btn.onclick = function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        if (!isEditMode) {
                            showToast('Aktifkan switch "Mode Edit Visual" terlebih dahulu.');
                            toggleEditorPopup(true);
                            return;
                        }
                        triggerImageChooser(img);
                    };
                    btn.onkeydown = function (e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            btn.click();
                        }
                    };
                    parent.appendChild(btn);
                }
            });
        }

        function setupFileInputHandler() {
            var fileInput = document.getElementById('adminInstantImgInput');
            if (!fileInput) return;
            fileInput.addEventListener('change', function (e) {
                var file = e.target.files[0];
                if (!file || !activeImageTarget) return;

                compressImageFile(file, function (b64) {
                    var key = activeImageTarget.getAttribute('data-editor-img-key');
                    if (!key) return;
                    commitMutation(function (st) {
                        st.images[key] = b64;
                    }, 'Foto berhasil diganti & dikompres!');
                });
            });
        }

        function triggerImageChooser(imgEl) {
            activeImageTarget = imgEl;
            var fileInput = document.getElementById('adminInstantImgInput');
            if (!fileInput) return;
            fileInput.value = '';
            fileInput.click();
        }

        // ============================================================
        // KONTROL INLINE: BILAH "+ TAMBAH" & TOMBOL AKSI PER ITEM/BAGIAN
        // ============================================================
        function injectContainerBars() {
            document.querySelectorAll('.admin-container-bar').forEach(function (el) { el.remove(); });

            document.querySelectorAll('[data-editor-container-key]').forEach(function (ctr) {
                var key = ctr.getAttribute('data-editor-container-key');
                var type = ctr.getAttribute('data-editor-container-type') || 'card_icon';
                var label = ctr.getAttribute('data-editor-container-label') || 'Bagian Konten';
                var itemLabel = ctr.getAttribute('data-editor-item-label') || 'Item';
                var isCompact = Boolean(ctr.closest('.value-card, .vm-card, .syarat-card, .kontak-info, .jenjang-card, .program-card'));
                var displayLabel = isCompact
                    ? (label.replace(/\s*\([^)]*\)\s*$/, '').trim() || itemLabel)
                    : label;
                var buttonLabel = isCompact ? 'Tambah' : ('Tambah ' + itemLabel);

                var bar = document.createElement('div');
                bar.className = 'admin-container-bar' + (isCompact ? ' admin-container-bar--compact' : '');
                bar.innerHTML =
                    '<span class="admin-container-bar-label" title="' + escapeHtml(label) + '"><i class="fa-solid fa-layer-group"></i> ' + escapeHtml(displayLabel) + '</span>' +
                    '<button type="button" class="btn-admin-add-item"><i class="fa-solid fa-plus"></i> ' + escapeHtml(buttonLabel) + '</button>';

                bar.querySelector('.btn-admin-add-item').addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    openAddItemModal(key, type, label, itemLabel);
                });

                if (ctr.parentNode) {
                    ctr.parentNode.insertBefore(bar, ctr);
                }
            });
        }

        function findDirectField(itemEl, selector) {
            if (!itemEl) return null;
            var list = itemEl.querySelectorAll(selector);
            for (var i = 0; i < list.length; i++) {
                if (list[i].closest('[data-editor-item-id]') === itemEl) {
                    return list[i];
                }
            }
            return null;
        }

        function extractCleanText(el, stripIcons) {
            if (!el) return '';
            var clone = el.cloneNode(true);
            clone.querySelectorAll('.admin-item-actions, .btn-admin-change-img').forEach(function (tool) {
                tool.remove();
            });
            if (stripIcons) {
                clone.querySelectorAll('i').forEach(function (ic) { ic.remove(); });
            }
            return (clone.textContent || clone.innerText || '').replace(/\s+/g, ' ').trim();
        }

        function injectItemActionToolbars() {
            document.querySelectorAll('.admin-item-actions').forEach(function (el) { el.remove(); });

            document.querySelectorAll('[data-editor-item-id]').forEach(function (itemEl) {
                if (itemEl.classList.contains('editor-removed-item')) return;
                var itemId = itemEl.getAttribute('data-editor-item-id');
                var ctr = itemEl.closest('[data-editor-container-key]');
                if (!itemId || !ctr) return;
                var ctrKey = ctr.getAttribute('data-editor-container-key');
                var ctrType = ctr.getAttribute('data-editor-container-type') || 'card_icon';
                var ctrLabel = ctr.getAttribute('data-editor-container-label') || 'Bagian Konten';
                var itemLabel = ctr.getAttribute('data-editor-item-label') || 'Card';

                var isAddedItem = itemEl.getAttribute('data-editor-added-item') === '1';

                var toolbar = document.createElement('div');
                toolbar.className = 'admin-item-actions';
                toolbar.setAttribute('contenteditable', 'false');

                var btnEdit = document.createElement('button');
                btnEdit.type = 'button';
                btnEdit.className = 'admin-mini-btn admin-mini-btn--edit';
                btnEdit.title = 'Edit Card Ini';
                btnEdit.innerHTML = '<i class="fa-solid fa-pen-to-square"></i>';
                btnEdit.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    openEditItemModal(itemEl, itemId, ctrKey, ctrType, isAddedItem, ctrLabel, itemLabel);
                });
                toolbar.appendChild(btnEdit);

                var icoEl = findDirectField(itemEl, '[data-editor-ico-key]');
                if (icoEl) {
                    var btnIcon = document.createElement('button');
                    btnIcon.type = 'button';
                    btnIcon.className = 'admin-mini-btn';
                    btnIcon.title = 'Ganti Ikon';
                    btnIcon.innerHTML = '<i class="fa-solid fa-icons"></i>';
                    btnIcon.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        var icoKey = icoEl.getAttribute('data-editor-ico-key');
                        openIconPicker(function (pickedClass) {
                            commitMutation(function (st) {
                                st.icons[icoKey] = pickedClass;
                            }, 'Ikon berhasil diganti!');
                        }, icoEl.className);
                    });
                    toolbar.appendChild(btnIcon);
                }

                var btnDup = document.createElement('button');
                btnDup.type = 'button';
                btnDup.className = 'admin-mini-btn';
                btnDup.title = 'Duplikat Card Ini';
                btnDup.innerHTML = '<i class="fa-solid fa-copy"></i>';
                btnDup.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    duplicateItemFromDom(itemEl, ctrKey, ctrType);
                });
                toolbar.appendChild(btnDup);

                if (isAddedItem) {
                    var btnDel = document.createElement('button');
                    btnDel.type = 'button';
                    btnDel.className = 'admin-mini-btn danger';
                    btnDel.title = 'Hapus Card Tambahan Ini';
                    btnDel.innerHTML = '<i class="fa-solid fa-trash-can"></i>';
                    btnDel.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        requestDeleteItem(itemId, true);
                    });
                    toolbar.appendChild(btnDel);
                }

                itemEl.appendChild(toolbar);
            });
        }

        function refreshQuickAddButtons() {
            var map = [
                { id: 'btnQuickAddGallery', type: 'gallery' },
                { id: 'btnQuickAddProgram', type: 'program' },
                { id: 'btnQuickAddFacility', type: 'card_icon' },
                { id: 'btnQuickAddAchievement', type: 'prestasi' }
            ];
            map.forEach(function (entry) {
                var btn = document.getElementById(entry.id);
                if (!btn) return;
                var hasContainer = Boolean(document.querySelector('[data-editor-container-type="' + entry.type + '"]'));
                btn.style.display = hasContainer ? '' : 'none';
            });
            var quickGrid = document.getElementById('adminQuickGrid');
            if (quickGrid) {
                var anyVisible = map.some(function (entry) {
                    var b = document.getElementById(entry.id);
                    return b && b.style.display !== 'none';
                });
                quickGrid.style.display = anyVisible ? 'grid' : 'none';
            }
        }

        function refreshEditorControls() {
            setupImageOverlays();
            injectContainerBars();
            injectItemActionToolbars();
            refreshQuickAddButtons();
            scanAndMakeAllTextsEditable(isEditMode);
        }

        function populateContainerDropdown() {
            var select = document.getElementById('adminQuickContainerSelect');
            if (!select) return;
            var prev = select.value;
            select.innerHTML = '';

            var containers = document.querySelectorAll('[data-editor-container-key]');
            if (containers.length === 0) {
                var optEmpty = document.createElement('option');
                optEmpty.value = '';
                optEmpty.textContent = 'Tidak ada daftar card di halaman ini';
                select.appendChild(optEmpty);
                return;
            }

            containers.forEach(function (ctr) {
                var opt = document.createElement('option');
                opt.value = ctr.getAttribute('data-editor-container-key');
                opt.textContent = ctr.getAttribute('data-editor-container-label') || 'Bagian Halaman';
                select.appendChild(opt);
            });

            if (prev && select.querySelector('option[value="' + prev + '"]')) {
                select.value = prev;
            }
        }

        // ============================================================
        // AKSI CRUD ITEM & BAGIAN (ADD, DUPLICATE, MOVE, DELETE)
        // ============================================================
        function resolveCardElements(itemEl, ctrType) {
            var titleEl = null;
            if (ctrType === 'check' || ctrType === 'list_icon') {
                titleEl = itemEl;
            } else if (ctrType === 'list_syarat') {
                titleEl = findDirectField(itemEl, 'span[data-editor-key], span');
            } else {
                titleEl = findDirectField(itemEl, 'h3, h4, summary, strong');
            }

            var descEl = null;
            if (ctrType !== 'check' && ctrType !== 'list_icon' && ctrType !== 'list_syarat') {
                if (ctrType === 'contact_item') {
                    descEl = findDirectField(itemEl, 'div > span[data-editor-key], div > span');
                } else if (ctrType === 'stat') {
                    descEl = findDirectField(itemEl, 'span[data-editor-key]:not(.counter-num)');
                    if (!descEl) descEl = findDirectField(itemEl, 'span:not(.counter-num)');
                } else {
                    descEl = findDirectField(itemEl, 'p[data-editor-key], p');
                }
            }

            return {
                titleEl: titleEl,
                descEl: descEl,
                badgeEl: findDirectField(itemEl, '.badge'),
                tagEl: findDirectField(itemEl, '.program-tag'),
                timeEl: findDirectField(itemEl, '.timeline-time'),
                codeEl: findDirectField(itemEl, '.jenjang-badge, .value-num'),
                imgEl: findDirectField(itemEl, 'img[data-editor-img-key], img'),
                icoEl: findDirectField(itemEl, '[data-editor-ico-key], i.fa-solid, i.fa-regular, i.fa-brands')
            };
        }

        function duplicateItemFromDom(itemEl, ctrKey, ctrType) {
            var newId = 'itm_' + Date.now() + '_' + Math.random().toString(36).slice(2, 6);
            var els = resolveCardElements(itemEl, ctrType);

            var titleText = '';
            if (ctrType === 'check' || ctrType === 'list_icon') {
                titleText = extractCleanText(itemEl, true);
            } else if (els.titleEl) {
                titleText = extractCleanInnerHtml(els.titleEl);
            } else {
                titleText = 'Item Duplikat';
            }

            var newItem = {
                id: newId,
                containerKey: ctrKey,
                type: ctrType,
                category: itemEl.getAttribute('data-category') || 'tahfizh',
                badge: els.badgeEl ? StateEngine.sanitizePlain(extractCleanText(els.badgeEl, true), 80) : '',
                title: titleText,
                desc: els.descEl ? extractCleanInnerHtml(els.descEl) : '',
                tag: els.tagEl ? StateEngine.sanitizePlain(extractCleanText(els.tagEl, true), 80) : '',
                time: els.timeEl ? StateEngine.sanitizePlain(extractCleanText(els.timeEl, true), 80) : '',
                code: els.codeEl ? StateEngine.sanitizePlain(extractCleanText(els.codeEl, true), 20) : '',
                num: '',
                icon: StateEngine.sanitizeIcon(els.icoEl ? els.icoEl.className : 'fa-solid fa-star'),
                image: els.imgEl ? els.imgEl.src : ''
            };

            commitMutation(function (st) {
                st.added_items.push(newItem);
            }, 'Item berhasil diduplikasi!');
        }

        function requestDeleteItem(itemId, isAdded) {
            if (!isAdded) {
                showToast('Card bawaan halaman tidak dapat dihapus. Anda hanya dapat mengedit atau menduplikatnya.');
                return;
            }
            openConfirmModal(
                'Hapus Card Tambahan?',
                'Card tambahan ini akan dihapus dari tampilan halaman. Anda masih dapat membatalkannya dengan tombol Undo.',
                function () {
                    commitMutation(function (st) {
                        st.added_items = st.added_items.filter(function (it) { return it.id !== itemId; });
                        delete st.texts['dyn_' + itemId + '_title'];
                        delete st.texts['dyn_' + itemId + '_desc'];
                        delete st.texts['dyn_' + itemId + '_badge'];
                        delete st.texts['dyn_' + itemId + '_tag'];
                        delete st.texts['dyn_' + itemId + '_time'];
                        delete st.texts['dyn_' + itemId + '_code'];
                        delete st.images['dyn_' + itemId + '_img'];
                        delete st.icons['dyn_' + itemId + '_ico'];
                    }, 'Card tambahan berhasil dihapus dari halaman.');
                }
            );
        }

        // ============================================================
        // QUICK ADD LAUNCHERS DARI POPUP WIDGET (HANYA MENU YANG ADA)
        // ============================================================
        window.openQuickAddByType = function (type) {
            if (!ensureBooted()) return;
            var ctr = document.querySelector('[data-editor-container-type="' + type + '"]');
            if (ctr) {
                if (!isEditMode) toggleEditMode(true);
                ctr.scrollIntoView({ behavior: 'smooth', block: 'center' });
                openAddItemModal(
                    ctr.getAttribute('data-editor-container-key'),
                    type,
                    ctr.getAttribute('data-editor-container-label') || 'Tambah Card',
                    ctr.getAttribute('data-editor-item-label') || 'Card'
                );
                return;
            }
            showToast('Bagian tersebut tidak tersedia di halaman ini. Silakan tambah card melalui menu yang sesuai.');
        };

        window.openSelectedContainerAddModal = function () {
            if (!ensureBooted()) return;
            var select = document.getElementById('adminQuickContainerSelect');
            if (!select || !select.value) {
                showToast('Tidak ada daftar card yang tersedia untuk ditambahkan di halaman ini.');
                return;
            }
            var ctr = document.querySelector('[data-editor-container-key="' + select.value + '"]');
            if (!ctr) return;
            if (!isEditMode) toggleEditMode(true);
            ctr.scrollIntoView({ behavior: 'smooth', block: 'center' });
            openAddItemModal(
                ctr.getAttribute('data-editor-container-key'),
                ctr.getAttribute('data-editor-container-type') || 'card_icon',
                ctr.getAttribute('data-editor-container-label') || 'Bagian Konten',
                ctr.getAttribute('data-editor-item-label') || 'Card'
            );
        };

        // ============================================================
        // MODAL TAMBAH ITEM DINAMIS
        // ============================================================
        function escapeHtml(str) {
            return String(str || '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function buildIconFieldHtml(idPrefix, defaultIcon) {
            return '<div class="admin-form-group">' +
                '<label>Ikon Tampilan</label>' +
                '<div class="admin-icon-row">' +
                    '<div class="admin-icon-preview-box"><i id="' + idPrefix + 'IconPreview" class="' + escapeHtml(defaultIcon) + '"></i></div>' +
                    '<input type="hidden" id="' + idPrefix + 'IconValue" value="' + escapeHtml(defaultIcon) + '">' +
                    '<button type="button" class="admin-modal-btn-cancel" id="' + idPrefix + 'PickIconBtn" style="flex:1; text-align:left;"><i class="fa-solid fa-icons"></i> Pilih Ikon...</button>' +
                '</div>' +
            '</div>';
        }

        function openItemFormModal(mode, cfg) {
            var backdrop = document.getElementById('adminAddModalBackdrop');
            var titleEl = document.getElementById('adminAddModalTitle');
            var bodyEl = document.getElementById('adminAddModalBody');
            var submitBtn = document.getElementById('adminAddModalSubmitBtn');
            if (!backdrop || !bodyEl || !submitBtn) return;

            var isEdit = (mode === 'edit');
            var type = cfg.type || 'card_icon';
            var initial = cfg.initial || {};
            titleEl.textContent = (isEdit ? 'Edit ' : 'Tambah ') + (cfg.itemLabel || 'Card') + (cfg.containerLabel ? ' — ' + cfg.containerLabel : '');

            var defaultIcons = {
                gallery: 'fa-solid fa-book-quran',
                program: 'fa-solid fa-book-open-reader',
                card_icon: 'fa-solid fa-building-columns',
                prestasi: 'fa-solid fa-trophy',
                value: 'fa-solid fa-star',
                timeline: 'fa-regular fa-clock',
                stat: 'fa-solid fa-users',
                check: 'fa-solid fa-check',
                list_icon: 'fa-solid fa-check',
                list_syarat: 'fa-solid fa-circle-check',
                contact_item: 'fa-solid fa-phone'
            };
            var initIcon = StateEngine.sanitizeIcon(initial.icon || defaultIcons[type] || 'fa-solid fa-star');
            var html = '';

            if (type === 'gallery') {
                if (!isEdit || cfg.isAdded) {
                    var initCat = initial.category || 'tahfizh';
                    html += '<div class="admin-form-group"><label>Kategori Filter Galeri</label>' +
                        '<select id="addItemCategory" class="admin-form-control">' +
                            '<option value="tahfizh"' + (initCat === 'tahfizh' ? ' selected' : '') + '>Halaqah &amp; Tahfizh</option>' +
                            '<option value="kbm"' + (initCat === 'kbm' ? ' selected' : '') + '>Kegiatan Belajar (KBM)</option>' +
                            '<option value="karakter"' + (initCat === 'karakter' ? ' selected' : '') + '>Karakter &amp; Adab</option>' +
                            '<option value="ukhuwah"' + (initCat === 'ukhuwah' ? ' selected' : '') + '>Ukhuwah &amp; Event</option>' +
                        '</select></div>';
                }
                html += '<div class="admin-form-group"><label>Label Lencana Kegiatan</label>' +
                    '<input type="text" id="addItemBadge" class="admin-form-control" value="' + escapeHtml(initial.badge !== undefined ? initial.badge : 'Kegiatan Santri') + '" placeholder="Mis: Halaqah & Tahfizh"></div>';
            }

            if (type === 'jenjang') {
                html += '<div class="admin-form-group"><label>Kode Singkat Jenjang</label>' +
                    '<input type="text" id="addItemCode" class="admin-form-control" value="' + escapeHtml(initial.code !== undefined ? initial.code : 'PAUD') + '" placeholder="Mis: TK, SD, SMP, SMA"></div>';
            } else if (type === 'value') {
                html += '<div class="admin-form-group"><label>Nomor / Kode Urut</label>' +
                    '<input type="text" id="addItemCode" class="admin-form-control" value="' + escapeHtml(initial.code !== undefined ? initial.code : '04') + '" placeholder="Mis: 04, TK, SD"></div>';
            } else if (type === 'timeline') {
                html += '<div class="admin-form-group"><label>Rentang Waktu Kegiatan</label>' +
                    '<input type="text" id="addItemTime" class="admin-form-control" value="' + escapeHtml(initial.time !== undefined ? initial.time : '13.00 - 15.00 WITA') + '" placeholder="Mis: 07.30 - 09.00 WITA"></div>';
            } else if (type === 'prestasi') {
                html += '<div class="admin-form-group"><label>Label Pilar / Tahun Prestasi</label>' +
                    '<input type="text" id="addItemBadge" class="admin-form-control" value="' + escapeHtml(initial.badge !== undefined ? initial.badge : 'Capaian Terbaru') + '" placeholder="Mis: Juara 1 MHQ / Pilar 4"></div>';
            }

            if (type !== 'jenjang' && type !== 'step' && type !== 'faq' && (!isEdit || cfg.hasIcon)) {
                html += buildIconFieldHtml('addItem', initIcon);
            }

            var titleLabelText = 'Judul Item';
            var titlePlaceholder = 'Masukkan judul singkat & jelas...';
            if (type === 'faq') {
                titleLabelText = 'Pertanyaan';
                titlePlaceholder = 'Tuliskan pertanyaan yang sering ditanyakan...';
            } else if (type === 'stat') {
                titleLabelText = 'Angka / Nilai Statistik';
                titlePlaceholder = 'Mis: 250+ Santri / 15 Ruang';
            } else if (type === 'check' || type === 'list_icon' || type === 'list_syarat') {
                titleLabelText = 'Isi Poin';
                titlePlaceholder = 'Tuliskan poin keunggulan atau syarat...';
            }

            html += '<div class="admin-form-group"><label>' + titleLabelText + '</label>' +
                '<input type="text" id="addItemTitle" class="admin-form-control" value="' + escapeHtml(initial.title || '') + '" placeholder="' + titlePlaceholder + '"></div>';

            if (type !== 'check' && type !== 'list_icon' && type !== 'list_syarat') {
                var descLabel = (type === 'faq') ? 'Jawaban Lengkap' : (type === 'stat' ? 'Keterangan Bawah Angka' : 'Deskripsi Singkat');
                html += '<div class="admin-form-group"><label>' + descLabel + '</label>' +
                    '<textarea id="addItemDesc" class="admin-form-control" rows="3" placeholder="Tuliskan penjelasan singkat...">' + escapeHtml(initial.desc || '') + '</textarea></div>';
            }

            if (type === 'program') {
                html += '<div class="admin-form-group"><label>Tag Bawah Kartu</label>' +
                    '<input type="text" id="addItemTag" class="admin-form-control" value="' + escapeHtml(initial.tag !== undefined ? initial.tag : 'Program Pilihan') + '" placeholder="Mis: Target Hafalan Mutqin"></div>';
            }

            if (type === 'gallery') {
                var previewSrc = initial.image || '/img/ft_2.jpeg';
                html += '<div class="admin-form-group">' +
                    '<label>' + (isEdit ? 'Ganti Foto Kegiatan (Opsional, otomatis dikompres)' : 'Upload Foto Kegiatan (Otomatis dikompres)') + '</label>' +
                    '<input type="file" id="addItemImageFile" class="admin-form-control" accept="image/*">' +
                    '<label style="margin-top:6px; font-weight:600; font-size:0.74rem; color:#475569;">Atau pilih foto bawaan sekolah:</label>' +
                    '<select id="addItemPresetImage" class="admin-form-control">' +
                        (isEdit ? '<option value="">-- Pertahankan foto saat ini --</option>' : '') +
                        '<option value="/img/ft_2.jpeg">Foto Kegiatan 1 (ft_2.jpeg)</option>' +
                        '<option value="/img/ft_1.jpeg">Foto Pembelajaran Kelas (ft_1.jpeg)</option>' +
                        '<option value="/img/foto_1.jpeg">Dokumentasi Sekolah 1 (foto_1.jpeg)</option>' +
                        '<option value="/img/foto_2.jpeg">Dokumentasi Sekolah 2 (foto_2.jpeg)</option>' +
                        '<option value="/img/bg_skl.jpeg">Suasana Lingkungan Sekolah (bg_skl.jpeg)</option>' +
                    '</select>' +
                    '<img id="addItemImagePreview" class="admin-img-preview" src="' + escapeHtml(previewSrc) + '" alt="Pratinjau foto">' +
                '</div>';
            }

            bodyEl.innerHTML = html;

            var uploadedPhotoData = '';
            var photoTouched = false;
            var pickBtn = document.getElementById('addItemPickIconBtn');
            if (pickBtn) {
                pickBtn.addEventListener('click', function () {
                    var hidden = document.getElementById('addItemIconValue');
                    openIconPicker(function (picked) {
                        hidden.value = picked;
                        document.getElementById('addItemIconPreview').className = picked;
                    }, hidden.value);
                });
            }

            var fileInput = document.getElementById('addItemImageFile');
            var presetSelect = document.getElementById('addItemPresetImage');
            var imgPrev = document.getElementById('addItemImagePreview');
            if (fileInput) {
                fileInput.addEventListener('change', function (e) {
                    var f = e.target.files[0];
                    if (!f) return;
                    compressImageFile(f, function (b64) {
                        uploadedPhotoData = b64;
                        photoTouched = true;
                        if (imgPrev) imgPrev.src = b64;
                    });
                });
            }
            if (presetSelect) {
                presetSelect.addEventListener('change', function () {
                    uploadedPhotoData = '';
                    photoTouched = Boolean(presetSelect.value);
                    if (imgPrev) imgPrev.src = presetSelect.value || (initial.image || '/img/ft_2.jpeg');
                });
            }

            submitBtn.innerHTML = isEdit
                ? '<i class="fa-solid fa-check"></i> Simpan Perubahan Card'
                : '<i class="fa-solid fa-check"></i> Tambahkan ke Halaman';

            submitBtn.onclick = function () {
                var titleVal = (document.getElementById('addItemTitle') ? document.getElementById('addItemTitle').value : '').trim();
                if (!titleVal) {
                    showToast('Judul / isi utama tidak boleh kosong.');
                    return;
                }
                var descVal = (document.getElementById('addItemDesc') ? document.getElementById('addItemDesc').value : '').trim();
                var iconVal = document.getElementById('addItemIconValue') ? document.getElementById('addItemIconValue').value : initIcon;
                var badgeVal = document.getElementById('addItemBadge') ? document.getElementById('addItemBadge').value.trim() : '';
                var tagVal = document.getElementById('addItemTag') ? document.getElementById('addItemTag').value.trim() : '';
                var timeVal = document.getElementById('addItemTime') ? document.getElementById('addItemTime').value.trim() : '';
                var codeVal = document.getElementById('addItemCode') ? document.getElementById('addItemCode').value.trim() : '';
                var catVal = document.getElementById('addItemCategory') ? document.getElementById('addItemCategory').value : (initial.category || 'tahfizh');
                var finalImg = uploadedPhotoData || (presetSelect && presetSelect.value ? presetSelect.value : (initial.image || '/img/ft_2.jpeg'));

                closeAddModal();
                cfg.onSave({
                    title: StateEngine.sanitizeHtml(titleVal),
                    desc: StateEngine.sanitizeHtml(descVal),
                    icon: StateEngine.sanitizeIcon(iconVal),
                    badge: badgeVal,
                    tag: tagVal,
                    time: timeVal,
                    code: codeVal,
                    category: catVal,
                    image: finalImg,
                    photoTouched: photoTouched
                });
            };

            backdrop.hidden = false;
            var firstInput = document.getElementById('addItemTitle');
            if (firstInput) setTimeout(function () { firstInput.focus(); firstInput.select && firstInput.select(); }, 60);
        }

        function openAddItemModal(containerKey, type, containerLabel, itemLabel) {
            openItemFormModal('add', {
                containerKey: containerKey,
                type: type,
                containerLabel: containerLabel,
                itemLabel: itemLabel,
                isAdded: true,
                hasIcon: true,
                onSave: function (vals) {
                    var itemObj = {
                        id: 'itm_' + Date.now() + '_' + Math.random().toString(36).slice(2, 6),
                        containerKey: containerKey,
                        type: type,
                        category: vals.category,
                        badge: vals.badge,
                        title: vals.title,
                        desc: vals.desc,
                        tag: vals.tag,
                        time: vals.time,
                        code: vals.code,
                        num: '',
                        icon: vals.icon,
                        image: type === 'gallery' ? vals.image : ''
                    };
                    commitMutation(function (st) {
                        st.added_items.push(itemObj);
                    }, 'Berhasil menambahkan ' + (itemLabel || 'item baru') + ' ke halaman!');
                }
            });
        }

        function openEditItemModal(itemEl, itemId, ctrKey, ctrType, isAdded, containerLabel, itemLabel) {
            var els = resolveCardElements(itemEl, ctrType);
            var icoKeyEl = findDirectField(itemEl, '[data-editor-ico-key]');
            var initial = {
                title: els.titleEl ? extractCleanText(els.titleEl, ctrType === 'check' || ctrType === 'list_icon') : '',
                desc: els.descEl ? extractCleanText(els.descEl, false) : '',
                badge: els.badgeEl ? extractCleanText(els.badgeEl, true) : '',
                tag: els.tagEl ? extractCleanText(els.tagEl, true) : '',
                time: els.timeEl ? extractCleanText(els.timeEl, true) : '',
                code: els.codeEl ? extractCleanText(els.codeEl, true) : '',
                category: itemEl.getAttribute('data-category') || 'tahfizh',
                icon: icoKeyEl ? icoKeyEl.className : (els.icoEl ? els.icoEl.className : ''),
                image: els.imgEl ? (els.imgEl.getAttribute('src') || els.imgEl.src || '') : ''
            };

            openItemFormModal('edit', {
                containerKey: ctrKey,
                type: ctrType,
                containerLabel: containerLabel,
                itemLabel: itemLabel,
                isAdded: isAdded,
                hasIcon: Boolean(icoKeyEl),
                initial: initial,
                onSave: function (vals) {
                    commitMutation(function (st) {
                        if (isAdded) {
                            var target = null;
                            for (var i = 0; i < st.added_items.length; i++) {
                                if (st.added_items[i].id === itemId) {
                                    target = st.added_items[i];
                                    break;
                                }
                            }
                            if (target) {
                                target.title = vals.title;
                                target.desc = vals.desc;
                                target.badge = vals.badge;
                                target.tag = vals.tag;
                                target.time = vals.time;
                                target.code = vals.code;
                                target.category = vals.category;
                                if (icoKeyEl) target.icon = vals.icon;
                                if (ctrType === 'gallery' && (vals.photoTouched || !target.image)) {
                                    target.image = vals.image;
                                }
                            }
                            delete st.texts['dyn_' + itemId + '_title'];
                            delete st.texts['dyn_' + itemId + '_desc'];
                            delete st.texts['dyn_' + itemId + '_badge'];
                            delete st.texts['dyn_' + itemId + '_tag'];
                            delete st.texts['dyn_' + itemId + '_time'];
                            delete st.texts['dyn_' + itemId + '_code'];
                            delete st.images['dyn_' + itemId + '_img'];
                            delete st.icons['dyn_' + itemId + '_ico'];
                        } else {
                            var setTextByEl = function (node, textVal) {
                                if (!node) return;
                                var tKey = node.getAttribute('data-editor-key');
                                if (tKey) st.texts[tKey] = textVal;
                            };
                            setTextByEl(els.titleEl, vals.title);
                            if (els.descEl) setTextByEl(els.descEl, vals.desc);
                            if (els.badgeEl) setTextByEl(els.badgeEl, StateEngine.sanitizePlain(vals.badge, 80));
                            if (els.tagEl) setTextByEl(els.tagEl, StateEngine.sanitizePlain(vals.tag, 80));
                            if (els.timeEl) setTextByEl(els.timeEl, StateEngine.sanitizePlain(vals.time, 80));
                            if (els.codeEl) setTextByEl(els.codeEl, StateEngine.sanitizePlain(vals.code, 20));
                            if (icoKeyEl) {
                                var iKey = icoKeyEl.getAttribute('data-editor-ico-key');
                                if (iKey) st.icons[iKey] = vals.icon;
                            }
                            if (ctrType === 'gallery' && vals.photoTouched && els.imgEl) {
                                var mKey = els.imgEl.getAttribute('data-editor-img-key');
                                if (mKey) st.images[mKey] = vals.image;
                            }
                        }
                    }, 'Perubahan card berhasil diterapkan!');
                }
            });
        }

        window.closeAddModal = function () {
            var b = document.getElementById('adminAddModalBackdrop');
            if (b) b.hidden = true;
        };

        // ============================================================
        // MODAL PICKER IKON & MODAL KONFIRMASI
        // ============================================================
        function openIconPicker(onPick, currentIcon) {
            var backdrop = document.getElementById('adminIconPickerModalBackdrop');
            var search = document.getElementById('adminIconSearchInput');
            var grid = document.getElementById('adminIconGrid');
            if (!backdrop || !search || !grid) return;

            function renderGrid(query) {
                var q = String(query || '').trim().toLowerCase();
                grid.innerHTML = '';
                CURATED_ICONS.forEach(function (ic) {
                    if (q && ic.cls.toLowerCase().indexOf(q) === -1 && ic.tags.indexOf(q) === -1) return;
                    var btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'admin-icon-option' + (ic.cls === currentIcon ? ' selected' : '');
                    btn.title = ic.tags;
                    btn.innerHTML = '<i class="' + ic.cls + '"></i>';
                    btn.addEventListener('click', function () {
                        closeIconPicker();
                        onPick(ic.cls);
                    });
                    grid.appendChild(btn);
                });
            }

            search.value = '';
            search.oninput = function () { renderGrid(search.value); };
            renderGrid('');
            backdrop.hidden = false;
            setTimeout(function () { search.focus(); }, 60);
        }

        window.closeIconPicker = function () {
            var b = document.getElementById('adminIconPickerModalBackdrop');
            if (b) b.hidden = true;
        };

        function openConfirmModal(title, message, onConfirm) {
            var backdrop = document.getElementById('adminConfirmModalBackdrop');
            var tEl = document.getElementById('adminConfirmTitle');
            var mEl = document.getElementById('adminConfirmMessage');
            var okBtn = document.getElementById('adminConfirmActionBtn');
            if (!backdrop || !tEl || !mEl || !okBtn) return;

            tEl.textContent = title;
            mEl.textContent = message;
            okBtn.onclick = function () {
                closeConfirmModal();
                onConfirm();
            };
            backdrop.hidden = false;
        }

        window.closeConfirmModal = function () {
            var b = document.getElementById('adminConfirmModalBackdrop');
            if (b) b.hidden = true;
        };

        // ============================================================
        // SIMPAN & PUBLIKASIKAN KE DATABASE + RESET KE BAWAAN
        // ============================================================
        window.saveAndPublishChanges = function () {
            if (!ensureBooted()) return;
            var btn = document.getElementById('btnSavePublishEditor');
            var origHtml = btn ? btn.innerHTML : '';
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
            }

            StateEngine.writeLocalDraft(state);

            fetch('/page-editor/simpan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                body: JSON.stringify({
                    page_key: StateEngine.pageKey,
                    content: state
                })
            })
            .then(function (res) {
                return res.text().then(function (rawText) {
                    var parsed = null;
                    try { parsed = JSON.parse(rawText); } catch (e) {}
                    return { ok: res.ok, status: res.status, data: parsed };
                });
            })
            .then(function (result) {
                if (result.ok && result.data && result.data.success) {
                    StateEngine.publishedData = cloneState(state);
                    updateSyncBadge('saved', 'Dipublikasikan ke Database');
                    showToast(result.data.message || 'Perubahan halaman berhasil dipublikasikan ke database!');
                } else if (result.status === 404 || result.status === 405) {
                    updateSyncBadge('local-only', 'Tersimpan di browser (rute /page-editor/simpan belum aktif)');
                    showToast('Draf tersimpan di browser! Tambahkan rute POST /page-editor/simpan agar tayang permanen ke semua pengunjung.');
                } else {
                    updateSyncBadge('local-only');
                    showToast((result.data && result.data.message) ? result.data.message : 'Gagal menyimpan ke server, draf aman di browser.');
                }
            })
            .catch(function () {
                updateSyncBadge('local-only');
                showToast('Koneksi server gagal. Perubahan tetap tersimpan sebagai draf browser.');
            })
            .finally(function () {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = origHtml;
                }
            });
        };

        window.confirmResetToDefault = function () {
            if (!ensureBooted()) return;
            openConfirmModal(
                'Reset Halaman ke Versi Bawaan?',
                'Seluruh perubahan teks, foto, dan card tambahan (Kegiatan/Program/Fasilitas) di halaman ini akan dikembalikan seperti semula.',
                function () {
                    var cleanState = StateEngine.normalizeState({});
                    undoHistory = [];
                    redoHistory = [];
                    StateEngine.clearLocalDraft();
                    StateEngine.publishedData = null;
                    applyStateAndRefresh(cleanState);
                    updateHistoryUI();

                    fetch('/page-editor/reset', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                        body: JSON.stringify({ page_key: StateEngine.pageKey })
                    })
                    .then(function (res) {
                        if (res.ok) {
                            updateSyncBadge('default', 'Direset ke bawaan (Database & Lokal)');
                            showToast('Konten halaman berhasil dikembalikan ke versi bawaan!');
                        } else {
                            updateSyncBadge('default', 'Direset di browser');
                            showToast('Draf lokal halaman berhasil direset ke tampilan bawaan.');
                        }
                    })
                    .catch(function () {
                        updateSyncBadge('default', 'Direset di browser');
                        showToast('Draf lokal halaman berhasil direset ke tampilan bawaan.');
                    });
                }
            );
        };

        // Fallback backward compatibility name
        window.saveAllCurrentChanges = window.saveAndPublishChanges;

        function showToast(msg) {
            var toast = document.getElementById('adminEditorToast');
            var msgEl = document.getElementById('adminEditorToastMsg');
            if (!toast || !msgEl) return;
            msgEl.textContent = msg;
            toast.classList.add('show');
            clearTimeout(toast._timeout);
            toast._timeout = setTimeout(function () {
                toast.classList.remove('show');
            }, 3400);
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEditor);
        } else {
            initEditor();
        }
    })();
</script>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/home-admin-editor.blade.php ENDPATH**/ ?>
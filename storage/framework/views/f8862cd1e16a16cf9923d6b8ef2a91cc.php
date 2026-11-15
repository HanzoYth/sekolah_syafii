
<style id="syafiiEditorPublicStyles">
    .editor-removed-item {
        display: none !important;
    }
</style>

<script id="syafiiPublishedEditorData" type="application/json"><?php echo json_encode($publishedPageContent ?? null, 15, 512) ?></script>
<script id="syafiiEditorMeta" type="application/json"><?php echo json_encode(['pageKey' => $editorPageKey ?? '/', 'isAdmin' => $isAdmin ?? false], 512) ?></script>

<script>
    (function () {
        'use strict';

        function parseJsonScript(id, fallback) {
            var el = document.getElementById(id);
            if (!el) return fallback;
            try {
                var parsed = JSON.parse(el.textContent || 'null');
                return parsed === null ? fallback : parsed;
            } catch (e) {
                return fallback;
            }
        }

        var meta = parseJsonScript('syafiiEditorMeta', { pageKey: '/', isAdmin: false }) || {};
        var pageKey = String(meta.pageKey || '/');
        var isAdmin = Boolean(meta.isAdmin);
        var publishedData = parseJsonScript('syafiiPublishedEditorData', null);

        var PROTECTED_SELECTOR = [
            'header', 'nav', '.navbar', '.mobile-menu', '.menu-toggle', 'footer', '.footer', '.footer-bottom', '.copyright', '#year',
            '.page-breadcrumb', '.hero-btns', '.auth-buttons', '.ppdb-btns', '.btn-action', '.sosmed',
            '.basmalah', '[lang="ar"]', '.arabic-quote', '#map', '.leaflet-container', 'form',
            '.lightbox', '#lightbox', '.pwa-modal-backdrop', '#pwaInstallModal',
            '#adminFloatingWidget', '#adminEditorPopupCard', '#adminEditorToast',
            '#adminAddModalBackdrop', '#adminIconPickerModalBackdrop', '#adminConfirmModalBackdrop',
            '.admin-container-bar', '.admin-item-actions',
            '.admin-img-overlay', '.btn-admin-change-img',
            '.btn', 'button', 'a', 'input', 'textarea', 'select', 'script', 'style', 'noscript'
        ].join(', ');

        var TOOL_ELEMENT_SELECTOR = [
            '.admin-container-bar', '.admin-item-actions',
            '.admin-img-overlay', '.btn-admin-change-img'
        ].join(', ');

        var EDITABLE_TEXT_SELECTORS = [
            'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
            'p', 'blockquote',
            'span.section-eyebrow', '.lead-text', '.hero-desc',
            '.check-item',
            '.stat-number', '.stat-desc', '.stat-item-desc',
            '.stat-card strong', '.stat-card > span',
            '.hero-mini-stat strong', '.hero-mini-stat span',
            '.floating-badge strong', '.floating-badge span',
            '.profil-exp-badge strong', '.profil-exp-badge span',
            '.vm-card li',
            '.syarat-card li > span',
            '.kontak-info li > div > strong',
            '.kontak-info li > div > span',
            '.galeri-item figcaption .badge',
            '.program-tag', '.jenjang-badge', '.value-num', '.timeline-time',
            '.prestasi-card .badge', '.faq-list summary'
        ];

        var CONTAINER_DEFS = [
            { selector: '.galeri-grid', type: 'gallery', label: 'Galeri & Kegiatan', itemLabel: 'Kegiatan / Galeri' },
            { selector: '.program-grid', type: 'program', label: 'Program Unggulan', itemLabel: 'Program' },
            { selector: '.jenjang-strip', type: 'jenjang', label: 'Jenjang Pendidikan', itemLabel: 'Jenjang' },
            { selector: '.fasilitas-grid', type: 'card_icon', label: 'Fasilitas / Agenda', itemLabel: 'Fasilitas / Agenda' },
            { selector: '.prestasi-grid', type: 'prestasi', label: 'Pilar & Prestasi', itemLabel: 'Prestasi' },
            { selector: '.values-grid', type: 'value', label: 'Nilai Inti / Karakter', itemLabel: 'Nilai / Pilar' },
            { selector: '.timeline-grid', type: 'timeline', label: 'Jadwal Harian', itemLabel: 'Agenda Harian' },
            { selector: '.stat-grid', type: 'stat', label: 'Statistik Sekolah', itemLabel: 'Statistik' },
            { selector: '.ppdb-steps-grid', type: 'step', label: 'Alur Pendaftaran PPDB', itemLabel: 'Langkah PPDB' },
            { selector: '.faq-list', type: 'faq', label: 'Tanya Jawab (FAQ)', itemLabel: 'Pertanyaan FAQ' },
            { selector: '.check-grid', type: 'check', label: 'Poin Keunggulan', itemLabel: 'Poin Keunggulan' },
            { selector: '.vm-card ul', type: 'list_icon', label: 'Daftar Misi', itemLabel: 'Poin Misi' },
            { selector: '.syarat-card ul', type: 'list_syarat', label: 'Daftar Syarat / Ketentuan', itemLabel: 'Poin Syarat' },
            { selector: '.kontak-info ul', type: 'contact_item', label: 'Info Kontak & Layanan', itemLabel: 'Info Kontak' }
        ];

        var ICON_TARGET_SELECTORS = [
            '.fasilitas-icon > i',
            '.icon-card > i',
            '.prestasi-icon > i',
            '.stat-card > i',
            '.check-item > i',
            '.vm-card h3 > i',
            '.vm-card li > i',
            '.syarat-card h3 > i',
            '.syarat-card li > i',
            '.kontak-info li > i',
            '.galeri-item figcaption .badge > i',
            '.timeline-time > i',
            '.section-eyebrow > i'
        ];

        var originals = {
            texts: {},
            images: {},
            icons: {}
        };
        var staticIndexed = false;

        function sanitizeHtml(html) {
            if (html === null || html === undefined) return '';
            var tpl = document.createElement('template');
            tpl.innerHTML = String(html);
            var blocked = tpl.content.querySelectorAll('script, iframe, object, embed, style, link, meta');
            blocked.forEach(function (node) { node.remove(); });
            tpl.content.querySelectorAll('*').forEach(function (el) {
                Array.prototype.slice.call(el.attributes).forEach(function (attr) {
                    var name = attr.name.toLowerCase();
                    var val = String(attr.value || '').trim();
                    if (name.indexOf('on') === 0) {
                        el.removeAttribute(attr.name);
                    } else if ((name === 'href' || name === 'src') && /^(javascript|vbscript|data:text\/html)/i.test(val)) {
                        el.setAttribute(attr.name, '#');
                    }
                });
            });
            return tpl.innerHTML;
        }

        function escapeText(str) {
            return String(str || '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');
        }

        function sanitizePlain(str, max) {
            var tmp = document.createElement('div');
            tmp.innerHTML = String(str || '');
            var txt = (tmp.textContent || tmp.innerText || '').trim();
            return max ? txt.slice(0, max) : txt;
        }

        function sanitizeIcon(cls) {
            var val = String(cls || '').trim();
            if (/^fa-(solid|regular|brands)\s+fa-[a-z0-9-]+$/.test(val)) {
                return val;
            }
            return 'fa-solid fa-star';
        }

        function sanitizeMediaSrc(src) {
            var val = String(src || '').trim();
            if (!val) return '';
            if (/^data:image\/(png|jpe?g|gif|webp);base64,[A-Za-z0-9+/=]+$/i.test(val)) {
                return val;
            }
            if (val.charAt(0) === '/' || /^https?:\/\//i.test(val)) {
                return val.replace(/javascript:/ig, '');
            }
            return '';
        }

        function isProtectedElement(el) {
            if (!el || el.nodeType !== 1) return true;
            if (el.matches && el.matches(PROTECTED_SELECTOR)) return true;
            return Boolean(el.closest && el.closest(PROTECTED_SELECTOR));
        }

        function isToolElement(el) {
            if (!el || el.nodeType !== 1) return false;
            return el.matches && el.matches(TOOL_ELEMENT_SELECTOR);
        }

        function getStoragePrefixKey() {
            return 'syafii_editor_draft_' + pageKey.replace(/[^a-zA-Z0-9_-]/g, '_');
        }

        function getLegacyStorageKey() {
            return 'syafii_editor_' + (window.location.pathname + window.location.search).replace(/[^a-zA-Z0-9]/g, '_');
        }

        function normalizeState(raw) {
            var st = (raw && typeof raw === 'object') ? raw : {};
            return {
                texts: (st.texts && typeof st.texts === 'object' && !Array.isArray(st.texts)) ? Object.assign({}, st.texts) : {},
                images: (st.images && typeof st.images === 'object' && !Array.isArray(st.images)) ? Object.assign({}, st.images) : {},
                icons: (st.icons && typeof st.icons === 'object' && !Array.isArray(st.icons)) ? Object.assign({}, st.icons) : {},
                added_items: Array.isArray(st.added_items) ? st.added_items.map(function (it) { return Object.assign({}, it); }) : [],
                removed_items: []
            };
        }

        function inferHeadingForNode(node) {
            var sec = node.closest('section');
            if (!sec) return '';
            var h = sec.querySelector('.fasilitas-subhead h3, .faq-head h3, .section-head h2, h2, h3');
            if (!h) return '';
            return sanitizePlain(h.textContent, 42);
        }

        function assignStaticEditableTextsInRoot(root, startCounter) {
            var combined = EDITABLE_TEXT_SELECTORS.join(', ');
            var all = Array.prototype.slice.call(root.querySelectorAll(combined));
            var filtered = all.filter(function (el) {
                if (isProtectedElement(el)) return false;
                if (el.getAttribute('data-editor-key')) return false;
                return true;
            });

            // Skip outer nodes if a deeper matched node exists inside (prevents nested contenteditable)
            var leafNodes = filtered.filter(function (el) {
                return !filtered.some(function (other) {
                    return other !== el && el.contains(other);
                });
            });

            var idx = startCounter;
            leafNodes.forEach(function (el) {
                var tag = el.tagName.toLowerCase();
                var key = 'txt_' + idx + '_' + tag;
                el.setAttribute('data-editor-key', key);
                el.setAttribute('data-editor-static', '1');
                originals.texts[key] = el.innerHTML;
                idx++;
            });
            return idx;
        }

        function indexStaticDom() {
            if (staticIndexed) return;
            staticIndexed = true;

            // Index repeatable containers & SSR items already present in the page menus
            var ctrIdx = 0;
            CONTAINER_DEFS.forEach(function (def) {
                document.querySelectorAll(def.selector).forEach(function (ctr) {
                    if (isProtectedElement(ctr)) return;
                    if (ctr.getAttribute('data-editor-container-key')) return;

                    var ctrKey = 'ctr_' + ctrIdx + '_' + def.type;
                    ctr.setAttribute('data-editor-container-key', ctrKey);
                    ctr.setAttribute('data-editor-container-type', def.type);
                    var headingHint = inferHeadingForNode(ctr);
                    var fullLabel = headingHint ? (def.label + ' (' + headingHint + ')') : def.label;
                    ctr.setAttribute('data-editor-container-label', fullLabel);
                    ctr.setAttribute('data-editor-item-label', def.itemLabel);

                    var childIdx = 0;
                    Array.prototype.slice.call(ctr.children).forEach(function (child) {
                        if (isToolElement(child)) return;
                        child.setAttribute('data-editor-static-item', '1');
                        child.setAttribute('data-editor-item-id', 'static_' + ctrKey + '_' + childIdx);
                        childIdx++;
                    });
                    ctrIdx++;
                });
            });

            // 3. Index SSR standalone icons BEFORE capturing static text originals so inner <i> retains data-editor-ico-key
            var icoIdx = 0;
            var iconCombined = ICON_TARGET_SELECTORS.join(', ');
            document.querySelectorAll(iconCombined).forEach(function (iconEl) {
                if (isProtectedElement(iconEl)) return;
                if (iconEl.getAttribute('data-editor-ico-key')) return;
                var icoKey = 'ico_' + icoIdx;
                iconEl.setAttribute('data-editor-ico-key', icoKey);
                originals.icons[icoKey] = iconEl.className;
                icoIdx++;
            });

            // 4. Index SSR editable text nodes
            assignStaticEditableTextsInRoot(document.body, 0);

            // 5. Index SSR images
            var imgIdx = 0;
            document.querySelectorAll('img').forEach(function (img) {
                if (isProtectedElement(img) && !img.closest('.galeri-btn')) return;
                if (img.closest('#adminFloatingWidget, .navbar, .footer, .lightbox, .pwa-modal-backdrop')) return;
                if (img.getAttribute('data-editor-img-key')) return;
                var iKey = 'img_' + imgIdx;
                img.setAttribute('data-editor-img-key', iKey);
                originals.images[iKey] = img.getAttribute('src') || '';
                imgIdx++;
            });
        }

        function setElementTextValue(el, html) {
            if (!el) return;
            var safe = sanitizeHtml(html);
            if (el.matches('.check-item, .vm-card li, .galeri-item figcaption .badge, .timeline-time, span.section-eyebrow')) {
                var existingIcon = el.querySelector('i[data-editor-ico-key], i.fa-solid, i.fa-regular, i.fa-brands');
                if (existingIcon && !/<i\s+[^>]*class=/i.test(safe)) {
                    var iconClone = existingIcon.outerHTML;
                    el.innerHTML = iconClone + ' ' + safe;
                    return;
                }
            }
            el.innerHTML = safe;
            var counter = el.querySelector('.counter-num[data-target]');
            if (counter) {
                counter.removeAttribute('data-target');
            }
            if (el.matches('.counter-num[data-target]')) {
                el.removeAttribute('data-target');
            }
        }

        function syncLightboxParent(img, newSrc) {
            var btn = img ? img.closest('[data-lightbox]') : null;
            if (!btn) return;
            btn.setAttribute('data-full', newSrc);
            var item = btn.closest('.galeri-item');
            if (item) {
                var titleEl = item.querySelector('figcaption h3');
                var descEl = item.querySelector('figcaption p');
                var t = titleEl ? titleEl.textContent.trim() : '';
                var d = descEl ? descEl.textContent.trim() : '';
                if (t || d) {
                    btn.setAttribute('data-caption', t + (d ? ' — ' + d : ''));
                }
            }
        }

        function buildItemElement(item) {
            var id = sanitizePlain(item.id || ('itm_' + Date.now()), 80);
            var type = sanitizePlain(item.type || 'card_icon', 40);
            var iconClass = sanitizeIcon(item.icon || 'fa-solid fa-star');
            var titleHtml = sanitizeHtml(item.title || 'Judul Baru');
            var descHtml = sanitizeHtml(item.desc || '');
            var badgeText = escapeText(sanitizePlain(item.badge || '', 80));
            var tagText = escapeText(sanitizePlain(item.tag || '', 80));
            var timeText = escapeText(sanitizePlain(item.time || '', 80));
            var codeText = escapeText(sanitizePlain(item.code || '', 20));
            var category = sanitizePlain(item.category || 'tahfizh', 40) || 'tahfizh';
            var defaultImg = sanitizeMediaSrc(item.image || '') || '/img/ft_2.jpeg';
            var plainCaption = escapeText(sanitizePlain(titleHtml, 80) + (descHtml ? ' — ' + sanitizePlain(descHtml, 120) : ''));

            var el;

            if (type === 'gallery') {
                el = document.createElement('figure');
                el.className = 'galeri-item';
                el.setAttribute('data-category', category);
                el.innerHTML =
                    '<button type="button" class="galeri-btn" data-lightbox data-full="' + escapeText(defaultImg) + '" data-caption="' + plainCaption + '">' +
                        '<img src="' + escapeText(defaultImg) + '" alt="' + escapeText(sanitizePlain(titleHtml, 60)) + '" loading="lazy" data-editor-img-key="dyn_' + id + '_img">' +
                        '<span class="galeri-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i></span>' +
                    '</button>' +
                    '<figcaption>' +
                        '<span class="badge" data-editor-key="dyn_' + id + '_badge"><i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i> ' + (badgeText || 'Kegiatan Sekolah') + '</span>' +
                        '<h3 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h3>' +
                        '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Dokumentasi kegiatan santri Sekolah Islam Al-Qur\'an Imam Syafi\'i.') + '</p>' +
                    '</figcaption>';
            } else if (type === 'program') {
                el = document.createElement('div');
                el.className = 'program-card tilt-card';
                el.innerHTML =
                    '<div class="icon-card"><i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i></div>' +
                    '<h3 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h3>' +
                    '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Deskripsi program pembelajaran unggulan sekolah.') + '</p>' +
                    '<span class="program-tag" data-editor-key="dyn_' + id + '_tag">' + (tagText || 'Program Unggulan') + '</span>';
            } else if (type === 'jenjang') {
                el = document.createElement('div');
                el.className = 'jenjang-card';
                el.innerHTML =
                    '<div class="jenjang-badge" data-editor-key="dyn_' + id + '_code">' + (codeText || 'BARU') + '</div>' +
                    '<div>' +
                        '<h3 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h3>' +
                        '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Pembinaan jenjang pendidikan terpadu berlandaskan Al-Qur\'an & Sunnah.') + '</p>' +
                    '</div>';
            } else if (type === 'prestasi') {
                el = document.createElement('div');
                el.className = 'prestasi-card';
                el.innerHTML =
                    '<div class="prestasi-icon"><i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i></div>' +
                    '<div>' +
                        '<span class="badge" style="background: rgba(212,175,55,0.22); color: var(--accent-light);" data-editor-key="dyn_' + id + '_badge">' + (badgeText || 'Prestasi') + '</span>' +
                        '<h4 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h4>' +
                        '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Capaian membanggakan santri di bidang Al-Qur\'an, diniyah, dan akademik.') + '</p>' +
                    '</div>';
            } else if (type === 'value') {
                el = document.createElement('div');
                el.className = 'value-card';
                el.innerHTML =
                    '<span class="value-num" data-editor-key="dyn_' + id + '_code">' + (codeText || '04') + '</span>' +
                    '<div class="fasilitas-icon"><i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i></div>' +
                    '<h3 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h3>' +
                    '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Nilai karakter Islami yang ditanamkan kepada seluruh peserta didik.') + '</p>';
            } else if (type === 'timeline') {
                el = document.createElement('div');
                el.className = 'timeline-card';
                el.innerHTML =
                    '<span class="timeline-time" data-editor-key="dyn_' + id + '_time"><i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i> ' + (timeText || '08.00 - 09.30 WITA') + '</span>' +
                    '<h4 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h4>' +
                    '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Agenda pembinaan harian santri secara terstruktur.') + '</p>';
            } else if (type === 'stat') {
                el = document.createElement('div');
                el.className = 'stat-card';
                el.innerHTML =
                    '<i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i>' +
                    '<strong data-editor-key="dyn_' + id + '_title">' + titleHtml + '</strong>' +
                    '<span data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Keterangan Statistik') + '</span>';
            } else if (type === 'step') {
                el = document.createElement('div');
                el.className = 'ppdb-step';
                el.innerHTML =
                    '<span class="ppdb-step-num">•</span>' +
                    '<h4 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h4>' +
                    '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Tahapan pendaftaran santri baru.') + '</p>';
            } else if (type === 'faq') {
                el = document.createElement('details');
                el.setAttribute('open', 'open');
                el.innerHTML =
                    '<summary data-editor-key="dyn_' + id + '_title">' + titleHtml + '</summary>' +
                    '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Jawaban lengkap seputar informasi sekolah dan pendaftaran.') + '</p>';
            } else if (type === 'check') {
                el = document.createElement('div');
                el.className = 'check-item';
                el.setAttribute('data-editor-key', 'dyn_' + id + '_title');
                el.innerHTML = '<i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i> ' + titleHtml;
            } else if (type === 'list_icon') {
                el = document.createElement('li');
                el.setAttribute('data-editor-key', 'dyn_' + id + '_title');
                el.innerHTML = '<i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i> ' + titleHtml;
            } else if (type === 'list_syarat') {
                el = document.createElement('li');
                el.innerHTML =
                    '<i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i>' +
                    '<span data-editor-key="dyn_' + id + '_title">' + titleHtml + '</span>';
            } else if (type === 'contact_item') {
                el = document.createElement('li');
                el.innerHTML =
                    '<i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico" aria-hidden="true"></i>' +
                    '<div>' +
                        '<strong data-editor-key="dyn_' + id + '_title">' + titleHtml + '</strong>' +
                        '<span data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Hubungi sekretariat sekolah') + '</span>' +
                    '</div>';
            } else {
                // Default: card_icon (.fasilitas-card)
                el = document.createElement('div');
                el.className = 'fasilitas-card';
                el.innerHTML =
                    '<div class="fasilitas-icon"><i class="' + iconClass + '" data-editor-ico-key="dyn_' + id + '_ico"></i></div>' +
                    '<h4 data-editor-key="dyn_' + id + '_title">' + titleHtml + '</h4>' +
                    '<p data-editor-key="dyn_' + id + '_desc">' + (descHtml || 'Informasi fasilitas dan layanan penunjang kegiatan belajar santri.') + '</p>';
            }

            el.setAttribute('data-editor-added-item', '1');
            el.setAttribute('data-editor-item-id', id);
            return el;
        }

        function renumberSteps() {
            document.querySelectorAll('.ppdb-steps-grid').forEach(function (grid) {
                var num = 1;
                Array.prototype.slice.call(grid.children).forEach(function (child) {
                    if (isToolElement(child) || child.classList.contains('editor-removed-item')) return;
                    var badge = child.querySelector('.ppdb-step-num');
                    if (badge) {
                        badge.textContent = String(num);
                        num++;
                    }
                });
            });
        }

        function applyFullState(rawState) {
            indexStaticDom();
            var state = normalizeState(rawState);

            // 1. Restore static items visibility
            document.querySelectorAll('[data-editor-static-item="1"]').forEach(function (el) {
                el.classList.remove('editor-removed-item');
            });

            // 2. Remove previously hydrated dynamic cards so re-render is deterministic
            document.querySelectorAll('[data-editor-added-item="1"]').forEach(function (el) {
                el.remove();
            });

            // 3. Card bawaan tidak dapat dihapus/disembunyikan, hanya dapat diedit atau diduplikasi.

            // 4. Inject added_items only into existing page containers
            state.added_items.forEach(function (item) {
                if (!item || !item.id || !item.containerKey) return;
                var ctr = document.querySelector('[data-editor-container-key="' + item.containerKey + '"]');
                if (!ctr) return;
                var itemEl = buildItemElement(item);
                ctr.appendChild(itemEl);
            });

            // 6. Apply icons first (so inline edits containing icons or standalones sync)
            Object.keys(originals.icons).forEach(function (k) {
                var icoEl = document.querySelector('[data-editor-ico-key="' + k + '"]');
                if (icoEl) icoEl.className = originals.icons[k];
            });
            Object.keys(state.icons).forEach(function (k) {
                var icoEl = document.querySelector('[data-editor-ico-key="' + k + '"]');
                if (icoEl) icoEl.className = sanitizeIcon(state.icons[k]);
            });

            // 7. Apply images
            Object.keys(originals.images).forEach(function (k) {
                var imgEl = document.querySelector('img[data-editor-img-key="' + k + '"]');
                if (imgEl) {
                    imgEl.src = originals.images[k];
                    syncLightboxParent(imgEl, originals.images[k]);
                }
            });
            Object.keys(state.images).forEach(function (k) {
                var imgEl = document.querySelector('img[data-editor-img-key="' + k + '"]');
                var safeSrc = sanitizeMediaSrc(state.images[k]);
                if (imgEl && safeSrc) {
                    imgEl.src = safeSrc;
                    syncLightboxParent(imgEl, safeSrc);
                }
            });

            // 8. Apply texts
            Object.keys(originals.texts).forEach(function (k) {
                var tEl = document.querySelector('[data-editor-key="' + k + '"]');
                if (tEl && !Object.prototype.hasOwnProperty.call(state.texts, k)) {
                    tEl.innerHTML = originals.texts[k];
                }
            });
            Object.keys(state.texts).forEach(function (k) {
                var tEl = document.querySelector('[data-editor-key="' + k + '"]');
                if (tEl) {
                    setElementTextValue(tEl, state.texts[k]);
                }
            });

            renumberSteps();

            if (typeof window.SyafiiRefreshDynamicHooks === 'function') {
                window.SyafiiRefreshDynamicHooks();
            }
            if (typeof AOS !== 'undefined') {
                if (typeof AOS.refreshHard === 'function') AOS.refreshHard();
                else if (typeof AOS.refresh === 'function') AOS.refresh();
            }
        }

        function readLocalDraft() {
            try {
                var raw = localStorage.getItem(getStoragePrefixKey());
                if (raw) {
                    return normalizeState(JSON.parse(raw));
                }
                // Seamless migration from older session/local storage format ({ txt_...: ..., img_...: ... })
                var legacyKey = getLegacyStorageKey();
                var legacyRaw = sessionStorage.getItem(legacyKey) || localStorage.getItem(legacyKey);
                if (legacyRaw) {
                    var leg = JSON.parse(legacyRaw);
                    if (leg && typeof leg === 'object') {
                        var texts = {};
                        var images = {};
                        Object.keys(leg).forEach(function (k) {
                            if (k.indexOf('img_') === 0) images[k] = leg[k];
                            else if (k.indexOf('txt_') === 0) texts[k] = leg[k];
                        });
                        if (Object.keys(texts).length || Object.keys(images).length) {
                            return normalizeState({ texts: texts, images: images });
                        }
                    }
                }
            } catch (e) {}
            return null;
        }

        function writeLocalDraft(state) {
            try {
                localStorage.setItem(getStoragePrefixKey(), JSON.stringify(normalizeState(state)));
                return true;
            } catch (e) {
                return false;
            }
        }

        function clearLocalDraft() {
            try {
                localStorage.removeItem(getStoragePrefixKey());
                localStorage.removeItem(getLegacyStorageKey());
                sessionStorage.removeItem(getLegacyStorageKey());
            } catch (e) {}
        }

        function getInitialState() {
            if (isAdmin) {
                var draft = readLocalDraft();
                if (draft) return draft;
            }
            if (publishedData && typeof publishedData === 'object') {
                return normalizeState(publishedData);
            }
            return normalizeState({});
        }

        window.SyafiiPageState = {
            pageKey: pageKey,
            isAdmin: isAdmin,
            originals: originals,
            publishedData: publishedData ? normalizeState(publishedData) : null,
            normalizeState: normalizeState,
            sanitizeHtml: sanitizeHtml,
            sanitizePlain: sanitizePlain,
            sanitizeIcon: sanitizeIcon,
            sanitizeMediaSrc: sanitizeMediaSrc,
            isProtectedElement: isProtectedElement,
            isToolElement: isToolElement,
            indexStaticDom: indexStaticDom,
            applyFullState: applyFullState,
            buildItemElement: buildItemElement,
            renumberSteps: renumberSteps,
            readLocalDraft: readLocalDraft,
            writeLocalDraft: writeLocalDraft,
            clearLocalDraft: clearLocalDraft,
            getInitialState: getInitialState
        };

        // Run synchronously before AOS.init() / parallax bindings
        indexStaticDom();
        applyFullState(getInitialState());
    })();
</script>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/components/home-editor-hydrate.blade.php ENDPATH**/ ?>
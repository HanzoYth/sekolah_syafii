{{-- KOMPONEN GLOBAL LOADING ANIMATION SIAKAD --}}
<style>
    /* Top Progress Bar */
    #siakad-top-progress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3.5px;
        background: linear-gradient(90deg, #059669, #10b981, #34d399);
        box-shadow: 0 0 10px rgba(16, 185, 129, 0.7);
        z-index: 100001;
         opacity: 0;
        pointer-events: none;
        transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.25s ease;
    }

    /* Fullscreen Backdrop Overlay */
    #siakad-loader-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.28);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        z-index: 100000;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
        transition: opacity 0.22s ease, visibility 0.22s ease;
    }

    #siakad-loader-overlay.is-active {
        opacity: 1;
        visibility: visible;
        pointer-events: auto;
    }

    /* Loader Card */
    .siakad-loader-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        padding: 24px 32px;
        box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.12), 0 8px 10px -6px rgba(15, 23, 42, 0.08);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        max-width: 310px;
        width: 90%;
        transform: translateY(8px) scale(0.97);
        transition: transform 0.22s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    #siakad-loader-overlay.is-active .siakad-loader-card {
        transform: translateY(0) scale(1);
    }

    /* Dual Ring Spinner with Icon */
    .siakad-spinner-wrap {
        position: relative;
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 14px;
    }

    .siakad-spinner-ring {
        position: absolute;
        inset: 0;
        border-radius: 9999px;
        border: 3.5px solid #d1fae5;
        border-top-color: #059669;
        border-right-color: #10b981;
        animation: siakadSpin 0.85s linear infinite;
    }

    .siakad-spinner-ring-inner {
        position: absolute;
        inset: 7px;
        border-radius: 9999px;
        border: 2.5px solid transparent;
        border-bottom-color: #34d399;
        animation: siakadSpinReverse 1.3s linear infinite;
    }

    .siakad-spinner-icon {
        color: #059669;
        font-size: 18px;
        animation: siakadPulse 1.5s ease-in-out infinite;
    }

    .siakad-loader-title {
        font-family: 'Inter', 'Poppins', system-ui, -apple-system, sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 4px 0;
    }

    .siakad-loader-subtitle {
        font-family: 'Inter', 'Poppins', system-ui, -apple-system, sans-serif;
        font-size: 12px;
        color: #64748b;
        margin: 0;
        line-height: 1.45;
    }

    @keyframes siakadSpin {
        to { transform: rotate(360deg); }
    }

    @keyframes siakadSpinReverse {
        to { transform: rotate(-360deg); }
    }

    @keyframes siakadPulse {
        0%, 100% { transform: scale(1); opacity: 0.9; }
        50% { transform: scale(1.12); opacity: 1; }
    }

    @media print {
        #siakad-top-progress,
        #siakad-loader-overlay {
            display: none !important;
        }
    }
</style>

<div id="siakad-top-progress" aria-hidden="true"></div>

<div id="siakad-loader-overlay" role="status" aria-live="polite" aria-hidden="true">
    <div class="siakad-loader-card">
        <div class="siakad-spinner-wrap">
            <div class="siakad-spinner-ring"></div>
            <div class="siakad-spinner-ring-inner"></div>
            <i id="siakad-loader-icon" class="fa-solid fa-mosque siakad-spinner-icon"></i>
        </div>
        <h4 id="siakad-loader-title" class="siakad-loader-title">Memuat Halaman...</h4>
        <p id="siakad-loader-subtitle" class="siakad-loader-subtitle">Mohon tunggu sebentar, sedang menyiapkan data SIAKAD.</p>
    </div>
</div>

<script>
(function () {
    if (window.__siakadLoaderInitialized) return;
    window.__siakadLoaderInitialized = true;

    var progressBar = document.getElementById('siakad-top-progress');
    var overlay     = document.getElementById('siakad-loader-overlay');
    var titleEl     = document.getElementById('siakad-loader-title');
    var subtitleEl  = document.getElementById('siakad-loader-subtitle');
    var iconEl      = document.getElementById('siakad-loader-icon');

    var progressInterval = null;
    var overlayTimer     = null;
    var safetyTimeout    = null;
    var lockedButtons    = [];

    function startProgressBar() {
        if (!progressBar) return;
        clearInterval(progressInterval);
        progressBar.style.opacity = '1';
        progressBar.style.width = '18%';

        var current = 18;
        progressInterval = setInterval(function () {
            if (current < 65) {
                current += Math.random() * 12;
            } else if (current < 88) {
                current += Math.random() * 3;
            }
            if (current > 90) current = 90;
            progressBar.style.width = current + '%';
        }, 180);
    }

    function showSiakadLoader(options) {
        options = options || {};
        var title    = options.title || 'Memuat Halaman...';
        var subtitle = options.subtitle || 'Mohon tunggu sebentar, sedang menyiapkan data SIAKAD.';
        var icon     = options.icon || 'fa-mosque';
        var delay    = typeof options.delay === 'number' ? options.delay : 80;

        if (titleEl) titleEl.textContent = title;
        if (subtitleEl) subtitleEl.textContent = subtitle;
        if (iconEl) iconEl.className = 'fa-solid ' + icon + ' siakad-spinner-icon';

        startProgressBar();

        clearTimeout(overlayTimer);
        overlayTimer = setTimeout(function () {
            if (overlay) {
                overlay.classList.add('is-active');
                overlay.setAttribute('aria-hidden', 'false');
            }
        }, delay);

        // Safety fallback: jangan pernah mengunci layar selamanya jika koneksi terputus / unduhan file
        clearTimeout(safetyTimeout);
        safetyTimeout = setTimeout(function () {
            hideSiakadLoader();
        }, 12000);
    }

    function hideSiakadLoader() {
        clearInterval(progressInterval);
        clearTimeout(overlayTimer);
        clearTimeout(safetyTimeout);

        if (progressBar) {
            progressBar.style.width = '100%';
            setTimeout(function () {
                progressBar.style.opacity = '0';
                setTimeout(function () {
                    progressBar.style.width = '0%';
                }, 250);
            }, 150);
        }

        if (overlay) {
            overlay.classList.remove('is-active');
            overlay.setAttribute('aria-hidden', 'true');
        }

        // Pulihkan tombol submit yang dikunci
        lockedButtons.forEach(function (item) {
            if (item && item.btn) {
                item.btn.disabled = false;
                item.btn.innerHTML = item.originalHtml;
                item.btn.style.opacity = '';
                item.btn.style.cursor = '';
            }
        });
        lockedButtons = [];
    }

    // Ekspos secara global bila dibutuhkan oleh script halaman
    window.SiakadLoader = {
        show: showSiakadLoader,
        hide: hideSiakadLoader
    };

    // 1. Tangani klik pada link navigasi & tab
    document.addEventListener('click', function (e) {
        if (e.defaultPrevented) return;
        if (e.button !== 0 || e.ctrlKey || e.metaKey || e.shiftKey || e.altKey) return;

        var link = e.target.closest('a');
        if (!link) return;

        var href = link.getAttribute('href');
        if (!href) return;

        // Abaikan anchor murni, javascript:, target="_blank", download, atau atribut data-no-loader
        if (
            href.charAt(0) === '#' ||
            href.indexOf('javascript:') === 0 ||
            href.indexOf('mailto:') === 0 ||
            href.indexOf('tel:') === 0 ||
            link.target === '_blank' ||
            link.hasAttribute('download') ||
            link.hasAttribute('data-no-loader')
        ) {
            return;
        }

        // Jika link punya atribut onclick (misal confirm()), dan user membatalkan, e.defaultPrevented sudah true di atas.
        try {
            var targetUrl = new URL(link.href, window.location.origin);
            if (targetUrl.origin !== window.location.origin) return;

            // Jika hanya berpindah #hash di halaman & query yang persis sama, jangan tampilkan loading
            if (
                targetUrl.pathname === window.location.pathname &&
                targetUrl.search === window.location.search &&
                targetUrl.hash !== ''
            ) {
                return;
            }

            var isTabSwitch = targetUrl.pathname === window.location.pathname && targetUrl.search !== window.location.search;
            showSiakadLoader({
                title: isTabSwitch ? 'Memuat Data...' : 'Memuat Halaman...',
                subtitle: isTabSwitch ? 'Sedang memperbarui tampilan data yang dipilih.' : 'Mohon tunggu sebentar, sedang membuka halaman.',
                icon: isTabSwitch ? 'fa-layer-group' : 'fa-mosque',
                delay: 60
            });
        } catch (err) {
            // Abaikan URL tidak valid
        }
    });

    // 2. Tangani pengiriman form (POST Simpan Data & GET Filter Data)
    document.addEventListener('submit', function (e) {
        if (e.defaultPrevented) return;
        var form = e.target;
        if (!form || form.tagName !== 'FORM') return;
        if (form.hasAttribute('data-no-loader') || form.target === '_blank') return;

        // Pastikan validasi HTML5 lulus
        if (typeof form.checkValidity === 'function' && !form.checkValidity()) {
            return;
        }

        var method = (form.getAttribute('method') || 'GET').toUpperCase();
        var action = form.getAttribute('action') || '';

        var loaderTitle    = 'Memproses Data...';
        var loaderSubtitle = 'Mohon tunggu, sedang memproses permintaan Anda.';
        var loaderIcon     = 'fa-arrows-rotate';
        var btnText        = 'Memproses...';

        if (method === 'POST') {
            if (action.indexOf('/sk/pbsp') !== -1) {
                loaderTitle    = 'Mengirim Notifikasi Tagihan...';
                loaderSubtitle = 'Sedang menghubungi layanan pesan untuk mempublikasikan tagihan.';
                loaderIcon     = 'fa-paper-plane';
                btnText        = 'Mengirim...';
            } else if (action.indexOf('absensi') !== -1) {
                loaderTitle    = 'Menyimpan Presensi...';
                loaderSubtitle = 'Sedang merekam data kehadiran dan jurnal kelas ke sistem.';
                loaderIcon     = 'fa-clipboard-check';
                btnText        = 'Menyimpan...';
            } else if (action.indexOf('nilai') !== -1) {
                loaderTitle    = 'Menyimpan Nilai Siswa...';
                loaderSubtitle = 'Sedang menghitung nilai akhir dan menyimpan ke pangkalan data.';
                loaderIcon     = 'fa-star';
                btnText        = 'Menyimpan...';
            } else {
                loaderTitle    = 'Menyimpan Data...';
                loaderSubtitle = 'Mohon jangan tutup halaman ini saat data sedang disimpan.';
                loaderIcon     = 'fa-floppy-disk';
                btnText        = 'Menyimpan...';
            }
        } else {
            loaderTitle    = 'Menerapkan Filter...';
            loaderSubtitle = 'Sedang memuat ulang data sesuai kriteria yang dipilih.';
            loaderIcon     = 'fa-filter';
            btnText        = 'Memuat...';
        }

        // Kunci tombol submit untuk mencegah double-submit
        var submitBtn = e.submitter || form.querySelector('button[type="submit"], input[type="submit"]');
        if (submitBtn && submitBtn.tagName === 'BUTTON' && !submitBtn.disabled) {
            var originalHtml = submitBtn.innerHTML;
            lockedButtons.push({ btn: submitBtn, originalHtml: originalHtml });
            setTimeout(function () {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.8';
                submitBtn.style.cursor = 'wait';
                submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin mr-1.5"></i> ' + btnText;
            }, 10);
        }

        showSiakadLoader({
            title: loaderTitle,
            subtitle: loaderSubtitle,
            icon: loaderIcon,
            delay: 20
        });
    });

    // 3. Tangani select dengan onchange="this.form.submit()" (seperti filter Sekolah/Kelas)
    document.addEventListener('change', function (e) {
        var select = e.target;
        if (!select || select.tagName !== 'SELECT') return;
        var onchangeAttr = select.getAttribute('onchange') || '';
        if (onchangeAttr.indexOf('submit') !== -1) {
            showSiakadLoader({
                title: 'Memuat Data Filter...',
                subtitle: 'Sedang menyesuaikan tampilan berdasarkan pilihan Anda.',
                icon: 'fa-filter',
                delay: 20
            });
        }
    });

    // 4. Sembunyikan loader saat halaman selesai dimuat, kembali dari bfcache (Back/Forward), atau saat Print
    window.addEventListener('pageshow', function () {
        hideSiakadLoader();
    });

    window.addEventListener('load', function () {
        hideSiakadLoader();
    });

    window.addEventListener('beforeprint', function () {
        hideSiakadLoader();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            hideSiakadLoader();
        }
    });
})();
</script>


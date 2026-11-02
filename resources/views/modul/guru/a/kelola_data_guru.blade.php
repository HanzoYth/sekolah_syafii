<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/kelola_data_guru.css') }}?v={{ time() }}">
</head>
<body>

<div class="dashboard-container">
    <!-- TEMPAT SIDEBAR -->
    <x-sidebar_guru />

    <!-- MAIN CONTENT (membawa data dari session/Blade untuk dibaca JS) -->
    <main class="main-wrapper"
          id="appConfig"
          data-admin="{{ session('role') == 'a' ? '1' : '0' }}"
          data-foto-url="{{ route('file.show', ['path' => '__PATH__']) }}"
          data-foto-default="{{ asset('img/logo_sklh.png') }}">

        <!-- TOPBAR HEADER -->
        @if (session("role") == "a")
            <header class="topbar">
                <div class="topbar-title">
                    <div class="title-with-date">
                        <h2>Kelola Data Guru</h2>
                        <span class="date-badge">
                            <i class="fa-regular fa-calendar-days"></i>
                            <span id="currentDateText">Loading...</span>
                        </span>
                    </div>
                    <p>Kelola data induk, status keaktifan, dan informasi pengajar</p>
                </div>
            </header>
        @else
            <header class="topbar">
                <div class="topbar-title">
                    <div class="title-with-date">
                        <h2>Jadwal Piket Guru</h2>
                        <span class="date-badge">
                            <i class="fa-regular fa-calendar-days"></i>
                            <span id="currentDateText">Loading...</span>
                        </span>
                    </div>
                    <p>Kelola Dan Atur Jadwal Piket Guru</p>
                </div>
            </header>
        @endif

        <!-- CARD KATEGORI -->
        <section class="card category-card">
            <div class="category-tabs" id="categoryTabs">
                <button type="button" class="category-tab active" data-kategori="guru">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Guru</span>
                </button>
                <button type="button" class="category-tab" data-kategori="bendahara">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Bendahara</span>
                </button>
                <button type="button" class="category-tab" data-kategori="satpam">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Satpam</span>
                </button>
                <button type="button" class="category-tab" data-kategori="operator">
                    <i class="fa-solid fa-computer"></i>
                    <span>Operator</span>
                </button>
            </div>
        </section>

        <!-- CARD FILTER -->
        <section class="card filter-card">
            <form action="#" method="GET" class="filter-form" id="filterForm">
                <div class="form-group">
                    <label for="searchGuru">Cari Nama Guru / NIG</label>
                    <div class="input-icon-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchGuru" name="search" placeholder="Masukkan nama atau NIG guru..." autocomplete="off">
                    </div>
                </div>

                <div class="filter-actions">
                    <button type="submit" class="btn-filter">
                        <i class="fa-solid fa-filter"></i>
                        <span>Tampilkan</span>
                    </button>
                    <button type="button" class="btn-reset" id="btnResetFilter">
                        <i class="fa-solid fa-rotate-right"></i>
                        <span>Reset</span>
                    </button>
                </div>
            </form>
        </section>

        <!-- CARD TABEL DATA GURU -->
        <section class="card table-card">
            <div class="card-header">
                <h3>Daftar Tenaga Pengajar</h3>
                <span class="total-badge" id="totalBadge">Total: 0 Guru</span>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Guru</th>
                            @if (session("role") == "a")
                                <th>NIG</th>
                                <th>Kode Identitas</th>
                                <th>Jenis Sekolah</th>
                            @endif
                            <th class="text-center">Status</th>
                            <th class="text-center" width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="guruTableBody">
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<!-- MODAL KONFIRMASI NONAKTIFKAN GURU -->
<div class="modal-overlay" id="deactivateModal">
    <div class="modal-card">
        <div class="modal-icon warning">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div class="modal-body">
            <h3>Konfirmasi Nonaktifkan</h3>
            <p>Apakah Anda yakin ingin menonaktifkan akun guru <strong id="modalTeacherName">-</strong>?</p>
            <p class="modal-subtext">Guru yang dinonaktifkan tidak akan memiliki akses lagi ke sistem EduHRIS.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" id="btnCancelModal">Batal</button>
            <button type="button" class="btn-modal-confirm" id="btnConfirmDeactivate">Ya, Nonaktifkan</button>
        </div>
    </div>
</div>
<x-warning />

<!-- JAVASCRIPT LOGIC (tanpa sintaks Blade) -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    // --- Ambil konfigurasi dari atribut data-* di HTML ---
    const config = document.getElementById('appConfig').dataset;
    const isAdmin = config.admin === '1';
    const fotoTemplate = config.fotoUrl;
    const fotoDefault = config.fotoDefault;
    const colspan = isAdmin ? 7 : 4;

    // --- Helper ---
    const esc = s => String(s ?? '').replace(/[&<>"']/g, c => (
        { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]
    ));

    // --- Elemen utama ---
    const tempat = document.getElementById('guruTableBody');
    const totalBadge = document.getElementById('totalBadge');
    const categoryTabs = document.querySelectorAll('.category-tab');
    const filterForm = document.getElementById('filterForm');
    const searchInput = document.getElementById('searchGuru');
    const btnReset = document.getElementById('btnResetFilter');
    const modal = document.getElementById('deactivateModal');
    const modalTeacherName = document.getElementById('modalTeacherName');
    const btnCancelModal = document.getElementById('btnCancelModal');
    const btnConfirmDeactivate = document.getElementById('btnConfirmDeactivate');

    let activeCategory = 'guru';
    let selectedId = null;

    // --- 1. Tanggal otomatis ---
    document.getElementById('currentDateText').textContent =
        new Date().toLocaleDateString('id-ID', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });

    // --- 2. Tampilkan data per kategori ---
    function tampilkanData(kategori) {
        const label = kategori.charAt(0).toUpperCase() + kategori.slice(1);
        tempat.innerHTML = `<tr><td colspan="${colspan}" class="text-center">Memuat data...</td></tr>`;

        fetch(`/gr/ambgr/${kategori}`, { headers: { 'Accept': 'application/json' } })
            .then(res => {
                if (!res.ok) throw new Error('Gagal Ambil Data');
                return res.json();
            })
            .then(data => {
                tempat.innerHTML = '';

                if (!data || data.length === 0) {
                    tempat.innerHTML = `<tr><td colspan="${colspan}" class="text-center">Belum ada data</td></tr>`;
                    totalBadge.textContent = `Total: 0 ${label}`;
                    return;
                }

                totalBadge.textContent = `Total: ${data.length} ${label}`;

                const rows = data.map((item, i) => {
                    const user = item.get_user ?? {};
                    const aktif = !!user.aktif;
                    const fotoUrl = item.url_foto
                        ? fotoTemplate.replace('__PATH__', item.url_foto)
                        : fotoDefault;

                    const kolomAdmin = isAdmin ? `
                        <td><span class="nig-badge">${esc(item.nig)}</span></td>
                        <td><span class="nig-badge">${esc(user.identitas?.identitas ?? '-')}</span></td>
                        <td><span class="school-tag sma">${esc(item.get_sekolah?.jenis ?? '-')}</span></td>
                    ` : '';

                    const emailHtml = isAdmin ? `<small>${esc(user.email ?? '-')}</small>` : '';

                    const tombolNonaktif = isAdmin ? `
                        <button type="button" class="btn-action btn-deactivate btn-trigger-modal"
                                title="Nonaktifkan Guru" data-akun-guru="${esc(user.id)}">
                            <i class="fa-solid fa-user-xmark"></i>
                        </button>` : '';

                    const aksi = aktif
                        ? `<a href="/gr/edgr/${esc(item.id)}" class="btn-action btn-edit" title="Edit Data">
                               <i class="fa-solid fa-pen-to-square"></i>
                           </a>${tombolNonaktif}`
                        : `<button type="button" class="btn-action btn-deactivate" title="Guru Sudah Non-Aktif" disabled>
                               <i class="fa-solid fa-user-xmark"></i>
                           </button>`;

                    const status = aktif
                        ? `<span class="status-badge status-active"><i class="fa-solid fa-circle-check"></i> Aktif</span>`
                        : `<span class="status-badge status-inactive"><i class="fa-solid fa-circle-xmark"></i> Non Aktif</span>`;

                    return `
                        <tr data-id="${esc(item.id)}" data-nama="${esc(item.nama)}">
                            <td>${i + 1}</td>
                            <td>
                                <div class="teacher-profile">
                                    <div class="avatar-circle">
                                        <img src="${fotoUrl}" alt="" onerror="this.onerror=null;this.src='${fotoDefault}'">
                                    </div>
                                    <div class="teacher-detail">
                                        <strong>${esc(item.nama)}</strong>
                                        ${emailHtml}
                                    </div>
                                </div>
                            </td>
                            ${kolomAdmin}
                            <td class="text-center">${status}</td>
                            <td class="text-center"><div class="action-buttons">${aksi}</div></td>
                        </tr>`;
                });

                tempat.innerHTML = rows.join('');
            })
            .catch(err => {
                console.error(err);
                tempat.innerHTML = `<tr><td colspan="${colspan}" class="text-center">Gagal memuat data</td></tr>`;
            });
    }

    // --- 3. Tab kategori ---
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function () {
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.dataset.kategori;
            searchInput.value = '';
            tampilkanData(activeCategory);
        });
    });

    tampilkanData(activeCategory);

    // --- 4. Filter pencarian (baris diambil saat dijalankan, bukan saat load) ---
    function terapkanFilter() {
        const query = searchInput.value.toLowerCase().trim();
        tempat.querySelectorAll('tr[data-id]').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(query) ? '' : 'none';
        });
    }

    filterForm.addEventListener('submit', function (e) {
        e.preventDefault();
        terapkanFilter();
    });

    btnReset.addEventListener('click', function () {
        searchInput.value = '';
        terapkanFilter();
    });

    // --- 5. Modal nonaktifkan (event delegation di tbody) ---
    tempat.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-trigger-modal');
        if (!btn || btn.disabled) return;

        const row = btn.closest('tr');
        selectedId = btn.dataset.akunGuru;
        modalTeacherName.textContent = row.dataset.nama;
        modal.classList.add('active');
    });

    function closeModal() {
        modal.classList.remove('active');
        selectedId = null;
    }

    btnCancelModal.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    // --- 6. Konfirmasi nonaktifkan (satu handler saja) ---
    btnConfirmDeactivate.addEventListener('click', function () {
        if (selectedId) {
            window.location.href = "/reg/nakt/" + parseInt(selectedId, 10);
        }
    });
});
</script>

</body>
</html>
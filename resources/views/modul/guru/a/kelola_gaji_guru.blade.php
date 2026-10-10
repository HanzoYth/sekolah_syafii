<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Gaji Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/gaji_guru.css') }}?v={{ time() }}">
</head>
<body>

<div class="dashboard-container">
    <!-- TEMPAT SIDEBAR -->
    <x-sidebar_guru />

    <!-- MAIN CONTENT -->
    <main class="main-wrapper">
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-title">
                <div class="title-with-date">
                    <h2>Kelola Gaji Pegawai</h2>
                    <span class="date-badge">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span id="currentDateText">Loading...</span>
                    </span>
                </div>
                <p>Kelola rincian honorarium, tunjangan, dan rekapitulasi penggajian guru & staf</p>
            </div>
        </header>

        <!-- NODE / TAB ROLE SELECTION -->
        <div class="role-tabs-container">
            <button type="button" class="role-tab active" data-name = "guru">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Guru</span>
            </button>
            <button type="button" class="role-tab" data-name="bendahara">
                <i class="fa-solid fa-file-invoice-dollar"></i>
                <span>Bendahara</span>
            </button>
            <button type="button" class="role-tab" data-name="operator">
                <i class="fa-solid fa-headset"></i>
                <span>Operator</span>
            </button>
            <button type="button" class="role-tab" data-name="satpam">
                <i class="fa-solid fa-user-shield"></i>
                <span>Satpam</span>
            </button>
        </div>

        <!-- CARD FILTER -->
        <section class="card filter-card">
            <form action="#" method="GET" class="filter-form" id="filterForm">
                <div class="form-group">
                    <label for="searchGuru">Cari Nama / NIG</label>
                    <div class="input-icon-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchGuru" name="search" placeholder="Masukkan nama atau NIG..." autocomplete="off">
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

        <!-- CARD TABEL DATA GAJI GURU -->
        <section class="card table-card">
            <div class="card-header">
                <div class="header-left">
                    <h3>Daftar Penggajian</h3>
                    <span class="total-badge">Total: {{ count($data_guru) }} Data</span>
                </div>
                <!-- TOMBOL RESET DATA GAJI -->
                <button type="button" class="btn-reset-data" id="btnOpenResetDataModal">
                    <i class="fa-solid fa-trash-arrow-up"></i>
                    <span>Reset Data Gaji</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Pegawai</th>
                            <th>NIG</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Total Gaji</th>
                            <th class="text-center">Status Bayar</th>
                            <th class="text-center" width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="guruTableBody">
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<x-warning />

<!-- MODAL POP-UP PUBLISH -->
<div class="modal-overlay" id="publishModal">
    <div class="modal-box">
        <div class="modal-icon-wrapper icon-publish" id="modalIcon">
            <i class="fa-solid fa-upload"></i>
        </div>
        <h4 id="modalTitle">Konfirmasi Publish</h4>
        <p id="modalDescription">Apakah Anda yakin ingin mempublikasikan slip gaji ini?</p>
        
        <div class="modal-actions">
            <button type="button" class="modal-btn modal-btn-cancel" id="btnCancelModal">Batal</button>
            <button type="button" class="modal-btn modal-btn-confirm" id="btnConfirmModal">Ya, Lanjutkan</button>
        </div>
    </div>
</div>

<!-- MODAL POP-UP RESET DATA GAJI -->
<div class="modal-overlay" id="resetDataModal">
    <div class="modal-box">
        <div class="modal-icon-wrapper icon-unpublish">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <h4>Reset Seluruh Data Gaji?</h4>
        <p>Tindakan ini akan mengosongkan atau mengembalikan seluruh hitungan data gaji guru ke pengaturan awal. Apakah Anda yakin?</p>
        
        <div class="modal-actions">
            <button type="button" class="modal-btn modal-btn-cancel" id="btnCancelResetModal">Batal</button>
            <button type="button" class="modal-btn modal-btn-confirm btn-danger" id="btnConfirmResetModal">Ya, Reset Data</button>
        </div>
    </div>
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- 1. TAMPILKAN TANGGAL OTOMATIS ---
        const dateElement = document.getElementById('currentDateText');
        const today = new Date();
        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
        dateElement.textContent = today.toLocaleDateString('id-ID', options);

        // --- 2. LOGIC FILTER DATA GAJI GURU ---
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchGuru');
        const btnReset = document.getElementById('btnResetFilter');
        const tableRows = document.querySelectorAll('#guruTableBody tr');

        filterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.toLowerCase().trim();

            tableRows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        btnReset.addEventListener('click', function() {
            searchInput.value = '';
            tableRows.forEach(row => row.style.display = '');
        });

        let defaultName = "guru";

        // --- 3. SWITCHER STATUS TAB ROLE (VISUAL Saja) ---
        const roleTabs = document.querySelectorAll('.role-tab');
        roleTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                roleTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                changeDataGaji(this.dataset.name);
            }); 
        });

        const tempat = document.getElementById("guruTableBody");
        function changeDataGaji(name){
            
            tempat.innerHTML = ''; // kosongkan dulu supaya tidak menumpuk

            const rupiah = angka => 'Rp ' + Number(angka).toLocaleString('id-ID');

            fetch(`/gr/ambgjgr/${name}`)
            .then(res => {
                if (!res.ok) throw new Error("gagal ambil data");
                return res.json();
            })
            .then(data => {
                if (!data || data.length == 0){
                    tempat.innerHTML = `<tr><td colspan="8" class="text-center">Belum ada data</td></tr>`;
                    return;
                }

                let no = 0;
                data.forEach(item => {
                    const g = item.get_gaji || {};
                    const fotoUrl = "{{ route('file.show', ['path' => '__PATH__']) }}"
                        .replace('__PATH__', item.url_foto);
                    const slipUrl = "{{ route('Slipgaji.guru', ['id' => '__PATH__']) }}"
                        .replace('__PATH__', item.id);
                    no++;

                    const n = v => Number(v) || 0; // string "1000000.00" / null -> angka


                    let jumlah_tunjangan_potongan = 0;

                    (item.get_tunjangan_potongan || []).forEach(value => {
                        jumlah_tunjangan_potongan += value.nominal;
                    });

                    const gajiPokok = n(g.gaji_pokok);
                    const selisih = n(g.gaji_honor) + n(g.gaji_tugas_tambahan) + n(g.gaji_tambahan) + n(g.bonus)
                                - n(g.potongan_tidak_hadir) - n(g.potongan_keterlambatan) - n(g.kasbon) - jumlah_tunjangan_potongan;

                    let totalGaji = selisih > 0 ? gajiPokok + selisih : gajiPokok;

                    let totalTunjangan = 0;
                    (item.get_tunjangan || []).forEach(value => {
                        totalTunjangan += n(value.nominal);
                    });
                    totalGaji += totalTunjangan;

                    let newData = `
                        <tr data-id="${item.id}" data-nama="${item.nama}">
                            <td>${no}</td>
                            <td>
                                <div class="teacher-profile">
                                    <div class="avatar-circle">
                                        <img src="${fotoUrl}" alt="${item.nama}">
                                    </div>
                                    <div class="teacher-detail">
                                        <strong>${item.nama}</strong>
                                        <small>${item.get_user?.email ?? '-'}</small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="nig-badge">${item.nig}</span></td>
                            <td>${rupiah(gajiPokok)}</td>
                            <td>${rupiah(totalTunjangan)}</td>
                            <td><strong>${rupiah(totalGaji)}</strong></td>
                            <td class="text-center">
                                ${
                                    g.publish
                                    ? `<span class="status-badge status-active">
                                        <i class="fa-solid fa-circle-check"></i> Publish
                                    </span>`
                                    : `<span class="status-badge status-pending">
                                        <i class="fa-solid fa-clock"></i> Pending
                                    </span>`
                                }
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    ${
                                        !g.publish
                                        ? `<button type="button" class="btn-action btn-publish" data-id="${item.id}" title="publish gaji">
                                            <i class="fa-solid fa-upload"></i>
                                        </button>
                                        <a href="/gr/edgjgr/${item.id}" class="btn-action btn-edit" title="Edit Gaji">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>`
                                        : ``
                                    }
                                    <a href="${slipUrl}" target="_blank" class="btn-action btn-print" title="Cetak Slip Gaji">
                                        <i class="fa-solid fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    `;
                    tempat.insertAdjacentHTML('beforeend', newData);
                });
            })
            .catch(err => {
                console.error(err);
            });
        }

        changeDataGaji(defaultName);



        // --- 4. LOGIC POP-UP MODAL PUBLISH SLIP GAJI ---
        const publishButtons = document.querySelectorAll('.btn-publish');
        const publishModal = document.getElementById('publishModal');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const btnConfirmModal = document.getElementById('btnConfirmModal');

        let activeTargetButton = null;

        tempat.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-publish');

            if (!btn) return;

            activeTargetButton = btn;
            publishModal.classList.add('active');
        });

        btnConfirmModal.addEventListener('click', function() {
            if (!activeTargetButton) return;
            window.location.href = "/gr/pbgjgr/" + parseInt(activeTargetButton.dataset.id);
            closePublishModal();
        });

        function closePublishModal() {
            publishModal.classList.remove('active');
            activeTargetButton = null;
        }

        btnCancelModal.addEventListener('click', closePublishModal);

        publishModal.addEventListener('click', function(e) {
            if (e.target === publishModal) {
                closePublishModal();
            }
        });

        // --- 5. LOGIC POP-UP MODAL RESET DATA GAJI ---
        const btnOpenResetDataModal = document.getElementById('btnOpenResetDataModal');
        const resetDataModal = document.getElementById('resetDataModal');
        const btnCancelResetModal = document.getElementById('btnCancelResetModal');
        const btnConfirmResetModal = document.getElementById('btnConfirmResetModal');

        btnOpenResetDataModal.addEventListener('click', function() {
            resetDataModal.classList.add('active');
        });

        btnConfirmResetModal.addEventListener('click', function() {
            window.location.href = "/gr/rstgj"; 
        });

        function closeResetModal() {
            resetDataModal.classList.remove('active');
        }

        btnCancelResetModal.addEventListener('click', closeResetModal);

        resetDataModal.addEventListener('click', function(e) {
            if (e.target === resetDataModal) {
                closeResetModal();
            }
        });
    }); 
</script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/kelola_data_guru.css') }}">
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
                    <h2>Kelola Data Guru</h2>
                    <span class="date-badge">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span id="currentDateText">Loading...</span>
                    </span>
                </div>
                <p>Kelola data induk, status keaktifan, dan informasi pengajar</p>
            </div>
        </header>

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
                <span class="total-badge">Total: 4 Guru</span>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Guru</th>
                            <th>NIG</th>
                            <th>Jenis Sekolah</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="guruTableBody">
                        <!-- BARIS 1 -->
                         @foreach ($data_guru as $value)
                         @php
                            $data_akun = App\Models\akun::find((int) $value->user_id);
                            $jenis_sekolah = App\Models\jenis_sekolah::find((int) $value->sekolah_id);
                         @endphp
                            <tr data-id="{{$value->id}}" data-nama="{{$value->nama}}">
                                <td>1</td>
                                <td>
                                    <div class="teacher-profile">
                                        <div class="avatar-circle">AD</div>
                                        <div class="teacher-detail">
                                            <strong>{{$value->nama}}</strong>
                                            <small>{{$data_akun->email}}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="nig-badge">{{$value->nig}}</span></td>
                                <td><span class="school-tag sma">{{$jenis_sekolah->jenis}}</span></td>
                                <td class="text-center">
                                    @if ($data_akun->aktif)
                                    <span class="status-badge status-active">
                                        <i class="fa-solid fa-circle-check"></i> Aktif
                                    </span>
                                    @else
                                        <span class="status-ba  dge status-inactive">
                                            <i class="fa-solid fa-circle-check"></i> Non Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <a href="/gr/edgr/{{$value->id}}" class="btn-action btn-edit" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn-action btn-deactivate btn-trigger-modal" title="Nonaktifkan Guru">
                                            <i class="fa-solid fa-user-xmark"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>

<!-- MODAL CONFIRMATION NONAKTIFKAN GURU -->
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
            <button class="btn-modal-cancel" id="btnCancelModal">Batal</button>
            <button class="btn-modal-confirm" id="btnConfirmDeactivate">Ya, Nonaktifkan</button>
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

        // --- 2. LOGIC FILTER DATA GURU ---
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

        // --- 3. LOGIC MODAL KONFIRMASI NONAKTIFKAN ---
        const modal = document.getElementById('deactivateModal');
        const modalTeacherName = document.getElementById('modalTeacherName');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const btnConfirmDeactivate = document.getElementById('btnConfirmDeactivate');
        let selectedRow = null;

        // Buka modal saat tombol nonaktifkan diklik
        document.querySelectorAll('.btn-trigger-modal').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                selectedRow = row;
                const teacherName = row.getAttribute('data-nama');
                
                modalTeacherName.textContent = teacherName;
                modal.classList.add('active');
            });
        });

        // Tutup Modal
        function closeModal() {
            modal.classList.remove('active');
            selectedRow = null;
        }

        btnCancelModal.addEventListener('click', closeModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });

        // Eksekusi Nonaktifkan Guru
        btnConfirmDeactivate.addEventListener('click', function() {
            if (selectedRow) {
                const statusCell = selectedRow.querySelector('.status-badge');
                const actionBtn = selectedRow.querySelector('.btn-trigger-modal');

                // Ubah Tampilan Status secara langsung
                statusCell.className = 'status-badge status-inactive';
                statusCell.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> Non-Aktif';

                // Disable tombol nonaktifkan
                actionBtn.classList.remove('btn-trigger-modal');
                actionBtn.disabled = true;
                actionBtn.title = "Guru Sudah Non-Aktif";

                closeModal();
            }
        });
    });
</script>

</body>
</html>
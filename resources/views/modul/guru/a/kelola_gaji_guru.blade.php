<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Gaji Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/gaji_guru.css') }}">
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
                    <h2>Kelola Gaji Guru</h2>
                    <span class="date-badge">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span id="currentDateText">Loading...</span>
                    </span>
                </div>
                <p>Kelola rincian honorarium, tunjangan, dan rekapitulasi penggajian guru</p>
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

        <!-- CARD TABEL DATA GAJI GURU -->
        <section class="card table-card">
            <div class="card-header">
                <h3>Daftar Penggajian Guru</h3>
                <span class="total-badge">Total: 1.000.000 Data</span>
            </div>

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Guru</th>
                            <th>NIG</th>
                            <th>Gaji Pokok</th>
                            <th>Tunjangan</th>
                            <th>Total Gaji</th>
                            <th class="text-center">Status Bayar</th>
                            <th class="text-center" width="180">Aksi</th>
                        </tr>
                    </thead>
                    @php
                        $index = 0;
                    @endphp
                    <tbody id="guruTableBody">
                        @foreach ($data_guru as $value)
                            @php
                                $data_akun = App\Models\akun::where("id",$value->user_id)->first();
                                $data_gaji = App\Models\gaji::where("guru_id",$value->id)->first();
                                $cek_tunjangan = App\Models\tunjangan::where("guru_id",$value->id)->exists();
                                $total_tunjangan = 0;
                                $total_gaji =  $data_gaji->gaji_pokok + $data_gaji->gaji_honor + $data_gaji->gaji_tugas_tambahan + $data_gaji->gaji_tambahan + $data_gaji->bonus - $data_gaji->potongan_tidak_hadir - $data_gaji->potongan_keterlambatan - $data_gaji->kasbon;
                                if ($cek_tunjangan) {
                                    $hasil = App\Models\tunjangan::where("guru_id",$value->id)->sum("nominal");
                                    $total_tunjangan += $hasil;
                                    $total_gaji += $total_tunjangan;
                                }
                            @endphp
                            <tr data-id="{{ $value->id }}" data-nama="{{ $value->nama }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="teacher-profile">
                                        <div class="avatar-circle">
                                            <img src="{{route('file.show',$value->url_foto)}}" alt="{{ $value->nama }}">
                                        </div>
                                        <div class="teacher-detail">
                                            <strong>{{ $value->nama }}</strong>
                                            <small>{{ $data_akun->email ?? '-' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="nig-badge">{{ $value->nig }}</span></td>
                                <td>Rp {{ number_format(max(0, $data_gaji->gaji_pokok ?? 0), 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($total_tunjangan, 0, ',', '.') }}</td>
                                <td><strong>Rp {{ number_format(max(0, $total_gaji ?? 0), 0, ',', '.') }}</strong></td>
                                <td class="text-center">
                                    @if ($data_gaji && $data_gaji->publish)
                                        <span class="status-badge status-active">
                                            <i class="fa-solid fa-circle-check"></i> Publish
                                        </span>
                                    @else
                                        <span class="status-badge status-pending">
                                            <i class="fa-solid fa-clock"></i> Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        @if (!$data_gaji->publish)
                                            <!-- TOMBOL PUBLISH GAJI -->
                                            <button type="button" 
                                                    class="btn-action btn-publish {{ ($data_gaji && $data_gaji->publish) ? 'published' : '' }}" 
                                                    data-id="{{ $value->id }}" 
                                                    title="publish gaji">
                                                <i class="fa-solid {{ ($data_gaji && $data_gaji->publish) ? 'fa-paper-plane' : 'fa-upload' }}"></i>
                                            </button>

                                            <!-- TOMBOL EDIT GAJI -->
                                            <a href="/gr/edgjgr/{{ $value->id }}" class="btn-action btn-edit" title="Edit Gaji">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif

                                        <!-- TOMBOL PRINT SLIP GAJI -->
                                        <a href="{{route('Slipgaji.guru',$value->id)}}" target="_blank" class="btn-action btn-print" title="Cetak Slip Gaji">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
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

<!-- COMPONENT MODAL POP-UP -->
<div class="modal-overlay" id="publishModal">
    <div class="modal-box">
        <div class="modal-icon-wrapper" id="modalIcon">
            <i class="fa-solid fa-upload"></i>
        </div>
        <h4 id="modalTitle">Konfirmasi Publish</h4>
        <p id="modalDescription">Apakah Anda yakin ingin mempublikasikan slip gaji ini?</p>
        
        <div class="modal-actions">
            <button type="button" class="modal-btn modal-btn-cancel" id="btnCancelModal">Batal</button>
            <button type="button" class="modal-btn modal-btn-confirm" id="btnConfirmModal" >Ya, Lanjutkan</button>
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

        // --- 3. LOGIC POP-UP MODAL PUBLISH SLIP GAJI ---
        const publishButtons = document.querySelectorAll('.btn-publish');
        const publishModal = document.getElementById('publishModal');
        const modalIcon = document.getElementById('modalIcon');
        const modalTitle = document.getElementById('modalTitle');
        const modalDescription = document.getElementById('modalDescription');
        const btnCancelModal = document.getElementById('btnCancelModal');
        const btnConfirmModal = document.getElementById('btnConfirmModal');

        let activeTargetButton = null;

        // Buka Pop-up & Atur Konten
        publishButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                activeTargetButton = this;

                publishModal.classList.add('active');
            });
        });

        // Terapkan perubahan setelah klik Konfirmasi di Pop-up
        btnConfirmModal.addEventListener('click', function() {
            if (!activeTargetButton) return;

            window.location.href = "/gr/pbgjgr/"+parseInt(activeTargetButton.dataset.id)
            // Tutup Modal
            closeModal();
        });

        // Fungsi Tutup Modal
        function closeModal() {
            publishModal.classList.remove('active');
            activeTargetButton = null;
        }

        btnCancelModal.addEventListener('click', closeModal);

        // Tutup jika overlay luar di-klik
        publishModal.addEventListener('click', function(e) {
            if (e.target === publishModal) {
                closeModal();
            }
        });
    }); 
</script>

</body>
</html>
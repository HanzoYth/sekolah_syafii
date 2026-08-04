<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Absensi Guru - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/kelola_absen_guru.css') }}">
</head>
<body>

<div class="dashboard-container">
    <!-- Include Sidebar -->
    <x-sidebar_guru />

    <main class="absen-wrapper">
        <!-- TOPBAR HEADER -->
        <header class="topbar">
            <div class="topbar-title">
                <div class="title-with-date">
                    <h2>Kelola Absensi Guru</h2>
                    <!-- BADGE TANGGAL DITAMBAHKAN DI SINI -->
                    <span class="date-badge" id="currentDateBadge">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span id="currentDateText">Loading tanggal...</span>
                    </span>
                </div>
                <p>Catat dan kelola kehadiran harian seluruh tenaga pengajar</p>
            </div>
            <!-- TOMBOL AKSI MASSAL -->
            <button type="button" class="btn-bulk-present" id="btnAllPresent">
                <i class="fa-solid fa-user-check"></i>
                <span>Tandai Semua Hadir</span>
            </button>
        </header>

        <!-- SEARCH & DATA CARD -->
        <section class="card">
            <div class="card-header">
                <h3>Daftar Absensi Guru</h3>
                
                <!-- INPUT CARI NAMA GURU (Bukan form lagi, cukup div biasa) -->
                <div class="search-form">
                    <div class="search-input-wrapper">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchGuru" placeholder="Cari nama guru..." autocomplete="off">
                    </div>
                    <button type="button" class="btn-search">
                        <span>Search</span>
                    </button>
                </div>
            </div>

            <!-- FORM UNTUK MENYIMPAN PERUBAHAN ABSENSI -->
            <form action="/gr/keabs/" method="POST">
                @csrf
                
                <!-- TABEL ABSENSI -->
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIG</th>
                                <th>Nama Guru</th>
                                <th>Cabang</th>
                                <th class="text-center">Status Kehadiran (Aksi)</th>
                            </tr>
                        </thead>
                        <tbody id="absenTableBody">
                            @foreach ($data_guru as $value)
                                @php
                                    $data_absen_guru = App\Models\master_absen_guru::where("tgl_masuk",Carbon\Carbon::now()->translatedFormat("Y-m-d"))->where("guru_id",$value->id)->first();
                                    $cabang = App\Models\cabang_guru::where("id",$value->cabang_id)->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="nig-badge">{{$value->nig}}</span></td>
                                    <td class="teacher-name">
                                        <strong>{{$value->nama}}</strong>
                                    </td>
                                    <td><span class="branch-tag">{{$cabang->nama_cabang}}</span></td>
                                    @if (in_array($value->id,$data_absen_id_guru))
                                        @if ($data_absen_guru->status_kehadiran == "h")
                                            <td class="text-center">
                                                <div class="select-presence-wrapper">
                                                    <select class="select-presence status-hadir" name="status">
                                                        <option value="h" selected>Hadir</option>
                                                        <option value="i">Izin</option>
                                                        <option value="s">Sakit</option>
                                                        <option value="a">Alpa</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @elseif ($data_absen_guru->status_kehadiran == "s")
                                            <td class="text-center">
                                                <div class="select-presence-wrapper">
                                                    <select class="select-presence status-hadir" name="status">
                                                        <option value="h">Hadir</option>
                                                        <option value="i">Izin</option>
                                                        <option value="s" selected>Sakit</option>
                                                        <option value="a">Alpa</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @elseif ($data_absen_guru->status_kehadiran == "i")
                                            <td class="text-center">
                                                <div class="select-presence-wrapper">
                                                    <select class="select-presence status-hadir" name="status">
                                                        <option value="h">Hadir</option>
                                                        <option value="i" selected>Izin</option>
                                                        <option value="s">Sakit</option>
                                                        <option value="a">Alpa</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @else 
                                            <td class="text-center">
                                                <div class="select-presence-wrapper">
                                                    <select class="select-presence status-hadir" name="status">
                                                        <option value="h">Hadir</option>
                                                        <option value="i">Izin</option>
                                                        <option value="s">Sakit</option>
                                                        <option value="a" selected>Alpa</option>
                                                    </select>
                                                </div>
                                            </td>
                                        @endif
                                    @else
                                        <td class="text-center">
                                            <div class="select-presence-wrapper">
                                                <select class="select-presence status-hadir" name="status">
                                                    <option value="h">Hadir</option>
                                                    <option value="i">Izin</option>
                                                    <option value="s">Sakit</option>
                                                    <option value="a" selected>Alpa</option>
                                                </select>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn-save-attendance">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan Absensi</span>
                    </button>
                </div>
            </form>
        </section>
    </main>
</div>

<!-- JAVASCRIPT UTILS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnAllPresent = document.getElementById('btnAllPresent');
        const selectElements = document.querySelectorAll('.select-presence');
        const searchInput = document.getElementById('searchGuru');
        const tableRows = document.querySelectorAll('#absenTableBody tr');

        // --- FUNGSI FORMAT & TAMPILKAN TANGGAL OTOMATIS ---
        function renderCurrentDate() {
            const dateElement = document.getElementById('currentDateText');
            const today = new Date();
            
            const options = { 
                weekday: 'long', 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric' 
            };
            
            const formattedDate = today.toLocaleDateString('id-ID', options);
            dateElement.textContent = formattedDate;
        }

        renderCurrentDate();

        // Fungsi mengubah warna berdasarkan opsi yang dipilih
        function updateSelectStyle(select) {
            select.classList.remove('status-hadir', 'status-izin', 'status-sakit', 'status-alpa', 'status-h', 'status-i', 'status-s', 'status-a');
            select.classList.add(`status-${select.value}`);
        }

        // Listener ubah warna saat select diganti
        selectElements.forEach(select => {
            updateSelectStyle(select);
            select.addEventListener('change', function() {
                updateSelectStyle(this);
            });
        });

        // Tombol Ubah Semua Kehadiran ke 'Hadir'
        btnAllPresent.addEventListener('click', function () {
            selectElements.forEach(select => {
                select.value = 'h';
                updateSelectStyle(select);
            });
        });

        // Pencarian Nama Guru secara Real-time
        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase();

            tableRows.forEach(row => {
                const nameText = row.querySelector('.teacher-name').innerText.toLowerCase();
                const nigText = row.querySelector('.nig-badge').innerText.toLowerCase();

                if (nameText.includes(query) || nigText.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

</body>
</html> 
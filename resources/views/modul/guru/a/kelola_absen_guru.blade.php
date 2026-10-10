<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Absensi Pegawai - EduHRIS</title>
    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/modul/guru/kelola_absen_guru.css') }}?v={{ time() }}">
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
                    <h2>Kelola Absensi Pegawai</h2>
                    <span class="date-badge" id="currentDateBadge">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span id="currentDateText">Loading tanggal...</span>
                    </span>
                </div>
                <p>Catat dan kelola kehadiran harian seluruh staf dan tenaga pengajar</p>
            </div>
            <!-- TOMBOL AKSI MASSAL -->
            <button type="button" class="btn-bulk-present" id="btnAllPresent">
                <i class="fa-solid fa-user-check"></i>
                <span>Tandai Semua Hadir</span>
            </button>
        </header>

        <!-- NODE / TAB ROLE SELECTION -->
        <div class="role-tabs-container">
            <button type="button" class="role-tab active" data-name ="guru">
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

        <!-- SEARCH & DATA CARD -->
        <section class="card">
            <div class="card-header">
                <h3>Daftar Absensi Guru</h3>
                
                <!-- INPUT CARI NAMA GURU -->
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
            <form action="/gr/keabs" method="POST">
                @csrf
                
                <!-- TABEL ABSENSI -->
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru</th>
                                <th>Kehadiran</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Cabang</th>
                                <th class="text-center">Status Kehadiran (Aksi)</th>
                            </tr>
                        </thead>
                        <tbody id="absenTableBody">
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

<x-warning />

<!-- JAVASCRIPT UTILS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnAllPresent = document.getElementById('btnAllPresent');
        const selectElements = document.querySelectorAll('.select-presence');
        const searchInput = document.getElementById('searchGuru');
        const tableRows = document.querySelectorAll('#absenTableBody tr');
        const roleTabs = document.querySelectorAll('.role-tab');

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

        let dafaultName = "guru";

        // Switcher state sederhana untuk visual tab role (tanpa PHP)
        roleTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                roleTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                changeData(this.dataset.name);
            });
        });

function changeData(name){
    fetch(`/gr/ambabgr/${name}`)
    .then(res => {
        if (!res.ok) throw new Error("Gagal Ambil Data");
        return res.json();
    })
    .then(data => {
        let tempat = document.getElementById("absenTableBody");
        tempat.innerHTML = '';

        if (!data || data.length == 0){
            tempat.innerHTML = `<tr><td colspan="7" class="text-center">Belum ada data</td></tr>`;
            return;
        }

        const tanggal = new Date().toLocaleDateString('en-CA'); // YYYY-MM-DD, waktu lokal
        let no = 0;

        data.forEach(item => {
            no++;
            let jumlah_kehadiran = 0;
            let jumlah_izin = 0;
            let jumlah_sakit = 0;

            item.get_absen.forEach(value => {
                if (value.status_kehadiran == "h") jumlah_kehadiran++;
                if (value.status_kehadiran == "i") jumlah_izin++;
                if (value.status_kehadiran == "s") jumlah_sakit++;
            });

            // absen hari ini (kalau ada)
            const absenHariIni = item.get_absen.find(v => v.tgl_masuk == tanggal);
            const status = absenHariIni ? absenHariIni.status_kehadiran : 'n';
            const sel = v => status == v ? 'selected' : '';
            // status selain h/i/s (mis. "a") jatuh ke "--tidak ada pilihan--"
            const selN = ['h','i','s'].includes(status) ? '' : 'selected';

            let new_data = `
                <tr>
                    <td>
                        <input type="hidden" value="${item.id}" name="id_guru_${item.id}">
                        ${no}
                    </td>
                    <td class="teacher-name">
                        <strong>${item.nama}</strong>
                    </td>
                    <td><span class="nig-badge">${jumlah_kehadiran}</span></td>
                    <td><span class="nig-badge">${jumlah_izin}</span></td>
                    <td><span class="nig-badge">${jumlah_sakit}</span></td>
                    <td><span class="branch-tag">${item.get_cabang.nama_cabang}</span></td>
                    <td class="text-center">
                        <div class="select-presence-wrapper">
                            <a href="/gr/edklabs/${item.id}">
                                <i class="fa-solid fa-clipboard-list select-rule-icon" title="Aturan Absensi"></i>
                            </a>
                            <select class="select-presence status-hadir" name="status_${item.id}">
                                <option value="n" ${selN}>--tidak ada pilihan--</option>
                                <option value="h" ${sel('h')}>Hadir</option>
                                <option value="i" ${sel('i')}>Izin</option>
                                <option value="s" ${sel('s')}>Sakit</option>
                            </select>
                        </div>
                    </td>
                </tr>
            `;
            tempat.insertAdjacentHTML('beforeend', new_data);
        });
    })
    .catch(err => {
        console.error(err);
    });
}

        changeData(dafaultName);

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
        document.querySelector(".btn-search").addEventListener('click', function () {
            const query = searchInput.value.toLowerCase();

            tableRows.forEach(row => {
                const nameText = row.querySelector('.teacher-name').innerText.toLowerCase();
                const nigBadge = row.querySelector('.nig-badge');
                const nigText = nigBadge ? nigBadge.innerText.toLowerCase() : '';

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
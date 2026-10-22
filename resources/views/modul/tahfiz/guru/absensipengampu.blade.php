<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mata Pelajaran - SIAKAD</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Halaman Absensi Mapel -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/absensipengampu.css') }}?v={{ time() }}">

    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Absensi Mata Pelajaran</h2>
                    <p class="subtitle-text">Presensi masuk kelas dan pencatatan kehadiran siswa per mata pelajaran.</p>
                </div>
                <div class="topbar-icons">
                    <a href="/sk/dsg" title="Kembali ke Dashboard" style="text-decoration: none;"><i class="fa-solid fa-house"></i></a>
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Guru Pengajar"></i>
                </div>
            </header>

            {{-- BLADE SESSION SUCCESS (DI PERTAHANKAN) --}}
            @if(session('success'))
                <div class="abs-alert abs-alert-success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <p class="abs-alert-title">Berhasil!</p>
                        <p class="abs-alert-text">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            {{-- BLADE SESSION ERROR (DI PERTAHANKAN) --}}
            @if(session('error'))
                <div class="abs-alert abs-alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        <p class="abs-alert-title">Perhatian</p>
                        <p class="abs-alert-text">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            {{-- 1. FILTER TANGGAL --}}
            <div class="abs-card abs-card-gold abs-card-pad">
                <form method="GET" action="/sk/ass" class="abs-filter-form">
                    <div class="abs-filter-info">
                        <div class="abs-icon-box">
                            <i class="fa-solid fa-calendar-day"></i>
                        </div>
                        <div>
                            <h3 class="abs-filter-title">Kamis, 22 Oktober 2026</h3>
                            <p class="abs-subtitle">3 sesi pelajaran terjadwal pada tanggal ini</p>
                        </div>
                    </div>

                    <div class="abs-filter-actions">
                        <div class="abs-date-wrap">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="date" name="tanggal" value="2026-10-22" onchange="this.form.submit()">
                        </div>
                        <button type="submit" class="abs-btn abs-btn-primary abs-btn-sm">
                            <i class="fa-solid fa-filter"></i> Terapkan
                        </button>
                    </div>
                </form>
            </div>

            {{-- 2. PEMILIH SESI (HTML MURNI / STATIK) --}}
            <div class="abs-section-head">
                <span class="abs-section-label">
                    <i class="fa-solid fa-chalkboard"></i> Pilih Sesi Mengajar
                </span>
                <span class="abs-section-hint">Klik salah satu sesi untuk membuka absensi</span>
            </div>

            <div class="abs-session-grid">
                <!-- Sesi 1 (Aktif) -->
                <a href="/sk/ass?tanggal=2026-10-22&jadwal_id=1" class="abs-session-card active">
                    <div class="abs-session-row">
                        <div class="abs-session-main">
                            <span class="abs-session-time">
                                <i class="fa-regular fa-clock"></i> 07:30 - 09:00 WIB
                            </span>
                            <h4 class="abs-session-name">Matematika Lanjutan</h4>
                            <span class="abs-session-class">Kelas 12 IPA 1</span>
                        </div>
                        <div class="abs-session-side">
                            <span class="abs-badge abs-badge-success" title="Masuk: 07:25 WIB">
                                <i class="fa-solid fa-check"></i> Tepat Waktu
                            </span>
                            <span class="abs-session-count">
                                <i class="fa-solid fa-users"></i> 28 Siswa Terabsen
                            </span>
                        </div>
                    </div>
                    <div class="abs-session-foot">
                        <span><i class="fa-solid fa-circle-check"></i> Sedang Dipilih</span>
                        <span>Lanjutkan di bawah &darr;</span>
                    </div>
                </a>

                <!-- Sesi 2 -->
                <a href="/sk/ass?tanggal=2026-10-22&jadwal_id=2" class="abs-session-card">
                    <div class="abs-session-row">
                        <div class="abs-session-main">
                            <span class="abs-session-time">
                                <i class="fa-regular fa-clock"></i> 09:15 - 10:45 WIB
                            </span>
                            <h4 class="abs-session-name">Fisika Dasar</h4>
                            <span class="abs-session-class">Kelas 11 IPA 2</span>
                        </div>
                        <div class="abs-session-side">
                            <span class="abs-badge abs-badge-muted">Belum Masuk</span>
                        </div>
                    </div>
                </a>

                <!-- Sesi 3 -->
                <a href="/sk/ass?tanggal=2026-10-22&jadwal_id=3" class="abs-session-card">
                    <div class="abs-session-row">
                        <div class="abs-session-main">
                            <span class="abs-session-time">
                                <i class="fa-regular fa-clock"></i> 13:00 - 14:30 WIB
                            </span>
                            <h4 class="abs-session-name">Matematika Wajib</h4>
                            <span class="abs-session-class">Kelas 10 IPS 1</span>
                        </div>
                        <div class="abs-session-side">
                            <span class="abs-badge abs-badge-warning" title="Masuk: 13:10 WIB">
                                <i class="fa-solid fa-clock-rotate-left"></i> Terlambat
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 3. AREA KERJA ABSENSI SESI TERPILIH --}}
            
            {{-- TAHAP 1: PRESENSI MASUK GURU & JURNAL MATERI --}}
            <div class="abs-card abs-card-gold abs-card-clip" id="tahap-guru">
                <div class="abs-panel-head">
                    <div class="abs-panel-title-wrap">
                        <span class="abs-step done">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <div>
                            <div class="abs-panel-title-row">
                                <h3 class="abs-panel-title">Tahap 1: Presensi Masuk Kelas & Materi Mengajar</h3>
                                <span class="abs-badge abs-badge-success">Selesai</span>
                            </div>
                            <p class="abs-subtitle">
                                Matematika Lanjutan • Kelas 12 IPA 1 (07:30 - 09:00 WIB)
                            </p>
                        </div>
                    </div>

                    <div class="abs-deadline">
                        <span>Batas Tepat Waktu:</span>
                        <strong>07:35 WIB (+5 mnt)</strong>
                    </div>
                </div>

                <div class="abs-panel-body">
                    {{-- GURU SUDAH PRESENSI MASUK (KONDISI AKTIF) --}}
                    <div class="abs-done-box">
                        <div class="abs-done-info">
                            <div class="abs-done-icon">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div>
                                <div class="abs-done-meta">
                                    <span class="abs-badge abs-badge-success">✓ Masuk Tepat Waktu</span>
                                    <span class="abs-done-time">
                                        Pukul <strong>07:25 WIB</strong>
                                    </span>
                                </div>
                                <div class="abs-done-materi">
                                    <b>Materi:</b> Bab 3 - Turunan Fungsi Aljabar & Latihan Soal 
                                    <em>(Siswa aktif berdiskusi kelompok)</em>
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="toggleEditMateri()" class="abs-btn abs-btn-outline abs-btn-sm">
                            <i class="fa-solid fa-pen"></i> <span id="btnTextUbahMateri">Ubah Materi</span>
                        </button>
                    </div>

                    <div id="formEditMateriBox" class="abs-edit-box" style="display: none;">
                        <form action="/sk/simpan-absensi-mapel" method="POST">
                            @csrf
                            <input type="hidden" name="aksi" value="presensi_guru">
                            <input type="hidden" name="jadwal_id" value="1">
                            <input type="hidden" name="tanggal" value="2026-10-22">

                            <div class="abs-form-grid">
                                <div>
                                    <label class="abs-label">Materi Pembelajaran:</label>
                                    <input type="text" name="materi" value="Bab 3 - Turunan Fungsi Aljabar & Latihan Soal" required class="abs-input abs-input-sm">
                                </div>
                                <div>
                                    <label class="abs-label">Catatan Pembelajaran:</label>
                                    <input type="text" name="catatan" value="Siswa aktif berdiskusi kelompok" class="abs-input abs-input-sm">
                                </div>
                            </div>
                            <div class="abs-edit-actions">
                                <button type="button" onclick="toggleEditMateri()" class="abs-btn abs-btn-gray abs-btn-sm">Batal</button>
                                <button type="submit" class="abs-btn abs-btn-primary abs-btn-sm">Simpan Perubahan Materi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- TAHAP 2: TABEL ABSENSI SISWA --}}
            <div class="abs-card abs-card-gold abs-card-clip" id="tahap-siswa">
                <div class="abs-panel-head">
                    <div class="abs-panel-title-wrap">
                        <span class="abs-step active">2</span>
                        <div>
                            <div class="abs-panel-title-row">
                                <h3 class="abs-panel-title">Tahap 2: Presensi Siswa</h3>
                                <span class="abs-badge abs-badge-count">3 Siswa</span>
                            </div>
                            <p class="abs-subtitle">Catat kehadiran setiap peserta didik pada sesi pelajaran ini</p>
                        </div>
                    </div>

                    <div class="abs-head-actions">
                        <button type="button" onclick="setSemuaHadir()" class="abs-btn abs-btn-soft abs-btn-sm">
                            <i class="fa-solid fa-check-double"></i> Tandai Semua Hadir
                        </button>
                        <button type="submit" form="formAbsensiSiswa" class="abs-btn abs-btn-primary abs-btn-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Absensi Siswa
                        </button>
                    </div>
                </div>

                <div>
                    {{-- REKAP --}}
                    <div class="abs-recap">
                        <div class="abs-recap-list">
                            <span class="abs-recap-label">Rekap:</span>
                            <span class="abs-recap-item hadir"><strong>2</strong> Hadir</span>
                            <span class="abs-recap-item sakit"><strong>1</strong> Sakit</span>
                            <span class="abs-recap-item izin"><strong>0</strong> Izin</span>
                            <span class="abs-recap-item alpa"><strong>0</strong> Alpa</span>
                        </div>
                        <span class="abs-section-hint">Pilih status pada baris setiap siswa di bawah</span>
                    </div>

                    <form id="formAbsensiSiswa" action="/sk/simpan-absensi-mapel" method="POST">
                        @csrf
                        <input type="hidden" name="aksi" value="absensi_siswa">
                        <input type="hidden" name="jadwal_id" value="1">
                        <input type="hidden" name="tanggal" value="2026-10-22">

                        <div class="abs-table-wrap">
                            <table class="abs-table">
                                <thead>
                                    <tr>
                                        <th class="abs-center abs-col-no">No</th>
                                        <th class="abs-col-nis">NIS</th>
                                        <th>Nama Lengkap Siswa</th>
                                        <th class="abs-center abs-col-status">Status Kehadiran</th>
                                        <th class="abs-col-note">Catatan / Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Siswa 1 -->
                                    <tr>
                                        <td class="abs-center abs-num">1</td>
                                        <td class="abs-nis">222301001</td>
                                        <td>
                                            <span class="abs-student-name">Ahmad Fauzi</span>
                                            <span class="abs-student-gender">Laki-laki</span>
                                        </td>
                                        <td class="abs-center">
                                            <div class="abs-status-group">
                                                <label class="abs-radio hadir">
                                                    <input type="radio" name="absensi[101][status]" value="h" class="radio-hadir" checked>
                                                    <span>Hadir</span>
                                                </label>
                                                <label class="abs-radio sakit">
                                                    <input type="radio" name="absensi[101][status]" value="s">
                                                    <span>Sakit</span>
                                                </label>
                                                <label class="abs-radio izin">
                                                    <input type="radio" name="absensi[101][status]" value="i">
                                                    <span>Izin</span>
                                                </label>
                                                <label class="abs-radio alpa">
                                                    <input type="radio" name="absensi[101][status]" value="a">
                                                    <span>Alpa</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="absensi[101][keterangan]" value="" placeholder="Catatan siswa..." class="abs-input abs-input-sm">
                                        </td>
                                    </tr>

                                    <!-- Siswa 2 -->
                                    <tr>
                                        <td class="abs-center abs-num">2</td>
                                        <td class="abs-nis">222301002</td>
                                        <td>
                                            <span class="abs-student-name">Aisyah Nurbalqis</span>
                                            <span class="abs-student-gender">Perempuan</span>
                                        </td>
                                        <td class="abs-center">
                                            <div class="abs-status-group">
                                                <label class="abs-radio hadir">
                                                    <input type="radio" name="absensi[102][status]" value="h" class="radio-hadir">
                                                    <span>Hadir</span>
                                                </label>
                                                <label class="abs-radio sakit">
                                                    <input type="radio" name="absensi[102][status]" value="s" checked>
                                                    <span>Sakit</span>
                                                </label>
                                                <label class="abs-radio izin">
                                                    <input type="radio" name="absensi[102][status]" value="i">
                                                    <span>Izin</span>
                                                </label>
                                                <label class="abs-radio alpa">
                                                    <input type="radio" name="absensi[102][status]" value="a">
                                                    <span>Alpa</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="absensi[102][keterangan]" value="Surat dokter terlampir" placeholder="Catatan siswa..." class="abs-input abs-input-sm">
                                        </td>
                                    </tr>

                                    <!-- Siswa 3 -->
                                    <tr>
                                        <td class="abs-center abs-num">3</td>
                                        <td class="abs-nis">222301003</td>
                                        <td>
                                            <span class="abs-student-name">Muhammad Bilal</span>
                                            <span class="abs-student-gender">Laki-laki</span>
                                        </td>
                                        <td class="abs-center">
                                            <div class="abs-status-group">
                                                <label class="abs-radio hadir">
                                                    <input type="radio" name="absensi[103][status]" value="h" class="radio-hadir" checked>
                                                    <span>Hadir</span>
                                                </label>
                                                <label class="abs-radio sakit">
                                                    <input type="radio" name="absensi[103][status]" value="s">
                                                    <span>Sakit</span>
                                                </label>
                                                <label class="abs-radio izin">
                                                    <input type="radio" name="absensi[103][status]" value="i">
                                                    <span>Izin</span>
                                                </label>
                                                <label class="abs-radio alpa">
                                                    <input type="radio" name="absensi[103][status]" value="a">
                                                    <span>Alpa</span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" name="absensi[103][keterangan]" value="" placeholder="Catatan siswa..." class="abs-input abs-input-sm">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="abs-panel-foot">
                            <span>Total <strong>3</strong> siswa terdaftar di rombel ini.</span>
                            <button type="submit" class="abs-btn abs-btn-primary">
                                <i class="fa-solid fa-floppy-disk"></i> Simpan Absensi Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <script>
        function setSemuaHadir() {
            document.querySelectorAll('.radio-hadir').forEach(function(radio) {
                radio.checked = true;
            });
        }

        function toggleEditMateri() {
            const box = document.getElementById('formEditMateriBox');
            const btnText = document.getElementById('btnTextUbahMateri');
            if (box.style.display === 'none' || box.style.display === '') {
                box.style.display = 'block';
                if (btnText) btnText.innerText = 'Tutup Edit';
            } else {
                box.style.display = 'none';
                if (btnText) btnText.innerText = 'Ubah Materi';
            }
        }
    </script>
</body>
</html>
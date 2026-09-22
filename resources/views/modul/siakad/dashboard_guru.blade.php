<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SIAKAD</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dashboard.css') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">

            {{-- HEADER BAR --}}
            <header class="bg-emerald-900 text-white shadow-md relative overflow-hidden flex-shrink-0 rounded-xl mb-6">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:16px_16px]"></div>

                <div class="px-6 py-5 relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-center md:text-left">
                        <p class="font-arabic text-xl text-amber-400 mb-0.5">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <h1 class="text-xl font-bold tracking-wide text-white flex items-center justify-center md:justify-start gap-2">
                            Dashboard Guru
                        </h1>
                        <p class="text-emerald-200 text-xs">Selamat datang kembali, Ustadzah Fitri</p>
                    </div>
                </div>
            </header>

            {{-- STATISTIC CARDS --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-chalkboard"></i></div>
                    <div>
                        <h3>2</h3>
                        <p>Kelas Diampu</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    <div>
                        <h3>58</h3>
                        <p>Total Siswa</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <h3>4</h3>
                        <p>Jadwal Mengajar Hari Ini</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div>
                        <h3>97,1%</h3>
                        <p>Rata-rata Kehadiran Kelas</p>
                        <span class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 0,8% dari bulan lalu</span>
                    </div>
                </div>
            </div>

            {{-- ROW: RINGKASAN KEHADIRAN KELAS & JADWAL HARI INI --}}
            <div class="summary-filter-row">

                {{-- RINGKASAN KEHADIRAN --}}
                <div class="summary-box">
                    <h4>Ringkasan Kehadiran Kelas 1A Hari Ini</h4>
                    <div class="summary-cards">
                        <div class="sum-card green">
                            <h3>26</h3>
                            <p>Hadir</p>
                        </div>
                        <div class="sum-card yellow">
                            <h3>1</h3>
                            <p>Izin / Sakit</p>
                        </div>
                        <div class="sum-card red">
                            <h3>1</h3>
                            <p>Alpa</p>
                        </div>
                        <div class="sum-card blue">
                            <h3>0</h3>
                            <p>Terlambat</p>
                        </div>
                    </div>
                </div>

                {{-- JADWAL HARI INI --}}
                <div class="filter-box">
                    <h4>Jadwal Mengajar Hari Ini</h4>
                    <div class="filter-group">
                        <label>07.30 - 08.10</label>
                        <p style="font-size:0.85rem; font-weight:600; color:var(--emerald-dark);">Al-Qur'an Hadits — Kelas 1A</p>
                    </div>
                    <div class="filter-group">
                        <label>08.10 - 08.50</label>
                        <p style="font-size:0.85rem; font-weight:600; color:var(--emerald-dark);">Al-Qur'an Hadits — Kelas 1B</p>
                    </div>
                    <div class="filter-group">
                        <label>10.10 - 10.50</label>
                        <p style="font-size:0.85rem; font-weight:600; color:var(--emerald-dark);">Tahfiz — Kelas 1A</p>
                    </div>
                </div>
            </div>

            {{-- ROW: PENGUMUMAN & TUGAS/PENILAIAN --}}
            <div class="info-row">

                {{-- PENGUMUMAN --}}
                <div class="info-card">
                    <h4>Pengumuman Terbaru <a href="#" class="card-link">Lihat semua</a></h4>
                    <ul class="announcement-list">
                        <li class="announcement-item">
                            <div class="announcement-icon"><i class="fa-solid fa-bullhorn"></i></div>
                            <div class="announcement-body">
                                <h5>Pembagian Rapor Tengah Semester</h5>
                                <p>Nilai tengah semester mohon diinput paling lambat tanggal 10 Agustus.</p>
                            </div>
                            <span class="announcement-date">02 Agu</span>
                        </li>
                        <li class="announcement-item">
                            <div class="announcement-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                            <div class="announcement-body">
                                <h5>Slip Gaji Agustus Sudah Terbit</h5>
                                <p>Slip gaji bulan Agustus dapat dilihat pada menu Slip Pembayaran.</p>
                            </div>
                            <span class="announcement-date">01 Agu</span>
                        </li>
                        <li class="announcement-item">
                            <div class="announcement-icon"><i class="fa-solid fa-flag"></i></div>
                            <div class="announcement-body">
                                <h5>Libur Nasional &amp; Cuti Bersama</h5>
                                <p>Kegiatan belajar mengajar diliburkan sesuai kalender pendidikan.</p>
                            </div>
                            <span class="announcement-date">29 Jul</span>
                        </li>
                    </ul>
                </div>

                {{-- KELAS YANG DIAMPU --}}
                <div class="info-card">
                    <h4>Kelas yang Diampu</h4>
                    <ul class="calendar-list">
                        <li class="calendar-item">
                            <div class="calendar-date-box"><span class="day">1A</span><span class="month">SD</span></div>
                            <div class="calendar-info">
                                <h5>Kelas 1A</h5>
                                <p>28 siswa &bull; Wali kelas</p>
                            </div>
                        </li>
                        <li class="calendar-item">
                            <div class="calendar-date-box"><span class="day">1B</span><span class="month">SD</span></div>
                            <div class="calendar-info">
                                <h5>Kelas 1B</h5>
                                <p>30 siswa &bull; Guru mapel</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- TABEL DAFTAR SISWA KELAS 1A --}}
            <div class="table-card">
                <h4>Daftar Siswa — Kelas 1A</h4>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>NISN</th>
                                <th>Status Hari Ini</th>
                                <th>Nilai Rata-rata</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ali Hidayat</td>
                                <td>0091234567</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Hadir</span></td>
                                <td>90</td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Siti Aminah</td>
                                <td>0091234568</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Hadir</span></td>
                                <td>94</td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Budi Santoso</td>
                                <td>0091234569</td>
                                <td><span class="badge warning"><i class="fa-solid fa-triangle-exclamation"></i> Izin</span></td>
                                <td>85</td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Fatimah Zahra</td>
                                <td>0091234570</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Alpa</span></td>
                                <td>88</td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-15">
                    <button class="btn-outline"><i class="fa-solid fa-eye"></i> Lihat Semua Siswa</button>
                </div>
            </div>

            {{-- DETAIL SISWA (SATU CONTOH) --}}
            <div class="detail-row">
                <div class="detail-box">
                    <div class="detail-header-tag">DETAIL SISWA</div>
                    <button class="btn-back mb-10">&lt; Kembali</button>

                    <div class="student-profile">
                        <div class="avatar"><i class="fa-solid fa-user"></i></div>
                        <div class="student-info">
                            <h4>Ali Hidayat</h4>
                            <p>NISN: 0091234567</p>
                            <p>Kelas: 1A | Wali: Bpk. Hidayat</p>
                        </div>
                    </div>

                    <div class="grade-box">
                        <h5>Nilai Rata-rata per Mata Pelajaran</h5>
                        <ul class="grade-list">
                            <li class="grade-row">
                                <span class="subject">Al-Qur'an Hadits</span>
                                <span class="grade-track">
                                    <span class="grade-fill" style="width: 90%;"></span>
                                </span>
                                <span class="score">90</span>
                            </li>
                            <li class="grade-row">
                                <span class="subject">Tahfiz</span>
                                <span class="grade-track">
                                    <span class="grade-fill" style="width: 95%;"></span>
                                </span>
                                <span class="score">95</span>
                            </li>
                        </ul>
                    </div>

                    <div class="history-section">
                        <h5>Riwayat Kehadiran Terbaru</h5>
                        <table class="table-compact text-sm">
                            <thead>
                                <tr>
                                    <th>Tgl</th>
                                    <th>Status</th>
                                    <th>Jam Masuk</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>04/08</td>
                                    <td><i class="fa-solid fa-circle-check text-green"></i> Hadir</td>
                                    <td>06.52</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>03/08</td>
                                    <td><i class="fa-solid fa-circle-check text-green"></i> Hadir</td>
                                    <td>06.48</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>02/08</td>
                                    <td><i class="fa-solid fa-circle-check text-green"></i> Hadir</td>
                                    <td>06.55</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- AKSI CEPAT GURU --}}
                <div class="detail-box">
                    <div class="detail-header-tag">AKSI CEPAT</div>
                    <h3>Menu Guru</h3>
                    <p class="subtitle-text">Akses cepat ke fitur yang sering digunakan</p>

                    <div class="bottom-btns mt-15">
                        <button class="btn-action-outline"><i class="fa-solid fa-clipboard-user"></i> Input Absensi</button>
                        <button class="btn-action-outline"><i class="fa-solid fa-file-invoice-dollar"></i> Slip Pembayaran</button>
                        <button class="btn-action-outline"><i class="fa-solid fa-id-card"></i> Profil Saya</button>
                        <button class="btn-action-outline"><i class="fa-solid fa-calendar-week"></i> Rekap Mingguan</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
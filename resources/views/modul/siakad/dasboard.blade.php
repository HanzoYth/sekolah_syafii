<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SIAKAD</title>

    {{-- Google Fonts: Amiri untuk sentuhan kaligrafis, Poppins untuk keterbacaan UI --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Tailwind CSS CDN (Pastikan terhubung agar class Tailwind pada header baru berfungsi) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Stylesheet dashboard SIAKAD --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}">
</head>
<body>

    <div class="dashboard-container">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">

            {{-- HEADER BAR BARU (Islamic Theme with Tailwind) --}}
            <header class="bg-emerald-900 text-white shadow-md relative overflow-hidden flex-shrink-0 rounded-xl mb-6">
                <!-- Pattern background Islamic -->
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:16px_16px]"></div>
                
                <div class="px-6 py-5 relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="text-center md:text-left">
                        <p class="font-arabic text-xl text-amber-400 mb-0.5">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                        <h1 class="text-xl font-bold tracking-wide text-white flex items-center justify-center md:justify-start gap-2">
                            Sistem Informasi Data Siswa
                        </h1>
                        <p class="text-emerald-200 text-xs">Mewujudkan Generasi Rabbani, Berakhlak Mulia & Berprestasi</p>
                    </div>
                    <div>
                        <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-semibold px-4 py-2 rounded-lg shadow-md text-xs transition-all duration-200 hover:shadow-lg">
                            <i class="fa-solid fa-user-plus"></i> Tambah Siswa Baru
                        </a>
                    </div>
                </div>
            </header>

            {{-- STATISTIC CARDS --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    <div>
                        <h3>842</h3>
                        <p>Total Siswa</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-chalkboard-user"></i></div>
                    <div>
                        <h3>56</h3>
                        <p>Guru &amp; Staff</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-school"></i></div>
                    <div>
                        <h3>28</h3>
                        <p>Rombel / Kelas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div>
                        <h3>96,4%</h3>
                        <p>Rata-rata Kehadiran</p>
                        <span class="stat-trend up"><i class="fa-solid fa-arrow-up"></i> 1,2% dari bulan lalu</span>
                    </div>
                </div>
            </div>

            {{-- ROW: RINGKASAN KEHADIRAN & FILTER --}}
            <div class="summary-filter-row">

                {{-- RINGKASAN KEHADIRAN HARI INI --}}
                <div class="summary-box">
                    <h4>Ringkasan Kehadiran Hari Ini</h4>
                    <div class="summary-cards">
                        <div class="sum-card green">
                            <h3>798</h3>
                            <p>Hadir</p>
                        </div>
                        <div class="sum-card yellow">
                            <h3>27</h3>
                            <p>Izin / Sakit</p>
                        </div>
                        <div class="sum-card red">
                            <h3>9</h3>
                            <p>Alpa</p>
                        </div>
                        <div class="sum-card blue">
                            <h3>8</h3>
                            <p>Terlambat</p>
                        </div>
                    </div>
                </div>

                {{-- FILTER --}}
                <div class="filter-box">
                    <h4>Filter</h4>
                    <div class="filter-group">
                        <label for="filter-jenjang">Jenjang</label>
                        <select id="filter-jenjang" name="jenjang">
                            <option value="">Semua Jenjang</option>
                            <option value="tk">TK</option>
                            <option value="sd" selected>SD</option>
                            <option value="smp">SMP</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filter-kelas">Kelas</label>
                        <select id="filter-kelas" name="kelas">
                            <option value="">Semua Kelas</option>
                            <option value="1a" selected>Kelas 1A</option>
                            <option value="2b">Kelas 2B</option>
                            <option value="7a">Kelas 7A</option>
                            <option value="tkb1">TK B1</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="filter-tanggal">Tanggal</label>
                        <input type="date" id="filter-tanggal" name="tanggal" value="2026-08-04">
                    </div>
                </div>
            </div>

            {{-- ROW: PENGUMUMAN & KALENDER AKADEMIK --}}
            <div class="info-row">

                {{-- PENGUMUMAN --}}
                <div class="info-card">
                    <h4>Pengumuman Terbaru <a href="#" class="card-link">Lihat semua</a></h4>
                    <ul class="announcement-list">
                        <li class="announcement-item">
                            <div class="announcement-icon"><i class="fa-solid fa-bullhorn"></i></div>
                            <div class="announcement-body">
                                <h5>Pembagian Rapor Tengah Semester</h5>
                                <p>Rapor tengah semester akan dibagikan kepada wali murid melalui wali kelas masing-masing.</p>
                            </div>
                            <span class="announcement-date">02 Agu</span>
                        </li>
                        <li class="announcement-item">
                            <div class="announcement-icon"><i class="fa-solid fa-money-check-dollar"></i></div>
                            <div class="announcement-body">
                                <h5>Batas Pembayaran SPP Agustus</h5>
                                <p>Pembayaran SPP bulan Agustus paling lambat tanggal 10, mohon disampaikan ke wali murid.</p>
                            </div>
                            <span class="announcement-date">01 Agu</span>
                        </li>
                        <li class="announcement-item">
                            <div class="announcement-icon"><i class="fa-solid fa-flag"></i></div>
                            <div class="announcement-body">
                                <h5>Libur Nasional &amp; Cuti Bersama</h5>
                                <p>Kegiatan belajar mengajar diliburkan sesuai kalender pendidikan yang berlaku.</p>
                            </div>
                            <span class="announcement-date">29 Jul</span>
                        </li>
                    </ul>
                </div>

                {{-- KALENDER AKADEMIK --}}
                <div class="info-card">
                    <h4>Kalender Akademik <a href="#" class="card-link">Lihat semua</a></h4>
                    <ul class="calendar-list">
                        <li class="calendar-item">
                            <div class="calendar-date-box"><span class="day">12</span><span class="month">Agu</span></div>
                            <div class="calendar-info">
                                <h5>Penilaian Tengah Semester</h5>
                                <p>Berlaku untuk seluruh jenjang</p>
                            </div>
                        </li>
                        <li class="calendar-item">
                            <div class="calendar-date-box"><span class="day">17</span><span class="month">Agu</span></div>
                            <div class="calendar-info">
                                <h5>Upacara HUT RI</h5>
                                <p>Libur kegiatan belajar mengajar</p>
                            </div>
                        </li>
                        <li class="calendar-item">
                            <div class="calendar-date-box"><span class="day">25</span><span class="month">Agu</span></div>
                            <div class="calendar-info">
                                <h5>Rapat Wali Murid</h5>
                                <p>Aula sekolah, pukul 09.00</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- TABEL DAFTAR KELAS --}}
            <div class="table-card">
                <h4>Daftar Kelas</h4>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Jenjang</th>
                                <th>Wali Kelas</th>
                                <th>Jumlah Siswa</th>
                                <th>Kehadiran Hari Ini</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kelas 1A</td>
                                <td><span class="badge info">SD</span></td>
                                <td>Ustadzah Fitri</td>
                                <td>28</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> 98%</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Kelas 2B</td>
                                <td><span class="badge info">SD</span></td>
                                <td>Ustadz Rahman</td>
                                <td>30</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> 95%</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>Kelas 7A</td>
                                <td><span class="badge info">SMP</span></td>
                                <td>Ustadzah Ani</td>
                                <td>32</td>
                                <td><span class="badge warning"><i class="fa-solid fa-triangle-exclamation"></i> 87%</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                            <tr>
                                <td>TK B1</td>
                                <td><span class="badge info">TK</span></td>
                                <td>Ustadzah Sari</td>
                                <td>20</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> 100%</span></td>
                                <td><button class="btn-sm">Lihat</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-15">
                    <button class="btn-outline"><i class="fa-solid fa-eye"></i> Lihat Semua Kelas</button>
                </div>
            </div>

            {{-- ROW DETAIL (DETAIL KELAS & DETAIL SISWA) --}}
            <div class="detail-row">

                {{-- DETAIL KELAS --}}
                <div class="detail-box">
                    <div class="detail-header-tag">DETAIL KELAS (ADMIN VIEW)</div>
                    <div class="detail-action-bar">
                        <button class="btn-back">&lt; Kembali</button>
                        <div class="action-right">
                            <button class="btn-action-outline"><i class="fa-solid fa-user-pen"></i> Alih Wali Kelas</button>
                            <button class="btn-action-outline"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>
                        </div>
                    </div>
                    <h3>Kelas 1A</h3>
                    <p class="subtitle-text">
                        Wali Kelas: Ustadzah Fitri | Jadwal: Selasa, 04 Agustus 2026
                    </p>

                    <div class="table-responsive mt-15">
                        <table class="table-compact">
                            <thead>
                                <tr>
                                    <th>Jam</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Guru Pengajar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>07.30 - 08.10</td>
                                    <td>Al-Qur'an Hadits</td>
                                    <td>Ustadzah Fitri</td>
                                    <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Selesai</span></td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                                <tr>
                                    <td>08.10 - 08.50</td>
                                    <td>Matematika</td>
                                    <td>Ustadz Rahman</td>
                                    <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Selesai</span></td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                                <tr>
                                    <td>08.50 - 09.30</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Ustadzah Sari</td>
                                    <td><span class="badge-text red"><i class="fa-solid fa-clock"></i> Berlangsung</span></td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                                <tr>
                                    <td>09.30 - 10.10</td>
                                    <td>IPA</td>
                                    <td>Ustadz Fajar</td>
                                    <td><span class="badge-text red"><i class="fa-solid fa-clock"></i> Berlangsung</span></td>
                                    <td><button class="btn-xs">Detail</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="bottom-btns">
                        <button class="btn-action-outline"><i class="fa-solid fa-calendar-week"></i> Rekap Mingguan</button>
                        <button class="btn-action-outline"><i class="fa-solid fa-calendar-days"></i> Rekap Bulanan</button>
                    </div>
                </div>

                {{-- DETAIL SISWA --}}
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
                                <span class="subject">Matematika</span>
                                <span class="grade-track">
                                    <span class="grade-fill" style="width: 88%;"></span>
                                </span>
                                <span class="score">88</span>
                            </li>
                            <li class="grade-row">
                                <span class="subject">B. Indonesia</span>
                                <span class="grade-track">
                                    <span class="grade-fill" style="width: 92%;"></span>
                                </span>
                                <span class="score">92</span>
                            </li>
                            <li class="grade-row">
                                <span class="subject">IPA</span>
                                <span class="grade-track">
                                    <span class="grade-fill" style="width: 85%;"></span>
                                </span>
                                <span class="score">85</span>
                            </li>
                            <li class="grade-row">
                                <span class="subject">Al-Qur'an</span>
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
            </div>
        </main>
    </div>

</body>
</html>
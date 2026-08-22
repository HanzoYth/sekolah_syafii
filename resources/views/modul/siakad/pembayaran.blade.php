<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembayaran - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet dashboard SIAKAD (terpisah dari markup) --}}
    <!-- <link rel="stylesheet" href="{{ asset('css/modul/siakad/dasboard.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaran.css') }}">
</head>
<body>

    <div class="dashboard-container">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">

            {{-- TOPBAR / HEADER --}}
            <header class="topbar">
                <div class="topbar-left">
                    <span class="topbar-eyebrow">Sistem Informasi Akademik &middot; Selasa, 04 Agustus 2026</span>
                    <h2>Dashboard Pembayaran</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2025/2026 &middot; Semester Ganjil
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK PEMBAYARAN --}}
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-sack-dollar"></i></div>
                    <div>
                        <h3>Rp 84.200.000</h3>
                        <p>Total Pemasukan Bulan Ini</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-circle-check"></i></div>
                    <div>
                        <h3>712</h3>
                        <p>Siswa Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-hourglass-half"></i></div>
                    <div>
                        <h3>98</h3>
                        <p>Belum Bayar</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div>
                        <h3>32</h3>
                        <p>Tunggakan &gt; 1 Bulan</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN --}}
            <div class="filter-box pembayaran-filter">
                <h4>Filter Pembayaran</h4>
                <div class="filter-group">
                    <label for="filter-bulan-spp">Bulan</label>
                    <select id="filter-bulan-spp" name="bulan_spp">
                        <option value="8" selected>Agustus 2026</option>
                        <option value="7">Juli 2026</option>
                        <option value="6">Juni 2026</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filter-status-bayar">Status</label>
                    <select id="filter-status-bayar" name="status_bayar">
                        <option value="">Semua Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="belum">Belum Bayar</option>
                        <option value="tunggak">Tunggakan</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filter-kelas-spp">Kelas</label>
                    <select id="filter-kelas-spp" name="kelas_spp">
                        <option value="">Semua Kelas</option>
                        <option value="1a">Kelas 1A</option>
                        <option value="2b">Kelas 2B</option>
                        <option value="7a">Kelas 7A</option>
                        <option value="tkb1">TK B1</option>
                    </select>
                </div>
            </div>

            {{-- TABEL DAFTAR PEMBAYARAN --}}
            <div class="table-card">
                <h4>Daftar Pembayaran SPP <a href="#" class="card-link">Lihat semua</a></h4>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Tgl Bayar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ali Hidayat</td>
                                <td>1A</td>
                                <td>Agustus 2026</td>
                                <td>Rp 350.000</td>
                                <td>03/08</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Lunas</span></td>
                                <td><a href = '/sk/dp'class="btn-sm">Detail</a></td>
                            </tr>
                            <tr>
                                <td>Siti Aminah</td>
                                <td>2B</td>
                                <td>Agustus 2026</td>
                                <td>Rp 350.000</td>
                                <td>-</td>
                                <td><span class="badge warning"><i class="fa-solid fa-clock"></i> Belum Bayar</span></td>
                                <td><button class="btn-sm">Detail</button></td>
                            </tr>
                            <tr>
                                <td>Budi Santoso</td>
                                <td>7A</td>
                                <td>Juli 2026</td>
                                <td>Rp 400.000</td>
                                <td>-</td>
                                <td><span class="badge danger"><i class="fa-solid fa-triangle-exclamation"></i> Tunggakan</span></td>
                                <td><button class="btn-sm">Detail</button></td>
                            </tr>
                            <tr>
                                <td>Nadia Putri</td>
                                <td>TK B1</td>
                                <td>Agustus 2026</td>
                                <td>Rp 300.000</td>
                                <td>01/08</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Lunas</span></td>
                                <td><button class="btn-sm">Detail</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-15">
                    <button class="btn-outline"><i class="fa-solid fa-eye"></i> Lihat Semua Pembayaran</button>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
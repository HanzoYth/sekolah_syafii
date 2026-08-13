<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Harian - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/laporan_harian.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER + NAVIGASI TANGGAL -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Laporan Harian</span></p>
                    <h1>Laporan Harian</h1>
                </div>
                <div class="page-header-right">
                    <div class="date-nav">
                        <button class="date-nav-btn" title="Hari sebelumnya"><i class="fa-solid fa-chevron-left"></i></button>
                        <div class="date-nav-current">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="date" value="2026-06-23">
                        </div>
                        <button class="date-nav-btn" title="Hari berikutnya"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Export</button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT (UNTUK TANGGAL TERPILIH) -->
            <div class="quick-stats">
                <div class="stat-pill success">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <h4>11</h4>
                        <p>Halaqah Sudah Input</p>
                    </div>
                </div>
                <div class="stat-pill warning">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        <h4>4</h4>
                        <p>Halaqah Belum Input</p>
                    </div>
                </div>
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>18</h4>
                        <p>Siswa Tidak Capai Target</p>
                    </div>
                </div>
            </div>

            <!-- 2b. GRAFIK PERBANDINGAN CAPAIAN ANTAR HALAQAH (khusus tanggal terpilih) -->
            <div class="chart-card">
                <h4>Perbandingan Capaian Antar Halaqah</h4>
                <div class="hbar-list">
                    <div class="hbar-row">
                        <span class="hbar-label">Kelas 1A - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 88%;"></div></div>
                        <span class="hbar-value">88%</span>
                    </div>
                    <div class="hbar-row">
                        <span class="hbar-label">Kelas 1A - Halaqah 2</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 95%;"></div></div>
                        <span class="hbar-value">95%</span>
                    </div>
                    <div class="hbar-row pending">
                        <span class="hbar-label">Kelas 2B - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 0%;"></div></div>
                        <span class="hbar-value">Belum input</span>
                    </div>
                    <div class="hbar-row pending">
                        <span class="hbar-label">Kelas 2B - Halaqah 3</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 0%;"></div></div>
                        <span class="hbar-value">Belum input</span>
                    </div>
                    <div class="hbar-row">
                        <span class="hbar-label">Kelas 3A - Halaqah 1</span>
                        <div class="hbar-track"><div class="hbar-fill" style="width: 100%;"></div></div>
                        <span class="hbar-value">100%</span>
                    </div>
                </div>
            </div>

            <!-- 3. FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama halaqah atau pengampu...">
                </div>
                <div class="toolbar-filters">
                    <select>
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                    <select>
                        <option>Semua Pengampu</option>
                        <option>Ustadz Ahmad</option>
                        <option>Ustadzah Aisyah</option>
                    </select>
                    <select>
                        <option>Semua Status</option>
                        <option>Sudah Input</option>
                        <option>Belum Input</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL LAPORAN PER HALAQAH -->
            <div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Halaqah</th>
                                <th>Pengampu</th>
                                <th>Siswa Dilaporkan</th>
                                <th>Rata-rata Capaian</th>
                                <th>Status Input</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Kelas 1A</td>
                                <td class="cell-strong">Halaqah 1</td>
                                <td>Ustadz Ahmad</td>
                                <td>12 / 12</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 88%;"></div>
                                    </div>
                                    <span class="progress-mini-label">88%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailLaporan').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kelas 1A</td>
                                <td class="cell-strong">Halaqah 2</td>
                                <td>Ustadzah Aisyah</td>
                                <td>11 / 11</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 95%;"></div>
                                    </div>
                                    <span class="progress-mini-label">95%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailLaporan').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row-pending">
                                <td>Kelas 2B</td>
                                <td class="cell-strong">Halaqah 1</td>
                                <td>Ustadz Fajar</td>
                                <td>0 / 13</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 0%;"></div>
                                    </div>
                                    <span class="progress-mini-label">-</span>
                                </td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailLaporan').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Ingatkan Pengampu" class="highlight"><i class="fa-solid fa-bell"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row-pending">
                                <td>Kelas 2B</td>
                                <td class="cell-strong">Halaqah 3</td>
                                <td class="cell-empty"><i class="fa-solid fa-user-slash"></i> Belum ditentukan</td>
                                <td>0 / 9</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 0%;"></div>
                                    </div>
                                    <span class="progress-mini-label">-</span>
                                </td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailLaporan').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Ingatkan Pengampu" class="highlight"><i class="fa-solid fa-bell"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Kelas 3A</td>
                                <td class="cell-strong">Halaqah 1</td>
                                <td>Ustadzah Rina</td>
                                <td>10 / 10</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">100%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailLaporan').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 7. EMPTY STATE (tampil kalau tanggal terpilih belum ada satupun input) -->
                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-calendar-xmark"></i>
                    <h4>Belum ada laporan untuk tanggal ini</h4>
                    <p>Belum ada halaqah yang menginput hafalan pada tanggal yang dipilih.</p>
                </div>
                --}}
            </div>

        </main>
    </div>

    <!-- 6. MODAL DETAIL LAPORAN HALAQAH (view-only, panel lebar) -->
    <div class="modal-overlay" id="modalDetailLaporan">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">DETAIL LAPORAN HARIAN</span>
                    <h3>Kelas 1A - Halaqah 1</h3>
                    <p class="modal-subtitle">Pengampu: Ustadz Ahmad &nbsp;|&nbsp; Tanggal: 23/06/2026</p>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalDetailLaporan').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Target Harian</th>
                                <th>Ziyadah</th>
                                <th>Murojaah</th>
                                <th>Jumlah Baris</th>
                                <th>Kondisi Hafalan</th>
                                <th>Capaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="cell-strong">Ali</td>
                                <td>5 baris</td>
                                <td>5 baris <small>(An-Naba: 1-5)</small></td>
                                <td>2 ayat <small>(An-Naba: 1-2)</small></td>
                                <td>5</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="cell-strong">Budi</td>
                                <td>5 baris</td>
                                <td>3 baris <small>(An-Naba: 1-3)</small></td>
                                <td>2 ayat <small>(An-Naba: 1-2)</small></td>
                                <td>3</td>
                                <td>Belum Lancar</td>
                                <td><span class="badge-text red"><i class="fa-solid fa-circle-xmark"></i> Tidak Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="cell-strong">Citra</td>
                                <td>4 baris</td>
                                <td>4 baris <small>(An-Naba: 1-4)</small></td>
                                <td>2 ayat <small>(An-Naba: 1-2)</small></td>
                                <td>4</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="cell-strong">Dafa</td>
                                <td>6 baris</td>
                                <td>6 baris <small>(An-Naba: 1-6)</small></td>
                                <td>2 ayat <small>(An-Naba: 1-2)</small></td>
                                <td>6</td>
                                <td>Lancar</td>
                                <td><span class="badge-text green"><i class="fa-solid fa-circle-check"></i> Tercapai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalDetailLaporan').classList.remove('show')">Tutup</button>
                <button class="btn-primary-gold"><i class="fa-solid fa-file-pdf"></i> Export PDF</button>
            </div>
        </div>
    </div>

</body>
</html>
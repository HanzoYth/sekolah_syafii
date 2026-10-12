<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Setoran Hafalan - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/input_setoran.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- 1. PAGE HEADER + INFORMASI KELAS & HALAQAH -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Input Setoran</span></p>
                    <h1>Form Input Setoran Hafalan</h1>
                </div>
                <div class="page-header-right">
                    <div class="date-nav">
                        <div class="date-nav-current">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="date" value="2026-06-23">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. INFO KARTU HALAQAH AKTIF -->
            <div class="info-halaqah-card">
                <div class="info-item">
                    <span class="label">Kelas:</span>
                    <span class="value">Kelas 1A</span>
                </div>
                <div class="divider"></div>
                <div class="info-item">
                    <span class="label">Halaqah:</span>
                    <span class="value">Halaqah 1</span>
                </div>
                <div class="divider"></div>
                <div class="info-item">
                    <span class="label">Pengampu:</span>
                    <span class="value">Ustadz Ahmad, S.Pd.</span>
                </div>
                <div class="divider"></div>
                <div class="info-item">
                    <span class="label">Total Siswa:</span>
                    <span class="value">12 Siswa</span>
                </div>
            </div>

            <!-- 3. FORM UTAMA INPUT SETORAN -->
            <form action="#" method="POST">
                @csrf
                <div class="table-card">
                    <div class="table-header-flex">
                        <h4>Daftar Siswa & Input Capaian Hari Ini</h4>
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-floppy-disk"></i> Simpan Semua Setoran</button>
                    </div>

                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Target (Baris)</th>
                                    <th>Ziyadah (Baris & Surah/Ayat)</th>
                                    <th>Murojaah (Ayat/Halaman)</th>
                                    <th>Kondisi Hafalan</th>
                                    <th>Status Target</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Siswa 1 -->
                                <tr>
                                    <td>1</td>
                                    <td class="cell-strong">Ali</td>
                                    <td><span class="badge-target">5 baris</span></td>
                                    <td>
                                        <div class="input-group-grid">
                                            <input type="number" name="ziyadah_baris[1]" value="5" class="input-sm" placeholder="Baris">
                                            <input type="text" name="ziyadah_ket[1]" value="An-Naba: 1-5" class="input-md" placeholder="Keterangan Surah/Ayat">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="murojaah[1]" value="An-Naba: 1-2" class="input-full" placeholder="Cth: An-Naba: 1-2">
                                    </td>
                                    <td>
                                        <select name="kondisi[1]" class="select-sm">
                                            <option value="Lancar" selected>Lancar</option>
                                            <option value="Kurang Lancar">Kurang Lancar</option>
                                            <option value="Mengulang">Mengulang</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="capaian[1]" class="select-status green">
                                            <option value="Tercapai" selected>Tercapai</option>
                                            <option value="Tidak Tercapai">Tidak Tercapai</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Siswa 2 -->
                                <tr>
                                    <td>2</td>
                                    <td class="cell-strong">Budi</td>
                                    <td><span class="badge-target">5 baris</span></td>
                                    <td>
                                        <div class="input-group-grid">
                                            <input type="number" name="ziyadah_baris[2]" value="3" class="input-sm" placeholder="Baris">
                                            <input type="text" name="ziyadah_ket[2]" value="An-Naba: 1-3" class="input-md" placeholder="Keterangan Surah/Ayat">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="murojaah[2]" value="An-Naba: 1-2" class="input-full" placeholder="Cth: An-Naba: 1-2">
                                    </td>
                                    <td>
                                        <select name="kondisi[2]" class="select-sm">
                                            <option value="Lancar">Lancar</option>
                                            <option value="Kurang Lancar" selected>Kurang Lancar</option>
                                            <option value="Mengulang">Mengulang</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="capaian[2]" class="select-status red">
                                            <option value="Tercapai">Tercapai</option>
                                            <option value="Tidak Tercapai" selected>Tidak Tercapai</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Siswa 3 -->
                                <tr>
                                    <td>3</td>
                                    <td class="cell-strong">Citra</td>
                                    <td><span class="badge-target">4 baris</span></td>
                                    <td>
                                        <div class="input-group-grid">
                                            <input type="number" name="ziyadah_baris[3]" value="4" class="input-sm" placeholder="Baris">
                                            <input type="text" name="ziyadah_ket[3]" value="An-Naba: 1-4" class="input-md" placeholder="Keterangan Surah/Ayat">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="murojaah[3]" value="An-Naba: 1-2" class="input-full" placeholder="Cth: An-Naba: 1-2">
                                    </td>
                                    <td>
                                        <select name="kondisi[3]" class="select-sm">
                                            <option value="Lancar" selected>Lancar</option>
                                            <option value="Kurang Lancar">Kurang Lancar</option>
                                            <option value="Mengulang">Mengulang</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="capaian[3]" class="select-status green">
                                            <option value="Tercapai" selected>Tercapai</option>
                                            <option value="Tidak Tercapai">Tidak Tercapai</option>
                                        </select>
                                    </td>
                                </tr>

                                <!-- Siswa 4 -->
                                <tr>
                                    <td>4</td>
                                    <td class="cell-strong">Dafa</td>
                                    <td><span class="badge-target">6 baris</span></td>
                                    <td>
                                        <div class="input-group-grid">
                                            <input type="number" name="ziyadah_baris[4]" value="6" class="input-sm" placeholder="Baris">
                                            <input type="text" name="ziyadah_ket[4]" value="An-Naba: 1-6" class="input-md" placeholder="Keterangan Surah/Ayat">
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="murojaah[4]" value="An-Naba: 1-2" class="input-full" placeholder="Cth: An-Naba: 1-2">
                                    </td>
                                    <td>
                                        <select name="kondisi[4]" class="select-sm">
                                            <option value="Lancar" selected>Lancar</option>
                                            <option value="Kurang Lancar">Kurang Lancar</option>
                                            <option value="Mengulang">Mengulang</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="capaian[4]" class="select-status green">
                                            <option value="Tercapai" selected>Tercapai</option>
                                            <option value="Tidak Tercapai">Tidak Tercapai</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer-action">
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-floppy-disk"></i> Simpan Semua Setoran</button>
                    </div>
                </div>
            </form>

        </main>
    </div>

</body>
</html>
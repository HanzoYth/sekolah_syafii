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
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/setorran.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- WADAH TEMPLATE SIDEBAR -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Input Setoran</span></p>
                    <h1>Form Input Setoran Hafalan</h1>
                </div>
                <div class="page-header-right">
                    <div class="date-nav">
                        <div class="date-nav-current">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="date" name="tanggal_setoran" value="2026-06-23">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. FILTER PILIH KELAS & HALAQAH -->
            <div class="filter-toolbar-card">
                <div class="filter-group">
                    <label><i class="fa-solid fa-school"></i> Pilih Kelas</label>
                    <select class="form-control-select">
                        <option value="1a" selected>Kelas 1A</option>
                        <option value="1b">Kelas 1B</option>
                        <option value="2a">Kelas 2A</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label><i class="fa-solid fa-users-rectangle"></i> Pilih Halaqah</label>
                    <select class="form-control-select">
                        <option value="1" selected>Halaqah 1 (Ustadz Ahmad)</option>
                        <option value="2">Halaqah 2 (Ustadzah Aisyah)</option>
                    </select>
                </div>
                <div class="filter-action">
                    <button type="button" class="btn-filter-apply"><i class="fa-solid fa-rotate"></i> Muat Data Siswa</button>
                </div>
            </div>

            <!-- 3. FORM UTAMA INPUT SETORAN PER SISWA -->
            <form action="" method="POST">
                @csrf
                <div class="table-card">
                    <div class="table-header-flex">
                        <div>
                            <h4>Lembar Input Setoran Halaqah 1</h4>
                            <p class="table-subtitle">Pengampu: Ustadz Ahmad, S.Pd. | Total Siswa: 4 Orang</p>
                        </div>
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-floppy-disk"></i> Simpan Semua Setoran</button>
                    </div>

                    <div class="table-responsive">
                        <table class="table-input-setoran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa & Juz</th>
                                    <th>Target Harian</th>
                                    <th>Ziyadah (Setoran Baru)</th>
                                    <th>Murojaah</th>
                                    <th>PR di Rumah</th>
                                    <th>Kondisi & Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Siswa 1: Ali -->
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="student-info-cell">
                                            <span class="cell-strong">Ali</span>
                                            <span class="badge-juz">Juz 29</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-target">5 baris</span>
                                        <input type="hidden" name="siswa[1][id]" value="1">
                                    </td>
                                    <!-- ZIYADAH -->
                                    <td>
                                        <div class="input-stack">
                                            <input type="text" name="siswa[1][ziyadah_surah]" placeholder="Nama Surah (Cth: An-Naba)" value="An-Naba" class="input-control">
                                            <div class="input-inline-grid">
                                                <input type="text" name="siswa[1][ziyadah_ayat_dari]" placeholder="Dari Ayat" value="1" class="input-control">
                                                <input type="text" name="siswa[1][ziyadah_ayat_sampai]" placeholder="Sampai Ayat" value="5" class="input-control">
                                            </div>
                                            <input type="number" name="siswa[1][ziyadah_baris]" placeholder="Jumlah Baris" value="5" class="input-control">
                                        </div>
                                    </td>
                                    <!-- MUROJAAH -->
                                    <td>
                                        <div class="input-stack">
                                            <input type="text" name="siswa[1][murojaah_surah]" placeholder="Surah Murojaah" value="An-Naba" class="input-control">
                                            <input type="text" name="siswa[1][murojaah_ayat]" placeholder="Ayat (Cth: 1-2)" value="1-2" class="input-control">
                                        </div>
                                    </td>
                                    <!-- PR DI RUMAH -->
                                    <td>
                                        <div class="input-stack">
                                            <input type="text" name="siswa[1][pr_ziyadah]" placeholder="PR Ziyadah (Ayat/Baris)" value="An-Naba: 6-10" class="input-control pr-input">
                                            <input type="text" name="siswa[1][pr_murojaah]" placeholder="PR Murojaah" value="An-Naba: 1-5" class="input-control pr-input">
                                        </div>
                                    </td>
                                    <!-- KONDISI & STATUS -->
                                    <td>
                                        <div class="input-stack">
                                            <select name="siswa[1][kondisi_hafalan]" class="select-control">
                                                <option value="Lancar" selected>Lancar</option>
                                                <option value="Kurang Lancar">Kurang Lancar</option>
                                                <option value="Mengulang">Mengulang</option>
                                            </select>
                                            <select name="siswa[1][status_target]" class="select-status green">
                                                <option value="Tercapai" selected>Tercapai</option>
                                                <option value="Tidak Tercapai">Tidak Tercapai</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Siswa 2: Budi -->
                                <tr>
                                    <td>2</td>
                                    <td>
                                        <div class="student-info-cell">
                                            <span class="cell-strong">Budi</span>
                                            <span class="badge-juz">Juz 29</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-target">5 baris</span>
                                        <input type="hidden" name="siswa[2][id]" value="2">
                                    </td>
                                    <!-- ZIYADAH -->
                                    <td>
                                        <div class="input-stack">
                                            <input type="text" name="siswa[2][ziyadah_surah]" placeholder="Nama Surah" value="An-Naba" class="input-control">
                                            <div class="input-inline-grid">
                                                <input type="text" name="siswa[2][ziyadah_ayat_dari]" placeholder="Dari Ayat" value="1" class="input-control">
                                                <input type="text" name="siswa[2][ziyadah_ayat_sampai]" placeholder="Sampai Ayat" value="3" class="input-control">
                                            </div>
                                            <input type="number" name="siswa[2][ziyadah_baris]" placeholder="Jumlah Baris" value="3" class="input-control">
                                        </div>
                                    </td>
                                    <!-- MUROJAAH -->
                                    <td>
                                        <div class="input-stack">
                                            <input type="text" name="siswa[2][murojaah_surah]" placeholder="Surah Murojaah" value="An-Naba" class="input-control">
                                            <input type="text" name="siswa[2][murojaah_ayat]" placeholder="Ayat" value="1-2" class="input-control">
                                        </div>
                                    </td>
                                    <!-- PR DI RUMAH -->
                                    <td>
                                        <div class="input-stack">
                                            <input type="text" name="siswa[2][pr_ziyadah]" placeholder="PR Ziyadah" value="An-Naba: 4-8" class="input-control pr-input">
                                            <input type="text" name="siswa[2][pr_murojaah]" placeholder="PR Murojaah" value="An-Naba: 1-3" class="input-control pr-input">
                                        </div>
                                    </td>
                                    <!-- KONDISI & STATUS -->
                                    <td>
                                        <div class="input-stack">
                                            <select name="siswa[2][kondisi_hafalan]" class="select-control">
                                                <option value="Lancar">Lancar</option>
                                                <option value="Kurang Lancar" selected>Kurang Lancar</option>
                                                <option value="Mengulang">Mengulang</option>
                                            </select>
                                            <select name="siswa[2][status_target]" class="select-status red">
                                                <option value="Tercapai">Tercapai</option>
                                                <option value="Tidak Tercapai" selected>Tidak Tercapai</option>
                                            </select>
                                        </div>
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
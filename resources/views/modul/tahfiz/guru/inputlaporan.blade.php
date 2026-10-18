<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Laporan Harian - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama & CSS Khusus Input Laporan -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/inputlaporan.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR GURU -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Input Laporan Setoran Harian</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Guru"></i>
                </div>
            </header>

            <!-- ACTION & NAVIGATION BAR -->
           

            <!-- FORM INPUT LAPORAN HARIAN -->
            <form action="" method="POST" class="form-laporan-container">
                @csrf

                <!-- SECTION 1: DATA SISWA & HALAQAH -->
                <div class="table-card form-card">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-user-graduate"></i> Data Siswa & Informasi Halaqah</h4>
                        <span class="detail-header-tag"><i class="fa-solid fa-calendar-day"></i> Presensi & Identitas</span>
                    </div>

                    <div class="filter-box form-grid-3">
                        <!-- Tanggal Setoran -->
                        <div class="filter-group">
                            <label for="tanggal_setoran">Tanggal Setoran <span class="text-danger">*</span></label>
                            <input type="date" id="tanggal_setoran" name="tanggal_setoran" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <!-- Pilih Halaqah -->
                        <div class="filter-group">
                            <label for="halaqah_id">Pilih Halaqah <span class="text-danger">*</span></label>
                            <select id="halaqah_id" name="halaqah_id" required>
                                <option value="">-- Pilih Halaqah --</option>
                                <option value="1" selected>Kelas 1A - Halaqah 1 (Ustadz Ahmad)</option>
                                <option value="2">Kelas 1B - Halaqah 2 (Ustadzah Aisyah)</option>
                                <option value="3">Kelas 2A - Halaqah 1 (Ustadz Fajar)</option>
                            </select>
                        </div>

                        <!-- Nama Siswa -->
                        <div class="filter-group">
                            <label for="siswa_id">Nama Siswa <span class="text-danger">*</span></label>
                            <select id="siswa_id" name="siswa_id" required>
                                <option value="">-- Pilih Nama Siswa --</option>
                                <option value="222301001" {{ request('nisn') == '222301001' ? 'selected' : '' }}>Ahmad Fauzi (NISN: 222301001)</option>
                                <option value="222301002" {{ request('nisn') == '222301002' ? 'selected' : '' }}>Aisyah Nurbalqis (NISN: 222301002)</option>
                                <option value="222301003" {{ request('nisn') == '222301003' ? 'selected' : '' }}>Muhammad Bilal (NISN: 222301003)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: CAPAIAN & TARGET HARIAN -->
                <div class="table-card form-card">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-bullseye"></i> Capaian & Target Harian</h4>
                        <span class="detail-header-tag"><i class="fa-solid fa-book-quran"></i> Target Hafalan</span>
                    </div>

                    <div class="filter-box form-grid-4">
                        <!-- Capaian Juz -->
                        <div class="filter-group">
                            <label for="juz">Capaian Juz <span class="text-danger">*</span></label>
                            <select id="juz" name="juz" required>
                                <option value="">-- Pilih Juz --</option>
                                @for ($i = 1; $i <= 30; $i++)
                                    <option value="{{ $i }}" {{ $i == 30 ? 'selected' : '' }}>Juz {{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Target Harian (Baris) -->
                        <div class="filter-group">
                            <label for="target_harian_baris">Target Harian (Baris) <span class="text-danger">*</span></label>
                            <input type="number" id="target_harian_baris" name="target_harian_baris" placeholder="Contoh: 15" value="15" required>
                        </div>

                        <!-- Jumlah Baris Disetor -->
                        <div class="filter-group">
                            <label for="jumlah_baris">Jumlah Baris Setoran <span class="text-danger">*</span></label>
                            <input type="number" id="jumlah_baris" name="jumlah_baris" placeholder="Contoh: 15" value="15" required>
                        </div>

                        <!-- Status Target -->
                        <div class="filter-group">
                            <label for="target_status">Status Target <span class="text-danger">*</span></label>
                            <select id="target_status" name="target_status" required>
                                <option value="Tercapai" selected>Tercapai</option>
                                <option value="Melampaui Target">Melampaui Target</option>
                                <option value="Belum Tercapai">Belum Tercapai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: SETORAN HARI INI (ZIYADAH & MUROJAAH) -->
                <div class="table-card form-card">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-cloud-arrow-up"></i> Setoran Hari Ini (Ziyadah & Murojaah)</h4>
                        <span class="detail-header-tag"><i class="fa-solid fa-feather-pointed"></i> Setoran Langsung</span>
                    </div>

                    <div class="filter-box form-grid-2">
                        <!-- Setoran Ziyadah -->
                        <div class="filter-group">
                            <label for="setoran_ziyadah">
                                <i class="fa-solid fa-plus-circle text-green"></i> Setoran Ziyadah (Hafalan Baru)
                            </label>
                            <textarea id="setoran_ziyadah" name="setoran_ziyadah" rows="3" placeholder="Contoh: Surah An-Naba' ayat 1 - 20 (Halaman 582)"></textarea>
                        </div>

                        <!-- Setoran Murojaah -->
                        <div class="filter-group">
                            <label for="setoran_murojaah">
                                <i class="fa-solid fa-arrows-rotate style-gold"></i> Setoran Murojaah (Mengulang)
                            </label>
                            <textarea id="setoran_murojaah" name="setoran_murojaah" rows="3" placeholder="Contoh: Surah An-Naziat ayat 1 - 46"></textarea>
                        </div>
                    </div>
                </div>

                <!-- SECTION 4: TUGAS PEKERJAAN RUMAH (PR) -->
                <div class="table-card form-card">
                    <div class="card-header-title">
                        <h4><i class="fa-solid fa-house-chimney-crack"></i> Tugas Pekerjaan Rumah (PR)</h4>
                        <span class="detail-header-tag"><i class="fa-solid fa-note-sticky"></i> Untuk Hari Berikutnya</span>
                    </div>

                    <div class="filter-box form-grid-2">
                        <!-- PR Ziyadah -->
                        <div class="filter-group">
                            <label for="pr_ziyadah">
                                <i class="fa-solid fa-book-bookmark text-green"></i> PR Ziyadah
                            </label>
                            <textarea id="pr_ziyadah" name="pr_ziyadah" rows="3" placeholder="Contoh: Hafalkan Surah An-Naba' ayat 21 - 40"></textarea>
                        </div>

                        <!-- PR Murojaah -->
                        <div class="filter-group">
                            <label for="pr_murojaah">
                                <i class="fa-solid fa-clock-rotate-left style-gold"></i> PR Murojaah
                            </label>
                            <textarea id="pr_murojaah" name="pr_murojaah" rows="3" placeholder="Contoh: Ulangi Surah An-Naba' ayat 1 - 20 di rumah"></textarea>
                        </div>
                    </div>
                </div>

                <!-- SUBMIT BUTTONS -->
                <div class="form-actions-row">
                    <button type="reset" class="btn-sm btn-reset">
                        <i class="fa-solid fa-rotate-left"></i> Reset Form
                    </button>
                    <button type="submit" class="btn-sm btn-submit">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Laporan Setoran
                    </button>
                </div>

            </form>

        </main>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/siswa_tahfiz.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Siswa</span></p>
                    <h1>Data Siswa</h1>
                </div>
                <div class="page-header-right">
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Import siswa</button>
                    <button class="btn-primary-gold" onclick="openModal('modalTambahSiswa')">
                        <i class="fa-solid fa-plus"></i> Tambah Siswa
                    </button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT -->
            <div class="quick-stats">
                <div class="stat-pill">
                    <i class="fa-solid fa-users"></i>
                    <div>
                        <h4>300</h4>
                        <p>Total Siswa</p>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-user-check"></i>
                    <div>
                        <h4>295</h4>
                        <p>Siswa Aktif</p>
                    </div>
                </div>

            </div>

            <!-- 3. TOOLBAR ATAS TABEL -->
            <div class="toolbar-box-custom">
                <div class="toolbar-left-group">
                    <button class="btn-tindakan"><i class="fa-solid fa-ellipsis-vertical"></i> Tindakan</button>
                </div>
                <div class="toolbar-right-group">
                    <div class="search-field">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Cari...">
                    </div>
                    <button class="btn-filter-icon">
                        <i class="fa-solid fa-filter"></i>
                        <span class="filter-count">0</span>
                    </button>
                </div>
            </div>

            <!-- 4. INFO SELEKSI DATA -->
            <div class="selection-info-bar">
                <span><strong>20 data dipilih</strong></span>
                <div class="selection-actions">
                    <a href="#">Pilih semua (203)</a>
                    <a href="#" class="text-danger">Batalkan semua pilihan</a>
                </div>
            </div>

            <!-- 5. TABEL DAFTAR SISWA -->
            <div class="table-card">
                <div class="table-responsive">
                    <table class="table-siswa-modern">
                        <thead>
                            <tr>
                                <th style="width: 40px;" class="text-center"><input type="checkbox" checked></th>
                                <th>Siswa <i class="fa-solid fa-chevron-down text-xs"></i></th>
                                <th>Wali Murid / Akses <i class="fa-solid fa-chevron-up text-xs"></i></th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- BARIS 1: Faqih -->
                            <tr>
                                <td class="text-center"><input type="checkbox" checked></td>
                                <td>
                                    <div class="student-main-info">
                                        <strong class="student-name">Faqih</strong>
                                        <span class="student-meta">Username: faqih_sqis08</span>
                                        <span class="student-meta">Halaqah: Halaqah 1</span>
                                        <span class="student-meta">Kelas: 1A</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="wali-info">
                                        <span class="wali-name">-</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="status-juz-group">
                                        <span class="badge-status-active">Aktif</span>
                                        <span class="juz-label">Juz 30</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons-stack">
                                        <button class="btn-action-custom btn-blue"><i class="fa-solid fa-copy"></i> Salin Akses</button>
                                        <button class="btn-action-custom btn-green" onclick="openModal('modalDetailSiswa')"><i class="fa-solid fa-eye"></i> Lihat</button>
                                        <button class="btn-action-custom btn-orange" onclick="openModal('modalEditSiswa')"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                        <button class="btn-action-custom btn-red" onclick="openModal('modalHapusSiswa')"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- BARIS 2: Raffasya Ilham P -->
                            <tr>
                                <td class="text-center"><input type="checkbox" checked></td>
                                <td>
                                    <div class="student-main-info">
                                        <strong class="student-name">Raffasya Ilham P</strong>
                                        <span class="student-meta">Username: raffasya_sqis04</span>
                                        <span class="student-meta">Halaqah: Halaqah 5</span>
                                        <span class="student-meta">Kelas: 2A</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="wali-info">
                                        <strong class="wali-name">Abd Darwis P. & Hajrana</strong>
                                        <span class="wali-detail">Email: -</span>
                                        <span class="wali-detail">Pass: <code class="pass-code">raffasya_sqis04</code></span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="status-juz-group">
                                        <span class="badge-status-active">Aktif</span>
                                        <span class="juz-label">Juz 29</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons-stack">
                                        <button class="btn-action-custom btn-blue"><i class="fa-solid fa-copy"></i> Salin Akses</button>
                                        <button class="btn-action-custom btn-green" onclick="openModal('modalDetailSiswa')"><i class="fa-solid fa-eye"></i> Lihat</button>
                                        <button class="btn-action-custom btn-orange" onclick="openModal('modalEditSiswa')"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                        <button class="btn-action-custom btn-red" onclick="openModal('modalHapusSiswa')"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                    </div>
                                </td>
                            </tr>

                            <!-- BARIS 3: Muhammad Nurzaty Al Muntazar -->
                            <tr>
                                <td class="text-center"><input type="checkbox" checked></td>
                                <td>
                                    <div class="student-main-info">
                                        <strong class="student-name">Muhammad Nurzaty Al Muntazar</strong>
                                        <span class="student-meta">Username: nurzaty_sqis22</span>
                                        <span class="student-meta">Halaqah: Halaqah 10</span>
                                        <span class="student-meta">Kelas: 3A</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="wali-info">
                                        <strong class="wali-name">Abdul Rahman</strong>
                                        <span class="wali-detail">Email: -</span>
                                        <span class="wali-detail">Pass: <code class="pass-code">nurzaty_sqis22</code></span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="status-juz-group">
                                        <span class="badge-status-active">Aktif</span>
                                        <span class="juz-label">Juz 30</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="action-buttons-stack">
                                        <button class="btn-action-custom btn-blue"><i class="fa-solid fa-copy"></i> Salin Akses</button>
                                        <button class="btn-action-custom btn-green" onclick="openModal('modalDetailSiswa')"><i class="fa-solid fa-eye"></i> Lihat</button>
                                        <button class="btn-action-custom btn-orange" onclick="openModal('modalEditSiswa')"><i class="fa-solid fa-pen-to-square"></i> Ubah</button>
                                        <button class="btn-action-custom btn-red" onclick="openModal('modalHapusSiswa')"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- 6. MODAL TAMBAH SISWA -->
    <div class="modal-overlay" id="modalTambahSiswa">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Siswa</h3>
                <button class="modal-close" onclick="closeModal('modalTambahSiswa')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" placeholder="Contoh: Ahmad Fauzan">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" placeholder="2024005">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="closeModal('modalTambahSiswa')">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 7. MODAL DETAIL SISWA -->
    <div class="modal-overlay" id="modalDetailSiswa">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <h3>Detail Siswa</h3>
                <button class="modal-close" onclick="closeModal('modalDetailSiswa')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="detail-siswa-grid">
                    <div class="detail-siswa-col">
                        <div class="
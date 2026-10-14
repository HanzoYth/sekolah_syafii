<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Guru & Pengampu - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri (islami/elegan) + Poppins (body) -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/manajemen_guru.css') }}">
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
                <div class="topbar-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Manajemen Guru</span></p>
                    <h2>Manajemen Guru & Pengampu</h2>
                </div>
                <div class="topbar-icons">
                    <div class="notification-badge-wrapper">
                        <i class="fa-regular fa-bell"></i>
                        <span class="badge-dot"></span>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            <!-- STATISTIC SUMMARY CARDS (4 KOTAK) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>15</h3>
                    <p>Total Guru / Pengampu</p>
                </div>
                <div class="stat-card">
                    <h3>15</h3>
                    <p>Halaqah Terisi</p>
                </div>
                <div class="stat-card">
                    <h3>20</h3>
                    <p>Rata-rata Siswa / Halaqah</p>
                </div>
                <div class="stat-card">
                    <h3>1</h3>
                    <p>Halaqah Tanpa Pengampu</p>
                </div>
            </div>

            <!-- TOOLBAR: FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama guru, NIP, atau halaqah...">
                </div>
                <div class="toolbar-filters">
                    <select class="form-control-select">
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 1B</option>
                        <option>Kelas 2B</option>
                    </select>
                    <select class="form-control-select">
                        <option>Status Pengampu: Semua</option>
                        <option>Aktif Mengampu</option>
                        <option>Belum Ditugaskan</option>
                    </select>
                </div>
                <button class="btn-primary-gold" onclick="document.getElementById('modalTambahGuru').classList.add('show')">
                    <i class="fa-solid fa-user-plus"></i> Tambah Guru
                </button>
            </div>

            <!-- TABEL DAFTAR GURU & PENGAMPU -->
            <div class="table-card">
                <div class="table-header-flex">
                    <div>
                        <h4>Daftar Guru & Kelompok Pembinaan</h4>
                        <p class="subtitle-text">Kelola penugasan halaqah dan alokasi siswa binaan</p>
                    </div>
                    <span class="text-muted text-sm">Menampilkan 1-4 dari 15 Guru</span>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Guru & NIP</th>
                                <th>Kelas & Halaqah Binaan</th>
                                <th>Jumlah Siswa</th>
                                <th>Status Tugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="teacher-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-chalkboard-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Ustadz Ahmad, S.Pd.</span>
                                            <small class="text-muted">NIP: 198501152010121001</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>Kelas 1A</strong> — <span class="badge-tag">Halaqah 1</span>
                                </td>
                                <td><span class="badge-count">12 Siswa</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif Mengampu</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Atur Halaqah & Siswa Binaan" onclick="document.getElementById('modalAturHalaqah').classList.add('show')"><i class="fa-solid fa-users-gear"></i></button>
                                        <button title="Edit Data Guru" onclick="document.getElementById('modalTambahGuru').classList.add('show')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Cabut Penugasan" class="highlight"><i class="fa-solid fa-user-xmark"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="teacher-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-chalkboard-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Ustadzah Aisyah, Lc.</span>
                                            <small class="text-muted">NIP: 199003222015042002</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>Kelas 1A</strong> — <span class="badge-tag">Halaqah 2</span>
                                </td>
                                <td><span class="badge-count">11 Siswa</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif Mengampu</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Atur Halaqah & Siswa Binaan" onclick="document.getElementById('modalAturHalaqah').classList.add('show')"><i class="fa-solid fa-users-gear"></i></button>
                                        <button title="Edit Data Guru"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Cabut Penugasan" class="highlight"><i class="fa-solid fa-user-xmark"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="teacher-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-chalkboard-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Ustadz Fajar Pratama, M.Ag.</span>
                                            <small class="text-muted">NIP: 198811022012011003</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <strong>Kelas 2B</strong> — <span class="badge-tag">Halaqah 1</span>
                                </td>
                                <td><span class="badge-count">13 Siswa</span></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif Mengampu</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Atur Halaqah & Siswa Binaan"><i class="fa-solid fa-users-gear"></i></button>
                                        <button title="Edit Data Guru"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button title="Cabut Penugasan" class="highlight"><i class="fa-solid fa-user-xmark"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="teacher-info-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-chalkboard-user"></i></div>
                                        <div>
                                            <span class="cell-strong">Ustadz Zaky Nurrahman, S.H.I.</span>
                                            <small class="text-muted">NIP: 199307182018031005</small>
                                        </div>
                                    </div>
                                </td>
                                <td><em class="text-muted">Belum ada kelompok</em></td>
                                <td><span class="badge-count empty">0 Siswa</span></td>
                                <td><span class="badge danger"><i class="fa-solid fa-clock"></i> Belum Ditugaskan</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Tugaskan Ke Halaqah" class="success-btn" onclick="document.getElementById('modalAturHalaqah').classList.add('show')"><i class="fa-solid fa-user-plus"></i></button>
                                        <button title="Edit Data Guru"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL TAMBAH / EDIT GURU -->
    <div class="modal-overlay" id="modalTambahGuru">
        <div class="modal-box">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">DATA PENDIDIK</span>
                    <h3>Tambah / Ubah Data Guru</h3>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalTambahGuru').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="form-group-stack">
                        <label>Nama Lengkap Guru (dengan Gelar)</label>
                        <input type="text" class="input-control" placeholder="Cth: Ustadz Ahmad, S.Pd." required>
                    </div>
                    <div class="form-row-grid">
                        <div class="form-group-stack">
                            <label>NIP / ID Guru</label>
                            <input type="text" class="input-control" placeholder="Nomor Induk Pegawai" required>
                        </div>
                        <div class="form-group-stack">
                            <label>No. WhatsApp / HP</label>
                            <input type="text" class="input-control" placeholder="0812xxxxxxxx" required>
                        </div>
                    </div>
                    <div class="form-group-stack">
                        <label>Email Utama</label>
                        <input type="email" class="input-control" placeholder="alamat@email.com" required>
                    </div>
                    <div class="modal-footer-action">
                        <button type="button" class="btn-back" onclick="document.getElementById('modalTambahGuru').classList.remove('show')">Batal</button>
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-floppy-disk"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL ATUR HALAQAH & SISWA BINAAN -->
    <div class="modal-overlay" id="modalAturHalaqah">
        <div class="modal-box modal-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">PENUGASAN PENGAMPU</span>
                    <h3>Atur Halaqah & Siswa Binaan</h3>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalAturHalaqah').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                    <div class="teacher-profile-summary mb-15">
                        <div class="avatar-lg"><i class="fa-solid fa-user-tie"></i></div>
                        <div>
                            <h4>Ustadz Ahmad, S.Pd.</h4>
                            <p class="text-sm text-muted">Pengampu Terpilih | NIP: 198501152010121001</p>
                        </div>
                    </div>

                    <div class="form-row-grid">
                        <div class="form-group-stack">
                            <label>Pilih Kelas</label>
                            <select class="input-control">
                                <option>Kelas 1A</option>
                                <option>Kelas 1B</option>
                                <option>Kelas 2B</option>
                            </select>
                        </div>
                        <div class="form-group-stack">
                            <label>Pilih Nama / Kelompok Halaqah</label>
                            <select class="input-control">
                                <option>Halaqah 1</option>
                                <option>Halaqah 2</option>
                                <option>Halaqah Baru (+ Buat Baru)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group-stack mt-15">
                        <label>Pilih Siswa Binaan (Centang Siswa untuk Dimasukkan)</label>
                        <div class="student-select-list">
                            <label class="checkbox-item">
                                <input type="checkbox" checked>
                                <span><strong>Ali</strong> (NISN: 0081234561) — Kelas 1A</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox" checked>
                                <span><strong>Budi</strong> (NISN: 0081234562) — Kelas 1A</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox">
                                <span><strong>Citra</strong> (NISN: 0081234563) — Kelas 1A</span>
                            </label>
                            <label class="checkbox-item">
                                <input type="checkbox">
                                <span><strong>Dafa</strong> (NISN: 0081234564) — Kelas 1A</span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-footer-action">
                        <button type="button" class="btn-back" onclick="document.getElementById('modalAturHalaqah').classList.remove('show')">Batal</button>
                        <button type="submit" class="btn-primary-gold"><i class="fa-solid fa-check-double"></i> Simpan Penugasan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
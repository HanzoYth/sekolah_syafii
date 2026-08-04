<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas & Halaqah - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/kelas_halaqah.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Kelas & Halaqah</span></p>
                    <h1>Kelas & Halaqah</h1>
                </div>
                <div class="page-header-right">
                    <button class="btn-outline"><i class="fa-solid fa-school"></i> Tambah Kelas</button>
                    <button class="btn-primary-gold"><i class="fa-solid fa-plus"></i> Tambah Halaqah</button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT -->
            <div class="quick-stats">
                <div class="stat-pill">
                    <i class="fa-solid fa-school"></i>
                    <div>
                        <h4>6</h4>
                        <p>Total Kelas</p>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-book-quran"></i>
                    <div>
                        <h4>15</h4>
                        <p>Total Halaqah</p>
                    </div>
                </div>
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>2</h4>
                        <p>Halaqah Belum Ada Pengampu</p>
                    </div>
                </div>
            </div>

            <!-- 3. FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama halaqah, kelas, atau pengampu...">
                </div>
                <div class="toolbar-filters">
                    <select>
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                    <select>
                        <option>Semua Status</option>
                        <option>Ada Pengampu</option>
                        <option>Belum Ada Pengampu</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL HALAQAH (POLA B: DATAR, KOLOM KELAS) -->
            <div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Halaqah</th>
                                <th>Kelas</th>
                                <th>Pengampu</th>
                                <th>Siswa</th>
                                <th>Progres Capaian</th>
                                <th>Input Hari Ini</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="cell-strong">Halaqah 1</td>
                                <td>Kelas 1A</td>
                                <td>Ustadz Ahmad</td>
                                <td>12</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 85%;"></div>
                                    </div>
                                    <span class="progress-mini-label">85%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Ganti Pengampu"><i class="fa-solid fa-user-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Halaqah 2</td>
                                <td>Kelas 1A</td>
                                <td>Ustadzah Aisyah</td>
                                <td>11</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 92%;"></div>
                                    </div>
                                    <span class="progress-mini-label">92%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Ganti Pengampu"><i class="fa-solid fa-user-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Halaqah 1</td>
                                <td>Kelas 2B</td>
                                <td>Ustadz Fajar</td>
                                <td>13</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 58%;"></div>
                                    </div>
                                    <span class="progress-mini-label">58%</span>
                                </td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Ganti Pengampu"><i class="fa-solid fa-user-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Halaqah 3</td>
                                <td>Kelas 2B</td>
                                <td class="cell-empty"><i class="fa-solid fa-user-slash"></i> Belum ditentukan</td>
                                <td>9</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 0%;"></div>
                                    </div>
                                    <span class="progress-mini-label">-</span>
                                </td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Ganti Pengampu" class="highlight"><i class="fa-solid fa-user-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-strong">Halaqah 1</td>
                                <td>Kelas 3A</td>
                                <td>Ustadzah Rina</td>
                                <td>10</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">100%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Ganti Pengampu"><i class="fa-solid fa-user-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 8. EMPTY STATE (tampil kalau data kosong, contoh markup — sembunyikan/hapus saat sudah ada data) -->
                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-book-quran"></i>
                    <h4>Belum ada halaqah</h4>
                    <p>Tambahkan halaqah pertama untuk mulai mencatat hafalan siswa.</p>
                    <button class="btn-primary-gold"><i class="fa-solid fa-plus"></i> Tambah Halaqah</button>
                </div>
                --}}
            </div>

        </main>
    </div>

    <!-- 7. MODAL TAMBAH KELAS -->
    <div class="modal-overlay" id="modalTambahKelas">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Kelas</h3>
                <button class="modal-close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kelas</label>
                    <input type="text" placeholder="Contoh: Kelas 4A">
                </div>
                <div class="form-group">
                    <label>Keterangan (opsional)</label>
                    <input type="text" placeholder="Contoh: Kelas pagi">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 7. MODAL TAMBAH / EDIT HALAQAH -->
    <div class="modal-overlay" id="modalTambahHalaqah">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Halaqah</h3>
                <button class="modal-close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Halaqah</label>
                    <input type="text" placeholder="Contoh: Halaqah 4">
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <select>
                        <option>Pilih kelas...</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Pengampu</label>
                    <select>
                        <option>Pilih pengampu...</option>
                        <option>Ustadz Ahmad</option>
                        <option>Ustadzah Aisyah</option>
                        <option>Ustadz Fajar</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Target Harian (baris)</label>
                        <input type="number" placeholder="5">
                    </div>
                    <div class="form-group">
                        <label>Kapasitas Siswa</label>
                        <input type="number" placeholder="15">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

</body>
</html>
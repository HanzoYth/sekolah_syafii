<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/siswa_tahfiz.css') }}">
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
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Export Data</button>
                    <button class="btn-primary-gold" onclick="document.getElementById('modalTambahSiswa').classList.add('show')">
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
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>18</h4>
                        <p>Belum Capai Target Minggu Ini</p>
                    </div>
                </div>
            </div>

            <!-- 3. FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama siswa atau NIS...">
                </div>
                <div class="toolbar-filters">
                    <select>
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                    <select>
                        <option>Semua Halaqah</option>
                        <option>Halaqah 1</option>
                        <option>Halaqah 2</option>
                    </select>
                    <select>
                        <option>Semua Status Hafalan</option>
                        <option>Lancar</option>
                        <option>Belum Lancar</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL SISWA -->
            <div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Halaqah</th>
                                <th>Juz</th>
                                <th>Progres</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <span class="cell-strong">Ali</span>
                                    </div>
                                </td>
                                <td>2024001</td>
                                <td>Kelas 1A</td>
                                <td>Halaqah 1</td>
                                <td>29</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 85%;"></div>
                                    </div>
                                    <span class="progress-mini-label">85%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <span class="cell-strong">Budi</span>
                                    </div>
                                </td>
                                <td>2024002</td>
                                <td>Kelas 1A</td>
                                <td>Halaqah 1</td>
                                <td>29</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 58%;"></div>
                                    </div>
                                    <span class="progress-mini-label">58%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <span class="cell-strong">Citra</span>
                                    </div>
                                </td>
                                <td>2024003</td>
                                <td>Kelas 1A</td>
                                <td>Halaqah 2</td>
                                <td>28</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 92%;"></div>
                                    </div>
                                    <span class="progress-mini-label">92%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="student-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user"></i></div>
                                        <span class="cell-strong">Dafa</span>
                                    </div>
                                </td>
                                <td>2024004</td>
                                <td>Kelas 2B</td>
                                <td>Halaqah 1</td>
                                <td>27</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">100%</span>
                                </td>
                                <td><span class="badge nonaktif"><i class="fa-solid fa-circle-minus"></i> Nonaktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailSiswa').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Hapus" class="danger"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 7. EMPTY STATE (tampil kalau data kosong — sembunyikan/hapus saat sudah ada data) -->
                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-user-graduate"></i>
                    <h4>Belum ada siswa</h4>
                    <p>Tambahkan siswa pertama untuk mulai mencatat hafalannya.</p>
                    <button class="btn-primary-gold"><i class="fa-solid fa-plus"></i> Tambah Siswa</button>
                </div>
                --}}
            </div>

        </main>
    </div>

    <!-- 6. MODAL TAMBAH / EDIT SISWA -->
    <div class="modal-overlay" id="modalTambahSiswa">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Siswa</h3>
                <button class="modal-close" onclick="document.getElementById('modalTambahSiswa').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
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
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date">
                </div>
                <div class="form-row">
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
                        <label>Halaqah</label>
                        <select>
                            <option>Pilih halaqah...</option>
                            <option>Halaqah 1</option>
                            <option>Halaqah 2</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Orang Tua / Wali</label>
                    <input type="text" placeholder="Contoh: Bapak Hasan">
                </div>
                <div class="form-group">
                    <label>No. HP Orang Tua / Wali</label>
                    <input type="text" placeholder="08xxxxxxxxxx">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalTambahSiswa').classList.remove('show')">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 5. MODAL DETAIL SISWA (panel lebar) -->
    <div class="modal-overlay" id="modalDetailSiswa">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <h3>Detail Siswa</h3>
                <button class="modal-close" onclick="document.getElementById('modalDetailSiswa').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="detail-siswa-grid">

                    <!-- KOLOM KIRI: PROFIL, ORANG TUA, CATATAN -->
                    <div class="detail-siswa-col">
                        <div class="student-profile">
                            <div class="avatar"><i class="fa-solid fa-user"></i></div>
                            <div class="student-info">
                                <h4>Ali</h4>
                                <p>NIS: 2024001</p>
                                <p>Kelas 1A · Halaqah 1 · Juz 29</p>
                            </div>
                        </div>

                        <div class="info-box">
                            <h5><i class="fa-solid fa-people-roof"></i> Orang Tua / Wali</h5>
                            <p class="info-line"><i class="fa-solid fa-user"></i> Bapak Hasan</p>
                            <p class="info-line"><i class="fa-solid fa-phone"></i> 0812-3456-7890</p>
                        </div>

                        <div class="info-box">
                            <h5><i class="fa-solid fa-note-sticky"></i> Catatan Pengampu</h5>
                            <p class="notes-text">Hafalan cukup lancar, perlu lebih diperhatikan pada bacaan tajwid di juz 29. Semangat murojaah baik.</p>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: GRAFIK & RIWAYAT SETORAN -->
                    <div class="detail-siswa-col">
                        <div class="chart-box">
                            <h5>Progress Hafalan</h5>
                            <div class="dummy-chart">
                                <div class="bar" style="height: 40%;"></div>
                                <div class="bar" style="height: 60%;"></div>
                                <div class="bar" style="height: 80%;"></div>
                                <div class="bar" style="height: 50%;"></div>
                                <div class="bar" style="height: 70%;"></div>
                                <div class="bar" style="height: 90%;"></div>
                                <div class="bar" style="height: 100%;"></div>
                            </div>
                            <div class="chart-labels">
                                <span>17/06</span><span>18/06</span><span>19/06</span><span>20/06</span><span>21/06</span><span>22/06</span><span>23/06</span>
                            </div>
                        </div>

                        <div class="history-section">
                            <h5>Riwayat Setoran</h5>
                            <div class="table-responsive">
                                <table class="table-compact">
                                    <thead>
                                        <tr>
                                            <th>Tgl</th>
                                            <th>Ziyadah</th>
                                            <th>Murojaah</th>
                                            <th>Kondisi</th>
                                            <th>Capaian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>23/06</td>
                                            <td>5 baris<br><small>(An-Naba: 1-5)</small></td>
                                            <td>2 ayat<br><small>(An-Naba: 1-2)</small></td>
                                            <td>Lancar</td>
                                            <td><i class="fa-solid fa-circle-check text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td>22/06</td>
                                            <td>4 baris<br><small>(An-Naba: 1-4)</small></td>
                                            <td>3 ayat<br><small>(An-Naba: 1-3)</small></td>
                                            <td>Lancar</td>
                                            <td><i class="fa-solid fa-circle-check text-green"></i></td>
                                        </tr>
                                        <tr>
                                            <td>21/06</td>
                                            <td>5 baris<br><small>('Abasa: 1-5)</small></td>
                                            <td>2 ayat<br><small>('Abasa: 1-2)</small></td>
                                            <td>Belum Lancar</td>
                                            <td><i class="fa-solid fa-circle-xmark text-red"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalDetailSiswa').classList.remove('show')">Tutup</button>
                <button class="btn-primary-gold"><i class="fa-solid fa-pen"></i> Edit Siswa</button>
            </div>
        </div>
    </div>

</body>
</html>
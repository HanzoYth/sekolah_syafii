<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Siswa - SIAKAD</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{asset('img/logo_sklh.png')}}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/teacher/dashboard.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/teacher/attendance.css') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <x-siakad_teacher.sidebar_siakad />

        <main class="main-content teacher-attendance">

            <x-siakad_teacher.topbar
                name="Ustadzah Fitri"
                position="Guru Mata Pelajaran"
                initials="UF"
                title="Absensi Siswa"
                description="Catat kehadiran siswa dan pantau rekap kelas hari ini."
            />

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">SIAKAD Guru / <span>Absensi</span></p>
                    <h1>Pencatatan Kehadiran</h1>
                </div>
                <div class="page-header-right">
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Export Data</button>
                    <button class="btn-primary-gold" id="btnSimpanAbsensi">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Absensi
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
                <div class="stat-pill hadir">
                    <i class="fa-solid fa-circle-check"></i>
                    <div>
                        <h4>274</h4>
                        <p>Hadir</p>
                    </div>
                </div>
                <div class="stat-pill sakit">
                    <i class="fa-solid fa-notes-medical"></i>
                    <div>
                        <h4>9</h4>
                        <p>Sakit</p>
                    </div>
                </div>
                <div class="stat-pill izin">
                    <i class="fa-solid fa-envelope-open-text"></i>
                    <div>
                        <h4>11</h4>
                        <p>Izin</p>
                    </div>
                </div>
                <div class="stat-pill alpa">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>6</h4>
                        <p>Alpa</p>
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
                    <div class="date-field">
                        <i class="fa-solid fa-calendar-days"></i>
                        <input type="date" value="{{ date('Y-m-d') }}">
                    </div>
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
                        <option>Semua Status</option>
                        <option>Hadir</option>
                        <option>Sakit</option>
                        <option>Izin</option>
                        <option>Alpa</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL ABSENSI -->
            <div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Siswa</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>Halaqah</th>
                                <th class="col-status">Status Kehadiran</th>
                                <th>Keterangan</th>
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
                                <td>
                                    <div class="attendance-status-group">
                                        <label class="status-radio hadir">
                                            <input type="radio" name="status_2024001" value="hadir" checked>
                                            <span>Hadir</span>
                                        </label>
                                        <label class="status-radio sakit">
                                            <input type="radio" name="status_2024001" value="sakit">
                                            <span>Sakit</span>
                                        </label>
                                        <label class="status-radio izin">
                                            <input type="radio" name="status_2024001" value="izin">
                                            <span>Izin</span>
                                        </label>
                                        <label class="status-radio alpa">
                                            <input type="radio" name="status_2024001" value="alpa">
                                            <span>Alpa</span>
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" class="input-keterangan" placeholder="Opsional"></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Riwayat" onclick="document.getElementById('modalRiwayatAbsensi').classList.add('show')"><i class="fa-solid fa-clock-rotate-left"></i></button>
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
                                <td>
                                    <div class="attendance-status-group">
                                        <label class="status-radio hadir">
                                            <input type="radio" name="status_2024002" value="hadir">
                                            <span>Hadir</span>
                                        </label>
                                        <label class="status-radio sakit">
                                            <input type="radio" name="status_2024002" value="sakit" checked>
                                            <span>Sakit</span>
                                        </label>
                                        <label class="status-radio izin">
                                            <input type="radio" name="status_2024002" value="izin">
                                            <span>Izin</span>
                                        </label>
                                        <label class="status-radio alpa">
                                            <input type="radio" name="status_2024002" value="alpa">
                                            <span>Alpa</span>
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" class="input-keterangan" value="Demam, surat dari orang tua"></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Riwayat" onclick="document.getElementById('modalRiwayatAbsensi').classList.add('show')"><i class="fa-solid fa-clock-rotate-left"></i></button>
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
                                <td>
                                    <div class="attendance-status-group">
                                        <label class="status-radio hadir">
                                            <input type="radio" name="status_2024003" value="hadir">
                                            <span>Hadir</span>
                                        </label>
                                        <label class="status-radio sakit">
                                            <input type="radio" name="status_2024003" value="sakit">
                                            <span>Sakit</span>
                                        </label>
                                        <label class="status-radio izin">
                                            <input type="radio" name="status_2024003" value="izin" checked>
                                            <span>Izin</span>
                                        </label>
                                        <label class="status-radio alpa">
                                            <input type="radio" name="status_2024003" value="alpa">
                                            <span>Alpa</span>
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" class="input-keterangan" value="Acara keluarga"></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Riwayat" onclick="document.getElementById('modalRiwayatAbsensi').classList.add('show')"><i class="fa-solid fa-clock-rotate-left"></i></button>
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
                                <td>
                                    <div class="attendance-status-group">
                                        <label class="status-radio hadir">
                                            <input type="radio" name="status_2024004" value="hadir">
                                            <span>Hadir</span>
                                        </label>
                                        <label class="status-radio sakit">
                                            <input type="radio" name="status_2024004" value="sakit">
                                            <span>Sakit</span>
                                        </label>
                                        <label class="status-radio izin">
                                            <input type="radio" name="status_2024004" value="izin">
                                            <span>Izin</span>
                                        </label>
                                        <label class="status-radio alpa">
                                            <input type="radio" name="status_2024004" value="alpa" checked>
                                            <span>Alpa</span>
                                        </label>
                                    </div>
                                </td>
                                <td><input type="text" class="input-keterangan" placeholder="Opsional"></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Riwayat" onclick="document.getElementById('modalRiwayatAbsensi').classList.add('show')"><i class="fa-solid fa-clock-rotate-left"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- EMPTY STATE (tampil kalau data kosong — sembunyikan/hapus saat sudah ada data) -->
                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-clipboard-user"></i>
                    <h4>Belum ada data absensi</h4>
                    <p>Pilih tanggal dan kelas untuk mulai mencatat kehadiran siswa.</p>
                </div>
                --}}
            </div>

        </main>
    </div>

    <!-- 5. MODAL RIWAYAT ABSENSI SISWA -->
    <div class="modal-overlay" id="modalRiwayatAbsensi">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <h3>Riwayat Absensi</h3>
                <button class="modal-close" onclick="document.getElementById('modalRiwayatAbsensi').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="student-profile">
                    <div class="avatar"><i class="fa-solid fa-user"></i></div>
                    <div class="student-info">
                        <h4>Ali</h4>
                        <p>NIS: 2024001</p>
                        <p>Kelas 1A · Halaqah 1</p>
                    </div>
                </div>

                <div class="recap-stats">
                    <div class="recap-pill hadir">
                        <h5>22</h5>
                        <p>Hadir</p>
                    </div>
                    <div class="recap-pill sakit">
                        <h5>1</h5>
                        <p>Sakit</p>
                    </div>
                    <div class="recap-pill izin">
                        <h5>1</h5>
                        <p>Izin</p>
                    </div>
                    <div class="recap-pill alpa">
                        <h5>0</h5>
                        <p>Alpa</p>
                    </div>
                </div>

                <div class="history-section">
                    <h5>Riwayat 30 Hari Terakhir</h5>
                    <div class="table-responsive">
                        <table class="table-compact">
                            <thead>
                                <tr>
                                    <th>Tgl</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>23/06</td>
                                    <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Hadir</span></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>22/06</td>
                                    <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Hadir</span></td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>21/06</td>
                                    <td><span class="badge warning"><i class="fa-solid fa-notes-medical"></i> Sakit</span></td>
                                    <td>Demam</td>
                                </tr>
                                <tr>
                                    <td>20/06</td>
                                    <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Hadir</span></td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalRiwayatAbsensi').classList.remove('show')">Tutup</button>
            </div>
        </div>
    </div>

</body>
</html>

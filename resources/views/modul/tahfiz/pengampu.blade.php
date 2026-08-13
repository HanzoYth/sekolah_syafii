<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengampu - Tahfiz Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/pengampu.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <x-sidebar_tahfiz />

        <main class="main-content">

            <!-- 1. PAGE HEADER -->
            <div class="page-header">
                <div class="page-header-left">
                    <p class="breadcrumb">Tahfiz Digital / <span>Pengampu</span></p>
                    <h1>Pengampu</h1>
                </div>
                <div class="page-header-right">
                    <button class="btn-outline"><i class="fa-solid fa-file-export"></i> Export</button>
                    <button class="btn-primary-gold" onclick="document.getElementById('modalTambahPengampu').classList.add('show')">
                        <i class="fa-solid fa-plus"></i> Tambah Pengampu
                    </button>
                </div>
            </div>

            <!-- 2. RINGKASAN SINGKAT -->
            <div class="quick-stats">
                <div class="stat-pill success">
                    <i class="fa-solid fa-user-tie"></i>
                    <div>
                        <h4>13</h4>
                        <p>Pengampu Aktif</p>
                    </div>
                </div>
                <div class="stat-pill alert">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <h4>2</h4>
                        <p>Halaqah Belum Ada Pengampu</p>
                    </div>
                </div>
                <div class="stat-pill">
                    <i class="fa-solid fa-chart-line"></i>
                    <div>
                        <h4>89%</h4>
                        <p>Rata-rata Konsistensi Input</p>
                    </div>
                </div>
            </div>

            <!-- 3. FILTER & PENCARIAN -->
            <div class="toolbar-box">
                <div class="search-field">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama pengampu...">
                </div>
                <div class="toolbar-filters">
                    <select>
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                    <select>
                        <option>Semua Kelas</option>
                        <option>Kelas 1A</option>
                        <option>Kelas 2B</option>
                        <option>Kelas 3A</option>
                    </select>
                </div>
            </div>

            <!-- 4. TABEL DAFTAR PENGAMPU -->
            <div class="table-card">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Pengampu</th>
                                <th>Halaqah Diampu</th>
                                <th>Siswa</th>
                                <th>Konsistensi Input</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="person-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user-tie"></i></div>
                                        <span class="cell-strong">Ustadz Ahmad</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="halaqah-badges">
                                        <span class="mini-badge">1A - Halaqah 1</span>
                                    </div>
                                </td>
                                <td>12</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 96%;"></div>
                                    </div>
                                    <span class="progress-mini-label">96%</span>
                                </td>
                                <td><a href="#" class="contact-link"><i class="fa-brands fa-whatsapp"></i> 0812-3456-7890</a></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailPengampu').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Nonaktifkan" class="danger"><i class="fa-solid fa-user-slash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="person-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user-tie"></i></div>
                                        <span class="cell-strong">Ustadzah Aisyah</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="halaqah-badges">
                                        <span class="mini-badge">1A - Halaqah 2</span>
                                        <span class="mini-badge more">+1</span>
                                    </div>
                                </td>
                                <td>20</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 94%;"></div>
                                    </div>
                                    <span class="progress-mini-label">94%</span>
                                </td>
                                <td><a href="#" class="contact-link"><i class="fa-brands fa-whatsapp"></i> 0813-2233-4455</a></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailPengampu').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Nonaktifkan" class="danger"><i class="fa-solid fa-user-slash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="row-pending">
                                <td>
                                    <div class="person-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user-tie"></i></div>
                                        <span class="cell-strong">Ustadz Fajar</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="halaqah-badges">
                                        <span class="mini-badge">2B - Halaqah 1</span>
                                    </div>
                                </td>
                                <td>13</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 45%;"></div>
                                    </div>
                                    <span class="progress-mini-label">45%</span>
                                </td>
                                <td><a href="#" class="contact-link"><i class="fa-brands fa-whatsapp"></i> 0857-1122-3344</a></td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailPengampu').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Ingatkan" class="highlight"><i class="fa-solid fa-bell"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="person-cell">
                                        <div class="avatar-sm"><i class="fa-solid fa-user-tie"></i></div>
                                        <span class="cell-strong">Ustadzah Rina</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="halaqah-badges">
                                        <span class="mini-badge">3A - Halaqah 1</span>
                                    </div>
                                </td>
                                <td>10</td>
                                <td>
                                    <div class="progress-mini">
                                        <div class="progress-mini-fill" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-mini-label">100%</span>
                                </td>
                                <td><a href="#" class="contact-link"><i class="fa-brands fa-whatsapp"></i> 0821-9988-7766</a></td>
                                <td><span class="badge cuti"><i class="fa-solid fa-mug-hot"></i> Cuti</span></td>
                                <td>
                                    <div class="action-icons">
                                        <button title="Lihat Detail" onclick="document.getElementById('modalDetailPengampu').classList.add('show')"><i class="fa-solid fa-eye"></i></button>
                                        <button title="Edit"><i class="fa-solid fa-pen"></i></button>
                                        <button title="Nonaktifkan" class="danger"><i class="fa-solid fa-user-slash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 8. EMPTY STATE (tampil kalau belum ada pengampu terdaftar) -->
                {{--
                <div class="empty-state">
                    <i class="fa-solid fa-user-tie"></i>
                    <h4>Belum ada pengampu terdaftar</h4>
                    <p>Tambahkan pengampu pertama untuk mulai menugaskan halaqah.</p>
                    <button class="btn-primary-gold"><i class="fa-solid fa-plus"></i> Tambah Pengampu</button>
                </div>
                --}}
            </div>

        </main>
    </div>

    <!-- 5. MODAL TAMBAH / EDIT PENGAMPU -->
    <div class="modal-overlay" id="modalTambahPengampu">
        <div class="modal-box">
            <div class="modal-header">
                <h3>Tambah Pengampu</h3>
                <button class="modal-close" onclick="document.getElementById('modalTambahPengampu').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" placeholder="Contoh: Ustadz Yusuf">
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>No. HP / WA</label>
                        <input type="text" placeholder="08xxxxxxxxxx">
                    </div>
                    <div class="form-group">
                        <label>Email (opsional)</label>
                        <input type="email" placeholder="nama@email.com">
                    </div>
                </div>
                <div class="form-group">
                    <label>Assign ke Halaqah</label>
                    <div class="checkbox-list">
                        <label class="checkbox-item"><input type="checkbox"> Kelas 2B - Halaqah 3</label>
                        <label class="checkbox-item"><input type="checkbox"> Kelas 1A - Halaqah 3 (belum dibuat)</label>
                    </div>
                    <p class="field-hint">Bisa dikosongkan dulu, di-assign belakangan dari halaman Kelas & Halaqah.</p>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Cuti</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalTambahPengampu').classList.remove('show')">Batal</button>
                <button class="btn-primary-gold">Simpan</button>
            </div>
        </div>
    </div>

    <!-- 6 & 7. MODAL DETAIL PENGAMPU (profil + tab grafik + alih tugas) -->
    <div class="modal-overlay" id="modalDetailPengampu">
        <div class="modal-box modal-box-lg">
            <div class="modal-header">
                <div>
                    <span class="modal-header-tag">DETAIL PENGAMPU</span>
                    <h3>Ustadz Ahmad</h3>
                    <p class="modal-subtitle">Bergabung sejak 12 Januari 2024</p>
                </div>
                <button class="modal-close" onclick="document.getElementById('modalDetailPengampu').classList.remove('show')"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="detail-pengampu-grid">

                    <!-- KOLOM KIRI: PROFIL, KONTAK, HALAQAH DIAMPU -->
                    <div class="detail-pengampu-col">
                        <div class="person-profile">
                            <div class="avatar"><i class="fa-solid fa-user-tie"></i></div>
                            <div class="person-info">
                                <h4>Ustadz Ahmad</h4>
                                <p>0812-3456-7890</p>
                                <span class="badge success"><i class="fa-solid fa-circle-check"></i> Aktif</span>
                            </div>
                        </div>

                        <div class="info-box">
                            <h5><i class="fa-solid fa-book-quran"></i> Halaqah Diampu</h5>

                            <div class="assigned-row">
                                <div>
                                    <p class="assigned-name">Kelas 1A - Halaqah 1</p>
                                    <p class="assigned-meta">12 siswa</p>
                                </div>
                                <button class="btn-xs-outline" title="Pindahkan halaqah ini ke pengampu lain">
                                    <i class="fa-solid fa-right-left"></i> Pindahkan
                                </button>
                            </div>
                        </div>

                        <div class="info-box">
                            <h5><i class="fa-solid fa-users"></i> Statistik Siswa Asuhan</h5>
                            <div class="mini-stat-row">
                                <div class="mini-stat green">
                                    <h4>9</h4>
                                    <p>Capai Target</p>
                                </div>
                                <div class="mini-stat red">
                                    <h4>3</h4>
                                    <p>Perlu Perhatian</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: TAB GRAFIK KONSISTENSI -->
                    <div class="detail-pengampu-col">
                        <div class="chart-box">
                            <div class="tab-switch">
                                <button class="tab-btn active" onclick="switchTab(event, 'tabHarian')">Harian</button>
                                <button class="tab-btn" onclick="switchTab(event, 'tabMingguan')">Mingguan</button>
                                <button class="tab-btn" onclick="switchTab(event, 'tabBulanan')">Bulanan</button>
                            </div>

                            <!-- TAB HARIAN (7 hari terakhir) -->
                            <div class="tab-panel active" id="tabHarian">
                                <div class="dummy-chart">
                                    <div class="bar" style="height: 100%;"></div>
                                    <div class="bar" style="height: 100%;"></div>
                                    <div class="bar" style="height: 0%;"></div>
                                    <div class="bar" style="height: 100%;"></div>
                                    <div class="bar" style="height: 100%;"></div>
                                    <div class="bar" style="height: 100%;"></div>
                                    <div class="bar" style="height: 100%;"></div>
                                </div>
                                <div class="chart-labels">
                                    <span>17/06</span><span>18/06</span><span>19/06</span><span>20/06</span><span>21/06</span><span>22/06</span><span>23/06</span>
                                </div>
                            </div>

                            <!-- TAB MINGGUAN (4 minggu terakhir) -->
                            <div class="tab-panel" id="tabMingguan">
                                <div class="dummy-chart">
                                    <div class="bar" style="height: 90%;"></div>
                                    <div class="bar" style="height: 100%;"></div>
                                    <div class="bar" style="height: 80%;"></div>
                                    <div class="bar" style="height: 96%;"></div>
                                </div>
                                <div class="chart-labels">
                                    <span>Minggu 1</span><span>Minggu 2</span><span>Minggu 3</span><span>Minggu 4</span>
                                </div>
                            </div>

                            <!-- TAB BULANAN (6 bulan terakhir) -->
                            <div class="tab-panel" id="tabBulanan">
                                <div class="dummy-chart">
                                    <div class="bar" style="height: 70%;"></div>
                                    <div class="bar" style="height: 85%;"></div>
                                    <div class="bar" style="height: 78%;"></div>
                                    <div class="bar" style="height: 92%;"></div>
                                    <div class="bar" style="height: 88%;"></div>
                                    <div class="bar" style="height: 96%;"></div>
                                </div>
                                <div class="chart-labels">
                                    <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>Mei</span><span>Jun</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-back" onclick="document.getElementById('modalDetailPengampu').classList.remove('show')">Tutup</button>
                <button class="btn-primary-gold"><i class="fa-solid fa-pen"></i> Edit Pengampu</button>
            </div>
        </div>
    </div>

    <script>
        function switchTab(evt, panelId) {
            const modal = evt.target.closest('.chart-box');
            modal.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            modal.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));
            evt.target.classList.add('active');
            document.getElementById(panelId).classList.add('active');
        }
    </script>

</body>
</html>
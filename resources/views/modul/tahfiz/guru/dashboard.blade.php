<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard guru - Tahfiz Digital</title>
    <!-- Google Fonts: Amiri + Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Utama (Sudah Termasuk Styling Modal) -->
    <link rel="stylesheet" href="{{ asset('css/modul/tahfiz/dashboard.css') }}?v={{ time() }}">
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- SIDEBAR -->
        <x-sidebar_tahfiz />

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR / HEADER -->
            <header class="topbar">
                <div>
                    <h2>Monitoring Halaqah & Laporan Harian</h2>
                </div>
                <div class="topbar-icons">
                    <i class="fa-regular fa-bell" title="Notifikasi"></i>
                    <i class="fa-regular fa-user" title="Profil Admin"></i>
                </div>
            </header>

            <!-- SUBTITLE ACTION BAR -->
            <div class="detail-action-bar mb-20" style="margin-bottom: 24px;">
                <div class="action-left">
                    <p class="subtitle-text">Kelola dan pantau seluruh aktivitas halaqah tahfiz secara real-time.</p>
                </div>
            </div>

            <!-- STATISTIC CARDS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>300</h3>
                    <p>Total Siswa Aktif</p>
                </div>
                <div class="stat-card">
                    <h3>15</h3>
                    <p>Total Halaqah</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--green-text);">
                    <h3 class="text-green">11</h3>
                    <p>Sudah Input Hari Ini</p>
                </div>
                <div class="stat-card" style="border-top-color: var(--red-text);">
                    <h3 style="color: var(--red-text);">4</h3>
                    <p>Belum Input Hari Ini</p>
                </div>
            </div>

            <!-- SUMMARY & FILTER SECTION -->
            <div class="summary-filter-row">
                <div class="summary-box">
                    <h4><i class="fa-solid fa-chart-pie"></i> Ringkasan Status Input Tanggal {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</h4>
                    <div class="summary-cards">
                        <div class="sum-card green">
                            <h3>11</h3>
                            <p>Halaqah Selesai</p>
                        </div>
                        <div class="sum-card yellow">
                            <h3>0</h3>
                            <p>Proses Input</p>
                        </div>
                        <div class="sum-card red">
                            <h3>4</h3>
                            <p>Belum Menyetor</p>
                        </div>
                    </div>
                </div>

                <div class="filter-box">
                    <h4><i class="fa-solid fa-filter"></i> Filter Data</h4>
                    <div class="filter-group">
                        <label for="tanggal">Pilih Tanggal:</label>
                        <input type="date" id="tanggal" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="filter-group" style="margin-bottom: 0;">
                        <label for="kelas">Pilih Kelas:</label>
                        <select id="kelas">
                            <option value="">Semua Kelas</option>
                            <option value="1">Kelas 1</option>
                            <option value="2">Kelas 2</option>
                            <option value="3">Kelas 3</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- DETAIL PER HALAQAH -->
            <div class="table-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
                    <h4><i class="fa-solid fa-list-check"></i> Status & Detail Seluruh Halaqah</h4>
                    <span class="detail-header-tag"><i class="fa-solid fa-users"></i> Total 15 Halaqah Aktif</span>
                </div>

                <div class="table-responsive">
                    <table class="table-compact">
                        <thead>
                            <tr>
                                <th>Kelas & Halaqah</th>
                                <th>Pengampu / Guru</th>
                                <th>Jumlah Siswa</th>
                                <th>Status Input Hari Ini</th>
                                <th>Tanggal & Waktu</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $currentDate = date('d/m/Y'); @endphp

                            <!-- Halaqah 1 -->
                            <tr>
                                <td class="cell-strong"><strong>Kelas 1A</strong> - Halaqah 1</td>
                                <td>Ustadz Ahmad, S.Pd.</td>
                                <td>20 Siswa</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah Input</span></td>
                                <td class="text-sm">{{ $currentDate }} (08:15 WIB)</td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail" 
                                        data-halaqah="Kelas 1A - Halaqah 1" 
                                        data-guru="Ustadz Ahmad, S.Pd." 
                                        data-total="20 Siswa" 
                                        data-sudah="20 Siswa" 
                                        data-belum="0 Siswa" 
                                        data-status="Sudah Input" 
                                        data-waktu="{{ $currentDate }} 08:15 WIB">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Halaqah 2 -->
                            <tr>
                                <td class="cell-strong"><strong>Kelas 1A</strong> - Halaqah 2</td>
                                <td>Ustadzah Aisyah, Lc.</td>
                                <td>18 Siswa</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Sudah Input</span></td>
                                <td class="text-sm">{{ $currentDate }} (08:02 WIB)</td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail" 
                                        data-halaqah="Kelas 1A - Halaqah 2" 
                                        data-guru="Ustadzah Aisyah, Lc." 
                                        data-total="18 Siswa" 
                                        data-sudah="18 Siswa" 
                                        data-belum="0 Siswa" 
                                        data-status="Sudah Input" 
                                        data-waktu="{{ $currentDate }} 08:02 WIB">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Halaqah Belum Input 1 -->
                            <tr>
                                <td class="cell-strong"><strong>Kelas 2B</strong> - Halaqah 1</td>
                                <td>Ustadz Fajar Pratama</td>
                                <td>22 Siswa</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum Input</span></td>
                                <td class="text-sm">-</td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail" style="background: var(--red-bg); color: var(--red-text); border-color: var(--border-color);" 
                                        data-halaqah="Kelas 2B - Halaqah 1" 
                                        data-guru="Ustadz Fajar Pratama" 
                                        data-total="22 Siswa" 
                                        data-sudah="0 Siswa" 
                                        data-belum="22 Siswa" 
                                        data-status="Belum Input" 
                                        data-waktu="-">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Halaqah Belum Input 2 -->
                            <tr>
                                <td class="cell-strong"><strong>Kelas 2B</strong> - Halaqah 3</td>
                                <td>Belum Ditentukan</td>
                                <td>19 Siswa</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum Input</span></td>
                                <td class="text-sm">-</td>
                                <td class="text-center">
                                    <button type="button" class="btn-xs btn-detail" style="background: var(--red-bg); color: var(--red-text); border-color: var(--border-color);" 
                                        data-halaqah="Kelas 2B - Halaqah 3" 
                                        data-guru="Belum Ditentukan" 
                                        data-total="19 Siswa" 
                                        data-sudah="0 Siswa" 
                                        data-belum="19 Siswa" 
                                        data-status="Belum Input" 
                                        data-waktu="-">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <!-- MODAL POP-UP DETAIL HALAQAH -->
    <div class="modal-overlay" id="detailModal">
        <div class="modal-container">
            <div class="modal-header">
                <h3><i class="fa-solid fa-circle-info"></i> Detail Laporan Halaqah</h3>
                <button type="button" class="modal-close" onclick="closeDetailModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="modal-detail-list">
                    <div class="detail-item">
                        <span class="detail-label">Kelas & Halaqah:</span>
                        <span class="detail-value" id="modalHalaqah">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Pengampu / Guru:</span>
                        <span class="detail-value" id="modalGuru">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Total Siswa Halaqah:</span>
                        <span class="detail-value" id="modalTotalSiswa">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Sudah Input (Setor):</span>
                        <span class="detail-value text-green" id="modalSudahInput">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Belum Input (Belum Setor):</span>
                        <span class="detail-value" style="color: var(--red-text);" id="modalBelumInput">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status Input:</span>
                        <span class="detail-value" id="modalStatus">-</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Waktu Input:</span>
                        <span class="detail-value" id="modalWaktu">-</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()">Tutup</button>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT AMAN & BERSIH -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detailButtons = document.querySelectorAll('.btn-detail');
            const modal = document.getElementById('detailModal');

            detailButtons.forEach(button => {
                button.addEventListener('click', function () {
                    document.getElementById('modalHalaqah').innerText = this.getAttribute('data-halaqah');
                    document.getElementById('modalGuru').innerText = this.getAttribute('data-guru');
                    document.getElementById('modalTotalSiswa').innerText = this.getAttribute('data-total');
                    document.getElementById('modalSudahInput').innerText = this.getAttribute('data-sudah');
                    document.getElementById('modalBelumInput').innerText = this.getAttribute('data-belum');
                    document.getElementById('modalStatus').innerText = this.getAttribute('data-status');
                    document.getElementById('modalWaktu').innerText = this.getAttribute('data-waktu');
                    
                    modal.classList.add('active');
                });
            });
        });

        function closeDetailModal() {
            document.getElementById('detailModal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeDetailModal();
            }
        }
    </script>
</body>
</html>
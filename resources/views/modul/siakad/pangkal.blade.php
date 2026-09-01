<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Uang Pangkal - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet dashboard SIAKAD --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaran.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pangkal.css') }}">
</head>
<body>

    <div class="dashboard-container">

        {{-- WADAH TEMPLATE SIDEBAR --}}
        <x-sidebar_siakad />

        {{-- MAIN CONTENT --}}
        <main class="main-content">

            {{-- TOPBAR / HEADER --}}
            <header class="topbar">
                <div class="topbar-left">
                    <span class="topbar-eyebrow">Sistem Informasi Akademik &middot; Selasa, 04 Agustus 2026</span>
                    <h2>Pembayaran Uang Pangkal</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2026/2027 &middot; Penerimaan Siswa Baru
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK UANG PANGKAL --}}
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    <div>
                        <h3>Rp 425.000.000</h3>
                        <p>Total Target Uang Pangkal</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-vault"></i></div>
                    <div>
                        <h3>Rp 310.500.000</h3>
                        <p>Total Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h3>62</h3>
                        <p>Siswa Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-warning"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div>
                        <h3>23</h3>
                        <p>Siswa Mengangsur</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN UANG PANGKAL --}}
            <div class="filter-box pembayaran-filter">
                <h4> Uang Pangkal</h4>
                <div class="filter-group">
                  
                    <div class="input-wrap">
                        <label for="filter-status-pangkal">Status Pembayaran</label>
                        <select id="filter-status-pangkal" name="status_pangkal">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="angsuran">Mengangsur</option>
                            <option value="belum">Belum Bayar</option>
                        </select>
                    </div>
                  
                    <div class="input-wrap">
                        <label for="filter-status-pangkal">kelas</label>
                        <select id="filter-status-pangkal" name="kelas">
                            <option value="">Semua kelas</option>
                            <option value="lunas">kelas 1a</option>
                            <option value="angsuran">kelas 7a</option>
                            <option value="belum">kelas 8b</option>
                        </select>
                    </div>
                    <div class="input-wrap">
                        <label for="filter-bulan-spp">Bulan & Tahun</label>
                        <input type="month" id="filter-bulan-spp" name="bulan_spp" class="input-date-custom">
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR UANG PANGKAL --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Tagihan Uang Pangkal Siswa Baru</h4>
                 
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>No. Registrasi</th>
                                <th>Nama Siswa</th>
                                <th>Jenjang / Kelas</th>
                                <th>Total Tagihan</th>
                                <th>Terbayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="reg-number">REG-2026-001</span></td>
                                <td><span class="student-name">Ahmad Raihan</span></td>
                                <td><span class="class-pill">SD - 1A</span></td>
                                <td class="amount">Rp 5.000.000</td>
                                <td class="amount text-success">Rp 5.000.000</td>
                                <td class="amount">Rp 0</td>
                                <td style="width: 130px;">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar bg-success" style="width: 100%;"></div>
                                    </div>
                                    <span class="progress-text">100%</span>
                                </td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Lunas</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Ahmad Raihan', 'REG-2026-001', '5000000', '5000000', '0')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('Ahmad Raihan', 'REG-2026-001', '5000000', '5000000', '0')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="reg-number">REG-2026-014</span></td>
                                <td><span class="student-name">Dewi Lestari</span></td>
                                <td><span class="class-pill">SMP - 7A</span></td>
                                <td class="amount">Rp 6.000.000</td>
                                <td class="amount text-success">Rp 3.000.000</td>
                                <td class="amount text-danger">Rp 3.000.000</td>
                                <td style="width: 130px;">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar bg-warning" style="width: 50%;"></div>
                                    </div>
                                    <span class="progress-text">50%</span>
                                </td>
                                <td><span class="badge warning"><i class="fa-solid fa-clock-rotate-left"></i> Angsuran (1/2)</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Dewi Lestari', 'REG-2026-014', '6000000', '3000000', '3000000')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('Dewi Lestari', 'REG-2026-014', '6000000', '3000000', '3000000')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="reg-number">REG-2026-028</span></td>
                                <td><span class="student-name">Fajar Maulana</span></td>
                                <td><span class="class-pill">TK - B1</span></td>
                                <td class="amount">Rp 4.000.000</td>
                                <td class="amount text-success">Rp 1.000.000</td>
                                <td class="amount text-danger">Rp 3.000.000</td>
                                <td style="width: 130px;">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar bg-warning" style="width: 25%;"></div>
                                    </div>
                                    <span class="progress-text">25%</span>
                                </td>
                                <td><span class="badge warning"><i class="fa-solid fa-clock-rotate-left"></i> Angsuran (1/4)</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Fajar Maulana', 'REG-2026-028', '4000000', '1000000', '3000000')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('Fajar Maulana', 'REG-2026-028', '4000000', '1000000', '3000000')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="reg-number">REG-2026-045</span></td>
                                <td><span class="student-name">Gita Gutawa</span></td>
                                <td><span class="class-pill">SD - 1B</span></td>
                                <td class="amount">Rp 5.000.000</td>
                                <td class="amount text-success">Rp 0</td>
                                <td class="amount text-danger">Rp 5.000.000</td>
                                <td style="width: 130px;">
                                    <div class="progress-bar-container">
                                        <div class="progress-bar bg-danger" style="width: 0%;"></div>
                                    </div>
                                    <span class="progress-text">0%</span>
                                </td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Belum Bayar</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Gita Gutawa', 'REG-2026-045', '5000000', '0', '5000000')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('Gita Gutawa', 'REG-2026-045', '5000000', '0', '5000000')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER CARD / PAGINATION --}}
                <div class="card-footer">
                    <span class="card-footer-info">Menampilkan 4 dari 85 data tagihan uang pangkal</span>
                    <div class="pagination">
                        <button disabled><i class="fa-solid fa-chevron-left"></i> Sebelumnya</button>
                        <button class="active">1</button>
                        <button>2</button>
                        <button>3</button>
                        <button>Selanjutnya <i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL INPUT TRANSAKSI / ANGSURAN --}}
    <div id="modalBayarPangkal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Pembayaran Uang Pangkal</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="#" method="POST" class="modal-body">
                @csrf
                <div class="modal-field">
                    <label>No. Registrasi / Nama Siswa</label>
                    <input type="text" id="modal-bayar-siswa" readonly disabled class="input-readonly">
                </div>
                <div class="modal-row-2">
                    <div class="modal-field">
                        <label>Total Tagihan</label>
                        <input type="text" id="modal-bayar-total" readonly disabled class="input-readonly">
                    </div>
                    <div class="modal-field">
                        <label>Sisa Tanggungan</label>
                        <input type="text" id="modal-bayar-sisa" readonly disabled class="input-readonly text-danger font-bold">
                    </div>
                </div>
                <div class="modal-field">
                    <label for="bayar-nominal">Nominal Pembayaran Saat Ini (Rp)</label>
                    <input type="number" id="bayar-nominal" name="nominal_bayar" placeholder="Masukkan jumlah yang dibayarkan" required>
                </div>
                <div class="modal-field">
                    <label for="bayar-metode">Metode Pembayaran</label>
                    <select id="bayar-metode" name="metode_pembayaran" required>
                        <option value="transfer">Transfer Bank (BSI / Mandiri)</option>
                        <option value="tunai">Tunai / Kasir Sekolah</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>
                <div class="modal-field">
                    <label for="bayar-catatan">Keterangan / Catatan (Opsional)</label>
                    <input type="text" id="bayar-catatan" name="catatan" placeholder="Contoh: Cicilan ke-2 via transfer BSI">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeBayarModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-receipt"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DETAIL RIWAYAT ANGSURAN --}}
    <div id="modalDetailPangkal" class="modal-overlay">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <h3>Riwayat Pembayaran Uang Pangkal</h3>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="student-info-summary">
                    <div>
                        <small>Siswa</small>
                        <h4 id="detail-nama">Ahmad Raihan</h4>
                    </div>
                    <div>
                        <small>No. Reg</small>
                        <h4 id="detail-reg">REG-2026-001</h4>
                    </div>
                    <div>
                        <small>Status</small>
                        <span id="detail-status-badge" class="badge success">Lunas</span>
                    </div>
                </div>

                <h5 class="history-title"><i class="fa-solid fa-history"></i> Log Transaksi Masuk</h5>
                <div class="history-table-wrap">
                    <table class="table-history">
                        <thead>
                            <tr>
                                <th>Tgl Transaksi</th>
                                <th>Keterangan</th>
                                <th>Metode</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="detail-history-body">
                            <!-- Populated via Javascript -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
                    <button type="button" class="btn-action view" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak Bukti</button>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT --}}
    <script>
        function openBayarModal(nama, reg, total, terbayar, sisa) {
            document.getElementById('modal-bayar-siswa').value = `${reg} - ${nama}`;
            document.getElementById('modal-bayar-total').value = 'Rp ' + parseInt(total).toLocaleString('id-ID');
            document.getElementById('modal-bayar-sisa').value = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');
            document.getElementById('bayar-nominal').max = sisa;
            
            document.getElementById('modalBayarPangkal').classList.add('active');
        }

        function closeBayarModal() {
            document.getElementById('modalBayarPangkal').classList.remove('active');
        }

        function openDetailModal(nama, reg, total, terbayar, sisa) {
            document.getElementById('detail-nama').innerText = nama;
            document.getElementById('detail-reg').innerText = reg;

            const historyBody = document.getElementById('detail-history-body');
            if(parseInt(sisa) === 0) {
                document.getElementById('detail-status-badge').className = 'badge success';
                document.getElementById('detail-status-badge').innerText = 'Lunas';
                historyBody.innerHTML = `
                    <tr>
                        <td>01/08/2026</td>
                        <td>Pembayaran Pelunasan Uang Pangkal</td>
                        <td>Transfer BSI</td>
                        <td class="text-success font-bold">Rp ${parseInt(total).toLocaleString('id-ID')}</td>
                    </tr>`;
            } else if (parseInt(terbayar) > 0) {
                document.getElementById('detail-status-badge').className = 'badge warning';
                document.getElementById('detail-status-badge').innerText = 'Mengangsur';
                historyBody.innerHTML = `
                    <tr>
                        <td>15/07/2026</td>
                        <td>Pembayaran Angsuran ke-1</td>
                        <td>Tunai</td>
                        <td class="text-success font-bold">Rp ${parseInt(terbayar).toLocaleString('id-ID')}</td>
                    </tr>`;
            } else {
                document.getElementById('detail-status-badge').className = 'badge danger';
                document.getElementById('detail-status-badge').innerText = 'Belum Bayar';
                historyBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center" style="color: #94a3b8;">Belum ada riwayat transaksi.</td>
                    </tr>`;
            }

            document.getElementById('modalDetailPangkal').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('modalDetailPangkal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modalBayar = document.getElementById('modalBayarPangkal');
            const modalDetail = document.getElementById('modalDetailPangkal');
            if (event.target === modalBayar) closeBayarModal();
            if (event.target === modalDetail) closeDetailModal();
        }
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pembayaran Pendidikan - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pembayaran.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pendidikan.css') }}">
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
                    <h2>Pembayaran2 Pendidikan</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2026/2027 &middot; Semester Genap
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK PEMBAYARAN PENDIDIKAN --}}
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-wallet"></i></div>
                    <div>
                        <h3>Rp 185.000.000</h3>
                        <p>Target SPP Bulan Ini</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-circle-dollar-to-slot"></i></div>
                    <div>
                        <h3>Rp 142.500.000</h3>
                        <p>Total SPP Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h3>285</h3>
                        <p>Siswa Lunas SPP</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-danger"><i class="fa-solid fa-user-xmark"></i></div>
                    <div>
                        <h3>85</h3>
                        <p>Siswa Menunggak</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN PENDIDIKAN --}}
            <div class="filter-box pembayaran-filter">
                <h4><i class="fa-solid fa-filter"></i> Filter Tagihan SPP</h4>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-status-spp">Status SPP</label>
                        <select id="filter-status-spp" name="status_spp">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="tunggakan">Menunggak</option>
                        </select>
                    </div>
                  
                    <div class="input-wrap">
                        <label for="filter-kelas-spp">Kelas</label>
                        <select id="filter-kelas-spp" name="kelas">
                            <option value="">Semua Kelas</option>
                            <option value="1a">Kelas 1A</option>
                            <option value="7a">Kelas 7A</option>
                            <option value="8b">Kelas 8B</option>
                        </select>
                    </div>

                    <div class="input-wrap">
                        <label for="filter-bulan-spp">Bulan & Tahun</label>
                        <input type="month" id="filter-bulan-spp" name="bulan_spp" class="input-date-custom">
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR TAGIHAN SPP --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Tagihan SPP Bulanan Siswa</h4>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Bulan Tagihan</th>
                                <th>Nominal SPP</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="reg-number">NISN-2026-001</span></td>
                                <td><span class="student-name">Ahmad Raihan</span></td>
                                <td><span class="class-pill">SD - 1A</span></td>
                                <td><span class="month-pill">Agustus 2026</span></td>
                                <td class="amount">Rp 500.000</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Lunas</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Ahmad Raihan', 'NISN-2026-001', '500000', 'Agustus 2026', 'lunas')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar SPP" onclick="openBayarModal('Ahmad Raihan', 'NISN-2026-001', '500000', 'Agustus 2026')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="reg-number">NISN-2026-014</span></td>
                                <td><span class="student-name">Dewi Lestari</span></td>
                                <td><span class="class-pill">SMP - 7A</span></td>
                                <td><span class="month-pill">Agustus 2026</span></td>
                                <td class="amount">Rp 650.000</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Menunggak</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Dewi Lestari', 'NISN-2026-014', '650000', 'Agustus 2026', 'belum')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar SPP" onclick="openBayarModal('Dewi Lestari', 'NISN-2026-014', '650000', 'Agustus 2026')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="reg-number">NISN-2026-028</span></td>
                                <td><span class="student-name">Fajar Maulana</span></td>
                                <td><span class="class-pill">TK - B1</span></td>
                                <td><span class="month-pill">Agustus 2026</span></td>
                                <td class="amount">Rp 450.000</td>
                                <td><span class="badge success"><i class="fa-solid fa-circle-check"></i> Lunas</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Fajar Maulana', 'NISN-2026-028', '450000', 'Agustus 2026', 'lunas')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar SPP" onclick="openBayarModal('Fajar Maulana', 'NISN-2026-028', '450000', 'Agustus 2026')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="reg-number">NISN-2026-045</span></td>
                                <td><span class="student-name">Gita Gutawa</span></td>
                                <td><span class="class-pill">SD - 1B</span></td>
                                <td><span class="month-pill">Agustus 2026</span></td>
                                <td class="amount">Rp 500.000</td>
                                <td><span class="badge danger"><i class="fa-solid fa-circle-xmark"></i> Menunggak</span></td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Detail Riwayat" onclick="openDetailModal('Gita Gutawa', 'NISN-2026-045', '500000', 'Agustus 2026', 'belum')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar SPP" onclick="openBayarModal('Gita Gutawa', 'NISN-2026-045', '500000', 'Agustus 2026')"><i class="fa-solid fa-cash-register"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- FOOTER CARD / PAGINATION --}}
                <div class="card-footer">
                    <span class="card-footer-info">Menampilkan 4 dari 370 data SPP siswa</span>
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

    {{-- MODAL INPUT TRANSAKSI SPP --}}
    <div id="modalBayarPendidikan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Transaksi SPP</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="#" method="POST" class="modal-body">
                @csrf
                <div class="modal-field">
                    <label>NISN / Nama Siswa</label>
                    <input type="text" id="modal-bayar-siswa" readonly disabled class="input-readonly">
                </div>
                <div class="modal-row-2">
                    <div class="modal-field">
                        <label>Periode Tagihan</label>
                        <input type="text" id="modal-bayar-periode" readonly disabled class="input-readonly">
                    </div>
                    <div class="modal-field">
                        <label>Nominal SPP</label>
                        <input type="text" id="modal-bayar-nominal-tagihan" readonly disabled class="input-readonly font-bold">
                    </div>
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
                    <input type="text" id="bayar-catatan" name="catatan" placeholder="Contoh: SPP Bulan Agustus via QRIS">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeBayarModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-receipt"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DETAIL RIWAYAT SPP --}}
    <div id="modalDetailPendidikan" class="modal-overlay">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <h3>Riwayat Pembayaran SPP Siswa</h3>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="student-info-summary">
                    <div>
                        <small>Siswa</small>
                        <h4 id="detail-nama">Ahmad Raihan</h4>
                    </div>
                    <div>
                        <small>NISN</small>
                        <h4 id="detail-nisn">NISN-2026-001</h4>
                    </div>
                    <div>
                        <small>Status Tagihan</small>
                        <span id="detail-status-badge" class="badge success">Lunas</span>
                    </div>
                </div>

                <h5 class="history-title"><i class="fa-solid fa-history"></i> Log Transaksi Masuk</h5>
                <div class="history-table-wrap">
                    <table class="table-history">
                        <thead>
                            <tr>
                                <th>Tgl Transaksi</th>
                                <th>Periode SPP</th>
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
        function openBayarModal(nama, nisn, nominal, periode) {
            document.getElementById('modal-bayar-siswa').value = `${nisn} - ${nama}`;
            document.getElementById('modal-bayar-periode').value = periode;
            document.getElementById('modal-bayar-nominal-tagihan').value = 'Rp ' + parseInt(nominal).toLocaleString('id-ID');
            
            document.getElementById('modalBayarPendidikan').classList.add('active');
        }

        function closeBayarModal() {
            document.getElementById('modalBayarPendidikan').classList.remove('active');
        }

        function openDetailModal(nama, nisn, nominal, periode, status) {
            document.getElementById('detail-nama').innerText = nama;
            document.getElementById('detail-nisn').innerText = nisn;

            const historyBody = document.getElementById('detail-history-body');
            if(status === 'lunas') {
                document.getElementById('detail-status-badge').className = 'badge success';
                document.getElementById('detail-status-badge').innerText = 'Lunas';
                historyBody.innerHTML = `
                    <tr>
                        <td>02/08/2026</td>
                        <td>SPP ${periode}</td>
                        <td>Transfer BSI</td>
                        <td class="text-success font-bold">Rp ${parseInt(nominal).toLocaleString('id-ID')}</td>
                    </tr>`;
            } else {
                document.getElementById('detail-status-badge').className = 'badge danger';
                document.getElementById('detail-status-badge').innerText = 'Menunggak';
                historyBody.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center" style="color: #94a3b8;">Belum ada pembayaran untuk periode ini.</td>
                    </tr>`;
            }

            document.getElementById('modalDetailPendidikan').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('modalDetailPendidikan').classList.remove('active');
        }

        window.onclick = function(event) {
            const modalBayar = document.getElementById('modalBayarPendidikan');
            const modalDetail = document.getElementById('modalDetailPendidikan');
            if (event.target === modalBayar) closeBayarModal();
            if (event.target === modalDetail) closeDetailModal();
        }
    </script>

</body>
</html>
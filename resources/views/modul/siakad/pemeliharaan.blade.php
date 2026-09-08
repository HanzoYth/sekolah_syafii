<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Uang Pemeliharaan - SIAKAD</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Font Awesome Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pemeliharaan.css') }}">
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
                    <h2>Pembayaran Biaya Pemeliharaan</h2>
                </div>

                <div class="academic-pill">
                    <i class="fa-solid fa-calendar-check"></i>
                    T.A. 2026/2027 &middot; Fasilitas & Infrastruktur
                </div>

                <div class="topbar-icons">
                    <div class="icon-bell-wrap">
                        <i class="fa-regular fa-bell"></i>
                    </div>
                    <i class="fa-regular fa-user"></i>
                </div>
            </header>

            {{-- STATISTIK UANG PEMELIHARAAN --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-screwdriver-wrench"></i></div>
                    <div>
                        <h3>Rp 150.000.000</h3>
                        <p>Total Target Pemeliharaan</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <div>
                        <h3>Rp 105.000.000</h3>
                        <p>Total Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h3>70</h3>
                        <p>Siswa Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-warning"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div>
                        <h3>30</h3>
                        <p>Siswa Belum Lunas</p>
                    </div>
                </div>
            </div>

            {{-- FILTER PEMBAYARAN --}}
            <div class="filter-box">
                <h4>Biaya Pemeliharaan</h4>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-status-pemeliharaan">Status Pembayaran</label>
                        <select id="filter-status-pemeliharaan" name="status_pemeliharaan">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="menunggak">Menunggak</option>
                        </select>
                    </div>

                    <div class="input-wrap">
                        <label for="filter-kelas-pemeliharaan">Kelas</label>
                        <select id="filter-kelas-pemeliharaan" name="kelas">
                            <option value="">Semua Kelas</option>
                            <option value="X IPA 1">X IPA 1</option>
                            <option value="X IPA 2">X IPA 2</option>
                            <option value="XI IPS 1">XI IPS 1</option>
                            <option value="XII IPA 1">XII IPA 1</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- TABEL DAFTAR UANG PEMELIHARAAN --}}
            <div class="table-card">
                <div class="table-header">
                    <h4>Daftar Tagihan Uang Pemeliharaan Siswa</h4>
                </div>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Kelas</th>
                                <th>Nominal</th>
                                <th>Terbayar</th>
                                <th>Sisa Tagihan</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Dummy Data 1 -->
                            <tr>
                                <td><span class="student-name">Ahmad Rizky</span></td>
                                <td><span class="class-pill">X IPA 1</span></td>
                                <td class="amount">Rp 1.500.000</td>
                                <td class="amount text-success">Rp 1.500.000</td>
                                <td class="amount text-danger">Rp 0</td>
                                <td class="status">
                                    <span class="badge success">
                                        <i class="fa-solid fa-check"></i> Lunas
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Ahmad Rizky', '2026001', '1500000', '1500000', '0', '1')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('1','Ahmad Rizky', '2026001', '1500000','0','1')"><i class="fa-solid fa-cash-register"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('101', 'Ahmad Rizky', '2026001')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('1', 'Ahmad Rizky', '2026001')"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dummy Data 2 -->
                            <tr>
                                <td><span class="student-name">Siti Nurhaliza</span></td>
                                <td><span class="class-pill">X IPA 2</span></td>
                                <td class="amount">Rp 1.500.000</td>
                                <td class="amount text-success">Rp 1.000.000</td>
                                <td class="amount text-danger">Rp 500.000</td>
                                <td class="status">
                                    <span class="badge danger">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Menunggak
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Siti Nurhaliza', '2026002', '1500000', '1000000', '500000', '0')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('2','Siti Nurhaliza', '2026002', '1500000','500000','0')"><i class="fa-solid fa-cash-register"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('102', 'Siti Nurhaliza', '2026002')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('2', 'Siti Nurhaliza', '2026002')"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dummy Data 3 -->
                            <tr>
                                <td><span class="student-name">Budi Pratama</span></td>
                                <td><span class="class-pill">XI IPS 1</span></td>
                                <td class="amount">Rp 1.500.000</td>
                                <td class="amount text-success">Rp 0</td>
                                <td class="amount text-danger">Rp 1.500.000</td>
                                <td class="status">
                                    <span class="badge danger">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Menunggak
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Budi Pratama', '2026003', '1500000', '0', '1500000', '0')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('3','Budi Pratama', '2026003', '1500000','1500000','0')"><i class="fa-solid fa-cash-register"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('103', 'Budi Pratama', '2026003')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('3', 'Budi Pratama', '2026003')"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dummy Data 4 -->
                            <tr>
                                <td><span class="student-name">Dewi Lestari</span></td>
                                <td><span class="class-pill">XII IPA 1</span></td>
                                <td class="amount">Rp 1.500.000</td>
                                <td class="amount text-success">Rp 1.500.000</td>
                                <td class="amount text-danger">Rp 0</td>
                                <td class="status">
                                    <span class="badge success">
                                        <i class="fa-solid fa-check"></i> Lunas
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Dewi Lestari', '2026004', '1500000', '1500000', '0', '1')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('4','Dewi Lestari', '2026004', '1500000','0','1')"><i class="fa-solid fa-cash-register"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('104', 'Dewi Lestari', '2026004')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('4', 'Dewi Lestari', '2026004')"><i class="fa-solid fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="card-footer pagination-wrap">
                    <div class="pagination-container">
                        <div class="pagination">
                            <span class="page-item disabled">&laquo;</span>
                            <span class="page-item active">1</span>
                            <span class="page-item">2</span>
                            <span class="page-item">&raquo;</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL INPUT TRANSAKSI / ANGSURAN --}}
    <div id="modalBayarPemeliharaan" class="modal-overlay">
        <input type="hidden" value="" id="value_pembayaran">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Pembayaran Uang Pemeliharaan</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/espm" method="POST" class="modal-body">
                @csrf
                <input type="hidden" name="id_siswa" id="id_siswa" value="">
                <div class="modal-field">
                    <label>NIS / Nama Siswa</label>
                    <input type="text" id="modal-bayar-siswa" readonly disabled class="input-readonly">
                </div>
                <div class="modal-row-2">
                    <div class="modal-field">
                        <label>Nominal Tagihan</label>
                        <input type="number" id="modal-bayar-total" name="nominal">
                    </div>
                    <div class="modal-field">
                        <label>Sisa Tanggungan</label>
                        <input type="text" id="modal-bayar-sisa" readonly disabled class="input-readonly text-danger font-bold">
                    </div>
                </div>
                <div class="modal-field">
                    <label for="bayar-nominal">Nominal Pembayaran Saat Ini (Rp)</label>
                    <input type="number" id="bayar-nominal" name="bayar" placeholder="Masukkan jumlah yang dibayarkan">
                </div>
                <div class="modal-field">
                    <label for="edit-status">Status Pembayaran</label>
                    <input type="text" id="edit-status" name="status" readonly class="input-readonly">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeBayarModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-receipt"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DETAIL & BUKTI --}}
    <div id="modalDetailPemeliharaan" class="modal-overlay">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <h3>Konfirmasi Pembayaran Uang Pemeliharaan</h3>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <div class="printable-header">
                    <h3>SISTEM INFORMASI AKADEMIK (SIAKAD)</h3>
                    <p>Bukti Konfirmasi Tagihan Pembayaran Uang Pemeliharaan</p>
                </div>

                <div class="student-info-summary">
                    <div>
                        <small>Nama Siswa</small>
                        <h4 id="detail-nama">-</h4>
                    </div>
                    <div>
                        <small>NIS / No. Reg</small>
                        <h4 id="detail-reg">-</h4>
                    </div>
                    <div>
                        <small>Status Pembayaran</small>
                        <span id="detail-status-badge" class="badge success">Lunas</span>
                    </div>
                </div>

                <div class="confirmation-box">
                    <h5><i class="fa-solid fa-circle-info"></i> Ringkasan Konfirmasi</h5>
                    <div class="summary-grid">
                        <div>
                            <span>Total Tagihan:</span>
                            <strong id="detail-total">Rp 0</strong>
                        </div>
                        <div>
                            <span>Total Terbayar:</span>
                            <strong id="detail-terbayar" class="text-success">Rp 0</strong>
                        </div>
                        <div>
                            <span>Sisa Tagihan:</span>
                            <strong id="detail-sisa" class="text-danger">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
                    <button type="button" class="btn-action view" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak Bukti</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PUBLISH --}}
    <div id="modalPublishPemeliharaan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Publish Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closePublishModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/pbpm" method="POST" class="modal-body">
                @csrf
                <input type="hidden" name="id_siswa" id="publish-id-pemeliharaan" value="">
                <input type="hidden" name="pembayaran" value="pemeliharaan">
                
                <div class="modal-alert-body">
                    <i class="fa-solid fa-paper-plane icon-alert-publish"></i>
                    <p>Apakah Anda yakin ingin mempublikasikan tagihan pemeliharaan ini?</p>
                    <strong id="publish-student-info">-</strong>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closePublishModal()">Batal</button>
                    <button type="submit" class="btn-modal-save btn-publish-confirm"><i class="fa-solid fa-paper-plane"></i> Ya, Publish</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <div id="modalDeletePemeliharaan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Hapus Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/hppm" method="POST" class="modal-body">
                @csrf
                <input type="hidden" name="id" id="delete-id-pemeliharaan" value="">
                <input type="hidden" name="pembayaran" id="delete_id" value="pemeliharaan">
                
                <div class="modal-alert-body">
                    <i class="fa-solid fa-triangle-exclamation icon-alert-delete"></i>
                    <p>Apakah Anda yakin ingin menghapus tagihan pemeliharaan ini?</p>
                    <strong id="delete-student-info" class="text-danger">-</strong>
                    <small>Data yang dihapus tidak dapat dikembalikan.</small>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn-modal-save btn-delete-confirm"><i class="fa-solid fa-trash"></i> Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    {{-- JAVASCRIPT LOGIC --}}
    <script>
        var input_status = document.getElementById("filter-status-pemeliharaan");
        var input_kelas = document.getElementById("filter-kelas-pemeliharaan");

        input_status.addEventListener("change", filterData);
        input_kelas.addEventListener("change", filterData);

        function filterData() {
            var value_status = input_status.value;
            var value_kelas = input_kelas.value;
            var row_tr = document.querySelectorAll(".table-responsive tbody tr");

            reset();
            row_tr.forEach((data) => {
                var row_kelas = data.querySelector(".class-pill");
                var row_status = data.querySelector(".status");

                if (value_status != "") {
                    if (!row_status.classList.contains("hide") && row_status.textContent.toLowerCase().trim() != value_status.toLowerCase().trim()) {
                        data.classList.add("hide");
                    }
                }

                if (value_kelas != "") {
                    if (!row_kelas.classList.contains("hide") && row_kelas.textContent.toLowerCase().trim() != value_kelas.toLowerCase().trim()) {
                        data.classList.add("hide");
                    }
                }
            });
        }

        function reset() {
            var row_tr = document.querySelectorAll("tbody tr");
            row_tr.forEach((data) => {
                data.classList.remove("hide");
            }); 
        }

        var memory_data = 0;
        document.getElementById("bayar-nominal").addEventListener('input', (e) => {
            var limit = parseInt(document.getElementById("value_pembayaran").value) || 0;
            var val = parseInt(e.target.value) || 0;

            if (val <= limit) {
                memory_data = val;
            } else {
                e.target.value = memory_data;
            }

            if (parseInt(e.target.value || 0) === limit && limit > 0) {
                document.getElementById("edit-status").value = "Lunas";
            } else {
                document.getElementById("edit-status").value = "Menunggak";        
            }
        });

        function openBayarModal(id, nama, reg, total, sisa, status) {
            document.getElementById("value_pembayaran").value = sisa;
            document.getElementById("id_siswa").value = id;
            document.getElementById("edit-status").value = parseInt(status) ? "Lunas" : "Menunggak";

            document.getElementById('modal-bayar-siswa').value = `${reg} - ${nama}`;
            document.getElementById('modal-bayar-total').value = parseInt(total);
            document.getElementById('modal-bayar-sisa').value = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');
            document.getElementById('bayar-nominal').max = sisa;
            
            document.getElementById('modalBayarPemeliharaan').classList.add('active');
        }

        function closeBayarModal() {
            document.getElementById('modalBayarPemeliharaan').classList.remove('active');
        }

        function openDetailModal(nama, reg, total, terbayar, sisa, status) {
            document.getElementById('detail-nama').innerText = nama;
            document.getElementById('detail-reg').innerText = reg;
            document.getElementById('detail-total').innerText = 'Rp ' + parseInt(total).toLocaleString('id-ID');
            document.getElementById('detail-terbayar').innerText = 'Rp ' + parseInt(terbayar).toLocaleString('id-ID');
            document.getElementById('detail-sisa').innerText = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');

            var badge = document.getElementById('detail-status-badge');
            if (parseInt(status) === 1 || status.toLowerCase() === 'lunas') {
                badge.className = 'badge success';
                badge.innerText = 'Lunas';
            } else {
                badge.className = 'badge danger';
                badge.innerText = 'Menunggak';
            }

            document.getElementById('modalDetailPemeliharaan').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('modalDetailPemeliharaan').classList.remove('active');
        }

        function openPublishModal(id, nama, reg) {
            document.getElementById('publish-id-pemeliharaan').value = id;
            document.getElementById('publish-student-info').innerText = `${reg} - ${nama}`;
            document.getElementById('modalPublishPemeliharaan').classList.add('active');
        }

        function closePublishModal() {
            document.getElementById('modalPublishPemeliharaan').classList.remove('active');
        }

        function openDeleteModal(id, nama, reg) {
            document.getElementById('delete-id-pemeliharaan').value = id;
            document.getElementById('delete-student-info').innerText = `${reg} - ${nama}`;
            document.getElementById('modalDeletePemeliharaan').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('modalDeletePemeliharaan').classList.remove('active');
        }

        window.onclick = function(event) {
            const modalBayar = document.getElementById('modalBayarPemeliharaan');
            const modalDetail = document.getElementById('modalDetailPemeliharaan');
            const modalPublish = document.getElementById('modalPublishPemeliharaan');
            const modalDelete = document.getElementById('modalDeletePemeliharaan');
            
            if (event.target === modalBayar) closeBayarModal();
            if (event.target === modalDetail) closeDetailModal();
            if (event.target === modalPublish) closePublishModal();
            if (event.target === modalDelete) closeDeleteModal();
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Uang Pemeliharaan - SIAKAD</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/pemeliharaan.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <div class="dashboard-container maintenance-page">

        
        <?php if (isset($component)) { $__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar_siakad','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar_siakad'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4)): ?>
<?php $attributes = $__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4; ?>
<?php unset($__attributesOriginal5aec4545c59eb84aeaa1ffd6241385c4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4)): ?>
<?php $component = $__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4; ?>
<?php unset($__componentOriginal5aec4545c59eb84aeaa1ffd6241385c4); ?>
<?php endif; ?>

        
        <main class="main-content">
            <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Pembayaran Pemeliharaan','description' => 'Kelola pembayaran pemeliharaan sekolah.','position' => 'Administrator SIAKAD','initials' => 'AD'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.topbar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Siakad\Topbar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a1f63a2a79d284712d591a40114df0d)): ?>
<?php $attributes = $__attributesOriginal1a1f63a2a79d284712d591a40114df0d; ?>
<?php unset($__attributesOriginal1a1f63a2a79d284712d591a40114df0d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a1f63a2a79d284712d591a40114df0d)): ?>
<?php $component = $__componentOriginal1a1f63a2a79d284712d591a40114df0d; ?>
<?php unset($__componentOriginal1a1f63a2a79d284712d591a40114df0d); ?>
<?php endif; ?>

            
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

            
            <div class="filter-box">
                <div class="filter-heading">
                    <div><h4>Filter Biaya Pemeliharaan</h4><p>Telusuri data berdasarkan siswa, status, atau kelas.</p></div>
                    <span class="result-counter" id="resultCounter">0 data</span>
                </div>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-nama-pemeliharaan">Cari Siswa</label>
                        <input type="search" id="filter-nama-pemeliharaan" placeholder="Nama atau NIS siswa" autocomplete="off">
                    </div>
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
                        </select>
                    </div>
                </div>
            </div>

            
            <div class="table-card">
                <div class="table-header">
                    <div><h4>Daftar Tagihan Pemeliharaan</h4><span class="table-subtitle">Data contoh transaksi pemeliharaan sekolah.</span></div>
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
                                <td><span class="student-name">Ahmad Rizky</span><span class="student-nis">NIS: 2026001</span></td>
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
                                    <div class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Ahmad Rizky', '2026001', '1500000', '1500000', '0', '1')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('1','Ahmad Rizky', '2026001', '1500000','0','1')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('101', 'Ahmad Rizky', '2026001')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('1', 'Ahmad Rizky', '2026001')"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dummy Data 2 -->
                            <tr>
                                <td><span class="student-name">Siti Nurhaliza</span><span class="student-nis">NIS: 2026002</span></td>
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
                                    <div class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Siti Nurhaliza', '2026002', '1500000', '1000000', '500000', '0')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('2','Siti Nurhaliza', '2026002', '1500000','500000','0')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('102', 'Siti Nurhaliza', '2026002')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('2', 'Siti Nurhaliza', '2026002')"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dummy Data 3 -->
                            <tr>
                                <td><span class="student-name">Budi Pratama</span><span class="student-nis">NIS: 2026003</span></td>
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
                                    <div class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Budi Pratama', '2026003', '1500000', '0', '1500000', '0')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('3','Budi Pratama', '2026003', '1500000','1500000','0')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('103', 'Budi Pratama', '2026003')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('3', 'Budi Pratama', '2026003')"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Dummy Data 4 -->
                            <tr>
                                <td><span class="student-name">Dewi Lestari</span><span class="student-nis">NIS: 2026004</span></td>
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
                                    <div class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                        <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('Dewi Lestari', '2026004', '1500000', '1500000', '0', '1')"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('4','Dewi Lestari', '2026004', '1500000','0','1')"><i class="fa-solid fa-pen-to-square"></i></button>
                                        <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('104', 'Dewi Lestari', '2026004')"><i class="fa-solid fa-paper-plane"></i></button>
                                        <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('4', 'Dewi Lestari', '2026004')"><i class="fa-solid fa-trash-can"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                
                <div class="card-footer pagination-wrap" style="display: flex; justify-content: center; align-items: center; width: 100%;">
                    <div class="pagination-container" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;">
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

    
    <div id="modalBayarPemeliharaan" class="modal-overlay">
        <input type="hidden" value="" id="value_pembayaran">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Pembayaran Uang Pemeliharaan</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/espm" method="POST" class="modal-body">
                <?php echo csrf_field(); ?>
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

    
    <div id="modalPublishPemeliharaan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Publish Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closePublishModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/pbpm" method="POST" class="modal-body">
                <?php echo csrf_field(); ?>
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

    
    <div id="modalDeletePemeliharaan" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Hapus Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/hppm" method="POST" class="modal-body">
                <?php echo csrf_field(); ?>
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
                    <button type="submit" class="btn-modal-save btn-delete-confirm"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        var input_status = document.getElementById("filter-status-pemeliharaan");
        var input_kelas = document.getElementById("filter-kelas-pemeliharaan");
        var input_nama = document.getElementById("filter-nama-pemeliharaan");
        var dataPemeliharaan = [...document.querySelectorAll(".table-responsive tbody tr")];

        input_status.addEventListener("change", filterData);
        input_kelas.addEventListener("change", filterData);
        input_nama.addEventListener("input", filterData);

        [...new Set(dataPemeliharaan.map((baris) => baris.querySelector(".class-pill")?.textContent.trim()).filter(Boolean))]
            .sort()
            .forEach((kelas) => input_kelas.add(new Option(kelas, kelas)));

        function filterData() {
            var value_status = input_status.value;
            var value_kelas = input_kelas.value;
            var value_nama = input_nama.value.toLowerCase().trim();
            var row_tr = dataPemeliharaan;
            var totalTampil = 0;

            reset();
            row_tr.forEach((data) => {
                var row_nama = data.cells[0];
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

                if (value_nama != "" && !row_nama.textContent.toLowerCase().includes(value_nama)) {
                    data.classList.add("hide");
                }

                if (!data.classList.contains("hide")) totalTampil++;
            });

            document.getElementById("resultCounter").textContent = `${totalTampil} data`;
        }

        function reset() {
            var row_tr = document.querySelectorAll("tbody tr");
            row_tr.forEach((data) => {
                data.classList.remove("hide");
            }); 
        }

        filterData();

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



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/pemeliharaan.blade.php ENDPATH**/ ?>
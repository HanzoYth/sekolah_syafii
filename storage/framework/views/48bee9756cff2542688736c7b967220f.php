<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Uang Pangkal - SIAKAD</title>

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/pembayaran.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/pangkal.css')); ?>">
</head>
<body>
    <?php
        $totalDataPangkal = method_exists($data_slip_pangkal, 'total')
            ? $data_slip_pangkal->total()
            : count($data_slip_pangkal);
    ?>

    <div class="dashboard-container pangkal-page">

        
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
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Pembayaran Uang Pangkal','description' => 'Kelola transaksi uang pangkal siswa.','position' => 'Administrator SIAKAD','initials' => 'AD'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            
            <div class="stats-grid pembayaran-stats">
                <div class="stat-card">
                    <div class="stat-icon icon-primary"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                    <div>
                        <h3>Rp <?php echo e(number_format($total_target_pangkal,0,",",".")); ?></h3>
                        <p>Total Target Uang Pangkal</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-success"><i class="fa-solid fa-vault"></i></div>
                    <div>
                        <h3>Rp <?php echo e(number_format($total_lunas_pangkal,0,",",".")); ?></h3>
                        <p>Total Terkumpul</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-info"><i class="fa-solid fa-user-check"></i></div>
                    <div>
                        <h3><?php echo e($total_siswa_lunas); ?></h3>
                        <p>Siswa Lunas</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-warning"><i class="fa-solid fa-clock-rotate-left"></i></div>
                    <div>
                        <h3><?php echo e($total_siswa_belum_lunas); ?></h3>
                        <p>Siswa Belum Lunas</p>
                    </div>
                </div>
            </div>

            
            <div class="filter-box pembayaran-filter">
                <div class="filter-heading">
                    <div><h4>Filter Uang Pangkal</h4><p>Temukan tagihan berdasarkan siswa, status, atau kelas.</p></div>
                    <span class="result-counter" id="resultCounter"><?php echo e($totalDataPangkal); ?> data</span>
                </div>
                <div class="filter-group">
                    <div class="input-wrap">
                        <label for="filter-nama-pangkal">Cari Siswa</label>
                        <input type="search" id="filter-nama-pangkal" placeholder="Nama atau NIS siswa" autocomplete="off">
                    </div>
                  
                    <div class="input-wrap">
                        <label for="filter-status-pangkal">Status Pembayaran</label>
                        <select id="filter-status-pangkal" name="status_pangkal">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="Menunggak">Menunggak</option>
                        </select>
                    </div>
                  
                    <div class="input-wrap">
                        <label for="filter-kelas-pangkal">Kelas</label>
                        <select id="filter-kelas-pangkal" name="kelas">
                            <option value="">Semua kelas</option>
                            <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->nama_ruang); ?>"><?php echo e($value->nama_ruang); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>

            
            <div class="table-card">
                <div class="table-header">
                    <div><h4>Daftar Tagihan Uang Pangkal</h4><span class="table-subtitle">Penerimaan siswa baru dan pembayaran angsuran.</span></div>
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
                            <?php $__currentLoopData = $data_slip_pangkal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $data_siswa = App\Models\siswa::where("id", $value->siswa_id)->first();
                                    $data_kelas = ($data_siswa && $data_siswa->kelas_id) ? App\Models\ruang_kelas::where("id",$data_siswa->kelas_id)->first() : null;
                                    $nama_siswa = $data_siswa->nama ?? 'Siswa #' . $value->siswa_id;
                                    $nis_siswa = $data_siswa->nis ?? '-';
                                    $nama_kelas = $data_kelas->nama_ruang ?? 'Belum Ditentukan';
                                    $sisa_bayar = max(0, $value->nominal - ($value->jumlah_di_bayar ?? 0));
                                ?>
                                <tr>
                                    <td><span class="student-name"><?php echo e($nama_siswa); ?></span><span class="student-nis">NIS: <?php echo e($nis_siswa); ?></span></td>
                                    <td><span class="class-pill"><?php echo e($nama_kelas); ?></span></td>
                                    <td class="amount">Rp<?php echo e(number_format($value->nominal,0,",",".")); ?></td>
                                    <td class="amount text-success">Rp<?php echo e(number_format($value->jumlah_di_bayar,0,",",".")); ?></td>
                                    <td class="amount">Rp<?php echo e(number_format($sisa_bayar,0,",",".")); ?></td>
                                    <td class="status"><span class="badge <?php echo e($value->status ? 'success' : 'danger'); ?>"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo e($value->status ? 'lunas':'menunggak'); ?></span></td>
                                    <td>
                                        <div class="action-buttons" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: center; gap: 8px; white-space: nowrap;">
                                            <button class="btn-action view" title="Konfirmasi & Bukti Pembayaran" onclick="openDetailModal('<?php echo e($nama_siswa); ?>', '<?php echo e($nis_siswa); ?>', '<?php echo e($value->nominal); ?>', '<?php echo e($value->jumlah_di_bayar); ?>', '<?php echo e($sisa_bayar); ?>', '<?php echo e($value->status); ?>')"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn-action edit" title="Bayar Angsuran" onclick="openBayarModal('<?php echo e($value->id); ?>','<?php echo e($nama_siswa); ?>', '<?php echo e($nis_siswa); ?>', '<?php echo e($value->nominal); ?>','<?php echo e($sisa_bayar); ?>','<?php echo e($value->status); ?>')"><i class="fa-solid fa-cash-register"></i></button>
                                            <button class="btn-action publish" title="Publish Tagihan" onclick="openPublishModal('<?php echo e($value->siswa_id); ?>', '<?php echo e($nama_siswa); ?>', '<?php echo e($nis_siswa); ?>')"><i class="fa-solid fa-paper-plane"></i></button>
                                            <button class="btn-action delete" title="Hapus Tagihan" onclick="openDeleteModal('<?php echo e($value->id); ?>', '<?php echo e($nama_siswa); ?>', '<?php echo e($nis_siswa); ?>')"><i class="fa-solid fa-trash-can"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="card-footer pagination-wrap">
                    <div class="pagination-container">
                        <?php echo e($data_slip_pangkal->links()); ?>

                    </div>
                </div>
            </div>
        </main>
    </div>

    
    <div id="modalBayarPangkal" class="modal-overlay">
        <input type="hidden" value="" id="value_pembayaran">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Input Pembayaran Uang Pangkal</h3>
                <button type="button" class="btn-close-modal" onclick="closeBayarModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/espk" method="POST" class="modal-body">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id_siswa" id="id_siswa" value="">
                <div class="modal-field">
                    <label>Nis / Nama Siswa</label>
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
                    <label for="edit-status">Status Pembayaran IPP</label>
                    <input type="text" id="edit-status" name="status" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeBayarModal()">Batal</button>
                    <button type="submit" class="btn-modal-save"><i class="fa-solid fa-receipt"></i> Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="modalDetailPangkal" class="modal-overlay">
        <div class="modal-card modal-lg">
            <div class="modal-header">
                <h3>Konfirmasi Pembayaran Uang Pangkal</h3>
                <button type="button" class="btn-close-modal" onclick="closeDetailModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                <!-- Header Logo & Nama Sekolah -->
                <div class="printable-header" style="text-align: center; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 15px;">
                    <h3 style="margin: 0; font-family: 'Poppins', sans-serif;">SISTEM INFORMASI AKADEMIK (SIAKAD)</h3>
                    <p style="margin: 0; font-size: 0.85rem; color: #666;">Bukti Konfirmasi Tagihan Pembayaran Uang Pangkal</p>
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

                <div class="confirmation-box" style="background: #f8f9fa; border-radius: 8px; padding: 15px; margin-top: 15px;">
                    <h5 style="margin-top: 0; margin-bottom: 10px; color: #333;"><i class="fa-solid fa-circle-info"></i> Ringkasan Konfirmasi</h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; font-size: 0.9rem;">
                        <div>
                            <span style="color: #666; display: block;">Total Tagihan:</span>
                            <strong id="detail-total">Rp 0</strong>
                        </div>
                        <div>
                            <span style="color: #666; display: block;">Total Terbayar:</span>
                            <strong id="detail-terbayar" style="color: #2e7d32;">Rp 0</strong>
                        </div>
                        <div>
                            <span style="color: #666; display: block;">Sisa Tagihan:</span>
                            <strong id="detail-sisa" style="color: #c62828;">Rp 0</strong>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeDetailModal()">Tutup</button>
                    <button type="button" class="btn-action view" onclick="window.print()"><i class="fa-solid fa-print"></i> Cetak Bukti</button>
                </div>
            </div>
        </div>
    </div>

    
    <div id="modalPublishPangkal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Publish Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closePublishModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/pbsp" method="POST" class="modal-body">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id_siswa" id="publish-id-pangkal" value="">
                <input type="hidden" name="pembayaran" value="pangkal">
                
                <div style="text-align: center; padding: 10px 0;">
                    <i class="fa-solid fa-paper-plane" style="font-size: 3rem; color: #0284c7; margin-bottom: 15px;"></i>
                    <p style="margin: 0; font-size: 1rem; color: #333;">Apakah Anda yakin ingin mempublikasikan tagihan uang pangkal ini?</p>
                    <strong id="publish-student-info" style="display: block; margin-top: 8px; font-size: 0.95rem; color: #555;">-</strong>
                </div>

                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closePublishModal()">Batal</button>
                    <button type="submit" class="btn-modal-save" style="background-color: #0284c7;"><i class="fa-solid fa-paper-plane"></i> Ya, Publish</button>
                </div>
            </form>
        </div>
    </div>

    
    <div id="modalDeletePangkal" class="modal-overlay">
        <div class="modal-card">
            <div class="modal-header">
                <h3>Konfirmasi Hapus Tagihan</h3>
                <button type="button" class="btn-close-modal" onclick="closeDeleteModal()"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <form action="/sk/hpsp" method="POST" class="modal-body">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" id="delete-id-pangkal" value="">
                <input type="hidden" name="pembayaran" id="delete_id" value="pangkal">
                
                <div style="text-align: center; padding: 10px 0;">
                    <i class="fa-solid fa-triangle-exclamation" style="font-size: 3rem; color: #dc2626; margin-bottom: 15px;"></i>
                    <p style="margin: 0; font-size: 1rem; color: #333;">Apakah Anda yakin ingin menghapus tagihan uang pangkal ini?</p>
                    <strong id="delete-student-info" style="display: block; margin-top: 8px; font-size: 0.95rem; color: #dc2626;">-</strong>
                    <small style="display: block; margin-top: 5px; color: #666;">Data yang dihapus tidak dapat dikembalikan.</small>
                </div>

                <div class="modal-footer" style="margin-top: 20px;">
                    <button type="button" class="btn-modal-cancel" onclick="closeDeleteModal()">Batal</button>
                    <button type="submit" class="btn-modal-save" style="background-color: #dc2626;"><i class="fa-solid fa-trash-can"></i> Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>

    
    <script>
        var input_status = document.getElementById("filter-status-pangkal");
        var input_kelas = document.getElementById("filter-kelas-pangkal");
        var input_nama = document.getElementById("filter-nama-pangkal");

        input_status.addEventListener("change", filterData);
        input_kelas.addEventListener("change", filterData);
        input_nama.addEventListener("input", filterData);

        function filterData(){
            var value_status = input_status.value;
            var value_kelas = input_kelas.value;
            var value_nama = input_nama.value.toLowerCase().trim();
            var row_tr = document.querySelectorAll(".table-responsive tbody tr");
            var totalTampil = 0;

            reset();
            row_tr.forEach((data) => {
                var row_nama = data.cells[0];
                var row_kelas = data.querySelector(".class-pill");
                var row_status = data.querySelector(".status");

                if (value_status != ""){
                    if (!row_status.classList.contains("hide") && row_status.textContent.toLowerCase().trim() != value_status.toLowerCase().trim()){
                        data.classList.add("hide");
                    }
                }

                if (value_kelas != ""){
                    if (!row_kelas.classList.contains("hide") && row_kelas.textContent.toLowerCase().trim() != value_kelas.toLowerCase().trim()){
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

        function reset(){
            var row_tr = document.querySelectorAll("tbody tr");
            row_tr.forEach((data) => {
                data.classList.remove("hide");
            }); 
        }

        var memory_data = 0;
        document.getElementById("bayar-nominal").addEventListener('input',(e) => {
            if (parseInt(e.target.value ? e.target.value : 0) <= parseInt(document.getElementById("value_pembayaran").value)){
                memory_data = parseInt(e.target.value);
            } else {
                e.target.value = memory_data;
            }

            if (parseInt(e.target.value ? e.target.value : 0) == parseInt(document.getElementById("value_pembayaran").value)){
                document.getElementById("edit-status").value = "Lunas";
            } else {
                document.getElementById("edit-status").value = "Menunggak";        
            }
        });

        function openBayarModal(id, nama, reg, total, sisa, status) {
            document.getElementById("value_pembayaran").value = sisa;
            document.getElementById("id_siswa").value = id;

            document.getElementById("edit-status").value = parseInt(status) ? "lunas" : "Menunggak";

            document.getElementById('modal-bayar-siswa').value = `${reg} - ${nama}`;
            document.getElementById('modal-bayar-total').value = parseInt(total);
            document.getElementById('modal-bayar-sisa').value = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');
            document.getElementById('bayar-nominal').max = sisa;
            
            document.getElementById('modalBayarPangkal').classList.add('active');
        }

        function closeBayarModal() {
            document.getElementById('modalBayarPangkal').classList.remove('active');
        }

        function openDetailModal(nama, reg, total, terbayar, sisa, status) {
            document.getElementById('detail-nama').innerText = nama;
            document.getElementById('detail-reg').innerText = reg;
            document.getElementById('detail-total').innerText = 'Rp ' + parseInt(total).toLocaleString('id-ID');
            document.getElementById('detail-terbayar').innerText = 'Rp ' + parseInt(terbayar).toLocaleString('id-ID');
            document.getElementById('detail-sisa').innerText = 'Rp ' + parseInt(sisa).toLocaleString('id-ID');

            var badge = document.getElementById('detail-status-badge');
            if (parseInt(status) === 1 || status === 'lunas') {
                badge.className = 'badge success';
                badge.innerText = 'Lunas';
            } else {
                badge.className = 'badge danger';
                badge.innerText = 'Menunggak';
            }

            document.getElementById('modalDetailPangkal').classList.add('active');
        }

        function closeDetailModal() {
            document.getElementById('modalDetailPangkal').classList.remove('active');
        }

        function openPublishModal(id, nama, reg) {
            document.getElementById('publish-id-pangkal').value = id;
            document.getElementById('publish-student-info').innerText = `${reg} - ${nama}`;
            document.getElementById('modalPublishPangkal').classList.add('active');
        }

        function closePublishModal() {
            document.getElementById('modalPublishPangkal').classList.remove('active');
        }

        function openDeleteModal(id, nama, reg) {
            document.getElementById('delete-id-pangkal').value = id;
            document.getElementById('delete-student-info').innerText = `${reg} - ${nama}`;
            document.getElementById('modalDeletePangkal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('modalDeletePangkal').classList.remove('active');
        }

        window.onclick = function(event) {
            const modalBayar = document.getElementById('modalBayarPangkal');
            const modalDetail = document.getElementById('modalDetailPangkal');
            const modalPublish = document.getElementById('modalPublishPangkal');
            const modalDelete = document.getElementById('modalDeletePangkal');
            
            if (event.target === modalBayar) closeBayarModal();
            if (event.target === modalDetail) closeDetailModal();
            if (event.target === modalPublish) closePublishModal();
            if (event.target === modalDelete) closeDeleteModal();
        }
    </script>

</body>
</html>



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/pangkal.blade.php ENDPATH**/ ?>
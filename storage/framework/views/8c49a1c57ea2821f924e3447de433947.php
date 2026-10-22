<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIAKAD - Tagihan Pembayaran Siswa</title>
    
    <!-- Font Poppins & FontAwesome Icon -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('img/logo_sklh.png')); ?>?v=<?php echo e(time()); ?>">
    
    <!-- Load CSS Terpisah -->
    <link rel="stylesheet" href="<?php echo e(asset('css/modul/siakad/buatTagihan.css')); ?>">
</head>
<body>

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
    
    <div class="main-content billing-page">
        <?php if (isset($component)) { $__componentOriginal1a1f63a2a79d284712d591a40114df0d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a1f63a2a79d284712d591a40114df0d = $attributes; } ?>
<?php $component = App\View\Components\Siakad\Topbar::resolve(['title' => 'Daftar Tagihan Siswa','description' => 'Kelola tagihan pembayaran akademik siswa.','position' => 'Administrator SIAKAD','initials' => 'AD'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

        <!-- Filter Pencarian -->
        <div class="filter-card">
            <div class="filter-card-heading">
                <div>
                    <span class="section-eyebrow"><i class="fa-solid fa-file-circle-plus"></i> Administrasi Pembayaran</span>
                    <h1>Buat Tagihan Siswa</h1>
                    <p>Pilih siswa, lalu buat tagihan sesuai jenis dan periode pembayaran.</p>
                </div>
                <span class="result-counter" id="resultCounter"><?php echo e(count($data_siswa)); ?> siswa</span>
            </div>
            <div class="filter-row">
                <div class="filter-field">
                    <label for="filterNama"><i class="fa-solid fa-magnifying-glass"></i> Cari Nama Siswa</label>
                    <input type="search" id="filterNama" placeholder="Ketik nama atau NIS siswa..." autocomplete="off">
                </div>
                <div class="filter-field">
                    <label for="filterKelas"><i class="fa-solid fa-filter"></i> Pilih Kelas</label>
                    <select id="filterKelas"><option value="">Semua kelas</option></select>
                </div>
            </div>
        </div>

        <!-- Card Tabel Siswa -->
        <div class="table-card">
            <div class="table-header">
                <div><h4>Data Siswa</h4><p>Pilih <strong>Buat Tagihan</strong> pada siswa yang dituju.</p></div>
            </div>
            
            <div class="table-responsive">
                <table id="tableSiswa">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data_siswa) > 0): ?>
                            <?php $__currentLoopData = $data_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $data_kelas = App\Models\ruang_kelas::where("id",$siswa->kelas_id)->first();
                                    $namaKelas = $data_kelas->nama_ruang ?? '-';
                                ?>
                                <tr data-student-row data-search="<?php echo e(strtolower($siswa->nama . ' ' . $siswa->nis . ' ' . $namaKelas)); ?>" data-kelas="<?php echo e($namaKelas); ?>">
                                    <td><?php echo e($index + 1); ?></td>
                                    <td class="student-name"><?php echo e($siswa->nama); ?></td>
                                    <td><?php echo e($siswa->nis); ?></td>
                                    <td><span class="class-pill"><?php echo e($namaKelas); ?></span></td>
                                    <td class="text-center">
                                        <button type="button" class="btn-outline" onclick='openModalTagihan(<?php echo json_encode($siswa->id, 15, 512) ?>, <?php echo json_encode($siswa->nama, 15, 512) ?>, <?php echo json_encode($siswa->nis, 15, 512) ?>)'>
                                            <i class="fa-solid fa-file-invoice-dollar"></i> Buat Tagihan
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr class="empty-row"><td colspan="5"><i class="fa-solid fa-users-slash"></i> Belum ada data siswa yang dapat ditampilkan.</td></tr>
                        <?php endif; ?>
                        <tr class="empty-row" id="filterEmpty" hidden><td colspan="5"><i class="fa-solid fa-magnifying-glass"></i> Siswa tidak ditemukan.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Modal Pop-up Buat Tagihan -->
    <div class="modal-overlay" id="modalTagihan">
        <div class="modal-card">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h3>
                    <i class="fa-solid fa-receipt"></i>
                    <div>
                        Buat Tagihan Pembayaran
                        <small id="modalStudentInfo">Siswa: -</small>
                    </div>
                </h3>
                <button type="button" class="btn-close-modal" onclick="closeModalTagihan()">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Form Tagihan -->
            <form id="formBuatTagihan" action="/sk/tbtg" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="siswa_id" id="modal_siswa_id">

                <div class="modal-body">
                    
                    <!-- Input Jenis Pembayaran -->
                    <div class="modal-field">
                        <label for="jenis_pembayaran">
                            <i class="fa-solid fa-wallet"></i> Jenis Pembayaran
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-list-check"></i>
                            <select name="jenis_pembayaran" id="jenis_pembayaran" required>
                                <option value="" disabled selected>-- Pilih Jenis Pembayaran --</option>
                                <option value="ipp">Tagihan IPP</option>
                                <option value="pangkal">Tagihan Pangkal</option>
                                <option value="pendidikan">Tagihan Pendidikan</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-section-title">Periode Tagihan</div>

                    <!-- Input Periode Tanggal (Mulai Tanggal & Akhir Tanggal) -->
                    <div class="modal-row">
                        <div class="modal-field">
                            <label for="tanggal_mulai">
                                <i class="fa-regular fa-calendar-minus"></i> Tanggal Mulai
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-regular fa-calendar"></i>
                                <input type="date" 
                                       name="tanggal_mulai" 
                                       id="tanggal_mulai" 
                                       required>
                            </div>
                        </div>

                        <div class="modal-field">
                            <label for="tanggal_akhir">
                                <i class="fa-regular fa-calendar-plus"></i> Tanggal Akhir
                            </label>
                            <div class="input-icon-wrapper">
                                <i class="fa-regular fa-calendar"></i>
                                <input type="date" 
                                       name="tanggal_akhir" 
                                       id="tanggal_akhir" 
                                       required>
                            </div>
                        </div>
                    </div>
                    <!-- Input Nominal -->
                    <div class="modal-field">
                        <label for="nominal">
                            <i class="fa-solid fa-money-bill-wave"></i> Nominal Tagihan (Rp)
                        </label>
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-rupiah-sign"></i>
                            <input type="number" 
                                   name="nominal" 
                                   id="nominal" 
                                   class="input-nominal" 
                                   placeholder="Masukkan nominal angka (contoh: 500000)" 
                                   min="0"
                                   required>
                        </div>
                        <span class="field-hint">Isikan angka tanpa titik atau koma.</span>
                    </div>

                </div>

                <!-- Footer Modal -->
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeModalTagihan()">Batal</button>
                    <button type="submit" class="btn-modal-save">
                        <i class="fa-solid fa-paper-plane"></i> Simpan Tagihan
                    </button>
                </div>
            </form>

        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginal0681b545d180d4f9d8ad2ed4614031e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2 = $attributes; } ?>
<?php $component = App\View\Components\Warning::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('warning'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Warning::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2)): ?>
<?php $attributes = $__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2; ?>
<?php unset($__attributesOriginal0681b545d180d4f9d8ad2ed4614031e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0681b545d180d4f9d8ad2ed4614031e2)): ?>
<?php $component = $__componentOriginal0681b545d180d4f9d8ad2ed4614031e2; ?>
<?php unset($__componentOriginal0681b545d180d4f9d8ad2ed4614031e2); ?>
<?php endif; ?>
    <!-- JavaScript Handling Modal, Filter & Dummy Action -->
    <script>
        const inputNama = document.getElementById('filterNama');
        const selectKelas = document.getElementById('filterKelas');
        const studentRows = [...document.querySelectorAll('[data-student-row]')];
        const resultCounter = document.getElementById('resultCounter');
        const filterEmpty = document.getElementById('filterEmpty');

        [...new Set(studentRows.map((row) => row.dataset.kelas).filter((kelas) => kelas && kelas !== '-'))]
            .sort()
            .forEach((kelas) => selectKelas.add(new Option(kelas, kelas)));

        function filterSiswa() {
            const keyword = inputNama.value.trim().toLowerCase();
            const kelas = selectKelas.value;
            let visible = 0;

            studentRows.forEach((row) => {
                const tampil = row.dataset.search.includes(keyword) && (!kelas || row.dataset.kelas === kelas);
                row.hidden = !tampil;
                if (tampil) visible++;
            });

            resultCounter.textContent = `${visible} siswa`;
            filterEmpty.hidden = visible !== 0 || studentRows.length === 0;
        }

        inputNama.addEventListener('input', filterSiswa);
        selectKelas.addEventListener('change', filterSiswa);

        function openModalTagihan(id, nama, nis) {
            document.getElementById('modal_siswa_id').value = id;
            document.getElementById('modalStudentInfo').textContent = `Siswa: ${nama} (${nis})`;
            
            // Reset form saat membuka modal
            document.getElementById('formBuatTagihan').reset();
            document.getElementById('modal_siswa_id').value = id;

            const modal = document.getElementById('modalTagihan');
            modal.classList.add('active');
        }

        function closeModalTagihan() {
            const modal = document.getElementById('modalTagihan');
            modal.classList.remove('active');
        }

        // Menutup modal saat mengklik area luar modal (overlay)
        window.onclick = function(event) {
            const modal = document.getElementById('modalTagihan');
            if (event.target === modal) {
                closeModalTagihan();
            }
        }
        const jenis = document.getElementById('jenis_pembayaran');
        const pembungkus_priode = document.querySelector('.modal-row');

        jenis.addEventListener('change',() => {
            if (jenis.value != "ipp"){
                pembungkus_priode.style.display = "none";
                document.getElementById("tanggal_mulai").removeAttribute("required");
                document.getElementById("tanggal_akhir").removeAttribute("required");
            }else{
                pembungkus_priode.style.display = "";
                document.getElementById("tanggal_mulai").setAttribute("required","");
                document.getElementById("tanggal_akhir").setAttribute("required","");
            }
        });

    </script>
</body>
</html>



<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\buatTagihan.blade.php ENDPATH**/ ?>
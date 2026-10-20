<?php
    $totalSiswa = count($data_siswa);
    $siswaAktif = collect($data_siswa)->filter(fn ($siswa) => !isset($siswa->aktif) || (int) $siswa->aktif === 1)->count();
    $tanpaKelas = $jumlahTanpaKelas ?? collect($data_siswa)->filter(fn ($siswa) => empty($siswa->kelas_id))->count();
    $jumlahKelas = collect($data_siswa)->pluck('kelas_id')->filter()->unique()->count();
?>
<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Data Siswa','description' => 'Kelola dan pantau data siswa yang terdaftar pada SIAKAD.','position' => 'Administrator SIAKAD','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Data Siswa','description' => 'Kelola dan pantau data siswa yang terdaftar pada SIAKAD.','position' => 'Administrator SIAKAD','initials' => 'AD']); ?>

    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; flex-wrap: wrap; gap: 14px;">
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-users"></i> Manajemen Akademik
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <span><i class="fa-solid fa-user-graduate"></i> Daftar Siswa</span>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <div style="position: relative; display: flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 12px; gap: 8px;">
                        <i class="fa-solid fa-filter" style="color: #64748b; font-size: 14px;"></i>
                        <select name="sekolah_id" onchange="this.form.submit()" style="background: transparent; border: none; outline: none; font-size: 14px; color: #334155; font-weight: 600; cursor: pointer; padding-right: 8px;">
                            <option value="">Semua Jenjang</option>
                            <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($s->id); ?>" <?php echo e(($sekolah_id ?? '') == $s->id ? 'selected' : ''); ?>><?php echo e(strtoupper($s->jenis)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </form>
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Temukan informasi siswa berdasarkan nama, NIS, jenis kelamin, atau status penempatan kelas.
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <a href="/sk/frss" style="display: inline-flex; align-items: center; gap: 8px; background: #166534; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; box-shadow: 0 2px 4px rgba(22, 101, 52, 0.2); transition: all 0.2s;" onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#166534'">
                <i class="fa-solid fa-user-plus"></i> Tambah Siswa Baru
            </a>
            <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 10px 16px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #334155;">
                <i class="fa-solid fa-user-graduate" style="color: #177455;"></i>
                <span><?php echo e($totalSiswa); ?> siswa terdaftar</span>
            </div>
        </div>
    </div>

    <!-- Metrics Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div style="background: white; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #64748b; font-weight: 600;">Total Siswa</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;"><?php echo e($totalSiswa); ?></div>
                <div style="font-size: 11px; color: #94a3b8;">Data siswa terdaftar</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #64748b; font-weight: 600;">Siswa Aktif</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;"><?php echo e($siswaAktif); ?></div>
                <div style="font-size: 11px; color: #94a3b8;">Status aktif belajar</div>
            </div>
        </div>

        <div style="background: <?php echo e($tanpaKelas > 0 ? '#fffbeb' : 'white'); ?>; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid <?php echo e($tanpaKelas > 0 ? '#fde68a' : '#e2e8f0'); ?>; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: <?php echo e($tanpaKelas > 0 ? '#fef3c7' : '#f1f5f9'); ?>; color: <?php echo e($tanpaKelas > 0 ? '#d97706' : '#64748b'); ?>; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div style="flex: 1;">
                <div style="font-size: 12px; color: <?php echo e($tanpaKelas > 0 ? '#92400e' : '#64748b'); ?>; font-weight: 700;">Belum Ada Kelas</div>
                <div style="font-size: 20px; font-weight: bold; color: <?php echo e($tanpaKelas > 0 ? '#b45309' : '#1e293b'); ?>;"><?php echo e($tanpaKelas); ?></div>
                <div style="font-size: 11px; color: <?php echo e($tanpaKelas > 0 ? '#d97706' : '#94a3b8'); ?>;">
                    <?php if($tanpaKelas > 0): ?>
                        <a href="/sk/pembagian-kelas" style="color: #b45309; font-weight: 700; text-decoration: underline;">Bagi Kelas Sekarang &rarr;</a>
                    <?php else: ?>
                        Semua punya rombel
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 44px; height: 44px; border-radius: 12px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0;">
                <i class="fa-solid fa-school"></i>
            </div>
            <div>
                <div style="font-size: 12px; color: #64748b; font-weight: 600;">Kelas Terisi</div>
                <div style="font-size: 20px; font-weight: bold; color: #1e293b;"><?php echo e($jumlahKelas); ?></div>
                <div style="font-size: 11px; color: #94a3b8;">Rombel aktif berpenghuni</div>
            </div>
        </div>
    </div>

    <?php if($tanpaKelas > 0): ?>
        <!-- Alert Banner Siswa Belum Ada Kelas -->
        <div style="background: #fffbeb; border: 1px solid #fde68a; border-radius: 12px; padding: 14px 20px; margin-bottom: 20px; display: flex; align-items: center; justify-content: space-between; gap: 14px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <div style="font-size: 14px; font-weight: 700; color: #92400e;">
                        Perhatian: Terdapat <?php echo e($tanpaKelas); ?> Siswa Belum Masuk Ruang Kelas
                    </div>
                    <div style="font-size: 12px; color: #b45309; margin-top: 2px;">
                        Peserta didik yang mendaftar mandiri perlu dimasukkan ke dalam rombel kelas agar terjadwal dalam kegiatan belajar mengajar.
                    </div>
                </div>
            </div>
            <a href="/sk/pembagian-kelas<?php echo e($sekolah_id ? '?sekolah_id='.$sekolah_id : ''); ?>" style="display: inline-flex; align-items: center; gap: 8px; background: #d97706; color: white; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; box-shadow: 0 2px 4px rgba(217, 119, 6, 0.2); transition: all 0.2s;" onmouseover="this.style.background='#b45309'" onmouseout="this.style.background='#d97706'">
                <i class="fa-solid fa-users-gear"></i> Tempatkan ke Kelas Sekarang
            </a>
        </div>
    <?php endif; ?>

    <!-- Table Section -->
    <div style="background: white; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <!-- Controls -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b;">
                Data Siswa Terdaftar
            </div>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <div style="position: relative; min-width: 180px;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <input type="text" id="studentSearch" placeholder="Cari nama, NIS, atau kelas..." style="padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; width: 100%; box-sizing: border-box;">
                </div>
                <div style="position: relative;">
                    <i class="fa-solid fa-filter" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                    <select id="genderFilter" style="padding: 8px 12px 8px 32px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; appearance: none;">
                        <option value="">Semua Gender</option>
                        <option value="l">Laki-laki</option>
                        <option value="p">Perempuan</option>
                    </select>
                </div>
                <div style="position: relative;">
                    <i class="fa-solid fa-chalkboard-user" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px;"></i>
                    <select id="rombelFilter" style="padding: 8px 12px 8px 32px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; background: white; cursor: pointer; appearance: none;">
                        <option value="">Semua Status Rombel</option>
                        <option value="tanpa_kelas" <?php echo e(($status_rombel ?? '') == 'tanpa_kelas' ? 'selected' : ''); ?>>⚠️ Belum Ada Kelas (<?php echo e($tanpaKelas); ?>)</option>
                        <option value="ada_kelas" <?php echo e(($status_rombel ?? '') == 'ada_kelas' ? 'selected' : ''); ?>>Sudah Masuk Kelas</option>
                    </select>
                </div>
                <span id="resultCounter" style="font-size: 13px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 6px 12px; border-radius: 20px;"><?php echo e($totalSiswa); ?> data</span>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.table','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <thead>
                <tr>
                    <th style="width: 50px; text-align: center;">No.</th>
                    <th>Siswa</th>
                    <th style="width: 150px;">Jenis Kelamin</th>
                    <th style="width: 150px;">Kelas</th>
                    <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody id="studentRows">
                <?php if(count($data_siswa) > 0): ?>
                    <?php $__currentLoopData = $data_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $siswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $kelas = $siswa->kelas;
                            $hasKelas = !empty($siswa->kelas_id) && $kelas;
                            $isPerempuan = ($siswa->gender ?? '') === 'p';
                            $isAktif = !isset($siswa->aktif) || (int) $siswa->aktif === 1;
                            $kelasNama = $kelas->nama_ruang ?? 'Belum Ada Kelas';
                        ?>
                        <tr data-student-row data-gender="<?php echo e($siswa->gender ?? ''); ?>" data-has-kelas="<?php echo e($hasKelas ? '1' : '0'); ?>" data-search="<?php echo e(strtolower($siswa->nis . ' ' . $siswa->nama . ' ' . ($hasKelas ? $kelasNama : 'belum ada kelas tanpa rombel'))); ?>">
                            <td style="text-align: center;"><?php echo e($index + 1); ?></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <?php if($siswa->url_foto): ?>
                                        <img src="<?php echo e(route('file.show', $siswa->url_foto)); ?>" alt="Foto <?php echo e($siswa->nama); ?>" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e2e8f0;">
                                    <?php else: ?>
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background: #f1f5f9; color: #94a3b8; display: flex; align-items: center; justify-content: center; font-size: 16px; border: 2px solid #e2e8f0;">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <div style="font-weight: 600; color: #1e293b; font-size: 14px;"><?php echo e($siswa->nama); ?></div>
                                        <div style="font-size: 12px; color: #64748b;">NIS: <?php echo e($siswa->nis ?? '-'); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php if($isPerempuan): ?>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: #fce7f3; color: #be185d; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-venus"></i> Perempuan
                                    </span>
                                <?php else: ?>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: #e9f2ff; color: #3875c5; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-mars"></i> Laki-laki
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($hasKelas): ?>
                                    <span style="display: inline-block; padding: 4px 10px; background: #f1f5f9; color: #475569; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                        <?php echo e($kelasNama); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; background: #fef3c7; color: #b45309; border: 1px solid #fde68a; border-radius: 6px; font-size: 12px; font-weight: 700;">
                                        <i class="fa-solid fa-triangle-exclamation" style="color: #d97706; font-size: 11px;"></i> Belum Ada Kelas
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if($isAktif): ?>
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #dcfce7; color: #166534; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-circle-check"></i> Aktif
                                    </span>
                                <?php else: ?>
                                    <span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; background: #f3f4f6; color: #4b5563; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                        <i class="fa-solid fa-circle-pause"></i> Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <a href="/sk/dls/<?php echo e($siswa->id); ?>" style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f1f5f9; color: #475569; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; color: #cbd5e1;"></i>
                            <p style="margin: 0; font-size: 14px;">Belum ada data siswa yang dapat ditampilkan.</p>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr id="filterEmpty" style="display: none;">
                    <td colspan="6" style="text-align: center; padding: 40px 20px; color: #64748b;">
                        <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; margin-bottom: 12px; color: #cbd5e1;"></i>
                        <p style="margin: 0; font-size: 14px;">Data siswa tidak ditemukan.</p>
                    </td>
                </tr>
            </tbody>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $attributes = $__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__attributesOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880)): ?>
<?php $component = $__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880; ?>
<?php unset($__componentOriginalb451ae0a4b2a0f57d42f1e2fea2cf880); ?>
<?php endif; ?>
    </div>

    <script>
        const searchInput = document.getElementById('studentSearch');
        const genderFilter = document.getElementById('genderFilter');
        const rombelFilter = document.getElementById('rombelFilter');
        const studentRows = [...document.querySelectorAll('[data-student-row]')];
        const resultCounter = document.getElementById('resultCounter');
        const filterEmpty = document.getElementById('filterEmpty');

        function filterStudents() {
            const keyword = searchInput ? searchInput.value.trim().toLowerCase() : '';
            const gender = genderFilter ? genderFilter.value : '';
            const rombel = rombelFilter ? rombelFilter.value : '';
            let visible = 0;

            studentRows.forEach((row) => {
                const matchesKeyword = row.dataset.search.includes(keyword);
                const matchesGender = !gender || row.dataset.gender === gender;
                const hasKelas = row.dataset.hasKelas;
                const matchesRombel = !rombel || (rombel === 'tanpa_kelas' && hasKelas === '0') || (rombel === 'ada_kelas' && hasKelas === '1');
                const show = matchesKeyword && matchesGender && matchesRombel;
                
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
                if (show) visible++;
            });

            if (resultCounter) resultCounter.textContent = `${visible} data`;
            if (visible === 0 && studentRows.length > 0) {
                if (filterEmpty) filterEmpty.style.display = '';
            } else {
                if (filterEmpty) filterEmpty.style.display = 'none';
            }
            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
        }

        searchInput?.addEventListener('input', filterStudents);
        genderFilter?.addEventListener('change', filterStudents);
        rombelFilter?.addEventListener('change', filterStudents);

        // Initial filter check if value preselected
        if (rombelFilter && rombelFilter.value) {
            filterStudents();
        }
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14)): ?>
<?php $attributes = $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14; ?>
<?php unset($__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14)): ?>
<?php $component = $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14; ?>
<?php unset($__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views//modul/siakad/admin/daftar_siswa.blade.php ENDPATH**/ ?>
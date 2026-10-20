<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Input Nilai Siswa','description' => 'Masukkan dan evaluasi nilai untuk mata pelajaran '.e($jadwal->mata_pelajaran->nama_mapel ?? '-').' kelas '.e($jadwal->kelas->nama_ruang ?? ($jadwal->kelas->nama_kelas ?? '-')).'.','position' => 'Guru SIAKAD','initials' => 'GR']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Input Nilai Siswa','description' => 'Masukkan dan evaluasi nilai untuk mata pelajaran '.e($jadwal->mata_pelajaran->nama_mapel ?? '-').' kelas '.e($jadwal->kelas->nama_ruang ?? ($jadwal->kelas->nama_kelas ?? '-')).'.','position' => 'Guru SIAKAD','initials' => 'GR']); ?>

    <?php
        $kkm = $jadwal->mata_pelajaran->kkm ?? 75;
        $namaKelas = $jadwal->kelas->nama_ruang ?? ($jadwal->kelas->nama_kelas ?? '-');
        $namaMapel = $jadwal->mata_pelajaran->nama_mapel ?? '-';
        $tahunAjaran = $jadwal->tahun_ajaran->nama ?? 'Tahun Ajaran Aktif';
    ?>

    <style>
        .score-input {
            width: 75px;
            padding: 8px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            font-family: inherit;
            outline: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: #fff;
        }
        .score-input:focus {
            border-color: #166534;
            box-shadow: 0 0 0 3px rgba(22, 101, 52, 0.15);
            background: #f0fdf4;
            transform: scale(1.04);
        }
        .score-input.invalid {
            border-color: #ef4444 !important;
            background: #fef2f2 !important;
            color: #b91c1c !important;
        }
        .score-input::-webkit-outer-spin-button,
        .score-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .score-input[type=number] {
            -moz-appearance: textfield;
        }
        
        .badge-status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-tuntas {
            background: #dcfce7;
            color: #15803d;
            border: 1px solid #bbf7d0;
        }
        .badge-remedi {
            background: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }
        .badge-kosong {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .predikat-chip {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
        }
        .predikat-a { background: #dbeafe; color: #1d4ed8; }
        .predikat-b { background: #dcfce7; color: #15803d; }
        .predikat-c { background: #fef3c7; color: #b45309; }
        .predikat-d { background: #fee2e2; color: #b91c1c; }

        .filter-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .filter-btn:hover {
            background: #f8fafc;
            color: #1e293b;
        }
        .filter-btn.active {
            background: #166534;
            color: white;
            border-color: #166534;
        }

        .avatar-initial {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: #e2e8f0;
            color: #475569;
            font-weight: 700;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sticky-save-bar {
            position: sticky;
            bottom: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 14px 24px;
            margin-top: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            z-index: 50;
        }

        @media (max-width: 640px) {
            .sticky-save-bar {
                flex-direction: column;
                gap: 12px;
                padding: 12px 16px;
                bottom: 10px;
                align-items: stretch;
            }
            .sticky-save-bar > div:last-child {
                display: flex;
                width: 100%;
                gap: 8px;
            }
            .sticky-save-bar > div:last-child a,
            .sticky-save-bar > div:last-child button {
                flex: 1;
                justify-content: center;
                text-align: center;
            }
        }

        .table-grading tr:hover td {
            background: #f8fafc;
        }
    </style>

    <!-- Top Action Breadcrumb & Info -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 12px;">
        <div style="display: flex; align-items: center; gap: 12px;">
            <a href="<?php echo e(!empty($isWalasAccess) ? '/sk/rapor-walas?tab=nilai' : '/sk/nilai-guru'); ?>" style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 14px; background: white; border: 1px solid #cbd5e1; border-radius: 8px; color: #475569; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='white'">
                <i class="fa-solid fa-arrow-left"></i> <?php echo e(!empty($isWalasAccess) ? 'Kembali ke Manajemen Nilai Kelas' : 'Kembali'); ?>

            </a>
            <div>
                <h1 style="font-size: 20px; font-weight: 800; color: #1e293b; margin: 0 0 4px 0; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-file-signature" style="color: #166534;"></i> <?php echo e(!empty($isWalasAccess) ? 'Manajemen & Evaluasi Nilai Mapel (Wali Kelas)' : 'Form Input Nilai Siswa'); ?>

                </h1>
                <div style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: #64748b; flex-wrap: wrap;">
                    <span><?php echo e($namaMapel); ?></span>
                    <span>•</span>
                    <span style="font-weight: 600; color: #166534;">Kelas <?php echo e($namaKelas); ?></span>
                    <span>•</span>
                    <span>Pengajar: <strong><?php echo e($jadwal->guru->nama ?? '-'); ?></strong></span>
                    <span>•</span>
                    <span><?php echo e($tahunAjaran); ?></span>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <?php if(!empty($isWalasAccess)): ?>
                <span style="background: #f3e8ff; color: #6b21a8; border: 1px solid #d8b4fe; padding: 6px 12px; border-radius: 8px; font-weight: 700; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-user-shield"></i> Mode Kontrol Wali Kelas
                </span>
            <?php endif; ?>
            <span style="background: #e0f2fe; color: #0369a1; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-bullseye" style="color: #0284c7;"></i> Standar KKM: <strong><?php echo e($kkm); ?></strong>
            </span>
            <span style="background: #dcfce7; color: #15803d; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                <i class="fa-solid fa-users"></i> Total: <strong><?php echo e(count($siswa)); ?> Siswa</strong>
            </span>
        </div>
    </div>

    <!-- Info Cards Banner: Bobot Penilaian -->
    <div style="background: white; border-radius: 12px; padding: 18px 24px; border: 1px solid #e2e8f0; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <div>
                    <h3 style="margin: 0 0 2px 0; font-size: 14px; font-weight: 700; color: #1e293b;">Komposisi & Bobot Evaluasi</h3>
                    <p style="margin: 0; font-size: 12px; color: #64748b;">Perhitungan Nilai Akhir (NA) dikalkulasi otomatis secara real-time berdasarkan persentase bobot:</p>
                </div>
            </div>

            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 6px 12px; font-size: 12px; display: inline-flex; align-items: center; gap: 6px;">
                        <span style="color: #475569; font-weight: 600;"><?php echo e($jp->nama_jenis); ?>:</span>
                        <span style="background: #166534; color: white; padding: 2px 6px; border-radius: 4px; font-weight: 700; font-size: 11px;"><?php echo e($jp->bobot); ?>%</span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <?php if(session('success')): ?>
        <?php if (isset($component)) { $__componentOriginal776f70d299b6a134735e2691eb95c7db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal776f70d299b6a134735e2691eb95c7db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.alert','data' => ['type' => 'success','message' => ''.e(session('success')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'success','message' => ''.e(session('success')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal776f70d299b6a134735e2691eb95c7db)): ?>
<?php $attributes = $__attributesOriginal776f70d299b6a134735e2691eb95c7db; ?>
<?php unset($__attributesOriginal776f70d299b6a134735e2691eb95c7db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal776f70d299b6a134735e2691eb95c7db)): ?>
<?php $component = $__componentOriginal776f70d299b6a134735e2691eb95c7db; ?>
<?php unset($__componentOriginal776f70d299b6a134735e2691eb95c7db); ?>
<?php endif; ?>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <?php if (isset($component)) { $__componentOriginal776f70d299b6a134735e2691eb95c7db = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal776f70d299b6a134735e2691eb95c7db = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.alert','data' => ['type' => 'error','message' => ''.e(session('error')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'error','message' => ''.e(session('error')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal776f70d299b6a134735e2691eb95c7db)): ?>
<?php $attributes = $__attributesOriginal776f70d299b6a134735e2691eb95c7db; ?>
<?php unset($__attributesOriginal776f70d299b6a134735e2691eb95c7db); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal776f70d299b6a134735e2691eb95c7db)): ?>
<?php $component = $__componentOriginal776f70d299b6a134735e2691eb95c7db; ?>
<?php unset($__componentOriginal776f70d299b6a134735e2691eb95c7db); ?>
<?php endif; ?>
    <?php endif; ?>

    <!-- Main Table Container -->
    <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <!-- Search & Filter Controls -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 14px;">
            <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                <button type="button" class="filter-btn active" onclick="setFilter('all', this)">
                    Semua Siswa (<span id="countAll"><?php echo e(count($siswa)); ?></span>)
                </button>
                <button type="button" class="filter-btn" onclick="setFilter('tuntas', this)">
                    <i class="fa-solid fa-circle-check" style="color: #16a34a;"></i> Tuntas (<span id="countTuntas">0</span>)
                </button>
                <button type="button" class="filter-btn" onclick="setFilter('remedi', this)">
                    <i class="fa-solid fa-triangle-exclamation" style="color: #dc2626;"></i> Remedial (<span id="countRemedi">0</span>)
                </button>
                <button type="button" class="filter-btn" onclick="setFilter('empty', this)">
                    <i class="fa-regular fa-clock" style="color: #64748b;"></i> Belum Lengkap (<span id="countEmpty">0</span>)
                </button>
            </div>

            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <button type="button" onclick="quickFillBlank(<?php echo e($kkm); ?>)" style="display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 700; border: 1px solid #bbf7d0; background: #f0fdf4; color: #166534; cursor: pointer; transition: all 0.2s;" title="Isi kotak nilai yang masih kosong dengan nilai KKM (<?php echo e($kkm); ?>)">
                    <i class="fa-solid fa-wand-magic-sparkles text-amber-500"></i> Set KKM (<?php echo e($kkm); ?>) ke Nilai Kosong
                </button>

                <div style="position: relative; width: 100%; max-width: 260px;">
                    <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 13px;"></i>
                    <input type="text" id="searchSiswa" placeholder="Cari nama atau NIS siswa..." onkeyup="filterTable()" style="width: 100%; padding: 8px 12px 8px 34px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#166534';" onblur="this.style.borderColor='#cbd5e1';">
                </div>
            </div>
        </div>

        <!-- Form Input -->
        <form id="formNilai" action="/sk/simpan-nilai-siswa/<?php echo e($jadwal->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
            
            <div style="overflow-x: auto;">
                <table class="table-grading" style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                    <thead>
                        <tr>
                            <th style="background: #f0fdf4; padding: 14px 12px; font-weight: 700; color: #166534; border-bottom: 2px solid #bbf7d0; text-align: center; width: 50px;">No</th>
                            <th style="background: #f0fdf4; padding: 14px 16px; font-weight: 700; color: #166534; border-bottom: 2px solid #bbf7d0; min-width: 200px;">Data Siswa</th>
                            
                            <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colIdx => $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th style="background: #f0fdf4; padding: 14px 10px; font-weight: 700; color: #166534; border-bottom: 2px solid #bbf7d0; text-align: center; width: 110px;">
                                    <div style="font-size: 13px;"><?php echo e($jp->nama_jenis); ?></div>
                                    <span style="font-size: 11px; font-weight: 600; color: #15803d; background: #dcfce7; padding: 2px 6px; border-radius: 4px; display: inline-block; margin-top: 3px;">
                                        Bobot <?php echo e($jp->bobot); ?>%
                                    </span>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <th style="background: #f0fdf4; padding: 14px 12px; font-weight: 700; color: #166534; border-bottom: 2px solid #bbf7d0; text-align: center; width: 100px;">
                                Nilai Akhir
                                <span style="font-size: 10px; font-weight: normal; color: #64748b; display: block;">(Terbobot)</span>
                            </th>
                            <th style="background: #f0fdf4; padding: 14px 12px; font-weight: 700; color: #166534; border-bottom: 2px solid #bbf7d0; text-align: center; width: 80px;">Predikat</th>
                            <th style="background: #f0fdf4; padding: 14px 14px; font-weight: 700; color: #166534; border-bottom: 2px solid #bbf7d0; text-align: center; width: 120px;">Kelulusan</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if(count($siswa) > 0): ?>
                            <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowIdx => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $namaParts = explode(' ', trim($s->nama));
                                    $initials = count($namaParts) >= 2 
                                        ? strtoupper(substr($namaParts[0], 0, 1) . substr($namaParts[1], 0, 1))
                                        : strtoupper(substr($s->nama, 0, 2));
                                ?>
                                <tr class="student-row" id="row-<?php echo e($s->id); ?>" data-siswa-id="<?php echo e($s->id); ?>" data-nama="<?php echo e(strtolower($s->nama)); ?>" data-nis="<?php echo e($s->nis); ?>" style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s;">
                                    <td style="text-align: center; color: #64748b; font-weight: 600; padding: 12px 10px;">
                                        <?php echo e($loop->iteration); ?>

                                    </td>
                                    
                                    <td style="padding: 12px 16px;">
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div class="avatar-initial"><?php echo e($initials); ?></div>
                                            <div>
                                                <strong style="color: #1e293b; font-size: 14px; display: block; line-height: 1.3;"><?php echo e($s->nama); ?></strong>
                                                <span style="font-size: 12px; color: #64748b; font-family: monospace;">NIS: <?php echo e($s->nis); ?></span>
                                            </div>
                                        </div>
                                    </td>

                                    <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colIdx => $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $val = $nilai[$s->id][$jp->id] ?? '';
                                        ?>
                                        <td style="text-align: center; padding: 10px 8px;">
                                            <input type="number" 
                                                   name="nilai[<?php echo e($s->id); ?>][<?php echo e($jp->id); ?>]" 
                                                   value="<?php echo e($val); ?>" 
                                                   class="score-input input-score-cell"
                                                   data-siswa-id="<?php echo e($s->id); ?>"
                                                   data-jp-id="<?php echo e($jp->id); ?>"
                                                   data-bobot="<?php echo e($jp->bobot); ?>"
                                                   data-row="<?php echo e($rowIdx); ?>"
                                                   data-col="<?php echo e($colIdx); ?>"
                                                   min="0" max="100" step="any"
                                                   placeholder="0"
                                                   autocomplete="off">
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <!-- Nilai Akhir (Kalkulasi Otomatis) -->
                                    <td style="text-align: center; padding: 12px 8px;">
                                        <strong class="na-cell" id="na-<?php echo e($s->id); ?>" style="font-size: 15px; color: #1e293b;">-</strong>
                                    </td>

                                    <!-- Predikat -->
                                    <td style="text-align: center; padding: 12px 8px;">
                                        <span class="predikat-chip" id="predikat-<?php echo e($s->id); ?>">-</span>
                                    </td>

                                    <!-- Status Kelulusan (KKM) -->
                                    <td style="text-align: center; padding: 12px 14px;">
                                        <span class="badge-status badge-kosong" id="status-<?php echo e($s->id); ?>">Belum Lengkap</span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?php echo e(5 + count($jenis_penilaian)); ?>" style="text-align: center; padding: 50px 20px; color: #94a3b8;">
                                    <i class="fa-solid fa-user-xmark" style="font-size: 32px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                                    Belum ada siswa yang terdaftar di rombongan belajar ini.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                    <!-- Table Summary Footer (Rata-Rata Kelas) -->
                    <?php if(count($siswa) > 0): ?>
                        <tfoot>
                            <tr style="background: #f8fafc; border-top: 2px solid #e2e8f0; font-weight: 700;">
                                <td colspan="2" style="padding: 14px 16px; color: #334155;">
                                    <i class="fa-solid fa-calculator" style="color: #166534; margin-right: 6px;"></i> RATA-RATA KELAS
                                </td>
                                <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td style="text-align: center; padding: 14px 8px; color: #1e293b;" id="avg-jp-<?php echo e($jp->id); ?>">
                                        -
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <td style="text-align: center; padding: 14px 8px; color: #166534; font-size: 15px;" id="avg-na">
                                    -
                                </td>
                                <td style="text-align: center; padding: 14px 8px; color: #64748b;" id="avg-predikat">-</td>
                                <td style="text-align: center; padding: 14px 8px; font-size: 12px; color: #64748b;" id="ket-tuntas">-</td>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            </div>

            <!-- Sticky Bottom Save Bar -->
            <?php if(count($siswa) > 0): ?>
                <div class="sticky-save-bar">
                    <div style="display: flex; align-items: center; gap: 16px;">
                        <div>
                            <span style="font-size: 13px; color: #64748b; font-weight: 500; display: block;">Kelengkapan Nilai</span>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <strong id="progressText" style="font-size: 15px; color: #1e293b;">0 / <?php echo e(count($siswa)); ?> Siswa</strong>
                                <span id="progressPercent" style="font-size: 12px; color: #16a34a; font-weight: 700;">(0%)</span>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 12px;">
                        <a href="/sk/nilai-guru" style="padding: 10px 18px; border-radius: 8px; background: #f1f5f9; color: #475569; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s;">
                            Batal
                        </a>
                        <button type="submit" id="btnSubmitNilai" style="padding: 10px 24px; border: none; background: #166534; color: white; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px -1px rgba(22, 101, 52, 0.3); transition: all 0.2s;" onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#166534'">
                            <i class="fa-solid fa-floppy-disk"></i> Simpan Nilai Siswa
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <!-- Client-side Realtime Calculation & Navigation Script -->
    <script>
        const KKM = <?php echo e($kkm); ?>;
        const totalRows = <?php echo e(count($siswa)); ?>;
        const totalCols = <?php echo e(count($jenis_penilaian)); ?>;

        // Recalculate row scores
        function calculateRow(siswaId) {
            const inputs = document.querySelectorAll(`input.input-score-cell[data-siswa-id="${siswaId}"]`);
            let totalWeighted = 0;
            let totalBobot = 0;
            let filledCount = 0;

            inputs.forEach(inp => {
                const val = parseFloat(inp.value);
                const bobot = parseFloat(inp.getAttribute('data-bobot')) || 0;

                // Validation visual
                if (val > 100 || val < 0) {
                    inp.classList.add('invalid');
                } else {
                    inp.classList.remove('invalid');
                }

                if (!isNaN(val) && val >= 0 && val <= 100) {
                    totalWeighted += val * (bobot / 100);
                    totalBobot += bobot;
                    filledCount++;
                }
            });

            const naEl = document.getElementById(`na-${siswaId}`);
            const predikatEl = document.getElementById(`predikat-${siswaId}`);
            const statusEl = document.getElementById(`status-${siswaId}`);
            const rowEl = document.getElementById(`row-${siswaId}`);

            if (filledCount > 0) {
                // Skala proporsional jika bobot belum genap 100
                const finalScore = totalBobot > 0 ? (totalWeighted / (totalBobot / 100)) : 0;
                const formatted = finalScore.toFixed(1);
                
                if (naEl) naEl.textContent = formatted;

                // Predikat
                let pred = 'D';
                let predClass = 'predikat-d';
                if (finalScore >= 88) {
                    pred = 'A';
                    predClass = 'predikat-a';
                } else if (finalScore >= 78) {
                    pred = 'B';
                    predClass = 'predikat-b';
                } else if (finalScore >= 68) {
                    pred = 'C';
                    predClass = 'predikat-c';
                }
                
                if (predikatEl) {
                    predikatEl.textContent = pred;
                    predikatEl.className = `predikat-chip ${predClass}`;
                }

                // Status Tuntas vs Remedi
                if (statusEl) {
                    if (finalScore >= KKM) {
                        statusEl.textContent = 'Tuntas';
                        statusEl.className = 'badge-status badge-tuntas';
                        rowEl.setAttribute('data-status-calc', 'tuntas');
                    } else {
                        statusEl.textContent = 'Remedial';
                        statusEl.className = 'badge-status badge-remedi';
                        rowEl.setAttribute('data-status-calc', 'remedi');
                    }
                }
            } else {
                if (naEl) naEl.textContent = '-';
                if (predikatEl) {
                    predikatEl.textContent = '-';
                    predikatEl.className = 'predikat-chip';
                }
                if (statusEl) {
                    statusEl.textContent = 'Belum Dinilai';
                    statusEl.className = 'badge-status badge-kosong';
                    rowEl.setAttribute('data-status-calc', 'empty');
                }
            }

            if (filledCount < inputs.length && filledCount > 0) {
                rowEl.setAttribute('data-status-calc', 'empty');
            }
        }

        // Calculate class summary stats
        function calculateClassAverages() {
            let totalStudents = 0;
            let completeCount = 0;
            let tuntasCount = 0;
            let remediCount = 0;
            let emptyCount = 0;

            let colSums = {};
            let colCounts = {};
            let naSum = 0;
            let naCount = 0;

            const rows = document.querySelectorAll('.student-row');
            totalStudents = rows.length;

            rows.forEach(row => {
                const siswaId = row.getAttribute('data-siswa-id');
                const inputs = row.querySelectorAll('.input-score-cell');
                let allFilled = true;

                inputs.forEach(inp => {
                    const jpId = inp.getAttribute('data-jp-id');
                    const val = parseFloat(inp.value);

                    if (!colSums[jpId]) {
                        colSums[jpId] = 0;
                        colCounts[jpId] = 0;
                    }

                    if (!isNaN(val) && val >= 0 && val <= 100) {
                        colSums[jpId] += val;
                        colCounts[jpId]++;
                    } else {
                        allFilled = false;
                    }
                });

                const naEl = document.getElementById(`na-${siswaId}`);
                if (naEl && naEl.textContent !== '-') {
                    const naVal = parseFloat(naEl.textContent);
                    naSum += naVal;
                    naCount++;

                    if (naVal >= KKM) {
                        tuntasCount++;
                    } else {
                        remediCount++;
                    }
                }

                if (allFilled) {
                    completeCount++;
                } else {
                    emptyCount++;
                }
            });

            // Update footer col averages
            for (let jpId in colSums) {
                const avgEl = document.getElementById(`avg-jp-${jpId}`);
                if (avgEl) {
                    const count = colCounts[jpId];
                    avgEl.textContent = count > 0 ? (colSums[jpId] / count).toFixed(1) : '-';
                }
            }

            // Update NA average
            const avgNaEl = document.getElementById('avg-na');
            const avgPredEl = document.getElementById('avg-predikat');
            const ketTuntasEl = document.getElementById('ket-tuntas');
            
            if (avgNaEl) {
                const classAvg = naCount > 0 ? (naSum / naCount).toFixed(1) : '-';
                avgNaEl.textContent = classAvg;

                if (classAvg !== '-') {
                    const numAvg = parseFloat(classAvg);
                    if (avgPredEl) {
                        if (numAvg >= 88) avgPredEl.textContent = 'A';
                        else if (numAvg >= 78) avgPredEl.textContent = 'B';
                        else if (numAvg >= 68) avgPredEl.textContent = 'C';
                        else avgPredEl.textContent = 'D';
                    }
                    if (ketTuntasEl) {
                        const passRate = totalStudents > 0 ? ((tuntasCount / totalStudents) * 100).toFixed(0) : 0;
                        ketTuntasEl.textContent = `${passRate}% Tuntas`;
                    }
                }
            }

            // Update badge counters
            const elTuntas = document.getElementById('countTuntas');
            const elRemedi = document.getElementById('countRemedi');
            const elEmpty = document.getElementById('countEmpty');
            const elProgressText = document.getElementById('progressText');
            const elProgressPercent = document.getElementById('progressPercent');

            if (elTuntas) elTuntas.textContent = tuntasCount;
            if (elRemedi) elRemedi.textContent = remediCount;
            if (elEmpty) elEmpty.textContent = emptyCount;

            if (elProgressText) {
                elProgressText.textContent = `${completeCount} / ${totalStudents} Siswa Lengkap`;
            }
            if (elProgressPercent) {
                const pct = totalStudents > 0 ? Math.round((completeCount / totalStudents) * 100) : 0;
                elProgressPercent.textContent = `(${pct}%)`;
            }
        }

        // Excel-like Keyboard navigation (Arrow keys + Enter)
        function setupKeyboardNav() {
            const inputs = document.querySelectorAll('.input-score-cell');
            inputs.forEach(input => {
                input.addEventListener('keydown', function(e) {
                    const row = parseInt(this.getAttribute('data-row'));
                    const col = parseInt(this.getAttribute('data-col'));

                    let targetRow = row;
                    let targetCol = col;

                    if (e.key === 'ArrowDown' || e.key === 'Enter') {
                        e.preventDefault();
                        targetRow = row + 1;
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        targetRow = row - 1;
                    } else if (e.key === 'ArrowRight' && (this.selectionStart === this.value.length || this.value === '')) {
                        targetCol = col + 1;
                    } else if (e.key === 'ArrowLeft' && this.selectionStart === 0) {
                        targetCol = col - 1;
                    } else {
                        return;
                    }

                    const nextInput = document.querySelector(`.input-score-cell[data-row="${targetRow}"][data-col="${targetCol}"]`);
                    if (nextInput) {
                        nextInput.focus();
                        nextInput.select();
                    }
                });

                input.addEventListener('input', function() {
                    const siswaId = this.getAttribute('data-siswa-id');
                    calculateRow(siswaId);
                    calculateClassAverages();
                });
            });
        }

        // Filter by text search & status button
        let currentFilterStatus = 'all';

        function setFilter(status, btn) {
            currentFilterStatus = status;
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            if (btn) btn.classList.add('active');
            filterTable();
        }

        function filterTable() {
            const searchVal = document.getElementById('searchSiswa').value.toLowerCase().trim();
            const rows = document.querySelectorAll('.student-row');

            rows.forEach(row => {
                const nama = row.getAttribute('data-nama') || '';
                const nis = row.getAttribute('data-nis') || '';
                const calcStatus = row.getAttribute('data-status-calc') || 'empty';

                const matchesSearch = nama.includes(searchVal) || nis.includes(searchVal);
                let matchesStatus = true;

                if (currentFilterStatus === 'tuntas') {
                    matchesStatus = (calcStatus === 'tuntas');
                } else if (currentFilterStatus === 'remedi') {
                    matchesStatus = (calcStatus === 'remedi');
                } else if (currentFilterStatus === 'empty') {
                    matchesStatus = (calcStatus === 'empty');
                }

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Quick Fill Blank Inputs with KKM
        function quickFillBlank(val) {
            if (!confirm(`Isi semua kotak nilai yang masih KOSONG dengan nilai KKM (${val})?\nNilai yang sudah pernah diisi tidak akan ditimpa.`)) {
                return;
            }
            const inputs = document.querySelectorAll('.input-score-cell');
            let filledCount = 0;
            inputs.forEach(inp => {
                if (!inp.value || inp.value.trim() === '') {
                    inp.value = val;
                    inp.dispatchEvent(new Event('input', { bubbles: true }));
                    filledCount++;
                }
            });
            alert(`Berhasil mengisi ${filledCount} kotak nilai dengan angka ${val}.\nSilakan periksa kembali dan klik tombol 'Simpan Nilai' di bawah.`);
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.student-row');
            rows.forEach(row => {
                const siswaId = row.getAttribute('data-siswa-id');
                calculateRow(siswaId);
            });
            calculateClassAverages();
            setupKeyboardNav();
        });
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/guru/inputNilaiDetail.blade.php ENDPATH**/ ?>
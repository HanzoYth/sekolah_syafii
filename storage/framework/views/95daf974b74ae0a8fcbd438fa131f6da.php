<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Kelola Mata Pelajaran','description' => 'Manajemen data mata pelajaran kurikulum per jenjang sekolah','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Mata Pelajaran','description' => 'Manajemen data mata pelajaran kurikulum per jenjang sekolah','position' => 'Administrator','initials' => 'AD']); ?>

    <style>
        .mapel-tab-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .mapel-tab-btn {
            padding: 8px 18px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #475569;
            font-family: inherit;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .mapel-tab-btn:hover {
            background: #f1f5f9;
            color: #1e293b;
        }
        .mapel-tab-btn.active {
            background: #177455;
            color: #fff;
            border-color: #177455;
            box-shadow: 0 4px 12px rgba(23, 116, 85, .25);
        }
        .mapel-tab-pill {
            font-size: 0.72rem;
            padding: 2px 8px;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.08);
            font-weight: 700;
        }
        .mapel-tab-btn.active .mapel-tab-pill {
            background: rgba(255, 255, 255, 0.25);
            color: #fff;
        }
        .mapel-banner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 18px;
            margin-bottom: 20px;
            font-size: 0.84rem;
            color: #475569;
            flex-wrap: wrap;
            gap: 10px;
        }
        .badge-jenjang {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }
        .badge-sd { background: #fee2e2; color: #b91c1c; }
        .badge-smp { background: #dbeafe; color: #1d4ed8; }
        .badge-sma { background: #ede9fe; color: #6d28d9; }
        .badge-tk { background: #fef3c7; color: #b45309; }
        .badge-umum { background: #f1f5f9; color: #475569; }
        #mapelEmptyState.is-hidden {
            display: none !important;
        }
        #mapelEmptyState.is-visible {
            display: table-row !important;
        }
    </style>

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <!-- Header Toolbar -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; flex-wrap: wrap; gap: 14px;">
            <div>
                <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-book" style="color: #177455;"></i>
                    <span>Daftar Mata Pelajaran Kurikulum</span>
                </div>
                <p style="margin: 4px 0 0; font-size: 13px; color: #64748b;">Kelola struktur mata pelajaran dan standar KKM terpisah sesuai jenjang sekolah.</p>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="/sk/bobot-penilaian" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.2s; font-size: 14px;">
                    <i class="fa-solid fa-sliders"></i> Atur Bobot & KKM
                </a>
                <button onclick="openModalTambahMapel()" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s; font-size: 14px; box-shadow: 0 2px 6px rgba(23, 116, 85, .2);">
                    <i class="fa-solid fa-plus"></i> Tambah Mapel
                </button>
            </div>
        </div>

        <!-- Filter Tab per Jenjang (Fokus per Jenjang Sekolah) -->
        <div class="mapel-tab-bar" id="mapelTabBar">
            <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $kode = strtoupper(trim($s->jenis));
                    $isTk = str_contains(strtolower($kode), 'tk') || str_contains(strtolower($kode), 'paud');
                    $jmlMapel = $data_mapel->where('sekolah_id', $s->id)->count();
                    $isActive = ($index === 0);
                ?>
                <button type="button" class="mapel-tab-btn <?php echo e($isActive ? 'active' : ''); ?>"
                    data-jenjang-target="<?php echo e($kode); ?>"
                    data-sekolah-id="<?php echo e($s->id); ?>"
                    onclick="filterMapelJenjang('<?php echo e($kode); ?>', this)">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Jenjang <?php echo e($kode); ?></span>
                    <?php if($isTk): ?>
                        <span class="mapel-tab-pill"><?php echo e($jmlMapel); ?> Mapel • Non-KKM</span>
                    <?php else: ?>
                        <span class="mapel-tab-pill"><?php echo e($jmlMapel); ?> Mapel</span>
                    <?php endif; ?>
                </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php $jmlUmum = $data_mapel->whereNull('sekolah_id')->count(); ?>
            <?php if($jmlUmum > 0): ?>
                <button type="button" class="mapel-tab-btn"
                    data-jenjang-target="UMUM"
                    data-sekolah-id=""
                    onclick="filterMapelJenjang('UMUM', this)">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Umum / Lintas Jenjang</span>
                    <span class="mapel-tab-pill"><?php echo e($jmlUmum); ?> Mapel</span>
                </button>
            <?php endif; ?>
        </div>

        <!-- Sub-Banner Keterangan Jenjang Aktif -->
        <div class="mapel-banner" id="activeJenjangBanner">
            <div>
                <i class="fa-solid fa-layer-group" style="color: #177455; margin-right: 6px;"></i>
                Menampilkan Mata Pelajaran untuk: <strong id="lblActiveJenjangTitle" style="color: #0f172a;">Jenjang SD</strong>
                <span id="lblActiveJenjangDesc" style="color: #94a3b8; margin-left: 8px;">(Acuan kurikulum & nilai berlaku khusus untuk kelas pada jenjang ini)</span>
            </div>
            <div id="lblActiveJenjangStat" style="font-size: 0.8rem; font-weight: 700; color: #166534; background: #ecfdf5; padding: 4px 12px; border-radius: 6px; border: 1px solid #bbf7d0;"></div>
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
             <?php $__env->slot('thead', null, []); ?> 
                <tr>
                    <th style="width: 60px; text-align: center;">No.</th>
                    <th style="width: 120px; text-align: center;">Jenjang</th>
                    <th>Nama Mata Pelajaran</th>
                    <th style="width: 200px; text-align: center;">Standar KKM / Penilaian</th>
                    <th style="width: 130px; text-align: center;">Aksi</th>
                </tr>
             <?php $__env->endSlot(); ?>

            <tr id="mapelEmptyState" class="empty-row is-hidden" data-empty-state="true" style="display: none !important;">
                <td colspan="5" style="text-align: center; padding: 40px; color: #64748b; background: #ffffff;">
                    <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                    Belum ada mata pelajaran yang terdaftar untuk jenjang ini.<br>
                    <span style="font-size: 13px; color: #94a3b8;">Klik tombol <strong>Tambah Mapel</strong> untuk mendaftarkan mata pelajaran kurikulum jenjang ini.</span>
                </td>
            </tr>

            <?php if(count($data_mapel) > 0): ?>
                <?php $__currentLoopData = $data_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $kode = $m->kode_jenjang;
                        $isTkRow = $m->is_tk;
                        $badgeClass = match(strtolower($kode)) {
                            'sd' => 'badge-sd',
                            'smp' => 'badge-smp',
                            'sma', 'smk' => 'badge-sma',
                            'tk', 'paud' => 'badge-tk',
                            default => 'badge-umum'
                        };
                    ?>
                    <tr class="mapel-row" data-jenjang="<?php echo e($kode); ?>" data-sekolah-id="<?php echo e($m->sekolah_id); ?>">
                        <td style="text-align: center;" class="mapel-row-num"><?php echo e($index + 1); ?></td>
                        <td style="text-align: center;">
                            <span class="badge-jenjang <?php echo e($badgeClass); ?>">
                                <?php echo e($kode); ?>

                            </span>
                        </td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: #f1f5f3; color: #177455; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>
                                <div>
                                    <strong style="display: block; color: #1e293b; font-size: 14.5px;"><?php echo e($m->nama_mapel); ?></strong>
                                    <span style="font-size: 12px; color: #64748b;">ID: MAPEL-<?php echo e(str_pad($m->id, 3, '0', STR_PAD_LEFT)); ?></span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <?php if($isTkRow): ?>
                                <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 12px; background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;" title="Jenjang TK menggunakan Penilaian Capaian Perkembangan">
                                    <i class="fa-solid fa-star" style="color: #10b981;"></i> Capaian Deskriptif
                                </span>
                            <?php else: ?>
                                <span style="display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 6px; font-weight: 700; font-size: 13px; background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                                    <i class="fa-solid fa-award"></i> KKM: <?php echo e($m->kkm ?? 75); ?>

                                </span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <button onclick="editMapel(<?php echo e($m->id); ?>, '<?php echo e(addslashes($m->nama_mapel)); ?>', '<?php echo e($m->sekolah_id); ?>', '<?php echo e($m->kkm ?? 75); ?>', '<?php echo e($kode); ?>')" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit Mata Pelajaran">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button onclick="deleteMapel(<?php echo e($m->id); ?>, '<?php echo e(addslashes($m->nama_mapel)); ?>', '<?php echo e($kode); ?>')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Mata Pelajaran">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                        Belum ada data mata pelajaran yang terdaftar.
                    </td>
                </tr>
            <?php endif; ?>
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

    <!-- Modal Tambah Mapel -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'addModal','title' => 'Tambah Mata Pelajaran','icon' => 'fa-book-medical','iconColor' => '#166534','iconBg' => '#dcfce7']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'addModal','title' => 'Tambah Mata Pelajaran','icon' => 'fa-book-medical','iconColor' => '#166534','iconBg' => '#dcfce7']); ?>
        <form action="/sk/simpan-mapel" method="POST">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="addSekolahSelect" required onchange="onAddJenjangSelectChange()" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Jenjang --</option>
                    <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $kode = strtoupper(trim($s->jenis));
                            $isTk = str_contains(strtolower($kode), 'tk') || str_contains(strtolower($kode), 'paud');
                        ?>
                        <option value="<?php echo e($s->id); ?>" data-kode="<?php echo e($kode); ?>" data-tk="<?php echo e($isTk ? '1' : '0'); ?>">
                            Jenjang <?php echo e($kode); ?> <?php echo e($isTk ? '(Penilaian Deskriptif)' : '(Berbasis KKM Angka)'); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="addNamaMapel" required placeholder="Contoh: Matematika / Bahasa Arab" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
            </div>
            
            <div id="addKkmWrapper" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                <input type="number" name="kkm" id="addKkmInput" value="75" min="0" max="100" required placeholder="Standar: 75" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                <small style="color: #64748b; font-size: 12px; margin-top: 4px; display: block;">Skala nilai 0 - 100 (Default KKM standar: 75)</small>
            </div>

            <div id="addTkInfoBox" style="display: none; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; padding: 10px 14px; margin-bottom: 20px; font-size: 13px; color: #065f46;">
                <i class="fa-solid fa-circle-info" style="color: #059669; margin-right: 6px;"></i>
                Jenjang <strong>TK / PAUD</strong> menggunakan Penilaian Capaian Perkembangan Deskriptif (Non-KKM angka). Nilai KKM akan disimpan otomatis.
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Data</button>
            </div>
        </form>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

    <!-- Modal Edit Mapel -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'editModal','title' => 'Edit Mata Pelajaran','icon' => 'fa-pen-to-square','iconColor' => '#3875c5','iconBg' => '#e9f2ff']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'editModal','title' => 'Edit Mata Pelajaran','icon' => 'fa-pen-to-square','iconColor' => '#3875c5','iconBg' => '#e9f2ff']); ?>
        <form id="editForm" method="POST">
            <?php echo csrf_field(); ?>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="editSekolah" required onchange="onEditJenjangSelectChange()" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Jenjang --</option>
                    <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $kode = strtoupper(trim($s->jenis));
                            $isTk = str_contains(strtolower($kode), 'tk') || str_contains(strtolower($kode), 'paud');
                        ?>
                        <option value="<?php echo e($s->id); ?>" data-kode="<?php echo e($kode); ?>" data-tk="<?php echo e($isTk ? '1' : '0'); ?>">
                            Jenjang <?php echo e($kode); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="editInput" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
            </div>
            
            <div id="editKkmWrapper" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                <input type="number" name="kkm" id="editKkm" min="0" max="100" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                <small style="color: #64748b; font-size: 12px; margin-top: 4px; display: block;">Skala nilai 0 - 100 (Default: 75)</small>
            </div>

            <div id="editTkInfoBox" style="display: none; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 8px; padding: 10px 14px; margin-bottom: 20px; font-size: 13px; color: #065f46;">
                <i class="fa-solid fa-circle-info" style="color: #059669; margin-right: 6px;"></i>
                Jenjang <strong>TK / PAUD</strong> menggunakan Penilaian Capaian Perkembangan Deskriptif (Non-KKM angka).
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Perubahan</button>
            </div>
        </form>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

    <!-- Modal Delete Mapel -->
    <?php if (isset($component)) { $__componentOriginale960230fd71228156fe70d1ba75c1455 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale960230fd71228156fe70d1ba75c1455 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad.ui.modal','data' => ['id' => 'deleteModal','title' => 'Konfirmasi Hapus','icon' => 'fa-triangle-exclamation','iconColor' => '#b34d4d','iconBg' => '#f8e9e9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad.ui.modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'deleteModal','title' => 'Konfirmasi Hapus','icon' => 'fa-triangle-exclamation','iconColor' => '#b34d4d','iconBg' => '#f8e9e9']); ?>
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus <strong id="deleteMapelName" style="color: #1e293b;"></strong>? Data yang dihapus tidak dapat dipulihkan.</p>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('deleteModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="button" id="btnConfirmDelete" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Ya, Hapus</button>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $attributes = $__attributesOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__attributesOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale960230fd71228156fe70d1ba75c1455)): ?>
<?php $component = $__componentOriginale960230fd71228156fe70d1ba75c1455; ?>
<?php unset($__componentOriginale960230fd71228156fe70d1ba75c1455); ?>
<?php endif; ?>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        // Filter Tab Jenjang pada Tabel Mata Pelajaran
        function filterMapelJenjang(kode, btn) {
            document.querySelectorAll('.mapel-tab-btn').forEach(b => b.classList.remove('active'));
            if (btn) {
                btn.classList.add('active');
            } else {
                const targetBtn = document.querySelector(`.mapel-tab-btn[data-jenjang-target="${kode}"]`);
                if (targetBtn) targetBtn.classList.add('active');
            }

            try {
                localStorage.setItem('siakad_active_mapel_jenjang', kode);
            } catch (e) {}

            const titleEl = document.getElementById('lblActiveJenjangTitle');
            const descEl = document.getElementById('lblActiveJenjangDesc');
            if (titleEl) {
                titleEl.textContent = (kode === 'UMUM') ? 'Umum / Lintas Jenjang' : `Jenjang ${kode}`;
            }
            if (descEl) {
                if (kode === 'SD') {
                    descEl.textContent = '(Kurikulum & KKM berlaku untuk Kelas 1 s/d 6 SD)';
                } else if (kode === 'SMP') {
                    descEl.textContent = '(Kurikulum & KKM berlaku untuk Kelas 7 s/d 9 SMP)';
                } else if (kode === 'TK' || kode === 'PAUD') {
                    descEl.textContent = '(Kurikulum berbasis Capaian Perkembangan Anak Usia Dini - Non-KKM)';
                } else {
                    descEl.textContent = '(Berlaku untuk seluruh kelas pada jenjang ini)';
                }
            }

            let visibleCount = 0;
            document.querySelectorAll('.mapel-row').forEach(row => {
                const rowJenjang = row.getAttribute('data-jenjang');
                if (rowJenjang === kode) {
                    row.setAttribute('data-filtered-out', 'false');
                    row.style.display = '';
                    visibleCount++;
                    const numCell = row.querySelector('.mapel-row-num');
                    if (numCell) numCell.textContent = visibleCount;
                } else {
                    row.setAttribute('data-filtered-out', 'true');
                    row.style.display = 'none';
                }
            });

            const emptyState = document.getElementById('mapelEmptyState');
            if (emptyState) {
                if (visibleCount === 0) {
                    emptyState.classList.remove('is-hidden');
                    emptyState.classList.add('is-visible');
                    emptyState.style.setProperty('display', 'table-row', 'important');
                } else {
                    emptyState.classList.remove('is-visible');
                    emptyState.classList.add('is-hidden');
                    emptyState.style.setProperty('display', 'none', 'important');
                }
            }

            const statEl = document.getElementById('lblActiveJenjangStat');
            if (statEl) {
                statEl.textContent = `${visibleCount} Mata Pelajaran Terdaftar`;
            }

            if (typeof window.refreshSiakadPagination === 'function') {
                window.refreshSiakadPagination();
            }
        }

        // Buka Modal Tambah Mapel dengan Jenjang Terkunci Sesuai Tab Aktif
        function openModalTambahMapel() {
            const activeBtn = document.querySelector('.mapel-tab-btn.active');
            const activeSekolahId = activeBtn ? activeBtn.getAttribute('data-sekolah-id') : '';
            const sel = document.getElementById('addSekolahSelect');
            if (sel && activeSekolahId) {
                sel.value = activeSekolahId;
            }
            document.getElementById('addNamaMapel').value = '';
            onAddJenjangSelectChange();
            openModal('addModal');
        }

        // Reaksi Dinamis saat Pilihan Jenjang di Modal Tambah Berubah
        function onAddJenjangSelectChange() {
            const sel = document.getElementById('addSekolahSelect');
            const opt = sel.options[sel.selectedIndex];
            const isTk = opt ? (opt.getAttribute('data-tk') === '1') : false;

            const kkmWrap = document.getElementById('addKkmWrapper');
            const tkInfo = document.getElementById('addTkInfoBox');
            const kkmInput = document.getElementById('addKkmInput');

            if (isTk) {
                kkmWrap.style.display = 'none';
                tkInfo.style.display = 'block';
                kkmInput.required = false;
                kkmInput.value = '0';
            } else {
                kkmWrap.style.display = 'block';
                tkInfo.style.display = 'none';
                kkmInput.required = true;
                if (!kkmInput.value || kkmInput.value === '0') kkmInput.value = '75';
            }
        }

        // Modal Edit Mapel
        function editMapel(id, nama, sekolah_id, kkm, jenjangKode) {
            document.getElementById('editForm').action = "/sk/update-mapel/" + id;
            document.getElementById('editInput').value = nama;
            
            const sel = document.getElementById('editSekolah');
            if (sekolah_id) {
                sel.value = sekolah_id;
            } else {
                sel.value = "";
            }

            document.getElementById('editKkm').value = kkm || 75;
            onEditJenjangSelectChange();
            openModal('editModal');
        }

        function onEditJenjangSelectChange() {
            const sel = document.getElementById('editSekolah');
            const opt = sel.options[sel.selectedIndex];
            const isTk = opt ? (opt.getAttribute('data-tk') === '1') : false;

            const kkmWrap = document.getElementById('editKkmWrapper');
            const tkInfo = document.getElementById('editTkInfoBox');
            const kkmInput = document.getElementById('editKkm');

            if (isTk) {
                kkmWrap.style.display = 'none';
                tkInfo.style.display = 'block';
                kkmInput.required = false;
            } else {
                kkmWrap.style.display = 'block';
                tkInfo.style.display = 'none';
                kkmInput.required = true;
                if (!kkmInput.value || kkmInput.value === '0') kkmInput.value = '75';
            }
        }

        let deleteIdTarget = null;
        function deleteMapel(id, nama, jenjangKode) {
            deleteIdTarget = id;
            document.getElementById('deleteMapelName').textContent = `[Jenjang ${jenjangKode}] ${nama}`;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) {
                window.location.href = "/sk/hapus-mapel/" + deleteIdTarget;
            }
        });

        // Inisialisasi Tab Aktif saat Halaman Dimuat
        document.addEventListener('DOMContentLoaded', function() {
            let initialJenjang = null;
            try {
                initialJenjang = localStorage.getItem('siakad_active_mapel_jenjang');
            } catch (e) {}

            const firstTabBtn = document.querySelector('.mapel-tab-btn');
            const defaultKode = firstTabBtn ? firstTabBtn.getAttribute('data-jenjang-target') : 'SD';

            if (!initialJenjang || !document.querySelector(`.mapel-tab-btn[data-jenjang-target="${initialJenjang}"]`)) {
                initialJenjang = defaultKode;
            }

            const activeBtn = document.querySelector(`.mapel-tab-btn[data-jenjang-target="${initialJenjang}"]`) || firstTabBtn;
            if (activeBtn) {
                filterMapelJenjang(initialJenjang, activeBtn);
            }
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\kelolaMapel.blade.php ENDPATH**/ ?>
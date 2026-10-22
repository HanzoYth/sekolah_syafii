<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Edit Jadwal Pelajaran','description' => 'Perbarui informasi jadwal mengajar berbasis Sistem JP.','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Edit Jadwal Pelajaran','description' => 'Perbarui informasi jadwal mengajar berbasis Sistem JP.','position' => 'Administrator','initials' => 'AD']); ?>

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-pen-to-square" style="color: #0d5c3a;"></i> Edit Jadwal Pelajaran
        </div>
        <form action="/sk/update-jadwal/<?php echo e($jadwal->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;"> Kelas (Jenjang & Tingkatan)</label>
                    <select name="kelas_id" id="editKelasSelect" required onchange="onEditKelasChange(false)" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $namaKelas = $k->nama_kelas ?? ($k->nama_ruang ?? '-');
                                $prefixKelas = strtoupper(explode(' ', trim($namaKelas))[0] ?? '');
                            ?>
                            <option value="<?php echo e($k->id); ?>" data-jenjang="<?php echo e($prefixKelas); ?>" <?php echo e($jadwal->kelas_id == $k->id ? 'selected' : ''); ?>>
                                <?php echo e($namaKelas); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Hari</label>
                    <select name="hari" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="senin" <?php echo e($jadwal->hari == 'senin' ? 'selected' : ''); ?>>Senin</option>
                        <option value="selasa" <?php echo e($jadwal->hari == 'selasa' ? 'selected' : ''); ?>>Selasa</option>
                        <option value="rabu" <?php echo e($jadwal->hari == 'rabu' ? 'selected' : ''); ?>>Rabu</option>
                        <option value="kamis" <?php echo e($jadwal->hari == 'kamis' ? 'selected' : ''); ?>>Kamis</option>
                        <option value="jumat" <?php echo e($jadwal->hari == 'jumat' ? 'selected' : ''); ?>>Jumat</option>
                        <option value="sabtu" <?php echo e($jadwal->hari == 'sabtu' ? 'selected' : ''); ?>>Sabtu</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Jam Pelajaran (JP)</label>
                    <select name="jam_pelajaran_id" id="editJamSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <?php $__currentLoopData = $data_jam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $kodeJam = $jam->kode_jenjang;
                                $mulai = substr($jam->jam_mulai, 0, 5);
                                $selesai = substr($jam->jam_selesai, 0, 5);
                                $jmlJp = $jam->hitung_jp;
                                $durasi = $jam->durasi_menit;
                                $sesiLabel = $jam->jam_ke ?: ('Jam ke-' . $loop->iteration);
                            ?>
                            <?php if($jam->is_istirahat): ?>
                                <option value="<?php echo e($jam->id); ?>" disabled data-jenjang="<?php echo e($kodeJam); ?>" style="color: #b45309; background-color: #fefce8; font-style: italic;">
                                    [<?php echo e($kodeJam); ?>] ☕ <?php echo e($sesiLabel); ?> (<?php echo e($mulai); ?> - <?php echo e($selesai); ?> • JAM ISTIRAHAT - Bebas KBM)
                                </option>
                            <?php else: ?>
                                <option value="<?php echo e($jam->id); ?>" data-jenjang="<?php echo e($kodeJam); ?>" <?php echo e($jadwal->jam_pelajaran_id == $jam->id ? 'selected' : ''); ?>>
                                    [<?php echo e($kodeJam); ?>] <?php echo e($sesiLabel); ?> (<?php echo e($mulai); ?> - <?php echo e($selesai); ?> • <?php echo e($jmlJp > 0 ? $jmlJp . ' JP / ' . $durasi . 'm' : 'Non-JP / ' . $durasi . 'm'); ?>)
                                </option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Mata Pelajaran</label>
                    <select name="mapel_id" id="editMapelSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <?php $__currentLoopData = $data_mapel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $kodeMapel = $m->sekolah ? strtoupper(trim($m->sekolah->jenis)) : 'UMUM';
                            ?>
                            <option value="<?php echo e($m->id); ?>" data-jenjang="<?php echo e($kodeMapel); ?>" <?php echo e($jadwal->mapel_id == $m->id ? 'selected' : ''); ?>>
                                [<?php echo e($kodeMapel); ?>] <?php echo e($m->nama_mapel); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Guru Pengajar</label>
                    <select name="guru_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <?php $__currentLoopData = $data_guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $tags = [];
                                if ($g->guru_tetap) $tags[] = 'Guru Tetap';
                                elseif ($g->guru_honor) $tags[] = 'Guru Honor';
                                if (\App\Models\wallas::where('guru_id', $g->id)->exists()) $tags[] = 'Wali Kelas';
                                $tagLabel = count($tags) > 0 ? ' (' . implode(', ', $tags) . ')' : '';
                            ?>
                            <option value="<?php echo e($g->id); ?>" <?php echo e($jadwal->guru_id == $g->id ? 'selected' : ''); ?>><?php echo e($g->nama); ?><?php echo e($tagLabel); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <?php $__currentLoopData = $data_tahun; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($t->id); ?>" <?php echo e($jadwal->tahun_ajaran_id == $t->id ? 'selected' : ''); ?>><?php echo e($t->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #0d5c3a; color: white; border-radius: 8px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                <a href="/sk/kelola-jadwal" style="padding: 10px 20px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; font-weight: bold; text-decoration: none;">Batal</a>
            </div>
        </form>
    </div>

    <script>
        function onEditKelasChange(initialLoad) {
            const kelasSel = document.getElementById('editKelasSelect');
            const opt = kelasSel.options[kelasSel.selectedIndex];
            const jenjang = opt ? (opt.getAttribute('data-jenjang') || '') : '';
            const jamSel = document.getElementById('editJamSelect');
            const mapelSel = document.getElementById('editMapelSelect');

            let adaJamJenjangSpesifik = false;
            Array.from(jamSel.options).forEach(o => {
                if (o.getAttribute('data-jenjang') === jenjang) adaJamJenjangSpesifik = true;
            });

            Array.from(jamSel.options).forEach(o => {
                const jKode = o.getAttribute('data-jenjang');
                if (!jenjang || !adaJamJenjangSpesifik) {
                    o.hidden = false;
                } else {
                    o.hidden = (jKode !== jenjang && jKode !== 'UMUM' && !o.selected);
                }
            });

            Array.from(mapelSel.options).forEach(o => {
                const mKode = o.getAttribute('data-jenjang');
                o.hidden = (jenjang && mKode !== jenjang && mKode !== 'UMUM' && !o.selected);
            });
        }
        document.addEventListener('DOMContentLoaded', () => onEditKelasChange(true));
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\editJadwal.blade.php ENDPATH**/ ?>
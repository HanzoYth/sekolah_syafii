<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Nilai & Rapor Akademik Siswa','description' => 'Transkrip rincian nilai komponen (Tugas, UH, UTS, UAS) dan pratinjau dokumen Rapor Semester ananda '.e($siswa->nama).'.','position' => 'Siswa / Orang Tua','initials' => 'SW']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nilai & Rapor Akademik Siswa','description' => 'Transkrip rincian nilai komponen (Tugas, UH, UTS, UAS) dan pratinjau dokumen Rapor Semester ananda '.e($siswa->nama).'.','position' => 'Siswa / Orang Tua','initials' => 'SW']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Nilai & Rapor</span>
        </li>
     <?php $__env->endSlot(); ?>

    <?php
        $activeTab = $tab ?? request('tab', 'transkrip');
        $namaKelas = $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? '-');
    ?>

    <!-- Top Summary KPI Cards (Hidden when printing) -->
    <div class="no-print grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Mata Pelajaran</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($stats_akademik['mapel_dinilai'] ?? 0); ?> / <?php echo e($stats_akademik['total_mapel'] ?? count($rekap_nilai)); ?></h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mapel telah dinilai</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Rata-rata Nilai Akhir</p>
                <h3 class="text-xl font-bold text-emerald-600"><?php echo e(($stats_akademik['rata_rata'] ?? 0) > 0 ? number_format($stats_akademik['rata_rata'], 1) : '-'); ?></h3>
                <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Predikat: <?php echo e($stats_akademik['predikat_umum'] ?? '-'); ?></p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Status Ketuntasan</p>
                <h3 class="text-xl font-bold text-slate-800"><?php echo e($stats_akademik['mapel_tuntas'] ?? 0); ?> Mapel</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mencapai batas KKM</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Wali Kelas</p>
                <h3 class="text-sm font-bold text-slate-800 line-clamp-1"><?php echo e($wallas->guru->nama ?? 'Belum Ditentukan'); ?></h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Kelas <?php echo e($namaKelas); ?></p>
            </div>
        </div>
    </div>

    <!-- Tab Bar & Print Button -->
    <div class="no-print flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex flex-wrap p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 self-start gap-1">
            <a href="/sk/rapor-siswa?tab=transkrip" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab !== 'rapor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-list-check"></i>
                <span>Transkrip Rincian Nilai Komponen</span>
            </a>
            <a href="/sk/rapor-siswa?tab=rapor" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all <?php echo e($activeTab === 'rapor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800'); ?>">
                <i class="fa-solid fa-file-contract"></i>
                <span>Lembar Rapor Semester</span>
            </a>
        </div>

        <?php if($activeTab === 'rapor'): ?>
            <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-2 self-start sm:self-auto">
                <i class="fa-solid fa-print"></i> Cetak Dokumen Rapor
            </button>
        <?php endif; ?>
    </div>

    <?php if($activeTab === 'rapor'): ?>
        <!-- TAB 2: LEMBAR RAPOR RESMI (SIAP CETAK) -->
        <div class="print-area bg-white rounded-xl shadow-sm border border-slate-200 p-8 sm:p-12 text-slate-900">
            <!-- Kop Rapor -->
            <div class="text-center border-b-2 border-slate-800 pb-5 mb-6">
                <h1 class="text-xl sm:text-2xl font-extrabold uppercase tracking-wide text-slate-900">Laporan Hasil Capaian Belajar Peserta Didik</h1>
                <p class="text-sm font-semibold text-slate-600 mt-1">
                    Tahun Ajaran <?php echo e($tahun_aktif->nama ?? '2026/2027'); ?> &bull; Semester <?php echo e(ucfirst($tahun_aktif->semester ?? 'Ganjil')); ?>

                </p>
            </div>

            <!-- Identitas Siswa -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-sm mb-6 pb-4 border-b border-slate-200">
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Nama Peserta Didik</span>
                    <span class="mr-2">:</span>
                    <span class="font-bold text-slate-900 uppercase"><?php echo e($siswa->nama); ?></span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Kelas / Rombel</span>
                    <span class="mr-2">:</span>
                    <span class="font-bold text-slate-900"><?php echo e($namaKelas); ?></span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Nomor Induk / NIS</span>
                    <span class="mr-2">:</span>
                    <span class="font-mono font-semibold text-slate-800"><?php echo e($siswa->nis ?? '-'); ?></span>
                </div>
                <div class="flex">
                    <span class="w-36 font-semibold text-slate-600">Wali Kelas</span>
                    <span class="mr-2">:</span>
                    <span class="font-semibold text-slate-800"><?php echo e($wallas->guru->nama ?? '-'); ?></span>
                </div>
            </div>

            <!-- A. Capaian Nilai Akademik -->
            <div class="mb-6">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">A. Capaian Nilai Akademik</h3>
                <div class="overflow-x-auto w-full">
                    <table class="w-full border-collapse border border-slate-400 text-xs sm:text-sm">
                        <thead>
                            <tr class="bg-slate-100 text-slate-800 font-bold text-center">
                                <th class="border border-slate-400 px-3 py-2.5 w-10">No</th>
                                <th class="border border-slate-400 px-3 py-2.5 text-left">Mata Pelajaran</th>
                                <th class="border border-slate-400 px-3 py-2.5 w-16">KKM</th>
                                <th class="border border-slate-400 px-3 py-2.5 w-24">Nilai Akhir</th>
                                <th class="border border-slate-400 px-3 py-2.5 w-20">Predikat</th>
                                <th class="border border-slate-400 px-3 py-2.5 w-28">Ketuntasan</th>
                                <th class="border border-slate-400 px-3 py-2.5 text-left">Deskripsi Capaian Kompetensi</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php if(count($rekap_nilai) > 0): ?>
                            <?php $__currentLoopData = $rekap_nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel_id => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="border border-slate-400 px-3 py-2 text-center"><?php echo e($loop->iteration); ?></td>
                                    <td class="border border-slate-400 px-3 py-2 font-semibold"><?php echo e($data['mata_pelajaran']->nama_mapel ?? '-'); ?></td>
                                    <td class="border border-slate-400 px-3 py-2 text-center text-slate-600"><?php echo e($data['kkm'] ?? 75); ?></td>
                                    <td class="border border-slate-400 px-3 py-2 text-center font-bold">
                                        <?php echo e($data['ada_nilai'] ? number_format($data['nilai_akhir'], 1) : '-'); ?>

                                    </td>
                                    <td class="border border-slate-400 px-3 py-2 text-center font-bold"><?php echo e($data['predikat'] ?? '-'); ?></td>
                                    <td class="border border-slate-400 px-3 py-2 text-center font-semibold <?php echo e(!$data['ada_nilai'] ? 'text-slate-400' : ($data['tuntas'] ? 'text-emerald-800' : 'text-rose-700')); ?>">
                                        <?php echo e(!$data['ada_nilai'] ? 'Belum Dinilai' : ($data['tuntas'] ? 'Tuntas' : 'Belum Tuntas')); ?>

                                    </td>
                                    <td class="border border-slate-400 px-3 py-2 text-xs text-slate-700 leading-relaxed"><?php echo e($data['deskripsi'] ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr class="bg-slate-50 font-bold">
                                <td colspan="3" class="border border-slate-400 px-3 py-2 text-right">Jumlah Nilai Akhir</td>
                                <td class="border border-slate-400 px-3 py-2 text-center"><?php echo e(number_format($stats_akademik['total_nilai_akhir'] ?? 0, 1)); ?></td>
                                <td colspan="3" class="border border-slate-400 px-3 py-2 text-left">
                                    Rata-Rata Capaian Rapor: <span class="underline"><?php echo e(number_format($stats_akademik['rata_rata'] ?? 0, 1)); ?></span>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="border border-slate-400 px-4 py-6 text-center text-slate-500">
                                    Belum ada data nilai rapor untuk semester ini.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>

            <!-- B. Ketidakhadiran & C. Evaluasi Wali Kelas -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-10">
                <div class="md:col-span-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">B. Rekapitulasi Ketidakhadiran</h3>
                    <div class="overflow-x-auto w-full">
                        <table class="w-full border-collapse border border-slate-400 text-sm">
                            <tr>
                                <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">1. Sakit</td>
                                <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold w-28"><?php echo e($rekap_absen['s'] ?? 0); ?> Hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">2. Izin</td>
                                <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold"><?php echo e($rekap_absen['i'] ?? 0); ?> Hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">3. Tanpa Keterangan (Alpa)</td>
                                <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold"><?php echo e($rekap_absen['a'] ?? 0); ?> Hari</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="md:col-span-7">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">C. Catatan Evaluasi Wali Kelas</h3>
                    <?php
                        $rata = $stats_akademik['rata_rata'] ?? 0;
                        $catatanOtomatis = $rata >= 85
                            ? "Ananda {$siswa->nama} menunjukkan prestasi akademik yang sangat baik dan aktif dalam kegiatan pembelajaran di kelas. Pertahankan semangat belajar dan terus tingkatkan potensi diri."
                            : ($rata >= 75
                                ? "Ananda {$siswa->nama} telah mengikuti kegiatan pembelajaran dengan baik dan mencapai ketuntasan belajar. Tingkatkan terus kedisiplinan dan keaktifan belajar di semester berikutnya."
                                : "Terus tingkatkan semangat belajar, keaktifan di kelas, dan pengulangan materi pelajaran di rumah agar capaian akademik semakin optimal.");
                    ?>
                    <div class="border border-slate-400 p-4 min-h-[106px] text-sm text-slate-800 italic leading-relaxed bg-slate-50/30">
                        "<?php echo e($catatanOtomatis); ?>"
                    </div>
                </div>
            </div>

            <!-- Tanda Tangan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-12 text-sm text-center">
                <div>
                    <p class="mb-14 sm:mb-20">Mengetahui,<br>Orang Tua / Wali Peserta Didik</p>
                    <p class="font-bold underline">....................................................</p>
                </div>
                <div>
                    <p class="mb-14 sm:mb-20">Wali Kelas <?php echo e($namaKelas); ?></p>
                    <p class="font-bold underline"><?php echo e($wallas->guru->nama ?? '....................................................'); ?></p>
                    <?php if(!empty($wallas->guru->nig)): ?>
                        <p class="text-xs text-slate-600 mt-0.5">NIG. <?php echo e($wallas->guru->nig); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- TAB 1: TRANSKRIP RINCIAN NILAI KOMPONEN -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Rincian Capaian Nilai Per Komponen</h3>
                    <p class="text-xs text-slate-500">Daftar nilai Tugas, Ulangan Harian, UTS, dan UAS yang diinput oleh Guru Pengajar maupun Wali Kelas</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Tahun Ajaran <?php echo e($tahun_aktif->nama ?? '2026/2027'); ?>

                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-12 text-center">No</th>
                            <th class="px-5 py-3.5">Mata Pelajaran & Pengajar</th>
                            <th class="px-5 py-3.5 text-center">KKM</th>
                            <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="px-4 py-3.5 text-center">
                                    <?php echo e($jp->nama_jenis); ?>

                                    <span class="block text-[10px] font-normal text-slate-400">Bobot <?php echo e($jp->bobot); ?>%</span>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <th class="px-5 py-3.5 text-center bg-emerald-50/70 text-emerald-900">Nilai Akhir</th>
                            <th class="px-5 py-3.5 text-center">Predikat</th>
                            <th class="px-5 py-3.5 text-center">Ketuntasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(count($rekap_nilai) > 0): ?>
                            <?php $__currentLoopData = $rekap_nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mapel_id => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $ada = $data['ada_nilai'] ?? true;
                                    $na = $data['nilai_akhir'];
                                    $predikat = $data['predikat'] ?? '-';
                                    $tuntas = $data['tuntas'] ?? ($na >= ($data['kkm'] ?? 75));
                                ?>
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium"><?php echo e($loop->iteration); ?></td>
                                    <td class="px-5 py-4">
                                        <span class="font-bold text-slate-800 block"><?php echo e($data['mata_pelajaran']->nama_mapel ?? '-'); ?></span>
                                        <span class="text-xs text-slate-400">
                                            <i class="fa-solid fa-chalkboard-user text-[10px] mr-1"></i> <?php echo e($data['guru_nama'] ?? '-'); ?>

                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-center font-mono text-xs font-semibold text-slate-500">
                                        <?php echo e($data['kkm'] ?? 75); ?>

                                    </td>
                                    <?php $__currentLoopData = $jenis_penilaian; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $skor = $data['nilai_detail'][$jp->id] ?? null;
                                        ?>
                                        <td class="px-4 py-4 text-center font-mono">
                                            <?php if($skor !== null): ?>
                                                <span class="font-semibold text-slate-700"><?php echo e($skor); ?></span>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-300">-</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td class="px-5 py-4 text-center bg-emerald-50/30 font-extrabold text-base <?php echo e(!$ada ? 'text-slate-400' : ($tuntas ? 'text-emerald-700' : 'text-rose-600')); ?>">
                                        <?php echo e($ada ? number_format($na, 1) : '-'); ?>

                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if(!$ada): ?>
                                            <span class="text-xs text-slate-400">-</span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-extrabold <?php echo e($predikat === 'A' ? 'bg-emerald-100 text-emerald-800' : ($predikat === 'B' ? 'bg-blue-100 text-blue-800' : ($predikat === 'C' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800'))); ?>">
                                                <?php echo e($predikat); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        <?php if(!$ada): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                Belum Input
                                            </span>
                                        <?php elseif($tuntas): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Tuntas
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-rotate-right mr-1 text-[10px]"></i> Perlu Remedi
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?php echo e(6 + count($jenis_penilaian)); ?>" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-folder-open text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Data Mata Pelajaran atau Nilai</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data nilai akan tampil secara otomatis setelah diinput oleh Guru Pengajar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <style>
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-area, .print-area * { visibility: visible; }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
        }
    </style>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\siswa\raporSiswa.blade.php ENDPATH**/ ?>
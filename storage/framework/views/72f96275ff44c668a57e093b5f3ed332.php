<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Dashboard Siswa & Wali Murid','description' => 'Pantau informasi akademik, jadwal pelajaran, jurnal materi harian, serta capaian nilai belajar.','position' => 'Siswa / Orang Tua','initials' => 'SW']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard Siswa & Wali Murid','description' => 'Pantau informasi akademik, jadwal pelajaran, jurnal materi harian, serta capaian nilai belajar.','position' => 'Siswa / Orang Tua','initials' => 'SW']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Dashboard Akademik Siswa</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- Welcome & Student Identity Banner -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-5">
        <div class="flex items-center gap-4 min-w-0 flex-1">
            <div class="w-14 h-14 min-w-[56px] min-h-[56px] aspect-square rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center text-2xl font-bold flex-shrink-0 overflow-hidden">
                <?php if(!empty($data_siswa->url_foto) && \Illuminate\Support\Facades\Storage::exists($data_siswa->url_foto)): ?>
                    <img src="<?php echo e(route('file.show', $data_siswa->url_foto)); ?>" alt="<?php echo e($data_siswa->nama); ?>" class="w-full h-full object-cover flex-shrink-0">
                <?php else: ?>
                    <i class="fa-solid fa-user-graduate"></i>
                <?php endif; ?>
            </div>
            <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2">
                    <h2 class="text-lg font-bold text-slate-800 break-words"><?php echo e($data_siswa->nama ?? 'Siswa SIAKAD'); ?></h2>
                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800">
                        Siswa Aktif
                    </span>
                </div>
                <p class="text-xs text-slate-500 mt-1">
                    NIS: <strong class="font-mono text-slate-700"><?php echo e($data_siswa->nis ?? '-'); ?></strong>
                    <span class="mx-1.5 text-slate-300">&bull;</span>
                    Kelas: <strong class="text-slate-700"><?php echo e($data_kelas->nama_ruang ?? 'Belum Ditempatkan'); ?></strong>
                    <span class="mx-1.5 text-slate-300">&bull;</span>
                    Tahun Ajaran: <strong class="text-slate-700"><?php echo e($tahun_aktif->nama ?? '2026/2027'); ?></strong>
                </p>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="/sk/jadwal-siswa?tab=absensi_mapel" class="px-3.5 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-book-open-reader text-emerald-600"></i> Jurnal & Absensi
            </a>
            <a href="/sk/rapor-siswa?tab=rapor" class="px-4 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-file-contract"></i> Lihat Rapor Semester
            </a>
        </div>
    </div>

    <!-- Top KPI Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-clipboard-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Persentase Kehadiran</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e($rekap_absen['persentase'] ?? 100); ?>%</h3>
                <p class="text-xs text-slate-400 mt-1">
                    <?php echo e($rekap_absen['hadir'] ?? 0); ?> Hadir &bull; <?php echo e(($rekap_absen['sakit'] ?? 0) + ($rekap_absen['izin'] ?? 0)); ?> S/I &bull; <?php echo e($rekap_absen['alpa'] ?? 0); ?> Alpa
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-star text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Rata-rata Nilai</p>
                <h3 class="text-2xl font-bold text-slate-800"><?php echo e(($rata_rata_nilai ?? 0) > 0 ? $rata_rata_nilai : '-'); ?></h3>
                <p class="text-xs text-slate-400 mt-1"><?php echo e(isset($nilai_terbaru) ? $nilai_terbaru->count() : 0); ?> Mata pelajaran dinilai</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-wallet text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Status Pembayaran</p>
                <?php if($ringkasan_pembayaran['lunas'] ?? true): ?>
                    <h3 class="text-2xl font-bold text-emerald-600">Lunas</h3>
                    <p class="text-xs text-slate-400 mt-1">Tidak ada tunggakan aktif</p>
                <?php else: ?>
                    <h3 class="text-xl font-bold text-rose-600"><?php echo e($ringkasan_pembayaran['tagihan_aktif']); ?> Tagihan</h3>
                    <p class="text-xs text-slate-400 mt-1">Sisa Rp <?php echo e(number_format($ringkasan_pembayaran['sisa_tagihan'] ?? 0, 0, ',', '.')); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <?php
            $rawWa = $wallas->guru->getUser->noWa ?? null;
            $cleanWa = $rawWa ? preg_replace('/[^0-9]/', '', $rawWa) : null;
            if ($cleanWa && str_starts_with($cleanWa, '0')) {
                $cleanWa = '62' . substr($cleanWa, 1);
            }
            $namaWallas = $wallas->guru->nama ?? 'Wali Kelas';
            $namaSiswa = $data_siswa->nama ?? 'Siswa';
            $nisSiswa = $data_siswa->nis ?? '-';
            $ruangKelasNama = $data_kelas->nama_ruang ?? '-';
            $tanggalHariIni = \Carbon\Carbon::now()->isoFormat('dddd, D MMMM Y');
        ?>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex flex-col justify-between">
            <div class="flex items-start space-x-4">
                <div class="p-3 bg-violet-50 text-violet-600 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-chalkboard-user text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-slate-500">Wali Kelas</p>
                    <h3 class="text-base font-bold text-slate-800 mt-0.5 line-clamp-1" title="<?php echo e($namaWallas); ?>"><?php echo e($namaWallas); ?></h3>
                    <p class="text-xs text-slate-400 mt-1">Pembina <?php echo e($ruangKelasNama); ?></p>
                </div>
            </div>

            <?php if($cleanWa): ?>
                <div class="mt-4 pt-3 border-t border-slate-100">
                    <button type="button" onclick="bukaModalIzinWa()" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold border border-emerald-200 transition-colors shadow-sm">
                        <i class="fa-brands fa-whatsapp text-sm text-emerald-600"></i> Kirim Izin / Sakit (WhatsApp)
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Grid: Jadwal Hari Ini & Capaian Nilai -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Jadwal Pelajaran & Jurnal Mengajar Hari Ini -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Jadwal & Aktivitas Kelas Hari Ini</h3>
                    <p class="text-xs text-slate-500"><?php echo e($hari_ini_label ?? date('d M Y')); ?> &bull; <?php echo e($data_kelas->nama_ruang ?? '-'); ?></p>
                </div>
                <a href="/sk/jadwal-siswa" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
                    Jadwal Lengkap <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-between">
                <?php if(isset($jadwal_hari_ini) && $jadwal_hari_ini->count() > 0): ?>
                    <div class="space-y-3.5">
                        <?php $__currentLoopData = $jadwal_hari_ini; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $jam_mulai = substr($j->jam_pelajaran->jam_mulai ?? '07:00:00', 0, 5);
                                $jam_selesai = substr($j->jam_pelajaran->jam_selesai ?? '08:30:00', 0, 5);
                                $now_hm = now()->format('H:i');
                                $absen_guru = $absensi_guru_hari_ini[$j->id] ?? null;

                                $status_sesi = 'terjadwal';
                                if ($now_hm > $jam_selesai) {
                                    $status_sesi = 'selesai';
                                } elseif ($now_hm >= $jam_mulai && $now_hm <= $jam_selesai) {
                                    $status_sesi = 'berlangsung';
                                }
                            ?>
                            <div class="flex items-stretch border <?php echo e($status_sesi === 'berlangsung' ? 'border-emerald-300 bg-emerald-50/20 shadow-sm' : 'border-slate-200 bg-white'); ?> rounded-xl overflow-hidden">
                                <div class="w-1.5 <?php echo e($status_sesi === 'berlangsung' ? 'bg-emerald-500' : ($status_sesi === 'selesai' ? 'bg-slate-400' : 'bg-blue-500')); ?>"></div>
                                <div class="p-4 flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <h4 class="text-sm font-bold text-slate-800"><?php echo e($j->mata_pelajaran->nama_mapel ?? '-'); ?></h4>
                                            <?php if($absen_guru): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                                    <i class="fa-solid fa-chalkboard-user mr-1"></i> Guru Masuk (<?php echo e(substr($absen_guru->jam_masuk, 0, 5)); ?>)
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-0.5">
                                            <i class="fa-solid fa-user-tie text-[10px] mr-1 text-slate-400"></i> <?php echo e($j->guru->nama ?? '-'); ?>

                                        </p>
                                        <?php if($absen_guru && $absen_guru->materi): ?>
                                            <p class="text-xs text-emerald-700 font-medium mt-1.5 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-100">
                                                <i class="fa-solid fa-book-bookmark text-[10px] mr-1"></i> Materi: <?php echo e($absen_guru->materi); ?>

                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="sm:text-right flex sm:flex-col items-center sm:items-end justify-between">
                                        <span class="text-xs font-mono font-bold text-slate-700"><?php echo e($jam_mulai); ?> - <?php echo e($jam_selesai); ?> WIB</span>
                                        <?php if($status_sesi === 'berlangsung'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 mt-1 animate-pulse">
                                                Sedang Berlangsung
                                            </span>
                                        <?php elseif($status_sesi === 'selesai'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-600 mt-1">
                                                Selesai
                                            </span>
                                        <?php else: ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-blue-50 text-blue-700 mt-1">
                                                Berikutnya
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="py-10 text-center text-slate-500">
                        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-calendar-day text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Tidak Ada Jadwal Pelajaran Hari Ini</h4>
                        <p class="text-xs text-slate-400 mt-1">Silakan cek jadwal mingguan lengkap melalui menu Jadwal Pelajaran.</p>
                    </div>
                <?php endif; ?>

                <div class="mt-5 pt-3 border-t border-slate-100 text-xs text-slate-500 flex items-center justify-between">
                    <span><i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i> Materi otomatis terupdate saat guru mengisi jurnal kelas.</span>
                </div>
            </div>
        </div>

        <!-- Perkembangan Nilai Akademik -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Capaian Nilai Mata Pelajaran</h3>
                    <p class="text-xs text-slate-500">Kalkulasi nilai akhir berdasarkan komponen penilaian</p>
                </div>
                <a href="/sk/rapor-siswa" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
                    Detail Transkrip <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-between">
                <?php if(isset($nilai_terbaru) && $nilai_terbaru->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $nilai_terbaru->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $tuntas = $nt->nilai_akhir >= $nt->kkm;
                            ?>
                            <div>
                                <div class="flex justify-between items-center mb-1.5">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-bold text-slate-800"><?php echo e($nt->nama_mapel); ?></span>
                                        <span class="text-[10px] px-1.5 py-0.5 rounded bg-slate-100 text-slate-500 font-semibold">KKM <?php echo e($nt->kkm); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-extrabold <?php echo e($tuntas ? 'text-emerald-700' : 'text-rose-600'); ?>"><?php echo e($nt->nilai_akhir); ?></span>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?php echo e($tuntas ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'); ?>">
                                            <?php echo e($tuntas ? 'Tuntas' : 'Remedi'); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="<?php echo e($nt->nilai_akhir >= 85 ? 'bg-emerald-500' : ($tuntas ? 'bg-blue-500' : 'bg-amber-500')); ?> h-2 rounded-full transition-all" style="width: <?php echo e(min(100, $nt->nilai_akhir)); ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div class="py-10 text-center text-slate-500">
                        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-chart-simple text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Nilai Belum Diinput</h4>
                        <p class="text-xs text-slate-400 mt-1">Nilai mata pelajaran akan tampil setelah diinput oleh Guru Pengajar atau Wali Kelas.</p>
                    </div>
                <?php endif; ?>

                <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Rata-rata Nilai Akhir Sementara:</span>
                    <span class="font-bold text-slate-800 text-sm"><?php echo e(($rata_rata_nilai ?? 0) > 0 ? $rata_rata_nilai : '-'); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Lower Grid: Administrasi Pembayaran & Pengumuman -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Ringkasan Administrasi Pembayaran -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Status Administrasi Keuangan</h3>
                    <p class="text-xs text-slate-500">Ringkasan tagihan SPP/IPP, Uang Pangkal & Pendidikan</p>
                </div>
                <a href="/sk/pbs" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
                    Riwayat Tagihan <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <?php if($ringkasan_pembayaran['lunas'] ?? true): ?>
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-emerald-50 border border-emerald-200 mb-5">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-circle-check text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-emerald-900">Administrasi Pembayaran Lunas</h4>
                                <p class="text-xs text-emerald-700 mt-0.5">Tidak terdapat tunggakan tagihan aktif pada periode ini.</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-amber-50 border border-amber-200 mb-5">
                            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock text-xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-amber-900">Terdapat <?php echo e($ringkasan_pembayaran['tagihan_aktif']); ?> Tagihan Menunggu Pembayaran</h4>
                                <p class="text-xs text-amber-800 mt-0.5">Silakan buka menu Riwayat Pembayaran untuk melihat rincian tagihan.</p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80">
                            <span class="block text-xs text-slate-500 font-medium">Total Terbayar</span>
                            <span class="block text-base font-bold text-emerald-700 mt-1">Rp <?php echo e(number_format($ringkasan_pembayaran['total_dibayar'] ?? 0, 0, ',', '.')); ?></span>
                        </div>
                        <div class="p-4 bg-slate-50 rounded-xl border border-slate-200/80">
                            <span class="block text-xs text-slate-500 font-medium">Sisa Tagihan</span>
                            <span class="block text-base font-bold <?php echo e(($ringkasan_pembayaran['sisa_tagihan'] ?? 0) > 0 ? 'text-rose-600' : 'text-slate-800'); ?> mt-1">
                                Rp <?php echo e(number_format($ringkasan_pembayaran['sisa_tagihan'] ?? 0, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>

                <a href="/sk/pbs" class="mt-5 w-full flex items-center justify-center px-4 py-2.5 text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 rounded-xl hover:bg-emerald-100 transition-colors">
                    <i class="fa-solid fa-receipt mr-2"></i> Buka Rincian & Slip Pembayaran
                </a>
            </div>
        </div>

        <!-- Pengumuman Terbaru -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Pengumuman Akademik</h3>
                    <p class="text-xs text-slate-500">Informasi resmi dari pihak sekolah</p>
                </div>
                <a href="/sk/ps" class="text-xs font-bold text-emerald-600 hover:text-emerald-700">
                    Semua Info <i class="fa-solid fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="divide-y divide-slate-100 flex-1">
                <?php
                    $daftar_info = (isset($list_pengumuman) && count($list_pengumuman) > 0) ? $list_pengumuman : collect([
                        (object)['tanggal' => now()->isoFormat('D MMM Y'), 'judul' => 'Monitoring Akademik & Kehadiran Real-Time', 'ringkasan' => 'Orang tua dan siswa kini dapat memantau kehadiran harian, jurnal materi guru, dan nilai rapor secara langsung melalui portal SIAKAD.'],
                        (object)['tanggal' => now()->subDays(3)->isoFormat('D MMM Y'), 'judul' => 'Ketertiban Waktu Masuk Kelas', 'ringkasan' => 'Kegiatan belajar mengajar dimulai tepat waktu sesuai jadwal pelajaran kelas masing-masing.'],
                    ]);
                ?>
                <?php $__currentLoopData = $daftar_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="p-4 flex items-start space-x-3.5 hover:bg-slate-50/80 transition-colors">
                        <div class="w-9 h-9 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i class="fa-solid fa-bullhorn text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <h4 class="text-sm font-bold text-slate-800 truncate"><?php echo e($info->judul); ?></h4>
                                <span class="text-[11px] font-medium text-slate-400 whitespace-nowrap"><?php echo e($info->tanggal); ?></span>
                            </div>
                            <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed"><?php echo e($info->ringkasan); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <?php if($cleanWa): ?>
    <!-- Modal WhatsApp Izin/Sakit ke Wali Kelas -->
    <div id="modalIzinWa" class="fixed inset-0 z-50 hidden bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-5 sm:p-6 shadow-2xl transform transition-all text-left">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100 mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 class="text-sm sm:text-base font-bold text-slate-800">Kirim Surat Izin / Sakit via WhatsApp</h3>
                        <p class="text-xs text-slate-500">Pesan otomatis terformat ke Wali Kelas: <strong><?php echo e($namaWallas); ?></strong></p>
                    </div>
                </div>
                <button type="button" onclick="tutupModalIzinWa()" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-lg hover:bg-slate-100 transition-colors">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div class="space-y-3.5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Alasan Ketidakhadiran:</label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="cursor-pointer border rounded-lg p-2.5 flex items-center gap-2 hover:bg-slate-50 transition-colors border-slate-200" id="labelOptSakit">
                            <input type="radio" name="opt_alasan" value="Sakit" checked onchange="updateWaPreview()" class="peer text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs font-semibold text-slate-700">Sakit</span>
                        </label>
                        <label class="cursor-pointer border rounded-lg p-2.5 flex items-center gap-2 hover:bg-slate-50 transition-colors border-slate-200" id="labelOptIzin">
                            <input type="radio" name="opt_alasan" value="Izin Ada Keperluan Keluarga" onchange="updateWaPreview()" class="peer text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs font-semibold text-slate-700">Keperluan Keluarga</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Rincian / Keterangan Tambahan (Opsional):</label>
                    <input type="text" id="detailKeteranganWa" placeholder="Misal: Demam sejak kemarin / Acara keluarga di luar kota" oninput="updateWaPreview()"
                           class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1">
                        <label class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Pratinjau Pesan yang Akan Dikirim:</label>
                        <span class="text-[10px] text-emerald-600 font-semibold"><i class="fa-solid fa-lock text-[9px] mr-1"></i> Format Resmi Sekolah</span>
                    </div>
                    <textarea id="previewPesanWa" rows="6" readonly class="w-full p-3 text-xs bg-slate-50 rounded-xl border border-slate-200 text-slate-700 font-mono leading-relaxed resize-none focus:outline-none"></textarea>
                </div>
            </div>

            <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="tutupModalIzinWa()" class="px-4 py-2 text-xs font-semibold text-slate-600 hover:bg-slate-100 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="button" onclick="kirimKeWa()" class="px-4 py-2 text-xs font-bold bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors shadow-sm inline-flex items-center gap-1.5">
                    <i class="fa-brands fa-whatsapp text-sm"></i> Buka WhatsApp & Kirim
                </button>
            </div>
        </div>
    </div>

    <script>
        const waConfig = {
            noWa: "<?php echo e($cleanWa); ?>",
            guruNama: "<?php echo e(addslashes($namaWallas)); ?>",
            siswaNama: "<?php echo e(addslashes($namaSiswa)); ?>",
            siswaNis: "<?php echo e(addslashes($nisSiswa)); ?>",
            kelasNama: "<?php echo e(addslashes($ruangKelasNama)); ?>",
            tanggal: "<?php echo e($tanggalHariIni); ?>"
        };

        function bukaModalIzinWa() {
            document.getElementById('modalIzinWa').classList.remove('hidden');
            updateWaPreview();
        }

        function tutupModalIzinWa() {
            document.getElementById('modalIzinWa').classList.add('hidden');
        }

        function updateWaPreview() {
            const radio = document.querySelector('input[name="opt_alasan"]:checked');
            const alasan = radio ? radio.value : 'Sakit';
            const detailInput = document.getElementById('detailKeteranganWa');
            const detail = detailInput && detailInput.value.trim() ? ` (${detailInput.value.trim()})` : '';

            const template = `Assalamu'alaikum Warahmatullahi Wabarakatuh.\n\nYth. Bapak/Ibu ${waConfig.guruNama}\n(Wali Kelas ${waConfig.kelasNama})\n\nSaya selaku orang tua/wali dari peserta didik:\n• Nama: ${waConfig.siswaNama}\n• NIS: ${waConfig.siswaNis}\n• Kelas: ${waConfig.kelasNama}\n\nMemberitahukan bahwa anak kami pada hari ini (${waConfig.tanggal}) berhalangan hadir ke sekolah dikarenakan: *${alasan}*${detail}.\n\nMohon kiranya Bapak/Ibu dapat memaklumi. Atas perhatian, doa, dan bimbingannya kami ucapkan terima kasih.\n\nWassalamu'alaikum Warahmatullahi Wabarakatuh.`;

            const previewArea = document.getElementById('previewPesanWa');
            if (previewArea) {
                previewArea.value = template;
            }
        }

        function kirimKeWa() {
            const previewArea = document.getElementById('previewPesanWa');
            const text = previewArea ? previewArea.value : '';
            if (!waConfig.noWa) {
                alert('Nomor WhatsApp Wali Kelas belum tercatat.');
                return;
            }
            const url = `https://wa.me/${waConfig.noWa}?text=${encodeURIComponent(text)}`;
            window.open(url, '_blank');
            tutupModalIzinWa();
        }
    </script>
    <?php endif; ?>
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\siswa\dashboardSiswa.blade.php ENDPATH**/ ?>
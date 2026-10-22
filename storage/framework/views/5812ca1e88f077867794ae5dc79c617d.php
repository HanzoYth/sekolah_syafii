<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Kelola Pengumuman Akademik','description' => 'Publikasikan pengumuman sekolah dengan target penerima yang fleksibel (semua, per jenjang, per kelas, per peran, atau perorangan).','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kelola Pengumuman Akademik','description' => 'Publikasikan pengumuman sekolah dengan target penerima yang fleksibel (semua, per jenjang, per kelas, per peran, atau perorangan).','position' => 'Administrator','initials' => 'AD']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/das" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Kelola Pengumuman</span>
        </li>
     <?php $__env->endSlot(); ?>

    <!-- Top KPI Stats -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <p class="text-xs font-semibold text-slate-500">Total Pengumuman</p>
            <h4 class="text-xl font-bold text-slate-800 mt-1"><?php echo e($stats['total']); ?></h4>
            <span class="text-[11px] text-slate-400">Semua riwayat</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <p class="text-xs font-semibold text-emerald-600">Semua Civitas</p>
            <h4 class="text-xl font-bold text-emerald-700 mt-1"><?php echo e($stats['semua']); ?></h4>
            <span class="text-[11px] text-slate-400">Publik umum</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <p class="text-xs font-semibold text-blue-600">Per Jenjang</p>
            <h4 class="text-xl font-bold text-blue-700 mt-1"><?php echo e($stats['sekolah']); ?></h4>
            <span class="text-[11px] text-slate-400">TK / SD / SMP / SMA</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <p class="text-xs font-semibold text-violet-600">Per Kelas</p>
            <h4 class="text-xl font-bold text-violet-700 mt-1"><?php echo e($stats['kelas']); ?></h4>
            <span class="text-[11px] text-slate-400">Rombel spesifik</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <p class="text-xs font-semibold text-amber-600">Per Kategori Akun</p>
            <h4 class="text-xl font-bold text-amber-700 mt-1"><?php echo e($stats['role']); ?></h4>
            <span class="text-[11px] text-slate-400">Guru / Siswa saja</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <p class="text-xs font-semibold text-rose-600">Perorangan</p>
            <h4 class="text-xl font-bold text-rose-700 mt-1"><?php echo e($stats['spesifik']); ?></h4>
            <span class="text-[11px] text-slate-400">Akun personal</span>
        </div>
    </div>

    <!-- Main Container -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <!-- Action Header -->
        <div class="px-6 py-4 bg-slate-50/60 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-bullhorn"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Daftar Pengumuman Sekolah</h3>
                    <p class="text-xs text-slate-500">Kelola dan pantau seluruh siaran pengumuman akademik</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <!-- Filter Target -->
                <form action="/sk/kelola-pengumuman" method="GET" class="flex items-center">
                    <select name="target" onchange="this.form.submit()" 
                            class="px-3 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 transition-colors">
                        <option value="semua_filter" <?php echo e(($target_filter ?? '') === 'semua_filter' ? 'selected' : ''); ?>>Semua Filter Target</option>
                        <option value="semua" <?php echo e(($target_filter ?? '') === 'semua' ? 'selected' : ''); ?>>Target: Semua Civitas</option>
                        <option value="sekolah" <?php echo e(($target_filter ?? '') === 'sekolah' ? 'selected' : ''); ?>>Target: Per Jenjang</option>
                        <option value="kelas" <?php echo e(($target_filter ?? '') === 'kelas' ? 'selected' : ''); ?>>Target: Per Kelas</option>
                        <option value="role" <?php echo e(($target_filter ?? '') === 'role' ? 'selected' : ''); ?>>Target: Per Peran Akun</option>
                        <option value="spesifik" <?php echo e(($target_filter ?? '') === 'spesifik' ? 'selected' : ''); ?>>Target: Perorangan (Spesifik)</option>
                    </select>
                </form>

                <button type="button" onclick="openModalPengumuman()" 
                        class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition-all">
                    <i class="fa-solid fa-plus text-xs"></i> Buat Pengumuman Baru
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5 min-w-[120px]">Tanggal</th>
                        <th class="px-5 py-3.5 min-w-[280px]">Judul & Ringkasan</th>
                        <th class="px-5 py-3.5 min-w-[180px]">Target Penerima</th>
                        <th class="px-5 py-3.5 text-center">Lampiran</th>
                        <th class="px-5 py-3.5 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <?php if(count($pengumuman_list) > 0): ?>
                        <?php $__currentLoopData = $pengumuman_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium">
                                    <?php echo e($pengumuman_list->firstItem() + $index); ?>

                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <span class="text-xs font-bold text-slate-700 block">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('D MMM Y')); ?>

                                    </span>
                                    <span class="text-[11px] text-slate-400"><?php echo e(\Carbon\Carbon::parse($item->tanggal)->diffForHumans()); ?></span>
                                </td>
                                <td class="px-5 py-4">
                                    <h4 class="font-bold text-slate-800 text-sm mb-1 leading-snug"><?php echo e($item->judul); ?></h4>
                                    <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->isi), 120)); ?></p>
                                </td>
                                <td class="px-5 py-4">
                                    <?php if($item->target_tipe === 'semua'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <i class="fa-solid fa-earth-americas text-[10px]"></i> Semua Civitas
                                        </span>
                                    <?php elseif($item->target_tipe === 'sekolah'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                            <i class="fa-solid fa-school text-[10px]"></i> Jenjang: <?php echo e(strtoupper($item->sekolah->jenis ?? '-')); ?>

                                        </span>
                                    <?php elseif($item->target_tipe === 'kelas'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-violet-50 text-violet-700 border border-violet-200">
                                            <i class="fa-solid fa-chalkboard-user text-[10px]"></i> Kelas: <?php echo e($item->ruangKelas->nama_ruang ?? '-'); ?>

                                        </span>
                                    <?php elseif($item->target_tipe === 'role'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                            <i class="fa-solid fa-users-gear text-[10px]"></i> <?php echo e($item->target_role === 'g' ? 'Dewan Guru Saja' : 'Siswa / Orang Tua'); ?>

                                        </span>
                                    <?php elseif($item->target_tipe === 'spesifik'): ?>
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                            <i class="fa-solid fa-user-lock text-[10px]"></i>
                                            <?php if($item->siswa): ?>
                                                Siswa: <?php echo e($item->siswa->nama); ?>

                                            <?php elseif($item->guru): ?>
                                                Guru: <?php echo e($item->guru->nama); ?>

                                            <?php else: ?>
                                                Akun Spesifik
                                            <?php endif; ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <?php if($item->lampiran): ?>
                                        <a href="<?php echo e(asset($item->lampiran)); ?>" target="_blank" download
                                           class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors" title="Unduh Berkas Lampiran">
                                            <i class="fa-solid fa-paperclip text-emerald-600"></i> Ada File
                                        </a>
                                    <?php else: ?>
                                        <span class="text-xs text-slate-300">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <button type="button" onclick="previewPengumuman(<?php echo e(json_encode($item)); ?>)" 
                                                class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 flex items-center justify-center transition-colors" title="Lihat Isi">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </button>
                                        <button type="button" 
                                                onclick="bukaModalHapusPengumuman(<?php echo e($item->id); ?>, '<?php echo e(addslashes($item->judul)); ?>')" 
                                                class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center transition-colors" title="Hapus">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-bullhorn text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Belum Ada Pengumuman</h4>
                                <p class="text-xs text-slate-400 mt-1">Gunakan tombol "Buat Pengumuman Baru" untuk menerbitkan siaran akademik pertama Anda.</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($pengumuman_list->hasPages()): ?>
            <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-200 flex justify-center items-center">
                <div class="pagination-container" style="display: flex; justify-content: center; align-items: center; margin: 0 auto;">
                    <?php echo e($pengumuman_list->links()); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- MODAL BUAT PENGUMUMAN BARU -->
    <div id="modalPengumuman" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-2xl my-8 overflow-hidden transform transition-all">
            <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-sm">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h3 class="text-base font-bold text-slate-800">Buat Pengumuman Baru</h3>
                </div>
                <button type="button" onclick="closeModalPengumuman()" class="text-slate-400 hover:text-slate-600 transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <form action="/sk/simpan-pengumuman" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                <?php echo csrf_field(); ?>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Judul Pengumuman <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" name="judul" required placeholder="Contoh: Jadwal Pelaksanaan Asesmen Akhir Semester Ganjil"
                           class="w-full px-3.5 py-2.5 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Tanggal Penerbitan <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" name="tanggal" value="<?php echo e(date('Y-m-d')); ?>" required
                               class="w-full px-3.5 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Target Penerima / Audiens <span class="text-rose-500">*</span>
                        </label>
                        <select id="selectTargetTipe" name="target_tipe" required onchange="handleTargetChange(this.value)"
                                class="w-full px-3.5 py-2 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 font-semibold focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
                            <option value="semua">Semua Civitas Sekolah (Umum)</option>
                            <option value="sekolah">Per Tingkat / Jenjang Sekolah</option>
                            <option value="kelas">Per Rombongan Belajar (Kelas)</option>
                            <option value="role">Per Kategori Akun (Role)</option>
                            <option value="spesifik">Perorangan / Akun Tertentu</option>
                        </select>
                    </div>
                </div>

                <!-- SELECTOR DINAMIS TARGET -->
                <!-- 1. Tingkat Sekolah -->
                <div id="boxTargetSekolah" class="hidden p-4 rounded-xl bg-blue-50/70 border border-blue-200">
                    <label class="block text-xs font-bold text-blue-900 uppercase tracking-wider mb-1.5">
                        <i class="fa-solid fa-school text-blue-600 mr-1"></i> Pilih Jenjang Sekolah:
                    </label>
                    <select name="sekolah_id" class="w-full px-3 py-2 text-sm bg-white border border-blue-200 rounded-lg text-slate-800 font-medium">
                        <option value="">-- Pilih Tingkat Sekolah --</option>
                        <?php $__currentLoopData = $daftar_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e(strtoupper($s->jenis)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- 2. Rombel / Kelas -->
                <div id="boxTargetKelas" class="hidden p-4 rounded-xl bg-violet-50/70 border border-violet-200">
                    <label class="block text-xs font-bold text-violet-900 uppercase tracking-wider mb-1.5">
                        <i class="fa-solid fa-chalkboard-user text-violet-600 mr-1"></i> Pilih Ruang Kelas:
                    </label>
                    <select name="kelas_id" class="w-full px-3 py-2 text-sm bg-white border border-violet-200 rounded-lg text-slate-800 font-medium">
                        <option value="">-- Pilih Kelas --</option>
                        <?php $__currentLoopData = $daftar_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id); ?>">Kelas <?php echo e($k->nama_ruang); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <!-- 3. Kategori Role -->
                <div id="boxTargetRole" class="hidden p-4 rounded-xl bg-amber-50/70 border border-amber-200">
                    <label class="block text-xs font-bold text-amber-900 uppercase tracking-wider mb-2">
                        <i class="fa-solid fa-users-gear text-amber-600 mr-1"></i> Kirimkan Khusus Kepada:
                    </label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-700">
                            <input type="radio" name="target_role" value="g" checked class="text-amber-600 focus:ring-amber-500">
                            <span>Dewan Guru Saja</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-sm font-semibold text-slate-700">
                            <input type="radio" name="target_role" value="s" class="text-amber-600 focus:ring-amber-500">
                            <span>Siswa & Wali Murid Saja</span>
                        </label>
                    </div>
                </div>

                <!-- 4. Spesifik Akun -->
                <div id="boxTargetSpesifik" class="hidden p-4 rounded-xl bg-rose-50/70 border border-rose-200 space-y-3">
                    <label class="block text-xs font-bold text-rose-900 uppercase tracking-wider">
                        <i class="fa-solid fa-user-lock text-rose-600 mr-1"></i> Penerima Akun Tertentu:
                    </label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                            <input type="radio" name="tipe_spesifik" value="siswa" checked onchange="toggleSpesifikDropdown('siswa')">
                            <span>Pilih Akun Siswa</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
                            <input type="radio" name="tipe_spesifik" value="guru" onchange="toggleSpesifikDropdown('guru')">
                            <span>Pilih Akun Guru</span>
                        </label>
                    </div>

                    <div id="selectSiswaWrapper">
                        <select name="siswa_id" class="w-full px-3 py-2 text-xs bg-white border border-rose-200 rounded-lg text-slate-800">
                            <option value="">-- Pilih Nama Siswa --</option>
                            <?php $__currentLoopData = $daftar_siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($sw->id); ?>"><?php echo e($sw->nama); ?> (NIS: <?php echo e($sw->nis ?? '-'); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div id="selectGuruWrapper" class="hidden">
                        <select name="guru_id" class="w-full px-3 py-2 text-xs bg-white border border-rose-200 rounded-lg text-slate-800">
                            <option value="">-- Pilih Nama Guru --</option>
                            <?php $__currentLoopData = $daftar_guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($gr->id); ?>"><?php echo e($gr->nama); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <!-- Isi Pengumuman -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Isi / Narasi Pengumuman <span class="text-rose-500">*</span>
                    </label>
                    <textarea name="isi" rows="5" required placeholder="Tuliskan isi pengumuman lengkap secara jelas..."
                              class="w-full px-3.5 py-2.5 text-sm bg-white border border-slate-200 rounded-xl text-slate-800 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all"></textarea>
                </div>

                <!-- Unggah Lampiran -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        Berkas / Dokumen Lampiran (Opsional)
                    </label>
                    <input type="file" name="lampiran" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                           class="w-full px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl text-slate-700 file:mr-4 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    <p class="text-[11px] text-slate-400 mt-1">Mendukung format PDF, Foto (JPG/PNG), Word (DOCX). Maksimal ukuran berkas 5 MB.</p>
                </div>

                <div class="pt-3 border-t border-slate-200 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeModalPengumuman()" class="px-4 py-2 text-xs font-bold text-slate-600 hover:text-slate-800 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-bold shadow-sm transition-all flex items-center gap-1.5">
                        <i class="fa-solid fa-paper-plane text-xs"></i> Terbitkan Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL PRATINJAU PENGUMUMAN -->
    <div id="modalPreview" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 w-full max-w-lg overflow-hidden">
            <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Detail Pengumuman</span>
                <button type="button" onclick="closeModalPreview()" class="text-slate-400 hover:text-slate-600">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <h3 id="prevJudul" class="text-base font-bold text-slate-800"></h3>
                <div class="flex items-center gap-2 text-xs text-slate-400">
                    <span id="prevTanggal"></span>
                    <span>•</span>
                    <span id="prevPenulis"></span>
                </div>
                <div id="prevIsi" class="text-sm text-slate-700 leading-relaxed max-h-64 overflow-y-auto bg-slate-50 p-4 rounded-xl border border-slate-100"></div>
                <div id="prevLampiranBox" class="hidden pt-2 border-t border-slate-100">
                    <a id="prevLampiranLink" href="#" target="_blank" download class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                        <i class="fa-solid fa-paperclip"></i> Unduh Lampiran
                    </a>
                </div>
            </div>
            <div class="px-6 py-3 bg-slate-50 border-t border-slate-200 flex justify-end">
                <button type="button" onclick="closeModalPreview()" class="px-4 py-1.5 text-xs font-bold text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-100">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL HAPUS PENGUMUMAN -->
    <div id="modalHapusPengumuman" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all text-center">
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Hapus Pengumuman?</h3>
            <p class="text-xs text-slate-500 mb-2 leading-relaxed">
                Anda yakin ingin menghapus pengumuman berikut:
            </p>
            <p id="hapusJudulPengumuman" class="text-sm font-semibold text-slate-800 bg-slate-50 p-3 rounded-xl border border-slate-200 mb-4 break-words"></p>
            <p class="text-xs text-rose-600 mb-6">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> Data dan berkas lampiran yang dihapus tidak dapat dipulihkan kembali.
            </p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="tutupModalHapusPengumuman()" class="w-1/2 py-2.5 px-4 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                    Batal
                </button>
                <a id="btnEksekusiHapusPengumuman" href="#" class="w-1/2 py-2.5 px-4 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-colors inline-flex items-center justify-center gap-1.5 shadow-sm shadow-rose-200">
                    <i class="fa-solid fa-trash-can"></i> Ya, Hapus
                </a>
            </div>
        </div>
    </div>

    <script>
        function bukaModalHapusPengumuman(id, judul) {
            document.getElementById('hapusJudulPengumuman').innerText = `"${judul}"`;
            document.getElementById('btnEksekusiHapusPengumuman').href = '/sk/hapus-pengumuman/' + id;
            document.getElementById('modalHapusPengumuman').classList.remove('hidden');
        }

        function tutupModalHapusPengumuman() {
            document.getElementById('modalHapusPengumuman').classList.add('hidden');
        }

        function openModalPengumuman() {
            document.getElementById('modalPengumuman').classList.remove('hidden');
        }

        function closeModalPengumuman() {
            document.getElementById('modalPengumuman').classList.add('hidden');
        }

        function handleTargetChange(val) {
            document.getElementById('boxTargetSekolah').classList.add('hidden');
            document.getElementById('boxTargetKelas').classList.add('hidden');
            document.getElementById('boxTargetRole').classList.add('hidden');
            document.getElementById('boxTargetSpesifik').classList.add('hidden');

            if (val === 'sekolah') {
                document.getElementById('boxTargetSekolah').classList.remove('hidden');
            } else if (val === 'kelas') {
                document.getElementById('boxTargetKelas').classList.remove('hidden');
            } else if (val === 'role') {
                document.getElementById('boxTargetRole').classList.remove('hidden');
            } else if (val === 'spesifik') {
                document.getElementById('boxTargetSpesifik').classList.remove('hidden');
            }
        }

        function toggleSpesifikDropdown(tipe) {
            if (tipe === 'siswa') {
                document.getElementById('selectSiswaWrapper').classList.remove('hidden');
                document.getElementById('selectGuruWrapper').classList.add('hidden');
            } else {
                document.getElementById('selectSiswaWrapper').classList.add('hidden');
                document.getElementById('selectGuruWrapper').classList.remove('hidden');
            }
        }

        function previewPengumuman(item) {
            document.getElementById('prevJudul').innerText = item.judul || '-';
            document.getElementById('prevTanggal').innerText = item.tanggal || '-';
            document.getElementById('prevPenulis').innerText = 'Diterbitkan oleh ' + (item.penulis || 'Admin');
            document.getElementById('prevIsi').innerText = item.isi || '-';

            const lampiranBox = document.getElementById('prevLampiranBox');
            const lampiranLink = document.getElementById('prevLampiranLink');
            if (item.lampiran) {
                lampiranLink.href = '/' + item.lampiran;
                lampiranBox.classList.remove('hidden');
            } else {
                lampiranBox.classList.add('hidden');
            }

            document.getElementById('modalPreview').classList.remove('hidden');
        }

        function closeModalPreview() {
            document.getElementById('modalPreview').classList.add('hidden');
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

<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views/modul/siakad/admin/kelolaPengumuman.blade.php ENDPATH**/ ?>
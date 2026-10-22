<?php if (isset($component)) { $__componentOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a0c4a580c8c25bcd5a395abd953ea14 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.siakad-layout','data' => ['title' => 'Pembagian Kelas Siswa','description' => 'Atur penempatan dan distribusi peserta didik ke dalam ruang kelas secara terstruktur.','position' => 'Administrator','initials' => 'AD']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('siakad-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pembagian Kelas Siswa','description' => 'Atur penempatan dan distribusi peserta didik ke dalam ruang kelas secara terstruktur.','position' => 'Administrator','initials' => 'AD']); ?>

     <?php $__env->slot('breadcrumb', null, []); ?> 
        <li class="flex items-center">
            <a href="/sk/dashboard" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Pembagian Kelas</span>
        </li>
     <?php $__env->endSlot(); ?>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5 flex-shrink-0"></i>
            <div class="flex-1">
                <p class="font-semibold text-sm">Berhasil!</p>
                <p class="text-sm mt-0.5 text-emerald-700"><?php echo e(session('success')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg mt-0.5 flex-shrink-0"></i>
            <div class="flex-1">
                <p class="font-semibold text-sm">Terjadi Kesalahan</p>
                <p class="text-sm mt-0.5 text-rose-700"><?php echo e(session('error')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if(count($siswa_belum_ada_kelas) > 0): ?>
        <!-- Alert Banner Siswa Belum Ada Kelas -->
        <div class="mb-6 p-4 sm:p-5 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm">
            <div class="flex items-start gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center text-lg flex-shrink-0 mt-0.5">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-amber-800">
                        Terdapat <?php echo e(count($siswa_belum_ada_kelas)); ?> Peserta Didik Belum Memiliki Ruang Kelas
                    </h3>
                    <p class="text-xs text-amber-700 mt-0.5">
                        Pilih ruang kelas tujuan pada formulir di bawah ini untuk mendistribusikan siswa baru ke dalam rombel.
                    </p>
                </div>
            </div>
            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-amber-300 text-xs font-bold text-amber-800 shadow-sm self-start sm:self-auto">
                <i class="fa-solid fa-user-clock text-amber-600"></i> <?php echo e(count($siswa_belum_ada_kelas)); ?> Menunggu Penempatan
            </div>
        </div>
    <?php endif; ?>

    <!-- Card Filter & Pemilihan Kelas -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800">Pembagian Ruang Kelas Siswa</h2>
                    <p class="text-xs sm:text-sm text-slate-500">Pilih jenjang dan ruang kelas tujuan untuk mengelola daftar anggotanya.</p>
                </div>
            </div>
            <?php if($kelas_id || $sekolah_id): ?>
                <a href="/sk/pembagian-kelas" class="inline-flex items-center text-xs font-semibold text-slate-500 hover:text-rose-600 transition-colors self-start sm:self-auto">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset Filter
                </a>
            <?php endif; ?>
        </div>

        <form method="GET" action="/sk/pembagian-kelas" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
            <!-- Filter Jenjang / Satuan Pendidikan -->
            <div class="sm:col-span-5">
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Filter Jenjang Sekolah</label>
                <div class="relative">
                    <i class="fa-solid fa-school absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <select name="sekolah_id" onchange="this.form.submit()" class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors">
                        <option value="">Semua Jenjang</option>
                        <?php $__currentLoopData = $data_sekolah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>" <?php echo e(($sekolah_id ?? '') == $s->id ? 'selected' : ''); ?>>
                                Jenjang <?php echo e(strtoupper($s->jenis)); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <!-- Pilih Ruang Kelas -->
            <div class="sm:col-span-5">
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pilih Ruang Kelas <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <i class="fa-solid fa-chalkboard absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <select name="kelas_id" required class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors">
                        <option value="">-- Pilih Ruang Kelas --</option>
                        <?php $__currentLoopData = $data_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($k->id); ?>" <?php echo e($kelas_id == $k->id ? 'selected' : ''); ?>>
                                <?php echo e($k->nama_ruang); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <!-- Tombol Tampilkan -->
            <div class="sm:col-span-2">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-semibold transition-colors shadow-sm">
                    <i class="fa-solid fa-filter text-xs"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    <?php if($kelas_id && $kelas_terpilih): ?>
        <!-- Ringkasan KPI Status Kelas -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Kelas Terpilih</p>
                    <h3 class="text-base sm:text-lg font-bold text-slate-800 break-words leading-snug mt-0.5"><?php echo e($kelas_terpilih->nama_ruang); ?></h3>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">Ruang rombel tujuan</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Anggota Saat Ini</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate"><?php echo e(count($siswa_di_kelas)); ?></h3>
                    <p class="text-xs text-emerald-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Siswa aktif terdaftar</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Belum Ada Kelas</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate"><?php echo e(count($siswa_belum_ada_kelas)); ?></h3>
                    <p class="text-xs text-amber-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-clock text-[10px] mr-1"></i>Tersedia untuk dimasukkan</p>
                </div>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TABEL 1 (VERTIKAL - ATAS): ANGGOTA KELAS SAAT INI        -->
        <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base flex-shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-bold text-slate-800">1. Anggota Kelas Saat Ini: <?php echo e($kelas_terpilih->nama_ruang); ?></h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                <?php echo e(count($siswa_di_kelas)); ?> Siswa
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar seluruh siswa yang telah terdaftar resmi di kelas ini.</p>
                    </div>
                </div>

                <!-- Input Pencarian Anggota Kelas -->
                <?php if(count($siswa_di_kelas) > 0): ?>
                    <div class="relative w-full md:w-64">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" id="searchAnggotaInput" onkeyup="filterTable('searchAnggotaInput', 'tableAnggotaKelas')" placeholder="Cari nama / NIS siswa..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-500 shadow-sm">
                    </div>
                <?php endif; ?>
            </div>

            <div class="overflow-x-auto">
                <table id="tableAnggotaKelas" class="w-full text-left border-collapse min-w-[650px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5 text-center w-16">No</th>
                            <th class="px-5 py-3.5 w-32">NIS</th>
                            <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                            <th class="px-5 py-3.5 w-32">Jenis Kelamin</th>
                            <th class="px-5 py-3.5 w-32">Jenjang</th>
                            <th class="px-5 py-3.5 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php if(count($siswa_di_kelas) > 0): ?>
                            <?php $__currentLoopData = $siswa_di_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-3.5 text-center text-slate-500 font-medium text-xs"><?php echo e($index + 1); ?></td>
                                    <td class="px-5 py-3.5 font-mono text-xs font-semibold text-slate-600"><?php echo e($s->nis ?? '-'); ?></td>
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                <?php echo e(substr($s->nama, 0, 2)); ?>

                                            </div>
                                            <div>
                                                <span class="font-semibold text-slate-800 block"><?php echo e($s->nama); ?></span>
                                                <span class="text-[11px] text-slate-400">ID: #<?php echo e($s->id); ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <?php if(strtolower($s->gender) == 'l'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                <i class="fa-solid fa-mars text-[10px] mr-1"></i> Laki-laki
                                            </span>
                                        <?php elseif(strtolower($s->gender) == 'p'): ?>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                                <i class="fa-solid fa-venus text-[10px] mr-1"></i> Perempuan
                                            </span>
                                        <?php else: ?>
                                            <span class="text-xs text-slate-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            <?php echo e(strtoupper($s->sekolah->jenis ?? '-')); ?>

                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <button type="button" 
                                           onclick="bukaModalKeluarkanSiswa(<?php echo e($s->id); ?>, '<?php echo e(addslashes($s->nama)); ?>', '<?php echo e(addslashes($kelas_terpilih->nama_ruang)); ?>')" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold transition-colors cursor-pointer"
                                           title="Keluarkan dari rombel ini">
                                            <i class="fa-solid fa-user-minus text-[11px]"></i> Keluarkan
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <tr class="empty-row">
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-users-slash text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-semibold text-slate-700">Kelas Ini Masih Kosong</h4>
                                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Belum ada siswa yang ditempatkan di kelas <?php echo e($kelas_terpilih->nama_ruang); ?>. Pilih dan masukkan siswa dari daftar di bawah.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- ======================================================== -->
        <!-- TABEL 2 (VERTIKAL - BAWAH): TAMBAH SISWA KE KELAS        -->
        <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <form action="/sk/simpan-pembagian-kelas" method="POST" id="formTambahSiswa">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="kelas_id" value="<?php echo e($kelas_id); ?>">

                <!-- Header Panel Tambah Siswa -->
                <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 bg-amber-50/40 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-base flex-shrink-0">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-base font-bold text-slate-800">2. Tambahkan Siswa ke Kelas Ini</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                    <?php echo e(count($siswa_belum_ada_kelas)); ?> Siswa Tersedia
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mt-0.5">Pilih siswa yang belum memiliki kelas di bawah ini untuk dimasukkan ke rombel <strong><?php echo e($kelas_terpilih->nama_ruang); ?></strong>.</p>
                        </div>
                    </div>

                    <!-- Tombol Submit Atas -->
                    <?php if(count($siswa_belum_ada_kelas) > 0): ?>
                        <div class="flex items-center gap-2 self-end md:self-center">
                            <button type="submit" id="btnSubmitTop" disabled class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed text-white text-xs font-bold transition-all shadow-sm">
                                <i class="fa-solid fa-arrow-down-to-bracket text-xs"></i> Masukkan Siswa Terpilih
                            </button>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Action Toolbar: Check All & Live Search -->
                <?php if(count($siswa_belum_ada_kelas) > 0): ?>
                    <div class="p-3.5 sm:p-4 bg-slate-50 border-b border-slate-200 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700 bg-white px-3 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors select-none">
                                <input type="checkbox" id="checkAllMaster" onchange="toggleSelectAll(this)" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                                <span>Pilih Semua</span>
                            </label>

                            <span id="selectedCountBadge" class="text-xs font-semibold text-slate-600 bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                                0 siswa dipilih
                            </span>
                        </div>

                        <!-- Live Search Input -->
                        <div class="relative w-full sm:w-64">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="searchBelumAdaInput" onkeyup="filterTable('searchBelumAdaInput', 'tableBelumAdaKelas')" placeholder="Filter siswa belum ada kelas..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-500 shadow-sm">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Tabel Siswa Belum Ada Kelas -->
                <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
                    <table id="tableBelumAdaKelas" class="w-full text-left border-collapse min-w-[650px]">
                        <thead class="sticky top-0 z-10 bg-slate-100 shadow-sm">
                            <tr class="border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                                <th class="px-5 py-3.5 text-center w-14">Pilih</th>
                                <th class="px-5 py-3.5 text-center w-14">No</th>
                                <th class="px-5 py-3.5 w-32">NIS</th>
                                <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                                <th class="px-5 py-3.5 w-32">Jenis Kelamin</th>
                                <th class="px-5 py-3.5 w-32">Asal Jenjang</th>
                                <th class="px-5 py-3.5 text-center w-36">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            <?php if(count($siswa_belum_ada_kelas) > 0): ?>
                                <?php $__currentLoopData = $siswa_belum_ada_kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr onclick="toggleRowCheckbox(event, this)" class="hover:bg-amber-50/40 transition-colors cursor-pointer select-none">
                                        <td class="px-5 py-3.5 text-center">
                                            <input type="checkbox" name="siswa_ids[]" value="<?php echo e($s->id); ?>" onchange="updateSelectedCount()" class="siswa-checkbox w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                                        </td>
                                        <td class="px-5 py-3.5 text-center text-slate-500 font-medium text-xs"><?php echo e($index + 1); ?></td>
                                        <td class="px-5 py-3.5 font-mono text-xs font-semibold text-slate-600"><?php echo e($s->nis ?? '-'); ?></td>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                    <?php echo e(substr($s->nama, 0, 2)); ?>

                                                </div>
                                                <div>
                                                    <strong class="text-slate-800 block font-semibold"><?php echo e($s->nama); ?></strong>
                                                    <span class="text-[11px] text-slate-400">ID: #<?php echo e($s->id); ?></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <?php if(strtolower($s->gender) == 'l'): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                    <i class="fa-solid fa-mars text-[10px] mr-1"></i> Laki-laki
                                                </span>
                                            <?php elseif(strtolower($s->gender) == 'p'): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                                    <i class="fa-solid fa-venus text-[10px] mr-1"></i> Perempuan
                                                </span>
                                            <?php else: ?>
                                                <span class="text-xs text-slate-400">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                                <?php echo e(strtoupper($s->sekolah->jenis ?? '-')); ?>

                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-clock text-[10px] mr-1"></i> Belum Ada Kelas
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr class="empty-row">
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-2xl">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <h4 class="text-sm font-semibold text-slate-800">Semua Siswa Sudah Masuk Kelas</h4>
                                        <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Tidak ada peserta didik pada filter jenjang ini yang belum memiliki ruang kelas.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Action Panel Bawah -->
                <?php if(count($siswa_belum_ada_kelas) > 0): ?>
                    <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="text-xs text-slate-500">
                            <span id="bottomSelectedCount" class="font-bold text-emerald-700">0 siswa dipilih</span> untuk dimasukkan ke rombel <strong><?php echo e($kelas_terpilih->nama_ruang); ?></strong>.
                        </div>
                        <button type="submit" id="btnSubmitBottom" disabled class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed text-white text-xs font-bold transition-all shadow-sm">
                            <i class="fa-solid fa-arrow-down-to-bracket text-xs"></i> Masukkan Siswa Terpilih ke Kelas
                        </button>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    <?php else: ?>
        <!-- State Awal: Belum Memilih Kelas -->
        <?php if(count($siswa_belum_ada_kelas) > 0): ?>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
                <div class="p-5 sm:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <i class="fa-solid fa-user-clock text-amber-600"></i>
                            Daftar Siswa Belum Memiliki Ruang Kelas (<?php echo e(count($siswa_belum_ada_kelas)); ?> Siswa)
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Siswa di bawah ini perlu dimasukkan ke dalam rombel. Pilih nama ruang kelas pada form di atas untuk mulai memasukkan siswa.
                        </p>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 self-start sm:self-auto">
                        <i class="fa-solid fa-triangle-exclamation"></i> Menunggu Penempatan
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-xs">
                        <thead>
                            <tr class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                                <th class="py-3 px-4 w-12 text-center">No</th>
                                <th class="py-3 px-4">Nama Siswa</th>
                                <th class="py-3 px-4">NIS</th>
                                <th class="py-3 px-4">Jenis Kelamin</th>
                                <th class="py-3 px-4">Jenjang</th>
                                <th class="py-3 px-4 text-center">Status Rombel</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <?php $__currentLoopData = $siswa_belum_ada_kelas->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="py-2.5 px-4 text-center text-slate-400 font-mono"><?php echo e($idx + 1); ?></td>
                                    <td class="py-2.5 px-4 font-bold text-slate-800"><?php echo e($s->nama); ?></td>
                                    <td class="py-2.5 px-4 font-mono text-slate-600"><?php echo e($s->nis ?? '-'); ?></td>
                                    <td class="py-2.5 px-4">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold <?php echo e(($s->gender ?? '') === 'p' ? 'bg-pink-50 text-pink-700' : 'bg-blue-50 text-blue-700'); ?>">
                                            <?php echo e(($s->gender ?? '') === 'p' ? 'Perempuan' : 'Laki-laki'); ?>

                                        </span>
                                    </td>
                                    <td class="py-2.5 px-4 text-slate-600"><?php echo e($s->sekolah->jenis ?? '-'); ?></td>
                                    <td class="py-2.5 px-4 text-center">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                            <i class="fa-solid fa-clock"></i> Belum Masuk Kelas
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($siswa_belum_ada_kelas) > 10): ?>
                                <tr>
                                    <td colspan="6" class="py-3 px-4 text-center text-slate-500 bg-slate-50/50 italic">
                                        ...dan <?php echo e(count($siswa_belum_ada_kelas) - 10); ?> siswa lainnya. Silakan pilih ruang kelas di form atas untuk membagi siswa ke dalam rombel.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center text-slate-500">
                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                    <i class="fa-solid fa-chalkboard-user text-2xl"></i>
                </div>
                <h4 class="text-base font-semibold text-slate-800">Silakan Pilih Ruang Kelas Terlebih Dahulu</h4>
                <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">
                    Pilih jenjang sekolah dan nama ruang kelas melalui form filter di atas untuk melihat daftar anggota kelas serta menambahkan siswa baru ke dalamnya.
                </p>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- MODAL KONFIRMASI KELUARKAN SISWA DARI KELAS -->
    <div id="modalKeluarkanSiswa" class="fixed inset-0 z-50 hidden bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all text-center">
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa-solid fa-user-minus"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Keluarkan Siswa dari Rombel?</h3>
            <p class="text-xs text-slate-500 mb-3 leading-relaxed">
                Apakah Anda yakin ingin mengeluarkan siswa berikut dari kelas <strong id="keluarkanNamaKelas" class="text-slate-700"></strong>?
            </p>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 mb-4 text-left">
                <span class="text-[11px] font-semibold text-slate-400 block uppercase tracking-wider">Nama Siswa</span>
                <strong id="keluarkanNamaSiswa" class="text-sm text-slate-800"></strong>
            </div>
            <p class="text-[11px] text-amber-700 mb-6 bg-amber-50 p-2.5 rounded-lg border border-amber-200 leading-normal">
                <i class="fa-solid fa-triangle-exclamation mr-1"></i> Siswa akan berstatus <strong>belum memiliki kelas</strong> dan dapat dialokasikan kembali ke kelas lainnya nanti.
            </p>
            <div class="flex items-center justify-center gap-3">
                <button type="button" onclick="tutupModalKeluarkanSiswa()" class="w-1/2 py-2.5 px-4 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                    Batal
                </button>
                <a id="btnEksekusiKeluarkanSiswa" href="#" class="w-1/2 py-2.5 px-4 text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 rounded-xl transition-colors inline-flex items-center justify-center gap-1.5 shadow-sm shadow-rose-200">
                    <i class="fa-solid fa-user-minus"></i> Ya, Keluarkan
                </a>
            </div>
        </div>
    </div>

    <script>
        function bukaModalKeluarkanSiswa(id, nama, namaKelas) {
            document.getElementById('keluarkanNamaSiswa').innerText = nama;
            document.getElementById('keluarkanNamaKelas').innerText = namaKelas;
            document.getElementById('btnEksekusiKeluarkanSiswa').href = '/sk/hapus-anggota-kelas/' + id;
            document.getElementById('modalKeluarkanSiswa').classList.remove('hidden');
        }

        function tutupModalKeluarkanSiswa() {
            document.getElementById('modalKeluarkanSiswa').classList.add('hidden');
        }

        // Check All toggle
        function toggleSelectAll(master) {
            const checkboxes = document.querySelectorAll('.siswa-checkbox');
            checkboxes.forEach(cb => {
                const row = cb.closest('tr');
                if (row && row.style.display !== 'none') {
                    cb.checked = master.checked;
                }
            });
            updateSelectedCount();
        }

        // Live selection counter and button enable/disable
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.siswa-checkbox:checked');
            const count = checkboxes.length;
            const badge = document.getElementById('selectedCountBadge');
            const btnTop = document.getElementById('btnSubmitTop');
            const btnBottom = document.getElementById('btnSubmitBottom');
            const bottomCount = document.getElementById('bottomSelectedCount');

            if (badge) badge.innerText = `${count} siswa dipilih`;
            if (bottomCount) bottomCount.innerText = `${count} siswa dipilih`;

            if (btnTop) btnTop.disabled = (count === 0);
            if (btnBottom) btnBottom.disabled = (count === 0);

            // Update master checkbox state
            const allCheckboxes = document.querySelectorAll('.siswa-checkbox');
            const master = document.getElementById('checkAllMaster');
            if (master && allCheckboxes.length > 0) {
                master.checked = (count === allCheckboxes.length);
            }
        }

        // Click row to toggle checkbox
        function toggleRowCheckbox(event, row) {
            if (event.target.tagName === 'INPUT' || event.target.tagName === 'A' || event.target.tagName === 'BUTTON' || event.target.closest('a')) {
                return;
            }
            const cb = row.querySelector('.siswa-checkbox');
            if (cb) {
                cb.checked = !cb.checked;
                updateSelectedCount();
            }
        }

        // Real-time table filter
        function filterTable(inputId, tableId) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const filter = input.value.toLowerCase().trim();
            const table = document.getElementById(tableId);
            if (!table) return;
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                if (row.classList.contains('empty-row')) continue;
                const text = row.innerText.toLowerCase();
                const show = (text.indexOf(filter) > -1);
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
            }
            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
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
<?php /**PATH D:\laragon\www\sekolahsyafii\resources\views\modul\siakad\admin\pembagianKelas.blade.php ENDPATH**/ ?>
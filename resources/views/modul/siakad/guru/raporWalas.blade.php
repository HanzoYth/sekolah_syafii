@php
    $isAdmin = session('role') === 'a';
    $initialAdminTab = ($isAdmin && in_array(request('tab'), ['pengesahan', 'kegiatan', 'template_prestasi']))
        ? request('tab')
        : 'kelas';
@endphp

<x-siakad-layout 
    title="{{ $isAdmin ? 'Manajemen Rapor Siswa' : 'Cetak & Evaluasi Rapor Santri' }}" 
    description="{{ $isAdmin ? 'Pusat manajemen rapor siswa, tanda tangan wali kelas, pengesahan kepala sekolah, program kegiatan, dan template prestasi.' : 'Kelola rekap nilai, catatan wali kelas, prestasi, dan cetak dokumen rapor santri.' }}" 
    position="{{ $isAdmin ? 'Administrator SIAKAD' : 'Guru Wali Kelas' }}" 
    initials="{{ $isAdmin ? 'AD' : 'GR' }}">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="{{ $isAdmin ? '/sk/ds' : '/sk/dsg' }}" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">{{ $isAdmin ? 'Rapor Siswa' : 'Cetak Rapor' }}</span>
        </li>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-emerald-900">Berhasil Disimpan</h5>
                    <p class="text-xs text-emerald-700 mt-0.5">{{ session('success') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800 text-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-rose-500 text-white flex items-center justify-center font-bold text-sm">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div>
                    <h5 class="text-xs font-bold uppercase tracking-wider text-rose-900">Terjadi Kesalahan</h5>
                    <p class="text-xs text-rose-700 mt-0.5">{{ session('error') }}</p>
                </div>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-800 text-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm">
            <div class="flex items-center gap-2 font-bold text-xs uppercase tracking-wider text-rose-900 mb-1">
                <i class="fa-solid fa-triangle-exclamation text-rose-600"></i> Validasi Gagal
            </div>
            <ul class="list-disc pl-5 text-xs text-rose-700 space-y-0.5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($isAdmin)
        <!-- Navigasi Pusat Rapor Admin (Pemisahan Jelas: Per Kelas vs Global Sekolah) -->
        <div class="bg-white rounded-2xl border border-slate-200 p-4 mb-6 shadow-xs flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500 px-1.5 flex items-center gap-1 whitespace-nowrap">
                    <i class="fa-solid fa-chalkboard-user text-emerald-700"></i> Per Kelas:
                </span>
                <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1">
                    <button type="button" id="adminTabBtn-kelas" onclick="switchAdminRaporTab('kelas')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-all cursor-pointer whitespace-nowrap {{ $initialAdminTab === 'kelas' ? 'bg-emerald-700 text-white shadow-xs' : 'text-slate-600 hover:text-emerald-800 hover:bg-white/80' }}">
                        <i class="fa-solid fa-file-contract"></i> Rapor &amp; TTD
                    </button>
                    <a href="/sk/rapor-walas?tab=nilai&kelas_id={{ $wallas->kelas_id ?? '' }}" class="px-3.5 py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-emerald-800 hover:bg-white/80 flex items-center gap-1.5 transition-all whitespace-nowrap">
                        <i class="fa-solid fa-sliders"></i> Leger Nilai
                    </a>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-700 px-1.5 flex items-center gap-1 whitespace-nowrap">
                    <i class="fa-solid fa-globe"></i> Global:
                </span>
                <div class="inline-flex flex-wrap p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1">
                    <button type="button" id="adminTabBtn-pengesahan" onclick="switchAdminRaporTab('pengesahan')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-all cursor-pointer whitespace-nowrap {{ $initialAdminTab === 'pengesahan' ? 'bg-emerald-700 text-white shadow-xs' : 'text-slate-600 hover:text-emerald-800 hover:bg-white/80' }}">
                        <i class="fa-solid fa-file-signature"></i> Pengesahan
                    </button>
                    <button type="button" id="adminTabBtn-kegiatan" onclick="switchAdminRaporTab('kegiatan')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-all cursor-pointer whitespace-nowrap {{ $initialAdminTab === 'kegiatan' ? 'bg-emerald-700 text-white shadow-xs' : 'text-slate-600 hover:text-emerald-800 hover:bg-white/80' }}">
                        <i class="fa-solid fa-mosque"></i> Kegiatan
                    </button>
                    <button type="button" id="adminTabBtn-template_prestasi" onclick="switchAdminRaporTab('template_prestasi')" class="admin-rapor-tab-btn px-3.5 py-2 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-all cursor-pointer whitespace-nowrap {{ $initialAdminTab === 'template_prestasi' ? 'bg-emerald-700 text-white shadow-xs' : 'text-slate-600 hover:text-emerald-800 hover:bg-white/80' }}">
                        <i class="fa-solid fa-trophy"></i> Prestasi
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Admin Switcher Kelas (Hanya untuk Admin & Mode Per Kelas) -->
    @if($isAdmin && isset($daftar_semua_kelas) && $daftar_semua_kelas->isNotEmpty())
        <div id="adminClassSwitcherWrapper" class="{{ $initialAdminTab === 'kelas' ? '' : 'hidden' }} bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-700 text-white rounded-2xl p-5 mb-6 shadow-sm border border-emerald-700/80 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-300/30 text-emerald-100 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white flex items-center gap-2">
                        Mode Administrator Rapor
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-950/40 text-emerald-100 border border-emerald-400/30">Per Kelas</span>
                    </h4>
                    <p class="text-xs text-emerald-100/90 mt-0.5">Pilih rombongan belajar untuk mengelola catatan, prestasi, TTD Wali Kelas, dan cetak rapor siswa.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <label for="selectKelasAdmin" class="text-xs text-emerald-100 font-medium whitespace-nowrap">Pilih Kelas:</label>
                <select id="selectKelasAdmin" onchange="location.href='/sk/rapor-walas?kelas_id=' + this.value" class="text-xs bg-emerald-950/60 border border-emerald-400/40 text-white rounded-xl px-3.5 py-2 focus:ring-emerald-400 focus:border-emerald-400 font-semibold shadow-inner">
                    @foreach($daftar_semua_kelas as $rk)
                        <option value="{{ $rk->id }}" {{ ($wallas->kelas_id ?? null) == $rk->id ? 'selected' : '' }}>
                            {{ $rk->nama_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <div id="adminRaporPane-kelas" class="admin-rapor-pane {{ $initialAdminTab === 'kelas' ? '' : 'hidden' }}">
    <!-- Tab Switcher: Manajemen Nilai vs Cetak Rapor -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        @if(!$isAdmin)
            <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200">
                <a href="/sk/rapor-walas?tab=nilai" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all whitespace-nowrap">
                    <i class="fa-solid fa-sliders"></i> Leger Nilai
                </a>
                <a href="/sk/rapor-walas" class="px-4 py-2 rounded-lg text-xs font-bold bg-emerald-700 text-white shadow-sm flex items-center gap-2 transition-all whitespace-nowrap">
                    <i class="fa-solid fa-file-contract"></i> Cetak Rapor
                </a>
            </div>
        @else
            <div class="flex items-center gap-2 text-xs text-slate-500 font-medium">
                <i class="fa-solid fa-chalkboard text-emerald-600"></i>
                <span>Kelas Aktif: <strong class="text-slate-800">{{ $wallas->ruangKelas->nama_ruang ?? '-' }}</strong></span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-50 text-emerald-700 border border-emerald-200">Jenjang {{ strtoupper($kelas_jenjang ?? 'smp') }}</span>
            </div>
        @endif

        <div class="flex items-center gap-2">
            <a href="/sk/rapor-walas?print=massal{{ $isAdmin ? '&kelas_id='.($wallas->kelas_id ?? '') : '' }}" target="_blank" class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-sm gap-2 whitespace-nowrap">
                <i class="fa-solid fa-print"></i> Cetak Massal
            </a>
            @if(!$isAdmin)
                <a href="/sk/rapor-walas?tab=nilai" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-colors whitespace-nowrap">
                    <i class="fa-solid fa-sliders mr-1.5"></i> Leger Nilai
                </a>
            @endif
        </div>
    </div>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-violet-50 text-violet-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-school text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Kelas Binaan</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 break-words leading-snug mt-0.5">{{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}</h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Wali: {{ $wallas->guru->nama ?? 'Belum Ditentukan' }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-file-circle-check text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Total Siswa Terdaftar</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ count($siswa) }}</h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Berkas rapor siswa siap cetak</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0 sm:col-span-2 lg:col-span-1">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-print text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Progres Nilai Mapel</p>
                <h3 class="text-xl font-bold text-slate-800 mt-0.5 truncate">{{ $stats_nilai['mapel_sudah_input'] ?? 0 }} / {{ $stats_nilai['total_mapel'] ?? 0 }} Mapel</h3>
                <p class="text-xs text-emerald-600 font-medium mt-1 truncate"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Rata-rata Kelas: {{ number_format($stats_nilai['rata_kelas'] ?? 0, 1) }}</p>
            </div>
        </div>
    </div>


    <!-- Banner Info Program Kegiatan Sekolah Yang Dinilai Pada Rapor -->
    @if(isset($daftar_kegiatan_sekolah) && $daftar_kegiatan_sekolah->isNotEmpty())
        <div class="mb-8 bg-white border border-slate-200 rounded-2xl p-4 sm:p-5 shadow-xs">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-800">Master Program Kegiatan Sekolah (Rapor)</h4>
                        <p class="text-[11px] text-slate-500">Daftar kegiatan resmi dari Admin yang dinilai pada lembar rapor santri. Klik <strong>Detail Rapor</strong> santri untuk mengevaluasi predikat &amp; narasinya.</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200/60 w-fit">
                    <i class="fa-solid fa-list-check mr-1.5"></i> {{ $daftar_kegiatan_sekolah->count() }} Kegiatan Aktif
                </span>
            </div>
            <div class="flex flex-wrap gap-2 pt-3 border-t border-slate-100">
                @foreach($daftar_kegiatan_sekolah as $dkeg)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <strong class="text-slate-800">{{ $dkeg->nama_kegiatan }}</strong>
                        @if($dkeg->jenjang !== 'semua')
                            <span class="text-[10px] uppercase font-bold text-emerald-700 bg-emerald-50 px-1.5 py-0.5 rounded border border-emerald-200">{{ $dkeg->jenjang }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    <!-- ======================================================== -->
    <!-- PENGESAHAN TANDA TANGAN DIGITAL RAPOR (LEVEL KELAS)      -->
    <!-- ======================================================== -->
    @php
        $hasWallasRecord = isset($wallas->id);
        $currentTtdWalas = $wallas->ttd_walas ?? null;
        $currentTtdKepsek = $pengaturan_rapor->ttd_kepsek ?? null;
    @endphp
    <div class="mb-8 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 shadow-xs">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-4 pb-3 border-b border-slate-100">
            <div class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-center text-sm flex-shrink-0">
                    <i class="fa-solid fa-signature"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-slate-800">Pengesahan Tanda Tangan Rapor — {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}</h4>
                    <p class="text-[11px] text-slate-500">Unggah TTD Wali Kelas sekali di sini — otomatis tampil di seluruh rapor siswa, Cetak Massal, dan akun Santri.</p>
                </div>
            </div>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 w-fit flex-shrink-0">
                <i class="fa-solid fa-wand-magic-sparkles text-amber-500 text-[10px]"></i> Auto-Hapus Background Aktif
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Kolom Kiri: Upload TTD Wali Kelas (Per Kelas) -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-bold text-slate-700">Tanda Tangan Wali Kelas</label>
                        <span id="walasCardStatusTtd" class="text-[10px] font-semibold px-2 py-0.5 rounded {{ !empty($currentTtdWalas) ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                            {{ !empty($currentTtdWalas) ? 'Aktif (Tersimpan)' : 'Belum diunggah' }}
                        </span>
                    </div>
                    <p class="text-[11px] text-slate-500 mb-2.5 truncate">Wali Kelas: <strong class="text-slate-700">{{ $wallas->guru->nama ?? 'Belum Ditugaskan' }}</strong></p>

                    <div class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                        <img id="walasCardThumbTtd" src="{{ $currentTtdWalas ?? '' }}" alt="TTD Wali Kelas" class="max-h-20 max-w-full object-contain {{ !empty($currentTtdWalas) ? '' : 'hidden' }}" style="mix-blend-mode: multiply;" />
                        <div id="walasCardPlaceholderTtd" class="text-center text-slate-400 {{ !empty($currentTtdWalas) ? 'hidden' : '' }}">
                            <i class="fa-solid fa-file-signature text-2xl mb-1 text-slate-300 block"></i>
                            <span class="text-[11px]">Belum ada tanda tangan</span>
                        </div>
                    </div>
                </div>

                @if($hasWallasRecord)
                    <div>
                        <div class="flex items-center gap-2">
                            <input type="file" id="walasCardFileTtd" accept="image/*" class="hidden" onchange="handleClassWalasSignatureUpload(this)">
                            <button type="button" onclick="document.getElementById('walasCardFileTtd').click()" class="flex-1 px-3 py-2 bg-emerald-700 hover:bg-emerald-800 text-white rounded-lg text-xs font-bold flex items-center justify-center gap-1.5 transition-colors cursor-pointer shadow-xs whitespace-nowrap">
                                <i class="fa-solid fa-arrow-up-from-bracket text-[11px]"></i> Upload TTD Wali Kelas
                            </button>
                            <button type="button" id="walasCardBtnHapus" onclick="removeClassWalasSignature()" class="px-3 py-2 bg-slate-200 hover:bg-rose-100 hover:text-rose-700 text-slate-600 rounded-lg text-xs font-semibold transition-colors cursor-pointer {{ !empty($currentTtdWalas) ? '' : 'hidden' }}" title="Hapus tanda tangan wali kelas">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                        <p id="walasCardSyncMsg" class="text-[11px] text-slate-400 mt-2 hidden"></p>
                    </div>
                @else
                    <div class="p-2.5 rounded-lg bg-amber-50 border border-amber-200 text-[11px] text-amber-800 flex items-center justify-between gap-2">
                        <span>Tugaskan Wali Kelas terlebih dahulu untuk mengunggah TTD kelas ini.</span>
                        <a href="/sk/kelola-wali-kelas" class="font-bold underline whitespace-nowrap">Atur Walas</a>
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Preview TTD Kepala Sekolah (Read-Only dari Admin) -->
            <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/70 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-bold text-slate-700">Tanda Tangan Kepala Sekolah</label>
                        @if(!empty($currentTtdKepsek))
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800">Aktif dari Admin</span>
                        @else
                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600">Belum Diunggah Admin</span>
                        @endif
                    </div>
                    <p class="text-[11px] text-slate-500 mb-2.5 truncate">Kepala Sekolah ({{ strtoupper($kelas_jenjang ?? 'smp') }}): <strong class="text-slate-700">{{ $pengaturan_rapor->nama_kepsek ?? 'Rajihul Haq, S.Sos' }}</strong></p>

                    <div class="h-24 rounded-lg border-2 border-dashed border-slate-300 bg-white flex items-center justify-center relative overflow-hidden mb-3">
                        @if(!empty($currentTtdKepsek))
                            <img src="{{ $currentTtdKepsek }}" alt="TTD Kepala Sekolah" class="max-h-20 max-w-full object-contain" style="mix-blend-mode: multiply;" />
                        @else
                            <div class="text-center text-slate-400">
                                <i class="fa-solid fa-stamp text-2xl mb-1 text-slate-300 block"></i>
                                <span class="text-[11px]">Menunggu TTD Kepala Sekolah dari Admin</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-between text-[11px] text-slate-500 pt-1">
                    @if(session('role') === 'a')
                        <span>Dikelola per jenjang pada tab Pengesahan Rapor.</span>
                        <button type="button" onclick="if (typeof selectAdminPengesahanJenjang === 'function') { selectAdminPengesahanJenjang('{{ $kelas_jenjang ?? 'tk' }}', false); } switchAdminRaporTab('pengesahan')" class="text-emerald-700 hover:text-emerald-800 font-bold whitespace-nowrap ml-2 cursor-pointer">
                            Atur TTD Kepsek ({{ strtoupper($kelas_jenjang ?? 'smp') }}) <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </button>
                    @else
                        <span><i class="fa-solid fa-lock text-[10px] mr-1 text-slate-400"></i> Pratinjau resmi (hanya Admin yang dapat mengubah TTD Kepala Sekolah).</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- DAFTAR CETAK RAPOR SISWA                                 -->
    <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Daftar Siswa Kelas {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}</h3>
                    <p class="text-sm text-slate-500">Pilih siswa untuk melihat pratinjau nilai dan mencetak lembar rapor</p>
                </div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200 gap-1" role="group" aria-label="Urutkan Daftar Rapor Siswa">
                        <button type="button" data-sort-table="tableRaporWalas" data-sort-mode="name" onclick="window.sortSiakadRankingTable('tableRaporWalas', 'name', this)"
                                class="rapor-sort-btn px-3 py-1.5 rounded-lg text-[11px] font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 transition-all cursor-pointer flex items-center gap-1.5">
                            <i class="fa-solid fa-arrow-down-a-z"></i> Nama
                        </button>
                        <button type="button" data-sort-table="tableRaporWalas" data-sort-mode="rank" onclick="window.sortSiakadRankingTable('tableRaporWalas', 'rank', this)"
                                class="rapor-sort-btn px-3 py-1.5 rounded-lg text-[11px] font-semibold text-slate-600 hover:text-amber-700 transition-all cursor-pointer flex items-center gap-1.5">
                            <i class="fa-solid fa-crown text-amber-500"></i> Peringkat
                        </button>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                        <i class="fa-solid fa-users mr-1.5 text-xs"></i> {{ count($siswa) }} Siswa
                    </span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse" id="tableRaporWalas">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider w-14 text-center">No</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">NIS</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Lengkap Siswa</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Kelengkapan Nilai</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Rata-Rata & Peringkat</th>
                            <th class="px-4 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if(isset($leger_siswa) && count($leger_siswa) > 0)
                            @foreach($leger_siswa as $index => $row)
                                @php
                                    $s = $row->siswa;
                                    $rankNum = is_numeric($row->peringkat) ? (int) $row->peringkat : 999999;
                                    $rowRankClass = $rankNum === 1
                                        ? 'siakad-rank-row-1'
                                        : ($rankNum === 2 ? 'siakad-rank-row-2' : ($rankNum === 3 ? 'siakad-rank-row-3' : ''));
                                    $avatarRankClass = $rankNum === 1
                                        ? 'bg-gradient-to-br from-amber-300 to-amber-500 text-amber-950 ring-1 ring-amber-400/70'
                                        : ($rankNum === 2 ? 'bg-gradient-to-br from-slate-200 to-slate-400 text-slate-900 ring-1 ring-slate-400/60'
                                        : ($rankNum === 3 ? 'bg-gradient-to-br from-orange-200 to-orange-400 text-orange-950 ring-1 ring-orange-400/60'
                                        : 'bg-slate-100 text-slate-700'));
                                @endphp
                                <tr class="{{ $rowRankClass }} hover:bg-slate-50/60 transition-colors"
                                    data-orig-index="{{ $index + 1 }}"
                                    data-rank="{{ $rankNum }}">
                                    <td class="px-4 py-4 text-sm text-slate-500 text-center font-medium" data-row-number="true">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4 text-sm font-mono text-slate-600 whitespace-nowrap">{{ $s->nis ?? '-' }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full {{ $avatarRankClass }} flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                {{ substr($s->nama, 0, 2) }}
                                            </div>
                                            <span class="text-sm font-semibold {{ $rankNum <= 3 ? 'text-slate-900' : 'text-slate-800' }}">{{ $s->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        @if(strtoupper($s->gender) == 'P' || strtolower($s->gender) == 'perempuan')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                                <i class="fa-solid fa-venus text-[10px] mr-1"></i> Perempuan
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                <i class="fa-solid fa-mars text-[10px] mr-1"></i> Laki-laki
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $row->mapel_terisi >= $row->total_mapel && $row->total_mapel > 0 ? 'bg-emerald-100 text-emerald-800' : ($row->mapel_terisi > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600') }}">
                                            {{ $row->mapel_terisi }} / {{ $row->total_mapel }} Mapel
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-center whitespace-nowrap">
                                        @if($row->mapel_terisi > 0)
                                            <div class="inline-flex items-center justify-center gap-2">
                                                <span class="font-bold text-slate-800">{{ number_format($row->rata_rata, 1) }}</span>
                                                <x-siakad.rank-badge :rank="$row->peringkat" variant="compact" />
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">Belum ada nilai</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-right whitespace-nowrap">
                                        <a href="/sk/detail-rapor-walas/{{ $s->id }}" class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-emerald-700 text-white hover:bg-emerald-800 text-xs font-semibold transition-colors shadow-sm whitespace-nowrap">
                                            <i class="fa-solid fa-print mr-1.5"></i> Cetak Rapor
                                        </a>
                                    </td>   
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-users-slash text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-medium text-slate-700">Belum Ada Siswa</h4>
                                    <p class="text-xs text-slate-400 mt-1">Belum ada data siswa di kelas perwalian ini.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /#adminRaporPane-kelas -->

    @if($isAdmin)
        @include('modul.siakad.admin.partials.raporGlobalTabs')
    @endif

    <x-siakad.signature-script />
    <script>
        function switchAdminRaporTab(tab, updateUrl = true) {
            const validTabs = ['kelas', 'pengesahan', 'kegiatan', 'template_prestasi'];
            if (!validTabs.includes(tab)) {
                tab = 'kelas';
            }

            document.querySelectorAll('.admin-rapor-pane').forEach(el => el.classList.add('hidden'));
            const activePane = document.getElementById('adminRaporPane-' + tab);
            if (activePane) {
                activePane.classList.remove('hidden');
            }

            const classSwitcher = document.getElementById('adminClassSwitcherWrapper');
            const globalBanner = document.getElementById('adminRaporGlobalBanner');
            if (classSwitcher) {
                classSwitcher.classList.toggle('hidden', tab !== 'kelas');
            }
            if (globalBanner) {
                globalBanner.classList.toggle('hidden', tab === 'kelas');
            }

            const activeClasses = ['bg-emerald-700', 'text-white', 'shadow-xs'];
            const inactiveClasses = ['text-slate-600', 'hover:text-emerald-800', 'hover:bg-white/80'];
            const validTabKeys = ['kelas', 'pengesahan', 'kegiatan', 'template_prestasi'];

            validTabKeys.forEach(key => {
                const btn = document.getElementById('adminTabBtn-' + key);
                if (!btn) return;
                btn.classList.remove(
                    'bg-white', 'text-emerald-700', 'border', 'border-slate-200/80',
                    'bg-blue-700', 'bg-violet-700', 'bg-amber-600',
                    'hover:text-blue-800', 'hover:text-violet-800', 'hover:text-amber-800',
                    ...activeClasses, ...inactiveClasses
                );
                if (key === tab) {
                    btn.classList.add(...activeClasses);
                } else {
                    btn.classList.add(...inactiveClasses);
                }
            });

            if (updateUrl) {
                try {
                    const url = new URL(window.location);
                    if (tab === 'kelas') {
                        url.searchParams.delete('tab');
                        url.searchParams.delete('jenjang');
                    } else {
                        url.searchParams.set('tab', tab);
                        if (tab === 'pengesahan') {
                            const jVal = document.getElementById('adminPengaturanJenjangInput')?.value;
                            if (jVal) url.searchParams.set('jenjang', jVal);
                        } else if (tab === 'kegiatan' && window.__activeKegiatanFilter && window.__activeKegiatanFilter !== 'all') {
                            url.searchParams.set('jenjang', window.__activeKegiatanFilter);
                        } else if (tab === 'template_prestasi' && window.__activePrestasiFilter && window.__activePrestasiFilter !== 'all') {
                            url.searchParams.set('jenjang', window.__activePrestasiFilter);
                        } else {
                            url.searchParams.delete('jenjang');
                        }
                    }
                    window.history.replaceState({}, '', url);
                } catch (e) {}
            }

            if (typeof window.refreshSiakadPagination === 'function') {
                setTimeout(() => window.refreshSiakadPagination(), 20);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if($isAdmin)
                switchAdminRaporTab('{{ $initialAdminTab }}', false);
            @endif
        });
    </script>
    <script>
        function updateClassWalasSignatureUI(dataUrl, message, isError = false) {
            const thumb = document.getElementById('walasCardThumbTtd');
            const placeholder = document.getElementById('walasCardPlaceholderTtd');
            const statusEl = document.getElementById('walasCardStatusTtd');
            const btnHapus = document.getElementById('walasCardBtnHapus');
            const syncMsg = document.getElementById('walasCardSyncMsg');

            if (dataUrl) {
                if (thumb) { thumb.src = dataUrl; thumb.classList.remove('hidden'); }
                if (placeholder) placeholder.classList.add('hidden');
                if (statusEl) {
                    statusEl.textContent = 'Aktif (Tersimpan)';
                    statusEl.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-emerald-100 text-emerald-800';
                }
                if (btnHapus) btnHapus.classList.remove('hidden');
            } else {
                if (thumb) { thumb.src = ''; thumb.classList.add('hidden'); }
                if (placeholder) placeholder.classList.remove('hidden');
                if (statusEl) {
                    statusEl.textContent = 'Belum diunggah';
                    statusEl.className = 'text-[10px] font-semibold px-2 py-0.5 rounded bg-slate-200 text-slate-600';
                }
                if (btnHapus) btnHapus.classList.add('hidden');
            }

            if (syncMsg && message) {
                syncMsg.textContent = message;
                syncMsg.className = 'text-[11px] mt-2 font-medium ' + (isError ? 'text-rose-600' : 'text-emerald-700');
                syncMsg.classList.remove('hidden');
            }
        }

        async function saveClassWalasSignature(dataUrl) {
            const syncMsg = document.getElementById('walasCardSyncMsg');
            if (syncMsg) {
                syncMsg.textContent = 'Menyimpan tanda tangan kelas ke database...';
                syncMsg.className = 'text-[11px] mt-2 font-medium text-slate-500';
                syncMsg.classList.remove('hidden');
            }

            try {
                const response = await fetch('/sk/simpan-massal-prestasi-walas', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action: 'simpan_ttd_walas',
                        kelas_id: {{ $wallas->kelas_id ?? 'null' }},
                        ttd_walas: dataUrl || ''
                    })
                });
                const resJson = await response.json().catch(() => ({}));
                if (response.ok && resJson.success) {
                    updateClassWalasSignatureUI(dataUrl, resJson.message || 'Berhasil disimpan ke database.');
                } else {
                    updateClassWalasSignatureUI(null, resJson.message || 'Gagal menyimpan tanda tangan ke database.', true);
                }
            } catch (err) {
                updateClassWalasSignatureUI(dataUrl, 'Gagal terhubung ke server saat menyimpan TTD.', true);
            }
        }

        function handleClassWalasSignatureUpload(inputEl) {
            const file = inputEl.files && inputEl.files[0];
            if (!file) return;

            removeSignatureBackground(file, function(pngDataUrl) {
                updateClassWalasSignatureUI(pngDataUrl, 'Memproses gambar transparan...');
                saveClassWalasSignature(pngDataUrl);
            });
            inputEl.value = '';
        }

        function removeClassWalasSignature() {
            updateClassWalasSignatureUI('', 'Menghapus tanda tangan kelas...');
            saveClassWalasSignature('');
        }
    </script>
</x-siakad-layout>
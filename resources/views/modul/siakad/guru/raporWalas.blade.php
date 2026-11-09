<x-siakad-layout 
    title="Cetak & Evaluasi Rapor Santri" 
    description="Kelola rekap nilai, catatan wali kelas, prestasi, dan cetak dokumen rapor santri." 
    position="{{ session('role') === 'a' ? 'Administrator SIAKAD' : 'Guru Wali Kelas' }}" 
    initials="{{ session('role') === 'a' ? 'AD' : 'GR' }}">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="{{ session('role') === 'a' ? '/sk/ds' : '/sk/dsg' }}" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Rapor Santri</span>
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

    <!-- Admin Switcher Kelas (Hanya untuk Admin) -->
    @if(session('role') === 'a' && isset($daftar_semua_kelas) && $daftar_semua_kelas->isNotEmpty())
        <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white rounded-2xl p-5 mb-6 shadow-sm border border-slate-700 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div>
                    <h4 class="text-sm font-bold text-white flex items-center gap-2">
                        Mode Administrator Rapor
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">Semua Kelas</span>
                    </h4>
                    <p class="text-xs text-slate-300 mt-0.5">Pilih rombongan belajar untuk mengelola catatan, prestasi, dan cetak rapor santri.</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <label for="selectKelasAdmin" class="text-xs text-slate-300 font-medium whitespace-nowrap">Pilih Kelas:</label>
                <select id="selectKelasAdmin" onchange="location.href='/sk/rapor-walas?kelas_id=' + this.value + '{{ request('tab') ? '&tab='.request('tab') : '' }}'" class="text-xs bg-slate-800 border border-slate-600 text-white rounded-xl px-3.5 py-2 focus:ring-emerald-500 focus:border-emerald-500 font-semibold shadow-inner">
                    @foreach($daftar_semua_kelas as $rk)
                        <option value="{{ $rk->id }}" {{ ($wallas->kelas_id ?? null) == $rk->id ? 'selected' : '' }}>
                            {{ $rk->nama_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    <!-- Tab Switcher: Manajemen Nilai vs Cetak Rapor -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200">
            <a href="/sk/rapor-walas?tab=nilai{{ session('role') === 'a' ? '&kelas_id='.($wallas->kelas_id ?? '') : '' }}" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-sliders"></i> Leger Nilai
            </a>
            <a href="/sk/rapor-walas{{ session('role') === 'a' ? '?kelas_id='.($wallas->kelas_id ?? '') : '' }}" class="px-4 py-2 rounded-lg text-xs font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-file-contract"></i> Cetak Rapor
            </a>
        </div>

        <div class="flex items-center gap-2">
            <a href="/sk/rapor-walas?print=massal{{ session('role') === 'a' ? '&kelas_id='.($wallas->kelas_id ?? '') : '' }}" target="_blank" class="inline-flex items-center px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold transition-all shadow-sm gap-2">
                <i class="fa-solid fa-print"></i> Cetak Seluruh Rapor Kelas (Massal)
            </a>
            <a href="/sk/rapor-walas?tab=nilai{{ session('role') === 'a' ? '&kelas_id='.($wallas->kelas_id ?? '') : '' }}" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors">
                <i class="fa-solid fa-sliders mr-1.5"></i> Leger Nilai
            </a>
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
                    <div class="w-8 h-8 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center text-sm font-bold">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold text-slate-800">Master Program Kegiatan Sekolah (Rapor)</h4>
                        <p class="text-[11px] text-slate-500">Daftar kegiatan resmi dari Admin yang dinilai pada lembar rapor santri. Klik <strong>Detail Rapor</strong> santri untuk mengevaluasi predikat & narasinya.</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200/60 w-fit">
                    <i class="fa-solid fa-list-check mr-1.5"></i> {{ $daftar_kegiatan_sekolah->count() }} Kegiatan Aktif
                </span>
            </div>
            <div class="flex flex-wrap gap-2 pt-3 border-t border-slate-100">
                @foreach($daftar_kegiatan_sekolah as $dkeg)
                    <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 font-medium">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <strong class="text-slate-800">{{ $dkeg->nama_kegiatan }}</strong>
                        @if($dkeg->jenjang !== 'semua')
                            <span class="text-[10px] uppercase font-bold text-indigo-600 bg-indigo-50 px-1.5 py-0.5 rounded border border-indigo-200">{{ $dkeg->jenjang }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif


    <!-- ======================================================== -->
    <!-- DAFTAR CETAK RAPOR SISWA                                 -->
    <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Daftar Siswa Kelas {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}</h3>
                    <p class="text-sm text-slate-500">Pilih siswa untuk melihat pratinjau nilai dan mencetak lembar rapor</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    <i class="fa-solid fa-users mr-1.5 text-xs"></i> {{ count($siswa) }} Siswa
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider w-16 text-center">No</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Nama Lengkap Siswa</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Kelengkapan Nilai</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Rata-Rata & Peringkat</th>
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if(isset($leger_siswa) && count($leger_siswa) > 0)
                            @foreach($leger_siswa as $index => $row)
                                @php $s = $row->siswa; @endphp
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 text-sm text-slate-500 text-center font-medium">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-mono text-slate-600">{{ $s->nis ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                {{ substr($s->nama, 0, 2) }}
                                            </div>
                                            <span class="text-sm font-semibold text-slate-800">{{ $s->nama }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
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
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $row->mapel_terisi >= $row->total_mapel && $row->total_mapel > 0 ? 'bg-emerald-100 text-emerald-800' : ($row->mapel_terisi > 0 ? 'bg-amber-100 text-amber-800' : 'bg-slate-100 text-slate-600') }}">
                                            {{ $row->mapel_terisi }} / {{ $row->total_mapel }} Mapel
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($row->mapel_terisi > 0)
                                            <span class="font-bold text-slate-800">{{ number_format($row->rata_rata, 1) }}</span>
                                            <span class="ml-1.5 px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-slate-700">#{{ $row->peringkat }}</span>
                                        @else
                                            <span class="text-xs text-slate-400">Belum ada nilai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="/sk/detail-rapor-walas/{{ $s->id }}" class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 text-xs font-semibold transition-colors shadow-sm">
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
</x-siakad-layout>
<x-siakad-layout 
    title="Manajemen Nilai Kelas" 
    description="Pantau, tinjau, dan atur nilai seluruh mata pelajaran yang diinput oleh guru pengajar di kelas perwalian Anda." 
    position="Guru Wali Kelas" 
    initials="WK">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Manajemen Nilai Kelas</span>
        </li>
    </x-slot>

    <!-- Tab Switcher: Manajemen Nilai vs Cetak Rapor -->
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
        <div class="inline-flex p-1 rounded-xl bg-slate-100 border border-slate-200">
            <a href="/sk/rapor-walas?tab=nilai" class="px-4 py-2 rounded-lg text-xs font-bold bg-white text-emerald-700 shadow-sm border border-slate-200/80 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-sliders"></i> Manajemen & Leger Nilai Kelas
            </a>
            <a href="/sk/rapor-walas" class="px-4 py-2 rounded-lg text-xs font-semibold text-slate-600 hover:text-slate-900 flex items-center gap-2 transition-all">
                <i class="fa-solid fa-file-contract"></i> Cetak Rapor Siswa
            </a>
        </div>

        <div class="flex items-center gap-2 text-xs text-slate-500">
            <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-800 border border-emerald-200 font-semibold">
                <i class="fa-solid fa-shield-halved mr-1.5 text-emerald-600"></i> Akses Wali Kelas: Dapat Meninjau & Mengatur Nilai Mapel
            </span>
        </div>
    </div>

    <!-- Top KPI Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-violet-50 text-violet-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-school text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Kelas Perwalian</p>
                <h3 class="text-xl font-bold text-slate-800 break-words leading-snug mt-0.5">{{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                <p class="text-xs text-slate-400 mt-1 truncate">{{ count($siswa) }} siswa aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Progres Input Pengajar</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $stats_nilai['mapel_sudah_input'] }} <span class="text-xs sm:text-sm font-normal text-slate-400">/ {{ $stats_nilai['total_mapel'] }} Mapel</span></h3>
                <p class="text-xs text-slate-400 mt-1 truncate">{{ $stats_nilai['mapel_lengkap'] }} mapel sudah lengkap 100%</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Rata-Rata Kelas</p>
                <h3 class="text-xl sm:text-2xl font-bold text-emerald-600 mt-0.5 truncate">{{ number_format($stats_nilai['rata_kelas'], 1) }}</h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Akumulasi nilai akhir terbobot</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg flex-shrink-0">
                <i class="fa-solid fa-scale-balanced text-xl"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-500 truncate">Komponen Evaluasi</p>
                <h3 class="text-lg sm:text-xl font-bold text-slate-800 mt-0.5 truncate">{{ count($jenis_penilaian) }} Komponen</h3>
                <p class="text-xs text-slate-400 mt-1 truncate">Tugas, UH, UTS, & UAS</p>
            </div>
        </div>
    </div>

    <!-- BAGIAN 1: DAFTAR MATA PELAJARAN & MANAJEMEN NILAI PENGAJAR -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Daftar Nilai Mata Pelajaran (Inputan Guru Pengajar)</h3>
                    <p class="text-xs text-slate-500">Klik tombol <strong>Atur / Edit Nilai</strong> untuk memeriksa atau menyesuaikan rincian nilai siswa pada mata pelajaran terkait</p>
                </div>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                <i class="fa-solid fa-layer-group mr-1.5 text-xs"></i> {{ $rekap_mapel->count() }} Mata Pelajaran
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Guru Pengajar</th>
                        <th class="px-5 py-3.5 text-center">KKM</th>
                        <th class="px-5 py-3.5">Progres Input Nilai</th>
                        <th class="px-5 py-3.5 text-center">Rata-Rata</th>
                        <th class="px-5 py-3.5 text-center">Ketuntasan</th>
                        <th class="px-5 py-3.5 text-center w-44">Aksi Wali Kelas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @if($rekap_mapel->count() > 0)
                        @foreach($rekap_mapel as $m)
                            @php
                                $persen = $m->total_siswa > 0 ? round(($m->siswa_dinilai / $m->total_siswa) * 100) : 0;
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-800 block">{{ $m->nama_mapel }}</span>
                                    <span class="text-xs text-slate-400">{{ $m->hari }} • {{ $m->jam_mulai }} - {{ $m->jam_selesai }} WIB</span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center space-x-2.5">
                                        <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            {{ substr($m->guru_nama, 0, 2) }}
                                        </div>
                                        <span class="font-medium text-slate-700">{{ $m->guru_nama }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $m->kkm }}
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-between text-xs mb-1">
                                        <span class="font-semibold text-slate-700">{{ $m->siswa_dinilai }} / {{ $m->total_siswa }} Siswa</span>
                                        @if($m->status_input === 'lengkap')
                                            <span class="text-emerald-600 font-bold"><i class="fa-solid fa-circle-check mr-1"></i>Lengkap</span>
                                        @elseif($m->status_input === 'sebagian')
                                            <span class="text-amber-600 font-semibold">Proses ({{ $persen }}%)</span>
                                        @else
                                            <span class="text-rose-600 font-semibold">Belum Diinput</span>
                                        @endif
                                    </div>
                                    <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full {{ $m->status_input === 'lengkap' ? 'bg-emerald-500' : ($m->status_input === 'sebagian' ? 'bg-amber-500' : 'bg-slate-300') }}" style="width: {{ $persen }}%"></div>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($m->siswa_dinilai > 0)
                                        <span class="text-base font-extrabold {{ $m->rata_rata >= $m->kkm ? 'text-emerald-700' : 'text-rose-600' }}">
                                            {{ number_format($m->rata_rata, 1) }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($m->siswa_dinilai > 0)
                                        <div class="inline-flex items-center gap-1.5 text-xs">
                                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold border border-emerald-200" title="Tuntas KKM">
                                                {{ $m->siswa_tuntas }} Tuntas
                                            </span>
                                            @if($m->siswa_remedi > 0)
                                                <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold border border-rose-200" title="Di Bawah KKM">
                                                    {{ $m->siswa_remedi }} Remedi
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Menunggu nilai</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <a href="/sk/input-nilai-detail/{{ $m->jadwal_id }}?from=walas" 
                                       class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-all shadow-sm">
                                        <i class="fa-solid fa-pen-to-square mr-1.5"></i> Atur / Edit Nilai
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-book-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Belum Ada Mata Pelajaran Terjadwal</h4>
                                <p class="text-xs text-slate-400 mt-1">Jadwal mata pelajaran untuk kelas {{ $wallas->ruangKelas->nama_ruang ?? '-' }} belum diatur oleh Admin.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- BAGIAN 2: TABEL LEGER NILAI KELAS (REKAPITULASI SEMUA MATA PELAJARAN) -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-table-list"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Leger Nilai Seluruh Siswa: {{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                    <p class="text-xs text-slate-500">Rekapitulasi nilai akhir seluruh mata pelajaran, rata-rata capaian, dan peringkat kelas</p>
                </div>
            </div>

            <div class="relative w-full sm:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" id="searchLeger" onkeyup="filterLeger()" placeholder="Cari nama atau NIS siswa..." 
                       class="w-full pl-9 pr-3 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-emerald-500 transition-colors">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="tableLeger">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-4 py-3.5 w-12 text-center">No</th>
                        <th class="px-4 py-3.5 min-w-[200px]">Nama Lengkap Siswa</th>
                        @foreach($rekap_mapel as $m)
                            <th class="px-3 py-3.5 text-center min-w-[110px]" title="Pengajar: {{ $m->guru_nama }} (KKM: {{ $m->kkm }})">
                                <span class="block text-[11px] font-bold text-slate-700 leading-tight">{{ $m->nama_mapel }}</span>
                                <span class="text-[10px] font-normal text-slate-400">KKM: {{ $m->kkm }}</span>
                            </th>
                        @endforeach
                        <th class="px-4 py-3.5 text-center bg-slate-100/70">Total</th>
                        <th class="px-4 py-3.5 text-center bg-slate-100/70">Rata-Rata</th>
                        <th class="px-4 py-3.5 text-center">Predikat</th>
                        <th class="px-4 py-3.5 text-center">Peringkat</th>
                        <th class="px-4 py-3.5 text-center">Rapor</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @if($leger_siswa->count() > 0)
                        @foreach($leger_siswa as $row)
                            <tr class="leger-row hover:bg-slate-50/70 transition-colors" data-search="{{ strtolower($row->siswa->nama . ' ' . ($row->siswa->nis ?? '')) }}">
                                <td class="px-4 py-3.5 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3.5">
                                    <div class="flex items-center space-x-2.5">
                                        <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            {{ substr($row->siswa->nama, 0, 2) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block leading-tight">{{ $row->siswa->nama }}</span>
                                            <span class="text-[11px] font-mono text-slate-400">NIS: {{ $row->siswa->nis ?? '-' }}</span>
                                        </div>
                                    </div>
                                </td>

                                @foreach($rekap_mapel as $m)
                                    @php
                                        $cell = $row->nilai_mapel[$m->mapel_id] ?? ['ada' => false, 'nilai_akhir' => null, 'tuntas' => false];
                                    @endphp
                                    <td class="px-3 py-3.5 text-center">
                                        @if($cell['ada'])
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold {{ $cell['tuntas'] ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-rose-50 text-rose-700 border border-rose-200' }}">
                                                {{ number_format($cell['nilai_akhir'], 1) }}
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-300">-</span>
                                        @endif
                                    </td>
                                @endforeach

                                <td class="px-4 py-3.5 text-center font-bold text-slate-800 bg-slate-50/50">
                                    {{ $row->mapel_terisi > 0 ? number_format($row->total_nilai, 1) : '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-center font-extrabold text-emerald-700 bg-slate-50/50">
                                    {{ $row->mapel_terisi > 0 ? number_format($row->rata_rata, 1) : '-' }}
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    @if($row->predikat !== '-')
                                        <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold {{ $row->predikat == 'A' ? 'bg-blue-100 text-blue-800' : ($row->predikat == 'B' ? 'bg-emerald-100 text-emerald-800' : ($row->predikat == 'C' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800')) }}">
                                            {{ $row->predikat }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    @if($row->peringkat !== '-')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold {{ $row->peringkat <= 3 ? 'bg-amber-100 text-amber-800 border border-amber-300' : 'bg-slate-100 text-slate-700' }}">
                                            @if($row->peringkat == 1) <i class="fa-solid fa-crown text-amber-500 mr-1 text-[10px]"></i> @endif
                                            #{{ $row->peringkat }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <a href="/sk/detail-rapor-walas/{{ $row->siswa->id }}" 
                                       class="inline-flex items-center px-2.5 py-1 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 text-xs font-semibold transition-colors" title="Lihat & Cetak Rapor">
                                        <i class="fa-solid fa-print mr-1"></i> Rapor
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="{{ 7 + $rekap_mapel->count() }}" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-users-slash text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Belum Ada Siswa</h4>
                                <p class="text-xs text-slate-400 mt-1">Belum ada peserta didik terdaftar di kelas perwalian ini.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function filterLeger() {
            const q = (document.getElementById('searchLeger').value || '').toLowerCase();
            document.querySelectorAll('.leger-row').forEach(function(row) {
                const text = row.getAttribute('data-search') || '';
                const show = text.includes(q);
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
            });
            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
        }
    </script>
</x-siakad-layout>


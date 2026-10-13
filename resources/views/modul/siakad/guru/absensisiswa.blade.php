<x-siakad-layout 
    title="Absensi & Rekap Kehadiran Kelas" 
    description="Kelola presensi harian siswa perwalian dan pantau rekapitulasi kehadiran akumulatif semester." 
    position="Guru Wali Kelas" 
    initials="WK">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Absensi Kelas ({{ $wallas->ruangKelas->nama_ruang ?? '-' }})</span>
        </li>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5"></i>
            <div>
                <p class="font-semibold text-sm">Berhasil!</p>
                <p class="text-sm mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @php
        $activeTab = $tab ?? request('tab', 'harian');
    @endphp

    <!-- Header & Tab Switcher -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 self-start">
            <a href="/sk/absensi-walas?tab=harian&tanggal={{ $tanggal }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab !== 'rekap' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Input Absensi Harian</span>
            </a>
            <a href="/sk/absensi-walas?tab=rekap&tanggal={{ $tanggal }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab === 'rekap' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-chart-pie"></i>
                <span>Rekap Akumulasi Semester</span>
            </a>
        </div>

        <form method="GET" action="/sk/absensi-walas" class="flex items-center gap-2.5">
            <input type="hidden" name="tab" value="{{ $activeTab }}">
            <div class="relative">
                <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="date" name="tanggal" value="{{ $tanggal }}" 
                       class="pl-9 pr-3 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-semibold focus:outline-none focus:border-emerald-500 shadow-sm">
            </div>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition-colors shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-filter text-[10px]"></i> Tampilkan
            </button>
        </form>
    </div>

    @if($activeTab === 'rekap')
        <!-- TAB 2: REKAP AKUMULASI KEHADIRAN SEMESTER -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Kelas Perwalian</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">{{ count($siswa) }} Peserta Didik</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Total Hari Efektif Tercatat</p>
                    <h3 class="text-xl font-bold text-slate-800">{{ $total_hari_efektif ?? 0 }} Hari</h3>
                    <p class="text-[11px] text-emerald-600 font-semibold mt-0.5">Presensi Harian Wali Kelas</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                    <i class="fa-solid fa-file-contract"></i>
                </div>
                <div>
                    <p class="text-xs font-medium text-slate-500">Sinkronisasi Rapor</p>
                    <h3 class="text-base font-bold text-slate-800">Otomatis Terhubung</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Total S/I/A masuk ke cetak rapor</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Tabel Rekapitulasi Kehadiran Siswa (Akumulasi Semester)</h3>
                    <p class="text-xs text-slate-500">Pantau siswa yang sering izin, sakit, atau tanpa keterangan (alpa) untuk pembinaan lebih lanjut</p>
                </div>
                <a href="/sk/rapor-walas" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold transition-colors self-start sm:self-auto">
                    <i class="fa-solid fa-print mr-1.5"></i> Buka Cetak Rapor
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-14 text-center">No</th>
                            <th class="px-5 py-3.5">NIS</th>
                            <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                            <th class="px-5 py-3.5 text-center">Hadir (H)</th>
                            <th class="px-5 py-3.5 text-center">Sakit (S)</th>
                            <th class="px-5 py-3.5 text-center">Izin (I)</th>
                            <th class="px-5 py-3.5 text-center">Alpa (A)</th>
                            <th class="px-5 py-3.5 text-center">Persentase Hadir</th>
                            <th class="px-5 py-3.5 text-center">Evaluasi Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @if(count($siswa) > 0)
                            @foreach($siswa as $s)
                                @php
                                    $rk = $rekap_akumulasi[$s->id] ?? ['hadir' => 0, 'sakit' => 0, 'izin' => 0, 'alpa' => 0, 'total' => 0, 'persentase' => 0];
                                    $pct = $rk['persentase'];
                                @endphp
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-3.5 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-3.5 font-mono text-xs text-slate-500">{{ $s->nis ?? '-' }}</td>
                                    <td class="px-5 py-3.5 font-semibold text-slate-800">{{ $s->nama }}</td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 font-bold text-xs">{{ $rk['hadir'] }}</span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 font-bold text-xs">{{ $rk['sakit'] }}</span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-blue-50 text-blue-700 font-bold text-xs">{{ $rk['izin'] }}</span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <span class="px-2.5 py-1 rounded-md {{ $rk['alpa'] > 0 ? 'bg-rose-100 text-rose-800' : 'bg-slate-50 text-slate-500' }} font-bold text-xs">{{ $rk['alpa'] }}</span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        @if($rk['total'] > 0)
                                            <div class="inline-flex items-center gap-2">
                                                <div class="w-16 h-2 bg-slate-100 rounded-full overflow-hidden">
                                                    <div class="h-full {{ $pct >= 90 ? 'bg-emerald-500' : ($pct >= 75 ? 'bg-amber-500' : 'bg-rose-500') }}" style="width: {{ $pct }}%"></div>
                                                </div>
                                                <span class="text-xs font-bold text-slate-700">{{ $pct }}%</span>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        @if($rk['total'] == 0)
                                            <span class="text-xs text-slate-400 italic">Belum ada data</span>
                                        @elseif($rk['alpa'] >= 3 || $pct < 75)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-triangle-exclamation mr-1 text-[10px]"></i> Perlu Pembinaan
                                            </span>
                                        @elseif($pct >= 90)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check mr-1 text-[10px]"></i> Disiplin Baik
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                Cukup
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-slate-500">Belum ada siswa di kelas ini.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- TAB 1: INPUT ABSENSI HARIAN WALI KELAS -->
        <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-slate-800">{{ $rekap['total'] }}</span>
                    <span class="text-[11px] font-semibold text-slate-500 uppercase">Total Siswa</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-emerald-700">{{ $rekap['hadir'] }}</span>
                    <span class="text-[11px] font-semibold text-emerald-800 uppercase">Hadir</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-amber-700">{{ $rekap['sakit'] }}</span>
                    <span class="text-[11px] font-semibold text-amber-800 uppercase">Sakit</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-4 flex items-center gap-3.5">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-blue-700">{{ $rekap['izin'] }}</span>
                    <span class="text-[11px] font-semibold text-blue-800 uppercase">Izin</span>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-rose-200 p-4 flex items-center gap-3.5 col-span-2 sm:col-span-1">
                <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-user-xmark"></i>
                </div>
                <div>
                    <span class="block text-xl font-bold text-rose-700">{{ $rekap['alpa'] }}</span>
                    <span class="text-[11px] font-semibold text-rose-800 uppercase">Alpa</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Form Presensi Harian Kelas {{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                        <p class="text-xs text-slate-500">Tanggal: <strong>{{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</strong></p>
                    </div>
                </div>

                @if(count($siswa) > 0)
                <button type="button" onclick="setSemuaHadirWalas()" class="inline-flex items-center px-3.5 py-2 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors self-start sm:self-auto">
                    <i class="fa-solid fa-check-double mr-1.5"></i> Tandai Semua Hadir
                </button>
                @endif
            </div>

            <form action="/sk/simpan-absensi-walas" method="POST">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                <th class="px-5 py-3.5 w-14 text-center">No</th>
                                <th class="px-5 py-3.5">NIS</th>
                                <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                                <th class="px-5 py-3.5 text-center">Status Kehadiran Harian</th>
                                <th class="px-5 py-3.5">Keterangan / Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @if(count($siswa) > 0)
                                @foreach($siswa as $index => $s)
                                    @php
                                        $absen = $absensi_db[$s->id] ?? null;
                                        $status = $absen ? $absen->status : 'h';
                                        $keterangan = $absen ? $absen->keterangan : '';
                                    @endphp
                                    <tr class="hover:bg-slate-50/60 transition-colors">
                                        <td class="px-5 py-3.5 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                        <td class="px-5 py-3.5 font-mono text-xs text-slate-500">{{ $s->nis ?? '-' }}</td>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                    {{ substr($s->nama, 0, 2) }}
                                                </div>
                                                <span class="font-semibold text-slate-800">{{ $s->nama }}</span>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center justify-center gap-2">
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status[{{ $s->id }}]" value="h" class="peer sr-only radio-hadir-walas" {{ $status == 'h' ? 'checked' : '' }}>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-emerald-100 peer-checked:text-emerald-800 peer-checked:border-emerald-300 transition-all">
                                                        <i class="fa-solid fa-check mr-1 text-[10px]"></i> Hadir
                                                    </span>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status[{{ $s->id }}]" value="s" class="peer sr-only" {{ $status == 's' ? 'checked' : '' }}>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-amber-100 peer-checked:text-amber-800 peer-checked:border-amber-300 transition-all">
                                                        <i class="fa-solid fa-heart-pulse mr-1 text-[10px]"></i> Sakit
                                                    </span>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status[{{ $s->id }}]" value="i" class="peer sr-only" {{ $status == 'i' ? 'checked' : '' }}>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-blue-100 peer-checked:text-blue-800 peer-checked:border-blue-300 transition-all">
                                                        <i class="fa-solid fa-envelope-open mr-1 text-[10px]"></i> Izin
                                                    </span>
                                                </label>
                                                <label class="cursor-pointer">
                                                    <input type="radio" name="status[{{ $s->id }}]" value="a" class="peer sr-only" {{ $status == 'a' ? 'checked' : '' }}>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-rose-100 peer-checked:text-rose-800 peer-checked:border-rose-300 transition-all">
                                                        <i class="fa-solid fa-xmark mr-1 text-[10px]"></i> Alpa
                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <input type="text" name="keterangan[{{ $s->id }}]" value="{{ $keterangan }}" 
                                                   placeholder="Tambahkan keterangan (opsional)..." autocomplete="off"
                                                   class="w-full px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                        <i class="fa-solid fa-folder-open text-2xl text-slate-300 mb-2 block"></i>
                                        Belum ada data siswa di kelas ini.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(count($siswa) > 0)
                <div class="p-6 bg-slate-50/50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500">
                        <i class="fa-solid fa-circle-info text-emerald-600 mr-1"></i>
                        Data absensi harian kelas ini akan direkap otomatis ke dalam laporan ketidakhadiran rapor siswa.
                    </p>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-sm transition-all flex items-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Absensi Harian
                    </button>
                </div>
                @endif
            </form>
        </div>
    @endif

    <script>
        function setSemuaHadirWalas() {
            document.querySelectorAll('.radio-hadir-walas').forEach(function(radio) {
                radio.checked = true;
            });
        }
    </script>
</x-siakad-layout>

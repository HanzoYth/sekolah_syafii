<x-siakad-layout 
    title="Jadwal Pelajaran, Absensi & Jurnal Belajar" 
    description="Pantau jadwal pelajaran mingguan, jurnal materi yang diajarkan guru, serta rekapitulasi kehadiran ananda {{ $siswa->nama }}." 
    position="Siswa / Orang Tua" 
    initials="SW">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Jadwal & Absensi</span>
        </li>
    </x-slot>

    @php
        $activeTab = $tab ?? request('tab', 'jadwal');
        $namaKelas = $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? 'Belum Ada Kelas');
    @endphp

    <!-- Top Rekap Kehadiran Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 flex items-center gap-3.5 col-span-2 sm:col-span-1">
            <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-chart-pie"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-slate-800">{{ $rekap_absen['persentase'] ?? 100 }}%</span>
                <span class="text-[11px] font-semibold text-slate-500 uppercase">Kehadiran</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-emerald-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-emerald-700">{{ $rekap_absen['h'] ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-emerald-800 uppercase">Hadir (H)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-notes-medical"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-amber-700">{{ $rekap_absen['s'] ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-amber-800 uppercase">Sakit (S)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-envelope-open-text"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-blue-700">{{ $rekap_absen['i'] ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-blue-800 uppercase">Izin (I)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-rose-200 p-4 flex items-center gap-3.5">
            <div class="w-10 h-10 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-user-xmark"></i>
            </div>
            <div>
                <span class="block text-xl font-bold text-rose-700">{{ $rekap_absen['a'] ?? 0 }}</span>
                <span class="text-[11px] font-semibold text-rose-800 uppercase">Alpa (A)</span>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex flex-wrap p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 gap-1">
            <a href="/sk/jadwal-siswa?tab=jadwal" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab === 'jadwal' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-calendar-week"></i>
                <span>Jadwal Pelajaran ({{ $jadwal->count() }})</span>
            </a>
            <a href="/sk/jadwal-siswa?tab=absensi_mapel" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab === 'absensi_mapel' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-book-open-reader"></i>
                <span>Absensi Mapel & Jurnal Belajar ({{ isset($riwayat_absensi_mapel) ? $riwayat_absensi_mapel->count() : 0 }})</span>
            </a>
            <a href="/sk/jadwal-siswa?tab=absensi_harian" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab === 'absensi_harian' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-clipboard-user"></i>
                <span>Presensi Harian Wali Kelas ({{ isset($riwayat_absensi_harian) ? $riwayat_absensi_harian->count() : 0 }})</span>
            </a>
        </div>

        <div class="flex items-center gap-2 text-xs text-slate-600 bg-white px-3.5 py-2 rounded-xl border border-slate-200 shadow-sm self-start sm:self-auto">
            <i class="fa-solid fa-school text-emerald-600"></i>
            <span>Kelas: <strong>{{ $namaKelas }}</strong></span>
            @if(isset($wallas) && $wallas && $wallas->guru)
                <span class="text-slate-300">|</span>
                <span>Walas: <strong>{{ $wallas->guru->nama }}</strong></span>
            @endif
        </div>
    </div>

    @if($activeTab === 'absensi_mapel')
        <!-- TAB 2: RIWAYAT ABSENSI MAPEL & JURNAL MATERI GURU -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Riwayat Kehadiran Per Mata Pelajaran & Jurnal Belajar</h3>
                    <p class="text-xs text-slate-500">Rekaman kehadiran siswa pada setiap jam pelajaran beserta pokok bahasan materi yang diajarkan oleh Guru Pengajar</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Kehadiran Sesi Mapel: {{ $rekap_absen_mapel['persentase'] ?? 100 }}% ({{ $rekap_absen_mapel['h'] ?? 0 }}/{{ $rekap_absen_mapel['total'] ?? 0 }} Sesi)
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-12 text-center">No</th>
                            <th class="px-5 py-3.5">Tanggal & Waktu</th>
                            <th class="px-5 py-3.5">Mata Pelajaran</th>
                            <th class="px-5 py-3.5">Guru Pengajar</th>
                            <th class="px-5 py-3.5">Jurnal Materi & Kegiatan Belajar</th>
                            <th class="px-5 py-3.5 text-center">Kehadiran Siswa</th>
                            <th class="px-5 py-3.5">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @if(isset($riwayat_absensi_mapel) && $riwayat_absensi_mapel->count() > 0)
                            @foreach($riwayat_absensi_mapel as $item)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 whitespace-nowrap">
                                        <span class="font-bold text-slate-800 block">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMM Y') }}</span>
                                        @if($item->jadwal && $item->jadwal->jam_pelajaran)
                                            <span class="text-xs text-slate-400 font-mono">
                                                {{ substr($item->jadwal->jam_pelajaran->jam_mulai, 0, 5) }} - {{ substr($item->jadwal->jam_pelajaran->jam_selesai, 0, 5) }} WIB
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="font-bold text-slate-800">{{ $item->jadwal->mata_pelajaran->nama_mapel ?? '-' }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-700 font-medium">
                                        {{ $item->jadwal->guru->nama ?? ($item->guru->nama ?? '-') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        @if(!empty($item->jurnal_materi))
                                            <span class="font-semibold text-emerald-800 block text-xs">
                                                <i class="fa-solid fa-book-bookmark text-[10px] mr-1 text-emerald-600"></i>{{ $item->jurnal_materi }}
                                            </span>
                                            @if(!empty($item->jurnal_catatan))
                                                <span class="text-[11px] text-slate-500 italic block mt-0.5">"{{ $item->jurnal_catatan }}"</span>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400 italic">Materi belum dicatat</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($item->status == 'h')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Hadir
                                            </span>
                                        @elseif($item->status == 's')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-notes-medical mr-1 text-[10px]"></i> Sakit
                                            </span>
                                        @elseif($item->status == 'i')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-envelope-open mr-1 text-[10px]"></i> Izin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-xmark mr-1 text-[10px]"></i> Alpa
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-xs text-slate-500">
                                        {{ $item->keterangan ?: '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-book-open text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Riwayat Absensi Sesi Mata Pelajaran</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data presensi mapel dan jurnal materi belajar akan muncul setelah Guru Pengajar melakukan absensi di kelas.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    @elseif($activeTab === 'absensi_harian')
        <!-- TAB 3: RIWAYAT PRESENSI HARIAN WALI KELAS -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Riwayat Presensi Harian Kelas (Wali Kelas)</h3>
                    <p class="text-xs text-slate-500">Catatan kehadiran harian yang direkap oleh Wali Kelas sebagai dasar laporan ketidakhadiran di Rapor</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Total Hari Efektif Tercatat: {{ isset($riwayat_absensi_harian) ? $riwayat_absensi_harian->count() : 0 }} Hari
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-14 text-center">No</th>
                            <th class="px-5 py-3.5">Hari & Tanggal</th>
                            <th class="px-5 py-3.5">Kelas</th>
                            <th class="px-5 py-3.5">Dicatat Oleh</th>
                            <th class="px-5 py-3.5 text-center">Status Kehadiran</th>
                            <th class="px-5 py-3.5">Keterangan Wali Kelas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @if(isset($riwayat_absensi_harian) && $riwayat_absensi_harian->count() > 0)
                            @foreach($riwayat_absensi_harian as $item)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-2.5 py-1 rounded-md bg-slate-100 text-slate-700 text-xs font-semibold">{{ $namaKelas }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        {{ $item->guru->nama ?? ($wallas->guru->nama ?? 'Wali Kelas') }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($item->status == 'h')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Hadir
                                            </span>
                                        @elseif($item->status == 's')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-notes-medical mr-1.5 text-[10px]"></i> Sakit
                                            </span>
                                        @elseif($item->status == 'i')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-envelope-open mr-1.5 text-[10px]"></i> Izin
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-triangle-exclamation mr-1.5 text-[10px]"></i> Tanpa Keterangan (Alpa)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-xs text-slate-500">
                                        {{ $item->keterangan ?: '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-clipboard-user text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Presensi Harian Wali Kelas</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data presensi harian akan muncul setelah Wali Kelas menginput daftar hadir kelas.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <!-- TAB 1: JADWAL PELAJARAN HARI INI & MINGGUAN -->
        @if(isset($jadwal_hari_ini) && $jadwal_hari_ini->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-emerald-200 overflow-hidden mb-8">
                <div class="px-6 py-4 bg-emerald-50/60 border-b border-emerald-200 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div class="flex items-center gap-2.5">
                        <span class="w-8 h-8 rounded-lg bg-emerald-600 text-white flex items-center justify-center text-sm">
                            <i class="fa-solid fa-calendar-day"></i>
                        </span>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800">Jadwal Pelajaran Hari Ini ({{ $hari_ini_label }})</h3>
                            <p class="text-xs text-slate-500">Status kehadiran guru pengajar, materi hari ini, dan presensi ananda di kelas</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                <th class="px-5 py-3 w-12 text-center">No</th>
                                <th class="px-5 py-3">Waktu</th>
                                <th class="px-5 py-3">Mata Pelajaran</th>
                                <th class="px-5 py-3">Guru Pengajar</th>
                                <th class="px-5 py-3">Materi Hari Ini</th>
                                <th class="px-5 py-3 text-center">Status Guru</th>
                                <th class="px-5 py-3 text-center">Presensi Siswa</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @php $prevSelesaiHariIni = null; @endphp
                            @foreach($jadwal_hari_ini as $j)
                                @php
                                    $ag = $absensi_guru_hari_ini[$j->id] ?? null;
                                    $as = $absensi_siswa_hari_ini[$j->id] ?? null;
                                    $mulaiCur = $j->jam_pelajaran->jam_mulai ?? null;
                                    $selesaiCur = $j->jam_pelajaran->jam_selesai ?? null;
                                    $jedaIstirahat = $prevSelesaiHariIni ? \App\Models\jam_pelajaran::deteksiJedaIstirahat($prevSelesaiHariIni, $mulaiCur) : null;
                                    $prevSelesaiHariIni = $selesaiCur;
                                @endphp
                                @if($jedaIstirahat)
                                    <tr class="bg-amber-50/70">
                                        <td class="px-5 py-2.5 text-center text-amber-600"><i class="fa-solid fa-mug-hot"></i></td>
                                        <td class="px-5 py-2.5 font-mono text-xs font-bold text-amber-800 whitespace-nowrap">
                                            {{ $jedaIstirahat['mulai'] }} - {{ $jedaIstirahat['selesai'] }} WIB
                                        </td>
                                        <td colspan="5" class="px-5 py-2.5 text-xs font-bold text-amber-800">
                                            <i class="fa-solid fa-mug-saucer mr-1"></i> JAM ISTIRAHAT ({{ $jedaIstirahat['durasi'] }} Menit)
                                        </td>
                                    </tr>
                                @endif
                                <tr class="hover:bg-slate-50/60">
                                    <td class="px-5 py-3.5 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-3.5 font-mono text-xs font-bold text-slate-700 whitespace-nowrap">
                                        {{ substr($j->jam_pelajaran->jam_mulai ?? '', 0, 5) }} - {{ substr($j->jam_pelajaran->jam_selesai ?? '', 0, 5) }} WIB
                                    </td>
                                    <td class="px-5 py-3.5 font-bold text-slate-800">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</td>
                                    <td class="px-5 py-3.5 text-slate-700">{{ $j->guru->nama ?? '-' }}</td>
                                    <td class="px-5 py-3.5 text-xs">
                                        @if($ag && $ag->materi)
                                            <span class="font-semibold text-emerald-800">{{ $ag->materi }}</span>
                                        @else
                                            <span class="text-slate-400 italic">Belum diisi</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        @if($ag)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Hadir ({{ substr($ag->jam_masuk, 0, 5) }})
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                Terjadwal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        @if($as)
                                            @if($as->status == 'h')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Hadir</span>
                                            @elseif($as->status == 's')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">Sakit</span>
                                            @elseif($as->status == 'i')
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">Izin</span>
                                            @else
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">Alpa</span>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <!-- Jadwal Pelajaran Mingguan Lengkap -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Jadwal Mata Pelajaran Mingguan ({{ $namaKelas }})</h3>
                    <p class="text-xs text-slate-500">Susunan jadwal belajar dari hari Senin hingga Sabtu</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Total {{ $jadwal->count() }} Sesi Pelajaran / Minggu
                </span>
            </div>

            <div class="p-6">
                @if($jadwal->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $hari)
                            @php
                                $list_hari = isset($jadwal_per_hari) ? $jadwal_per_hari->get($hari, collect()) : $jadwal->filter(fn($item) => strtolower($item->hari) === $hari);
                            @endphp
                            @if($list_hari->count() > 0)
                                <div class="border border-slate-200 rounded-xl overflow-hidden flex flex-col">
                                    <div class="px-4 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                                        <span class="text-xs font-extrabold uppercase tracking-wider text-slate-800 flex items-center gap-2">
                                            <i class="fa-solid fa-calendar-day text-emerald-600"></i> Hari {{ ucfirst($hari) }}
                                        </span>
                                        <span class="text-[11px] font-semibold text-slate-500">{{ $list_hari->count() }} Mapel</span>
                                    </div>
                                    <div class="divide-y divide-slate-100">
                                        @php $prevSelesaiMingguan = null; @endphp
                                        @foreach($list_hari as $j)
                                            @php
                                                $mulaiM = $j->jam_pelajaran->jam_mulai ?? null;
                                                $selesaiM = $j->jam_pelajaran->jam_selesai ?? null;
                                                $jedaM = $prevSelesaiMingguan ? \App\Models\jam_pelajaran::deteksiJedaIstirahat($prevSelesaiMingguan, $mulaiM) : null;
                                                $prevSelesaiMingguan = $selesaiM;
                                                $jmlJpItem = $j->getJumlahJp();
                                            @endphp
                                            @if($jedaM)
                                                <div class="px-4 py-2.5 bg-amber-50/80 flex items-center justify-between text-xs font-bold text-amber-800">
                                                    <span><i class="fa-solid fa-mug-hot mr-1.5 text-amber-600"></i> JAM ISTIRAHAT</span>
                                                    <span class="font-mono">{{ $jedaM['mulai'] }} - {{ $jedaM['selesai'] }} ({{ $jedaM['durasi'] }} Menit)</span>
                                                </div>
                                            @endif
                                            <div class="p-4 hover:bg-slate-50/60 transition-colors flex items-center justify-between gap-3">
                                                <div>
                                                    <h4 class="text-sm font-bold text-slate-800">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</h4>
                                                    <p class="text-xs text-slate-500 mt-0.5">
                                                        <i class="fa-solid fa-chalkboard-user text-[10px] mr-1 text-slate-400"></i> {{ $j->guru->nama ?? '-' }}
                                                    </p>
                                                </div>
                                                <div class="text-right flex-shrink-0 flex flex-col items-end gap-1">
                                                    <span class="inline-block px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 border border-emerald-200 font-mono text-xs font-bold">
                                                        {{ substr($j->jam_pelajaran->jam_mulai ?? '-', 0, 5) }} - {{ substr($j->jam_pelajaran->jam_selesai ?? '-', 0, 5) }}
                                                    </span>
                                                    @if($jmlJpItem > 0)
                                                        <span class="text-[10px] font-semibold text-slate-400">{{ $jmlJpItem }} JP</span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="py-12 text-center text-slate-500">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-calendar-xmark text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Belum Ada Jadwal Pelajaran</h4>
                        <p class="text-xs text-slate-400 mt-1">Jadwal pelajaran untuk kelas {{ $namaKelas }} belum diatur oleh Admin Akademik.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</x-siakad-layout>

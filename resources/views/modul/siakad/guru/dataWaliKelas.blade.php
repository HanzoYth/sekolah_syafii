<x-siakad-layout 
    title="Data Siswa Wali Kelas" 
    description="Daftar siswa dan jadwal kelas yang berada di bawah perwalian Anda." 
    position="Guru Wali Kelas" 
    initials="GR">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Data Siswa Perwalian</span>
        </li>
    </x-slot>

    @if($wallas)
        <!-- Top Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
                <div class="p-3 bg-violet-50 text-violet-600 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-school text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-slate-500 truncate">Rombongan Belajar</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 break-words leading-snug mt-0.5">{{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                    <p class="text-xs text-slate-400 mt-1 truncate">Kelas perwalian binaan</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex items-start space-x-4 min-w-0">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg flex-shrink-0">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-slate-500 truncate">Total Siswa Binaan</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ count($siswa) }}</h3>
                    <p class="text-xs text-slate-400 mt-1 truncate">
                        {{ $siswa->where('gender', 'l')->count() }} Laki-laki • {{ $siswa->where('gender', 'p')->count() }} Perempuan
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 flex flex-col justify-between sm:col-span-2 lg:col-span-1">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-2">Aksi Singkat Walas</p>
                    <div class="grid grid-cols-3 gap-2">
                        <a href="/sk/absensi-walas" class="inline-flex items-center justify-center px-2 py-2 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 text-xs font-semibold transition-colors text-center truncate">
                            <i class="fa-solid fa-clipboard-user mr-1.5 flex-shrink-0"></i> <span class="truncate">Absen</span>
                        </a>
                        <a href="/sk/rapor-walas?tab=nilai" class="inline-flex items-center justify-center px-2 py-2 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 text-xs font-semibold transition-colors text-center truncate">
                            <i class="fa-solid fa-sliders mr-1.5 flex-shrink-0"></i> <span class="truncate">Nilai</span>
                        </a>
                        <a href="/sk/rapor-walas" class="inline-flex items-center justify-center px-2 py-2 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200 text-xs font-semibold transition-colors text-center truncate">
                            <i class="fa-solid fa-file-contract mr-1.5 flex-shrink-0"></i> <span class="truncate">Rapor</span>
                        </a>
                    </div>
                </div>
                <p class="text-[11px] text-slate-400 mt-2 truncate">Kelola kehadiran, nilai mapel, dan rapor rombel</p>
            </div>
        </div>

        <!-- Tabel Siswa -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Daftar Anggota Rombel: {{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                    <p class="text-sm text-slate-500">Daftar seluruh peserta didik terdaftar di kelas perwalian Anda</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    <i class="fa-solid fa-user-check mr-1.5 text-xs"></i> {{ count($siswa) }} Siswa Aktif
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
                            <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if(count($siswa) > 0)
                            @foreach($siswa as $s)
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-6 py-4 text-sm text-slate-500 text-center font-medium">{{ $loop->iteration }}</td>
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
                                        @if(strtolower($s->gender) == 'p' || strtolower($s->gender) == 'perempuan')
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
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-circle-check mr-1.5 text-[10px]"></i> Aktif
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-users-slash text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-medium text-slate-700">Belum Ada Siswa</h4>
                                    <p class="text-xs text-slate-400 mt-1">Belum ada data siswa yang ditempatkan pada kelas rombel ini.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Jadwal Pelajaran & Monitoring Guru Hari Ini untuk Kelas Binaan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                        <i class="fa-solid fa-calendar-day"></i>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Jadwal & Kehadiran Guru di Kelas Hari Ini</h3>
                        <p class="text-xs text-slate-500">{{ $hari_ini_indonesia }} • Rombel {{ $wallas->ruangKelas->nama_ruang ?? '-' }}</p>
                    </div>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    <i class="fa-solid fa-book-open mr-1.5 text-xs"></i> {{ $jadwal_hari_ini->count() }} Sesi Pelajaran Hari Ini
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-12 text-center">No</th>
                            <th class="px-5 py-3.5">Jam Pelajaran</th>
                            <th class="px-5 py-3.5">Mata Pelajaran</th>
                            <th class="px-5 py-3.5">Guru Pengajar</th>
                            <th class="px-5 py-3.5">Jurnal / Materi Hari Ini</th>
                            <th class="px-5 py-3.5 text-center">Status Masuk Guru</th>
                            <th class="px-5 py-3.5 text-center">Presensi Siswa</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @if($jadwal_hari_ini->count() > 0)
                            @php $prevSelesaiWalasHariIni = null; @endphp
                            @foreach($jadwal_hari_ini as $j)
                                @php
                                    $absen_guru = $absensi_mengajar_hari_ini[$j->id] ?? null;
                                    $siswa_absen = $absensi_siswa_hari_ini[$j->id] ?? null;
                                    
                                    $jam_mulai_str = $j->jam_pelajaran->jam_mulai ?? '07:00:00';
                                    $jam_selesai_str = $j->jam_pelajaran->jam_selesai ?? null;
                                    $jedaWalas = $prevSelesaiWalasHariIni ? \App\Models\jam_pelajaran::deteksiJedaIstirahat($prevSelesaiWalasHariIni, $jam_mulai_str) : null;
                                    $prevSelesaiWalasHariIni = $jam_selesai_str;

                                    $jam_mulai = \Carbon\Carbon::parse($jam_mulai_str);
                                    $jam_batas = $jam_mulai->copy()->addMinutes(5);
                                    $sekarang = now();
                                    $lewat_waktu = $sekarang->format('H:i:s') > $jam_batas->format('H:i:s');
                                @endphp
                                @if($jedaWalas)
                                    <tr class="bg-amber-50/70">
                                        <td class="px-5 py-2.5 text-center text-amber-600"><i class="fa-solid fa-mug-hot"></i></td>
                                        <td class="px-5 py-2.5 font-mono text-xs font-bold text-amber-800 whitespace-nowrap">
                                            {{ $jedaWalas['mulai'] }} - {{ $jedaWalas['selesai'] }} WIB
                                        </td>
                                        <td colspan="5" class="px-5 py-2.5 text-xs font-bold text-amber-800">
                                            <i class="fa-solid fa-mug-saucer mr-1"></i> JAM ISTIRAHAT ({{ $jedaWalas['durasi'] }} Menit)
                                        </td>
                                    </tr>
                                @endif
                                <tr class="hover:bg-slate-50/60 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4 font-medium text-slate-700 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full {{ $absen_guru ? 'bg-emerald-500' : ($lewat_waktu ? 'bg-rose-500' : 'bg-slate-300') }}"></span>
                                            <span>{{ substr($j->jam_pelajaran->jam_mulai ?? '', 0, 5) }} - {{ substr($j->jam_pelajaran->jam_selesai ?? '', 0, 5) }} WIB</span>
                                        </div>
                                        <span class="text-[11px] text-slate-400 ml-4 block">Batas toleransi: {{ $jam_batas->format('H:i') }} WIB</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="font-bold text-slate-800 block">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex items-center space-x-2.5">
                                            <div class="w-7 h-7 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                {{ substr($j->guru->nama ?? 'G', 0, 2) }}
                                            </div>
                                            <span class="font-medium text-slate-700">{{ $j->guru->nama ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        @if($absen_guru && $absen_guru->materi)
                                            <span class="font-semibold text-slate-800 block text-xs">{{ $absen_guru->materi }}</span>
                                            @if($absen_guru->catatan)
                                                <span class="text-[11px] text-slate-500 block mt-0.5 italic">"{{ $absen_guru->catatan }}"</span>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400 italic">Belum diisi</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($absen_guru)
                                            @if($absen_guru->status == 'tepat_waktu')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                    <i class="fa-solid fa-circle-check mr-1.5 text-[11px]"></i> Tepat Waktu ({{ substr($absen_guru->jam_masuk, 0, 5) }} WIB)
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                    <i class="fa-solid fa-clock-rotate-left mr-1.5 text-[11px]"></i> Terlambat ({{ substr($absen_guru->jam_masuk, 0, 5) }} WIB)
                                                </span>
                                            @endif
                                        @else
                                            @if($lewat_waktu)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                    <i class="fa-solid fa-triangle-exclamation mr-1.5 text-[11px]"></i> Belum Masuk Kelas
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                                    <i class="fa-regular fa-clock mr-1.5 text-[11px]"></i> Menunggu Jam Masuk
                                                </span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($siswa_absen && $siswa_absen->count() > 0)
                                            <div class="inline-flex items-center gap-1.5 text-xs font-medium">
                                                <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold">{{ $siswa_absen->where('status', 'h')->count() }} H</span>
                                                <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 font-bold">{{ $siswa_absen->where('status', 's')->count() }} S</span>
                                                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-bold">{{ $siswa_absen->where('status', 'i')->count() }} I</span>
                                                <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold">{{ $siswa_absen->where('status', 'a')->count() }} A</span>
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400 italic">Belum diabsen</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                    <i class="fa-solid fa-mug-hot text-2xl text-slate-300 mb-2 block"></i>
                                    <p class="text-sm font-semibold text-slate-700">Tidak Ada Jadwal Pelajaran Hari Ini</p>
                                    <p class="text-xs text-slate-400 mt-1">Tidak ada mata pelajaran yang dijadwalkan untuk kelas binaan Anda pada hari {{ $hari_ini_indonesia }}.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Jadwal Mengajar Mingguan Kelas Binaan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-base font-semibold text-slate-800">Jadwal Mata Pelajaran Mingguan: {{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h3>
                <p class="text-sm text-slate-500">Susunan agenda pelajaran mingguan lengkap untuk rombongan belajar Anda</p>
            </div>
            
            <div class="p-6 space-y-6">
                @php
                    $adaJadwal = false;
                @endphp
                @foreach(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $hari)
                    @if(isset($jadwal_mingguan[$hari]) && $jadwal_mingguan[$hari]->count() > 0)
                        @php $adaJadwal = true; @endphp
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <div class="px-5 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                                <span class="text-sm font-bold text-slate-800 uppercase tracking-wide flex items-center">
                                    <i class="fa-solid fa-calendar-day text-emerald-600 mr-2"></i> Hari {{ ucfirst($hari) }}
                                </span>
                                <span class="text-xs text-slate-500 font-medium">
                                    {{ $jadwal_mingguan[$hari]->count() }} Pelajaran
                                </span>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-slate-50/40 border-b border-slate-100 text-xs text-slate-500">
                                            <th class="px-5 py-2.5 w-12 text-center">No</th>
                                            <th class="px-5 py-2.5">Waktu</th>
                                            <th class="px-5 py-2.5">Mata Pelajaran</th>
                                            <th class="px-5 py-2.5">Guru Pengajar</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @php $prevSelesaiWalasMingguan = null; @endphp
                                        @foreach($jadwal_mingguan[$hari] as $j)
                                            @php
                                                $mulaiWm = $j->jam_pelajaran->jam_mulai ?? null;
                                                $selesaiWm = $j->jam_pelajaran->jam_selesai ?? null;
                                                $jedaWm = $prevSelesaiWalasMingguan ? \App\Models\jam_pelajaran::deteksiJedaIstirahat($prevSelesaiWalasMingguan, $mulaiWm) : null;
                                                $prevSelesaiWalasMingguan = $selesaiWm;
                                            @endphp
                                            @if($jedaWm)
                                                <tr class="bg-amber-50/70 text-xs font-bold text-amber-800">
                                                    <td class="px-5 py-2 text-center text-amber-600"><i class="fa-solid fa-mug-hot"></i></td>
                                                    <td class="px-5 py-2 font-mono">{{ $jedaWm['mulai'] }} - {{ $jedaWm['selesai'] }}</td>
                                                    <td colspan="2" class="px-5 py-2"><i class="fa-solid fa-mug-saucer mr-1"></i> JAM ISTIRAHAT ({{ $jedaWm['durasi'] }} Menit)</td>
                                                </tr>
                                            @endif
                                            <tr class="hover:bg-slate-50/50 text-sm">
                                                <td class="px-5 py-3 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                                <td class="px-5 py-3 font-medium text-slate-700">
                                                    <i class="fa-regular fa-clock text-slate-400 mr-1 text-xs"></i>
                                                    {{ substr($j->jam_pelajaran->jam_mulai ?? '-', 0, 5) }} - {{ substr($j->jam_pelajaran->jam_selesai ?? '-', 0, 5) }}
                                                </td>
                                                <td class="px-5 py-3 font-semibold text-slate-800">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</td>
                                                <td class="px-5 py-3 text-slate-600">{{ $j->guru->nama ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if(!$adaJadwal)
                    <div class="p-8 text-center text-slate-500">
                        <i class="fa-solid fa-calendar-xmark text-3xl text-slate-300 mb-2 block"></i>
                        <p class="text-sm font-medium text-slate-700">Belum Ada Jadwal Mingguan</p>
                        <p class="text-xs text-slate-400 mt-1">Jadwal pelajaran kelas binaan ini belum diset oleh Admin.</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center">
            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                <i class="fa-solid fa-ban text-2xl"></i>
            </div>
            <h3 class="text-base font-semibold text-slate-800">Anda Bukan Wali Kelas</h3>
            <p class="text-sm text-slate-500 mt-1">Menu ini khusus diperuntukkan bagi Guru yang ditugaskan sebagai Wali Kelas rombel aktif.</p>
            <a href="/sk/dsg" class="inline-flex items-center text-xs font-semibold px-4 py-2 mt-4 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition-colors">
                Kembali ke Dashboard
            </a>
        </div>
    @endif
</x-siakad-layout>

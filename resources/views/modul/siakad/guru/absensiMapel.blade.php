<x-siakad-layout 
    title="Absensi Mata Pelajaran" 
    description="Kelola jadwal sesi mengajar harian, rekam presensi siswa, dan pantau waktu masuk kelas." 
    position="Guru Pengajar" 
    initials="GP">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Absensi Mata Pelajaran</span>
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

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg mt-0.5"></i>
            <div>
                <p class="font-semibold text-sm">Peringatan!</p>
                <p class="text-sm mt-0.5">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Top Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <form method="GET" action="/sk/ass" class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Jadwal Mengajar Harian</h3>
                    <p class="text-xs text-slate-500">{{ $hari_indonesia }}</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" 
                           class="pl-9 pr-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 transition-colors w-full sm:w-auto">
                </div>
                <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-2 shadow-sm">
                    <i class="fa-solid fa-filter text-xs"></i> Terapkan
                </button>
            </div>
        </form>
    </div>

    <!-- TABEL DAFTAR MATA PELAJARAN HARI INI -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-800">Daftar Sesi Mengajar Anda</h3>
                <p class="text-xs text-slate-500">Pilih salah satu sesi di bawah untuk membuka form absensi siswa dan mencatat presensi masuk kelas</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                <i class="fa-solid fa-book-open mr-1.5 text-xs"></i> {{ $jadwal_hari_ini->count() }} Sesi Mengajar
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Jam Pelajaran</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Kelas / Ruang</th>
                        <th class="px-5 py-3.5 text-center">Status Waktu</th>
                        <th class="px-5 py-3.5 text-center">Kehadiran Guru</th>
                        <th class="px-5 py-3.5 text-center">Presensi Siswa</th>
                        <th class="px-5 py-3.5 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @if($jadwal_hari_ini->count() > 0)
                        @foreach($jadwal_hari_ini as $j)
                            @php
                                $absen = $absensi_guru_semua->get($j->id);
                                $siswa_absen = $absensi_siswa_semua->get($j->id, collect());
                                $is_selected = ($jadwal_id == $j->id);

                                $jam_mulai_str = $j->jam_pelajaran->jam_mulai ?? '07:00:00';
                                $jam_selesai_str = $j->jam_pelajaran->jam_selesai ?? '08:30:00';
                                $jam_mulai = \Carbon\Carbon::parse($jam_mulai_str);
                                $jam_buka = $jam_mulai->copy()->subMinutes(5);
                                $jam_batas = $jam_mulai->copy()->addMinutes(5);
                                $jam_selesai = \Carbon\Carbon::parse($jam_selesai_str);
                                $sekarang = now();
                                $is_today = ($tanggal === date('Y-m-d'));

                                // Hitung status sesi waktu
                                $status_waktu = 'mendatang';
                                if ($is_today) {
                                    if ($sekarang->format('H:i:s') < $jam_buka->format('H:i:s')) {
                                        $status_waktu = 'belum_buka';
                                    } elseif ($sekarang->format('H:i:s') <= $jam_selesai->format('H:i:s')) {
                                        $status_waktu = 'berlangsung';
                                    } else {
                                        $status_waktu = 'selesai';
                                    }
                                } elseif ($tanggal < date('Y-m-d')) {
                                    $status_waktu = 'lewat';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/70 transition-colors {{ $is_selected ? 'bg-emerald-50/40 border-l-4 border-l-emerald-600' : '' }}">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-1.5 font-bold text-slate-800">
                                        <i class="fa-regular fa-clock text-slate-400 text-xs mr-1"></i>
                                        <span>{{ substr($jam_mulai_str, 0, 5) }} - {{ substr($jam_selesai_str, 0, 5) }} WIB</span>
                                    </div>
                                    <span class="text-[11px] text-amber-700 font-medium block mt-0.5">
                                        Batas tepat: {{ $jam_batas->format('H:i') }} WIB (+5 mnt)
                                    </span>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-bold text-slate-800 block text-base">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</span>
                                    <span class="text-xs text-slate-400">Kode: MAPEL-{{ $j->mapel_id }}</span>
                                    @if($absen && $absen->materi)
                                        <div class="mt-1.5 inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-emerald-50 border border-emerald-100 text-[11px] text-emerald-800 font-medium max-w-xs truncate" title="Materi: {{ $absen->materi }}">
                                            <i class="fa-solid fa-book-bookmark text-[10px] text-emerald-600"></i>
                                            <span class="truncate">{{ $absen->materi }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        <i class="fa-solid fa-users text-[10px] mr-1.5 text-slate-500"></i>
                                        {{ $j->kelas->nama_kelas ?? ($j->kelas->nama_ruang ?? '-') }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($status_waktu == 'belum_buka')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 border border-slate-200" title="Buka 5 menit sebelum jam mulai">
                                            <i class="fa-solid fa-lock text-[10px] mr-1 text-slate-400"></i> Belum Buka ({{ $jam_buka->format('H:i') }})
                                        </span>
                                    @elseif($status_waktu == 'berlangsung')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200 animate-pulse">
                                            <i class="fa-solid fa-circle-play text-[10px] mr-1"></i> Sedang Berlangsung
                                        </span>
                                    @elseif($status_waktu == 'selesai')
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                            <i class="fa-solid fa-flag-checkered text-[10px] mr-1"></i> Jam Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-50 text-slate-600 border border-slate-200">
                                            <i class="fa-regular fa-calendar text-[10px] mr-1"></i> Terjadwal
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($absen)
                                        @if($absen->status == 'tepat_waktu')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check mr-1.5 text-xs"></i> Tepat Waktu ({{ substr($absen->jam_masuk, 0, 5) }} WIB)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-clock-rotate-left mr-1.5 text-xs"></i> Terlambat ({{ substr($absen->jam_masuk, 0, 5) }} WIB)
                                            </span>
                                        @endif
                                    @else
                                        @if($is_today && $sekarang->format('H:i:s') > $jam_batas->format('H:i:s'))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                <i class="fa-solid fa-triangle-exclamation mr-1.5 text-xs"></i> Belum Masuk Kelas
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                <i class="fa-regular fa-clock mr-1.5 text-xs"></i> Belum Absen
                                            </span>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($siswa_absen->count() > 0)
                                        <div class="inline-flex items-center gap-1.5 text-xs font-semibold">
                                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold" title="Hadir">{{ $siswa_absen->where('status', 'h')->count() }} H</span>
                                            <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 font-bold" title="Sakit">{{ $siswa_absen->where('status', 's')->count() }} S</span>
                                            <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-bold" title="Izin">{{ $siswa_absen->where('status', 'i')->count() }} I</span>
                                            <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold" title="Alpa">{{ $siswa_absen->where('status', 'a')->count() }} A</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum diabsen</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($is_selected)
                                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-lg bg-emerald-600 text-white text-xs font-bold shadow-sm">
                                            <i class="fa-solid fa-check mr-1.5"></i> Terbuka
                                        </span>
                                    @else
                                        <a href="/sk/ass?tanggal={{ $tanggal }}&jadwal_id={{ $j->id }}#detail-absensi" 
                                           class="inline-flex items-center px-3.5 py-1.5 rounded-lg {{ $absen ? 'bg-slate-100 hover:bg-slate-200 text-slate-700 border border-slate-300' : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200' }} text-xs font-bold transition-all shadow-sm">
                                            <i class="fa-solid {{ $absen ? 'fa-eye' : 'fa-clipboard-user' }} mr-1.5"></i>
                                            {{ $absen ? 'Lihat Detail' : 'Buka Absensi' }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-calendar-xmark text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-bold text-slate-700">Tidak Ada Jadwal Mengajar Hari Ini</h4>
                                <p class="text-xs text-slate-400 mt-1">Anda tidak memiliki agenda mengajar pada hari {{ $hari_indonesia }}.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- DETAIL DAN FORM ABSENSI (Hanya muncul jika jadwal dipilih) -->
    <div id="detail-absensi">
        @if($jadwal_terpilih)
            <!-- Proteksi Anti-Kecurangan: Jika Absen Dibuka Terlalu Dini -->
            @if($toleransi_info['terlalu_dini'])
                <div class="bg-amber-50 rounded-xl border border-amber-200 p-8 text-center mb-8 shadow-sm">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-2xl shadow-sm">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h3 class="text-lg font-bold text-amber-900">Waktu Presensi Sesi Ini Belum Dibuka</h3>
                    <p class="text-sm text-amber-800 max-w-xl mx-auto mt-2 leading-relaxed">
                        Jam pelajaran <strong>{{ $jadwal_terpilih->mata_pelajaran->nama_mapel ?? '-' }}</strong> di kelas <strong>{{ $jadwal_terpilih->kelas->nama_kelas ?? ($jadwal_terpilih->kelas->nama_ruang ?? '-') }}</strong> terjadwal mulai pukul <strong>{{ $toleransi_info['jam_mulai'] }} WIB</strong>.
                    </p>
                    <div class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-lg bg-white border border-amber-300 text-amber-900 text-xs font-semibold">
                        <i class="fa-solid fa-shield-halved text-amber-600"></i>
                        <span>Sistem hanya mengizinkan presensi mulai pukul <strong>{{ $toleransi_info['jam_buka'] }} WIB</strong> (5 menit sebelum jam mulai) untuk memastikan guru sudah berada di lingkungan kelas.</span>
                    </div>
                </div>
            @else
                <!-- Kartu Status Presensi Masuk Guru -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
                    <div class="px-6 py-4 bg-slate-50/80 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-800 flex items-center justify-center text-sm font-bold">
                                <i class="fa-solid fa-chalkboard-user"></i>
                            </span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">
                                    {{ $jadwal_terpilih->mata_pelajaran->nama_mapel ?? 'Mata Pelajaran' }} 
                                    <span class="text-slate-400 font-normal">•</span> 
                                    Kelas {{ $jadwal_terpilih->kelas->nama_kelas ?? ($jadwal_terpilih->kelas->nama_ruang ?? '-') }}
                                </h4>
                                <p class="text-xs text-slate-500">
                                    Waktu Terjadwal: {{ $toleransi_info['jam_mulai'] }} - {{ $toleransi_info['jam_selesai'] }} WIB
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-500 font-medium">Batas Toleransi Tepat Waktu:</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                                <i class="fa-solid fa-stopwatch mr-1.5 text-[11px]"></i> {{ $toleransi_info['jam_batas'] }} WIB (+5 mnt)
                            </span>
                        </div>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Status Presensi Masuk Guru -->
                        <div class="md:col-span-2 p-5 rounded-xl border {{ $absen_guru ? ($absen_guru->status == 'tepat_waktu' ? 'bg-emerald-50/60 border-emerald-200' : 'bg-amber-50/60 border-amber-200') : 'bg-slate-50 border-slate-200' }} flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                                        <i class="fa-solid fa-user-clock mr-1.5"></i> Status Presensi Masuk Guru
                                    </span>
                                    @if($absen_guru)
                                        @if($absen_guru->status == 'tepat_waktu')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                <i class="fa-solid fa-circle-check mr-1.5"></i> Tepat Waktu
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                                <i class="fa-solid fa-clock-rotate-left mr-1.5"></i> Terlambat Masuk
                                            </span>
                                        @endif
                                    @else
                                        @if($toleransi_info['estimasi_status'] == 'tepat_waktu')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                                                <i class="fa-solid fa-info-circle mr-1.5"></i> Belum Absen Masuk (Tepat Waktu)
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                                <i class="fa-solid fa-triangle-exclamation mr-1.5"></i> Belum Absen Masuk (Terlambat)
                                            </span>
                                        @endif
                                    @endif
                                </div>

                                <div class="mt-2">
                                    @if($absen_guru)
                                        <p class="text-sm font-semibold text-slate-800">
                                            Presensi masuk tercatat pada pukul <span class="font-mono text-emerald-700 font-bold">{{ substr($absen_guru->jam_masuk, 0, 5) }} WIB</span>.
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            @if($absen_guru->status == 'tepat_waktu')
                                                Kehadiran Anda sesuai jadwal mengajar dengan toleransi waktu 5 menit (batas {{ $toleransi_info['jam_batas'] }} WIB).
                                            @else
                                                Kehadiran Anda tercatat melewati batas toleransi 5 menit (batas maksimal {{ $toleransi_info['jam_batas'] }} WIB).
                                            @endif
                                        </p>
                                    @else
                                        <p class="text-sm font-medium text-slate-700">
                                            Presensi masuk kelas Anda akan direkam otomatis saat Anda menekan tombol <strong class="text-slate-900">Simpan Absensi Siswa & Kehadiran Guru</strong> di bawah.
                                        </p>
                                        <p class="text-xs text-slate-500 mt-1">
                                            Toleransi keterlambatan 5 menit dari jadwal mulai (<span class="font-semibold">{{ $toleransi_info['jam_mulai'] }}</span> s/d <span class="font-semibold">{{ $toleransi_info['jam_batas'] }} WIB</span>).
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-t border-slate-200/80 flex items-center justify-between text-xs text-slate-500">
                                <span>Tanggal Pelajaran: <strong>{{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</strong></span>
                                <span>Ruang: <strong>{{ $jadwal_terpilih->kelas->nama_kelas ?? ($jadwal_terpilih->kelas->nama_ruang ?? '-') }}</strong></span>
                            </div>
                        </div>

                        <!-- Info Rangkuman Kehadiran Siswa -->
                        <div class="p-5 rounded-xl border border-slate-200 bg-white flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block mb-3">
                                    <i class="fa-solid fa-chart-pie mr-1.5"></i> Ringkasan Siswa
                                </span>
                                <div class="grid grid-cols-2 gap-2 text-center">
                                    <div class="p-2.5 rounded-lg bg-emerald-50 border border-emerald-100">
                                        <span class="block text-xl font-bold text-emerald-700">{{ $rekap_siswa['hadir'] }}</span>
                                        <span class="text-[11px] font-semibold text-emerald-800 uppercase">Hadir</span>
                                    </div>
                                    <div class="p-2.5 rounded-lg bg-amber-50 border border-amber-100">
                                        <span class="block text-xl font-bold text-amber-700">{{ $rekap_siswa['sakit'] }}</span>
                                        <span class="text-[11px] font-semibold text-amber-800 uppercase">Sakit</span>
                                    </div>
                                    <div class="p-2.5 rounded-lg bg-blue-50 border border-blue-100">
                                        <span class="block text-xl font-bold text-blue-700">{{ $rekap_siswa['izin'] }}</span>
                                        <span class="text-[11px] font-semibold text-blue-800 uppercase">Izin</span>
                                    </div>
                                    <div class="p-2.5 rounded-lg bg-rose-50 border border-rose-100">
                                        <span class="block text-xl font-bold text-rose-700">{{ $rekap_siswa['alpa'] }}</span>
                                        <span class="text-[11px] font-semibold text-rose-800 uppercase">Alpa</span>
                                    </div>
                                </div>
                            </div>
                            <p class="text-[11px] text-slate-400 text-center mt-3">Total Peserta: {{ $rekap_siswa['total'] }} Siswa</p>
                        </div>
                    </div>
                </div>

                <!-- Form Absensi Siswa -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
                    <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Presensi Siswa: {{ $jadwal_terpilih->mata_pelajaran->nama_mapel ?? '-' }}</h3>
                            <p class="text-xs text-slate-500">Kelas {{ $jadwal_terpilih->kelas->nama_kelas ?? ($jadwal_terpilih->kelas->nama_ruang ?? '-') }} • Tanggal {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</p>
                        </div>

                        @if(count($siswa) > 0)
                        <button type="button" onclick="setSemuaHadir()" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-semibold transition-colors">
                            <i class="fa-solid fa-check-double mr-1.5"></i> Tandai Semua Hadir
                        </button>
                        @endif
                    </div>

                    <form action="/sk/simpan-absensi-mapel" method="POST">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">

                        <!-- Input Jurnal Mengajar / Materi Harian -->
                        <div class="p-6 bg-emerald-50/40 border-b border-slate-200">
                            <div class="flex items-center gap-2 mb-3">
                                <i class="fa-solid fa-book-open-reader text-emerald-600 text-sm"></i>
                                <h4 class="text-sm font-bold text-slate-800">Jurnal Mengajar & Materi Pembelajaran Harian</h4>
                                <span class="text-[11px] px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-semibold">Terintegrasi Walas & Admin</span>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                        Pokok Bahasan / Materi yang Diajarkan <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="materi" value="{{ $absen_guru->materi ?? '' }}" required
                                           placeholder="Contoh: Bab 3 - Persamaan Linear & Latihan Soal"
                                           class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg text-slate-800 font-medium focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                                        Catatan / Evaluasi Kegiatan Belajar (Opsional)
                                    </label>
                                    <input type="text" name="catatan_jurnal" value="{{ $absen_guru->catatan ?? '' }}"
                                           placeholder="Contoh: Siswa aktif berdiskusi, tugas dikumpulkan pekan depan"
                                           class="w-full px-3.5 py-2 text-sm bg-white border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                        <th class="px-5 py-3.5 w-14 text-center">No</th>
                                        <th class="px-5 py-3.5">NIS</th>
                                        <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                                        <th class="px-5 py-3.5 text-center">Status Kehadiran</th>
                                        <th class="px-5 py-3.5">Keterangan Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @if(count($siswa) > 0)
                                        @foreach($siswa as $index => $s)
                                            @php
                                                $absen_siswa = $absensi_db[$s->id] ?? null;
                                                $status = $absen_siswa ? $absen_siswa->status : "h"; 
                                                $keterangan = $absen_siswa ? $absen_siswa->keterangan : "";
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
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="h" class="peer sr-only radio-hadir" {{ $status == "h" ? "checked" : "" }}>
                                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-emerald-100 peer-checked:text-emerald-800 peer-checked:border-emerald-300 transition-all">
                                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Hadir
                                                            </span>
                                                        </label>
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="s" class="peer sr-only" {{ $status == "s" ? "checked" : "" }}>
                                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-amber-100 peer-checked:text-amber-800 peer-checked:border-amber-300 transition-all">
                                                                <i class="fa-solid fa-heart-pulse mr-1 text-[10px]"></i> Sakit
                                                            </span>
                                                        </label>
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="i" class="peer sr-only" {{ $status == "i" ? "checked" : "" }}>
                                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-blue-100 peer-checked:text-blue-800 peer-checked:border-blue-300 transition-all">
                                                                <i class="fa-solid fa-envelope-open mr-1 text-[10px]"></i> Izin
                                                            </span>
                                                        </label>
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="a" class="peer sr-only" {{ $status == "a" ? "checked" : "" }}>
                                                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-semibold border border-slate-200 text-slate-600 peer-checked:bg-rose-100 peer-checked:text-rose-800 peer-checked:border-rose-300 transition-all">
                                                                <i class="fa-solid fa-xmark mr-1 text-[10px]"></i> Alpa
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-3.5">
                                                    <input type="text" name="absensi[{{ $s->id }}][keterangan]" value="{{ $keterangan }}" 
                                                           placeholder="Catatan..." 
                                                           class="w-full px-3 py-1.5 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                                    <i class="fa-solid fa-users-slash text-2xl"></i>
                                                </div>
                                                <h4 class="text-sm font-semibold text-slate-700">Belum Ada Siswa</h4>
                                                <p class="text-xs text-slate-400 mt-1">Belum ada peserta didik yang terdaftar di kelas rombel ini.</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if(count($siswa) > 0)
                        <div class="p-6 bg-slate-50/50 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="text-xs text-slate-500 flex items-center gap-2">
                                <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                                <span>Menyimpan form ini akan memperbarui status siswa dan merekam presensi jam masuk kelas Anda.</span>
                            </div>
                            <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold shadow-sm transition-all flex items-center justify-center gap-2 w-full sm:w-auto">
                                <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Absensi Siswa & Kehadiran Guru
                            </button>
                        </div>
                        @endif
                    </form>
                </div>
            @endif
        @else
            <!-- Petunjuk Saat Belum Ada Sesi yang Dipilih -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center text-slate-500">
                <i class="fa-solid fa-arrow-pointer text-2xl text-slate-300 mb-2 block"></i>
                <h4 class="text-sm font-bold text-slate-700">Pilih Sesi Mengajar</h4>
                <p class="text-xs text-slate-400 mt-1">Klik tombol <strong>Buka Absensi</strong> atau <strong>Lihat Detail</strong> pada tabel di atas untuk membuka form presensi siswa.</p>
            </div>
        @endif
    </div>

    <script>
        function setSemuaHadir() {
            document.querySelectorAll('.radio-hadir').forEach(function(radio) {
                radio.checked = true;
            });
        }
    </script>
</x-siakad-layout>

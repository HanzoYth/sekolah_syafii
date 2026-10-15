<x-siakad-layout>
    <x-slot name="title">Dashboard Guru</x-slot>
    <x-slot name="subtitle">Selamat datang kembali, {{ $guru->nama ?? 'Guru' }}.</x-slot>
    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <span class="text-slate-700">Dashboard</span>
        </li>
    </x-slot>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 sm:gap-5 mb-8">
        @if($isPengajar)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-chalkboard text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-slate-500 truncate">Kelas Diampu</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $kelas_diampu->count() }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">Kelas aktif mengajar</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-clock text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-slate-500 truncate">Jadwal Hari Ini</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $jadwal_hari_ini->count() }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">Sesi mengajar ({{ $nama_hari }})</p>
                </div>
            </div>
        @endif

        @if($isWallas && $wallas)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-users text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-slate-500 truncate">Siswa Perwalian</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $siswa_walas->count() }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">Siswa binaan aktif</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-school text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-slate-500 truncate">Kelas Perwalian</p>
                    <h3 class="text-base sm:text-lg font-bold text-slate-800 mt-0.5 leading-snug break-words" title="{{ $wallas->ruangKelas->nama_ruang ?? '-' }}">
                        {{ $wallas->ruangKelas->nama_ruang ?? '-' }}
                    </h3>
                    <p class="text-[11px] text-emerald-600 font-semibold mt-1 flex items-center truncate">
                        <i class="fa-solid fa-circle-check text-[10px] mr-1 flex-shrink-0"></i> Wali Kelas Aktif
                    </p>
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-user-tie text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-slate-500 truncate">Tugas Wali Kelas</p>
                    <h3 class="text-xl font-bold text-slate-700 mt-0.5 truncate">-</h3>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">Bukan wali kelas</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-book-bookmark text-xl"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs sm:text-sm font-medium text-slate-500 truncate">Status Guru</p>
                    <h3 class="text-base sm:text-lg font-bold text-slate-800 mt-0.5 truncate">Guru Pengajar</h3>
                    <p class="text-[11px] text-emerald-600 font-semibold mt-1 flex items-center truncate">
                        <i class="fa-solid fa-circle-check text-[10px] mr-1 flex-shrink-0"></i> SIAKAD Aktif
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Grid: Jadwal Hari Ini & Aksi Cepat -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Jadwal Mengajar Hari Ini (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 flex flex-wrap sm:flex-nowrap justify-between items-center gap-2 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Jadwal Mengajar Hari Ini ({{ $nama_hari }})</h3>
                    <p class="text-xs sm:text-sm text-slate-500">Agenda pembelajaran yang dijadwalkan</p>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 flex-shrink-0">
                    <i class="fa-solid fa-calendar-day mr-1.5 text-xs"></i> {{ $jadwal_hari_ini->count() }} Sesi
                </span>
            </div>

            <div class="divide-y divide-slate-100 flex-1">
                @if($jadwal_hari_ini->count() > 0)
                    @foreach($jadwal_hari_ini as $jadwal)
                        <div class="p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-slate-50/70 transition-colors">
                            <div class="flex items-center space-x-3.5 sm:space-x-4 min-w-0">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-xl bg-emerald-50 border border-emerald-100 flex flex-col items-center justify-center text-emerald-700 flex-shrink-0">
                                    <span class="text-xs sm:text-sm font-bold leading-none">{{ \Carbon\Carbon::parse($jadwal->jam_pelajaran->jam_mulai ?? now())->format('H:i') }}</span>
                                    <span class="text-[9px] sm:text-[10px] text-emerald-600 font-medium mt-1">WIB</span>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="text-sm font-semibold text-slate-800 truncate">{{ $jadwal->mata_pelajaran->nama_mapel ?? '-' }}</h4>
                                    <div class="flex flex-wrap items-center gap-2 mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            <i class="fa-solid fa-users text-[10px] mr-1.5"></i> Kelas {{ $jadwal->kelas->nama_kelas ?? ($jadwal->kelas->nama_ruang ?? '-') }}
                                        </span>
                                        <span class="text-xs text-slate-500 flex items-center">
                                            <i class="fa-regular fa-clock text-slate-400 mr-1"></i> {{ substr($jadwal->jam_pelajaran->jam_mulai ?? '', 0, 5) }} - {{ substr($jadwal->jam_pelajaran->jam_selesai ?? '', 0, 5) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 self-end sm:self-center flex-shrink-0">
                                <a href="/sk/ass" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200 transition-colors flex items-center">
                                    <i class="fa-solid fa-clipboard-check mr-1.5"></i> Absensi
                                </a>
                                <a href="/sk/input-nilai-detail/{{ $jadwal->id }}" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 border border-slate-200 transition-colors flex items-center">
                                    <i class="fa-solid fa-pen-to-square mr-1.5"></i> Nilai
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-10 sm:p-12 text-center text-slate-500">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-mug-hot text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-medium text-slate-700">Tidak Ada Jadwal Mengajar Hari Ini</h4>
                        <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Tidak ada jadwal tatap muka untuk hari {{ $nama_hari }}. Silakan periksa menu Jadwal Mengajar untuk hari lainnya.</p>
                        <a href="/sk/jadwal-guru" class="inline-flex items-center text-xs font-medium text-emerald-600 hover:text-emerald-700 mt-3">
                            Lihat Jadwal Lengkap <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Aksi Cepat (1 Col) -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-base font-semibold text-slate-800">Aksi Cepat</h3>
                <p class="text-xs sm:text-sm text-slate-500">Pintasan menu operasional guru</p>
            </div>
            <div class="p-4 sm:p-5 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-2.5 sm:gap-3 flex-1 content-start">
                <a href="/sk/jadwal-guru" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-colors group">
                    <i class="fa-solid fa-calendar-week text-xl sm:text-2xl text-emerald-500 mb-1.5 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700 text-center leading-snug">Jadwal Guru</span>
                </a>
                <a href="/sk/nilai-guru" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-200 transition-colors group">
                    <i class="fa-solid fa-star text-xl sm:text-2xl text-amber-500 mb-1.5 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700 text-center leading-snug">Input Nilai</span>
                </a>
                <a href="/sk/ass" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors group">
                    <i class="fa-solid fa-clipboard-list text-xl sm:text-2xl text-blue-500 mb-1.5 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700 text-center leading-snug">Absensi Mapel</span>
                </a>

                @if($isWallas)
                    <a href="/sk/wali-kelas" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-violet-50 hover:border-violet-200 transition-colors group">
                        <i class="fa-solid fa-users-rectangle text-xl sm:text-2xl text-violet-500 mb-1.5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700 text-center leading-snug">Data Walas</span>
                    </a>
                    <a href="/sk/absensi-walas" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-teal-50 hover:border-teal-200 transition-colors group">
                        <i class="fa-solid fa-clipboard-user text-xl sm:text-2xl text-teal-500 mb-1.5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700 text-center leading-snug">Absen Kelas</span>
                    </a>
                    <a href="/sk/rapor-walas" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-rose-50 hover:border-rose-200 transition-colors group">
                        <i class="fa-solid fa-file-contract text-xl sm:text-2xl text-rose-500 mb-1.5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700 text-center leading-snug">Cetak Rapor</span>
                    </a>
                @else
                    <a href="/sk/gsp" class="flex flex-col items-center justify-center p-3 sm:p-3.5 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 hover:border-slate-300 transition-colors group">
                        <i class="fa-solid fa-id-badge text-xl sm:text-2xl text-slate-600 mb-1.5 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700 text-center leading-snug">Profil Guru</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Secondary Grid: Daftar Kelas Diampu & Informasi Wali Kelas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Kelas yang Diampu (Tabel persis seperti Admin) -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 flex flex-wrap sm:flex-nowrap justify-between items-center gap-2 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Daftar Kelas yang Diampu</h3>
                    <p class="text-xs sm:text-sm text-slate-500">Rombongan belajar tempat Anda mengajar</p>
                </div>
                <a href="/sk/nilai-guru" class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center flex-shrink-0">
                    Kelola Nilai <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[500px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-4 sm:px-6 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Ruang Kelas</th>
                            <th class="px-4 sm:px-6 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Peran Pengajar</th>
                            <th class="px-4 sm:px-6 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @if($kelas_diampu->count() > 0)
                            @foreach ($kelas_diampu as $kelas)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                <i class="fa-solid fa-chalkboard"></i>
                                            </div>
                                            <span class="text-sm font-semibold text-slate-800">Kelas {{ $kelas->nama_kelas }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3.5 sm:py-4">
                                        @if($wallas && ($wallas->kelas_id == $kelas->id || ($wallas->ruangKelas && $wallas->ruangKelas->nama_ruang == $kelas->nama_kelas)))
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-crown mr-1 text-[10px]"></i> Wali Kelas & Pengajar
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <i class="fa-solid fa-user-check mr-1 text-[10px]"></i> Guru Pengajar
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 sm:px-6 py-3.5 sm:py-4 text-right">
                                        <a href="/sk/jadwal-guru" class="text-xs font-medium text-emerald-600 hover:text-emerald-700 mr-3">
                                            Jadwal
                                        </a>
                                        <a href="/sk/nilai-guru" class="text-xs font-medium text-blue-600 hover:text-blue-700">
                                            Input Nilai
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                                    <p class="text-sm text-slate-600">Belum ada penugasan kelas yang diampu.</p>
                                    <p class="text-xs text-slate-400 mt-1">Silakan koordinasi dengan Admin Akademik terkait jadwal mengajar.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Panel Informasi Perwalian (Wali Kelas) atau Card Akademik -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            @if($isWallas && $wallas)
                <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 flex flex-wrap sm:flex-nowrap justify-between items-start sm:items-center gap-2 bg-slate-50/50">
                    <div class="min-w-0 flex-1">
                        <h3 class="text-base font-semibold text-slate-800">Kelas Perwalian</h3>
                        <p class="text-xs sm:text-sm text-slate-500">Tugas & wewenang wali kelas</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-violet-100 text-violet-800 flex-shrink-0 max-w-full truncate" title="{{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}">
                        {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}
                    </span>
                </div>
                <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-5 sm:space-y-6">
                    <div>
                        <div class="p-4 rounded-xl bg-violet-50/60 border border-violet-100 mb-4">
                            <span class="text-xs font-medium text-violet-600 uppercase tracking-wider block mb-1">Ruang Kelas Binaan</span>
                            <h4 class="text-lg sm:text-xl font-bold text-slate-800 break-words">{{ $wallas->ruangKelas->nama_ruang ?? '-' }}</h4>
                            <p class="text-xs text-slate-500 mt-1">Terdaftar <span class="font-semibold text-slate-700">{{ $siswa_walas->count() }} siswa</span> di bawah bimbingan Anda.</p>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs py-2 border-b border-slate-100">
                                <span class="text-slate-500">Siswa Aktif</span>
                                <span class="font-semibold text-slate-700">{{ $siswa_walas->count() }} Siswa</span>
                            </div>
                            <div class="flex items-center justify-between text-xs py-2 border-b border-slate-100">
                                <span class="text-slate-500">Tahun Ajaran</span>
                                <span class="font-semibold text-emerald-600">Aktif</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-1 gap-2.5 pt-2">
                        <a href="/sk/wali-kelas" class="w-full flex items-center justify-center px-3.5 py-2.5 rounded-lg border border-slate-200 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors text-center">
                            <i class="fa-solid fa-users mr-2 text-slate-500 flex-shrink-0"></i> Kelola Data Siswa
                        </a>
                        <a href="/sk/absensi-walas" class="w-full flex items-center justify-center px-3.5 py-2.5 rounded-lg bg-emerald-600 text-xs font-semibold text-white hover:bg-emerald-700 transition-colors shadow-sm text-center">
                            <i class="fa-solid fa-clipboard-user mr-2 flex-shrink-0"></i> Rekap Absensi
                        </a>
                        <a href="/sk/rapor-walas" class="w-full flex items-center justify-center px-3.5 py-2.5 rounded-lg bg-blue-600 text-xs font-semibold text-white hover:bg-blue-700 transition-colors shadow-sm text-center">
                            <i class="fa-solid fa-file-contract mr-2 flex-shrink-0"></i> Cetak Lembar Rapor
                        </a>
                    </div>
                </div>
            @else
                <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Informasi Akademik</h3>
                        <p class="text-xs sm:text-sm text-slate-500">Panduan guru pengajar</p>
                    </div>
                </div>
                <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg flex-shrink-0">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-800">Status Pengajar</h4>
                            </div>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Anda tercatat sebagai Guru Pengajar aktif. Pastikan mengisi absensi siswa setiap sesi pelajaran berlangsung dan memasukkan nilai secara berkala.
                            </p>
                        </div>
                    </div>

                    <div class="pt-4">
                        <a href="/sk/jadwal-guru" class="w-full flex items-center justify-center px-4 py-2.5 rounded-lg bg-emerald-600 text-xs font-semibold text-white hover:bg-emerald-700 transition-colors text-center">
                            <i class="fa-solid fa-calendar-check mr-2 flex-shrink-0"></i> Buka Jadwal Mengajar
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-siakad-layout>

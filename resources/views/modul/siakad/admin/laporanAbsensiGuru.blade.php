<x-siakad-layout 
    title="Laporan Kehadiran Mengajar Guru" 
    description="Pantau presensi masuk kelas dan ketepatan waktu guru pengajar (toleransi 5 menit)." 
    position="Admin SIAKAD" 
    initials="AD">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/das" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Laporan Kehadiran Guru</span>
        </li>
    </x-slot>

    <!-- KPI Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-calendar-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Sesi Hari Ini</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $stats['total_sesi'] }}</h3>
                <p class="text-xs text-slate-400 mt-1">Jadwal pelajaran aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Tepat Waktu</p>
                <h3 class="text-2xl font-bold text-emerald-600">{{ $stats['tepat_waktu'] }}</h3>
                <p class="text-xs text-slate-400 mt-1">Masuk &le; toleransi 5 mnt</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Terlambat</p>
                <h3 class="text-2xl font-bold text-amber-600">{{ $stats['terlambat'] }}</h3>
                <p class="text-xs text-slate-400 mt-1">Lewat batas toleransi</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Belum Absen Masuk</p>
                <h3 class="text-2xl font-bold text-rose-600">{{ $stats['belum_absen'] }}</h3>
                <p class="text-xs text-slate-400 mt-1">Menunggu kehadiran guru</p>
            </div>
        </div>
    </div>

    <!-- Filter & Toolbar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <form method="GET" action="/sk/laporan-absensi-guru" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Filter Kehadiran Mengajar</h3>
                    <p class="text-xs text-slate-500">Pilih tanggal dan status kehadiran untuk melihat monitoring guru</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <div class="relative">
                    <i class="fa-regular fa-calendar absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" 
                           class="pl-9 pr-3 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 transition-colors w-full sm:w-auto">
                </div>

                <div class="relative sm:w-44">
                    <select name="status" class="w-full pl-3 pr-8 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 transition-colors appearance-none cursor-pointer">
                        <option value="semua" {{ $status_filter == 'semua' ? 'selected' : '' }}>Semua Status</option>
                        <option value="tepat_waktu" {{ $status_filter == 'tepat_waktu' ? 'selected' : '' }}>Tepat Waktu</option>
                        <option value="terlambat" {{ $status_filter == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                        <option value="belum_absen" {{ $status_filter == 'belum_absen' ? 'selected' : '' }}>Belum Absen</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                </div>

                <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-semibold transition-colors flex items-center justify-center gap-2 shadow-sm">
                    <i class="fa-solid fa-filter text-xs"></i> Terapkan
                </button>
            </div>
        </form>
    </div>

    <!-- Tabel Data Kehadiran Mengajar Guru -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h3 class="text-base font-bold text-slate-800">Data Presensi Masuk Kelas Per Mata Pelajaran</h3>
                <p class="text-xs text-slate-500">Daftar kehadiran sesi mengajar pada: <strong class="text-slate-700">{{ $hari_indonesia }}</strong></p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    <i class="fa-solid fa-stopwatch mr-1.5 text-xs"></i> Toleransi Keterlambatan: 5 Menit
                </span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-12 text-center">No</th>
                        <th class="px-5 py-3.5">Guru Pengajar</th>
                        <th class="px-5 py-3.5">Mata Pelajaran</th>
                        <th class="px-5 py-3.5">Kelas</th>
                        <th class="px-5 py-3.5">Jadwal Sesi</th>
                        <th class="px-5 py-3.5">Batas Toleransi</th>
                        <th class="px-5 py-3.5">Waktu Masuk</th>
                        <th class="px-5 py-3.5 text-center">Status Kehadiran</th>
                        <th class="px-5 py-3.5 text-center">Presensi Siswa</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @if($laporan->count() > 0)
                        @foreach($laporan as $item)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            {{ substr($item->guru->nama ?? 'G', 0, 2) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block">{{ $item->guru->nama ?? '-' }}</span>
                                            <span class="text-xs text-slate-400 font-mono">{{ $item->guru->nip ?? ($item->guru->nomor_induk ?? '') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-4">
                                    <span class="font-semibold text-slate-800 block">{{ $item->mata_pelajaran->nama_mapel ?? '-' }}</span>
                                    @if(!empty($item->materi))
                                        <span class="text-xs text-emerald-700 font-medium block mt-0.5">
                                            <i class="fa-solid fa-book-bookmark text-[10px] mr-1"></i>{{ $item->materi }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700">
                                        {{ $item->kelas->nama_kelas ?? ($item->kelas->nama_ruang ?? '-') }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-600 whitespace-nowrap">
                                    <i class="fa-regular fa-clock text-slate-400 mr-1"></i>
                                    {{ $item->jam_mulai }} - {{ $item->jam_selesai }} WIB
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-amber-700 whitespace-nowrap font-semibold">
                                    {{ $item->jam_batas_toleransi }} WIB
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-700 whitespace-nowrap">
                                    @if($item->jam_masuk)
                                        <span class="font-bold text-slate-800">{{ substr($item->jam_masuk, 0, 5) }} WIB</span>
                                    @else
                                        <span class="text-slate-400">-</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($item->status == 'tepat_waktu')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                            <i class="fa-solid fa-circle-check mr-1.5 text-xs"></i> Tepat Waktu
                                        </span>
                                    @elseif($item->status == 'terlambat')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                            <i class="fa-solid fa-clock-rotate-left mr-1.5 text-xs"></i> Terlambat
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200">
                                            <i class="fa-solid fa-circle-xmark mr-1.5 text-xs"></i> Belum Masuk
                                        </span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($item->rekap_siswa['total'] > 0)
                                        <div class="inline-flex items-center gap-1.5 text-xs font-medium">
                                            <span class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 font-bold" title="Hadir">{{ $item->rekap_siswa['hadir'] }} H</span>
                                            <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-700 font-bold" title="Sakit">{{ $item->rekap_siswa['sakit'] }} S</span>
                                            <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-bold" title="Izin">{{ $item->rekap_siswa['izin'] }} I</span>
                                            <span class="px-2 py-0.5 rounded bg-rose-50 text-rose-700 font-bold" title="Alpa">{{ $item->rekap_siswa['alpa'] }} A</span>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400 italic">Belum diabsen</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-700">Tidak Ada Data</h4>
                                <p class="text-xs text-slate-400 mt-1">Tidak ditemukan jadwal atau presensi mengajar guru pada kriteria filter ini.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-siakad-layout>

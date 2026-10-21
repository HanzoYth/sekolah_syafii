<x-siakad-layout 
    title="Jadwal Mengajar" 
    description="Kelola dan pantau agenda sesi pembelajaran Anda." 
    position="Guru SIAKAD" 
    initials="GR">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Jadwal Mengajar</span>
        </li>
    </x-slot>

    <!-- Top Summary Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-calendar-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Sesi Mengajar</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ count($jadwal) }}</h3>
                <p class="text-xs text-slate-400 mt-1">Jadwal tatap muka terdaftar</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-chalkboard-user text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Kelas yang Diampu</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $jadwal->pluck('kelas_id')->unique()->count() }}</h3>
                <p class="text-xs text-slate-400 mt-1">Rombongan belajar aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-book-open text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Mata Pelajaran</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $jadwal->pluck('mapel_id')->unique()->count() }}</h3>
                <p class="text-xs text-slate-400 mt-1">Bidang studi penugasan</p>
            </div>
        </div>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/50">
            <div>
                <h3 class="text-base font-semibold text-slate-800">Daftar Jadwal Mengajar</h3>
                <p class="text-sm text-slate-500">Rincian hari, jam, kelas, dan mata pelajaran Anda</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                    <i class="fa-solid fa-clock mr-1.5 text-xs"></i> {{ count($jadwal) }} Sesi Terjadwal
                </span>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Hari</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jam Pelajaran</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider">Ruangan</th>
                        <th class="px-6 py-3.5 text-xs font-semibold text-slate-600 uppercase tracking-wider text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @if(count($jadwal) > 0)
                        @foreach($jadwal as $j)
                            <tr class="hover:bg-slate-50/60 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-800 uppercase tracking-wide">
                                        {{ ucfirst($j->hari) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $jmlJp = $j->getJumlahJp();
                                        $durasi = $j->jam_pelajaran ? $j->jam_pelajaran->durasi_menit : 0;
                                        $jamKe = $j->jam_pelajaran->jam_ke ?? null;
                                    @endphp
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center space-x-2 text-sm text-slate-700">
                                            <i class="fa-regular fa-clock text-emerald-600 text-xs"></i>
                                            <span class="font-semibold">
                                                @if($jamKe) {{ $jamKe }} • @endif
                                                {{ substr($j->jam_pelajaran->jam_mulai ?? '-', 0, 5) }} - {{ substr($j->jam_pelajaran->jam_selesai ?? '-', 0, 5) }}
                                            </span>
                                        </div>
                                        <div>
                                            @if($jmlJp > 0)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    {{ $jmlJp }} JP @if($durasi > 0) ({{ $durasi }} Menit) @endif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                                    Sesi Non-JP @if($durasi > 0) ({{ $durasi }} Menit) @endif
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                        <i class="fa-solid fa-users text-[10px] mr-1.5"></i> {{ $j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-slate-800">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    <i class="fa-solid fa-door-open text-slate-400 mr-1 text-xs"></i> {{ $j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="/sk/ass" class="text-xs font-semibold px-2.5 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors">
                                            Absen
                                        </a>
                                        <a href="/sk/input-nilai-detail/{{ $j->id }}" class="text-xs font-semibold px-2.5 py-1.5 rounded-lg bg-slate-100 text-slate-700 hover:bg-slate-200 transition-colors">
                                            Nilai
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-medium text-slate-700">Belum Ada Jadwal Mengajar</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Jadwal mengajar belum diatur atau Anda belum ditugaskan ke mata pelajaran pada rombel aktif.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-siakad-layout>

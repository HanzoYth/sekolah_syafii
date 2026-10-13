<x-siakad-layout 
    title="Input Nilai Mata Pelajaran" 
    description="Kelola dan evaluasi capaian nilai akademik siswa untuk setiap kelas dan mata pelajaran yang Anda ampu." 
    position="Guru Pengajar" 
    initials="GP">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Input Nilai Mapel</span>
        </li>
    </x-slot>

    <!-- Header Stats & Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-book-open-reader text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Sesi Kelas Diampu</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ count($mapel_guru) }}</h3>
                <p class="text-xs text-emerald-600 font-semibold mt-1">Jadwal Mengajar Aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-sliders text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Komposisi Bobot Nilai</p>
                <h3 class="text-sm font-bold text-slate-800 mt-1">Tugas (20%) • UH (30%)</h3>
                <p class="text-xs text-slate-500 mt-1">UTS (20%) • UAS (30%)</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-chart-line text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Kalkulasi Rapor</p>
                <h3 class="text-base font-bold text-slate-800 mt-0.5">Otomatis & Real-Time</h3>
                <p class="text-xs text-amber-600 font-semibold mt-1">Terhubung ke Leger Wali Kelas</p>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <!-- Action & Search Header -->
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-emerald-600"></i>
                    <span>Daftar Mata Pelajaran & Kelas Mengajar</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Pilih kelas di bawah ini untuk menginput nilai Tugas, UH, UTS, dan UAS siswa</p>
            </div>

            <div class="relative w-full sm:w-72">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" id="searchInput" placeholder="Cari nama mapel atau kelas..." onkeyup="filterCards()"
                       class="w-full pl-9 pr-4 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
            </div>
        </div>

        <div class="p-6">
            <!-- Cards Grid -->
            <div id="cardGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(count($mapel_guru) > 0)
                    @foreach($mapel_guru as $mapel)
                        @php
                            $namaKelas = $mapel->kelas->nama_ruang ?? ($mapel->kelas->nama_kelas ?? '-');
                            $namaMapel = $mapel->mata_pelajaran->nama_mapel ?? '-';
                            $kkm = $mapel->mata_pelajaran->kkm ?? 75;
                            $hari = ucfirst($mapel->hari ?? '-');
                            $jamMulai = substr($mapel->jam_pelajaran->jam_mulai ?? '', 0, 5);
                            $jamSelesai = substr($mapel->jam_pelajaran->jam_selesai ?? '', 0, 5);
                            $tahunAjaran = $mapel->tahun_ajaran->nama ?? 'Tahun Ajaran Aktif';
                        @endphp
                        <div class="mapel-card group rounded-xl border border-slate-200 bg-white p-5 flex flex-col justify-between hover:border-emerald-500 hover:shadow-md transition-all"
                             data-search="{{ strtolower($namaMapel . ' ' . $namaKelas . ' ' . $hari) }}">
                            <div>
                                <!-- Header Card -->
                                <div class="flex items-center justify-between gap-2 mb-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <i class="fa-solid fa-users text-[10px]"></i> Kelas {{ $namaKelas }}
                                    </span>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-100 text-slate-600">
                                        <i class="fa-solid fa-bullseye text-amber-600 text-[10px]"></i> KKM: {{ $kkm }}
                                    </span>
                                </div>

                                <!-- Mapel Title -->
                                <h4 class="text-base font-bold text-slate-800 group-hover:text-emerald-700 transition-colors mb-3">
                                    {{ $namaMapel }}
                                </h4>

                                <!-- Details list -->
                                <div class="space-y-2 p-3 rounded-lg bg-slate-50 border border-slate-100 text-xs text-slate-600 mb-5">
                                    <div class="flex items-center gap-2">
                                        <i class="fa-regular fa-calendar-days text-emerald-600 w-4 text-center"></i>
                                        <span>Hari: <strong class="text-slate-800">{{ $hari }}</strong></span>
                                    </div>
                                    @if($jamMulai && $jamSelesai)
                                    <div class="flex items-center gap-2">
                                        <i class="fa-regular fa-clock text-blue-600 w-4 text-center"></i>
                                        <span>Jam: <strong class="text-slate-800">{{ $jamMulai }} - {{ $jamSelesai }} WIB</strong></span>
                                    </div>
                                    @endif
                                    <div class="flex items-center gap-2">
                                        <i class="fa-solid fa-calendar-check text-violet-600 w-4 text-center"></i>
                                        <span>Periode: <strong class="text-slate-800">{{ $tahunAjaran }}</strong></span>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <a href="/sk/input-nilai-detail/{{ $mapel->id }}" 
                               class="w-full py-2.5 px-4 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i> Input & Kelola Nilai Siswa
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full py-12 px-6 text-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50/50">
                        <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-300">
                            <i class="fa-solid fa-folder-open text-2xl"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Belum Ada Jadwal Mengajar</h4>
                        <p class="text-xs text-slate-500 mt-1 max-w-md mx-auto">Mata pelajaran atau jadwal mengajar Anda belum terdaftar di sistem SIAKAD. Silakan hubungi bagian Akademik.</p>
                    </div>
                @endif
            </div>

            <div id="noMatch" class="hidden py-12 text-center text-slate-500">
                <i class="fa-solid fa-magnifying-glass text-2xl text-slate-300 mb-2 block"></i>
                <p class="text-sm font-medium text-slate-600">Tidak ada mata pelajaran atau kelas yang cocok dengan kata kunci pencarian.</p>
            </div>
        </div>
    </div>

    <script>
        function filterCards() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.mapel-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const searchData = card.getAttribute('data-search') || '';
                if (searchData.includes(input)) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            const noMatch = document.getElementById('noMatch');
            if (noMatch) {
                if (visibleCount === 0 && cards.length > 0) {
                    noMatch.classList.remove('hidden');
                } else {
                    noMatch.classList.add('hidden');
                }
            }
        }
    </script>
</x-siakad-layout>

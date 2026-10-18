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
                <h3 class="text-2xl font-bold text-slate-800">{{ $total_kelas ?? count($mapel_guru) }}</h3>
                <p class="text-xs text-slate-400 mt-1">Total jadwal mengajar aktif</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-circle-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Nilai Selesai (100%)</p>
                <h3 class="text-2xl font-bold text-emerald-600">{{ $kelas_tuntas ?? 0 }}</h3>
                <p class="text-xs text-emerald-700 font-semibold mt-1">Kelas tuntas dinilai</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Perlu Dilengkapi</p>
                <h3 class="text-2xl font-bold text-amber-600">{{ $kelas_belum ?? 0 }}</h3>
                <p class="text-xs text-amber-700 font-semibold mt-1">Masih proses input nilai</p>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <!-- Action & Search Header -->
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-emerald-600"></i>
                    <span>Daftar Mata Pelajaran & Kelas Mengajar</span>
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Pilih kelas di bawah ini untuk menginput nilai Tugas, UH, UTS, dan UAS siswa</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <!-- Status Filter Tabs -->
                <div class="inline-flex p-1 rounded-lg bg-slate-200/80 text-xs font-semibold">
                    <button type="button" onclick="setStatusFilter('all', this)" id="tab-all" class="px-3 py-1.5 rounded-md bg-white text-emerald-800 shadow-sm transition-all">
                        Semua ({{ $total_kelas ?? count($mapel_guru) }})
                    </button>
                    <button type="button" onclick="setStatusFilter('belum', this)" id="tab-belum" class="px-3 py-1.5 rounded-md text-slate-600 hover:text-slate-800 transition-all">
                        Belum Lengkap ({{ $kelas_belum ?? 0 }})
                    </button>
                    <button type="button" onclick="setStatusFilter('selesai', this)" id="tab-selesai" class="px-3 py-1.5 rounded-md text-slate-600 hover:text-slate-800 transition-all">
                        Selesai ({{ $kelas_tuntas ?? 0 }})
                    </button>
                </div>

                <div class="relative w-full sm:w-64">
                    <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="searchInput" placeholder="Cari mapel atau kelas..." onkeyup="filterCards()"
                           class="w-full pl-9 pr-4 py-2 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/15 transition-all">
                </div>
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
                            $statusCard = $mapel->is_tuntas ? 'selesai' : 'belum';
                        @endphp
                        <div class="mapel-card group rounded-xl border border-slate-200 bg-white p-5 flex flex-col justify-between hover:border-emerald-500 hover:shadow-md transition-all"
                             data-status="{{ $statusCard }}"
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
                                <h4 class="text-base font-bold text-slate-800 group-hover:text-emerald-700 transition-colors mb-2.5">
                                    {{ $namaMapel }}
                                </h4>

                                <!-- Progress Bar & Status -->
                                <div class="p-3 rounded-lg bg-slate-50 border border-slate-100 mb-4">
                                    <div class="flex items-center justify-between gap-2 mb-1.5">
                                        @if(($mapel->total_siswa ?? 0) === 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-200 text-slate-600">
                                                <i class="fa-solid fa-circle-info text-[10px]"></i> Belum Ada Siswa
                                            </span>
                                        @elseif(!empty($mapel->is_tuntas))
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check text-[10px] text-emerald-600"></i> Nilai Lengkap ({{ $mapel->siswa_dinilai }}/{{ $mapel->total_siswa }})
                                            </span>
                                        @elseif(($mapel->siswa_dinilai ?? 0) > 0)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-clock text-[10px] text-amber-600"></i> Sebagian ({{ $mapel->siswa_dinilai }}/{{ $mapel->total_siswa }})
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-200 text-slate-600">
                                                <i class="fa-solid fa-pen-line text-[10px]"></i> Belum Diisi (0/{{ $mapel->total_siswa }})
                                            </span>
                                        @endif
                                        <span class="text-xs font-bold {{ !empty($mapel->is_tuntas) ? 'text-emerald-600' : (($mapel->siswa_dinilai ?? 0) > 0 ? 'text-amber-600' : 'text-slate-400') }}">
                                            {{ $mapel->persentase_selesai ?? 0 }}%
                                        </span>
                                    </div>
                                    <div class="w-full bg-slate-200/80 rounded-full h-1.5 overflow-hidden">
                                        <div class="h-full rounded-full transition-all duration-300 {{ !empty($mapel->is_tuntas) ? 'bg-emerald-500' : (($mapel->siswa_dinilai ?? 0) > 0 ? 'bg-amber-500' : 'bg-slate-300') }}"
                                             style="width: {{ $mapel->persentase_selesai ?? 0 }}%;"></div>
                                    </div>
                                </div>

                                <!-- Details list -->
                                <div class="space-y-1.5 text-xs text-slate-600 mb-5">
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
                               class="w-full py-2.5 px-4 rounded-lg {{ !empty($mapel->is_tuntas) ? 'bg-slate-800 hover:bg-slate-900' : 'bg-emerald-600 hover:bg-emerald-700' }} text-white text-xs font-bold transition-colors flex items-center justify-center gap-2 shadow-sm">
                                <i class="fa-solid fa-pen-to-square"></i> 
                                {{ !empty($mapel->is_tuntas) ? 'Tinjau / Perbarui Nilai' : 'Input & Kelola Nilai' }}
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
                <p class="text-sm font-medium text-slate-600">Tidak ada mata pelajaran atau kelas yang cocok dengan filter yang dipilih.</p>
            </div>
        </div>
    </div>

    <script>
        let currentStatusFilter = 'all';

        function setStatusFilter(status, btn) {
            currentStatusFilter = status;

            // Reset tab styling
            document.querySelectorAll('[id^="tab-"]').forEach(el => {
                el.classList.remove('bg-white', 'text-emerald-800', 'shadow-sm');
                el.classList.add('text-slate-600');
            });
            btn.classList.add('bg-white', 'text-emerald-800', 'shadow-sm');
            btn.classList.remove('text-slate-600');

            filterCards();
        }

        function filterCards() {
            const input = document.getElementById('searchInput') ? document.getElementById('searchInput').value.toLowerCase().trim() : '';
            const cards = document.querySelectorAll('.mapel-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const searchData = card.getAttribute('data-search') || '';
                const cardStatus = card.getAttribute('data-status') || '';

                const matchesSearch = !input || searchData.includes(input);
                const matchesStatus = (currentStatusFilter === 'all') || (cardStatus === currentStatusFilter);

                if (matchesSearch && matchesStatus) {
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

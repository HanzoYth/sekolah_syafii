<x-siakad-layout 
    title="Aturan Bobot Penilaian & KKM" 
    description="Atur persentase bobot penilaian (Tugas, Ulangan Harian, UTS, UAS) serta standar Kriteria Ketuntasan Minimal (KKM) mata pelajaran." 
    position="Administrator" 
    initials="AD">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/das" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Bobot Nilai & KKM</span>
        </li>
    </x-slot>

    <!-- Top KPI Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Komponen Nilai</p>
                    <h4 class="text-2xl font-bold text-slate-800 mt-1">{{ $jenis_penilaian->count() }}</h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">Tugas, UH, UTS, UAS</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Bobot Nilai</p>
                    <div class="flex items-center gap-2 mt-1">
                        <h4 class="text-2xl font-bold {{ $total_bobot == 100 ? 'text-emerald-700' : 'text-amber-700' }}" id="kpiTotalBobot">{{ $total_bobot }}%</h4>
                    </div>
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-percent"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">Standar perhitungan: 100%</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Rata-rata KKM</p>
                    <h4 class="text-2xl font-bold text-emerald-700 mt-1">{{ $avg_kkm }}</h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-award"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">Batas kelulusan kompetensi</span>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Mata Pelajaran</p>
                    <h4 class="text-2xl font-bold text-slate-800 mt-1">{{ $data_mapel->count() }}</h4>
                </div>
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-book"></i>
                </div>
            </div>
            <span class="text-[11px] text-slate-400 mt-2 block">Mata pelajaran kurikulum</span>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- BAGIAN 1: PENGATURAN PERSENTASE BOBOT PENILAIAN         -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-sliders"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Pengaturan Persentase Bobot Penilaian</h3>
                    <p class="text-xs text-slate-500">Bobot ini dipakai langsung untuk menghitung Nilai Akhir (NA) dan Rapor siswa.</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button type="button" onclick="resetBobotStandar()" class="px-3.5 py-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-rotate-left text-[11px]"></i> Reset ke Standar (20-30-20-30)
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Live Visual Progress Bar -->
            <div class="mb-6 p-4 rounded-xl bg-slate-50 border border-slate-200">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-bold text-slate-700 flex items-center gap-1.5">
                        <i class="fa-solid fa-chart-pie text-emerald-600"></i> Visualisasi Proporsi Nilai Akhir (NA):
                    </span>
                    <span id="liveTotalBadge" class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $total_bobot == 100 ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                        Total: <span id="liveTotalVal">{{ $total_bobot }}</span>% 
                        <span id="liveTotalText">{{ $total_bobot == 100 ? '(Pas 100%)' : '(Selisih ' . (100 - $total_bobot) . '%)' }}</span>
                    </span>
                </div>

                <!-- Multi-bar preview -->
                <div class="w-full h-5 bg-slate-200 rounded-lg overflow-hidden flex shadow-inner">
                    @php
                        $color_classes = [
                            1 => ['bg' => 'bg-emerald-600', 'text' => 'text-emerald-700'],
                            2 => ['bg' => 'bg-teal-500', 'text' => 'text-teal-700'],
                            3 => ['bg' => 'bg-sky-500', 'text' => 'text-sky-700'],
                            4 => ['bg' => 'bg-indigo-600', 'text' => 'text-indigo-700'],
                        ];
                    @endphp
                    @foreach($jenis_penilaian as $idx => $jp)
                        @php
                            $c = $color_classes[$jp->id] ?? ['bg' => 'bg-violet-500', 'text' => 'text-violet-700'];
                        @endphp
                        <div id="bar-jp-{{ $jp->id }}" 
                             class="{{ $c['bg'] }} h-full transition-all duration-300 relative group flex items-center justify-center text-[10px] text-white font-bold"
                             style="width: {{ max(0, $jp->bobot) }}%;"
                             title="{{ $jp->nama_jenis }}: {{ $jp->bobot }}%">
                            <span class="truncate px-1">{{ $jp->nama_jenis }} ({{ $jp->bobot }}%)</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-3 flex flex-wrap items-center justify-between gap-3 text-xs text-slate-500">
                    <div class="flex items-center gap-4 flex-wrap">
                        @foreach($jenis_penilaian as $jp)
                            @php
                                $c = $color_classes[$jp->id] ?? ['bg' => 'bg-violet-500', 'text' => 'text-violet-700'];
                            @endphp
                            <div class="flex items-center gap-1.5">
                                <span class="w-3 h-3 rounded-full {{ $c['bg'] }} inline-block"></span>
                                <span class="font-medium text-slate-700">{{ $jp->nama_jenis }}:</span>
                                <span class="font-bold {{ $c['text'] }}" id="legend-jp-{{ $jp->id }}">{{ $jp->bobot }}%</span>
                            </div>
                        @endforeach
                    </div>
                    <span class="text-slate-400 text-[11px] italic">
                        Rumus: NA = &sum; (Nilai &times; Bobot%)
                    </span>
                </div>
            </div>

            <!-- Form Edit Bobot -->
            <form action="/sk/simpan-bobot-penilaian" method="POST" id="formBobot">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    @php
                        $icons = [
                            'Tugas' => 'fa-book-bookmark',
                            'Ulangan Harian' => 'fa-pen-ruler',
                            'UTS' => 'fa-file-lines',
                            'UAS' => 'fa-graduation-cap'
                        ];
                    @endphp
                    @foreach($jenis_penilaian as $jp)
                        @php
                            $c = $color_classes[$jp->id] ?? ['bg' => 'bg-violet-500', 'text' => 'text-violet-700'];
                            $icon = $icons[$jp->nama_jenis] ?? 'fa-clipboard-check';
                        @endphp
                        <div class="p-4 rounded-xl border border-slate-200 bg-white hover:border-slate-300 transition-all shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center {{ $c['text'] }}">
                                        <i class="fa-solid {{ $icon }} text-sm"></i>
                                    </div>
                                    <span class="font-bold text-slate-800 text-sm">{{ $jp->nama_jenis }}</span>
                                </div>
                                <span class="text-[10px] uppercase font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-600">
                                    ID: {{ $jp->id }}
                                </span>
                            </div>

                            <label class="block text-xs font-semibold text-slate-600 mb-1.5">Persentase Bobot (%):</label>
                            <div class="relative">
                                <input type="number" 
                                       name="bobot[{{ $jp->id }}]" 
                                       id="input-jp-{{ $jp->id }}"
                                       data-jp-id="{{ $jp->id }}"
                                       data-nama="{{ $jp->nama_jenis }}"
                                       value="{{ $jp->bobot }}" 
                                       min="0" max="100" required
                                       class="input-bobot w-full pl-3.5 pr-8 py-2 text-sm font-bold text-slate-800 bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400 pointer-events-none">%</span>
                            </div>
                            <span class="text-[11px] text-slate-400 mt-2 block">
                                Komponen penilaian per semester
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="fa-solid fa-circle-info text-emerald-600"></i>
                        <span>Pastikan seluruh komponen bernilai pas <strong>100%</strong> untuk akurasi nilai rapor.</span>
                    </div>

                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs sm:text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Konfigurasi Bobot
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- BAGIAN 2: PENGATURAN KKM PER TINGKATAN KELAS             -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-base font-bold text-slate-800">Standar KKM Per Tingkatan Kelas</h3>
                    <p class="text-xs text-slate-500">Kriteria Ketuntasan Minimal (KKM) diatur secara detail untuk tiap tingkatan (Kelas 1 s/d 6 SD, Kelas 7 s/d 9 SMP, dsb.).</p>
                </div>
            </div>

            <!-- Quick Action: KKM Massal di Sisi Kanan -->
            <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl flex-shrink-0 shadow-sm ml-auto md:ml-0">
                <span class="text-xs font-semibold text-slate-700 flex items-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-wand-magic-sparkles text-emerald-600"></i> KKM Massal:
                </span>
                <input type="number" id="kkmMassalInput" value="75" min="0" max="100" 
                       class="w-16 px-2.5 py-1 text-xs font-bold text-center bg-white border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 transition-colors">
                <button type="button" onclick="terapkanKkmMassal()" 
                        class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold shadow-sm transition-all flex items-center gap-1.5 whitespace-nowrap cursor-pointer">
                    <i class="fa-solid fa-floppy-disk text-[11px]"></i> Simpan
                </button>
            </div>
        </div>

        <div class="p-6">
            <!-- Navigasi Tab Jenjang Sekolah -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-4 border-b border-slate-100">
                <!-- Tab Buttons -->
                <div class="flex items-center gap-2 flex-wrap">
                    @foreach($data_sekolah as $index => $s)
                        @php
                            $jenjangKey = strtolower($s->jenis);
                            $count_mapel_jenjang = $data_mapel->where('sekolah_id', $s->id)->count();
                            $is_active = ($loop->first && !$sekolah_id) || ($sekolah_id == $s->id);
                        @endphp
                        <button type="button" 
                                onclick="switchJenjangTab('{{ $jenjangKey }}')"
                                id="tab-btn-{{ $jenjangKey }}"
                                class="tab-jenjang-btn px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-pointer {{ $is_active ? 'bg-emerald-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                            <i class="fa-solid fa-school text-[11px]"></i>
                            <span>{{ strtoupper($s->jenis) }}</span>
                            @if($jenjangKey === 'sd')
                                <span class="text-[10px] opacity-80">(Kelas 1 - 6)</span>
                            @elseif($jenjangKey === 'smp')
                                <span class="text-[10px] opacity-80">(Kelas 7 - 9 / 1 - 3 SMP)</span>
                            @elseif($jenjangKey === 'sma')
                                <span class="text-[10px] opacity-80">(Kelas 10 - 12)</span>
                            @elseif($jenjangKey === 'tk')
                                <span class="text-[10px] opacity-80">(TK A & B)</span>
                            @endif
                            <span class="px-1.5 py-0.2 rounded-full text-[10px] font-mono {{ $is_active ? 'bg-emerald-700 text-white' : 'bg-white text-slate-600 border border-slate-200' }}">
                                {{ $count_mapel_jenjang }}
                            </span>
                        </button>
                    @endforeach
                </div>

                <!-- Search Input -->
                <div class="relative w-full sm:w-64 flex-shrink-0">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" id="cariMapelInput" onkeyup="filterMapelTable()" placeholder="Cari nama mata pelajaran..."
                           class="w-full pl-8 pr-3 py-2 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-500 transition-colors">
                </div>
            </div>

            <!-- Form Simpan KKM Mapel Per Tingkatan -->
            <form action="/sk/simpan-kkm-mapel" method="POST" id="formKkmMapel">
                @csrf

                @foreach($data_sekolah as $index => $s)
                    @php
                        $jenjangKey = strtolower($s->jenis);
                        $tingkats = $tingkat_options[$jenjangKey] ?? [];
                        $mapel_jenjang = $data_mapel->where('sekolah_id', $s->id);
                        $is_active = ($loop->first && !$sekolah_id) || ($sekolah_id == $s->id);
                    @endphp

                    <div id="pane-jenjang-{{ $jenjangKey }}" class="tab-pane-jenjang {{ $is_active ? '' : 'hidden' }}">
                        <div class="mb-3 px-3 py-2 bg-emerald-50/70 border border-emerald-100 rounded-lg flex items-center justify-between text-xs text-emerald-800">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-info text-emerald-600"></i>
                                <span>Mengatur KKM untuk <strong>Jenjang {{ strtoupper($s->jenis) }}</strong>. Setiap tingkatan kelas dapat memiliki nilai KKM yang berbeda sesuai beban kompetensi.</span>
                            </div>
                            <span class="font-bold hidden md:inline text-emerald-700">Skala Penilaian: 0 - 100</span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[700px] tabel-kkm-jenjang" id="tabel-{{ $jenjangKey }}">
                                <thead>
                                    <tr class="bg-slate-50/80 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                        <th class="px-4 py-3 w-10 text-center">No</th>
                                        <th class="px-4 py-3 min-w-[200px]">Nama Mata Pelajaran</th>
                                        @foreach($tingkats as $t)
                                            <th class="px-3 py-3 text-center min-w-[100px]">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-slate-700 font-bold text-xs">{{ $t['label'] }}</span>
                                                    <span class="text-[10px] text-slate-400 font-normal lowercase">kkm</span>
                                                </div>
                                            </th>
                                        @endforeach
                                        <th class="px-4 py-3 w-32 text-center">Aksi Cepat</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @if($mapel_jenjang->count() > 0)
                                        @foreach($mapel_jenjang as $mIndex => $m)
                                            <tr class="hover:bg-slate-50/60 transition-colors mapel-row" data-nama="{{ strtolower($m->nama_mapel) }}">
                                                <td class="px-4 py-3.5 text-center text-slate-400 font-medium text-xs">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-3.5">
                                                    <div class="flex items-center gap-2.5">
                                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                                            <i class="fa-solid fa-book"></i>
                                                        </div>
                                                        <div>
                                                            <strong class="font-bold text-slate-800 text-xs sm:text-sm block">{{ $m->nama_mapel }}</strong>
                                                            <span class="text-[11px] text-slate-400 font-mono">ID: MAPEL-{{ str_pad($m->id, 3, '0', STR_PAD_LEFT) }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                @foreach($tingkats as $t)
                                                    @php
                                                        $val_kkm = $m->getKkmTingkat($t['tingkat']);
                                                    @endphp
                                                    <td class="px-3 py-3 text-center">
                                                        <div class="inline-flex flex-col items-center">
                                                            <input type="number" 
                                                                   name="kkm_tingkat[{{ $m->id }}][{{ $t['tingkat'] }}]" 
                                                                   id="kkm-{{ $m->id }}-{{ $t['tingkat'] }}"
                                                                   value="{{ $val_kkm }}" 
                                                                   min="0" max="100" required
                                                                   class="input-kkm-row kkm-input-{{ $jenjangKey }} kkm-row-{{ $m->id }} w-16 px-2 py-1.5 text-xs font-bold text-center text-slate-800 bg-white border border-slate-300 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors">
                                                            <span class="text-[10px] text-slate-400 mt-0.5">/ 100</span>
                                                        </div>
                                                    </td>
                                                @endforeach
                                                <td class="px-4 py-3.5 text-center">
                                                    @if(count($tingkats) > 0)
                                                        <button type="button" 
                                                                onclick="samakanKkmRow({{ $m->id }}, '{{ $tingkats[0]['tingkat'] }}')"
                                                                class="px-2.5 py-1 rounded bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-bold transition-colors inline-flex items-center gap-1 cursor-pointer"
                                                                title="Salin KKM {{ $tingkats[0]['label'] }} ke seluruh tingkatan mapel ini">
                                                            <i class="fa-solid fa-arrows-left-right-to-line text-[10px]"></i> Samakan
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="{{ count($tingkats) + 3 }}" class="px-6 py-10 text-center text-slate-400 text-xs">
                                                Tidak ada data mata pelajaran untuk jenjang {{ strtoupper($s->jenis) }}.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach

                <!-- Footer Bar -->
                <div class="mt-6 px-6 py-4 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3 rounded-b-xl">
                    <span class="text-xs text-slate-500 flex items-center gap-1.5">
                        <i class="fa-solid fa-shield-halved text-emerald-600"></i>
                        <span>KKM yang disimpan langsung berlaku pada rekap rapor dan leger penilaian siswa di masing-masing tingkatan kelas.</span>
                    </span>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs sm:text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2 w-full sm:w-auto cursor-pointer">
                        <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Seluruh KKM Per Tingkatan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Kalkulator & Aksi KKM -->
    <script>
        // 1. Live Calculator & Progress Bar Bobot Penilaian
        const inputsBobot = document.querySelectorAll('.input-bobot');
        const liveTotalVal = document.getElementById('liveTotalVal');
        const liveTotalBadge = document.getElementById('liveTotalBadge');
        const liveTotalText = document.getElementById('liveTotalText');
        const kpiTotalBobot = document.getElementById('kpiTotalBobot');
        const kpiStatusBobot = document.getElementById('kpiStatusBobot');

        function recalculateBobot() {
            let total = 0;
            inputsBobot.forEach(input => {
                const val = parseInt(input.value) || 0;
                total += val;
                const jpId = input.getAttribute('data-jp-id');
                const bar = document.getElementById('bar-jp-' + jpId);
                const legend = document.getElementById('legend-jp-' + jpId);
                const nama = input.getAttribute('data-nama');

                if (bar) {
                    bar.style.width = Math.max(0, Math.min(100, val)) + '%';
                    bar.title = nama + ': ' + val + '%';
                    bar.innerHTML = `<span class="truncate px-1">${nama} (${val}%)</span>`;
                }
                if (legend) {
                    legend.innerText = val + '%';
                }
            });

            if (liveTotalVal) liveTotalVal.innerText = total;
            if (kpiTotalBobot) kpiTotalBobot.innerText = total + '%';

            if (total === 100) {
                if (liveTotalBadge) {
                    liveTotalBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800';
                    liveTotalText.innerText = '(Pas 100%)';
                }
                if (kpiTotalBobot) kpiTotalBobot.className = 'text-2xl font-bold text-emerald-700';
                if (kpiStatusBobot) {
                    kpiStatusBobot.className = 'px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800';
                    kpiStatusBobot.innerText = '✓ Sempurna';
                }
            } else {
                const selisih = 100 - total;
                const ket = selisih > 0 ? `(Kurang ${selisih}%)` : `(Lebih ${Math.abs(selisih)}%)`;
                if (liveTotalBadge) {
                    liveTotalBadge.className = 'px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800';
                    liveTotalText.innerText = ket;
                }
                if (kpiTotalBobot) kpiTotalBobot.className = 'text-2xl font-bold text-rose-700';
                if (kpiStatusBobot) {
                    kpiStatusBobot.className = 'px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800';
                    kpiStatusBobot.innerText = '⚠ Belum 100%';
                }
            }
        }

        inputsBobot.forEach(input => {
            input.addEventListener('input', recalculateBobot);
        });

        function resetBobotStandar() {
            // Standar: Tugas 20%, UH 30%, UTS 20%, UAS 30%
            inputsBobot.forEach(input => {
                const nama = (input.getAttribute('data-nama') || '').toLowerCase();
                if (nama.includes('tugas')) input.value = 20;
                else if (nama.includes('harian') || nama.includes('uh')) input.value = 30;
                else if (nama.includes('uts')) input.value = 20;
                else if (nama.includes('uas')) input.value = 30;
            });
            recalculateBobot();
        }

        // 2. Tab Navigation & KKM Per Tingkatan
        window.currentActiveJenjang = '{{ strtolower($data_sekolah->first()->jenis ?? "sd") }}';

        function switchJenjangTab(jenjangKey) {
            window.currentActiveJenjang = jenjangKey;

            // Update Tab Button Styles
            document.querySelectorAll('.tab-jenjang-btn').forEach(btn => {
                btn.className = 'tab-jenjang-btn px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 bg-slate-100 text-slate-600 hover:bg-slate-200 cursor-pointer';
                const countBadge = btn.querySelector('span:last-child');
                if (countBadge) {
                    countBadge.className = 'px-1.5 py-0.2 rounded-full text-[10px] font-mono bg-white text-slate-600 border border-slate-200';
                }
            });

            const activeBtn = document.getElementById('tab-btn-' + jenjangKey);
            if (activeBtn) {
                activeBtn.className = 'tab-jenjang-btn px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-2 bg-emerald-600 text-white shadow-sm cursor-pointer';
                const countBadge = activeBtn.querySelector('span:last-child');
                if (countBadge) {
                    countBadge.className = 'px-1.5 py-0.2 rounded-full text-[10px] font-mono bg-emerald-700 text-white';
                }
            }

            // Show / Hide Tab Panes
            document.querySelectorAll('.tab-pane-jenjang').forEach(pane => {
                pane.classList.add('hidden');
            });

            const activePane = document.getElementById('pane-jenjang-' + jenjangKey);
            if (activePane) {
                activePane.classList.remove('hidden');
            }
        }

        // KKM Massal pada Tab Aktif
        function terapkanKkmMassal() {
            const massalVal = parseInt(document.getElementById('kkmMassalInput').value) || 75;
            const activeJenjang = window.currentActiveJenjang;
            
            // Set ke semua input KKM di tab yang aktif (atau semua tab jika tidak spesifik)
            const inputs = document.querySelectorAll('.kkm-input-' + activeJenjang);
            if (inputs.length > 0) {
                inputs.forEach(input => {
                    input.value = massalVal;
                });
            } else {
                document.querySelectorAll('.input-kkm-row').forEach(input => {
                    input.value = massalVal;
                });
            }

            const form = document.getElementById('formKkmMapel');
            if (form) {
                if (form.requestSubmit) {
                    form.requestSubmit();
                } else {
                    form.submit();
                }
            }
        }

        // Salin KKM kolom pertama ke seluruh kolom tingkatan pada baris mapel tersebut
        function samakanKkmRow(mapelId, firstTingkat) {
            const firstInput = document.getElementById('kkm-' + mapelId + '-' + firstTingkat);
            if (!firstInput) return;

            const val = parseInt(firstInput.value) || 75;
            document.querySelectorAll('.kkm-row-' + mapelId).forEach(input => {
                input.value = val;
            });
        }

        // Filter pencarian nama mapel
        function filterMapelTable() {
            const keyword = document.getElementById('cariMapelInput').value.toLowerCase();
            const rows = document.querySelectorAll('.mapel-row');
            rows.forEach(row => {
                const nama = row.getAttribute('data-nama') || '';
                if (nama.includes(keyword)) {
                    row.removeAttribute('data-filtered-out');
                    row.style.display = '';
                } else {
                    row.setAttribute('data-filtered-out', 'true');
                    row.style.display = 'none';
                }
            });
        }
    </script>
</x-siakad-layout>


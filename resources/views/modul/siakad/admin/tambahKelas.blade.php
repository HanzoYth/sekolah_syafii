<x-siakad-layout 
    title="Kelola Ruang Kelas" 
    description="Buat, atur, dan kelola seluruh ruang kelas rombongan belajar untuk tahun ajaran aktif." 
    position="Administrator" 
    initials="AD">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dashboard" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Kelola Ruang Kelas</span>
        </li>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5 flex-shrink-0"></i>
            <div class="flex-1">
                <p class="font-semibold text-sm">Berhasil!</p>
                <p class="text-sm mt-0.5 text-emerald-700">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg mt-0.5 flex-shrink-0"></i>
            <div class="flex-1">
                <p class="font-semibold text-sm">Terjadi Kesalahan</p>
                <p class="text-sm mt-0.5 text-rose-700">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- KPI Ringkasan Ruang Kelas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                <i class="fa-solid fa-school"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Total Ruang Kelas</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ count($data_kelas) }}</h3>
                <p class="text-xs text-slate-400 mt-0.5 truncate">Rombel aktif terdaftar</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Total Siswa Terdaftar</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $total_siswa_semua ?? 0 }}</h3>
                <p class="text-xs text-blue-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-users text-[10px] mr-1"></i>Siswa di seluruh kelas</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Sudah Ada Walas</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $total_walas_terisi ?? 0 }}</h3>
                <p class="text-xs text-emerald-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Wali kelas ditugaskan</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                <i class="fa-solid fa-clipboard-user"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Belum Berwali</p>
                <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ $total_walas_kosong ?? 0 }}</h3>
                <p class="text-xs text-amber-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-clock text-[10px] mr-1"></i>Perlu penugasan walas</p>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- BAGIAN 1 (VERTIKAL - ATAS): FORM BUAT KELAS BARU         -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 mb-8">
        <div class="flex items-center gap-3 pb-4 mb-5 border-b border-slate-100">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                <i class="fa-solid fa-plus"></i>
            </div>
            <div>
                <h2 class="text-base sm:text-lg font-bold text-slate-800">1. Buat Ruang Kelas Baru</h2>
                <p class="text-xs sm:text-sm text-slate-500">Konfigurasi dan daftarkan rombongan belajar baru untuk tahun ajaran aktif.</p>
            </div>
        </div>

        <form action="/sk/simpan-kelas" method="POST" id="formBuatKelas">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 items-end">
                <!-- Dropdown Jenjang -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Jenjang Sekolah <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-school absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <select name="tingkat_sekolah" id="inputJenjang" onchange="updateNamePreview()" required class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors">
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="TK">Taman Kanak-kanak (TK)</option>
                            <option value="SD">Sekolah Dasar (SD)</option>
                            <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                            <option value="SMA">Sekolah Menengah Atas (SMA)</option>
                        </select>
                    </div>
                </div>

                <!-- Dropdown Tingkat / Nomor -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Tingkat / Nomor Kelas <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-layer-group absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <select name="no_kelas" id="inputTingkat" onchange="updateNamePreview()" required class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors">
                            <option value="">-- Pilih Tingkat --</option>
                            <optgroup label="Taman Kanak-kanak">
                                <option value="A">TK A</option>
                                <option value="B">TK B</option>
                            </optgroup>
                            <optgroup label="Pendidikan Dasar & Menengah">
                                @for($i=1; $i<=12; $i++)
                                    <option value="{{ $i }}">Kelas {{ $i }}</option>
                                @endfor
                            </optgroup>
                        </select>
                    </div>
                </div>

                <!-- Input Tipe / Pararel -->
                <div>
                    <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama / Tipe Pararel <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <i class="fa-solid fa-signature absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" name="tipe_kelas" id="inputPararel" onkeyup="updateNamePreview()" required placeholder="Contoh: UNGGULAN, IPA 1, A" class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium placeholder-slate-400 focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors" autocomplete="off">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-bold shadow-sm transition-all">
                        <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Ruang Kelas
                    </button>
                </div>
            </div>

            <!-- Live Preview Bar -->
            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between gap-2 text-xs text-slate-500">
                <div class="flex items-center gap-2">
                    <span class="font-medium text-slate-400">Pratinjau Hasil Format Nama:</span>
                    <span id="previewNamaKelas" class="font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                        (Lengkapi formulir di atas)
                    </span>
                </div>
                <span class="text-[11px] text-slate-400 italic">Format otomatis: [Jenjang] Kelas [Tingkat] [Tipe Pararel]</span>
            </div>
        </form>
    </div>


    <!-- ======================================================== -->
    <!-- BAGIAN 2 (VERTIKAL - BAWAH): TABEL DAFTAR RUANG KELAS    -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <!-- Header Tabel -->
        <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base flex-shrink-0">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap">
                        <h3 class="text-base font-bold text-slate-800">2. Daftar Seluruh Ruang Kelas</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                            {{ count($data_kelas) }} Kelas Terdaftar
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 mt-0.5">Pantau kapasitas siswa, penugasan wali kelas, serta aksi edit atau hapus kelas.</p>
                </div>
            </div>

            <!-- Toolbar Kanan: Live Search -->
            <div class="relative w-full md:w-72">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                <input type="text" id="searchKelasInput" onkeyup="filterTableKelas()" placeholder="Cari nama kelas / wali kelas..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-500 shadow-sm">
            </div>
        </div>

        <!-- Filter Tab Jenjang Cepat -->
        <div class="px-5 sm:px-6 py-2.5 bg-slate-50 border-b border-slate-200 flex flex-wrap items-center gap-2 text-xs">
            <span class="font-semibold text-slate-500 mr-1">Filter Jenjang:</span>
            <button type="button" onclick="filterByJenjang('SEMUA')" class="jenjang-filter-btn px-3 py-1 rounded-md font-bold transition-colors bg-emerald-600 text-white shadow-sm" data-jenjang="SEMUA">
                Semua
            </button>
            <button type="button" onclick="filterByJenjang('TK')" class="jenjang-filter-btn px-3 py-1 rounded-md font-semibold text-slate-600 hover:bg-slate-200 transition-colors" data-jenjang="TK">
                TK
            </button>
            <button type="button" onclick="filterByJenjang('SD')" class="jenjang-filter-btn px-3 py-1 rounded-md font-semibold text-slate-600 hover:bg-slate-200 transition-colors" data-jenjang="SD">
                SD
            </button>
            <button type="button" onclick="filterByJenjang('SMP')" class="jenjang-filter-btn px-3 py-1 rounded-md font-semibold text-slate-600 hover:bg-slate-200 transition-colors" data-jenjang="SMP">
                SMP
            </button>
            <button type="button" onclick="filterByJenjang('SMA')" class="jenjang-filter-btn px-3 py-1 rounded-md font-semibold text-slate-600 hover:bg-slate-200 transition-colors" data-jenjang="SMA">
                SMA
            </button>
        </div>

        <!-- Tabel Konten -->
        <div class="overflow-x-auto">
            <table id="tableRuangKelas" class="w-full text-left border-collapse min-w-[750px]">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                        <th class="px-5 py-3.5 text-center w-16">No</th>
                        <th class="px-5 py-3.5">Nama Ruang Kelas</th>
                        <th class="px-5 py-3.5 w-32">Jenjang</th>
                        <th class="px-5 py-3.5 w-44">Jumlah Siswa</th>
                        <th class="px-5 py-3.5 w-52">Wali Kelas</th>
                        <th class="px-5 py-3.5 text-center w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @if(count($data_kelas) > 0)
                        @foreach($data_kelas as $index => $k)
                            <tr class="kelas-row hover:bg-slate-50/70 transition-colors" data-jenjang="{{ $k->jenjang ?? 'UMUM' }}">
                                <td class="px-5 py-3.5 text-center text-slate-500 font-medium text-xs">{{ $index + 1 }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                            <i class="fa-solid fa-chalkboard-user"></i>
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block text-sm">{{ $k->nama_kelas }}</span>
                                            <span class="text-[11px] text-slate-400">ID Kelas: #{{ $k->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    @php
                                        $j = $k->jenjang ?? 'UMUM';
                                        $badgeBg = match($j) {
                                            'TK' => 'bg-pink-50 text-pink-700 border-pink-100',
                                            'SD' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'SMP' => 'bg-blue-50 text-blue-700 border-blue-100',
                                            'SMA' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                            default => 'bg-slate-100 text-slate-700 border-slate-200'
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold border {{ $badgeBg }}">
                                        {{ $j }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <a href="/sk/pembagian-kelas?kelas_id={{ $k->ruang_id }}" class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg {{ $k->total_siswa > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200 hover:bg-slate-200' }} text-xs font-semibold transition-colors" title="Buka kelola pembagian kelas ini">
                                        <i class="fa-solid fa-users text-[11px]"></i>
                                        <span>{{ $k->total_siswa }} Siswa</span>
                                        <i class="fa-solid fa-arrow-up-right-from-square text-[9px] ml-0.5 text-slate-400"></i>
                                    </a>
                                </td>
                                <td class="px-5 py-3.5">
                                    @if($k->nama_walas)
                                        <div class="flex items-center space-x-2">
                                            <i class="fa-solid fa-user-check text-emerald-500 text-xs"></i>
                                            <span class="text-xs font-medium text-slate-800">{{ $k->nama_walas }}</span>
                                        </div>
                                    @else
                                        <a href="/sk/kelola-wali-kelas" class="inline-flex items-center gap-1 text-xs text-amber-600 hover:text-amber-700 font-semibold" title="Tetapkan wali kelas">
                                            <i class="fa-solid fa-triangle-exclamation text-[11px]"></i> Belum Ada Walas
                                        </a>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <!-- Tombol Edit -->
                                        <a href="/sk/edit-kelas/{{ $k->id }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 border border-blue-200 flex items-center justify-center text-xs transition-colors" title="Ubah Nama Kelas">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <button type="button" onclick="konfirmasiHapusKelas({{ $k->id }}, '{{ addslashes($k->nama_kelas) }}')" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 border border-rose-200 flex items-center justify-center text-xs transition-colors" title="Hapus Ruang Kelas">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="empty-row">
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <i class="fa-solid fa-folder-open text-2xl"></i>
                                </div>
                                <h4 class="text-sm font-semibold text-slate-700">Belum Ada Ruang Kelas</h4>
                                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Silakan gunakan form di atas untuk membuat dan mendaftarkan ruang kelas baru.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Kelas -->
    <div id="modalHapusKelas" class="fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 animate-in fade-in zoom-in-95 duration-200">
            <div class="flex items-center gap-3.5 text-rose-600 mb-4">
                <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center flex-shrink-0 text-lg">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Konfirmasi Hapus Ruang Kelas</h3>
                    <p class="text-xs text-slate-500">Tindakan ini memerlukan perhatian</p>
                </div>
            </div>
            
            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed mb-4">
                Apakah Anda yakin ingin menghapus kelas <strong id="namaKelasTarget" class="text-slate-800"></strong>?
            </p>
            <div class="p-3 bg-amber-50 border border-amber-200 rounded-lg text-[11px] text-amber-800 mb-5">
                <i class="fa-solid fa-circle-info mr-1"></i> Kelas hanya dapat dihapus apabila tidak memiliki siswa terdaftar dan tidak memiliki jadwal pelajaran aktif.
            </div>

            <div class="flex items-center justify-end gap-2.5">
                <button type="button" onclick="tutupModalHapus()" class="px-4 py-2 rounded-lg border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <a id="btnEksekusiHapus" href="#" class="px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-xs font-bold text-white shadow-sm transition-colors">
                    Ya, Hapus Kelas
                </a>
            </div>
        </div>
    </div>

    <script>
        // Update Live Name Preview
        function updateNamePreview() {
            const jenjang = document.getElementById('inputJenjang').value;
            const tingkat = document.getElementById('inputTingkat').value;
            const pararel = document.getElementById('inputPararel').value.trim();
            const previewEl = document.getElementById('previewNamaKelas');

            if (jenjang && tingkat && pararel) {
                previewEl.innerText = `${jenjang} Kelas ${tingkat} ${pararel.toUpperCase()}`;
                previewEl.className = "font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200";
            } else if (jenjang || tingkat || pararel) {
                const j = jenjang || '[Jenjang]';
                const t = tingkat ? `Kelas ${tingkat}` : 'Kelas [...]';
                const p = pararel ? pararel.toUpperCase() : '[Tipe]';
                previewEl.innerText = `${j} ${t} ${p}`;
                previewEl.className = "font-semibold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-md border border-slate-200";
            } else {
                previewEl.innerText = "(Lengkapi formulir di atas)";
                previewEl.className = "font-semibold text-slate-400 bg-slate-50 px-2.5 py-1 rounded-md border border-slate-200";
            }
        }

        let activeJenjang = 'SEMUA';

        function applyKelasFilters() {
            const input = document.getElementById('searchKelasInput');
            const filter = input ? input.value.toLowerCase().trim() : '';
            const rows = document.querySelectorAll('.kelas-row');

            rows.forEach(row => {
                const rowJenjang = row.getAttribute('data-jenjang');
                const matchJenjang = (activeJenjang === 'SEMUA' || rowJenjang === activeJenjang);
                const matchSearch = (!filter || row.innerText.toLowerCase().indexOf(filter) > -1);
                const show = matchJenjang && matchSearch;
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
            });

            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
        }

        // Live Table Search
        function filterTableKelas() {
            applyKelasFilters();
        }

        // Filter by Jenjang Buttons
        function filterByJenjang(jenjang) {
            activeJenjang = jenjang;
            // Update button styles
            const buttons = document.querySelectorAll('.jenjang-filter-btn');
            buttons.forEach(btn => {
                if (btn.getAttribute('data-jenjang') === jenjang) {
                    btn.className = "jenjang-filter-btn px-3 py-1 rounded-md font-bold transition-colors bg-emerald-600 text-white shadow-sm";
                } else {
                    btn.className = "jenjang-filter-btn px-3 py-1 rounded-md font-semibold text-slate-600 hover:bg-slate-200 transition-colors";
                }
            });

            applyKelasFilters();
        }

        // Modal Konfirmasi Hapus
        function konfirmasiHapusKelas(id, nama) {
            document.getElementById('namaKelasTarget').innerText = `"${nama}"`;
            document.getElementById('btnEksekusiHapus').href = `/sk/hapus-kelas/${id}`;
            const modal = document.getElementById('modalHapusKelas');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function tutupModalHapus() {
            const modal = document.getElementById('modalHapusKelas');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Tutup modal jika klik di luar area dialog
        window.onclick = function(event) {
            const modal = document.getElementById('modalHapusKelas');
            if (event.target === modal) {
                tutupModalHapus();
            }
        }
    </script>
</x-siakad-layout>

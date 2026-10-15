<x-siakad-layout 
    title="Pembagian Kelas Siswa" 
    description="Atur penempatan dan distribusi peserta didik ke dalam ruang kelas secara terstruktur." 
    position="Administrator" 
    initials="AD">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dashboard" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Pembagian Kelas</span>
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

    <!-- Card Filter & Pemilihan Kelas -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-4 mb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-lg flex-shrink-0">
                    <i class="fa-solid fa-users-gear"></i>
                </div>
                <div>
                    <h2 class="text-base sm:text-lg font-bold text-slate-800">Pembagian Ruang Kelas Siswa</h2>
                    <p class="text-xs sm:text-sm text-slate-500">Pilih jenjang dan ruang kelas tujuan untuk mengelola daftar anggotanya.</p>
                </div>
            </div>
            @if($kelas_id || $sekolah_id)
                <a href="/sk/pembagian-kelas" class="inline-flex items-center text-xs font-semibold text-slate-500 hover:text-rose-600 transition-colors self-start sm:self-auto">
                    <i class="fa-solid fa-rotate-left mr-1.5"></i> Reset Filter
                </a>
            @endif
        </div>

        <form method="GET" action="/sk/pembagian-kelas" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
            <!-- Filter Jenjang / Satuan Pendidikan -->
            <div class="sm:col-span-5">
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Filter Jenjang Sekolah</label>
                <div class="relative">
                    <i class="fa-solid fa-school absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <select name="sekolah_id" onchange="this.form.submit()" class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors">
                        <option value="">Semua Jenjang</option>
                        @foreach($data_sekolah as $s)
                            <option value="{{ $s->id }}" {{ ($sekolah_id ?? '') == $s->id ? 'selected' : '' }}>
                                Jenjang {{ strtoupper($s->jenis) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Pilih Ruang Kelas -->
            <div class="sm:col-span-5">
                <label class="block text-xs font-semibold text-slate-600 mb-1.5">Pilih Ruang Kelas <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <i class="fa-solid fa-chalkboard absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <select name="kelas_id" required class="w-full pl-9 pr-3 py-2.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:bg-white focus:outline-none focus:border-emerald-500 transition-colors">
                        <option value="">-- Pilih Ruang Kelas --</option>
                        @foreach($data_kelas as $k)
                            <option value="{{ $k->id }}" {{ $kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_ruang }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Tombol Tampilkan -->
            <div class="sm:col-span-2">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs sm:text-sm font-semibold transition-colors shadow-sm">
                    <i class="fa-solid fa-filter text-xs"></i> Tampilkan
                </button>
            </div>
        </form>
    </div>

    @if($kelas_id && $kelas_terpilih)
        <!-- Ringkasan KPI Status Kelas -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                    <i class="fa-solid fa-door-open"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Kelas Terpilih</p>
                    <h3 class="text-base sm:text-lg font-bold text-slate-800 break-words leading-snug mt-0.5">{{ $kelas_terpilih->nama_ruang }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5 truncate">Ruang rombel tujuan</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                    <i class="fa-solid fa-user-check"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Anggota Saat Ini</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ count($siswa_di_kelas) }}</h3>
                    <p class="text-xs text-emerald-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-circle-check text-[10px] mr-1"></i>Siswa aktif terdaftar</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 flex items-center space-x-3.5 min-w-0">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0 text-xl font-bold">
                    <i class="fa-solid fa-user-clock"></i>
                </div>
                <div class="min-w-0 flex-1">
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider truncate">Belum Ada Kelas</p>
                    <h3 class="text-xl sm:text-2xl font-bold text-slate-800 mt-0.5 truncate">{{ count($siswa_belum_ada_kelas) }}</h3>
                    <p class="text-xs text-amber-600 font-semibold mt-0.5 truncate"><i class="fa-solid fa-clock text-[10px] mr-1"></i>Tersedia untuk dimasukkan</p>
                </div>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TABEL 1 (VERTIKAL - ATAS): ANGGOTA KELAS SAAT INI        -->
        <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center font-bold text-base flex-shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-bold text-slate-800">1. Anggota Kelas Saat Ini: {{ $kelas_terpilih->nama_ruang }}</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                {{ count($siswa_di_kelas) }} Siswa
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">Daftar seluruh siswa yang telah terdaftar resmi di kelas ini.</p>
                    </div>
                </div>

                <!-- Input Pencarian Anggota Kelas -->
                @if(count($siswa_di_kelas) > 0)
                    <div class="relative w-full md:w-64">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" id="searchAnggotaInput" onkeyup="filterTable('searchAnggotaInput', 'tableAnggotaKelas')" placeholder="Cari nama / NIS siswa..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-500 shadow-sm">
                    </div>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table id="tableAnggotaKelas" class="w-full text-left border-collapse min-w-[650px]">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                            <th class="px-5 py-3.5 text-center w-16">No</th>
                            <th class="px-5 py-3.5 w-32">NIS</th>
                            <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                            <th class="px-5 py-3.5 w-32">Jenis Kelamin</th>
                            <th class="px-5 py-3.5 w-32">Jenjang</th>
                            <th class="px-5 py-3.5 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @if(count($siswa_di_kelas) > 0)
                            @foreach($siswa_di_kelas as $index => $s)
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-3.5 text-center text-slate-500 font-medium text-xs">{{ $index + 1 }}</td>
                                    <td class="px-5 py-3.5 font-mono text-xs font-semibold text-slate-600">{{ $s->nis ?? '-' }}</td>
                                    <td class="px-5 py-3.5">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                {{ substr($s->nama, 0, 2) }}
                                            </div>
                                            <div>
                                                <span class="font-semibold text-slate-800 block">{{ $s->nama }}</span>
                                                <span class="text-[11px] text-slate-400">ID: #{{ $s->id }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        @if(strtolower($s->gender) == 'l')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                <i class="fa-solid fa-mars text-[10px] mr-1"></i> Laki-laki
                                            </span>
                                        @elseif(strtolower($s->gender) == 'p')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                                <i class="fa-solid fa-venus text-[10px] mr-1"></i> Perempuan
                                            </span>
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                            {{ strtoupper($s->sekolah->jenis ?? '-') }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                        <a href="/sk/hapus-anggota-kelas/{{ $s->id }}" 
                                           onclick="return confirm('Apakah Anda yakin ingin mengeluarkan siswa \'{{ addslashes($s->nama) }}\' dari kelas {{ addslashes($kelas_terpilih->nama_ruang) }}? Siswa akan berstatus belum memiliki kelas.')" 
                                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-xs font-semibold transition-colors"
                                           title="Keluarkan dari rombel ini">
                                            <i class="fa-solid fa-user-minus text-[11px]"></i> Keluarkan
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="empty-row">
                                <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <i class="fa-solid fa-users-slash text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-semibold text-slate-700">Kelas Ini Masih Kosong</h4>
                                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Belum ada siswa yang ditempatkan di kelas {{ $kelas_terpilih->nama_ruang }}. Pilih dan masukkan siswa dari daftar di bawah.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>


        <!-- ======================================================== -->
        <!-- TABEL 2 (VERTIKAL - BAWAH): TAMBAH SISWA KE KELAS        -->
        <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <form action="/sk/simpan-pembagian-kelas" method="POST" id="formTambahSiswa">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">

                <!-- Header Panel Tambah Siswa -->
                <div class="px-5 sm:px-6 py-4 sm:py-5 border-b border-slate-200 bg-amber-50/40 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center font-bold text-base flex-shrink-0">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-base font-bold text-slate-800">2. Tambahkan Siswa ke Kelas Ini</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                    {{ count($siswa_belum_ada_kelas) }} Siswa Tersedia
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mt-0.5">Pilih siswa yang belum memiliki kelas di bawah ini untuk dimasukkan ke rombel <strong>{{ $kelas_terpilih->nama_ruang }}</strong>.</p>
                        </div>
                    </div>

                    <!-- Tombol Submit Atas -->
                    @if(count($siswa_belum_ada_kelas) > 0)
                        <div class="flex items-center gap-2 self-end md:self-center">
                            <button type="submit" id="btnSubmitTop" disabled class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed text-white text-xs font-bold transition-all shadow-sm">
                                <i class="fa-solid fa-arrow-down-to-bracket text-xs"></i> Masukkan Siswa Terpilih
                            </button>
                        </div>
                    @endif
                </div>

                <!-- Action Toolbar: Check All & Live Search -->
                @if(count($siswa_belum_ada_kelas) > 0)
                    <div class="p-3.5 sm:p-4 bg-slate-50 border-b border-slate-200 flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700 bg-white px-3 py-1.5 rounded-lg border border-slate-200 hover:bg-slate-50 transition-colors select-none">
                                <input type="checkbox" id="checkAllMaster" onchange="toggleSelectAll(this)" class="w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                                <span>Pilih Semua</span>
                            </label>

                            <span id="selectedCountBadge" class="text-xs font-semibold text-slate-600 bg-white px-3 py-1.5 rounded-lg border border-slate-200">
                                0 siswa dipilih
                            </span>
                        </div>

                        <!-- Live Search Input -->
                        <div class="relative w-full sm:w-64">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                            <input type="text" id="searchBelumAdaInput" onkeyup="filterTable('searchBelumAdaInput', 'tableBelumAdaKelas')" placeholder="Filter siswa belum ada kelas..." class="w-full pl-8 pr-3 py-1.5 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 placeholder-slate-400 focus:outline-none focus:border-emerald-500 shadow-sm">
                        </div>
                    </div>
                @endif

                <!-- Tabel Siswa Belum Ada Kelas -->
                <div class="overflow-x-auto max-h-[520px] overflow-y-auto">
                    <table id="tableBelumAdaKelas" class="w-full text-left border-collapse min-w-[650px]">
                        <thead class="sticky top-0 z-10 bg-slate-100 shadow-sm">
                            <tr class="border-b border-slate-200 text-slate-600 text-xs font-semibold uppercase tracking-wider">
                                <th class="px-5 py-3.5 text-center w-14">Pilih</th>
                                <th class="px-5 py-3.5 text-center w-14">No</th>
                                <th class="px-5 py-3.5 w-32">NIS</th>
                                <th class="px-5 py-3.5">Nama Lengkap Siswa</th>
                                <th class="px-5 py-3.5 w-32">Jenis Kelamin</th>
                                <th class="px-5 py-3.5 w-32">Asal Jenjang</th>
                                <th class="px-5 py-3.5 text-center w-36">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @if(count($siswa_belum_ada_kelas) > 0)
                                @foreach($siswa_belum_ada_kelas as $index => $s)
                                    <tr onclick="toggleRowCheckbox(event, this)" class="hover:bg-amber-50/40 transition-colors cursor-pointer select-none">
                                        <td class="px-5 py-3.5 text-center">
                                            <input type="checkbox" name="siswa_ids[]" value="{{ $s->id }}" onchange="updateSelectedCount()" class="siswa-checkbox w-4 h-4 rounded text-emerald-600 focus:ring-emerald-500 border-slate-300">
                                        </td>
                                        <td class="px-5 py-3.5 text-center text-slate-500 font-medium text-xs">{{ $index + 1 }}</td>
                                        <td class="px-5 py-3.5 font-mono text-xs font-semibold text-slate-600">{{ $s->nis ?? '-' }}</td>
                                        <td class="px-5 py-3.5">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                                    {{ substr($s->nama, 0, 2) }}
                                                </div>
                                                <div>
                                                    <strong class="text-slate-800 block font-semibold">{{ $s->nama }}</strong>
                                                    <span class="text-[11px] text-slate-400">ID: #{{ $s->id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-3.5">
                                            @if(strtolower($s->gender) == 'l')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                                    <i class="fa-solid fa-mars text-[10px] mr-1"></i> Laki-laki
                                                </span>
                                            @elseif(strtolower($s->gender) == 'p')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-rose-50 text-rose-700 border border-rose-100">
                                                    <i class="fa-solid fa-venus text-[10px] mr-1"></i> Perempuan
                                                </span>
                                            @else
                                                <span class="text-xs text-slate-400">-</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3.5">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                                {{ strtoupper($s->sekolah->jenis ?? '-') }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-3.5 text-center">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                <i class="fa-solid fa-clock text-[10px] mr-1"></i> Belum Ada Kelas
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="empty-row">
                                    <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-2xl">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                        <h4 class="text-sm font-semibold text-slate-800">Semua Siswa Sudah Masuk Kelas</h4>
                                        <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Tidak ada peserta didik pada filter jenjang ini yang belum memiliki ruang kelas.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Footer Action Panel Bawah -->
                @if(count($siswa_belum_ada_kelas) > 0)
                    <div class="p-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="text-xs text-slate-500">
                            <span id="bottomSelectedCount" class="font-bold text-emerald-700">0 siswa dipilih</span> untuk dimasukkan ke rombel <strong>{{ $kelas_terpilih->nama_ruang }}</strong>.
                        </div>
                        <button type="submit" id="btnSubmitBottom" disabled class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 disabled:bg-slate-200 disabled:text-slate-400 disabled:cursor-not-allowed text-white text-xs font-bold transition-all shadow-sm">
                            <i class="fa-solid fa-arrow-down-to-bracket text-xs"></i> Masukkan Siswa Terpilih ke Kelas
                        </button>
                    </div>
                @endif
            </form>
        </div>
    @else
        <!-- State Awal: Belum Memilih Kelas -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center text-slate-500">
            <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                <i class="fa-solid fa-chalkboard-user text-2xl"></i>
            </div>
            <h4 class="text-base font-semibold text-slate-800">Silakan Pilih Ruang Kelas Terlebih Dahulu</h4>
            <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto">
                Pilih jenjang sekolah dan nama ruang kelas melalui form filter di atas untuk melihat daftar anggota kelas serta menambahkan siswa baru ke dalamnya.
            </p>
        </div>
    @endif

    <script>
        // Check All toggle
        function toggleSelectAll(master) {
            const checkboxes = document.querySelectorAll('.siswa-checkbox');
            checkboxes.forEach(cb => {
                const row = cb.closest('tr');
                if (row && row.style.display !== 'none') {
                    cb.checked = master.checked;
                }
            });
            updateSelectedCount();
        }

        // Live selection counter and button enable/disable
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.siswa-checkbox:checked');
            const count = checkboxes.length;
            const badge = document.getElementById('selectedCountBadge');
            const btnTop = document.getElementById('btnSubmitTop');
            const btnBottom = document.getElementById('btnSubmitBottom');
            const bottomCount = document.getElementById('bottomSelectedCount');

            if (badge) badge.innerText = `${count} siswa dipilih`;
            if (bottomCount) bottomCount.innerText = `${count} siswa dipilih`;

            if (btnTop) btnTop.disabled = (count === 0);
            if (btnBottom) btnBottom.disabled = (count === 0);

            // Update master checkbox state
            const allCheckboxes = document.querySelectorAll('.siswa-checkbox');
            const master = document.getElementById('checkAllMaster');
            if (master && allCheckboxes.length > 0) {
                master.checked = (count === allCheckboxes.length);
            }
        }

        // Click row to toggle checkbox
        function toggleRowCheckbox(event, row) {
            if (event.target.tagName === 'INPUT' || event.target.tagName === 'A' || event.target.tagName === 'BUTTON' || event.target.closest('a')) {
                return;
            }
            const cb = row.querySelector('.siswa-checkbox');
            if (cb) {
                cb.checked = !cb.checked;
                updateSelectedCount();
            }
        }

        // Real-time table filter
        function filterTable(inputId, tableId) {
            const input = document.getElementById(inputId);
            if (!input) return;
            const filter = input.value.toLowerCase().trim();
            const table = document.getElementById(tableId);
            if (!table) return;
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                if (row.classList.contains('empty-row')) continue;
                const text = row.innerText.toLowerCase();
                const show = (text.indexOf(filter) > -1);
                row.setAttribute('data-filtered-out', show ? 'false' : 'true');
            }
            if (window.refreshSiakadPagination) window.refreshSiakadPagination();
        }
    </script>
</x-siakad-layout>

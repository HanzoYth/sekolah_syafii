<x-siakad-layout>
    <x-slot name="title">Dashboard {{ $roleTitle ?? 'Admin' }}</x-slot>
    <x-slot name="subtitle">
        @if($isKepsek ?? false)
            Pantau pengawasan kurikulum, jadwal pelajaran, rombel kelas, dan santri.
        @elseif($isBendahara ?? false)
            Pantau ringkasan tagihan, penerimaan kas, dan administrasi keuangan santri.
        @else
            Pantau ringkasan data akademik dan administrasi sekolah.
        @endif
    </x-slot>
    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <span class="text-slate-700">Dashboard</span>
        </li>
    </x-slot>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @if($isKepsek ?? false)
            {{-- STATS KEPALA SEKOLAH & WAKASEK (FOKUS AKADEMIK) --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                    <i class="fa-solid fa-user-graduate text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Siswa Terdaftar</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahSiswa) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">{{ number_format($jumlahSiswaAktif) }} siswa aktif</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                    <i class="fa-solid fa-school text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Rombel / Kelas</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahKelas) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Data kelas terdaftar</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="fa-solid fa-book text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Mata Pelajaran</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahMapel ?? 0) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Kurikulum aktif</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                    <i class="fa-solid fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Jadwal KBM</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahJadwal ?? 0) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Sesi pelajaran aktif</p>
                </div>
            </div>

        @elseif($isBendahara ?? false)
            {{-- STATS BENDAHARA (FOKUS KEUANGAN) --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Tagihan Terbit</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahTagihan) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">IPP, pangkal, & pendidikan</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Tagihan Lunas</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format(max(0, $jumlahTagihan - $jumlahTunggakan)) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Pembayaran terverifikasi</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                    <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Tagihan Menunggak</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahTunggakan) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Belum lunas / tertunda</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-lg">
                    <i class="fa-solid fa-chart-pie text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Persentase Lunas</p>
                    @php
                        $rasioLunas = $jumlahTagihan > 0 ? round((($jumlahTagihan - $jumlahTunggakan) / $jumlahTagihan) * 100) : 0;
                    @endphp
                    <h3 class="text-2xl font-bold text-slate-800">{{ $rasioLunas }}%</h3>
                    <p class="text-xs text-slate-400 mt-1">Tingkat kepatuhan santri</p>
                </div>
            </div>

        @else
            {{-- STATS ADMIN (LENGKAP: AKADEMIK + KEUANGAN) --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                    <i class="fa-solid fa-user-graduate text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Siswa Terdaftar</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahSiswa) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">{{ number_format($jumlahSiswaAktif) }} siswa aktif</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Tagihan Akademik</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahTagihan) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">IPP, pangkal, & pendidikan</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                    <i class="fa-solid fa-school text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Rombel / Kelas</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahKelas) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Data kelas terdaftar</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
                <div class="p-3 bg-rose-50 text-rose-600 rounded-lg">
                    <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Tagihan Menunggak</p>
                    <h3 class="text-2xl font-bold text-slate-800">{{ number_format($jumlahTunggakan) }}</h3>
                    <p class="text-xs text-slate-400 mt-1">Memerlukan tindak lanjut</p>
                </div>
            </div>
        @endif
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        @if($isKepsek ?? false)
            {{-- MAIN GRID KEPSEK & WAKASEK --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Fokus & Pengawasan Akademik</h3>
                        <p class="text-sm text-slate-500">Ringkasan rombel, jadwal, dan kurikulum</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                        {{ number_format($jumlahSiswaAktif) }} Santri Aktif
                    </span>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Data Siswa Terdaftar</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahSiswa) }} siswa tercatat dalam sistem akademik.</p>
                            </div>
                        </div>
                        <a href="/sk/ds" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Lihat <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                                <i class="fa-solid fa-school"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Ruang & Rombongan Belajar</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahKelas) }} rombel kelas tersedia untuk KBM.</p>
                            </div>
                        </div>
                        <a href="/sk/tk" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Kelola <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg">
                                <i class="fa-solid fa-calendar-alt"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Jadwal Pelajaran & KBM</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahJadwal ?? 0) }} jadwal KBM telah dialokasikan pada kalender.</p>
                            </div>
                        </div>
                        <a href="/sk/kelola-jadwal" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Tinjau <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Ringkasan Kurikulum -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50">
                    <h3 class="text-base font-semibold text-slate-800">Ringkasan Kurikulum</h3>
                    <p class="text-sm text-slate-500">Mata pelajaran dan penilaian</p>
                </div>
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="text-sm text-slate-600">Total Mata Pelajaran</span>
                            <span class="font-bold text-slate-800">{{ number_format($jumlahMapel ?? 0) }} Mapel</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="text-sm text-slate-600">Total Rombel Kelas</span>
                            <span class="font-bold text-slate-800">{{ number_format($jumlahKelas) }} Rombel</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="text-sm text-slate-600">Alokasi Jadwal KBM</span>
                            <span class="font-bold text-indigo-600">{{ number_format($jumlahJadwal ?? 0) }} Sesi</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="/sk/kelola-mapel" class="block text-center py-2 px-4 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition-colors">
                            Kelola Mata Pelajaran
                        </a>
                    </div>
                </div>
            </div>

        @elseif($isBendahara ?? false)
            {{-- MAIN GRID BENDAHARA (FOKUS KEUANGAN & PEMBAYARAN) --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Prioritas Administrasi Keuangan</h3>
                        <p class="text-sm text-slate-500">Monitoring penerimaan tagihan santri</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                        {{ number_format($jumlahTunggakan) }} tagihan menunggak
                    </span>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-rose-50 text-rose-600 rounded-lg">
                                <i class="fa-solid fa-file-circle-exclamation"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Tagihan Belum Lunas</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahTunggakan) }} tagihan tercatat belum lunas pada data pembayaran.</p>
                            </div>
                        </div>
                        <a href="/sk/pb" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Tinjau <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Penerimaan IPP Bulanan</p>
                                <p class="text-xs text-slate-500">Kelola slip dan verifikasi pembayaran SPP / IPP santri.</p>
                            </div>
                        </div>
                        <a href="/sk/pb" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Kelola <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                                <i class="fa-solid fa-money-check-dollar"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Uang Pangkal & Pendidikan</p>
                                <p class="text-xs text-slate-500">Monitoring cicilan dan pelunasan uang pangkal santri baru.</p>
                            </div>
                        </div>
                        <a href="/sk/pp" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Kelola <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Administrasi Donut -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Administrasi</h3>
                        <p class="text-sm text-slate-500">Ringkasan tagihan</p>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col items-center justify-center">
                    <div class="relative flex items-center justify-center mb-8">
                        <div class="w-32 h-32 rounded-full border-8 border-slate-100 flex items-center justify-center">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-slate-800">{{ number_format($jumlahTagihan) }}</span>
                                <span class="block text-xs text-slate-500">Total</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="text-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="block text-xl font-bold text-emerald-600">{{ number_format(max(0, $jumlahTagihan - $jumlahTunggakan)) }}</span>
                            <span class="block text-xs text-slate-500">Lunas</span>
                        </div>
                        <div class="text-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="block text-xl font-bold text-rose-600">{{ number_format($jumlahTunggakan) }}</span>
                            <span class="block text-xs text-slate-500">Menunggak</span>
                        </div>
                    </div>
                </div>
            </div>

        @else
            {{-- MAIN GRID ADMIN (DEFAULT) --}}
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Perlu Ditindaklanjuti</h3>
                        <p class="text-sm text-slate-500">Prioritas administrasi dan akademik</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                        {{ number_format($jumlahTunggakan) }} tagihan
                    </span>
                </div>
                <div class="divide-y divide-slate-100">
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-rose-50 text-rose-600 rounded-lg">
                                <i class="fa-solid fa-file-circle-exclamation"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Tagihan belum lunas</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahTunggakan) }} tagihan tercatat belum lunas pada data pembayaran.</p>
                            </div>
                        </div>
                        <a href="/sk/pb" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Tinjau <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Data siswa terdaftar</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahSiswa) }} siswa tercatat dalam sistem akademik.</p>
                            </div>
                        </div>
                        <a href="/sk/ds" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Lihat <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                    <div class="p-6 flex items-center justify-between hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="p-2 bg-amber-50 text-amber-600 rounded-lg">
                                <i class="fa-solid fa-school"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-800">Ruang kelas</p>
                                <p class="text-xs text-slate-500">{{ number_format($jumlahKelas) }} ruang kelas tersedia untuk pengelolaan akademik.</p>
                            </div>
                        </div>
                        <a href="/sk/tk" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center">
                            Kelola <i class="fa-solid fa-chevron-right ml-1 text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Administrasi Donut -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Administrasi</h3>
                        <p class="text-sm text-slate-500">Ringkasan tagihan</p>
                    </div>
                </div>
                <div class="p-6 flex-1 flex flex-col items-center justify-center">
                    <div class="relative flex items-center justify-center mb-8">
                        <div class="w-32 h-32 rounded-full border-8 border-slate-100 flex items-center justify-center">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-slate-800">{{ number_format($jumlahTagihan) }}</span>
                                <span class="block text-xs text-slate-500">Total</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="text-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="block text-xl font-bold text-emerald-600">{{ number_format(max(0, $jumlahTagihan - $jumlahTunggakan)) }}</span>
                            <span class="block text-xs text-slate-500">Lunas</span>
                        </div>
                        <div class="text-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="block text-xl font-bold text-rose-600">{{ number_format($jumlahTunggakan) }}</span>
                            <span class="block text-xs text-slate-500">Menunggak</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Data Kelas & Pintasan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        @if(!($isBendahara ?? false))
            <!-- Tabel Kelas (Tampil untuk Admin & Kepsek/Wakasek) -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Ringkasan Siswa per Kelas</h3>
                        <p class="text-sm text-slate-500">Data terdistribusi per rombel</p>
                    </div>
                    <a href="/sk/tk" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200">
                                <th class="px-6 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Jumlah Siswa</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-600 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @if(count($kelasDenganSiswa) > 0)
                                @foreach ($kelasDenganSiswa as $kelas)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $kelas->nama_ruang }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ number_format($kelas->jumlah_siswa) }} siswa</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-circle-check mr-1.5"></i> Terdaftar
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                        <i class="fa-solid fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                                        <p>Belum ada data kelas.</p>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- Ringkasan Pembayaran Khusus Bendahara -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                    <div>
                        <h3 class="text-base font-semibold text-slate-800">Petunjuk Administrasi Keuangan</h3>
                        <p class="text-sm text-slate-500">Prosedur pengelolaan kas dan tagihan santri</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fa-solid fa-info-circle mr-1"></i> Standar Operasional
                    </span>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-start space-x-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="p-2.5 bg-blue-100 text-blue-700 rounded-lg mt-0.5">
                            <i class="fa-solid fa-file-circle-plus text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">1. Terbitkan Tagihan Baru</h4>
                            <p class="text-xs text-slate-600 mt-1">Gunakan menu <strong>Buat Tagihan</strong> untuk menerbitkan slip SPP/IPP bulanan, uang pangkal, atau dana pendidikan untuk seluruh santri.</p>
                            <a href="/sk/bt" class="inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-700 mt-2">
                                Buka Form Tagihan <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="p-2.5 bg-emerald-100 text-emerald-700 rounded-lg mt-0.5">
                            <i class="fa-solid fa-wallet text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">2. Verifikasi Penerimaan Kas IPP</h4>
                            <p class="text-xs text-slate-600 mt-1">Catat pembayaran tunai atau transfer santri dan ubah status slip menjadi <strong>Lunas</strong> agar terbit otomatis notifikasi WhatsApp.</p>
                            <a href="/sk/pb" class="inline-flex items-center text-xs font-semibold text-emerald-600 hover:text-emerald-700 mt-2">
                                Buka Rekapitulasi IPP <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 rounded-xl bg-slate-50 border border-slate-200">
                        <div class="p-2.5 bg-purple-100 text-purple-700 rounded-lg mt-0.5">
                            <i class="fa-solid fa-money-check-dollar text-lg"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-slate-800">3. Rekap Uang Pangkal & Pendidikan</h4>
                            <p class="text-xs text-slate-600 mt-1">Pantau cicilan uang pangkal masuk untuk kebutuhan operasional dan sarana prasarana yayasan.</p>
                            <a href="/sk/pp" class="inline-flex items-center text-xs font-semibold text-purple-600 hover:text-purple-700 mt-2">
                                Kelola Uang Pangkal <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Aksi Cepat Sesuai Hak Akses -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-base font-semibold text-slate-800">Aksi Cepat</h3>
                <p class="text-sm text-slate-500">Pintasan menu utama</p>
            </div>
            <div class="p-6 grid grid-cols-2 gap-4">
                @if($isKepsek ?? false)
                    {{-- AKSI CEPAT KEPALA & WAKIL SEKOLAH (AKADEMIK) --}}
                    <a href="/sk/ds" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-colors group text-center">
                        <i class="fa-solid fa-user-graduate text-2xl text-emerald-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Data Siswa</span>
                    </a>
                    <a href="/sk/tk" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-200 transition-colors group text-center">
                        <i class="fa-solid fa-users-rectangle text-2xl text-amber-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Kelola Kelas</span>
                    </a>
                    <a href="/sk/kelola-jadwal" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-200 transition-colors group text-center">
                        <i class="fa-solid fa-calendar-alt text-2xl text-indigo-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Kelola Jadwal</span>
                    </a>
                    <a href="/sk/kelola-mapel" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors group text-center">
                        <i class="fa-solid fa-book text-2xl text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Mata Pelajaran</span>
                    </a>
                    <a href="/sk/pembagian-kelas" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-teal-50 hover:border-teal-200 transition-colors group text-center">
                        <i class="fa-solid fa-users-cog text-2xl text-teal-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Bagi Kelas</span>
                    </a>
                    <a href="/sk/kenaikan-kelas" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-purple-50 hover:border-purple-200 transition-colors group text-center">
                        <i class="fa-solid fa-graduation-cap text-2xl text-purple-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Kenaikan Kelas</span>
                    </a>

                @elseif($isBendahara ?? false)
                    {{-- AKSI CEPAT BENDAHARA (KEUANGAN) --}}
                    <a href="/sk/bt" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors group text-center">
                        <i class="fa-solid fa-file-circle-plus text-2xl text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Buat Tagihan</span>
                    </a>
                    <a href="/sk/pb" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-colors group text-center">
                        <i class="fa-solid fa-wallet text-2xl text-emerald-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Bayar IPP</span>
                    </a>
                    <a href="/sk/pp" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-rose-50 hover:border-rose-200 transition-colors group text-center">
                        <i class="fa-solid fa-money-check-dollar text-2xl text-rose-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Uang Pangkal</span>
                    </a>
                    <a href="/sk/pd" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-200 transition-colors group text-center">
                        <i class="fa-solid fa-graduation-cap text-2xl text-indigo-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Pendidikan</span>
                    </a>
                    <a href="/sk/ppl" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-200 transition-colors group text-center col-span-2">
                        <i class="fa-solid fa-screwdriver-wrench text-2xl text-amber-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Pemeliharaan & Sarana</span>
                    </a>

                @else
                    {{-- AKSI CEPAT ADMIN (LENGKAP) --}}
                    <a href="/sk/ds" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-colors group text-center">
                        <i class="fa-solid fa-user-graduate text-2xl text-emerald-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Data Siswa</span>
                    </a>
                    <a href="/sk/bt" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors group text-center">
                        <i class="fa-solid fa-file-circle-plus text-2xl text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Buat Tagihan</span>
                    </a>
                    <a href="/sk/tk" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-200 transition-colors group text-center">
                        <i class="fa-solid fa-users-rectangle text-2xl text-amber-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Kelola Kelas</span>
                    </a>
                    <a href="/sk/pb" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-violet-50 hover:border-violet-200 transition-colors group text-center">
                        <i class="fa-solid fa-wallet text-2xl text-violet-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Pembayaran IPP</span>
                    </a>
                    <a href="/sk/pp" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-rose-50 hover:border-rose-200 transition-colors group text-center">
                        <i class="fa-solid fa-money-check-dollar text-2xl text-rose-500 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Uang Pangkal</span>
                    </a>
                    <a href="/sk/pd" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 hover:border-slate-300 transition-colors group text-center">
                        <i class="fa-solid fa-graduation-cap text-2xl text-slate-600 mb-2 group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs font-medium text-slate-700">Pendidikan</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-siakad-layout>

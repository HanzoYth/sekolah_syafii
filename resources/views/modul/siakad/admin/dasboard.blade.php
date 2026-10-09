<x-siakad-layout>
    <x-slot name="title">Dashboard Admin</x-slot>
    <x-slot name="subtitle">Pantau ringkasan data akademik dan administrasi sekolah.</x-slot>
    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <span class="text-slate-700">Dashboard</span>
        </li>
    </x-slot>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
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
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Prioritas & Tindak Lanjut -->
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

        <!-- Ringkasan Administrasi -->
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
                        <span class="block text-xl font-bold text-emerald-600">{{ number_format($jumlahTagihan - $jumlahTunggakan) }}</span>
                        <span class="block text-xs text-slate-500">Lunas</span>
                    </div>
                    <div class="text-center p-3 bg-slate-50 rounded-lg border border-slate-100">
                        <span class="block text-xl font-bold text-rose-600">{{ number_format($jumlahTunggakan) }}</span>
                        <span class="block text-xs text-slate-500">Menunggak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Kelas & Pintasan -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Tabel Kelas -->
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
                        @forelse ($kelasDenganSiswa as $kelas)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-slate-800">{{ $kelas->nama_ruang }}</td>
                                <td class="px-6 py-4 text-sm text-slate-600">{{ number_format($kelas->jumlah_siswa) }} siswa</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">
                                        <i class="fa-solid fa-circle-check mr-1.5"></i> Terdaftar
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500">
                                    <i class="fa-solid fa-folder-open text-4xl text-slate-300 mb-3 block"></i>
                                    <p>Belum ada data kelas.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Aksi Cepat -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50">
                <h3 class="text-base font-semibold text-slate-800">Aksi Cepat</h3>
                <p class="text-sm text-slate-500">Pintasan menu utama</p>
            </div>
            <div class="p-6 grid grid-cols-2 gap-4">
                <a href="/sk/ds" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 transition-colors group">
                    <i class="fa-solid fa-user-graduate text-2xl text-emerald-500 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700">Data Siswa</span>
                </a>
                <a href="/sk/bt" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-blue-50 hover:border-blue-200 transition-colors group">
                    <i class="fa-solid fa-file-circle-plus text-2xl text-blue-500 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700">Buat Tagihan</span>
                </a>
                <a href="/sk/tk" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-amber-50 hover:border-amber-200 transition-colors group">
                    <i class="fa-solid fa-users-rectangle text-2xl text-amber-500 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700">Kelola Kelas</span>
                </a>
                <a href="/sk/pb" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-violet-50 hover:border-violet-200 transition-colors group">
                    <i class="fa-solid fa-wallet text-2xl text-violet-500 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700">Pembayaran IPP</span>
                </a>
                <a href="/sk/pp" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-rose-50 hover:border-rose-200 transition-colors group">
                    <i class="fa-solid fa-money-check-dollar text-2xl text-rose-500 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700">Uang Pangkal</span>
                </a>
                <a href="/sk/pd" class="flex flex-col items-center justify-center p-4 rounded-xl border border-slate-200 bg-slate-50 hover:bg-slate-100 hover:border-slate-300 transition-colors group">
                    <i class="fa-solid fa-graduation-cap text-2xl text-slate-600 mb-2 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-medium text-slate-700">Pendidikan</span>
                </a>
            </div>
        </div>
    </div>
</x-siakad-layout>

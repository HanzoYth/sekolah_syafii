<x-siakad-layout>
    <x-slot name="title">Dashboard Siswa</x-slot>
    <x-slot name="subtitle">Pantau informasi akademik dan aktivitas belajar Anda.</x-slot>
    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <span class="text-slate-700">Dashboard</span>
        </li>
    </x-slot>

    <!-- Top Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                <i class="fa-solid fa-clipboard-check text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Kehadiran Bulan Ini</p>
                <h3 class="text-2xl font-bold text-slate-800">96%</h3>
                <p class="text-xs text-slate-400 mt-1">24 dari 25 hari hadir</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                <i class="fa-solid fa-star text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Rata-rata Nilai</p>
                <h3 class="text-2xl font-bold text-slate-800">89</h3>
                <p class="text-xs text-slate-400 mt-1">Baik sekali</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                <i class="fa-solid fa-wallet text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Status Pembayaran</p>
                <h3 class="text-2xl font-bold text-emerald-600">Lunas</h3>
                <p class="text-xs text-slate-400 mt-1">Periode Agustus 2026</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 flex items-start space-x-4">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-lg">
                <i class="fa-solid fa-bullhorn text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Pengumuman Baru</p>
                <h3 class="text-2xl font-bold text-slate-800">3</h3>
                <p class="text-xs text-slate-400 mt-1">Informasi perlu dibaca</p>
            </div>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Jadwal Hari Ini -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Jadwal Pelajaran</h3>
                    <p class="text-sm text-slate-500">Aktivitas hari ini</p>
                </div>
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    <i class="fa-regular fa-calendar mr-1.5"></i> Hari ini
                </span>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-stretch border border-slate-200 rounded-lg overflow-hidden bg-slate-50 opacity-70">
                        <div class="w-2 bg-emerald-500"></div>
                        <div class="p-4 flex-1 flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800">Al-Qur'an Hadits</h4>
                                <p class="text-xs text-slate-500 mt-1">Ustadzah Fitri &bull; Ruang {{ $data_kelas->nama_ruang ?? '1A' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-sm font-bold text-slate-700">07.30 - 08.10</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-slate-200 text-slate-700 mt-1">Selesai</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-stretch border-2 border-blue-200 rounded-lg overflow-hidden shadow-sm">
                        <div class="w-2 bg-blue-500"></div>
                        <div class="p-4 flex-1 flex justify-between items-center bg-white">
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800">Matematika</h4>
                                <p class="text-xs text-slate-500 mt-1">Ustadz Rahman &bull; Ruang {{ $data_kelas->nama_ruang ?? '1A' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-sm font-bold text-blue-700">08.10 - 08.50</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-blue-100 text-blue-800 mt-1 animate-pulse">Berlangsung</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-stretch border border-slate-200 rounded-lg overflow-hidden bg-white">
                        <div class="w-2 bg-amber-400"></div>
                        <div class="p-4 flex-1 flex justify-between items-center">
                            <div>
                                <h4 class="text-sm font-semibold text-slate-800">Bahasa Indonesia</h4>
                                <p class="text-xs text-slate-500 mt-1">Ustadzah Sari &bull; Ruang {{ $data_kelas->nama_ruang ?? '1A' }}</p>
                            </div>
                            <div class="text-right">
                                <span class="block text-sm font-bold text-slate-700">09.10 - 09.50</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-amber-100 text-amber-800 mt-1">Berikutnya</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-xs text-slate-500 flex items-center">
                    <i class="fa-solid fa-circle-info mr-1.5"></i> Jadwal lengkap akan tersedia pada menu akademik.
                </div>
            </div>
        </div>

        <!-- Administrasi -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Status Pembayaran</h3>
                    <p class="text-sm text-slate-500">Administrasi</p>
                </div>
                <a href="/sk/pbs" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat detail</a>
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <div class="flex items-center space-x-4 p-4 rounded-xl bg-emerald-50 border border-emerald-100 mb-6">
                    <div class="p-2 bg-emerald-100 text-emerald-600 rounded-full">
                        <i class="fa-solid fa-circle-check text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-emerald-800">Pembayaran lunas</h4>
                        <p class="text-xs text-emerald-600 mt-0.5">Tidak ada tagihan aktif pada periode ini.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                        <span class="block text-xs text-slate-500">Periode</span>
                        <span class="block text-sm font-bold text-slate-800 mt-1">Agustus 2026</span>
                    </div>
                    <div class="p-4 bg-slate-50 rounded-lg border border-slate-100">
                        <span class="block text-xs text-slate-500">Total dibayar</span>
                        <span class="block text-sm font-bold text-slate-800 mt-1">Rp 1.000.000</span>
                    </div>
                </div>

                <div class="mt-auto">
                    <a href="/sk/pbs" class="w-full flex items-center justify-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-200 transition-colors">
                        <i class="fa-solid fa-receipt mr-2"></i> Lihat slip pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Lower Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Nilai Terbaru -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Nilai Terbaru</h3>
                    <p class="text-sm text-slate-500">Perkembangan akademik</p>
                </div>
                <span class="text-sm font-bold text-slate-700">Rata-rata: 89</span>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-700">Matematika</span>
                            <span class="text-sm font-bold text-slate-800">88</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 88%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-700">Bahasa Indonesia</span>
                            <span class="text-sm font-bold text-slate-800">92</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 92%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-700">Al-Qur'an Hadits</span>
                            <span class="text-sm font-bold text-slate-800">95</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium text-slate-700">IPA</span>
                            <span class="text-sm font-bold text-slate-800">85</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2">
                            <div class="bg-amber-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pengumuman -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 flex justify-between items-center bg-slate-50/50">
                <div>
                    <h3 class="text-base font-semibold text-slate-800">Pengumuman Terbaru</h3>
                    <p class="text-sm text-slate-500">Informasi sekolah</p>
                </div>
                <a href="/sk/ps" class="text-sm font-medium text-blue-600 hover:text-blue-700">Lihat semua</a>
            </div>
            <div class="divide-y divide-slate-100">
                <div class="p-4 flex space-x-4 hover:bg-slate-50 transition-colors">
                    <div class="p-2 bg-amber-50 text-amber-600 rounded-lg h-fit">
                        <i class="fa-solid fa-file-pen"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-slate-800">Pembagian Rapor Tengah Semester</h4>
                        <p class="text-xs text-slate-500 mt-1">Rapor dibagikan melalui wali kelas masing-masing.</p>
                    </div>
                    <span class="text-xs text-slate-400 whitespace-nowrap">02 Agu</span>
                </div>
                <div class="p-4 flex space-x-4 hover:bg-slate-50 transition-colors">
                    <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg h-fit">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-slate-800">Penilaian Tengah Semester</h4>
                        <p class="text-xs text-slate-500 mt-1">Persiapkan diri untuk asesmen pada 12 Agustus.</p>
                    </div>
                    <span class="text-xs text-slate-400 whitespace-nowrap">01 Agu</span>
                </div>
                <div class="p-4 flex space-x-4 hover:bg-slate-50 transition-colors">
                    <div class="p-2 bg-blue-50 text-blue-600 rounded-lg h-fit">
                        <i class="fa-solid fa-flag"></i>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold text-slate-800">Libur Nasional & Cuti Bersama</h4>
                        <p class="text-xs text-slate-500 mt-1">Kegiatan belajar mengikuti kalender pendidikan.</p>
                    </div>
                    <span class="text-xs text-slate-400 whitespace-nowrap">29 Jul</span>
                </div>
            </div>
        </div>
    </div>
</x-siakad-layout>

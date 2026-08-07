<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Wali Kelas - Islamic Smart School</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- CSS Elegansi Islami Tambahan -->
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/walas_style.css') }}">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            850: '#064e3b',
                            900: '#022c22',
                        },
                        amber: {
                            450: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-100 text-slate-800 flex h-screen overflow-hidden">

    <x-sidebar_siakad />

    <!-- AREA KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

        <!-- Header Top Bar Bernuansa Islami (Dibuat Lebih Megah & Compact) -->
        <header class="bg-islamic-pattern text-white shadow-xl relative overflow-hidden flex-shrink-0 border-b-4 border-amber-500">
            <div class="px-8 py-6 relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                        <span class="font-arabic text-2xl text-amber-400 font-bold">رَبِّ زِدْنِي عِلْمًا</span>
                        <span class="text-amber-400 text-xs hidden md:inline">• Data Pendidik & Wali Kelas</span>
                    </div>
                    <h1 class="text-2xl font-extrabold tracking-wide text-white flex items-center justify-center md:justify-start gap-3">
                        <i class="fa-solid fa-user-tie text-amber-400 text-xl"></i> Directori Wali Kelas (Walas)
                    </h1>
                    <p class="text-emerald-200 text-xs mt-1">Manajemen Pendamping Akademik & Karakter Santri</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="#" class="inline-flex items-center gap-2 bg-slate-800/80 hover:bg-slate-800 text-emerald-300 font-medium px-4 py-2.5 rounded-xl border border-emerald-500/30 text-xs transition-all shadow-md">
                        <i class="fa-solid fa-file-export"></i> Cetak SK Walas
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:brightness-110 text-slate-950 font-bold px-4 py-2.5 rounded-xl shadow-lg text-xs transition-all transform hover:-translate-y-0.5">
                        <i class="fa-solid fa-user-plus"></i> Tambah Walas Baru
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 space-y-6">

            <!-- Card Summary / Stats Mini (Perbedaan dari Data Siswa) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Walas</p>
                        <h3 class="text-xl font-bold text-slate-800">12 Guru</h3>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-mars"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Mualim (Pria)</p>
                        <h3 class="text-xl font-bold text-slate-800">7 Orang</h3>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-rose-100 text-rose-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-venus"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Mualimah (Wanita)</p>
                        <h3 class="text-xl font-bold text-slate-800">5 Orang</h3>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200/80 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center text-xl font-bold">
                        <i class="fa-solid fa-door-open"></i>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kelas Terampu</p>
                        <h3 class="text-xl font-bold text-slate-800">12 Rombel</h3>
                    </div>
                </div>
            </div>

            <!-- Card Container Table -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 overflow-hidden">
                
                <!-- Toolbar, Filter, & Search Bar -->
                <div class="p-5 bg-gradient-to-r from-slate-50 to-emerald-50/30 border-b border-slate-200 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="w-full md:w-96 relative">
                        <form action="#" method="GET">
                            <input type="text" name="search" placeholder="Cari NIP, Nama Ustaz/Ustazah, NUPTK..." class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-700 focus:border-transparent text-xs bg-white shadow-sm transition">
                            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-3.5 text-slate-400 text-xs"></i>
                        </form>
                    </div>
                    
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <select class="px-3 py-2 rounded-xl border border-slate-300 text-xs bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600 shadow-sm">
                            <option value="">Semua Tingkat</option>
                            <option value="X">Kelas X</option>
                            <option value="XI">Kelas XI</option>
                            <option value="XII">Kelas XII</option>
                        </select>
                        <select class="px-3 py-2 rounded-xl border border-slate-300 text-xs bg-white text-slate-700 focus:outline-none focus:ring-2 focus:ring-emerald-600 shadow-sm">
                            <option value="">Status Kepegawaian</option>
                            <option value="Tetap">Guru Tetap Yayasan</option>
                            <option value="Kontrak">Guru Kontrak</option>
                        </select>
                    </div>
                </div>

                <!-- Table Data Wali Kelas -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-emerald-950 text-amber-300 text-xs uppercase tracking-wider font-semibold border-b border-amber-500/30">
                                <th class="py-4 px-6 text-center">No</th>
                                <th class="py-4 px-6">Profil Walas</th>
                                <th class="py-4 px-6">NIP / NUPTK</th>
                                <th class="py-4 px-6">Mata Pelajaran Utama</th>
                                <th class="py-4 px-6">Tugas Wali Kelas</th>
                                <th class="py-4 px-6">Kontak / WA</th>
                                <th class="py-4 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs md:text-sm">
                            
                            <!-- Baris 1: Walas Pria -->
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-150">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">1</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-emerald-900 border-2 border-amber-400 flex items-center justify-center text-amber-300 shadow-md font-bold text-sm">
                                            UA
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Ust. Ahmad Dahlan, S.Pd.I</p>
                                            <span class="inline-flex items-center gap-1 text-[11px] text-blue-600 font-medium">
                                                <i class="fa-solid fa-mars"></i> Mualim (Laki-laki)
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-mono text-xs text-slate-600">
                                    <span class="font-bold text-slate-800">19850712 201001 1 003</span>
                                    <span class="block text-[10px] text-slate-400">NUPTK: 8492019283019</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-medium text-slate-700">Fiqih & Usul Fiqih</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-900 border border-emerald-300 shadow-sm">
                                        <i class="fa-solid fa-graduation-cap text-amber-600"></i> X-A Tahfidz
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-emerald-700 hover:text-emerald-900 font-medium bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                                        <i class="fa-brands fa-whatsapp text-emerald-600"></i> +62 812-3456-7890
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-800 hover:text-white flex items-center justify-center transition shadow-sm" title="Detail Walas">
                                            <i class="fa-solid fa-address-card text-xs"></i>
                                        </a>
                                        <a href="#" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button type="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data Wali Kelas ini?');" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Hapus Walas">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Baris 2: Walas Wanita -->
                            <tr class="hover:bg-emerald-50/40 transition-colors duration-150">
                                <td class="py-4 px-6 text-center font-medium text-slate-400">2</td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-amber-600 border-2 border-emerald-400 flex items-center justify-center text-white shadow-md font-bold text-sm">
                                            UM
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800">Ustazah Maryam, M.Pd.</p>
                                            <span class="inline-flex items-center gap-1 text-[11px] text-rose-600 font-medium">
                                                <i class="fa-solid fa-venus"></i> Mualimah (Perempuan)
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-6 font-mono text-xs text-slate-600">
                                    <span class="font-bold text-slate-800">19900321 201502 2 005</span>
                                    <span class="block text-[10px] text-slate-400">NUPTK: 1948201948201</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-medium text-slate-700">Bahasa Arab & Nahwu</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold bg-emerald-100 text-emerald-900 border border-emerald-300 shadow-sm">
                                        <i class="fa-solid fa-graduation-cap text-amber-600"></i> XI-B IPA
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="https://wa.me/6289876543210" target="_blank" class="inline-flex items-center gap-1.5 text-xs text-emerald-700 hover:text-emerald-900 font-medium bg-emerald-50 px-2.5 py-1 rounded-md border border-emerald-200">
                                        <i class="fa-brands fa-whatsapp text-emerald-600"></i> +62 898-7654-3210
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="#" class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-800 hover:text-white flex items-center justify-center transition shadow-sm" title="Detail Walas">
                                            <i class="fa-solid fa-address-card text-xs"></i>
                                        </a>
                                        <a href="#" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button type="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data Wali Kelas ini?');" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Hapus Walas">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Footer Card / Pagination -->
                <div class="p-4 bg-slate-50 border-t border-slate-200 flex justify-between items-center">
                    <span class="text-xs font-medium text-slate-500">Menampilkan 2 dari 12 Wali Kelas Aktif</span>
                    <div class="flex gap-1 text-xs">
                        <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-400 cursor-not-allowed">Sebelumnya</button>
                        <button class="px-3 py-1.5 rounded-lg border border-emerald-700 bg-emerald-800 text-white font-bold shadow-sm">1</button>
                        <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-100">2</button>
                        <button class="px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-100">Selanjutnya</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
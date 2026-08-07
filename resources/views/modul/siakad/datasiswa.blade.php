<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - Islamic Smart School</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Inter & Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS (Opsional dari asset Anda) -->
    <!-- <link rel="stylesheet" href="{{ asset('css/modul/siakad/data_siswa.css') }}"> -->

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
                    },
                    fontFamily: {
                        arabic: ['Amiri', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-50 font-sans text-slate-800 flex h-screen overflow-hidden">

    <x-sidebar_siakad />
    <!-- AREA KONTEN UTAMA (HEADER + TABLE) -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

        <!-- Header / Navbar Top -->
        <header class="bg-emerald-900 text-white shadow-md relative overflow-hidden flex-shrink-0">
            <!-- Pattern background Islamic -->
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="px-6 py-5 relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <p class="font-arabic text-xl text-amber-400 mb-0.5">بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ</p>
                    <h1 class="text-xl font-bold tracking-wide text-white flex items-center justify-center md:justify-start gap-2">
                        Sistem Informasi Data Siswa
                    </h1>
                    <p class="text-emerald-200 text-xs">Mewujudkan Generasi Rabbani, Berakhlak Mulia & Berprestasi</p>
                </div>
                <div>
                    <a href="#" class="inline-flex items-center gap-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-semibold px-4 py-2 rounded-lg shadow-md text-xs transition-all duration-200 hover:shadow-lg">
                        <i class="fa-solid fa-user-plus"></i> Tambah Siswa Baru
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 p-6">

            <!-- Notifikasi Murni (Static Alert) -->
            <div class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-600 text-emerald-800 rounded-r-lg flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3 text-xs md:text-sm">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                    <span>Data siswa berhasil dimuat.</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Card Container Table -->
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                
                <!-- Toolbar & Filter -->
                <div class="p-5 bg-slate-50 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="w-full md:w-80 relative">
                        <form action="#" method="GET">
                            <input type="text" name="search" placeholder="Cari NIS, Nama, atau Kelas..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-600 focus:border-transparent text-xs transition">
                            <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-slate-400 text-xs"></i>
                        </form>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-500">
                        <i class="fa-solid fa-users text-emerald-700"></i>
                        <span>Total Siswa: <strong class="text-slate-800">3</strong> Santri/Siswa</span>
                    </div>
                </div>

                <!-- Table Data Siswa (Dummy Data) -->
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-emerald-900 text-emerald-100 text-xs uppercase tracking-wider font-semibold border-b border-emerald-800">
                                <th class="py-3.5 px-6 text-center">No</th>
                                <th class="py-3.5 px-6">Foto</th>
                                <th class="py-3.5 px-6">NISN / NIS</th>
                                <th class="py-3.5 px-6">Nama Lengkap</th>
                                <th class="py-3.5 px-6">Jenis Kelamin</th>
                                <th class="py-3.5 px-6">Kelas</th>
                                <th class="py-3.5 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs md:text-sm">
                            <!-- Baris 1 (Laki-laki) -->
                            <tr class="hover:bg-emerald-50/50 transition-colors duration-150">
                                <td class="py-3.5 px-6 text-center font-medium text-slate-500">1</td>
                                <td class="py-3.5 px-6">
                                    <div class="w-9 h-9 rounded-full bg-emerald-100 border-2 border-amber-400 flex items-center justify-center overflow-hidden shadow-sm">
                                        <i class="fa-solid fa-user text-emerald-700"></i>
                                    </div>
                                </td>
                                <td class="py-3.5 px-6 font-mono text-xs text-slate-600">
                                    <span class="font-bold text-slate-800">0051234567</span> / 202301
                                </td>
                                <td class="py-3.5 px-6 font-semibold text-slate-800">
                                    Ahmad Al-Fatih
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-mars"></i> Laki-laki
                                    </span>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        X-A Tahfidz
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="#" class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Detail Siswa">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>
                                        <a href="#" class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button type="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');" class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Hapus Siswa">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Baris 2 (Perempuan) -->
                            <tr class="hover:bg-emerald-50/50 transition-colors duration-150">
                                <td class="py-3.5 px-6 text-center font-medium text-slate-500">2</td>
                                <td class="py-3.5 px-6">
                                    <div class="w-9 h-9 rounded-full bg-emerald-100 border-2 border-amber-400 flex items-center justify-center overflow-hidden shadow-sm">
                                        <i class="fa-solid fa-user text-emerald-700"></i>
                                    </div>
                                </td>
                                <td class="py-3.5 px-6 font-mono text-xs text-slate-600">
                                    <span class="font-bold text-slate-800">0057654321</span> / 202302
                                </td>
                                <td class="py-3.5 px-6 font-semibold text-slate-800">
                                    Aisha Humaira
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-rose-50 text-rose-700 border border-rose-200">
                                        <i class="fa-solid fa-venus"></i> Perempuan
                                    </span>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        XI-B IPA
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="#" class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Detail Siswa">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>
                                        <a href="#" class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button type="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');" class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Hapus Siswa">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Baris 3 (Laki-laki) -->
                            <tr class="hover:bg-emerald-50/50 transition-colors duration-150">
                                <td class="py-3.5 px-6 text-center font-medium text-slate-500">3</td>
                                <td class="py-3.5 px-6">
                                    <div class="w-9 h-9 rounded-full bg-emerald-100 border-2 border-amber-400 flex items-center justify-center overflow-hidden shadow-sm">
                                        <i class="fa-solid fa-user text-emerald-700"></i>
                                    </div>
                                </td>
                                <td class="py-3.5 px-6 font-mono text-xs text-slate-600">
                                    <span class="font-bold text-slate-800">0059988776</span> / 202303
                                </td>
                                <td class="py-3.5 px-6 font-semibold text-slate-800">
                                    Muhammad Zaid
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                        <i class="fa-solid fa-mars"></i> Laki-laki
                                    </span>
                                </td>
                                <td class="py-3.5 px-6">
                                    <span class="px-2.5 py-1 rounded-md text-[11px] font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                        XII-A IPS
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="#" class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-700 hover:bg-emerald-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Detail Siswa">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </a>
                                        <a href="#" class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition shadow-sm" title="Edit Data">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </a>
                                        <button type="button" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?');" class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white flex items-center justify-center transition shadow-sm" title="Hapus Siswa">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Card / Pagination Murni -->
                <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-between items-center">
                    <span class="text-xs text-slate-500">Menampilkan 3 dari 3 data siswa aktif</span>
                    <div class="flex gap-1 text-xs">
                        <button class="px-3 py-1 rounded border border-slate-200 bg-white text-slate-400 cursor-not-allowed">Sebelumnya</button>
                        <button class="px-3 py-1 rounded border border-emerald-600 bg-emerald-600 text-white font-medium">1</button>
                        <button class="px-3 py-1 rounded border border-slate-200 bg-white text-slate-400 cursor-not-allowed">Selanjutnya</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>
<x-siakad-layout 
    title="Profil Akademik Siswa" 
    description="Tinjau biodata peserta didik, penempatan kelas rombel, dan informasi wali kelas yang terdaftar di SIAKAD." 
    position="Siswa / Orang Tua" 
    initials="SW">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Profil Siswa</span>
        </li>
    </x-slot>

    <!-- Profile Hero Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 sm:p-8 mb-8 flex flex-col sm:flex-row items-center sm:items-start gap-6">
        <div class="w-28 h-28 min-w-[112px] min-h-[112px] aspect-square rounded-2xl overflow-hidden bg-emerald-50 border-4 border-white shadow-md flex-shrink-0 flex items-center justify-center text-emerald-600 text-4xl">
            @if(!empty($data_siswa->url_foto) && \Illuminate\Support\Facades\Storage::exists($data_siswa->url_foto))
                <img src="{{ route('file.show', $data_siswa->url_foto) }}" alt="Foto {{ $data_siswa->nama }}" class="w-full h-full object-cover flex-shrink-0">
            @else
                <i class="fa-solid fa-user-graduate"></i>
            @endif
        </div>

        <div class="flex-1 min-w-0 text-center sm:text-left">
            <span class="text-[11px] font-bold uppercase tracking-widest text-emerald-600 block mb-1">Biodata Peserta Didik</span>
            <h2 class="text-2xl font-bold text-slate-800 break-words">{{ $data_siswa->nama ?? '-' }}</h2>
            <p class="text-sm text-slate-500 font-mono mt-1">
                <i class="fa-solid fa-id-card text-slate-400 mr-1.5"></i> NIS / Nomor Induk: <strong>{{ $data_siswa->nis ?? '-' }}</strong>
            </p>

            <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2.5 mt-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                    <i class="fa-solid fa-circle-check text-[10px]"></i> Peserta Didik Aktif
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                    <i class="fa-solid fa-school text-[10px]"></i> {{ $data_kelas->nama_ruang ?? 'Belum Ada Kelas' }}
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-800 border border-amber-200">
                    <i class="fa-solid fa-calendar-check text-[10px]"></i> T.A. {{ $tahun_aktif->nama ?? '2026/2027' }}
                </span>
            </div>
        </div>
    </div>

    <!-- Detail Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Identitas Pribadi Siswa -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-slate-800">Identitas Pribadi Peserta Didik</h3>
                    <p class="text-xs text-slate-500">Data pribadi siswa yang tercatat di sistem akademik sekolah</p>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Nama Lengkap</span>
                    <p class="font-bold text-slate-800">{{ $data_siswa->nama ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Nomor Induk Siswa (NIS)</span>
                    <p class="font-mono font-bold text-slate-700">{{ $data_siswa->nis ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Jenis Kelamin</span>
                    <p class="font-semibold text-slate-700">
                        @php
                            $jk = strtolower($data_siswa->gender ?? ($data_siswa->jenis_kelamin ?? ''));
                        @endphp
                        {{ ($jk === 'p' || $jk === 'perempuan') ? 'Perempuan' : (($jk === 'l' || $jk === 'laki-laki') ? 'Laki-laki' : 'Laki-laki / Perempuan') }}
                    </p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Agama</span>
                    <p class="font-semibold text-slate-700">{{ ucfirst($data_siswa->agama ?? 'Islam') }}</p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Tempat, Tanggal Lahir</span>
                    <p class="font-semibold text-slate-700">
                        {{ $data_siswa->tempat_lahir ?? '-' }}{{ !empty($data_siswa->tanggal_lahir) ? ', ' . \Carbon\Carbon::parse($data_siswa->tanggal_lahir)->locale('id')->isoFormat('D MMMM Y') : '' }}
                    </p>
                </div>
                <div>
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Jenjang / Unit Sekolah</span>
                    <p class="font-semibold text-slate-700">{{ strtoupper($data_siswa->sekolah->jenis ?? 'Sekolah Islam') }}</p>
                </div>
                <div class="sm:col-span-2 pt-3 border-t border-slate-100">
                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block mb-1">Alamat Tempat Tinggal</span>
                    <p class="font-medium text-slate-700 leading-relaxed">{{ $data_siswa->alamat ?? 'Belum tersedia' }}</p>
                </div>
            </div>
        </div>

        <!-- Informasi Akademik & Perwalian -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="fa-solid fa-graduation-cap"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-800">Status Akademik & Kelas</h3>
                        <p class="text-xs text-slate-500">Informasi rombel & wali kelas</p>
                    </div>
                </div>

                <div class="p-6 divide-y divide-slate-100 text-sm">
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Rombongan Belajar</span>
                        <span class="font-bold text-slate-800">{{ $data_kelas->nama_ruang ?? '-' }}</span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Wali Kelas</span>
                        <span class="font-bold text-emerald-700">{{ $wallas->guru->nama ?? 'Belum Ditentukan' }}</span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Tahun Ajaran Aktif</span>
                        <span class="font-bold text-slate-800">{{ $tahun_aktif->nama ?? '2026/2027' }}</span>
                    </div>
                    <div class="py-3 flex items-center justify-between">
                        <span class="text-slate-500 font-medium">Status Kesiswaan</span>
                        <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif Terdaftar
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-4 m-4 rounded-xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                <i class="fa-solid fa-shield-halved text-emerald-600 mt-0.5"></i>
                <p class="text-xs text-slate-500 leading-relaxed">
                    Apabila terdapat perubahan atau koreksi pada biodata siswa, silakan menghubungi Wali Kelas atau bagian Tata Usaha Sekolah.
                </p>
            </div>
        </div>
    </div>
</x-siakad-layout>

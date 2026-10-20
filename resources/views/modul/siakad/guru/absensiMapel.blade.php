<x-siakad-layout 
    title="Absensi Mata Pelajaran" 
    description="Presensi masuk kelas dan pencatatan kehadiran siswa per mata pelajaran." 
    position="Guru Pengajar" 
    initials="GP">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Absensi Mata Pelajaran</span>
        </li>
    </x-slot>

    @if(session('success'))
        <div class="mb-5 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5"></i>
            <div>
                <p class="font-bold text-sm">Berhasil!</p>
                <p class="text-sm mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-start gap-3 shadow-sm">
            <i class="fa-solid fa-circle-exclamation text-rose-600 text-lg mt-0.5"></i>
            <div>
                <p class="font-bold text-sm">Perhatian</p>
                <p class="text-sm mt-0.5">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- 1. BAR FILTER TANGGAL (RINGKAS & BERSIH)                -->
    <!-- ======================================================== -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 sm:p-5 mb-6">
        <form method="GET" action="/sk/ass" class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-lg flex-shrink-0">
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
                <div>
                    <h3 class="text-sm sm:text-base font-bold text-slate-800">{{ $hari_indonesia }}</h3>
                    <p class="text-xs text-slate-500">{{ $jadwal_hari_ini->count() }} sesi pelajaran terjadwal pada tanggal ini</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="relative flex-1 sm:flex-initial">
                    <i class="fa-regular fa-calendar absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" onchange="this.form.submit()"
                           class="pl-8 pr-3 py-1.5 text-xs sm:text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 transition-colors w-full sm:w-auto">
                </div>
                <button type="submit" class="px-3.5 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-semibold transition-colors flex items-center gap-1.5 shadow-sm">
                    <i class="fa-solid fa-filter text-[11px]"></i> Terapkan
                </button>
            </div>
        </form>
    </div>

    <!-- ======================================================== -->
    <!-- 2. PEMILIH SESI JADWAL HARI INI (SELEKTOR KARTU BERSIH) -->
    <!-- ======================================================== -->
    @if($jadwal_hari_ini->count() > 0)
        <div class="mb-6">
            <div class="flex items-center justify-between mb-2.5">
                <span class="text-xs font-bold text-slate-600 uppercase tracking-wider flex items-center gap-1.5">
                    <i class="fa-solid fa-chalkboard text-emerald-600"></i> Pilih Sesi Mengajar:
                </span>
                <span class="text-[11px] text-slate-400">Klik salah satu sesi untuk membuka absensi</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($jadwal_hari_ini as $j)
                    @php
                        $absen_item = $absensi_guru_semua->get($j->id);
                        $siswa_absen_count = $absensi_siswa_semua->get($j->id, collect())->count();
                        $is_active = ($jadwal_id == $j->id);

                        $jam_mulai_sub = substr($j->jam_pelajaran->jam_mulai ?? '00:00', 0, 5);
                        $jam_selesai_sub = substr($j->jam_pelajaran->jam_selesai ?? '00:00', 0, 5);
                    @endphp
                    <a href="/sk/ass?tanggal={{ $tanggal }}&jadwal_id={{ $j->id }}"
                       class="block p-3.5 rounded-xl border transition-all text-left relative {{ $is_active ? 'bg-emerald-50/70 border-emerald-500 shadow-sm ring-1 ring-emerald-500' : 'bg-white border-slate-200 hover:border-slate-300 hover:bg-slate-50/60' }}">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0 flex-1">
                                <span class="text-xs font-semibold text-slate-500 block">
                                    <i class="fa-regular fa-clock mr-1 text-[11px]"></i> {{ $jam_mulai_sub }} - {{ $jam_selesai_sub }} WIB
                                </span>
                                <h4 class="font-bold text-slate-800 text-sm truncate mt-0.5">{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</h4>
                                <span class="inline-block mt-1 text-xs font-semibold text-slate-600 bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $j->kelas->nama_kelas ?? ($j->kelas->nama_ruang ?? '-') }}
                                </span>
                            </div>

                            <div class="text-right flex-shrink-0 flex flex-col items-end gap-1">
                                @if($absen_item)
                                    @if($absen_item->status === 'tepat_waktu')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800" title="Masuk: {{ substr($absen_item->jam_masuk, 0, 5) }} WIB">
                                            <i class="fa-solid fa-check text-[10px] mr-1"></i> Tepat Waktu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800" title="Masuk: {{ substr($absen_item->jam_masuk, 0, 5) }} WIB">
                                            <i class="fa-solid fa-clock-rotate-left text-[10px] mr-1"></i> Terlambat
                                        </span>
                                    @endif
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-100 text-slate-600">
                                        Belum Masuk
                                    </span>
                                @endif

                                @if($siswa_absen_count > 0)
                                    <span class="text-[10px] text-emerald-700 font-semibold block">
                                        <i class="fa-solid fa-users text-[9px]"></i> {{ $siswa_absen_count }} Siswa Terabsen
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($is_active)
                            <div class="mt-2.5 pt-2 border-t border-emerald-200/80 flex items-center justify-between text-[11px] text-emerald-700 font-bold">
                                <span><i class="fa-solid fa-circle-check text-[10px] mr-1"></i> Sedang Dipilih</span>
                                <span>Lanjutkan di bawah &darr;</span>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <!-- Empty state jika tidak ada jadwal hari ini -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 text-center text-slate-500 mb-8">
            <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                <i class="fa-solid fa-calendar-xmark text-2xl"></i>
            </div>
            <h4 class="text-sm font-bold text-slate-700">Tidak Ada Jadwal Mengajar Hari Ini</h4>
            <p class="text-xs text-slate-400 mt-1">Anda tidak memiliki jadwal mengajar pada {{ $hari_indonesia }}.</p>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- 3. AREA KERJA ABSENSI SESI TERPILIH                     -->
    <!-- ======================================================== -->
    @if($jadwal_terpilih)
        @php
            $jam_mulai_str = substr($jadwal_terpilih->jam_pelajaran->jam_mulai ?? '07:00', 0, 5);
            $jam_selesai_str = substr($jadwal_terpilih->jam_pelajaran->jam_selesai ?? '08:30', 0, 5);
            $toleransi_jam = $toleransi_info['jam_batas'] ?? '-';
            $is_terlalu_dini = $toleransi_info['terlalu_dini'] ?? false;
        @endphp

        <!-- ======================================================== -->
        <!-- TAHAP 1: PRESENSI MASUK GURU & JURNAL MATERI             -->
        <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6" id="tahap-guru">
            <!-- Header Tahap 1 -->
            <div class="px-5 sm:px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg {{ $absen_guru ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }} flex items-center justify-center font-bold text-xs flex-shrink-0">
                        @if($absen_guru)
                            <i class="fa-solid fa-check"></i>
                        @else
                            1
                        @endif
                    </span>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm sm:text-base font-bold text-slate-800">Tahap 1: Presensi Masuk Kelas & Materi Mengajar</h3>
                            @if($absen_guru)
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-100 text-emerald-800">
                                    Selesai
                                </span>
                            @else
                                <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-amber-100 text-amber-800">
                                    Wajib Pertama
                                </span>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">
                            {{ $jadwal_terpilih->mata_pelajaran->nama_mapel ?? '-' }} • Kelas {{ $jadwal_terpilih->kelas->nama_kelas ?? ($jadwal_terpilih->kelas->nama_ruang ?? '-') }} ({{ $jam_mulai_str }} - {{ $jam_selesai_str }} WIB)
                        </p>
                    </div>
                </div>

                <div class="text-xs text-slate-500 self-start sm:self-auto flex items-center gap-2">
                    <span class="font-medium">Batas Tepat Waktu:</span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                        {{ $toleransi_jam }} WIB (+5 mnt)
                    </span>
                </div>
            </div>

            <!-- Konten Tahap 1 -->
            <div class="p-5 sm:p-6">
                @if($is_terlalu_dini)
                    <!-- Peringatan jika sesi belum boleh dibuka -->
                    <div class="p-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-center">
                        <i class="fa-solid fa-lock text-2xl text-amber-600 mb-2 block"></i>
                        <h4 class="font-bold text-sm">Waktu Presensi Belum Dibuka</h4>
                        <p class="text-xs text-amber-800 mt-1 max-w-md mx-auto">
                            Sesi pelajaran ini baru dapat dibuka dan dipresensi mulai pukul <strong>{{ $toleransi_info['jam_buka'] }} WIB</strong> (5 menit sebelum jam mulai).
                        </p>
                    </div>
                @elseif(!$absen_guru)

                    <form action="/sk/simpan-absensi-mapel" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="aksi" value="presensi_guru">
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                    Pokok Bahasan / Materi yang Diajarkan <span class="text-rose-500">*</span>
                                </label>
                                <input type="text" name="materi" required autocomplete="off"
                                       placeholder="Contoh: Bab 3 - Persamaan Kuadrat & Latihan Soal"
                                       class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white border border-slate-300 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1.5">
                                    Catatan / Evaluasi Pembelajaran (Opsional)
                                </label>
                                <input type="text" name="catatan" autocomplete="off"
                                       placeholder="Contoh: Siswa aktif berdiskusi kelompok, tugas dikumpul pekan depan"
                                       class="w-full px-3.5 py-2.5 text-xs sm:text-sm bg-white border border-slate-300 rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors">
                            </div>
                        </div>

                        <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-t border-slate-100">
                            <span class="text-xs text-slate-400 italic">
                                <i class="fa-solid fa-lock text-[10px] mr-1"></i> Tabel absensi siswa akan muncul otomatis setelah Anda menekan tombol ini.
                            </span>
                            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs sm:text-sm font-bold shadow-sm transition-colors flex items-center justify-center gap-2">
                                <i class="fa-solid fa-right-to-bracket text-xs"></i> Konfirmasi Masuk Kelas & Simpan Materi
                            </button>
                        </div>
                    </form>
                @else
                    <!-- KONDISI B: GURU SUDAH MELAKUKAN PRESENSI MASUK -->
                    <div class="p-4 rounded-xl bg-emerald-50/70 border border-emerald-200 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-9 h-9 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-base font-bold flex-shrink-0 mt-0.5">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    @if($absen_guru->status === 'tepat_waktu')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-emerald-200 text-emerald-900">
                                            ✓ Masuk Tepat Waktu
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded text-xs font-bold bg-amber-200 text-amber-900">
                                            ⚠ Masuk Terlambat
                                        </span>
                                    @endif
                                    <span class="text-xs font-semibold text-slate-700">
                                        Pukul <strong>{{ substr($absen_guru->jam_masuk, 0, 5) }} WIB</strong>
                                    </span>
                                </div>
                                <div class="mt-1.5 text-xs text-slate-700">
                                    <span class="font-bold text-slate-800">Materi:</span> {{ $absen_guru->materi ?? '-' }}
                                    @if($absen_guru->catatan)
                                        <span class="text-slate-500 italic ml-1">({{ $absen_guru->catatan }})</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <button type="button" onclick="toggleEditMateri()" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-semibold transition-colors self-start md:self-auto">
                            <i class="fa-solid fa-pen text-[10px]"></i> <span id="btnTextUbahMateri">Ubah Materi</span>
                        </button>
                    </div>

                    <!-- Form Collapse Ubah Materi (Tersembunyi secara default) -->
                    <div id="formEditMateriBox" class="mt-4 p-4 rounded-xl bg-slate-50 border border-slate-200" style="display: none;">
                        <form action="/sk/simpan-absensi-mapel" method="POST">
                            @csrf
                            <input type="hidden" name="aksi" value="presensi_guru">
                            <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                            <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Materi Pembelajaran:</label>
                                    <input type="text" name="materi" value="{{ $absen_guru->materi }}" required class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Pembelajaran:</label>
                                    <input type="text" name="catatan" value="{{ $absen_guru->catatan }}" class="w-full px-3 py-1.5 text-xs bg-white border border-slate-300 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500">
                                </div>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" onclick="toggleEditMateri()" class="px-3 py-1.5 bg-slate-200 text-slate-700 text-xs font-semibold rounded-lg">Batal</button>
                                <button type="submit" class="px-3 py-1.5 bg-emerald-600 text-white text-xs font-bold rounded-lg hover:bg-emerald-700">Simpan Perubahan Materi</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- TAHAP 2: TABEL ABSENSI SISWA                             -->
        <!-- ======================================================== -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8" id="tahap-siswa">
            <!-- Header Tahap 2 -->
            <div class="px-5 sm:px-6 py-4 bg-slate-50/70 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg {{ $absen_guru ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-400' }} flex items-center justify-center font-bold text-xs flex-shrink-0">
                        2
                    </span>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-sm sm:text-base font-bold text-slate-800">Tahap 2: Presensi Siswa</h3>
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-slate-700">
                                {{ count($siswa) }} Siswa
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Catat kehadiran setiap peserta didik pada sesi pelajaran ini
                        </p>
                    </div>
                </div>

                @if($absen_guru && count($siswa) > 0)
                    <!-- Tombol Cepat Aksi -->
                    <div class="flex items-center gap-2 self-start sm:self-auto">
                        <button type="button" onclick="setSemuaHadir()" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border border-emerald-200 text-xs font-semibold transition-colors">
                            <i class="fa-solid fa-check-double mr-1.5 text-[11px]"></i> Tandai Semua Hadir
                        </button>
                        <button type="submit" form="formAbsensiSiswa" class="inline-flex items-center px-4 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold shadow-sm transition-colors gap-1.5">
                            <i class="fa-solid fa-floppy-disk text-[11px]"></i> Simpan Absensi Siswa
                        </button>
                    </div>
                @endif
            </div>

            <!-- Konten Tahap 2 -->
            <div>
                @if(!$absen_guru)
                    <!-- KONDISI TERKUNCI: GURU BELUM MELAKUKAN PRESENSI TAHAP 1 -->
                    <div class="p-8 sm:p-12 text-center bg-slate-50/40">
                        <div class="w-14 h-14 mx-auto mb-3 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-xl">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <h4 class="text-sm font-bold text-slate-700">Tabel Absensi Siswa Belum Terbuka</h4>
                        <p class="text-xs text-slate-400 mt-1 max-w-md mx-auto leading-relaxed">
                            Silakan lakukan presensi masuk kelas dan isi pokok materi pada <strong>Tahap 1</strong> di atas terlebih dahulu. Tabel absensi siswa akan otomatis muncul setelahnya.
                        </p>
                        <div class="mt-4">
                            <a href="#tahap-guru" class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold transition-colors shadow-sm">
                                <i class="fa-solid fa-arrow-up text-[10px]"></i> Menuju Tahap 1 (Presensi Masuk)
                            </a>
                        </div>
                    </div>
                @else
                    <!-- KONDISI TERBUKA: GURU SUDAH PRESENSI MASUK -->
                    <!-- Ringkasan Status Siswa Ringkas -->
                    <div class="px-5 sm:px-6 py-2.5 bg-slate-50/90 border-b border-slate-200 flex flex-wrap items-center justify-between gap-2 text-xs">
                        <div class="flex items-center gap-3 font-semibold text-slate-600">
                            <span>Rekap:</span>
                            <span class="text-emerald-700"><strong class="font-bold">{{ $rekap_siswa['hadir'] }}</strong> Hadir</span>
                            <span class="text-amber-700"><strong class="font-bold">{{ $rekap_siswa['sakit'] }}</strong> Sakit</span>
                            <span class="text-blue-700"><strong class="font-bold">{{ $rekap_siswa['izin'] }}</strong> Izin</span>
                            <span class="text-rose-700"><strong class="font-bold">{{ $rekap_siswa['alpa'] }}</strong> Alpa</span>
                        </div>
                        <span class="text-slate-400 text-[11px]">Pilih status pada baris setiap siswa di bawah</span>
                    </div>

                    <form id="formAbsensiSiswa" action="/sk/simpan-absensi-mapel" method="POST">
                        @csrf
                        <input type="hidden" name="aksi" value="absensi_siswa">
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal_id }}">
                        <input type="hidden" name="tanggal" value="{{ $tanggal }}">

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[620px]">
                                <thead>
                                    <tr class="bg-slate-50/80 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                                        <th class="px-5 py-3 w-12 text-center">No</th>
                                        <th class="px-5 py-3 w-28">NIS</th>
                                        <th class="px-5 py-3">Nama Lengkap Siswa</th>
                                        <th class="px-5 py-3 text-center w-64">Status Kehadiran</th>
                                        <th class="px-5 py-3 w-56">Catatan / Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @if(count($siswa) > 0)
                                        @foreach($siswa as $index => $s)
                                            @php
                                                $absen_siswa = $absensi_db[$s->id] ?? null;
                                                $status = $absen_siswa ? $absen_siswa->status : "h"; 
                                                $keterangan = $absen_siswa ? $absen_siswa->keterangan : "";
                                            @endphp
                                            <tr class="hover:bg-slate-50/60 transition-colors">
                                                <td class="px-5 py-3 text-center text-slate-400 font-medium text-xs">{{ $index + 1 }}</td>
                                                <td class="px-5 py-3 font-mono text-xs text-slate-500">{{ $s->nis ?? '-' }}</td>
                                                <td class="px-5 py-3">
                                                    <span class="font-bold text-slate-800 block text-xs sm:text-sm">{{ $s->nama }}</span>
                                                    <span class="text-[11px] text-slate-400">{{ $s->gender == 'p' ? 'Perempuan' : 'Laki-laki' }}</span>
                                                </td>
                                                <td class="px-5 py-3 text-center">
                                                    <div class="inline-flex items-center gap-1.5 p-1 bg-slate-100/80 rounded-lg border border-slate-200">
                                                        <!-- Hadir (H) -->
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="h" class="peer sr-only radio-hadir" {{ $status == "h" ? "checked" : "" }}>
                                                            <span class="px-2.5 py-1 rounded text-xs font-bold text-slate-600 peer-checked:bg-emerald-600 peer-checked:text-white transition-all block">
                                                                Hadir
                                                            </span>
                                                        </label>
                                                        <!-- Sakit (S) -->
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="s" class="peer sr-only" {{ $status == "s" ? "checked" : "" }}>
                                                            <span class="px-2.5 py-1 rounded text-xs font-bold text-slate-600 peer-checked:bg-amber-500 peer-checked:text-white transition-all block">
                                                                Sakit
                                                            </span>
                                                        </label>
                                                        <!-- Izin (I) -->
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="i" class="peer sr-only" {{ $status == "i" ? "checked" : "" }}>
                                                            <span class="px-2.5 py-1 rounded text-xs font-bold text-slate-600 peer-checked:bg-blue-600 peer-checked:text-white transition-all block">
                                                                Izin
                                                            </span>
                                                        </label>
                                                        <!-- Alpa (A) -->
                                                        <label class="cursor-pointer">
                                                            <input type="radio" name="absensi[{{ $s->id }}][status]" value="a" class="peer sr-only" {{ $status == "a" ? "checked" : "" }}>
                                                            <span class="px-2.5 py-1 rounded text-xs font-bold text-slate-600 peer-checked:bg-rose-600 peer-checked:text-white transition-all block">
                                                                Alpa
                                                            </span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="px-5 py-3">
                                                    <input type="text" name="absensi[{{ $s->id }}][keterangan]" value="{{ $keterangan }}" 
                                                           placeholder="Catatan siswa..." 
                                                           class="w-full px-2.5 py-1 text-xs bg-white border border-slate-200 rounded-lg text-slate-700 focus:outline-none focus:border-emerald-500 transition-colors">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="px-6 py-10 text-center text-slate-400 text-xs">
                                                Belum ada data siswa yang terdaftar di kelas rombel ini.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        @if(count($siswa) > 0)
                            <div class="px-5 sm:px-6 py-3.5 bg-slate-50/80 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                                <span class="text-xs text-slate-500">
                                    Total <strong>{{ count($siswa) }}</strong> siswa terdaftar di rombel ini.
                                </span>
                                <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs sm:text-sm font-bold shadow-sm transition-colors flex items-center gap-1.5 w-full sm:w-auto justify-center">
                                    <i class="fa-solid fa-floppy-disk text-xs"></i> Simpan Absensi Siswa
                                </button>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    @endif

    <script>
        function setSemuaHadir() {
            document.querySelectorAll('.radio-hadir').forEach(function(radio) {
                radio.checked = true;
            });
        }

        function toggleEditMateri() {
            const box = document.getElementById('formEditMateriBox');
            const btnText = document.getElementById('btnTextUbahMateri');
            if (box.style.display === 'none' || box.style.display === '') {
                box.style.display = 'block';
                if (btnText) btnText.innerText = 'Tutup Edit';
            } else {
                box.style.display = 'none';
                if (btnText) btnText.innerText = 'Ubah Materi';
            }
        }
    </script>
</x-siakad-layout>

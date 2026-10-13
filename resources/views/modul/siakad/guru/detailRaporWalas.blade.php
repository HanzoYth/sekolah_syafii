<x-siakad-layout 
    title="Cetak Rapor Siswa" 
    description="Pratinjau dokumen Laporan Hasil Belajar Siswa (Rapor) dan sesuaikan catatan wali kelas sebelum dicetak." 
    position="Guru Wali Kelas" 
    initials="WK">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <a href="/sk/rapor-walas" class="text-slate-500 hover:text-emerald-600 transition-colors">Rapor & Leger</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">{{ $siswa->nama }}</span>
        </li>
    </x-slot>

    <!-- Panel Kontrol Wali Kelas (Tidak ikut tercetak saat print) -->
    <div class="no-print bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-5 border-b border-slate-100">
            <div class="flex items-center gap-3">
                <a href="/sk/rapor-walas" class="w-9 h-9 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition-colors">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <div>
                    <h3 class="text-base font-bold text-slate-800">Kustomisasi & Pratinjau Cetak Rapor: {{ $siswa->nama }}</h3>
                    <p class="text-xs text-slate-500">Sesuaikan Catatan Wali Kelas di bawah ini sebelum menekan tombol Cetak Rapor</p>
                </div>
            </div>

            <div class="flex items-center gap-2.5">
                <a href="/sk/rapor-walas?tab=nilai" class="px-4 py-2 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 text-xs font-bold transition-colors flex items-center gap-1.5">
                    <i class="fa-solid fa-sliders"></i> Edit Nilai Mapel
                </a>
                <button type="button" onclick="window.print()" class="px-5 py-2 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Cetak Dokumen Rapor
                </button>
            </div>
        </div>

        @php
            $defaultCatatan = ($rata_rata_rapor ?? 0) >= 85 
                ? "Ananda {$siswa->nama} menunjukkan prestasi akademik yang sangat baik dan aktif dalam pembelajaran di kelas. Pertahankan semangat belajar dan terus tingkatkan potensi diri."
                : (($rata_rata_rapor ?? 0) >= 75 
                    ? "Ananda {$siswa->nama} telah mengikuti kegiatan pembelajaran dengan baik dan mencapai ketuntasan belajar. Tingkatkan lagi kedisiplinan dan keaktifan belajar di semester berikutnya."
                    : "Ananda {$siswa->nama} perlu lebih giat berlatih dan mengulang materi pelajaran di rumah agar capaian akademik pada semester berikutnya dapat meningkat lebih optimal.");
        @endphp

        <div class="mt-4 grid grid-cols-1 lg:grid-cols-3 gap-4">
            <div class="lg:col-span-2">
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    <i class="fa-solid fa-pen-nib text-emerald-600 mr-1"></i> Catatan & Evaluasi Wali Kelas (Tampil di Rapor)
                </label>
                <textarea id="inputCatatanWalas" rows="2" oninput="updateCatatanPreview(this.value)"
                          class="w-full px-3.5 py-2 text-sm bg-slate-50 border border-slate-200 rounded-lg text-slate-800 focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">{{ $defaultCatatan }}</textarea>
            </div>
            <div class="bg-slate-50 rounded-lg p-3.5 border border-slate-200 flex flex-col justify-between">
                <div class="flex items-center justify-between text-xs">
                    <span class="text-slate-500 font-medium">Rata-rata Nilai Rapor:</span>
                    <span class="font-bold text-emerald-700 text-sm">{{ number_format($rata_rata_rapor ?? 0, 1) }}</span>
                </div>
                <div class="flex items-center justify-between text-xs mt-1.5">
                    <span class="text-slate-500 font-medium">Mata Pelajaran Dinilai:</span>
                    <span class="font-bold text-slate-800">{{ count($rekap_nilai) }} Mapel</span>
                </div>
                <div class="flex items-center justify-between text-xs mt-1.5">
                    <span class="text-slate-500 font-medium">Total Ketidakhadiran:</span>
                    <span class="font-bold text-slate-800">{{ ($rekap_absensi['sakit'] ?? 0) + ($rekap_absensi['izin'] ?? 0) + ($rekap_absensi['alpa'] ?? 0) }} Hari</span>
                </div>
            </div>
        </div>
    </div>

    <!-- DOKUMEN RAPOR (AREA CETAK) -->
    <div class="print-area bg-white rounded-xl shadow-sm border border-slate-200 p-8 sm:p-12 text-slate-900">
        <!-- Kop Rapor -->
        <div class="text-center border-b-2 border-slate-800 pb-5 mb-6">
            <h1 class="text-xl sm:text-2xl font-extrabold uppercase tracking-wide text-slate-900">Laporan Hasil Capaian Belajar Peserta Didik</h1>
            <p class="text-sm font-semibold text-slate-600 mt-1">
                Tahun Ajaran {{ $tahun_aktif->nama ?? '2026/2027' }} • Semester {{ ucfirst($tahun_aktif->semester ?? 'Ganjil') }}
            </p>
        </div>

        <!-- Identitas Siswa -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-sm mb-6 pb-4 border-b border-slate-200">
            <div class="flex">
                <span class="w-36 font-semibold text-slate-600">Nama Peserta Didik</span>
                <span class="mr-2">:</span>
                <span class="font-bold text-slate-900 uppercase">{{ $siswa->nama }}</span>
            </div>
            <div class="flex">
                <span class="w-36 font-semibold text-slate-600">Kelas / Rombel</span>
                <span class="mr-2">:</span>
                <span class="font-bold text-slate-900">{{ $wallas->ruangKelas->nama_ruang ?? '-' }}</span>
            </div>
            <div class="flex">
                <span class="w-36 font-semibold text-slate-600">Nomor Induk / NIS</span>
                <span class="mr-2">:</span>
                <span class="font-mono font-semibold text-slate-800">{{ $siswa->nis ?? '-' }}</span>
            </div>
            <div class="flex">
                <span class="w-36 font-semibold text-slate-600">Wali Kelas</span>
                <span class="mr-2">:</span>
                <span class="font-semibold text-slate-800">{{ $wallas->guru->nama ?? '-' }}</span>
            </div>
        </div>

        <!-- A. Capaian Nilai Akademik -->
        <div class="mb-6">
            <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">A. Capaian Nilai Akademik</h3>
            <table class="w-full border-collapse border border-slate-400 text-xs sm:text-sm">
                <thead>
                    <tr class="bg-slate-100 text-slate-800 font-bold text-center">
                        <th class="border border-slate-400 px-3 py-2.5 w-10">No</th>
                        <th class="border border-slate-400 px-3 py-2.5 text-left">Mata Pelajaran</th>
                        <th class="border border-slate-400 px-3 py-2.5 w-16">KKM</th>
                        <th class="border border-slate-400 px-3 py-2.5 w-24">Nilai Akhir</th>
                        <th class="border border-slate-400 px-3 py-2.5 w-20">Predikat</th>
                        <th class="border border-slate-400 px-3 py-2.5 w-28">Ketuntasan</th>
                        <th class="border border-slate-400 px-3 py-2.5 text-left">Deskripsi Capaian Kompetensi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @if(count($rekap_nilai) > 0)
                        @foreach($rekap_nilai as $mapel => $data)
                            @php 
                                $na = $data['nilai_akhir']; 
                                $kkm = $data['kkm'] ?? 75;
                                $predikat = 'D';
                                if($na >= 90) $predikat = 'A';
                                elseif($na >= 80) $predikat = 'B';
                                elseif($na >= 70) $predikat = 'C';
                                
                                $tuntas = $na >= $kkm;
                                $deskripsi = $na >= 90 
                                    ? "Sangat baik dalam menguasai seluruh kompetensi dasar mata pelajaran {$mapel}."
                                    : ($na >= $kkm 
                                        ? "Baik dan tuntas dalam memahami materi pokok mata pelajaran {$mapel}."
                                        : "Perlu bimbingan dan penguatan lebih lanjut pada kompetensi dasar {$mapel}.");
                            @endphp
                            <tr>
                                <td class="border border-slate-400 px-3 py-2 text-center">{{ $i++ }}</td>
                                <td class="border border-slate-400 px-3 py-2 font-semibold">{{ $mapel }}</td>
                                <td class="border border-slate-400 px-3 py-2 text-center text-slate-600">{{ $kkm }}</td>
                                <td class="border border-slate-400 px-3 py-2 text-center font-bold">{{ number_format($na, 1) }}</td>
                                <td class="border border-slate-400 px-3 py-2 text-center font-bold">{{ $predikat }}</td>
                                <td class="border border-slate-400 px-3 py-2 text-center font-semibold {{ $tuntas ? 'text-emerald-800' : 'text-rose-700' }}">
                                    {{ $tuntas ? 'Tuntas' : 'Belum Tuntas' }}
                                </td>
                                <td class="border border-slate-400 px-3 py-2 text-xs text-slate-700 leading-relaxed">{{ $deskripsi }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-slate-50 font-bold">
                            <td colspan="3" class="border border-slate-400 px-3 py-2 text-right">Jumlah Nilai Akhir</td>
                            <td class="border border-slate-400 px-3 py-2 text-center">{{ number_format($total_nilai_akhir ?? 0, 1) }}</td>
                            <td colspan="3" class="border border-slate-400 px-3 py-2 text-left">
                                Rata-Rata Capaian Rapor: <span class="underline">{{ number_format($rata_rata_rapor ?? 0, 1) }}</span>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="7" class="border border-slate-400 px-4 py-6 text-center text-slate-500">
                                Belum ada nilai mata pelajaran yang diinput untuk siswa ini.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- B. Ketidakhadiran & C. Catatan Wali Kelas -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-10">
            <div class="md:col-span-5">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">B. Rekapitulasi Ketidakhadiran</h3>
                <table class="w-full border-collapse border border-slate-400 text-sm">
                    <tr>
                        <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">1. Sakit</td>
                        <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold w-28">{{ $rekap_absensi['sakit'] ?? 0 }} Hari</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">2. Izin</td>
                        <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold">{{ $rekap_absensi['izin'] ?? 0 }} Hari</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">3. Tanpa Keterangan (Alpa)</td>
                        <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold">{{ $rekap_absensi['alpa'] ?? 0 }} Hari</td>
                    </tr>
                </table>
            </div>

            <div class="md:col-span-7">
                <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">C. Catatan & Evaluasi Wali Kelas</h3>
                <div id="previewCatatanWalas" class="border border-slate-400 p-4 min-h-[106px] text-sm text-slate-800 italic leading-relaxed bg-slate-50/30">
                    "{{ $defaultCatatan }}"
                </div>
            </div>
        </div>

        <!-- Tanda Tangan Pengesahan -->
        <div class="grid grid-cols-2 gap-8 mt-12 text-sm text-center">
            <div>
                <p class="mb-20">Mengetahui,<br>Orang Tua / Wali Peserta Didik</p>
                <p class="font-bold underline">....................................................</p>
            </div>
            <div>
                <p class="mb-20">Diterbitkan pada {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}<br>Wali Kelas {{ $wallas->ruangKelas->nama_ruang ?? '' }}</p>
                <p class="font-bold underline">{{ $wallas->guru->nama ?? '....................................................' }}</p>
                @if(!empty($wallas->guru->nig))
                    <p class="text-xs text-slate-600 mt-0.5">NIG. {{ $wallas->guru->nig }}</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function updateCatatanPreview(val) {
            const box = document.getElementById('previewCatatanWalas');
            if (box) {
                box.textContent = '"' + val + '"';
            }
        }
    </script>

    <style>
        @media print {
            body * { visibility: hidden; }
            .no-print { display: none !important; }
            .print-area, .print-area * { visibility: visible; }
            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }
        }
    </style>
</x-siakad-layout>

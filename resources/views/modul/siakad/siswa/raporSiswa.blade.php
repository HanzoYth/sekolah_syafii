<x-siakad-layout 
    title="Nilai & Rapor Akademik Siswa" 
    description="Transkrip rincian nilai komponen (Tugas, UH, UTS, UAS) dan pratinjau dokumen Rapor Semester ananda {{ $siswa->nama }}." 
    position="Siswa / Orang Tua" 
    initials="SW">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dbs" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Nilai & Rapor</span>
        </li>
    </x-slot>

    @php
        $activeTab = $tab ?? request('tab', 'transkrip');
        $namaKelas = $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? '-');
    @endphp

    <!-- Top Summary KPI Cards (Hidden when printing) -->
    <div class="no-print grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-book"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Mata Pelajaran</p>
                <h3 class="text-xl font-bold text-slate-800">{{ $stats_akademik['mapel_dinilai'] ?? 0 }} / {{ $stats_akademik['total_mapel'] ?? count($rekap_nilai) }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mapel telah dinilai</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Rata-rata Nilai Akhir</p>
                <h3 class="text-xl font-bold text-emerald-600">{{ ($stats_akademik['rata_rata'] ?? 0) > 0 ? number_format($stats_akademik['rata_rata'], 1) : '-' }}</h3>
                <p class="text-[11px] text-emerald-700 font-semibold mt-0.5">Predikat: {{ $stats_akademik['predikat_umum'] ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Status Ketuntasan</p>
                <h3 class="text-xl font-bold text-slate-800">{{ $stats_akademik['mapel_tuntas'] ?? 0 }} Mapel</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Mencapai batas KKM</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-xl flex-shrink-0">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500">Wali Kelas</p>
                <h3 class="text-sm font-bold text-slate-800 line-clamp-1">{{ $wallas->guru->nama ?? 'Belum Ditentukan' }}</h3>
                <p class="text-[11px] text-slate-400 mt-0.5">Kelas {{ $namaKelas }}</p>
            </div>
        </div>
    </div>

    <!-- Tab Bar & Print Button -->
    <div class="no-print flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div class="inline-flex flex-wrap p-1.5 rounded-xl bg-slate-200/70 border border-slate-200 self-start gap-1">
            <a href="/sk/rapor-siswa?tab=transkrip" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab !== 'rapor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-list-check"></i>
                <span>Rincian Nilai</span>
            </a>
            <a href="/sk/rapor-siswa?tab=rapor" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $activeTab === 'rapor' ? 'bg-white text-emerald-700 shadow-sm' : 'text-slate-600 hover:text-slate-800' }}">
                <i class="fa-solid fa-file-contract"></i>
                <span>Lembar Rapor</span>
            </a>
        </div>

        @if($activeTab === 'rapor')
            <button type="button" onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition-colors shadow-sm flex items-center gap-2 self-start sm:self-auto">
                <i class="fa-solid fa-print"></i> Cetak Rapor
            </button>
        @endif
    </div>

    @if($activeTab === 'rapor')
        <!-- TAB 2: LEMBAR RAPOR RESMI (SIAP CETAK) -->
        <div class="print-area bg-white rounded-xl shadow-sm border border-slate-200 p-8 sm:p-12 text-slate-900">
            <!-- Kop Rapor -->
            <div class="text-center border-b-2 border-slate-800 pb-5 mb-6">
                <h1 class="text-xl sm:text-2xl font-extrabold uppercase tracking-wide text-slate-900">Laporan Hasil Capaian Belajar Peserta Didik</h1>
                <p class="text-sm font-semibold text-slate-600 mt-1">
                    Tahun Ajaran {{ $tahun_aktif->nama ?? '2026/2027' }} &bull; Semester {{ ucfirst($tahun_aktif->semester ?? 'Ganjil') }}
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
                    <span class="font-bold text-slate-900">{{ $namaKelas }}</span>
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
                <div class="overflow-x-auto w-full">
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
                        @if(count($rekap_nilai) > 0)
                            @foreach($rekap_nilai as $mapel_id => $data)
                                <tr>
                                    <td class="border border-slate-400 px-3 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border border-slate-400 px-3 py-2 font-semibold">{{ $data['mata_pelajaran']->nama_mapel ?? '-' }}</td>
                                    <td class="border border-slate-400 px-3 py-2 text-center text-slate-600">{{ $data['kkm'] ?? 75 }}</td>
                                    <td class="border border-slate-400 px-3 py-2 text-center font-bold">
                                        {{ $data['ada_nilai'] ? number_format($data['nilai_akhir'], 1) : '-' }}
                                    </td>
                                    <td class="border border-slate-400 px-3 py-2 text-center font-bold">{{ $data['predikat'] ?? '-' }}</td>
                                    <td class="border border-slate-400 px-3 py-2 text-center font-semibold {{ !$data['ada_nilai'] ? 'text-slate-400' : ($data['tuntas'] ? 'text-emerald-800' : 'text-rose-700') }}">
                                        {{ !$data['ada_nilai'] ? 'Belum Dinilai' : ($data['tuntas'] ? 'Tuntas' : 'Belum Tuntas') }}
                                    </td>
                                    <td class="border border-slate-400 px-3 py-2 text-xs text-slate-700 leading-relaxed">{{ $data['deskripsi'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                            <tr class="bg-slate-50 font-bold">
                                <td colspan="3" class="border border-slate-400 px-3 py-2 text-right">Jumlah Nilai Akhir</td>
                                <td class="border border-slate-400 px-3 py-2 text-center">{{ number_format($stats_akademik['total_nilai_akhir'] ?? 0, 1) }}</td>
                                <td colspan="3" class="border border-slate-400 px-3 py-2 text-left">
                                    Rata-Rata Capaian Rapor: <span class="underline">{{ number_format($stats_akademik['rata_rata'] ?? 0, 1) }}</span>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="7" class="border border-slate-400 px-4 py-6 text-center text-slate-500">
                                    Belum ada data nilai rapor untuk semester ini.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>

            <!-- B. Ketidakhadiran & C. Evaluasi Wali Kelas -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-10">
                <div class="md:col-span-5">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">B. Rekapitulasi Ketidakhadiran</h3>
                    <div class="overflow-x-auto w-full">
                        <table class="w-full border-collapse border border-slate-400 text-sm">
                            <tr>
                                <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">1. Sakit</td>
                                <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold w-28">{{ $rekap_absen['s'] ?? 0 }} Hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">2. Izin</td>
                                <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold">{{ $rekap_absen['i'] ?? 0 }} Hari</td>
                            </tr>
                            <tr>
                                <td class="border border-slate-400 px-3.5 py-2 bg-slate-50 font-medium">3. Tanpa Keterangan (Alpa)</td>
                                <td class="border border-slate-400 px-3.5 py-2 text-center font-semibold">{{ $rekap_absen['a'] ?? 0 }} Hari</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="md:col-span-7">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2.5">C. Catatan Evaluasi Wali Kelas</h3>
                    @php
                        $rata = $stats_akademik['rata_rata'] ?? 0;
                        $catatanOtomatis = $rata >= 85
                            ? "Ananda {$siswa->nama} menunjukkan prestasi akademik yang sangat baik dan aktif dalam kegiatan pembelajaran di kelas. Pertahankan semangat belajar dan terus tingkatkan potensi diri."
                            : ($rata >= 75
                                ? "Ananda {$siswa->nama} telah mengikuti kegiatan pembelajaran dengan baik dan mencapai ketuntasan belajar. Tingkatkan terus kedisiplinan dan keaktifan belajar di semester berikutnya."
                                : "Terus tingkatkan semangat belajar, keaktifan di kelas, dan pengulangan materi pelajaran di rumah agar capaian akademik semakin optimal.");
                    @endphp
                    <div class="border border-slate-400 p-4 min-h-[106px] text-sm text-slate-800 italic leading-relaxed bg-slate-50/30">
                        "{{ $catatanOtomatis }}"
                    </div>
                </div>
            </div>

            <!-- Tanda Tangan -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 mt-12 text-sm text-center">
                <div>
                    <p class="mb-14 sm:mb-20">Mengetahui,<br>Orang Tua / Wali Peserta Didik</p>
                    <p class="font-bold underline">....................................................</p>
                </div>
                <div>
                    <p class="mb-14 sm:mb-20">Wali Kelas {{ $namaKelas }}</p>
                    <p class="font-bold underline">{{ $wallas->guru->nama ?? '....................................................' }}</p>
                    @if(!empty($wallas->guru->nig))
                        <p class="text-xs text-slate-600 mt-0.5">NIG. {{ $wallas->guru->nig }}</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        <!-- TAB 1: TRANSKRIP RINCIAN NILAI KOMPONEN -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="px-6 py-5 border-b border-slate-200 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Rincian Capaian Nilai Per Komponen</h3>
                    <p class="text-xs text-slate-500">Daftar nilai Tugas, Ulangan Harian, UTS, dan UAS yang diinput oleh Guru Pengajar maupun Wali Kelas</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 self-start sm:self-auto">
                    Tahun Ajaran {{ $tahun_aktif->nama ?? '2026/2027' }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            <th class="px-5 py-3.5 w-12 text-center">No</th>
                            <th class="px-5 py-3.5">Mata Pelajaran & Pengajar</th>
                            <th class="px-5 py-3.5 text-center">KKM</th>
                            @foreach($jenis_penilaian as $jp)
                                <th class="px-4 py-3.5 text-center">
                                    {{ $jp->nama_jenis }}
                                    <span class="block text-[10px] font-normal text-slate-400">Bobot {{ $jp->bobot }}%</span>
                                </th>
                            @endforeach
                            <th class="px-5 py-3.5 text-center bg-emerald-50/70 text-emerald-900">Nilai Akhir</th>
                            <th class="px-5 py-3.5 text-center">Predikat</th>
                            <th class="px-5 py-3.5 text-center">Ketuntasan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @if(count($rekap_nilai) > 0)
                            @foreach($rekap_nilai as $mapel_id => $data)
                                @php
                                    $ada = $data['ada_nilai'] ?? true;
                                    $na = $data['nilai_akhir'];
                                    $predikat = $data['predikat'] ?? '-';
                                    $tuntas = $data['tuntas'] ?? ($na >= ($data['kkm'] ?? 75));
                                @endphp
                                <tr class="hover:bg-slate-50/70 transition-colors">
                                    <td class="px-5 py-4 text-center text-slate-400 font-medium">{{ $loop->iteration }}</td>
                                    <td class="px-5 py-4">
                                        <span class="font-bold text-slate-800 block">{{ $data['mata_pelajaran']->nama_mapel ?? '-' }}</span>
                                        <span class="text-xs text-slate-400">
                                            <i class="fa-solid fa-chalkboard-user text-[10px] mr-1"></i> {{ $data['guru_nama'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-center font-mono text-xs font-semibold text-slate-500">
                                        {{ $data['kkm'] ?? 75 }}
                                    </td>
                                    @foreach($jenis_penilaian as $jp)
                                        @php
                                            $skor = $data['nilai_detail'][$jp->id] ?? null;
                                        @endphp
                                        <td class="px-4 py-4 text-center font-mono">
                                            @if($skor !== null)
                                                <span class="font-semibold text-slate-700">{{ $skor }}</span>
                                            @else
                                                <span class="text-xs text-slate-300">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="px-5 py-4 text-center bg-emerald-50/30 font-extrabold text-base {{ !$ada ? 'text-slate-400' : ($tuntas ? 'text-emerald-700' : 'text-rose-600') }}">
                                        {{ $ada ? number_format($na, 1) : '-' }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if(!$ada)
                                            <span class="text-xs text-slate-400">-</span>
                                        @else
                                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-extrabold {{ $predikat === 'A' ? 'bg-emerald-100 text-emerald-800' : ($predikat === 'B' ? 'bg-blue-100 text-blue-800' : ($predikat === 'C' ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800')) }}">
                                                {{ $predikat }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if(!$ada)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-500">
                                                Belum Input
                                            </span>
                                        @elseif($tuntas)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <i class="fa-solid fa-check mr-1 text-[10px]"></i> Tuntas
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <i class="fa-solid fa-rotate-right mr-1 text-[10px]"></i> Perlu Remedi
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="{{ 6 + count($jenis_penilaian) }}" class="px-6 py-12 text-center text-slate-500">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-slate-50 flex items-center justify-center text-slate-300">
                                        <i class="fa-solid fa-folder-open text-2xl"></i>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-700">Belum Ada Data Mata Pelajaran atau Nilai</h4>
                                    <p class="text-xs text-slate-400 mt-1">Data nilai akan tampil secara otomatis setelah diinput oleh Guru Pengajar.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif

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
            }
        }
    </style>
</x-siakad-layout>

<x-siakad-layout 
    title="Rapor & Nilai Akademik" 
    description="Laporan hasil belajar ananda {{ $siswa->nama }}." 
    position="Orang Tua / Siswa" 
    initials="OT">

    <!-- INFO SISWA -->
    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-bottom: 24px; display: flex; gap: 20px; align-items: center;">
        <div style="width: 80px; height: 80px; border-radius: 50%; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 30px; color: #94a3b8;">
            <i class="fa-solid fa-user-graduate"></i>
        </div>
        <div>
            <h2 style="margin: 0 0 5px 0; color: #1e293b; font-size: 20px;">{{ $siswa->nama }}</h2>
            <div style="color: #64748b; font-size: 14px; display: flex; gap: 15px;">
                <span><i class="fa-solid fa-id-card"></i> NIS: {{ $siswa->nis }}</span>
                <span><i class="fa-solid fa-users"></i> Kelas: {{ $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? '-') }}</span>
            </div>
        </div>
    </div>

    <!-- REKAP NILAI -->
    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
            <i class="fa-solid fa-star"></i> Capaian Hasil Belajar
        </div>
        
        <x-siakad.ui.table>
            <x-slot name="thead">
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Mata Pelajaran</th>
                    @foreach($jenis_penilaian as $jp)
                        <th style="text-align: center;">{{ $jp->nama_jenis }}<br><span style="font-size: 11px; font-weight: normal;">{{ $jp->bobot }}%</span></th>
                    @endforeach
                    <th style="text-align: center; background: #dcfce7; color: #166534;">NILAI AKHIR</th>
                    <th style="text-align: center;">PREDIKAT</th>
                </tr>
            </x-slot>

            @php $no = 1; @endphp
            @forelse($rekap_nilai as $mapel_id => $data)
                @php
                    $nilai_akhir = round($data['nilai_akhir'], 1);
                    $predikat = 'D';
                    $predikat_color = '#dc2626'; // Red
                    if ($nilai_akhir >= 90) { $predikat = 'A'; $predikat_color = '#16a34a'; } // Green
                    elseif ($nilai_akhir >= 80) { $predikat = 'B'; $predikat_color = '#0284c7'; } // Blue
                    elseif ($nilai_akhir >= 70) { $predikat = 'C'; $predikat_color = '#ca8a04'; } // Yellow
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td><strong>{{ $data['mata_pelajaran']->nama_mapel ?? '-' }}</strong></td>
                    @foreach($jenis_penilaian as $jp)
                        <td style="text-align: center;">
                            {{ $data['nilai_detail'][$jp->id] ?? '-' }}
                        </td>
                    @endforeach
                    <td style="text-align: center; font-weight: bold; font-size: 16px;">
                        {{ $nilai_akhir }}
                    </td>
                    <td style="text-align: center;">
                        <span style="background: {{ $predikat_color }}20; color: {{ $predikat_color }}; padding: 4px 12px; border-radius: 6px; font-weight: bold;">
                            {{ $predikat }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ 4 + count($jenis_penilaian) }}" style="text-align: center; padding: 30px;">
                        <i class="fa-solid fa-folder-open" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                        Belum ada data nilai untuk semester ini.
                    </td>
                </tr>
            @endforelse
        </x-siakad.ui.table>
    </div>
</x-siakad-layout>


<x-siakad-layout 
    title="Jadwal & Absensi" 
    description="Jadwal pelajaran dan rekap kehadiran ananda {{ $siswa->nama }}." 
    position="Orang Tua / Siswa" 
    initials="OT">

    <!-- REKAP ABSENSI -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 24px;">
        <x-siakad.ui.card-rekap title="Hadir" value="{{ $rekap_absen['h'] }} Hari" icon="fa-user-check" color="#16a34a" />
        <x-siakad.ui.card-rekap title="Izin" value="{{ $rekap_absen['i'] }} Hari" icon="fa-envelope-open-text" color="#0284c7" />
        <x-siakad.ui.card-rekap title="Sakit" value="{{ $rekap_absen['s'] }} Hari" icon="fa-bed-pulse" color="#ca8a04" />
        <x-siakad.ui.card-rekap title="Alpa" value="{{ $rekap_absen['a'] }} Hari" icon="fa-user-xmark" color="#dc2626" />
    </div>

    <!-- JADWAL PELAJARAN -->
    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
            <i class="fa-solid fa-calendar-week"></i> Jadwal Pelajaran (Kelas {{ $siswa->kelas->nama_ruang ?? ($siswa->kelas->nama_kelas ?? '-') }})
        </div>
        
        <x-siakad.ui.table>
            <x-slot name="thead">
                <tr>
                    <th>Hari</th>
                    <th>Jam Pelajaran</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru Pengajar</th>
                </tr>
            </x-slot>

            @forelse($jadwal as $j)
                <tr>
                    <td>
                        <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                            {{ ucfirst($j->hari) }}
                        </span>
                    </td>
                    <td>{{ $j->jam_pelajaran->jam_mulai ?? '-' }} - {{ $j->jam_pelajaran->jam_selesai ?? '-' }}</td>
                    <td><strong>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</strong></td>
                    <td>{{ $j->guru->nama ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 30px;">
                        <i class="fa-solid fa-calendar-xmark" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                        Belum ada jadwal pelajaran yang diatur untuk kelas ini.
                    </td>
                </tr>
            @endforelse
        </x-siakad.ui.table>
    </div>
</x-siakad-layout>


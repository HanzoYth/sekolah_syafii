<x-siakad-layout 
    title="Jadwal Mengajar" 
    description="Jadwal mata pelajaran yang Anda ampu" 
    position="Guru SIAKAD" 
    initials="GR">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
            <i class="fa-solid fa-calendar-week"></i> Jadwal Mengajar Anda
        </div>
        
        <x-siakad.ui.table>
            <x-slot name="thead">
                <tr>
                    <th>Hari</th>
                    <th>Jam Pelajaran</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Ruangan</th>
                </tr>
            </x-slot>

            @if(count($jadwal) > 0)
                @foreach($jadwal as $j)
                    <tr>
                        <td>
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                {{ ucfirst($j->hari) }}
                            </span>
                        </td>
                        <td>{{ $j->jam_pelajaran->jam_mulai ?? '-' }} - {{ $j->jam_pelajaran->jam_selesai ?? '-' }}</td>
                        <td>
                            <span style="background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                {{ $j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-') }}
                            </span>
                        </td>
                        <td><strong>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</strong></td>
                        <td>{{ $j->kelas->nama_ruang ?? ($j->kelas->nama_kelas ?? '-') }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px;">
                        <i class="fa-solid fa-folder-open" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                        Belum ada jadwal mengajar yang diatur untuk Anda.
                    </td>
                </tr>
            @endif
        </x-siakad.ui.table>
    </div>
</x-siakad-layout>

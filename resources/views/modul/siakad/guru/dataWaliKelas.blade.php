<x-siakad-layout 
    title="Data Siswa Wali Kelas" 
    description="Daftar siswa yang berada di bawah perwalian Anda." 
    position="Guru Wali Kelas" 
    initials="GR">

    <div style="padding: 24px; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 20px;">
        @if($wallas)
            <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; display: flex; align-items: center; gap: 10px;">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-users-rectangle"></i>
                </div>
                Rombongan Belajar: {{ $wallas->ruangKelas->nama_ruang ?? '-' }}
            </div>
            
            <x-siakad.ui.table :headers="['No', 'NIS', 'Nama Lengkap', 'Jenis Kelamin', 'Status']">
                @if(count($siswa) > 0)
                    @foreach($siswa as $s)
                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td>{{ $s->nis }}</td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td>{{ $s->gender == 'p' ? 'Perempuan' : 'Laki-laki' }}</td>
                        <td style="text-align: center;">
                            <span style="display: inline-flex; align-items: center; gap: 4px; background:#dcfce7; color:#166534; padding:4px 10px; border-radius:20px; font-size:12px; font-weight: 600;">
                                <i class="fa-solid fa-circle-check"></i> Aktif
                            </span>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px 20px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                            Belum ada data siswa di kelas ini.
                        </td>
                    </tr>
                @endif
            </x-siakad.ui.table>
            <div style="font-size: 18px; font-weight: bold; margin: 40px 0 20px; color: #1e293b; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px; display: flex; align-items: center; gap: 10px;">
                <div style="width: 40px; height: 40px; border-radius: 8px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-calendar-week"></i>
                </div>
                Jadwal Mengajar Kelas
            </div>

            @foreach(['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'] as $hari)
                @if(isset($jadwal_mingguan[$hari]) && $jadwal_mingguan[$hari]->count() > 0)
                    <h4 style="margin-top: 20px; color: #334155; font-size: 16px;"><i class="fa-solid fa-calendar-day" style="color: #177455; margin-right: 8px;"></i> Hari {{ ucfirst($hari) }}</h4>
                    <x-siakad.ui.table :headers="['Jam', 'Waktu', 'Mata Pelajaran', 'Guru Pengajar']">
                        @foreach($jadwal_mingguan[$hari] as $j)
                            <tr>
                                <td>{{ $j->jam_pelajaran->nama_jam }}</td>
                                <td>{{ substr($j->jam_pelajaran->jam_mulai, 0, 5) }} - {{ substr($j->jam_pelajaran->jam_selesai, 0, 5) }}</td>
                                <td><strong>{{ $j->mata_pelajaran->nama_pelajaran }}</strong></td>
                                <td>{{ $j->guru->nama }}</td>
                            </tr>
                        @endforeach
                    </x-siakad.ui.table>
                @endif
            @endforeach

        @else
            <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
                <i class="fa-solid fa-ban" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                Anda saat ini tidak ditugaskan sebagai Wali Kelas.
            </div>
        @endif
    </div>
</x-siakad-layout>

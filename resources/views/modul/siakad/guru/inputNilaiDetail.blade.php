<x-siakad-layout 
    title="Input Nilai Siswa" 
    description="Masukkan nilai untuk mata pelajaran {{ $jadwal->mata_pelajaran->nama_mapel ?? '-' }} kelas {{ $jadwal->kelas->nama_ruang ?? ($jadwal->kelas->nama_kelas ?? '-') }}." 
    position="Guru SIAKAD" 
    initials="GR">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        @if(session('success'))
            <x-siakad.ui.alert type="success" message="{{ session('success') }}" />
        @endif
        
        <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #166534; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <i class="fa-solid fa-file-pen"></i> Form Nilai: {{ $jadwal->kelas->nama_ruang ?? ($jadwal->kelas->nama_kelas ?? '-') }} - {{ $jadwal->mata_pelajaran->nama_mapel ?? '-' }}
            </div>
            <a href="/sk/nilai-guru" style="color: #64748b; text-decoration: none; font-size: 14px; font-weight: normal; background: #f1f5f9; padding: 6px 12px; border-radius: 6px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <form action="/sk/simpan-nilai-siswa/{{ $jadwal->id }}" method="POST">
            @csrf
            <div style="overflow-x: auto;">
                <x-siakad.ui.table>
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            @foreach($jenis_penilaian as $jp)
                                <th style="text-align: center;">{{ $jp->nama_jenis }}<br><span style="font-size: 11px; font-weight: normal; color: #166534; background: #dcfce7; padding: 2px 6px; border-radius: 4px;">{{ $jp->bobot }}%</span></th>
                            @endforeach
                        </tr>
                    </x-slot>
                    
                    @forelse($siswa as $index => $s)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td>{{ $s->nis }}</td>
                        @foreach($jenis_penilaian as $jp)
                            <td style="text-align: center;">
                                <input type="number" 
                                       name="nilai[{{ $s->id }}][{{ $jp->id }}]" 
                                       value="{{ $nilai[$s->id][$jp->id] ?? '' }}" 
                                       style="width: 70px; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px; text-align: center; font-family: inherit; transition: all 0.2s;" 
                                       onfocus="this.style.borderColor='#166534'; this.style.boxShadow='0 0 0 2px rgba(22, 101, 52, 0.2)';"
                                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';"
                                       min="0" max="100" step="0.1" 
                                       placeholder="-">
                            </td>
                        @endforeach
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ 3 + count($jenis_penilaian) }}" style="text-align: center; padding: 30px;">
                            <i class="fa-solid fa-users-slash" style="font-size: 24px; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                            Belum ada siswa di kelas ini.
                        </td>
                    </tr>
                    @endforelse
                </x-siakad.ui.table>
            </div>
            
            @if(count($siswa) > 0)
            <div style="margin-top: 20px; display: flex; justify-content: flex-end;">
                <button type="submit" style="background: #166534; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;" onmouseover="this.style.background='#14532d'" onmouseout="this.style.background='#166534'">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Nilai
                </button>
            </div>
            @endif
        </form>
    </div>
</x-siakad-layout>


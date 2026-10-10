<x-siakad-layout title="Cetak Rapor - SIAKAD" pageTitle="Cetak Rapor Siswa" pageDescription="Kelola dan cetak rapor akademik siswa per semester.">
    <div class="page-header">
        <h2 class="page-title"><i class="fa-solid fa-file-contract"></i> Daftar Siswa - {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}</h2>
    </div>
    
    <x-siakad.ui.table :headers="['No', 'NIS', 'Nama Siswa', 'Gender', 'Aksi']">
        @if(count($siswa) > 0)
            @foreach($siswa as $index => $s)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $s->nis }}</td>
                <td><strong>{{ $s->nama }}</strong></td>
                <td>{{ $s->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td style="text-align: center;">
                    <x-siakad.ui.button href="/sk/detail-rapor-walas/{{ $s->id }}" type="info" icon="fa-solid fa-print" style="background: #0ea5e9; border:none; color:white;">
                        Lihat & Cetak Rapor
                    </x-siakad.ui.button>
                </td>
            </tr>
            @endforeach
        @else
        <tr>
            <td colspan="5" style="text-align: center; padding: 30px;">Belum ada data siswa di kelas ini.</td>
        </tr>
        @endif
    </x-siakad.ui.table>
</x-siakad-layout>


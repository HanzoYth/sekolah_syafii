<x-siakad-layout title="Absensi Kelas - SIAKAD" position="Wali Kelas" initials="WK">
    <style>
        .radio-group { display: flex; gap: 8px; flex-wrap: wrap; }
        .radio-label { display: flex; align-items: center; gap: 5px; cursor: pointer; padding: 4px 10px; border-radius: 6px; border: 1px solid #cbd5e1; font-size: 13px; font-weight: 600; color: #475569; transition: all 0.2s; }
        .radio-label:hover { background: #f1f5f9; }
        .radio-label input[type="radio"] { cursor: pointer; accent-color: #166534; }
        
        .radio-label:has(input[value="h"]:checked) { background: #dcfce7; border-color: #16a34a; color: #166534; }
        .radio-label:has(input[value="s"]:checked) { background: #fef9c3; border-color: #eab308; color: #854d0e; }
        .radio-label:has(input[value="i"]:checked) { background: #dbeafe; border-color: #3b82f6; color: #1e40af; }
        .radio-label:has(input[value="a"]:checked) { background: #fee2e2; border-color: #ef4444; color: #991b1b; }

        .input-ket { width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; outline: none; transition: border-color 0.2s; }
        .input-ket:focus { border-color: #177455; }
        
        .recap-box { display: flex; gap: 15px; margin-bottom: 24px; flex-wrap: wrap; }
        .recap-item { flex: 1; min-width: 120px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 15px; display: flex; align-items: center; gap: 15px; }
        .recap-item i { font-size: 24px; color: #94a3b8; }
        .recap-item div { display: flex; flex-direction: column; }
        .recap-item strong { font-size: 20px; color: #1e293b; }
        .recap-item span { font-size: 12px; color: #64748b; font-weight: 600; text-transform: uppercase; }
        
        .recap-item.hadir i { color: #16a34a; }
        .recap-item.sakit i { color: #eab308; }
        .recap-item.izin i { color: #3b82f6; }
        .recap-item.alpa i { color: #ef4444; }
    </style>

    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-users-rectangle"></i> Wali Kelas
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                <i class="fa-solid fa-clipboard-user"></i> Absensi Kelas
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Kelola kehadiran siswa harian di kelas Anda.
            </div>
        </div>
    </div>

    @if(session('success'))
        <x-siakad.ui.alert type="success" message="{{ session('success') }}" />
    @endif

    <div style="background: white; border-radius: 12px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; flex-wrap: wrap; gap: 16px;">
            <div style="font-size: 16px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 10px;">
                <div style="width: 36px; height: 36px; border-radius: 8px; background: #f3f4f6; color: #475569; display: flex; align-items: center; justify-content: center; font-size: 16px;">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                {{ $wallas->ruangKelas->nama_ruang ?? 'Kelas' }}
            </div>
            
            <form method="GET" action="/sk/absensi-walas" style="display: flex; gap: 10px; align-items: center;">
                <div style="position: relative;">
                    <i class="fa-regular fa-calendar" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #64748b;"></i>
                    <input type="date" name="tanggal" value="{{ $tanggal }}" style="padding: 8px 12px 8px 36px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none; font-family: inherit; color: #1e293b;">
                </div>
                <button type="submit" style="padding: 8px 16px; border: none; background: #f1f5f9; color: #334155; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 14px; transition: background 0.2s;">
                    Tampilkan
                </button>
            </form>
        </div>
        
        <div class="recap-box">
            <div class="recap-item">
                <i class="fa-solid fa-users"></i>
                <div><strong>{{ $rekap['total'] }}</strong><span>Total Siswa</span></div>
            </div>
            <div class="recap-item hadir">
                <i class="fa-solid fa-circle-check"></i>
                <div><strong>{{ $rekap['hadir'] }}</strong><span>Hadir</span></div>
            </div>
            <div class="recap-item sakit">
                <i class="fa-solid fa-notes-medical"></i>
                <div><strong>{{ $rekap['sakit'] }}</strong><span>Sakit</span></div>
            </div>
            <div class="recap-item izin">
                <i class="fa-solid fa-envelope-open-text"></i>
                <div><strong>{{ $rekap['izin'] }}</strong><span>Izin</span></div>
            </div>
            <div class="recap-item alpa">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div><strong>{{ $rekap['alpa'] }}</strong><span>Alpa</span></div>
            </div>
        </div>

        <form action="/sk/simpan-absensi-walas" method="POST">
            @csrf
            <input type="hidden" name="tanggal" value="{{ $tanggal }}">
            
            <x-siakad.ui.table>
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Nama Siswa</th>
                        <th style="width: 120px;">NIS</th>
                        <th style="width: 320px;">Status Kehadiran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($siswa) > 0)
                        @foreach($siswa as $index => $s)
                            @php
                                $absen = $absensi_db[$s->id] ?? null;
                                $status = $absen ? $absen->status : 'h'; // Default hadir
                                $keterangan = $absen ? $absen->keterangan : '';
                            @endphp
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td><strong>{{ $s->nama }}</strong></td>
                            <td>{{ $s->nis }}</td>
                            <td>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="status[{{ $s->id }}]" value="h" {{ $status == 'h' ? 'checked' : '' }}> Hadir
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="status[{{ $s->id }}]" value="s" {{ $status == 's' ? 'checked' : '' }}> Sakit
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="status[{{ $s->id }}]" value="i" {{ $status == 'i' ? 'checked' : '' }}> Izin
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="status[{{ $s->id }}]" value="a" {{ $status == 'a' ? 'checked' : '' }}> Alpa
                                    </label>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="keterangan[{{ $s->id }}]" value="{{ $keterangan }}" class="input-ket" placeholder="Tambahkan keterangan (opsional)..." autocomplete="off">
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
                </tbody>
            </x-siakad.ui.table>
            
            @if(count($siswa) > 0)
            <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #177455; color: white; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Absensi
                </button>
            </div>
            @endif
        </form>
    </div>
</x-siakad-layout>

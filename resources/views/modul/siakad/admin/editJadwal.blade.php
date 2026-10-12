<x-siakad-layout 
    title="Edit Jadwal Pelajaran" 
    description="Perbarui informasi jadwal mengajar." 
    position="Administrator" 
    initials="AD">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-pen-to-square" style="color: #0d5c3a;"></i> Edit Jadwal
        </div>
        <form action="/sk/update-jadwal/{{ $jadwal->id }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_tahun as $t)
                            <option value="{{ $t->id }}" {{ $jadwal->tahun_ajaran_id == $t->id ? 'selected' : '' }}>{{ $t->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Kelas</label>
                    <select name="kelas_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_kelas as $k)
                            <option value="{{ $k->id }}" {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Guru Pengajar</label>
                    <select name="guru_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_guru as $g)
                            <option value="{{ $g->id }}" {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>{{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Mata Pelajaran</label>
                    <select name="mapel_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_mapel as $m)
                            <option value="{{ $m->id }}" {{ $jadwal->mapel_id == $m->id ? 'selected' : '' }}>{{ $m->nama_mapel }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Hari</label>
                    <select name="hari" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="senin" {{ $jadwal->hari == 'senin' ? 'selected' : '' }}>Senin</option>
                        <option value="selasa" {{ $jadwal->hari == 'selasa' ? 'selected' : '' }}>Selasa</option>
                        <option value="rabu" {{ $jadwal->hari == 'rabu' ? 'selected' : '' }}>Rabu</option>
                        <option value="kamis" {{ $jadwal->hari == 'kamis' ? 'selected' : '' }}>Kamis</option>
                        <option value="jumat" {{ $jadwal->hari == 'jumat' ? 'selected' : '' }}>Jumat</option>
                        <option value="sabtu" {{ $jadwal->hari == 'sabtu' ? 'selected' : '' }}>Sabtu</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jam Pelajaran</label>
                    <select name="jam_pelajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_jam as $jam)
                            <option value="{{ $jam->id }}" {{ $jadwal->jam_pelajaran_id == $jam->id ? 'selected' : '' }}>{{ $jam->nama_jam }} ({{ $jam->jam_mulai }} - {{ $jam->jam_selesai }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #0d5c3a; color: white; border-radius: 8px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                <a href="/sk/kelola-jadwal" style="padding: 10px 20px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; font-weight: bold; text-decoration: none;">Batal</a>
            </div>
        </form>
    </div>
</x-siakad-layout>

<x-siakad-layout 
    title="Edit Jadwal Pelajaran" 
    description="Perbarui informasi jadwal mengajar berbasis Sistem JP." 
    position="Administrator" 
    initials="AD">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-pen-to-square" style="color: #0d5c3a;"></i> Edit Jadwal Pelajaran
        </div>
        <form action="/sk/update-jadwal/{{ $jadwal->id }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;"> Kelas (Jenjang & Tingkatan)</label>
                    <select name="kelas_id" id="editKelasSelect" required onchange="onEditKelasChange(false)" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_kelas as $k)
                            @php
                                $namaKelas = $k->nama_kelas ?? ($k->nama_ruang ?? '-');
                                $prefixKelas = strtoupper(explode(' ', trim($namaKelas))[0] ?? '');
                            @endphp
                            <option value="{{ $k->id }}" data-jenjang="{{ $prefixKelas }}" {{ $jadwal->kelas_id == $k->id ? 'selected' : '' }}>
                                {{ $namaKelas }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Hari</label>
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
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Jam Pelajaran (JP)</label>
                    <select name="jam_pelajaran_id" id="editJamSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_jam as $jam)
                            @php
                                $kodeJam = $jam->kode_jenjang;
                                $mulai = substr($jam->jam_mulai, 0, 5);
                                $selesai = substr($jam->jam_selesai, 0, 5);
                                $jmlJp = $jam->hitung_jp;
                                $durasi = $jam->durasi_menit;
                                $sesiLabel = $jam->jam_ke ?: ('Jam ke-' . $loop->iteration);
                            @endphp
                            @if($jam->is_istirahat)
                                <option value="{{ $jam->id }}" disabled data-jenjang="{{ $kodeJam }}" style="color: #b45309; background-color: #fefce8; font-style: italic;">
                                    [{{ $kodeJam }}] ☕ {{ $sesiLabel }} ({{ $mulai }} - {{ $selesai }} • JAM ISTIRAHAT - Bebas KBM)
                                </option>
                            @else
                                <option value="{{ $jam->id }}" data-jenjang="{{ $kodeJam }}" {{ $jadwal->jam_pelajaran_id == $jam->id ? 'selected' : '' }}>
                                    [{{ $kodeJam }}] {{ $sesiLabel }} ({{ $mulai }} - {{ $selesai }} • {{ $jmlJp > 0 ? $jmlJp . ' JP / ' . $durasi . 'm' : 'Non-JP / ' . $durasi . 'm' }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Mata Pelajaran</label>
                    <select name="mapel_id" id="editMapelSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_mapel as $m)
                            @php
                                $kodeMapel = $m->sekolah ? strtoupper(trim($m->sekolah->jenis)) : 'UMUM';
                            @endphp
                            <option value="{{ $m->id }}" data-jenjang="{{ $kodeMapel }}" {{ $jadwal->mapel_id == $m->id ? 'selected' : '' }}>
                                [{{ $kodeMapel }}] {{ $m->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Guru Pengajar</label>
                    <select name="guru_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_guru as $g)
                            @php
                                $tags = [];
                                if ($g->guru_tetap) $tags[] = 'Guru Tetap';
                                elseif ($g->guru_honor) $tags[] = 'Guru Honor';
                                if (\App\Models\wallas::where('guru_id', $g->id)->exists()) $tags[] = 'Wali Kelas';
                                $tagLabel = count($tags) > 0 ? ' (' . implode(', ', $tags) . ')' : '';
                            @endphp
                            <option value="{{ $g->id }}" {{ $jadwal->guru_id == $g->id ? 'selected' : '' }}>{{ $g->nama }}{{ $tagLabel }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 13.5px;">Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        @foreach($data_tahun as $t)
                            <option value="{{ $t->id }}" {{ $jadwal->tahun_ajaran_id == $t->id ? 'selected' : '' }}>{{ $t->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <button type="submit" style="padding: 10px 20px; border: none; background: #0d5c3a; color: white; border-radius: 8px; font-weight: bold; cursor: pointer; display: flex; align-items: center; gap: 8px;"><i class="fa-solid fa-save"></i> Simpan Perubahan</button>
                <a href="/sk/kelola-jadwal" style="padding: 10px 20px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; font-weight: bold; text-decoration: none;">Batal</a>
            </div>
        </form>
    </div>

    <script>
        function onEditKelasChange(initialLoad) {
            const kelasSel = document.getElementById('editKelasSelect');
            const opt = kelasSel.options[kelasSel.selectedIndex];
            const jenjang = opt ? (opt.getAttribute('data-jenjang') || '') : '';
            const jamSel = document.getElementById('editJamSelect');
            const mapelSel = document.getElementById('editMapelSelect');

            let adaJamJenjangSpesifik = false;
            Array.from(jamSel.options).forEach(o => {
                if (o.getAttribute('data-jenjang') === jenjang) adaJamJenjangSpesifik = true;
            });

            Array.from(jamSel.options).forEach(o => {
                const jKode = o.getAttribute('data-jenjang');
                if (!jenjang || !adaJamJenjangSpesifik) {
                    o.hidden = false;
                } else {
                    o.hidden = (jKode !== jenjang && jKode !== 'UMUM' && !o.selected);
                }
            });

            Array.from(mapelSel.options).forEach(o => {
                const mKode = o.getAttribute('data-jenjang');
                o.hidden = (jenjang && mKode !== jenjang && mKode !== 'UMUM' && !o.selected);
            });
        }
        document.addEventListener('DOMContentLoaded', () => onEditKelasChange(true));
    </script>
</x-siakad-layout>

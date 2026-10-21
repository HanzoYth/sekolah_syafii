<x-siakad-layout 
    title="Kelola Jadwal Pelajaran" 
    description="Atur dan manajemen jadwal mata pelajaran berbasis Sistem JP (SD = 35 menit, SMP = 45 menit)." 
    position="Administrator" 
    initials="AD">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; flex-wrap: wrap; gap: 14px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <span><i class="fa-solid fa-calendar-alt" style="color:#177455; margin-right:6px;"></i> Daftar Jadwal Pelajaran</span>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <div style="position: relative; display: flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 5px 12px; gap: 8px;">
                        <i class="fa-solid fa-filter" style="color: #64748b; font-size: 13px;"></i>
                        <select name="sekolah_id" onchange="this.form.submit()" style="background: transparent; border: none; outline: none; font-size: 13.5px; color: #334155; font-weight: 600; cursor: pointer; padding-right: 8px;">
                            <option value="">Semua Jenjang</option>
                            @foreach($data_sekolah as $s)
                                @php
                                    $kodeJenjang = strtoupper(trim($s->jenis));
                                    $pakaiJp = \App\Models\jam_pelajaran::pakaiSistemJp($kodeJenjang);
                                    $standarJp = \App\Models\jam_pelajaran::standarMenitPerJp($kodeJenjang);
                                @endphp
                                <option value="{{ $s->id }}" {{ ($sekolah_id ?? '') == $s->id ? 'selected' : '' }}>
                                    {{ $kodeJenjang }} {{ $pakaiJp ? '(1 JP = ' . $standarJp . 'm)' : '(Non-JP)' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <a href="/sk/referensi" style="background: #f1f5f9; color: #334155; text-decoration: none; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; border: 1px solid #e2e8f0;">
                    <i class="fa-regular fa-clock"></i> Atur Slot Jam & JP
                </a>
                <button onclick="openModal('addModal')" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                    <i class="fa-solid fa-plus"></i> Tambah Jadwal
                </button>
            </div>
        </div>

        <!-- Info Ringkas Standar JP -->
        <div style="display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 18px; padding: 10px 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0; font-size: 12.5px; color: #475569; align-items: center;">
            <span style="font-weight: 700; color: #0f172a;"><i class="fa-solid fa-circle-info" style="color:#177455; margin-right:4px;"></i> Standar Sistem JP:</span>
            <span style="background: #fee2e2; color: #b91c1c; padding: 2px 8px; border-radius: 5px; font-weight: 600;">SD: 1 JP = 35 Menit</span>
            <span style="background: #dbeafe; color: #1d4ed8; padding: 2px 8px; border-radius: 5px; font-weight: 600;">SMP: 1 JP = 45 Menit</span>
            <span style="background: #fef3c7; color: #b45309; padding: 2px 8px; border-radius: 5px; font-weight: 600;">TK: Non-JP (Sesi Bebas)</span>
            <span style="color: #64748b;">• Saat memilih Kelas pada form tambah jadwal, daftar Jam & Mapel akan otomatis menyesuaikan jenjangnya.</span>
        </div>

        <div style="overflow-x: auto;">
            <x-siakad.ui.table>
                <x-slot name="thead">
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Hari</th>
                        <th>Jam Pelajaran & JP</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru Pengajar</th>
                        <th style="text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </x-slot>

                @if(count($data_jadwal) > 0)
                    @foreach($data_jadwal as $index => $j)
                        @php
                            $mulaiStr = $j->jam_pelajaran ? substr($j->jam_pelajaran->jam_mulai, 0, 5) : '-';
                            $selesaiStr = $j->jam_pelajaran ? substr($j->jam_pelajaran->jam_selesai, 0, 5) : '-';
                            $durasiMenit = $j->jam_pelajaran ? $j->jam_pelajaran->durasi_menit : 0;
                            $jmlJp = $j->getJumlahJp();
                            $jamKeLabel = $j->jam_pelajaran->jam_ke ?? null;
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>
                                <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                    {{ ucfirst($j->hari) }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; gap: 3px;">
                                    <div style="font-weight: 600; color: #1e293b;">
                                        @if($jamKeLabel)
                                            <span style="color: #0d5c3a; font-weight: 700;">{{ $jamKeLabel }}:</span>
                                        @endif
                                        {{ $mulaiStr }} - {{ $selesaiStr }}
                                    </div>
                                    <div>
                                        @if($jmlJp > 0)
                                            <span style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; padding: 1px 7px; border-radius: 4px; font-size: 11px; font-weight: 700;">
                                                {{ $jmlJp }} JP @if($durasiMenit > 0) ({{ $durasiMenit }} Menit) @endif
                                            </span>
                                        @else
                                            <span style="background: #fef3c7; color: #b45309; border: 1px solid #fde68a; padding: 1px 7px; border-radius: 4px; font-size: 11px; font-weight: 700;">
                                                Non-JP @if($durasiMenit > 0) ({{ $durasiMenit }} Menit) @endif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td><strong>{{ $j->kelas->nama_kelas ?? '-' }}</strong></td>
                            <td>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</td>
                            <td>{{ $j->guru->nama ?? '-' }}</td>
                            <td style="text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <button type="button" onclick="bukaModalEditJadwal({{ json_encode($j) }})" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit Jadwal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button onclick="deleteJadwal({{ $j->id }})" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Jadwal">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                            Belum ada jadwal pelajaran yang diatur.
                        </td>
                    </tr>
                @endif
            </x-siakad.ui.table>
        </div>
    </div>

    <!-- Modal Tambah Jadwal -->
    <x-siakad.ui.modal id="addModal" title="Tambah Jadwal Pelajaran" icon="fa-calendar-plus" iconColor="#166534" iconBg="#dcfce7">
        <form action="/sk/simpan-jadwal" method="POST">
            @csrf

            <!-- 1. Pilih Kelas Terlebih Dahulu Agar Jenjang (SD/SMP) Otomatis Menyaring Jam & Mapel -->
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">1. Pilih Kelas (Jenjang & Tingkatan)</label>
                <select name="kelas_id" id="modalKelasSelect" required onchange="onModalKelasChange()" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="" data-jenjang="">-- Pilih Kelas --</option>
                    @foreach($data_kelas as $kelas)
                        @php
                            $prefixKelas = strtoupper(explode(' ', trim($kelas->nama_kelas))[0] ?? '');
                        @endphp
                        <option value="{{ $kelas->id }}" data-jenjang="{{ $prefixKelas }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
                <div id="jenjangDetectBadge" style="display: none; margin-top: 6px; padding: 7px 11px; border-radius: 7px; background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; font-size: 12px; font-weight: 500;">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-3.5">
                <!-- 2. Hari -->
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">2. Hari</label>
                    <select name="hari" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">-- Pilih Hari --</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                </div>
                
                <!-- 3. Jam Pelajaran (Otomatis Tersaring Sesuai Jenjang SD=35m / SMP=45m) -->
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">3. Jam Pelajaran (JP)</label>
                    <select name="jam_pelajaran_id" id="modalJamSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">-- Pilih Jam --</option>
                        @foreach($data_jam as $jam)
                            @php
                                $kodeJam = $jam->kode_jenjang;
                                $mulai = substr($jam->jam_mulai, 0, 5);
                                $selesai = substr($jam->jam_selesai, 0, 5);
                                $jmlJp = $jam->hitung_jp;
                                $durasi = $jam->durasi_menit;
                                $sesiLabel = $jam->jam_ke ? ($jam->jam_ke . ' • ') : '';
                            @endphp
                            <option value="{{ $jam->id }}" data-jenjang="{{ $kodeJam }}" data-durasi="{{ $durasi }}">
                                [{{ $kodeJam }}] {{ $sesiLabel }}{{ $mulai }} - {{ $selesai }} ({{ $jmlJp > 0 ? $jmlJp . ' JP / ' . $durasi . 'm' : 'Non-JP / ' . $durasi . 'm' }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- 4. Mata Pelajaran (Otomatis Tersaring Sesuai Jenjang) -->
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">4. Mata Pelajaran</label>
                <select name="mapel_id" id="modalMapelSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($data_mapel as $mapel)
                        @php
                            $kodeMapel = $mapel->sekolah ? strtoupper(trim($mapel->sekolah->jenis)) : 'UMUM';
                        @endphp
                        <option value="{{ $mapel->id }}" data-jenjang="{{ $kodeMapel }}">
                            [{{ $kodeMapel }}] {{ $mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 5. Guru Pengajar -->
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">5. Guru Pengajar</label>
                <select name="guru_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($data_guru as $guru)
                        @php
                            $tags = [];
                            if ($guru->guru_tetap) $tags[] = 'Guru Tetap';
                            elseif ($guru->guru_honor) $tags[] = 'Guru Honor';
                            if (\App\Models\wallas::where('guru_id', $guru->id)->exists()) $tags[] = 'Wali Kelas';
                            $tagLabel = count($tags) > 0 ? ' (' . implode(', ', $tags) . ')' : '';
                        @endphp
                        <option value="{{ $guru->id }}">{{ $guru->nama }}{{ $tagLabel }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 6. Tahun Ajaran -->
            <div style="margin-bottom: 22px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">6. Tahun Ajaran</label>
                <select name="tahun_ajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Tahun Ajaran --</option>
                    @foreach($data_tahun as $tahun)
                        <option value="{{ $tahun->id }}" {{ $tahun->aktif ? 'selected' : '' }}>{{ $tahun->nama }}{{ $tahun->aktif ? ' (Aktif)' : '' }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Jadwal</button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Edit Jadwal -->
    <x-siakad.ui.modal id="editModal" title="Edit Jadwal Pelajaran" icon="fa-pen-to-square" iconColor="#3875c5" iconBg="#e9f2ff">
        <form id="formEditJadwal" action="" method="POST">
            @csrf

            <!-- 1. Kelas -->
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">1. Kelas (Jenjang & Tingkatan)</label>
                <select name="kelas_id" id="modalEditKelasSelect" required onchange="onModalEditKelasChange()" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="" data-jenjang="">-- Pilih Kelas --</option>
                    @foreach($data_kelas as $kelas)
                        @php
                            $namaKls = $kelas->nama_kelas ?? ($kelas->nama_ruang ?? '-');
                            $prefixKelas = strtoupper(explode(' ', trim($namaKls))[0] ?? '');
                        @endphp
                        <option value="{{ $kelas->id }}" data-jenjang="{{ $prefixKelas }}">{{ $namaKls }}</option>
                    @endforeach
                </select>
                <div id="jenjangDetectBadgeEdit" style="display: none; margin-top: 6px; padding: 7px 11px; border-radius: 7px; background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; font-size: 12px; font-weight: 500;">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-3.5">
                <!-- 2. Hari -->
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">2. Hari</label>
                    <select name="hari" id="modalEditHariSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">-- Pilih Hari --</option>
                        <option value="senin">Senin</option>
                        <option value="selasa">Selasa</option>
                        <option value="rabu">Rabu</option>
                        <option value="kamis">Kamis</option>
                        <option value="jumat">Jumat</option>
                        <option value="sabtu">Sabtu</option>
                    </select>
                </div>
                
                <!-- 3. Jam Pelajaran (JP) -->
                <div>
                    <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">3. Jam Pelajaran (JP)</label>
                    <select name="jam_pelajaran_id" id="modalEditJamSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">-- Pilih Jam Pelajaran --</option>
                        @foreach($data_jam as $jam)
                            @php
                                $kodeJam = $jam->kode_jenjang;
                                $mulai = substr($jam->jam_mulai, 0, 5);
                                $selesai = substr($jam->jam_selesai, 0, 5);
                                $jmlJp = $jam->hitung_jp;
                                $durasi = $jam->durasi_menit;
                                $sesiLabel = $jam->jam_ke ?: ('Jam ke-' . $loop->iteration);
                            @endphp
                            <option value="{{ $jam->id }}" data-jenjang="{{ $kodeJam }}">
                                [{{ $kodeJam }}] {{ $sesiLabel }} ({{ $mulai }} - {{ $selesai }} • {{ $jmlJp > 0 ? $jmlJp . ' JP / ' . $durasi . 'm' : 'Non-JP / ' . $durasi . 'm' }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- 4. Mata Pelajaran -->
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">4. Mata Pelajaran</label>
                <select name="mapel_id" id="modalEditMapelSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($data_mapel as $mapel)
                        @php
                            $kodeMapel = $mapel->sekolah ? strtoupper(trim($mapel->sekolah->jenis)) : 'UMUM';
                        @endphp
                        <option value="{{ $mapel->id }}" data-jenjang="{{ $kodeMapel }}">
                            [{{ $kodeMapel }}] {{ $mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 5. Guru Pengajar -->
            <div style="margin-bottom: 14px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">5. Guru Pengajar</label>
                <select name="guru_id" id="modalEditGuruSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($data_guru as $guru)
                        @php
                            $tags = [];
                            if ($guru->guru_tetap) $tags[] = 'Guru Tetap';
                            elseif ($guru->guru_honor) $tags[] = 'Guru Honor';
                            if (\App\Models\wallas::where('guru_id', $guru->id)->exists()) $tags[] = 'Wali Kelas';
                            $tagLabel = count($tags) > 0 ? ' (' . implode(', ', $tags) . ')' : '';
                        @endphp
                        <option value="{{ $guru->id }}">{{ $guru->nama }}{{ $tagLabel }}</option>
                    @endforeach
                </select>
            </div>

            <!-- 6. Tahun Ajaran -->
            <div style="margin-bottom: 22px;">
                <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 13.5px;">6. Tahun Ajaran</label>
                <select name="tahun_ajaran_id" id="modalEditTahunSelect" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Tahun Ajaran --</option>
                    @foreach($data_tahun as $tahun)
                        <option value="{{ $tahun->id }}">{{ $tahun->nama }}{{ $tahun->aktif ? ' (Aktif)' : '' }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Delete -->
    <x-siakad.ui.modal id="deleteModal" title="Konfirmasi Hapus" icon="fa-triangle-exclamation" iconColor="#b34d4d" iconBg="#f8e9e9">
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus jadwal ini? Jadwal yang dihapus tidak dapat dipulihkan.</p>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('deleteModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="button" id="btnConfirmDelete" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Ya, Hapus</button>
        </div>
    </x-siakad.ui.modal>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }
        
        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }

        let deleteIdTarget = null;
        function deleteJadwal(id) {
            deleteIdTarget = id;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) {
                window.location.href = "/sk/hapus-jadwal/" + deleteIdTarget;
            }
        });

        // Auto-Filter Jam Pelajaran & Mata Pelajaran saat Kelas dipilih
        function onModalKelasChange() {
            const kelasSel = document.getElementById('modalKelasSelect');
            const opt = kelasSel.options[kelasSel.selectedIndex];
            const jenjang = opt ? (opt.getAttribute('data-jenjang') || '') : '';
            const badge = document.getElementById('jenjangDetectBadge');

            const jamSel = document.getElementById('modalJamSelect');
            const mapelSel = document.getElementById('modalMapelSelect');

            if (jenjang) {
                if (jenjang === 'TK' || jenjang === 'PAUD') {
                    badge.style.display = 'block';
                    badge.innerHTML = `<i class="fa-solid fa-wand-magic-sparkles"></i> Jenjang <strong>${jenjang}</strong> terdeteksi (<strong>Non-JP / Sesi Bebas</strong>). Pilihan Jam & Mata Pelajaran telah disesuaikan.`;
                } else {
                    const standarMenit = (jenjang === 'SD') ? 35 : 45;
                    badge.style.display = 'block';
                    badge.innerHTML = `<i class="fa-solid fa-wand-magic-sparkles"></i> Jenjang <strong>${jenjang}</strong> terdeteksi (Standar: <strong>1 JP = ${standarMenit} Menit</strong>). Pilihan Jam & Mata Pelajaran telah disesuaikan.`;
                }
            } else {
                badge.style.display = 'none';
            }

            // Filter Jam Pelajaran: tampilkan jam milik jenjang terkait atau UMUM
            let adaJamJenjangSpesifik = false;
            Array.from(jamSel.options).forEach(o => {
                if (!o.value) return;
                if (o.getAttribute('data-jenjang') === jenjang) adaJamJenjangSpesifik = true;
            });

            Array.from(jamSel.options).forEach(o => {
                if (!o.value) return;
                const jKode = o.getAttribute('data-jenjang');
                if (!jenjang) {
                    o.hidden = false;
                } else if (adaJamJenjangSpesifik) {
                    o.hidden = (jKode !== jenjang && jKode !== 'UMUM');
                } else {
                    o.hidden = false;
                }
            });
            if (jamSel.selectedIndex > 0 && jamSel.options[jamSel.selectedIndex].hidden) {
                jamSel.value = '';
            }

            // Filter Mata Pelajaran: tampilkan mapel milik jenjang terkait
            Array.from(mapelSel.options).forEach(o => {
                if (!o.value) return;
                const mKode = o.getAttribute('data-jenjang');
                o.hidden = (jenjang && mKode !== jenjang && mKode !== 'UMUM');
            });
            if (mapelSel.selectedIndex > 0 && mapelSel.options[mapelSel.selectedIndex].hidden) {
                mapelSel.value = '';
            }
        }

        // Modal Edit Jadwal Handler
        function bukaModalEditJadwal(j) {
            document.getElementById('formEditJadwal').action = '/sk/update-jadwal/' + j.id;
            
            const kelasSel = document.getElementById('modalEditKelasSelect');
            kelasSel.value = j.kelas_id;
            
            onModalEditKelasChange(j.jam_pelajaran_id, j.mapel_id);

            document.getElementById('modalEditHariSelect').value = j.hari;
            document.getElementById('modalEditGuruSelect').value = j.guru_id;
            document.getElementById('modalEditTahunSelect').value = j.tahun_ajaran_id;

            openModal('editModal');
        }

        function onModalEditKelasChange(preserveJamId = null, preserveMapelId = null) {
            const kelasSel = document.getElementById('modalEditKelasSelect');
            const opt = kelasSel.options[kelasSel.selectedIndex];
            const jenjang = opt ? (opt.getAttribute('data-jenjang') || '') : '';
            const badge = document.getElementById('jenjangDetectBadgeEdit');

            const jamSel = document.getElementById('modalEditJamSelect');
            const mapelSel = document.getElementById('modalEditMapelSelect');

            if (jenjang) {
                if (jenjang === 'TK' || jenjang === 'PAUD') {
                    badge.style.display = 'block';
                    badge.innerHTML = `<i class="fa-solid fa-wand-magic-sparkles"></i> Jenjang <strong>${jenjang}</strong> terdeteksi (<strong>Non-JP / Sesi Bebas</strong>). Pilihan Jam & Mata Pelajaran telah disesuaikan.`;
                } else {
                    const standarMenit = (jenjang === 'SD') ? 35 : 45;
                    badge.style.display = 'block';
                    badge.innerHTML = `<i class="fa-solid fa-wand-magic-sparkles"></i> Jenjang <strong>${jenjang}</strong> terdeteksi (Standar: <strong>1 JP = ${standarMenit} Menit</strong>). Pilihan Jam & Mata Pelajaran telah disesuaikan.`;
                }
            } else {
                badge.style.display = 'none';
            }

            let adaJamJenjangSpesifik = false;
            Array.from(jamSel.options).forEach(o => {
                if (!o.value) return;
                if (o.getAttribute('data-jenjang') === jenjang) adaJamJenjangSpesifik = true;
            });

            Array.from(jamSel.options).forEach(o => {
                if (!o.value) return;
                const jKode = o.getAttribute('data-jenjang');
                if (!jenjang) {
                    o.hidden = false;
                } else if (adaJamJenjangSpesifik) {
                    o.hidden = (jKode !== jenjang && jKode !== 'UMUM');
                } else {
                    o.hidden = false;
                }
            });

            if (preserveJamId) {
                jamSel.value = preserveJamId;
            } else if (jamSel.selectedIndex > 0 && jamSel.options[jamSel.selectedIndex].hidden) {
                jamSel.value = '';
            }

            Array.from(mapelSel.options).forEach(o => {
                if (!o.value) return;
                const mKode = o.getAttribute('data-jenjang');
                o.hidden = (jenjang && mKode !== jenjang && mKode !== 'UMUM');
            });

            if (preserveMapelId) {
                mapelSel.value = preserveMapelId;
            } else if (mapelSel.selectedIndex > 0 && mapelSel.options[mapelSel.selectedIndex].hidden) {
                mapelSel.value = '';
            }
        }
    </script>
</x-siakad-layout>

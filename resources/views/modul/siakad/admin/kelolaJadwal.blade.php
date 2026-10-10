<x-siakad-layout 
    title="Kelola Jadwal Pelajaran" 
    description="Atur dan manajemen jadwal mata pelajaran untuk setiap kelas." 
    position="Administrator" 
    initials="AD">

    @if(session('success'))
        <x-siakad.ui.alert type="success" message="{{ session('success') }}" />
    @endif
    @if(session('error'))
        <x-siakad.ui.alert type="error" message="{{ session('error') }}" />
    @endif

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                <i class="fa-solid fa-calendar-alt"></i> Daftar Jadwal Pelajaran
            </div>
            <button onclick="openModal('addModal')" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                <i class="fa-solid fa-plus"></i> Tambah Jadwal
            </button>
        </div>

        <div style="overflow-x: auto;">
            <x-siakad.ui.table>
                <x-slot name="thead">
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Hari</th>
                        <th>Jam Pelajaran</th>
                        <th>Kelas</th>
                        <th>Mata Pelajaran</th>
                        <th>Guru Pengajar</th>
                        <th style="text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </x-slot>

                @forelse($data_jadwal as $index => $j)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                {{ ucfirst($j->hari) }}
                            </span>
                        </td>
                        <td>{{ $j->jam_pelajaran->jam_mulai ?? '-' }} - {{ $j->jam_pelajaran->jam_selesai ?? '-' }}</td>
                        <td><strong>{{ $j->kelas->nama_kelas ?? '-' }}</strong></td>
                        <td>{{ $j->mata_pelajaran->nama_mapel ?? '-' }}</td>
                        <td>{{ $j->guru->nama ?? '-' }}</td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <button onclick="deleteJadwal({{ $j->id }})" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Jadwal">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                            Belum ada jadwal pelajaran yang diatur.
                        </td>
                    </tr>
                @endforelse
            </x-siakad.ui.table>
        </div>
    </div>

    <!-- Modal Tambah Jadwal -->
    <x-siakad.ui.modal id="addModal" title="Tambah Jadwal Pelajaran" icon="fa-calendar-plus" iconColor="#166534" iconBg="#dcfce7">
        <form action="/sk/simpan-jadwal" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <!-- Hari -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Hari</label>
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
                
                <!-- Jam Pelajaran -->
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jam Pelajaran</label>
                    <select name="jam_pelajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">-- Pilih Jam --</option>
                        @foreach($data_jam as $jam)
                            <option value="{{ $jam->id }}">{{ $jam->jam_mulai }} - {{ $jam->jam_selesai }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Kelas</label>
                <select name="kelas_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($data_kelas as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Mata Pelajaran</label>
                <select name="mapel_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Mata Pelajaran --</option>
                    @foreach($data_mapel as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Guru Pengajar</label>
                <select name="guru_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($data_guru as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Tahun Ajaran</label>
                <select name="tahun_ajaran_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Tahun Ajaran --</option>
                    @foreach($data_tahun as $tahun)
                        <option value="{{ $tahun->id }}">{{ $tahun->nama_tahun }} ({{ ucfirst($tahun->semester) }})</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Jadwal</button>
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
    </script>
</x-siakad-layout>




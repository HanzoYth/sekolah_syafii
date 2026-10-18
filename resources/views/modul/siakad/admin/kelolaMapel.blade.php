<x-siakad-layout 
    title="Kelola Mata Pelajaran" 
    description="Manajemen data mata pelajaran kurikulum" 
    position="Administrator" 
    initials="AD">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; flex-wrap: wrap; gap: 14px;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                <span><i class="fa-solid fa-book"></i> Daftar Mata Pelajaran</span>
                <form action="" method="GET" style="display: flex; align-items: center;">
                    <div style="position: relative; display: flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 4px 12px; gap: 8px;">
                        <i class="fa-solid fa-filter" style="color: #64748b; font-size: 14px;"></i>
                        <select name="sekolah_id" onchange="this.form.submit()" style="background: transparent; border: none; outline: none; font-size: 14px; color: #334155; font-weight: 600; cursor: pointer; padding-right: 8px;">
                            <option value="">Semua Jenjang</option>
                            @foreach($data_sekolah as $s)
                                <option value="{{ $s->id }}" {{ ($sekolah_id ?? '') == $s->id ? 'selected' : '' }}>{{ strtoupper($s->jenis) }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="/sk/bobot-penilaian" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; padding: 10px 16px; border-radius: 8px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 8px; transition: all 0.2s; font-size: 14px;">
                    <i class="fa-solid fa-sliders"></i> Atur Bobot & KKM
                </a>
                <button onclick="openModal('addModal')" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s; font-size: 14px;">
                    <i class="fa-solid fa-plus"></i> Tambah Mapel
                </button>
            </div>
        </div>

        <x-siakad.ui.table>
            <x-slot name="thead">
                <tr>
                    <th style="width: 60px; text-align: center;">No.</th>
                    <th>Nama Mata Pelajaran</th>
                    <th style="width: 120px; text-align: center;">Standar KKM</th>
                    <th style="width: 150px; text-align: center;">Aksi</th>
                </tr>
            </x-slot>

            @if(count($data_mapel) > 0)
                @foreach($data_mapel as $index => $m)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; border-radius: 8px; background: #f1f5f3; color: #64748b; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-book-open"></i>
                                </div>
                                <div>
                                    <strong style="display: block; color: #1e293b;">{{ $m->nama_mapel }}</strong>
                                    <span style="font-size: 12px; color: #64748b;">ID: MAPEL-{{ str_pad($m->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 13px; background: #fef3c7; color: #92400e; border: 1px solid #fde68a;">
                                {{ $m->kkm ?? 75 }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <button onclick="editMapel({{ $m->id }}, '{{ addslashes($m->nama_mapel) }}', '{{ $m->sekolah_id }}', '{{ $m->kkm ?? 75 }}')" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button onclick="deleteMapel({{ $m->id }}, '{{ addslashes($m->nama_mapel) }}')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                        Belum ada data mata pelajaran yang terdaftar.
                    </td>
                </tr>
            @endif
        </x-siakad.ui.table>
    </div>

    <!-- Modal Tambah -->
    <x-siakad.ui.modal id="addModal" title="Tambah Mata Pelajaran" icon="fa-book-medical" iconColor="#166534" iconBg="#dcfce7">
        <form action="/sk/simpan-mapel" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                <select name="sekolah_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Jenjang --</option>
                    @foreach($data_sekolah as $s)
                        <option value="{{ $s->id }}">{{ strtoupper($s->jenis) }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" required placeholder="Contoh: Pendidikan Agama Islam" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                <input type="number" name="kkm" value="75" min="0" max="100" required placeholder="Standar: 75" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                <small style="color: #64748b; font-size: 12px; margin-top: 4px; display: block;">Skala nilai 0 - 100 (Default: 75)</small>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Data</button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Edit -->
    <x-siakad.ui.modal id="editModal" title="Edit Mata Pelajaran" icon="fa-pen-to-square" iconColor="#3875c5" iconBg="#e9f2ff">
        <form id="editForm" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                <select name="sekolah_id" id="editSekolah" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Jenjang --</option>
                    @foreach($data_sekolah as $s)
                        <option value="{{ $s->id }}">{{ strtoupper($s->jenis) }}</option>
                    @endforeach
                </select>
            </div>
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="editInput" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nilai KKM (Kriteria Ketuntasan Minimal)</label>
                <input type="number" name="kkm" id="editKkm" min="0" max="100" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #3875c5; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Perubahan</button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Delete -->
    <x-siakad.ui.modal id="deleteModal" title="Konfirmasi Hapus" icon="fa-triangle-exclamation" iconColor="#b34d4d" iconBg="#f8e9e9">
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus <strong id="deleteMapelName" style="color: #1e293b;"></strong>? Data yang dihapus tidak dapat dipulihkan.</p>
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

        function editMapel(id, nama, sekolah_id, kkm) {
            document.getElementById('editForm').action = "/sk/update-mapel/" + id;
            document.getElementById('editInput').value = nama;
            document.getElementById('editKkm').value = kkm || 75;
            if (sekolah_id) {
                document.getElementById('editSekolah').value = sekolah_id;
            } else {
                document.getElementById('editSekolah').value = "";
            }
            openModal('editModal');
        }

        let deleteIdTarget = null;
        function deleteMapel(id, nama) {
            deleteIdTarget = id;
            document.getElementById('deleteMapelName').textContent = nama;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) {
                window.location.href = "/sk/hapus-mapel/" + deleteIdTarget;
            }
        });
    </script>
</x-siakad-layout>




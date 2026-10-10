<x-siakad-layout 
    title="Kelola Mata Pelajaran" 
    description="Manajemen data mata pelajaran kurikulum" 
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
                <i class="fa-solid fa-book"></i> Daftar Mata Pelajaran
            </div>
            <button onclick="openModal('addModal')" style="background: #177455; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                <i class="fa-solid fa-plus"></i> Tambah Mapel
            </button>
        </div>

        <x-siakad.ui.table>
            <x-slot name="thead">
                <tr>
                    <th style="width: 60px; text-align: center;">No.</th>
                    <th>Nama Mata Pelajaran</th>
                    <th style="width: 150px; text-align: center;">Aksi</th>
                </tr>
            </x-slot>

            @forelse($data_mapel as $index => $m)
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
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button onclick="editMapel({{ $m->id }}, '{{ addslashes($m->nama_mapel) }}')" style="background: #e9f2ff; color: #3875c5; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button onclick="deleteMapel({{ $m->id }}, '{{ addslashes($m->nama_mapel) }}')" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                        Belum ada data mata pelajaran yang terdaftar.
                    </td>
                </tr>
            @endforelse
        </x-siakad.ui.table>
    </div>

    <!-- Modal Tambah -->
    <x-siakad.ui.modal id="addModal" title="Tambah Mata Pelajaran" icon="fa-book-medical" iconColor="#166534" iconBg="#dcfce7">
        <form action="/sk/simpan-mapel" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" required placeholder="Contoh: Pendidikan Agama Islam" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
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
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama Mata Pelajaran</label>
                <input type="text" name="nama_mapel" id="editInput" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
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

        function editMapel(id, nama) {
            document.getElementById('editForm').action = "/sk/update-mapel/" + id;
            document.getElementById('editInput').value = nama;
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




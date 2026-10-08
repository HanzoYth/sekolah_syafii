<x-siakad-layout 
    title="Kelola Wali Kelas" 
    description="Penugasan guru sebagai wali kelas untuk mendampingi ruang kelas tertentu." 
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
            <div style="font-size: 18px; font-weight: bold; color: #166534;">
                <i class="fa-solid fa-users-rectangle"></i> Daftar Wali Kelas
            </div>
            <button onclick="openModal('addModal')" style="background: #166534; color: white; border: none; padding: 10px 16px; border-radius: 8px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 8px; transition: background 0.2s;">
                <i class="fa-solid fa-plus"></i> Tugaskan Wali Kelas
            </button>
        </div>

        <x-siakad.ui.table>
            <x-slot name="thead">
                <tr>
                    <th style="width: 60px; text-align: center;">No.</th>
                    <th>Nama Guru</th>
                    <th>Kelas yang Diampu</th>
                    <th style="width: 150px; text-align: center;">Aksi</th>
                </tr>
            </x-slot>

            @forelse($data_wallas as $index => $w)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 8px; background: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center;">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <div>
                                <strong style="display: block; color: #1e293b;">{{ $w->guru->nama ?? '-' }}</strong>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background: #e0f2fe; color: #0284c7; padding: 6px 12px; border-radius: 6px; font-weight: bold; font-size: 13px;">
                            {{ $w->ruangKelas->nama_ruang ?? '-' }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button onclick="editWallas({{ $w->id }}, {{ $w->guru_id }}, {{ $w->kelas_id }})" style="background: #e0f2fe; color: #0284c7; border: none; width: 32px; height: 32px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Edit Data">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button onclick="deleteWallas({{ $w->id }})" style="background: #fee2e2; color: #dc2626; border: none; width: 32px; height: 32px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Data">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 40px; color: #64748b;">
                        <i class="fa-solid fa-users-slash" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                        Belum ada data wali kelas yang ditugaskan.
                    </td>
                </tr>
            @endforelse
        </x-siakad.ui.table>
    </div>

    <!-- Modal Tambah -->
    <x-siakad.ui.modal id="addModal" title="Penugasan Wali Kelas" icon="fa-user-plus" iconColor="#166534" iconBg="#dcfce7">
        <form action="/sk/simpan-wali-kelas" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Guru</label>
                <select name="guru_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($data_guru as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Ruang Kelas</label>
                <select name="kelas_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Ruang Kelas --</option>
                    @foreach($data_kelas as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_ruang }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('addModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #166534; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Data</button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Edit -->
    <x-siakad.ui.modal id="editModal" title="Edit Wali Kelas" icon="fa-pen-to-square" iconColor="#0284c7" iconBg="#e0f2fe">
        <form id="editForm" method="POST">
            @csrf
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Guru</label>
                <select name="guru_id" id="editGuruId" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Guru --</option>
                    @foreach($data_guru as $guru)
                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Ruang Kelas</label>
                <select name="kelas_id" id="editKelasId" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Ruang Kelas --</option>
                    @foreach($data_kelas as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_ruang }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('editModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
                <button type="submit" style="padding: 10px 16px; border: none; background: #0284c7; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Simpan Perubahan</button>
            </div>
        </form>
    </x-siakad.ui.modal>

    <!-- Modal Delete -->
    <x-siakad.ui.modal id="deleteModal" title="Konfirmasi Hapus" icon="fa-triangle-exclamation" iconColor="#dc2626" iconBg="#fee2e2">
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus penugasan wali kelas ini?</p>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('deleteModal')" style="padding: 10px 16px; border: none; background: #f1f5f9; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="button" id="btnConfirmDelete" style="padding: 10px 16px; border: none; background: #dc2626; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Ya, Hapus</button>
        </div>
    </x-siakad.ui.modal>

    <script>
        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }

        function editWallas(id, guru_id, kelas_id) {
            document.getElementById('editForm').action = "/sk/update-wali-kelas/" + id;
            document.getElementById('editGuruId').value = guru_id;
            document.getElementById('editKelasId').value = kelas_id;
            openModal('editModal');
        }

        let deleteIdTarget = null;
        function deleteWallas(id) {
            deleteIdTarget = id;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) {
                window.location.href = "/sk/hapus-wali-kelas/" + deleteIdTarget;
            }
        });
    </script>
</x-siakad-layout>
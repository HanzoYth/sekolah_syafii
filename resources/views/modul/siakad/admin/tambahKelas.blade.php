<x-siakad-layout 
    title="Kelola Kelas" 
    description="Buat dan manajemen ruang kelas untuk tahun ajaran berjalan." 
    position="Administrator" 
    initials="AD">

    @if(session('success'))
        <x-siakad.ui.alert type="success" message="{{ session('success') }}" />
    @endif
    @if(session('error'))
        <x-siakad.ui.alert type="error" message="{{ session('error') }}" />
    @endif

    <div style="display: grid; grid-template-columns: 350px 1fr; gap: 24px;">
        
        <!-- Form Tambah Kelas -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); align-self: start;">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
                <i class="fa-solid fa-school"></i> Buat Kelas Baru
            </div>

            <form action="/sk/simpan-kelas" method="POST">
                @csrf
                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Jenjang Sekolah</label>
                    <select name="tingkat_sekolah" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">Pilih Jenjang</option>
                        <option value="TK">Taman Kanak-kanak (TK)</option>
                        <option value="SD">Sekolah Dasar (SD)</option>
                        <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Tingkat Kelas (Angka)</label>
                    <select name="no_kelas" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                        <option value="">Pilih Tingkat</option>
                        <option value="A">TK A</option>
                        <option value="B">TK B</option>
                        @for($i=1; $i<=9; $i++)
                            <option value="{{ $i }}">Kelas {{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div style="margin-bottom: 25px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Nama / Tipe Pararel</label>
                    <input type="text" name="tipe_kelas" required placeholder="Contoh: UNGGULAN, REGULER, IPA 1" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;" autocomplete="off">
                </div>

                <button type="submit" style="width: 100%; padding: 12px; border: none; background: #177455; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Kelas
                </button>
            </form>
        </div>

        <!-- Tabel Daftar Kelas -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 18px; font-weight: bold; color: #1e293b; margin-bottom: 20px; border-bottom: 2px solid #ecfdf5; padding-bottom: 15px;">
                <i class="fa-solid fa-list"></i> Daftar Ruang Kelas
            </div>

            <x-siakad.ui.table>
                <x-slot name="thead">
                    <tr>
                        <th style="width: 50px; text-align: center;">No</th>
                        <th>Nama Kelas</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </x-slot>

                @forelse($data_kelas as $index => $k)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 6px; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center;">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </div>
                                <strong>{{ $k->nama_kelas }}</strong>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <button onclick="deleteKelas({{ $k->id }})" style="background: #f8e9e9; color: #b34d4d; border: none; width: 32px; height: 32px; border-radius: 8px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.2s;" title="Hapus Kelas">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align: center; padding: 40px; color: #64748b;">
                            <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 12px; display: block; color: #cbd5e1;"></i>
                            Belum ada ruang kelas yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </x-siakad.ui.table>
        </div>
    </div>

    <!-- Modal Delete -->
    <x-siakad.ui.modal id="deleteModal" title="Konfirmasi Hapus" icon="fa-triangle-exclamation" iconColor="#b34d4d" iconBg="#f8e9e9">
        <p style="margin-bottom: 20px; color: #475569; line-height: 1.5;">Anda yakin ingin menghapus kelas ini? Menghapus kelas akan menghapus keterkaitan data lainnya seperti jadwal dan siswa.</p>
        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <button type="button" onclick="closeModal('deleteModal')" style="padding: 10px 16px; border: none; background: #f1f5f3; color: #64748b; border-radius: 8px; cursor: pointer; font-weight: 600;">Batal</button>
            <button type="button" id="btnConfirmDelete" style="padding: 10px 16px; border: none; background: #b34d4d; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;">Ya, Hapus</button>
        </div>
    </x-siakad.ui.modal>

    <script>
        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
        
        let deleteIdTarget = null;
        function deleteKelas(id) {
            deleteIdTarget = id;
            openModal('deleteModal');
        }

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            if (deleteIdTarget) window.location.href = "/sk/hapus-kelas/" + deleteIdTarget;
        });
    </script>
</x-siakad-layout>




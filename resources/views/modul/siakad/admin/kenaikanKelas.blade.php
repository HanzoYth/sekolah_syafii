<x-siakad-layout title="Kenaikan Kelas & Kelulusan" pageTitle="Kenaikan Kelas & Kelulusan" pageDescription="Pindahkan siswa ke kelas tingkat selanjutnya atau tetapkan kelulusan secara massal.">
    
    <div class="page-header" style="display: flex; gap: 15px; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 20px; margin-bottom: 20px;">
        <i class="fa-solid fa-graduation-cap" style="font-size: 24px; color: #0d5c3a;"></i>
        <form method="GET" action="/sk/kenaikan-kelas" style="display: flex; gap: 10px; width: 100%; align-items: center;">
            <strong style="white-space: nowrap;">Pilih Kelas Asal:</strong>
            <select name="kelas_id" class="input-ket" style="width: 250px; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;" onchange="this.form.submit()">
                <option value="">-- Pilih Rombongan Belajar --</option>
                @foreach($data_kelas as $k)
                    <option value="{{ $k->id }}" {{ $kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_ruang }}</option>
                @endforeach
            </select>
        </form>
    </div>

    @if($kelas_id)
        @if($siswa->count() > 0)
            <form method="POST" action="/sk/proses-kenaikan-kelas">
                @csrf
                <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 20px; display: flex; gap: 20px; align-items: flex-end;">
                    <div style="flex: 1;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px;">Aksi Eksekusi</label>
                        <select name="aksi" id="aksi-select" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" onchange="toggleKelasTujuan()">
                            <option value="naik">Naik / Pindah Kelas</option>
                            <option value="lulus">Lulus (Alumni)</option>
                        </select>
                    </div>
                    
                    <div style="flex: 1;" id="kelas-tujuan-wrapper">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px;">Pilih Kelas Tujuan</label>
                        <select name="kelas_tujuan" id="kelas-tujuan" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($data_kelas as $k)
                                @if($k->id != $kelas_id)
                                    <option value="{{ $k->id }}">{{ $k->nama_ruang }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <x-siakad.ui.button type="primary" icon="fa-solid fa-paper-plane" type="submit">Proses Terpilih</x-siakad.ui.button>
                    </div>
                </div>

                <x-siakad.ui.table :headers="['Pilih', 'NIS', 'Nama Siswa', 'Gender', 'Status']">
                    <tr>
                        <td colspan="5" style="background: #f1f5f9; padding: 10px 16px;">
                            <label style="cursor: pointer; font-weight: bold; display: flex; align-items: center; gap: 10px;">
                                <input type="checkbox" id="check-all" onclick="toggleCheckAll()" style="width: 18px; height: 18px;">
                                Pilih Semua Siswa di Bawah
                            </label>
                        </td>
                    </tr>
                    @foreach($siswa as $s)
                    <tr>
                        <td style="width: 50px; text-align: center;">
                            <input type="checkbox" name="siswa_id[]" value="{{ $s->id }}" class="check-siswa" style="width: 18px; height: 18px;">
                        </td>
                        <td>{{ $s->nis }}</td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td>{{ $s->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td><span style="background:#dcfce7; color:#15803d; padding:4px 8px; border-radius:4px; font-size:12px;">Aktif</span></td>
                    </tr>
                    @endforeach
                </x-siakad.ui.table>
            </form>
            
            <script>
                function toggleCheckAll() {
                    const checkAll = document.getElementById('check-all');
                    const checkboxes = document.querySelectorAll('.check-siswa');
                    checkboxes.forEach(cb => cb.checked = checkAll.checked);
                }
                
                function toggleKelasTujuan() {
                    const aksi = document.getElementById('aksi-select').value;
                    const wrapper = document.getElementById('kelas-tujuan-wrapper');
                    const select = document.getElementById('kelas-tujuan');
                    
                    if (aksi === 'lulus') {
                        wrapper.style.display = 'none';
                        select.removeAttribute('required');
                    } else {
                        wrapper.style.display = 'block';
                        select.setAttribute('required', 'required');
                    }
                }
                // Run on load
                toggleKelasTujuan();
            </script>
        @else
            <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
                <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                Tidak ada siswa aktif yang ditemukan di kelas ini.
            </div>
        @endif
    @else
        <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px;">
            <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
            Silakan pilih kelas asal terlebih dahulu dari menu *dropdown* di atas.
        </div>
    @endif
</x-siakad-layout>





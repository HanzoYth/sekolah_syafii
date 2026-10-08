<x-siakad-layout 
    title="Pembagian Kelas Siswa" 
    description="Atur penempatan siswa ke dalam ruang kelas masing-masing." 
    position="Administrator" 
    initials="AD">

    @if(session('success'))
        <x-siakad.ui.alert type="success" message="{{ session('success') }}" />
    @endif
    @if(session('error'))
        <x-siakad.ui.alert type="error" message="{{ session('error') }}" />
    @endif

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); margin-bottom: 24px;">
        <form method="GET" action="/sk/pembagian-kelas" style="display: flex; gap: 15px; align-items: flex-end;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #475569;">Pilih Ruang Kelas</label>
                <select name="kelas_id" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-family: inherit; font-size: 14px;">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($data_kelas as $k)
                        <option value="{{ $k->id }}" {{ $kelas_id == $k->id ? 'selected' : '' }}>{{ $k->nama_ruang }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="padding: 10px 20px; border: none; background: #0284c7; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-filter"></i> Tampilkan
            </button>
        </form>
    </div>

    @if($kelas_id)
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
        
        <!-- KOLOM KIRI: SISWA BELUM ADA KELAS -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 16px; font-weight: bold; color: #b45309; margin-bottom: 15px; border-bottom: 2px solid #fef3c7; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-users-slash"></i> Belum Memiliki Kelas</span>
                <span style="background: #fef3c7; color: #b45309; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ count($siswa_belum_ada_kelas) }} Siswa</span>
            </div>

            <form action="/sk/simpan-pembagian-kelas" method="POST">
                @csrf
                <input type="hidden" name="kelas_id" value="{{ $kelas_id }}">
                
                <div style="max-height: 400px; overflow-y: auto; margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 8px;">
                    @forelse($siswa_belum_ada_kelas as $s)
                        <label style="display: flex; align-items: center; gap: 12px; padding: 12px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <input type="checkbox" name="siswa_ids[]" value="{{ $s->id }}" style="width: 18px; height: 18px; accent-color: #166534;">
                            <div>
                                <strong style="display: block; color: #1e293b;">{{ $s->nama }}</strong>
                                <span style="font-size: 12px; color: #64748b;">NIS: {{ $s->nis }}</span>
                            </div>
                        </label>
                    @empty
                        <div style="padding: 30px; text-align: center; color: #94a3b8;">
                            <i class="fa-solid fa-check-circle" style="font-size: 24px; margin-bottom: 10px; color: #cbd5e1; display: block;"></i>
                            Semua siswa sudah masuk kelas.
                        </div>
                    @endforelse
                </div>

                @if(count($siswa_belum_ada_kelas) > 0)
                    <button type="submit" style="width: 100%; padding: 12px; border: none; background: #166534; color: white; border-radius: 8px; cursor: pointer; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Masukkan ke Kelas Ini
                    </button>
                @endif
            </form>
        </div>

        <!-- KOLOM KANAN: SISWA DI DALAM KELAS -->
        <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
            <div style="font-size: 16px; font-weight: bold; color: #166534; margin-bottom: 15px; border-bottom: 2px solid #dcfce7; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                <span><i class="fa-solid fa-users"></i> Anggota Kelas Saat Ini</span>
                <span style="background: #dcfce7; color: #166534; padding: 2px 8px; border-radius: 12px; font-size: 12px;">{{ count($siswa_di_kelas) }} Siswa</span>
            </div>

            <div style="max-height: 400px; overflow-y: auto; margin-bottom: 15px; border: 1px solid #e2e8f0; border-radius: 8px;">
                <x-siakad.ui.table>
                    <x-slot name="thead">
                        <tr>
                            <th style="width: 40px; text-align: center;">No</th>
                            <th>Siswa</th>
                            <th style="width: 60px; text-align: center;">Aksi</th>
                        </tr>
                    </x-slot>
                    
                    @forelse($siswa_di_kelas as $index => $s)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td>
                                <strong style="display: block; color: #1e293b;">{{ $s->nama }}</strong>
                                <span style="font-size: 12px; color: #64748b;">NIS: {{ $s->nis }}</span>
                            </td>
                            <td style="text-align: center;">
                                <a href="/sk/hapus-anggota-kelas/{{ $s->id }}" style="display: inline-flex; background: #fee2e2; color: #dc2626; border: none; width: 32px; height: 32px; border-radius: 6px; text-decoration: none; align-items: center; justify-content: center; transition: all 0.2s;" title="Keluarkan dari kelas">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: 30px; color: #94a3b8;">
                                <i class="fa-solid fa-users-slash" style="font-size: 24px; margin-bottom: 10px; color: #cbd5e1; display: block;"></i>
                                Kelas ini masih kosong.
                            </td>
                        </tr>
                    @endforelse
                </x-siakad.ui.table>
            </div>
        </div>
    </div>
    @else
        <div style="background: white; border-radius: 12px; padding: 40px; text-align: center; color: #64748b; border: 2px dashed #cbd5e1;">
            <i class="fa-solid fa-arrow-pointer" style="font-size: 32px; margin-bottom: 15px; color: #94a3b8; display: block;"></i>
            Silakan pilih kelas terlebih dahulu untuk mengatur anggota kelas.
        </div>
    @endif
</x-siakad-layout>

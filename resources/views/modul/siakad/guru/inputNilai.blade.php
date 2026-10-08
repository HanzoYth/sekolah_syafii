<x-siakad-layout 
    title="Manajemen Nilai" 
    description="Kelola nilai siswa untuk mata pelajaran Anda." 
    position="Guru SIAKAD" 
    initials="GR">

    <div style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
        <div style="font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #166534; border-bottom: 2px solid #ecfdf5; padding-bottom: 10px;">
            <i class="fa-solid fa-star"></i> Kelas & Mata Pelajaran Anda
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px;">
            @forelse($mapel_guru as $mapel)
                <div style="padding: 20px; border: 1px solid #e2e8f0; border-radius: 10px; background: #f8fafc; display: flex; flex-direction: column; justify-content: space-between;">
                    <div style="margin-bottom: 15px;">
                        <h3 style="margin: 0 0 8px 0; color: #1e293b; font-size: 16px;">{{ $mapel->mata_pelajaran->nama_mapel ?? '-' }}</h3>
                        <div style="display: flex; align-items: center; gap: 8px; color: #64748b; font-size: 13px;">
                            <span style="background: #e0f2fe; color: #0369a1; padding: 4px 8px; border-radius: 4px; font-weight: 600;">
                                <i class="fa-solid fa-users"></i> {{ $mapel->kelas->nama_ruang ?? ($mapel->kelas->nama_kelas ?? '-') }}
                            </span>
                        </div>
                    </div>
                    <a href="/sk/input-nilai-detail/{{ $mapel->id }}" style="text-align: center; background: #166534; color: white; text-decoration: none; border: none; padding: 10px; border-radius: 6px; font-weight: 600; cursor: pointer; transition: all 0.2s;">
                        <i class="fa-solid fa-pen-to-square"></i> Input Nilai
                    </a>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #94a3b8; border: 2px dashed #e2e8f0; border-radius: 12px;">
                    <i class="fa-solid fa-folder-open" style="font-size: 32px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                    Belum ada jadwal mengajar / mata pelajaran yang ditugaskan.
                </div>
            @endforelse
        </div>
    </div>
</x-siakad-layout>
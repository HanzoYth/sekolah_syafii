@php
    $isPerempuan = ($data_siswa->gender ?? '') === 'p';
    $isAktif = !isset($data_siswa->aktif) || (int) $data_siswa->aktif === 1;
    $namaKelas = $data_kelas->nama_ruang ?? 'Belum ditempatkan';
    $tanggalLahir = !empty($data_siswa->tanggal_lahir)
        ? \Carbon\Carbon::parse($data_siswa->tanggal_lahir)->locale('id')->translatedFormat('d F Y')
        : 'Belum tersedia';
@endphp
<x-siakad-layout title="Detail Siswa" description="Tinjau informasi profil dan akademik siswa." position="Administrator SIAKAD" initials="AD">
    
    <!-- Header Section -->
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-user-graduate"></i> Manajemen Akademik
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                <i class="fa-solid fa-address-card"></i> Profil Siswa
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Informasi terdaftar untuk siswa pada sistem akademik.
            </div>
        </div>
        <div>
            <a href="/sk/ds" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; background: #f1f5f9; color: #475569; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke daftar
            </a>
        </div>
    </div>

    <!-- Profile Hero -->
    <div style="background: white; border-radius: 16px; padding: 30px; display: flex; align-items: center; gap: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 24px; flex-wrap: wrap;">
        
        <div style="width: 120px; height: 120px; border-radius: 20px; overflow: hidden; background: #f1f5f9; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #94a3b8;">
            @if (!empty($data_siswa->url_foto))
                <img src="{{ route('file.show', $data_siswa->url_foto) }}" alt="Foto {{ $data_siswa->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <i class="fa-solid fa-user"></i>
            @endif
        </div>
        
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 12px; font-weight: 700; color: #177455; letter-spacing: 1px; margin-bottom: 8px;">SISWA TERDAFTAR</div>
            <h2 style="margin: 0 0 8px; font-size: 24px; color: #1e293b;">{{ $data_siswa->nama }}</h2>
            <div style="color: #64748b; font-size: 15px; margin-bottom: 16px;">
                <i class="fa-solid fa-id-card"></i> NIS: {{ $data_siswa->nis }}
            </div>
            
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f1f5f9; color: #475569; border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-school"></i> {{ $namaKelas }}
                </span>
                @if($isAktif)
                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #dcfce7; color: #166534; border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-circle-check"></i> Siswa aktif
                    </span>
                @else
                    <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f3f4f6; color: #4b5563; border-radius: 8px; font-size: 13px; font-weight: 600;">
                        <i class="fa-solid fa-circle-pause"></i> Siswa nonaktif
                    </span>
                @endif
            </div>
        </div>
        
        <div style="background: #f8fafc; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center; min-width: 150px;">
            <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 8px;">Jenis kelamin</div>
            <div style="font-size: 16px; font-weight: bold; color: #1e293b;">
                @if($isPerempuan)
                    <i class="fa-solid fa-venus" style="color: #be185d; margin-right: 4px;"></i> Perempuan
                @else
                    <i class="fa-solid fa-mars" style="color: #3875c5; margin-right: 4px;"></i> Laki-laki
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Layout Grid -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
        
        <!-- Personal Info -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Informasi Pribadi</h3>
                    <p style="margin: 0; font-size: 13px; color: #64748b;">Data identitas dasar siswa.</p>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">NIS</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->nis }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Jenis kelamin</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $isPerempuan ? 'Perempuan' : 'Laki-laki' }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Tempat lahir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->tempat_lahir ?: 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Tanggal lahir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $tanggalLahir }}</div>
                </div>
                <div style="grid-column: 1 / -1;">
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Alamat</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">{{ $data_siswa->alamat ?: 'Belum tersedia' }}</div>
                </div>
            </div>
        </div>

        <!-- Academic Status -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #f3e8ff; color: #9333ea; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-school"></i>
                </div>
                <div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Status Akademik</h3>
                    <p style="margin: 0; font-size: 13px; color: #64748b;">Penempatan siswa saat ini.</p>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Kelas</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">{{ $namaKelas }}</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Status siswa</div>
                    <div>
                        @if($isAktif)
                            <span style="font-size: 14px; font-weight: bold; color: #166534;"><i class="fa-solid fa-circle" style="font-size: 10px; margin-right: 4px;"></i> Aktif</span>
                        @else
                            <span style="font-size: 14px; font-weight: bold; color: #4b5563;"><i class="fa-solid fa-circle" style="font-size: 10px; margin-right: 4px;"></i> Nonaktif</span>
                        @endif
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">ID data siswa</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">#{{ $data_siswa->id }}</div>
                </div>
            </div>
        </div>

    </div>
</x-siakad-layout>

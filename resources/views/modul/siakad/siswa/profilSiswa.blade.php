<x-siakad-layout title="Profil Siswa" description="Tinjau informasi akademik dan data pribadi Anda." position="Orang Tua / Siswa" initials="OT">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-id-card"></i> Administrasi Siswa
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                Profil Anak
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Tinjau informasi akademik dan data pribadi yang terdaftar pada sistem.
            </div>
        </div>
    </div>

    @if(session('eror'))
        <x-siakad.ui.alert type="danger" message="{{ session('eror') }}" />
    @endif

    <!-- Profile Hero -->
    <div style="background: white; border-radius: 16px; padding: 30px; display: flex; align-items: center; gap: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 24px; flex-wrap: wrap;">
        
        <div style="width: 120px; height: 120px; border-radius: 20px; overflow: hidden; background: #f1f5f9; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #94a3b8;">
            <img src="{{ route('file.show', $data_siswa->url_foto) }}" alt="Foto {{ $data_siswa->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 12px; font-weight: 700; color: #177455; letter-spacing: 1px; margin-bottom: 8px;">PROFIL AKADEMIK SISWA</div>
            <h2 style="margin: 0 0 8px; font-size: 24px; color: #1e293b;">{{ $data_siswa->nama }}</h2>
            <div style="color: #64748b; font-size: 15px; margin-bottom: 16px;">
                <i class="fa-solid fa-id-card"></i> NIS: {{ $data_siswa->nis }}
            </div>
            
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f1f5f9; color: #475569; border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-school"></i> {{ $data_kelas->nama_ruang ?? 'Belum ada kelas' }}
                </span>
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #dcfce7; color: #166534; border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> Siswa aktif
                </span>
            </div>
        </div>
    </div>

    <!-- Metrics Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 24px;">
        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-school"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Kelas Aktif</div>
                <div style="font-size: 16px; font-weight: bold; color: #1e293b;">{{ $data_kelas->nama_ruang ?? '-' }}</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef9c3; color: #eab308; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Tahun Ajaran</div>
                <div style="font-size: 16px; font-weight: bold; color: #1e293b;">2026/2027</div>
            </div>
        </div>

        <div style="background: white; border-radius: 12px; padding: 20px; display: flex; align-items: center; gap: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div>
                <div style="font-size: 13px; color: #64748b; font-weight: 600;">Status Data</div>
                <div style="font-size: 16px; font-weight: bold; color: #1e293b;">Terverifikasi</div>
            </div>
        </div>
    </div>

    <!-- Detail Layout Grid -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
        
        <!-- Personal Info -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #dcfce7; color: #16a34a; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #16a34a; letter-spacing: 1px; margin-bottom: 4px;">IDENTITAS</div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Data Pribadi</h3>
                </div>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">NIS / NISN</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->nis }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Jenis kelamin</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->jenis_kelamin ?? 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Tempat, tanggal lahir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ ($data_siswa->tempat_lahir ?? 'Belum tersedia') }}{{ !empty($data_siswa->tanggal_lahir) ? ', ' . \Carbon\Carbon::parse($data_siswa->tanggal_lahir)->translatedFormat('d F Y') : '' }}</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Agama</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">{{ $data_siswa->agama ?? 'Islam' }}</div>
                </div>
                <div style="grid-column: 1 / -1;">
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Alamat</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">{{ $data_siswa->alamat ?? 'Belum tersedia' }}</div>
                </div>
            </div>
        </div>

        <!-- Academic Status -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #fef9c3; color: #eab308; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #eab308; letter-spacing: 1px; margin-bottom: 4px;">AKADEMIK</div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Data Sekolah</h3>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Kelas</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">{{ $data_kelas->nama_ruang ?? '-' }}</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Tahun ajaran</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">2026/2027 Ganjil</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Wali kelas</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">Ustadzah Fitri</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Status siswa</div>
                    <span style="font-size: 14px; font-weight: bold; color: #166534;"><i class="fa-solid fa-circle" style="font-size: 10px; margin-right: 4px;"></i> Aktif</span>
                </div>
            </div>
        </div>

        <div style="grid-column: 1 / -1; background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #3875c5; letter-spacing: 1px; margin-bottom: 4px;">KEAMANAN AKUN</div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Informasi Akses</h3>
                </div>
            </div>
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; gap: 20px; align-items: center;">
                <i class="fa-solid fa-lock" style="font-size: 32px; color: #94a3b8;"></i>
                <div>
                    <strong style="display: block; color: #1e293b; font-size: 16px; margin-bottom: 4px;">Data akun Anda terlindungi</strong>
                    <p style="margin: 0; font-size: 14px; color: #64748b;">Untuk memperbarui data pribadi, foto, atau kata sandi, silakan hubungi administrasi sekolah.</p>
                </div>
            </div>
        </div>

    </div>
</x-siakad-layout>

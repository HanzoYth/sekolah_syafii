<x-siakad-layout title="Profil Guru" description="Tinjau informasi kepegawaian dan data pribadi Anda." position="Guru" initials="GR">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-id-card"></i> Administrasi Kepegawaian
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                Profil Pendidik
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Tinjau informasi kepegawaian dan data pribadi yang terdaftar pada sistem.
            </div>
        </div>
    </div>

    <!-- Profile Hero -->
    <div style="background: white; border-radius: 16px; padding: 30px; display: flex; align-items: center; gap: 30px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 24px; flex-wrap: wrap;">
        
        <div style="width: 120px; height: 120px; border-radius: 20px; overflow: hidden; background: #f1f5f9; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #94a3b8;">
            <i class="fa-solid fa-user-tie"></i>
        </div>
        
        <div style="flex: 1; min-width: 250px;">
            <div style="font-size: 12px; font-weight: 700; color: #177455; letter-spacing: 1px; margin-bottom: 8px;">TENAGA PENDIDIK</div>
            <h2 style="margin: 0 0 8px; font-size: 24px; color: #1e293b;">Ustadzah Fitri</h2>
            <div style="color: #64748b; font-size: 15px; margin-bottom: 16px;">
                <i class="fa-solid fa-id-badge"></i> NIP/NUPTK: 198506152010012015
            </div>
            
            <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #dcfce7; color: #166534; border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-circle-check"></i> Guru Aktif
                </span>
                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #e9f2ff; color: #3875c5; border-radius: 8px; font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-chalkboard-user"></i> Pengajar Tetap
                </span>
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
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Jenis kelamin</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">Perempuan</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Pendidikan Terakhir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">S1 Pendidikan Agama Islam</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Tempat, tanggal lahir</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">Jakarta, 15 Juni 1985</div>
                </div>
                <div>
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Agama</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500;">Islam</div>
                </div>
                <div style="grid-column: 1 / -1;">
                    <div style="font-size: 13px; color: #64748b; font-weight: 600; margin-bottom: 4px;">Alamat</div>
                    <div style="font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">Jl. Mawar Merah No. 12, Jakarta Selatan</div>
                </div>
            </div>
        </div>

        <!-- Academic Status -->
        <div style="background: white; border-radius: 16px; padding: 24px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #fef9c3; color: #eab308; display: flex; align-items: center; justify-content: center; font-size: 18px;">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <div>
                    <div style="font-size: 12px; font-weight: 700; color: #eab308; letter-spacing: 1px; margin-bottom: 4px;">KEPEGAWAIAN</div>
                    <h3 style="margin: 0; font-size: 16px; color: #1e293b;">Data Tugas</h3>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 16px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Status Guru</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">Tetap (GTY)</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Tugas Tambahan</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">Wali Kelas</div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;">
                    <div style="font-size: 14px; color: #64748b; font-weight: 600;">Tahun Mulai Mengabdi</div>
                    <div style="font-size: 14px; color: #1e293b; font-weight: bold;">2010</div>
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
                    <strong style="display: block; color: #1e293b; font-size: 16px; margin-bottom: 4px;">Data akun Anda dikelola oleh Admin</strong>
                    <p style="margin: 0; font-size: 14px; color: #64748b;">Untuk memperbarui data profil atau kata sandi, silakan hubungi Administrator Sistem SIAKAD.</p>
                </div>
            </div>
        </div>

    </div>
</x-siakad-layout>

@php
    $pengumuman = (isset($list_pengumuman) && count($list_pengumuman)) ? $list_pengumuman : [
        (object)['tanggal'=>'28 Agu 2026','judul'=>'Libur Nasional Hari Kemerdekaan','ringkasan'=>'Kegiatan belajar mengajar diliburkan sesuai kalender pendidikan yang berlaku.','ditujukan'=>'Seluruh Siswa','isi'=>'Sehubungan dengan peringatan Hari Kemerdekaan Republik Indonesia, seluruh kegiatan belajar mengajar diliburkan. Kegiatan belajar akan kembali berjalan normal pada hari kerja berikutnya.'],
        (object)['tanggal'=>'20 Agu 2026','judul'=>'Jadwal Ujian Tengah Semester','ringkasan'=>'Jadwal UTS semester ganjil dapat dilihat melalui wali kelas masing-masing.','ditujukan'=>'Kelas 1A - 6B','isi'=>'Ujian Tengah Semester ganjil akan dilaksanakan mulai tanggal 1 September 2026 sampai dengan 5 September 2026. Siswa diharapkan hadir tepat waktu dan membawa perlengkapan ujian masing-masing.'],
        (object)['tanggal'=>'12 Agu 2026','judul'=>'Pembagian Rapor Semester Genap','ringkasan'=>'Rapor dapat diambil oleh wali murid di ruang tata usaha.','ditujukan'=>'Wali Murid','isi'=>'Pembagian rapor semester genap dilaksanakan pada tanggal 15 Agustus 2026 pukul 08.00 - 12.00 WITA. Rapor diambil langsung oleh wali murid dengan menunjukkan kartu identitas.'],
    ];
@endphp
<x-siakad-layout title="Pengumuman Akademik" description="Informasi dan pengumuman terbaru dari pihak sekolah." position="Orang Tua / Siswa" initials="OT">
    
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 24px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
        <div style="flex: 1;">
            <div style="font-size: 14px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">
                <i class="fa-solid fa-bullhorn"></i> Administrasi Siswa
            </div>
            <div style="font-size: 18px; font-weight: bold; color: #1e293b;">
                Pengumuman Akademik
            </div>
            <div style="color: #64748b; font-size: 14px; margin-top: 4px;">
                Tetap *up-to-date* dengan informasi terbaru seputar kegiatan sekolah.
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 8px; background: #f8fafc; padding: 10px 16px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 14px; font-weight: 600; color: #334155;">
            <i class="fa-solid fa-bell" style="color: #3875c5;"></i>
            <span>{{ count($pengumuman) }} pengumuman baru</span>
        </div>
    </div>

    <div style="display: grid; gap: 20px;">
        @forelse($pengumuman as $index => $item)
            <div style="background: white; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); overflow: hidden;">
                <div style="padding: 24px; display: flex; gap: 24px; align-items: flex-start;">
                    <div style="width: 64px; height: 64px; border-radius: 12px; background: #e9f2ff; color: #3875c5; display: flex; align-items: center; justify-content: center; font-size: 28px; flex-shrink: 0;">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px;">
                            <h3 style="margin: 0; font-size: 18px; color: #1e293b;">{{ $item->judul }}</h3>
                            <span style="font-size: 13px; font-weight: 600; color: #64748b; display: flex; align-items: center; gap: 6px;">
                                <i class="fa-regular fa-calendar"></i> {{ $item->tanggal }}
                            </span>
                        </div>
                        <div style="display: flex; gap: 12px; margin-bottom: 16px;">
                            <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; background: #f1f5f9; color: #475569; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                <i class="fa-solid fa-users"></i> Ditujukan: {{ $item->ditujukan }}
                            </span>
                        </div>
                        <p style="margin: 0 0 16px; font-size: 14px; color: #475569; line-height: 1.6;">{{ $item->ringkasan }}</p>
                        
                        <details style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                            <summary style="padding: 12px 16px; font-size: 13px; font-weight: 600; color: #3875c5; cursor: pointer; list-style: none; display: flex; align-items: center; gap: 8px;">
                                <i class="fa-solid fa-chevron-down"></i> Baca selengkapnya
                            </summary>
                            <div style="padding: 0 16px 16px; font-size: 14px; color: #1e293b; line-height: 1.6; border-top: 1px solid #e2e8f0; margin-top: 8px; padding-top: 16px;">
                                {{ $item->isi }}
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 60px 20px; color: #64748b; background: white; border: 1px dashed #cbd5e1; border-radius: 12px;">
                <i class="fa-solid fa-folder-open" style="font-size: 48px; color: #cbd5e1; margin-bottom: 16px; display: block;"></i>
                <h3 style="margin: 0 0 8px; font-size: 18px; color: #1e293b;">Belum ada pengumuman</h3>
                <p style="margin: 0; font-size: 14px;">Saat ini tidak ada informasi atau pengumuman baru dari sekolah.</p>
            </div>
        @endforelse
    </div>

    <style>
        details > summary::-webkit-details-marker { display: none; }
        details[open] summary i { transform: rotate(180deg); transition: transform 0.2s; }
        details summary i { transition: transform 0.2s; }
    </style>
</x-siakad-layout>

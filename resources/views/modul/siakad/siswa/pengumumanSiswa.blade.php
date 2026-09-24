<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Akademik - SIAKAD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('img/logo_sklh.png') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/modul/siakad/pengumumanSiswa.css') }}?v={{ time() }}">
</head>
<body>
    @php
        $pengumuman = (isset($list_pengumuman) && count($list_pengumuman)) ? $list_pengumuman : [
            (object)['tanggal'=>'28 Agu 2026','judul'=>'Libur Nasional Hari Kemerdekaan','ringkasan'=>'Kegiatan belajar mengajar diliburkan sesuai kalender pendidikan yang berlaku.','ditujukan'=>'Seluruh Siswa','isi'=>'Sehubungan dengan peringatan Hari Kemerdekaan Republik Indonesia, seluruh kegiatan belajar mengajar diliburkan. Kegiatan belajar akan kembali berjalan normal pada hari kerja berikutnya.'],
            (object)['tanggal'=>'20 Agu 2026','judul'=>'Jadwal Ujian Tengah Semester','ringkasan'=>'Jadwal UTS semester ganjil dapat dilihat melalui wali kelas masing-masing.','ditujukan'=>'Kelas 1A - 6B','isi'=>'Ujian Tengah Semester ganjil akan dilaksanakan mulai tanggal 1 September 2026 sampai dengan 5 September 2026. Siswa diharapkan hadir tepat waktu dan membawa perlengkapan ujian masing-masing.'],
            (object)['tanggal'=>'12 Agu 2026','judul'=>'Pembagian Rapor Semester Genap','ringkasan'=>'Rapor dapat diambil oleh wali murid di ruang tata usaha.','ditujukan'=>'Wali Murid','isi'=>'Pembagian rapor semester genap dilaksanakan pada tanggal 15 Agustus 2026 pukul 08.00 - 12.00 WITA. Rapor diambil langsung oleh wali murid dengan menunjukkan kartu identitas.'],
        ];
    @endphp
    <div class="dashboard-container student-announcement-page">
        <x-sidebar_siakad />
        <main class="main-content">
            <x-siakad.topbar :name="$data_siswa->nama" position="Siswa" initials="SW" title="Pengumuman Akademik" description="Informasi terbaru untuk kegiatan belajar dan sekolah." />

            @if(session('eror'))
                <div class="announcement-alert" id="errorToast"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('eror') }}</span><button type="button" onclick="closeToast()" aria-label="Tutup pesan">&times;</button></div>
            @endif

            <section class="announcement-intro"><div><p>INFORMASI SEKOLAH</p><h2>Pengumuman terbaru</h2><span>Informasi untuk {{ $data_siswa->nama }} · {{ $data_kelas->nama_ruang }}</span></div><span class="announcement-counter"><i class="fa-solid fa-bullhorn"></i> {{ count($pengumuman) }} pengumuman</span></section>

            <section class="priority-announcement">
                <span class="priority-icon"><i class="fa-solid fa-thumbtack"></i></span><div><small>PENGUMUMAN PRIORITAS</small><h3>Jadwal Ujian Tengah Semester</h3><p>Persiapkan diri dan perhatikan informasi jadwal dari wali kelas.</p></div><button type="button" class="priority-view" data-index="1">Baca informasi <i class="fa-solid fa-arrow-right"></i></button>
            </section>

            <section class="announcement-toolbar"><div class="announcement-search"><i class="fa-solid fa-magnifying-glass"></i><input type="search" id="announcementSearch" placeholder="Cari judul atau isi pengumuman..."></div><span><i class="fa-regular fa-clock"></i> Diurutkan terbaru</span></section>

            <section class="announcement-list" id="announcementList">
                @forelse($pengumuman as $index => $item)
                    <article class="announcement-card" data-search="{{ strtolower($item->judul . ' ' . $item->ringkasan . ' ' . $item->ditujukan) }}">
                        <span class="announcement-card-icon {{ $index === 0 ? 'gold' : ($index === 1 ? 'emerald' : 'blue') }}"><i class="fa-solid {{ $index === 0 ? 'fa-flag' : ($index === 1 ? 'fa-file-pen' : 'fa-graduation-cap') }}"></i></span>
                        <div class="announcement-card-body"><div class="announcement-meta"><span>{{ $item->ditujukan }}</span><time><i class="fa-regular fa-calendar"></i> {{ $item->tanggal }}</time></div><h3>{{ $item->judul }}</h3><p>{{ $item->ringkasan }}</p></div>
                        <button type="button" class="announcement-read" data-index="{{ $index }}">Baca <i class="fa-solid fa-chevron-right"></i></button>
                        <template class="announcement-data"><span class="data-title">{{ $item->judul }}</span><span class="data-date">{{ $item->tanggal }}</span><span class="data-target">{{ $item->ditujukan }}</span><span class="data-content">{{ $item->isi ?? $item->ringkasan }}</span></template>
                    </article>
                @empty
                    <div class="announcement-empty"><i class="fa-solid fa-bullhorn"></i><strong>Belum ada pengumuman</strong><p>Informasi terbaru dari sekolah akan muncul di halaman ini.</p></div>
                @endforelse
            </section>
        </main>
    </div>

    <div class="announcement-modal" id="announcementModal" aria-hidden="true"><div class="announcement-modal-box" role="dialog" aria-modal="true" aria-labelledby="modalTitle"><div class="modal-top"><span><i class="fa-solid fa-bullhorn"></i></span><button type="button" onclick="closeAnnouncement()" aria-label="Tutup"><i class="fa-solid fa-xmark"></i></button></div><div class="modal-content"><h3 id="modalTitle"></h3><div><span id="modalDate"></span><span id="modalTarget"></span></div><p id="modalText"></p></div><div class="modal-footer"><button type="button" onclick="closeAnnouncement()">Tutup</button></div></div></div>
    <script>
        function closeToast(){document.getElementById('errorToast')?.remove();}
        window.setTimeout(closeToast,5000);
        const modal=document.getElementById('announcementModal');
        function openAnnouncement(index){const card=document.querySelectorAll('.announcement-card')[index];if(!card)return;const data=card.querySelector('.announcement-data');document.getElementById('modalTitle').textContent=data.querySelector('.data-title').textContent;document.getElementById('modalDate').textContent=data.querySelector('.data-date').textContent;document.getElementById('modalTarget').textContent=data.querySelector('.data-target').textContent;document.getElementById('modalText').textContent=data.querySelector('.data-content').textContent;modal.classList.add('active');modal.setAttribute('aria-hidden','false');document.body.style.overflow='hidden';}
        function closeAnnouncement(){modal.classList.remove('active');modal.setAttribute('aria-hidden','true');document.body.style.overflow='';}
        document.querySelectorAll('.announcement-read,.priority-view').forEach(button=>button.addEventListener('click',()=>openAnnouncement(button.dataset.index)));
        document.getElementById('announcementSearch')?.addEventListener('input',function(){const query=this.value.toLowerCase();document.querySelectorAll('.announcement-card').forEach(card=>card.hidden=!card.dataset.search.includes(query));});
        modal.addEventListener('click',event=>{if(event.target===modal)closeAnnouncement();});document.addEventListener('keydown',event=>{if(event.key==='Escape')closeAnnouncement();});
    </script>
</body>
</html>

<x-siakad-layout 
    title="Pengumuman Akademik & Surat Edaran" 
    description="Papan informasi resmi, agenda kalender akademik, dan surat edaran dari Yayasan & Admin Sekolah." 
    position="Guru SIAKAD" 
    initials="GR">

    <x-slot name="breadcrumb">
        <li class="flex items-center">
            <a href="/sk/dsg" class="text-slate-500 hover:text-emerald-600 transition-colors">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px] mx-2 text-slate-400"></i>
        </li>
        <li class="flex items-center">
            <span class="text-slate-700 font-medium">Pengumuman</span>
        </li>
    </x-slot>

    <!-- Header Filter Bar -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-3.5">
            <div class="w-11 h-11 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg flex-shrink-0">
                <i class="fa-solid fa-bullhorn"></i>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-800">Papan Pengumuman & Surat Edaran Guru</h3>
                <p class="text-xs text-slate-500">Menampilkan {{ count($list_pengumuman) }} pengumuman resmi yang ditujukan untuk Anda</p>
            </div>
        </div>

        <div class="relative w-full sm:w-72">
            <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" id="searchPengumumanGuru" placeholder="Cari judul pengumuman..."
                   class="w-full pl-9 pr-4 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg text-slate-700 font-medium focus:outline-none focus:border-emerald-500 focus:bg-white transition-colors">
        </div>
    </div>

    <!-- Announcements List -->
    <div id="pengumumanGuruList" class="space-y-5 mb-8">
        @if(count($list_pengumuman) > 0)
            @foreach($list_pengumuman as $item)
                <div class="pengumuman-guru-item bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:border-emerald-300 transition-all">
                    <div class="flex flex-col sm:flex-row sm:items-start gap-5">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <h4 class="text-base font-bold text-slate-800">{{ $item->judul }}</h4>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1 rounded-full self-start sm:self-auto whitespace-nowrap">
                                    <i class="fa-regular fa-calendar text-[11px] text-emerald-600"></i> {{ $item->tanggal }}
                                </span>
                            </div>

                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <i class="fa-solid fa-users text-[10px]"></i> {{ $item->target_label ?? 'Semua Civitas' }}
                                </span>
                                <span class="text-xs text-slate-400">
                                    Diterbitkan oleh: <strong class="text-slate-600">{{ $item->penulis }}</strong>
                                </span>
                            </div>

                            <p class="text-sm text-slate-600 leading-relaxed mb-4">{{ $item->ringkasan }}</p>

                            <details class="group bg-slate-50 border border-slate-200 rounded-xl overflow-hidden">
                                <summary class="px-4 py-2.5 text-xs font-bold text-emerald-700 cursor-pointer list-none flex items-center justify-between hover:bg-slate-100/80 transition-colors">
                                    <span class="flex items-center gap-2">
                                        <i class="fa-solid fa-book-open text-[11px]"></i> Baca Isi Pengumuman Selengkapnya
                                    </span>
                                    <i class="fa-solid fa-chevron-down text-[10px] group-open:rotate-180 transition-transform"></i>
                                </summary>
                                <div class="p-4 text-sm text-slate-700 leading-relaxed border-t border-slate-200 bg-white">
                                    {!! nl2br(e($item->isi)) !!}

                                    @if(!empty($item->lampiran))
                                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between flex-wrap gap-2">
                                            <span class="text-xs text-slate-500 font-medium">Dokumen / Berkas Lampiran Resmi:</span>
                                            <a href="{{ asset($item->lampiran) }}" target="_blank" download 
                                               class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-bold border border-emerald-200 transition-colors">
                                                <i class="fa-solid fa-file-arrow-down"></i> Unduh Lampiran
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-12 text-center text-slate-500">
                <i class="fa-solid fa-folder-open text-3xl text-slate-300 mb-3 block"></i>
                <h4 class="text-sm font-bold text-slate-700">Belum Ada Pengumuman</h4>
                <p class="text-xs text-slate-400 mt-1">Saat ini belum ada pengumuman atau surat edaran baru yang ditujukan untuk Anda.</p>
            </div>
        @endif
    </div>

    <script>
        document.getElementById('searchPengumumanGuru')?.addEventListener('input', function() {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.pengumuman-guru-item').forEach(el => {
                el.style.display = el.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        });
    </script>
</x-siakad-layout>


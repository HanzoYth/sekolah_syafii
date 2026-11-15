@props([
    'ranking' => [],
    'currentSiswaId' => null,
    'kelasNama' => '',
    'showPendingHint' => false,
])

@php
    $finalReady = (bool) ($ranking['final_ready'] ?? false);
    $top3 = collect($ranking['top3'] ?? []);
    $peringkatSiswa = $ranking['peringkat_siswa'] ?? null;
    $totalSiswa = (int) ($ranking['total_siswa'] ?? 0);
    $mapelLengkap = (int) ($ranking['mapel_lengkap'] ?? 0);
    $totalMapel = (int) ($ranking['total_mapel'] ?? 0);
@endphp

@if($finalReady && $top3->isNotEmpty())
    <div {{ $attributes->merge(['class' => 'bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8']) }}>
        <div class="px-5 py-3.5 bg-gradient-to-r from-emerald-800 via-emerald-900 to-teal-900 text-white flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-9 h-9 rounded-lg bg-amber-400/20 border border-amber-300/30 text-amber-300 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-trophy text-sm"></i>
                </div>
                <div class="min-w-0">
                    <h3 class="text-sm font-bold tracking-tight text-white">Top 3 Juara Final Kelas{{ $kelasNama ? ' — ' . $kelasNama : '' }}</h3>
                    <p class="text-[11px] text-emerald-100/85">Peringkat resmi berdasarkan kelengkapan 100% seluruh komponen nilai mata pelajaran</p>
                </div>
            </div>
            @if($peringkatSiswa)
                <div class="inline-flex items-center flex-wrap gap-2 px-3 py-1.5 rounded-full bg-white shadow-sm text-xs font-semibold text-slate-700 self-start sm:self-auto">
                    <span class="text-slate-500">Peringkat Kamu:</span>
                    <x-siakad.rank-badge :rank="$peringkatSiswa" variant="compact" />
                    <span class="text-[11px] text-slate-500 font-medium">dari {{ $totalSiswa }} siswa</span>
                </div>
            @endif
        </div>

        <div class="p-4 sm:p-5 bg-slate-50/40">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5">
                @foreach($top3 as $juara)
                    @php
                        $isMe = $currentSiswaId && ((int) $juara->siswa_id === (int) $currentSiswaId);
                        $tierStyle = match ((int) $juara->peringkat) {
                            1 => [
                                'card' => 'border-amber-300/90 bg-gradient-to-br from-amber-50/70 via-white to-white',
                                'avatar' => 'bg-amber-100 text-amber-800 border-amber-200',
                            ],
                            2 => [
                                'card' => 'border-slate-300 bg-gradient-to-br from-slate-50/80 via-white to-white',
                                'avatar' => 'bg-slate-200/80 text-slate-700 border-slate-300',
                            ],
                            default => [
                                'card' => 'border-orange-200 bg-gradient-to-br from-orange-50/60 via-white to-white',
                                'avatar' => 'bg-orange-100 text-orange-800 border-orange-200',
                            ],
                        };
                    @endphp
                    <div class="rounded-xl border {{ $tierStyle['card'] }} {{ $isMe ? 'ring-2 ring-emerald-500/80 shadow-sm' : '' }} p-4 transition-all">
                        <div class="flex items-center justify-between flex-wrap gap-2 mb-3">
                            <x-siakad.rank-badge :rank="$juara->peringkat" variant="compact" />
                            <div class="flex items-center flex-wrap gap-1.5">
                                @if($isMe)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-600 text-white">
                                        Kamu
                                    </span>
                                @endif
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                    Predikat {{ $juara->predikat }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full border {{ $tierStyle['avatar'] }} flex items-center justify-center font-bold text-xs flex-shrink-0">
                                {{ $juara->inisial }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-bold text-slate-800 truncate" title="{{ $juara->nama }}">{{ $juara->nama }}</h4>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Rata-rata Final: <span class="font-bold text-slate-800">{{ number_format($juara->rata_rata, 1) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@elseif($showPendingHint && $totalMapel > 0)
    <div {{ $attributes->merge(['class' => 'rounded-xl border border-amber-200/80 bg-amber-50/70 px-4 py-3 mb-6 flex items-center gap-3 text-xs text-amber-900']) }}>
        <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center flex-shrink-0">
            <i class="fa-solid fa-hourglass-half"></i>
        </div>
        <div>
            <p class="font-bold text-amber-950">Peringkat Final Kelas Menunggu Kelengkapan Nilai ({{ $mapelLengkap }}/{{ $totalMapel }} Mapel Lengkap)</p>
            <p class="text-[11px] text-amber-800 mt-0.5">Peringkat kelas dan daftar 3 Juara Terbaik akan muncul otomatis setelah seluruh komponen nilai untuk semua mata pelajaran selesai diinput 100%.</p>
        </div>
    </div>
@endif

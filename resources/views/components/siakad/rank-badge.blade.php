@props([
    'rank' => '-',
    'variant' => 'table', // 'table' | 'compact' | 'print'
])

@php
    $isRanked = is_numeric($rank) && (int) $rank > 0;
    $rankNum = $isRanked ? (int) $rank : null;
    $isTop3 = $isRanked && $rankNum <= 3;

    $tierMeta = [
        1 => ['label' => 'Juara 1', 'icon' => 'fa-solid fa-crown', 'title' => 'Peringkat 1 — Juara Kelas'],
        2 => ['label' => 'Juara 2', 'icon' => 'fa-solid fa-medal', 'title' => 'Peringkat 2 — Juara Kelas'],
        3 => ['label' => 'Juara 3', 'icon' => 'fa-solid fa-award', 'title' => 'Peringkat 3 — Juara Kelas'],
    ];
    $meta = $isTop3 ? $tierMeta[$rankNum] : null;
@endphp

@if(!$isRanked)
    <span class="text-xs text-slate-400 font-medium">-</span>
@elseif($variant === 'print')
    @if($isTop3)
        <span class="siakad-rank-print siakad-rank-print-{{ $rankNum }}" title="{{ $meta['title'] }}">
            <i class="{{ $meta['icon'] }} text-[8.5px]"></i>
            <span>{{ $rankNum }}</span>
        </span>
    @else
        <span class="font-bold text-slate-700">#{{ $rankNum }}</span>
    @endif
@else
    <span
        {{ $attributes->merge([
            'class' => 'siakad-rank-badge '
                . ($variant === 'compact' ? 'siakad-rank-badge--compact ' : '')
                . ($isTop3 ? 'siakad-rank-badge--top3 siakad-rank-' . $rankNum : 'siakad-rank-other'),
            'title' => $meta['title'] ?? ('Peringkat #' . $rankNum),
        ]) }}
        data-rank-tier="{{ $rankNum }}"
    >
        @if($isTop3)
            <span class="siakad-rank-crest-wrap">
                @if($rankNum === 1)
                    <i class="fa-solid fa-crown siakad-rank-crest-crown" aria-hidden="true"></i>
                @endif
                <span class="siakad-rank-coin" aria-label="Peringkat {{ $rankNum }}">{{ $rankNum }}</span>
            </span>
            <span class="siakad-rank-meta">
                @if($rankNum !== 1)
                    <i class="{{ $meta['icon'] }} siakad-rank-icon {{ $variant === 'compact' ? 'text-[9px]' : 'text-[10px]' }}"></i>
                @endif
                <span class="siakad-rank-tier-label">{{ $meta['label'] }}</span>
            </span>
        @else
            <span class="siakad-rank-meta">
                <span class="{{ $variant === 'compact' ? 'text-[10.5px]' : 'text-[11px]' }} font-bold tracking-tight text-slate-600">#{{ $rankNum }}</span>
            </span>
        @endif
    </span>
@endif

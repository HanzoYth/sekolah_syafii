@props([
    'type' => 'primary', // primary, secondary, danger, warning, success
    'icon' => null,
    'href' => null,
])

@php
    $baseClasses = 'inline-flex items-center gap-2 px-4 py-2 text-sm font-medium rounded-lg transition-colors border';
    
    $colorClasses = [
        'primary' => 'bg-[#0d5c3a] text-white border-transparent hover:bg-[#064e3b]',
        'secondary' => 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50',
        'danger' => 'bg-red-500 text-white border-transparent hover:bg-red-600',
        'warning' => 'bg-yellow-500 text-white border-transparent hover:bg-yellow-600',
        'success' => 'bg-emerald-500 text-white border-transparent hover:bg-emerald-600',
    ];

    $classes = $baseClasses . ' ' . ($colorClasses[$type] ?? $colorClasses['primary']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon) <i class="{{ $icon }}"></i> @endif
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon) <i class="{{ $icon }}"></i> @endif
        {{ $slot }}
    </button>
@endif


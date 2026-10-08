@props([
    'title',
    'value',
    'icon',
    'color' => 'success' // success, warning, danger, info, primary
])

@php
    $colors = [
        'success' => ['border' => '#86efac', 'bg' => '#f0fdf4', 'icon' => '#16a34a'],
        'warning' => ['border' => '#fde047', 'bg' => '#fefce8', 'icon' => '#eab308'],
        'danger'  => ['border' => '#fca5a5', 'bg' => '#fef2f2', 'icon' => '#ef4444'],
        'info'    => ['border' => '#93c5fd', 'bg' => '#eff6ff', 'icon' => '#3b82f6'],
        'primary' => ['border' => '#e2e8f0', 'bg' => '#f8fafc', 'icon' => '#64748b'],
    ];

    $style = $colors[$color] ?? $colors['primary'];
@endphp

<div style="background: {{ $style['bg'] }}; padding: 16px; border-radius: 8px; border: 1px solid {{ $style['border'] }}; display: flex; align-items: center; gap: 15px; min-width: 160px; flex: 1;">
    <i class="{{ $icon }}" style="font-size: 24px; color: {{ $style['icon'] }};"></i>
    <div>
        <strong style="display: block; font-size: 20px; color: #1e293b; line-height: 1;">{{ $value }}</strong>
        <span style="font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 4px; display: block;">{{ $title }}</span>
    </div>
</div>


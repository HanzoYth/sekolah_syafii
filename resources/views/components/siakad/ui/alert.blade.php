@props([
    'type' => 'success', // success, error, warning, info
    'message' => ''
])

@php
    $bg = match($type) {
        'success' => '#ecfdf5',
        'error' => '#fef2f2',
        'warning' => '#fefce8',
        'info' => '#eff6ff',
        default => '#ecfdf5',
    };
    $border = match($type) {
        'success' => '#a7f3d0',
        'error' => '#fecaca',
        'warning' => '#fef08a',
        'info' => '#bfdbfe',
        default => '#a7f3d0',
    };
    $text = match($type) {
        'success' => '#065f46',
        'error' => '#991b1b',
        'warning' => '#854d0e',
        'info' => '#1e40af',
        default => '#065f46',
    };
    $icon = match($type) {
        'success' => 'fa-circle-check',
        'error' => 'fa-circle-exclamation',
        'warning' => 'fa-triangle-exclamation',
        'info' => 'fa-circle-info',
        default => 'fa-circle-check',
    };
@endphp

<div style="padding: 16px 20px; background: {{ $bg }}; color: {{ $text }}; border-radius: 12px; border: 1px solid {{ $border }}; margin-bottom: 20px; font-weight: 500; font-size: 0.95rem; display: flex; align-items: center; gap: 10px;">
    <i class="fa-solid {{ $icon }}" style="font-size: 1.2rem;"></i>
    <div>
        {{ $message }}
        {{ $slot }}
    </div>
</div>


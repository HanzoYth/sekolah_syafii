@props([
    'id',
    'title',
    'icon' => null,
    'iconColor' => '#166534',
    'iconBg' => '#dcfce7'
])

<div id="{{ $id }}" style="display: none; position: fixed; inset: 0; z-index: 1000; align-items: center; justify-content: center;">
    <!-- Backdrop -->
    <div style="position: absolute; inset: 0; background: rgba(15, 23, 42, 0.4); backdrop-filter: blur(4px);" onclick="closeModal('{{ $id }}')"></div>
    
    <!-- Modal Content -->
    <div class="siakad-modal-box" style="position: relative; background: white; border-radius: 16px; padding: 24px; width: 92%; max-width: 500px; max-height: 90vh; overflow-y: auto; box-sizing: border-box; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1); transform: scale(0.95); opacity: 0; transition: all 0.2s ease-out; animation: modalIn 0.3s forwards;">
        
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
            @if($icon)
            <div style="width: 52px; height: 52px; border-radius: 14px; background: {{ $iconBg }}; color: {{ $iconColor }}; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0;">
                <i class="fa-solid {{ $icon }}"></i>
            </div>
            @endif
            <h3 style="margin: 0; font-size: 1.15rem; color: #1e293b; font-weight: 700;">{{ $title }}</h3>
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
</div>

<style>
@keyframes modalIn {
    to { transform: scale(1); opacity: 1; }
}
@media (max-width: 640px) {
    .siakad-modal-box {
        padding: 18px 14px !important;
        width: 95% !important;
        border-radius: 12px !important;
    }
}
</style>


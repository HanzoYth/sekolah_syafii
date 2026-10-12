<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SIAKAD' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @include('components.siakad.styles')
    <style>
        .page-container { padding: 24px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-top: 20px; }
        .page-header { border-bottom: 2px solid #ecfdf5; padding-bottom: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
        .page-title { font-size: 18px; font-weight: bold; color: #0d5c3a; margin: 0; display: flex; align-items: center; gap: 8px; }
        .alert-toast { padding: 16px 20px; background: #ecfdf5; color: #065f46; border-radius: 8px; border: 1px solid #a7f3d0; margin-bottom: 20px; font-weight: 500; font-size: 0.95rem; }
        .alert-error { background: #fef2f2; color: #991b1b; border-color: #fecaca; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <x-siakad.sidebar />
        <main class="main-content">
            <x-siakad.topbar 
                title="{{ $pageTitle ?? ($title ?? 'Dashboard SIAKAD') }}" 
                description="{{ $pageDescription ?? ($subtitle ?? 'Kelola sistem akademik dengan mudah.') }}" 
                position="{{ session('role') == 'g' ? 'Guru' : (session('role') == 'a' ? 'Admin' : 'Siswa') }}" 
            />

            <div class="page-container">
                @include('components.warning')

                {{ $slot }}
            </div>
        </main>
    </div>
    
    {{ $scripts ?? '' }}
</body>
</html>


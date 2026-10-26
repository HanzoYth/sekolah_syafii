@php
    $role = session('role');
@endphp

@if(in_array($role, ['a', 'g', 's']))
    <nav class="siakad-bottom-nav" aria-label="Navigasi Cepat Mobile">
        <div class="siakad-bottom-nav-inner">
            {{-- ================= ROLE SISWA ================= --}}
            @if($role === 's')
                @php
                    $isBeranda = request()->is('sk/dbs');
                    $isJadwal = request()->is('sk/jadwal-siswa') && !in_array(request('tab'), ['absensi_mapel', 'absensi_harian']);
                    $isRapor = request()->is('sk/rapor-siswa*');
                    $isTagihan = request()->is('sk/pbs*', 'sk/dsp*');
                @endphp
                
                <a href="/sk/dbs" class="bottom-nav-item {{ $isBeranda ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <span class="bottom-nav-label">Beranda</span>
                </a>

                <a href="/sk/jadwal-siswa?tab=jadwal" class="bottom-nav-item {{ $isJadwal ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-calendar-week"></i>
                    </div>
                    <span class="bottom-nav-label">Jadwal</span>
                </a>

                <a href="/sk/rapor-siswa" class="bottom-nav-item {{ $isRapor ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <span class="bottom-nav-label">Rapor</span>
                </a>

                <a href="/sk/pbs" class="bottom-nav-item {{ $isTagihan ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <span class="bottom-nav-label">Tagihan</span>
                </a>

                <button type="button" class="bottom-nav-item" onclick="if(window.toggleSiakadSidebar){window.toggleSiakadSidebar();}else{var h=document.getElementById('mobile-hamburger-btn');if(h)h.click();}" aria-label="Buka Menu Lengkap">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <span class="bottom-nav-label">Menu</span>
                </button>

            {{-- ================= ROLE GURU ================= --}}
            @elseif($role === 'g')
                @php
                    $guruId = session('id');
                    $guruData = $guruId ? \App\Models\guru::find($guruId) : null;
                    if (!$guruData && session('id_akun')) {
                        $guruData = \App\Models\guru::where('user_id', session('id_akun'))->first();
                    }
                    $isKepsek = $guruData && ($guruData->kepala_sekolah == 1 || $guruData->wakil_sekolah == 1);
                    $isBendahara = $guruData && ($guruData->bendahara == 1);
                @endphp

                @if($isKepsek)
                    @php
                        $isBeranda = request()->is('sk/das');
                        $isSiswa = request()->is('sk/ds*', 'sk/dls/*', 'sk/dts*');
                        $isJadwal = request()->is('sk/kelola-jadwal*', 'sk/edit-jadwal*');
                        $isKelas = request()->is('sk/tk*', 'sk/pembagian-kelas*');
                    @endphp

                    <a href="/sk/das" class="bottom-nav-item {{ $isBeranda ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <span class="bottom-nav-label">Beranda</span>
                    </a>

                    <a href="/sk/ds" class="bottom-nav-item {{ $isSiswa ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <span class="bottom-nav-label">Siswa</span>
                    </a>

                    <a href="/sk/kelola-jadwal" class="bottom-nav-item {{ $isJadwal ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-calendar-alt"></i>
                        </div>
                        <span class="bottom-nav-label">Jadwal</span>
                    </a>

                    <a href="/sk/tk" class="bottom-nav-item {{ $isKelas ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-school"></i>
                        </div>
                        <span class="bottom-nav-label">Kelas</span>
                    </a>

                    <button type="button" class="bottom-nav-item" onclick="if(window.toggleSiakadSidebar){window.toggleSiakadSidebar();}else{var h=document.getElementById('mobile-hamburger-btn');if(h)h.click();}" aria-label="Buka Menu Lengkap">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <span class="bottom-nav-label">Menu</span>
                    </button>

                @elseif($isBendahara)
                    @php
                        $isBeranda = request()->is('sk/das');
                        $isTagihan = request()->is('sk/bt*');
                        $isPembayaran = request()->is('sk/pb*', 'sk/dp*');
                        $isPangkal = request()->is('sk/pp*', 'sk/pd*', 'sk/ppl*');
                    @endphp

                    <a href="/sk/das" class="bottom-nav-item {{ $isBeranda ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <span class="bottom-nav-label">Beranda</span>
                    </a>

                    <a href="/sk/bt" class="bottom-nav-item {{ $isTagihan ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </div>
                        <span class="bottom-nav-label">Tagihan</span>
                    </a>

                    <a href="/sk/pb" class="bottom-nav-item {{ $isPembayaran ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-wallet"></i>
                        </div>
                        <span class="bottom-nav-label">Bayar IPP</span>
                    </a>

                    <a href="/sk/pp" class="bottom-nav-item {{ $isPangkal ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-money-check-dollar"></i>
                        </div>
                        <span class="bottom-nav-label">Pangkal</span>
                    </a>

                    <button type="button" class="bottom-nav-item" onclick="if(window.toggleSiakadSidebar){window.toggleSiakadSidebar();}else{var h=document.getElementById('mobile-hamburger-btn');if(h)h.click();}" aria-label="Buka Menu Lengkap">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <span class="bottom-nav-label">Menu</span>
                    </button>

                @else
                    @php
                        $isBeranda = request()->is('sk/dsg');
                        $isJadwal = request()->is('sk/jadwal-guru*');
                        $isPresensi = request()->is('sk/ass*', 'sk/absensi-walas*');
                        $isNilai = request()->is('sk/nilai-guru*', 'sk/input-nilai-detail*', 'sk/rapor-walas*');
                    @endphp

                    <a href="/sk/dsg" class="bottom-nav-item {{ $isBeranda ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-house"></i>
                        </div>
                        <span class="bottom-nav-label">Beranda</span>
                    </a>

                    <a href="/sk/jadwal-guru" class="bottom-nav-item {{ $isJadwal ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-calendar-week"></i>
                        </div>
                        <span class="bottom-nav-label">Jadwal</span>
                    </a>

                    <a href="/sk/ass" class="bottom-nav-item {{ $isPresensi ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-clipboard-user"></i>
                        </div>
                        <span class="bottom-nav-label">Presensi</span>
                    </a>

                    <a href="/sk/nilai-guru" class="bottom-nav-item {{ $isNilai ? 'active' : '' }}">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <span class="bottom-nav-label">Nilai</span>
                    </a>

                    <button type="button" class="bottom-nav-item" onclick="if(window.toggleSiakadSidebar){window.toggleSiakadSidebar();}else{var h=document.getElementById('mobile-hamburger-btn');if(h)h.click();}" aria-label="Buka Menu Lengkap">
                        <div class="bottom-nav-icon-wrap">
                            <i class="fa-solid fa-bars"></i>
                        </div>
                        <span class="bottom-nav-label">Menu</span>
                    </button>
                @endif

            {{-- ================= ROLE ADMIN ================= --}}
            @elseif($role === 'a')
                @php
                    $isBeranda = request()->is('sk/das');
                    $isSiswa = request()->is('sk/ds*', 'sk/dls/*', 'sk/dts*');
                    $isJadwal = request()->is('sk/kelola-jadwal*', 'sk/edit-jadwal*');
                    $isKeuangan = request()->is('sk/bt*', 'sk/pb*', 'sk/pp*', 'sk/pd*', 'sk/ppl*', 'sk/dp*');
                @endphp

                <a href="/sk/das" class="bottom-nav-item {{ $isBeranda ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <span class="bottom-nav-label">Beranda</span>
                </a>

                <a href="/sk/ds" class="bottom-nav-item {{ $isSiswa ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <span class="bottom-nav-label">Siswa</span>
                </a>

                <a href="/sk/kelola-jadwal" class="bottom-nav-item {{ $isJadwal ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-calendar-alt"></i>
                    </div>
                    <span class="bottom-nav-label">Jadwal</span>
                </a>

                <a href="/sk/pb" class="bottom-nav-item {{ $isKeuangan ? 'active' : '' }}">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <span class="bottom-nav-label">Keuangan</span>
                </a>

                <button type="button" class="bottom-nav-item" onclick="if(window.toggleSiakadSidebar){window.toggleSiakadSidebar();}else{var h=document.getElementById('mobile-hamburger-btn');if(h)h.click();}" aria-label="Buka Menu Lengkap">
                    <div class="bottom-nav-icon-wrap">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <span class="bottom-nav-label">Menu</span>
                </button>
            @endif
        </div>
    </nav>

    <style>
        .siakad-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 999;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-top: 1px solid #e2e8f0;
            box-shadow: 0 -4px 20px rgba(15, 23, 42, 0.08);
            padding-bottom: env(safe-area-inset-bottom, 0px);
            touch-action: manipulation;
        }

        .siakad-bottom-nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-around;
            height: 60px;
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
            padding: 0 4px;
        }

        .bottom-nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            height: 100%;
            color: #64748b;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px 2px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            -webkit-tap-highlight-color: transparent;
        }

        .bottom-nav-item:active {
            transform: scale(0.92);
        }

        .bottom-nav-icon-wrap {
            width: 38px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-size: 17px;
            transition: all 0.2s ease;
        }

        .bottom-nav-label {
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: -0.01em;
            line-height: 1;
            transition: all 0.2s ease;
        }

        /* Active State */
        .bottom-nav-item.active {
            color: #166534;
        }

        .bottom-nav-item.active .bottom-nav-icon-wrap {
            background: #dcfce7;
            color: #166534;
        }

        .bottom-nav-item.active .bottom-nav-label {
            font-weight: 700;
            color: #166534;
        }

        /* Mobile Breakpoint Display */
        @media (max-width: 768px) {
            .siakad-bottom-nav {
                display: block;
            }
            body, .main-content {
                padding-bottom: calc(72px + env(safe-area-inset-bottom, 0px)) !important;
            }
        }
    </style>
@endif


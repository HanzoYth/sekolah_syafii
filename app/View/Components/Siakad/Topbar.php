<?php

namespace App\View\Components\Siakad;

use App\Models\admin;
use App\Models\guru;
use App\Models\siswa;
use App\Models\pengumuman;
use App\Models\wallas;
use App\Models\jadwal_pelajaran;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topbar extends Component
{
    public string $currentName;
    public string $currentPosition;
    public string $currentInitials;
    public ?string $currentPhoto = null;
    public ?string $profileUrl = null;
    public ?string $dashboardUrl = null;
    public ?string $announcementsUrl = null;
    public ?string $userIdentifier = null;
    public bool $isWallas = false;
    public ?string $waliKelasNama = null;
    public mixed $notifications = [];
    public int $notificationCount = 0;

    public function __construct(
        public ?string $name = null,
        public string $position = 'Pengguna SIAKAD',
        public ?string $initials = null,
        public mixed $title = 'SIAKAD',
        public mixed $description = 'Kelola informasi akademik sekolah dalam satu tempat.',
    ) {
        $this->currentName = $name ?? session('nama', 'Pengguna SIAKAD');
        $this->currentPosition = $position;
        $this->currentInitials = $initials ?? 'SK';

        $akunId = session('id_akun');
        $sessionRole = session('role');
        $roleId = session('id');

        $this->notifications = collect();
        $this->notificationCount = 0;

        if ($sessionRole === 'g' || $sessionRole === 'guru') {
            $user = ($akunId ? guru::where('user_id', $akunId)->first() : null) ?: ($roleId ? guru::find($roleId) : null);
            
            $wallasModel = $user ? wallas::with('ruangKelas')->where('guru_id', $user->id)->first() : null;
            $this->isWallas = (bool)$wallasModel;
            $this->waliKelasNama = $wallasModel?->ruangKelas?->nama_ruang;

            $isPengajar = $user ? (($user->guru_tetap || $user->guru_honor) || jadwal_pelajaran::where('guru_id', $user->id)->exists()) : false;

            if ($user && $user->kepala_sekolah == 1) {
                $label = 'Kepala Sekolah';
                $this->dashboardUrl = '/sk/das';
                $this->announcementsUrl = '/sk/kelola-pengumuman';
                $this->userIdentifier = 'Kepala Sekolah';
            } elseif ($user && $user->wakil_sekolah == 1) {
                $label = 'Wakil Kepala Sekolah';
                $this->dashboardUrl = '/sk/das';
                $this->announcementsUrl = '/sk/kelola-pengumuman';
                $this->userIdentifier = 'Wakil Kepala Sekolah';
            } elseif ($user && $user->bendahara == 1) {
                $label = 'Bendahara';
                $this->dashboardUrl = '/sk/das';
                $this->announcementsUrl = '/sk/pengumuman-guru';
                $this->userIdentifier = 'Bendahara Sekolah';
            } elseif ($this->isWallas && $isPengajar) {
                $label = 'Guru & Wali Kelas';
                $this->dashboardUrl = '/sk/dsg';
                $this->announcementsUrl = '/sk/pengumuman-guru';
                $this->userIdentifier = $user?->nip ? 'NIP: ' . $user->nip : ($user?->nuptk ? 'NUPTK: ' . $user->nuptk : 'Guru & Wali Kelas');
            } elseif ($this->isWallas) {
                $label = 'Wali Kelas';
                $this->dashboardUrl = '/sk/dsg';
                $this->announcementsUrl = '/sk/pengumuman-guru';
                $this->userIdentifier = $user?->nip ? 'NIP: ' . $user->nip : ($user?->nuptk ? 'NUPTK: ' . $user->nuptk : 'Wali Kelas');
            } else {
                $label = 'Guru Pengajar';
                $this->dashboardUrl = '/sk/dsg';
                $this->announcementsUrl = '/sk/pengumuman-guru';
                $this->userIdentifier = $user?->nip ? 'NIP: ' . $user->nip : ($user?->nuptk ? 'NUPTK: ' . $user->nuptk : 'Guru Pengajar');
            }

            $this->profileUrl = '/sk/pr';

            if ($user) {
                $this->currentName = $user->nama ?: $this->currentName;
                $this->currentPosition = $label;
                if (!empty($user->url_foto)) {
                    $this->currentPhoto = route('file.show', $user->url_foto) . '?v=' . time();
                }

                $guru_id = $user->id;
                $sekolah_id = $user->sekolah_id;
                $this->notifications = pengumuman::where(function($q) use ($guru_id, $sekolah_id) {
                        $q->where('target_tipe', 'semua')
                        ->orWhere(function($sub) use ($sekolah_id) {
                            $sub->where('target_tipe', 'sekolah');
                            if ($sekolah_id) $sub->where('sekolah_id', $sekolah_id);
                        })
                        ->orWhere(function($sub) {
                            $sub->where('target_tipe', 'role')->whereIn('target_role', ['g', 'all']);
                        })
                        ->orWhere(function($sub) use ($guru_id) {
                            $sub->where('target_tipe', 'spesifik')->where('guru_id', $guru_id);
                        });
                    })
                    ->orderByDesc('tanggal')
                    ->orderByDesc('id')
                    ->take(5)
                    ->get();
                $this->notificationCount = $this->notifications->count();
            }

        } elseif ($sessionRole === 'a' || $sessionRole === 'admin') {
            $user = ($akunId ? admin::where('user_id', $akunId)->first() : null) ?: ($roleId ? admin::find($roleId) : null);
            $label = 'Administrator';
            $this->dashboardUrl = '/sk/das';
            $this->profileUrl = '/gr/prad';
            $this->announcementsUrl = '/sk/kelola-pengumuman';
            $this->userIdentifier = session('username') ?? 'Admin SIAKAD';

            if ($user) {
                $this->currentName = $user->nama ?: $this->currentName;
                $this->currentPosition = $label;
                if (!empty($user->url_foto)) {
                    $this->currentPhoto = route('file.show', $user->url_foto) . '?v=' . time();
                }
            }

            $this->notifications = pengumuman::orderByDesc('tanggal')
                ->orderByDesc('id')
                ->take(5)
                ->get();
            $this->notificationCount = $this->notifications->count();

        } elseif ($sessionRole === 's' || $sessionRole === 'siswa') {
            $user = ($akunId ? siswa::with('kelas')->where('user_id', $akunId)->first() : null) ?: ($roleId ? siswa::with('kelas')->find($roleId) : null);
            $label = 'Siswa';
            $this->dashboardUrl = '/sk/dbs';
            $this->profileUrl = '/sk/pfs';
            $this->announcementsUrl = '/sk/ps';
            $this->userIdentifier = $user?->nis ? 'NIS: ' . $user->nis . ($user?->kelas?->nama_ruang ? ' • ' . $user->kelas->nama_ruang : '') : 'Siswa';

            if ($user) {
                $this->currentName = $user->nama ?: $this->currentName;
                $this->currentPosition = $label;
                if (!empty($user->url_foto)) {
                    $this->currentPhoto = route('file.show', $user->url_foto) . '?v=' . time();
                }

                $siswa_id = $user->id;
                $sekolah_id = $user->sekolah_id;
                $kelas_id = $user->kelas_id;
                $this->notifications = pengumuman::where(function($q) use ($siswa_id, $sekolah_id, $kelas_id) {
                        $q->where('target_tipe', 'semua')
                        ->orWhere(function($sub) use ($sekolah_id) {
                            if ($sekolah_id) {
                                $sub->where('target_tipe', 'sekolah')->where('sekolah_id', $sekolah_id);
                            }
                        })
                        ->orWhere(function($sub) use ($kelas_id) {
                            if ($kelas_id) {
                                $sub->where('target_tipe', 'kelas')->where('kelas_id', $kelas_id);
                            }
                        })
                        ->orWhere(function($sub) {
                            $sub->where('target_tipe', 'role')->whereIn('target_role', ['s', 'all']);
                        })
                        ->orWhere(function($sub) use ($siswa_id) {
                            $sub->where('target_tipe', 'spesifik')->where('siswa_id', $siswa_id);
                        });
                    })
                    ->orderByDesc('tanggal')
                    ->orderByDesc('id')
                    ->take(5)
                    ->get();
                $this->notificationCount = $this->notifications->count();
            }
        }

        if ($this->currentName) {
            $words = preg_split('/\s+/', trim($this->currentName));
            $this->currentInitials = strtoupper(
                mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '')
            );
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.siakad.topbar-profile');
    }
}

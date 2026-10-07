<?php

namespace App\View\Components\Siakad;

use App\Models\admin;
use App\Models\guru;
use App\Models\siswa;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Topbar extends Component
{
    public string $currentName;
    public string $currentPosition;
    public string $currentInitials;
    public ?string $currentPhoto = null;

    public function __construct(
        public ?string $name = null,
        public string $position = 'Pengguna SIAKAD',
        public ?string $initials = null,
        public string $title = 'SIAKAD',
        public string $description = 'Kelola informasi akademik sekolah dalam satu tempat.',
    ) {
        $this->currentName = $name ?? session('nama', 'Pengguna SIAKAD');
        $this->currentPosition = $position;
        $this->currentInitials = $initials ?? 'SK';

        $akunId = session('id_akun');
        $role = session('role');

        if ($akunId) {
            $user = null;
            $label = null;

            if ($role === 'g' || $role === 'guru') {
                $user = guru::where('user_id', $akunId)->first();
                $label = 'Guru Pengajar';
            } elseif ($role === 'a' || $role === 'admin') {
                $user = admin::where('user_id', $akunId)->first();
                $label = 'Administrator';
            } elseif ($role === 's' || $role === 'siswa') {
                $user = siswa::where('user_id', $akunId)->first();
                $label = 'Siswa';
            }

            if ($user) {
                $this->currentName = $user->nama ?: $this->currentName;
                $this->currentPosition = $label;
                if (!empty($user->url_foto)) {
                    $this->currentPhoto = route('file.show', $user->url_foto) . '?v=' . time();
                }
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

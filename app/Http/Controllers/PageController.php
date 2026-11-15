<?php

namespace App\Http\Controllers;

use App\Models\page_content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PageController extends Controller
{
    private function normalizePageKey(?string $rawKey): string
    {
        $raw = trim((string) $rawKey);
        if ($raw === '' || $raw === '/') {
            return '/';
        }

        if (str_starts_with($raw, '/prof')) {
            $query = parse_url($raw, PHP_URL_QUERY) ?? '';
            parse_str($query, $params);
            $halaman = strtolower((string) ($params['halaman'] ?? 'profil'));

            return match ($halaman) {
                'program', 'pendidikan', 'akademik' => '/prof?halaman=program',
                'galeri', 'kegiatan', 'prestasi'    => '/prof?halaman=galeri',
                'ppdb', 'pendaftaran'               => '/prof?halaman=ppdb',
                'kontak', 'lokasi'                  => '/prof?halaman=kontak',
                default                             => '/prof?halaman=profil',
            };
        }

        return substr($raw, 0, 120);
    }

    private function getPublishedPageContent(string $pageKey): ?array
    {
        try {
            if (!Schema::hasTable('page_contents')) {
                return null;
            }
            $record = page_content::where('page_key', $this->normalizePageKey($pageKey))->first();
            if (!$record || empty($record->content_json)) {
                return null;
            }
            $decoded = json_decode($record->content_json, true);
            return is_array($decoded) ? $decoded : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function sanitizeRichHtml(?string $html): string
    {
        $clean = (string) $html;
        $clean = preg_replace('#<(script|iframe|object|embed|style|link|meta)\b[^>]*>.*?</\1>#is', '', $clean);
        $clean = preg_replace('#<(script|iframe|object|embed|style|link|meta)\b[^>]*\/?>#is', '', $clean);
        $clean = preg_replace('/\son[a-z]+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/is', '', $clean);
        $clean = preg_replace('/(href|src)\s*=\s*("|\')\s*(javascript|vbscript|data:text\/html)[^"\']*\2/is', '$1="#"', $clean);
        return $clean;
    }

    private function sanitizePlain(?string $text, int $max = 300): string
    {
        return mb_substr(trim(strip_tags((string) $text)), 0, $max);
    }

    private function sanitizeIconClass(?string $icon): string
    {
        $val = trim((string) $icon);
        if (preg_match('/^fa-(solid|regular|brands)\s+fa-[a-z0-9-]+$/', $val)) {
            return $val;
        }
        return 'fa-solid fa-star';
    }

    private function sanitizeMediaSrc(?string $src): string
    {
        $val = trim((string) $src);
        if ($val === '') {
            return '';
        }
        if (preg_match('#^data:image/(png|jpe?g|gif|webp);base64,[A-Za-z0-9+/=]+$#i', $val)) {
            return $val;
        }
        if (str_starts_with($val, '/') || preg_match('#^https?://#i', $val)) {
            return str_ireplace('javascript:', '', $val);
        }
        return '';
    }

    private function sanitizeEditorPayload(array $raw): array
    {
        $texts = [];
        if (isset($raw['texts']) && is_array($raw['texts'])) {
            foreach ($raw['texts'] as $k => $v) {
                $key = $this->sanitizePlain((string) $k, 120);
                if ($key !== '' && is_scalar($v)) {
                    $texts[$key] = $this->sanitizeRichHtml((string) $v);
                }
            }
        }

        $images = [];
        if (isset($raw['images']) && is_array($raw['images'])) {
            foreach ($raw['images'] as $k => $v) {
                $key = $this->sanitizePlain((string) $k, 120);
                $safeSrc = is_scalar($v) ? $this->sanitizeMediaSrc((string) $v) : '';
                if ($key !== '' && $safeSrc !== '') {
                    $images[$key] = $safeSrc;
                }
            }
        }

        $icons = [];
        if (isset($raw['icons']) && is_array($raw['icons'])) {
            foreach ($raw['icons'] as $k => $v) {
                $key = $this->sanitizePlain((string) $k, 120);
                if ($key !== '' && is_scalar($v)) {
                    $icons[$key] = $this->sanitizeIconClass((string) $v);
                }
            }
        }

        $addedItems = [];
        if (isset($raw['added_items']) && is_array($raw['added_items'])) {
            foreach ($raw['added_items'] as $item) {
                if (!is_array($item)) {
                    continue;
                }
                $id = $this->sanitizePlain($item['id'] ?? '', 80);
                $containerKey = $this->sanitizePlain($item['containerKey'] ?? '', 120);
                $type = $this->sanitizePlain($item['type'] ?? '', 40);
                if ($id === '' || $containerKey === '' || $type === '') {
                    continue;
                }
                $addedItems[] = [
                    'id'           => $id,
                    'containerKey' => $containerKey,
                    'type'         => $type,
                    'category'     => $this->sanitizePlain($item['category'] ?? 'tahfizh', 40),
                    'badge'        => $this->sanitizePlain($item['badge'] ?? '', 80),
                    'title'        => $this->sanitizeRichHtml($item['title'] ?? ''),
                    'desc'         => $this->sanitizeRichHtml($item['desc'] ?? ''),
                    'tag'          => $this->sanitizePlain($item['tag'] ?? '', 80),
                    'time'         => $this->sanitizePlain($item['time'] ?? '', 80),
                    'code'         => $this->sanitizePlain($item['code'] ?? '', 20),
                    'num'          => $this->sanitizePlain($item['num'] ?? '', 30),
                    'icon'         => $this->sanitizeIconClass($item['icon'] ?? 'fa-solid fa-star'),
                    'image'        => $this->sanitizeMediaSrc($item['image'] ?? ''),
                ];
            }
        }

        // Card bawaan tidak diperbolehkan dihapus; hanya card tambahan admin yang dapat dihapus dari added_items
        return [
            'texts'         => $texts,
            'images'        => $images,
            'icons'         => $icons,
            'added_items'   => $addedItems,
            'removed_items' => [],
        ];
    }

    public function tampilan_welcome()
    {
        $editorPageKey = '/';
        $publishedPageContent = $this->getPublishedPageContent($editorPageKey);
        return view("welcome", compact('editorPageKey', 'publishedPageContent'));
    }

    public function tampilan_modul()
    {
        if (session("hasLogin")) {
            return view("modul/modul");
        }
        return redirect("/reg");
    }

    public function tampilan_profile_sekolah(Request $request)
    {
        $halaman = strtolower((string) $request->query('halaman', 'profil'));
        $editorPageKey = $this->normalizePageKey('/prof?halaman=' . $halaman);
        $publishedPageContent = $this->getPublishedPageContent($editorPageKey);

        return match ($halaman) {
            'program', 'pendidikan', 'akademik' => view("halaman_program", compact('editorPageKey', 'publishedPageContent')),
            'galeri', 'kegiatan', 'prestasi'    => view("halaman_galeri", compact('editorPageKey', 'publishedPageContent')),
            'ppdb', 'pendaftaran'               => view("halaman_ppdb", compact('editorPageKey', 'publishedPageContent')),
            'kontak', 'lokasi'                  => view("halaman_kontak", compact('editorPageKey', 'publishedPageContent')),
            default                             => view("profile_sekolah", compact('editorPageKey', 'publishedPageContent')),
        };
    }

    public function tampilan_program()
    {
        $editorPageKey = '/prof?halaman=program';
        $publishedPageContent = $this->getPublishedPageContent($editorPageKey);
        return view("halaman_program", compact('editorPageKey', 'publishedPageContent'));
    }

    public function tampilan_galeri()
    {
        $editorPageKey = '/prof?halaman=galeri';
        $publishedPageContent = $this->getPublishedPageContent($editorPageKey);
        return view("halaman_galeri", compact('editorPageKey', 'publishedPageContent'));
    }

    public function tampilan_ppdb()
    {
        $editorPageKey = '/prof?halaman=ppdb';
        $publishedPageContent = $this->getPublishedPageContent($editorPageKey);
        return view("halaman_ppdb", compact('editorPageKey', 'publishedPageContent'));
    }

    public function tampilan_kontak()
    {
        $editorPageKey = '/prof?halaman=kontak';
        $publishedPageContent = $this->getPublishedPageContent($editorPageKey);
        return view("halaman_kontak", compact('editorPageKey', 'publishedPageContent'));
    }

    public function simpanKontenEditor(Request $request)
    {
        if (!session('hasLogin') || !in_array(session('role'), ['a', 'admin'])) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Hanya Administrator yang dapat mempublikasikan perubahan halaman.'
            ], 403);
        }

        $request->validate([
            'page_key' => 'required|string|max:120',
            'content'  => 'required|array',
        ]);

        $pageKey = $this->normalizePageKey($request->input('page_key'));
        $sanitized = $this->sanitizeEditorPayload($request->input('content', []));

        page_content::updateOrCreate(
            ['page_key' => $pageKey],
            [
                'content_json' => json_encode($sanitized, JSON_UNESCAPED_UNICODE),
                'updated_by'   => (string) (session('nama') ?? 'Admin'),
            ]
        );

        return response()->json([
            'success'  => true,
            'message'  => 'Perubahan konten & bagian halaman berhasil dipublikasikan ke database!',
            'page_key' => $pageKey,
        ]);
    }

    public function resetKontenEditor(Request $request)
    {
        if (!session('hasLogin') || !in_array(session('role'), ['a', 'admin'])) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak.'
            ], 403);
        }

        $request->validate([
            'page_key' => 'required|string|max:120',
        ]);

        $pageKey = $this->normalizePageKey($request->input('page_key'));
        page_content::where('page_key', $pageKey)->delete();

        return response()->json([
            'success'  => true,
            'message'  => 'Konten halaman berhasil dikembalikan ke versi bawaan.',
            'page_key' => $pageKey,
        ]);
    }
}

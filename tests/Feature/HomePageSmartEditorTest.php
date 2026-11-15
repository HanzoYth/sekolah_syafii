<?php

namespace Tests\Feature;

use App\Http\Controllers\PageController;
use App\Models\page_content;
use Illuminate\Http\Request;
use Tests\TestCase;

class HomePageSmartEditorTest extends TestCase
{
    private array $backupRows = [];
    private array $touchedKeys = ['/', '/prof?halaman=galeri', '/prof?halaman=program', '/prof?halaman=profil', '/prof?halaman=ppdb', '/prof?halaman=kontak'];

    protected function setUp(): void
    {
        parent::setUp();

        foreach ($this->touchedKeys as $key) {
            $existing = page_content::where('page_key', $key)->first();
            $this->backupRows[$key] = $existing ? $existing->toArray() : null;
        }
    }

    protected function tearDown(): void
    {
        session()->flush();

        foreach ($this->touchedKeys as $key) {
            page_content::where('page_key', $key)->delete();
            if (!empty($this->backupRows[$key])) {
                page_content::create([
                    'page_key'     => $this->backupRows[$key]['page_key'],
                    'content_json' => $this->backupRows[$key]['content_json'],
                    'updated_by'   => $this->backupRows[$key]['updated_by'],
                ]);
            }
        }

        parent::tearDown();
    }

    public function test_public_pages_render_hydrate_without_admin_widget_for_visitors(): void
    {
        $urls = [
            '/',
            '/prof?halaman=profil',
            '/prof?halaman=program',
            '/prof?halaman=galeri',
            '/prof?halaman=ppdb',
            '/prof?halaman=kontak',
        ];

        foreach ($urls as $url) {
            $res = $this->get($url);
            $res->assertStatus(200);
            $res->assertSee('syafiiPublishedEditorData', false);
            $res->assertSee('syafiiEditorMeta', false);
            $res->assertSee('SyafiiPageState', false);
            $res->assertSee('SyafiiRefreshDynamicHooks', false);
            $res->assertDontSee('id="adminFloatingWidget"', false);
        }
    }

    public function test_admin_session_renders_smart_editor_with_add_controls_and_modals(): void
    {
        $urls = ['/', '/prof?halaman=galeri', '/prof?halaman=program'];

        foreach ($urls as $url) {
            $res = $this->withSession([
                'hasLogin' => true,
                'role'     => 'a',
                'nama'     => 'Admin Tester',
            ])->get($url);

            $res->assertStatus(200);
            $res->assertSee('id="adminFloatingWidget"', false);
            $res->assertSee('id="adminEditorPopupCard"', false);
            $res->assertSee('id="btnQuickAddGallery"', false);
            $res->assertSee('id="btnQuickAddProgram"', false);
            $res->assertSee('id="btnQuickAddFacility"', false);
            $res->assertDontSee('id="btnQuickAddNewSection"', false);
            $res->assertDontSee('openAddSectionModal', false);
            $res->assertSee('id="btnSavePublishEditor"', false);
            $res->assertSee('id="btnResetEditorDefault"', false);
            $res->assertSee('id="adminAddModalBackdrop"', false);
            $res->assertSee('id="adminIconPickerModalBackdrop"', false);
            $res->assertSee('id="adminConfirmModalBackdrop"', false);
            $res->assertSee('ensureBooted()', false);
            $res->assertSee('openEditItemModal', false);
            $res->assertSee('fa-pen-to-square', false);
            $res->assertSee('if (isAddedItem)', false);
            $res->assertSee('Card bawaan halaman tidak dapat dihapus', false);
            $res->assertDontSee('var StateEngine = window.SyafiiPageState;' . "\n" . '        if (!StateEngine) return;', false);
        }
    }

    public function test_non_admin_cannot_publish_or_reset_page_editor_content(): void
    {
        $controller = new PageController();
        $payload = [
            'page_key' => '/',
            'content'  => [
                'texts' => ['txt_0_h1' => 'Unauthorized Edit'],
            ],
        ];

        // 1. Tamu (belum login)
        session()->flush();
        $resGuest = $controller->simpanKontenEditor(Request::create('/page-editor/simpan', 'POST', $payload));
        $this->assertEquals(403, $resGuest->getStatusCode());

        // 2. Guru / Siswa tidak boleh mempublikasikan
        foreach (['g', 's'] as $role) {
            session(['hasLogin' => true, 'role' => $role, 'nama' => 'Non Admin']);
            $resSave = $controller->simpanKontenEditor(Request::create('/page-editor/simpan', 'POST', $payload));
            $this->assertEquals(403, $resSave->getStatusCode());

            $resReset = $controller->resetKontenEditor(Request::create('/page-editor/reset', 'POST', ['page_key' => '/']));
            $this->assertEquals(403, $resReset->getStatusCode());
        }
    }

    public function test_admin_can_publish_added_items_custom_sections_and_sanitize_xss_then_visible_to_visitors(): void
    {
        page_content::where('page_key', '/')->delete();
        session(['hasLogin' => true, 'role' => 'a', 'nama' => 'Super Admin']);

        $controller = new PageController();
        $req = Request::create('/page-editor/simpan', 'POST', [
            'page_key' => '/',
            'content'  => [
                'texts' => [
                    'txt_0_h1' => '<script>alert("xss")</script>Sekolah Islam Unggulan',
                ],
                'images' => [
                    'img_0' => 'data:image/jpeg;base64,AQIDBA==',
                    'img_1' => 'javascript:alert(1)',
                ],
                'icons' => [
                    'ico_0' => 'fa-solid fa-mosque',
                    'ico_1' => 'invalid-class" onclick="alert(1)',
                ],
                'added_items' => [
                    [
                        'id'           => 'itm_kegiatan_1',
                        'containerKey' => 'ctr_kegiatan',
                        'type'         => 'gallery',
                        'category'     => 'tahfizh',
                        'badge'        => 'Dokumentasi Baru',
                        'title'        => 'Wisuda Tahfizh Angkatan V<script>evil()</script>',
                        'desc'         => 'Penganugerahan syahadah hafalan 30 Juz.',
                        'icon'         => 'fa-solid fa-book-quran',
                        'image'        => '/img/ft_2.jpeg',
                    ],
                    [
                        'id'           => 'itm_program_1',
                        'containerKey' => 'ctr_program',
                        'type'         => 'program',
                        'title'        => 'Program Bahasa Arab Intensif',
                        'desc'         => 'Muhadatsah harian dengan pembimbing.',
                        'tag'          => 'Program Baru',
                        'icon'         => 'fa-solid fa-language',
                    ],
                    [
                        'id'           => 'itm_fasilitas_1',
                        'containerKey' => 'ctr_fasilitas',
                        'type'         => 'card_icon',
                        'title'        => 'Laboratorium Komputer',
                        'desc'         => 'Fasilitas praktik TIK untuk santri.',
                        'icon'         => 'fa-solid fa-laptop-code',
                    ],
                ],
                'removed_items' => ['static_ctr_0_check_0'],
                'custom_sections' => [
                    [
                        'id'            => 'sec_ekskul_1',
                        'layout'        => 'cards',
                        'theme'         => 'alt',
                        'afterSelector' => 'ssec_2',
                        'containerKey'  => 'secgrid_sec_ekskul_1',
                        'eyebrow'       => 'Pengumuman Ekskul',
                        'icon'          => 'fa-solid fa-campground',
                        'title'         => 'Ekstrakurikuler &amp; Rihlah Santri',
                        'subtitle'      => 'Kegiatan pengembangan bakat di luar jam kelas.',
                    ],
                ],
            ],
        ]);

        $res = $controller->simpanKontenEditor($req);
        $this->assertEquals(200, $res->getStatusCode());
        $json = $res->getData(true);
        $this->assertTrue($json['success']);

        $row = page_content::where('page_key', '/')->first();
        $this->assertNotNull($row);
        $saved = json_decode($row->content_json, true);

        $this->assertSame('Sekolah Islam Unggulan', $saved['texts']['txt_0_h1']);
        $this->assertSame('data:image/jpeg;base64,AQIDBA==', $saved['images']['img_0']);
        $this->assertArrayNotHasKey('img_1', $saved['images']);
        $this->assertSame('fa-solid fa-mosque', $saved['icons']['ico_0']);
        $this->assertSame('fa-solid fa-star', $saved['icons']['ico_1']);
        $this->assertCount(3, $saved['added_items']);
        $this->assertSame('Wisuda Tahfizh Angkatan V', $saved['added_items'][0]['title']);
        $this->assertArrayNotHasKey('custom_sections', $saved);
        $this->assertSame([], $saved['removed_items']);

        // Pengunjung biasa melihat data terpublikasi dari DB
        session()->flush();
        $visitorRes = $this->get('/');
        $visitorRes->assertStatus(200);
        $visitorRes->assertSee('Wisuda Tahfizh Angkatan V', false);
        $visitorRes->assertSee('Program Bahasa Arab Intensif', false);
        $visitorRes->assertSee('Laboratorium Komputer', false);
        $visitorRes->assertDontSee('Ekstrakurikuler &amp; Rihlah Santri', false);
        $visitorRes->assertDontSee('alert("xss")', false);
        $visitorRes->assertDontSee('evil()', false);
        $visitorRes->assertDontSee('id="adminFloatingWidget"', false);
    }

    public function test_subpage_galeri_persists_with_key_normalization_and_reset_clears_db(): void
    {
        page_content::where('page_key', '/prof?halaman=galeri')->delete();
        session(['hasLogin' => true, 'role' => 'a', 'nama' => 'Admin Sekolah']);

        $controller = new PageController();
        $saveRes = $controller->simpanKontenEditor(Request::create('/page-editor/simpan', 'POST', [
            'page_key' => '/prof?halaman=kegiatan',
            'content'  => [
                'added_items' => [
                    [
                        'id'           => 'itm_gal_sub_1',
                        'containerKey' => 'ctr_gal',
                        'type'         => 'gallery',
                        'title'        => 'Lomba Pidato Bahasa Arab',
                        'desc'         => 'Santri menampilkan khitobah berbahasa Arab.',
                        'image'        => '/img/foto_1.jpeg',
                    ],
                ],
            ],
        ]));

        $this->assertEquals(200, $saveRes->getStatusCode());
        $this->assertSame('/prof?halaman=galeri', $saveRes->getData(true)['page_key']);

        session()->flush();
        $pageRes = $this->get('/prof?halaman=galeri');
        $pageRes->assertStatus(200);
        $pageRes->assertSee('Lomba Pidato Bahasa Arab', false);

        session(['hasLogin' => true, 'role' => 'a', 'nama' => 'Admin Sekolah']);
        $resetRes = $controller->resetKontenEditor(Request::create('/page-editor/reset', 'POST', [
            'page_key' => '/prof?halaman=galeri',
        ]));

        $this->assertEquals(200, $resetRes->getStatusCode());
        $this->assertNull(page_content::where('page_key', '/prof?halaman=galeri')->first());

        session()->flush();
        $afterReset = $this->get('/prof?halaman=galeri');
        $afterReset->assertStatus(200);
        $afterReset->assertDontSee('Lomba Pidato Bahasa Arab', false);
    }
}

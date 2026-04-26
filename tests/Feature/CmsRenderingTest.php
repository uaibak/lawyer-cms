<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CmsRenderingTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders_sections_from_database(): void
    {
        $page = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'meta_title' => 'Home',
            'meta_description' => 'Homepage',
        ]);

        Section::create([
            'page_id' => $page->id,
            'type' => 'hero',
            'sort_order' => 1,
            'content' => json_encode([
                'heading' => 'Best Criminal Lawyer',
                'subheading' => '10+ Years Experience',
            ]),
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Best Criminal Lawyer');
    }

    public function test_admin_middleware_redirects_guests_to_login(): void
    {
        $response = $this->get(route('admin.pages.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_create_page(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title' => 'About Us',
            'slug' => '',
            'meta_title' => 'About Us',
            'meta_description' => 'About page',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('pages', [
            'title' => 'About Us',
            'slug' => 'about-us',
        ]);
    }

    public function test_admin_can_create_section_from_structured_fields(): void
    {
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        $page = Page::create([
            'title' => 'Home',
            'slug' => 'home',
            'meta_title' => 'Home',
            'meta_description' => 'Homepage',
        ]);

        $response = $this->actingAs($admin)->post(route('admin.pages.sections.store', $page), [
            'type' => 'services',
            'sort_order' => 1,
            'content_fields' => [
                'title' => 'Practice Areas',
                'items' => [
                    [
                        'title' => 'Family Law',
                        'description' => 'Support for custody and divorce matters.',
                    ],
                    [
                        'title' => 'Criminal Defense',
                        'description' => 'Representation from investigation through trial.',
                    ],
                ],
            ],
        ]);

        $response->assertRedirect(route('admin.pages.edit', $page));

        $section = Section::query()->where('page_id', $page->id)->firstOrFail();

        $this->assertSame('services', $section->type);
        $this->assertSame('Practice Areas', $section->contentData()['title']);
        $this->assertCount(2, $section->contentData()['items']);
    }
}

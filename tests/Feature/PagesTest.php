<?php

namespace Tests\Feature;

use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Portfolio;
use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\PortfolioProject;
use App\Notifications\NewContactSubmission;
use App\Support\Catalog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    private function catalog(): Catalog
    {
        return app(Catalog::class);
    }

    public function test_about_portfolio_and_contact_have_one_h1(): void
    {
        foreach (['/about', '/portfolio', '/contact'] as $uri) {
            $html = $this->get($uri)->assertOk()->getContent();

            $this->assertSame(1, substr_count($html, '<h1'), "{$uri} must have exactly one h1");
        }
    }

    public function test_about_keeps_the_removed_claims_out(): void
    {
        $html = $this->get('/about')->getContent();

        $this->assertStringContainsString('Founded in Beirut', $html);
        foreach (['Fast Turnaround', 'guarantee', 'Our Team', 'Our Mission', 'Our Vision', 'Our Values'] as $removed) {
            $this->assertStringNotContainsString($removed, $html);
        }
    }

    public function test_portfolio_shows_the_four_products_with_demo_links_and_no_pos_pro(): void
    {
        $html = $this->get('/portfolio')->assertOk()->getContent();

        foreach ($this->catalog()->products() as $product) {
            $this->assertStringContainsString($product['name'], $html);
            $this->assertStringContainsString('From ' . $product['price']['from'], $html);
            $this->assertStringContainsString('href="' . $product['demo']['url'] . '" target="_blank" rel="noopener"', $html);
        }
        $this->assertStringNotContainsString('POS Pro', $html);
    }

    public function test_portfolio_empty_state_has_the_design_copy_and_not_the_admin_note(): void
    {
        $html = $this->get('/portfolio')->getContent();

        $this->assertStringContainsString('Client case studies are on the way.', $html);
        $this->assertStringNotContainsString('When a project is added in the admin', $html);
    }

    public function test_portfolio_filter_chips_use_the_catalog_labels(): void
    {
        $html = $this->get('/portfolio')->getContent();

        foreach ($this->catalog()->portfolioCategories() as $value => $label) {
            $this->assertStringContainsString("filterByCategory('{$value}')", $html);
            $this->assertStringContainsString($label, $html);
        }
        $this->assertSame(array_keys($this->catalog()->portfolioCategories()), array_values(array_intersect(
            array_keys($this->catalog()->portfolioCategories()),
            config('products.portfolio_categories')
        )));
        $this->assertEqualsCanonicalizing(config('products.portfolio_categories'), array_keys($this->catalog()->portfolioCategories()));
    }

    public function test_portfolio_lists_client_projects_filters_and_opens_the_modal(): void
    {
        PortfolioProject::create(['title' => 'Corner Shop till', 'description' => 'A till for a corner shop.', 'category' => 'pos', 'technologies' => ['Laravel'], 'featured' => false]);
        PortfolioProject::create(['title' => 'Brand site', 'description' => 'A company website.', 'category' => 'web', 'technologies' => ['Livewire'], 'featured' => false]);

        $component = Livewire::test(Portfolio::class)
            ->assertSee('Corner Shop till')
            ->assertSee('Brand site')
            ->assertSee('LebaSouk POS')
            ->assertDontSee('Client case studies are on the way.')
            ->call('filterByCategory', 'pos')
            ->assertSee('Corner Shop till')
            ->assertDontSee('Brand site');

        $component->call('viewProject', PortfolioProject::where('title', 'Corner Shop till')->value('id'))
            ->assertSeeHtml('role="dialog"')
            ->assertSeeHtml('aria-modal="true"')
            ->call('closeModal')
            ->assertDontSeeHtml('role="dialog"');
    }

    public function test_changing_the_category_goes_back_to_page_one(): void
    {
        Livewire::test(Portfolio::class)
            ->set('paginators.page', 2)
            ->call('filterByCategory', 'pos')
            ->assertSet('paginators.page', 1)
            ->set('paginators.page', 2)
            ->call('clearFilters')
            ->assertSet('category', 'all')
            ->assertSet('paginators.page', 1);
    }

    public function test_contact_options_come_from_the_catalog(): void
    {
        $html = $this->get('/contact')->getContent();

        $labels = $this->catalog()->projectTypeLabels();
        $this->assertEqualsCanonicalizing($this->catalog()->projectTypes(), array_keys($labels));

        foreach ($this->catalog()->projectTypes() as $type) {
            $this->assertStringContainsString('<option value="' . $type . '">' . $labels[$type] . '</option>', $html);
        }
    }

    public function test_contact_preselects_type_and_plan_from_the_query(): void
    {
        Livewire::withQueryParams(['type' => 'pos', 'plan' => 'Standard'])
            ->test(Contact::class)
            ->assertSet('project_type', 'pos')
            ->assertSet('message', "I'm interested in the Standard plan.");
    }

    public function test_contact_form_saves_every_project_type(): void
    {
        Notification::fake();

        foreach ($this->catalog()->projectTypes() as $type) {
            RateLimiter::clear('contact-form:127.0.0.1');

            Livewire::test(Contact::class)
                ->set('name', 'Test Person')
                ->set('email', 'person@example.com')
                ->set('project_type', $type)
                ->set('message', "A message about the {$type} option.")
                ->call('submit')
                ->assertHasNoErrors();

            $this->assertDatabaseHas('contact_submissions', ['project_type' => $type, 'message' => "A message about the {$type} option."]);
        }

        $this->assertSame(count($this->catalog()->projectTypes()), ContactSubmission::count());
    }

    public function test_contact_rejects_an_unknown_type_and_marks_fields_for_assistive_tech(): void
    {
        Livewire::test(Contact::class)
            ->set('name', 'Test Person')
            ->set('email', 'person@example.com')
            ->set('project_type', 'mobile_app')
            ->set('message', 'A long enough message.')
            ->call('submit')
            ->assertHasErrors(['project_type']);

        $html = Livewire::test(Contact::class)->call('submit')->html();

        $this->assertStringContainsString('aria-invalid="true"', $html);
        $this->assertStringContainsString('aria-describedby="name-error"', $html);
        $this->assertStringContainsString('id="name-error"', $html);
        $this->assertStringContainsString('<label for="name">', $html);
    }

    public function test_contact_faq_numbers_come_from_the_catalog(): void
    {
        $care = $this->catalog()->maintenance();
        $prices = array_column($care['plans'], 'price');

        $this->get('/contact')
            ->assertSee('Maintenance plans run from ' . $prices[0] . ' to ' . end($prices) . ' a month, with a minimum of ' . $care['minimum_months'] . ' months.')
            ->assertSee('A ShopNex store takes 4 to 14 weeks');
    }

    public function test_legal_pages_do_not_mention_pos_pro_and_terms_describe_each_product(): void
    {
        foreach (['/terms-of-service', '/privacy-policy'] as $uri) {
            $this->get($uri)->assertOk()->assertDontSee('POS Pro');
        }

        $text = preg_replace('/\s+/', ' ', strip_tags($this->get('/terms-of-service')->getContent()));

        $this->assertStringContainsString('Custom projects and ShopNex are paid 50% before development begins, 30% on delivery and 20% after training or handover.', $text);
        $this->assertStringContainsString('Tymelo is a one-time setup fee followed by a monthly fee.', $text);
        $this->assertStringContainsString('CarteNex', $text);
    }

    public function test_blog_pages_render_with_escaped_content_and_the_footer_newsletter(): void
    {
        $post = BlogPost::create([
            'title' => 'A test article',
            'excerpt' => 'Short excerpt.',
            'content' => '<script>alert(1)</script> Plain text',
            'author' => 'Build Syntax',
            'published' => true,
            'published_at' => now()->subDay(),
        ]);

        $index = $this->get('/blog')->assertOk()->assertSee('A test article');
        $this->assertSame(1, substr_count($index->getContent(), '<h1'));

        $show = $this->get(route('blog.show', $post->slug))->assertOk();
        $html = $show->getContent();

        $this->assertSame(1, substr_count($html, '<h1'));
        $this->assertStringContainsString('&lt;script&gt;alert(1)&lt;/script&gt;', $html);
        $this->assertStringNotContainsString('<script>alert(1)</script>', $html);
        $this->assertStringContainsString('class="post-body"', $html);
        // The full newsletter card is gone from the blog; the compact footer form is the only one.
        $this->assertStringNotContainsString('Subscribe to Our Newsletter', $html);
        $this->assertSame(1, substr_count($html, 'wire:submit.prevent="subscribe"'));
    }

    public function test_newsletter_status_pages_render(): void
    {
        $this->get('/newsletter/confirm/not-a-real-token')->assertOk()->assertSee('Confirmation Failed');
        $this->get('/newsletter/unsubscribe/not-a-real-token')->assertOk()->assertSee('Invalid unsubscribe link');
    }

    public function test_every_redesigned_page_has_one_organization_json_ld_block_and_no_fade_in_above_the_fold(): void
    {
        foreach (['/about', '/portfolio', '/contact', '/blog', '/privacy-policy', '/terms-of-service'] as $uri) {
            $html = $this->get($uri)->getContent();

            $this->assertSame(1, substr_count($html, 'application/ld+json'), $uri);

            $firstSection = strpos($html, '<h1');
            $this->assertStringNotContainsString('fade-in', substr($html, 0, $firstSection + 400), $uri);
        }
    }
}

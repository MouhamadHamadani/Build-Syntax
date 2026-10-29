<?php

namespace Tests\Feature;

use App\Models\CatalogPlan;
use App\Models\CatalogService;
use App\Models\ContactSubmission;
use App\Support\Catalog;
use App\Support\CatalogSource\ConfigCatalogRepository;
use App\Support\CatalogSource\DatabaseCatalogRepository;
use Database\Seeders\CatalogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Livewire\Livewire;
use Tests\TestCase;

class CatalogDatabaseTest extends TestCase
{
    use RefreshDatabase;

    private const METHODS = ['products', 'custom', 'hosting', 'maintenance', 'projectTypes', 'projectTypeLabels', 'portfolioCategories'];

    private function useDatabase(bool $seed = true): void
    {
        if ($seed) {
            $this->seed(CatalogSeeder::class);
        }

        config(['catalog.source' => 'database']);
        DatabaseCatalogRepository::flush();
    }

    /** Visible text of a page: no markup, scripts or styles, whitespace collapsed. */
    private function text(string $uri): string
    {
        $html = $this->get($uri)->assertOk()->getContent();
        $html = preg_replace('#<(script|style)\b.*?</\1>#is', '', $html);
        $html = preg_replace('#<!--.*?-->#s', '', $html);

        return trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags(str_replace('>', '> ', $html)))));
    }

    // --- Parity: the database source changes nothing for visitors -------------------------------

    public function test_every_catalog_method_returns_the_same_array_from_the_database_as_from_config(): void
    {
        $this->useDatabase();
        $config = new ConfigCatalogRepository;
        $catalog = app(Catalog::class);

        foreach (self::METHODS as $method) {
            $this->assertSame(
                json_encode($config->$method()),
                json_encode($catalog->$method()),
                "Catalog::{$method}() differs between config and database",
            );
            $this->assertEquals($config->$method(), $catalog->$method(), $method);
        }
    }

    public function test_public_pages_render_the_same_text_from_both_sources(): void
    {
        $pages = ['/', '/services', '/portfolio', '/contact', '/about'];

        $fromConfig = array_map(fn ($uri) => $this->text($uri), $pages);

        $this->useDatabase();

        foreach ($pages as $i => $uri) {
            $this->assertSame($fromConfig[$i], $this->text($uri), "{$uri} renders different text from the database");
        }
    }

    public function test_seeding_twice_does_not_duplicate_anything(): void
    {
        $this->seed(CatalogSeeder::class);
        $counts = [CatalogService::count(), CatalogPlan::count(), \App\Models\CatalogPlanFeature::count()];

        $this->seed(CatalogSeeder::class);

        $this->assertSame($counts, [CatalogService::count(), CatalogPlan::count(), \App\Models\CatalogPlanFeature::count()]);
        $this->assertSame(7, $counts[0]);
    }

    public function test_the_seed_keeps_prices_exactly_as_written(): void
    {
        $this->seed(CatalogSeeder::class);

        $prices = CatalogPlan::pluck('price')->all();

        foreach (['$349', '$19', 'From $800', 'Contact us', 'Custom quote', '$1,200'] as $price) {
            $this->assertContains($price, $prices);
        }
    }

    // --- Source selection and fallback ---------------------------------------------------------

    public function test_config_is_the_default_source(): void
    {
        $this->assertSame('config', config('catalog.source'));
        $this->assertInstanceOf(ConfigCatalogRepository::class, app(\App\Support\CatalogSource\CatalogRepository::class));
    }

    public function test_empty_tables_fall_back_to_config_and_log_a_warning(): void
    {
        Log::spy();
        $this->useDatabase(seed: false);

        $this->assertSame((new ConfigCatalogRepository)->products(), app(Catalog::class)->products());
        $this->assertSame((new ConfigCatalogRepository)->projectTypes(), app(Catalog::class)->projectTypes());
        $this->get('/services')->assertOk()->assertSee('CarteNex');

        Log::shouldHaveReceived('warning')->once();
    }

    public function test_a_failing_query_falls_back_to_config(): void
    {
        $this->useDatabase();
        \Illuminate\Support\Facades\Schema::drop('catalog_plan_features');
        \Illuminate\Support\Facades\Schema::drop('catalog_plans');
        DatabaseCatalogRepository::flush();
        Log::spy();

        $this->assertSame((new ConfigCatalogRepository)->products(), app(Catalog::class)->products());
        $this->get('/')->assertOk()->assertSee('Tymelo');
    }

    // --- Editing: cache, visibility, new services ----------------------------------------------

    public function test_a_price_edit_clears_the_cache_and_shows_on_the_public_pages(): void
    {
        $this->useDatabase();
        $this->assertStringContainsString('$349', $this->text('/services'));
        $this->assertTrue(Cache::has('catalog.database'));

        CatalogPlan::where('name', 'Starter')->where('price', '$349')->firstOrFail()->update(['price' => '$399']);

        $this->assertFalse(Cache::has('catalog.database'));
        $services = $this->text('/services');
        $this->assertStringContainsString('$399', $services);
        $this->assertStringNotContainsString('$349', $services);
        // The home card shows the plan price too (the headline "From" price is its own field).
        $this->assertStringContainsString('$399 + $35/mo', $this->text('/'));
    }

    public function test_a_hidden_product_disappears_from_every_public_page_but_keeps_its_data(): void
    {
        $this->useDatabase();
        CatalogService::where('slug', 'tymelo')->update(['is_visible' => false]);
        DatabaseCatalogRepository::flush();

        // Data-driven text only: the page copy (FAQ, About) still names the products in prose.
        foreach (['/', '/services', '/portfolio'] as $uri) {
            $html = $this->get($uri)->assertOk()->getContent();

            foreach (['Try the booking page', 'tymelo.build-syntax.com', 'accent-tymelo', 'Tymelo · demo clinic booking'] as $needle) {
                $this->assertStringNotContainsString($needle, $html, "$uri still shows $needle");
            }
        }
        $this->assertStringNotContainsString('$349', $this->text('/services'));

        $this->assertNull(app(Catalog::class)->product('tymelo'));
        $this->assertSame(2, CatalogService::where('slug', 'tymelo')->firstOrFail()->plans()->count());
    }

    public function test_a_new_service_appears_on_home_services_portfolio_and_the_contact_form(): void
    {
        $this->useDatabase();

        $service = CatalogService::create([
            'slug' => 'loyalty', 'kind' => 'product', 'name' => 'Loyaltix', 'label' => 'Loyalty cards',
            'project_type' => 'loyalty', 'accent' => 'terracotta', 'demo_url' => 'https://loyalty.example.com/demo',
            'demo_label' => 'Try it', 'headline_price' => '$25', 'headline_unit' => ' / month',
            'description' => 'Digital stamp cards for shops.', 'is_visible' => true, 'sort_order' => 9,
            'details' => ['blurb' => 'Stamp cards on the phone.', 'features' => ['QR stamping'], 'for' => 'shops.', 'for_extra' => ''],
        ]);
        $plan = $service->plans()->create(['name' => 'Solo', 'price' => '$25', 'period' => ' / month', 'summary' => 'One shop.', 'cta' => 'Request this plan', 'sort_order' => 1, 'is_featured' => true]);
        $plan->features()->create(['text' => '500 customers', 'sort_order' => 1]);

        foreach (['/' => ['Loyaltix', 'Digital stamp cards for shops.', '$25'], '/services' => ['Loyaltix', 'Loyalty cards', 'Solo', '500 customers'], '/portfolio' => ['Loyaltix', 'Stamp cards on the phone.']] as $uri => $needles) {
            $text = $this->text($uri);
            foreach ($needles as $needle) {
                $this->assertStringContainsString($needle, $text, "{$uri} is missing {$needle}");
            }
        }

        $this->get('/services')->assertSee('id="loyalty"', false)->assertSee('accent-terracotta', false)
            ->assertSee(e(route('contact', ['type' => 'loyalty', 'plan' => 'Solo'])), false);

        $catalog = app(Catalog::class);
        $this->assertContains('loyalty', $catalog->projectTypes());
        $this->assertSame('Loyaltix', $catalog->projectTypeLabels()['loyalty']);

        // The contact form lists the type and accepts it.
        $this->get('/contact')->assertSee('value="loyalty"', false)->assertSee('Loyaltix');
        Livewire::test(\App\Livewire\Pages\Contact::class)
            ->set('name', 'Sara Haddad')->set('email', 'sara@example.com')->set('message', 'I want loyalty cards for my shop.')
            ->set('project_type', 'loyalty')->call('submit')->assertHasNoErrors();
        $this->assertDatabaseHas('contact_submissions', ['project_type' => 'loyalty']);

        // Hiding it removes its type again.
        $service->update(['is_visible' => false]);
        $this->assertNotContains('loyalty', $catalog->projectTypes());
        $this->assertStringNotContainsString('Loyaltix', $this->text('/'));
        $this->assertTrue(ContactSubmission::where('project_type', 'loyalty')->exists());
    }

    public function test_a_service_without_screens_or_logo_renders_without_broken_images(): void
    {
        $this->useDatabase();
        CatalogService::create(['slug' => 'plain', 'kind' => 'product', 'name' => 'Plainly', 'project_type' => 'plain', 'accent' => 'brand', 'is_visible' => true, 'sort_order' => 9]);
        DatabaseCatalogRepository::flush();

        foreach (['/', '/services', '/portfolio'] as $uri) {
            $html = $this->get($uri)->assertOk()->getContent();
            $this->assertStringNotContainsString('images/brand/"', $html, $uri);
            $this->assertStringNotContainsString('images/showcase/"', $html, $uri);
            $this->assertStringContainsString('Plainly', $html, $uri);
        }
    }

    public function test_accent_options_match_the_tailwind_safelist(): void
    {
        $config = file_get_contents(base_path('tailwind.config.js'));

        foreach (array_keys(Catalog::ACCENTS) as $accent) {
            $this->assertStringContainsString("'accent-{$accent}'", $config, "accent-{$accent} is not safelisted");
        }
    }
}

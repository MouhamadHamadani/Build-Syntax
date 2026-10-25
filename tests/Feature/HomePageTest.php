<?php

namespace Tests\Feature;

use App\Livewire\Components\NewsletterSubscribe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /** The four products plus custom development, in page order. */
    private function offers(): array
    {
        return [...array_values(config('products.catalog')), config('products.custom')];
    }

    public function test_home_renders_every_product_name_and_headline_price_from_config(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        foreach ($this->offers() as $offer) {
            $this->assertStringContainsString($offer['name'], $html);
            $this->assertStringContainsString('From ' . $offer['price']['from'], $html);
        }
    }

    public function test_home_lists_products_in_config_order(): void
    {
        $html = $this->get('/')->getContent();

        preg_match_all('#<h3 class="heading[^"]*">([^<]+)</h3>#', $html, $m);

        $this->assertSame(
            ['CarteNex', 'ShopNex', 'Tymelo', 'LebaSouk POS', 'Something that does not exist yet?'],
            array_slice($m[1], 0, 5)
        );
    }

    public function test_home_has_no_pos_pro_and_exactly_one_h1(): void
    {
        $html = $this->get('/')->getContent();

        $this->assertStringNotContainsString('POS Pro', $html);
        $this->assertSame(1, substr_count($html, '<h1'));
    }

    public function test_hero_content_is_not_hidden_by_the_fade_in_utility(): void
    {
        $html = $this->get('/')->getContent();

        // Everything above the products section (header + hero) must be visible at rest.
        $aboveTheFold = substr($html, 0, strpos($html, 'id="products"'));

        $this->assertStringNotContainsString('fade-in', $aboveTheFold);
    }

    public function test_hero_showcase_is_an_accessible_tab_set_with_sized_images(): void
    {
        $html = $this->get('/')->getContent();

        $this->assertSame(1, substr_count($html, 'role="tablist"'));
        $this->assertSame(4, substr_count($html, 'role="tab"'));
        $this->assertSame(4, substr_count($html, 'role="tabpanel"'));

        // Every showcase screenshot has explicit dimensions; only the first loads eagerly.
        preg_match_all('#<img src="[^"]*/images/showcase/[^>]*>#', $html, $imgs);
        $this->assertCount(7, $imgs[0]);
        foreach ($imgs[0] as $img) {
            $this->assertMatchesRegularExpression('/ width="\d+" height="\d+"/', $img);
            $this->assertMatchesRegularExpression('/ alt="[^"]+"/', $img);
        }
        $this->assertSame(2, substr_count(implode('', $imgs[0]), 'loading="eager"'));
    }

    public function test_home_shows_contact_details_and_links_product_enquiries_to_the_contact_form(): void
    {
        $html = $this->get('/')->getContent();

        $this->assertStringContainsString('https://wa.me/9613876822', $html);
        $this->assertStringContainsString('+961 3 876 822', $html);
        $this->assertStringContainsString('info@build-syntax.com', $html);
        $this->assertStringContainsString(e(route('contact', ['type' => 'pos', 'plan' => 'Premium'])), $html);
        $this->assertStringContainsString(e(route('contact', ['type' => 'website'])), $html);
    }

    public function test_footer_has_a_compact_newsletter_form_with_a_proper_livewire_root(): void
    {
        $html = $this->get('/')->getContent();

        // Livewire puts wire:id on the first tag of the component; it must be the wrapper, not an inner heading.
        $this->assertSame(1, preg_match('#<(\w+)\s[^>]*components\.newsletter-subscribe#', $html, $m));
        $this->assertSame('div', $m[1]);
        $this->assertSame(1, substr_count($html, 'wire:submit.prevent="subscribe"'));
        $this->assertStringNotContainsString('Subscribe to Our Newsletter', $html);

        Livewire::test(NewsletterSubscribe::class, ['compact' => true])
            ->assertSet('compact', true)
            ->call('subscribe')
            ->assertHasErrors(['email' => 'required']);
    }

    public function test_meta_description_names_the_four_products_and_stays_short(): void
    {
        preg_match('/<meta name="description" content="([^"]*)"/', $this->get('/')->getContent(), $m);
        $description = html_entity_decode($m[1] ?? '');

        $this->assertLessThanOrEqual(155, mb_strlen($description));
        foreach (['CarteNex', 'ShopNex', 'Tymelo', 'LebaSouk POS'] as $name) {
            $this->assertStringContainsString($name, $description);
        }
        $this->assertStringContainsString('<title>Home - Build Syntax</title>', $this->get('/')->getContent());
    }
}

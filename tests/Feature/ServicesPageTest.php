<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesPageTest extends TestCase
{
    use RefreshDatabase;

    /** Every price string in config/catalog.php (plan prices, tier prices, headline prices). */
    private function catalogPrices(): array
    {
        $prices = [];
        $walk = function (array $node) use (&$walk, &$prices) {
            foreach ($node as $key => $value) {
                if ($key === 'price' && is_string($value)) {
                    $prices[] = $value;
                } elseif ($key === 'price' && is_array($value)) {
                    $prices[] = $value['from'];
                } elseif (is_array($value)) {
                    $walk($value);
                }
            }
        };
        $walk(config('catalog'));

        return array_values(array_unique($prices));
    }

    public function test_services_lists_every_product_name_and_price_from_the_catalog(): void
    {
        $html = $this->get('/services')->assertOk()->getContent();

        foreach (config('catalog.products') as $product) {
            $this->assertStringContainsString($product['name'], $html);
            foreach ($product['plans'] as $plan) {
                $this->assertStringContainsString($plan['name'], $html);
            }
        }

        $prices = $this->catalogPrices();
        $this->assertGreaterThan(15, count($prices));
        foreach ($prices as $price) {
            $this->assertStringContainsString($price, $html, "Price {$price} is missing from /services");
        }
    }

    public function test_home_and_services_show_the_same_product_prices(): void
    {
        $home = $this->get('/')->getContent();
        $services = $this->get('/services')->getContent();

        foreach (config('catalog.products') as $product) {
            foreach ($product['plans'] as $plan) {
                if ($plan['price'] === null) {
                    continue;
                }
                $this->assertStringContainsString($plan['price'], $home);
                $this->assertStringContainsString($plan['price'], $services);
            }
        }
    }

    public function test_services_has_no_retired_claims_and_exactly_one_h1(): void
    {
        $html = $this->get('/services')->getContent();

        foreach (['POS Pro', '99.9%', 'Early Access', 'Beta', 'Quality Guaranteed', 'available on request for all packages'] as $retired) {
            $this->assertStringNotContainsStringIgnoringCase($retired, $html);
        }
        $this->assertSame(1, substr_count($html, '<h1'));
    }

    public function test_every_plan_link_goes_to_the_contact_form_with_a_valid_type_and_plan(): void
    {
        $html = $this->get('/services')->getContent();

        preg_match_all('#href="([^"]*/contact\?[^"]*)"#', $html, $m);
        $planLinks = array_unique($m[1]);

        // 18 plan cards + the two secondary buttons (free trial, POS demo)
        $this->assertCount(20, $planLinks);

        foreach ($planLinks as $href) {
            parse_str(parse_url(html_entity_decode($href), PHP_URL_QUERY), $query);

            $this->assertContains($query['type'] ?? null, config('products.project_types'), $href);
            $this->assertMatchesRegularExpression('/^[A-Za-z0-9][A-Za-z0-9 _.\-]{0,49}$/', $query['plan'] ?? '', $href);
        }
    }

    public function test_subnav_targets_exist_and_old_anchors_still_resolve(): void
    {
        $html = $this->get('/services')->getContent();

        $this->assertSame(1, substr_count($html, 'aria-label="Service sections"'));

        foreach (['cartenex', 'shopnex', 'tymelo', 'pos', 'web-development', 'hosting'] as $id) {
            $this->assertSame(1, substr_count($html, 'id="' . $id . '"'), "#{$id} must exist exactly once");
            $this->assertStringContainsString('href="#' . $id . '"', $html);
        }

        foreach (['ecommerce', 'menus', 'appointment'] as $legacy) {
            $this->assertSame(1, substr_count($html, 'id="' . $legacy . '"'), "legacy #{$legacy} must resolve");
        }
    }

    public function test_hero_is_visible_at_rest_and_images_have_dimensions(): void
    {
        $html = $this->get('/services')->getContent();

        $aboveTheFold = substr($html, 0, strpos($html, 'id="cartenex"'));
        $this->assertStringNotContainsString('fade-in', $aboveTheFold);

        preg_match_all('#<img\b[^>]*>#', $html, $imgs);
        $this->assertNotEmpty($imgs[0]);
        foreach ($imgs[0] as $img) {
            $this->assertMatchesRegularExpression('/ width="\d+"/', $img);
            $this->assertMatchesRegularExpression('/ height="\d+"/', $img);
        }

        // The Tymelo mark is decorative: the word "Tymelo" is live text beside it.
        $this->assertStringContainsString('<img src="' . asset('images/brand/tymelo-mark.svg') . '" alt=""', $html);
    }

    public function test_services_meta_matches_the_design(): void
    {
        $html = $this->get('/services')->getContent();

        $this->assertStringContainsString('<title>Services and pricing | Build Syntax</title>', $html);
        $this->assertStringContainsString(
            '<meta name="description" content="Prices for CarteNex digital menus, ShopNex online stores, Tymelo booking, LebaSouk POS, custom websites, hosting and maintenance.">',
            $html
        );
    }
}

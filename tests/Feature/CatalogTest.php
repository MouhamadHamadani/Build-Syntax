<?php

namespace Tests\Feature;

use App\Support\Catalog;
use Tests\TestCase;

class CatalogTest extends TestCase
{
    private function catalog(): Catalog
    {
        return app(Catalog::class);
    }

    public function test_it_is_a_singleton(): void
    {
        $this->assertSame($this->catalog(), app(Catalog::class));
    }

    public function test_products_come_in_display_order_with_plans_and_features(): void
    {
        $products = $this->catalog()->products();

        $this->assertSame(['cartenex', 'shopnex', 'tymelo', 'lebasouk'], array_keys($products));

        foreach ($products as $slug => $product) {
            $this->assertSame($slug, $product['slug']);
            $this->assertNotEmpty($product['plans'], "{$slug} has no plans");
            $this->assertNotEmpty($product['features'], "{$slug} has no features");
            $this->assertContains($product['project_type'], $this->catalog()->projectTypes());
        }
    }

    public function test_product_returns_one_product_or_null(): void
    {
        $this->assertSame('CarteNex', $this->catalog()->product('cartenex')['name']);
        $this->assertNull($this->catalog()->product('does-not-exist'));
    }

    public function test_custom_hosting_and_maintenance_have_their_plans(): void
    {
        $this->assertCount(3, $this->catalog()->custom()['service']['plans']);
        $this->assertCount(3, $this->catalog()->hosting()['tiers']);
        $this->assertCount(4, $this->catalog()->maintenance()['plans']);
        $this->assertContains($this->catalog()->custom()['project_type'], $this->catalog()->projectTypes());
        $this->assertContains($this->catalog()->maintenance()['project_type'], $this->catalog()->projectTypes());
    }

    public function test_prices_are_display_strings_and_unpriced_plans_say_what_to_show(): void
    {
        foreach ($this->catalog()->products() as $product) {
            foreach ($product['plans'] as $plan) {
                if ($plan['price'] === null) {
                    $this->assertNotEmpty($plan['unit'], 'A plan without a price needs text such as "Contact us"');
                } else {
                    $this->assertMatchesRegularExpression('/^\$[\d,]+$/', $plan['price']);
                }
            }
        }
    }

    public function test_project_types_are_the_contact_form_taxonomy(): void
    {
        $this->assertSame(config('products.project_types'), $this->catalog()->projectTypes());
    }
}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LebaSoukPagesTest extends TestCase
{
    use RefreshDatabase;

    /** Page source with tags stripped and whitespace collapsed (entities such as &mdash; stay as written). */
    private function pageText(string $uri): string
    {
        $response = $this->get($uri)->assertOk();

        return preg_replace('/\s+/', ' ', strip_tags($response->getContent()));
    }

    public function test_terms_scope_the_payment_schedule_and_cover_all_products(): void
    {
        $text = $this->pageText('/terms-of-service');

        foreach ([
            'CarteNex &mdash; digital menu platform (monthly subscription)',
            'LebaSouk POS &mdash; point-of-sale software (one-time license)',
            'The 50% / 30% / 20% schedule below applies to custom development and project-based platform work. It does not apply to LebaSouk POS or CarteNex.',
            'LebaSouk POS is sold as a one-time license with no upfront deposit. Payment is due once installation is complete.',
            'CarteNex is billed as a monthly subscription',
            'Last updated: October 2026',
        ] as $needle) {
            $this->assertStringContainsString($needle, $text);
        }
    }

    public function test_services_payment_note_no_longer_claims_all_packages(): void
    {
        $text = $this->pageText('/services');

        $this->assertStringContainsString('50% deposit &middot; 30% on delivery &middot; 20% after training &mdash; available on request for custom development projects. LebaSouk POS: no deposit, payment on completion of installation.', $text);
        $this->assertStringNotContainsString('available on request for all packages', $text);
    }

    public function test_hero_panel_lists_products_in_site_order(): void
    {
        $text = $this->pageText('/');

        preg_match('/products: \[(.*?)\]/', $text, $m);
        preg_match_all('/"([^"]+)"/', $m[1] ?? '', $names);

        $this->assertSame(['ShopNex', 'CarteNex', 'Tymelo', 'LebaSouk POS'], $names[1]);
    }

    public function test_lebasouk_teaser_links_to_the_arabic_site_like_other_product_links(): void
    {
        $html = $this->get('/services')->getContent();

        // Plain link: lang="ar", no target/rel, same as the other product links.
        $this->assertMatchesRegularExpression(
            '#<a href="https://lebasouk\.build-syntax\.com/\?lang=ar" lang="ar" class="[^"]*">العربية</a>#u',
            $html
        );
    }

    public function test_each_public_page_has_exactly_one_valid_organization_json_ld_block(): void
    {
        foreach (['/', '/services', '/contact'] as $uri) {
            $html = $this->get($uri)->getContent();

            $this->assertSame(1, preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $blocks), "{$uri}: expected one JSON-LD block");

            $data = json_decode($blocks[1][0], true, flags: JSON_THROW_ON_ERROR);

            $this->assertSame('https://schema.org', $data['@context']);
            $this->assertSame('Organization', $data['@type']);
            $this->assertSame('Build Syntax', $data['name']);
            $this->assertSame('https://build-syntax.com', $data['url']);
            $this->assertSame('https://build-syntax.com/images/icon.png', $data['logo']);
            $this->assertSame('+9613876822', $data['telephone']);
            $this->assertSame('info@build-syntax.com', $data['email']);
            $this->assertSame(['@type' => 'PostalAddress', 'addressLocality' => 'Beirut', 'addressCountry' => 'LB'], $data['address']);
            $this->assertSame([
                'https://www.facebook.com/profile.php?id=61590554412690',
                'https://www.instagram.com/buildsyntax.dev',
            ], $data['sameAs']);

            // Company facts only: no offers, products or people.
            foreach (['offers', 'hasOfferCatalog', 'founder', 'employee', 'makesOffer'] as $key) {
                $this->assertArrayNotHasKey($key, $data);
            }
        }
    }

    public function test_services_meta_description_is_short_and_names_every_product(): void
    {
        preg_match('/<meta name="description" content="([^"]*)"/', $this->get('/services')->getContent(), $m);
        $description = html_entity_decode($m[1] ?? '');

        $this->assertLessThanOrEqual(155, mb_strlen($description));
        foreach (['custom web development', 'ShopNex', 'CarteNex', 'Tymelo', 'LebaSouk POS'] as $name) {
            $this->assertStringContainsString($name, $description);
        }
    }
}

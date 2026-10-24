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
}

<?php

namespace App\Support;

/**
 * Read access to the public product catalog: products, plans, custom development,
 * hosting and maintenance. Views, Livewire components and tests read prices and copy
 * through this class only; nothing else calls config('catalog').
 *
 * It returns the data as stored and does no formatting: prices are display strings such
 * as "$19", "From " + "$800" (prefix and price are separate keys) or "Contact us".
 * Today the data comes from config/catalog.php. Later it can come from database tables:
 * keep the return shapes below stable and no view has to change.
 *
 * Shapes (all plain arrays):
 *
 *  products(): array<string, Product>   keyed by slug, in display order
 *  Product: name, slug, accent, project_type, tagline, description, features[], for,
 *           for_extra, for_extra_strong, price{from, unit}, site, demo{url, label},
 *           plans_label, plans[], note, showcase{title, laptop, phone, tab},
 *           service{anchor, legacy_anchors[], logo, secondary_cta, note}
 *  Plan: name, featured, price (string|null), unit, period, billing, summary,
 *        description, features[], meta, cta, plan_key?, prefix?
 *        price is null for "Contact us" / "Custom quote"; unit then holds that text.
 *  custom(): name, slug, accent, project_type, tagline, headline, description, price{from, unit},
 *            cta, stack[], service{anchor, heading, intro, points[], plans[]}
 *  hosting(): heading, intro, tiers[]{name, price, period, features[]}
 *  maintenance(): heading, intro, project_type, plans[]  (Plan shape)
 *  projectTypes(): string[]   the contact form types, config/products.php
 */
class Catalog
{
    /** The four products, keyed by slug, in display order. */
    public function products(): array
    {
        return config('catalog.products');
    }

    /** One product by slug, or null. */
    public function product(string $slug): ?array
    {
        return $this->products()[$slug] ?? null;
    }

    /** Custom development: card copy plus the Services page section and its plans. */
    public function custom(): array
    {
        return config('catalog.custom');
    }

    /** VPS hosting tiers. */
    public function hosting(): array
    {
        return config('catalog.hosting');
    }

    /** Monthly maintenance plans. */
    public function maintenance(): array
    {
        return config('catalog.maintenance');
    }

    /** Project types the contact form accepts (values, not labels). */
    public function projectTypes(): array
    {
        return config('products.project_types');
    }
}

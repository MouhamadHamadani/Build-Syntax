<?php

namespace App\Support\CatalogSource;

/**
 * A plan's price is one display string in the database ("$349", "From $800", "Contact us") and
 * is read by the views as separate keys: prefix, price and, for text-only plans, unit.
 * This is the one place that converts between the two.
 */
class PlanPrice
{
    /** @return array{prefix: ?string, price: ?string, text: string} price is null for a text-only plan, whose text goes in 'unit' */
    public static function split(string $display): array
    {
        preg_match('/^(From )?(.*)$/s', $display, $m);

        return [
            'prefix' => $m[1] !== '' ? $m[1] : null,
            'price' => preg_match('/\d/', $m[2]) === 1 ? $m[2] : null,
            'text' => $m[2],
        ];
    }

    /** The display string for a plan array in the config shape. */
    public static function join(array $plan): string
    {
        return ($plan['prefix'] ?? '') . ($plan['price'] ?? $plan['unit']);
    }
}

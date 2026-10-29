<?php

namespace App\Livewire\Admin\Portfolio\Concerns;

use App\Support\Catalog;

trait ListsCategories
{
    /** Every allowed category value with the label the public portfolio uses, in config order. */
    protected function categories(): array
    {
        $labels = app(Catalog::class)->portfolioCategories();

        return collect(config('products.portfolio_categories'))
            ->mapWithKeys(fn ($value) => [$value => $labels[$value] ?? ucfirst(str_replace('_', ' ', $value))])
            ->all();
    }
}

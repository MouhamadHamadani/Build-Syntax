<?php

namespace App\Support\CatalogSource;

/** The data in config/catalog.php and config/products.php. Also the seed source and the fallback. */
class ConfigCatalogRepository implements CatalogRepository
{
    public function products(): array
    {
        return config('catalog.products');
    }

    public function custom(): array
    {
        return config('catalog.custom');
    }

    public function hosting(): array
    {
        return config('catalog.hosting');
    }

    public function maintenance(): array
    {
        return config('catalog.maintenance');
    }

    public function projectTypes(): array
    {
        return config('products.project_types');
    }

    public function projectTypeLabels(): array
    {
        return config('catalog.project_type_labels');
    }

    public function portfolioCategories(): array
    {
        return config('catalog.portfolio_category_labels');
    }
}

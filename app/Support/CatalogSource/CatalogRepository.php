<?php

namespace App\Support\CatalogSource;

/**
 * Where App\Support\Catalog reads its data from. Both implementations return the shapes
 * documented on Catalog, so no view depends on the source. Chosen by CATALOG_SOURCE.
 */
interface CatalogRepository
{
    public function products(): array;

    public function custom(): array;

    public function hosting(): array;

    public function maintenance(): array;

    public function projectTypes(): array;

    public function projectTypeLabels(): array;

    public function portfolioCategories(): array;
}

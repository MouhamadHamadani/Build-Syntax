<?php

namespace App\Models\Concerns;

use App\Support\CatalogSource\DatabaseCatalogRepository;

/** Any save or delete of catalog data drops the cached public arrays. */
trait FlushesCatalogCache
{
    protected static function bootFlushesCatalogCache(): void
    {
        $flush = fn () => DatabaseCatalogRepository::flush();

        static::saved($flush);
        static::deleted($flush);
    }
}

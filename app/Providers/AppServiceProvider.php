<?php

namespace App\Providers;

use App\Support\Catalog;
use App\Support\CatalogSource\CatalogRepository;
use App\Support\CatalogSource\ConfigCatalogRepository;
use App\Support\CatalogSource\DatabaseCatalogRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Catalog::class);

        // CATALOG_SOURCE=config (default) or database. Not a singleton: tests and the editor may switch it.
        $this->app->bind(CatalogRepository::class, fn ($app) => config('catalog.source') === 'database'
            ? $app->make(DatabaseCatalogRepository::class)
            : $app->make(ConfigCatalogRepository::class));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}

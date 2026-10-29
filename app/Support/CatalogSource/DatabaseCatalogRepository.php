<?php

namespace App\Support\CatalogSource;

use App\Models\CatalogPlan;
use App\Models\CatalogService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Builds the same arrays as config/catalog.php from the catalog_* tables, once, and caches them.
 * The hero showcase screens and logos are brand assets that stay in code (config/catalog.php,
 * keyed by slug); a service that has none gets a default. If the tables are empty or the query
 * fails, every method answers from the config data and logs a warning: never an empty site.
 */
class DatabaseCatalogRepository implements CatalogRepository
{
    private const CACHE_KEY = 'catalog.database';

    public function __construct(private ConfigCatalogRepository $config) {}

    public static function flush(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    public function products(): array
    {
        return $this->data()['products'] ?? $this->config->products();
    }

    public function custom(): array
    {
        return $this->data()['custom'] ?? $this->config->custom();
    }

    public function hosting(): array
    {
        return $this->data()['hosting'] ?? $this->config->hosting();
    }

    public function maintenance(): array
    {
        return $this->data()['maintenance'] ?? $this->config->maintenance();
    }

    public function projectTypes(): array
    {
        return $this->data()['project_types'] ?? $this->config->projectTypes();
    }

    public function projectTypeLabels(): array
    {
        return $this->data()['project_type_labels'] ?? $this->config->projectTypeLabels();
    }

    public function portfolioCategories(): array
    {
        return $this->config->portfolioCategories();
    }

    /** The cached arrays, or null when the config data must be used instead. */
    private function data(): ?array
    {
        try {
            $data = Cache::get(self::CACHE_KEY);

            if ($data === null) {
                $data = $this->build();

                if ($data === null) {
                    $this->warn('the catalog tables are empty');

                    return null;
                }

                Cache::forever(self::CACHE_KEY, $data);
            }

            return $data;
        } catch (Throwable $e) {
            $this->warn($e->getMessage());

            return null;
        }
    }

    /** One log line per five minutes, not one per request. */
    private function warn(string $reason): void
    {
        if (Cache::add('catalog.fallback_logged', true, 300)) {
            Log::warning("Catalog: using config/catalog.php because {$reason}.");
        }
    }

    private function build(): ?array
    {
        $services = CatalogService::with('plans.features')->orderBy('sort_order')->orderBy('id')->get();

        if ($services->isEmpty()) {
            return null;
        }

        $products = [];
        foreach ($services->where('kind', 'product')->where('is_visible', true) as $service) {
            $products[$service->slug] = $this->product($service);
        }

        $visibleTypes = $services->where('is_visible', true)->pluck('project_type')->filter()->unique();
        $newTypes = $visibleTypes->diff($this->config->projectTypes())->values();

        $custom = $services->firstWhere('kind', 'custom');
        $hosting = $services->firstWhere('kind', 'hosting');
        $maintenance = $services->firstWhere('kind', 'maintenance');

        return [
            'products' => $products,
            'custom' => $custom ? $this->customFrom($custom) : $this->config->custom(),
            'hosting' => $hosting ? $this->hostingFrom($hosting) : $this->config->hosting(),
            'maintenance' => $maintenance ? $this->maintenanceFrom($maintenance) : $this->config->maintenance(),
            'project_types' => [...$this->config->projectTypes(), ...$newTypes],
            'project_type_labels' => $this->config->projectTypeLabels()
                + $newTypes->mapWithKeys(fn ($type) => [$type => $services->where('is_visible', true)->firstWhere('project_type', $type)->name])->all(),
        ];
    }

    private function product(CatalogService $s): array
    {
        $d = $s->details ?? [];
        $code = $this->codeAssets($s);
        $anchor = $d['anchor'] ?? $s->slug;

        return [
            'name' => $s->name,
            'slug' => $s->slug,
            'accent' => $s->accent,
            'project_type' => $s->project_type,
            'tagline' => $s->label ?? '',
            'blurb' => $d['blurb'] ?? '',
            'card_unit' => $d['card_unit'] ?? null,
            'description' => $s->description ?? '',
            'features' => $d['features'] ?? [],
            'for' => $d['for'] ?? '',
            'for_extra' => $d['for_extra'] ?? '',
            'for_extra_strong' => (bool) ($d['for_extra_strong'] ?? false),
            'price' => ['from' => $s->headline_price ?? '', 'unit' => $s->headline_unit],
            'site' => $s->site_url ?: url('/services') . '#' . $anchor,
            'demo' => [
                'url' => $s->demo_url ?: ($s->site_url ?: url('/contact') . '?type=' . $s->project_type),
                'label' => $s->demo_label ?: 'Learn more',
            ],
            'plans_label' => $d['plans_label'] ?? $s->name . ' plans',
            'plans' => $s->plans->map(fn (CatalogPlan $p) => $this->plan($p, 'product'))->all(),
            'note' => $s->note ?? '',
            'showcase' => $code['showcase'],
            'service' => [
                'anchor' => $anchor,
                'legacy_anchors' => $d['legacy_anchors'] ?? [],
                'logo' => $code['logo'],
                'secondary_cta' => $d['secondary_cta'] ?? null,
                'note' => $d['service_note'] ?? ['strong' => '', 'text' => ''],
            ],
        ];
    }

    private function customFrom(CatalogService $s): array
    {
        $d = $s->details ?? [];

        return [
            'name' => $s->name,
            'slug' => $s->slug,
            'accent' => $s->accent,
            'project_type' => $s->project_type,
            'tagline' => $s->label ?? '',
            'headline' => $d['headline'] ?? '',
            'description' => $s->description ?? '',
            'price' => ['from' => $s->headline_price ?? '', 'unit' => $s->headline_unit],
            'cta' => $d['cta'] ?? '',
            'stack' => $d['stack'] ?? [],
            'service' => [
                'anchor' => $d['anchor'] ?? $s->slug,
                'heading' => $d['heading'] ?? '',
                'intro' => $s->intro ?? '',
                'points' => $d['points'] ?? [],
                'plans' => $s->plans->map(fn (CatalogPlan $p) => $this->plan($p, 'custom'))->all(),
            ],
        ];
    }

    private function hostingFrom(CatalogService $s): array
    {
        $d = $s->details ?? [];

        return [
            'heading' => $d['heading'] ?? '',
            'intro' => $s->intro ?? '',
            'tiers' => $s->plans->map(fn (CatalogPlan $p) => [
                'name' => $p->name,
                'price' => $p->price,
                'period' => $p->period,
                'features' => $p->features->pluck('text')->all(),
            ])->all(),
        ];
    }

    private function maintenanceFrom(CatalogService $s): array
    {
        $d = $s->details ?? [];

        return [
            'heading' => $d['heading'] ?? '',
            'minimum_months' => (int) ($d['minimum_months'] ?? 0),
            'intro' => $s->intro ?? '',
            'project_type' => $s->project_type,
            'plans' => $s->plans->map(fn (CatalogPlan $p) => $this->plan($p, 'maintenance'))->all(),
        ];
    }

    /** A plan in the config shape. Which optional keys exist depends on the kind, as in config/catalog.php. */
    private function plan(CatalogPlan $p, string $kind): array
    {
        $price = PlanPrice::split($p->price);
        $extra = $p->extra ?? [];

        $plan = ['name' => $p->name];

        if ($p->plan_key) {
            $plan['plan_key'] = $p->plan_key;
        }

        $plan['featured'] = (bool) $p->is_featured;

        if ($price['prefix']) {
            $plan['prefix'] = $price['prefix'];
        }

        $plan += [
            'price' => $price['price'],
            'unit' => $price['price'] === null ? $price['text'] : $p->unit,
            'period' => $p->period,
            'billing' => $p->billing,
            'summary' => $p->summary ?? '',
        ];

        // The home page prints a description under every product plan, so a product plan always has one.
        if ($kind === 'product' || $p->description !== null) {
            $plan['description'] = $p->description ?? $p->summary ?? '';
        }

        $plan['features'] = $p->features->pluck('text')->all();

        foreach (['weeks', 'support_months'] as $key) {
            if (isset($extra[$key])) {
                $plan[$key] = $extra[$key];
            }
        }

        return $plan + ['meta' => $p->meta, 'cta' => $p->cta];
    }

    /** Showcase screens and heading logo: kept in code by slug, with a default for a new service. */
    private function codeAssets(CatalogService $s): array
    {
        $known = $this->config->products()[$s->slug] ?? null;

        return [
            'showcase' => $known['showcase'] ?? [
                'title' => $s->name,
                'laptop' => null,
                'phone' => null,
                'tab' => ['logo' => null, 'width' => 24, 'height' => 24, 'wordmark' => $s->name],
            ],
            'logo' => $known['service']['logo'] ?? ['file' => null, 'width' => 0, 'height' => 0, 'alt' => '', 'wordmark' => $s->name],
        ];
    }
}

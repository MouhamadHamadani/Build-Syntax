<?php

namespace Database\Seeders;

use App\Models\CatalogPlan;
use App\Models\CatalogService;
use App\Support\CatalogSource\ConfigCatalogRepository;
use App\Support\CatalogSource\PlanPrice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Copies config/catalog.php into the catalog_* tables, in the current order. It always reads the
 * config repository, never the database one. Safe to run again, but it resets every seeded
 * service and plan to the config values: do not run it after editing prices in the admin.
 *
 *   php artisan db:seed --class=CatalogSeeder
 */
class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $config = new ConfigCatalogRepository;

        // Seeding is not a price change: keep it out of the activity log.
        activity()->withoutLogs(function () use ($config) {
            DB::transaction(function () use ($config) {
                $order = 0;

                foreach ($config->products() as $slug => $p) {
                    $service = $this->service($slug, 'product', ++$order, [
                        'name' => $p['name'],
                        'label' => $p['tagline'],
                        'project_type' => $p['project_type'],
                        'accent' => $p['accent'],
                        'site_url' => $p['site'],
                        'demo_url' => $p['demo']['url'],
                        'demo_label' => $p['demo']['label'],
                        'headline_price' => $p['price']['from'],
                        'headline_unit' => $p['price']['unit'],
                        'description' => $p['description'],
                        'note' => $p['note'],
                        'details' => [
                            'blurb' => $p['blurb'],
                            'card_unit' => $p['card_unit'],
                            'plans_label' => $p['plans_label'],
                            'features' => $p['features'],
                            'for' => $p['for'],
                            'for_extra' => $p['for_extra'],
                            'for_extra_strong' => $p['for_extra_strong'],
                            'anchor' => $p['service']['anchor'],
                            'legacy_anchors' => $p['service']['legacy_anchors'],
                            'secondary_cta' => $p['service']['secondary_cta'],
                            'service_note' => $p['service']['note'],
                        ],
                    ]);
                    $this->plans($service, $p['plans']);
                }

                $c = $config->custom();
                $service = $this->service($c['slug'], 'custom', ++$order, [
                    'name' => $c['name'],
                    'label' => $c['tagline'],
                    'project_type' => $c['project_type'],
                    'accent' => $c['accent'],
                    'headline_price' => $c['price']['from'],
                    'headline_unit' => $c['price']['unit'],
                    'description' => $c['description'],
                    'intro' => $c['service']['intro'],
                    'details' => [
                        'headline' => $c['headline'],
                        'cta' => $c['cta'],
                        'stack' => $c['stack'],
                        'heading' => $c['service']['heading'],
                        'anchor' => $c['service']['anchor'],
                        'points' => $c['service']['points'],
                    ],
                ]);
                $this->plans($service, $c['service']['plans']);

                $h = $config->hosting();
                $service = $this->service('hosting', 'hosting', ++$order, [
                    'name' => 'Hosting',
                    'accent' => 'neutral',
                    'intro' => $h['intro'],
                    'details' => ['heading' => $h['heading']],
                ]);
                $this->plans($service, array_map(fn ($tier) => $tier + ['featured' => false], $h['tiers']), hosting: true);

                $m = $config->maintenance();
                $service = $this->service('maintenance', 'maintenance', ++$order, [
                    'name' => 'Maintenance',
                    'accent' => 'neutral',
                    'project_type' => $m['project_type'],
                    'intro' => $m['intro'],
                    'details' => ['heading' => $m['heading'], 'minimum_months' => $m['minimum_months']],
                ]);
                $this->plans($service, $m['plans']);
            });
        });
    }

    private function service(string $slug, string $kind, int $order, array $attributes): CatalogService
    {
        return CatalogService::updateOrCreate(
            ['slug' => $slug],
            $attributes + ['kind' => $kind, 'sort_order' => $order, 'is_visible' => true],
        );
    }

    /** One plan per config plan, matched by name; features are rewritten in order. */
    private function plans(CatalogService $service, array $plans, bool $hosting = false): void
    {
        $service->plans()->whereNotIn('name', array_column($plans, 'name'))->delete();

        foreach (array_values($plans) as $i => $p) {
            $plan = CatalogPlan::updateOrCreate(
                ['service_id' => $service->id, 'name' => $p['name']],
                [
                    'sort_order' => $i + 1,
                    'price' => $hosting ? $p['price'] : PlanPrice::join($p),
                    'unit' => ($p['price'] ?? null) === null ? null : ($p['unit'] ?? null),
                    'period' => $p['period'] ?? null,
                    'billing' => $p['billing'] ?? null,
                    'summary' => $p['summary'] ?? null,
                    'description' => $p['description'] ?? null,
                    'meta' => $p['meta'] ?? null,
                    'cta' => $p['cta'] ?? 'Request this plan',
                    'plan_key' => $p['plan_key'] ?? null,
                    'is_featured' => $p['featured'],
                    'extra' => array_filter(['weeks' => $p['weeks'] ?? null, 'support_months' => $p['support_months'] ?? null]) ?: null,
                ],
            );

            $plan->features()->delete();
            $plan->features()->createMany(
                collect($p['features'])->map(fn ($text, $n) => ['sort_order' => $n + 1, 'text' => $text])->all()
            );
        }
    }
}

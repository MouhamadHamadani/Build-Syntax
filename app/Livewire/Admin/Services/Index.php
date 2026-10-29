<?php

namespace App\Livewire\Admin\Services;

use App\Models\CatalogPlan;
use App\Models\CatalogService;
use App\Models\ContactSubmission;
use App\Support\Catalog;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Url;
use Livewire\Component;

/**
 * Services and pricing: the editor for the catalog_* tables. Reads here always go to the
 * database (never the cached public arrays); every save clears that cache through the models.
 */
class Index extends Component
{
    public const MAX_PLANS = 6;
    public const MAX_FEATURES = 12;

    /** Columns each kind of service lets the editor change. */
    private const COLUMNS = [
        'product' => ['slug', 'name', 'label', 'project_type', 'accent', 'site_url', 'demo_url', 'demo_label', 'headline_price', 'headline_unit', 'description', 'note', 'is_visible'],
        'custom' => ['name', 'label', 'accent', 'headline_price', 'headline_unit', 'description', 'intro'],
        'hosting' => ['name', 'intro'],
        'maintenance' => ['name', 'intro'],
    ];

    /** Keys of the details JSON each kind lets the editor change (the rest is kept as it is). */
    private const DETAILS = [
        'product' => ['blurb', 'features', 'for', 'for_extra', 'for_extra_strong', 'service_note'],
        'custom' => ['headline', 'cta', 'stack', 'heading', 'points'],
        'hosting' => ['heading'],
        'maintenance' => ['heading', 'minimum_months'],
    ];

    #[Url(as: 'service')]
    public string $service = '';

    public array $form = [];

    public bool $planOpen = false;
    public ?int $planId = null;
    public array $plan = [];

    public bool $adding = false;
    public string $newName = '';

    public ?string $notice = null;
    public string $noticeType = 'success';

    public function mount(): void
    {
        $this->service = $this->current()?->slug ?? CatalogService::orderBy('sort_order')->orderBy('id')->value('slug') ?? '';
        $this->loadForm();
    }

    private function current(): ?CatalogService
    {
        return $this->service === '' ? null : CatalogService::with('plans.features')->where('slug', $this->service)->first();
    }

    private function say(string $text, string $type = 'success'): void
    {
        $this->notice = $text;
        $this->noticeType = $type;
    }

    // --- Services ------------------------------------------------------------------------------

    public function select(string $slug): void
    {
        $this->service = $slug;
        $this->planOpen = false;
        $this->adding = false;
        $this->notice = null;
        $this->resetValidation();
        $this->loadForm();
    }

    private function loadForm(): void
    {
        $s = $this->current();

        if (! $s) {
            $this->form = [];

            return;
        }

        $d = $s->details ?? [];
        $lines = fn (string $key) => implode("\n", $d[$key] ?? []);

        $this->form = [
            'slug' => $s->slug,
            'name' => $s->name,
            'label' => $s->label ?? '',
            'project_type' => $s->project_type ?? '',
            'accent' => $s->accent,
            'site_url' => $s->site_url ?? '',
            'demo_url' => $s->demo_url ?? '',
            'demo_label' => $s->demo_label ?? '',
            'headline_price' => $s->headline_price ?? '',
            'headline_unit' => $s->headline_unit ?? '',
            'description' => $s->description ?? '',
            'intro' => $s->intro ?? '',
            'note' => $s->note ?? '',
            'is_visible' => $s->is_visible,
            'blurb' => $d['blurb'] ?? '',
            'features' => $lines('features'),
            'for' => $d['for'] ?? '',
            'for_extra' => $d['for_extra'] ?? '',
            'for_extra_strong' => (bool) ($d['for_extra_strong'] ?? false),
            'service_note_strong' => $d['service_note']['strong'] ?? '',
            'service_note_text' => $d['service_note']['text'] ?? '',
            'headline' => $d['headline'] ?? '',
            'cta' => $d['cta'] ?? '',
            'stack' => $lines('stack'),
            'points' => $lines('points'),
            'heading' => $d['heading'] ?? '',
            'minimum_months' => (string) ($d['minimum_months'] ?? ''),
        ];
    }

    private function serviceRules(CatalogService $s): array
    {
        $text = 'nullable|string|max:1000';
        $url = 'nullable|url:http,https|max:255';
        $lines = ['nullable', 'string', fn ($attribute, $value, $fail) => collect(preg_split('/\R/', (string) $value))->contains(fn ($line) => mb_strlen(trim($line)) > 200)
            ? $fail('Each line can be at most 200 characters.') : null];

        return [
            'form.slug' => ['required', 'max:60', 'regex:/^[a-z0-9-]+$/', Rule::unique('catalog_services', 'slug')->ignore($s->id)],
            'form.name' => 'required|string|min:1|max:80',
            'form.label' => 'nullable|string|max:80',
            'form.project_type' => ['required', 'max:30', 'regex:/^[a-z0-9_]+$/'],
            'form.accent' => ['required', Rule::in(array_keys(Catalog::ACCENTS))],
            'form.site_url' => $url,
            'form.demo_url' => $url,
            'form.demo_label' => 'nullable|string|max:80',
            'form.headline_price' => 'nullable|string|max:40',
            'form.headline_unit' => 'nullable|string|max:60',
            'form.description' => $text,
            'form.intro' => $text,
            'form.note' => $text,
            'form.blurb' => $text,
            'form.for' => $text,
            'form.for_extra' => $text,
            'form.service_note_strong' => 'nullable|string|max:200',
            'form.service_note_text' => $text,
            'form.headline' => 'nullable|string|max:200',
            'form.cta' => 'nullable|string|max:80',
            'form.heading' => 'nullable|string|max:200',
            'form.minimum_months' => 'nullable|integer|min:0|max:60',
            'form.features' => $lines,
            'form.stack' => $lines,
            'form.points' => $lines,
        ];
    }

    public function saveService(): void
    {
        $s = $this->current();

        if (! $s) {
            return;
        }

        $columns = self::COLUMNS[$s->kind];
        $rules = array_intersect_key($this->serviceRules($s), array_flip(array_map(fn ($c) => "form.$c", [
            ...$columns, ...self::DETAILS[$s->kind],
            ...($s->kind === 'product' ? ['service_note_strong', 'service_note_text'] : []),
        ])));
        $this->validate($rules);

        $blank = fn ($value) => ($value = is_string($value) ? trim($value) : $value) === '' ? null : $value;
        $split = fn (string $value) => array_values(array_filter(array_map('trim', preg_split('/\R/', $value))));
        $f = $this->form;

        $details = $s->details ?? [];
        foreach (self::DETAILS[$s->kind] as $key) {
            $details[$key] = match ($key) {
                'features', 'stack', 'points' => $split($f[$key]),
                'for_extra_strong' => (bool) $f[$key],
                'minimum_months' => (int) $f[$key],
                'service_note' => ['strong' => trim($f['service_note_strong']), 'text' => trim($f['service_note_text'])],
                default => trim($f[$key]),
            };
        }

        $s->update(
            collect($columns)->mapWithKeys(fn ($c) => [$c => $c === 'is_visible' ? (bool) $f[$c] : $blank($f[$c])])->all()
            + ['details' => $details]
        );

        $this->service = $s->slug;
        $this->loadForm();
        $this->say('Saved. The change is live on the site.');
        $this->dispatch('saved');
    }

    public function startAdding(): void
    {
        $this->adding = true;
        $this->newName = '';
        $this->resetValidation();
    }

    public function addService(): void
    {
        $this->validate(['newName' => 'required|string|min:1|max:80'], attributes: ['newName' => 'name']);

        $slug = $base = Str::slug($this->newName) ?: 'service';
        for ($i = 2; CatalogService::where('slug', $slug)->exists(); $i++) {
            $slug = "$base-$i";
        }

        // Its own contact form type, unless that word is already one of the existing types.
        $existing = [...config('products.project_types'), ...CatalogService::whereNotNull('project_type')->pluck('project_type')];
        $type = $candidate = Str::limit(str_replace('-', '_', $slug), 30, '');
        for ($i = 2; in_array($type, $existing, true); $i++) {
            $type = Str::limit($candidate, 27, '') . "_$i";
        }

        CatalogService::create([
            'slug' => $slug, 'kind' => 'product', 'name' => trim($this->newName), 'label' => trim($this->newName),
            'project_type' => $type, 'accent' => 'brand', 'is_visible' => false,
            'sort_order' => (int) CatalogService::max('sort_order') + 1,
            'details' => ['anchor' => $slug, 'features' => [], 'for' => '', 'for_extra' => '', 'blurb' => ''],
        ]);

        $this->adding = false;
        $this->select($slug);
        $this->say('Service created and hidden. Fill in the details and add plans, then switch on "Visible on the site".');
    }

    public function deleteService(): void
    {
        $s = $this->current();

        if (! $s || ! $s->isProduct()) {
            return;
        }

        $onlyOwner = ! CatalogService::where('project_type', $s->project_type)->whereKeyNot($s->id)->exists();

        if ($onlyOwner && ContactSubmission::where('project_type', $s->project_type)->exists()) {
            $this->say("Cannot delete {$s->name}: it is the only service for the contact type \"{$s->project_type}\" and there are enquiries with that type. Hide it instead.", 'error');

            return;
        }

        $name = $s->name;
        $s->delete();
        $this->service = CatalogService::orderBy('sort_order')->orderBy('id')->value('slug') ?? '';
        $this->planOpen = false;
        $this->loadForm();
        $this->say("{$name} deleted.");
    }

    // --- Plans ---------------------------------------------------------------------------------

    private function blankPlan(string $kind): array
    {
        return [
            'name' => '', 'price' => '', 'unit' => '', 'period' => $kind === 'hosting' ? ' / year' : '', 'billing' => '',
            'summary' => '', 'description' => '', 'meta' => '', 'cta' => 'Request this plan',
            'is_featured' => false, 'features' => [''],
        ];
    }

    public function addPlan(): void
    {
        $s = $this->current();

        if (! $s) {
            return;
        }

        if ($s->plans->count() >= self::MAX_PLANS) {
            $this->say('A service can have at most ' . self::MAX_PLANS . ' plans.', 'error');

            return;
        }

        $this->planId = null;
        $this->plan = $this->blankPlan($s->kind);
        $this->planOpen = true;
        $this->resetValidation();
    }

    public function editPlan(int $id): void
    {
        $plan = $this->current()?->plans->firstWhere('id', $id);

        if (! $plan) {
            return;
        }

        $this->planId = $plan->id;
        $this->plan = [
            'name' => $plan->name, 'price' => $plan->price, 'unit' => $plan->unit ?? '', 'period' => $plan->period ?? '',
            'billing' => $plan->billing ?? '', 'summary' => $plan->summary ?? '', 'description' => $plan->description ?? '',
            'meta' => $plan->meta ?? '', 'cta' => $plan->cta, 'is_featured' => $plan->is_featured,
            'features' => $plan->features->pluck('text')->all() ?: [''],
        ];
        $this->planOpen = true;
        $this->resetValidation();
    }

    public function closePlan(): void
    {
        $this->planOpen = false;
        $this->resetValidation();
    }

    public function addFeature(): void
    {
        if (count($this->plan['features']) < self::MAX_FEATURES) {
            $this->plan['features'][] = '';
        } else {
            $this->say('A plan can have at most ' . self::MAX_FEATURES . ' features.', 'error');
        }
    }

    public function removeFeature(int $index): void
    {
        unset($this->plan['features'][$index]);
        $this->plan['features'] = array_values($this->plan['features']) ?: [''];
    }

    public function moveFeature(int $index, int $direction): void
    {
        $to = $index + $direction;
        $features = $this->plan['features'];

        if (isset($features[$to])) {
            [$features[$index], $features[$to]] = [$features[$to], $features[$index]];
            $this->plan['features'] = $features;
        }
    }

    public function savePlan(): void
    {
        $s = $this->current();

        if (! $s) {
            return;
        }

        $this->plan['features'] = array_values(array_filter(array_map(fn ($t) => trim((string) $t), $this->plan['features']), fn ($t) => $t !== ''));

        $this->validate([
            'plan.name' => 'required|string|min:1|max:80',
            'plan.price' => 'required|string|min:1|max:40',
            'plan.unit' => 'nullable|string|max:60',
            'plan.period' => 'nullable|string|max:60',
            'plan.billing' => 'nullable|string|max:120',
            'plan.summary' => 'nullable|string|max:1000',
            'plan.description' => 'nullable|string|max:1000',
            'plan.meta' => 'nullable|string|max:200',
            'plan.cta' => 'required|string|min:1|max:80',
            'plan.features' => 'array|max:' . self::MAX_FEATURES,
            'plan.features.*' => 'required|string|min:1|max:200',
        ], attributes: ['plan.price' => 'price', 'plan.name' => 'name', 'plan.cta' => 'button label']);

        $p = $this->plan;
        $blank = fn ($v) => trim((string) $v) === '' ? null : trim((string) $v);

        $attributes = [
            'name' => trim($p['name']), 'price' => trim($p['price']), 'unit' => $blank($p['unit']), 'period' => $blank($p['period']),
            'billing' => $blank($p['billing']), 'summary' => $blank($p['summary']), 'description' => $blank($p['description']),
            'meta' => $blank($p['meta']), 'cta' => trim($p['cta']), 'is_featured' => (bool) $p['is_featured'],
        ];

        if ($this->planId) {
            $plan = $s->plans->firstWhere('id', $this->planId);
            abort_unless($plan, 404);
            $plan->update($attributes);
        } else {
            if ($s->plans->count() >= self::MAX_PLANS) {
                $this->say('A service can have at most ' . self::MAX_PLANS . ' plans.', 'error');

                return;
            }

            $plan = $s->plans()->create($attributes + ['sort_order' => (int) $s->plans->max('sort_order') + 1]);
            $this->planId = $plan->id;
        }

        $old = $plan->features->pluck('text')->all();

        if ($old !== $p['features']) {
            $plan->features()->delete();
            $plan->features()->createMany(collect($p['features'])->map(fn ($text, $i) => ['sort_order' => $i + 1, 'text' => $text])->all());

            activity()->performedOn($plan)->causedBy(auth()->user())
                ->withProperties(['old' => ['features' => $old], 'attributes' => ['features' => $p['features']]])
                ->log('features updated');
        }

        $this->say("Plan \"{$plan->name}\" saved. The change is live on the site.");
        $this->dispatch('saved');
    }

    public function deletePlan(int $id): void
    {
        $plan = $this->current()?->plans->firstWhere('id', $id);

        if (! $plan) {
            return;
        }

        $name = $plan->name;
        $plan->delete();

        if ($this->planId === $id) {
            $this->planOpen = false;
        }

        $this->renumber();
        $this->say("Plan \"{$name}\" deleted.");
    }

    public function movePlan(int $id, int $direction): void
    {
        $ids = $this->current()?->plans->pluck('id')->all() ?? [];
        $from = array_search($id, $ids, true);
        $to = $from === false ? false : $from + $direction;

        if ($to === false || ! isset($ids[$to])) {
            return;
        }

        [$ids[$from], $ids[$to]] = [$ids[$to], $ids[$from]];

        foreach ($ids as $position => $planId) {
            CatalogPlan::whereKey($planId)->first()?->update(['sort_order' => $position + 1]);
        }
    }

    private function renumber(): void
    {
        foreach ($this->current()?->plans ?? [] as $position => $plan) {
            if ($plan->sort_order !== $position + 1) {
                $plan->update(['sort_order' => $position + 1]);
            }
        }
    }

    // --- Render --------------------------------------------------------------------------------

    public function render()
    {
        $services = CatalogService::withCount('plans')->orderBy('sort_order')->orderBy('id')->get();
        $current = $this->current();

        $preview = null;
        if ($current) {
            $anchor = in_array($current->kind, ['hosting', 'maintenance'], true) ? 'hosting' : ($current->details['anchor'] ?? $current->slug);
            $preview = route('services') . '#' . $anchor;
        }

        return view('livewire.admin.services.index', [
            'products' => $services->where('kind', 'product'),
            'others' => $services->where('kind', '!=', 'product'),
            'current' => $current,
            'accents' => Catalog::ACCENTS,
            'types' => collect([...config('products.project_types'), ...CatalogService::whereNotNull('project_type')->pluck('project_type'), $this->form['project_type'] ?? null])
                ->filter()->unique()->values(),
            'preview' => $preview,
            'maxPlans' => self::MAX_PLANS,
            'maxFeatures' => self::MAX_FEATURES,
        ])->layout('layouts.admin', ['title' => 'Services and pricing']);
    }
}

<?php

namespace App\Models;

use App\Models\Concerns\FlushesCatalogCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CatalogService extends Model
{
    use FlushesCatalogCache, LogsActivity;

    public const KINDS = ['product', 'custom', 'hosting', 'maintenance'];

    protected $fillable = [
        'slug', 'kind', 'name', 'label', 'project_type', 'accent', 'site_url', 'demo_url', 'demo_label',
        'headline_price', 'headline_unit', 'description', 'intro', 'note', 'is_visible', 'sort_order', 'details',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'details' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'label', 'slug', 'project_type', 'accent', 'headline_price', 'headline_unit', 'site_url', 'demo_url', 'is_visible'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function plans(): HasMany
    {
        return $this->hasMany(CatalogPlan::class, 'service_id')->orderBy('sort_order')->orderBy('id');
    }

    /** Only products can be hidden or deleted: the other kinds are fixed sections of the Services page. */
    public function isProduct(): bool
    {
        return $this->kind === 'product';
    }
}

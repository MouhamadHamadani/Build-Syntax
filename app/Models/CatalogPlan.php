<?php

namespace App\Models;

use App\Models\Concerns\FlushesCatalogCache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CatalogPlan extends Model
{
    use FlushesCatalogCache, LogsActivity;

    protected $fillable = [
        'service_id', 'sort_order', 'name', 'price', 'unit', 'period', 'billing', 'summary',
        'description', 'meta', 'cta', 'plan_key', 'is_featured', 'extra',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'extra' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price', 'unit', 'period', 'billing', 'summary', 'meta', 'cta', 'is_featured'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(CatalogService::class, 'service_id');
    }

    public function features(): HasMany
    {
        return $this->hasMany(CatalogPlanFeature::class, 'plan_id')->orderBy('sort_order')->orderBy('id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PortfolioProject extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'category',
        'technologies',
        'project_url',
        'image_url',
        'featured',
        'created_by',
    ];

    protected $casts = [
        'technologies' => 'array',
        'featured' => 'boolean',
        'created_at' => 'datetime',
    ];

    // Activity log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'category', 'featured'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopePublished($query)
    {
        return $query->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getTechnologiesListAttribute()
    {
        return is_array($this->technologies)
            ? implode(', ', $this->technologies)
            : $this->technologies;
    }
}

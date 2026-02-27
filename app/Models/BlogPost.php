<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class BlogPost extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'meta_title',
        'meta_description',
        'tags',
        'published',
        'published_at',
        'view_count',
        'created_by',
    ];

    protected $casts = [
        'tags' => 'array',
        'published' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            // Generate slug using blog title
            $slug = Str::slug($blog->title);

            // Ensure the slug is unique
            while (BlogPost::where('slug', $slug)->exists()) {
                $slug = Str::slug($blog->title);
            }

            $blog->slug = $slug;
        });
    }

    // Activity log
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'published', 'published_at'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published', true)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc');
    }

    public function scopeDraft($query)
    {
        return $query->where('published', false);
    }

    // Accessors
    public function getReadingTimeAttribute()
    {
        $words = str_word_count(strip_tags($this->content));
        $minutes = ceil($words / 200);
        return $minutes . ' min read';
    }

    // Methods
    public function incrementViewCount()
    {
        $this->increment('view_count');
    }
}

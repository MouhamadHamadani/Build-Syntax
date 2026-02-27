<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class NewsletterSubscription extends Model
{
    use HasFactory, Notifiable;

    const UPDATED_AT = null; // No updated_at column

    protected $fillable = [
        'email',
        'name',
        'status',
        'source',
        'confirmation_token',
        'confirmed',
        'confirmed_at',
        'subscribed_at',
        'unsubscribed_at',
    ];

    protected $casts = [
        'confirmed' => 'boolean',
        'confirmed_at' => 'datetime',
        'subscribed_at' => 'datetime',
        'unsubscribed_at' => 'datetime',
    ];

    // Boot
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            if (empty($subscription->confirmation_token)) {
                $subscription->confirmation_token = Str::random(64);
            }
        });
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
            ->where('confirmed', true);
    }

    public function scopeUnconfirmed($query)
    {
        return $query->where('confirmed', false);
    }

    // Methods
    public function confirm()
    {
        $this->update([
            'confirmed' => true,
            'confirmed_at' => now(),
            'status' => 'active',
        ]);
    }

    public function unsubscribe()
    {
        $this->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => now(),
        ]);
    }
}

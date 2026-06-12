<?php

namespace App\Livewire\Components;

use App\Models\NewsletterSubscription;
use App\Notifications\ConfirmNewsletterSubscription;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class NewsletterSubscribe extends Component
{
    public $email = '';
    public $name = '';

    protected $rules = [
        'email' => 'required|email|max:255',
        'name' => 'nullable|string|max:255',
    ];

    public function subscribe()
    {
        // Rate limiting (mirrors the contact form: 3 attempts / 5 minutes per IP)
        $key = 'newsletter-subscribe:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('email', 'Too many attempts. Please try again later.');

            return;
        }

        $this->validate();

        RateLimiter::hit($key, 300); // 5 minutes

        try {
            $existing = NewsletterSubscription::where('email', $this->email)->first();

            if ($existing && $existing->status === 'active' && $existing->confirmed) {
                // Already subscribed: respond with the same generic message so the
                // form cannot be used to enumerate subscriber emails.
                session()->flash('newsletter_success', 'Thank you for subscribing! Please check your email to confirm.');

                $this->reset();

                return;
            }

            if ($existing) {
                // Unsubscribed (or never-confirmed) row: reactivate and re-run the
                // double opt-in flow instead of failing on the unique email column.
                $existing->update([
                    'name' => $this->name ?: $existing->name,
                    'status' => 'active',
                    'confirmed' => false,
                    'confirmed_at' => null,
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                    'source' => 'website',
                ]);

                $subscription = $existing;
            } else {
                $subscription = NewsletterSubscription::create([
                    'email' => $this->email,
                    'name' => $this->name,
                    'source' => 'website',
                ]);
            }

            // Send confirmation email first; only flash success once it succeeds.
            $subscription->notify(new ConfirmNewsletterSubscription($subscription));

            session()->flash('newsletter_success', 'Thank you for subscribing! Please check your email to confirm.');

            $this->reset();
        } catch (Exception $e) {
            $this->addError('email', 'An error occurred. Please try again.');
            Log::error('Newsletter form error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.components.newsletter-subscribe');
    }
}

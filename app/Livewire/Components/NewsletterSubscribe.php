<?php

namespace App\Livewire\Components;

use App\Models\NewsletterSubscription;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewsletterSubscribe extends Component
{
    public $email = '';
    public $name = '';

    protected $rules = [
        'email' => 'required|email|unique:newsletter_subscriptions,email',
        'name' => 'nullable|string|max:255',
    ];

    public function subscribe()
    {
        $this->validate();

        try {
            $subscription = NewsletterSubscription::create([
                'email' => $this->email,
                'name' => $this->name,
                'source' => 'website',
            ]);

            session()->flash('newsletter_success', 'Thank you for subscribing! Please check your email to confirm.');

        // Send confirmation email
        // $subscription->notify(new ConfirmNewsletterSubscription());

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

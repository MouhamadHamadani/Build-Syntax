<?php

namespace App\Livewire;

use App\Models\NewsletterSubscription;
use App\Notifications\ConfirmNewsletterSubscription;
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

        $subscription = NewsletterSubscription::create([
            'email' => $this->email,
            'name' => $this->name,
            'source' => 'website',
        ]);

        // Send confirmation email
        $subscription->notify(new ConfirmNewsletterSubscription($subscription));

        session()->flash('message', 'Please check your email to confirm your subscription!');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.newsletter-subscribe');
    }
}

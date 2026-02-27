<?php

namespace App\Livewire\Pages;

use App\Models\NewsletterSubscription;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewsletterUnsubscribe extends Component
{
    public $token;
    public $status = 'confirm'; // confirm, processing, success, error
    public $message = '';
    public $subscription = null;

    public function mount($token)
    {
        $this->token = $token;
        $this->loadSubscription();
    }

    public function loadSubscription()
    {
        $this->subscription = NewsletterSubscription::where('confirmation_token', $this->token)->first();

        if (!$this->subscription) {
            $this->status = 'error';
            $this->message = 'Invalid unsubscribe link. Please contact support if you need assistance.';
        } elseif ($this->subscription->status === 'unsubscribed') {
            $this->status = 'success';
            $this->message = 'You have already been unsubscribed from our newsletter.';
        }
    }

    public function confirmUnsubscribe()
    {
        $this->status = 'processing';

        try {
            if (!$this->subscription) {
                throw new Exception('Subscription not found');
            }

            $this->subscription->unsubscribe();

            $this->status = 'success';
            $this->message = 'You have been successfully unsubscribed. We\'re sorry to see you go!';

        } catch (Exception $e) {
            $this->status = 'error';
            $this->message = 'An error occurred. Please try again or contact support.';
            Log::error('Newsletter unsubscribe error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.newsletter-unsubscribe')
            ->layout('layouts.app', [
                'title' => 'Unsubscribe from Newsletter - Build Syntax',
                'description' => 'Unsubscribe from Build Syntax newsletter.'
            ]);
    }
}
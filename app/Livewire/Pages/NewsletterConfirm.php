<?php

namespace App\Livewire\Pages;

use App\Models\NewsletterSubscription;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NewsletterConfirm extends Component
{
    public $token;
    public $status = 'processing'; // processing, success, error, already_confirmed
    public $message = '';

    public function mount($token)
    {
        $this->token = $token;
        $this->confirmSubscription();
    }

    public function confirmSubscription()
    {
        try {
            $subscription = NewsletterSubscription::where('confirmation_token', $this->token)->first();

            if (!$subscription) {
                $this->status = 'error';
                $this->message = 'Invalid confirmation link. Please try subscribing again.';
                return;
            }

            if ($subscription->confirmed) {
                $this->status = 'already_confirmed';
                $this->message = 'Your email is already confirmed. Thank you!';
                return;
            }

            $subscription->confirm();

            $this->status = 'success';
            $this->message = 'Thank you! Your email has been confirmed. You\'ll now receive our newsletter.';

        } catch (Exception $e) {
            $this->status = 'error';
            $this->message = 'An error occurred. Please try again or contact support.';
            Log::error('Newsletter confirmation error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pages.newsletter-confirm')
            ->layout('layouts.app', [
                'title' => 'Confirm Newsletter Subscription - Build Syntax',
                'description' => 'Confirm your newsletter subscription to receive updates from Build Syntax.'
            ]);
    }
}
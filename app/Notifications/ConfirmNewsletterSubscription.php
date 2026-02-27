<?php

namespace App\Notifications;

use App\Models\NewsletterSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmNewsletterSubscription extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly NewsletterSubscription $subscription
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $confirmUrl = route('newsletter.confirm', $this->subscription->confirmation_token);
        $unsubscribeUrl = route('newsletter.unsubscribe', $this->subscription->confirmation_token);
        $name = $this->subscription->name ?? 'there';

        return (new MailMessage)
            ->subject('Confirm your subscription to Build Syntax Newsletter')
            ->view('emails.newsletter.confirm', [
                'name'           => $name,
                'confirmUrl'     => $confirmUrl,
                'unsubscribeUrl' => $unsubscribeUrl,
            ]);
    }
}
<?php

namespace App\Notifications;

use App\Models\ContactSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactSubmission extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly ContactSubmission $submission
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $projectTypeLabels = [
            'website'    => 'Website',
            'ecommerce'  => 'E-Commerce',
            'mobile_app' => 'Mobile App',
            'other'      => 'Other',
        ];

        $projectType = $projectTypeLabels[$this->submission->project_type] ?? $this->submission->project_type;

        return (new MailMessage)
            ->subject("🔔 New Contact Submission from {$this->submission->name}")
            ->view('emails.contact.admin-notification', [
                'submission'  => $this->submission,
                'projectType' => $projectType,
            ]);
    }
}
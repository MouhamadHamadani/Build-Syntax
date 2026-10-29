<?php

namespace App\Support;

use App\Models\ContactSubmission;

/**
 * What the admin shows about a contact-form enquiry: the product it is for, the plan the
 * Services buttons pre-filled, and whether it has waited too long for a reply.
 */
class Enquiry
{
    /** Hours a new enquiry may wait before the dashboard marks it overdue. */
    public const OVERDUE_HOURS = 24;

    /** Budget select values on the contact form, with their labels. */
    public const BUDGETS = [
        'under_1k' => 'Under $1,000',
        '1k_2.5k' => '$1,000 - $2,500',
        '2.5k_5k' => '$2,500 - $5,000',
        '5k_plus' => '$5,000+',
    ];

    /** Status values in pipeline order: label and badge class. */
    public const STATUSES = [
        'new' => ['New', 'bd-new'],
        'contacted' => ['Contacted', 'bd-warn'],
        'in_progress' => ['In progress', 'bd-progress'],
        'completed' => ['Completed', 'bd-done'],
        'declined' => ['Declined', 'bd-danger'],
    ];

    /** Priority values, lowest first: label and badge class. */
    public const PRIORITIES = [
        'low' => ['Low', 'bd-neutral'],
        'medium' => ['Medium', 'bd-neutral'],
        'high' => ['High', 'bd-warn'],
        'urgent' => ['Urgent', 'bd-danger'],
    ];

    /** "Today 18:04", "Yesterday", or "27 Oct" (with the year when it is not this year). */
    public static function received(\DateTimeInterface $date): string
    {
        $date = \Illuminate\Support\Carbon::instance($date);

        return match (true) {
            $date->isToday() => 'Today '.$date->format('H:i'),
            $date->isYesterday() => 'Yesterday',
            $date->isCurrentYear() => $date->format('j M'),
            default => $date->format('j M Y'),
        };
    }

    /** @return array{name: string, accent: string} accent is an accent-* suffix, or "neutral" for an unknown type */
    public static function product(?string $type): array
    {
        $catalog = app(Catalog::class);
        $custom = $catalog->custom();
        $product = collect($catalog->products())->firstWhere('project_type', $type);

        return [
            'name' => $product['name'] ?? $catalog->projectTypeLabels()[$type] ?? ucfirst(str_replace('_', ' ', (string) $type)),
            'accent' => $product['accent'] ?? ($type === $custom['project_type'] ? $custom['accent'] : 'neutral'),
        ];
    }

    /** The plan name when the message starts with "I'm interested in the {plan} plan." (what Contact.php writes). */
    public static function plan(ContactSubmission $contact): ?string
    {
        return preg_match("/^I'm interested in the (.+?) plan\./u", (string) $contact->message, $m) ? $m[1] : null;
    }

    public static function isOverdue(ContactSubmission $contact): bool
    {
        return $contact->status === 'new' && $contact->created_at->lte(now()->subHours(self::OVERDUE_HOURS));
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\ContactSubmission;
use App\Notifications\NewContactSubmission;
use App\Support\Catalog;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class Contact extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $project_type = 'website';
    public $budget_range = '';
    public $message = '';

    protected function rules(): array
    {
        return [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:150',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:100',
            'project_type' => 'required|in:' . implode(',', config('products.project_types')),
            'budget_range' => 'nullable|in:under_1k,1k_2.5k,2.5k_5k,5k_plus',
            'message' => 'required|min:10',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter your name.',
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'message.required' => 'Please tell us about your project.',
        'message.min' => 'Please provide more details about your project (at least 10 characters).',
    ];

    public function mount()
    {
        // CTA context prefill (e.g. /contact?type=ecommerce&plan=Standard).
        $type = request()->query('type');

        if (is_string($type) && in_array($type, config('products.project_types'), true)) {
            $this->project_type = $type;
        }

        $plan = request()->query('plan');

        if (
            $this->message === ''
            && is_string($plan)
            && preg_match('/^[A-Za-z0-9][A-Za-z0-9 _.\-]{0,49}$/', $plan)
        ) {
            $this->message = "I'm interested in the {$plan} plan.";
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        // Rate limiting
        $key = 'contact-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('form', 'Too many submissions. Please try again later.');

            return;
        }

        $validated = $this->validate();

        try {
            $submission = ContactSubmission::create($validated);

            // Send notification to admin
            Notification::route('mail', config('mail.admin_email'))
                ->notify(new NewContactSubmission($submission));

            RateLimiter::hit($key, 300); // 5 minutes

            session()->flash('success', 'Thank you for contacting us! We\'ll get back to you within 24 hours.');

            $this->reset();
        } catch (Exception $e) {
            $this->addError('form', 'Sorry, there was an error submitting your message. Please try again or email us directly.');
            Log::error('Contact form error: ' . $e->getMessage());
        }
    }

    /** FAQ items; timelines, support periods and the maintenance range come from the Catalog. */
    private function faqs(Catalog $catalog): array
    {
        [$starter, $professional] = $catalog->custom()['service']['plans'];
        $shopWeeks = array_column($catalog->product('shopnex')['plans'], 'weeks');
        $care = $catalog->maintenance();
        $carePrices = array_column($care['plans'], 'price');

        return [
            [
                'q' => 'How long does a project take?',
                'a' => "A starter website takes {$starter['weeks'][0]} to {$starter['weeks'][1]} weeks and a professional one {$professional['weeks'][0]} to {$professional['weeks'][1]}. A ShopNex store takes " . min(array_column($shopWeeks, 0)) . ' to ' . max(array_column($shopWeeks, 1)) . ' weeks depending on the plan. We confirm the timeline in writing before we start.',
            ],
            [
                'q' => 'What is included in a website project?',
                'a' => "Design, development, testing, deployment help and a documented handover, plus a support period of {$starter['support_months']} to {$professional['support_months']} months depending on the package. The exact list is on the Services page.",
            ],
            [
                'q' => 'Do you offer maintenance after launch?',
                'a' => "Yes. Maintenance plans run from {$carePrices[0]} to " . end($carePrices) . " a month, with a minimum of {$care['minimum_months']} months. Details are on the Services page.",
            ],
            [
                'q' => 'Can you work with businesses outside Lebanon?',
                'a' => 'Yes. Most of the work happens online, and we work with businesses across the region.',
            ],
        ];
    }

    public function render()
    {
        $catalog = app(Catalog::class);

        return view('livewire.pages.contact', [
            'types' => $catalog->projectTypes(),
            'typeLabels' => $catalog->projectTypeLabels(),
            'faqs' => $this->faqs($catalog),
        ])
            ->layout('layouts.app', [
                'title' => 'Contact Us - Build Syntax',
                'description' => 'Get in touch with Build Syntax for your web development needs. Contact us for a free consultation and project quote.'
            ]);
    }
}

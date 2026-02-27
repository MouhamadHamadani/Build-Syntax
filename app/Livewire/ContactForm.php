<?php

namespace App\Livewire;

use App\Models\ContactSubmission;
use App\Notifications\NewContactSubmission;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';
    public $email = '';
    public $phone = '';
    public $company = '';
    public $project_type = 'website';
    public $budget_range = '';
    public $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'nullable|string',
        'company' => 'nullable|string',
        'project_type' => 'required|in:website,ecommerce,mobile_app,other',
        'budget_range' => 'nullable|string',
        'message' => 'required|min:10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $validated = $this->validate();

        $submission = ContactSubmission::create($validated);

        // Send notification to admin
        Notification::route('mail', config('mail.admin_email'))
            ->notify(new NewContactSubmission($submission));

        session()->flash('message', 'Thank you for contacting us! We\'ll get back to you soon.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
<?php

namespace App\Livewire\Admin\Newsletter;

use App\Models\NewsletterSubscription;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    protected $queryString = ['search', 'status'];

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingStatus(): void { $this->resetPage(); }

    public function unsubscribe(int $id): void
    {
        NewsletterSubscription::findOrFail($id)->unsubscribe();
        session()->flash('success', 'Subscriber removed.');
    }

    public function render()
    {
        $subscribers = NewsletterSubscription::latest('subscribed_at')
            ->when($this->search, fn($q) => $q->where('email', 'like', "%{$this->search}%")
                                              ->orWhere('name', 'like', "%{$this->search}%"))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->paginate(25);

        $totals = [
            'active'       => NewsletterSubscription::active()->count(),
            'unconfirmed'  => NewsletterSubscription::unconfirmed()->count(),
            'unsubscribed' => NewsletterSubscription::where('status', 'unsubscribed')->count(),
        ];

        return view('livewire.admin.newsletter.index', compact('subscribers', 'totals'))
            ->layout('layouts.admin', ['title' => 'Newsletter Subscribers']);
    }
}
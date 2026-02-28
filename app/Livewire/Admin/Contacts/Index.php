<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactSubmission;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search   = '';
    public string $status   = '';
    public string $priority = '';

    protected $queryString = ['search', 'status', 'priority'];

    public function updatingSearch(): void  { $this->resetPage(); }
    public function updatingStatus(): void  { $this->resetPage(); }
    public function updatingPriority(): void { $this->resetPage(); }

    public function render()
    {
        $submissions = ContactSubmission::latest()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                                              ->orWhere('email', 'like', "%{$this->search}%"))
            ->when($this->status,   fn($q) => $q->where('status', $this->status))
            ->when($this->priority, fn($q) => $q->where('priority', $this->priority))
            ->paginate(20);

        return view('livewire.admin.contacts.index', compact('submissions'))
            ->layout('layouts.admin', ['title' => 'Contact Submissions']);
    }
}
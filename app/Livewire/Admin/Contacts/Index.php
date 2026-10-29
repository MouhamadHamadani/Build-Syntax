<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactSubmission;
use App\Support\Catalog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search   = '';
    public string $status   = '';
    public string $priority = '';
    public string $product  = '';

    protected $queryString = ['search', 'status', 'priority', 'product'];

    public function updatingSearch(): void  { $this->resetPage(); }
    public function updatingStatus(): void  { $this->resetPage(); }
    public function updatingPriority(): void { $this->resetPage(); }
    public function updatingProduct(): void { $this->resetPage(); }

    public function setStatus(string $status): void
    {
        $this->status = $status;
        $this->resetPage();
    }

    public function render()
    {
        $submissions = ContactSubmission::latest()
            ->when($this->search, fn($q) => $q->where(fn($sub) => $sub->where('name', 'like', "%{$this->search}%")
                                                                      ->orWhere('email', 'like', "%{$this->search}%")
                                                                      ->orWhere('company', 'like', "%{$this->search}%")))
            ->when($this->status,   fn($q) => $q->where('status', $this->status))
            ->when($this->priority, fn($q) => $q->where('priority', $this->priority))
            ->when($this->product,  fn($q) => $q->where('project_type', $this->product))
            ->paginate(20);

        // Tab counts, one grouped query.
        $counts = ContactSubmission::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');

        return view('livewire.admin.contacts.index', [
            'submissions' => $submissions,
            'counts' => $counts,
            'total' => $counts->sum(),
            'productLabels' => app(Catalog::class)->projectTypeLabels(),
        ])->layout('layouts.admin', ['title' => 'Contacts']);
    }
}

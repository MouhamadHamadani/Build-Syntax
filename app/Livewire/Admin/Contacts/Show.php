<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactSubmission;
use App\Support\Enquiry;
use Livewire\Component;

class Show extends Component
{
    public ContactSubmission $submission;

    public string $status   = '';
    public string $priority = '';
    public string $notes    = '';

    public function mount(int $id): void
    {
        $this->submission = ContactSubmission::findOrFail($id);
        $this->status     = $this->submission->status;
        $this->priority   = $this->submission->priority;
        $this->notes      = $this->submission->notes ?? '';
    }

    public function update(): void
    {
        $this->validate([
            'status'   => 'required|in:new,contacted,in_progress,completed,declined',
            'priority' => 'required|in:low,medium,high,urgent',
            'notes'    => 'nullable|string|max:5000',
        ]);

        $this->submission->update([
            'status'   => $this->status,
            'priority' => $this->priority,
            'notes'    => $this->notes,
        ]);
        session()->flash('success', 'Submission updated.');
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.admin.contacts.show', [
            'product' => Enquiry::product($this->submission->project_type),
            'plan' => Enquiry::plan($this->submission),
            'statuses' => Enquiry::STATUSES,
            'priorities' => Enquiry::PRIORITIES,
            'budgets' => Enquiry::BUDGETS,
            'overdueHours' => Enquiry::OVERDUE_HOURS,
        ])->layout('layouts.admin', ['title' => 'Contact: ' . $this->submission->name]);
    }
}

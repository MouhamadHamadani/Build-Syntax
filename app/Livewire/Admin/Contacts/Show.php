<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\ContactSubmission;
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
        $this->submission->update([
            'status'   => $this->status,
            'priority' => $this->priority,
            'notes'    => $this->notes,
        ]);
        session()->flash('success', 'Submission updated.');
    }

    public function render()
    {
        return view('livewire.admin.contacts.show')
            ->layout('layouts.admin', ['title' => 'Contact: ' . $this->submission->name]);
    }
}
<?php

namespace App\Livewire\Admin\Portfolio;

use App\Models\PortfolioProject;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void { $this->resetPage(); }

    public function toggleFeatured(int $id): void
    {
        $project = PortfolioProject::findOrFail($id);
        $project->update(['featured' => !$project->featured]);
        session()->flash('success', 'Featured status updated.');
    }

    public function delete(int $id): void
    {
        PortfolioProject::findOrFail($id)->delete();
        session()->flash('success', 'Project deleted.');
    }

    public function render()
    {
        $projects = PortfolioProject::latest()
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->paginate(15);

        return view('livewire.admin.portfolio.index', compact('projects'))
            ->layout('layouts.admin', ['title' => 'Portfolio']);
    }
}
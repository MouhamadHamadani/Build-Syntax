<?php

namespace App\Livewire\Pages;

use App\Models\PortfolioProject;
use Livewire\Component;
use Livewire\WithPagination;

class Portfolio extends Component
{
    use WithPagination;

    public $category = 'all';
    public $search = '';
    public $selectedProject = null;
    
    protected $queryString = [
        'category' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function filterByCategory($category)
    {
        $this->category = $category;
    }

    public function viewProject($id)
    {
        $this->selectedProject = PortfolioProject::with('creator')->find($id);
        $this->dispatch('open-modal', 'project-modal');
    }

    public function closeModal()
    {
        $this->selectedProject = null;
    }

    public function render()
    {
        $query = PortfolioProject::query()->published();

        if ($this->category !== 'all') {
            $query->byCategory($this->category);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.pages.portfolio', [
            'projects' => $query->paginate(12),
            'categories' => ['all', 'web', 'ecommerce', 'mobile', 'other'],
        ])->layout('layouts.app', [
            'title' => 'Portfolio - Build Syntax',
            'description' => 'Explore our portfolio of successful web development projects including custom websites, e-commerce platforms, and mobile applications.'
        ]);
    }
}
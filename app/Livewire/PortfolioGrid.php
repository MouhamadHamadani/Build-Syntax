<?php

namespace App\Livewire;

use App\Models\PortfolioProject;
use Livewire\Component;
use Livewire\WithPagination;

class PortfolioGrid extends Component
{
use WithPagination;

    public $category = 'all';
    public $search = '';
    
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

        return view('livewire.portfolio-grid', [
            'projects' => $query->paginate(12),
            'categories' => PortfolioProject::distinct()->pluck('category'),
        ]);
    }
}

<?php

namespace App\Livewire\Pages;

use App\Models\PortfolioProject;
use App\Support\Catalog;
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
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category']);
        $this->resetPage();
    }

    public function viewProject($id)
    {
        $this->selectedProject = PortfolioProject::with('creator')->find($id);
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

        $catalog = app(Catalog::class);

        return view('livewire.pages.portfolio', [
            'projects' => $query->paginate(12),
            'categoryLabels' => $catalog->portfolioCategories(),
            'products' => $catalog->products(),
        ])->layout('layouts.app', [
            'title' => 'Portfolio - Build Syntax',
            'description' => 'Our portfolio: CarteNex, ShopNex, Tymelo and LebaSouk POS, four products we built with live demos, plus client projects as they launch.'
        ]);
    }
}
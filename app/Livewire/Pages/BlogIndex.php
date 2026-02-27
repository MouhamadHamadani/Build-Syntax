<?php

namespace App\Livewire\Pages;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use WithPagination;

    public $search = '';
    
    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = BlogPost::published()->with('creator');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('title', 'like', "%{$this->search}%")
                  ->orWhere('excerpt', 'like', "%{$this->search}%")
                  ->orWhere('content', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.pages.blog-index', [
            'posts' => $query->paginate(9),
            'featuredPost' => BlogPost::published()->latest('published_at')->first(),
        ])->layout('layouts.app', [
            'title' => 'Blog - Build Syntax',
            'description' => 'Read our latest articles on web development, technology trends, and business growth strategies.'
        ]);
    }
}
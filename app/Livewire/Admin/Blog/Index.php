<?php

namespace App\Livewire\Admin\Blog;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filter = 'all'; // all, published, draft

    protected $queryString = ['search', 'filter'];

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingFilter(): void { $this->resetPage(); }

    public function togglePublish(int $id): void
    {
        $post = BlogPost::findOrFail($id);
        $post->update([
            'published'    => !$post->published,
            'published_at' => !$post->published ? now() : $post->published_at,
        ]);
        session()->flash('success', $post->published ? 'Post published.' : 'Post moved to drafts.');
    }

    public function delete(int $id): void
    {
        BlogPost::findOrFail($id)->delete();
        session()->flash('success', 'Post deleted.');
    }

    public function render()
    {
        $query = BlogPost::withTrashed(false)->latest();

        if ($this->search) {
            $query->where('title', 'like', "%{$this->search}%");
        }

        if ($this->filter === 'published') {
            $query->where('published', true);
        } elseif ($this->filter === 'draft') {
            $query->where('published', false);
        }

        return view('livewire.admin.blog.index', [
            'posts' => $query->paginate(15),
        ])->layout('layouts.admin', ['title' => 'Blog Posts']);
    }
}
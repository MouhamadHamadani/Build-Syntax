<?php

namespace App\Livewire\Admin\Blog;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public string $title        = '';
    public string $excerpt      = '';
    public string $content      = '';
    public string $author       = '';
    public string $meta_title   = '';
    public string $meta_description = '';
    public string $tags_input   = ''; // comma-separated input
    public bool   $published    = false;

    protected $rules = [
        'title'            => 'required|string|max:255',
        'excerpt'          => 'nullable|string|max:500',
        'content'          => 'required|string',
        'author'           => 'nullable|string|max:100',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:320',
        'tags_input'       => 'nullable|string',
        'published'        => 'boolean',
    ];

    public function mount(): void
    {
        $this->author = Auth::user()->name;
    }

    public function save(): void
    {
        $this->validate();

        $tags = array_filter(array_map('trim', explode(',', $this->tags_input)));

        BlogPost::create([
            'title'            => $this->title,
            'excerpt'          => $this->excerpt,
            'content'          => $this->content,
            'author'           => $this->author ?: 'Build Syntax Team',
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'tags'             => !empty($tags) ? $tags : null,
            'published'        => $this->published,
            'published_at'     => $this->published ? now() : null,
            'created_by'       => Auth::id(),
        ]);

        session()->flash('success', 'Blog post created successfully.');
        $this->redirect(route('admin.blog.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.blog.create')
            ->layout('layouts.admin', ['title' => 'New Blog Post']);
    }
}
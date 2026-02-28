<?php

namespace App\Livewire\Admin\Blog;

use App\Models\BlogPost;
use Livewire\Component;

class Edit extends Component
{
    public BlogPost $post;

    public string $title        = '';
    public string $slug         = '';
    public string $excerpt      = '';
    public string $content      = '';
    public string $author       = '';
    public string $meta_title   = '';
    public string $meta_description = '';
    public string $tags_input   = '';
    public bool   $published    = false;

    protected $rules = [
        'title'            => 'required|string|max:255',
        'slug'             => 'required|string|max:255',
        'excerpt'          => 'nullable|string|max:500',
        'content'          => 'required|string',
        'author'           => 'nullable|string|max:100',
        'meta_title'       => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:320',
        'tags_input'       => 'nullable|string',
        'published'        => 'boolean',
    ];

    public function mount(int $id): void
    {
        $this->post = BlogPost::findOrFail($id);

        $this->title             = $this->post->title;
        $this->slug              = $this->post->slug;
        $this->excerpt           = $this->post->excerpt ?? '';
        $this->content           = $this->post->content;
        $this->author            = $this->post->author;
        $this->meta_title        = $this->post->meta_title ?? '';
        $this->meta_description  = $this->post->meta_description ?? '';
        $this->tags_input        = $this->post->tags ? implode(', ', $this->post->tags) : '';
        $this->published         = $this->post->published;
    }

    public function save(): void
    {
        $this->validate();

        $tags = array_filter(array_map('trim', explode(',', $this->tags_input)));

        $wasPublished = $this->post->published;

        $this->post->update([
            'title'            => $this->title,
            'slug'             => $this->slug,
            'excerpt'          => $this->excerpt,
            'content'          => $this->content,
            'author'           => $this->author ?: 'Build Syntax Team',
            'meta_title'       => $this->meta_title,
            'meta_description' => $this->meta_description,
            'tags'             => !empty($tags) ? $tags : null,
            'published'        => $this->published,
            'published_at'     => $this->published && !$wasPublished ? now() : $this->post->published_at,
        ]);

        session()->flash('success', 'Post updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.blog.edit')
            ->layout('layouts.admin', ['title' => 'Edit: ' . $this->post->title]);
    }
}
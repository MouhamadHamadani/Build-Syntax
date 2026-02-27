<?php

namespace App\Livewire\Pages;

use App\Models\BlogPost;
use Livewire\Component;

class BlogShow extends Component
{
    public BlogPost $post;

    public function mount($slug)
    {
        $this->post = BlogPost::where('slug', $slug)
            ->where('published', true)
            ->with('creator')
            ->firstOrFail();

        // Increment view count
        $this->post->incrementViewCount();
    }

    public function render()
    {
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $this->post->id)
            ->take(3)
            ->get();

        return view('livewire.pages.blog-show', [
            'relatedPosts' => $relatedPosts,
        ])->layout('layouts.app', [
            'title' => $this->post->meta_title ?? $this->post->title . ' - Build Syntax Blog',
            'description' => $this->post->meta_description ?? $this->post->excerpt
        ]);
    }
}
<?php

namespace App\Livewire\Admin;

use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscription;
use App\Models\PortfolioProject;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard', [
            'stats' => [
                'contacts_new'        => ContactSubmission::where('status', 'new')->count(),
                'contacts_total'      => ContactSubmission::count(),
                'blog_published'      => BlogPost::where('published', true)->count(),
                'blog_drafts'         => BlogPost::where('published', false)->count(),
                'portfolio_total'     => PortfolioProject::count(),
                'newsletter_active'   => NewsletterSubscription::active()->count(),
                'newsletter_total'    => NewsletterSubscription::count(),
            ],
            'recentContacts'  => ContactSubmission::latest()->take(5)->get(),
            'recentPosts'     => BlogPost::latest()->take(5)->get(),
        ])->layout('layouts.admin', ['title' => 'Dashboard']);
    }
}
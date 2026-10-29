<?php

namespace App\Livewire\Admin;

use App\Models\BlogPost;
use App\Models\ContactSubmission;
use App\Models\NewsletterSubscription;
use App\Models\PortfolioProject;
use App\Support\Enquiry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $now = now();
        $hour = (int) $now->format('G');

        // One grouped query: enquiries per product, biggest first.
        $byType = ContactSubmission::selectRaw('project_type, count(*) as total')
            ->groupBy('project_type')
            ->orderByDesc('total')
            ->pluck('total', 'project_type');

        $max = max(1, (int) $byType->max());

        $enquiriesByProduct = $byType->map(fn ($total, $type) => Enquiry::product($type) + [
            'total' => $total,
            'percent' => max(4, (int) round($total / $max * 100)),
        ])->values();

        return view('livewire.admin.dashboard', [
            'firstName' => Str::before(Auth::user()->name, ' '),
            'greeting' => $hour < 12 ? 'Good morning' : ($hour < 18 ? 'Good afternoon' : 'Good evening'),
            'today' => $now->format('l, j F'),
            'stats' => [
                'contacts_new'        => ContactSubmission::where('status', 'new')->count(),
                'contacts_total'      => ContactSubmission::count(),
                'blog_published'      => BlogPost::where('published', true)->count(),
                'blog_drafts'         => BlogPost::where('published', false)->count(),
                'portfolio_total'     => PortfolioProject::count(),
                'newsletter_active'   => NewsletterSubscription::active()->count(),
                'newsletter_total'    => NewsletterSubscription::count(),
                'newsletter_pending'  => NewsletterSubscription::unconfirmed()->count(),
            ],
            // Oldest first: the one that has waited longest is on top.
            'needsReply' => ContactSubmission::new()->oldest()->take(5)->get(),
            'enquiriesByProduct' => $enquiriesByProduct,
            'overdueHours' => Enquiry::OVERDUE_HOURS,
        ])->layout('layouts.admin', ['title' => 'Dashboard']);
    }
}

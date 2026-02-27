<?php

use App\Livewire\ContactForm;
use App\Livewire\NewsletterSubscribe;
use App\Livewire\Pages\About;
use App\Livewire\Pages\BlogIndex;
use App\Livewire\Pages\BlogShow;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\NewsletterConfirm;
use App\Livewire\Pages\NewsletterUnsubscribe;
use App\Livewire\Pages\Portfolio;
use App\Livewire\Pages\Services;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;

RateLimiter::for('contact', function (Request $request) {
    return Limit::perMinute(3)->by($request->ip());
});

RateLimiter::for('newsletter', function (Request $request) {
    return Limit::perMinute(2)->by($request->ip());
});

// Public routes
Route::get('/', Home::class)->name('home');
Route::get('/services', Services::class)->name('services');
Route::get('/portfolio', Portfolio::class)->name('portfolio');
Route::get('/about', About::class)->name('about');
Route::get('/contact', Contact::class)->name('contact');

// Blog
Route::get('/blog', BlogIndex::class)->name('blog.index');
Route::get('/blog/{slug}', BlogShow::class)->name('blog.show');

// Newsletter confirmation
Route::get('/newsletter/confirm/{token}', NewsletterConfirm::class)->name('newsletter.confirm');
Route::get('/newsletter/unsubscribe/{token}', NewsletterUnsubscribe::class)->name('newsletter.unsubscribe');

// Admin routes (protected by Jetstream)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Add more admin routes here
});

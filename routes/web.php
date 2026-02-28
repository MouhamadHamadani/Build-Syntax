<?php

// Admin Section
// Blog
use App\Livewire\Admin\Blog\Create as AdminBlogCreate;
use App\Livewire\Admin\Blog\Edit as AdminBlogEdit;
use App\Livewire\Admin\Blog\Index as AdminBlogIndex;
// Portfolio
use App\Livewire\Admin\Portfolio\Create as AdminPortfolioCreate;
use App\Livewire\Admin\Portfolio\Edit as AdminPortfolioEdit;
use App\Livewire\Admin\Portfolio\Index as AdminPortfolioIndex;
// Contact
use App\Livewire\Admin\Contacts\Show as AdminContactsShow;
use App\Livewire\Admin\Contacts\Index as AdminContactsIndex;
// Newsletter
use App\Livewire\Admin\Newsletter\Index as AdminNewsletterIndex;

use App\Livewire\Admin\Dashboard;
// Admin Section

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

// RateLimiter::for('contact', function (Request $request) {
//     return Limit::perMinute(3)->by($request->ip());
// });

// RateLimiter::for('newsletter', function (Request $request) {
//     return Limit::perMinute(2)->by($request->ip());
// });

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

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', Dashboard::class)->name('dashboard');

        // Blog
        Route::get('/blog', AdminBlogIndex::class)->name('blog.index');
        Route::get('/blog/create', AdminBlogCreate::class)->name('blog.create');
        Route::get('/blog/{id}/edit', AdminBlogEdit::class)->name('blog.edit');

        // Portfolio
        Route::get('/portfolio', AdminPortfolioIndex::class)->name('portfolio.index');
        Route::get('/portfolio/create', AdminPortfolioCreate::class)->name('portfolio.create');
        Route::get('/portfolio/{id}/edit', AdminPortfolioEdit::class)->name('portfolio.edit');

        // Contacts
        Route::get('/contacts', AdminContactsIndex::class)->name('contacts.index');
        Route::get('/contacts/{id}', AdminContactsShow::class)->name('contacts.show');

        // Newsletter
        Route::get('/newsletter', AdminNewsletterIndex::class)->name('newsletter.index');
    });

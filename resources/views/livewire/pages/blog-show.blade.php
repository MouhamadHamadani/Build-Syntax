<div>
    {{-- Hero Section with Featured Image --}}
    <section class="gradient-hero-dark pt-32 pb-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                {{-- Breadcrumb --}}
                <nav class="text-dark-muted mb-6 fade-in">
                    <a href="{{ route('home') }}" class="hover:text-brand-blue transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('blog.index') }}" class="hover:text-brand-blue transition-colors">Blog</a>
                    <span class="mx-2">/</span>
                    <span class="text-dark-accent">{{ $post->title }}</span>
                </nav>

                {{-- Post Header --}}
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-6 leading-tight fade-in">
                    {{ $post->title }}
                </h1>

                {{-- Post Meta --}}
                <div class="flex items-center space-x-6 text-dark-muted fade-in">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>{{ $post->author }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>{{ $post->reading_time }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>{{ $post->view_count }} views</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Image --}}
    @if($post->featured_image)
    <section class="py-12 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="rounded-xl overflow-hidden shadow-lg">
                    <img src="{{ Storage::url($post->featured_image) }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-auto">
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Post Content --}}
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="card-dark rounded-xl p-8 lg:p-12">
                    {{-- Post Content --}}
                    <div class="prose prose-lg prose-invert max-w-none mb-12">
                        <div class="text-dark-muted leading-relaxed">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>

                    {{-- Tags --}}
                    @if($post->tags && count($post->tags) > 0)
                    <div class="border-t border-dark-border pt-8 mb-8">
                        <h3 class="text-lg font-bold text-dark-accent mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                            <span class="bg-brand-blue bg-opacity-10 text-brand-blue px-4 py-2 rounded-full text-sm font-medium">
                                {{ $tag }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Share Section --}}
                    <div class="border-t border-dark-border pt-8">
                        <h3 class="text-lg font-bold text-dark-accent mb-4">Share this article</h3>
                        <div class="flex space-x-4">
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                               target="_blank"
                               class="bg-dark-primary hover:bg-brand-blue text-dark-accent hover:text-white px-6 py-3 rounded-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                                <span>Twitter</span>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                               target="_blank"
                               class="bg-dark-primary hover:bg-brand-blue text-dark-accent hover:text-white px-6 py-3 rounded-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                <span>Facebook</span>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}" 
                               target="_blank"
                               class="bg-dark-primary hover:bg-brand-blue text-dark-accent hover:text-white px-6 py-3 rounded-lg transition-all duration-200 flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                <span>LinkedIn</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Related Posts --}}
    @if($relatedPosts->count() > 0)
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-dark-accent mb-12 text-center">Related Articles</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedPosts as $relatedPost)
                    <article class="card-dark rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300">
                        {{-- Post Image --}}
                        <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600">
                            @if($relatedPost->featured_image)
                                <img src="{{ Storage::url($relatedPost->featured_image) }}" 
                                     alt="{{ $relatedPost->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Post Content --}}
                        <div class="p-6">
                            <div class="text-sm text-dark-muted mb-3">
                                {{ $relatedPost->published_at->format('M d, Y') }}
                            </div>
                            
                            <h3 class="text-lg font-bold text-dark-accent mb-3 line-clamp-2">
                                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="hover:text-brand-blue transition-colors">
                                    {{ $relatedPost->title }}
                                </a>
                            </h3>
                            
                            <p class="text-dark-muted text-sm mb-4 line-clamp-2">
                                {{ $relatedPost->excerpt }}
                            </p>

                            <a href="{{ route('blog.show', $relatedPost->slug) }}" 
                               class="text-brand-blue font-semibold hover:underline text-sm">
                                Read More →
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Newsletter CTA --}}
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                @livewire('components.newsletter-subscribe')
            </div>
        </div>
    </section>

    {{-- Back to Blog --}}
    <section class="py-12 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center">
                <a href="{{ route('blog.index') }}" 
                   class="inline-flex items-center space-x-2 text-brand-blue hover:text-brand-blue-dark font-semibold transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    <span>Back to Blog</span>
                </a>
            </div>
        </div>
    </section>
</div>
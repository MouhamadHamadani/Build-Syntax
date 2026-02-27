<div>
    {{-- Hero Section --}}
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in text-brand-blue">Our Blog</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                Insights, tutorials, and tips on web development, technology trends, and business growth.
            </p>
        </div>
    </section>

    {{-- Featured Post --}}
    @if($featuredPost)
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="card-dark rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- Featured Image --}}
                    <div class="h-64 lg:h-auto bg-gradient-to-br from-brand-blue to-blue-600">
                        @if($featuredPost->featured_image)
                            <img src="{{ Storage::url($featuredPost->featured_image) }}" 
                                 alt="{{ $featuredPost->title }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full">
                                <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    {{-- Featured Content --}}
                    <div class="p-8 flex flex-col justify-center">
                        <div class="inline-block bg-brand-blue text-white px-3 py-1 rounded-full text-sm font-semibold mb-4 w-fit">
                            Featured Post
                        </div>
                        <h2 class="text-3xl font-bold text-dark-accent mb-4">
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" class="hover:text-brand-blue transition-colors">
                                {{ $featuredPost->title }}
                            </a>
                        </h2>
                        <p class="text-dark-muted mb-6 leading-relaxed">
                            {{ $featuredPost->excerpt }}
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-sm text-dark-muted">
                                <span>{{ $featuredPost->author }}</span>
                                <span>•</span>
                                <span>{{ $featuredPost->published_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ $featuredPost->reading_time }}</span>
                            </div>
                            <a href="{{ route('blog.show', $featuredPost->slug) }}" 
                               class="text-brand-blue font-semibold hover:underline">
                                Read More →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- Search Bar --}}
    <section class="py-12 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search articles..."
                        class="w-full px-6 py-4 pl-12 bg-dark-secondary border border-dark-border rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- Blog Posts Grid --}}
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                    <article class="card-dark rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col">
                        {{-- Post Image --}}
                        <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600 relative">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" 
                                     alt="{{ $post->title }}"
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
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center space-x-3 text-sm text-dark-muted mb-3">
                                <span>{{ $post->published_at->format('M d, Y') }}</span>
                                <span>•</span>
                                <span>{{ $post->reading_time }}</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-dark-accent mb-3 line-clamp-2">
                                <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-brand-blue transition-colors">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            
                            <p class="text-dark-muted mb-4 line-clamp-3 flex-1">
                                {{ $post->excerpt }}
                            </p>

                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-sm text-dark-muted">{{ $post->author }}</span>
                                <a href="{{ route('blog.show', $post->slug) }}" 
                                   class="text-brand-blue font-semibold hover:underline text-sm">
                                    Read More →
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-dark-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-dark-muted text-lg">No articles found matching your search.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Newsletter Subscription --}}
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                @livewire('components.newsletter-subscribe')
            </div>
        </div>
    </section>
</div>
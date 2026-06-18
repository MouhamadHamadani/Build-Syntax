<div>
    {{-- Hero Section --}}
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in text-brand-blue">Our Portfolio</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                Discover the projects we've built for our clients. Each project represents our commitment to quality, innovation, and client satisfaction.
            </p>
        </div>
    </section>

    {{-- Filters Section --}}
    @php
        $categoryLabels = [
            'all'       => 'All Projects',
            'ecommerce' => 'ShopNex (E-Commerce)',
            'digital_menu' => 'CarteNex (Digital Menu)',
            'appointment' => 'Tymelo (Appointment Booking)',
            'web'       => 'Web Development',
            'pos'       => 'POS Pro',
            'other'     => 'Other',
        ];
    @endphp
    <section class="py-12 bg-dark-secondary">
        <div class="container mx-auto px-6">
            {{-- Category Filters --}}
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                @foreach($categories as $cat)
                <button
                    type="button"
                    wire:click="filterByCategory('{{ $cat }}')"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-60 cursor-wait"
                    wire:target="filterByCategory,search"
                    class="px-6 py-2 rounded-lg font-medium transition-all duration-200
                        {{ $category === $cat ? 'bg-brand-blue text-white' : 'bg-dark-tertiary text-dark-accent hover:bg-dark-primary' }}">
                    {{ $categoryLabels[$cat] ?? ucfirst($cat) }}
                </button>
                @endforeach
            </div>

            {{-- Search Bar with inline loading spinner --}}
            <div class="max-w-md mx-auto relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search projects..."
                    class="w-full px-4 py-3 pr-10 bg-dark-tertiary border border-dark-border rounded-lg text-dark-accent placeholder-dark-muted focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                <div wire:loading wire:target="search,filterByCategory"
                     class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-blue">
                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    {{-- Projects Grid --}}
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6"
             wire:loading.class="opacity-50 transition-opacity"
             wire:target="filterByCategory,search">
            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                    <div class="card-dark rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 fade-in"
                         data-category="{{ $project->category }}">
                        {{-- Project Image --}}
                        <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600 relative overflow-hidden">
                            @if($project->image_url)
                                <img src="{{ $project->image_url }}"
                                     alt="{{ $project->title }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                </div>
                            @endif
                            @if($project->featured)
                                <div class="absolute top-4 right-4 bg-yellow-500 text-yellow-900 px-3 py-1 rounded-full text-xs font-bold">
                                    Featured
                                </div>
                            @endif
                        </div>

                        {{-- Project Info --}}
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-brand-blue text-sm font-medium">{{ $categoryLabels[$project->category] ?? ucfirst($project->category) }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-dark-accent mb-3">{{ $project->title }}</h3>
                            <p class="text-dark-muted mb-4 line-clamp-3">
                                {{ $project->description }}
                            </p>
                            
                            {{-- Technologies --}}
                            @if($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->technologies as $tech)
                                    <x-tech-icon :tech="$tech" variant="chip" />
                                @endforeach
                            </div>
                            @endif

                            {{-- Actions --}}
                            <div class="flex justify-between items-center">
                                <button 
                                    wire:click="viewProject({{ $project->id }})"
                                    class="text-brand-blue font-semibold hover:underline">
                                    View Details →
                                </button>
                                @if($project->project_url)
                                <a href="{{ $project->project_url }}"
                                   target="_blank"
                                   aria-label="Visit live site"
                                   class="text-gray-400 hover:text-brand-blue transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @else
                {{-- Friendly empty state --}}
                <div class="max-w-xl mx-auto text-center py-16 fade-in">
                    <div class="bg-brand-blue/10 text-brand-blue w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    @if ($search || $category !== 'all')
                        <h3 class="text-2xl font-bold text-dark-accent mb-3">No projects match those filters</h3>
                        <p class="text-dark-muted mb-8 leading-relaxed">
                            Try clearing the search or picking a different category &mdash; or talk to us directly
                            about a project we haven't built yet.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button type="button" wire:click="$set('search', ''); $set('category', 'all')"
                                    class="border-2 border-brand-blue text-brand-blue font-semibold px-6 py-3 rounded-lg
                                           hover:bg-brand-blue hover:text-white transition-all duration-200">
                                Clear filters
                            </button>
                            <a href="{{ route('contact') }}"
                               class="bg-brand-blue text-white font-semibold px-6 py-3 rounded-lg
                                      hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                                Start a Project
                            </a>
                        </div>
                    @else
                        <h3 class="text-2xl font-bold text-dark-accent mb-3">Portfolio coming soon</h3>
                        <p class="text-dark-muted mb-8 leading-relaxed">
                            We're a new agency &mdash; case studies are being added as we launch our first clients.
                            Want to be one of them? Get in touch and we'll walk you through similar work in progress.
                        </p>
                        <a href="{{ route('contact') }}"
                           class="inline-block bg-brand-blue text-white font-semibold px-8 py-4 rounded-lg
                                  hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                            Become a Founding Client
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

    {{-- Technologies We Use --}}
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Technologies We Use</h2>
                <p class="text-dark-muted text-lg max-w-2xl mx-auto">We leverage modern technologies to build robust, scalable solutions.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 max-w-4xl mx-auto">
                <x-tech-icon tech="PHP" variant="card" />
                <x-tech-icon tech="Laravel" variant="card" />
                <x-tech-icon tech="Livewire" variant="card" />
                <x-tech-icon tech="Tailwind" variant="card" />
                <x-tech-icon tech="Alpine.js" variant="card" />
                <x-tech-icon tech="MySQL" variant="card" />
            </div>
        </div>
    </section>

    {{-- Project Modal --}}
    @if($selectedProject)
    <div x-data
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         @keydown.escape.window="$wire.closeModal()">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"
             @click="$wire.closeModal()"></div>

        {{-- Modal --}}
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-dark-secondary rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-xl"
                 role="dialog" aria-modal="true" aria-label="Project details">
                {{-- Close Button --}}
                <button @click="$wire.closeModal()"
                        aria-label="Close project details"
                        class="absolute top-4 right-4 text-dark-muted hover:text-white z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Modal Content --}}
                <div class="p-8">
                    @if($selectedProject->image_url)
                    <div class="h-64 bg-gradient-to-br from-brand-blue to-blue-600 rounded-lg mb-6">
                        <img src="{{ $selectedProject->image_url }}"
                             alt="{{ $selectedProject->title }}"
                             class="w-full h-full object-cover rounded-lg">
                    </div>
                    @endif

                    @if($selectedProject->featured)
                    <div class="inline-block bg-yellow-500 text-yellow-900 px-3 py-1 rounded-full text-sm font-bold mb-4">
                        ⭐ Featured Project
                    </div>
                    @endif

                    <h2 class="text-3xl font-bold text-dark-accent mb-2">{{ $selectedProject->title }}</h2>
                    <p class="text-brand-blue mb-6">{{ $categoryLabels[$selectedProject->category] ?? ucfirst($selectedProject->category) }}</p>

                    <div class="prose prose-invert max-w-none mb-6">
                        <p class="text-dark-muted">{{ $selectedProject->description }}</p>
                    </div>

                    @if($selectedProject->technologies)
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-dark-accent mb-3">Technologies Used</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($selectedProject->technologies as $tech)
                                <x-tech-icon :tech="$tech" variant="chip" />
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if($selectedProject->project_url)
                    <div>
                        <a href="{{ $selectedProject->project_url }}" 
                           target="_blank"
                           class="bg-brand-blue text-white px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-all inline-block">
                            Visit Live Site →
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
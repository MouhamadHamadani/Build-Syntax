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
    <section class="py-12 bg-dark-secondary">
        <div class="container mx-auto px-6">
            {{-- Category Filters --}}
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                @foreach($categories as $cat)
                <button 
                    wire:click="filterByCategory('{{ $cat }}')"
                    class="px-6 py-2 rounded-lg font-medium transition-all duration-200
                        {{ $category === $cat ? 'bg-brand-blue text-white' : 'bg-dark-tertiary text-dark-accent hover:bg-dark-primary' }}">
                    {{ ucfirst($cat) }}
                </button>
                @endforeach
            </div>

            {{-- Search Bar --}}
            <div class="max-w-md mx-auto">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search"
                    placeholder="Search projects..."
                    class="w-full px-4 py-3 bg-dark-tertiary border border-dark-border rounded-lg text-dark-accent placeholder-dark-muted focus:ring-2 focus:ring-brand-blue focus:border-transparent">
            </div>
        </div>
    </section>

    {{-- Projects Grid --}}
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                    <div class="card-dark rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 fade-in"
                         data-category="{{ $project->category }}">
                        {{-- Project Image --}}
                        <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600 relative overflow-hidden">
                            @if($project->image_url)
                                <img src="{{ Storage::url($project->image_url) }}" 
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
                                <span class="text-brand-blue text-sm font-medium">{{ ucfirst($project->category) }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-dark-accent mb-3">{{ $project->title }}</h3>
                            <p class="text-dark-muted mb-4 line-clamp-3">
                                {{ $project->description }}
                            </p>
                            
                            {{-- Technologies --}}
                            @if($project->technologies)
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->technologies as $tech)
                                <span class="bg-dark-primary text-dark-muted text-xs px-2 py-1 rounded">
                                    {{ $tech }}
                                </span>
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
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-dark-muted mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-dark-muted text-lg">No projects found matching your criteria.</p>
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
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">PHP</div>
                    </div>
                    <p class="text-sm text-white">PHP</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">L</div>
                    </div>
                    <p class="text-sm text-white">Laravel</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">JS</div>
                    </div>
                    <p class="text-sm text-white">JavaScript</p>
                </div>
                {{-- <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">⚛</div>
                    </div>
                    <p class="text-sm text-white">React</p>
                </div> --}}
                {{-- Livewire --}}
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">LW</div>
                    </div>
                    <p class="text-sm text-white">Livewire</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">DB</div>
                    </div>
                    <p class="text-sm text-white">MySQL</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-muted hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">TW</div>
                    </div>
                    <p class="text-sm text-white">Tailwind</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Project Modal --}}
    @if($selectedProject)
    <div x-data="{ open: @entangle('selectedProject').live }" 
         x-show="open"
         x-cloak
         class="fixed inset-0 z-50 overflow-y-auto"
         @keydown.escape.window="$wire.closeModal()">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-black bg-opacity-75 transition-opacity"
             @click="$wire.closeModal()"></div>

        {{-- Modal --}}
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-dark-secondary rounded-lg max-w-4xl w-full max-h-[90vh] overflow-y-auto shadow-xl">
                {{-- Close Button --}}
                <button @click="$wire.closeModal()"
                        class="absolute top-4 right-4 text-dark-muted hover:text-white z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- Modal Content --}}
                <div class="p-8">
                    @if($selectedProject->image_url)
                    <div class="h-64 bg-gradient-to-br from-brand-blue to-blue-600 rounded-lg mb-6">
                        <img src="{{ Storage::url($selectedProject->image_url) }}" 
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
                    <p class="text-brand-blue mb-6">{{ ucfirst($selectedProject->category) }}</p>

                    <div class="prose prose-invert max-w-none mb-6">
                        <p class="text-dark-muted">{{ $selectedProject->description }}</p>
                    </div>

                    @if($selectedProject->technologies)
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-dark-accent mb-3">Technologies Used</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($selectedProject->technologies as $tech)
                            <span class="bg-dark-primary text-dark-accent px-3 py-1 rounded">
                                {{ $tech }}
                            </span>
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
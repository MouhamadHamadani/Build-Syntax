@php
    $products = config('products.catalog');
    $phoneIcon = 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z';
    $link = 'py-1.5 text-[14px] font-medium transition-colors hover:text-dark-accent';
@endphp
{{-- Fixed header, 61px tall at every width (60px bar + 1px border). The home hero pads for it. --}}
<header x-data="{ open: false, scrolled: false }"
        @scroll.window="scrolled = window.pageYOffset > 50"
        :class="{ 'header-scrolled': scrolled, '!bg-dark-primary': open }"
        class="fixed top-0 z-50 w-full border-b border-dark-line bg-dark-primary/[.88] backdrop-blur-[10px] transition-shadow duration-300">
    <nav class="wrap" aria-label="Main">
        <div class="flex h-[60px] items-center justify-between gap-4">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-none" aria-label="Build Syntax, home">
                <img src="{{ asset('images/brand/build-syntax-logo-dark.svg') }}" alt="Build Syntax" width="138" height="34" class="h-[34px] w-auto">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden items-center gap-x-5 lg:flex xl:gap-x-[26px]">
                <a href="{{ route('home') }}" wire:navigate @if (request()->routeIs('home')) aria-current="page" @endif
                   class="{{ $link }} {{ request()->routeIs('home') ? 'text-dark-accent' : 'text-dark-muted' }}">Home</a>
                <a href="{{ route('services') }}" wire:navigate @if (request()->routeIs('services')) aria-current="page" @endif
                   class="{{ $link }} {{ request()->routeIs('services') ? 'text-dark-accent' : 'text-dark-muted' }}">Services</a>

                {{-- Products dropdown --}}
                <div class="relative" x-data="{ productsOpen: false }" @click.outside="productsOpen = false"
                     @keydown.escape.window="productsOpen = false">
                    <button type="button" @click="productsOpen = !productsOpen"
                            class="{{ $link }} flex items-center gap-1 text-dark-muted"
                            :aria-expanded="productsOpen" aria-label="Products menu">
                        Products
                        <svg class="h-4 w-4 transition-transform" :class="productsOpen && 'rotate-180'"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="productsOpen" x-transition x-cloak
                         class="absolute right-0 z-50 mt-2 w-60 rounded-xl border border-dark-line bg-dark-secondary p-1.5 shadow-lg shadow-black/30">
                        @foreach ($products as $product)
                            <a href="{{ $product['site'] }}"
                               class="block rounded-lg px-3 py-2 text-[14px] text-dark-muted transition-colors hover:bg-dark-tertiary hover:text-dark-accent">{{ $product['name'] }} &mdash; {{ $product['tagline'] }}</a>
                        @endforeach
                    </div>
                </div>

                {{-- Portfolio: uncomment when at least 2 projects exist --}}
                <a href="{{ route('portfolio') }}" wire:navigate @if (request()->routeIs('portfolio')) aria-current="page" @endif
                   class="{{ $link }} {{ request()->routeIs('portfolio') ? 'text-dark-accent' : 'text-dark-muted' }}">Portfolio</a>
                {{-- Blog: uncomment when at least 2 posts are published --}}
                {{-- <a href="{{ route('blog.index') }}" wire:navigate class="{{ $link }} text-dark-muted">Blog</a> --}}
                <a href="{{ route('about') }}" wire:navigate @if (request()->routeIs('about')) aria-current="page" @endif
                   class="{{ $link }} {{ request()->routeIs('about') ? 'text-dark-accent' : 'text-dark-muted' }}">About</a>
                <a href="tel:+9613876822" aria-label="Call us"
                   class="hidden items-center gap-1.5 text-[14px] font-medium text-dark-accent transition-colors hover:text-brand-blue-light xl:inline-flex">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $phoneIcon }}" />
                    </svg>
                    +961 3 876 822
                </a>
                <a href="{{ route('contact') }}" class="btn btn-brand btn-sm">Get a free quote</a>
            </div>

            <!-- Mobile menu button -->
            <button type="button" @click="open = !open" aria-label="Toggle menu" :aria-expanded="open"
                    class="-mr-2 flex h-10 w-10 items-center justify-center rounded-lg text-dark-accent lg:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" x-transition x-cloak
             class="max-h-[calc(100vh-61px)] space-y-1 overflow-y-auto pb-4 lg:hidden">
            <a href="{{ route('home') }}" class="block py-2 text-dark-accent hover:text-brand-blue-light">Home</a>
            <a href="{{ route('services') }}" class="block py-2 text-dark-accent hover:text-brand-blue-light">Services</a>

            {{-- Products group (collapsible) --}}
            <div x-data="{ productsOpen: false }">
                <button type="button" @click="productsOpen = !productsOpen"
                        class="flex w-full items-center justify-between py-2 text-dark-accent hover:text-brand-blue-light"
                        :aria-expanded="productsOpen" aria-label="Products menu">
                    <span>Products</span>
                    <svg class="h-4 w-4 transition-transform" :class="productsOpen && 'rotate-180'"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="productsOpen" x-transition x-cloak class="ml-1 space-y-1 border-l border-dark-line pl-4">
                    @foreach ($products as $product)
                        <a href="{{ $product['site'] }}" class="block py-2 text-sm text-dark-muted hover:text-brand-blue-light">{{ $product['name'] }} &mdash; {{ $product['tagline'] }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Portfolio: uncomment when at least 2 projects exist --}}
            <a href="{{ route('portfolio') }}" class="block py-2 text-dark-accent hover:text-brand-blue-light">Portfolio</a>
            {{-- Blog: uncomment when at least 2 posts are published --}}
            {{-- <a href="{{ route('blog.index') }}" class="block py-2 text-dark-accent hover:text-brand-blue-light">Blog</a> --}}
            <a href="{{ route('about') }}" class="block py-2 text-dark-accent hover:text-brand-blue-light">About</a>
            <a href="{{ route('contact') }}" class="btn btn-brand btn-sm mt-2 w-full">Get a free quote</a>
            <a href="tel:+9613876822"
               class="flex items-center gap-2 py-2 text-dark-muted transition-colors hover:text-brand-blue-light">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $phoneIcon }}" />
                </svg>
                +961 3 876 822
            </a>
        </div>
    </nav>
</header>

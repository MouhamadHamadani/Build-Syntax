<header x-data="{ open: false, scrolled: false }" 
        @scroll.window="scrolled = window.pageYOffset > 50"
        :class="{ 'header-scrolled': scrolled }"
        class="bg-dark-secondary fixed w-full top-0 z-50 transition-all duration-300">
    <nav class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/icon.png') }}" alt="Build Syntax" class="h-10 w-10">
                <div class="flex flex-col">
                    <span class="text-xl font-bold">
                        <span class="text-brand-blue">Build</span>
                        <span class="text-[#4c4c4c]">Syntax</span>
                    </span>
                    <span class="text-xs text-gray-500 hidden sm:block">Your Vision, Our Code</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    Home
                </x-nav-link>
                <x-nav-link href="{{ route('services') }}" :active="request()->routeIs('services')">
                    Services
                </x-nav-link>
                <x-nav-link href="{{ route('portfolio') }}" :active="request()->routeIs('portfolio')">
                    Portfolio
                </x-nav-link>
                <x-nav-link href="{{ route('blog.index') }}" :active="request()->routeIs('blog.*')">
                    Blog
                </x-nav-link>
                <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')">
                    About
                </x-nav-link>
                <a href="{{ route('contact') }}" class="btn-primary py-2">
                    Get a Free Quote
                </a>
            </div>

            <!-- Mobile menu button -->
            <button @click="open = !open" class="md:hidden text-dark-accent">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div x-show="open" 
             x-transition
             class="md:hidden mt-4 pb-4 space-y-2">
            <a href="{{ route('home') }}" class="block py-2 text-dark-accent hover:text-brand-blue">Home</a>
            <a href="{{ route('services') }}" class="block py-2 text-dark-accent hover:text-brand-blue">Services</a>
            <a href="{{ route('portfolio') }}" class="block py-2 text-dark-accent hover:text-brand-blue">Portfolio</a>
            <a href="{{ route('blog.index') }}" class="block py-2 text-dark-accent hover:text-brand-blue">Blog</a>
            <a href="{{ route('about') }}" class="block py-2 text-dark-accent hover:text-brand-blue">About</a>
            <a href="{{ route('contact') }}" class="block py-2 text-brand-blue font-semibold">Get Started</a>
        </div>
    </nav>
</header>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ strip_tags($title ?? 'Admin') }} — Build Syntax</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans"
      x-data="{ nav: false }"
      @keydown.escape.window="if (nav) { nav = false; $refs.menuBtn.focus() }"
      @resize.window="if (window.innerWidth >= 1024) nav = false">

    @php
        $user = Auth::user();
        $newCount = \App\Models\ContactSubmission::where('status', 'new')->count();
    @endphp

    <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-3 focus:top-3 focus:z-[60] focus:rounded-lg focus:bg-brand-blue-light focus:px-4 focus:py-2 focus:text-ink">Skip to content</a>

    {{-- Top bar, below 1024px only --}}
    <header class="sticky top-0 z-30 flex items-center justify-between border-b border-dark-line bg-dark-sidebar px-4 py-3 lg:hidden">
        <a href="{{ route('admin.dashboard') }}" class="sb-logo !px-0"><span class="sb-mark">B</span><span><span class="text-brand-blue-light">Build</span> Syntax</span></a>
        <button type="button" x-ref="menuBtn" @click="nav = true"
                aria-controls="admin-nav" :aria-expanded="nav.toString()" aria-label="Open menu"
                class="btn-row !p-2.5">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
    </header>

    {{-- Overlay behind the open drawer --}}
    <div x-show="nav" x-cloak x-transition.opacity @click="nav = false; $refs.menuBtn.focus()"
         class="fixed inset-0 z-40 bg-black/60 lg:hidden" aria-hidden="true"></div>

    {{-- Sidebar --}}
    <aside id="admin-nav"
           class="fixed inset-y-0 left-0 z-50 flex w-[248px] flex-col gap-[22px] overflow-y-auto border-r border-dark-line bg-dark-sidebar px-3.5 py-5 transition-[transform,visibility] duration-200 lg:visible lg:translate-x-0"
           :class="nav ? 'translate-x-0' : 'max-lg:invisible max-lg:-translate-x-full'"
           x-trap.noscroll="nav && window.innerWidth < 1024">

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="sb-logo"><span class="sb-mark">B</span><span><span class="text-brand-blue-light">Build</span> Syntax</span></a>
            <button type="button" @click="nav = false; $refs.menuBtn.focus()" aria-label="Close menu" class="btn-row !p-2 lg:hidden">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <nav class="sb-group" aria-label="Admin">
            <x-admin-nav-link route="admin.dashboard" icon="dashboard">Dashboard</x-admin-nav-link>
        </nav>

        <div>
            <div class="sb-tag">Sales</div>
            <nav class="sb-group" aria-label="Sales">
                <x-admin-nav-link route="admin.contacts.index" icon="contacts" match="admin.contacts.*">
                    Contacts
                    @if($newCount > 0)
                        <span class="sb-count" aria-label="{{ $newCount }} new">{{ $newCount }}</span>
                    @endif
                </x-admin-nav-link>
                <x-admin-nav-link route="admin.newsletter.index" icon="newsletter">Newsletter</x-admin-nav-link>
            </nav>
        </div>

        <div>
            <div class="sb-tag">Website</div>
            <nav class="sb-group" aria-label="Website">
                <x-admin-nav-link route="admin.services.index" icon="services" match="admin.services.*">Services and pricing <span class="sb-new">New</span></x-admin-nav-link>
                <x-admin-nav-link route="admin.portfolio.index" icon="portfolio" match="admin.portfolio.*">Portfolio</x-admin-nav-link>
                <x-admin-nav-link route="admin.blog.index" icon="blog" match="admin.blog.*">Blog posts</x-admin-nav-link>
            </nav>
        </div>

        <div class="sb-user">
            <div><b>{{ \Illuminate\Support\Str::before($user->name, ' ') }}</b><span class="break-all">{{ $user->email }}</span></div>
            <a href="{{ route('home') }}" target="_blank" rel="noopener">View site ↗&#xFE0E;</a>
            <a href="{{ route('profile.show') }}" wire:navigate @if(request()->routeIs('profile.show')) aria-current="page" @endif>My profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Sign out</button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="flex min-h-screen min-w-0 flex-col lg:pl-[248px]">

        {{-- Flash messages --}}
        @if(session('success') || session('error'))
            <div class="grid gap-3 px-4 pt-4 sm:px-6 lg:px-10 lg:pt-8">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         role="status" class="flash flash-success">
                        <span>{{ session('success') }}</span>
                        <button type="button" @click="show = false" aria-label="Dismiss message">✕</button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         role="alert" class="flash flash-error">
                        <span>{{ session('error') }}</span>
                        <button type="button" @click="show = false" aria-label="Dismiss message">✕</button>
                    </div>
                @endif
            </div>
        @endif

        <main id="main" class="flex min-w-0 flex-1 flex-col gap-[22px] px-4 py-6 sm:px-6 lg:px-10 lg:py-8">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>

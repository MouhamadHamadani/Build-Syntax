<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} — Build Syntax</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset("images/icon.png") }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: false }">

    {{-- Mobile overlay --}}
    <div x-show="sidebarOpen" x-transition.opacity
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>

    {{-- Sidebar --}}
    <aside class="fixed top-0 left-0 h-full w-64 bg-gray-900 text-white z-30 flex flex-col transition-transform duration-300
                  -translate-x-full lg:translate-x-0"
           :class="{ 'translate-x-0': sidebarOpen }">

        {{-- Logo --}}
        <div class="px-6 py-5 border-b border-gray-700 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="text-white font-bold text-lg tracking-tight">
                <span class="text-blue-400">Build</span>Syntax
                <span class="text-xs font-normal text-gray-400 block -mt-1">Admin Panel</span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">

            <x-admin-nav-link route="admin.dashboard" icon="home">Dashboard</x-admin-nav-link>

            <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</div>
            <x-admin-nav-link route="admin.blog.index" icon="document-text" match="admin.blog.*">Blog Posts</x-admin-nav-link>
            <x-admin-nav-link route="admin.portfolio.index" icon="photograph" match="admin.portfolio.*">Portfolio</x-admin-nav-link>

            <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">CRM</div>
            <x-admin-nav-link route="admin.contacts.index" icon="inbox" match="admin.contacts.*">
                Contacts
                @php $newCount = \App\Models\ContactSubmission::where('status','new')->count() @endphp
                @if($newCount > 0)
                    <span class="ml-auto bg-blue-600 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $newCount }}</span>
                @endif
            </x-admin-nav-link>
            <x-admin-nav-link route="admin.newsletter.index" icon="mail">Newsletter</x-admin-nav-link>

            <div class="pt-4 pb-1 px-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Account</div>
            <x-admin-nav-link route="profile.show" icon="user">My Profile</x-admin-nav-link>
        </nav>

        {{-- Footer --}}
        <div class="px-6 py-4 border-t border-gray-700">
            <div class="text-xs text-gray-400">Logged in as</div>
            <div class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2" x-data>
                @csrf
                <button @click.prevent="$root.submit()"
                        class="text-xs text-gray-400 hover:text-red-400 transition-colors">
                    Sign out →
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="lg:ml-64 min-h-screen flex flex-col">

        {{-- Top bar --}}
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center gap-4 sticky top-0 z-10">
            <button @click="sidebarOpen = true" class="lg:hidden text-gray-500 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="flex-1">
                <h1 class="text-lg font-semibold text-gray-800">{{ $title ?? 'Dashboard' }}</h1>
            </div>
            <a href="{{ route('home') }}" target="_blank"
               class="text-sm text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Site
            </a>
        </header>

        {{-- Flash messages --}}
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="mx-6 mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="text-green-600 hover:text-green-800">✕</button>
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="mx-6 mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button @click="show = false" class="text-red-600 hover:text-red-800">✕</button>
            </div>
        @endif

        {{-- Page content --}}
        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
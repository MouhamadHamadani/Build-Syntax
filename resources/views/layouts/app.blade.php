<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    $pageTitle = $title ?? config('app.name', 'Build Syntax');
    $pageDescription =
        $description ??
        'Build Syntax - Beirut-based custom web development. E-commerce, appointment systems, and websites built on Laravel 12 + Livewire 3.';
    $ogImage = $ogImage ?? asset('images/icon.png');
    $canonical = $canonical ?? url()->current();
  @endphp

  <title>{{ $pageTitle }}</title>
  <meta name="description" content="{{ $pageDescription }}">
  <link rel="canonical" href="{{ $canonical }}">

  <!-- Open Graph / Facebook / WhatsApp link previews -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Build Syntax">
  <meta property="og:url" content="{{ $canonical }}">
  <meta property="og:title" content="{{ $pageTitle }}">
  <meta property="og:description" content="{{ $pageDescription }}">
  <meta property="og:image" content="{{ $ogImage }}">
  <meta property="og:locale" content="en_US">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{{ $pageTitle }}">
  <meta name="twitter:description" content="{{ $pageDescription }}">
  <meta name="twitter:image" content="{{ $ogImage }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-3T57KTE79H"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-3T57KTE79H');
  </script>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen">
    @include('layouts.navigation')

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>

    @include('layouts.footer')

    {{-- Floating WhatsApp button (Lebanese market: WhatsApp-first business culture) --}}
    <a href="https://wa.me/96171293685?text=Hi%20Build%20Syntax%2C%20I%27d%20like%20to%20discuss%20a%20project."
      target="_blank" rel="noopener noreferrer" aria-label="Chat with us on WhatsApp"
      class="fixed bottom-6 right-6 z-50 flex items-center gap-2 bg-[#25D366] hover:bg-[#1ebe57]
                  text-white font-semibold px-4 py-3 rounded-full shadow-2xl
                  transition-all duration-200 hover:scale-105 group">
      <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
        <path
          d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
      </svg>
      <span class="hidden sm:inline text-sm whitespace-nowrap">Chat on WhatsApp</span>
    </a>

    {{-- Scroll to top button --}}
    <button x-data="{ show: false }" x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })" x-show="show" x-cloak
      x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-75"
      x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-75"
      @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
      class="fixed bottom-24 right-6 z-50 w-11 h-11 bg-dark-secondary border border-dark-border
                   text-dark-muted hover:text-brand-blue hover:border-brand-blue
                   rounded-full flex items-center justify-center shadow-lg
                   transition-all duration-200 cursor-pointer"
      aria-label="Scroll to top">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
      </svg>
    </button>
  </div>

  @livewireScripts
</body>

</html>

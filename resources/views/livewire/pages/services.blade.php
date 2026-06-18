<div>
    {{-- Services Hero --}}
    <section class="gradient-hero-dark pt-32 pb-20">
        <div class="container mx-auto px-6">
            <div class="text-center fade-in">
                <h1 class="text-4xl md:text-5xl font-bold text-brand-blue leading-tight mb-6">
                    Services & Pricing
                </h1>
                <p class="text-lg text-dark-muted max-w-3xl mx-auto leading-relaxed">
                    Choose the perfect plan for your business. All our services come with professional support, deployment assistance, and ongoing maintenance options.
                </p>
            </div>
        </div>
    </section>

    {{-- Sticky service tabs --}}
    <nav class="sticky top-[72px] z-30 bg-dark-secondary/95 backdrop-blur border-y border-dark-border"
         aria-label="Service sections">
        <div class="container mx-auto px-6">
            <ul class="flex items-center gap-1 md:gap-6 overflow-x-auto scrollbar-hide py-3 text-sm md:text-base">
                @foreach ([
                    ['href' => '#ecommerce', 'label' => 'ShopNex (E-Commerce)'],
                    ['href' => '#menus', 'label' => 'CarteNex (Digital Menus)'],
                    ['href' => '#appointment', 'label' => 'Tymelo (Booking)'],
                    ['href' => '#pos', 'label' => 'POS Pro (Early Access)'],
                    ['href' => '#web-development', 'label' => 'Custom Web Development'],
                    ['href' => '#hosting', 'label' => 'Hosting &amp; Maintenance'],
                ] as $tab)
                    <li class="flex-shrink-0">
                        <a href="{{ $tab['href'] }}"
                           class="inline-block px-4 py-2 rounded-full text-dark-muted font-medium
                                  hover:text-brand-blue hover:bg-brand-blue/10 transition-colors whitespace-nowrap">
                            {!! $tab['label'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>

    {{-- Payment plan note --}}
    <div class="bg-dark-primary border-b border-dark-border">
        <div class="container mx-auto px-6 py-4 fade-in">
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 text-sm text-dark-muted text-center">
                <span class="inline-flex items-center gap-2 text-brand-blue font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                    Flexible payments
                </span>
                <span class="hidden sm:inline text-dark-border">|</span>
                <span>50% deposit &middot; 30% on delivery &middot; 20% after training &mdash; available on request for all packages.</span>
                <span class="hidden sm:inline text-dark-border">|</span>
                <span>All prices in <strong class="text-dark-accent">USD</strong> &middot; LBP equivalent accepted at current market rate</span>
            </div>
        </div>
    </div>

    {{-- Group divider: Our Products --}}
    <div class="container mx-auto px-6 pt-16">
        <div class="text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-bold text-dark-accent">Our Products</h2>
            <p class="text-dark-muted mt-2">Ready-made solutions you can launch fast — each on its own platform.</p>
        </div>
    </div>

    {{-- E-Commerce (ShopNex) — canonical pricing lives on shopnex.build-syntax.com --}}
    <section id="ecommerce" class="py-20 bg-dark-secondary scroll-mt-32">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 fade-in">
                <span class="inline-block bg-orange-400/10 text-orange-400 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    E-Commerce Platform
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">ShopNex &mdash; E-Commerce Platform</h2>
                <p class="text-dark-muted text-lg max-w-3xl mx-auto">
                    Custom Laravel 12 / Livewire 3 online stores, fully responsive and bilingual
                    (English + Arabic with RTL support). Built for the Lebanese market with local
                    and international payment gateway support.
                </p>
            </div>

            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @foreach ([
                    ['Sell online fast', 'Storefront, cart, checkout, and order management ready to go — start selling quickly.'],
                    ['Local + global payments', 'Lebanese payment gateways alongside international cards, so every customer can pay.'],
                    ['Bilingual &amp; yours', 'English + Arabic with full RTL, your own branding, and an admin dashboard you control.'],
                ] as $feature)
                    <div class="card-dark p-6 rounded-xl fade-in">
                        <h3 class="text-lg font-bold text-dark-accent mb-2">{!! $feature[0] !!}</h3>
                        <p class="text-dark-muted text-sm leading-relaxed">{{ $feature[1] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="text-center fade-in">
                <p class="text-orange-400 font-bold text-lg mb-5">Plans from $1,200</p>
                <a href="https://shopnex.build-syntax.com"
                   class="inline-block bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg
                          hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                    View ShopNex Plans &amp; Demo →
                </a>
                <p class="text-dark-muted text-sm mt-4">Full plans &amp; live demo on shopnex.build-syntax.com</p>
            </div>
        </div>
    </section>

    {{-- Digital Menus (CarteNex) — SaaS; canonical pricing lives on cartenex.build-syntax.com --}}
    <section id="menus" class="py-20 bg-dark-primary scroll-mt-32">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 fade-in">
                <span class="inline-block bg-rose-400/10 text-rose-400 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    Digital Menu Platform
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">
                    CarteNex &mdash; Digital Menus for Restaurants &amp; Cafés
                </h2>
                <p class="text-dark-muted text-lg max-w-3xl mx-auto">
                    A QR-code menu your customers open instantly on their phone &mdash; no app, no reprinting.
                    Update dishes, prices, and photos yourself in seconds. Simple monthly subscription.
                </p>
            </div>

            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @foreach ([
                    ['Scan &amp; open', 'One QR scan opens your live menu on any phone — no download required.'],
                    ['Update anytime', 'Change items, prices, and photos yourself from any device, instantly.'],
                    ['Your branding', 'Your logo, colors, and languages (incl. Arabic) on your own menu page.'],
                ] as $feature)
                    <div class="card-dark p-6 rounded-xl fade-in">
                        <h3 class="text-lg font-bold text-dark-accent mb-2">{!! $feature[0] !!}</h3>
                        <p class="text-dark-muted text-sm leading-relaxed">{{ $feature[1] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="text-center fade-in">
                <p class="text-rose-400 font-bold text-lg mb-5">Plans from $15/mo</p>
                <a href="https://cartenex.build-syntax.com"
                   class="inline-block bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg
                          hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                    View CarteNex Plans &amp; Sign Up →
                </a>
                <p class="text-dark-muted text-sm mt-4">Self-serve subscription · Full pricing on cartenex.build-syntax.com</p>
            </div>
        </div>
    </section>

    {{-- Appointment (Tymelo) — canonical pricing lives on tymelo.build-syntax.com --}}
    <section id="appointment" class="py-20 bg-dark-secondary scroll-mt-32">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 fade-in">
                <span class="inline-block bg-teal-400/10 text-teal-400 text-sm font-semibold px-4 py-2 rounded-full mb-4">
                    Appointment Booking System
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">
                    Tymelo &mdash; Appointment Booking System
                </h2>
                <p class="text-dark-muted text-lg max-w-3xl mx-auto">
                    A white-label appointment platform installed, branded, and deployed on your own
                    domain. You own it &mdash; no SaaS subscription, no shared platform, no competitor
                    branding.
                </p>
            </div>

            <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @foreach ([
                    ['Your brand, your domain', 'A fully white-label booking page on your own domain — no Tymelo branding your clients ever see.'],
                    ['Clients self-book 24/7', 'Online booking with reminders and easy rescheduling, so appointments fill themselves around the clock.'],
                    ['You own it', 'No SaaS lock-in — cancel the retainer anytime and keep your system running.'],
                ] as $feature)
                    <div class="card-dark p-6 rounded-xl fade-in">
                        <h3 class="text-lg font-bold text-dark-accent mb-2">{!! $feature[0] !!}</h3>
                        <p class="text-dark-muted text-sm leading-relaxed">{{ $feature[1] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="text-center fade-in">
                <p class="text-teal-400 font-bold text-lg mb-5">Plans from $699 + $49/mo</p>
                <a href="https://tymelo.build-syntax.com"
                   class="inline-block bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg
                          hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                    View Tymelo Plans &amp; Demo →
                </a>
                <p class="text-dark-muted text-sm mt-4">Full plans &amp; live demo on tymelo.build-syntax.com</p>
            </div>
        </div>
    </section>

    {{-- POS Pro --}}
    <section id="pos" class="py-20 bg-dark-primary scroll-mt-32">
        <div class="container mx-auto px-6">

            {{-- Section header --}}
            <div class="text-center mb-12 fade-in">
                <span class="inline-block bg-purple-400/10 text-purple-400 text-sm font-semibold
                             px-4 py-2 rounded-full mb-4">
                    Early Access · Beta
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">
                    POS Pro &mdash; Point of Sale System
                </h2>
                <p class="text-dark-muted text-lg max-w-3xl mx-auto">
                    A custom, cloud-connected POS system built for Lebanese retail, food, and service
                    businesses. No monthly SaaS fees &mdash; you own the software. Works on tablet,
                    desktop, and receipt printers.
                </p>
            </div>

            {{-- Early-access banner --}}
            <div class="max-w-3xl mx-auto mb-12 fade-in">
                <div class="card-dark border border-purple-400/30 rounded-xl p-5 text-center">
                    <p class="text-dark-muted">
                        <span class="text-purple-400 font-semibold">POS Pro is in early access.</span>
                        We're onboarding a limited number of founding clients at the rates below, with hands-on setup
                        and a direct line to the team. Apply to join the beta.
                    </p>
                </div>
            </div>

            {{-- Value Bar (3 icons) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="flex flex-col items-center text-center p-6 card-dark rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-dark-accent font-semibold mb-2">No Monthly SaaS Fees</h3>
                    <p class="text-dark-muted text-sm">Pay once, own the software forever.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 card-dark rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M18.364 5.636a9 9 0 010 12.728m0 0l-2.829-2.829m2.829 2.829L21 21M15.536 8.464a5 5 0 010 7.072m0 0l-2.829-2.829m-4.243 2.829a4.978 4.978 0 01-1.414-2.83m-1.414 5.658a9 9 0 01-2.167-9.238m7.824 2.167a1 1 0 111.414 1.414m-1.414-1.414L3 3m8.293 8.293l1.414 1.414" />
                        </svg>
                    </div>
                    <h3 class="text-dark-accent font-semibold mb-2">Works Offline</h3>
                    <p class="text-dark-muted text-sm">Continues working during internet outages. Syncs when reconnected.</p>
                </div>
                <div class="flex flex-col items-center text-center p-6 card-dark rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3.6 9h16.8M3.6 15h16.8M11.5 3a17 17 0 000 18M12.5 3a17 17 0 010 18M12 21a9 9 0 100-18 9 9 0 000 18z" />
                        </svg>
                    </div>
                    <h3 class="text-dark-accent font-semibold mb-2">Lebanese Market Ready</h3>
                    <p class="text-dark-muted text-sm">Built for LBP/USD dual pricing, Arabic menus, and local receipt formats.</p>
                </div>
            </div>

            {{-- Pricing Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

                {{-- STARTER --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Starter</h3>
                        <p class="text-dark-muted text-sm">Single-cashier setup for small shops &amp; cafes.</p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">$800</span>
                            <span class="text-dark-muted text-sm ml-2">starting from</span>
                        </div>
                        <p class="text-dark-muted text-sm mt-2">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                3&ndash;4 weeks &middot; 1 month support
                            </span>
                        </p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Product / item catalog management',
                            'Sales transactions &amp; receipt printing',
                            'Basic inventory tracking',
                            'Daily sales summary reports',
                            'Single cashier / terminal',
                            'Admin dashboard',
                            'Mobile-responsive (tablet-ready)',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'pos', 'plan' => 'Starter']) }}"
                       class="w-full border-2 border-brand-blue text-brand-blue font-semibold py-3 rounded-lg
                              hover:bg-brand-blue hover:text-white transition-all duration-200 text-center block">
                        Apply for Early Access
                    </a>
                </div>

                {{-- BUSINESS (Most Popular) --}}
                <div class="relative card-dark p-8 rounded-xl shadow-xl ring-2 ring-brand-blue
                            md:-translate-y-4 fade-in">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand-blue text-white
                                text-xs font-bold px-4 py-1 rounded-full whitespace-nowrap">
                        <svg class="inline w-3 h-3 mr-1 -mt-0.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.922-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/>
                        </svg>
                        MOST POPULAR
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Business</h3>
                        <p class="text-dark-muted text-sm">Multi-cashier, multi-terminal setup with loyalty &amp; bilingual interface.</p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">$1,400</span>
                            <span class="text-dark-muted text-sm ml-2">starting from</span>
                        </div>
                        <p class="text-dark-muted text-sm mt-2">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                5&ndash;7 weeks &middot; 2 months support
                            </span>
                        </p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-dark-muted"><strong class="text-dark-accent">Everything in Starter</strong>, plus:</span>
                        </li>
                        @foreach ([
                            'Multi-cashier / multi-terminal support',
                            'Customer accounts &amp; loyalty tracking',
                            'Discount &amp; coupon codes',
                            'Low-stock alerts &amp; restocking notifications',
                            'Shift management &amp; cashier reports',
                            'Supplier management',
                            'Bilingual EN/AR interface',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'pos', 'plan' => 'Business']) }}"
                       class="w-full bg-brand-blue text-white font-semibold py-3 rounded-lg
                              hover:bg-brand-blue-dark transition-all duration-200 text-center block">
                        Apply for Early Access
                    </a>
                </div>

                {{-- ENTERPRISE --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <span class="inline-block bg-yellow-400/10 text-yellow-400 text-xs font-bold
                                     px-3 py-1 rounded-full mb-3">ENTERPRISE</span>
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Enterprise</h3>
                        <p class="text-dark-muted text-sm">Multi-branch chains, franchises &amp; custom hardware integrations.</p>
                    </div>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-yellow-400">Custom Quote</span>
                        <p class="text-dark-muted text-sm mt-2">Project-specific &middot; Dedicated support</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Custom hardware integration',
                            'Multi-branch / multi-location',
                            'Franchise management',
                            'API integrations (accounting, delivery platforms)',
                            'Custom reporting &amp; KPI dashboards',
                            'Priority support SLA',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'pos', 'plan' => 'Enterprise']) }}"
                       class="w-full border-2 border-yellow-400 text-yellow-400 font-semibold py-3 rounded-lg
                              hover:bg-yellow-400 hover:text-dark-primary transition-all duration-200 text-center block">
                        Apply for Early Access
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Group divider: Custom Development --}}
    <div class="container mx-auto px-6 pt-16">
        <div class="text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-bold text-dark-accent">Custom Development</h2>
            <p class="text-dark-muted mt-2">Bespoke websites and web apps for anything a product doesn't cover.</p>
        </div>
    </div>

    {{-- Custom Web Development --}}
    <section id="web-development" class="py-20 bg-dark-secondary scroll-mt-32">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block bg-brand-blue/10 text-brand-blue text-sm font-semibold
                             px-4 py-2 rounded-full mb-4">
                    Websites &amp; Web Applications
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Custom Web Development</h2>
                <p class="text-dark-muted text-lg max-w-3xl mx-auto">
                    Professional branded websites and custom web applications built on modern stacks.
                    All packages include design, development, testing, deployment assistance, and documented handover.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">

                {{-- STARTER --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Starter</h3>
                        <p class="text-dark-muted text-sm">
                            Landing page or brochure website to establish your online presence.
                        </p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">From&nbsp;$800</span>
                        </div>
                        <p class="text-dark-muted text-sm mt-2">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                2&ndash;3 weeks &middot; 1 month support
                            </span>
                        </p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Landing page / brochure website',
                            'Up to 5 pages',
                            'Template-based or semi-custom design',
                            'WhatsApp / contact form integration',
                            'Basic SEO &amp; Google Analytics',
                            'Mobile responsive',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'website', 'plan' => 'Starter']) }}"
                       class="w-full border-2 border-brand-blue text-brand-blue font-semibold py-3 rounded-lg
                              hover:bg-brand-blue hover:text-white transition-all duration-200 text-center block">
                        Request This Plan
                    </a>
                </div>

                {{-- PROFESSIONAL (Most Popular) --}}
                <div class="relative card-dark p-8 rounded-xl shadow-xl ring-2 ring-brand-blue
                            md:-translate-y-4 fade-in">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand-blue text-white
                                text-xs font-bold px-4 py-1 rounded-full whitespace-nowrap">
                        <svg class="inline w-3 h-3 mr-1 -mt-0.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.922-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/>
                        </svg>
                        MOST POPULAR
                    </div>
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Professional</h3>
                        <p class="text-dark-muted text-sm">
                            Full corporate / business website with CMS, blog, advanced SEO &amp; bilingual support.
                        </p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">From&nbsp;$1,500</span>
                        </div>
                        <p class="text-dark-muted text-sm mt-2">
                            <span class="inline-flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                3&ndash;6 weeks &middot; 2 months support
                            </span>
                        </p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Full corporate / business website',
                            '5&ndash;20 pages, fully custom design',
                            'CMS for self-managed content',
                            'Blog / news module',
                            'Advanced SEO &amp; Schema markup',
                            'Performance &amp; speed optimization',
                            'Bilingual EN/AR support',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'website', 'plan' => 'Professional']) }}"
                       class="w-full bg-brand-blue text-white font-semibold py-3 rounded-lg
                              hover:bg-brand-blue-dark transition-all duration-200 text-center block">
                        Request This Plan
                    </a>
                </div>

                {{-- ENTERPRISE --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <span class="inline-block bg-yellow-400/10 text-yellow-400 text-xs font-bold
                                     px-3 py-1 rounded-full mb-3">ENTERPRISE</span>
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Enterprise</h3>
                        <p class="text-dark-muted text-sm">
                            Custom web applications &amp; portals with complex logic, API integrations &amp; dedicated support.
                        </p>
                    </div>
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-yellow-400">Custom Quote</span>
                        <p class="text-dark-muted text-sm mt-2">Timeline &amp; price project-specific &middot; Dedicated support plan</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Custom web applications &amp; portals',
                            'Complex logic &amp; user roles',
                            'API integrations (CRM, ERP, etc.)',
                            'Custom dashboards &amp; reporting',
                            'Third-party payment processing',
                            'Scalable cloud infrastructure',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'website', 'plan' => 'Enterprise']) }}"
                       class="w-full border-2 border-yellow-400 text-yellow-400 font-semibold py-3 rounded-lg
                              hover:bg-yellow-400 hover:text-dark-primary transition-all duration-200 text-center block">
                        Get a Custom Quote
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Hosting & Maintenance --}}
    <section id="hosting" class="py-20 bg-dark-tertiary scroll-mt-32">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <span class="inline-block bg-brand-blue/10 text-brand-blue text-sm font-semibold
                             px-4 py-2 rounded-full mb-4">
                    Infrastructure &amp; Support
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Hosting &amp; Maintenance</h2>
                <p class="text-dark-muted text-lg max-w-3xl mx-auto">
                    Professional VPS hosting and ongoing maintenance plans to keep your platform
                    secure, fast, and reliable. All hosting tiers include VPS setup &amp; configuration,
                    SSL, daily backups, security hardening, monitoring, and 99.9% uptime SLA.
                </p>
            </div>

            {{-- Hosting Tiers --}}
            <h3 class="text-2xl font-bold text-dark-accent text-center mb-2">Professional VPS Hosting</h3>
            <p class="text-dark-muted text-center max-w-2xl mx-auto mb-10">
                You own the server subscription; Build Syntax handles the full configuration and hardening.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 items-start">
                @foreach ([
                    [
                        'name' => 'Small Sites',
                        'price' => '$200',
                        'unit' => '/ year',
                        'traffic' => 'Up to ~5,000 visits/month',
                        'ideal' => 'Brochure / informational sites',
                    ],
                    [
                        'name' => 'Medium Traffic',
                        'price' => '$300',
                        'unit' => '/ year',
                        'traffic' => '5,000&ndash;20,000 visits/month',
                        'ideal' => 'Active e-commerce &amp; booking sites',
                    ],
                    [
                        'name' => 'High Traffic',
                        'price' => '$500',
                        'unit' => '/ year',
                        'traffic' => '20,000+ visits/month',
                        'ideal' => 'Enterprise / business-critical platforms',
                    ],
                ] as $tier)
                    <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                        <h4 class="text-xl font-bold text-dark-accent mb-2">{{ $tier['name'] }}</h4>
                        <div class="flex items-baseline mb-4">
                            <span class="text-4xl font-bold text-brand-blue">{{ $tier['price'] }}</span>
                            <span class="text-dark-muted text-sm ml-2">{{ $tier['unit'] }}</span>
                        </div>
                        <p class="text-dark-muted text-sm mb-4">
                            <span class="font-semibold text-dark-accent">Traffic:</span> {!! $tier['traffic'] !!}
                        </p>
                        <p class="text-dark-muted text-sm">
                            <span class="font-semibold text-dark-accent">Ideal for:</span> {!! $tier['ideal'] !!}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- Maintenance Plans --}}
            <h3 class="text-2xl font-bold text-dark-accent text-center mb-2">Monthly Maintenance Plans</h3>
            <p class="text-dark-muted text-center max-w-2xl mx-auto mb-10">
                Keep your platform secure, fast, and up-to-date. Billed monthly &middot; minimum 3-month commitment.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8 items-start">

                {{-- Essential Maintenance --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-dark-accent mb-2">Essential</h4>
                        <p class="text-dark-muted text-sm">Keep-the-lights-on for live brochure sites</p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">$79</span>
                            <span class="text-dark-muted text-sm ml-2">/ month</span>
                        </div>
                        <p class="text-dark-muted text-xs mt-2">min. 3 months</p>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Security &amp; dependency updates',
                            'Uptime monitoring (99.9% SLA)',
                            'SSL certificate renewal',
                            'Monthly health report',
                            'Email support (48-hour response)',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <p class="text-xs text-dark-muted italic mb-4">
                        Does not include feature changes or bug fixes. Upgrade to Standard or Premium for those.
                    </p>
                    <a href="{{ route('contact', ['type' => 'other', 'plan' => 'Maintenance-Essential']) }}"
                       class="w-full border-2 border-brand-blue text-brand-blue font-semibold py-3 rounded-lg
                              hover:bg-brand-blue hover:text-white transition-all duration-200 text-center block">
                        Request This Plan
                    </a>
                </div>

                {{-- Basic Maintenance --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-dark-accent mb-2">Basic Maintenance</h4>
                        <p class="text-dark-muted text-sm">Small brochure / informational sites</p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">$150</span>
                            <span class="text-dark-muted text-sm ml-2">/ month</span>
                        </div>
                    </div>
                    <ul class="space-y-3 mb-8">
                        @foreach ([
                            'Bug fixes',
                            'Security patches',
                            'Plugin / package updates',
                            'Monthly health report',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'other', 'plan' => 'Maintenance-Basic']) }}"
                       class="w-full border-2 border-brand-blue text-brand-blue font-semibold py-3 rounded-lg
                              hover:bg-brand-blue hover:text-white transition-all duration-200 text-center block">
                        Request This Plan
                    </a>
                </div>

                {{-- Standard Maintenance (Most Popular) --}}
                <div class="relative card-dark p-8 rounded-xl shadow-xl ring-2 ring-brand-blue
                            md:-translate-y-4 fade-in">
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-brand-blue text-white
                                text-xs font-bold px-4 py-1 rounded-full whitespace-nowrap">
                        <svg class="inline w-3 h-3 mr-1 -mt-0.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.922-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.838-.196-1.539-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/>
                        </svg>
                        MOST POPULAR
                    </div>
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-dark-accent mb-2">Standard Maintenance</h4>
                        <p class="text-dark-muted text-sm">E-commerce &amp; booking platforms in active use</p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">$250</span>
                            <span class="text-dark-muted text-sm ml-2">/ month</span>
                        </div>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-dark-muted"><strong class="text-dark-accent">Everything in Basic</strong>, plus:</span>
                        </li>
                        @foreach ([
                            'Performance optimization',
                            'Priority support response',
                            'Minor content updates',
                            'Uptime monitoring',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'other', 'plan' => 'Maintenance-Standard']) }}"
                       class="w-full bg-brand-blue text-white font-semibold py-3 rounded-lg
                              hover:bg-brand-blue-dark transition-all duration-200 text-center block">
                        Request This Plan
                    </a>
                </div>

                {{-- Premium Maintenance --}}
                <div class="card-dark p-8 rounded-xl shadow-md fade-in">
                    <div class="mb-6">
                        <h4 class="text-xl font-bold text-dark-accent mb-2">Premium Maintenance</h4>
                        <p class="text-dark-muted text-sm">High-traffic or business-critical platforms</p>
                    </div>
                    <div class="mb-6">
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-brand-blue">$400</span>
                            <span class="text-dark-muted text-sm ml-2">/ month</span>
                        </div>
                    </div>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-dark-muted"><strong class="text-dark-accent">Everything in Standard</strong>, plus:</span>
                        </li>
                        @foreach ([
                            'Small feature additions (&le;4 hrs/mo)',
                            'Database optimization',
                            'Emergency incident response',
                            'Quarterly strategy review',
                        ] as $feature)
                            <li class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-dark-muted">{!! $feature !!}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contact', ['type' => 'other', 'plan' => 'Maintenance-Premium']) }}"
                       class="w-full border-2 border-brand-blue text-brand-blue font-semibold py-3 rounded-lg
                              hover:bg-brand-blue hover:text-white transition-all duration-200 text-center block">
                        Request This Plan
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Why Choose Build Syntax?</h2>
                <p class="text-dark-muted text-lg max-w-2xl mx-auto">We combine technical expertise with a client-focused approach to deliver exceptional results.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Feature 1 --}}
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Quality Guaranteed</h3>
                    <p class="text-dark-muted">We're committed to delivering high-quality, bug-free solutions that exceed expectations.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">On-Time Delivery</h3>
                    <p class="text-dark-muted">We respect deadlines and ensure your project is completed on schedule.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Dedicated Support</h3>
                    <p class="text-dark-muted">Our team is always available to answer questions and provide assistance.</p>
                </div>

                {{-- Feature 4 --}}
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Transparent Pricing</h3>
                    <p class="text-dark-muted">No hidden fees or surprises. You'll know exactly what you're paying for.</p>
                </div>
            </div>
        </div>
    </section>
</div>
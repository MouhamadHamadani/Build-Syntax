<div>
  {{-- Hero Section --}}
  <section id="home" class="gradient-hero-dark pt-32 pb-20">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="fade-in">
          <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
            Transform Your Business with <span class="text-brand-blue">Powerful Digital Solutions</span>
          </h1>
          <p class="text-lg text-dark-muted mb-4 leading-relaxed">
            We build custom websites, e-commerce platforms, and appointment systems that drive real business growth and
            connect you with your customers.
          </p>
          <p class="text-base text-dark-muted mb-8 leading-relaxed">
            Built for businesses in Beirut and beyond. Professional development, transparent pricing, and dedicated
            support.
          </p>
          <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('contact') }}"
              class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg text-center">
              Get Your Free Consultation
            </a>
            <a href="{{ route('services') }}"
              class="border-2 border-brand-blue text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue hover:!text-white transition-all duration-200 text-center">
              View Pricing
            </a>
          </div>
        </div>
        <div class="fade-in">
          <div class="relative">
            <div class="bg-brand-blue rounded-lg p-8 shadow-2xl transform rotate-3">
              <div class="bg-dark-secondary rounded-lg p-6 transform -rotate-3">
                <div class="flex items-center space-x-2 mb-4">
                  <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                  <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                  <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                </div>
                <div class="space-y-2">
                  <div class="h-2 bg-dark-tertiary rounded w-3/4"></div>
                  <div class="h-2 bg-dark-tertiary rounded w-1/2"></div>
                  <div class="h-2 bg-brand-blue rounded w-2/3"></div>
                  <div class="h-2 bg-dark-tertiary rounded w-1/3"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- How We Work Section --}}
  <section id="work" class="py-20 bg-dark-tertiary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">How We Work</h2>
        <p class="text-dark-muted text-lg max-w-2xl mx-auto">Our proven three-step process ensures your project is
          delivered on time, within budget, and exceeding expectations.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        {{-- Step 1: Consultation --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="flex flex-col items-center text-center">
            <div
              class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mb-6">
              1</div>
            <h3 class="text-xl font-bold mb-4 text-dark-accent">Consultation</h3>
            <p class="text-dark-muted mb-4 leading-relaxed">
              We start by understanding your business goals, target audience, and project requirements. This discovery
              phase ensures we build exactly what you need.
            </p>
            <ul class="text-sm text-dark-muted space-y-2 text-left w-full">
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Free initial consultation</span>
              </li>
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Requirements analysis</span>
              </li>
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Project proposal & timeline</span>
              </li>
            </ul>
          </div>
        </div>

        {{-- Step 2: Development --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="flex flex-col items-center text-center">
            <div
              class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mb-6">
              2</div>
            <h3 class="text-xl font-bold mb-4 text-dark-accent">Development</h3>
            <p class="text-dark-muted mb-4 leading-relaxed">
              Our expert team brings your vision to life using the latest technologies and best practices. You'll
              receive regular updates throughout the process.
            </p>
            <ul class="text-sm text-dark-muted space-y-2 text-left w-full">
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Modern tech stack</span>
              </li>
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Weekly progress updates</span>
              </li>
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Quality assurance testing</span>
              </li>
            </ul>
          </div>
        </div>

        {{-- Step 3: Launch & Support --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="flex flex-col items-center text-center">
            <div
              class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mb-6">
              3</div>
            <h3 class="text-xl font-bold mb-4 text-dark-accent">Launch & Support</h3>
            <p class="text-dark-muted mb-4 leading-relaxed">
              We deploy your project to production and provide comprehensive training. Your success is our success, and
              we're here to help you grow.
            </p>
            <ul class="text-sm text-dark-muted space-y-2 text-left w-full">
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Deployment & testing</span>
              </li>
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Training & documentation</span>
              </li>
              <li class="flex items-start space-x-2">
                <span class="text-brand-blue mt-1">✓</span>
                <span>Ongoing support</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Services Overview --}}
  <section id="services" class="py-20 bg-dark-secondary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Our Services</h2>
        <p class="text-dark-muted text-lg max-w-2xl mx-auto">We build solutions that power your business and connect you
          with your customers.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
        {{-- Service Card 1 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-6">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">Custom Web Development</h3>
          <p class="text-dark-muted text-center mb-6">Professional websites built with modern technologies, tailored to
            your business needs and brand identity.</p>
          <h4 class="text-brand-blue mb-5 text-center font-bold text-lg">Starting From $1,500</h4>
          <div class="text-center">
            <a href="{{ route('services') }}#web-development" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
          </div>
        </div>

        {{-- Service Card 2 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-6">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">ShopNex &mdash; E-Commerce</h3>
          <p class="text-dark-muted text-center mb-6">Complete online stores with payment processing, inventory
            management, and customer analytics.</p>
          <h4 class="text-orange-400 mb-5 text-center font-bold text-lg">Starting From $1,200</h4>
          <div class="text-center">
            <a href="{{ route('services') }}#ecommerce" class="text-brand-blue font-semibold hover:underline">Learn
              More →</a>
          </div>
        </div>

        {{-- Service Card 3 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-6">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">Tymelo &mdash; Appointment Systems</h3>
          <p class="text-dark-muted text-center mb-6">Streamline bookings with automated scheduling, reminders, and
            customer management tools.</p>
          <h4 class="text-teal-400 mb-5 text-center font-bold text-lg">From $699 + $49/mo</h4>
          <div class="text-center">
            <a href="{{ route('services') }}#appointment" class="text-brand-blue font-semibold hover:underline">Learn
              More →</a>
          </div>
        </div>

        {{-- Service Card 4 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="text-brand-blue mb-6">
            <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">POS Pro &mdash; Point of Sale</h3>
          <p class="text-dark-muted text-center mb-6">Custom point-of-sale for Lebanese retail and food businesses.
            Works offline, no monthly SaaS fees.</p>
          <h4 class="text-purple-400 mb-5 text-center font-bold text-lg">From $800</h4>
          <div class="text-center">
            <a href="{{ route('services') }}#pos" class="text-brand-blue font-semibold hover:underline">Learn
              More →</a>
          </div>
        </div>
      </div>
      <div class="text-center mt-12">
        <a href="{{ route('services') }}"
          class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
          View All Services & Pricing
        </a>
      </div>
    </div>
  </section>

  {{-- Why Pick Us (honest trust signals — placeholder testimonials removed) --}}
  <section class="py-20 bg-dark-tertiary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Why Clients Choose Build Syntax</h2>
        <p class="text-dark-muted text-lg max-w-2xl mx-auto">
          Honest signals while we build our portfolio &mdash; no fake testimonials, no inflated stats.
          Here's what you can actually count on from day one.
        </p>
      </div>

      <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ([
            ['icon' => 'location', 'title' => 'Based in Beirut', 'desc' => 'Local agency, MENA timezone, USD-priced &mdash; no offshore lag.'],
            ['icon' => 'code', 'title' => 'Laravel 12 Specialists', 'desc' => 'Modern stack: Laravel 12, Livewire 3, Tailwind &mdash; no legacy code.'],
            ['icon' => 'globe', 'title' => 'Bilingual EN / AR', 'desc' => 'RTL support and Arabic-ready out of the box for the Lebanese market.'],
            ['icon' => 'chat', 'title' => 'Free Consultation', 'desc' => 'A real 30-minute call &mdash; you walk away with a scoped plan, no commitment.'],
        ] as $badge)
          <div class="card-dark p-6 rounded-xl text-center fade-in">
            <div class="bg-brand-blue/10 text-brand-blue w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4">
              @switch($badge['icon'])
                @case('location')
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                @break
                @case('code')
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                  </svg>
                @break
                @case('globe')
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.6 9h16.8M3.6 15h16.8M11.5 3a17 17 0 000 18M12.5 3a17 17 0 010 18M12 21a9 9 0 100-18 9 9 0 000 18z"/>
                  </svg>
                @break
                @case('chat')
                  <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                  </svg>
                @break
              @endswitch
            </div>
            <h3 class="font-bold text-dark-accent mb-2">{{ $badge['title'] }}</h3>
            <p class="text-sm text-dark-muted leading-relaxed">{!! $badge['desc'] !!}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- FAQ Section --}}
  <section class="py-20 bg-dark-secondary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Frequently Asked Questions</h2>
        <p class="text-dark-muted text-lg max-w-2xl mx-auto">Got questions? We've got answers.</p>
      </div>

      <div class="max-w-4xl mx-auto space-y-4">
        {{-- FAQ 1 --}}
        <div class="card-dark p-6 rounded-xl fade-in">
          <details class="group">
            <summary
              class="flex cursor-pointer items-center justify-between font-semibold text-dark-accent hover:text-brand-blue transition-colors">
              <span>How long does it take to build a website?</span>
              <svg class="h-5 w-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </summary>
            <p class="mt-4 text-dark-muted leading-relaxed">
              Timeline depends on project complexity. A simple website takes 2&ndash;4 weeks, while
              e-commerce platforms typically need 4&ndash;10 weeks depending on the tier. Custom web
              applications may take longer. We'll provide a detailed timeline during consultation.
            </p>
          </details>
        </div>

        {{-- FAQ 2 --}}
        <div class="card-dark p-6 rounded-xl fade-in">
          <details class="group">
            <summary
              class="flex cursor-pointer items-center justify-between font-semibold text-dark-accent hover:text-brand-blue transition-colors">
              <span>What's included in the pricing?</span>
              <svg class="h-5 w-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </summary>
            <p class="mt-4 text-dark-muted leading-relaxed">
              All packages include design, development, testing, deployment, training, and support. Hosting and domain
              costs are separate but we can help set those up.
            </p>
          </details>
        </div>

        {{-- FAQ 3 --}}
        <div class="card-dark p-6 rounded-xl fade-in">
          <details class="group">
            <summary
              class="flex cursor-pointer items-center justify-between font-semibold text-dark-accent hover:text-brand-blue transition-colors">
              <span>Do you offer hosting services?</span>
              <svg class="h-5 w-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </summary>
            <p class="mt-4 text-dark-muted leading-relaxed">
              We offer professional VPS hosting with security setup, SSL certificates, and daily backups. Hosting fees
              range from $200-$500 per year depending on your traffic and storage needs.
            </p>
          </details>
        </div>

        {{-- FAQ 4 --}}
        <div class="card-dark p-6 rounded-xl fade-in">
          <details class="group">
            <summary
              class="flex cursor-pointer items-center justify-between font-semibold text-dark-accent hover:text-brand-blue transition-colors">
              <span>Do you offer maintenance and support?</span>
              <svg class="h-5 w-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </summary>
            <p class="mt-4 text-dark-muted leading-relaxed">
              Absolutely! We offer monthly maintenance plans starting at $79 that include bug fixes, security updates,
              performance optimization, and small feature adjustments. Support duration is included with every service
              package.
            </p>
          </details>
        </div>

        {{-- FAQ 5 --}}
        <div class="card-dark p-6 rounded-xl fade-in">
          <details class="group">
            <summary
              class="flex cursor-pointer items-center justify-between font-semibold text-dark-accent hover:text-brand-blue transition-colors">
              <span>Can the system be customized to my specific needs?</span>
              <svg class="h-5 w-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 14l-7 7m0 0l-7-7m7 7V3" />
              </svg>
            </summary>
            <p class="mt-4 text-dark-muted leading-relaxed">
              Yes! All our services are fully customizable. The pricing tiers we offer are starting points. We can
              adjust features, add custom functionality, and tailor the solution to your exact business requirements.
            </p>
          </details>
        </div>
      </div>

      {{-- Free Consultation definition + CTA --}}
      <div class="max-w-3xl mx-auto mt-12">
        <div class="card-dark p-8 rounded-xl border border-brand-blue/30 fade-in">
          <div class="flex items-start gap-4 mb-6">
            <div class="bg-brand-blue/10 text-brand-blue w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
              </svg>
            </div>
            <div>
              <h3 class="text-xl font-bold text-dark-accent mb-2">What &ldquo;Free Consultation&rdquo; actually means</h3>
              <p class="text-dark-muted leading-relaxed">
                A 30-minute video or in-person call. No sales pressure. You walk away with a clear project
                scope and budget &mdash; whether you decide to work with us or not.
              </p>
            </div>
          </div>
          <div class="text-center">
            <a href="{{ route('contact') }}"
              class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg
                     hover:bg-brand-blue-dark transition-all duration-200 shadow-lg inline-block">
              Book Your Free Consultation
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- Newsletter component --}}
  <div class="py-20 bg-dark-tertiary">
    <div class="w-full max-w-2xl mx-auto px-6">
      <livewire:components.newsletter-subscribe />
    </div>
  </div>
</div>

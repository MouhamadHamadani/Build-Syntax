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
            Trusted by businesses in Beirut and beyond. Professional development, transparent pricing, and dedicated
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
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
            <a href="{{ route('services') }}" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
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
          <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">E-Commerce Systems</h3>
          <p class="text-dark-muted text-center mb-6">Complete online stores with payment processing, inventory
            management, and customer analytics.</p>
          <h4 class="text-brand-blue mb-5 text-center font-bold text-lg">Starting From $1,200</h4>
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
          <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">Appointment Systems</h3>
          <p class="text-dark-muted text-center mb-6">Streamline bookings with automated scheduling, reminders, and
            customer management tools.</p>
          <h4 class="text-brand-blue mb-5 text-center font-bold text-lg">Starting From $800</h4>
          <div class="text-center">
            <a href="{{ route('services') }}#appointment" class="text-brand-blue font-semibold hover:underline">Learn
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

  {{-- Social Proof Section --}}
  <section class="py-20 bg-dark-tertiary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Trusted by Businesses</h2>
        <p class="text-dark-muted text-lg max-w-2xl mx-auto">Join dozens of satisfied clients who have transformed
          their business with our solutions.</p>
      </div>

      {{-- Testimonials --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        {{-- Testimonial 1 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="flex items-center mb-4">
            <div class="flex space-x-1">
              @for ($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
              @endfor
            </div>
          </div>
          <p class="text-dark-muted mb-4 italic">"Build Syntax delivered our e-commerce platform on time and within
            budget. The team was professional and responsive throughout the entire project."</p>
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center text-white font-bold">JD
            </div>
            <div>
              <p class="font-semibold text-dark-accent">John Doe</p>
              <p class="text-sm text-dark-muted">CEO, TechCorp</p>
            </div>
          </div>
        </div>

        {{-- Testimonial 2 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="flex items-center mb-4">
            <div class="flex space-x-1">
              @for ($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
              @endfor
            </div>
          </div>
          <p class="text-dark-muted mb-4 italic">"The appointment system has transformed how we manage bookings. Our
            no-show rate dropped by 50% thanks to the automated reminders!"</p>
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center text-white font-bold">SK
            </div>
            <div>
              <p class="font-semibold text-dark-accent">Sarah Khalil</p>
              <p class="text-sm text-dark-muted">Owner, Dental Clinic</p>
            </div>
          </div>
        </div>

        {{-- Testimonial 3 --}}
        <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
          <div class="flex items-center mb-4">
            <div class="flex space-x-1">
              @for ($i = 0; $i < 5; $i++)
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
              @endfor
            </div>
          </div>
          <p class="text-dark-muted mb-4 italic">"Working with Build Syntax was a great experience. They understood our
            needs and created a beautiful, functional website that perfectly represents our brand."</p>
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center text-white font-bold">MH
            </div>
            <div>
              <p class="font-semibold text-dark-accent">Michel Hassan</p>
              <p class="text-sm text-dark-muted">Marketing Director</p>
            </div>
          </div>
        </div>
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
              Timeline depends on project complexity. A simple website takes 2-4 weeks, while e-commerce platforms
              typically need 6-12 weeks. We'll provide a detailed timeline during consultation.
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
              Absolutely! We offer monthly maintenance plans starting at $150 that include bug fixes, security updates,
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

      {{-- CTA after FAQ --}}
      <div class="text-center mt-12">
        <p class="text-dark-muted mb-6">Still have questions? We're here to help!</p>
        <a href="{{ route('contact') }}"
          class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg inline-block">
          Get Your Free Consultation
        </a>
      </div>
    </div>
  </section>

  {{-- Why Choose Us --}}
  <section class="py-20 bg-dark-tertiary">
    <div class="container mx-auto px-6">
      <div class="text-center mb-16 fade-in">
        <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Why Choose Build Syntax?</h2>
        <p class="text-dark-muted text-lg max-w-2xl mx-auto">We combine technical expertise with a client-focused
          approach to deliver exceptional results.</p>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        {{-- Feature 1 --}}
        <div class="text-center fade-in">
          <div
            class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Quality Code</h3>
          <p class="text-dark-muted">Clean, maintainable, and scalable code that stands the test of time.</p>
        </div>
        {{-- Feature 2 --}}
        <div class="text-center fade-in">
          <div
            class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">On-Time Delivery</h3>
          <p class="text-dark-muted">We respect your deadlines and deliver projects on schedule, every time.</p>
        </div>
        {{-- Feature 3 --}}
        <div class="text-center fade-in">
          <div
            class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Client-Centric Approach</h3>
          <p class="text-dark-muted">Your vision guides our development process from start to finish.</p>
        </div>
        {{-- Feature 4 --}}
        <div class="text-center fade-in">
          <div
            class="bg-brand-blue text-dark-muted w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
          </div>
          <h3 class="text-lg font-bold mb-2 text-dark-accent">Ongoing Support</h3>
          <p class="text-dark-muted">Comprehensive maintenance and support to keep your website running smoothly.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- Newsletter component --}}
  <div class="py-20 bg-dark-secondary">
    <div class="container w-1/2 mx-auto px-6">
      <livewire:components.newsletter-subscribe />
    </div>
  </div>
</div>

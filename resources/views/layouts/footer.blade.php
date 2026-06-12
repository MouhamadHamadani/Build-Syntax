<div>
  <!-- =========== Call to Action =========== -->
  <section id="contact" class="py-20 gradient-hero-dark border-y border-brand-blue/30">
    <div class="container mx-auto px-6 text-center">
      <div class="max-w-3xl mx-auto fade-in">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-dark-accent">Ready to Bring Your Vision to Life?</h2>
        <p class="text-xl mb-8 text-dark-muted">Let's discuss your project and create something amazing together. Get a
          free consultation and project quote today.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          @if (!request()->routeIs('contact'))
            <a href="{{ route('contact') }}"
              class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
              Get Free Consultation
            </a>
            <a href="{{ route('services') }}"
              class="border-2 border-brand-blue text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue hover:text-white transition-all duration-200">
              View Services
            </a>
          @else
            {{-- Already on the contact page: don't self-link — offer the WhatsApp channel instead --}}
            <a href="https://wa.me/96171293685?text=Hi%20Build%20Syntax%2C%20I%27d%20like%20to%20discuss%20a%20project."
              target="_blank" rel="noopener noreferrer"
              class="inline-flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#1ebe57] text-white text-lg font-semibold px-8 py-4 rounded-lg transition-all duration-200 shadow-lg">
              <svg class="w-6 h-6 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                  d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
              </svg>
              Chat on WhatsApp
            </a>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- =========== Footer =========== -->
  <footer class="bg-dark-primary text-white">
    <div class="container mx-auto px-6 py-12">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Company Info -->
        <div class="md:col-span-2">
          <div class="flex items-center space-x-3 mb-4">
            <img src="{{ asset('images/icon.png') }}" alt="Build Syntax Icon" class="h-8 w-8">
            <span class="text-xl font-bold">Build Syntax</span>
          </div>
          <p class="text-dark-muted mb-4 max-w-md">
            Your Vision, Our Code. We are a Beirut-based development partner dedicated to transforming your ideas into
            powerful, modern, and reliable digital solutions.
          </p>
          {{-- Primary contact channel for Lebanese market. Add real social URLs here when accounts go live. --}}
          <a href="https://wa.me/96171293685?text=Hi%20Build%20Syntax%2C%20I%27d%20like%20to%20discuss%20a%20project."
             target="_blank" rel="noopener noreferrer"
             class="inline-flex items-center gap-2 text-green-400 hover:text-green-300 font-semibold transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
            Chat on WhatsApp
          </a>
        </div>

        <!-- Quick Links -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
          <ul class="space-y-2">
            <li><a href="{{ route('home') }}" class="text-dark-muted hover:text-white transition-colors" wire:navigate>Home</a></li>
            <li><a href="{{ route('services') }}" class="text-dark-muted hover:text-white transition-colors" wire:navigate>Services</a></li>
            <li><a href="{{ route('portfolio') }}" class="text-dark-muted hover:text-white transition-colors" wire:navigate>Portfolio</a></li>
            <li><a href="{{ route('about') }}" class="text-dark-muted hover:text-white transition-colors" wire:navigate>About</a></li>
            {{-- Blog: uncomment when at least 2 posts are published --}}
            {{-- <li><a href="{{ route('blog.index') }}" class="text-dark-muted hover:text-white transition-colors" wire:navigate>Blog</a></li> --}}
            <li><a href="{{ route('contact') }}" class="text-dark-muted hover:text-white transition-colors" wire:navigate>Contact</a></li>
          </ul>
        </div>

        <!-- Contact Info -->
        <div>
          <h3 class="text-lg font-semibold mb-4">Contact Info</h3>
          <ul class="space-y-2 text-dark-muted">
            <li class="flex items-center space-x-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Beirut, Lebanon</span>
            </li>
            <li class="flex items-center space-x-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              <span>{{ config('app.email') }}</span>
            </li>
            <li class="flex items-center space-x-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              <a href="tel:+96171293685" class="hover:text-white transition-colors">+961 71 293 685</a>
            </li>
            <li class="flex items-center space-x-2">
              <svg class="w-4 h-4 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.262.489 1.694.626.712.226 1.36.194 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
              </svg>
              <a href="https://wa.me/96171293685" target="_blank" rel="noopener noreferrer"
                 class="hover:text-white transition-colors">WhatsApp</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- Bottom Bar -->
      <div class="border-t border-dark-border mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
        <p class="text-dark-muted text-sm">
          &copy; {{ date('Y') }} Build Syntax. All rights reserved.
        </p>
        <div class="flex space-x-6 mt-4 md:mt-0">
          <a href="{{ route('privacy-policy') }}" class="text-dark-muted hover:text-white text-sm transition-colors" wire:navigate>Privacy Policy</a>
          <a href="{{ route('terms-of-service') }}" class="text-dark-muted hover:text-white text-sm transition-colors" wire:navigate>Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>
</div>

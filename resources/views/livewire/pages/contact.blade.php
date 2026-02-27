<div>
    {{-- Hero Section --}}
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in text-brand-blue">Contact Us</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                Ready to bring your vision to life? Let's discuss your project and create something amazing together.
            </p>
        </div>
    </section>

    {{-- Contact Form Section --}}
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                {{-- Contact Form --}}
                <div class="fade-in">
                    <h2 class="text-3xl font-bold text-dark-accent mb-6">Get a Free Quote</h2>
                    <p class="text-dark-muted mb-8 leading-relaxed">
                        Tell us about your project and we'll get back to you within 24 hours with a detailed proposal and timeline.
                    </p>

                    @if (session()->has('success'))
                        <div class="bg-green-500 bg-opacity-10 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-6">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif

                    @error('form')
                        <div class="bg-red-500 bg-opacity-10 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-6">
                            {{ $message }}
                        </div>
                    @enderror

                    <form wire:submit.prevent="submit" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-white font-medium mb-2">Full Name *</label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    wire:model.blur="name"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200
                                        {{ $errors->has('name') ? 'border-red-500 bg-red-50' : 'border-gray-300' }}"
                                    placeholder="John Doe">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-white font-medium mb-2">Email Address *</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    wire:model.blur="email"
                                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200
                                        {{ $errors->has('email') ? 'border-red-500 bg-red-50' : 'border-gray-300' }}"
                                    placeholder="john@example.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-white font-medium mb-2">Phone Number</label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    wire:model="phone"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200"
                                    placeholder="+961 71 123 456">
                            </div>

                            {{-- Company --}}
                            <div>
                                <label for="company" class="block text-white font-medium mb-2">Company Name</label>
                                <input 
                                    type="text" 
                                    id="company" 
                                    wire:model="company"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200"
                                    placeholder="Your Company LLC">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Project Type --}}
                            <div>
                                <label for="project_type" class="block text-white font-medium mb-2">Project Type *</label>
                                <select 
                                    id="project_type" 
                                    wire:model="project_type"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200">
                                    <option value="website">Custom Website</option>
                                    <option value="ecommerce">E-Commerce Store</option>
                                    <option value="mobile_app">Mobile App</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            {{-- Budget Range --}}
                            <div>
                                <label for="budget_range" class="block text-white font-medium mb-2">Budget Range</label>
                                <select 
                                    id="budget_range" 
                                    wire:model="budget_range"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200">
                                    <option value="">Select budget range</option>
                                    <option value="under_5k">Under $5,000</option>
                                    <option value="5k_15k">$5,000 - $15,000</option>
                                    <option value="15k_30k">$15,000 - $30,000</option>
                                    <option value="30k_plus">$30,000+</option>
                                </select>
                            </div>
                        </div>

                        {{-- notes --}}
                        <div>
                            <label for="notes" class="block text-white font-medium mb-2">Project Details *</label>
                            <textarea 
                                id="notes" 
                                wire:model.blur="notes"
                                rows="6"
                                class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200 resize-vertical resize-none
                                    {{ $errors->has('notes') ? 'border-red-500 bg-red-50' : 'border-gray-300' }}"
                                placeholder="Tell us about your project, goals, timeline, and any specific requirements..."></textarea>
                            @error('notes')
                                <p class="mt-1 text-sm text-red-500">{{ $notes }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center">
                            <button 
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:loading.class="opacity-50 cursor-not-allowed"
                                class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg transform hover:scale-105 disabled:transform-none">
                                <span wire:loading.remove>Send Message</span>
                                <span wire:loading>
                                    <svg class="animate-spin h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Contact Information --}}
                <div class="fade-in">
                    <h2 class="text-3xl font-bold text-dark-accent mb-6">Get in Touch</h2>
                    <p class="text-dark-muted mb-8 leading-relaxed">
                        We're here to help bring your digital vision to life. Reach out to us through any of the channels below.
                    </p>

                    {{-- Contact Cards --}}
                    <div class="space-y-4 mb-8">
                        {{-- Email --}}
                        <div class="card-dark p-6 rounded-xl">
                            <div class="flex items-center space-x-4">
                                <div class="bg-brand-blue p-4 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark-accent mb-1">Email</h4>
                                    <a href="mailto:{{ config('mail.from.address') }}" class="text-dark-muted hover:text-brand-blue transition-colors">
                                        {{ config('mail.from.address') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="card-dark p-6 rounded-xl">
                            <div class="flex items-center space-x-4">
                                <div class="bg-brand-blue p-4 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark-accent mb-1">Phone</h4>
                                    <a href="tel:+96171293685" class="text-dark-muted hover:text-brand-blue transition-colors">
                                        +961 71 293 685
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Location --}}
                        <div class="card-dark p-6 rounded-xl">
                            <div class="flex items-center space-x-4">
                                <div class="bg-brand-blue p-4 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark-accent mb-1">Location</h4>
                                    <p class="text-dark-muted">Beirut, Lebanon</p>
                                </div>
                            </div>
                        </div>

                        {{-- Response Time --}}
                        <div class="card-dark p-6 rounded-xl">
                            <div class="flex items-center space-x-4">
                                <div class="bg-brand-blue p-4 rounded-lg">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-dark-accent mb-1">Response Time</h4>
                                    <p class="text-dark-muted">Within 24 hours <br> Usually much faster!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Business Hours --}}
                    <div class="card-dark p-6 rounded-xl">
                        <h4 class="font-semibold text-dark-accent mb-4">Business Hours</h4>
                        <div class="space-y-2 text-dark-muted">
                            <div class="flex justify-between">
                                <span>Monday - Friday</span>
                                <span class="font-medium">9:00 AM - 5:00 PM</span>
                            </div>
                            {{-- <div class="flex justify-between">
                                <span>Saturday</span>
                                <span class="font-medium">10:00 AM - 4:00 PM</span>
                            </div> --}}
                            <div class="flex justify-between">
                                <span>Sunday</span>
                                <span class="font-medium">Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ Section --}}
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Common Questions</h2>
                <p class="text-dark-muted text-lg max-w-2xl mx-auto">Quick answers to questions you may have.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-4">
                {{-- FAQ 1 --}}
                <div class="card-dark rounded-lg shadow-md fade-in">
                    <details class="group">
                        <summary class="flex cursor-pointer items-center justify-between p-6 font-semibold text-dark-accent hover:text-brand-blue transition-colors">
                            <span>How long does it take to build a website?</span>
                            <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-6 pb-6">
                            <p class="text-dark-muted">A simple website typically takes 2-4 weeks, while more complex e-commerce or custom applications can take 6-12 weeks. We'll provide a detailed timeline during our initial consultation.</p>
                        </div>
                    </details>
                </div>

                {{-- FAQ 2 --}}
                <div class="card-dark rounded-lg shadow-md fade-in">
                    <details class="group">
                        <summary class="flex cursor-pointer items-center justify-between p-6 font-semibold text-dark-accent hover:text-brand-blue transition-colors">
                            <span>What's included in your web development service?</span>
                            <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-6 pb-6">
                            <p class="text-dark-muted">Our service includes custom design, responsive development, content management system, basic SEO setup, contact forms, 3 months of free support, and training on how to manage your content.</p>
                        </div>
                    </details>
                </div>

                {{-- FAQ 3 --}}
                <div class="card-dark rounded-lg shadow-md fade-in">
                    <details class="group">
                        <summary class="flex cursor-pointer items-center justify-between p-6 font-semibold text-dark-accent hover:text-brand-blue transition-colors">
                            <span>Do you provide ongoing maintenance?</span>
                            <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-6 pb-6">
                            <p class="text-dark-muted">Yes! We offer ongoing maintenance packages that include security updates, content updates, performance monitoring, and technical support. We believe in long-term partnerships with our clients.</p>
                        </div>
                    </details>
                </div>

                {{-- FAQ 4 --}}
                <div class="card-dark rounded-lg shadow-md fade-in">
                    <details class="group">
                        <summary class="flex cursor-pointer items-center justify-between p-6 font-semibold text-dark-accent hover:text-brand-blue transition-colors">
                            <span>Can you work with clients outside Lebanon?</span>
                            <svg class="w-5 h-5 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-6 pb-6">
                            <p class="text-dark-muted">Absolutely! We work with clients across the MENA region and internationally. We're experienced in remote collaboration and use modern communication tools to ensure smooth project delivery regardless of location.</p>
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </section>
</div>
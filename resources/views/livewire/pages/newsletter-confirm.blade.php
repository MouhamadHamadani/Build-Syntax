<div>
    <section class="gradient-hero-dark min-h-screen flex items-center justify-center py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto text-center">
                <div class="card-dark rounded-xl p-12">
                    @if($status === 'processing')
                        {{-- Processing --}}
                        <div class="flex flex-col items-center">
                            <svg class="animate-spin h-16 w-16 text-brand-blue mb-6" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <h1 class="text-2xl font-bold text-dark-accent mb-4">Confirming your subscription...</h1>
                        </div>
                    @elseif($status === 'success')
                        {{-- Success --}}
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-green-500 bg-opacity-10 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-dark-accent mb-4">Email Confirmed!</h1>
                            <p class="text-dark-secondary text-lg mb-8">{{ $message }}</p>
                            <a href="{{ route('blog.index') }}" 
                               class="bg-brand-blue text-white px-8 py-3 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 font-semibold inline-block">
                                Read Our Blog
                            </a>
                        </div>
                    @elseif($status === 'already_confirmed')
                        {{-- Already Confirmed --}}
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-blue-500 bg-opacity-10 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-dark-accent mb-4">Already Confirmed</h1>
                            <p class="text-dark-secondary text-lg mb-8">{{ $message }}</p>
                            <a href="{{ route('home') }}" 
                               class="bg-brand-blue text-white px-8 py-3 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 font-semibold inline-block">
                                Go to Homepage
                            </a>
                        </div>
                    @else
                        {{-- Error --}}
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-red-500 bg-opacity-10 rounded-full flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h1 class="text-3xl font-bold text-dark-accent mb-4">Confirmation Failed</h1>
                            <p class="text-dark-secondary text-lg mb-8">{{ $message }}</p>
                            <div class="flex space-x-4">
                                <a href="{{ route('home') }}" 
                                   class="bg-dark-tertiary text-dark-accent px-6 py-3 rounded-lg hover:bg-dark-primary transition-all duration-200 font-semibold">
                                    Go to Homepage
                                </a>
                                <a href="{{ route('contact') }}" 
                                   class="bg-brand-blue text-white px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 font-semibold">
                                    Contact Support
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
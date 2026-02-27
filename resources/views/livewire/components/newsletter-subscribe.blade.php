<div class="bg-brand-blue rounded-lg p-8">
    <h3 class="text-2xl font-bold text-white mb-4">Subscribe to Our Newsletter</h3>
    <p class="text-white opacity-90 mb-6">Get the latest updates on web development trends and tips delivered to your inbox.</p>

    @if (session()->has('newsletter_success'))
        <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4">
            {{ session('newsletter_success') }}
        </div>
    @endif

    <form wire:submit.prevent="subscribe" class="space-y-4">
        <div>
            <input 
                type="email" 
                wire:model="email"
                placeholder="Your email address"
                class="w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-white {{ $errors->has('email') ? 'border-2 border-red-300' : '' }}">
            @error('email')
                <p class="mt-1 text-sm text-red-200">{{ $message }}</p>
            @enderror
        </div>
        
        <button 
            type="submit"
            wire:loading.attr="disabled"
            class="w-full bg-white text-brand-blue font-semibold py-3 rounded-lg hover:bg-gray-100 transition-all duration-200">
            <span wire:loading.remove>Subscribe</span>
            <span wire:loading>Subscribing...</span>
        </button>
    </form>
</div>
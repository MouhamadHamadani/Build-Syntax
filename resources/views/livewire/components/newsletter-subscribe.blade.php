{{-- Single root element: Livewire attaches its wire:id to the first tag, so the compact/full switch lives inside it. --}}
<div @class(['bg-brand-blue rounded-lg p-8' => ! $compact])>
    @unless ($compact)
        <h3 class="text-2xl font-bold text-white mb-4">Subscribe to Our Newsletter</h3>
        <p class="text-white opacity-90 mb-6">Get the latest updates on web development trends and tips delivered to your inbox.</p>
    @endunless

    @if (session()->has('newsletter_success'))
        @if ($compact)
            <p class="mb-2 text-[13px] text-emerald-400" role="status">{{ session('newsletter_success') }}</p>
        @else
            <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4">
                {{ session('newsletter_success') }}
            </div>
        @endif
    @endif

    @if ($compact)
        {{-- One-line footer form --}}
        <form wire:submit.prevent="subscribe" class="flex gap-2">
            <input
                type="email"
                wire:model="email"
                placeholder="Newsletter: your email"
                aria-label="Email address for the newsletter"
                class="min-w-0 flex-1 rounded-[10px] border border-dark-line bg-dark-secondary px-3.5 py-2.5 text-[14px] text-dark-accent placeholder:text-dark-muted focus:border-brand-blue-light focus:ring-1 focus:ring-brand-blue-light {{ $errors->has('email') ? 'border-red-300' : '' }}">
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="btn btn-ghost btn-sm flex-none">
                <span wire:loading.remove>Subscribe</span>
                <span wire:loading>Subscribing...</span>
            </button>
        </form>
        @error('email')
            <p class="mt-1 text-[13px] text-red-300">{{ $message }}</p>
        @enderror
    @else
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
    @endif
</div>

<div class="leading-[1.6]">
  <x-status-card>
    @if ($status === 'confirm')
      <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-yellow-400/10 text-yellow-300" aria-hidden="true">
        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
      </div>
      <h1 class="heading mb-4 text-[32px] font-bold">Unsubscribe from Newsletter</h1>
      <p class="mb-4 text-[18px] text-dark-muted">Are you sure you want to unsubscribe from our newsletter?</p>
      @if ($subscription)
        <p class="mb-8 text-dark-muted">Email: <span class="font-medium text-dark-accent">{{ $subscription->email }}</span></p>
      @endif
      <div class="flex flex-wrap justify-center gap-3">
        <button type="button" wire:click="confirmUnsubscribe" class="btn bg-red-400 text-ink">Yes, Unsubscribe</button>
        <a href="{{ route('home') }}" class="btn btn-ghost">Cancel</a>
      </div>
    @elseif ($status === 'processing')
      <svg class="mb-6 h-16 w-16 animate-spin text-brand-blue-light" fill="none" viewBox="0 0 24 24" aria-hidden="true">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
      <h1 class="heading mb-4 text-[26px] font-bold">Processing...</h1>
    @elseif ($status === 'success')
      <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-400/10 text-emerald-300" aria-hidden="true">
        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <h1 class="heading mb-4 text-[32px] font-bold">Successfully Unsubscribed</h1>
      <p class="mb-8 text-[18px] text-dark-muted">{{ $message }}</p>
      <p class="mb-8 text-dark-muted">If you change your mind, you can always subscribe again from our homepage.</p>
      <a href="{{ route('home') }}" class="btn btn-brand">Go to Homepage</a>
    @else
      <div class="mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-red-400/10 text-red-300" aria-hidden="true">
        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <h1 class="heading mb-4 text-[32px] font-bold">Error</h1>
      <p class="mb-8 text-[18px] text-dark-muted">{{ $message }}</p>
      <div class="flex flex-wrap justify-center gap-3">
        <a href="{{ route('home') }}" class="btn btn-ghost">Go to Homepage</a>
        <a href="{{ route('contact') }}" class="btn btn-brand">Contact Support</a>
      </div>
    @endif
  </x-status-card>
</div>

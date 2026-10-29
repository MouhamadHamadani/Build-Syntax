{{-- Centered card for single-purpose status pages (newsletter confirm and unsubscribe). --}}
<div class="wrap min-h-[60vh] pb-[72px] pt-[calc(var(--header-h)+56px)]">
  <div class="mx-auto max-w-2xl rounded-[14px] border border-dark-line bg-dark-secondary p-8 text-center min-[561px]:p-12">
    <div class="flex flex-col items-center">
      {{ $slot }}
    </div>
  </div>
</div>

@props(['eyebrow', 'title', 'lead'])

{{-- Intro block for About, Portfolio and Contact. Never .fade-in: it is above the fold. --}}
<div class="wrap pb-7 pt-[calc(var(--header-h)+56px)]">
  <p class="eyebrow">{{ $eyebrow }}</p>
  <h1 class="heading mt-4 text-[clamp(34px,5vw,52px)] font-extrabold">{{ $title }}</h1>
  <p class="mt-4 max-w-[62ch] text-[18px] text-dark-muted">{{ $lead }}</p>
</div>

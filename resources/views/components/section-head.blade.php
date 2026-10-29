@props(['eyebrow', 'title', 'text' => null])

{{-- Eyebrow, h2 and optional paragraph above a section. --}}
<div {{ $attributes->class(['mb-10 max-w-[640px]']) }}>
  <p class="eyebrow-section">{{ $eyebrow }}</p>
  <h2 class="heading mt-3 text-[clamp(28px,4vw,42px)] font-bold">{{ $title }}</h2>
  @if ($text)
    <p class="mt-3.5 text-[17px] text-dark-muted">{{ $text }}</p>
  @endif
</div>

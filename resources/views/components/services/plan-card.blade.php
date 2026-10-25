@props(['plan', 'type', 'button' => 'btn-c'])

{{-- One pricing card. Prices are printed exactly as stored in config/catalog.php. --}}
@php
  $featured = $plan['featured'] ?? false;
@endphp
<div @class(['pcard', 'pcard-pop' => $featured])>
  @if ($featured)
    <span class="pcard-badge">Most popular</span>
  @endif
  <h3 class="heading text-[22px] font-bold">{{ $plan['name'] }}</h3>
  <p class="text-[14.5px] text-dark-muted">{{ $plan['summary'] }}</p>
  <p class="pcard-amount">
    @if ($plan['price'] === null)
      {{ $plan['unit'] }}
    @else
      {{ $plan['prefix'] ?? '' }}{{ $plan['price'] }}@if ($plan['period'])<small>{{ $plan['period'] }}</small>@endif
    @endif
  </p>
  @if ($plan['billing'])
    <p class="-mt-1.5 text-[13px] text-dark-muted">{{ $plan['billing'] }}</p>
  @endif
  <ul class="ticks">
    @foreach ($plan['features'] as $feature)
      <li>{{ $feature }}</li>
    @endforeach
  </ul>
  @if ($plan['meta'])
    <p class="pt-1 text-[13px] text-dark-muted">{{ $plan['meta'] }}</p>
  @endif
  <a @class(['btn', $button => $featured, 'btn-ghost' => ! $featured])
    href="{{ route('contact', ['type' => $type, 'plan' => $plan['plan_key'] ?? $plan['name']]) }}">{{ $plan['cta'] }}</a>
</div>

@props(['products'])

{{-- Hero showcase: one real product screen at a time. State and autoplay live in resources/js/home.js.
     Rendered server-side with slide 1 showing, so it reads correctly before Alpine starts. --}}
<div class="w-full min-w-0" x-data="showcase({{ count($products) }})">
  <div class="showcase-stage">
    @foreach ($products as $product)
      @php
        $shot = $product['showcase'];
        $laptop = $shot['laptop'];
        $phone = $shot['phone'];
      @endphp
      <div id="slide-{{ $loop->index }}" role="tabpanel" aria-labelledby="tab-{{ $loop->index }}"
        @unless ($loop->first) aria-hidden="true" @endunless
        :aria-hidden="active !== {{ $loop->index }} ? 'true' : null"
        class="showcase-slide accent-{{ $product['accent'] }}">
        <figure class="showcase-win">
          <div class="showcase-bar"><i></i><i></i><i></i><span>{{ $shot['title'] }}</span></div>
          <img src="{{ asset('images/showcase/' . $laptop['file']) }}" alt="{{ $laptop['alt'] }}"
            width="{{ $laptop['width'] }}" height="{{ $laptop['height'] }}"
            @if ($loop->first) loading="eager" fetchpriority="high" @else loading="lazy" @endif decoding="async"
            class="block aspect-[16/10] h-auto w-full object-cover object-left-top">
        </figure>
        @if ($phone)
          <figure class="showcase-phone">
            <img src="{{ asset('images/showcase/' . $phone['file']) }}" alt="{{ $phone['alt'] }}"
              width="{{ $phone['width'] }}" height="{{ $phone['height'] }}"
              @if ($loop->first) loading="eager" @else loading="lazy" @endif decoding="async"
              class="block h-auto w-full">
          </figure>
        @endif
      </div>
    @endforeach
  </div>

  <div x-ref="tablist" role="tablist" aria-label="Our products" class="grid grid-cols-2 gap-2 min-[561px]:grid-cols-4"
    @keydown.arrow-right.prevent="move(active + 1)" @keydown.arrow-left.prevent="move(active - 1)"
    @keydown.home.prevent="move(0)" @keydown.end.prevent="move({{ count($products) - 1 }})">
    @foreach ($products as $product)
      @php($tab = $product['showcase']['tab'])
      <button type="button" id="tab-{{ $loop->index }}" role="tab" aria-controls="slide-{{ $loop->index }}"
        aria-label="{{ $tab['wordmark'] ?? $product['name'] }}"
        aria-selected="{{ $loop->first ? 'true' : 'false' }}" tabindex="{{ $loop->first ? 0 : -1 }}"
        :aria-selected="active === {{ $loop->index }}" :tabindex="active === {{ $loop->index }} ? 0 : -1"
        @click="select({{ $loop->index }})" class="showcase-tab accent-{{ $product['accent'] }}">
        <img src="{{ asset('images/brand/' . $tab['logo']) }}" alt="" width="{{ $tab['width'] }}" height="{{ $tab['height'] }}">
        @if ($tab['wordmark'])
          <b @class([
            'font-bold leading-none',
            'font-jakarta text-[16px] text-[#085041]' => $tab['jakarta'] ?? false,
            'text-[15px] text-[#124f4a]' => ! ($tab['jakarta'] ?? false),
          ])>{{ $tab['wordmark'] }}</b>
        @endif
      </button>
    @endforeach
  </div>
</div>

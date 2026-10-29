@php
  $reasons = [
      ['title' => 'Based in Beirut', 'text' => 'Same time zone, same market, priced in USD.'],
      ['title' => 'Modern, maintained code', 'text' => 'Laravel and Livewire, not a tangle of plugins.'],
      ['title' => 'Arabic and English', 'text' => 'Menus, stores and booking pages work in Arabic, right-to-left.'],
      ['title' => 'Prices you can see', 'text' => 'Every product lists what it costs before you call.'],
  ];

  $faqs = [
      ['q' => 'What happens in the free consultation?', 'a' => 'A 30-minute video or in-person call. You leave with a clear scope and budget, whether or not you decide to work with us.'],
      ['q' => 'Do you work with businesses outside Beirut?', 'a' => 'Yes. We build for businesses across Lebanon and the region, and most of the work happens online.'],
      ['q' => 'Will my site or menu work in Arabic?', 'a' => 'Yes for menus, stores, booking pages and custom websites: CarteNex, ShopNex, Tymelo and our custom work support Arabic with right-to-left layouts. The LebaSouk POS screens are English for now.'],
      ['q' => 'How do payments work?', 'a' => 'CarteNex is a monthly subscription. LebaSouk POS has no deposit and is paid once installed. Custom projects are billed in stages, which we agree in writing before we start.'],
  ];
@endphp
<div class="leading-[1.6]">
  {{-- Hero. Nothing above the fold uses .fade-in, so the text is visible at rest.
       Top padding = 61px fixed header + 64px (101px on small screens: 61px + 40px). --}}
  <div class="wrap pb-14 pt-[125px] max-[900px]:pb-10 max-[900px]:pt-[101px]">
    <div class="grid items-center gap-10 min-[901px]:grid-cols-[1.05fr_1fr] min-[901px]:gap-14">
      <div>
        <p class="eyebrow">Web studio · Beirut, Lebanon</p>
        <h1 class="heading mt-[18px] text-[clamp(36px,5.4vw,62px)] font-extrabold">Websites and systems that <em class="not-italic text-brand-blue-light">run your business.</em></h1>
        <p class="mt-[22px] max-w-[52ch] text-[18px] text-dark-muted">We build online stores, QR menus, booking systems and point of sale for businesses in Lebanon and the region. Arabic and English, with prices listed up front.</p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a class="btn btn-wa" href="https://wa.me/9613876822" target="_blank" rel="noopener">Chat on WhatsApp</a>
          <a class="btn btn-ghost" href="#products">See products and prices</a>
        </div>
        <div class="mt-9 flex flex-wrap gap-x-[22px] gap-y-2 border-t border-dark-line pt-[22px] text-[13.5px] text-dark-muted">
          <span class="fact">Based in Beirut</span>
          <span class="fact">Arabic + English, RTL ready</span>
          <span class="fact">Prices in USD</span>
          <span class="fact">Free 30-minute consultation</span>
        </div>
      </div>

      <x-home.showcase :products="$products" />
    </div>
  </div>

  {{-- Products: rendered from config/products.php --}}
  <section id="products" class="wrap py-[72px]">
    <div class="mb-10 max-w-[640px]">
      <p class="eyebrow-section">What we build</p>
      <h2 class="heading mt-3 text-[clamp(28px,4vw,42px)] font-bold">Pick the system that fits your business.</h2>
      <p class="mt-3.5 text-[17px] text-dark-muted">Each product is ready to install and priced openly. If none fits, we build it custom.</p>
    </div>

    <div class="grid gap-4">
      @foreach ($products as $product)
        <article class="product-card product-feature accent-{{ $product['accent'] }}">
          <div class="flex min-w-0 flex-[1.15] flex-col gap-[14px]">
            <span class="product-tag">{{ $product['tagline'] }}</span>
            <h3 class="heading text-[26px] font-bold">{{ $product['name'] }}</h3>
            <p class="text-dark-muted">{{ $product['description'] }}</p>
            <ul class="ticks">
              @foreach ($product['features'] as $feature)
                <li>{{ $feature }}</li>
              @endforeach
            </ul>
            <p class="product-for"><b>For:</b> {{ $product['for'] }} @if ($product['for_extra_strong'])<b>{{ $product['for_extra'] }}</b>@else{{ $product['for_extra'] }}@endif</p>
            <div class="product-foot">
              <span class="product-price">From {{ $product['price']['from'] }}<small>{{ $product['price']['unit'] }}</small></span>
              <a class="product-more" href="{{ $product['demo']['url'] }}" target="_blank" rel="noopener">{{ $product['demo']['label'] }}</a>
            </div>
          </div>

          <div class="flex min-w-0 flex-1 flex-col justify-center gap-2.5" role="group" aria-label="{{ $product['plans_label'] }}">
            @foreach ($product['plans'] as $plan)
              <div @class(['plan', 'is-featured' => $plan['featured']])>
                <div><b>{{ $plan['name'] }}</b><small>{{ $plan['description'] }}</small></div>
                <span class="plan-price">
                  @if ($plan['price'] === null)
                    <small><a class="underline underline-offset-2 transition-colors hover:text-dark-accent" href="{{ route('contact', ['type' => $product['project_type'], 'plan' => $plan['name']]) }}">{{ $plan['unit'] }}</a></small>
                  @else
                    {{ $plan['price'] }}@if ($plan['unit'])<small>{{ $plan['unit'] }}</small>@endif
                  @endif
                </span>
              </div>
            @endforeach
            <p class="pt-1 text-[13.5px] text-dark-muted">{{ $product['note'] }}</p>
          </div>
        </article>
      @endforeach

      <article class="product-card product-wide accent-{{ $custom['accent'] }}">
        <div class="flex min-w-0 flex-1 flex-col gap-3">
          <span class="product-tag">{{ $custom['tagline'] }}</span>
          <h3 class="heading text-[26px] font-bold">{{ $custom['headline'] }}</h3>
          <p class="text-dark-muted">{{ $custom['description'] }}</p>
          <div class="product-foot">
            <span class="product-price">From {{ $custom['price']['from'] }}</span>
            <a class="product-more" href="{{ route('contact', ['type' => $custom['project_type']]) }}">{{ $custom['cta'] }}</a>
          </div>
        </div>
        <pre class="code-block"><span class="text-brand-blue-light">Stack</span>
@foreach ($custom['stack'] as $line)
@if ($loop->last)<span class="text-tymelo">{{ $line }}</span>@else{{ $line }}
@endif
@endforeach</pre>
      </article>
    </div>
  </section>

  {{-- How we work --}}
  <div id="process" class="border-y border-dark-line bg-dark-tertiary">
    <section class="wrap py-[72px]">
      <div class="fade-in">
        <div class="mb-10 max-w-[640px]">
          <p class="eyebrow-section">How we work</p>
          <h2 class="heading mt-3 text-[clamp(28px,4vw,42px)] font-bold">From first call to launch in three steps.</h2>
        </div>
        <x-process-steps />
      </div>
    </section>
  </div>

  {{-- Why us --}}
  <section id="why" class="wrap py-[72px]">
    <div class="fade-in grid items-start gap-8 min-[861px]:grid-cols-[1fr_1.4fr] min-[861px]:gap-14">
      <div class="max-w-[640px]">
        <p class="eyebrow-section">Why Build Syntax</p>
        <h2 class="heading mt-3 text-[clamp(28px,4vw,42px)] font-bold">A local studio you can reach on WhatsApp.</h2>
        <p class="mt-3.5 text-[17px] text-dark-muted">No offshore delays and no surprise invoices.</p>
      </div>
      <div class="grid gap-x-8 gap-y-7 min-[521px]:grid-cols-2">
        @foreach ($reasons as $reason)
          <div class="min-w-0 border-t-2 border-brand-blue-light pt-4">
            <h3 class="heading text-[18px] font-semibold tracking-[-0.01em]">{{ $reason['title'] }}</h3>
            <p class="mt-1.5 text-[15px] text-dark-muted">{{ $reason['text'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- FAQ --}}
  <section id="faq" class="wrap py-[72px]">
    <div class="fade-in">
      <div class="mb-10 max-w-[640px]">
        <p class="eyebrow-section">Questions</p>
        <h2 class="heading mt-3 text-[clamp(28px,4vw,42px)] font-bold">Before you message us.</h2>
      </div>
      <x-faq :items="$faqs" />
    </div>
  </section>

  {{-- Contact --}}
  <div id="contact" class="wrap scroll-mt-20 pb-[72px]">
    <x-contact-card class="fade-in" />
  </div>
</div>

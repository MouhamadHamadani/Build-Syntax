@php
  // Static page copy. Plans, prices, features, hosting and maintenance come from config/catalog.php.
  $terms = [
      ['Currency', 'Prices in USD. LBP accepted at the current market rate.'],
      ['Menus and booking', 'Monthly or yearly, with 2 months free when you pay yearly.'],
      ['Stores and POS', 'Paid once. ShopNex: 50% to start, 30% on delivery, 20% after training. LebaSouk POS: no deposit.'],
      ['Custom work', 'Billed in stages we agree in writing before we start.'],
  ];

  // Sub-navigation: the four products, then custom development, then hosting.
  $sections = collect($products)
      ->map(fn ($product) => ['id' => $product['service']['anchor'], 'label' => $product['name'], 'accent' => $product['accent']])
      ->values()
      ->push(['id' => $custom['service']['anchor'], 'label' => 'Custom development', 'accent' => 'brand'])
      ->push(['id' => $hosting['anchor'], 'label' => 'Hosting and maintenance', 'accent' => 'brand'])
      ->all();

  // Anchored headings clear the fixed header (--header-h) plus the sticky sub-navigation.
  $anchorOffset = 'scroll-mt-[calc(var(--header-h)+69px)]';
@endphp
<div class="leading-[1.6]">
  {{-- Hero. No .fade-in above the fold. Top padding = fixed header + 56px. --}}
  <div class="wrap pb-9 pt-[calc(var(--header-h)+56px)]">
    <p class="eyebrow">Services and pricing</p>
    <h1 class="heading mt-4 text-[clamp(34px,5vw,54px)] font-extrabold">Every price on one page.</h1>
    <p class="mt-[18px] max-w-[60ch] text-[18px] text-dark-muted">Four ready-made products and custom development. Pick one, see what it costs, and message us when you are ready.</p>
    <div class="terms">
      @foreach ($terms as [$label, $text])
        <div><b>{{ $label }}</b>{{ $text }}</div>
      @endforeach
    </div>
  </div>

  {{-- Sticky sub-navigation; the link of the section in view is marked aria-current --}}
  <nav class="subnav" aria-label="Service sections" x-data="subnav(@js(array_column($sections, 'id')))">
    <div class="wrap">
      <ul class="scrollbar-hide m-0 flex list-none gap-1.5 overflow-x-auto p-0 py-2.5">
        @foreach ($sections as $section)
          <li><a href="#{{ $section['id'] }}" class="subnav-link accent-{{ $section['accent'] }}"
              :aria-current="active === '{{ $section['id'] }}' ? 'location' : null">{{ $section['label'] }}</a></li>
        @endforeach
      </ul>
    </div>
  </nav>

  {{-- The four products --}}
  @foreach ($products as $product)
    @php
      $service = $product['service'];
      $logo = $service['logo'];
      $plans = $product['plans'];
      $columns = count($plans) === 2 ? 'min-[901px]:max-w-[780px] min-[901px]:grid-cols-2' : 'min-[901px]:grid-cols-3';
    @endphp
    {{-- Old anchors (#menus, #ecommerce, #appointment) keep working for outside links --}}
    @foreach ($service['legacy_anchors'] as $legacy)
      <span id="{{ $legacy }}" class="block h-0 {{ $anchorOffset }}"></span>
    @endforeach
    <section id="{{ $service['anchor'] }}" @class(['accent-' . $product['accent'], 'py-[72px]', $anchorOffset, 'band' => $loop->odd === false])>
      <div class="wrap">
        <div class="mb-8 grid items-start gap-6 min-[901px]:grid-cols-[1.1fr_1fr] min-[901px]:gap-12">
          <div>
            <span class="product-tag mb-4 table">{{ $product['tagline'] }}</span>
            <h2 class="heading flex flex-wrap items-center gap-[14px] text-[clamp(28px,4vw,40px)] font-bold">
              <img src="{{ asset('images/brand/' . $logo['file']) }}" alt="{{ $logo['alt'] }}" width="{{ $logo['width'] }}" height="{{ $logo['height'] }}"
                @class(['h-[34px] w-auto rounded-lg bg-white py-1', 'px-2' => ! $logo['wordmark'], 'px-1.5' => $logo['wordmark']])>
              @if ($logo['wordmark'])<span @class(['font-jakarta' => $logo['jakarta'] ?? false])>{{ $logo['wordmark'] }}</span>@endif
            </h2>
            <p class="mt-[14px] max-w-[56ch] text-[17px] text-dark-muted">{{ $product['description'] }}</p>
            <p class="product-for mt-4 max-w-[56ch] !text-[17px]"><b>For:</b> {{ $product['for'] }} {{ $product['for_extra'] }}</p>
            <div class="mt-[22px] flex flex-wrap gap-3">
              <a class="btn btn-c" href="{{ $product['demo']['url'] }}" target="_blank" rel="noopener">{{ $product['demo']['label'] }}</a>
              @if ($service['secondary_cta'])
                <a class="btn btn-ghost" href="{{ route('contact', ['type' => $product['project_type'], 'plan' => $service['secondary_cta']['plan']]) }}">{{ $service['secondary_cta']['label'] }}</a>
              @endif
            </div>
          </div>
          <ul class="ticks pt-1.5" aria-label="Included">
            @foreach ($product['features'] as $feature)
              <li>{{ $feature }}</li>
            @endforeach
          </ul>
        </div>

        <div class="grid gap-4 {{ $columns }}">
          @foreach ($plans as $plan)
            <x-services.plan-card :plan="$plan" :type="$product['project_type']" />
          @endforeach
        </div>
        <p class="mt-5 max-w-[80ch] text-[14px] text-dark-muted"><b class="font-semibold text-dark-accent">{{ $service['note']['strong'] }}</b> {{ $service['note']['text'] }}</p>
      </div>
    </section>
  @endforeach

  {{-- Custom development --}}
  @php($web = $custom['service'])
  <section id="{{ $web['anchor'] }}" class="accent-brand py-[72px] {{ $anchorOffset }}">
    <div class="wrap">
      <div class="mb-8 grid items-start gap-6 min-[901px]:grid-cols-[1.1fr_1fr] min-[901px]:gap-12">
        <div>
          <span class="product-tag mb-4 table">{{ $custom['tagline'] }}</span>
          <h2 class="heading text-[clamp(28px,4vw,40px)] font-bold">{{ $web['heading'] }}</h2>
          <p class="mt-[14px] max-w-[56ch] text-[17px] text-dark-muted">{{ $web['intro'] }}</p>
        </div>
        <ul class="ticks pt-1.5" aria-label="Stack">
          @foreach ($web['points'] as $point)
            <li>{{ $point }}</li>
          @endforeach
        </ul>
      </div>
      <div class="grid gap-4 min-[901px]:grid-cols-3">
        @foreach ($web['plans'] as $plan)
          <x-services.plan-card :plan="$plan" :type="$custom['project_type']" />
        @endforeach
      </div>
    </div>
  </section>

  {{-- Hosting and maintenance --}}
  <section id="{{ $hosting['anchor'] }}" class="accent-brand band py-[72px] {{ $anchorOffset }}">
    <div class="wrap">
      <div class="mb-10 max-w-[640px]">
        {{-- 11px wrapper: the reference's inline tag adds only 11px of line height and overhangs the section top, so match that. --}}
        <p class="text-[11px] leading-none"><span class="product-tag">{{ $hosting['tag'] }}</span></p>
        <h2 class="heading mt-3 text-[clamp(28px,4vw,42px)] font-bold">{{ $hosting['heading'] }}</h2>
        <p class="mt-3.5 text-[17px] text-dark-muted">{{ $hosting['intro'] }}</p>
      </div>

      <div class="mb-5">
        <h3 class="heading text-[24px] font-bold">{{ $hosting['vps']['heading'] }}</h3>
        <p class="mt-1.5 text-dark-muted">{{ $hosting['vps']['intro'] }}</p>
      </div>
      <div class="grid gap-4 min-[901px]:grid-cols-3">
        @foreach ($hosting['vps']['tiers'] as $tier)
          <div class="pcard">
            <h3 class="heading text-[22px] font-bold">{{ $tier['name'] }}</h3>
            <p class="pcard-amount">{{ $tier['price'] }}<small>{{ $tier['period'] }}</small></p>
            <ul class="ticks">
              @foreach ($tier['features'] as $feature)
                <li>{{ $feature }}</li>
              @endforeach
            </ul>
          </div>
        @endforeach
      </div>

      <div class="mb-5 mt-14">
        <h3 class="heading text-[24px] font-bold">{{ $hosting['maintenance']['heading'] }}</h3>
        <p class="mt-1.5 text-dark-muted">{{ $hosting['maintenance']['intro'] }}</p>
      </div>
      <div class="grid gap-4 min-[641px]:grid-cols-2 min-[1101px]:grid-cols-4">
        @foreach ($hosting['maintenance']['plans'] as $plan)
          <x-services.plan-card :plan="$plan" :type="$hosting['project_type']" button="btn-brand" />
        @endforeach
      </div>
    </div>
  </section>

  {{-- Contact --}}
  <div class="wrap py-[72px]">
    <div class="contact-card">
      <div>
        <h2 class="heading text-[clamp(28px,4vw,42px)] font-extrabold">Not sure which one fits?</h2>
        <p class="mt-3.5 max-w-[46ch] opacity-85">Tell us what you sell. We will tell you what fits, and what it costs.</p>
      </div>
      <div class="grid gap-2.5">
        <a class="btn btn-wa btn-lg" href="https://wa.me/9613876822" target="_blank" rel="noopener">Chat on WhatsApp</a>
        <div class="copy-row" x-data="copyButton('+961 3 876 822')">
          <span>+961 3 876 822</span>
          <button type="button" @click="copy()" x-text="label">Copy</button>
        </div>
        <div class="copy-row" x-data="copyButton('info@build-syntax.com')">
          <span>info@build-syntax.com</span>
          <button type="button" @click="copy()" x-text="label">Copy</button>
        </div>
      </div>
    </div>
  </div>
</div>

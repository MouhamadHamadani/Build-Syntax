@php
  $facts = [
      [count($products), 'Products, each with a live demo'],
      ['AR + EN', 'Menus, stores and booking pages'],
      ['24h', 'We reply within a day'],
  ];

  $principles = [
      ['title' => 'Prices before calls', 'text' => 'Every product lists what it costs. Custom work is quoted in writing before we start.'],
      ['title' => 'We build what is promised', 'text' => 'If a feature is not built, we do not put it on the page. Our product pages only list what you can try in the demo.'],
      ['title' => 'Your data stays yours', 'text' => 'You own the code and content made for your project once it is paid for, as set out in our terms.'],
      ['title' => 'Support after launch', 'text' => 'Each plan includes a support period, and maintenance plans are available when it ends.'],
  ];
@endphp
<div class="leading-[1.6]">
  <x-page-hero eyebrow="About"
    title="A Beirut studio that builds the systems small businesses actually use."
    lead="Build Syntax designs and builds websites, online stores, digital menus, booking systems and a point of sale, for businesses in Lebanon and the region." />

  {{-- Story and facts --}}
  <section class="wrap py-[72px]">
    <div class="grid items-start gap-8 min-[901px]:grid-cols-[1.2fr_1fr] min-[901px]:gap-14">
      <div class="story">
        <p>We started in 2025 with a simple idea: a business should not need an agency retainer to get a proper website, a menu people can open on their phone, or a way to take bookings.</p>
        <p>So we built four products that are ready to install and priced openly, and we take on custom work when none of them fits. Everything is built on Laravel and Livewire, in Arabic and English where the product supports it.</p>
        <p>We are based in Beirut, so we share your time zone and your market, and you can reach us on WhatsApp.</p>
      </div>
      <div class="grid grid-cols-2 gap-3">
        <div class="stat-tile"><b>2025</b><span>Founded in Beirut</span></div>
        @foreach ($facts as [$value, $label])
          <div class="stat-tile"><b>{{ $value }}</b><span>{{ $label }}</span></div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- How we work --}}
  <section class="band py-[72px]">
    <div class="wrap">
      <x-section-head eyebrow="How we work" title="Four things we hold ourselves to." />
      <div class="grid gap-x-8 gap-y-7 min-[641px]:grid-cols-2">
        @foreach ($principles as $principle)
          <div>
            <h3 class="heading border-t-2 border-brand-blue-light pt-4 text-[18px] font-bold">{{ $principle['title'] }}</h3>
            <p class="mt-1.5 text-[15px] text-dark-muted">{{ $principle['text'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Process --}}
  <section class="wrap py-[72px]">
    <x-section-head eyebrow="Process" title="From first message to launch." />
    <x-process-steps />
  </section>

  <div class="wrap py-[72px]">
    <x-contact-card />
  </div>
</div>

<div class="leading-[1.6]">
  <x-page-hero eyebrow="Portfolio" title="What we have built."
    lead="Four products we built and run ourselves, each with a live demo you can open. Client projects appear below as they launch." />

  {{-- Built by us: one card per product, from the Catalog --}}
  <section class="wrap py-[72px]">
    <h2 class="sr-only">Built by us</h2>
    <div class="grid gap-4 min-[761px]:grid-cols-2">
      @foreach ($products as $product)
        @php($shot = $product['showcase']['laptop'])
        <article class="demo-card accent-{{ $product['accent'] }}">
          <div class="demo-card-shot">
            <img src="{{ asset('images/showcase/' . $shot['file']) }}" alt="{{ $product['name'] }} demo screen"
              width="{{ $shot['width'] }}" height="{{ $shot['height'] }}" loading="lazy" decoding="async"
              class="block aspect-[16/10] h-auto w-full object-cover object-left-top">
          </div>
          <div class="flex flex-1 flex-col gap-2.5 p-[22px]">
            <h3 class="heading text-[22px] font-bold">{{ $product['name'] }}</h3>
            <p class="text-[15px] text-dark-muted">{{ $product['blurb'] }}</p>
            <div class="mt-auto flex flex-wrap items-center justify-between gap-3 pt-2.5">
              <span class="product-price">From {{ $product['price']['from'] }}{{ $product['card_unit'] }}</span>
              <a class="btn btn-ghost btn-sm" href="{{ $product['demo']['url'] }}" target="_blank" rel="noopener">Open the demo<span class="sr-only"> for {{ $product['name'] }} (opens in a new tab)</span></a>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  {{-- Client projects: published rows from the admin, with the category filter, search and detail modal --}}
  <section id="clients" class="wrap py-[72px]">
    <x-section-head eyebrow="Client projects" title="Delivered for clients." />

    <div class="mb-5 flex flex-wrap gap-2" role="group" aria-label="Filter projects">
      <button type="button" class="chip" aria-pressed="{{ $category === 'all' ? 'true' : 'false' }}"
        wire:click="filterByCategory('all')" wire:loading.attr="disabled" wire:target="filterByCategory">All projects</button>
      @foreach ($categoryLabels as $value => $label)
        <button type="button" class="chip" aria-pressed="{{ $category === $value ? 'true' : 'false' }}"
          wire:click="filterByCategory('{{ $value }}')" wire:loading.attr="disabled" wire:target="filterByCategory">{{ $label }}</button>
      @endforeach
    </div>

    <div class="relative mb-6 max-w-[380px]">
      <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search projects" aria-label="Search projects"
        class="search-input pr-10">
      <div wire:loading wire:target="search,filterByCategory" class="absolute right-3 top-1/2 -translate-y-1/2 text-brand-blue-light" aria-hidden="true">
        <svg class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
      </div>
    </div>

    <div wire:loading.class="opacity-50 transition-opacity" wire:target="filterByCategory,search">
      @if ($projects->count() > 0)
        <div class="grid gap-4 min-[761px]:grid-cols-2 min-[1101px]:grid-cols-3">
          @foreach ($projects as $project)
            <article class="demo-card accent-brand" wire:key="project-{{ $project->id }}" data-category="{{ $project->category }}">
              <div class="demo-card-shot">
                @if ($project->image_url)
                  <img src="{{ $project->image_url }}" alt="{{ $project->title }}" width="1100" height="688" loading="lazy" decoding="async"
                    class="block aspect-[16/10] h-auto w-full object-cover object-left-top">
                @else
                  <div class="flex aspect-[16/10] items-center justify-center text-dark-muted" aria-hidden="true">
                    <svg class="h-16 w-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                  </div>
                @endif
              </div>
              <div class="flex flex-1 flex-col gap-2.5 p-[22px]">
                <div class="flex flex-wrap items-center gap-2">
                  <span class="product-tag">{{ $categoryLabels[$project->category] ?? $project->category }}</span>
                  @if ($project->featured)
                    <span class="product-tag">Featured</span>
                  @endif
                </div>
                <h3 class="heading text-[22px] font-bold">{{ $project->title }}</h3>
                <p class="line-clamp-3 text-[15px] text-dark-muted">{{ $project->description }}</p>
                @if ($project->technologies)
                  <div class="flex flex-wrap gap-2">
                    @foreach ($project->technologies as $tech)
                      <x-tech-icon :tech="$tech" variant="chip" />
                    @endforeach
                  </div>
                @endif
                <div class="mt-auto flex flex-wrap items-center justify-between gap-3 pt-2.5">
                  <button type="button" wire:click="viewProject({{ $project->id }})" class="btn btn-ghost btn-sm">View details<span class="sr-only"> of {{ $project->title }}</span></button>
                  @if ($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener" class="product-more">Visit live site<span class="sr-only"> (opens in a new tab)</span></a>
                  @endif
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div class="mt-10">
          {{ $projects->links('pagination.site', ['noun' => 'projects', 'scrollTo' => 'clients']) }}
        </div>
      @elseif ($search || $category !== 'all')
        <div class="empty-state">
          <h3 class="heading text-[22px] font-bold">No projects match those filters</h3>
          <p class="mt-2 max-w-[60ch] text-dark-muted">Try clearing the search or picking a different category, or talk to us directly about a project we have not built yet.</p>
          <div class="mt-[18px] flex flex-wrap gap-3">
            <button type="button" wire:click="clearFilters" class="btn btn-ghost">Clear filters</button>
            <a class="btn btn-brand" href="{{ route('contact') }}">Start a project</a>
          </div>
        </div>
      @else
        <div class="empty-state">
          <h3 class="heading text-[22px] font-bold">Client case studies are on the way.</h3>
          <p class="mt-2 max-w-[60ch] text-dark-muted">We are adding projects here as they launch. Want yours to be one of the first? Tell us what you need and we will show you the closest product demo.</p>
          <a class="btn btn-brand mt-[18px]" href="{{ route('contact') }}">Start a project</a>
        </div>
      @endif
    </div>
  </section>

  {{-- Stack --}}
  <section class="band py-[72px]">
    <div class="wrap">
      <x-section-head eyebrow="Stack" title="What we build with." />
      <ul class="m-0 flex list-none flex-wrap gap-2.5 p-0">
        @foreach (['Laravel', 'Livewire', 'Tailwind CSS', 'Alpine.js', 'MySQL'] as $tool)
          <li class="stack-chip">{{ $tool }}</li>
        @endforeach
      </ul>
    </div>
  </section>

  <div class="wrap py-[72px]">
    <x-contact-card />
  </div>

  {{-- Project detail modal: focus moves in on open and returns to the button that opened it, Escape closes,
       the page behind is inert and cannot scroll. --}}
  @if ($selectedProject)
    <div x-data x-trap.noscroll.inert="true" x-cloak class="fixed inset-0 z-50 overflow-y-auto" @keydown.escape.window="$wire.closeModal()">
      <div class="fixed inset-0 bg-black/75" @click="$wire.closeModal()" aria-hidden="true"></div>

      <div class="flex min-h-screen items-center justify-center p-4">
        <div class="relative max-h-[90vh] w-full max-w-4xl overflow-y-auto rounded-[14px] border border-dark-line bg-dark-secondary shadow-xl"
          role="dialog" aria-modal="true" aria-labelledby="project-modal-title">
          <button type="button" @click="$wire.closeModal()" aria-label="Close project details"
            class="absolute right-4 top-4 z-10 rounded-full bg-dark-primary/80 p-1.5 text-dark-accent transition-colors hover:bg-dark-primary">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <div class="p-8">
            @if ($selectedProject->image_url)
              <img src="{{ $selectedProject->image_url }}" alt="{{ $selectedProject->title }}" width="1100" height="688"
                class="mb-6 aspect-[16/10] h-auto w-full rounded-xl object-cover object-left-top">
            @endif

            <div class="accent-brand mb-3 flex flex-wrap items-center gap-2">
              <span class="product-tag">{{ $categoryLabels[$selectedProject->category] ?? $selectedProject->category }}</span>
              @if ($selectedProject->featured)
                <span class="product-tag">Featured</span>
              @endif
            </div>
            <h2 id="project-modal-title" class="heading mb-4 pr-8 text-[clamp(26px,4vw,34px)] font-bold">{{ $selectedProject->title }}</h2>
            <p class="mb-6 max-w-[70ch] text-[17px] text-dark-muted">{{ $selectedProject->description }}</p>

            @if ($selectedProject->technologies)
              <div class="mb-6">
                <h3 class="heading mb-3 text-[18px] font-semibold">Technologies used</h3>
                <div class="flex flex-wrap gap-2">
                  @foreach ($selectedProject->technologies as $tech)
                    <x-tech-icon :tech="$tech" variant="chip" />
                  @endforeach
                </div>
              </div>
            @endif

            @if ($selectedProject->project_url)
              <a href="{{ $selectedProject->project_url }}" target="_blank" rel="noopener" class="btn btn-brand">Visit live site<span class="sr-only"> (opens in a new tab)</span></a>
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif
</div>

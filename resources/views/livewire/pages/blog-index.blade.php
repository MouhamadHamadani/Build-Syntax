<div class="leading-[1.6]">
  <x-page-hero eyebrow="Blog" title="Our Blog"
    lead="Insights, tutorials, and tips on web development, technology trends, and business growth." />

  {{-- Featured post --}}
  @if ($featuredPost)
    <section class="wrap py-[72px]">
      <article class="demo-card accent-brand">
        <div class="grid lg:grid-cols-2">
          <div class="demo-card-shot">
            @if ($featuredPost->featured_image)
              <img src="{{ $featuredPost->featured_image }}" alt="{{ $featuredPost->title }}" width="1100" height="688" decoding="async"
                class="block aspect-[16/10] h-full w-full object-cover object-left-top">
            @else
              <div class="flex aspect-[16/10] h-full w-full items-center justify-center text-dark-muted" aria-hidden="true">
                <svg class="h-20 w-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
              </div>
            @endif
          </div>
          <div class="flex flex-col justify-center gap-3 p-[22px] min-[901px]:p-8">
            <span class="product-tag">Featured post</span>
            <h2 class="heading text-[clamp(26px,3.4vw,34px)] font-bold">
              <a href="{{ route('blog.show', $featuredPost->slug) }}" class="transition-colors hover:text-brand-blue-light">{{ $featuredPost->title }}</a>
            </h2>
            <p class="text-[17px] text-dark-muted">{{ $featuredPost->excerpt }}</p>
            <div class="mt-2 flex flex-wrap items-center justify-between gap-3">
              <p class="text-[14px] text-dark-muted">{{ $featuredPost->author }} · {{ $featuredPost->published_at->format('M d, Y') }} · {{ $featuredPost->reading_time }}</p>
              <a href="{{ route('blog.show', $featuredPost->slug) }}" class="product-more">Read more<span class="sr-only">: {{ $featuredPost->title }}</span></a>
            </div>
          </div>
        </div>
      </article>
    </section>
  @endif

  {{-- Posts --}}
  <section class="band py-[72px]">
    <div class="wrap">
      <div class="relative mb-8 max-w-[380px]">
        <svg class="pointer-events-none absolute left-3.5 top-1/2 h-5 w-5 -translate-y-1/2 text-dark-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search articles" aria-label="Search articles" class="search-input pl-11">
      </div>

      @if ($posts->count() > 0)
        <div class="grid gap-4 min-[761px]:grid-cols-2 min-[1101px]:grid-cols-3">
          @foreach ($posts as $post)
            <article class="demo-card accent-brand" wire:key="post-{{ $post->id }}">
              <div class="demo-card-shot">
                @if ($post->featured_image)
                  <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" width="1100" height="688" loading="lazy" decoding="async"
                    class="block aspect-[16/10] h-auto w-full object-cover object-left-top">
                @else
                  <div class="flex aspect-[16/10] items-center justify-center text-dark-muted" aria-hidden="true">
                    <svg class="h-14 w-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                  </div>
                @endif
              </div>
              <div class="flex flex-1 flex-col gap-2.5 p-[22px]">
                <p class="text-[13px] text-dark-muted">{{ $post->published_at->format('M d, Y') }} · {{ $post->reading_time }}</p>
                <h3 class="heading line-clamp-2 text-[20px] font-bold">
                  <a href="{{ route('blog.show', $post->slug) }}" class="transition-colors hover:text-brand-blue-light">{{ $post->title }}</a>
                </h3>
                <p class="line-clamp-3 flex-1 text-[15px] text-dark-muted">{{ $post->excerpt }}</p>
                <div class="mt-auto flex flex-wrap items-center justify-between gap-3 pt-2.5">
                  <span class="text-[14px] text-dark-muted">{{ $post->author }}</span>
                  <a href="{{ route('blog.show', $post->slug) }}" class="product-more">Read more<span class="sr-only">: {{ $post->title }}</span></a>
                </div>
              </div>
            </article>
          @endforeach
        </div>

        <div class="mt-10">
          {{ $posts->links('pagination.site', ['noun' => 'articles']) }}
        </div>
      @else
        <div class="empty-state">
          @if ($search)
            <h3 class="heading text-[22px] font-bold">No articles found matching your search.</h3>
          @else
            <h3 class="heading text-[22px] font-bold">Articles are coming soon.</h3>
          @endif
          <a class="btn btn-brand mt-[18px]" href="{{ route('services') }}">Explore our services</a>
        </div>
      @endif
    </div>
  </section>
</div>

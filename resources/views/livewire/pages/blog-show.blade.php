<div class="leading-[1.6]">
  {{-- Header: breadcrumb, title, meta --}}
  <div class="wrap pb-7 pt-[calc(var(--header-h)+56px)]">
    <div class="max-w-[760px]">
      <nav aria-label="Breadcrumb" class="mb-5 text-[14px] text-dark-muted">
        <ol class="m-0 flex list-none flex-wrap items-center gap-x-2 gap-y-1 p-0">
          <li><a href="{{ route('home') }}" class="transition-colors hover:text-dark-accent">Home</a></li>
          <li aria-hidden="true">/</li>
          <li><a href="{{ route('blog.index') }}" class="transition-colors hover:text-dark-accent">Blog</a></li>
          <li aria-hidden="true">/</li>
          <li aria-current="page" class="text-dark-accent">{{ $post->title }}</li>
        </ol>
      </nav>

      <h1 class="heading text-[clamp(30px,5vw,48px)] font-extrabold">{{ $post->title }}</h1>

      <ul class="m-0 mt-5 flex list-none flex-wrap gap-x-6 gap-y-2 p-0 text-[14px] text-dark-muted">
        <li class="flex items-center gap-2">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
          <span>{{ $post->author }}</span>
        </li>
        <li class="flex items-center gap-2">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
          <span>{{ $post->published_at->format('F d, Y') }}</span>
        </li>
        <li class="flex items-center gap-2">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span>{{ $post->reading_time }}</span>
        </li>
        <li class="flex items-center gap-2">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
          <span>{{ $post->view_count }} views</span>
        </li>
      </ul>
    </div>
  </div>

  {{-- Featured image --}}
  @if ($post->featured_image)
    <div class="wrap pb-8">
      <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" width="1100" height="688" decoding="async"
        class="block aspect-[16/10] h-auto w-full max-w-[760px] rounded-[14px] border border-dark-line object-cover object-left-top">
    </div>
  @endif

  {{-- Article --}}
  <article class="wrap pb-[72px]">
    <div class="max-w-[760px]">
      {{-- Escaping is deliberate: post content is plain text, line breaks only. --}}
      <div class="post-body">
        {!! nl2br(e($post->content)) !!}
      </div>

      @if ($post->tags && count($post->tags) > 0)
        <div class="mt-10 border-t border-dark-line pt-8">
          <h2 class="heading mb-4 text-[18px] font-semibold">Tags</h2>
          <ul class="m-0 flex list-none flex-wrap gap-2 p-0">
            @foreach ($post->tags as $tag)
              <li class="chip cursor-default">{{ $tag }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="mt-8 border-t border-dark-line pt-8">
        <h2 class="heading mb-4 text-[18px] font-semibold">Share this article</h2>
        <div class="flex flex-wrap gap-3">
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}"
            target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
            <span>Twitter<span class="sr-only"> (opens in a new tab)</span></span>
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}"
            target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            <span>Facebook<span class="sr-only"> (opens in a new tab)</span></span>
          </a>
          <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post->slug)) }}&title={{ urlencode($post->title) }}"
            target="_blank" rel="noopener noreferrer" class="btn btn-ghost btn-sm">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            <span>LinkedIn<span class="sr-only"> (opens in a new tab)</span></span>
          </a>
        </div>
      </div>

      <a href="{{ route('blog.index') }}" class="mt-10 inline-flex items-center gap-2 font-semibold text-brand-blue-light transition-colors hover:text-dark-accent">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        <span>Back to Blog</span>
      </a>
    </div>
  </article>

  {{-- Related posts --}}
  @if ($relatedPosts->count() > 0)
    <section class="band py-[72px]">
      <div class="wrap">
        <h2 class="heading mb-8 text-[clamp(28px,4vw,42px)] font-bold">Related Articles</h2>
        <div class="grid gap-4 min-[761px]:grid-cols-3">
          @foreach ($relatedPosts as $relatedPost)
            <article class="demo-card accent-brand">
              <div class="demo-card-shot">
                @if ($relatedPost->featured_image)
                  <img src="{{ $relatedPost->featured_image }}" alt="{{ $relatedPost->title }}" width="1100" height="688" loading="lazy" decoding="async"
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
                <p class="text-[13px] text-dark-muted">{{ $relatedPost->published_at->format('M d, Y') }}</p>
                <h3 class="heading line-clamp-2 text-[18px] font-bold">
                  <a href="{{ route('blog.show', $relatedPost->slug) }}" class="transition-colors hover:text-brand-blue-light">{{ $relatedPost->title }}</a>
                </h3>
                <p class="line-clamp-2 text-[15px] text-dark-muted">{{ $relatedPost->excerpt }}</p>
                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="product-more mt-auto self-start">Read more<span class="sr-only">: {{ $relatedPost->title }}</span></a>
              </div>
            </article>
          @endforeach
        </div>
      </div>
    </section>
  @endif
</div>

{{-- Livewire pagination in the site's chip style.
     Use: $paginator->links('pagination.site', ['noun' => 'projects', 'scrollTo' => 'clients'])
     noun names the items in the summary; scrollTo is an optional element id to scroll to on page change. --}}
@php
  $noun = $noun ?? 'results';
  $scroll = isset($scrollTo) ? "document.getElementById('{$scrollTo}')?.scrollIntoView()" : '';
@endphp
<div>
  @if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex flex-wrap items-center justify-between gap-4">
      <p class="text-[14px] text-dark-muted">
        Showing <span class="font-medium text-dark-accent">{{ $paginator->firstItem() }}</span>
        to <span class="font-medium text-dark-accent">{{ $paginator->lastItem() }}</span>
        of <span class="font-medium text-dark-accent">{{ $paginator->total() }}</span> {{ $noun }}
      </p>

      <div class="flex flex-wrap gap-2">
        @if ($paginator->onFirstPage())
          <span class="chip cursor-default opacity-50" aria-disabled="true">Previous</span>
        @else
          <button type="button" class="chip" wire:click="previousPage('{{ $paginator->getPageName() }}')"
            x-on:click="{{ $scroll }}">Previous</button>
        @endif

        @foreach ($elements as $element)
          @if (is_string($element))
            <span class="px-1 py-[9px] text-[14px] text-dark-muted" aria-hidden="true">{{ $element }}</span>
          @endif

          @if (is_array($element))
            @foreach ($element as $page => $url)
              <button type="button" class="chip" wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}"
                @if ($page == $paginator->currentPage()) aria-current="page" aria-pressed="true" @else aria-pressed="false" @endif
                wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                x-on:click="{{ $scroll }}"
                aria-label="Go to page {{ $page }}">{{ $page }}</button>
            @endforeach
          @endif
        @endforeach

        @if ($paginator->hasMorePages())
          <button type="button" class="chip" wire:click="nextPage('{{ $paginator->getPageName() }}')"
            x-on:click="{{ $scroll }}">Next</button>
        @else
          <span class="chip cursor-default opacity-50" aria-disabled="true">Next</span>
        @endif
      </div>
    </nav>
  @endif
</div>

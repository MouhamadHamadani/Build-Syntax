<div class="flex flex-col gap-7">

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">{{ $today }}</p>
            <h1 class="admin-h1">{{ $greeting }}, {{ $firstName }}</h1>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn btn-ghost btn-sm">View site ↗&#xFE0E;</a>
    </header>

    {{-- Totals --}}
    <section aria-label="Totals" class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4">
        <div class="panel p-5">
            <p class="mono-label">New contacts</p>
            <p class="mb-0.5 mt-2.5 text-4xl font-extrabold text-brand-blue-light">{{ $stats['contacts_new'] }}</p>
            <p class="text-[13px] text-dark-muted">{{ $stats['contacts_total'] }} total</p>
        </div>
        <div class="panel p-5">
            <p class="mono-label">Published posts</p>
            <p class="mb-0.5 mt-2.5 text-4xl font-extrabold">{{ $stats['blog_published'] }}</p>
            <p class="text-[13px] text-dark-muted">{{ $stats['blog_drafts'] }} {{ Str::plural('draft', $stats['blog_drafts']) }}</p>
        </div>
        <div class="panel p-5">
            <p class="mono-label">Portfolio projects</p>
            <p class="mb-0.5 mt-2.5 text-4xl font-extrabold">{{ $stats['portfolio_total'] }}</p>
            <p class="text-[13px] text-dark-muted">client {{ Str::plural('project', $stats['portfolio_total']) }}</p>
        </div>
        <div class="panel p-5">
            <p class="mono-label">Subscribers</p>
            <p class="mb-0.5 mt-2.5 text-4xl font-extrabold">{{ $stats['newsletter_active'] }}</p>
            <p class="text-[13px] text-dark-muted">{{ $stats['newsletter_total'] }} total, {{ $stats['newsletter_pending'] }} unconfirmed</p>
        </div>
    </section>

    <div class="flex flex-wrap items-start gap-5">
        {{-- Needs a reply: new contacts, oldest first --}}
        <section class="panel min-w-0 flex-[2_1_460px]" aria-labelledby="needs-reply">
            <div class="panel-head">
                <h2 id="needs-reply">Needs a reply</h2>
                <a href="{{ route('admin.contacts.index') }}" wire:navigate class="admin-link text-sm font-semibold">All contacts →</a>
            </div>
            @forelse($needsReply as $contact)
                @php
                    $product = \App\Support\Enquiry::product($contact->project_type);
                    $plan = \App\Support\Enquiry::plan($contact);
                @endphp
                <a href="{{ route('admin.contacts.show', $contact->id) }}" wire:navigate class="row-link">
                    <span class="avatar" aria-hidden="true">{{ strtoupper(mb_substr($contact->name, 0, 1)) }}</span>
                    <span class="min-w-0 flex-1">
                        <b class="block truncate font-semibold">{{ $contact->name }}</b>
                        <span class="block truncate text-[13px] text-dark-muted">{{ $product['name'] }}{{ $plan ? ' · '.$plan.' plan' : '' }} · {{ $contact->created_at->diffForHumans() }}</span>
                    </span>
                    @if(\App\Support\Enquiry::isOverdue($contact))
                        <span class="bd bd-warn">Overdue {{ $overdueHours }} h</span>
                    @else
                        <span class="bd bd-new">New</span>
                    @endif
                </a>
            @empty
                <p class="border-t border-dark-line px-5 py-8 text-center text-sm text-dark-muted">Nothing is waiting for a reply.</p>
            @endforelse
        </section>

        {{-- Quick actions --}}
        <section class="panel min-w-0 flex-[1_1_280px]" aria-labelledby="quick-actions">
            <div class="panel-head"><h2 id="quick-actions">Quick actions</h2></div>
            <a href="{{ route('admin.portfolio.create') }}" wire:navigate class="row-link"><span class="flex-1">Add a portfolio project</span><span aria-hidden="true">→</span></a>
            <a href="{{ route('admin.blog.create') }}" wire:navigate class="row-link"><span class="flex-1">Write a blog post</span><span aria-hidden="true">→</span></a>
        </section>
    </div>

    {{-- Enquiries by product --}}
    <section class="panel" aria-labelledby="by-product">
        <div class="px-5 py-[18px]">
            <h2 id="by-product" class="text-[18px] font-semibold">Enquiries by product</h2>
            <p class="mt-1 text-[13px] text-dark-muted">All time, from the contact form</p>
        </div>
        <div class="flex flex-col gap-3 px-5 pb-[22px] pt-1">
            @forelse($enquiriesByProduct as $row)
                <div class="accent-{{ $row['accent'] }} flex items-center gap-3.5">
                    <span class="w-[160px] flex-none truncate text-sm">{{ $row['name'] }}</span>
                    <span class="bar-track" aria-hidden="true"><span class="bar-fill" style="width: {{ $row['percent'] }}%"></span></span>
                    <b class="w-8 flex-none text-right tabular-nums">{{ $row['total'] }}</b>
                </div>
            @empty
                <p class="text-sm text-dark-muted">No enquiries yet.</p>
            @endforelse
        </div>
    </section>
</div>

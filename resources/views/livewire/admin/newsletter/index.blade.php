<div class="flex flex-col gap-[22px]">

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">Sales</p>
            <h1 class="admin-h1">Newsletter</h1>
        </div>
    </header>

    {{-- Totals --}}
    <section aria-label="Totals" class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4">
        <div class="panel p-5">
            <p class="mono-label">Active subscribers</p>
            <p class="mt-2.5 text-4xl font-extrabold text-emerald-400">{{ $totals['active'] }}</p>
        </div>
        <div class="panel p-5">
            <p class="mono-label">Awaiting confirmation</p>
            <p class="mt-2.5 text-4xl font-extrabold text-[#F0C25B]">{{ $totals['unconfirmed'] }}</p>
        </div>
        <div class="panel p-5">
            <p class="mono-label">Unsubscribed</p>
            <p class="mt-2.5 text-4xl font-extrabold">{{ $totals['unsubscribed'] }}</p>
        </div>
    </section>

    {{-- Filters --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <nav class="flex flex-wrap gap-1.5" aria-label="Status">
            <button type="button" wire:click="$set('status', '')" class="chip" aria-pressed="{{ $status === '' ? 'true' : 'false' }}">All</button>
            <button type="button" wire:click="$set('status', 'active')" class="chip" aria-pressed="{{ $status === 'active' ? 'true' : 'false' }}">Active</button>
            <button type="button" wire:click="$set('status', 'unsubscribed')" class="chip" aria-pressed="{{ $status === 'unsubscribed' ? 'true' : 'false' }}">Unsubscribed</button>
        </nav>
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search email or name" aria-label="Search subscribers"
               class="field-input !w-auto min-w-[240px] !py-[11px] !text-sm">
    </div>

    <section class="panel">
        <table class="tbl">
            <caption class="sr-only">Newsletter subscribers</caption>
            <thead>
                <tr>
                    <th scope="col">Email</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Confirmed</th>
                    <th scope="col">Subscribed</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $subscriber)
                    <tr wire:key="subscriber-{{ $subscriber->id }}">
                        <td class="min-w-0 break-all font-semibold">{{ $subscriber->email }}</td>
                        <td data-label="Name" class="text-dark-soft">{{ $subscriber->name ?? '—' }}</td>
                        <td data-label="Status">
                            @if($subscriber->status === 'active')
                                <span class="bd bd-done">Active</span>
                            @elseif($subscriber->status === 'unsubscribed')
                                <span class="bd bd-neutral">Unsubscribed</span>
                            @else
                                <span class="bd bd-warn">{{ $subscriber->status }}</span>
                            @endif
                        </td>
                        <td data-label="Confirmed">
                            @if($subscriber->confirmed)
                                <span class="text-emerald-400"><span aria-hidden="true">✓</span><span class="sr-only">Confirmed</span></span>
                            @else
                                <span class="bd bd-warn">Pending</span>
                            @endif
                        </td>
                        <td data-label="Subscribed" class="text-dark-muted">{{ $subscriber->subscribed_at?->format('j M Y') }}</td>
                        <td data-actions>
                            @if($subscriber->status !== 'unsubscribed')
                                <button type="button" wire:click="unsubscribe({{ $subscriber->id }})"
                                        wire:confirm="Unsubscribe this user?"
                                        class="btn-row btn-row-danger ml-auto">
                                    Remove
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="is-empty"><td colspan="6" class="!py-12 text-center text-dark-muted">No subscribers found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($subscribers->hasPages())
            <div class="border-t border-dark-line px-5 py-4">{{ $subscribers->links('pagination.site', ['noun' => 'subscribers']) }}</div>
        @endif
    </section>
</div>

<div class="flex flex-col gap-[22px]">

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">Sales</p>
            <h1 class="admin-h1">Contacts</h1>
        </div>
        <p class="text-sm text-dark-muted">{{ $total }} {{ Str::plural('enquiry', $total) }} · {{ $counts['new'] ?? 0 }} new</p>
    </header>

    {{-- Filters --}}
    <div class="flex flex-wrap items-center justify-between gap-3">
        <nav class="flex flex-wrap gap-1.5" aria-label="Status">
            <button type="button" wire:click="setStatus('')" class="chip" aria-pressed="{{ $status === '' ? 'true' : 'false' }}">All · {{ $total }}</button>
            @foreach(\App\Support\Enquiry::STATUSES as $value => [$label])
                <button type="button" wire:click="setStatus('{{ $value }}')" class="chip" aria-pressed="{{ $status === $value ? 'true' : 'false' }}">{{ $label }} · {{ $counts[$value] ?? 0 }}</button>
            @endforeach
        </nav>

        <div class="flex flex-wrap gap-2.5">
            <select wire:model.live="product" aria-label="Product" class="field-input !w-auto !py-[11px] !text-sm">
                <option value="">All products</option>
                @foreach($productLabels as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            <select wire:model.live="priority" aria-label="Priority" class="field-input !w-auto !py-[11px] !text-sm">
                <option value="">All priorities</option>
                @foreach(array_reverse(\App\Support\Enquiry::PRIORITIES, true) as $value => [$label])
                    <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>
            <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search name, email or company" aria-label="Search"
                   class="field-input !w-auto min-w-[240px] !py-[11px] !text-sm">
        </div>
    </div>

    <section class="panel">
        <table class="tbl">
            <caption class="sr-only">Contact form enquiries</caption>
            <thead>
                <tr>
                    <th scope="col">Client</th>
                    <th scope="col">Product and plan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Received</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $submission)
                    @php
                        $product = \App\Support\Enquiry::product($submission->project_type);
                        $plan = \App\Support\Enquiry::plan($submission);
                        [$statusLabel, $statusBadge] = \App\Support\Enquiry::STATUSES[$submission->status] ?? [ucfirst(str_replace('_', ' ', $submission->status)), 'bd-neutral'];
                        [$priorityLabel, $priorityBadge] = \App\Support\Enquiry::PRIORITIES[$submission->priority] ?? [ucfirst($submission->priority), 'bd-neutral'];
                    @endphp
                    <tr wire:key="contact-{{ $submission->id }}">
                        <td>
                            <span class="flex min-w-0 items-center gap-3">
                                <span class="avatar" aria-hidden="true">{{ strtoupper(mb_substr($submission->name, 0, 1)) }}</span>
                                <span class="min-w-0">
                                    <a href="{{ route('admin.contacts.show', $submission->id) }}" wire:navigate class="block truncate font-semibold text-dark-accent no-underline hover:underline">{{ $submission->name }}</a>
                                    <span class="sub truncate">{{ $submission->email }}</span>
                                </span>
                            </span>
                        </td>
                        <td data-label="Product and plan">
                            <span class="accent-{{ $product['accent'] }} inline-flex items-center gap-2"><span class="dot" aria-hidden="true"></span>{{ $product['name'] }}{{ $plan ? ' · '.$plan : '' }}</span>
                        </td>
                        <td data-label="Status"><span class="bd {{ $statusBadge }}">{{ $statusLabel }}</span></td>
                        <td data-label="Priority"><span class="bd {{ $priorityBadge }}">{{ $priorityLabel }}</span></td>
                        <td data-label="Received" class="text-dark-muted">{{ \App\Support\Enquiry::received($submission->created_at) }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.contacts.show', $submission->id) }}" wire:navigate class="admin-link font-semibold" aria-label="View {{ $submission->name }}">View</a>
                        </td>
                    </tr>
                @empty
                    <tr class="is-empty"><td colspan="6" class="!py-12 text-center text-dark-muted">No enquiries found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($submissions->hasPages())
            <div class="border-t border-dark-line px-5 py-4">{{ $submissions->links('pagination.site', ['noun' => 'enquiries']) }}</div>
        @endif
    </section>

    <p class="text-[13px] text-dark-muted">The product and plan come from the type and plan the Services buttons send to the contact form.</p>
</div>

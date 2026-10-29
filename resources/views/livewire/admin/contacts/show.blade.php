@php
    $whatsapp = \App\Support\Phone::whatsapp($submission->phone);
    $received = $submission->created_at;
@endphp

<div class="flex flex-col gap-[22px]">

    <a href="{{ route('admin.contacts.index') }}" wire:navigate class="admin-link self-start text-sm font-medium">← All contacts</a>

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div class="flex items-center gap-4">
            <span class="grid h-[52px] w-[52px] flex-none place-items-center rounded-full bg-brand-blue-soft text-xl font-bold text-brand-blue-link" aria-hidden="true">{{ strtoupper(mb_substr($submission->name, 0, 1)) }}</span>
            <div class="min-w-0">
                <h1 class="break-words text-[28px] font-bold leading-tight">{{ $submission->name }}</h1>
                <p class="mt-0.5 text-sm text-dark-muted">Received {{ $received->isToday() ? 'today' : $received->format('j M Y') }} at {{ $received->format('H:i') }} · reply within {{ $overdueHours }} hours</p>
            </div>
        </div>
        <div class="flex flex-wrap gap-2.5">
            @if($whatsapp)
                <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" class="btn btn-wa">Reply on WhatsApp</a>
            @endif
            <a href="mailto:{{ $submission->email }}" class="btn btn-ghost">Reply by email</a>
        </div>
    </header>

    <div class="flex flex-wrap items-start gap-5">

        {{-- Enquiry --}}
        <section class="panel flex-[1.6_1_480px]" aria-labelledby="enquiry-h">
            <div class="px-[22px] py-[18px]"><h2 id="enquiry-h" class="text-[18px] font-semibold">Enquiry</h2></div>
            <dl>
                <div class="grid grid-cols-[110px_1fr] gap-3 border-t border-dark-line px-[22px] py-3.5 text-[15px] sm:grid-cols-[140px_1fr]">
                    <dt class="text-dark-muted">Wants</dt>
                    <dd class="accent-{{ $product['accent'] }}"><span class="dot mr-1.5" aria-hidden="true"></span>{{ $product['name'] }}{{ $plan ? ' · '.$plan.' plan' : '' }}</dd>
                </div>
                <div class="grid grid-cols-[110px_1fr] gap-3 border-t border-dark-line px-[22px] py-3.5 text-[15px] sm:grid-cols-[140px_1fr]">
                    <dt class="text-dark-muted">Email</dt>
                    <dd class="min-w-0 break-all"><a href="mailto:{{ $submission->email }}" class="admin-link">{{ $submission->email }}</a></dd>
                </div>
                @if($submission->phone)
                    <div class="grid grid-cols-[110px_1fr] gap-3 border-t border-dark-line px-[22px] py-3.5 text-[15px] sm:grid-cols-[140px_1fr]">
                        <dt class="text-dark-muted">Phone</dt>
                        <dd>{{ $submission->phone }}</dd>
                    </div>
                @endif
                @if($submission->company)
                    <div class="grid grid-cols-[110px_1fr] gap-3 border-t border-dark-line px-[22px] py-3.5 text-[15px] sm:grid-cols-[140px_1fr]">
                        <dt class="text-dark-muted">Company</dt>
                        <dd>{{ $submission->company }}</dd>
                    </div>
                @endif
                @if($submission->budget_range)
                    <div class="grid grid-cols-[110px_1fr] gap-3 border-t border-dark-line px-[22px] py-3.5 text-[15px] sm:grid-cols-[140px_1fr]">
                        <dt class="text-dark-muted">Budget</dt>
                        <dd>{{ $budgets[$submission->budget_range] ?? $submission->budget_range }}</dd>
                    </div>
                @endif
            </dl>
            <div class="border-t border-dark-line px-[22px] py-4">
                <h3 class="mono-label mb-2">Message</h3>
                <p class="whitespace-pre-wrap text-[15.5px] leading-[1.65] text-[#E1E4EA]">{{ $submission->message }}</p>
            </div>
        </section>

        {{-- Follow-up --}}
        <section class="panel flex-[1_1_320px]" aria-labelledby="followup-h">
            <form wire:submit="update" class="flex flex-col gap-5 p-[22px]">
                <h2 id="followup-h" class="text-[18px] font-semibold">Follow-up</h2>

                <fieldset>
                    <legend class="mono-label pb-2.5">Status</legend>
                    <div class="seg">
                        @foreach($statuses as $value => [$label])
                            <label>
                                <input type="radio" wire:model="status" name="status" value="{{ $value }}" class="peer sr-only">
                                <span class="seg-chip">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('status') <p class="field-error mt-2">{{ $message }}</p> @enderror
                </fieldset>

                <fieldset>
                    <legend class="mono-label pb-2.5">Priority</legend>
                    <div class="seg">
                        @foreach($priorities as $value => [$label])
                            <label>
                                <input type="radio" wire:model="priority" name="priority" value="{{ $value }}" class="peer sr-only">
                                <span class="seg-chip">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('priority') <p class="field-error mt-2">{{ $message }}</p> @enderror
                </fieldset>

                <div class="field">
                    <label for="notes" class="mono-label">Internal notes</label>
                    <textarea id="notes" wire:model="notes" rows="5" placeholder="Only you can see this." class="field-input !min-h-[120px] !text-[15px]"
                              @error('notes') aria-invalid="true" aria-describedby="notes-error" @enderror></textarea>
                    @error('notes') <p id="notes-error" class="field-error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" wire:loading.attr="disabled" class="btn btn-brand disabled:opacity-50">
                    <span wire:loading.remove wire:target="update">Save changes</span>
                    <span wire:loading wire:target="update">Saving...</span>
                </button>
                <x-action-message on="saved">Saved.</x-action-message>

                <p class="text-[13px] text-dark-muted">Status and note changes are logged, so you can see who changed what and when.</p>
            </form>
        </section>
    </div>
</div>

@php
    $kind = $current?->kind;
    $isProduct = $kind === 'product';
@endphp

<div class="flex flex-col gap-[22px]"
     x-data="{ dirty: false }" @input="dirty = true" @saved.window="dirty = false"
     @beforeunload.window="if (dirty) { $event.preventDefault(); $event.returnValue = '' }">

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">Website</p>
            <h1 class="admin-h1">Services and pricing</h1>
            <p class="mt-1.5 text-sm text-dark-muted">Edit once. The homepage, the Services page, the portfolio cards and the contact form all update.</p>
        </div>
        @if($current)
            <div class="flex flex-wrap gap-2.5">
                <a href="{{ $preview }}" target="_blank" rel="noopener" class="btn btn-ghost btn-sm">Preview on site ↗&#xFE0E;</a>
                <button type="submit" form="service-form" wire:loading.attr="disabled" wire:target="saveService" class="btn btn-brand btn-sm disabled:opacity-50">Save changes</button>
            </div>
        @endif
    </header>

    @if($notice)
        <div role="{{ $noticeType === 'error' ? 'alert' : 'status' }}" class="flash flash-{{ $noticeType }}">
            <span>{{ $notice }}</span>
            <button type="button" wire:click="$set('notice', null)" aria-label="Dismiss message">✕</button>
        </div>
    @endif

    <div class="flex flex-col items-start gap-5 lg:flex-row">

        {{-- Service list --}}
        <nav class="panel flex w-full flex-none flex-col gap-0.5 p-2.5 lg:w-[250px]" aria-label="Services">
            <p class="mono-label mx-3 mb-1.5 mt-2">Products</p>
            @foreach($products as $item)
                <button type="button" wire:click="select('{{ $item->slug }}')" wire:key="svc-{{ $item->id }}"
                        @if($item->slug === $service) aria-current="true" @endif class="sb-link w-full text-left">
                    <span class="dot accent-{{ $item->accent }}" aria-hidden="true"></span>
                    <span class="min-w-0 flex-1 truncate">{{ $item->name }}</span>
                    @unless($item->is_visible)<span class="bd bd-neutral !px-1.5 !py-0.5 !text-[9px]">Hidden</span>@endunless
                    <span class="text-xs text-dark-muted"><span class="sr-only">Plans: </span>{{ $item->plans_count }}</span>
                </button>
            @endforeach

            <p class="mono-label mx-3 mb-1.5 mt-3.5">Services</p>
            @foreach($others as $item)
                <button type="button" wire:click="select('{{ $item->slug }}')" wire:key="svc-{{ $item->id }}"
                        @if($item->slug === $service) aria-current="true" @endif class="sb-link w-full text-left">
                    <span class="dot accent-{{ $item->accent }}" aria-hidden="true"></span>
                    <span class="min-w-0 flex-1 truncate">{{ $item->name }}</span>
                    <span class="text-xs text-dark-muted"><span class="sr-only">Plans: </span>{{ $item->plans_count }}</span>
                </button>
            @endforeach

            @if($adding)
                <form wire:submit="addService" class="mt-2 flex flex-col gap-2 rounded-[10px] border border-dashed border-dark-line p-3">
                    <label for="new-name" class="mono-label">Service name</label>
                    <input id="new-name" type="text" wire:model="newName" maxlength="80" autofocus class="field-input !py-2.5 !text-sm"
                           @error('newName') aria-invalid="true" aria-describedby="new-name-error" @enderror>
                    @error('newName') <p id="new-name-error" class="field-error">{{ $message }}</p> @enderror
                    <div class="flex gap-2">
                        <button type="submit" class="btn-row btn-row-brand">Create</button>
                        <button type="button" wire:click="$set('adding', false)" class="btn-row">Cancel</button>
                    </div>
                </form>
            @else
                <button type="button" wire:click="startAdding" class="sb-link mt-2 w-full justify-center border border-dashed border-dark-line !text-brand-blue-link">+ Add a service</button>
            @endif
        </nav>

        @if($current)
            <div class="flex min-w-0 w-full flex-1 flex-col gap-5">

                {{-- Service details --}}
                <section class="panel p-6" aria-labelledby="details-h">
                    <form id="service-form" wire:submit="saveService" class="flex flex-col gap-[18px]">
                        <div class="flex flex-wrap items-center justify-between gap-3">
                            <h2 id="details-h" class="text-xl font-semibold">{{ $current->name }}</h2>
                            @if($isProduct)
                                <label class="flex cursor-pointer items-center gap-2.5 text-sm text-dark-soft">
                                    Visible on the site
                                    <input type="checkbox" role="switch" wire:model="form.is_visible" class="switch">
                                </label>
                            @else
                                <span class="text-sm text-dark-muted">Always shown: this section is part of the Services page.</span>
                            @endif
                        </div>

                        <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                            <div class="field content-start">
                                <label for="f-name">Name</label>
                                <input id="f-name" type="text" wire:model="form.name" maxlength="80" class="field-input" @error('form.name') aria-invalid="true" aria-describedby="f-name-error" @enderror>
                                @error('form.name') <p id="f-name-error" class="field-error">{{ $message }}</p> @enderror
                            </div>

                            @if(in_array($kind, ['product', 'custom']))
                                <div class="field content-start">
                                    <label for="f-label">Short label</label>
                                    <input id="f-label" type="text" wire:model="form.label" maxlength="80" class="field-input" @error('form.label') aria-invalid="true" aria-describedby="f-label-error" @enderror>
                                    @error('form.label') <p id="f-label-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            @if($isProduct)
                                <div class="field content-start">
                                    <label for="f-type">Contact form type</label>
                                    <select id="f-type" wire:model="form.project_type" class="field-input" @error('form.project_type') aria-invalid="true" aria-describedby="f-type-error" @enderror>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.project_type') <p id="f-type-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            @if(in_array($kind, ['product', 'custom']))
                                <div class="field content-start">
                                    <label for="f-accent">Accent colour</label>
                                    <select id="f-accent" wire:model="form.accent" class="field-input" @error('form.accent') aria-invalid="true" aria-describedby="f-accent-error" @enderror>
                                        @foreach($accents as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.accent') <p id="f-accent-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            @if($isProduct)
                                <div class="field content-start">
                                    <label for="f-demo-url">Demo link</label>
                                    <input id="f-demo-url" type="url" wire:model="form.demo_url" placeholder="https://" class="field-input" @error('form.demo_url') aria-invalid="true" aria-describedby="f-demo-url-error" @enderror>
                                    @error('form.demo_url') <p id="f-demo-url-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field content-start">
                                    <label for="f-demo-label">Demo link text</label>
                                    <input id="f-demo-label" type="text" wire:model="form.demo_label" maxlength="80" class="field-input">
                                </div>
                                <div class="field content-start">
                                    <label for="f-site-url">Product website</label>
                                    <input id="f-site-url" type="url" wire:model="form.site_url" placeholder="https://" class="field-input" @error('form.site_url') aria-invalid="true" aria-describedby="f-site-url-error" @enderror>
                                    @error('form.site_url') <p id="f-site-url-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            @if(in_array($kind, ['product', 'custom']))
                                <div class="field content-start">
                                    <label for="f-price">Headline price (cards)</label>
                                    <input id="f-price" type="text" wire:model="form.headline_price" maxlength="40" aria-describedby="f-price-hint" class="field-input" @error('form.headline_price') aria-invalid="true" @enderror>
                                    <span id="f-price-hint" class="field-hint">Shown as "From …". Not linked to the plan prices.</span>
                                    @error('form.headline_price') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field content-start">
                                    <label for="f-unit">Text after the headline price</label>
                                    <input id="f-unit" type="text" wire:model="form.headline_unit" maxlength="60" class="field-input">
                                </div>
                            @endif
                        </div>

                        @if($isProduct)
                            <div class="field">
                                <label for="f-blurb">One line for the portfolio card</label>
                                <input id="f-blurb" type="text" wire:model="form.blurb" class="field-input" @error('form.blurb') aria-invalid="true" aria-describedby="f-blurb-error" @enderror>
                                @error('form.blurb') <p id="f-blurb-error" class="field-error">{{ $message }}</p> @enderror
                            </div>
                        @endif

                        @if(in_array($kind, ['product', 'custom']))
                            <div class="field">
                                <label for="f-description">Description</label>
                                <textarea id="f-description" wire:model="form.description" class="field-input !min-h-[84px]" @error('form.description') aria-invalid="true" aria-describedby="f-description-error" @enderror></textarea>
                                @error('form.description') <p id="f-description-error" class="field-error">{{ $message }}</p> @enderror
                            </div>
                        @endif

                        @if($isProduct)
                            <div class="field">
                                <label for="f-features">What the product does (one per line)</label>
                                <textarea id="f-features" wire:model="form.features" rows="5" class="field-input" @error('form.features') aria-invalid="true" aria-describedby="f-features-error" @enderror></textarea>
                                @error('form.features') <p id="f-features-error" class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                                <div class="field content-start">
                                    <label for="f-for">For</label>
                                    <input id="f-for" type="text" wire:model="form.for" class="field-input" placeholder="cafés, restaurants, clinics.">
                                </div>
                                <div class="field content-start">
                                    <label for="f-for-extra">After "For"</label>
                                    <input id="f-for-extra" type="text" wire:model="form.for_extra" class="field-input">
                                    <label class="flex cursor-pointer items-center gap-2 text-[13px] font-normal text-dark-muted"><input type="checkbox" wire:model="form.for_extra_strong" class="h-4 w-4 rounded border-dark-line bg-dark-primary text-brand-blue-light focus:ring-brand-blue-light"> Show in bold on the home page</label>
                                </div>
                            </div>
                            <div class="field">
                                <label for="f-note">Plan note under the cards (home page)</label>
                                <textarea id="f-note" wire:model="form.note" class="field-input !min-h-[70px]" @error('form.note') aria-invalid="true" aria-describedby="f-note-error" @enderror></textarea>
                                @error('form.note') <p id="f-note-error" class="field-error">{{ $message }}</p> @enderror
                            </div>
                            <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                                <div class="field content-start">
                                    <label for="f-note-strong">Services page note, bold start</label>
                                    <input id="f-note-strong" type="text" wire:model="form.service_note_strong" class="field-input">
                                </div>
                                <div class="field content-start">
                                    <label for="f-note-text">Services page note, rest</label>
                                    <input id="f-note-text" type="text" wire:model="form.service_note_text" class="field-input">
                                </div>
                            </div>
                            <div class="field max-w-[360px]">
                                <label for="f-slug">URL slug</label>
                                <input id="f-slug" type="text" wire:model="form.slug" maxlength="60" aria-describedby="f-slug-hint" class="field-input font-mono !text-sm" @error('form.slug') aria-invalid="true" @enderror>
                                <span id="f-slug-hint" class="field-hint">Letters, numbers and hyphens. Used in the editor link.</span>
                                @error('form.slug') <p class="field-error">{{ $message }}</p> @enderror
                            </div>
                        @endif

                        @if($kind === 'custom')
                            <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                                <div class="field content-start">
                                    <label for="f-headline">Home card heading</label>
                                    <input id="f-headline" type="text" wire:model="form.headline" class="field-input">
                                </div>
                                <div class="field content-start">
                                    <label for="f-cta">Home card button</label>
                                    <input id="f-cta" type="text" wire:model="form.cta" maxlength="80" class="field-input">
                                </div>
                            </div>
                            <div class="field">
                                <label for="f-stack">Stack lines on the home card (one per line)</label>
                                <textarea id="f-stack" wire:model="form.stack" rows="5" class="field-input"></textarea>
                            </div>
                        @endif

                        @if(in_array($kind, ['custom', 'hosting', 'maintenance']))
                            <div class="field">
                                <label for="f-heading">Services page heading</label>
                                <input id="f-heading" type="text" wire:model="form.heading" class="field-input">
                            </div>
                            <div class="field">
                                <label for="f-intro">Services page intro</label>
                                <textarea id="f-intro" wire:model="form.intro" class="field-input !min-h-[84px]" @error('form.intro') aria-invalid="true" aria-describedby="f-intro-error" @enderror></textarea>
                                @error('form.intro') <p id="f-intro-error" class="field-error">{{ $message }}</p> @enderror
                            </div>
                        @endif

                        @if($kind === 'custom')
                            <div class="field">
                                <label for="f-points">Points beside the intro (one per line)</label>
                                <textarea id="f-points" wire:model="form.points" rows="4" class="field-input"></textarea>
                            </div>
                        @endif

                        @if($kind === 'maintenance')
                            <div class="field max-w-[240px]">
                                <label for="f-months">Minimum months</label>
                                <input id="f-months" type="number" min="0" max="60" wire:model="form.minimum_months" class="field-input" @error('form.minimum_months') aria-invalid="true" aria-describedby="f-months-error" @enderror>
                                @error('form.minimum_months') <p id="f-months-error" class="field-error">{{ $message }}</p> @enderror
                            </div>
                        @endif

                        @if($isProduct)
                            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-dark-line pt-4">
                                <button type="button" wire:click="deleteService" wire:confirm="Delete {{ $current->name }} and all its plans? This cannot be undone. To keep the data, switch off Visible on the site instead."
                                        class="btn-row btn-row-danger">Delete service</button>
                                <span class="text-[13px] text-dark-muted">Saving clears the site cache. Changes are live straight away.</span>
                            </div>
                        @endif
                    </form>
                </section>

                {{-- Plans --}}
                <section class="panel" aria-labelledby="plans-h">
                    <div class="panel-head">
                        <h2 id="plans-h">{{ $kind === 'hosting' ? 'Tiers' : 'Plans' }}</h2>
                        <button type="button" wire:click="addPlan" @disabled($current->plans->count() >= $maxPlans) class="btn-row">+ Add {{ $kind === 'hosting' ? 'tier' : 'plan' }}</button>
                    </div>
                    <table class="tbl">
                        <caption class="sr-only">Plans of {{ $current->name }}</caption>
                        <thead>
                            <tr>
                                <th scope="col">Order</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Billing</th>
                                <th scope="col">Popular</th>
                                <th scope="col"><span class="sr-only">Actions</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($current->plans as $item)
                                <tr wire:key="plan-{{ $item->id }}" @class(['bg-brand-blue-soft hover:!bg-brand-blue-soft' => $planOpen && $planId === $item->id])>
                                    <td data-label="Order">
                                        <span class="flex gap-1.5">
                                            <button type="button" wire:click="movePlan({{ $item->id }}, -1)" @disabled($loop->first) aria-label="Move {{ $item->name }} up" class="btn-row !px-2.5">↑</button>
                                            <button type="button" wire:click="movePlan({{ $item->id }}, 1)" @disabled($loop->last) aria-label="Move {{ $item->name }} down" class="btn-row !px-2.5">↓</button>
                                        </span>
                                    </td>
                                    <td><b class="font-semibold">{{ $item->name }}</b></td>
                                    <td data-label="Price">{{ $item->price }}</td>
                                    <td data-label="Billing" class="text-dark-muted">{{ $item->billing ?: $item->period }}</td>
                                    <td data-label="Popular">@if($item->is_featured)<span class="font-semibold text-brand-blue-light"><span aria-hidden="true">★</span><span class="sr-only">Most popular</span></span>@endif</td>
                                    <td data-actions>
                                        <div class="flex flex-wrap justify-end gap-2">
                                            <button type="button" wire:click="editPlan({{ $item->id }})" aria-label="Edit {{ $item->name }}" class="btn-row {{ $planOpen && $planId === $item->id ? 'btn-row-brand' : '' }}">{{ $planOpen && $planId === $item->id ? 'Editing' : 'Edit' }}</button>
                                            <button type="button" wire:click="deletePlan({{ $item->id }})" wire:confirm="Delete the plan {{ $item->name }}?" aria-label="Delete {{ $item->name }}" class="btn-row btn-row-danger">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="is-empty"><td colspan="6" class="!py-10 text-center text-dark-muted">No plans yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>

                {{-- Plan editor --}}
                @if($planOpen)
                    <section class="panel border-brand-blue-light p-6" aria-labelledby="plan-h">
                        <form wire:submit="savePlan" class="flex flex-col gap-[18px]">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <h2 id="plan-h" class="text-lg font-semibold">{{ $planId ? 'Editing plan: ' . ($plan['name'] ?: '…') : 'New plan' }}</h2>
                                @if($kind !== 'hosting')
                                    <label class="flex cursor-pointer items-center gap-2.5 text-sm text-dark-soft">
                                        Most popular
                                        <input type="checkbox" role="switch" wire:model="plan.is_featured" class="switch">
                                    </label>
                                @endif
                            </div>

                            <div class="grid grid-cols-[repeat(auto-fit,minmax(200px,1fr))] gap-4">
                                <div class="field content-start">
                                    <label for="p-name">Plan name</label>
                                    <input id="p-name" type="text" wire:model="plan.name" maxlength="80" class="field-input" @error('plan.name') aria-invalid="true" aria-describedby="p-name-error" @enderror>
                                    @error('plan.name') <p id="p-name-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                                <div class="field content-start">
                                    <label for="p-price">Price shown</label>
                                    <input id="p-price" type="text" wire:model="plan.price" maxlength="40" aria-describedby="p-price-hint" class="field-input" @error('plan.price') aria-invalid="true" @enderror>
                                    <span id="p-price-hint" class="field-hint">Printed as written: $349, From $800, Contact us</span>
                                    @error('plan.price') <p class="field-error">{{ $message }}</p> @enderror
                                </div>
                                @if($kind === 'hosting')
                                    <div class="field content-start">
                                        <label for="p-period">Period after the price</label>
                                        <input id="p-period" type="text" wire:model="plan.period" maxlength="60" class="field-input">
                                    </div>
                                @else
                                    <div class="field content-start">
                                        <label for="p-billing">Billing text</label>
                                        <input id="p-billing" type="text" wire:model="plan.billing" maxlength="120" class="field-input">
                                    </div>
                                    <div class="field content-start">
                                        <label for="p-cta">Button label</label>
                                        <input id="p-cta" type="text" wire:model="plan.cta" maxlength="80" class="field-input" @error('plan.cta') aria-invalid="true" aria-describedby="p-cta-error" @enderror>
                                        @error('plan.cta') <p id="p-cta-error" class="field-error">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="field content-start">
                                        <label for="p-unit">Suffix on the home card</label>
                                        <input id="p-unit" type="text" wire:model="plan.unit" maxlength="60" placeholder="/mo" class="field-input">
                                    </div>
                                    <div class="field content-start">
                                        <label for="p-period">Suffix on the Services card</label>
                                        <input id="p-period" type="text" wire:model="plan.period" maxlength="60" placeholder=" / month" class="field-input">
                                    </div>
                                @endif
                            </div>

                            @if($kind !== 'hosting')
                                <div class="field">
                                    <label for="p-summary">One-line summary</label>
                                    <input id="p-summary" type="text" wire:model="plan.summary" class="field-input" @error('plan.summary') aria-invalid="true" aria-describedby="p-summary-error" @enderror>
                                    @error('plan.summary') <p id="p-summary-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            @if($isProduct)
                                <div class="field">
                                    <label for="p-description">Line on the home card</label>
                                    <textarea id="p-description" wire:model="plan.description" class="field-input !min-h-[70px]" @error('plan.description') aria-invalid="true" aria-describedby="p-description-error" @enderror></textarea>
                                    <span class="field-hint">Left empty, the summary is used.</span>
                                    @error('plan.description') <p id="p-description-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            <fieldset class="flex flex-col gap-2.5">
                                <legend class="mono-label pb-1">Features</legend>
                                @foreach($plan['features'] as $i => $feature)
                                    <div class="flex items-center gap-2" wire:key="feature-{{ $planId ?? 'new' }}-{{ $i }}">
                                        <span class="flex flex-none gap-1">
                                            <button type="button" wire:click="moveFeature({{ $i }}, -1)" @disabled($i === 0) aria-label="Move feature {{ $i + 1 }} up" class="btn-row !px-2.5">↑</button>
                                            <button type="button" wire:click="moveFeature({{ $i }}, 1)" @disabled($i === count($plan['features']) - 1) aria-label="Move feature {{ $i + 1 }} down" class="btn-row !px-2.5">↓</button>
                                        </span>
                                        <input type="text" wire:model="plan.features.{{ $i }}" maxlength="200" aria-label="Feature {{ $i + 1 }}" class="field-input !py-2.5 !text-sm" @error("plan.features.$i") aria-invalid="true" @enderror>
                                        <button type="button" wire:click="removeFeature({{ $i }})" aria-label="Remove feature {{ $i + 1 }}" class="btn-row btn-row-danger flex-none">✕</button>
                                    </div>
                                    @error("plan.features.$i") <p class="field-error">{{ $message }}</p> @enderror
                                @endforeach
                                @error('plan.features') <p class="field-error">{{ $message }}</p> @enderror
                                <button type="button" wire:click="addFeature" @disabled(count($plan['features']) >= $maxFeatures) class="btn-row self-start !text-brand-blue-link">+ Add feature</button>
                            </fieldset>

                            @if($kind !== 'hosting')
                                <div class="field">
                                    <label for="p-meta">Timing and support line</label>
                                    <input id="p-meta" type="text" wire:model="plan.meta" maxlength="200" class="field-input" @error('plan.meta') aria-invalid="true" aria-describedby="p-meta-error" @enderror>
                                    @error('plan.meta') <p id="p-meta-error" class="field-error">{{ $message }}</p> @enderror
                                </div>
                            @endif

                            <div class="flex flex-wrap items-center justify-between gap-3 border-t border-dark-line pt-4">
                                <div class="flex gap-2">
                                    <button type="submit" wire:loading.attr="disabled" wire:target="savePlan" class="btn btn-brand btn-sm disabled:opacity-50">Save plan</button>
                                    <button type="button" wire:click="closePlan" class="btn btn-ghost btn-sm">Close</button>
                                    @if($planId)
                                        <button type="button" wire:click="deletePlan({{ $planId }})" wire:confirm="Delete the plan {{ $plan['name'] }}?" class="btn-row btn-row-danger !py-3">Delete plan</button>
                                    @endif
                                </div>
                                <span class="text-[13px] text-dark-muted">Saving clears the site cache. Changes are live straight away.</span>
                            </div>
                        </form>
                    </section>
                @endif
            </div>
        @else
            <p class="panel w-full p-8 text-center text-dark-muted">No services yet. Run <code class="font-mono text-dark-accent">php artisan db:seed --class=CatalogSeeder</code>, or add one.</p>
        @endif
    </div>
</div>

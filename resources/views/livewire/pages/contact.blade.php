@php
  $budgets = [
      'under_1k' => 'Under $1,000',
      '1k_2.5k' => '$1,000 - $2,500',
      '2.5k_5k' => '$2,500 - $5,000',
      '5k_plus' => '$5,000+',
  ];
@endphp
<div class="leading-[1.6]">
  <x-page-hero eyebrow="Contact" title="Tell us about your project."
    lead="We reply within 24 hours, usually much faster. WhatsApp is quickest." />

  <section class="wrap py-[72px]">
    <div class="grid items-start gap-8 min-[901px]:grid-cols-[1.2fr_1fr] min-[901px]:gap-14">
      <div>
        @if (session()->has('success'))
          <div role="status" class="mb-4 rounded-[10px] border border-emerald-400/50 bg-emerald-400/10 px-4 py-3 text-emerald-300">
            {{ session('success') }}
          </div>
        @endif

        @error('form')
          <div role="alert" class="mb-4 rounded-[10px] border border-red-400/50 bg-red-400/10 px-4 py-3 text-red-300">
            {{ $message }}
          </div>
        @enderror

        <form wire:submit.prevent="submit" class="form-card" novalidate aria-label="Project enquiry">
          <div class="form-row">
            <div class="field">
              <label for="name">Full name *</label>
              <input id="name" type="text" wire:model.blur="name" autocomplete="name" required class="field-input"
                @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
              @error('name') <p id="name-error" class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="field">
              <label for="email">Email *</label>
              <input id="email" type="email" wire:model.blur="email" autocomplete="email" required class="field-input"
                @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
              @error('email') <p id="email-error" class="field-error">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label for="phone">Phone</label>
              <span id="phone-hint" class="field-hint">Optional</span>
              <input id="phone" type="tel" wire:model="phone" autocomplete="tel" class="field-input"
                aria-describedby="phone-hint @error('phone') phone-error @enderror" @error('phone') aria-invalid="true" @enderror>
              @error('phone') <p id="phone-error" class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="field">
              <label for="company">Company</label>
              <span id="company-hint" class="field-hint">Optional</span>
              <input id="company" type="text" wire:model="company" autocomplete="organization" class="field-input"
                aria-describedby="company-hint @error('company') company-error @enderror" @error('company') aria-invalid="true" @enderror>
              @error('company') <p id="company-error" class="field-error">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="form-row">
            <div class="field">
              <label for="project_type">What do you need? *</label>
              <select id="project_type" wire:model="project_type" required class="field-input"
                @error('project_type') aria-invalid="true" aria-describedby="project_type-error" @enderror>
                @foreach ($types as $type)
                  <option value="{{ $type }}">{{ $typeLabels[$type] ?? \Illuminate\Support\Str::headline($type) }}</option>
                @endforeach
              </select>
              @error('project_type') <p id="project_type-error" class="field-error">{{ $message }}</p> @enderror
            </div>
            <div class="field">
              <label for="budget_range">Budget</label>
              <span id="budget_range-hint" class="field-hint">Optional</span>
              <select id="budget_range" wire:model="budget_range" class="field-input"
                aria-describedby="budget_range-hint @error('budget_range') budget_range-error @enderror" @error('budget_range') aria-invalid="true" @enderror>
                <option value="">Select a range</option>
                @foreach ($budgets as $value => $label)
                  <option value="{{ $value }}">{{ $label }}</option>
                @endforeach
              </select>
              @error('budget_range') <p id="budget_range-error" class="field-error">{{ $message }}</p> @enderror
            </div>
          </div>

          <div class="field">
            <label for="message">Project details *</label>
            <textarea id="message" wire:model.blur="message" required class="field-input"
              placeholder="What you sell, what you need, and when you need it."
              @error('message') aria-invalid="true" aria-describedby="message-error" @enderror></textarea>
            @error('message') <p id="message-error" class="field-error">{{ $message }}</p> @enderror
          </div>

          <button type="submit" class="btn btn-brand disabled:cursor-wait disabled:opacity-60" wire:loading.attr="disabled" wire:target="submit">
            <span wire:loading.remove wire:target="submit">Send message</span>
            <span wire:loading wire:target="submit">Sending...</span>
          </button>
        </form>
      </div>

      <div class="grid gap-3">
        <a class="btn btn-wa btn-lg" href="https://wa.me/9613876822" target="_blank" rel="noopener">Chat on WhatsApp<span class="sr-only"> (opens in a new tab)</span></a>
        <div class="info-list">
          <div><span>Phone</span><b><a href="tel:+9613876822" class="underline decoration-dark-muted decoration-dotted underline-offset-4">+961 3 876 822</a></b></div>
          <div><span>Email</span><b><a href="mailto:{{ config('app.email') }}" class="underline decoration-dark-muted decoration-dotted underline-offset-4">{{ config('app.email') }}</a></b></div>
          <div><span>Location</span><b>Beirut, Lebanon</b></div>
          <div><span>Reply time</span><b>Within 24 hours</b></div>
          <div><span>Hours</span><b>Mon to Fri, 9:00 to 17:00</b></div>
        </div>
      </div>
    </div>
  </section>

  <section id="faq" class="wrap py-[72px]">
    <x-section-head eyebrow="Questions" title="Before you send." />
    <x-faq :items="$faqs" />
  </section>
</div>

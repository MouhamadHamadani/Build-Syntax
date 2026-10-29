@props([
    'title' => 'Tell us what you sell. We will tell you what fits.',
    'text' => 'Message us on WhatsApp for the quickest answer, or send an email.',
])

{{-- Closing contact block: WhatsApp button plus phone and email with Copy buttons. --}}
<div {{ $attributes->class(['contact-card']) }}>
  <div>
    <h2 class="heading text-[clamp(28px,4vw,42px)] font-extrabold">{{ $title }}</h2>
    <p class="mt-3.5 max-w-[46ch] opacity-85">{{ $text }}</p>
  </div>
  <div class="grid gap-2.5">
    <a class="btn btn-wa btn-lg" href="https://wa.me/9613876822" target="_blank" rel="noopener">Chat on WhatsApp</a>
    <div class="copy-row" x-data="copyButton('+961 3 876 822')">
      <span>+961 3 876 822</span>
      <button type="button" @click="copy()" x-text="label">Copy</button>
    </div>
    <div class="copy-row" x-data="copyButton('info@build-syntax.com')">
      <span>info@build-syntax.com</span>
      <button type="button" @click="copy()" x-text="label">Copy</button>
    </div>
  </div>
</div>

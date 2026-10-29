@props(['items'])

{{-- Questions and answers as <details>; the first one starts open. $items: [['q' => ..., 'a' => ...], ...] --}}
<div {{ $attributes->class(['max-w-[780px]']) }}>
  @foreach ($items as $item)
    <details class="faq-item" @if ($loop->first) open @endif>
      <summary>{{ $item['q'] }}</summary>
      <p>{{ $item['a'] }}</p>
    </details>
  @endforeach
</div>

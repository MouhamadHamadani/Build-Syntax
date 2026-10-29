{{-- The three-step process, shared by the home and About pages. The heading stays with the page. --}}
@php
  $steps = [
      ['title' => 'Consultation', 'text' => 'We learn how your business runs and what you need the system to do.', 'points' => ['Free 30-minute call', 'Requirements review', 'Written scope and price']],
      ['title' => 'Development', 'text' => 'We build it and show you progress as it comes together, so nothing is a surprise.', 'points' => ['Regular progress updates', 'Testing before handover', 'Your feedback built in']],
      ['title' => 'Launch and support', 'text' => 'We put it live, show your team how to use it, and stay reachable afterwards.', 'points' => ['Deployment and testing', 'Training and documentation', 'Ongoing support']],
  ];
@endphp
<div {{ $attributes->class(['grid gap-7 min-[801px]:grid-cols-3 min-[801px]:gap-0']) }}>
  @foreach ($steps as $step)
    <div class="step">
      <p class="font-mono text-[12px] font-medium uppercase leading-[normal] tracking-[.1em] text-brand-blue-light">Step {{ $loop->iteration }}</p>
      <h3 class="heading my-2.5 text-[22px] font-bold">{{ $step['title'] }}</h3>
      <p class="text-[15px] text-dark-muted">{{ $step['text'] }}</p>
      <ul class="arrows mt-3.5 grid list-none gap-1.5 p-0 text-[14px]">
        @foreach ($step['points'] as $point)
          <li>{{ $point }}</li>
        @endforeach
      </ul>
    </div>
  @endforeach
</div>

@if ($errors->any())
    <div role="alert" {{ $attributes->merge(['class' => 'rounded-[10px] border border-[#5A2A2A] bg-[#3A1A1F] px-4 py-3 text-sm text-[#FECACA]']) }}>
        <div class="font-medium">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-2 list-inside list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-dark-accent']) }}>
    {{ $value ?? $slot }}
</label>

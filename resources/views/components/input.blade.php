@props(['disabled' => false])

@php
    // Error key: the field name, or its id for Livewire inputs that only carry wire:model.
    $key = $attributes->get('name') ?? $attributes->get('id');
    $invalid = $key && $errors->has($key);
@endphp

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'field-input disabled:opacity-60'])->merge($invalid ? ['aria-invalid' => 'true', 'aria-describedby' => $key.'-error'] : []) !!}>

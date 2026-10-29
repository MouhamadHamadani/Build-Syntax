@props(['for'])

@error($for)
    <p {{ $attributes->merge(['id' => $for.'-error', 'class' => 'field-error']) }}>{{ $message }}</p>
@enderror

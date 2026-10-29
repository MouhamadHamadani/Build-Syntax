<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-brand disabled:opacity-50']) }}>
    {{ $slot }}
</button>

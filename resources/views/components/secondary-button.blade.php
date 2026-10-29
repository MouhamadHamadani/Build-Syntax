<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-ghost disabled:opacity-50']) }}>
    {{ $slot }}
</button>

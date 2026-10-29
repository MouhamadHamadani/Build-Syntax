<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn bg-red-700 text-white hover:bg-red-600 disabled:opacity-50']) }}>
    {{ $slot }}
</button>

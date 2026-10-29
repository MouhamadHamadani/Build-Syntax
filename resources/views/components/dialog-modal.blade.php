@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-5">
        <div class="text-lg font-semibold text-dark-accent">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-dark-muted">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end gap-3 border-t border-dark-line bg-dark-sidebar px-6 py-4 text-end">
        {{ $footer }}
    </div>
</x-modal>

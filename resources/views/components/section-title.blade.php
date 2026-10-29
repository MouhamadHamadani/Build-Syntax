<div class="flex justify-between md:col-span-1">
    <div class="sm:px-0">
        <h2 class="text-lg font-semibold text-dark-accent">{{ $title }}</h2>

        <p class="mt-1 text-sm text-dark-muted">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>

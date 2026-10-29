<div class="flex flex-col gap-[22px]">

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">Website</p>
            <h1 class="admin-h1">Portfolio</h1>
        </div>
        <a href="{{ route('admin.portfolio.create') }}" wire:navigate class="btn btn-brand btn-sm">New project</a>
    </header>

    <div>
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search projects" aria-label="Search projects"
               class="field-input !w-auto min-w-[240px] !py-[11px] !text-sm">
    </div>

    <section class="panel">
        <table class="tbl">
            <caption class="sr-only">Client projects</caption>
            <thead>
                <tr>
                    <th scope="col">Project</th>
                    <th scope="col">Category</th>
                    <th scope="col">Featured</th>
                    <th scope="col">Created</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr wire:key="project-{{ $project->id }}">
                        <td class="min-w-0">
                            <b class="block font-semibold">{{ $project->title }}</b>
                            <span class="sub max-w-md truncate">{{ $project->description }}</span>
                        </td>
                        <td data-label="Category"><span class="bd bd-neutral">{{ $categories[$project->category] ?? $project->category }}</span></td>
                        <td data-label="Featured">
                            <button type="button" wire:click="toggleFeatured({{ $project->id }})"
                                    aria-pressed="{{ $project->featured ? 'true' : 'false' }}"
                                    aria-label="Featured: {{ $project->title }}"
                                    class="rounded-md p-1 text-xl leading-none transition-transform hover:scale-110 {{ $project->featured ? 'text-saffron' : 'text-dark-muted' }}">
                                <span aria-hidden="true">{{ $project->featured ? '★' : '☆' }}</span>
                            </button>
                        </td>
                        <td data-label="Created" class="text-dark-muted">{{ $project->created_at->format('j M') }}</td>
                        <td data-actions>
                            <div class="flex flex-wrap justify-end gap-2">
                                <a href="{{ route('admin.portfolio.edit', $project->id) }}" wire:navigate class="btn-row">Edit</a>
                                <button type="button" wire:click="delete({{ $project->id }})"
                                        wire:confirm="Delete this project?"
                                        class="btn-row btn-row-danger">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="is-empty"><td colspan="5" class="!py-12 text-center text-dark-muted">No projects found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($projects->hasPages())
            <div class="border-t border-dark-line px-5 py-4">{{ $projects->links('pagination.site', ['noun' => 'projects']) }}</div>
        @endif
    </section>
</div>

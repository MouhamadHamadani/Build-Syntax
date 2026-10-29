<div class="flex flex-col gap-[22px]">

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">Website</p>
            <h1 class="admin-h1">Blog posts</h1>
            <p class="mt-1.5 text-sm text-dark-muted">The blog link is hidden in the site menu until you publish your first post.</p>
        </div>
        <a href="{{ route('admin.blog.create') }}" wire:navigate class="btn btn-brand btn-sm">New post</a>
    </header>

    <div class="flex flex-wrap items-center justify-between gap-3">
        <nav class="flex flex-wrap gap-1.5" aria-label="Filter">
            <button type="button" wire:click="$set('filter', 'all')" class="chip" aria-pressed="{{ $filter === 'all' ? 'true' : 'false' }}">All · {{ $counts['all'] }}</button>
            <button type="button" wire:click="$set('filter', 'published')" class="chip" aria-pressed="{{ $filter === 'published' ? 'true' : 'false' }}">Published · {{ $counts['published'] }}</button>
            <button type="button" wire:click="$set('filter', 'draft')" class="chip" aria-pressed="{{ $filter === 'draft' ? 'true' : 'false' }}">Drafts · {{ $counts['draft'] }}</button>
        </nav>
        <input wire:model.live.debounce.300ms="search" type="search" placeholder="Search posts" aria-label="Search posts"
               class="field-input !w-auto min-w-[240px] !py-[11px] !text-sm">
    </div>

    <section class="panel">
        <table class="tbl">
            <caption class="sr-only">Blog posts</caption>
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Views</th>
                    <th scope="col">Created</th>
                    <th scope="col"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr wire:key="post-{{ $post->id }}">
                        <td class="min-w-0">
                            <b class="block font-semibold">{{ $post->title }}</b>
                            <span class="sub break-all">/blog/{{ $post->slug }}</span>
                        </td>
                        <td data-label="Status">
                            @if($post->published)
                                <span class="bd bd-done">Published</span>
                            @else
                                <span class="bd bd-warn">Draft</span>
                            @endif
                        </td>
                        <td data-label="Views" class="text-dark-muted">{{ number_format($post->view_count) }}</td>
                        <td data-label="Created" class="text-dark-muted">{{ $post->created_at->format('j M') }}</td>
                        <td data-actions>
                            <div class="flex flex-wrap justify-end gap-2">
                                <button type="button" wire:click="togglePublish({{ $post->id }})"
                                        class="btn-row {{ $post->published ? '' : 'btn-row-brand' }}">
                                    {{ $post->published ? 'Unpublish' : 'Publish' }}
                                </button>
                                <a href="{{ route('admin.blog.edit', $post->id) }}" wire:navigate class="btn-row">Edit</a>
                                <button type="button" wire:click="delete({{ $post->id }})"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        class="btn-row btn-row-danger">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="is-empty"><td colspan="5" class="!py-12 text-center text-dark-muted">No posts found.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($posts->hasPages())
            <div class="border-t border-dark-line px-5 py-4">{{ $posts->links('pagination.site', ['noun' => 'posts']) }}</div>
        @endif
    </section>
</div>

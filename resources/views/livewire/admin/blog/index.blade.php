<div class="space-y-4">

    {{-- Header --}}
    <div class="flex items-center justify-between md:flex-row flex-col gap-4">
        <div class="flex items-center gap-3">
            <input wire:model.live.debounce.300ms="search" type="text"
                   placeholder="Search posts..."
                   class="border border-gray-200 rounded-lg px-4 py-2 text-sm md:w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <select wire:model.live="filter"
                    class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="all">All</option>
                <option value="published">Published</option>
                <option value="draft">Drafts</option>
            </select>
        </div>
        <a href="{{ route('admin.blog.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2 md:w-auto w-full">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Post
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Title</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Views</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Date</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($posts as $post)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="font-medium text-gray-800">{{ $post->title }}</div>
                            <div class="text-xs text-gray-400">{{ $post->slug }}</div>
                        </td>
                        <td class="px-5 py-3">
                            @if($post->published)
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">Published</span>
                            @else
                                <span class="bg-gray-100 text-gray-600 text-xs font-semibold px-2 py-1 rounded-full">Draft</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ number_format($post->view_count) }}</td>
                        <td class="px-5 py-3 text-gray-500">{{ $post->created_at->format('M d, Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="togglePublish({{ $post->id }})"
                                        class="text-xs px-3 py-1 rounded border transition-colors
                                               {{ $post->published ? 'border-gray-300 text-gray-600 hover:bg-gray-100' : 'border-blue-300 text-blue-600 hover:bg-blue-50' }}">
                                    {{ $post->published ? 'Unpublish' : 'Publish' }}
                                </button>
                                <a href="{{ route('admin.blog.edit', $post->id) }}"
                                   class="text-xs px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-100 transition-colors">
                                    Edit
                                </a>
                                <button wire:click="delete({{ $post->id }})"
                                        wire:confirm="Are you sure you want to delete this post?"
                                        class="text-xs px-3 py-1 rounded border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-12 text-gray-400">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-4 border-t border-gray-100">
            {{ $posts->links() }}
        </div>
    </div>
</div>
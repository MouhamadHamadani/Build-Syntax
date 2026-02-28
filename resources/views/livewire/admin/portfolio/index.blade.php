<div class="space-y-4">

    <div class="flex items-center justify-between">
        <input wire:model.live.debounce.300ms="search" type="text"
               placeholder="Search projects..."
               class="border border-gray-200 rounded-lg px-4 py-2 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <a href="{{ route('admin.portfolio.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Project
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Project</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Category</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Featured</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Date</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($projects as $project)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="font-medium text-gray-800">{{ $project->title }}</div>
                            <div class="text-xs text-gray-400 truncate max-w-xs">{{ $project->description }}</div>
                        </td>
                        <td class="px-5 py-3">
                            <span class="bg-gray-100 text-gray-600 text-xs font-medium px-2 py-1 rounded">
                                {{ $project->category }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <button wire:click="toggleFeatured({{ $project->id }})"
                                    class="{{ $project->featured ? 'text-yellow-500' : 'text-gray-300' }} hover:scale-110 transition-transform text-xl">
                                ★
                            </button>
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $project->created_at->format('M d, Y') }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.portfolio.edit', $project->id) }}"
                                   class="text-xs px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-100 transition-colors">Edit</a>
                                <button wire:click="delete({{ $project->id }})"
                                        wire:confirm="Delete this project?"
                                        class="text-xs px-3 py-1 rounded border border-red-300 text-red-600 hover:bg-red-50 transition-colors">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-12 text-gray-400">No projects found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-4 border-t border-gray-100">{{ $projects->links() }}</div>
    </div>
</div>
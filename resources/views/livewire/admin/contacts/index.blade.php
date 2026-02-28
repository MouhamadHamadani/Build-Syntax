<div class="space-y-4">

    {{-- Filters --}}
    <div class="flex flex-wrap items-center gap-3">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search name or email..."
               class="border border-gray-200 rounded-lg px-4 py-2 text-sm w-56 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select wire:model.live="status"
                class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Statuses</option>
            <option value="new">New</option>
            <option value="contacted">Contacted</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
            <option value="declined">Declined</option>
        </select>
        <select wire:model.live="priority"
                class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All Priorities</option>
            <option value="urgent">Urgent</option>
            <option value="high">High</option>
            <option value="medium">Medium</option>
            <option value="low">Low</option>
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Client</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Project</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Priority</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Date</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($submissions as $submission)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3">
                            <div class="font-medium text-gray-800">{{ $submission->name }}</div>
                            <div class="text-xs text-gray-400">{{ $submission->email }}</div>
                        </td>
                        <td class="px-5 py-3 text-gray-600">{{ ucfirst(str_replace('_', ' ', $submission->project_type)) }}</td>
                        <td class="px-5 py-3">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $submission->status_badge_class }}">
                                {{ str_replace('_', ' ', $submission->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-3">
                            <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $submission->priority_badge_class }}">
                                {{ $submission->priority }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $submission->created_at->format('M d, Y') }}</td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.contacts.show', $submission->id) }}"
                               class="text-xs px-3 py-1 rounded border border-gray-300 text-gray-600 hover:bg-gray-100 transition-colors">View</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-12 text-gray-400">No submissions found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-4 border-t border-gray-100">{{ $submissions->links() }}</div>
    </div>
</div>
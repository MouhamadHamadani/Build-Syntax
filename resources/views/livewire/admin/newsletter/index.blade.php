<div class="space-y-4">

    {{-- Stats --}}
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <div class="text-2xl font-bold text-green-600">{{ $totals['active'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Active Subscribers</div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <div class="text-2xl font-bold text-yellow-500">{{ $totals['unconfirmed'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Awaiting Confirmation</div>
        </div>
        <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100 text-center">
            <div class="text-2xl font-bold text-gray-400">{{ $totals['unsubscribed'] }}</div>
            <div class="text-xs text-gray-500 mt-1">Unsubscribed</div>
        </div>
    </div>

    {{-- Filters --}}
    <div class="flex items-center gap-3">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search email or name..."
               class="border border-gray-200 rounded-lg px-4 py-2 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <select wire:model.live="status"
                class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">All</option>
            <option value="active">Active</option>
            <option value="unsubscribed">Unsubscribed</option>
        </select>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Email</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Name</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Status</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Confirmed</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Subscribed</th>
                    <th class="px-5 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($subscribers as $subscriber)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3 font-medium text-gray-800">{{ $subscriber->email }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $subscriber->name ?? '—' }}</td>
                        <td class="px-5 py-3">
                            @if($subscriber->status === 'active')
                                <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full">Active</span>
                            @elseif($subscriber->status === 'unsubscribed')
                                <span class="bg-gray-100 text-gray-500 text-xs font-semibold px-2 py-1 rounded-full">Unsubscribed</span>
                            @else
                                <span class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2 py-1 rounded-full">{{ $subscriber->status }}</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            @if($subscriber->confirmed)
                                <span class="text-green-600">✓</span>
                            @else
                                <span class="text-yellow-500 text-xs">Pending</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-gray-500">{{ $subscriber->subscribed_at->format('M d, Y') }}</td>
                        <td class="px-5 py-3 text-right">
                            @if($subscriber->status !== 'unsubscribed')
                                <button wire:click="unsubscribe({{ $subscriber->id }})"
                                        wire:confirm="Unsubscribe this user?"
                                        class="text-xs px-3 py-1 rounded border border-red-300 text-red-600 hover:bg-red-50 transition-colors">
                                    Remove
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-12 text-gray-400">No subscribers found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-4 border-t border-gray-100">{{ $subscribers->links() }}</div>
    </div>
</div>
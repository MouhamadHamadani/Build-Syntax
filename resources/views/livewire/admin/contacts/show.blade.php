<div class="max-w-8xl space-y-4">

    <a href="{{ route('admin.contacts.index') }}" class="text-sm text-gray-500 hover:text-gray-800">← Back to contacts</a>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Submission details --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
            <h2 class="font-semibold text-gray-800 text-lg">Submission Details</h2>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-400">Name</span><p class="font-medium text-gray-800">{{ $submission->name }}</p></div>
                <div><span class="text-gray-400">Email</span><p class="font-medium"><a href="mailto:{{ $submission->email }}" class="text-blue-600 hover:underline">{{ $submission->email }}</a></p></div>
                @if($submission->phone)
                <div><span class="text-gray-400">Phone</span><p class="font-medium">{{ $submission->phone }}</p></div>
                @endif
                @if($submission->company)
                <div><span class="text-gray-400">Company</span><p class="font-medium">{{ $submission->company }}</p></div>
                @endif
                <div><span class="text-gray-400">Project Type</span><p class="font-medium">{{ ucfirst(str_replace('_',' ',$submission->project_type)) }}</p></div>
                @if($submission->budget_range)
                <div><span class="text-gray-400">Budget</span><p class="font-medium">{{ $submission->budget_range }}</p></div>
                @endif
                <div><span class="text-gray-400">Received</span><p class="font-medium">{{ $submission->created_at->format('M d, Y H:i') }}</p></div>
            </div>

            <div>
                <span class="text-sm text-gray-400">Message</span>
                <div class="mt-2 bg-gray-50 rounded-lg p-4 text-sm text-gray-800 leading-relaxed whitespace-pre-wrap">{{ $submission->message }}</div>
            </div>
        </div>

        {{-- Update form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wider">Manage</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select wire:model="status"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="new">New</option>
                    <option value="contacted">Contacted</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="declined">Declined</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select wire:model="priority"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="urgent">Urgent</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Internal Notes</label>
                <textarea wire:model="notes" rows="5"
                          placeholder="Add notes about this lead..."
                          class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>

            <button wire:click="update" wire:loading.attr="disabled"
                    class="w-full bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                <span wire:loading.remove>Save Changes</span>
                <span wire:loading>Saving...</span>
            </button>
        </div>
    </div>
</div>
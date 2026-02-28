<div class="max-w-2xl space-y-4">

    <a href="{{ route('admin.portfolio.index') }}" class="text-sm text-gray-500 hover:text-gray-800">← Back</a>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Project Title *</label>
            <input wire:model="title" type="text"
                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-400 @enderror">
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
            <textarea wire:model="description" rows="4"
                      class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-400 @enderror"></textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select wire:model="category"
                        class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category') border-red-400 @enderror">
                    <option value="">Select category</option>
                    <option value="web">Web Development</option>
                    <option value="ecommerce">E-Commerce</option>
                    <option value="mobile">Mobile App</option>
                    <option value="other">Other</option>
                </select>
                @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Technologies</label>
                <input wire:model="technologies" type="text" placeholder="Laravel, Vue, Tailwind"
                       class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-400 mt-1">Comma-separated</p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Project URL</label>
            <input wire:model="project_url" type="url" placeholder="https://..."
                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Image URL</label>
            <input wire:model="image_url" type="url" placeholder="https://..."
                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <label class="flex items-center gap-3 cursor-pointer">
            <input wire:model="featured" type="checkbox" class="w-4 h-4 rounded text-blue-600">
            <span class="text-sm text-gray-700">Mark as featured project</span>
        </label>

        <button wire:click="save" wire:loading.attr="disabled"
                class="w-full bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
            <span wire:loading.remove>Save Project</span>
            <span wire:loading>Saving...</span>
        </button>
    </div>
</div>
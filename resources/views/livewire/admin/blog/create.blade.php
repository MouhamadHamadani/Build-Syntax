<div class="max-w-8xl space-y-6">

    <div class="flex items-center gap-4">
        <a href="{{ route('admin.blog.index') }}" class="text-sm text-gray-500 hover:text-gray-800">← Back</a>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Main form --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Title *</label>
                    <input wire:model="title" type="text" placeholder="Post title..."
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-400 @enderror">
                    @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
                    <textarea wire:model="excerpt" rows="2" placeholder="Short summary shown on blog index..."
                              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Content *</label>
                    <textarea wire:model="content" rows="18" placeholder="Write your post content here..."
                              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-400 @enderror"></textarea>
                    @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- SEO --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wider">SEO</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Title</label>
                    <input wire:model="meta_title" type="text" placeholder="Leave blank to use post title"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                    <textarea wire:model="meta_description" rows="2"
                              placeholder="Short description for search engines (max 320 chars)"
                              class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-4">
                <h3 class="font-semibold text-gray-700 text-sm uppercase tracking-wider">Publish</h3>

                <label class="flex items-center gap-3 cursor-pointer">
                    <input wire:model="published" type="checkbox"
                           class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Publish immediately</span>
                </label>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Author</label>
                    <input wire:model="author" type="text"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                    <input wire:model="tags_input" type="text" placeholder="laravel, php, web..."
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">Comma-separated</p>
                </div>

                <button wire:click="save"
                        wire:loading.attr="disabled"
                        class="w-full bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    <span wire:loading.remove>Save Post</span>
                    <span wire:loading>Saving...</span>
                </button>
            </div>
        </div>
    </div>
</div>
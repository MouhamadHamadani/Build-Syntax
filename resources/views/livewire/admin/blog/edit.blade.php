<div class="flex flex-col gap-[22px]">

    <a href="{{ route('admin.blog.index') }}" wire:navigate class="admin-link self-start text-sm font-medium">← All posts</a>

    <header>
        <p class="mono-label">Website · Blog</p>
        <h1 class="admin-h1">Edit post</h1>
    </header>

    <form wire:submit="save" class="flex flex-wrap items-start gap-5">

        {{-- Main form --}}
        <div class="flex min-w-0 flex-[2_1_520px] flex-col gap-5">
            <div class="panel flex flex-col gap-[18px] p-6">
                <div class="field">
                    <label for="title">Title *</label>
                    <input id="title" wire:model="title" type="text" placeholder="Post title..." class="field-input" @error('title') aria-invalid="true" aria-describedby="title-error" @enderror>
                    @error('title') <p id="title-error" class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="excerpt">Excerpt</label>
                    <textarea id="excerpt" wire:model="excerpt" rows="2" placeholder="Short summary shown on blog index..." class="field-input !min-h-0"></textarea>
                </div>

                <div class="field">
                    <label for="content">Content *</label>
                    <textarea id="content" wire:model="content" rows="18" placeholder="Write your post content here..." class="field-input font-mono !text-sm" @error('content') aria-invalid="true" aria-describedby="content-error" @enderror></textarea>
                    @error('content') <p id="content-error" class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- SEO --}}
            <div class="panel flex flex-col gap-[18px] p-6">
                <h2 class="mono-label">SEO</h2>
                <div class="field">
                    <label for="meta_title">Meta title</label>
                    <input id="meta_title" wire:model="meta_title" type="text" placeholder="Leave blank to use post title" class="field-input">
                </div>
                <div class="field">
                    <label for="meta_description">Meta description</label>
                    <textarea id="meta_description" wire:model="meta_description" rows="2" placeholder="Short description for search engines (max 320 chars)" class="field-input !min-h-0"></textarea>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="panel flex min-w-0 flex-[1_1_280px] flex-col gap-[18px] p-6">
            <h2 class="mono-label">Publish</h2>

            <label class="flex cursor-pointer items-center gap-3 text-sm">
                <input wire:model="published" type="checkbox" role="switch" class="switch">
                Publish immediately
            </label>

            <div class="field">
                <label for="author">Author</label>
                <input id="author" wire:model="author" type="text" class="field-input">
            </div>

            <div class="field">
                <label for="slug">URL slug</label>
                <input id="slug" wire:model="slug" type="text" aria-describedby="slug-hint @error('slug') slug-error @enderror" class="field-input" @error('slug') aria-invalid="true" @enderror>
                <span id="slug-hint" class="field-hint">Changing this will break existing links.</span>
                @error('slug') <p id="slug-error" class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label for="tags_input">Tags</label>
                <input id="tags_input" wire:model="tags_input" type="text" placeholder="laravel, php, web..." aria-describedby="tags-hint" class="field-input">
                <span id="tags-hint" class="field-hint">Comma-separated</span>
            </div>

            <button type="submit" wire:loading.attr="disabled" class="btn btn-brand disabled:opacity-50">
                <span wire:loading.remove wire:target="save">Update post</span>
                <span wire:loading wire:target="save">Updating...</span>
            </button>
        </div>
    </form>
</div>

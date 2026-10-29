{{-- Shared by portfolio create and edit. Expects $categories (value => label), $heading and $submitLabel. --}}
<div class="flex flex-col gap-[22px]">

    <a href="{{ route('admin.portfolio.index') }}" wire:navigate class="admin-link self-start text-sm font-medium">← All projects</a>

    <header class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <p class="mono-label">Website · Portfolio</p>
            <h1 class="admin-h1">{{ $heading }}</h1>
        </div>
        <button type="submit" form="project-form" wire:loading.attr="disabled" class="btn btn-brand btn-sm disabled:opacity-50">
            <span wire:loading.remove wire:target="save">{{ $submitLabel }}</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </header>

    <div class="flex flex-wrap items-start gap-5">
        <form id="project-form" wire:submit="save" class="panel flex flex-[1.6_1_520px] flex-col gap-[18px] p-6">
            <div class="field content-start">
                <label for="title">Project title *</label>
                <input id="title" wire:model="title" type="text" class="field-input" @error('title') aria-invalid="true" aria-describedby="title-error" @enderror>
                @error('title') <p id="title-error" class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field content-start">
                <label for="description">Description *</label>
                <textarea id="description" wire:model="description" rows="4" class="field-input !min-h-[120px]" @error('description') aria-invalid="true" aria-describedby="description-error" @enderror></textarea>
                @error('description') <p id="description-error" class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-4">
                <div class="field content-start">
                    <label for="category">Category *</label>
                    <select id="category" wire:model="category" class="field-input" @error('category') aria-invalid="true" aria-describedby="category-error" @enderror>
                        <option value="">Select category</option>
                        @foreach($categories as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category') <p id="category-error" class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field content-start">
                    <label for="technologies">Technologies</label>
                    <input id="technologies" wire:model="technologies" type="text" placeholder="Laravel, Vue, Tailwind" aria-describedby="technologies-hint" class="field-input">
                    <span id="technologies-hint" class="field-hint">Comma-separated</span>
                </div>

                <div class="field content-start">
                    <label for="project_url">Project link</label>
                    <input id="project_url" wire:model="project_url" type="url" placeholder="https://..." class="field-input" @error('project_url') aria-invalid="true" aria-describedby="project_url-error" @enderror>
                    @error('project_url') <p id="project_url-error" class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field content-start">
                    <label for="image_url">Image URL</label>
                    <input id="image_url" wire:model="image_url" type="url" placeholder="https://..." class="field-input" @error('image_url') aria-invalid="true" aria-describedby="image_url-error" @enderror>
                    @error('image_url') <p id="image_url-error" class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <label class="flex cursor-pointer items-center gap-3 border-t border-dark-line pt-4 text-[14.5px]">
                <input wire:model="featured" type="checkbox" role="switch" class="switch">
                Feature this project (shows first on the portfolio page)
            </label>
        </form>

        {{-- Live preview of the public card, read from the form fields --}}
        <aside class="flex min-w-0 flex-[1_1_300px] flex-col gap-3" aria-labelledby="preview-h" x-data="{ labels: @js($categories) }">
            <h2 id="preview-h" class="mono-label">How the card looks on the site</h2>
            <article class="demo-card accent-brand">
                <div class="demo-card-shot grid aspect-[16/10] place-items-center overflow-hidden text-[13px] text-dark-muted">
                    <img x-show="/^https?:\/\//.test($wire.image_url || '')" :src="$wire.image_url" alt="" class="h-full w-full object-cover" x-cloak>
                    <span x-show="!/^https?:\/\//.test($wire.image_url || '')">Screenshot</span>
                </div>
                <div class="flex flex-col gap-2.5 p-5">
                    <span class="mono-label !text-brand-blue-light" x-text="labels[$wire.category] || 'Category'"></span>
                    <h3 class="text-xl font-bold" x-text="$wire.title || 'Project title'"></h3>
                    <p class="text-[14.5px] text-dark-muted" x-text="$wire.description || 'A short description of what you built and for whom.'"></p>
                    <div class="flex flex-wrap gap-1.5">
                        <template x-for="tech in ($wire.technologies || '').split(',').map(t => t.trim()).filter(Boolean)" :key="tech">
                            <span class="stack-chip !px-2.5 !py-1.5 !text-xs" x-text="tech"></span>
                        </template>
                    </div>
                </div>
            </article>
        </aside>
    </div>
</div>

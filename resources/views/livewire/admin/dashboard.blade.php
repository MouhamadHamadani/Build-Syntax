<div class="space-y-6">

    {{-- Stats grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="text-sm text-gray-500 mb-1">New Contacts</div>
            <div class="text-3xl font-bold text-blue-600">{{ $stats['contacts_new'] }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $stats['contacts_total'] }} total</div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="text-sm text-gray-500 mb-1">Published Posts</div>
            <div class="text-3xl font-bold text-green-600">{{ $stats['blog_published'] }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $stats['blog_drafts'] }} drafts</div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="text-sm text-gray-500 mb-1">Portfolio Items</div>
            <div class="text-3xl font-bold text-purple-600">{{ $stats['portfolio_total'] }}</div>
            <div class="text-xs text-gray-400 mt-1">projects</div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
            <div class="text-sm text-gray-500 mb-1">Newsletter</div>
            <div class="text-3xl font-bold text-orange-500">{{ $stats['newsletter_active'] }}</div>
            <div class="text-xs text-gray-400 mt-1">{{ $stats['newsletter_total'] }} total</div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        {{-- Recent contacts --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-gray-800">Recent Contacts</h2>
                <a href="{{ route('admin.contacts.index') }}" class="text-sm text-blue-600 hover:underline">View all</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentContacts as $contact)
                    <a href="{{ route('admin.contacts.show', $contact->id) }}"
                       class="flex items-center gap-4 px-5 py-3 hover:bg-gray-50 transition-colors">
                        <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm shrink-0">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-gray-800 text-sm truncate">{{ $contact->name }}</div>
                            <div class="text-xs text-gray-400 truncate">{{ $contact->email }}</div>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $contact->status_badge_class }}">
                            {{ $contact->status }}
                        </span>
                    </a>
                @empty
                    <p class="px-5 py-8 text-center text-gray-400 text-sm">No contacts yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Recent blog posts --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="font-semibold text-gray-800">Recent Blog Posts</h2>
                <a href="{{ route('admin.blog.index') }}" class="text-sm text-blue-600 hover:underline">View all</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($recentPosts as $post)
                    <a href="{{ route('admin.blog.edit', $post->id) }}"
                       class="flex items-center gap-4 px-5 py-3 hover:bg-gray-50 transition-colors">
                        <div class="flex-1 min-w-0">
                            <div class="font-medium text-gray-800 text-sm truncate">{{ $post->title }}</div>
                            <div class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                        @if($post->published)
                            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-green-100 text-green-700">Published</span>
                        @else
                            <span class="text-xs font-semibold px-2 py-1 rounded-full bg-gray-100 text-gray-600">Draft</span>
                        @endif
                    </a>
                @empty
                    <p class="px-5 py-8 text-center text-gray-400 text-sm">No posts yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
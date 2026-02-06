<?php
require_once 'auth.php';
require_once '../includes/config.php';
requireAdmin();
$pdo = getDBConnection();

$message = '';
$error = '';

// Handle actions
if ($_POST) {
    $action = $_POST['action'] ?? '';

    if ($action === 'create_post') {
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $excerpt = trim($_POST['excerpt']);
        $author = trim($_POST['author']) ?: 'Build Syntax Team';
        $status = $_POST['status'] ?? 'draft';
        $meta_title = trim($_POST['meta_title']);
        $meta_description = trim($_POST['meta_description']);
        $tags = $_POST['tags'] ?? '';

        if (!$title || !$content) {
            $error = 'Title and content are required.';
        } else {
            $slug = generateSlug($title);

            // Check if slug exists
            $slugCheck = $pdo->prepare("SELECT id FROM blog_posts WHERE slug = ?");
            $slugCheck->execute([$slug]);
            if ($slugCheck->fetch()) {
                $slug .= '-' . time();
            }

            try {
                $published_at = ($status === 'published') ? date('Y-m-d H:i:s') : null;
                $tags_json = $tags ? json_encode(array_map('trim', explode(',', $tags))) : null;

                $stmt = $pdo->prepare("
                    INSERT INTO blog_posts (title, slug, excerpt, content, author, published, status, published_at, created_by, meta_title, meta_description, tags) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $title,
                    $slug,
                    $excerpt,
                    $content,
                    $author,
                    ($status === 'published' ? 1 : 0),
                    $status,
                    $published_at,
                    $_SESSION['admin_id'],
                    $meta_title,
                    $meta_description,
                    $tags_json
                ]);

                logActivity($pdo, 'create_blog_post', 'blog_posts', $pdo->lastInsertId(), null, ['title' => $title, 'status' => $status]);
                $message = 'Blog post created successfully!';
            } catch (PDOException $e) {
                $error = 'Failed to create post: ' . $e->getMessage();
            }
        }
    }

    if ($action === 'update_post') {
        $id = (int)$_POST['id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $excerpt = trim($_POST['excerpt']);
        $author = trim($_POST['author']) ?: 'Build Syntax Team';
        $status = $_POST['status'] ?? 'draft';
        $meta_title = trim($_POST['meta_title']);
        $meta_description = trim($_POST['meta_description']);
        $tags = $_POST['tags'] ?? '';

        if (!$title || !$content) {
            $error = 'Title and content are required.';
        } else {
            try {
                // Get current post data
                $currentPost = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
                $currentPost->execute([$id]);
                $oldData = $currentPost->fetch();

                $published_at = ($status === 'published' && $oldData['published_at'] === null) ? date('Y-m-d H:i:s') : $oldData['published_at'];
                $tags_json = $tags ? json_encode(array_map('trim', explode(',', $tags))) : null;

                $stmt = $pdo->prepare("
                    UPDATE blog_posts 
                    SET title = ?, excerpt = ?, content = ?, author = ?, published = ?, status = ?, published_at = ?, meta_title = ?, meta_description = ?, tags = ?
                    WHERE id = ?
                ");
                $stmt->execute([
                    $title,
                    $excerpt,
                    $content,
                    $author,
                    ($status === 'published' ? 1 : 0),
                    $status,
                    $published_at,
                    $meta_title,
                    $meta_description,
                    $tags_json,
                    $id
                ]);

                logActivity($pdo, 'update_blog_post', 'blog_posts', $id, $oldData, ['title' => $title, 'status' => $status]);
                $message = 'Blog post updated successfully!';
            } catch (PDOException $e) {
                $error = 'Failed to update post: ' . $e->getMessage();
            }
        }
    }

    if ($action === 'delete_post') {
        $id = (int)$_POST['id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM blog_posts WHERE id = ?");
            $stmt->execute([$id]);

            logActivity($pdo, 'delete_blog_post', 'blog_posts', $id);
            $message = 'Blog post deleted successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to delete post: ' . $e->getMessage();
        }
    }

    if ($action === 'toggle_status') {
        $id = (int)$_POST['id'];
        $new_status = $_POST['new_status'];

        try {
            $published_at = ($new_status === 'published') ? date('Y-m-d H:i:s') : null;

            $stmt = $pdo->prepare("UPDATE blog_posts SET published = ?, status = ?, published_at = ? WHERE id = ?");
            $stmt->execute([($new_status === 'published' ? 1 : 0), $new_status, $published_at, $id]);

            logActivity($pdo, 'toggle_blog_status', 'blog_posts', $id, null, ['status' => $new_status]);
            $message = 'Post status updated successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to update status: ' . $e->getMessage();
        }
    }
}

// Get filter parameters
$status_filter = $_GET['status'] ?? '';
$search = $_GET['search'] ?? '';

// Build query
$where_conditions = [];
$params = [];

if ($status_filter) {
    $where_conditions[] = "status = ?";
    $params[] = $status_filter;
}

if ($search) {
    $where_conditions[] = "(title LIKE ? OR content LIKE ? OR author LIKE ?)";
    $search_param = "%$search%";
    $params = array_merge($params, [$search_param, $search_param, $search_param]);
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get posts
try {
    $stmt = $pdo->prepare("
        SELECT * FROM blog_posts 
        $where_clause 
        ORDER BY created_at DESC
    ");
    $stmt->execute($params);
    $posts = $stmt->fetchAll();

    // Get counts for stats
    $stats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) as published_count,
            SUM(CASE WHEN status = 'draft' THEN 1 ELSE 0 END) as draft_count,
            SUM(CASE WHEN status = 'archived' THEN 1 ELSE 0 END) as archived_count,
            SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM blog_posts
    ")->fetch();
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
    $posts = [];
    $stats = ['total' => 0, 'published_count' => 0, 'draft_count' => 0, 'archived_count' => 0, 'today_count' => 0];
}

// Get single post for editing
$editPost = null;
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $editStmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $editStmt->execute([$editId]);
    $editPost = $editStmt->fetch();
}
include 'header.php';
?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-dark-accent">Blog Posts</h1>
                    <p class="text-dark-secondary mt-2">Create and manage your blog content</p>
                </div>
                <div class="flex space-x-4">
                    <?php if ($editPost): ?>
                        <a href="blog.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            Cancel Edit
                        </a>
                    <?php else: ?>
                        <button onclick="showCreateModal()" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
                            New Post
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <?php if ($message): ?>
            <div class="bg-green-500 bg-opacity-10 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="bg-red-500 bg-opacity-10 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-6">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <?php if ($editPost): ?>
            <!-- Edit Post Form -->
            <div class="bg-dark-secondary rounded-lg border border-dark p-6 mb-8">
                <h2 class="text-xl font-semibold text-dark-accent mb-6">Edit Post: <?php echo htmlspecialchars($editPost['title']); ?></h2>
                <form method="POST" class="space-y-6">
                    <input type="hidden" name="action" value="update_post">
                    <input type="hidden" name="id" value="<?php echo $editPost['id']; ?>">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Title *</label>
                            <input type="text" name="title" required value="<?php echo htmlspecialchars($editPost['title']); ?>"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Author</label>
                            <input type="text" name="author" value="<?php echo htmlspecialchars($editPost['author']); ?>"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Excerpt</label>
                        <textarea name="excerpt" rows="3"
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                            placeholder="Brief description of the post..."><?php echo htmlspecialchars($editPost['excerpt']); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Content *</label>
                        <textarea name="content" rows="15" required
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                            placeholder="Write your blog post content here..."><?php echo htmlspecialchars($editPost['content']); ?></textarea>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="<?php echo htmlspecialchars($editPost['meta_title']); ?>"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Tags (comma-separated)</label>
                            <input type="text" name="tags" value="<?php echo $editPost['tags'] ? implode(', ', json_decode($editPost['tags'])) : ''; ?>"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                                placeholder="web development, php, laravel">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="2"
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                            placeholder="SEO description for search engines..."><?php echo htmlspecialchars($editPost['meta_description']); ?></textarea>
                    </div>

                    <div class="flex justify-between items-center">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                            <select name="status" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                                <option value="draft" <?php echo $editPost['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                                <option value="published" <?php echo $editPost['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
                                <option value="archived" <?php echo $editPost['status'] === 'archived' ? 'selected' : ''; ?>>Archived</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-brand-blue text-white px-8 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
                            Update Post
                        </button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                    <p class="text-dark-secondary text-sm">Total</p>
                    <p class="text-2xl font-bold text-dark-accent"><?php echo $stats['total']; ?></p>
                </div>
                <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                    <p class="text-dark-secondary text-sm">Published</p>
                    <p class="text-2xl font-bold text-green-400"><?php echo $stats['published_count']; ?></p>
                </div>
                <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                    <p class="text-dark-secondary text-sm">Drafts</p>
                    <p class="text-2xl font-bold text-yellow-400"><?php echo $stats['draft_count']; ?></p>
                </div>
                <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                    <p class="text-dark-secondary text-sm">Archived</p>
                    <p class="text-2xl font-bold text-gray-400"><?php echo $stats['archived_count']; ?></p>
                </div>
                <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                    <p class="text-dark-secondary text-sm">Today</p>
                    <p class="text-2xl font-bold text-blue-400"><?php echo $stats['today_count']; ?></p>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-dark-secondary rounded-lg p-6 border border-dark mb-8">
                <form method="GET" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-64">
                        <label class="block text-sm font-medium text-dark-accent mb-2">Search</label>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                            placeholder="Search by title, content, or author..."
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                        <select name="status" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                            <option value="">All Statuses</option>
                            <option value="published" <?php echo $status_filter === 'published' ? 'selected' : ''; ?>>Published</option>
                            <option value="draft" <?php echo $status_filter === 'draft' ? 'selected' : ''; ?>>Draft</option>
                            <option value="archived" <?php echo $status_filter === 'archived' ? 'selected' : ''; ?>>Archived</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
                        Filter
                    </button>
                    <a href="blog.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                        Clear
                    </a>
                </form>
            </div>

            <!-- Posts Table -->
            <div class="bg-dark-secondary rounded-lg border border-dark overflow-hidden">
                <?php if (empty($posts)): ?>
                    <div class="p-8 text-center">
                        <p class="text-dark-secondary">No blog posts found matching your criteria.</p>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-dark-tertiary">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Post</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Author</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Views</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-dark">
                                <?php foreach ($posts as $post): ?>
                                    <tr class="hover:bg-dark-tertiary">
                                        <td class="px-6 py-4">
                                            <div>
                                                <div class="text-sm font-medium text-dark-accent"><?php echo htmlspecialchars($post['title']); ?></div>
                                                <div class="text-sm text-dark-secondary"><?php echo truncateText($post['excerpt'] ?: $post['content'], 80); ?></div>
                                                <?php if ($post['tags']): ?>
                                                    <div class="mt-1">
                                                        <?php foreach (json_decode($post['tags']) as $tag): ?>
                                                            <span class="inline-block bg-dark-tertiary text-dark-secondary text-xs px-2 py-1 rounded mr-1"><?php echo htmlspecialchars($tag); ?></span>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-dark-secondary">
                                            <?php echo htmlspecialchars($post['author']); ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 text-xs rounded-full <?php echo getStatusBadgeClass($post['status']); ?>">
                                                <?php echo ucfirst($post['status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-dark-secondary">
                                            <?php echo number_format($post['view_count']); ?>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-dark-secondary">
                                            <?php echo formatDateShort($post['created_at']); ?>
                                            <?php if ($post['published_at']): ?>
                                                <div class="text-xs text-dark-secondary">Pub: <?php echo formatDateShort($post['published_at']); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <a href="blog.php?edit=<?php echo $post['id']; ?>" class="text-green-400 hover:text-green-300 text-sm">Edit</a>
                                                <?php if ($post['status'] === 'published'): ?>
                                                    <button onclick="toggleStatus(<?php echo $post['id']; ?>, 'draft')" class="text-yellow-400 hover:text-yellow-300 text-sm">Unpublish</button>
                                                <?php else: ?>
                                                    <button onclick="toggleStatus(<?php echo $post['id']; ?>, 'published')" class="text-blue-400 hover:text-blue-300 text-sm">Publish</button>
                                                <?php endif; ?>
                                                <button onclick="deletePost(<?php echo $post['id']; ?>)" class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

<!-- Create Post Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-dark-secondary rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="p-6 border-b border-dark">
                <h3 class="text-lg font-semibold text-dark-accent">Create New Blog Post</h3>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="create_post">
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Title *</label>
                            <input type="text" name="title" required
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                                placeholder="Enter post title...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Author</label>
                            <input type="text" name="author" value="Build Syntax Team"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Excerpt</label>
                        <textarea name="excerpt" rows="3"
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                            placeholder="Brief description of the post..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Content *</label>
                        <textarea name="content" rows="12" required
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                            placeholder="Write your blog post content here..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Meta Title</label>
                            <input type="text" name="meta_title"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                                placeholder="SEO title...">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Tags (comma-separated)</label>
                            <input type="text" name="tags"
                                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                                placeholder="web development, php, laravel">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Meta Description</label>
                        <textarea name="meta_description" rows="2"
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                            placeholder="SEO description for search engines..."></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                        <select name="status" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                            <option value="draft">Save as Draft</option>
                            <option value="published">Publish Now</option>
                        </select>
                    </div>
                </div>
                <div class="p-6 border-t border-dark flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('createModal')"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-brand-blue-dark">
                        Create Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showCreateModal() {
        document.getElementById('createModal').classList.remove('hidden');
    }

    function toggleStatus(id, newStatus) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.innerHTML = `
                <input type="hidden" name="action" value="toggle_status">
                <input type="hidden" name="id" value="${id}">
                <input type="hidden" name="new_status" value="${newStatus}">
            `;
        document.body.appendChild(form);
        form.submit();
    }

    function deletePost(id) {
        if (confirm('Are you sure you want to delete this blog post? This action cannot be undone.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
                    <input type="hidden" name="action" value="delete_post">
                    <input type="hidden" name="id" value="${id}">
                `;
            document.body.appendChild(form);
            form.submit();
        }
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Close modals when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('fixed')) {
            e.target.classList.add('hidden');
        }
    });
</script>
</body>

</html>
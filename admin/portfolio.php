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

  if ($action === 'create_project') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $technologies = trim($_POST['technologies']);
    $project_url = trim($_POST['project_url']);
    $image_url = trim($_POST['image_url']);
    $featured = isset($_POST['featured']) ? 1 : 0;

    if (!$title || !$description || !$category) {
      $error = 'Title, description, and category are required.';
    } else {
      try {
        $stmt = $pdo->prepare("
                    INSERT INTO portfolio_projects (title, description, category, technologies, project_url, image_url, featured, created_by) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
                ");
        $stmt->execute([
          $title,
          $description,
          $category,
          $technologies,
          $project_url,
          $image_url,
          $featured,
          $_SESSION['admin_id']
        ]);

        logActivity($pdo, 'create_portfolio_project', 'portfolio_projects', $pdo->lastInsertId(), null, ['title' => $title, 'category' => $category]);
        $message = 'Portfolio project created successfully!';
      } catch (PDOException $e) {
        $error = 'Failed to create project: ' . $e->getMessage();
      }
    }
  }

  if ($action === 'update_project') {
    $id = (int)$_POST['id'];
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = $_POST['category'];
    $technologies = trim($_POST['technologies']);
    $project_url = trim($_POST['project_url']);
    $image_url = trim($_POST['image_url']);
    $featured = isset($_POST['featured']) ? 1 : 0;

    if (!$title || !$description || !$category) {
      $error = 'Title, description, and category are required.';
    } else {
      try {
        // Get current project data
        $currentProject = $pdo->prepare("SELECT * FROM portfolio_projects WHERE id = ?");
        $currentProject->execute([$id]);
        $oldData = $currentProject->fetch();

        $stmt = $pdo->prepare("
                    UPDATE portfolio_projects 
                    SET title = ?, description = ?, category = ?, technologies = ?, project_url = ?, image_url = ?, featured = ?
                    WHERE id = ?
                ");
        $stmt->execute([
          $title,
          $description,
          $category,
          $technologies,
          $project_url,
          $image_url,
          $featured,
          $id
        ]);

        logActivity($pdo, 'update_portfolio_project', 'portfolio_projects', $id, $oldData, ['title' => $title, 'category' => $category]);
        $message = 'Portfolio project updated successfully!';
      } catch (PDOException $e) {
        $error = 'Failed to update project: ' . $e->getMessage();
      }
    }
  }

  if ($action === 'delete_project') {
    $id = (int)$_POST['id'];

    try {
      $stmt = $pdo->prepare("DELETE FROM portfolio_projects WHERE id = ?");
      $stmt->execute([$id]);

      logActivity($pdo, 'delete_portfolio_project', 'portfolio_projects', $id);
      $message = 'Portfolio project deleted successfully!';
    } catch (PDOException $e) {
      $error = 'Failed to delete project: ' . $e->getMessage();
    }
  }

  if ($action === 'toggle_featured') {
    $id = (int)$_POST['id'];
    $featured = (int)$_POST['featured'];

    try {
      $stmt = $pdo->prepare("UPDATE portfolio_projects SET featured = ? WHERE id = ?");
      $stmt->execute([$featured, $id]);

      logActivity($pdo, 'toggle_portfolio_featured', 'portfolio_projects', $id, null, ['featured' => $featured]);
      $message = 'Project featured status updated successfully!';
    } catch (PDOException $e) {
      $error = 'Failed to update featured status: ' . $e->getMessage();
    }
  }
}

// Get filter parameters
$category_filter = $_GET['category'] ?? '';
$featured_filter = $_GET['featured'] ?? '';
$search = $_GET['search'] ?? '';

// Build query
$where_conditions = [];
$params = [];

if ($category_filter) {
  $where_conditions[] = "category = ?";
  $params[] = $category_filter;
}

if ($featured_filter !== '') {
  $where_conditions[] = "featured = ?";
  $params[] = (int)$featured_filter;
}

if ($search) {
  $where_conditions[] = "(title LIKE ? OR description LIKE ? OR technologies LIKE ?)";
  $search_param = "%$search%";
  $params = array_merge($params, [$search_param, $search_param, $search_param]);
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get projects
try {
  $stmt = $pdo->prepare("
        SELECT * FROM portfolio_projects 
        $where_clause 
        ORDER BY featured DESC, created_at DESC
    ");
  $stmt->execute($params);
  $projects = $stmt->fetchAll();

  // Get counts for stats
  $stats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN featured = 1 THEN 1 ELSE 0 END) as featured_count,
            SUM(CASE WHEN category = 'web' THEN 1 ELSE 0 END) as web_count,
            SUM(CASE WHEN category = 'ecommerce' THEN 1 ELSE 0 END) as ecommerce_count,
            SUM(CASE WHEN category = 'mobile' THEN 1 ELSE 0 END) as mobile_count,
            SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM portfolio_projects
    ")->fetch();
} catch (PDOException $e) {
  $error = "Database error: " . $e->getMessage();
  $projects = [];
  $stats = ['total' => 0, 'featured_count' => 0, 'web_count' => 0, 'ecommerce_count' => 0, 'mobile_count' => 0, 'today_count' => 0];
}

// Get single project for editing
$editProject = null;
if (isset($_GET['edit'])) {
  $editId = (int)$_GET['edit'];
  $editStmt = $pdo->prepare("SELECT * FROM portfolio_projects WHERE id = ?");
  $editStmt->execute([$editId]);
  $editProject = $editStmt->fetch();
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
          <h1 class="text-3xl font-bold text-dark-accent">Portfolio Projects</h1>
          <p class="text-dark-secondary mt-2">Manage your portfolio and showcase your work</p>
        </div>
        <div class="flex space-x-4">
          <?php if ($editProject): ?>
            <a href="portfolio.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
              Cancel Edit
            </a>
          <?php else: ?>
            <button onclick="showCreateModal()" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
              New Project
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

    <?php if ($editProject): ?>
      <!-- Edit Project Form -->
      <div class="bg-dark-secondary rounded-lg border border-dark p-6 mb-8">
        <h2 class="text-xl font-semibold text-dark-accent mb-6">Edit Project: <?php echo htmlspecialchars($editProject['title']); ?></h2>
        <form method="POST" class="space-y-6">
          <input type="hidden" name="action" value="update_project">
          <input type="hidden" name="id" value="<?php echo $editProject['id']; ?>">

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Project Title *</label>
              <input type="text" name="title" required value="<?php echo htmlspecialchars($editProject['title']); ?>"
                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
            </div>
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Category *</label>
              <select name="category" required class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                <option value="web" <?php echo $editProject['category'] === 'web' ? 'selected' : ''; ?>>Web Development</option>
                <option value="ecommerce" <?php echo $editProject['category'] === 'ecommerce' ? 'selected' : ''; ?>>E-Commerce</option>
                <option value="mobile" <?php echo $editProject['category'] === 'mobile' ? 'selected' : ''; ?>>Mobile App</option>
                <option value="other" <?php echo $editProject['category'] === 'other' ? 'selected' : ''; ?>>Other</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-dark-accent mb-2">Description *</label>
            <textarea name="description" rows="4" required
              class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
              placeholder="Describe the project and its key features..."><?php echo htmlspecialchars($editProject['description']); ?></textarea>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Technologies Used</label>
              <input type="text" name="technologies" value="<?php echo htmlspecialchars($editProject['technologies']); ?>"
                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                placeholder="Laravel, PHP, MySQL, JavaScript">
            </div>
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Project URL</label>
              <input type="url" name="project_url" value="<?php echo htmlspecialchars($editProject['project_url']); ?>"
                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                placeholder="https://example.com">
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-dark-accent mb-2">Image URL</label>
            <input type="url" name="image_url" value="<?php echo htmlspecialchars($editProject['image_url']); ?>"
              class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
              placeholder="https://example.com/image.jpg">
          </div>

          <div class="flex justify-between items-center">
            <div class="flex items-center">
              <input type="checkbox" name="featured" id="editFeatured" <?php echo $editProject['featured'] ? 'checked' : ''; ?>
                class="w-4 h-4 text-brand-blue bg-dark-tertiary border-dark rounded focus:ring-brand-blue focus:ring-2">
              <label for="editFeatured" class="ml-2 text-sm text-dark-accent">Featured Project</label>
            </div>
            <button type="submit" class="bg-brand-blue text-white px-8 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
              Update Project
            </button>
          </div>
        </form>
      </div>
    <?php else: ?>
      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-8">
        <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
          <p class="text-dark-secondary text-sm">Total</p>
          <p class="text-2xl font-bold text-dark-accent"><?php echo $stats['total']; ?></p>
        </div>
        <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
          <p class="text-dark-secondary text-sm">Featured</p>
          <p class="text-2xl font-bold text-yellow-400"><?php echo $stats['featured_count']; ?></p>
        </div>
        <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
          <p class="text-dark-secondary text-sm">Web</p>
          <p class="text-2xl font-bold text-blue-400"><?php echo $stats['web_count']; ?></p>
        </div>
        <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
          <p class="text-dark-secondary text-sm">E-Commerce</p>
          <p class="text-2xl font-bold text-green-400"><?php echo $stats['ecommerce_count']; ?></p>
        </div>
        <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
          <p class="text-dark-secondary text-sm">Mobile</p>
          <p class="text-2xl font-bold text-purple-400"><?php echo $stats['mobile_count']; ?></p>
        </div>
        <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
          <p class="text-dark-secondary text-sm">Today</p>
          <p class="text-2xl font-bold text-orange-400"><?php echo $stats['today_count']; ?></p>
        </div>
      </div>

      <!-- Filters -->
      <div class="bg-dark-secondary rounded-lg p-6 border border-dark mb-8">
        <form method="GET" class="flex flex-wrap gap-4 items-end">
          <div class="flex-1 min-w-64">
            <label class="block text-sm font-medium text-dark-accent mb-2">Search</label>
            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
              placeholder="Search by title, description, or technologies..."
              class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
          </div>
          <div>
            <label class="block text-sm font-medium text-dark-accent mb-2">Category</label>
            <select name="category" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
              <option value="">All Categories</option>
              <option value="web" <?php echo $category_filter === 'web' ? 'selected' : ''; ?>>Web Development</option>
              <option value="ecommerce" <?php echo $category_filter === 'ecommerce' ? 'selected' : ''; ?>>E-Commerce</option>
              <option value="mobile" <?php echo $category_filter === 'mobile' ? 'selected' : ''; ?>>Mobile App</option>
              <option value="other" <?php echo $category_filter === 'other' ? 'selected' : ''; ?>>Other</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-dark-accent mb-2">Featured</label>
            <select name="featured" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
              <option value="">All Projects</option>
              <option value="1" <?php echo $featured_filter === '1' ? 'selected' : ''; ?>>Featured Only</option>
              <option value="0" <?php echo $featured_filter === '0' ? 'selected' : ''; ?>>Non-Featured</option>
            </select>
          </div>
          <button type="submit" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
            Filter
          </button>
          <a href="portfolio.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            Clear
          </a>
        </form>
      </div>

      <!-- Projects Grid -->
      <div class="bg-dark-secondary rounded-lg border border-dark overflow-hidden">
        <?php if (empty($projects)): ?>
          <div class="p-8 text-center">
            <p class="text-dark-secondary">No portfolio projects found matching your criteria.</p>
          </div>
        <?php else: ?>
          <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 p-6">
            <?php foreach ($projects as $project): ?>
              <div class="bg-dark-tertiary rounded-lg border border-dark overflow-hidden hover:border-brand-blue transition-colors">
                <?php if ($project['image_url']): ?>
                  <div class="aspect-video bg-dark-primary">
                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>"
                      alt="<?php echo htmlspecialchars($project['title']); ?>"
                      class="w-full h-full object-cover">
                  </div>
                <?php endif; ?>

                <div class="p-6">
                  <div class="flex items-start justify-between mb-3">
                    <div class="flex-1">
                      <h3 class="text-lg font-semibold text-dark-accent mb-1">
                        <?php echo htmlspecialchars($project['title']); ?>
                        <?php if ($project['featured']): ?>
                          <span class="ml-2 px-2 py-1 text-xs bg-yellow-500 text-yellow-900 rounded-full">Featured</span>
                        <?php endif; ?>
                      </h3>
                      <p class="text-sm text-brand-blue mb-2"><?php echo ucfirst($project['category']); ?></p>
                    </div>
                  </div>

                  <p class="text-dark-secondary text-sm mb-4 line-clamp-3">
                    <?php echo htmlspecialchars(truncateText($project['description'], 120)); ?>
                  </p>

                  <?php if ($project['technologies']): ?>
                    <div class="mb-4">
                      <div class="flex flex-wrap gap-1">
                        <?php foreach (explode(',', $project['technologies']) as $tech): ?>
                          <span class="px-2 py-1 text-xs bg-dark-primary text-dark-secondary rounded">
                            <?php echo htmlspecialchars(trim($tech)); ?>
                          </span>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div class="flex items-center justify-between">
                    <div class="text-xs text-dark-secondary">
                      <?php echo formatDateShort($project['created_at']); ?>
                    </div>
                    <div class="flex space-x-2">
                      <?php if ($project['project_url']): ?>
                        <a href="<?php echo htmlspecialchars($project['project_url']); ?>" target="_blank"
                          class="text-brand-blue hover:text-blue-300 text-sm">View</a>
                      <?php endif; ?>
                      <a href="portfolio.php?edit=<?php echo $project['id']; ?>"
                        class="text-green-400 hover:text-green-300 text-sm">Edit</a>
                      <button onclick="toggleFeatured(<?php echo $project['id']; ?>, <?php echo $project['featured'] ? 0 : 1; ?>)"
                        class="text-yellow-400 hover:text-yellow-300 text-sm">
                        <?php echo $project['featured'] ? 'Unfeature' : 'Feature'; ?>
                      </button>
                      <button onclick="deleteProject(<?php echo $project['id']; ?>)"
                        class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
</div>

<!-- Create Project Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="bg-dark-secondary rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
      <div class="p-6 border-b border-dark">
        <h3 class="text-lg font-semibold text-dark-accent">Create New Portfolio Project</h3>
      </div>
      <form method="POST">
        <input type="hidden" name="action" value="create_project">
        <div class="p-6 space-y-6">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Project Title *</label>
              <input type="text" name="title" required
                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                placeholder="Enter project title...">
            </div>
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Category *</label>
              <select name="category" required class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                <option value="">Select Category</option>
                <option value="web">Web Development</option>
                <option value="ecommerce">E-Commerce</option>
                <option value="mobile">Mobile App</option>
                <option value="other">Other</option>
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-dark-accent mb-2">Description *</label>
            <textarea name="description" rows="4" required
              class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
              placeholder="Describe the project and its key features..."></textarea>
          </div>

          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Technologies Used</label>
              <input type="text" name="technologies"
                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                placeholder="Laravel, PHP, MySQL, JavaScript">
            </div>
            <div>
              <label class="block text-sm font-medium text-dark-accent mb-2">Project URL</label>
              <input type="url" name="project_url"
                class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                placeholder="https://example.com">
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-dark-accent mb-2">Image URL</label>
            <input type="url" name="image_url"
              class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
              placeholder="https://example.com/image.jpg">
          </div>

          <div class="flex items-center">
            <input type="checkbox" name="featured" id="createFeatured"
              class="w-4 h-4 text-brand-blue bg-dark-tertiary border-dark rounded focus:ring-brand-blue focus:ring-2">
            <label for="createFeatured" class="ml-2 text-sm text-dark-accent">Featured Project</label>
          </div>
        </div>
        <div class="p-6 border-t border-dark flex justify-end space-x-4">
          <button type="button" onclick="closeModal('createModal')"
            class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
            Cancel
          </button>
          <button type="submit" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-brand-blue-dark">
            Create Project
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

  function toggleFeatured(id, featured) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.innerHTML = `
                <input type="hidden" name="action" value="toggle_featured">
                <input type="hidden" name="id" value="${id}">
                <input type="hidden" name="featured" value="${featured}">
            `;
    document.body.appendChild(form);
    form.submit();
  }

  function deleteProject(id) {
    if (confirm('Are you sure you want to delete this portfolio project? This action cannot be undone.')) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.innerHTML = `
                    <input type="hidden" name="action" value="delete_project">
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
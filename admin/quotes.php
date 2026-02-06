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

    if ($action === 'update_status') {
        $id = (int)$_POST['id'];
        $status = $_POST['status'];
        $notes = $_POST['notes'] ?? '';
        $priority = $_POST['priority'] ?? 'medium';

        try {
            $stmt = $pdo->prepare("UPDATE contact_submissions SET status = ?, notes = ?, priority = ? WHERE id = ?");
            $stmt->execute([$status, $notes, $priority, $id]);

            logActivity($pdo, 'update_quote_status', 'contact_submissions', $id, null, ['status' => $status, 'priority' => $priority]);
            $message = 'Quote updated successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to update quote: ' . $e->getMessage();
        }
    }

    if ($action === 'delete') {
        $id = (int)$_POST['id'];

        try {
            $stmt = $pdo->prepare("DELETE FROM contact_submissions WHERE id = ?");
            $stmt->execute([$id]);

            logActivity($pdo, 'delete_quote', 'contact_submissions', $id);
            $message = 'Quote deleted successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to delete quote: ' . $e->getMessage();
        }
    }
}

// Get filter parameters
$status_filter = $_GET['status'] ?? '';
$priority_filter = $_GET['priority'] ?? '';
$search = $_GET['search'] ?? '';

// Build query
$where_conditions = [];
$params = [];

if ($status_filter) {
    $where_conditions[] = "status = ?";
    $params[] = $status_filter;
}

if ($priority_filter) {
    $where_conditions[] = "priority = ?";
    $params[] = $priority_filter;
}

if ($search) {
    $where_conditions[] = "(name LIKE ? OR email LIKE ? OR company LIKE ? OR message LIKE ?)";
    $search_param = "%$search%";
    $params = array_merge($params, [$search_param, $search_param, $search_param, $search_param]);
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get quotes
try {
    $stmt = $pdo->prepare("
        SELECT * FROM contact_submissions 
        $where_clause 
        ORDER BY 
            CASE priority 
                WHEN 'urgent' THEN 1 
                WHEN 'high' THEN 2 
                WHEN 'medium' THEN 3 
                WHEN 'low' THEN 4 
            END,
            created_at DESC
    ");
    $stmt->execute($params);
    $quotes = $stmt->fetchAll();

    // Get counts for stats
    $stats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_count,
            SUM(CASE WHEN status = 'contacted' THEN 1 ELSE 0 END) as contacted_count,
            SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as in_progress_count,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_count
        FROM contact_submissions
    ")->fetch();
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
    $quotes = [];
    $stats = ['total' => 0, 'new_count' => 0, 'contacted_count' => 0, 'in_progress_count' => 0, 'completed_count' => 0];
}
include 'header.php';
?>

<!-- Main Content -->
<div class="flex-1 p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-dark-accent">Contact Quotes</h1>
            <p class="text-dark-secondary mt-2">Manage client inquiries and project requests</p>
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

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                <p class="text-dark-secondary text-sm">Total</p>
                <p class="text-2xl font-bold text-dark-accent"><?php echo $stats['total']; ?></p>
            </div>
            <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                <p class="text-dark-secondary text-sm">New</p>
                <p class="text-2xl font-bold text-blue-400"><?php echo $stats['new_count']; ?></p>
            </div>
            <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                <p class="text-dark-secondary text-sm">Contacted</p>
                <p class="text-2xl font-bold text-yellow-400"><?php echo $stats['contacted_count']; ?></p>
            </div>
            <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                <p class="text-dark-secondary text-sm">In Progress</p>
                <p class="text-2xl font-bold text-purple-400"><?php echo $stats['in_progress_count']; ?></p>
            </div>
            <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                <p class="text-dark-secondary text-sm">Completed</p>
                <p class="text-2xl font-bold text-green-400"><?php echo $stats['completed_count']; ?></p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-dark-secondary rounded-lg p-6 border border-dark mb-8">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div class="flex-1 min-w-64">
                    <label class="block text-sm font-medium text-dark-accent mb-2">Search</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                        placeholder="Search by name, email, company, or message..."
                        class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                    <select name="status" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        <option value="">All Statuses</option>
                        <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?>>New</option>
                        <option value="contacted" <?php echo $status_filter === 'contacted' ? 'selected' : ''; ?>>Contacted</option>
                        <option value="in_progress" <?php echo $status_filter === 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                        <option value="completed" <?php echo $status_filter === 'completed' ? 'selected' : ''; ?>>Completed</option>
                        <option value="declined" <?php echo $status_filter === 'declined' ? 'selected' : ''; ?>>Declined</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-dark-accent mb-2">Priority</label>
                    <select name="priority" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        <option value="">All Priorities</option>
                        <option value="urgent" <?php echo $priority_filter === 'urgent' ? 'selected' : ''; ?>>Urgent</option>
                        <option value="high" <?php echo $priority_filter === 'high' ? 'selected' : ''; ?>>High</option>
                        <option value="medium" <?php echo $priority_filter === 'medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="low" <?php echo $priority_filter === 'low' ? 'selected' : ''; ?>>Low</option>
                    </select>
                </div>
                <button type="submit" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
                    Filter
                </button>
                <a href="quotes.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    Clear
                </a>
            </form>
        </div>

        <!-- Quotes Table -->
        <div class="bg-dark-secondary rounded-lg border border-dark overflow-hidden">
            <?php if (empty($quotes)): ?>
                <div class="p-8 text-center">
                    <p class="text-dark-secondary">No quotes found matching your criteria.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-dark-tertiary">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Project</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Budget</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Priority</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-dark">
                            <?php foreach ($quotes as $quote): ?>
                                <tr class="hover:bg-dark-tertiary">
                                    <td class="px-6 py-4">
                                        <div>
                                            <div class="text-sm font-medium text-dark-accent"><?php echo htmlspecialchars($quote['name']); ?></div>
                                            <div class="text-sm text-dark-secondary"><?php echo htmlspecialchars($quote['email']); ?></div>
                                            <?php if ($quote['company']): ?>
                                                <div class="text-xs text-dark-secondary"><?php echo htmlspecialchars($quote['company']); ?></div>
                                            <?php endif; ?>
                                            <?php if ($quote['phone']): ?>
                                                <div class="text-xs text-dark-secondary"><?php echo htmlspecialchars($quote['phone']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-dark-accent"><?php echo ucfirst(str_replace('_', ' ', $quote['project_type'] ?? 'website')); ?></div>
                                        <div class="text-xs text-dark-secondary"><?php echo truncateText($quote['message'], 60); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-dark-accent"><?php echo ucfirst(str_replace('_', '-', $quote['budget_range'])); ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full <?php echo getStatusBadgeClass($quote['status']); ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $quote['status'])); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs rounded-full <?php echo getPriorityBadgeClass($quote['priority']); ?>">
                                            <?php echo ucfirst($quote['priority']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-dark-secondary">
                                        <?php echo formatDate($quote['created_at']); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <button onclick="viewQuote(<?php echo $quote['id']; ?>)"
                                                class="text-brand-blue hover:text-blue-300 text-sm">View</button>
                                            <button onclick="editQuote(<?php echo $quote['id']; ?>)"
                                                class="text-green-400 hover:text-green-300 text-sm">Edit</button>
                                            <button onclick="deleteQuote(<?php echo $quote['id']; ?>)"
                                                class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>

<!-- View Quote Modal -->
<div id="viewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-dark-secondary rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="p-6 border-b border-dark">
                <h3 class="text-lg font-semibold text-dark-accent">Quote Details</h3>
            </div>
            <div id="viewContent" class="p-6">
                <!-- Content will be loaded here -->
            </div>
            <div class="p-6 border-t border-dark">
                <button onclick="closeModal('viewModal')" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Quote Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-dark-secondary rounded-lg max-w-2xl w-full">
            <div class="p-6 border-b border-dark">
                <h3 class="text-lg font-semibold text-dark-accent">Edit Quote</h3>
            </div>
            <form id="editForm" method="POST">
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="id" id="editId">
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                        <select name="status" id="editStatus" class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent">
                            <option value="new">New</option>
                            <option value="contacted">Contacted</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="declined">Declined</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Priority</label>
                        <select name="priority" id="editPriority" class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-dark-accent mb-2">Notes</label>
                        <textarea name="notes" id="editNotes" rows="4"
                            class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary"
                            placeholder="Add internal notes..."></textarea>
                    </div>
                </div>
                <div class="p-6 border-t border-dark flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('editModal')"
                        class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                        Cancel
                    </button>
                    <button type="submit" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-brand-blue-dark">
                        Update Quote
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const quotes = <?php echo json_encode($quotes); ?>;

    function viewQuote(id) {
        const quote = quotes.find(q => q.id == id);
        if (!quote) return;

        const content = `
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-medium text-dark-accent">Name</h4>
                            <p class="text-dark-secondary">${quote.name}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Email</h4>
                            <p class="text-dark-secondary">${quote.email}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Phone</h4>
                            <p class="text-dark-secondary">${quote.phone || 'Not provided'}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Company</h4>
                            <p class="text-dark-secondary">${quote.company || 'Not provided'}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Project Type</h4>
                            <p class="text-dark-secondary">${quote.project_type ? quote.project_type.replace('_', ' ') : 'Website'}</p>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Budget Range</h4>
                            <p class="text-dark-secondary">${quote.budget_range ? quote.budget_range.replace('_', '-') : 'Not specified'}</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-medium text-dark-accent">Message</h4>
                        <p class="text-dark-secondary mt-2 whitespace-pre-wrap">${quote.message}</p>
                    </div>
                    ${quote.notes ? `
                    <div>
                        <h4 class="font-medium text-dark-accent">Internal Notes</h4>
                        <p class="text-dark-secondary mt-2 whitespace-pre-wrap">${quote.notes}</p>
                    </div>
                    ` : ''}
                    <div class="grid grid-cols-3 gap-4 pt-4 border-t border-dark">
                        <div>
                            <h4 class="font-medium text-dark-accent">Status</h4>
                            <span class="px-2 py-1 text-xs rounded-full ${getStatusBadgeClass(quote.status)}">${quote.status.replace('_', ' ')}</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Priority</h4>
                            <span class="px-2 py-1 text-xs rounded-full ${getPriorityBadgeClass(quote.priority)}">${quote.priority}</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-dark-accent">Date</h4>
                            <p class="text-dark-secondary">${new Date(quote.created_at).toLocaleDateString()}</p>
                        </div>
                    </div>
                </div>
            `;

        document.getElementById('viewContent').innerHTML = content;
        document.getElementById('viewModal').classList.remove('hidden');
    }

    function editQuote(id) {
        const quote = quotes.find(q => q.id == id);
        if (!quote) return;

        document.getElementById('editId').value = quote.id;
        document.getElementById('editStatus').value = quote.status;
        document.getElementById('editPriority').value = quote.priority;
        document.getElementById('editNotes').value = quote.notes || '';

        document.getElementById('editModal').classList.remove('hidden');
    }

    function deleteQuote(id) {
        if (confirm('Are you sure you want to delete this quote? This action cannot be undone.')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="${id}">
                `;
            document.body.appendChild(form);
            form.submit();
        }
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function getStatusBadgeClass(status) {
        const classes = {
            'new': 'bg-blue-100 text-blue-800',
            'contacted': 'bg-yellow-100 text-yellow-800',
            'in_progress': 'bg-purple-100 text-purple-800',
            'completed': 'bg-green-100 text-green-800',
            'declined': 'bg-red-100 text-red-800'
        };
        return classes[status] || 'bg-gray-100 text-gray-800';
    }

    function getPriorityBadgeClass(priority) {
        const classes = {
            'urgent': 'bg-red-100 text-red-800',
            'high': 'bg-orange-100 text-orange-800',
            'medium': 'bg-yellow-100 text-yellow-800',
            'low': 'bg-green-100 text-green-800'
        };
        return classes[priority] || 'bg-gray-100 text-gray-800';
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
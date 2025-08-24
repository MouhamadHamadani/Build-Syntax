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
        
        try {
            $updateData = ['status' => $status];
            if ($status === 'unsubscribed') {
                $updateData['unsubscribed_at'] = date('Y-m-d H:i:s');
            }
            
            $stmt = $pdo->prepare("UPDATE newsletter_subscriptions SET status = ?, unsubscribed_at = ? WHERE id = ?");
            $stmt->execute([$status, $updateData['unsubscribed_at'] ?? null, $id]);
            
            logActivity($pdo, 'update_newsletter_status', 'newsletter_subscriptions', $id, null, $updateData);
            $message = 'Subscription updated successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to update subscription: ' . $e->getMessage();
        }
    }
    
    if ($action === 'delete') {
        $id = (int)$_POST['id'];
        
        try {
            $stmt = $pdo->prepare("DELETE FROM newsletter_subscriptions WHERE id = ?");
            $stmt->execute([$id]);
            
            logActivity($pdo, 'delete_newsletter_subscription', 'newsletter_subscriptions', $id);
            $message = 'Subscription deleted successfully!';
        } catch (PDOException $e) {
            $error = 'Failed to delete subscription: ' . $e->getMessage();
        }
    }
    
    if ($action === 'add_subscriber') {
        $email = trim($_POST['email']);
        $name = trim($_POST['name']);
        
        if (!validateEmail($email)) {
            $error = 'Please enter a valid email address.';
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO newsletter_subscriptions (email, name, status, confirmed) VALUES (?, ?, 'active', 1)");
                $stmt->execute([$email, $name]);
                
                logActivity($pdo, 'add_newsletter_subscriber', 'newsletter_subscriptions', $pdo->lastInsertId(), null, ['email' => $email, 'name' => $name]);
                $message = 'Subscriber added successfully!';
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) { // Duplicate entry
                    $error = 'This email is already subscribed.';
                } else {
                    $error = 'Failed to add subscriber: ' . $e->getMessage();
                }
            }
        }
    }
    
    if ($action === 'export_csv') {
        try {
            $stmt = $pdo->query("SELECT email, name, status, subscribed_at FROM newsletter_subscriptions ORDER BY subscribed_at DESC");
            $subscribers = $stmt->fetchAll();
            
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="newsletter_subscribers_' . date('Y-m-d') . '.csv"');
            
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Email', 'Name', 'Status', 'Subscribed Date']);
            
            foreach ($subscribers as $subscriber) {
                fputcsv($output, [
                    $subscriber['email'],
                    $subscriber['name'] ?: '',
                    $subscriber['status'],
                    $subscriber['subscribed_at']
                ]);
            }
            
            fclose($output);
            logActivity($pdo, 'export_newsletter_csv', 'newsletter_subscriptions');
            exit;
        } catch (PDOException $e) {
            $error = 'Failed to export data: ' . $e->getMessage();
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
    $where_conditions[] = "(email LIKE ? OR name LIKE ?)";
    $search_param = "%$search%";
    $params = array_merge($params, [$search_param, $search_param]);
}

$where_clause = $where_conditions ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get subscriptions
try {
    $stmt = $pdo->prepare("
        SELECT * FROM newsletter_subscriptions 
        $where_clause 
        ORDER BY subscribed_at DESC
    ");
    $stmt->execute($params);
    $subscriptions = $stmt->fetchAll();
    
    // Get counts for stats
    $stats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN status = 'unsubscribed' THEN 1 ELSE 0 END) as unsubscribed_count,
            SUM(CASE WHEN status = 'bounced' THEN 1 ELSE 0 END) as bounced_count,
            SUM(CASE WHEN DATE(subscribed_at) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM newsletter_subscriptions
    ")->fetch();
    
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
    $subscriptions = [];
    $stats = ['total' => 0, 'active_count' => 0, 'unsubscribed_count' => 0, 'bounced_count' => 0, 'today_count' => 0];
}
include 'header.php';
?>


        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-dark-accent">Newsletter Subscriptions</h1>
                    <p class="text-dark-secondary mt-2">Manage your newsletter subscribers and email campaigns</p>
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
                        <p class="text-dark-secondary text-sm">Active</p>
                        <p class="text-2xl font-bold text-green-400"><?php echo $stats['active_count']; ?></p>
                    </div>
                    <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                        <p class="text-dark-secondary text-sm">Unsubscribed</p>
                        <p class="text-2xl font-bold text-red-400"><?php echo $stats['unsubscribed_count']; ?></p>
                    </div>
                    <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                        <p class="text-dark-secondary text-sm">Bounced</p>
                        <p class="text-2xl font-bold text-yellow-400"><?php echo $stats['bounced_count']; ?></p>
                    </div>
                    <div class="bg-dark-secondary rounded-lg p-4 border border-dark">
                        <p class="text-dark-secondary text-sm">Today</p>
                        <p class="text-2xl font-bold text-blue-400"><?php echo $stats['today_count']; ?></p>
                    </div>
                </div>

                <!-- Actions Bar -->
                <div class="flex flex-wrap gap-4 mb-8">
                    <button onclick="showAddModal()" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
                        Add Subscriber
                    </button>
                    <form method="POST" class="inline">
                        <input type="hidden" name="action" value="export_csv">
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Export CSV
                        </button>
                    </form>
                </div>

                <!-- Filters -->
                <div class="bg-dark-secondary rounded-lg p-6 border border-dark mb-8">
                    <form method="GET" class="flex flex-wrap gap-4 items-end">
                        <div class="flex-1 min-w-64">
                            <label class="block text-sm font-medium text-dark-accent mb-2">Search</label>
                            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                                   placeholder="Search by email or name..."
                                   class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                            <select name="status" class="px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                                <option value="">All Statuses</option>
                                <option value="active" <?php echo $status_filter === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="unsubscribed" <?php echo $status_filter === 'unsubscribed' ? 'selected' : ''; ?>>Unsubscribed</option>
                                <option value="bounced" <?php echo $status_filter === 'bounced' ? 'selected' : ''; ?>>Bounced</option>
                            </select>
                        </div>
                        <button type="submit" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors">
                            Filter
                        </button>
                        <a href="newsletter.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                            Clear
                        </a>
                    </form>
                </div>

                <!-- Subscriptions Table -->
                <div class="bg-dark-secondary rounded-lg border border-dark overflow-hidden">
                    <?php if (empty($subscriptions)): ?>
                        <div class="p-8 text-center">
                            <p class="text-dark-secondary">No subscriptions found matching your criteria.</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-dark-tertiary">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Subscriber</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Source</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Subscribed</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-secondary uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-dark">
                                    <?php foreach ($subscriptions as $subscription): ?>
                                        <tr class="hover:bg-dark-tertiary">
                                            <td class="px-6 py-4">
                                                <div>
                                                    <div class="text-sm font-medium text-dark-accent"><?php echo htmlspecialchars($subscription['email']); ?></div>
                                                    <?php if ($subscription['name']): ?>
                                                        <div class="text-sm text-dark-secondary"><?php echo htmlspecialchars($subscription['name']); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="px-2 py-1 text-xs rounded-full <?php echo getStatusBadgeClass($subscription['status']); ?>">
                                                    <?php echo ucfirst($subscription['status']); ?>
                                                </span>
                                                <?php if (!$subscription['confirmed']): ?>
                                                    <span class="ml-2 px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Unconfirmed</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-dark-secondary">
                                                <?php echo ucfirst($subscription['source']); ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-dark-secondary">
                                                <?php echo formatDateShort($subscription['subscribed_at']); ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex space-x-2">
                                                    <button onclick="editSubscription(<?php echo $subscription['id']; ?>)" 
                                                            class="text-green-400 hover:text-green-300 text-sm">Edit</button>
                                                    <button onclick="deleteSubscription(<?php echo $subscription['id']; ?>)" 
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

    <!-- Add Subscriber Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-dark-secondary rounded-lg max-w-md w-full">
                <div class="p-6 border-b border-dark">
                    <h3 class="text-lg font-semibold text-dark-accent">Add New Subscriber</h3>
                </div>
                <form method="POST">
                    <input type="hidden" name="action" value="add_subscriber">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Email *</label>
                            <input type="email" name="email" required
                                   class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                                   placeholder="subscriber@example.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Name (Optional)</label>
                            <input type="text" name="name"
                                   class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent placeholder-dark-secondary focus:ring-2 focus:ring-brand-blue focus:border-transparent"
                                   placeholder="Subscriber Name">
                        </div>
                    </div>
                    <div class="p-6 border-t border-dark flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('addModal')" 
                                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-brand-blue-dark">
                            Add Subscriber
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Subscription Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-dark-secondary rounded-lg max-w-md w-full">
                <div class="p-6 border-b border-dark">
                    <h3 class="text-lg font-semibold text-dark-accent">Edit Subscription</h3>
                </div>
                <form method="POST">
                    <input type="hidden" name="action" value="update_status">
                    <input type="hidden" name="id" id="editId">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Email</label>
                            <input type="email" id="editEmail" readonly
                                   class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-secondary">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-dark-accent mb-2">Status</label>
                            <select name="status" id="editStatus" class="w-full px-4 py-2 bg-dark-tertiary border border-dark rounded-lg text-dark-accent">
                                <option value="active">Active</option>
                                <option value="unsubscribed">Unsubscribed</option>
                                <option value="bounced">Bounced</option>
                            </select>
                        </div>
                    </div>
                    <div class="p-6 border-t border-dark flex justify-end space-x-4">
                        <button type="button" onclick="closeModal('editModal')" 
                                class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                            Cancel
                        </button>
                        <button type="submit" class="bg-brand-blue text-white px-4 py-2 rounded-lg hover:bg-brand-blue-dark">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const subscriptions = <?php echo json_encode($subscriptions); ?>;

        function showAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
        }

        function editSubscription(id) {
            const subscription = subscriptions.find(s => s.id == id);
            if (!subscription) return;

            document.getElementById('editId').value = subscription.id;
            document.getElementById('editEmail').value = subscription.email;
            document.getElementById('editStatus').value = subscription.status;
            
            document.getElementById('editModal').classList.remove('hidden');
        }

        function deleteSubscription(id) {
            if (confirm('Are you sure you want to delete this subscription? This action cannot be undone.')) {
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

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('fixed')) {
                e.target.classList.add('hidden');
            }
        });
    </script>
</body>
</html>


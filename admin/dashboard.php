<?php
require_once 'auth.php';
require_once '../includes/config.php';
requireAdmin();

// Get dashboard statistics
try {
    $pdo = getDBConnection();
    // Contact submissions stats
    $contactStats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_count,
            SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as in_progress,
            SUM(CASE WHEN DATE(created_at) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM contact_submissions
    ")->fetch();

    // Newsletter stats
    $newsletterStats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN DATE(subscribed_at) = CURDATE() THEN 1 ELSE 0 END) as today_count
        FROM newsletter_subscriptions
    ")->fetch();

    // Blog stats
    $blogStats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            SUM(CASE WHEN published = 1 THEN 1 ELSE 0 END) as published_count,
            SUM(CASE WHEN published = 0 THEN 1 ELSE 0 END) as draft_count
        FROM blog_posts
    ")->fetch();

    // Recent activities
    $recentContacts = $pdo->query("
        SELECT name, email, company, created_at, status, priority 
        FROM contact_submissions 
        ORDER BY created_at DESC 
        LIMIT 5
    ")->fetchAll();

    $recentSubscriptions = $pdo->query("
        SELECT email, name, subscribed_at, status 
        FROM newsletter_subscriptions 
        ORDER BY subscribed_at DESC 
        LIMIT 5
    ")->fetchAll();

} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}

include 'header.php';
?>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-dark-accent">Dashboard</h1>
                    <p class="text-dark-secondary mt-2">Welcome to your Build Syntax admin panel</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Contact Quotes -->
                    <div class="bg-dark-secondary rounded-lg p-6 border border-dark">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-dark-secondary text-sm font-medium">Contact Quotes</p>
                                <p class="text-2xl font-bold text-dark-accent"><?php echo $contactStats['total']; ?></p>
                                <p class="text-xs text-dark-secondary mt-1">
                                    <?php echo $contactStats['new_count']; ?> new, <?php echo $contactStats['today_count']; ?> today
                                </p>
                            </div>
                            <div class="bg-blue-500 bg-opacity-20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter Subscribers -->
                    <div class="bg-dark-secondary rounded-lg p-6 border border-dark">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-dark-secondary text-sm font-medium">Newsletter</p>
                                <p class="text-2xl font-bold text-dark-accent"><?php echo $newsletterStats['total']; ?></p>
                                <p class="text-xs text-dark-secondary mt-1">
                                    <?php echo $newsletterStats['active_count']; ?> active, <?php echo $newsletterStats['today_count']; ?> today
                                </p>
                            </div>
                            <div class="bg-green-500 bg-opacity-20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Blog Posts -->
                    <div class="bg-dark-secondary rounded-lg p-6 border border-dark">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-dark-secondary text-sm font-medium">Blog Posts</p>
                                <p class="text-2xl font-bold text-dark-accent"><?php echo $blogStats['total']; ?></p>
                                <p class="text-xs text-dark-secondary mt-1">
                                    <?php echo $blogStats['published_count']; ?> published, <?php echo $blogStats['draft_count']; ?> drafts
                                </p>
                            </div>
                            <div class="bg-purple-500 bg-opacity-20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- In Progress -->
                    <div class="bg-dark-secondary rounded-lg p-6 border border-dark">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-dark-secondary text-sm font-medium">In Progress</p>
                                <p class="text-2xl font-bold text-dark-accent"><?php echo $contactStats['in_progress']; ?></p>
                                <p class="text-xs text-dark-secondary mt-1">Active projects</p>
                            </div>
                            <div class="bg-orange-500 bg-opacity-20 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Recent Contact Quotes -->
                    <div class="bg-dark-secondary rounded-lg border border-dark">
                        <div class="p-6 border-b border-dark">
                            <h3 class="text-lg font-semibold text-dark-accent">Recent Contact Quotes</h3>
                        </div>
                        <div class="p-6">
                            <?php if (empty($recentContacts)): ?>
                                <p class="text-dark-secondary text-center py-4">No contact submissions yet</p>
                            <?php else: ?>
                                <div class="space-y-4">
                                    <?php foreach ($recentContacts as $contact): ?>
                                        <div class="flex items-center justify-between p-4 bg-dark-tertiary rounded-lg">
                                            <div class="flex-1">
                                                <h4 class="font-medium text-dark-accent"><?php echo htmlspecialchars($contact['name']); ?></h4>
                                                <p class="text-sm text-dark-secondary"><?php echo htmlspecialchars($contact['company'] ?: $contact['email']); ?></p>
                                                <p class="text-xs text-dark-secondary"><?php echo formatDate($contact['created_at']); ?></p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="px-2 py-1 text-xs rounded-full <?php echo getStatusBadgeClass($contact['status']); ?>">
                                                    <?php echo ucfirst($contact['status']); ?>
                                                </span>
                                                <span class="px-2 py-1 text-xs rounded-full <?php echo getPriorityBadgeClass($contact['priority']); ?>">
                                                    <?php echo ucfirst($contact['priority']); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="quotes.php" class="text-brand-blue hover:underline text-sm">View all quotes →</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Recent Newsletter Subscriptions -->
                    <div class="bg-dark-secondary rounded-lg border border-dark">
                        <div class="p-6 border-b border-dark">
                            <h3 class="text-lg font-semibold text-dark-accent">Recent Newsletter Subscriptions</h3>
                        </div>
                        <div class="p-6">
                            <?php if (empty($recentSubscriptions)): ?>
                                <p class="text-dark-secondary text-center py-4">No newsletter subscriptions yet</p>
                            <?php else: ?>
                                <div class="space-y-4">
                                    <?php foreach ($recentSubscriptions as $subscription): ?>
                                        <div class="flex items-center justify-between p-4 bg-dark-tertiary rounded-lg">
                                            <div class="flex-1">
                                                <h4 class="font-medium text-dark-accent"><?php echo htmlspecialchars($subscription['name'] ?: 'Anonymous'); ?></h4>
                                                <p class="text-sm text-dark-secondary"><?php echo htmlspecialchars($subscription['email']); ?></p>
                                                <p class="text-xs text-dark-secondary"><?php echo formatDate($subscription['subscribed_at']); ?></p>
                                            </div>
                                            <span class="px-2 py-1 text-xs rounded-full <?php echo getStatusBadgeClass($subscription['status']); ?>">
                                                <?php echo ucfirst($subscription['status']); ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="mt-4 text-center">
                                    <a href="newsletter.php" class="text-brand-blue hover:underline text-sm">View all subscriptions →</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


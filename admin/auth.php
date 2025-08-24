<?php
// Admin authentication helper functions

function requireAdmin() {
    session_start();
    
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit;
    }
}

function requireRole($requiredRole = 'admin') {
    requireAdmin();
    
    if ($_SESSION['admin_role'] !== 'admin' && $_SESSION['admin_role'] !== $requiredRole) {
        header('Location: dashboard.php?error=insufficient_permissions');
        exit;
    }
}

function logActivity($pdo, $action, $tableName = null, $recordId = null, $oldValues = null, $newValues = null) {
    try {
        $stmt = $pdo->prepare("
            INSERT INTO admin_activity_log (admin_id, action, table_name, record_id, old_values, new_values, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $_SESSION['admin_id'],
            $action,
            $tableName,
            $recordId,
            $oldValues ? json_encode($oldValues) : null,
            $newValues ? json_encode($newValues) : null,
            $_SERVER['REMOTE_ADDR'],
            $_SERVER['HTTP_USER_AGENT']
        ]);
    } catch (PDOException $e) {
        // Log error but don't break the application
        error_log("Failed to log admin activity: " . $e->getMessage());
    }
}

function getAdminName() {
    return $_SESSION['admin_name'] ?? 'Admin';
}

function getAdminRole() {
    return $_SESSION['admin_role'] ?? 'admin';
}

function isAdmin() {
    return isset($_SESSION['admin_role']) && $_SESSION['admin_role'] === 'admin';
}

function formatDate($date) {
    return date('M j, Y g:i A', strtotime($date));
}

function formatDateShort($date) {
    return date('M j, Y', strtotime($date));
}

function truncateText($text, $length = 100) {
    return strlen($text) > $length ? substr($text, 0, $length) . '...' : $text;
}

function generateSlug($text) {
    // Convert to lowercase
    $text = strtolower($text);
    
    // Replace spaces and special characters with hyphens
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    
    // Remove leading/trailing hyphens
    $text = trim($text, '-');
    
    return $text;
}

// function sanitizeInput($input) {
//     return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
// }

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function getStatusBadgeClass($status) {
    switch ($status) {
        case 'new':
            return 'bg-blue-100 text-blue-800';
        case 'contacted':
            return 'bg-yellow-100 text-yellow-800';
        case 'in_progress':
            return 'bg-purple-100 text-purple-800';
        case 'completed':
            return 'bg-green-100 text-green-800';
        case 'declined':
            return 'bg-red-100 text-red-800';
        case 'active':
            return 'bg-green-100 text-green-800';
        case 'unsubscribed':
            return 'bg-gray-100 text-gray-800';
        case 'published':
            return 'bg-green-100 text-green-800';
        case 'draft':
            return 'bg-yellow-100 text-yellow-800';
        case 'archived':
            return 'bg-gray-100 text-gray-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}

function getPriorityBadgeClass($priority) {
    switch ($priority) {
        case 'urgent':
            return 'bg-red-100 text-red-800';
        case 'high':
            return 'bg-orange-100 text-orange-800';
        case 'medium':
            return 'bg-yellow-100 text-yellow-800';
        case 'low':
            return 'bg-green-100 text-green-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}
?>


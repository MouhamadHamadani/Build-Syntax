<?php
session_start();
require_once '../includes/config.php';
$pdo = getDBConnection();

// Log logout activity if user is logged in
if (isset($_SESSION['admin_id'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, ip_address, user_agent) VALUES (?, 'logout', ?, ?)");
        $stmt->execute([$_SESSION['admin_id'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']]);
    } catch (PDOException $e) {
        // Continue with logout even if logging fails
    }
}

// Destroy session
session_destroy();

// Redirect to login page
header('Location: index.php?logged_out=1');
exit;
?>


<?php
session_start();
require_once '../includes/config.php';
$pdo = getDBConnection();

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_POST) {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        try {
            $stmt = $pdo->prepare("SELECT id, username, email, password_hash, full_name, role, is_active FROM admin_users WHERE username = ? AND is_active = 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                // Update last login
                $updateStmt = $pdo->prepare("UPDATE admin_users SET last_login = NOW() WHERE id = ?");
                $updateStmt->execute([$admin['id']]);

                // Set session variables
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_email'] = $admin['email'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_role'] = $admin['role'];

                // Log activity
                $logStmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, ip_address, user_agent) VALUES (?, 'login', ?, ?)");
                $logStmt->execute([$admin['id'], $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']]);

                header('Location: dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        } catch (PDOException $e) {
            $error = 'Database error occurred';
        }
    } else {
        $error = 'Please fill in all fields';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Build Syntax</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .bg-dark-primary {
            background-color: #0F0F23;
        }

        .bg-dark-secondary {
            background-color: #1A1A2E;
        }

        .bg-dark-tertiary {
            background-color: #16213E;
        }

        .text-dark-primary {
            color: #E5E7EB;
        }

        .text-dark-secondary {
            color: #9CA3AF;
        }

        .text-dark-accent {
            color: #F3F4F6;
        }

        .border-dark {
            border-color: #374151;
        }

        .bg-brand-blue {
            background-color: #4A90E2;
        }

        .text-brand-blue {
            color: #4A90E2;
        }

        .hover\:bg-brand-blue-dark:hover {
            background-color: #357ABD;
        }
    </style>
</head>

<body class="bg-dark-primary text-dark-primary min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="bg-dark-secondary rounded-lg shadow-xl p-8 border border-dark">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="../assets/images/icon.png" alt="Build Syntax" class="h-12 w-12">
                    <div>
                        <h1 class="text-2xl font-bold text-dark-accent">Build Syntax</h1>
                        <p class="text-sm text-dark-secondary">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Login Form -->
            <form method="POST" class="space-y-6">
                <?php if ($error): ?>
                    <div class="bg-red-500 bg-opacity-10 border border-red-500 text-red-400 px-4 py-3 rounded-lg">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <div>
                    <label for="username" class="block text-sm font-medium text-dark-accent mb-2">Username</label>
                    <input type="text" id="username" name="username" required
                        class="w-full px-4 py-3 bg-dark-tertiary border border-dark rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-transparent text-dark-accent placeholder-dark-secondary"
                        placeholder="Enter your username"
                        value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-dark-accent mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 bg-dark-tertiary border border-dark rounded-lg focus:ring-2 focus:ring-brand-blue focus:border-transparent text-dark-accent placeholder-dark-secondary"
                        placeholder="Enter your password">
                </div>

                <button type="submit"
                    class="w-full bg-brand-blue text-white py-3 px-4 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-medium">
                    Sign In
                </button>
            </form>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-xs text-dark-secondary">
                    &copy; 2025 Build Syntax All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Build Syntax Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        /* Mobile sidebar overlay */
        .sidebar-overlay {
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Responsive table styles */
        @media (max-width: 768px) {
            .responsive-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .responsive-card {
                display: block !important;
            }
            
            .responsive-card .table-row {
                display: block;
                border: 1px solid #374151;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                padding: 1rem;
                background-color: #1A1A2E;
            }
            
            .responsive-card .table-cell {
                display: block;
                text-align: left !important;
                padding: 0.25rem 0;
                border: none;
            }
            
            .responsive-card .table-cell:before {
                content: attr(data-label) ": ";
                font-weight: 600;
                color: #9CA3AF;
                display: inline-block;
                width: 100px;
            }
            
            .responsive-card .table-header {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-dark-primary text-dark-primary">
    <!-- Mobile sidebar overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-40 sidebar-overlay hidden lg:hidden"></div>
    
    <!-- Navigation -->
    <nav class="bg-dark-secondary border-b border-dark relative z-50">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-btn" class="lg:hidden mr-3 p-2 rounded-md text-dark-secondary hover:text-dark-accent hover:bg-dark-tertiary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    
                    <img src="../assets/images/icon.png" alt="Build Syntax" class="h-8 w-8">
                    <span class="ml-3 text-lg lg:text-xl font-bold text-dark-accent">Build Syntax Admin</span>
                </div>
                <div class="flex items-center space-x-2 lg:space-x-4">
                    <span class="text-dark-secondary text-sm lg:text-base hidden sm:block">Welcome, <?php echo getAdminName(); ?></span>
                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 lg:px-4 rounded-lg text-xs lg:text-sm transition-colors">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-dark-secondary min-h-screen border-r border-dark transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
            <!-- Close button for mobile -->
            <div class="lg:hidden flex justify-end p-4">
                <button id="close-sidebar" class="p-2 rounded-md text-dark-secondary hover:text-dark-accent hover:bg-dark-tertiary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <nav class="mt-4 lg:mt-8">
                <div class="px-4 space-y-2">
                    <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-brand-blue text-white' : 'text-dark-secondary'; ?> flex items-center px-4 py-3 rounded-lg hover:text-dark-accent hover:bg-dark-tertiary transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                        </svg>
                        Dashboard
                    </a>
                    <a href="quotes.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'quotes.php' ? 'bg-brand-blue text-white' : 'text-dark-secondary'; ?> hover:text-dark-accent hover:bg-dark-tertiary flex items-center px-4 py-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Contact Quotes
                    </a>
                    <a href="newsletter.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'newsletter.php' ? 'bg-brand-blue text-white' : 'text-dark-secondary'; ?> hover:text-dark-accent hover:bg-dark-tertiary flex items-center px-4 py-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Newsletter
                    </a>
                    <a href="blog.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'bg-brand-blue text-white' : 'text-dark-secondary'; ?> hover:text-dark-accent hover:bg-dark-tertiary flex items-center px-4 py-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15" />
                        </svg>
                        Blog Posts
                    </a>
                    <a href="portfolio.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'bg-brand-blue text-white' : 'text-dark-secondary'; ?> hover:text-dark-accent hover:bg-dark-tertiary flex items-center px-4 py-3 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7a2 2 0 0 1 2-2h3l2 2h9a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7z" />
                        </svg>
                        Portfolio
                    </a>
                </div>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 lg:ml-0">
            <div class="p-4 lg:p-8">

<script>
$(document).ready(function() {
    // Mobile sidebar toggle
    $('#mobile-menu-btn').click(function() {
        $('#sidebar').removeClass('-translate-x-full');
        $('#sidebar-overlay').removeClass('hidden');
    });
    
    // Close sidebar
    $('#close-sidebar, #sidebar-overlay').click(function() {
        $('#sidebar').addClass('-translate-x-full');
        $('#sidebar-overlay').addClass('hidden');
    });
    
    // Close sidebar when clicking on navigation links (mobile)
    $('#sidebar a').click(function() {
        if (window.innerWidth < 1024) {
            $('#sidebar').addClass('-translate-x-full');
            $('#sidebar-overlay').addClass('hidden');
        }
    });
    
    // Handle window resize
    $(window).resize(function() {
        if (window.innerWidth >= 1024) {
            $('#sidebar').removeClass('-translate-x-full');
            $('#sidebar-overlay').addClass('hidden');
        }
    });
});
</script>


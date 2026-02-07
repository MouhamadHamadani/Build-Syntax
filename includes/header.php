<?php
if (!defined('SITE_NAME')) {
    require_once 'config.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME . ': ' . SITE_TAGLINE; ?></title>
    <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Build Syntax is a Beirut-based development partner dedicated to transforming your ideas into powerful, modern, and reliable websites and applications.'; ?>">

    <?php if (isset($social_meta)) { ?>
        <meta property="og:title" content="<?= $meta_title ?>" />
        <meta property="og:description" content="<?= $meta_description ?>" />
        
        <!-- Twitter -->
        <meta name="twitter:title" content="<?= $meta_title ?>">
        <meta name="twitter:description" content="<?= $meta_description ?>">
    <?php } ?>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- jQuery via CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Custom Font (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/images/icon.png">

    <style>
        /* Applying the custom font */
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Simple scroll-behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Custom brand colors from Build Syntax logo */
        .bg-brand-blue {
            background-color: #347dbe;
        }

        .hover\:bg-brand-blue:hover {
            background-color: #347dbe;
        }

        .text-brand-blue {
            color: #347dbe !important;
        }

        .border-brand-blue {
            border-color: #347dbe;
        }

        .hover\:bg-brand-blue-dark:hover {
            background-color: #357ABD;
        }

        .hover\:text-brand-blue:hover {
            color: #357ABD;
        }

        .from-brand-blue {
            --tw-gradient-from: #347dbe var(--tw-gradient-from-position);
            --tw-gradient-to: rgb(59 130 246 / 0) var(--tw-gradient-to-position);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to);
        }

        .to-brand-gray {
            --tw-gradient-to: #4c4c4c var(--tw-gradient-to-position);
        }

        /* Dark mode color overrides */
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

        /* Custom animations */
        .fade-in {
            animation: fadeIn 0.6s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header shadow on scroll */
        /* .header-scrolled {
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        } */

        /* Header shadow on scroll - Dark mode */
        .header-scrolled {
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
        }

        /* Dark mode specific styles */
        .card-dark {
            background: linear-gradient(135deg, #1A1A2E 0%, #16213E 100%);
            border: 1px solid #374151;
        }

        .card-dark:hover {
            border-color: #4A90E2;
            box-shadow: 0 10px 25px rgba(74, 144, 226, 0.1);
        }

        /* Gradient backgrounds for dark mode */
        .gradient-dark-blue {
            background: linear-gradient(135deg, #0F0F23 0%, #1A1A2E 50%, #16213E 100%);
        }

        .gradient-hero-dark {
            background: linear-gradient(135deg, #0F0F23 0%, #1A1A2E 100%);
        }
    </style>
</head>

<body class="bg-gray-500 text-gray-800">

    <!-- =========== Header =========== -->
    <header id="header" class="bg-dark-secondary fixed w-full top-0 z-50 transition-all duration-300">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3">
                <img src="../assets/images/icon.png" alt="Build Syntax Icon" class="h-10 w-10">
                <div class="flex flex-col">
                    <span class="text-xl font-bold text-brand-blue">Build <span class="text-[#4c4c4c]">Syntax</span> <span class="text-white">BETA</span></span>
                    <span class="text-xs text-gray-500 hidden sm:block">Your Vision, Our Code</span>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-brand-blue font-medium' : ''; ?>">Home</a>
                <a href="/services.php" class="text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-brand-blue font-medium' : ''; ?>">Services</a>
                <a href="/portfolio.php" class="text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'text-brand-blue font-medium' : ''; ?>">Portfolio</a>
                <a href="/about.php" class="text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'text-brand-blue font-medium' : ''; ?>">About</a>
                <a href="/blog.php" class="text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'text-brand-blue font-medium' : ''; ?>">Blog</a>
                <a href="/contact.php" class="bg-brand-blue text-white px-6 py-2 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 shadow-md">Get a Free Quote</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-dark-primary focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden dark-primary border-t border-gray-200">
            <div class="px-6 py-4 space-y-3">
                <a href="/" class="block py-2 text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-brand-blue font-medium' : ''; ?>">Home</a>
                <a href="/services.php" class="block py-2 text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'text-brand-blue font-medium' : ''; ?>">Services</a>
                <a href="/portfolio.php" class="block py-2 text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'text-brand-blue font-medium' : ''; ?>">Portfolio</a>
                <a href="/about.php" class="block py-2 text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'text-brand-blue font-medium' : ''; ?>">About</a>
                <a href="/blog.php" class="block py-2 text-dark-secondary hover:text-brand-blue transition-colors duration-200 <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'text-brand-blue font-medium' : ''; ?>">Blog</a>
                <a href="/contact.php" class="block mt-3 bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors">Get a Free Quote</a>
            </div>
        </div>
    </header>
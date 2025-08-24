<?php
$page_title = "Blog";
$page_description = "Read our latest insights on web development, technology trends, and business growth strategies.";
require_once '../includes/header.php';
require_once '../includes/config.php';

// Fetch blog posts from database
$posts = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->query("SELECT * FROM blog_posts WHERE published = 1 ORDER BY created_at DESC");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    // Fallback to static data if database is not available
    $posts = [
        [
            'id' => 1,
            'title' => 'Why Your Business Needs a Professional Website in 2025',
            'slug' => 'why-business-needs-professional-website-2025',
            'excerpt' => 'In today\'s digital landscape, a professional website is not just an option—it\'s a necessity for business success.',
            'created_at' => '2025-08-15 10:00:00'
        ],
        [
            'id' => 2,
            'title' => 'The Power of E-Commerce: Transforming Lebanese Businesses',
            'slug' => 'power-ecommerce-transforming-lebanese-businesses',
            'excerpt' => 'E-commerce is revolutionizing how Lebanese businesses reach customers and drive growth in challenging economic times.',
            'created_at' => '2025-08-10 14:30:00'
        ]
    ];
}

// Handle form submission
$message_sent = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_newsletter'])) {
    // Sanitize and validate input
    $email = sanitizeInput($_POST['email'] ?? '');

    // Validation
    if (empty($email)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!isValidEmail($email)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // Try to save to database
        try {
            $pdo = getDBConnection();

            if ($pdo) {
                $stmt = $pdo->prepare("INSERT INTO newsletter_subscriptions (email) VALUES (?)");
                $stmt->execute([$email]);
                $message_sent = true;

                // In a real application, you would also send an email notification here
                // mail(CONTACT_EMAIL, "New Contact Form Submission", $message, "From: $email");
            } else {
                $error_message = 'Sorry, there was a technical issue. Please try again later.';
            }
        } catch (Exception $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation (duplicate entry)
                $error_message = 'This email is already subscribed.';
            } else {
                $error_message = 'Sorry, there was a technical issue. Please try again later.';
            }
        }
    }
}
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in">Our Blog</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                Insights, tips, and trends in web development, technology, and business growth.
            </p>
        </div>
    </section>

    <!-- =========== Featured Post =========== -->
    <?php if (!empty($posts)): ?>
        <section class="py-20 bg-dark-secondary">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12 fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Featured Article</h2>
                    <p class="text-dark-secondary text-lg">Our latest insights on web development and business growth.</p>
                </div>
                <div class="max-w-4xl mx-auto">
                    <?php $featured_post = $posts[0]; ?>
                    <article class="card-dark rounded-xl overflow-hidden shadow-lg fade-in">
                        <div class="h-64 bg-gradient-to-br from-brand-blue to-blue-600 flex items-center justify-center">
                            <svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="p-8">
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <?php echo date('F j, Y', strtotime($featured_post['created_at'])); ?>
                            </div>
                            <h2 class="text-2xl md:text-3xl font-bold text-dark-accent mb-4"><?php echo htmlspecialchars($featured_post['title']); ?></h2>
                            <p class="text-dark-secondary text-lg leading-relaxed mb-6"><?php echo htmlspecialchars($featured_post['excerpt']); ?></p>
                            <a href="blog-post.php?slug=<?php echo urlencode($featured_post['slug']); ?>"
                                class="inline-flex items-center text-brand-blue font-semibold hover:text-brand-blue-dark transition-colors">
                                Read Full Article
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- =========== Blog Posts Grid =========== -->
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Latest Articles</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Stay updated with our latest thoughts on web development, technology, and business growth.</p>
            </div>

            <?php if (!empty($posts)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php foreach (array_slice($posts, 1) as $post): ?>
                        <article class="card-dark rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                            <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                                </div>
                                <h3 class="text-xl font-bold text-dark-accent mb-3"><?php echo htmlspecialchars($post['title']); ?></h3>
                                <p class="text-dark-secondary mb-4"><?php echo htmlspecialchars($post['excerpt']); ?></p>
                                <a href="blog-post.php?slug=<?php echo urlencode($post['slug']); ?>"
                                    class="inline-flex items-center text-brand-blue font-semibold hover:text-brand-blue-dark transition-colors">
                                    Read More
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>

                    <!-- Placeholder posts for demo -->
                    <!-- <article class="card-dark rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                        <div class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                August 5, 2025
                            </div>
                            <h3 class="text-xl font-bold text-dark-accent mb-3">5 Essential Features Every Modern Website Needs</h3>
                            <p class="text-dark-secondary mb-4">Discover the must-have features that make websites successful in today's competitive digital landscape.</p>
                            <a href="#" class="inline-flex items-center text-brand-blue font-semibold hover:text-brand-blue-dark transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>

                    <article class="card-dark rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                        <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                July 28, 2025
                            </div>
                            <h3 class="text-xl font-bold text-dark-accent mb-3">Mobile-First Design: Why It Matters More Than Ever</h3>
                            <p class="text-dark-secondary mb-4">Learn why mobile-first design is crucial for success in the Middle East market and beyond.</p>
                            <a href="#" class="inline-flex items-center text-brand-blue font-semibold hover:text-brand-blue-dark transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article>

                    <article class="card-dark rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                        <div class="h-48 bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                July 20, 2025
                            </div>
                            <h3 class="text-xl font-bold text-dark-accent mb-3">SEO Best Practices for Lebanese Businesses</h3>
                            <p class="text-dark-secondary mb-4">Optimize your website for local and regional search to attract more customers in the MENA region.</p>
                            <a href="#" class="inline-flex items-center text-brand-blue font-semibold hover:text-brand-blue-dark transition-colors">
                                Read More
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </article> -->
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h3 class="text-xl font-bold text-dark-accent mb-2">No Posts Yet</h3>
                    <p class="text-dark-secondary">We're working on some great content. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- =========== Newsletter Signup =========== -->
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div class="card-dark rounded-xl p-8 md:p-12 fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Stay Updated</h2>
                    <p class="text-dark-secondary text-lg mb-8 max-w-2xl mx-auto">
                        Subscribe to our newsletter to get the latest insights on web development, technology trends, and business growth strategies delivered to your inbox.
                    </p>
                    <?php if ($message_sent): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <div>
                                    <strong class="font-bold">Thank you!</strong>
                                    <span class="block sm:inline">Thank you for subscribing
                                </div>
                            </div>
                        </div>
                    <?php elseif ($error_message): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span><?php echo htmlspecialchars($error_message); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto" action="" method="post">
                        <input type="email" placeholder="Enter your email address" name="email"
                            class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent">
                        <button type="submit" name="submit_newsletter"
                            class="bg-brand-blue text-white px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors font-semibold">
                            Subscribe
                        </button>
                    </form>
                    <p class="text-sm text-dark-secondary mt-4">No spam, unsubscribe at any time.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Categories =========== -->
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Explore Topics</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Browse articles by category to find exactly what you're looking for.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Web Development</h3>
                    <p class="text-dark-secondary text-sm">Latest trends and best practices</p>
                </a>

                <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Business Growth</h3>
                    <p class="text-dark-secondary text-sm">Strategies for digital success</p>
                </a>

                <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Technology</h3>
                    <p class="text-dark-secondary text-sm">Emerging tech and innovations</p>
                </a>

                <a href="#" class="card-dark rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Case Studies</h3>
                    <p class="text-dark-secondary text-sm">Real project insights</p>
                </a>
            </div>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>
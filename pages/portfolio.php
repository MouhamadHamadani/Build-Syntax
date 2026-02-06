<?php
$page_title = "Portfolio";
$page_description = "Explore our portfolio of successful web development projects including custom websites, e-commerce platforms, and mobile applications.";
require_once '../includes/header.php';
require_once '../includes/config.php';

// Fetch portfolio projects from database
$projects = [];
try {
    $pdo = getDBConnection();
    if ($pdo) {
        $stmt = $pdo->query("SELECT * FROM portfolio_projects ORDER BY featured DESC, created_at DESC");
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Get unique categories for filter buttons
        $categoryStmt = $pdo->query("SELECT DISTINCT category FROM portfolio_projects ORDER BY category");
        $categories = $categoryStmt->fetchAll(PDO::FETCH_COLUMN);
    }
} catch (Exception $e) {
    // Fallback to static data if database is not available
    $projects = [
        [
            'id' => 1,
            'title' => 'E-Commerce Demo Platform',
            'description' => 'A comprehensive e-commerce solution built with Laravel and Livewire, featuring real-time cart updates, secure payment processing, and an intuitive admin panel.',
            'category' => 'E-Commerce',
            'technologies' => 'Laravel, Livewire, MySQL, Tailwind CSS',
            'featured' => true
        ],
        [
            'id' => 2,
            'title' => 'Corporate Website Redesign',
            'description' => 'Modern, responsive website redesign for a leading Lebanese consulting firm, improving user experience and mobile performance.',
            'category' => 'Corporate',
            'technologies' => 'PHP, HTML5, CSS3, JavaScript',
            'featured' => true
        ],
        [
            'id' => 3,
            'title' => 'Restaurant Management App',
            'description' => 'Full-stack web application for restaurant order management with real-time kitchen updates and customer notifications.',
            'category' => 'Web App',
            'technologies' => 'PHP, MySQL, jQuery, Bootstrap',
            'featured' => false
        ]
    ];
}
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in">Our Portfolio</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                Discover the projects we've built for our clients. Each project represents our commitment to quality, innovation, and client satisfaction.
            </p>
        </div>
    </section>

    <!-- =========== Portfolio Filter =========== -->
    <section class="py-12 bg-dark-secondary border-b border-gray-800">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-center gap-4">
                <button class="portfolio-filter active bg-brand-blue text-white px-6 py-2 rounded-full font-medium transition-all duration-200" data-filter="all">
                    All Projects
                </button>
                <?php foreach ($categories as $category): ?>
                    <button class="portfolio-filter bg-dark-tertiary text-dark-accent hover:bg-brand-blue hover:text-white px-6 py-2 rounded-full font-medium transition-all duration-200" data-filter="<?php echo htmlspecialchars($category); ?>">
                        <?php echo htmlspecialchars($categoryLabels[$category] ?? ucfirst($category)); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =========== Portfolio Grid =========== -->
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
                <?php foreach ($projects as $project): ?>
                    <div class="portfolio-item card-dark rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in" data-category="<?php echo htmlspecialchars($project['category']); ?>">
                        <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600 flex items-center justify-center relative overflow-hidden">
                            <?php if ($project['category'] === 'ecommerce'): ?>
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            <?php elseif ($project['category'] === 'web'): ?>
                                <!-- Globe (outline with meridians & parallels) -->
                                <svg class="w-16 h-16 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                                    <!-- outer circle -->
                                    <circle cx="12" cy="12" r="9" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <!-- meridians -->
                                    <path d="M12 3c2.5 2.5 4 6 4 9s-1.5 6.5-4 9M12 3c-2.5 2.5-4 6-4 9s1.5 6.5 4 9"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <!-- parallels -->
                                    <path d="M3 12h18" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M4.5 8.5a16 16 0 0 1 15 0M4.5 15.5a16 16 0 0 0 15 0"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                            <?php elseif ($project['category'] === 'Corporate'): ?>
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            <?php else: ?>
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            <?php endif; ?>

                            <?php if ($project['featured']): ?>
                                <div class="absolute top-4 right-4 bg-yellow-400 text-gray-900 text-xs font-bold px-2 py-1 rounded">
                                    Featured
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="bg-brand-blue text-white text-xs px-2 py-1 rounded"><?php echo htmlspecialchars($project['category']); ?></span>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-dark-accent"><?php echo htmlspecialchars($project['title']); ?></h3>
                            <p class="text-gray-600 mb-4 text-dark-secondary"><?php echo htmlspecialchars($project['description']); ?></p>
                            <div class="flex flex-wrap gap-1 mb-4">
                                <?php
                                $techs = array_map('trim', explode(',', $project['technologies']));
                                foreach ($techs as $tech):
                                ?>
                                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded"><?php echo htmlspecialchars($tech); ?></span>
                                <?php endforeach; ?>
                            </div>
                            <div class="flex justify-between items-center">
                                <button class="text-brand-blue font-semibold hover:underline view-project-btn" data-project-id="<?php echo $project['id']; ?>">
                                    View Details →
                                </button>
                                <div class="flex space-x-2">
                                    <button class="text-gray-400 hover:text-brand-blue transition-colors" id="view-live-<?php echo $project['id']; ?>" data-url="<?php echo $project['project_url']; ?>">
                                        <a href="<?php echo $project['project_url']; ?>" target="_blank">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </button>
                                    <button class="text-gray-400 hover:text-brand-blue transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- =========== Project Modal =========== -->
    <div id="project-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-dark-secondary rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                <h2 id="modal-title" class="text-2xl font-bold text-dark-accent"></h2>
                <button id="close-modal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div id="modal-content">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Technologies Section =========== -->
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Technologies We Use</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">We work with modern, reliable technologies to build robust and scalable solutions.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8">
                <!-- Technology Icons -->
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-secondary hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">PHP</div>
                    </div>
                    <p class="text-sm text-white">PHP</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-secondary hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">L</div>
                    </div>
                    <p class="text-sm text-white">Laravel</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-secondary hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">JS</div>
                    </div>
                    <p class="text-sm text-white">JavaScript</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-secondary hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">⚛</div>
                    </div>
                    <p class="text-sm text-white">React</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-secondary hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">DB</div>
                    </div>
                    <p class="text-sm text-white">MySQL</p>
                </div>
                <div class="text-center fade-in">
                    <div class="card-dark rounded-lg p-6 mb-3 hover:bg-brand-blue text-dark-secondary hover:text-white transition-all duration-200">
                        <div class="text-4xl font-bold">TW</div>
                    </div>
                    <p class="text-sm text-white">Tailwind</p>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {
        // Portfolio filtering
        $('.portfolio-filter').on('click', function() {
            const filter = $(this).data('filter');

            // Update active button
            $('.portfolio-filter').removeClass('active bg-brand-blue text-white').addClass('bg-dark-tertiary text-dark-accent');
            $(this).removeClass('bg-dark-tertiary text-dark-accent').addClass('active bg-brand-blue text-white');

            // Filter portfolio items
            if (filter === 'all') {
                $('.portfolio-item').fadeIn(300);
            } else {
                $('.portfolio-item').fadeOut(300);
                $(`.portfolio-item[data-category="${filter}"]`).fadeIn(300);
            }
        });

        // Project modal
        $('.view-project-btn').on('click', function() {
            const projectId = $(this).data('project-id');
            // const projectCard = $(this).closest('.portfolio-item');
            // const projectURL = $('#view-live-' + projectId).data('url');
            // const title = projectCard.find('h3').text();
            // const description = projectCard.find('p').text();

            $.ajax({
                type: "post",
                url: "../includes/get_portfolio.php",
                data: {
                    id: projectId
                },
                success: function(response) {
                    const title = response.data.title
                    const description = response.data.description;
                    const projectURL = response.data.project_url;
                    const image = response.data.image_url;
                    var technologies = ``;
                    $.each(response.data.technologies, function(index, value) {
                        technologies += `<li>• ${value}</li>`;
                    });
                    const featured = response.data.featured;
                    $('#modal-title').text(title);
                    $('#modal-content').html(`
                        <div class="space-y-6">
                            <div class="h-64 bg-gradient-to-br from-brand-blue to-blue-600 rounded-lg flex items-center justify-center">
                            ${image ? `<img src="${image}" class="h-full w-full" alt="${title}">` :
                                `<svg class="w-24 h-24 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>`}
                            </div>
                            ${featured ? `<div class="bg-yellow-400 text-gray-900 text-xs font-bold px-2 py-1 rounded w-max">
                                    Featured
                                </div>` : ''}
                            <div>
                                <h3 class="text-xl font-bold mb-3 text-dark-accent">Project Overview</h3>
                                <p class="text-dark-secondary leading-relaxed">${description}</p>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-3 text-dark-accent">Technologies</h3>
                                <ul class="space-y-2 text-dark-secondary">
                                    ${technologies}
                                </ul>
                            </div>
                            <div class="flex gap-4">
                                <a href="${projectURL}" class="bg-brand-blue text-white px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors">View Live Site</a>
                                <a href="contact.php" class="border border-brand-blue text-brand-blue px-6 py-3 rounded-lg hover:bg-brand-blue hover:text-white transition-colors">Start Similar Project</a>
                            </div>
                        </div>
                    `);

                    $('#project-modal').removeClass('hidden');
                }
            });


        });

        // Close modal
        $('#close-modal, #project-modal').on('click', function(e) {
            if (e.target === this) {
                $('#project-modal').addClass('hidden');
            }
        });
    });
</script>

<?php require_once '../includes/footer.php'; ?>
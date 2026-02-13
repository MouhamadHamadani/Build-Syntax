<?php
$page_title = "Home";
$page_description = "Build Syntax is a Beirut-based development partner dedicated to transforming your ideas into powerful, modern, and reliable websites and applications.";
require_once '../includes/header.php';
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section id="home" class="gradient-hero-dark pt-32 pb-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight mb-6">
                        Your Vision, <span class="text-brand-blue">Our Code.</span>
                    </h1>
                    <p class="text-lg text-dark-secondary mb-4 leading-relaxed">
                        Transform your ideas into powerful, modern, and reliable digital solutions that drive real business growth.
                    </p>
                    <p class="text-base text-dark-secondary mb-8 leading-relaxed">
                        We are a Beirut-based development partner specializing in custom web development, e-commerce systems, and appointment platforms that connect you with your customers.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="contact.php" class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg text-center">
                            Start Your Project
                        </a>
                        <a href="services.php" class="border-2 border-brand-blue text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue hover:text-white transition-all duration-200 text-center">
                            Explore Services
                        </a>
                    </div>
                </div>
                <div class="fade-in">
                    <div class="relative">
                        <div class="bg-brand-blue rounded-lg p-8 shadow-2xl transform rotate-3">
                            <div class="bg-dark-secondary rounded-lg p-6 transform -rotate-3">
                                <div class="flex items-center space-x-2 mb-4">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-2 bg-dark-tertiary rounded w-3/4"></div>
                                    <div class="h-2 bg-dark-tertiary rounded w-1/2"></div>
                                    <div class="h-2 bg-brand-blue rounded w-2/3"></div>
                                    <div class="h-2 bg-dark-tertiary rounded w-1/3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== How We Work Section =========== -->
    <section id="work" class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">How We Work</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Our proven three-step process ensures your project is delivered on time, within budget, and exceeding expectations.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1: Consultation -->
                <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mb-6">1</div>
                        <h3 class="text-xl font-bold mb-4 text-dark-accent">Consultation</h3>
                        <p class="text-dark-secondary mb-4 leading-relaxed">
                            We start by understanding your business goals, target audience, and project requirements. This discovery phase ensures we build exactly what you need.
                        </p>
                        <ul class="text-sm text-dark-secondary space-y-2 text-left w-full">
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Requirements gathering</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Project scoping</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Timeline & budget planning</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Step 2: Development -->
                <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mb-6">2</div>
                        <h3 class="text-xl font-bold mb-4 text-dark-accent">Development</h3>
                        <p class="text-dark-secondary mb-4 leading-relaxed">
                            Our expert team builds your solution using modern technologies and best practices. We maintain regular communication and provide progress updates.
                        </p>
                        <ul class="text-sm text-dark-secondary space-y-2 text-left w-full">
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Design & development</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Regular updates</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Quality assurance</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Step 3: Launch -->
                <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold mb-6">3</div>
                        <h3 class="text-xl font-bold mb-4 text-dark-accent">Launch & Support</h3>
                        <p class="text-dark-secondary mb-4 leading-relaxed">
                            We deploy your solution and provide comprehensive support. Your success is our success, and we're here to help you grow.
                        </p>
                        <ul class="text-sm text-dark-secondary space-y-2 text-left w-full">
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Deployment & testing</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Training & documentation</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="text-brand-blue mt-1">✓</span>
                                <span>Ongoing support</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Services Overview =========== -->
    <section id="services" class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Our Services</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">We build solutions that power your business and connect you with your customers.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-6">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">Custom Web Development</h3>
                    <p class="text-dark-secondary text-center mb-6">Bespoke websites and applications built from the ground up to meet your unique business needs.</p>
                    <div class="text-center">
                        <a href="services#web-development" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-6">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">E-Commerce Solutions</h3>
                    <p class="text-dark-secondary text-center mb-6">Powerful online stores with secure payment gateways to sell your products globally.</p>
                    <div class="text-center">
                        <a href="services#ecommerce" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div class="card-dark p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-6">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10m-3 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-center text-dark-accent">Appointment Systems</h3>
                    <p class="text-dark-secondary text-center mb-6">Streamline bookings with automated scheduling, reminders, and customer management tools.</p>
                    <div class="text-center">
                        <a href="services#appointment" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Featured Work =========== -->
    <section id="portfolio" class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Featured Work</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Take a look at some of our recent projects that showcase our expertise and commitment to quality.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                try {
                    $pdo = getDBConnection();
                    if ($pdo) {
                        $stmt = $pdo->prepare("SELECT id, title, description, category, technologies, project_url, image_url FROM portfolio_projects WHERE featured = TRUE ORDER BY created_at DESC");
                        $stmt->execute();
                        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (count($projects) > 0) {
                            // Define gradient colors for cards
                            $gradients = [
                                'from-brand-blue to-blue-600',
                                'from-green-500 to-green-600',
                                'from-purple-500 to-purple-600',
                                'from-pink-500 to-pink-600',
                                'from-indigo-500 to-indigo-600',
                                'from-yellow-500 to-yellow-600'
                            ];
                            
                            // Define icons for different categories
                            $icons = [
                                'ecommerce' => 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z',
                                'web' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                                'mobile' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                                'other' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'
                            ];
                            
                            foreach ($projects as $index => $project) {
                                $gradient = $gradients[$index % count($gradients)];
                                $icon = $icons[$project['category']] ?? $icons['other'];
                                $technologies = array_map('trim', explode(',', $project['technologies']));
                                $techColors = ['bg-brand-blue', 'bg-green-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-yellow-500'];
                                ?>
                                <!-- Project Card -->
                                <div class="card-dark rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                                    <div class="h-48 bg-gradient-to-br <?php echo $gradient; ?> flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="<?php echo $icon; ?>"/>
                                        </svg>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold mb-2 text-dark-accent"><?php echo htmlspecialchars($project['title']); ?></h3>
                                        <p class="text-dark-secondary mb-4"><?php echo strlen($project['description']) > 100 ? htmlspecialchars(substr($project['description'], 0, 100)) . '...' : htmlspecialchars($project['description']); ?></p>
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <?php foreach ($technologies as $tech_index => $tech) { 
                                                $techColor = $techColors[$tech_index % count($techColors)];
                                            ?>
                                                <span class="<?php echo $techColor; ?> text-white text-xs px-2 py-1 rounded"><?php echo htmlspecialchars($tech); ?></span>
                                            <?php } ?>
                                        </div>
                                        <a href="portfolio.php" class="text-brand-blue font-semibold hover:underline">View Case Study →</a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="col-span-full text-center py-12">
                                <p class="text-dark-secondary text-lg">No projects found</p>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-span-full text-center py-12">
                            <p class="text-dark-secondary text-lg">Unable to load projects at this time</p>
                        </div>
                        <?php
                    }
                } catch (Exception $ex) {
                    error_log("Error fetching featured projects: " . $ex->getMessage());
                    ?>
                    <div class="col-span-full text-center py-12">
                        <p class="text-dark-secondary text-lg">Unable to load projects at this time</p>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="text-center mt-12">
                <a href="portfolio.php" class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                    View All Projects
                </a>
            </div>
        </div>
    </section>

    <!-- =========== Why Choose Us =========== -->
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Why Choose Build Syntax?</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">We combine technical expertise with a client-focused approach to deliver exceptional results.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Quality Code</h3>
                    <p class="text-dark-secondary">Clean, maintainable, and scalable code that stands the test of time.</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">On-Time Delivery</h3>
                    <p class="text-dark-secondary">We respect your deadlines and deliver projects on schedule, every time.</p>
                </div>
                <!-- Feature 3 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Client-Centric Approach</h3>
                    <p class="text-dark-secondary">Your vision guides our development process from start to finish.</p>
                </div>
                <!-- Feature 4 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-dark-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-dark-accent">Ongoing Support</h3>
                    <p class="text-dark-secondary">Comprehensive maintenance and support to keep your website running smoothly.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>

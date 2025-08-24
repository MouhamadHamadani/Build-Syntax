<?php
$page_title = "Contact Us";
$page_description = "Get in touch with Build Syntax for your web development needs. Contact us for a free consultation and project quote.";
require_once '../includes/header.php';
require_once '../includes/config.php';

// Handle form submission
$message_sent = false;
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact'])) {
    // Sanitize and validate input
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $company = sanitizeInput($_POST['company'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    $budget_range = sanitizeInput($_POST['budget_range'] ?? '');
    
    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = 'Please fill in all required fields.';
    } elseif (!isValidEmail($email)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        // Try to save to database
        try {
            $pdo = getDBConnection();
            if ($pdo) {
                $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, company, message, budget_range) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$name, $email, $company, $message, $budget_range]);
                $message_sent = true;
                
                // In a real application, you would also send an email notification here
                // mail(CONTACT_EMAIL, "New Contact Form Submission", $message, "From: $email");
            } else {
                $error_message = 'Sorry, there was a technical issue. Please try again later.';
            }
        } catch (Exception $e) {
            error_log("Contact form error: " . $e->getMessage());
            $error_message = 'Sorry, there was a technical issue. Please try again later.';
        }
    }
}
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in">Contact Us</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                Ready to bring your vision to life? Let's discuss your project and create something amazing together.
            </p>
        </div>
    </section>

    <!-- =========== Contact Form Section =========== -->
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Contact Form -->
                <div class="fade-in">
                    <h2 class="text-3xl font-bold text-dark-accent mb-6">Get a Free Quote</h2>
                    <p class="text-dark-secondary mb-8 leading-relaxed">
                        Tell us about your project and we'll get back to you within 24 hours with a detailed proposal and timeline.
                    </p>

                    <?php if ($message_sent): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <div>
                                    <strong class="font-bold">Thank you!</strong>
                                    <span class="block sm:inline">Your message has been sent successfully. We will get back to you within 24 hours.</span>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($error_message): ?>
                        <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6" role="alert">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span><?php echo htmlspecialchars($error_message); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-white font-medium mb-2">Full Name *</label>
                                <input type="text" id="name" name="name" required 
                                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200">
                            </div>
                            <div>
                                <label for="email" class="block text-white font-medium mb-2">Email Address *</label>
                                <input type="email" id="email" name="email" required 
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="company" class="block text-white font-medium mb-2">Company Name</label>
                                <input type="text" id="company" name="company" 
                                       value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200">
                            </div>
                            <div>
                                <label for="budget_range" class="block text-white font-medium mb-2">Budget Range</label>
                                <select id="budget_range" name="budget_range" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200">
                                    <option value="">Select budget range</option>
                                    <option value="$1,000 - $2,500" <?php echo (isset($_POST['budget_range']) && $_POST['budget_range'] === '$1,000 - $2,500') ? 'selected' : ''; ?>>$1,000 - $2,500</option>
                                    <option value="$2,500 - $5,000" <?php echo (isset($_POST['budget_range']) && $_POST['budget_range'] === '$2,500 - $5,000') ? 'selected' : ''; ?>>$2,500 - $5,000</option>
                                    <option value="$5,000 - $10,000" <?php echo (isset($_POST['budget_range']) && $_POST['budget_range'] === '$5,000 - $10,000') ? 'selected' : ''; ?>>$5,000 - $10,000</option>
                                    <option value="$10,000+" <?php echo (isset($_POST['budget_range']) && $_POST['budget_range'] === '$10,000+') ? 'selected' : ''; ?>>$10,000+</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-white font-medium mb-2">Project Details *</label>
                            <textarea id="message" name="message" rows="6" required 
                                      placeholder="Tell us about your project, goals, timeline, and any specific requirements..."
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all duration-200 resize-vertical"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" name="submit_contact" 
                                    class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg transform hover:scale-105">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="fade-in">
                    <h2 class="text-3xl font-bold text-dark-accent mb-6">Get in Touch</h2>
                    <p class="text-dark-secondary mb-8 leading-relaxed">
                        We're here to help bring your digital vision to life. Reach out to us through any of the channels below.
                    </p>

                    <div class="space-y-6 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-dark-accent mb-1">Office Location</h3>
                                <p class="text-dark-secondary">Beirut, Lebanon</p>
                                <p class="text-sm text-dark-primary">Available for in-person meetings</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-dark-accent mb-1">Email Address</h3>
                                <p class="text-dark-secondary"><?php echo CONTACT_EMAIL; ?></p>
                                <p class="text-sm text-dark-primary">We respond within 24 hours</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-dark-accent mb-1">Phone Number</h3>
                                <p class="text-dark-secondary">+961 XX XXX XXX</p>
                                <p class="text-sm text-dark-primary">Monday - Friday, 9 AM - 6 PM</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-3 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-dark-accent mb-1">Response Time</h3>
                                <p class="text-dark-secondary">Within 24 hours</p>
                                <p class="text-sm text-dark-primary">Usually much faster!</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Contact Options -->
                    <div class="card-dark rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-dark-accent mb-4">Quick Contact</h3>
                        <div class="space-y-3">
                            <a href="mailto:<?php echo CONTACT_EMAIL; ?>" 
                               class="flex items-center space-x-3 text-brand-blue hover:text-brand-blue-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Send us an email</span>
                            </a>
                            <a href="tel:+961XXXXXXX" 
                               class="flex items-center space-x-3 text-brand-blue hover:text-brand-blue-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                <span>Give us a call</span>
                            </a>
                            <a href="../pages/services.php" 
                               class="flex items-center space-x-3 text-brand-blue hover:text-brand-blue-dark transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Learn about our services</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== FAQ Section =========== -->
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Frequently Asked Questions</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Get quick answers to common questions about our services and process.</p>
            </div>
            <div class="max-w-4xl mx-auto">
                <div class="space-y-6">
                    <!-- FAQ Item 1 -->
                    <div class="card-dark rounded-lg shadow-md fade-in">
                        <button class="faq-toggle w-full text-left p-6 focus:outline-none" data-target="faq-1">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-dark-accent">How long does it take to build a website?</h3>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div id="faq-1" class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-secondary">The timeline depends on the complexity of your project. A simple website typically takes 2-4 weeks, while more complex e-commerce or custom applications can take 6-12 weeks. We'll provide a detailed timeline during our initial consultation.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="card-dark rounded-lg shadow-md fade-in">
                        <button class="faq-toggle w-full text-left p-6 focus:outline-none" data-target="faq-2">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-dark-accent">What's included in your web development service?</h3>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div id="faq-2" class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-secondary">Our service includes custom design, responsive development, content management system, basic SEO setup, contact forms, 3 months of free support, and training on how to manage your content. We also handle hosting setup if needed.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="card-dark rounded-lg shadow-md fade-in">
                        <button class="faq-toggle w-full text-left p-6 focus:outline-none" data-target="faq-3">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-dark-accent">Do you provide ongoing maintenance?</h3>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div id="faq-3" class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-secondary">Yes! We offer ongoing maintenance packages that include security updates, content updates, performance monitoring, and technical support. We believe in long-term partnerships with our clients.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="card-dark rounded-lg shadow-md fade-in">
                        <button class="faq-toggle w-full text-left p-6 focus:outline-none" data-target="faq-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-dark-accent">Can you work with clients outside Lebanon?</h3>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </button>
                        <div id="faq-4" class="faq-content hidden px-6 pb-6">
                            <p class="text-dark-secondary">Absolutely! We work with clients across the MENA region and internationally. We're experienced in remote collaboration and use modern communication tools to ensure smooth project delivery regardless of location.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
$(document).ready(function() {
    // FAQ Toggle
    $('.faq-toggle').on('click', function() {
        const target = $(this).data('target');
        const content = $('#' + target);
        const icon = $(this).find('svg');
        
        // Close all other FAQ items
        $('.faq-content').not(content).slideUp(200);
        $('.faq-toggle svg').not(icon).removeClass('rotate-180');
        
        // Toggle current item
        content.slideToggle(200);
        icon.toggleClass('rotate-180');
    });
    
    // Form validation enhancement
    $('form input, form textarea, form select').on('blur', function() {
        const $this = $(this);
        if ($this.prop('required') && !$this.val()) {
            $this.addClass('border-red-300 focus:ring-red-500');
        } else {
            $this.removeClass('border-red-300 focus:ring-red-500');
        }
    });
});
</script>

<?php require_once '../includes/footer.php'; ?>


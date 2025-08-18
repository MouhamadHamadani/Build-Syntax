<?php
$page_title = "Services";
$page_description = "Discover our comprehensive web development services including custom websites, e-commerce solutions, and mobile applications.";
require_once '../includes/header.php';
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section class="bg-gradient-to-br from-blue-500 to-gray-700 text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in">Our Services</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                We offer comprehensive web development solutions tailored to your business needs. From concept to deployment, we're your trusted technical partner.
            </p>
        </div>
    </section>

    <!-- =========== Services Overview =========== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                <div class="fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">What We Do</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        At Build Syntax, we specialize in creating digital solutions that drive business growth. Our team combines technical expertise with creative problem-solving to deliver websites and applications that not only look great but perform exceptionally.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Whether you're a startup looking for your first website or an established business ready to scale online, we have the skills and experience to bring your vision to life.
                    </p>
                </div>
                <div class="fade-in">
                    <div class="bg-gray-50 rounded-xl p-8">
                        <h3 class="text-xl font-bold mb-4">Our Process</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <span class="text-gray-700">Discovery & Planning</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <span class="text-gray-700">Design & Development</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <span class="text-gray-700">Testing & Optimization</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">4</div>
                                <span class="text-gray-700">Launch & Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Detailed Services =========== -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Web Development Service -->
            <div id="web-development" class="mb-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="fade-in">
                        <div class="text-brand-blue mb-4">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Custom Web Development</h2>
                        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                            We build bespoke websites and web applications from the ground up, tailored specifically to your business requirements. Our development process ensures scalability, security, and optimal performance.
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Responsive design for all devices</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">SEO-optimized structure</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Content Management System (CMS)</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Fast loading speeds</span>
                            </li>
                        </ul>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">PHP</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Laravel</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">HTML5</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Tailwind CSS</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">JavaScript</span>
                        </div>
                    </div>
                    <div class="fade-in">
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <h3 class="text-xl font-bold mb-4">What's Included:</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li>• Custom design and development</li>
                                <li>• Mobile-responsive layout</li>
                                <li>• Contact forms and integrations</li>
                                <li>• Basic SEO setup</li>
                                <li>• 3 months free support</li>
                                <li>• Training on content management</li>
                            </ul>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Starting from</p>
                                <p class="text-2xl font-bold text-brand-blue">$1,500</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- E-Commerce Service -->
            <div id="ecommerce" class="mb-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="order-2 lg:order-1 fade-in">
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <h3 class="text-xl font-bold mb-4">What's Included:</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li>• Product catalog management</li>
                                <li>• Shopping cart and checkout</li>
                                <li>• Payment gateway integration</li>
                                <li>• Inventory management</li>
                                <li>• Order management system</li>
                                <li>• Customer accounts</li>
                                <li>• Admin dashboard</li>
                            </ul>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Starting from</p>
                                <p class="text-2xl font-bold text-brand-blue">$2,500</p>
                            </div>
                        </div>
                    </div>
                    <div class="order-1 lg:order-2 fade-in">
                        <div class="text-brand-blue mb-4">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">E-Commerce Solutions</h2>
                        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                            Launch your online store with our comprehensive e-commerce solutions. We build secure, scalable platforms that help you sell products and services online with confidence.
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Secure payment processing</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Inventory management</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Multi-language support</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Analytics and reporting</span>
                            </li>
                        </ul>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Laravel</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Livewire</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Tailwind CSS</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">JetStream</span>
                            <!-- <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Stripe</span> -->
                            <!-- <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">PayPal</span> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Apps Service -->
            <div id="mobile-apps" class="mb-20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div class="fade-in">
                        <div class="text-brand-blue mb-4">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Mobile Applications</h2>
                        <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                            Extend your reach with custom mobile applications for iOS and Android. We create engaging, user-friendly apps that connect your business with customers on their preferred devices.
                        </p>
                        <ul class="space-y-3 mb-6">
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Cross-platform development</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Native performance</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">Push notifications</span>
                            </li>
                            <li class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-gray-700">App store deployment</span>
                            </li>
                        </ul>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">React Native</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Flutter</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">iOS</span>
                            <span class="bg-brand-blue text-white text-sm px-3 py-1 rounded-full">Android</span>
                        </div>
                    </div>
                    <div class="fade-in">
                        <div class="bg-white rounded-xl shadow-lg p-8">
                            <h3 class="text-xl font-bold mb-4">What's Included:</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li>• iOS and Android apps</li>
                                <li>• Custom UI/UX design</li>
                                <li>• Backend API development</li>
                                <li>• User authentication</li>
                                <li>• Push notifications</li>
                                <li>• App store submission</li>
                                <li>• 6 months support</li>
                            </ul>
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Starting from</p>
                                <p class="text-2xl font-bold text-brand-blue">$3,500</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Additional Services =========== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Additional Services</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">We also offer complementary services to support your digital presence.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-gray-50 p-6 rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">SEO Optimization</h3>
                    <p class="text-gray-600">Improve your search engine rankings and drive organic traffic to your website.</p>
                </div>

                <!-- Service 2 -->
                <div class="bg-gray-50 p-6 rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Performance Optimization</h3>
                    <p class="text-gray-600">Speed up your website for better user experience and search rankings.</p>
                </div>

                <!-- Service 3 -->
                <div class="bg-gray-50 p-6 rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Security Audits</h3>
                    <p class="text-gray-600">Protect your website and customer data with comprehensive security reviews.</p>
                </div>

                <!-- Service 4 -->
                <div class="bg-gray-50 p-6 rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Maintenance & Support</h3>
                    <p class="text-gray-600">Keep your website updated, secure, and running smoothly with our ongoing support.</p>
                </div>

                <!-- Service 5 -->
                <div class="bg-gray-50 p-6 rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Hosting & Domains</h3>
                    <p class="text-gray-600">Reliable hosting solutions and domain management for your online presence.</p>
                </div>

                <!-- Service 6 -->
                <div class="bg-gray-50 p-6 rounded-xl fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Training Programs</h3>
                    <p class="text-gray-600">Learn web development skills with our comprehensive training courses.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Call to Action =========== -->
    <section class="py-20 bg-brand-blue text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Get Started?</h2>
                <p class="text-xl mb-8 opacity-90">Let's discuss your project requirements and create a custom solution that fits your needs and budget.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="contact.php" class="bg-white text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg">
                        Get Free Consultation
                    </a>
                    <a href="portfolio.php" class="border-2 border-white text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-white hover:text-brand-blue transition-all duration-200">
                        View Our Work
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>


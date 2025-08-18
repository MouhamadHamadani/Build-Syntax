<?php
$page_title = "Home";
$page_description = "Build Syntax is a Beirut-based development partner dedicated to transforming your ideas into powerful, modern, and reliable websites and applications.";
require_once 'includes/header.php';
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section id="home" class="bg-gradient-to-br from-white to-gray-100 pt-32 pb-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight mb-6">
                        Your Vision, <span class="text-brand-blue">Our Code.</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        We are a Beirut-based development partner dedicated to transforming your ideas into powerful, modern, and reliable websites and applications that drive business growth.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="pages/contact.php" class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg text-center">
                            Start Your Project
                        </a>
                        <a href="pages/portfolio.php" class="border-2 border-brand-blue text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue hover:text-white transition-all duration-200 text-center">
                            View Our Work
                        </a>
                    </div>
                </div>
                <div class="fade-in">
                    <div class="relative">
                        <div class="bg-brand-blue rounded-lg p-8 shadow-2xl transform rotate-3">
                            <div class="bg-white rounded-lg p-6 transform -rotate-3">
                                <div class="flex items-center space-x-2 mb-4">
                                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-2 bg-gray-200 rounded w-3/4"></div>
                                    <div class="h-2 bg-gray-200 rounded w-1/2"></div>
                                    <div class="h-2 bg-brand-blue rounded w-2/3"></div>
                                    <div class="h-2 bg-gray-200 rounded w-1/3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Services Overview =========== -->
    <section id="services" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">We build solutions that power your business and connect you with your customers.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Service Card 1 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-6">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-center">Custom Web Development</h3>
                    <p class="text-gray-600 text-center mb-6">Bespoke websites and applications built from the ground up to meet your unique business needs.</p>
                    <div class="text-center">
                        <a href="pages/services.php#web-development" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
                
                <!-- Service Card 2 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-6">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-center">E-Commerce Solutions</h3>
                    <p class="text-gray-600 text-center mb-6">Powerful online stores with secure payment gateways to sell your products globally.</p>
                    <div class="text-center">
                        <a href="pages/services.php#ecommerce" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
                
                <!-- Service Card 3 -->
                <div class="bg-gray-50 p-8 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="text-brand-blue mb-6">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-center">Mobile Applications</h3>
                    <p class="text-gray-600 text-center mb-6">Engaging and intuitive mobile apps for iOS and Android to connect with your users on the go.</p>
                    <div class="text-center">
                        <a href="pages/services.php#mobile-apps" class="text-brand-blue font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Featured Work =========== -->
    <section id="work" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Work</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Take a look at some of our recent projects that showcase our expertise and commitment to quality.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project Card 1 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="h-48 bg-gradient-to-br from-brand-blue to-blue-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">E-Commerce Demo Platform</h3>
                        <p class="text-gray-600 mb-4">A comprehensive e-commerce solution built with Laravel and Livewire, featuring real-time cart updates and secure payment processing.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-brand-blue text-white text-xs px-2 py-1 rounded">Laravel</span>
                            <span class="bg-brand-blue text-white text-xs px-2 py-1 rounded">Livewire</span>
                            <span class="bg-brand-blue text-white text-xs px-2 py-1 rounded">MySQL</span>
                        </div>
                        <a href="pages/portfolio.php" class="text-brand-blue font-semibold hover:underline">View Case Study →</a>
                    </div>
                </div>

                <!-- Project Card 2 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Corporate Website Redesign</h3>
                        <p class="text-gray-600 mb-4">Modern, responsive website redesign for a leading Lebanese consulting firm, improving user experience and mobile performance.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">PHP</span>
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">HTML5</span>
                            <span class="bg-green-500 text-white text-xs px-2 py-1 rounded">CSS3</span>
                        </div>
                        <a href="pages/portfolio.php" class="text-brand-blue font-semibold hover:underline">View Case Study →</a>
                    </div>
                </div>

                <!-- Project Card 3 -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 fade-in">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">Restaurant Management App</h3>
                        <p class="text-gray-600 mb-4">Full-stack web application for restaurant order management with real-time kitchen updates and customer notifications.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-purple-500 text-white text-xs px-2 py-1 rounded">PHP</span>
                            <span class="bg-purple-500 text-white text-xs px-2 py-1 rounded">MySQL</span>
                            <span class="bg-purple-500 text-white text-xs px-2 py-1 rounded">jQuery</span>
                        </div>
                        <a href="pages/portfolio.php" class="text-brand-blue font-semibold hover:underline">View Case Study →</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12">
                <a href="pages/portfolio.php" class="bg-brand-blue text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-brand-blue-dark transition-all duration-200 shadow-lg">
                    View All Projects
                </a>
            </div>
        </div>
    </section>

    <!-- =========== Why Choose Us =========== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose Build Syntax?</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">We combine technical expertise with a client-focused approach to deliver exceptional results.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Quality Code</h3>
                    <p class="text-gray-600">Clean, maintainable, and scalable code that stands the test of time.</p>
                </div>

                <!-- Feature 2 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">On-Time Delivery</h3>
                    <p class="text-gray-600">We respect your deadlines and deliver projects on schedule, every time.</p>
                </div>

                <!-- Feature 3 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Client-Centric Approach</h3>
                    <p class="text-gray-600">Your vision guides our development process from start to finish.</p>
                </div>

                <!-- Feature 4 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Ongoing Support</h3>
                    <p class="text-gray-600">Comprehensive maintenance and support to keep your website running smoothly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Call to Action =========== -->
    <section class="py-20 bg-brand-blue text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Bring Your Vision to Life?</h2>
                <p class="text-xl mb-8 opacity-90">Let's discuss your project and create something amazing together. Get a free consultation and project quote today.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="pages/contact.php" class="bg-white text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg">
                        Get Free Quote
                    </a>
                    <a href="pages/portfolio.php" class="border-2 border-white text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-white hover:text-brand-blue transition-all duration-200">
                        View Portfolio
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once 'includes/footer.php'; ?>


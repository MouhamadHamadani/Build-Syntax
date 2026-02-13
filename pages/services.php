<?php
$page_title = "Services";
$page_description = "Discover our comprehensive web development services including custom websites, e-commerce solutions, and appointment systems with flexible pricing tiers.";
require_once '../includes/header.php';
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section class="gradient-hero-dark text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in">Our Services</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                We offer comprehensive web development solutions tailored to your business needs. Choose from flexible pricing tiers designed to scale with your growth.
            </p>
        </div>
    </section>

    <!-- =========== Services Overview =========== -->
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
                <div class="fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-6">Why Choose Our Services?</h2>
                    <p class="text-lg text-dark-secondary mb-6 leading-relaxed">
                        At Build Syntax, we specialize in creating digital solutions that drive business growth. Our team combines technical expertise with creative problem-solving to deliver websites and applications that not only look great but perform exceptionally.
                    </p>
                    <p class="text-lg text-dark-secondary mb-6 leading-relaxed">
                        Whether you're a startup looking for your first system or an established business ready to scale, we have flexible pricing tiers to match your needs and budget.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Scalable architecture</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Responsive design</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Ongoing support included</span>
                        </li>
                    </ul>
                </div>
                <div class="fade-in">
                    <div class="card-dark rounded-xl p-8">
                        <h3 class="text-2xl font-bold mb-6 text-dark-accent">Our Process</h3>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">1</div>
                                <span class="text-dark-accent font-semibold">Consultation & Planning</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">2</div>
                                <span class="text-dark-accent font-semibold">Design & Development</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">3</div>
                                <span class="text-dark-accent font-semibold">Testing & Optimization</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="bg-brand-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold">4</div>
                                <span class="text-dark-accent font-semibold">Launch & Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== E-Commerce Service =========== -->
    <section id="ecommerce" class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">E-Commerce Solutions</h2>
                <p class="text-dark-secondary text-lg max-w-3xl mx-auto">Launch your online store with our comprehensive e-commerce systems. Choose the tier that fits your business needs.</p>
            </div>

            <!-- Pricing Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Basic Plan -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Basic</h3>
                        <p class="text-dark-secondary text-sm mb-4">Perfect for getting started</p>
                        <div class="mb-4">
                            <p class="text-sm text-dark-secondary mb-1">Starting from</p>
                            <p class="text-4xl font-bold text-brand-blue">$1,200</p>
                        </div>
                        <p class="text-xs text-dark-secondary">Plus hosting and maintenance fees</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">User registration/login</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Product management (CRUD)</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Product categories</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Shopping cart</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Cash on delivery checkout</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Basic admin dashboard</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Responsive design</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">2 weeks support</span>
                        </li>
                    </ul>
                    
                    <a href="../pages/contact.php" class="bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-semibold">
                        Request This Plan
                    </a>
                </div>

                <!-- Standard Plan (Most Popular) -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col border-2 border-brand-blue relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-brand-blue text-white px-4 py-1 rounded-full text-sm font-semibold">
                        Most Popular
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Standard</h3>
                        <p class="text-dark-secondary text-sm mb-4">Best for growing businesses</p>
                        <div class="mb-4">
                            <p class="text-sm text-dark-secondary mb-1">Starting from</p>
                            <p class="text-4xl font-bold text-brand-blue">$2,000</p>
                        </div>
                        <p class="text-xs text-dark-secondary">Plus hosting and maintenance fees</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent"><strong>Everything in Basic</strong></span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Online payment integration</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Discount coupons system</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Order status tracking</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Email notifications</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Sales reports</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Stock management</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Wishlist feature</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">1 month support</span>
                        </li>
                    </ul>
                    
                    <a href="../pages/contact.php" class="bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-semibold">
                        Request This Plan
                    </a>
                </div>

                <!-- Premium Plan -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Premium</h3>
                        <p class="text-dark-secondary text-sm mb-4">For enterprise-level needs</p>
                        <div class="mb-4">
                            <p class="text-sm text-dark-secondary mb-1">Starting from</p>
                            <p class="text-4xl font-bold text-brand-blue">$3,200</p>
                        </div>
                        <p class="text-xs text-dark-secondary">Plus hosting and maintenance fees</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent"><strong>Everything in Standard</strong></span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Multi-role admin system</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Advanced reports & charts</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Featured products system</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Product reviews & ratings</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">SEO optimization</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Performance optimization</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">VPS deployment</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">2 months support</span>
                        </li>
                    </ul>
                    
                    <a href="../pages/contact.php" class="bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-semibold">
                        Request This Plan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Appointment System Service =========== -->
    <section id="appointment" class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Appointment Systems</h2>
                <p class="text-dark-secondary text-lg max-w-3xl mx-auto">Streamline your booking process with our appointment management systems. Select the plan that matches your business requirements.</p>
            </div>

            <!-- Pricing Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                <!-- Basic Plan -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Basic</h3>
                        <p class="text-dark-secondary text-sm mb-4">Perfect for getting started</p>
                        <div class="mb-4">
                            <p class="text-sm text-dark-secondary mb-1">Starting from</p>
                            <p class="text-4xl font-bold text-brand-blue">$800</p>
                        </div>
                        <p class="text-xs text-dark-secondary">Plus hosting and maintenance fees</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">User registration/login</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Service management</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Appointment booking</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Admin panel</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Manual approval/rejection</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Calendar view</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Responsive design</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">2 weeks support</span>
                        </li>
                    </ul>
                    
                    <a href="../pages/contact.php" class="bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-semibold">
                        Request This Plan
                    </a>
                </div>

                <!-- Standard Plan (Most Popular) -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col border-2 border-brand-blue relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-brand-blue text-white px-4 py-1 rounded-full text-sm font-semibold">
                        Most Popular
                    </div>
                    
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Standard</h3>
                        <p class="text-dark-secondary text-sm mb-4">Best for growing businesses</p>
                        <div class="mb-4">
                            <p class="text-sm text-dark-secondary mb-1">Starting from</p>
                            <p class="text-4xl font-bold text-brand-blue">$1,400</p>
                        </div>
                        <p class="text-xs text-dark-secondary">Plus hosting and maintenance fees</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent"><strong>Everything in Basic</strong></span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Email/SMS reminders</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Online payment integration</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Staff role management</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Time slot management</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Service duration management</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Basic reporting</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">1 month support</span>
                        </li>
                    </ul>
                    
                    <a href="../pages/contact.php" class="bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-semibold">
                        Request This Plan
                    </a>
                </div>

                <!-- Premium Plan -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in flex flex-col">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-dark-accent mb-2">Premium</h3>
                        <p class="text-dark-secondary text-sm mb-4">For enterprise-level needs</p>
                        <div class="mb-4">
                            <p class="text-sm text-dark-secondary mb-1">Starting from</p>
                            <p class="text-4xl font-bold text-brand-blue">$2,200</p>
                        </div>
                        <p class="text-xs text-dark-secondary">Plus hosting and maintenance fees</p>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-grow">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent"><strong>Everything in Standard</strong></span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Multi-branch support</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Advanced reporting dashboard</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Customer history tracking</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Cancellation & reschedule logic</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Loyalty/points system</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">VPS deployment</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">2 months support</span>
                        </li>
                    </ul>
                    
                    <a href="../pages/contact.php" class="bg-brand-blue text-white text-center px-6 py-3 rounded-lg hover:bg-brand-blue-dark transition-colors duration-200 font-semibold">
                        Request This Plan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Hosting & Maintenance =========== -->
    <section class="py-20 bg-dark-tertiary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Hosting & Maintenance</h2>
                <p class="text-dark-secondary text-lg max-w-3xl mx-auto">Keep your system running smoothly with our hosting and maintenance plans.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Hosting -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <h3 class="text-2xl font-bold text-dark-accent mb-6">Hosting</h3>
                    <div class="mb-6">
                        <p class="text-dark-secondary mb-2">Reliable and secure hosting for your application</p>
                        <p class="text-3xl font-bold text-brand-blue mb-2">$150 - $500/year</p>
                        <p class="text-sm text-dark-secondary">Depending on traffic and storage requirements</p>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">99.9% uptime guarantee</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">SSL certificate included</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Daily backups</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">24/7 monitoring</span>
                        </li>
                    </ul>
                </div>

                <!-- Maintenance -->
                <div class="card-dark rounded-xl p-8 shadow-md hover:shadow-lg transition-all duration-300 fade-in">
                    <h3 class="text-2xl font-bold text-dark-accent mb-6">Maintenance</h3>
                    <div class="mb-6">
                        <p class="text-dark-secondary mb-2">Ongoing support and updates for your system</p>
                        <p class="text-3xl font-bold text-brand-blue mb-2">$200 - $800/month</p>
                        <p class="text-sm text-dark-secondary">Depending on scope and complexity</p>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Bug fixes and patches</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Security updates</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Performance optimization</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-brand-blue mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-dark-accent">Priority support</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== FAQ Section =========== -->
    <section class="py-20 bg-dark-secondary">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-dark-accent mb-4">Frequently Asked Questions</h2>
                <p class="text-dark-secondary text-lg max-w-2xl mx-auto">Find answers to common questions about our services and pricing.</p>
            </div>

            <div class="max-w-3xl mx-auto space-y-6">
                <!-- FAQ Item 1 -->
                <div class="card-dark rounded-xl p-8 fade-in">
                    <h3 class="text-xl font-bold text-dark-accent mb-3">What is the typical project timeline?</h3>
                    <p class="text-dark-secondary leading-relaxed">
                        Project timelines vary based on complexity and scope. Basic systems typically take 4-6 weeks, Standard systems 8-12 weeks, and Premium systems 12-16 weeks. We'll provide a detailed timeline during the consultation phase.
                    </p>
                </div>

                <!-- FAQ Item 2 -->
                <div class="card-dark rounded-xl p-8 fade-in">
                    <h3 class="text-xl font-bold text-dark-accent mb-3">What are your payment terms?</h3>
                    <p class="text-dark-secondary leading-relaxed">
                        We typically require 50% upfront to begin development and 50% upon completion. For larger projects, we can arrange milestone-based payments. All prices are in USD and do not include hosting or maintenance fees.
                    </p>
                </div>

                <!-- FAQ Item 3 -->
                <div class="card-dark rounded-xl p-8 fade-in">
                    <h3 class="text-xl font-bold text-dark-accent mb-3">Is hosting included in the pricing?</h3>
                    <p class="text-dark-secondary leading-relaxed">
                        No, hosting is separate and billed annually. We offer reliable hosting starting from $150/year for basic setups. Maintenance plans are also optional and billed monthly, starting from $200/month.
                    </p>
                </div>

                <!-- FAQ Item 4 -->
                <div class="card-dark rounded-xl p-8 fade-in">
                    <h3 class="text-xl font-bold text-dark-accent mb-3">Can I customize features beyond what's listed?</h3>
                    <p class="text-dark-secondary leading-relaxed">
                        Absolutely! The pricing tiers are starting points. We can customize any plan to include additional features. Contact us for a custom quote based on your specific requirements.
                    </p>
                </div>

                <!-- FAQ Item 5 -->
                <div class="card-dark rounded-xl p-8 fade-in">
                    <h3 class="text-xl font-bold text-dark-accent mb-3">What support is included after launch?</h3>
                    <p class="text-dark-secondary leading-relaxed">
                        Each plan includes free support for a specified period (2 weeks to 2 months). After that, we offer optional maintenance plans with priority support, bug fixes, and performance optimization.
                    </p>
                </div>

                <!-- FAQ Item 6 -->
                <div class="card-dark rounded-xl p-8 fade-in">
                    <h3 class="text-xl font-bold text-dark-accent mb-3">Do you provide training for our team?</h3>
                    <p class="text-dark-secondary leading-relaxed">
                        Yes! Training and documentation are included in all plans. We provide comprehensive training on system administration, content management, and basic troubleshooting to ensure your team can manage the system independently.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Call to Action =========== -->
    <section class="py-20 bg-brand-blue text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Get Started?</h2>
                <p class="text-xl mb-8 opacity-90">Let's discuss your project requirements and find the perfect plan for your business. Schedule a free consultation today.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="contact.php" class="bg-white text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg">
                        Get Free Consultation
                    </a>
                    <a href="contact.php" class="border-2 border-white text-white text-lg font-semibold px-8 py-4 rounded-lg hover:bg-white hover:text-brand-blue transition-all duration-200">
                        Request a Quote
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>

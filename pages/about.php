<?php
$page_title = "About Us";
$page_description = "Learn about Build Syntax, our mission, values, and the team behind your next web development project.";
require_once '../includes/header.php';
?>

<main>
    <!-- =========== Hero Section =========== -->
    <section class="bg-gradient-to-br from-blue-500 to-gray-700 text-white pt-32 pb-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 fade-in">About Build Syntax</h1>
            <p class="text-xl opacity-90 max-w-3xl mx-auto fade-in">
                We are passionate developers and designers committed to transforming your digital vision into reality.
            </p>
        </div>
    </section>

    <!-- =========== Our Story =========== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Build Syntax was founded with a simple yet powerful vision: to bridge the gap between innovative ideas and exceptional digital execution. Based in the vibrant tech ecosystem of Beirut, Lebanon, we combine local expertise with global standards.
                    </p>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Our journey began with the recognition that many businesses struggle to translate their vision into effective digital solutions. We saw an opportunity to create a development partner that truly listens, understands, and delivers beyond expectations.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Today, we're proud to serve clients across the MENA region and beyond, helping them build powerful web presences that drive real business growth.
                    </p>
                </div>
                <div class="fade-in">
                    <div class="bg-gray-50 rounded-xl p-8">
                        <h3 class="text-xl font-bold mb-6 text-center">Company Highlights</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-brand-blue mb-2">2025</div>
                                <p class="text-gray-600">Founded</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-brand-blue mb-2">50+</div>
                                <p class="text-gray-600">Projects Planned</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-brand-blue mb-2">100%</div>
                                <p class="text-gray-600">Client Satisfaction</p>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-brand-blue mb-2">24h</div>
                                <p class="text-gray-600">Response Time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Mission & Vision =========== -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Mission & Vision</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Our core beliefs and aspirations that drive everything we do.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Mission -->
                <div class="bg-white rounded-xl shadow-md p-8 fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4">Our Mission</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        To empower businesses by transforming their digital visions into powerful, modern, and reliable web solutions that drive growth and success. We are committed to delivering exceptional quality while building lasting partnerships with our clients.
                    </p>
                </div>

                <!-- Vision -->
                <div class="bg-white rounded-xl shadow-md p-8 fade-in">
                    <div class="text-brand-blue mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-center mb-4">Our Vision</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        To become the leading web development partner in the MENA region, known for our technical excellence, innovative solutions, and unwavering commitment to client success. We envision a future where every business has access to world-class digital solutions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Our Values =========== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Values</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">The principles that guide our work and relationships with clients.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Value 1 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Quality First</h3>
                    <p class="text-gray-600">We never compromise on quality. Every line of code, every design element, and every feature is crafted with precision and care.</p>
                </div>

                <!-- Value 2 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Client Partnership</h3>
                    <p class="text-gray-600">We believe in true collaboration. Your vision guides our development process, and your success is our success.</p>
                </div>

                <!-- Value 3 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Innovation</h3>
                    <p class="text-gray-600">We stay at the forefront of technology, constantly learning and adopting new tools to deliver cutting-edge solutions.</p>
                </div>

                <!-- Value 4 -->
                <div class="text-center fade-in">
                    <div class="bg-brand-blue text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-3">Reliability</h3>
                    <p class="text-gray-600">We deliver on our promises. When we commit to a timeline or feature, you can count on us to deliver.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Our Approach =========== -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Approach</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">How we work with clients to ensure successful project outcomes.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center fade-in">
                    <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h3 class="text-lg font-bold mb-3">Discovery</h3>
                    <p class="text-gray-600">We start by understanding your business, goals, and vision. This foundation ensures we build exactly what you need.</p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center fade-in">
                    <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h3 class="text-lg font-bold mb-3">Planning</h3>
                    <p class="text-gray-600">We create detailed project plans, wireframes, and technical specifications to guide the development process.</p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center fade-in">
                    <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h3 class="text-lg font-bold mb-3">Development</h3>
                    <p class="text-gray-600">Our team brings your vision to life using modern technologies and best practices, with regular updates and feedback loops.</p>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-xl shadow-md p-6 text-center fade-in">
                    <div class="bg-brand-blue text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                    <h3 class="text-lg font-bold mb-3">Launch & Support</h3>
                    <p class="text-gray-600">We handle the launch process and provide ongoing support to ensure your project continues to succeed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Why Choose Us =========== -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Why Choose Build Syntax?</h2>
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-2 rounded-lg mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">Local Expertise, Global Standards</h3>
                                <p class="text-gray-600">Based in Beirut, we understand the local market while delivering solutions that meet international standards.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-2 rounded-lg mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">Fast Turnaround</h3>
                                <p class="text-gray-600">We understand that time is money. Our efficient processes ensure quick delivery without compromising quality.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-2 rounded-lg mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">Personalized Service</h3>
                                <p class="text-gray-600">As a focused team, we provide personalized attention to each project and build lasting relationships with our clients.</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-brand-blue text-white p-2 rounded-lg mt-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold mb-2">Ongoing Support</h3>
                                <p class="text-gray-600">Our relationship doesn't end at launch. We provide ongoing support and maintenance to ensure your continued success.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fade-in">
                    <div class="bg-gray-50 rounded-xl p-8">
                        <h3 class="text-xl font-bold mb-6 text-center">Our Commitment</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg">
                                <span class="font-medium">Response Time</span>
                                <span class="text-brand-blue font-bold">< 24 hours</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg">
                                <span class="font-medium">Project Updates</span>
                                <span class="text-brand-blue font-bold">Weekly</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg">
                                <span class="font-medium">Free Support</span>
                                <span class="text-brand-blue font-bold">3 months</span>
                            </div>
                            <div class="flex items-center justify-between p-4 bg-white rounded-lg">
                                <span class="font-medium">Satisfaction</span>
                                <span class="text-brand-blue font-bold">Guaranteed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========== Call to Action =========== -->
    <section class="py-20 bg-brand-blue text-white">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto fade-in">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Work Together?</h2>
                <p class="text-xl mb-8 opacity-90">Let's discuss your project and see how we can help bring your vision to life.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="contact.php" class="bg-white text-brand-blue text-lg font-semibold px-8 py-4 rounded-lg hover:bg-gray-100 transition-all duration-200 shadow-lg">
                        Get in Touch
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


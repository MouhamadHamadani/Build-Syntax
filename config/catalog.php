<?php

/*
|--------------------------------------------------------------------------
| Product Catalog — Single Source of Truth for the public site
|--------------------------------------------------------------------------
|
| Copy, features, plans and prices for the four products, custom development,
| hosting and maintenance. Read it through App\Support\Catalog only (views, Livewire
| components and tests never call config('catalog')). A price is edited in exactly one
| place: the $prices block below. Everything else that shows a price is built from it.
|
| Every claim here was checked against that product's code and demo: do not
| add features that are not built. (Custom development tiers, VPS hosting and
| maintenance plans were carried over from the old Services page and have not
| been checked against a product report.)
|
| Keys used by the home page cards:
|   accent        Tailwind accent-* class suffix (see tailwind.config.js safelist)
|   project_type  value the contact form understands (?type=, see config/products.php)
|   site          the product's own homepage
|   showcase      hero screens (public/images/showcase) and tab logos (public/images/brand)
|   plans[]       name, price, unit, featured, description
| Keys used by the Services page: plans[].summary / period / billing / features /
| meta / cta, plus the product-level 'service' block.
|
*/

// All prices on the site. Display strings, shown exactly as written.
$prices = [
    'menu' => ['basic' => '$19', 'pro' => '$49', 'premium' => '$99'],
    'menu_year' => ['basic' => '$190', 'pro' => '$490', 'premium' => '$990'],
    'shop' => ['basic' => '$1,200', 'standard' => '$2,000', 'premium' => '$2,200'],
    'booking_setup' => ['starter' => '$349', 'business' => '$749'],
    'booking_month' => ['starter' => '$35', 'business' => '$69'],
    'booking_year' => ['starter' => '$350', 'business' => '$690'],
    'booking_extra_calendar' => '$10',
    'pos' => ['starter' => '$600', 'standard' => '$850'],
    'web' => ['starter' => '$800', 'professional' => '$1,500'],
    'vps' => ['small' => '$200', 'medium' => '$300', 'high' => '$500'],
    'care' => ['essential' => '$79', 'basic' => '$150', 'standard' => '$250', 'premium' => '$400'],
];

$shopNote = ['strong' => 'All prices start from, paid once.', 'text' => 'Payment is 50% to start, 30% on delivery and 20% after training. Other terms on request.'];
$posNote = ['strong' => 'You pay once it is installed, with no deposit.', 'text' => 'We install it for you and set up your account. Want to try it first? Contact us and we will install the demo for you.'];
$customIntro = 'Company websites, admin dashboards and management systems, built on Laravel and Livewire and shaped around how your team already works.';

return [
    'products' => [
        'cartenex' => [
            'name' => 'CarteNex',
            'slug' => 'cartenex',
            'accent' => 'saffron',
            'project_type' => 'cartenex',
            'tagline' => 'Digital menus',
            'description' => 'A QR menu your customers open on their phone. Change items, prices and photos from your own phone, in Arabic and English, and the menu updates straight away.',
            'features' => [
                'Download your QR code, ready to print',
                'Categories, photos, dietary tags and size options with their own prices',
                'Search and category filters for your guests',
                'Mark items sold out or featured with one tap',
                'Arabic and English menu, right-to-left, with a language toggle',
            ],
            'for' => 'cafés, restaurants, clinics and services.',
            'for_extra' => '14-day free trial, no card.',
            'for_extra_strong' => true,
            'price' => ['from' => $prices['menu']['basic'], 'unit' => ' / month'],
            'site' => 'https://cartenex.build-syntax.com',
            'demo' => ['url' => 'https://cartenex.build-syntax.com/olea', 'label' => 'See a demo menu'],
            'plans_label' => 'CarteNex plans',
            'plans' => [
                [
                    'name' => 'Basic', 'featured' => false,
                    'price' => $prices['menu']['basic'], 'unit' => '/mo', 'period' => ' / month',
                    'billing' => 'or ' . $prices['menu_year']['basic'] . ' a year',
                    'summary' => 'Everything you need for a small menu.',
                    'description' => '50 items, 1 staff account',
                    'features' => ['50 items', '1 staff account'],
                    'meta' => null, 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Pro', 'featured' => true,
                    'price' => $prices['menu']['pro'], 'unit' => '/mo', 'period' => ' / month',
                    'billing' => 'or ' . $prices['menu_year']['pro'] . ' a year',
                    'summary' => 'For menus that need your own look.',
                    'description' => '300 items, 5 staff accounts, your own accent colour, no “Powered by” badge, view analytics',
                    'features' => ['300 items', '5 staff accounts', 'Your own accent colour', 'No “Powered by” badge', 'View analytics'],
                    'meta' => null, 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Premium', 'featured' => false,
                    'price' => $prices['menu']['premium'], 'unit' => '/mo', 'period' => ' / month',
                    'billing' => 'or ' . $prices['menu_year']['premium'] . ' a year',
                    'summary' => 'No limits.',
                    'description' => 'Everything in Pro, with unlimited items and staff',
                    'features' => ['Everything in Pro', 'Unlimited items', 'Unlimited staff accounts'],
                    'meta' => null, 'cta' => 'Request this plan',
                ],
            ],
            'note' => 'Pay yearly and get 2 months free: ' . $prices['menu_year']['basic'] . ', ' . $prices['menu_year']['pro'] . ' or ' . $prices['menu_year']['premium'] . ' a year.',
            'showcase' => [
                'title' => 'CarteNex · OLEA demo menu',
                'laptop' => ['file' => 'cartenex-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'CarteNex demo menu for the OLEA café on a laptop'],
                'phone' => ['file' => 'cartenex-phone.webp', 'width' => 380, 'height' => 676, 'alt' => 'CarteNex menu on a phone'],
                'tab' => ['logo' => 'cartenex-lockup.svg', 'width' => 113, 'height' => 24, 'wordmark' => null],
            ],
            'service' => [
                'anchor' => 'cartenex',
                'legacy_anchors' => ['menus'],
                // Heading logo; when 'wordmark' is set the logo is decorative (alt "") and the word is live text.
                'logo' => ['file' => 'cartenex-lockup.svg', 'width' => 226, 'height' => 48, 'alt' => 'CarteNex', 'wordmark' => null],
                'secondary_cta' => ['label' => 'Start the free trial', 'plan' => 'Free trial'],
                'note' => ['strong' => 'Pay yearly and get 2 months free.', 'text' => 'Every plan starts with a 14-day free trial, no card needed.'],
            ],
        ],

        'shopnex' => [
            'name' => 'ShopNex',
            'slug' => 'shopnex',
            'accent' => 'emerald',
            'project_type' => 'ecommerce',
            'tagline' => 'Online store',
            'description' => 'A bilingual online store with orders, stock and delivery in one dashboard. Give customers a proper place to order, instead of selling through DMs.',
            'features' => [
                'Products with size options',
                'Stock goes down when an order comes in and back up when it is cancelled or returned',
                'Orders dashboard with a returns workflow',
                'Guest checkout, with pay on delivery or pickup',
                'Delivery zones and fees you set, with free shipping above an amount you choose',
                'Arabic and English, right-to-left',
            ],
            'for' => 'boutiques, food brands, retailers.',
            'for_extra' => 'Online card payments are not available yet.',
            'for_extra_strong' => false,
            'price' => ['from' => $prices['shop']['basic'], 'unit' => ' one-off'],
            'site' => 'https://shopnex.build-syntax.com',
            'demo' => ['url' => 'https://shopnex.build-syntax.com', 'label' => 'See the demo store'],
            'plans_label' => 'ShopNex packages',
            'plans' => [
                [
                    'name' => 'Basic', 'featured' => false,
                    'price' => $prices['shop']['basic'], 'unit' => null, 'period' => ' one-off', 'billing' => null,
                    'summary' => 'Your store, live and taking orders.',
                    'description' => 'Products, cart and checkout, orders, admin dashboard, basic SEO. 4 to 6 weeks, 1 month of support.',
                    'features' => ['Products, cart and checkout', 'Orders and admin dashboard', 'Basic SEO'],
                    'meta' => '4 to 6 weeks · 1 month of support', 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Standard', 'featured' => true,
                    'price' => $prices['shop']['standard'], 'unit' => null, 'period' => ' one-off', 'billing' => null,
                    'summary' => 'Adds the tools that save you time.',
                    'description' => 'Adds analytics, low-stock alerts, email notifications, reviews, coupons and wishlist. 7 to 10 weeks, 2 months of support.',
                    'features' => ['Everything in Basic', 'Analytics', 'Low-stock alerts', 'Email notifications', 'Reviews, coupons and wishlist'],
                    'meta' => '7 to 10 weeks · 2 months of support', 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Premium', 'featured' => false,
                    'price' => $prices['shop']['premium'], 'unit' => null, 'period' => ' one-off', 'billing' => null,
                    'summary' => 'For larger catalogues and teams.',
                    'description' => 'Adds multi-currency display (USD and LBP), role permissions and priority support. 10 to 14 weeks, 3 months of support.',
                    'features' => ['Everything in Standard', 'Multi-currency display (USD and LBP)', 'Role permissions', 'Priority support'],
                    'meta' => '10 to 14 weeks · 3 months of support', 'cta' => 'Request this plan',
                ],
            ],
            'note' => $shopNote['strong'] . ' ' . $shopNote['text'],
            'showcase' => [
                'title' => 'ShopNex · demo store',
                'laptop' => ['file' => 'shopnex-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'ShopNex demo store, Fashion category'],
                'phone' => ['file' => 'shopnex-phone.webp', 'width' => 380, 'height' => 822, 'alt' => 'ShopNex product page on a phone'],
                'tab' => ['logo' => 'shopnex-logo.svg', 'width' => 83, 'height' => 24, 'wordmark' => null],
            ],
            'service' => [
                'anchor' => 'shopnex',
                'legacy_anchors' => ['ecommerce'],
                'logo' => ['file' => 'shopnex-logo.svg', 'width' => 440, 'height' => 128, 'alt' => 'ShopNex', 'wordmark' => null],
                'secondary_cta' => null,
                'note' => $shopNote,
            ],
        ],

        'tymelo' => [
            'name' => 'Tymelo',
            'slug' => 'tymelo',
            'accent' => 'tymelo',
            'project_type' => 'appointment',
            'tagline' => 'Appointments',
            'description' => 'Clients pick a free slot and book themselves, with or without an account. You see every booking, client and time off in one admin.',
            'features' => [
                'A 4-step booking page: service, time, your details, confirm',
                'Working hours, breaks, days off and closures',
                'Email once you confirm a booking, and a reminder 24 hours before',
                'Clients cancel or reschedule within a window you set',
                'A client list, with WhatsApp buttons to message them',
                'Arabic and English, right-to-left',
            ],
            'for' => 'clinics, salons, studios.',
            'for_extra' => 'The demo is a sample skin clinic. Payments and deposits are recorded by you (Whish, OMT or cash).',
            'for_extra_strong' => false,
            'price' => ['from' => $prices['booking_setup']['starter'], 'unit' => ' setup + ' . $prices['booking_month']['starter'] . ' / month'],
            'site' => 'https://tymelo.build-syntax.com',
            'demo' => ['url' => 'https://tymelo.build-syntax.com/book-guest', 'label' => 'Try the booking page'],
            'plans_label' => 'Tymelo plans',
            'plans' => [
                [
                    'name' => 'Starter', 'featured' => false,
                    'price' => $prices['booking_setup']['starter'], 'unit' => ' + ' . $prices['booking_month']['starter'] . '/mo', 'period' => ' setup',
                    'billing' => 'then ' . $prices['booking_month']['starter'] . ' a month · or ' . $prices['booking_year']['starter'] . ' a year',
                    'summary' => 'Install, branding, hosting, backups and SSL included.',
                    'description' => 'Install, branding, hosting, backups and SSL included. Unlimited services, 1 staff calendar, guest booking, email confirmations and reminders, WhatsApp buttons. 30-minute handover, 72-hour support.',
                    'features' => ['Unlimited services, 1 staff calendar', 'Guest booking', 'Email confirmations and reminders', 'WhatsApp buttons'],
                    'meta' => '30-minute handover · 72-hour support', 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Business', 'featured' => true,
                    'price' => $prices['booking_setup']['business'], 'unit' => ' + ' . $prices['booking_month']['business'] . '/mo', 'period' => ' setup',
                    'billing' => 'then ' . $prices['booking_month']['business'] . ' a month · or ' . $prices['booking_year']['business'] . ' a year',
                    'summary' => 'Everything in Starter, plus the tools for busier places.',
                    'description' => 'Everything in Starter, plus approval mode, waitlist, intake forms, deposit tracking (unpaid holds release after 2 hours), a booking widget for your site, custom domain, client notes and tags, no-show heatmap, performance dashboard, CSV export. 1-hour onboarding, 24-hour support.',
                    'features' => [
                        'Approval mode and waitlist',
                        'Intake forms',
                        'Deposit tracking (unpaid holds release after 2 hours)',
                        'A booking widget for your site, and a custom domain',
                        'Client notes and tags',
                        'No-show heatmap and performance dashboard',
                        'CSV export',
                    ],
                    'meta' => '1-hour onboarding · 24-hour support', 'cta' => 'Request this plan',
                ],
            ],
            'note' => 'Setup is paid once, then monthly. Pay yearly and get 2 months free: ' . $prices['booking_year']['starter'] . ' or ' . $prices['booking_year']['business'] . ' a year. Extra staff calendars are ' . $prices['booking_extra_calendar'] . ' a month each. Larger setups get a custom quote.',
            'showcase' => [
                'title' => 'Tymelo · demo clinic booking',
                'laptop' => ['file' => 'tymelo-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'Tymelo booking page choosing a time'],
                'phone' => ['file' => 'tymelo-phone.webp', 'width' => 380, 'height' => 822, 'alt' => 'Tymelo booking page on a phone'],
                // The mark has no text: the "Tymelo" wordmark next to it is live text in Plus Jakarta Sans.
                'tab' => ['logo' => 'tymelo-mark.svg', 'width' => 24, 'height' => 24, 'wordmark' => 'Tymelo', 'jakarta' => true],
            ],
            'service' => [
                'anchor' => 'tymelo',
                'legacy_anchors' => ['appointment'],
                'logo' => ['file' => 'tymelo-mark.svg', 'width' => 32, 'height' => 32, 'alt' => '', 'wordmark' => 'Tymelo', 'jakarta' => true],
                'secondary_cta' => null,
                'note' => [
                    'strong' => 'Setup is paid once, then monthly.',
                    'text' => 'Pay yearly and get 2 months free. Extra staff calendars are ' . $prices['booking_extra_calendar'] . ' a month each. Larger setups get a custom quote.',
                ],
            ],
        ],

        'lebasouk' => [
            'name' => 'LebaSouk POS',
            'slug' => 'lebasouk',
            'accent' => 'terracotta',
            'project_type' => 'pos',
            'tagline' => 'Point of sale',
            'description' => 'A point of sale that runs on your shop\'s own Windows PC, with no internet needed to sell and no monthly software fee. English screens for now.',
            'features' => [
                'Product grid with search, categories, and retail, wholesale and VIP prices',
                'Hold a sale and recall it later',
                'Prices in USD, with LBP worked out from the rate you set',
                'Pay one sale part in USD and part in LBP, with change in either',
                'Stock counts, stock movements and manual adjustments',
                'Open and close shifts with USD and LBP cash counts',
                'Thermal receipts and A4 invoices, printed through Windows',
                'Daily sales, stock, expense and profit reports',
            ],
            'for' => 'shops, minimarkets, food businesses.',
            'for_extra' => 'Runs on one Windows PC per shop for now.',
            'for_extra_strong' => false,
            'price' => ['from' => $prices['pos']['starter'], 'unit' => ' paid once, no deposit'],
            'site' => 'https://lebasouk.build-syntax.com',
            'demo' => ['url' => 'https://lebasouk.build-syntax.com/pricing', 'label' => 'See pricing'],
            'plans_label' => 'LebaSouk POS plans',
            'plans' => [
                [
                    'name' => 'Starter', 'featured' => false,
                    'price' => $prices['pos']['starter'], 'unit' => null, 'period' => ' paid once', 'billing' => null,
                    'summary' => 'Run one counter.',
                    'description' => '1 user with Manager and Cashier roles, expenses and stock movements.',
                    'features' => ['1 user with Manager and Cashier roles', 'Expenses and stock movements'],
                    'meta' => null, 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Standard', 'featured' => true,
                    'price' => $prices['pos']['standard'], 'unit' => null, 'period' => ' paid once', 'billing' => null,
                    'summary' => 'For shops with a team.',
                    'description' => '3 users and four roles. Adds returns with manager approval, suppliers and purchase orders, and reports by product, stock level and profit and loss.',
                    'features' => ['3 users and four roles', 'Returns with manager approval', 'Suppliers and purchase orders', 'Reports by product, stock level and profit and loss'],
                    'meta' => null, 'cta' => 'Request this plan',
                ],
                // No price yet: both pages show "Contact us" in its place.
                [
                    'name' => 'Premium', 'featured' => false,
                    'price' => null, 'unit' => 'Contact us', 'period' => null, 'billing' => null,
                    'summary' => 'Unlimited users.',
                    'description' => 'Unlimited users. Contact us for a quote.',
                    'features' => ['Unlimited users', 'Quoted for your shop'],
                    'meta' => null, 'cta' => 'Contact us',
                ],
            ],
            'note' => $posNote['strong'] . ' ' . $posNote['text'],
            'showcase' => [
                'title' => 'LebaSouk POS · demo data',
                'laptop' => ['file' => 'lebasouk-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'LebaSouk POS sales screen with items in the cart'],
                'phone' => null,
                'tab' => ['logo' => 'lebasouk-mark.svg', 'width' => 26, 'height' => 26, 'wordmark' => 'LebaSouk'],
            ],
            'service' => [
                'anchor' => 'pos',
                'legacy_anchors' => [],
                'logo' => ['file' => 'lebasouk-mark.svg', 'width' => 100, 'height' => 100, 'alt' => '', 'wordmark' => 'LebaSouk POS'],
                'secondary_cta' => ['label' => 'Ask for the demo', 'plan' => 'Demo'],
                'note' => $posNote,
            ],
        ],
    ],

    'custom' => [
        'name' => 'Custom development',
        'slug' => 'custom',
        'accent' => 'brand',
        'project_type' => 'website',
        'tagline' => 'Custom development',
        'headline' => 'Something that does not exist yet?',
        'description' => $customIntro,
        'price' => ['from' => $prices['web']['professional'], 'unit' => null],
        'cta' => 'Describe your project',
        // Shown in a code-style block under a "Stack" label; the last line is highlighted.
        'stack' => ['Laravel', 'Livewire', 'Tailwind CSS', 'Alpine.js', 'Arabic + English, RTL'],

        // Services page section
        'service' => [
            'anchor' => 'web-development',
            'heading' => 'Websites and web applications',
            'intro' => $customIntro . ' Every package includes design, development, testing, deployment assistance and a documented handover.',
            'points' => [
                'Laravel and Livewire',
                'Tailwind CSS and Alpine.js',
                'Arabic and English, right-to-left',
                'Priced per project, billed in stages we agree in writing',
            ],
            'plans' => [
                [
                    'name' => 'Starter', 'featured' => false,
                    'prefix' => 'From ', 'price' => $prices['web']['starter'], 'unit' => null, 'period' => null, 'billing' => null,
                    'summary' => 'Landing page or brochure website to establish your online presence.',
                    'features' => ['Landing page or brochure website', 'Up to 5 pages', 'Template-based or semi-custom design', 'WhatsApp and contact form integration', 'Basic SEO and Google Analytics', 'Mobile responsive'],
                    'meta' => '2 to 3 weeks · 1 month of support', 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Professional', 'featured' => true,
                    'prefix' => 'From ', 'price' => $prices['web']['professional'], 'unit' => null, 'period' => null, 'billing' => null,
                    'summary' => 'Full business website with a CMS, a blog, advanced SEO and bilingual support.',
                    'features' => ['5 to 20 pages, fully custom design', 'CMS for self-managed content', 'Blog or news module', 'Advanced SEO and schema markup', 'Performance and speed optimisation', 'Arabic and English support'],
                    'meta' => '3 to 6 weeks · 2 months of support', 'cta' => 'Request this plan',
                ],
                [
                    'name' => 'Enterprise', 'featured' => false,
                    'price' => null, 'unit' => 'Custom quote', 'period' => null, 'billing' => null,
                    'summary' => 'Custom web applications and portals with complex logic and dedicated support.',
                    'features' => ['Custom web applications and portals', 'Complex logic and user roles', 'API integrations (CRM, ERP and others)', 'Custom dashboards and reporting', 'Third-party payment processing', 'Scalable cloud infrastructure'],
                    'meta' => 'Timeline and price set per project · dedicated support plan', 'cta' => 'Get a custom quote',
                ],
            ],
        ],
    ],

    // VPS hosting tiers (Services page)
    'hosting' => [
        'heading' => 'VPS hosting',
        'intro' => 'You own the server subscription. We handle the full configuration and hardening. Every tier includes VPS setup and configuration, SSL, daily backups, security hardening and monitoring.',
        'tiers' => [
            ['name' => 'Small sites', 'price' => $prices['vps']['small'], 'period' => ' / year', 'features' => ['Traffic: up to about 5,000 visits a month', 'Ideal for: brochure and informational sites']],
            ['name' => 'Medium traffic', 'price' => $prices['vps']['medium'], 'period' => ' / year', 'features' => ['Traffic: 5,000 to 20,000 visits a month', 'Ideal for: active e-commerce and booking sites']],
            ['name' => 'High traffic', 'price' => $prices['vps']['high'], 'period' => ' / year', 'features' => ['Traffic: 20,000+ visits a month', 'Ideal for: business-critical platforms']],
        ],
    ],

    // Monthly maintenance plans (Services page)
    'maintenance' => [
        'heading' => 'Monthly maintenance',
        'intro' => 'Billed monthly, with a minimum 3-month commitment.',
        // Contact form type for hosting and maintenance enquiries
        'project_type' => 'other',
        'plans' => [
            [
                'name' => 'Essential', 'plan_key' => 'Maintenance-Essential', 'featured' => false,
                'price' => $prices['care']['essential'], 'unit' => null, 'period' => ' / month', 'billing' => null,
                'summary' => 'Keep-the-lights-on for live brochure sites.',
                'features' => ['Security and dependency updates', 'Uptime monitoring', 'SSL certificate renewal', 'Monthly health report', 'Email support (48-hour response)'],
                'meta' => 'Does not include feature changes or bug fixes.', 'cta' => 'Request this plan',
            ],
            [
                'name' => 'Basic', 'plan_key' => 'Maintenance-Basic', 'featured' => false,
                'price' => $prices['care']['basic'], 'unit' => null, 'period' => ' / month', 'billing' => null,
                'summary' => 'Small brochure and informational sites.',
                'features' => ['Bug fixes', 'Security patches', 'Plugin and package updates', 'Monthly health report'],
                'meta' => null, 'cta' => 'Request this plan',
            ],
            [
                'name' => 'Standard', 'plan_key' => 'Maintenance-Standard', 'featured' => true,
                'price' => $prices['care']['standard'], 'unit' => null, 'period' => ' / month', 'billing' => null,
                'summary' => 'E-commerce and booking platforms in active use.',
                'features' => ['Everything in Basic', 'Performance optimisation', 'Priority support response', 'Minor content updates', 'Uptime monitoring'],
                'meta' => null, 'cta' => 'Request this plan',
            ],
            [
                'name' => 'Premium', 'plan_key' => 'Maintenance-Premium', 'featured' => false,
                'price' => $prices['care']['premium'], 'unit' => null, 'period' => ' / month', 'billing' => null,
                'summary' => 'High-traffic or business-critical platforms.',
                'features' => ['Everything in Standard', 'Small feature additions (up to 4 hours a month)', 'Database optimisation', 'Emergency incident response', 'Quarterly strategy review'],
                'meta' => null, 'cta' => 'Request this plan',
            ],
        ],
    ],
];

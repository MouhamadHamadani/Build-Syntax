<?php

/*
|--------------------------------------------------------------------------
| Product Catalog — Single Source of Truth for the public site
|--------------------------------------------------------------------------
|
| Marketing copy, features and prices for the four products and custom
| development. The home page cards read it today, the Services page next.
| Every claim here was checked against that product's code and demo: do not
| add features that are not built.
|
| 'accent' is the Tailwind accent-* class suffix, 'project_type' is the value
| the contact form understands (?type=, see config/products.php), 'site' is the
| product's own homepage. 'showcase' files live in public/images/showcase
| (screens) and public/images/brand (tab logos).
|
*/

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
            'price' => ['from' => '$19', 'unit' => ' / month'],
            'site' => 'https://cartenex.build-syntax.com',
            'demo' => ['url' => 'https://cartenex.build-syntax.com/olea', 'label' => 'See a demo menu'],
            'plans_label' => 'CarteNex plans',
            'plans' => [
                ['name' => 'Basic', 'price' => '$19', 'unit' => '/mo', 'featured' => false, 'description' => '50 items, 1 staff account'],
                ['name' => 'Pro', 'price' => '$49', 'unit' => '/mo', 'featured' => true, 'description' => '300 items, 5 staff accounts, your own accent colour, no “Powered by” badge, view analytics'],
                ['name' => 'Premium', 'price' => '$99', 'unit' => '/mo', 'featured' => false, 'description' => 'Everything in Pro, with unlimited items and staff'],
            ],
            'note' => 'Pay yearly and get 2 months free: $190, $490 or $990 a year.',
            'showcase' => [
                'title' => 'CarteNex · OLEA demo menu',
                'laptop' => ['file' => 'cartenex-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'CarteNex demo menu for the OLEA café on a laptop'],
                'phone' => ['file' => 'cartenex-phone.webp', 'width' => 380, 'height' => 676, 'alt' => 'CarteNex menu on a phone'],
                'tab' => ['logo' => 'cartenex-lockup.svg', 'width' => 113, 'height' => 24, 'wordmark' => null],
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
            'price' => ['from' => '$1,200', 'unit' => ' one-off'],
            'site' => 'https://shopnex.build-syntax.com',
            'demo' => ['url' => 'https://shopnex.build-syntax.com', 'label' => 'See the demo store'],
            'plans_label' => 'ShopNex packages',
            'plans' => [
                ['name' => 'Basic', 'price' => '$1,200', 'unit' => null, 'featured' => false, 'description' => 'Products, cart and checkout, orders, admin dashboard, basic SEO. 4 to 6 weeks, 1 month of support.'],
                ['name' => 'Standard', 'price' => '$2,000', 'unit' => null, 'featured' => true, 'description' => 'Adds analytics, low-stock alerts, email notifications, reviews, coupons and wishlist. 7 to 10 weeks, 2 months of support.'],
                ['name' => 'Premium', 'price' => '$2,200', 'unit' => null, 'featured' => false, 'description' => 'Adds multi-currency display (USD and LBP), role permissions and priority support. 10 to 14 weeks, 3 months of support.'],
            ],
            'note' => 'All prices start from, paid once. Payment is 50% to start, 30% on delivery and 20% after training. Other terms on request.',
            'showcase' => [
                'title' => 'ShopNex · demo store',
                'laptop' => ['file' => 'shopnex-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'ShopNex demo store, Fashion category'],
                'phone' => ['file' => 'shopnex-phone.webp', 'width' => 380, 'height' => 822, 'alt' => 'ShopNex product page on a phone'],
                'tab' => ['logo' => 'shopnex-logo.svg', 'width' => 83, 'height' => 24, 'wordmark' => null],
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
            'price' => ['from' => '$349', 'unit' => ' setup + $35 / month'],
            'site' => 'https://tymelo.build-syntax.com',
            'demo' => ['url' => 'https://tymelo.build-syntax.com/book-guest', 'label' => 'Try the booking page'],
            'plans_label' => 'Tymelo plans',
            'plans' => [
                ['name' => 'Starter', 'price' => '$349', 'unit' => ' + $35/mo', 'featured' => false, 'description' => 'Install, branding, hosting, backups and SSL included. Unlimited services, 1 staff calendar, guest booking, email confirmations and reminders, WhatsApp buttons. 30-minute handover, 72-hour support.'],
                ['name' => 'Business', 'price' => '$749', 'unit' => ' + $69/mo', 'featured' => true, 'description' => 'Everything in Starter, plus approval mode, waitlist, intake forms, deposit tracking (unpaid holds release after 2 hours), a booking widget for your site, custom domain, client notes and tags, no-show heatmap, performance dashboard, CSV export. 1-hour onboarding, 24-hour support.'],
            ],
            'note' => 'Setup is paid once, then monthly. Pay yearly and get 2 months free: $350 or $690 a year. Extra staff calendars are $10 a month each. Larger setups get a custom quote.',
            'showcase' => [
                'title' => 'Tymelo · demo clinic booking',
                'laptop' => ['file' => 'tymelo-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'Tymelo booking page choosing a time'],
                'phone' => ['file' => 'tymelo-phone.webp', 'width' => 380, 'height' => 822, 'alt' => 'Tymelo booking page on a phone'],
                // The mark has no text: the "Tymelo" wordmark next to it is live text in Plus Jakarta Sans.
                'tab' => ['logo' => 'tymelo-mark.svg', 'width' => 24, 'height' => 24, 'wordmark' => 'Tymelo', 'jakarta' => true],
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
            'price' => ['from' => '$600', 'unit' => ' paid once, no deposit'],
            'site' => 'https://lebasouk.build-syntax.com',
            'demo' => ['url' => 'https://lebasouk.build-syntax.com/pricing', 'label' => 'See pricing'],
            'plans_label' => 'LebaSouk POS plans',
            'plans' => [
                ['name' => 'Starter', 'price' => '$600', 'unit' => null, 'featured' => false, 'description' => '1 user with Manager and Cashier roles, expenses and stock movements.'],
                ['name' => 'Standard', 'price' => '$850', 'unit' => null, 'featured' => true, 'description' => '3 users and four roles. Adds returns with manager approval, suppliers and purchase orders, and reports by product, stock level and profit and loss.'],
                // No price yet: shown as a "Contact us" link.
                ['name' => 'Premium', 'price' => null, 'unit' => 'Contact us', 'featured' => false, 'description' => 'Unlimited users. Contact us for a quote.'],
            ],
            'note' => 'You pay once it is installed, with no deposit. We install it for you and set up your account. Want to try it first? Contact us and we will install the demo for you.',
            'showcase' => [
                'title' => 'LebaSouk POS · demo data',
                'laptop' => ['file' => 'lebasouk-laptop.webp', 'width' => 1100, 'height' => 688, 'alt' => 'LebaSouk POS sales screen with items in the cart'],
                'phone' => null,
                'tab' => ['logo' => 'lebasouk-mark.svg', 'width' => 26, 'height' => 26, 'wordmark' => 'LebaSouk'],
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
        'description' => 'Company websites, admin dashboards and management systems, built on Laravel and Livewire and shaped around how your team already works.',
        'price' => ['from' => '$1,500', 'unit' => null],
        'cta' => 'Describe your project',
        // Shown in a code-style block under a "Stack" label; the last line is highlighted.
        'stack' => ['Laravel', 'Livewire', 'Tailwind CSS', 'Alpine.js', 'Arabic + English, RTL'],
    ],
];

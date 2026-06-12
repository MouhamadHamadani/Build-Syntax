<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    /**
     * Serve sitemap.xml dynamically (small dataset; no caching needed).
     */
    public function __invoke()
    {
        $sitemap = Sitemap::create();

        // Static public pages.
        $staticPages = [
            ['url' => route('home'),             'priority' => 1.0, 'frequency' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => route('services'),         'priority' => 0.9, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('portfolio'),        'priority' => 0.8, 'frequency' => Url::CHANGE_FREQUENCY_WEEKLY],
            ['url' => route('about'),            'priority' => 0.7, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('contact'),          'priority' => 0.7, 'frequency' => Url::CHANGE_FREQUENCY_MONTHLY],
            ['url' => route('privacy-policy'),   'priority' => 0.3, 'frequency' => Url::CHANGE_FREQUENCY_YEARLY],
            ['url' => route('terms-of-service'), 'priority' => 0.3, 'frequency' => Url::CHANGE_FREQUENCY_YEARLY],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['frequency'])
                    ->setLastModificationDate(Carbon::now())
            );
        }

        // Blog URLs (index + published posts) intentionally omitted while the
        // blog is unlinked from the navigation — re-add when the blog goes live.

        return response($sitemap->render(), 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}

<?php

return [

    /*
     | --------------------------------------------------------------------------
     | Crawl Profile
     | --------------------------------------------------------------------------
     | You can tell the crawler not to visit certain urls by using the profile.
     |
     | This option control which profile to use during crawling urls.
     | you may specify any of the wonderful profiles provided here.
     |
     | Supported: "profile", "allUrls", "subdomains", "internalUrls"
     */
    'profile' => env('CRAWLER_PROFILE','subdomains'),

    /*
     | --------------------------------------------------------------------------
     | Concurrent Requests
     | --------------------------------------------------------------------------
     | You can tell the crawler how much urls to crawl concurrently.
     |
     | This option control the concurrent requests for crawling urls.
     | you may specify any number here depending on your needs.
     |
     | Tip: improve the speed of the crawl
     */
    'concurrency' => env('CRAWLER_CONCURRENCY',10),

    /*
     | --------------------------------------------------------------------------
     | Delay between requests
     | --------------------------------------------------------------------------
     | You can tell the crawler how much time to wait between each request.
     |
     | This option control the delay between each requests made by crawler.
     | you may specify any number here in milliseconds.
     |
     | Tip: prevent rate-limit when crawling too aggressively
     */
    'delayBetweenRequests' => env('CRAWLER_DELAY_BETWEEN_REQUESTS',150),
];
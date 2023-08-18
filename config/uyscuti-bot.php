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

    /*
     | --------------------------------------------------------------------------
     | Total Crawl Limit
     | --------------------------------------------------------------------------
     | You can tell the crawler total number of urls to crawl.
     |
     | This option control the total number of urls to crawl during crawling.
     | you may specify any number here.
     |
     | Tip: set it null to crawl all urls
     */
    'totalCrawlLimit' => env('CRAWLER_TOTAL_CRAWL_LIMIT',null),

    /*
     | --------------------------------------------------------------------------
     | Current Crawl Limit
     | --------------------------------------------------------------------------
     | You can tell the crawler how many urls to crawl per execution.
     |
     | This option control how many urls to crawled per execution during crawling.
     | you may specify any number here.
     |
     | Tip: set it null to crawl all urls
     */
    'currentCrawlLimit' => env('CRAWLER_CURRENT_CRAWL_LIMIT',null),

    /*
     | --------------------------------------------------------------------------
     | Maximum Crawl Depth
     | --------------------------------------------------------------------------
     | You can tell the crawler the maximum depth of the crawling.
     |
     | This option control the maximum depth limit of the crawler during crawling.
     | you may specify any number here.
     |
     | Tip: set it null to crawl all urls
     */
    'maximumDepth' => env('CRAWLER_MAXIMUM_DEPTH',null),
];
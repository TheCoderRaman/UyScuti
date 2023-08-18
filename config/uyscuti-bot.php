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
    'profile' => 'subdomains',

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
    'concurrency' => 10,
];
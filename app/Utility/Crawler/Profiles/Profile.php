<?php

namespace App\Utility\Crawler\Profiles;

use Psr\Http\Message\UriInterface;
use App\Utility\Urls\CrawledUrlAtlas;
use Spatie\Crawler\CrawlProfiles\CrawlProfile;

class Profile extends CrawlProfile
{
    /**
     * Determine if the given url should be crawled.
     *
     * @param UriInterface $url
     * @return bool
     */
    public function shouldCrawl(UriInterface $url): bool
    {
        return !(app(
            CrawledUrlAtlas::class)->isExists($url)
        );
    }
}
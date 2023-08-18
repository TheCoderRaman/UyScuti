<?php

namespace App\Utility\Crawler\Profiles;

use Psr\Http\Message\UriInterface;
use App\Utility\Urls\CrawledUrlAtlas;
use App\Console\Commands\CrawlerCommand;
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
        if(!app(CrawledUrlAtlas::class)->isExists($url)){
            return true;
        }

        if(app()->runningInConsole()){
            app(CrawlerCommand::class)->question(
                sprintf("Already Crawled: %s",$url)
            );
    
            app(CrawlerCommand::class)->line("\n");
        }

        return false;
    }
}
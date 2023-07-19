<?php

namespace App\Utility\Crawler\Observers;


use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\UriInterface;
use App\Utility\Crawler\UyScutiBot;
use App\Utility\Urls\CrawledUrlAtlas;
use App\Console\Commands\CrawlerCommand;
use GuzzleHttp\Exception\RequestException;
use Spatie\Crawler\CrawlObservers\CrawlObserver;

abstract class Observer extends CrawlObserver
{
    /**
     * Called when the crawler will crawl the url.
     * 
     * @param UriInterface $url
     * @param ?string $linkText
     * @return void
     */
    public function willCrawl(
        UriInterface $url, 
        ?string $linkText
    ): void {
        if(!app()->hasDebugModeEnabled()){
            return;
        }

        if(!app()->runningInConsole()){
            return;
        }
        
        app(CrawlerCommand::class)->comment(
            sprintf("Will Crawl: %s",$url)
        );
    }
    
    /**
     * Called when the crawl has ended.
     * 
     * @return void
     */
    public function finishedCrawling(): void
    {
        if(!app()->hasDebugModeEnabled()){
            return;
        }

        if(!app()->runningInConsole()){
            return;
        }
        
        app(CrawlerCommand::class)->info(
            "Crawling Finised"
        );
    }

    /**
     * Called when the crawler had a problem crawling the given url.
     * 
     * @param UriInterface $url
     * @param RequestException $requestException
     * @param ?UriInterface $foundOnUrl
     * @param ?string $linkText
     * @return void
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null
    ): void {
        DB::rollBack();

        if(!app(CrawledUrlAtlas::class)->isExists($url)){
            app(CrawledUrlAtlas::class)->crawled("",'failed',$url);
        }

        if(!app()->hasDebugModeEnabled()){
            return;
        }

        if(!app()->runningInConsole()){
            return;
        }
        
        app(CrawlerCommand::class)->error(
            sprintf("Crawled Failed: %s",$url)
        );

        app(CrawlerCommand::class)->line("\n");
    }

    /**
     * Check url is supported by current observer.
     * 
     * @param UriInterface $url
     * @param array $headers
     * @param array $types
     */
    protected function isSupported(
        UriInterface $url,
        array $headers,
        array $types
    ): bool {
        $mime = Arr::get($headers,'Content-Type.0','');

        $type = (UyScutiBot::$typeSniffer
            ->analyzer($mime)
        );

        if(!$type){
            $type = (UyScutiBot::$typeSniffer
                ->analyzer((string) $url)
            );
        }

        return in_array($type,$types);
    }
};

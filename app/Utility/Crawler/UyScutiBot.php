<?php

namespace App\Utility\Crawler;

use Exception;

use Spatie\Crawler\Crawler;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Utility\Crawler\Queues\Queue;
use App\Utility\Crawler\Queues\QueueList;
use App\Utility\Crawler\Observers\Observer;
use App\Utility\Crawler\Sniffer\TypeSniffer;
use App\Utility\Crawler\Observers\SiteObserver;
use App\Utility\Crawler\Observers\ImageObserver;
use App\Utility\Crawler\Observers\VideoObserver;
use App\Utility\Crawler\Observers\DocumentObserver;

class UyScutiBot
{
    /**
     * Crawler instance.
     * 
     * @var Crawler
     */
    protected Crawler $crawler;

    /**
     * Type sniffer instance.
     * 
     * @var TypeSniffer
     */
    public static $typeSniffer;

    /**
     * Url queue list instance.
     * 
     * @var QueueList
     */
    protected QueueList $queueList;

    /**
     * Crawl observers to observe different kind of content.
     * 
     * @var Observer[]
     */
    protected $observers = [
        SiteObserver::class,
        ImageObserver::class,
        VideoObserver::class,
        DocumentObserver::class
    ];

    /**
     * UyScuti bot constructor.
     * 
     * @param Crawler $crawler
     * @param QueueList $queueList
     * @return void
     */
    public function __construct(Crawler $crawler, QueueList $queueList)
    {
        $this->crawler = $crawler;
        $this->queueList = $queueList;

        $this->initializeCrawler();
        $this->registerCoreObservers();
        
        static::$typeSniffer = app(TypeSniffer::class);
    }

    /**
     * Register your own crawl observer.
     * 
     * @param Observer|string $observer
     * @return void
     */
    public function registerObserver(Observer|string $observer): void
    {
        if($observer instanceof Observer){
            $this->crawler->addCrawlObserver(
                $observer
            );

            return;
        }

        $this->crawler->addCrawlObserver(app($observer));
    }

    /**
     * Crawl either from given url or from url queues list.
     * 
     * @param string|null $url
     * @return void
     */
    public function crawl(string|null $url = null): void
    {
        DB::beginTransaction();
        
        try {
            $this->initialize(
                [$url]
            );
        } catch (Exception $e) {
            DB::rollBack();
            
            Log::error(sprintf("Error Caught: [code:%s] %s",
                $e->getCode(),$e->getMessage()),$e->getTrace()
            );
        }
    }

    /**
     * Initial uyscuti bot and start crawling pages.
     * 
     * @param array $urls
     * @return void
     */
    protected function initialize(array $urls = [])
    {
        $urls = (collect($urls)->filter(
            fn($url) => is_string($url))->toArray()
        );
        
        if(empty($urls)){
            $urls = $this->queueList->getAll();
        }
        
        $this->startCrawlerBot($urls);
    }

    /**
     * Start crawler bot.
     * 
     * @param string[] $urls
     * @return void
     */
    protected function startCrawlerBot(array $urls)
    {
        (collect($urls)->map(
            fn($url) => (
                ((!$url instanceof Queue)
                    ? $url: $url->getUrl()
                )
            ))->map(function ($url) {
                try {
                    ($this->crawler
                        ->startCrawling($url)
                    );

                    $this->queueList->crawled($url);
                } catch(Exception $e){
                    $this->queueList->unCrawled($url);

                    Log::error(sprintf("Error Caught: [code:%s] %s",
                        $e->getCode(),$e->getMessage()),$e->getTrace()
                    );
                }
            })
        );
    }

    /**
     * Initialize crawl.
     * 
     * @return void
     */
    protected function initializeCrawler()
    {
        ($this->crawler
            ->setConcurrency(
                env('CRAWLER_CONCURRENCY',1)
            )->setDelayBetweenRequests(
                env('CRAWLER_DELAY_BETWEEN_REQUESTS')
            )->setUserAgent(
                $site = env('CRAWLER_NAME','UyScuti-Bot')
            )
        );
    }

    /**
     * Register core crawl observers.
     * 
     * @return void
     */
    protected function registerCoreObservers(): void
    {
        (collect($this->observers)
            ->map(fn($observer) => app($observer))
            ->map(fn($observer) => (
                $this->crawler->addCrawlObserver($observer)
            ))
        );
    }
};
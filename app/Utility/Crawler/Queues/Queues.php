<?php

namespace App\Utility\Crawler\Queues;

use Spatie\Crawler\CrawlUrl;
use Psr\Http\Message\UriInterface;
use Illuminate\Support\Facades\Cache;
use Spatie\Crawler\Exceptions\InvalidUrl;
use Spatie\Crawler\CrawlQueues\CrawlQueue;
use Spatie\Crawler\Exceptions\UrlNotFoundByIndex;

class Queues implements CrawlQueue
{
    /**
     * Get all known urls, indexed by url string from cache.
     *
     * @return CrawlUrl[]
     */
    public function getUrls()
    {
        return Cache::get(static::class.'::urls',[]);
    }

    /**
     * Set all known urls, indexed by url string in cache.
     *
     * CrawlUrl[] $urls
     * @return CrawlQueue
     */
    public function setUrls($urls): CrawlQueue
    {
        Cache::put(
            static::class.'::urls',$urls
        );

        return $this;
    }

    /**
     * Get pending urls, indexed by url string from cache.
     *
     * @return CrawlUrl[]
     */
    public function getPendingUrls()
    {
        return Cache::get(static::class.'::pendingUrls',[]);
    }

    /**
     * Get pending urls, indexed by url string from cache.
     *
     * @param CrawlUrl[] $urls
     * @return CrawlQueue
     */
    public function setPendingUrls($urls): CrawlQueue
    {
        Cache::put(
            static::class.'::pendingUrls',$urls
        );

        return $this;
    }

    /**
     * Add crawl url in queue.
     *
     * @param CrawlUrl $crawlUrl
     * @return CrawlQueue
     */
    public function add(CrawlUrl $crawlUrl): CrawlQueue
    {
        $urls = $this->getUrls();
        $pendingUrls = $this->getPendingUrls();

        $urlString = (string) $crawlUrl->url;

        if (!isset($urls[$urlString])) {
            $crawlUrl->setId($urlString);

            $urls[$urlString] = $crawlUrl;
            $pendingUrls[$urlString] = $crawlUrl;
        }

        $this->setUrls($urls);
        $this->setPendingUrls($pendingUrls);

        return $this;
    }

    /**
     * Check if has any pending urls.
     *
     * @return bool
     */
    public function hasPendingUrls(): bool
    {
        return (bool) Cache::has(static::class.'::pendingUrls');
    }

    /**
     * Get queue url by id.
     *
     * @param mixed $id
     * @return CrawlUrl
     */
    public function getUrlById($id): CrawlUrl
    {
        $urls = $this->getUrls();

        if (isset($urls[$id])) {
            return $urls[$id];
        }

        throw new UrlNotFoundByIndex(
            "Crawl url {$id} not found in collection."
        );
    }

    /**
     * Check crawl url already has been processed.
     *
     * @param CrawlUrl $crawlUrl
     * @return bool
     */
    public function hasAlreadyBeenProcessed(CrawlUrl $crawlUrl): bool
    {
        $urls = $this->getUrls();
        $pendingUrls = $this->getPendingUrls();

        $urlString = (string) $crawlUrl->url;

        if (isset($pendingUrls[$urlString])) {
            return false;
        }

        if (isset($urls[$urlString])) {
            return true;
        }

        return false;
    }

    /**
     * Mark crawl url as processed.
     *
     * @param CrawlUrl $crawlUrl
     * @return void
     */
    public function markAsProcessed(CrawlUrl $crawlUrl): void
    {
        $pendingUrls = $this->getPendingUrls();

        $urlString = (string) $crawlUrl->url;

        unset($pendingUrls[$urlString]);

        $this->setPendingUrls($pendingUrls);
    }

    /**
     * Get processed url count.
     *
     * @return int
     */
    public function getProcessedUrlCount(): int
    {
        return (count($this->getUrls())
          - count($this->getPendingUrls())
        );
    }

    /**
     * Check has url in crawl queue.
     *
     * @param CrawlUrl|UriInterface $crawlUrl
     * @return bool
     */
    public function has(CrawlUrl|UriInterface $crawlUrl): bool
    {
        $urls = $this->getUrls();

        if ($crawlUrl instanceof CrawlUrl) {
            $urlString = (string) $crawlUrl->url;
        } elseif ($crawlUrl instanceof UriInterface) {
            $urlString = (string) $crawlUrl;
        } else {
            throw InvalidUrl::unexpectedType($crawlUrl);
        }

        return isset($urls[$urlString]);
    }

    /**
     * Get pending url from the crawl url queue.
     *
     * @return CrawlUrl
     */
    public function getPendingUrl(): ?CrawlUrl
    {
        foreach ($this->getPendingUrls() as $pendingUrl) {
            return $pendingUrl;
        }

        return null;
    }
}
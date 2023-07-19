<?php

namespace App\Utility\Crawler\Queues;

use Exception;
use Illuminate\Support\Arr;
use App\Models\UrlQueueAtlas;
use App\Utility\Crawler\Queues\Queue;
use Illuminate\Support\Facades\Validator;

class QueueList
{
    /**
     * Check url is not exists in queue list.
     * 
     * @param string $url
     * @return bool
     */
    public function isNotQueued(string $url)
    {
        return !$this->isQueued($url);
    }

    /**
     * Check url already exists in queue list.
     * 
     * @param string $url
     * @return bool
     */
    public function isQueued(string $url)
    {
        return UrlQueueAtlas::where('url',$url)->exists();
    }

    /**
     * Set url status to be uncrawled in queue list.
     * 
     * @param string $identifer
     * @return $this
     */
    public function unCrawled(string $identifer)
    {
        (UrlQueueAtlas::where('id',$identifer)
            ->orWhere('url',$identifer)
            ->update([
                'crawled' => 0
            ])
        );

        return $this;
    }

    /**
     * Set url status to be crawled in queue list.
     * 
     * @param string $identifer
     * @return $this
     */
    public function crawled(string $identifer)
    {
        (UrlQueueAtlas::where('id',$identifer)
            ->orWhere('url',$identifer)
            ->update([
                'crawled' => 1
            ])
        );

        return $this;
    }

    /**
     * Get all queues from the queue list.
     * 
     * @return Queue[]
     */
    public function getAll()
    {
        return (UrlQueueAtlas::where('crawled',0)
            ->get()->map(fn($queue) => new Queue($queue))->toArray()
        );
    }

    /**
     * Get multiple urls by id from queue list.
     * 
     * @param string[] $ids
     * @return array[string|null]
     */
    public function getUrls(array $ids)
    {
        return (collect($ids)->map(
            fn($id) => $this->getUrl($id))->toArray()
        );
    }

    /**
     * Get url by id from queue list.
     * 
     * @param string $id
     * @return string|null
     */
    public function getUrl(string $id)
    {
        $queue = UrlQueueAtlas::where('id',$id)->first();
        
        return ((null === $queue )
            ? $queue: $queue->url
        );
    }

    /**
     * Get multiple urls ids from queue list.
     * 
     * @param string[] $urls
     * @return array[string|null]
     */
    public function getIds(array $urls)
    {
        return (collect($urls)
            ->map(fn($url) => $this->getId($url))->toArray()
        );
    }

    /**
     * Get url id from queue list.
     * 
     * @param string $url
     * @return string
     */
    public function getId(string $url)
    {
        $queue = UrlQueueAtlas::where('url',$url)->first();
        
        return ((null === $queue )
            ? $queue: $queue->id
        );
    }

    /**
     * Add multiple urls to queue list.
     * 
     * @param string[] $urls
     * @return $this
     */
    public function addUrls(array $urls)
    {
        (collect($urls)
            ->filter(fn($url) => is_string($url))
            ->map(fn($url) => $this->addUrl($url))
        );

        return $this;
    }

    /**
     * Add new url to queue list.
     * 
     * @param string $url
     * @return $this
     * @throws Exception
     */
    public function addUrl(string $url)
    {
        $this->validateUrl($url);

        if($this->isQueued($url)){
            return $this;
        }

        UrlQueueAtlas::create(['url' => $url]);

        return $this;
    }

    /**
     * Remove urls from queue list.
     * 
     * @param string[] $urls
     * @return $this
     */
    public function removeUrls(array $urls)
    {
        (collect($urls)
            ->filter(fn($url) => is_string($url))
            ->map(fn($url) => $this->removeUrl($url))
        );

        return $this;
    }

    /**
     * Remove url from queue list.
     * 
     * @param string $url
     * @return $this
     */
    public function removeUrl(string $url)
    {
        if(!$this->isQueued($url)){
            return $this;
        }

        UrlQueueAtlas::where('url',$url)->delete();

        return $this;
    }

    /**
     * Validate given url.
     * 
     * @param string $url
     * @return string
     * @throws Exception
     */
    protected function validateUrl(string $url)
    {
        $validator = Validator::make(
            ['url' => $url],[
            'url' => 'required|url',
        ]);

        if ($validator->fails()) {
            throw new Exception(spritf(
                "Given [url: %s] is invalid!",$url
            ));
        }

        return Arr::get($validator->validated(),'url');
    }
};

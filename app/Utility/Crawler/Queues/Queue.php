<?php

namespace App\Utility\Crawler\Queues;

use Exception;
use Illuminate\Support\Arr;
use App\Models\UrlQueueAtlas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Queue
{
    /**
     * Queue pivot model.
     * 
     * @var model
     */
    protected model $pivot;

    /**
     * Queue class constructor.
     * 
     * @param model $pivot
     * @return void
     */
    public function __construct(UrlQueueAtlas $pivot)
    {
        $this->pivot = $pivot;
    }

    /**
     * Get pivot.
     * 
     * @return model
     */
    public function getPivot()
    {
        return $this->pivot;
    }

    /**
     * Get queue uuid.
     * 
     * @return string
     */
    public function getId()
    {
        return $this->pivot->id;
    }

    /**
     * Get queue url.
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->pivot->url;
    }
    
    /**
     * Check queue is crawled.
     * 
     * @return bool
     */
    public function isCrawled()
    {
        return $this->pivot->crawled;
    }

    /**
     * Check queue is not crawled.
     * 
     * @return bool
     */
    public function isNotCrawled()
    {
        return !$this->pivot->crawled;
    }
};
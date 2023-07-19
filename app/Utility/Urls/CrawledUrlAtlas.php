<?php

namespace App\Utility\Urls;

use Illuminate\Database\Eloquent\Model;
use App\Models\CrawledUrlAtlas as Pivot;

class CrawledUrlAtlas
{
    /**
     * Root url atlas pivot model.
     * 
     * @var model
     */
    protected model $pivot;

    /**
     * Crawled url atlas class constructor.
     * 
     * @param Model $pivot
     * @return void
     */
    public function __construct(Pivot $pivot)
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
     * Make specfied url crawled with given status.
     * 
     * @param string $subUrlId
     * @param string $status
     * @param string $Url
     * @return Pivot
     */
    public function crawled(string $subUrlId, string $status, string $url)
    {
        $CrawledAtlas = $this->pivot->where('url',$url)->first();

        if($CrawledAtlas){
            $CrawledAtlas->update([
                'status',$status
            ]);

            return $CrawledAtlas;
        }

        return $this->pivot->create([
            'url' => $url,
            'status' => $status,
            'sub_url_id' => $subUrlId
        ]);
    }

    /**
     * Check crawled url exists.
     * 
     * @param string $url
     * @return bool
     */
    public function isExists(string $url)
    {
        return $this->pivot->where('url',$url)->exists();
    }

    /**
     * Check url is crawled.
     * 
     * @param string $url
     * @return bool
     */
    public function isCrawled(string $url)
    {
        return $this->pivot->where([
            ['status','success'],['url',$url]
        ])->exists();
    }

    /**
     * Check url is not crawled.
     * 
     * @param string $url
     * @return bool
     */
    public function isNoCrawled(string $url)
    {
        return $this->pivot->where([
            ['status','failed'],['url',$url]
        ])->exists();
    }
};
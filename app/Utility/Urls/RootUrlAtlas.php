<?php

namespace App\Utility\Urls;

use App\Utility\Urls\Atlas;
use App\Models\RootUrlAtlas as Pivot;
use Illuminate\Database\Eloquent\Model;
use AshAllenDesign\FaviconFetcher\Facades\Favicon;

class RootUrlAtlas extends Atlas
{
    /**
     * Root url atlas pivot model.
     * 
     * @var model
     */
    protected model $pivot;

    /**
     * Url favicon.
     * 
     * @var ?string
     */
    protected ?string $favicon;

    /**
     * Url atlas class constructor.
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
     * Url favicon.
     * 
     * @param string $url
     * @return $this
     */
    public function favicon(string $url)
    {
        $favicon = Favicon::fetchOr($url, null);

        if(is_null($favicon)){
            $this->favicon = $favicon;
        } else if(is_string($favicon)){
            $this->favicon = $favicon;
        } else {
            $this->favicon = (
                (string) $favicon->getFaviconUrl()
            );
        }

        return $this;
    }

    /**
     * Get pivot from given url.
     * 
     * @param string $url
     * @return model
     */
    public function getPivotFrom(string $url)
    {
        return $this->pivot->where('url',$url)->first();
    }

    /**
     * Check url already exists.
     * 
     * @param string $url
     * @return bool
     */
    public function isExists(string $url)
    {
        return $this->pivot->where('url',$url)->exists();
    }

    /**
     * Submit url to url atlas.
     * 
     * @return model
     */
    public function submit()
    {
        return $this->pivot->create(collect([
            'url' => $this->url,
            'favicon' => $this->favicon
        ])->merge($this->meta)
            ->merge($this->data)->toArray()
        );
    }
};
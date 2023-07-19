<?php

namespace App\Utility\Urls;

use App\Utility\Urls\Atlas;
use App\Models\RootUrlAtlas;
use App\Models\SubUrlAtlas as Pivot;
use Illuminate\Database\Eloquent\Model;
use AshAllenDesign\FaviconFetcher\Facades\Favicon;

class SubUrlAtlas extends Atlas
{
    /**
     * Sub url atlas pivot model.
     * 
     * @var model
     */
    protected model $pivot;

    /**
     * Url type.
     * 
     * @var string
     */
    protected string $type;

    /**
     * Supported devices by the url.
     * 
     * @var array
     */
    protected string $devices;

    /**
     * From url.
     * 
     * @var string|null
     */
    protected ?string $fromUrl;

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
     * Get handler.
     * 
     * @return RootUrlAtlas
     */
    public function getHandler()
    {
        return $this->handler;
    } 

    /**
     * Url type.
     * 
     * @param string $type
     * @return $this
     */
    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Supported devices.
     * 
     * @param array $devices
     * @return $this
     */
    public function devices(array $devices)
    {
        $this->devices = (collect(
            explode(",",$this->devices ?? '')
        )->merge($devices)->filter(
            fn($device) => !empty($device))->implode(',')
        );

        return $this;
    }

    /**
     * From url.
     * 
     * @param string|null $fromUrl
     * @return $this
     */
    public function fromUrl(?string $fromUrl)
    {
        $this->fromUrl = $fromUrl;

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
     * Check url already exists in url atlas.
     * 
     * @param string $rootUrlId
     * @param string $url
     * @return bool
     */
    public function isExists(string $rootUrlId, string $url)
    {
        return $this->pivot->where([
            ['root_url_id',$rootUrlId],['url',$url]
        ])->exists();
    }

    /**
     * Submit url to sub url atlas.
     * 
     * @param RootUrlAtlas $rootUrl
     * @return model
     */
    public function submitTo(RootUrlAtlas $rootUrl)
    {
        return $this->pivot->create(collect([
            'url' => $this->url,
            'type' => $this->type,
            'devices' => $this->devices,
            'from_Url' => $this->fromUrl,
            'root_url_id' => $rootUrl->id
        ])->merge($this->meta)
            ->merge($this->data)->toArray()
        );
    }
};
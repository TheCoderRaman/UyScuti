<?php

namespace App\Utility\Crawler;

use \Exception;
use App\Utility\Urls\SubUrlAtlas;
use App\Utility\Urls\RootUrlAtlas;
use Illuminate\Support\Facades\Log;
use App\Utility\Crawler\DomainParser;
use App\Utility\Crawler\MetaTagParser;
use Illuminate\Database\Eloquent\Model;

class Indexer
{
    /**
     * Url for where sub url will be index to.
     * 
     * @var string
     */
    protected string $onUrl;

    /**
     * Sub url atlas instance.
     * 
     * @var Model
     */
    protected Model $subUrlAtlas;

    /**
     * Root url atlas instance.
     * 
     * @var Model
     */
    protected Model $rootUrlAtlas;

    /**
     * Get sub pivot.
     * 
     * @return model
     */
    public function getSubPivot()
    {
        return $this->subUrlAtlas;
    }

    /**
     * Get root pivot.
     * 
     * @return model
     */
    public function getRootPivot()
    {
        return $this->rootUrlAtlas;
    }

    /**
     * On url.
     * 
     * @param string $onUrl
     * @return $this
     */
    public function onUrl(string $onUrl)
    {
        $this->onUrl = $onUrl;

        return $this;
    }

    /**
     * Index given url.
     * 
     * @param SubUrlAtlas $subAtlas
     * @return bool
     */
    public function index(SubUrlAtlas $subAtlas)
    {
        $result = false;

        try {
            $result = $this->indexUrl($subAtlas);
        } catch(Exception $e){
            $result = false;

            Log::error(sprintf(
                "Indexer Error Caught: [code:%s] %s",
                $e->getCode(),$e->getMessage()),$e->getTrace()
            );
        }

        return $result;
    }

    /**
     * Indexing given url in root url atlas.
     * 
     * @param SubUrlAtlas $subAtlas
     * @return bool
     */
    protected function indexUrl(SubUrlAtlas $subAtlas)
    {
        $rootUrl = (app(RootUrlAtlas::class)
          ->url($this->onUrl)
        );

        $DomainDetails = DomainParser::getDetails($this->onUrl);

        $url = preg_replace('#^https?://#', '', $this->onUrl);
        $url = str_replace($DomainDetails['domain'],'',$url);

        $subAtlas->url($url = trim($url,'/'));

        if($rootUrl->isExists($DomainDetails['domain'])){
            $rootPivot = $rootUrl->getPivotFrom(
                $DomainDetails['domain']
            );

            if($subAtlas->isExists($rootPivot->id,$url)){
                $this->rootUrlAtlas = $rootPivot;

                $this->subUrlAtlas = (
                    $subAtlas->getPivotFrom($url)
                );

                return true;
            }

            $this->subUrlAtlas = $subAtlas->submitTo(
                $this->rootUrlAtlas = $rootPivot
            );
        } else {
            $MetaTags = MetaTagParser::getMetaTags(
                $this->onUrl
            );
    
            $rootUrl->metas(
                array_merge($MetaTags,[
                    'keywords' => []
                ])
            )->url(
                $DomainDetails['domain']
            )->data('modified_at',
                now()->toDateTimeString()
            )->data(
                'domain_details',$DomainDetails
            )->favicon(
                "http://".$DomainDetails['domain']
            );
   
            $this->subUrlAtlas = $subAtlas->submitTo(
                $this->rootUrlAtlas = $rootUrl->submit()
            );
        }

        return true;
    }
};
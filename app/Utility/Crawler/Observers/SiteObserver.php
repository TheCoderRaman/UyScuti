<?php

namespace App\Utility\Crawler\Observers;

use Illuminate\Support\Arr;
use App\Utility\Crawler\Indexer;
use App\Utility\Urls\SubUrlAtlas;
use DonatelloZa\RakePlus\RakePlus;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\UriInterface;
use App\Utility\Urls\CrawledUrlAtlas;
use App\Utility\Crawler\MetaTagParser;
use Psr\Http\Message\ResponseInterface;
use App\Console\Commands\CrawlerCommand;
use App\Utility\Crawler\Observers\Observer;

final class SiteObserver extends Observer
{
    /**
     * Called when the crawler has crawled the given url successfully.
     * 
     * @param UriInterface $url
     * @param ResponseInterface $response
     * @param ?UriInterface $foundOnUrl
     * @param ?string $linkText
     * @return void
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText  = null
    ): void {
        $headers = $response->getHeaders();
        
        if(!$this->isSupported(
            $url,$headers,['site']
        )){
            return;
        }

        if(app(CrawledUrlAtlas::class)->isExists($url)){
            if(!app()->runningInConsole()){
                return;
            }

            app(CrawlerCommand::class)->question(
                sprintf("Already Crawled: %s",$url)
            );
            app(CrawlerCommand::class)->line("\n");
            return;
        }

        $MetaTags = MetaTagParser::getMetaTags($response);
        $viewport = Arr::has($MetaTags,'viewport');

        Arr::forget($MetaTags,'viewport');

        $subUrl = (app(SubUrlAtlas::class)->fromUrl($foundOnUrl)
            ->url($url)->type('site')
            ->metas(array_merge([
                'description' => $linkText,
                'keywords' => (collect(RakePlus::create(
                    $linkText)->get())->map(
                        fn($word) => trim($word)
                    )->toArray()
                )
            ],$MetaTags
            ))->devices(!$viewport 
                ? ['window','mac','linux','chromeos']
                : ['window','mac','linux','android','chromeos']
            )->data('modified_at',Arr::get(
                $headers,'last-modified.0',now()->toDateTimeString())
            )
        );

        $indexer = app(Indexer::class);
        $result = $indexer->onUrl($url)->index($subUrl);

        if(!$result){
            return;
        } else {
            app(CrawledUrlAtlas::class)->crawled(
                $indexer->getSubPivot()->id,'success',$url
            );
        }

        DB::commit();
    }
};

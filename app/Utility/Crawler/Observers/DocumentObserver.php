<?php

namespace App\Utility\Crawler\Observers;

use Illuminate\Support\Arr;
use App\Utility\Crawler\Indexer;
use App\Utility\Urls\SubUrlAtlas;
use Illuminate\Support\Facades\DB;
use Psr\Http\Message\UriInterface;
use App\Utility\Urls\CrawledUrlAtlas;
use Psr\Http\Message\ResponseInterface;
use App\Utility\Crawler\Observers\Observer;

final class DocumentObserver extends Observer
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
        ?string $linkText = null
    ): void {
        $headers = $response->getHeaders();
        
        if(!$this->isSupported(
            $url,$headers,['document']
        )){
            return;
        }

        $pathInfo = pathinfo($url);

        $subUrl = (app(SubUrlAtlas::class)->fromUrl($foundOnUrl)
            ->url($url)->type('document')
            ->metas([
                'keywords' => [],
                'description' => $linkText,
                'title' => $pathInfo['basename'] ?? '',
            ])->devices([
                'window','mac','linux','android','chromeos'
            ])->data('modified_at',Arr::get(
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

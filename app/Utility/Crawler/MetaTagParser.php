<?php

namespace App\Utility\Crawler;

use \Exception;
use \DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Spatie\Crawler\ResponseWithCachedBody;

class MetaTagParser 
{
    /**
     * Supported meta tags.
     * 
     * @var static string[]
     */
    public static $SupportedMetaTags = [
        'title','description','keywords','viewport'
    ];

    /**
     * Get meta tags from url or from response.
     * 
     * @param string|ResponseWithCachedBody $response
     * @return array
     */
    public static function getMetaTags(
        string|ResponseWithCachedBody $response
    ){
        try {
            return self::findMetaTags($response);
        } catch(Exception $e){
            Log::error(sprintf(
                "Meta Parser Error Caught: [code:%s] %s",
                $e->getCode(),$e->getMessage()),$e->getTrace()
            );
        }

        return [];
    }
    
    /**
     * Find meta tags from given data.
     * 
     * @param string|ResponseWithCachedBody $response
     * @return array
     */
    public static function findMetaTags(
        string|ResponseWithCachedBody $response
    ){
        if($response instanceof ResponseWithCachedBody){
            return self::parseMetaTagsFrom($response);
        }

        $client = new Client();
        $response = $client->get($response);

        $responseWithCachedBody = (
            ResponseWithCachedBody::fromGuzzlePsr7Response(
                $response
            )
        );

        $responseWithCachedBody->setCachedBody(
            $response->getBody()
        );

        return self::parseMetaTagsFrom($responseWithCachedBody);
    }

    /**
     * Parse meta tags from the response body.
     * 
     * @param ResponseWithCachedBody $response
     * @return array
     */
    public static function parseMetaTagsFrom(
        ResponseWithCachedBody $response
    ){
        $metaTags = [];

        $doc = new DOMDocument();

        @$doc->loadHTML(
            $response->getCachedBody()
        );

        $nodes = $doc->getElementsByTagName('title');
        $metas = $doc->getElementsByTagName('meta');

        $metaTags['title'] = $nodes->item(0)->nodeValue ?? null;

        if(null === $metaTags['title']){
            return $metaTags;
        }
        
        for ($i = 0; $i < $metas->length; $i++)
        {
            $meta = $metas->item($i);
            $key = $meta->getAttribute('name');
            $content = $meta->getAttribute('content');

            if(!in_array($key,self::$SupportedMetaTags)){
                continue;
            }

            $metaTags[$key] = $content;
        }

        return $metaTags;
    }
}
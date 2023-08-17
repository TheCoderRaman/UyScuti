<?php

namespace App\Http\Controllers\Api\V1\Bot;

use Validator;
use Exception;
use Illuminate\Http\Request;
use App\Models\UrlQueueAtlas;
use Illuminate\Http\Response; 
use App\Utility\Api\ApiCodes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use App\Utility\Crawler\Queues\QueueList;
use Illuminate\Validation\ValidationException;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

class CrawlerController extends Controller
{
    /**
     * Create a new CrawlerController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Store the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function crawl(Request $request)
    {
        $data = Validator::make($request->all(), [
            'url' => 'required|url'
        ])->validate();

        $this->checkUrl($data['url']);

        try {
            $queue = (app(QueueList::class)
                ->addUrl($data['url'])->getQueue($data['url'])
            );

            return $this->prepareResponse($queue->getPivot());
        } catch(Exception $e){
            return ResponseBuilder::error(ApiCodes::INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Check url before adding in queue list.
     * 
     * @param string $url
     * @return \Illuminate\Http\Response
     */
    protected function checkUrl($url)
    {
        $queueList = app(QueueList::class);

        if(!$queueList->isQueued($url)){
            return;
        }

        if(!$queue = $queueList->getQueue($url)){
            throw ValidationException::withMessages([
                'url' => Lang::get('backend.url not found')
            ]);
        } else if($queue->isCrawled()){
            throw ValidationException::withMessages([
                'url' => Lang::get('backend.url already crawled')
            ]);
        }

        throw ValidationException::withMessages([
            'url' => Lang::get('backend.url already queued')
        ]);
    }

    /**
     * Prepare reponse from the given queue data.
     * 
     * @param UrlQueueAtlas|null $queue
     * @return \Illuminate\Http\Response
     */
    protected function prepareResponse(?UrlQueueAtlas $queue)
    {
        if($queue instanceof UrlQueueAtlas){
            $queue = [
                'id' => $queue->id,
                'url' => $queue->url,
                'created_at' => $queue->created_at
            ];

            return (ResponseBuilder::asSuccess()
                ->withHttpCode(ApiCodes::CREATED)->withData($queue)->build()
            );
        }

        return (ResponseBuilder::asError($api_code)
            ->withHttpCode(ApiCodes::NOT_ACCEPTABLE)
            ->withMessage(Lang::get('backend.Url is not a valid url'))->build()
        );
    }
}

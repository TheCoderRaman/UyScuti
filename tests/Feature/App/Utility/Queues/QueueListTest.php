<?php

namespace Tests\Feature\App\Utility\Queues;

use Exception;
use Tests\TestCase;
use App\Models\UrlQueue;
use App\Utility\Crawler\Queues\QueueList;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QueueListTest extends TestCase
{
    /**
     * Test is not queue.
     * 
     * @return void
     */
    public function testIsNotQueued(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queueList->addUrls([
            "http://example.com/1"
        ]);

        $this->assertFalse($queueList
            ->isNotQueued("http://example.com/1")
        );
    }

    /**
     * Test is queue.
     * 
     * @return void
     */
    public function testIsQueued(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queueList->addUrls([
            "http://example.com/1"
        ]);

        $this->assertTrue($queueList
            ->isQueued("http://example.com/1")
        );
    }

    /**
     * Test un crawled.
     * 
     * @return void
     */
    public function testUnCrawled(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queueList->addUrl(
            $url = "http://example.com/1"
        );

        $queueList->unCrawled($url);

        $queuesAfter = UrlQueue::all();

        $this->assertTrue(
            $queuesAfter->first()->crawled === 0
        );
    }

    /**
     * Test crawled.
     * 
     * @return void
     */
    public function testCrawled(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queueList->addUrl(
            $url = "http://example.com/1"
        );

        $queueList->crawled($url);

        $queuesAfter = UrlQueue::all();

        $this->assertTrue(
            $queuesAfter->first()->crawled === 1
        );
    }

    /**
     * Test queue list get all.
     * 
     * @return void
     */
    public function testGetAll(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrls([
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $queuesAfter = UrlQueue::all();

        $this->assertEquals($queuesAfter->map(
                fn($queue) => $queue->url
            )->toArray(),(collect($queueList->getAll())
                ->map(fn($queue) => $queue->getUrl())->toArray()
            )
        );

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test get urls.
     * 
     * @return void
     */
    public function testGetUrls(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrls([
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $queuesAfter = UrlQueue::all();

        $ids = ($queuesAfter->reverse()->map(
            fn($queue) => $queue->id)->toArray()
        );

        $this->assertEquals($queuesAfter->map(
                fn($queue) => $queue->url
            )->toArray(),collect(
                $queueList->getUrls($ids)
            )->reverse()->toArray()
        );

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test get url.
     * 
     * @return void
     */
    public function testGetUrl(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrl(
            "http://example.com/3"
        );

        $queuesAfter = UrlQueue::all();

        $id = $queuesAfter->first()->id;

        $this->assertEquals($queuesAfter->filter(
                fn($queue) => (
                    $queue->id == $id
                )
            )->map(
                fn($queue) => $queue->url
            )->get(0),$queueList->getUrl($id)
        );

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test get ids.
     * 
     * @return void
     */
    public function testGetIds(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrls([
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $queuesAfter = UrlQueue::all();

        $urls = ($queuesAfter->reverse()->map(
            fn($queue) => $queue->url)->toArray()
        );

        $this->assertEquals($queuesAfter->map(
                fn($queue) => $queue->id
            )->toArray(),collect(
                $queueList->getIds($urls)
            )->reverse()->toArray()
        );

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test get id.
     * 
     * @return void
     */
    public function testGetId(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrl(
            $url = "http://example.com/3"
        );

        $queuesAfter = UrlQueue::all();

        $this->assertEquals($queuesAfter->filter(
                fn($queue) => (
                    $queue->url == $url
                )
            )->map(
                fn($queue) => $queue->id
            )->get(0),$queueList->getId($url)
        );

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test queue list add urls.
     * 
     * @return void
     */
    public function testAddUrls(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrls([
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $queuesAfter = UrlQueue::all();

        $this->assertEquals($queuesAfter->map(
            fn($queue) => $queue->url
        )->toArray(),[
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test queue list add url.
     * 
     * @return void
     */
    public function testAddUrl(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrl("http://example.com/1");
        $queueList->addUrl("http://example.com/2");
        $queueList->addUrl("http://example.com/3");
        $queueList->addUrl("http://example.com/4");
        $queueList->addUrl("http://example.com/5");

        $queuesAfter = UrlQueue::all();

        $this->assertEquals($queuesAfter->map(
            fn($queue) => $queue->url
        )->toArray(),[
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test exception thrown on invalid url.
     * 
     * @return void
     */
    public function testExceptionOnInvalidUrl(): void
    {
        $this->expectException(Exception::class);

        $queueList->addUrl("http{:}[//]example{.}com[/]");
        
        $queueList->addUrls([
            "http://example.com/1","http{:}[//]example{.}com[/]"
        ]);
    }

    /**
     * Test queue list remove urls.
     * 
     * @return void
     */
    public function testRemoveUrls(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrls([
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $queueList->removeUrls([
            "http://example.com/1",
            "http://example.com/3"
        ]);

        $queuesAfter = UrlQueue::all();

        $this->assertEquals($queuesAfter->map(
            fn($queue) => $queue->url
        )->toArray(),[
            "http://example.com/2",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $this->assertFalse($queuesBefore === $queuesAfter);
    }

    /**
     * Test queue list remove url.
     * 
     * @return void
     */
    public function testRemoveUrl(): void
    {
        UrlQueue::truncate();

        $queueList = app(QueueList::class);

        $queuesBefore = UrlQueue::all();

        $queueList->addUrls([
            "http://example.com/1",
            "http://example.com/2",
            "http://example.com/3",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $queueList->removeUrl(
            "http://example.com/1"
        );
        $queueList->removeUrl(
            "http://example.com/3"
        );

        $queuesAfter = UrlQueue::all();

        $this->assertEquals($queuesAfter->map(
            fn($queue) => $queue->url
        )->toArray(),[
            "http://example.com/2",
            "http://example.com/4",
            "http://example.com/5"
        ]);

        $this->assertFalse($queuesBefore === $queuesAfter);
    }
}

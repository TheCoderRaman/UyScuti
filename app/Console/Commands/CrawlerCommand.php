<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Utility\Crawler\UyScutiBot;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutput;

class CrawlerCommand extends Command
{
    /**
     * UyScuti bot for crawling urls.
     *
     * @var UyScutiBot
     */
    protected UyScutiBot $bot;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crawler {
        --url= : Crawl the given url
    }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically discover and scan websites by following links from one web page to another';

    /**
     * Crawler command constructor.
     *
     * @param ConsoleOutput $output
     * @param UyScutiBot $bot
     * @return void
     */
    public function  __construct(ConsoleOutput $output,UyScutiBot $bot)
    {
        parent::__construct();

        $this->bot = $bot;
        $this->output = $output;

        app()->bind(
            Crawler::class, fn() => $this
        );
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $url = $this->option('url');

        $this->line("Waked: UyScuti bot");
        $this->newLine();

        if(null === $url){
            $this->bot->crawl();
        } else {
            $this->bot->crawl($url);
        }

        $this->newLine();
        $this->line("Sleeped: UyScuti bot");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['url', 'u', InputOption::VALUE_OPTIONAL, 'Url to be crawled by the bot',null],
        ];
    }
}

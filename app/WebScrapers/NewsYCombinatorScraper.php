<?php

namespace App\WebScrapers;

use App\Interfaces\WebScraper;
use App\Interfaces\WebScraperErrorHandler;
use App\Interfaces\WebScraperFormatter;
use App\Services\NewsYCombinatorScraperErrorManager;
use App\Services\NewsYCombinatorScraperFormatter;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class NewsYCombinatorScraper implements WebScraper
{
    /** @var NewsYCombinatorScraperFormatter $webScraperFormatter */
    private $webScraperFormatter;

    /** @var array $scrapResult */
    private $scrapResult;

    /** @var NewsYCombinatorScraperErrorManager $errormanager */
    private $errormanager;

    
    public function __construct(WebScraperFormatter $webScraperFormatter, WebScraperErrorHandler $errormanager)
    {
        $this->webScraperFormatter = $webScraperFormatter;
        $this->errormanager = $errormanager;
    }

    /**
     * Executes the scrap
     * @return void
     */
    private function doScrap()
    {
        $this->scrapResult =  $this->errormanager->scrapWrapper(
            function () {
                $client = new Client();
                $website = $client->request('GET', 'https://news.ycombinator.com',  ['timeout' => 2.5]);
                $cssSelector = '.titleline > a, .rank, .spacer, .subline span.score, .subline > a[href*="item"]';
                return  $website->filter($cssSelector)
                    ->each(function (Crawler $node) {
                        return $node->text();
                    });
            }
        );
    }

    public function getItems()
    {
        if (empty($this->scrapResult)) {
            $this->doScrap();
        }
        return $this->webScraperFormatter->formatItems($this->scrapResult);
    }
}

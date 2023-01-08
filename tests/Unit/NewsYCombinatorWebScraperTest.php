<?php

namespace Tests\Unit;

use App\Services\NewsYCombinatorScraperErrorHandler;
use App\Services\NewsYCombinatorScraperFormatter;
use App\WebScrapers\NewsYCombinatorScraper;
use PHPUnit\Framework\TestCase;

class NewsYCombinatorWebScraperTest extends TestCase
{
    /**
     * A unit test for.the News Y combinator scrapper.
     *
     * @return void
     */
    public function test_news_y_combinator_web_scraper_is_array()
    {
        $scraper = new NewsYCombinatorScraper(new NewsYCombinatorScraperFormatter(), new NewsYCombinatorScraperErrorHandler());
        $this->assertIsArray($scraper->getItems());
        $this->assertTrue(true);

    }
}

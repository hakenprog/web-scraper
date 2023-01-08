<?php

namespace Tests\Unit;

use App\WebScrapers\NewsYCombinatorScraper;
use PHPUnit\Framework\TestCase;

class NewsYCombinatorWebScraperTest extends TestCase
{
    /**
     * A unit test for.the News Y combinator scrapper.
     *
     * @return void
     */
    public function news_y_combinator_web_scraper_is_array()
    {
        $scraper = new NewsYCombinatorScraper();
        $this->assertIsArray($scraper->getItems());
    }
}
